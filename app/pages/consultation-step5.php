<?php
/**
 * Étape 5 : Synthèse de la consultation
 * Croise les réponses du questionnaire pour identifier :
 * - Organes/systèmes en déséquilibre
 * - Axes de travail prioritaires
 * - Suggestions de fiches pathologies liées
 */
$db = getDB();
$consultId = (int) getGet('id');
$userId = currentUserId();

$stmt = $db->prepare("SELECT c.*, cl.nom AS client_nom, cl.prenom AS client_prenom, cl.sexe AS client_sexe FROM consultations c JOIN clients cl ON c.client_id = cl.id WHERE c.id = ? AND c.user_id = ?");
$stmt->execute([$consultId, $userId]);
$consultation = $stmt->fetch();
if (!$consultation) { redirect('dashboard'); }

$currentStep = 5;
$allReponses = getReponses($consultId);

// Récupérer la synthèse existante
$synthStmt = $db->prepare("SELECT * FROM consultation_synthese WHERE consultation_id = ?");
$synthStmt->execute([$consultId]);
$synthese = $synthStmt->fetch();

// Récupérer les axes pré-remplis depuis l'étape 4
$axe1 = $synthese['priorite_1'] ?? getReponseValue($allReponses, 'axe_1');
$axe2 = $synthese['priorite_2'] ?? getReponseValue($allReponses, 'axe_2');
$axe3 = $synthese['priorite_3'] ?? getReponseValue($allReponses, 'axe_3');
$observations = $synthese['observations'] ?? '';

// Déséquilibres identifiés à l'étape 4
$desequilibres = explode(',', getReponseValue($allReponses, 'pre_synthese_desequilibres'));
$desequilibres = array_filter($desequilibres);

// Organes en déséquilibre (depuis JSON ou auto-détection)
$organesDesequilibre = $synthese ? json_decode($synthese['organes_desequilibre'], true) : [];
$axesTravail = $synthese ? json_decode($synthese['axes_travail'], true) : [];

// Auto-détection des points d'attention basée sur les réponses
$alertes = [];

// Stress élevé ?
$stressNiveau = (int) getReponseValue($allReponses, 'stress_niveau', '0');
if ($stressNiveau >= 7) {
    $alertes[] = ['high', 'Stress élevé (' . $stressNiveau . '/10)', 'Système nerveux'];
}

// Sommeil mauvais ?
$sommeilQualite = (int) getReponseValue($allReponses, 'sommeil_qualite', '10');
if ($sommeilQualite <= 4) {
    $alertes[] = ['high', 'Sommeil de mauvaise qualité (' . $sommeilQualite . '/10)', 'Système nerveux'];
}

// Sédentarité ?
$activiteNiveau = (int) getReponseValue($allReponses, 'activite_niveau', '5');
if ($activiteNiveau <= 3) {
    $alertes[] = ['medium', 'Faible activité physique (' . $activiteNiveau . '/10)', 'Mode de vie'];
}

// Troubles digestifs ?
$digTroubles = getReponseValue($allReponses, 'dig_troubles');
if ($digTroubles && $digTroubles !== 'Aucun') {
    $alertes[] = ['high', 'Troubles digestifs : ' . $digTroubles, 'Système digestif'];
}

// Immunité faible ?
$immuNiveau = (int) getReponseValue($allReponses, 'immu_niveau', '5');
if ($immuNiveau <= 4) {
    $alertes[] = ['medium', 'Immunité faible (' . $immuNiveau . '/10)', 'Système immunitaire'];
}

// Fiches pathologies suggérées
$fichesSuggestions = [];
$ficheStmt = $db->query("SELECT id, nom, systeme FROM fiches_pathologies ORDER BY systeme, nom");
$allFiches = $ficheStmt->fetchAll();

// Suggestions basées sur le motif
$motifCat = $consultation['motif_categorie'];
$motifTexte = strtolower($consultation['motif']);

foreach ($allFiches as $f) {
    $nomLower = strtolower($f['nom']);
    // Matching simple : si le nom de la fiche apparaît dans le motif ou les réponses
    if (str_contains($motifTexte, $nomLower) ||
        str_contains(strtolower($digTroubles ?? ''), $nomLower)) {
        $fichesSuggestions[] = $f;
    }
}
?>

<div class="page-header">
    <div>
        <h1>Synthèse</h1>
        <p class="subtitle"><?= e($consultation['client_prenom'] . ' ' . $consultation['client_nom']) ?> - <?= formatDate($consultation['date_consultation']) ?></p>
    </div>
</div>

<div class="page-body animate-in">
    <?php require __DIR__ . '/../includes/stepper.php'; ?>

    <!-- Alertes auto-détectées -->
    <?php if (!empty($alertes)): ?>
    <div class="card mb-3">
        <div class="card-header">
            <h3>Points d'attention détectés</h3>
            <span class="badge badge-warning"><?= count($alertes) ?> alerte<?= count($alertes) > 1 ? 's' : '' ?></span>
        </div>
        <div class="card-body">
            <div class="synthese-grid">
                <?php foreach ($alertes as [$severity, $message, $systeme]): ?>
                <div class="organe-card alert-<?= $severity ?>">
                    <h4><?= e($systeme) ?></h4>
                    <ul><li><?= e($message) ?></li></ul>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Déséquilibres identifiés -->
    <?php if (!empty($desequilibres)): ?>
    <div class="card mb-3">
        <div class="card-header"><h3>Déséquilibres identifiés</h3></div>
        <div class="card-body">
            <div style="display:flex;flex-wrap:wrap;gap:0.5rem;">
                <?php foreach ($desequilibres as $d): ?>
                    <span class="badge badge-terra"><?= e(trim($d)) ?></span>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Fiches pathologies suggérées -->
    <?php if (!empty($fichesSuggestions)): ?>
    <div class="card mb-3">
        <div class="card-header"><h3>Fiches pathologies en lien</h3></div>
        <div class="card-body" style="padding:0;">
            <table class="table">
                <tbody>
                <?php foreach ($fichesSuggestions as $f): ?>
                <tr>
                    <td><strong><?= e($f['nom']) ?></strong></td>
                    <td><span class="badge badge-sage"><?= e($f['systeme']) ?></span></td>
                    <td><a href="<?= url('fiche-view', ['id' => $f['id']]) ?>" class="btn btn-outline btn-sm" target="_blank">Consulter</a></td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php endif; ?>

    <!-- Formulaire de synthèse -->
    <form method="POST" action="<?= url('consultation-step5', ['id' => $consultId]) ?>">
        <input type="hidden" name="action" value="synthese-save">
        <input type="hidden" name="consultation_id" value="<?= $consultId ?>">

        <div class="card mb-3">
            <div class="card-header"><h3>Axes de travail</h3></div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Axe prioritaire 1 <span class="required">*</span></label>
                    <textarea name="priorite_1" class="form-control" rows="3" required placeholder="Ex: Soutien digestif - rééquilibrage de la flore intestinale et soutien hépatique"><?= e($axe1) ?></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Axe prioritaire 2</label>
                    <textarea name="priorite_2" class="form-control" rows="3" placeholder="Ex: Gestion du stress et soutien du système nerveux"><?= e($axe2) ?></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Axe secondaire</label>
                    <textarea name="priorite_3" class="form-control" rows="2" placeholder="Ex: Reprise progressive d'activité physique"><?= e($axe3) ?></textarea>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header"><h3>Observations & Stratégie</h3></div>
            <div class="card-body">
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label">Notes de synthèse</label>
                    <textarea name="observations" class="form-control" rows="5" placeholder="Stratégie d'accompagnement, nombre de séances envisagées, progressivité, points à surveiller..."><?= e($observations) ?></textarea>
                    <p class="form-hint">Rappel : toujours travailler le système digestif en priorité (fondation de l'immunité et de l'humeur). Progresser graduellement, laisser le temps aux résultats.</p>
                </div>
            </div>
        </div>

        <div class="d-flex justify-between" style="margin-top: 1.5rem;">
            <a href="<?= url('consultation-step4', ['id' => $consultId]) ?>" class="btn btn-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><polyline points="15 18 9 12 15 6"/></svg>
                Précédent
            </a>
            <button type="submit" class="btn btn-terra btn-lg">
                Suivant : Rédiger le PHV
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><polyline points="9 18 15 12 9 6"/></svg>
            </button>
        </div>
    </form>
</div>
