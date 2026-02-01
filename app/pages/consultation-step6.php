<?php
/**
 * Étape 6 : Rédaction du Programme d'Hygiène de Vie (PHV)
 * Document personnalisé à remettre au client
 */
$db = getDB();
$consultId = (int) getGet('id');
$userId = currentUserId();

$stmt = $db->prepare("SELECT c.*, cl.nom AS client_nom, cl.prenom AS client_prenom, cl.sexe AS client_sexe FROM consultations c JOIN clients cl ON c.client_id = cl.id WHERE c.id = ? AND c.user_id = ?");
$stmt->execute([$consultId, $userId]);
$consultation = $stmt->fetch();
if (!$consultation) { redirect('dashboard'); }

$currentStep = 6;

// Récupérer la synthèse
$synthStmt = $db->prepare("SELECT * FROM consultation_synthese WHERE consultation_id = ?");
$synthStmt->execute([$consultId]);
$synthese = $synthStmt->fetch();

// Récupérer le PHV existant
$phvStmt = $db->prepare("SELECT * FROM phv WHERE consultation_id = ?");
$phvStmt->execute([$consultId]);
$phv = $phvStmt->fetch();

$allReponses = getReponses($consultId);
?>

<div class="page-header">
    <div>
        <h1>Programme d'Hygiène de Vie</h1>
        <p class="subtitle"><?= e($consultation['client_prenom'] . ' ' . $consultation['client_nom']) ?></p>
    </div>
    <?php if ($phv): ?>
    <a href="<?= url('phv-export', ['id' => $consultId]) ?>" class="btn btn-terra" target="_blank">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
        Exporter en PDF
    </a>
    <?php endif; ?>
</div>

<div class="page-body animate-in">
    <?php require __DIR__ . '/../includes/stepper.php'; ?>

    <!-- Rappel des axes -->
    <?php if ($synthese): ?>
    <div class="card mb-3">
        <div class="card-header"><h3>Rappel de la synthèse</h3></div>
        <div class="card-body">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem;">
                <?php if ($synthese['priorite_1']): ?>
                <div class="organe-card">
                    <h4 style="color: var(--terra-500);">Axe prioritaire 1</h4>
                    <p class="text-sm"><?= nl2br(e($synthese['priorite_1'])) ?></p>
                </div>
                <?php endif; ?>
                <?php if ($synthese['priorite_2']): ?>
                <div class="organe-card">
                    <h4 style="color: var(--sage-600);">Axe prioritaire 2</h4>
                    <p class="text-sm"><?= nl2br(e($synthese['priorite_2'])) ?></p>
                </div>
                <?php endif; ?>
                <?php if ($synthese['priorite_3']): ?>
                <div class="organe-card">
                    <h4 style="color: var(--info);">Axe secondaire</h4>
                    <p class="text-sm"><?= nl2br(e($synthese['priorite_3'])) ?></p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <form method="POST" action="<?= url('consultation-step6', ['id' => $consultId]) ?>">
        <input type="hidden" name="action" value="phv-save">
        <input type="hidden" name="consultation_id" value="<?= $consultId ?>">

        <!-- Alimentation -->
        <div class="card mb-3">
            <div class="card-header">
                <h3>Conseils alimentaires</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Conseils généraux d'alimentation</label>
                    <textarea name="alimentation" class="form-control" rows="5" placeholder="Mastication, hydratation, associations alimentaires, organisation des repas..."><?= e($phv['alimentation'] ?? '') ?></textarea>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Aliments à éviter / limiter</label>
                        <textarea name="alimentation_eviter" class="form-control" rows="4" placeholder="Sucres rapides, gluten, produits laitiers..."><?= e($phv['alimentation_eviter'] ?? '') ?></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Aliments à privilégier</label>
                        <textarea name="alimentation_privilegier" class="form-control" rows="4" placeholder="Prébiotiques, aliments fermentés, superaliments..."><?= e($phv['alimentation_privilegier'] ?? '') ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Menu type / Exemples de repas</label>
                    <textarea name="menu_type" class="form-control" rows="5" placeholder="Petit-déjeuner : ...\nDéjeuner : ...\nCollation : ...\nDîner : ..."><?= e($phv['menu_type'] ?? '') ?></textarea>
                </div>
            </div>
        </div>

        <!-- Gestion du stress -->
        <div class="card mb-3">
            <div class="card-header"><h3>Gestion du stress & émotions</h3></div>
            <div class="card-body">
                <div class="form-group" style="margin-bottom:0;">
                    <textarea name="gestion_stress" class="form-control" rows="5" placeholder="Respiration ventrale, cohérence cardiaque, marche en nature, visualisation, bain chaud..."><?= e($phv['gestion_stress'] ?? '') ?></textarea>
                    <p class="form-hint">Choisir 1 à 2 outils maximum : phyto, aroma, respiration, relaxation, hydrothérapie...</p>
                </div>
            </div>
        </div>

        <!-- Activité physique -->
        <div class="card mb-3">
            <div class="card-header"><h3>Activité physique</h3></div>
            <div class="card-body">
                <div class="form-group" style="margin-bottom:0;">
                    <textarea name="activite_physique" class="form-control" rows="4" placeholder="Type d'activité recommandée, fréquence, durée... Adapter à la personnalité et aux contraintes."><?= e($phv['activite_physique'] ?? '') ?></textarea>
                    <p class="form-hint">Expliquer le POURQUOI pour motiver. Respecter le budget et les envies du client.</p>
                </div>
            </div>
        </div>

        <!-- Routines -->
        <div class="card mb-3">
            <div class="card-header"><h3>Routines & Soins</h3></div>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Routine matin</label>
                        <textarea name="routine_matin" class="form-control" rows="4" placeholder="Gratte-langue, douche écossaise, brossage à sec..."><?= e($phv['routine_matin'] ?? '') ?></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Routine soir</label>
                        <textarea name="routine_soir" class="form-control" rows="4" placeholder="Bouillotte foie, rituel coucher, respiration, lecture..."><?= e($phv['routine_soir'] ?? '') ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Soins naturels spécifiques</label>
                    <textarea name="soins_naturels" class="form-control" rows="3" placeholder="Ex: Mélanger 1 goutte de Tea Tree avec huile de coco, appliquer..."><?= e($phv['soins_naturels'] ?? '') ?></textarea>
                </div>
            </div>
        </div>

        <!-- Compléments -->
        <div class="card mb-3">
            <div class="card-header">
                <h3>Compléments alimentaires</h3>
                <span class="badge badge-warning">3 maximum</span>
            </div>
            <div class="card-body">
                <p class="text-sm text-muted mb-2">Vérifier les interactions médicamenteuses. Ne jamais référencer de pathologie dans les recommandations.</p>
                <?php
                $complements = $phv ? json_decode($phv['complements'], true) : [['nom' => '', 'posologie' => '', 'duree' => ''], ['nom' => '', 'posologie' => '', 'duree' => ''], ['nom' => '', 'posologie' => '', 'duree' => '']];
                if (!$complements) $complements = [['nom' => '', 'posologie' => '', 'duree' => ''], ['nom' => '', 'posologie' => '', 'duree' => ''], ['nom' => '', 'posologie' => '', 'duree' => '']];
                for ($i = 0; $i < 3; $i++):
                    $c = $complements[$i] ?? ['nom' => '', 'posologie' => '', 'duree' => ''];
                ?>
                <div class="form-row form-row-3" style="margin-bottom: 0.8rem; padding-bottom: 0.8rem; border-bottom: 1px solid var(--cream-200);">
                    <div class="form-group" style="margin-bottom:0;">
                        <label class="form-label">Complément <?= $i + 1 ?></label>
                        <input type="text" name="complement_nom[]" class="form-control" placeholder="Ex: Probiotiques" value="<?= e($c['nom']) ?>">
                    </div>
                    <div class="form-group" style="margin-bottom:0;">
                        <label class="form-label">Posologie</label>
                        <input type="text" name="complement_posologie[]" class="form-control" placeholder="Ex: 2 gélules à jeun le matin" value="<?= e($c['posologie']) ?>">
                    </div>
                    <div class="form-group" style="margin-bottom:0;">
                        <label class="form-label">Durée</label>
                        <input type="text" name="complement_duree[]" class="form-control" placeholder="Ex: 3 mois" value="<?= e($c['duree']) ?>">
                    </div>
                </div>
                <?php endfor; ?>
            </div>
        </div>

        <!-- Recommandations complémentaires -->
        <div class="card mb-3">
            <div class="card-header"><h3>Recommandations complémentaires</h3></div>
            <div class="card-body">
                <div class="form-group">
                    <textarea name="recommandations_complementaires" class="form-control" rows="3" placeholder="Massages, sophrologie, réflexologie, bilan gynécologique, coach..."><?= e($phv['recommandations_complementaires'] ?? '') ?></textarea>
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label">Notes internes (non incluses dans l'export)</label>
                    <textarea name="notes_phv" class="form-control" rows="2" placeholder="Notes pour le suivi..."><?= e($phv['notes'] ?? '') ?></textarea>
                </div>
            </div>
        </div>

        <div class="d-flex justify-between" style="margin-top: 1.5rem;">
            <a href="<?= url('consultation-step5', ['id' => $consultId]) ?>" class="btn btn-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><polyline points="15 18 9 12 15 6"/></svg>
                Précédent
            </a>
            <div class="d-flex gap-1">
                <button type="submit" name="finalize" value="0" class="btn btn-primary btn-lg">Enregistrer le PHV</button>
                <button type="submit" name="finalize" value="1" class="btn btn-terra btn-lg">Terminer la consultation</button>
            </div>
        </div>
    </form>
</div>
