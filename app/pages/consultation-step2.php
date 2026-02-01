<?php
/**
 * Étape 2 : Mode de vie
 * - Activité physique
 * - Sommeil
 * - Stress & gestion émotionnelle
 * - Habitudes alimentaires
 */
$db = getDB();
$consultId = (int) getGet('id');
$userId = currentUserId();

$stmt = $db->prepare("SELECT c.*, cl.nom AS client_nom, cl.prenom AS client_prenom, cl.sexe AS client_sexe FROM consultations c JOIN clients cl ON c.client_id = cl.id WHERE c.id = ? AND c.user_id = ?");
$stmt->execute([$consultId, $userId]);
$consultation = $stmt->fetch();
if (!$consultation) { redirect('dashboard'); }

$currentStep = 2;
$reponses = getReponses($consultId, 'mode_de_vie');
?>

<div class="page-header">
    <div>
        <h1><?= e($consultation['client_prenom'] . ' ' . $consultation['client_nom']) ?></h1>
        <p class="subtitle">Consultation du <?= formatDate($consultation['date_consultation']) ?></p>
    </div>
</div>

<div class="page-body animate-in">
    <?php require __DIR__ . '/../includes/stepper.php'; ?>

    <form method="POST" action="<?= url('consultation-step2', ['id' => $consultId]) ?>">
        <input type="hidden" name="action" value="consultation-save-step">
        <input type="hidden" name="consultation_id" value="<?= $consultId ?>">
        <input type="hidden" name="step" value="2">

        <!-- Activité physique -->
        <div class="card mb-3">
            <div class="card-header"><h3>Activité physique</h3></div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Quel est votre niveau d'activité physique ? Quelle est votre relation au sport ?</label>
                    <textarea name="activite_description" class="form-control" rows="3" placeholder="Type d'activité, fréquence, intensité..."><?= e(getReponseValue($reponses, 'activite_description')) ?></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Niveau d'activité</label>
                    <div class="score-range">
                        <span class="text-sm text-muted">Sédentaire</span>
                        <input type="range" name="activite_niveau" min="0" max="10" value="<?= e(getReponseValue($reponses, 'activite_niveau', '3')) ?>" oninput="this.nextElementSibling.textContent=this.value">
                        <span class="score-value"><?= e(getReponseValue($reponses, 'activite_niveau', '3')) ?></span>
                        <span class="text-sm text-muted">Très actif</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hobbies -->
        <div class="card mb-3">
            <div class="card-header"><h3>Loisirs & Temps pour soi</h3></div>
            <div class="card-body">
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label">Comment vous accordez-vous du temps pour vous-même et pour la détente ?</label>
                    <textarea name="hobbies" class="form-control" rows="3" placeholder="Activités de loisir, moments de détente..."><?= e(getReponseValue($reponses, 'hobbies')) ?></textarea>
                </div>
            </div>
        </div>

        <!-- Sommeil -->
        <div class="card mb-3">
            <div class="card-header"><h3>Sommeil</h3></div>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Heures de sommeil par nuit</label>
                        <input type="text" name="sommeil_heures" class="form-control" placeholder="Ex: 6-7h" value="<?= e(getReponseValue($reponses, 'sommeil_heures')) ?>">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Heure de coucher</label>
                        <input type="text" name="sommeil_coucher" class="form-control" placeholder="Ex: 23h" value="<?= e(getReponseValue($reponses, 'sommeil_coucher')) ?>">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Heure de réveil</label>
                        <input type="text" name="sommeil_reveil" class="form-control" placeholder="Ex: 7h" value="<?= e(getReponseValue($reponses, 'sommeil_reveil')) ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Qualité du sommeil</label>
                    <div class="score-range">
                        <span class="text-sm text-muted">Très mauvais</span>
                        <input type="range" name="sommeil_qualite" min="0" max="10" value="<?= e(getReponseValue($reponses, 'sommeil_qualite', '5')) ?>" oninput="this.nextElementSibling.textContent=this.value">
                        <span class="score-value"><?= e(getReponseValue($reponses, 'sommeil_qualite', '5')) ?></span>
                        <span class="text-sm text-muted">Excellent</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Problèmes de sommeil</label>
                    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 0.3rem;">
                        <?php
                        $pbSommeil = explode(',', getReponseValue($reponses, 'sommeil_problemes'));
                        $optionsSommeil = ['Difficulté endormissement', 'Réveils nocturnes', 'Réveil précoce', 'Sommeil non réparateur', 'Cauchemars', 'Apnée du sommeil', 'Bruxisme', 'Aucun'];
                        foreach ($optionsSommeil as $opt):
                        ?>
                        <label class="form-check">
                            <input type="checkbox" name="sommeil_problemes_cb[]" value="<?= e($opt) ?>" <?= in_array($opt, $pbSommeil) ? 'checked' : '' ?>>
                            <label><?= e($opt) ?></label>
                        </label>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Précisions sur le sommeil</label>
                    <textarea name="sommeil_details" class="form-control" rows="2" placeholder="Comment se passent vos nuits ? Énergie au réveil ?"><?= e(getReponseValue($reponses, 'sommeil_details')) ?></textarea>
                </div>
            </div>
        </div>

        <!-- Stress & Émotions -->
        <div class="card mb-3">
            <div class="card-header"><h3>Stress & Gestion émotionnelle</h3></div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Niveau de stress actuel</label>
                    <div class="score-range">
                        <span class="text-sm text-muted">Zen</span>
                        <input type="range" name="stress_niveau" min="0" max="10" value="<?= e(getReponseValue($reponses, 'stress_niveau', '5')) ?>" oninput="this.nextElementSibling.textContent=this.value">
                        <span class="score-value"><?= e(getReponseValue($reponses, 'stress_niveau', '5')) ?></span>
                        <span class="text-sm text-muted">Très stressé</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Comment gérez-vous le stress au quotidien ?</label>
                    <textarea name="stress_gestion" class="form-control" rows="3" placeholder="Méthodes, réactions, impacts sur le corps..."><?= e(getReponseValue($reponses, 'stress_gestion')) ?></textarea>
                    <p class="form-hint">Comment il réagit ? (empêche de dormir, douleurs trapèzes, maux de tête...)</p>
                </div>
                <div class="form-group">
                    <label class="form-label">Comment gérez-vous vos émotions ?</label>
                    <textarea name="stress_emotions" class="form-control" rows="2" placeholder="Expression des émotions, ressenti..."><?= e(getReponseValue($reponses, 'stress_emotions')) ?></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Manifestations du stress</label>
                    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 0.3rem;">
                        <?php
                        $manifestations = explode(',', getReponseValue($reponses, 'stress_manifestations'));
                        $optionsStress = ['Tensions musculaires', 'Maux de tête', 'Troubles digestifs', 'Troubles du sommeil', 'Irritabilité', 'Anxiété', 'Baisse de moral', 'Fatigue chronique', 'Bruxisme', 'Palpitations', 'Charge mentale', 'Aucune'];
                        foreach ($optionsStress as $opt):
                        ?>
                        <label class="form-check">
                            <input type="checkbox" name="stress_manifestations_cb[]" value="<?= e($opt) ?>" <?= in_array($opt, $manifestations) ? 'checked' : '' ?>>
                            <label><?= e($opt) ?></label>
                        </label>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alimentation -->
        <div class="card mb-3">
            <div class="card-header"><h3>Habitudes alimentaires</h3></div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Décrivez une journée type dans votre assiette</label>
                    <textarea name="alim_journee_type" class="form-control" rows="4" placeholder="Petit-déjeuner, déjeuner, collation, dîner... Soyez précis."><?= e(getReponseValue($reponses, 'alim_journee_type')) ?></textarea>
                    <p class="form-hint">Présentiel ou télétravail ? Cantine ? Restaurant ? Cuisine maison ?</p>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Rapport à l'alimentation</label>
                        <textarea name="alim_rapport" class="form-control" rows="2" placeholder="Aime cuisiner ? Mange par plaisir ou par nécessité ?"><?= e(getReponseValue($reponses, 'alim_rapport')) ?></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Qualité de la mastication</label>
                        <select name="alim_mastication" class="form-control">
                            <option value="">-</option>
                            <option value="bonne" <?= getReponseValue($reponses, 'alim_mastication') === 'bonne' ? 'selected' : '' ?>>Bonne</option>
                            <option value="moyenne" <?= getReponseValue($reponses, 'alim_mastication') === 'moyenne' ? 'selected' : '' ?>>Moyenne</option>
                            <option value="insuffisante" <?= getReponseValue($reponses, 'alim_mastication') === 'insuffisante' ? 'selected' : '' ?>>Insuffisante (mange vite)</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Hydratation quotidienne</label>
                        <input type="text" name="alim_hydratation" class="form-control" placeholder="Ex: 1L, essentiellement du café..." value="<?= e(getReponseValue($reponses, 'alim_hydratation')) ?>">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Stimulants (café, thé, alcool...)</label>
                        <input type="text" name="alim_stimulants" class="form-control" placeholder="Ex: 4 cafés/jour, 2 verres de vin/semaine" value="<?= e(getReponseValue($reponses, 'alim_stimulants')) ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Grignotage / Envies sucrées</label>
                    <textarea name="alim_grignotage" class="form-control" rows="2" placeholder="Fréquence, moments, types d'aliments..."><?= e(getReponseValue($reponses, 'alim_grignotage')) ?></textarea>
                </div>
            </div>
        </div>

        <!-- Notes -->
        <div class="card mb-3">
            <div class="card-header"><h3>Notes du praticien</h3></div>
            <div class="card-body">
                <div class="form-group" style="margin-bottom:0;">
                    <textarea name="notes_step2" class="form-control" rows="3" placeholder="Observations sur le mode de vie..."><?= e(getReponseValue($reponses, 'notes_step2')) ?></textarea>
                </div>
            </div>
        </div>

        <div class="d-flex justify-between" style="margin-top: 1.5rem;">
            <a href="<?= url('consultation-step1', ['id' => $consultId]) ?>" class="btn btn-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><polyline points="15 18 9 12 15 6"/></svg>
                Précédent
            </a>
            <button type="submit" class="btn btn-primary btn-lg">
                Suivant : Bilan systémique
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><polyline points="9 18 15 12 9 6"/></svg>
            </button>
        </div>
    </form>
</div>
