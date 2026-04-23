<?php
/**
 * Export PDF "dossier praticien" : récap complet de la consultation
 * (identité + toutes les questions/réponses + synthèse + PHV + notes internes).
 * Fonctionne pour V1 et V2.
 */

$debugMode = isset($_GET['debug']);
if ($debugMode) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    header('Content-Type: text/plain; charset=utf-8');
    echo "=== DEBUG phv-pdf-praticien ===\nPHP : " . PHP_VERSION . "\n";
    $autoload = __DIR__ . '/../lib/vendor/autoload.php';
    echo "Autoload : " . (file_exists($autoload) ? 'OK' : 'MANQUANT - ' . $autoload) . "\n";
}

try {
    $autoload = __DIR__ . '/../lib/vendor/autoload.php';
    if (!file_exists($autoload)) {
        throw new RuntimeException("Bibliothèque Dompdf absente. Upload manquant : app/lib/vendor/");
    }
    require_once $autoload;
    if (!class_exists('Dompdf\Dompdf')) {
        throw new RuntimeException("Classe Dompdf introuvable.");
    }

$db = getDB();
$consultId = (int) getGet('id');
$userId = currentUserId();

$stmt = $db->prepare("
    SELECT c.*, cl.nom AS client_nom, cl.prenom AS client_prenom, cl.sexe AS client_sexe,
           cl.email AS client_email, cl.telephone AS client_telephone, cl.date_naissance AS client_dob,
           cl.profession AS client_profession, cl.adresse AS client_adresse,
           cl.taille_cm AS client_taille, cl.poids_kg AS client_poids
    FROM consultations c
    JOIN clients cl ON c.client_id = cl.id
    WHERE c.id = ? AND c.user_id = ?
");
$stmt->execute([$consultId, $userId]);
$consultation = $stmt->fetch();
if (!$consultation) { exit('Consultation introuvable.'); }

// Détection V2
$isV2 = ($consultation['trame_version'] ?? 'v1') === 'v2';
if (!$isV2) {
    $checkV2 = $db->prepare("SELECT 1 FROM consultation_reponses WHERE consultation_id = ? AND section LIKE 'v2_step%' LIMIT 1");
    $checkV2->execute([$consultId]);
    $isV2 = (bool) $checkV2->fetchColumn();
}

// Synthèse
$synth = $db->prepare("SELECT * FROM consultation_synthese WHERE consultation_id = ?");
$synth->execute([$consultId]);
$synthese = $synth->fetch() ?: null;

// PHV
$phvStmt = $db->prepare("SELECT * FROM phv WHERE consultation_id = ?");
$phvStmt->execute([$consultId]);
$phv = $phvStmt->fetch() ?: null;

// Praticien
$userStmt = $db->prepare("SELECT * FROM users WHERE id = ?");
$userStmt->execute([$userId]);
$user = $userStmt->fetch();

// Toutes les réponses groupées par section
$rep = $db->prepare("SELECT section, question_key, question_label, reponse FROM consultation_reponses WHERE consultation_id = ? ORDER BY section, id");
$rep->execute([$consultId]);
$reponses = $rep->fetchAll();
$grouped = [];
foreach ($reponses as $r) {
    $grouped[$r['section']][] = $r;
}

// Labels lisibles pour V2 - construit à la volée
function prettyKey(string $k): string {
    $k = preg_replace('/^(atcd|fam|obs|pro|alim|dig|peau|hydra|immu|stress|endo|menopause|spm|sopk|cycle|thyroide|nerv|etat_emo|masculin|cardio|loco|urinaire|emonc|phaneres|repas|aliment|activite|habitat)_/', '', $k);
    $k = str_replace('_', ' ', $k);
    return ucfirst($k);
}

// Libellés des sections V1/V2
$sectionLabels = [
    // V1
    'infos_generales' => '1. Informations générales',
    'historique_medical' => '1. Historique médical',
    'mode_de_vie' => '2. Mode de vie',
    'bilan_digestif' => '3. Bilan digestif',
    'bilan_nerveux' => '3. Bilan nerveux',
    'bilan_endocrinien' => '3. Bilan endocrinien',
    'bilan_cardio' => '3. Bilan cardiovasculaire',
    'bilan_respiratoire' => '3. Bilan respiratoire',
    'bilan_uro_genital' => '3. Bilan uro-génital',
    'bilan_osteo' => '3. Bilan ostéo-articulaire',
    'bilan_tegumentaire' => '3. Bilan tégumentaire',
    'bilan_immunitaire' => '3. Bilan immunitaire',
    'bilan_complementaire' => '4. Bilan complémentaire',
];
// V2
$stepsV2 = CONSULTATION_STEPS_V2;
foreach ($stepsV2 as $num => $s) {
    if ($num <= 15) {
        $sectionLabels['v2_step' . $num] = $num . '. ' . $s['emoji'] . ' ' . $s['label'];
    }
}

// Ordre d'affichage
if ($isV2) {
    $sectionOrder = [];
    for ($i = 1; $i <= 15; $i++) $sectionOrder[] = 'v2_step' . $i;
} else {
    $sectionOrder = ['infos_generales', 'historique_medical', 'mode_de_vie',
        'bilan_digestif', 'bilan_nerveux', 'bilan_endocrinien', 'bilan_cardio', 'bilan_respiratoire',
        'bilan_uro_genital', 'bilan_osteo', 'bilan_tegumentaire', 'bilan_immunitaire', 'bilan_complementaire'];
}

// Helper : formater valeur pour affichage
function fmtVal(string $v): string {
    $v = trim($v);
    // Si CSV de checkboxes, retourner une liste
    if (str_contains($v, ',') && strlen($v) < 500) {
        $parts = array_map('trim', explode(',', $v));
        $parts = array_filter($parts);
        if (count($parts) > 1) return implode(' · ', $parts);
    }
    return nl2br(htmlspecialchars($v, ENT_QUOTES, 'UTF-8'));
}

// Calcul âge
$age = '';
if (!empty($consultation['client_dob'])) {
    $age = (new DateTime($consultation['client_dob']))->diff(new DateTime())->y . ' ans';
}

ob_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Dossier_<?= htmlspecialchars(strtolower($consultation['client_prenom'] . '_' . $consultation['client_nom']) . '_' . date('Y-m-d', strtotime($consultation['date_consultation']))) ?></title>
<style>
@page { size: A4 portrait; margin: 12mm 15mm; }
* { box-sizing: border-box; }
body { font-family: DejaVu Sans, sans-serif; font-size: 9pt; color: #1a1f16; line-height: 1.4; }
h1 { font-size: 18pt; color: #4a6741; margin: 0 0 4pt; }
h2 { font-size: 13pt; color: #c0592a; margin: 10pt 0 4pt; border-bottom: 2px solid #c0592a; padding-bottom: 2pt; }
h3 { font-size: 10.5pt; color: #4a6741; margin: 8pt 0 3pt; }
.subtitle { font-size: 10pt; color: #666; margin-bottom: 8pt; }
.banner { background: #4a6741; color: #fff; padding: 4pt 8pt; font-weight: bold; font-size: 10pt; letter-spacing: 1px; margin-bottom: 10pt; }
.meta-box { border: 1px solid #c0592a; padding: 6pt; margin: 0 0 10pt; background: #fdf5f0; }
.meta-row { display: table-row; }
.meta-cell { display: table-cell; padding: 2pt 6pt; }
.meta-label { font-weight: bold; color: #4a6741; width: 30%; }
table.infogrid { width: 100%; border-collapse: collapse; margin-bottom: 8pt; }
table.infogrid td { padding: 3pt 6pt; vertical-align: top; border-bottom: 1px solid #eee; }
table.infogrid td.k { width: 35%; font-weight: bold; color: #4a6741; background: #f9f9f7; }
table.infogrid td.v { color: #222; }
.section { page-break-inside: auto; margin-bottom: 8pt; }
.empty-note { font-style: italic; color: #999; padding: 4pt; }
.pagebreak { page-break-before: always; }
.phv-block { background: #f3f5ef; border-left: 4px solid #4a6741; padding: 5pt 8pt; margin: 4pt 0; white-space: pre-wrap; }
.synth-card { border: 1px solid #4a6741; background: #f0f4ec; padding: 6pt; margin-bottom: 6pt; }
.priority { padding: 3pt 0; border-bottom: 1px dashed #bbd1ae; }
.priority:last-child { border-bottom: none; }
.priority-num { display: inline-block; background: #c0592a; color: #fff; border-radius: 50%; width: 16pt; height: 16pt; text-align: center; line-height: 16pt; font-weight: bold; margin-right: 5pt; }
.footer { margin-top: 15pt; padding-top: 4pt; border-top: 1px solid #ccc; font-size: 7.5pt; color: #888; }
.internal-note { background: #fff6e0; border: 1px solid #e0a829; padding: 5pt 8pt; margin: 4pt 0; }
</style>
</head>
<body>

<div class="banner">RAPPORT PRATICIEN · Dossier de consultation — Usage interne — Ne pas remettre au client</div>

<h1>Dossier de consultation naturopathique</h1>
<div class="subtitle">
    Consultation du <?= date('d/m/Y', strtotime($consultation['date_consultation'])) ?>
    · Type : <?= $consultation['type_seance'] === 'premiere' ? '1<sup>ère</sup> séance' : 'Suivi' ?>
    · Trame : <?= $isV2 ? 'V2 (TaNaturo/ESN)' : 'V1' ?>
</div>

<div class="meta-box">
    <table style="width:100%">
        <tr>
            <td style="width:50%">
                <strong style="font-size:11pt;"><?= htmlspecialchars($consultation['client_prenom'] . ' ' . $consultation['client_nom']) ?></strong><br>
                <?= $age ?><?= $consultation['client_profession'] ? ' — ' . htmlspecialchars($consultation['client_profession']) : '' ?><br>
                <?= $consultation['client_sexe'] ? ucfirst($consultation['client_sexe']) : '' ?>
                <?= $consultation['client_dob'] ? ' · Né(e) le ' . date('d/m/Y', strtotime($consultation['client_dob'])) : '' ?><br>
                <?= $consultation['client_email'] ? htmlspecialchars($consultation['client_email']) . ' · ' : '' ?>
                <?= $consultation['client_telephone'] ? htmlspecialchars($consultation['client_telephone']) : '' ?><br>
                <?= $consultation['client_adresse'] ? htmlspecialchars($consultation['client_adresse']) : '' ?>
            </td>
            <td style="width:50%; text-align:right;">
                <strong><?= htmlspecialchars($user['prenom'] . ' ' . $user['nom']) ?></strong><br>
                Praticien(ne) en naturopathie<br>
                <?= !empty($user['email']) ? htmlspecialchars($user['email']) : '' ?><br>
                <?= !empty($user['telephone']) ? htmlspecialchars($user['telephone']) : '' ?>
            </td>
        </tr>
    </table>
</div>

<h2>Motif principal</h2>
<div class="phv-block"><?= nl2br(htmlspecialchars($consultation['motif'] ?: 'Non renseigné')) ?></div>

<?php if ($synthese): ?>
<h2>Synthèse &amp; priorités d'action</h2>
<div class="synth-card">
    <?php if (!empty($synthese['priorite_1'])): ?><div class="priority"><span class="priority-num">1</span><?= nl2br(htmlspecialchars($synthese['priorite_1'])) ?></div><?php endif; ?>
    <?php if (!empty($synthese['priorite_2'])): ?><div class="priority"><span class="priority-num">2</span><?= nl2br(htmlspecialchars($synthese['priorite_2'])) ?></div><?php endif; ?>
    <?php if (!empty($synthese['priorite_3'])): ?><div class="priority"><span class="priority-num">3</span><?= nl2br(htmlspecialchars($synthese['priorite_3'])) ?></div><?php endif; ?>

    <?php
    $terrains = json_decode($synthese['organes_desequilibre'] ?? '[]', true) ?: [];
    $axes = json_decode($synthese['axes_travail'] ?? '[]', true) ?: [];
    ?>
    <?php if (!empty($terrains)): ?>
    <div style="margin-top:4pt;"><strong>Terrain :</strong> <?= htmlspecialchars(implode(' · ', $terrains)) ?></div>
    <?php endif; ?>
    <?php if (!empty($axes)): ?>
    <div><strong>Axes :</strong> <?= htmlspecialchars(implode(' · ', $axes)) ?></div>
    <?php endif; ?>
    <?php if (!empty($synthese['observations'])): ?>
    <div style="margin-top:4pt;"><strong>Observations :</strong> <?= nl2br(htmlspecialchars($synthese['observations'])) ?></div>
    <?php endif; ?>
</div>
<?php endif; ?>

<div class="pagebreak"></div>
<h2>Questionnaire — toutes les réponses</h2>

<?php $anyReponse = false; foreach ($sectionOrder as $sec): ?>
    <?php if (empty($grouped[$sec])) continue; $anyReponse = true; ?>
    <div class="section">
        <h3><?= htmlspecialchars($sectionLabels[$sec] ?? $sec) ?></h3>
        <table class="infogrid">
            <?php foreach ($grouped[$sec] as $row): ?>
                <?php
                $label = !empty($row['question_label']) ? $row['question_label'] : prettyKey($row['question_key']);
                $val = fmtVal((string)$row['reponse']);
                if ($val === '') continue;
                ?>
                <tr>
                    <td class="k"><?= htmlspecialchars($label) ?></td>
                    <td class="v"><?= $val ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
<?php endforeach; ?>
<?php if (!$anyReponse): ?>
<p class="empty-note">Aucune réponse au questionnaire enregistrée.</p>
<?php endif; ?>

<?php if ($phv): ?>
<div class="pagebreak"></div>
<h2>Programme d'Hygiène de Vie — version remise au client</h2>

<?php
$phvBlocs = [
    'alimentation' => 'Conseils alimentaires',
    'alimentation_eviter' => 'Aliments à éviter',
    'alimentation_privilegier' => 'Aliments à privilégier',
    'menu_type' => 'Menu type',
    'activite_physique' => 'Activité physique',
    'gestion_stress' => 'Gestion du stress',
    'routine_matin' => 'Routine du matin',
    'routine_soir' => 'Routine du soir',
    'soins_naturels' => 'Soins naturels',
    'recommandations_complementaires' => 'Recommandations complémentaires',
];
foreach ($phvBlocs as $key => $label) {
    $val = trim((string)($phv[$key] ?? ''));
    if ($val === '') continue;
    echo '<h3>' . htmlspecialchars($label) . '</h3>';
    echo '<div class="phv-block">' . htmlspecialchars($val) . '</div>';
}

$complements = json_decode($phv['complements'] ?? '[]', true) ?: [];
if (!empty($complements)) {
    echo '<h3>Compléments alimentaires</h3>';
    echo '<table class="infogrid">';
    foreach ($complements as $c) {
        if (empty($c['nom'])) continue;
        echo '<tr><td class="k">' . htmlspecialchars($c['nom']) . '</td><td class="v">'
           . htmlspecialchars(($c['posologie'] ?? '') . ' — ' . ($c['duree'] ?? ''))
           . (isset($c['raison']) && $c['raison'] ? '<br><em style="color:#888;">' . htmlspecialchars($c['raison']) . '</em>' : '')
           . '</td></tr>';
    }
    echo '</table>';
}
?>

<?php if (!empty($phv['notes'])): ?>
<div class="internal-note">
    <strong>Notes internes (non transmises au client) :</strong><br>
    <?= nl2br(htmlspecialchars($phv['notes'])) ?>
</div>
<?php endif; ?>
<?php endif; ?>

<?php if (!empty($consultation['notes_praticien'])): ?>
<h2>Notes praticien sur la consultation</h2>
<div class="internal-note"><?= nl2br(htmlspecialchars($consultation['notes_praticien'])) ?></div>
<?php endif; ?>

<div class="footer">
    Généré le <?= date('d/m/Y à H:i') ?>
    · Consultation #<?= $consultId ?>
    · Document confidentiel — conservation RGPD selon vos paramètres
</div>

</body>
</html>
<?php
$html = ob_get_clean();

$options = new \Dompdf\Options();
$options->set('isRemoteEnabled', false);
$options->set('isHtml5ParserEnabled', true);
$options->set('defaultFont', 'DejaVu Sans');
$options->set('chroot', [__DIR__ . '/..']);
$options->set('tempDir', sys_get_temp_dir());
$options->set('fontDir', __DIR__ . '/../lib/vendor/dompdf/dompdf/lib/fonts');
$options->set('fontCache', sys_get_temp_dir());

$dompdf = new \Dompdf\Dompdf($options);
$dompdf->loadHtml($html, 'UTF-8');
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

if ($debugMode) {
    echo "\nRendu OK - " . $dompdf->getCanvas()->get_page_count() . " pages\n";
    echo "HTML capturé : " . strlen($html) . " caractères\n";
    echo "\nRetire ?debug=1 pour télécharger.\n";
    exit;
}

$filename = 'Dossier_' . preg_replace('/[^a-zA-Z0-9_-]/', '_', strtolower($consultation['client_prenom'] . '_' . $consultation['client_nom']))
          . '_' . date('Y-m-d', strtotime($consultation['date_consultation'])) . '.pdf';

$dompdf->stream($filename, ['Attachment' => true]);
exit;

} catch (Throwable $e) {
    if (isset($debugMode) && $debugMode) {
        echo "\n!!! EXCEPTION !!!\n" . get_class($e) . " : " . $e->getMessage() . "\n"
           . "Fichier : " . $e->getFile() . ":" . $e->getLine() . "\n\n"
           . $e->getTraceAsString() . "\n";
    } else {
        http_response_code(500);
        header('Content-Type: text/html; charset=utf-8');
        echo '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Erreur PDF</title></head><body style="font-family:sans-serif;padding:2rem;max-width:800px;margin:auto;">';
        echo '<h1 style="color:#c0392b;">Erreur lors de la génération du PDF praticien</h1>';
        echo '<p>' . htmlspecialchars($e->getMessage()) . '</p>';
        echo '<p><a href="?page=phv-pdf-praticien&id=' . (int)($_GET['id'] ?? 0) . '&debug=1">Mode debug</a> · <a href="javascript:history.back()">← Retour</a></p>';
        echo '</body></html>';
    }
    exit;
}
