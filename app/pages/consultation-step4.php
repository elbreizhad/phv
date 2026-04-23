<?php
/**
 * Étape 4 : Bilan complémentaire + Résumé avant synthèse
 */
$db = getDB();
$consultId = (int) getGet('id');
$userId = currentUserId();

$stmt = $db->prepare("SELECT c.*, cl.nom AS client_nom, cl.prenom AS client_prenom, cl.sexe AS client_sexe FROM consultations c JOIN clients cl ON c.client_id = cl.id WHERE c.id = ? AND c.user_id = ?");
$stmt->execute([$consultId, $userId]);
$consultation = $stmt->fetch();
if (!$consultation) { redirect('dashboard'); }

$currentStep = 4;
$allReponses = getReponses($consultId);
?>

<div class="page-header">
    <div>
        <h1><?= e($consultation['client_prenom'] . ' ' . $consultation['client_nom']) ?></h1>
        <p class="subtitle">Bilan complémentaire & Observations</p>
    </div>
</div>

<div class="page-body animate-in">
    <?php require __DIR__ . '/../includes/stepper.php'; ?>

    <form method="POST" action="<?= url('consultation-step4', ['id' => $consultId]) ?>">
        <input type="hidden" name="action" value="consultation-save-step">
        <input type="hidden" name="consultation_id" value="<?= $consultId ?>">
        <input type="hidden" name="step" value="4">

        <!-- Observations non-verbales -->
        <div class="card mb-3">
            <div class="card-header"><h3>Observations du praticien</h3></div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Communication non-verbale observée</label>
                    <textarea name="obs_non_verbal" class="form-control" rows="3" placeholder="Posture, expressions faciales, contact visuel, mouvements, ton de voix..."><?= e(getReponseValue($allReponses, 'obs_non_verbal')) ?></textarea>
                    <p class="form-hint">Bras croisés = défensif, inclinaison tête = intérêt, tapotement doigts = impatience...</p>
                </div>
                <div class="form-group">
                    <label class="form-label">Iridologie / Morphologie (si applicable)</label>
                    <textarea name="obs_morphologie" class="form-control" rows="2" placeholder="Observations morphologiques, iridologiques..."><?= e(getReponseValue($allReponses, 'obs_morphologie')) ?></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Points clés identifiés</label>
                    <textarea name="obs_points_cles" class="form-control" rows="4" placeholder="Les éléments les plus marquants du questionnaire, les liens que vous faites entre les différentes réponses..."><?= e(getReponseValue($allReponses, 'obs_points_cles')) ?></textarea>
                </div>
            </div>
        </div>

        <!-- Résumé rapide des points faibles détectés -->
        <div class="card mb-3">
            <div class="card-header"><h3>Pré-synthèse : Points faibles détectés</h3></div>
            <div class="card-body">
                <p class="text-sm text-muted mb-2">Cochez les déséquilibres que vous avez identifiés pour préparer la synthèse.</p>
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem;">
                    <?php
                    $desequilibres = explode(',', getReponseValue($allReponses, 'pre_synthese_desequilibres'));
                    $options = [
                        'Dysbiose intestinale',
                        'Perméabilité intestinale',
                        'Surcharge hépatique',
                        'Insuffisance biliaire',
                        'Déséquilibre acido-basique',
                        'Carence nutritionnelle',
                        'Stress oxydatif',
                        'Inflammation chronique',
                        'Déséquilibre hormonal',
                        'Insulino-résistance',
                        'Surmenage nerveux',
                        'Troubles du sommeil',
                        'Sédentarité',
                        'Mauvaise hygiène alimentaire',
                        'Déshydratation',
                        'Terrain acide',
                        'Surpoids / Sous-poids',
                        'Faiblesse immunitaire',
                        'Troubles circulatoires',
                    ];
                    foreach ($options as $opt):
                    ?>
                    <label class="form-check">
                        <input type="checkbox" name="pre_synthese_desequilibres_cb[]" value="<?= e($opt) ?>" <?= in_array($opt, $desequilibres) ? 'checked' : '' ?>>
                        <label><?= e($opt) ?></label>
                    </label>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Axes de travail pressentis -->
        <div class="card mb-3">
            <div class="card-header"><h3>Axes de travail pressentis</h3></div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Axe prioritaire 1</label>
                    <textarea name="axe_1" class="form-control" rows="2" placeholder="Ex: Rééquilibrage digestif - soutien intestin + foie"><?= e(getReponseValue($allReponses, 'axe_1')) ?></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Axe prioritaire 2</label>
                    <textarea name="axe_2" class="form-control" rows="2" placeholder="Ex: Gestion du stress - soutien système nerveux"><?= e(getReponseValue($allReponses, 'axe_2')) ?></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Axe secondaire</label>
                    <textarea name="axe_3" class="form-control" rows="2" placeholder="Ex: Reprise activité physique adaptée"><?= e(getReponseValue($allReponses, 'axe_3')) ?></textarea>
                </div>
            </div>
        </div>

        <div class="d-flex justify-between" style="margin-top: 1.5rem;">
            <a href="<?= url('consultation-step3', ['id' => $consultId]) ?>" class="btn btn-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><polyline points="15 18 9 12 15 6"/></svg>
                Précédent
            </a>
            <button type="submit" class="btn btn-primary btn-lg">
                Suivant : Synthèse
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><polyline points="9 18 15 12 9 6"/></svg>
            </button>
        </div>
    </form>
</div>
