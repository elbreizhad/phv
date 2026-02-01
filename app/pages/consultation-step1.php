<?php
/**
 * Étape 1 : Accueil & Motif de consultation
 * - Rappel du motif
 * - Informations générales (vie pro, vie perso)
 * - Historique médical
 */
$db = getDB();
$consultId = (int) getGet('id');
$userId = currentUserId();

$stmt = $db->prepare("SELECT c.*, cl.nom AS client_nom, cl.prenom AS client_prenom, cl.sexe AS client_sexe FROM consultations c JOIN clients cl ON c.client_id = cl.id WHERE c.id = ? AND c.user_id = ?");
$stmt->execute([$consultId, $userId]);
$consultation = $stmt->fetch();
if (!$consultation) { redirect('dashboard'); }

$currentStep = 1;
$reponses = getReponses($consultId, 'infos_generales');
$repMedical = getReponses($consultId, 'historique_medical');
// Merge
$reponses = array_merge($reponses, $repMedical);
?>

<div class="page-header">
    <div>
        <h1><?= e($consultation['client_prenom'] . ' ' . $consultation['client_nom']) ?></h1>
        <p class="subtitle">Consultation du <?= formatDate($consultation['date_consultation']) ?></p>
    </div>
    <a href="<?= url('client-view', ['id' => $consultation['client_id']]) ?>" class="btn btn-secondary">Retour au client</a>
</div>

<div class="page-body animate-in">
    <?php require __DIR__ . '/../includes/stepper.php'; ?>

    <!-- Rappel du motif -->
    <div class="card mb-3">
        <div class="card-header">
            <h3>Motif de consultation</h3>
            <?php if ($consultation['motif_categorie']): ?>
                <span class="badge badge-terra"><?= e(MOTIF_CATEGORIES[$consultation['motif_categorie']] ?? $consultation['motif_categorie']) ?></span>
            <?php endif; ?>
        </div>
        <div class="card-body">
            <p><?= nl2br(e($consultation['motif'])) ?></p>
        </div>
    </div>

    <form method="POST" action="<?= url('consultation-step1', ['id' => $consultId]) ?>">
        <input type="hidden" name="action" value="consultation-save-step">
        <input type="hidden" name="consultation_id" value="<?= $consultId ?>">
        <input type="hidden" name="step" value="1">

        <!-- Informations générales -->
        <div class="card mb-3">
            <div class="card-header"><h3>Informations générales</h3></div>
            <div class="card-body">
                <div class="form-section">
                    <div class="form-section-title">Vie professionnelle</div>
                    <div class="form-group">
                        <label class="form-label">Parlez-moi de votre travail. Qu'est-ce que vous faites dans la vie ?</label>
                        <textarea name="vie_pro_description" class="form-control" rows="3" placeholder="Description de l'activité professionnelle..."><?= e(getReponseValue($reponses, 'vie_pro_description')) ?></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Niveau de satisfaction au travail</label>
                        <div class="score-range">
                            <span class="text-sm text-muted">Insatisfait</span>
                            <input type="range" name="vie_pro_satisfaction" min="0" max="10" value="<?= e(getReponseValue($reponses, 'vie_pro_satisfaction', '5')) ?>" oninput="this.nextElementSibling.textContent=this.value">
                            <span class="score-value"><?= e(getReponseValue($reponses, 'vie_pro_satisfaction', '5')) ?></span>
                            <span class="text-sm text-muted">Très satisfait</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Équilibre vie pro / vie perso</label>
                        <textarea name="vie_pro_equilibre" class="form-control" rows="2" placeholder="Comment gère-t-il/elle l'équilibre ?"><?= e(getReponseValue($reponses, 'vie_pro_equilibre')) ?></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Changements récents au travail</label>
                        <textarea name="vie_pro_changements" class="form-control" rows="2" placeholder="Changements majeurs récents..."><?= e(getReponseValue($reponses, 'vie_pro_changements')) ?></textarea>
                    </div>
                </div>

                <div class="form-section">
                    <div class="form-section-title">Vie personnelle</div>
                    <div class="form-group">
                        <label class="form-label">Situation familiale - Partagez-vous votre foyer ?</label>
                        <textarea name="vie_perso_foyer" class="form-control" rows="2" placeholder="Situation familiale, relations..."><?= e(getReponseValue($reponses, 'vie_perso_foyer')) ?></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Changements récents dans la vie personnelle</label>
                        <textarea name="vie_perso_changements" class="form-control" rows="2" placeholder="Changements récents impactant le bien-être..."><?= e(getReponseValue($reponses, 'vie_perso_changements')) ?></textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Historique médical -->
        <div class="card mb-3">
            <div class="card-header"><h3>Historique médical</h3></div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Problèmes de santé actuels ou passés</label>
                    <textarea name="med_problemes" class="form-control" rows="3" placeholder="Maladies chroniques, interventions chirurgicales, allergies..."><?= e(getReponseValue($reponses, 'med_problemes')) ?></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Médicaments ou traitements actuels</label>
                    <textarea name="med_medicaments" class="form-control" rows="2" placeholder="Liste des médicaments et traitements en cours..."><?= e(getReponseValue($reponses, 'med_medicaments')) ?></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Antécédents familiaux</label>
                    <textarea name="med_antecedents" class="form-control" rows="2" placeholder="Maladies particulières dans la famille (parents, grands-parents, fratrie)..."><?= e(getReponseValue($reponses, 'med_antecedents')) ?></textarea>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Interventions chirurgicales</label>
                        <textarea name="med_chirurgie" class="form-control" rows="2" placeholder="Opérations passées..."><?= e(getReponseValue($reponses, 'med_chirurgie')) ?></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Allergies connues</label>
                        <textarea name="med_allergies" class="form-control" rows="2" placeholder="Allergies alimentaires, médicamenteuses, saisonnières..."><?= e(getReponseValue($reponses, 'med_allergies')) ?></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Praticiens de santé consultés</label>
                        <textarea name="med_praticiens" class="form-control" rows="2" placeholder="Médecin traitant, gynécologue, kiné, psy..."><?= e(getReponseValue($reponses, 'med_praticiens')) ?></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Dernière prise de sang</label>
                        <input type="text" name="med_prise_sang" class="form-control" placeholder="Date et résultats significatifs" value="<?= e(getReponseValue($reponses, 'med_prise_sang')) ?>">
                    </div>
                </div>
            </div>
        </div>

        <!-- Notes praticien -->
        <div class="card mb-3">
            <div class="card-header"><h3>Notes du praticien</h3></div>
            <div class="card-body">
                <div class="form-group" style="margin-bottom:0;">
                    <textarea name="notes_step1" class="form-control" rows="3" placeholder="Vos observations, impressions, éléments non-verbaux..."><?= e(getReponseValue($reponses, 'notes_step1')) ?></textarea>
                    <p class="form-hint">Notez le langage corporel, les hésitations, les émotions perçues...</p>
                </div>
            </div>
        </div>

        <div class="d-flex justify-between" style="margin-top: 1.5rem;">
            <a href="<?= url('client-view', ['id' => $consultation['client_id']]) ?>" class="btn btn-secondary">Sauvegarder et quitter</a>
            <button type="submit" class="btn btn-primary btn-lg">
                Suivant : Mode de vie
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><polyline points="9 18 15 12 9 6"/></svg>
            </button>
        </div>
    </form>
</div>
