<?php
/**
 * Étape 3 : Bilan systémique
 * Adapté selon le motif de consultation - les systèmes prioritaires sont mis en avant
 */
$db = getDB();
$consultId = (int) getGet('id');
$userId = currentUserId();

$stmt = $db->prepare("SELECT c.*, cl.nom AS client_nom, cl.prenom AS client_prenom, cl.sexe AS client_sexe FROM consultations c JOIN clients cl ON c.client_id = cl.id WHERE c.id = ? AND c.user_id = ?");
$stmt->execute([$consultId, $userId]);
$consultation = $stmt->fetch();
if (!$consultation) { redirect('dashboard'); }

$currentStep = 3;

// Récupérer toutes les réponses du bilan
$allReponses = getReponses($consultId);

// Systèmes prioritaires selon le motif
$motifCat = $consultation['motif_categorie'] ?: 'general';
$prioritaires = MOTIF_SYSTEMES_PRIORITAIRES[$motifCat] ?? ['digestif', 'nerveux', 'endocrinien'];
$allSystemes = array_keys(SYSTEMES);
$secondaires = array_diff($allSystemes, $prioritaires);
?>

<div class="page-header">
    <div>
        <h1><?= e($consultation['client_prenom'] . ' ' . $consultation['client_nom']) ?></h1>
        <p class="subtitle">Bilan systémique - adapté au motif : <?= e(MOTIF_CATEGORIES[$motifCat] ?? 'Général') ?></p>
    </div>
</div>

<div class="page-body animate-in">
    <?php require __DIR__ . '/../includes/stepper.php'; ?>

    <div class="alert alert-info mb-3">
        Les systèmes prioritaires selon le motif de consultation sont mis en avant. Les autres systèmes sont disponibles en dessous.
    </div>

    <form method="POST" action="<?= url('consultation-step3', ['id' => $consultId]) ?>">
        <input type="hidden" name="action" value="consultation-save-step">
        <input type="hidden" name="consultation_id" value="<?= $consultId ?>">
        <input type="hidden" name="step" value="3">

        <!-- Systèmes PRIORITAIRES -->
        <h2 class="mb-2" style="font-size: 1.2rem;">Systèmes prioritaires</h2>

        <?php foreach ($prioritaires as $sys): ?>
            <?php renderBilanSection($sys, $allReponses, $consultation); ?>
        <?php endforeach; ?>

        <!-- Systèmes SECONDAIRES (repliables) -->
        <h2 class="mb-2 mt-3" style="font-size: 1.2rem;">Autres systèmes</h2>
        <p class="text-sm text-muted mb-2">Cliquez pour déplier chaque section si nécessaire.</p>

        <?php foreach ($secondaires as $sys): ?>
            <?php renderBilanSection($sys, $allReponses, $consultation, true); ?>
        <?php endforeach; ?>

        <!-- Notes -->
        <div class="card mb-3 mt-3">
            <div class="card-header"><h3>Notes du praticien - Bilan</h3></div>
            <div class="card-body">
                <div class="form-group" style="margin-bottom:0;">
                    <textarea name="notes_step3" class="form-control" rows="4" placeholder="Synthèse de vos observations sur le bilan systémique..."><?= e(getReponseValue($allReponses, 'notes_step3')) ?></textarea>
                </div>
            </div>
        </div>

        <div class="d-flex justify-between" style="margin-top: 1.5rem;">
            <a href="<?= url('consultation-step2', ['id' => $consultId]) ?>" class="btn btn-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><polyline points="15 18 9 12 15 6"/></svg>
                Précédent
            </a>
            <button type="submit" class="btn btn-primary btn-lg">
                Suivant : Bilan complémentaire
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><polyline points="9 18 15 12 9 6"/></svg>
            </button>
        </div>
    </form>
</div>

<?php
function renderBilanSection(string $sys, array $reponses, array $consultation, bool $collapsible = false): void {
    $labels = SYSTEMES;
    $label = $labels[$sys] ?? $sys;
    $prefix = match($sys) {
        'digestif' => 'dig_',
        'nerveux' => 'nerv_',
        'endocrinien' => 'endo_',
        'cardio' => 'cardio_',
        'respiratoire' => 'resp_',
        'uro_genital' => 'uro_',
        'osteo' => 'osteo_',
        'tegumentaire' => 'peau_',
        'immunitaire' => 'immu_',
        default => $sys . '_',
    };
    $collapseId = 'bilan-' . $sys;
?>
    <div class="card mb-3" <?= $collapsible ? 'data-collapsible' : '' ?>>
        <div class="card-header" <?= $collapsible ? 'style="cursor:pointer;" onclick="toggleCollapse(\'' . $collapseId . '\')"' : '' ?>>
            <h3><?= e($label) ?></h3>
            <?php if (!$collapsible): ?>
                <span class="badge badge-terra">Prioritaire</span>
            <?php else: ?>
                <svg id="<?= $collapseId ?>-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="18" height="18" style="transition: transform 0.3s;"><polyline points="6 9 12 15 18 9"/></svg>
            <?php endif; ?>
        </div>
        <div class="card-body" id="<?= $collapseId ?>" <?= $collapsible ? 'style="display:none;"' : '' ?>>
            <?php
            switch ($sys) {
                case 'digestif':
                    ?>
                    <div class="form-group">
                        <label class="form-label">Comment se passe votre digestion ? Transit ?</label>
                        <textarea name="<?= $prefix ?>digestion" class="form-control" rows="3" placeholder="Digestion, transit, fréquence des selles..."><?= e(getReponseValue($reponses, $prefix . 'digestion')) ?></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Troubles digestifs</label>
                        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 0.3rem;">
                            <?php
                            $current = explode(',', getReponseValue($reponses, $prefix . 'troubles'));
                            foreach (['Ballonnements', 'Gaz', 'Brûlures estomac', 'Reflux/RGO', 'Nausées', 'Constipation', 'Diarrhée', 'Alternance', 'Spasmes', 'Lourdeur après repas', 'Fatigue après repas', 'Aucun'] as $opt):
                            ?>
                            <label class="form-check">
                                <input type="checkbox" name="<?= $prefix ?>troubles_cb[]" value="<?= e($opt) ?>" <?= in_array($opt, $current) ? 'checked' : '' ?>>
                                <label><?= e($opt) ?></label>
                            </label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Bouche (saignements, aphtes, caries, langue)</label>
                            <textarea name="<?= $prefix ?>bouche" class="form-control" rows="2"><?= e(getReponseValue($reponses, $prefix . 'bouche')) ?></textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Foie / Vésicule (haleine, langue blanche, hémorroïdes)</label>
                            <textarea name="<?= $prefix ?>foie" class="form-control" rows="2"><?= e(getReponseValue($reponses, $prefix . 'foie')) ?></textarea>
                        </div>
                    </div>
                    <?php
                    break;

                case 'nerveux':
                    ?>
                    <div class="form-group">
                        <label class="form-label">Santé mentale et émotionnelle</label>
                        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 0.3rem;">
                            <?php
                            $current = explode(',', getReponseValue($reponses, $prefix . 'symptomes'));
                            foreach (['Stress chronique', 'Anxiété', 'Ruminations', 'Charge mentale', 'Burn-out', 'Choc émotionnel', 'Baisse de moral', 'Dépression', 'Dépression saisonnière', 'Irritabilité', 'Colère', 'Tristesse', 'Aucun'] as $opt):
                            ?>
                            <label class="form-check">
                                <input type="checkbox" name="<?= $prefix ?>symptomes_cb[]" value="<?= e($opt) ?>" <?= in_array($opt, $current) ? 'checked' : '' ?>>
                                <label><?= e($opt) ?></label>
                            </label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Maux de tête / Migraines</label>
                        <textarea name="<?= $prefix ?>migraines" class="form-control" rows="2" placeholder="Fréquence, contexte, localisation..."><?= e(getReponseValue($reponses, $prefix . 'migraines')) ?></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Observations complémentaires</label>
                        <textarea name="<?= $prefix ?>notes" class="form-control" rows="2"><?= e(getReponseValue($reponses, $prefix . 'notes')) ?></textarea>
                    </div>
                    <?php
                    break;

                case 'endocrinien':
                    ?>
                    <div class="form-group">
                        <label class="form-label">Problèmes thyroïdiens ? Sensation de froid ?</label>
                        <textarea name="<?= $prefix ?>thyroide" class="form-control" rows="2"><?= e(getReponseValue($reponses, $prefix . 'thyroide')) ?></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Glycémie (soif excessive, envies de sucre, fatigue, diabète)</label>
                        <textarea name="<?= $prefix ?>glycemie" class="form-control" rows="2"><?= e(getReponseValue($reponses, $prefix . 'glycemie')) ?></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Énergie, fatigue, libido</label>
                        <textarea name="<?= $prefix ?>energie" class="form-control" rows="2"><?= e(getReponseValue($reponses, $prefix . 'energie')) ?></textarea>
                    </div>
                    <?php
                    break;

                case 'cardio':
                    ?>
                    <div class="form-group">
                        <label class="form-label">Tension artérielle, palpitations, oppression</label>
                        <textarea name="<?= $prefix ?>coeur" class="form-control" rows="2"><?= e(getReponseValue($reponses, $prefix . 'coeur')) ?></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Circulation (jambes lourdes, varices, hémorroïdes, extrémités froides, bleus)</label>
                        <textarea name="<?= $prefix ?>circulation" class="form-control" rows="2"><?= e(getReponseValue($reponses, $prefix . 'circulation')) ?></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Lymphatique (gonflements, rétention d'eau, cellulite)</label>
                        <textarea name="<?= $prefix ?>lymphe" class="form-control" rows="2"><?= e(getReponseValue($reponses, $prefix . 'lymphe')) ?></textarea>
                    </div>
                    <?php
                    break;

                case 'respiratoire':
                    ?>
                    <div class="form-group">
                        <label class="form-label">Troubles respiratoires</label>
                        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 0.3rem;">
                            <?php
                            $current = explode(',', getReponseValue($reponses, $prefix . 'troubles'));
                            foreach (['Asthme', 'Toux chronique', 'Mucosités', 'Rhinite', 'Sinusite', 'Maux de gorge', 'Bronchite', 'Allergies saisonnières', 'Aucun'] as $opt):
                            ?>
                            <label class="form-check">
                                <input type="checkbox" name="<?= $prefix ?>troubles_cb[]" value="<?= e($opt) ?>" <?= in_array($opt, $current) ? 'checked' : '' ?>>
                                <label><?= e($opt) ?></label>
                            </label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Détails</label>
                        <textarea name="<?= $prefix ?>details" class="form-control" rows="2"><?= e(getReponseValue($reponses, $prefix . 'details')) ?></textarea>
                    </div>
                    <?php
                    break;

                case 'uro_genital':
                    $sexe = $consultation['client_sexe'];
                    ?>
                    <div class="form-group">
                        <label class="form-label">Système urinaire (couleur, fréquence, brûlures, infections)</label>
                        <textarea name="<?= $prefix ?>urinaire" class="form-control" rows="2"><?= e(getReponseValue($reponses, $prefix . 'urinaire')) ?></textarea>
                    </div>
                    <?php if ($sexe === 'femme'): ?>
                    <div class="form-group">
                        <label class="form-label">Cycle féminin (régularité, durée, douleurs, SPM)</label>
                        <textarea name="<?= $prefix ?>cycle" class="form-control" rows="3" placeholder="Cycle régulier/irrégulier, durée, abondance, symptômes prémenstruels..."><?= e(getReponseValue($reponses, $prefix . 'cycle')) ?></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">SPM / Troubles gynécologiques</label>
                        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 0.3rem;">
                            <?php
                            $current = explode(',', getReponseValue($reponses, $prefix . 'gyneco'));
                            foreach (['Irritabilité SPM', 'Douleurs menstruelles', 'Envies alimentaires', 'Fatigue SPM', 'Rétention eau', 'Tensions poitrine', 'Endométriose', 'SOPK', 'Mycoses', 'Periménopause', 'Ménopause', 'Aucun'] as $opt):
                            ?>
                            <label class="form-check">
                                <input type="checkbox" name="<?= $prefix ?>gyneco_cb[]" value="<?= e($opt) ?>" <?= in_array($opt, $current) ? 'checked' : '' ?>>
                                <label><?= e($opt) ?></label>
                            </label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Contraception, grossesses, fertilité</label>
                        <textarea name="<?= $prefix ?>contraception" class="form-control" rows="2"><?= e(getReponseValue($reponses, $prefix . 'contraception')) ?></textarea>
                    </div>
                    <?php elseif ($sexe === 'homme'): ?>
                    <div class="form-group">
                        <label class="form-label">Troubles masculins (prostate, libido, mictions)</label>
                        <textarea name="<?= $prefix ?>masculin" class="form-control" rows="2"><?= e(getReponseValue($reponses, $prefix . 'masculin')) ?></textarea>
                    </div>
                    <?php else: ?>
                    <div class="form-group">
                        <label class="form-label">Troubles génitaux</label>
                        <textarea name="<?= $prefix ?>genital" class="form-control" rows="2"><?= e(getReponseValue($reponses, $prefix . 'genital')) ?></textarea>
                    </div>
                    <?php endif; ?>
                    <?php
                    break;

                case 'osteo':
                    ?>
                    <div class="form-group">
                        <label class="form-label">Douleurs articulaires / musculaires / dorsales</label>
                        <textarea name="<?= $prefix ?>douleurs" class="form-control" rows="3" placeholder="Localisation, fréquence, ce qui soulage..."><?= e(getReponseValue($reponses, $prefix . 'douleurs')) ?></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Pathologies (rhumatismes, ostéoporose, arthrose, tendinites)</label>
                        <textarea name="<?= $prefix ?>pathologies" class="form-control" rows="2"><?= e(getReponseValue($reponses, $prefix . 'pathologies')) ?></textarea>
                    </div>
                    <?php
                    break;

                case 'tegumentaire':
                    ?>
                    <div class="form-group">
                        <label class="form-label">Peau (type, problèmes)</label>
                        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 0.3rem;">
                            <?php
                            $current = explode(',', getReponseValue($reponses, $prefix . 'problemes'));
                            foreach (['Acné', 'Eczéma', 'Psoriasis', 'Démangeaisons', 'Herpès', 'Urticaire', 'Transpiration excessive', 'Mycoses cutanées', 'Peau sèche', 'Peau grasse', 'Aucun'] as $opt):
                            ?>
                            <label class="form-check">
                                <input type="checkbox" name="<?= $prefix ?>problemes_cb[]" value="<?= e($opt) ?>" <?= in_array($opt, $current) ? 'checked' : '' ?>>
                                <label><?= e($opt) ?></label>
                            </label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Cheveux (chute, pellicules, gras, sec)</label>
                            <textarea name="<?= $prefix ?>cheveux" class="form-control" rows="2"><?= e(getReponseValue($reponses, $prefix . 'cheveux')) ?></textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Ongles (stries, cassants, taches, mycoses)</label>
                            <textarea name="<?= $prefix ?>ongles" class="form-control" rows="2"><?= e(getReponseValue($reponses, $prefix . 'ongles')) ?></textarea>
                        </div>
                    </div>
                    <?php
                    break;

                case 'immunitaire':
                    ?>
                    <div class="form-group">
                        <label class="form-label">Infections fréquentes ? Fatigue immunitaire ?</label>
                        <textarea name="<?= $prefix ?>infections" class="form-control" rows="2" placeholder="Rhumes fréquents, infections urinaires, mycoses récurrentes..."><?= e(getReponseValue($reponses, $prefix . 'infections')) ?></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Niveau d'énergie / immunité globale</label>
                        <div class="score-range">
                            <span class="text-sm text-muted">Faible</span>
                            <input type="range" name="<?= $prefix ?>niveau" min="0" max="10" value="<?= e(getReponseValue($reponses, $prefix . 'niveau', '5')) ?>" oninput="this.nextElementSibling.textContent=this.value">
                            <span class="score-value"><?= e(getReponseValue($reponses, $prefix . 'niveau', '5')) ?></span>
                            <span class="text-sm text-muted">Excellent</span>
                        </div>
                    </div>
                    <?php
                    break;
            }
            ?>
        </div>
    </div>
<?php } ?>
