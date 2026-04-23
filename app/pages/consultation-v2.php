<?php
/**
 * Questionnaire V2 - dispatcher
 * Route vers app/pages/v2-sections/{N}-{slug}.php selon ?step=N
 */
$db = getDB();
$consultId = (int) getGet('id');
$userId = currentUserId();
$currentStep = max(1, min(15, (int) getGet('step', 1)));

$stmt = $db->prepare("SELECT c.*, cl.nom AS client_nom, cl.prenom AS client_prenom, cl.sexe AS client_sexe, cl.date_naissance AS client_dob
                      FROM consultations c JOIN clients cl ON c.client_id = cl.id
                      WHERE c.id = ? AND c.user_id = ?");
$stmt->execute([$consultId, $userId]);
$consultation = $stmt->fetch();
if (!$consultation) { redirect('dashboard'); }

// Toutes les réponses V2 toutes sections confondues (pour pré-remplissage)
$allStmt = $db->prepare("SELECT question_key, reponse FROM consultation_reponses WHERE consultation_id = ? AND section LIKE 'v2_step%'");
$allStmt->execute([$consultId]);
$allReponses = [];
foreach ($allStmt->fetchAll(PDO::FETCH_ASSOC) as $r) {
    $allReponses[$r['question_key']] = $r['reponse'];
}

// Helper local : valeur d'une réponse
$r = function(string $key, string $default = '') use ($allReponses): string {
    return (string)($allReponses[$key] ?? $default);
};
// Helper local : case cochée
$cb = function(string $key, string $val) use ($allReponses): bool {
    $current = explode(',', (string)($allReponses[$key] ?? ''));
    return in_array($val, $current, true);
};
// Helper local : radio sélectionnée
$rd = function(string $key, string $val) use ($allReponses): bool {
    return (string)($allReponses[$key] ?? '') === $val;
};

$stepInfo = CONSULTATION_STEPS_V2[$currentStep] ?? ['emoji' => '📋', 'label' => 'Étape'];
$sectionSlugs = [
    1 => '01-anthropo',
    2 => '02-motif',
    3 => '03-familial',
    4 => '04-pro',
    5 => '05-antecedents',
    6 => '06-sommeil',
    7 => '07-habitat',
    8 => '08-hydratation',
    9 => '09-alimentation',
    10 => '10-digestif',
    11 => '11-tegumentaire',
    12 => '12-systemes',
    13 => '13-immu-nerveux',
    14 => '14-endocrinien',
    15 => '15-synthese',
];
$sectionFile = __DIR__ . '/v2-sections/' . ($sectionSlugs[$currentStep] ?? '01-anthropo') . '.php';
?>

<div class="page-header">
    <div>
        <h1><?= e($consultation['client_prenom'] . ' ' . $consultation['client_nom']) ?></h1>
        <p class="subtitle">Consultation du <?= formatDate($consultation['date_consultation']) ?> <span class="badge badge-terra" style="margin-left:.5rem;">Trame V2</span></p>
    </div>
    <a href="<?= url('client-view', ['id' => $consultation['client_id']]) ?>" class="btn btn-secondary">Retour au client</a>
</div>

<div class="page-body animate-in">
    <?php require __DIR__ . '/../includes/stepper-v2.php'; ?>

    <div class="card mb-3" style="border-left: 4px solid #4a6741;">
        <div class="card-body" style="padding: .8rem 1.2rem;">
            <h2 style="margin:0; font-size: 1.25rem;"><?= $stepInfo['emoji'] ?> <?= $currentStep ?>. <?= e($stepInfo['label']) ?></h2>
        </div>
    </div>

    <?php // 🐛 DEBUG - à retirer plus tard
    if (isset($_GET['debug'])): ?>
    <div style="background:#1e1e1e; color:#0f0; padding:.8rem; border-radius:6px; font-family:monospace; font-size:12px; white-space:pre-wrap; margin-bottom:1rem;">🐛 DEBUG V2 DISPATCHER
  currentStep (?step=)       : <?= $currentStep ?>

  consultation.id            : <?= $consultation['id'] ?>

  consultation.trame_version : <?= $consultation['trame_version'] ?? '(colonne absente)' ?>

  consultation.current_step  : <?= $consultation['current_step'] ?>

  section slug               : <?= $sectionSlugs[$currentStep] ?? '(non mappé)' ?>

  section file path          : <?= $sectionFile ?>

  section file EXISTS        : <?= file_exists($sectionFile) ? '✅ OUI' : '❌ NON' ?>

  PHP version                : <?= PHP_VERSION ?>

  dispatcher mtime           : <?= date('Y-m-d H:i:s', filemtime(__FILE__)) ?>

</div>
    <?php endif; ?>

    <form method="POST" action="<?= url('consultation-v2', ['id' => $consultId, 'step' => $currentStep]) ?>">
        <input type="hidden" name="action" value="consultation-save-step-v2">
        <input type="hidden" name="consultation_id" value="<?= $consultId ?>">
        <input type="hidden" name="step" value="<?= $currentStep ?>">

        <?php
        if (file_exists($sectionFile)) {
            require $sectionFile;
        } else {
            echo '<div class="card mb-3"><div class="card-body"><p class="text-muted">Section en cours de construction.</p></div></div>';
        }
        ?>

        <div class="d-flex justify-between" style="margin-top: 1.5rem;">
            <?php if ($currentStep > 1): ?>
                <a href="<?= url('consultation-v2', ['id' => $consultId, 'step' => $currentStep - 1]) ?>" class="btn btn-secondary">← Précédent</a>
            <?php else: ?>
                <a href="<?= url('client-view', ['id' => $consultation['client_id']]) ?>" class="btn btn-secondary">Sauvegarder et quitter</a>
            <?php endif; ?>
            <button type="submit" class="btn btn-primary btn-lg">
                <?= $currentStep < 15 ? 'Suivant' : 'Terminer → Programme PHV' ?>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><polyline points="9 18 15 12 9 6"/></svg>
            </button>
        </div>
    </form>
</div>

<style>
.v2-section { margin-bottom: 1.5rem; }
.v2-section .card-header { background: #f3f5ef; }
.v2-grid-2 { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; }
.v2-grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; }
.v2-grid-4 { display: grid; grid-template-columns: repeat(4, 1fr); gap: .5rem; }
.v2-tip { background: #fff6e0; border-left: 3px solid #e0a829; padding: .6rem .9rem; border-radius: 4px; font-size: 13px; margin: .5rem 0; }
.v2-warn { background: #ffe8e3; border-left: 3px solid #d85a3d; padding: .6rem .9rem; border-radius: 4px; font-size: 13px; margin: .5rem 0; }
.v2-scale { display: flex; gap: .25rem; flex-wrap: wrap; }
.v2-scale label { display: inline-flex; flex-direction: column; align-items: center; padding: .25rem .4rem; border: 1px solid #e4e2dc; border-radius: 6px; cursor: pointer; min-width: 32px; font-size: 11px; }
.v2-scale input[type="radio"] { margin: 0 0 2px 0; }
.v2-scale input[type="radio"]:checked + span { font-weight: bold; color: #4a6741; }
.v2-group-title { font-weight: 600; color: #4a6741; margin: 1rem 0 .5rem; font-size: .95rem; }
.v2-checkbox-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: .3rem .8rem; }
.v2-checkbox-grid label { display: flex; align-items: center; gap: .4rem; font-size: 13px; cursor: pointer; padding: .2rem 0; }
.v2-family-table { width: 100%; border-collapse: collapse; font-size: 12px; }
.v2-family-table th, .v2-family-table td { border: 1px solid #e4e2dc; padding: .3rem; text-align: center; }
.v2-family-table th { background: #f3f5ef; font-weight: 600; }
.v2-family-table td:first-child { text-align: left; font-weight: 500; }
.v2-family-table input[type="checkbox"] { margin: 0; }
</style>
