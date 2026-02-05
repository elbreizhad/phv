<?php
/**
 * Gestion des objectifs client
 */
$db = getDB();
$userId = currentUserId();
$clientId = (int)getGet('id');

$clientStmt = $db->prepare("SELECT * FROM clients WHERE id = ? AND user_id = ?");
$clientStmt->execute([$clientId, $userId]);
$client = $clientStmt->fetch();

if (!$client) {
    flashSet('error', 'Client non trouvé.');
    redirect('clients');
}

// Récupérer les objectifs
$objectifsStmt = $db->prepare("SELECT * FROM client_objectifs WHERE client_id = ? ORDER BY statut = 'en_cours' DESC, date_debut DESC");
$objectifsStmt->execute([$clientId]);
$objectifs = $objectifsStmt->fetchAll();
?>

<div class="page-header">
    <div>
        <h1>Objectifs - <?= e($client['prenom'] . ' ' . $client['nom']) ?></h1>
        <p class="subtitle"><?= count($objectifs) ?> objectif(s)</p>
    </div>
    <div class="d-flex gap-1">
        <a href="<?= url('client-evolution', ['id' => $clientId]) ?>" class="btn btn-secondary">Retour</a>
        <button type="button" class="btn btn-primary" onclick="openObjectifModal()">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Nouvel objectif
        </button>
    </div>
</div>

<div class="page-body animate-in">
    <?php if (empty($objectifs)): ?>
        <div class="card">
            <div class="card-body">
                <div class="empty-state">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="48" height="48"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg>
                    <h3>Aucun objectif</h3>
                    <p>Définissez des objectifs avec votre client pour suivre sa progression.</p>
                    <button type="button" class="btn btn-primary" onclick="openObjectifModal()">Créer un objectif</button>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="objectifs-grid">
            <?php foreach ($objectifs as $obj): ?>
                <div class="card objectif-card <?= $obj['statut'] === 'atteint' ? 'objectif-atteint' : '' ?>">
                    <div class="card-body">
                        <div class="objectif-header">
                            <span class="badge <?= OBJECTIF_TYPES[$obj['type_objectif']] ? 'badge-sage' : 'badge-info' ?>"><?= OBJECTIF_TYPES[$obj['type_objectif']] ?? $obj['type_objectif'] ?></span>
                            <span class="badge <?= $obj['statut'] === 'atteint' ? 'badge-success' : ($obj['statut'] === 'en_cours' ? 'badge-warning' : 'badge-secondary') ?>">
                                <?= ucfirst(str_replace('_', ' ', $obj['statut'])) ?>
                            </span>
                        </div>
                        <h4><?= e($obj['titre']) ?></h4>
                        <?php if ($obj['description']): ?>
                            <p class="text-sm text-muted"><?= e($obj['description']) ?></p>
                        <?php endif; ?>

                        <div class="objectif-values mt-1">
                            <?php if ($obj['valeur_initiale']): ?>
                                <span class="text-sm">Départ: <strong><?= e($obj['valeur_initiale']) ?></strong></span>
                            <?php endif; ?>
                            <?php if ($obj['valeur_cible']): ?>
                                <span class="text-sm">Cible: <strong><?= e($obj['valeur_cible']) ?></strong></span>
                            <?php endif; ?>
                        </div>

                        <div class="objectif-progress mt-1">
                            <div class="progress-bar">
                                <div class="progress-fill <?= $obj['statut'] === 'atteint' ? 'progress-success' : '' ?>" style="width: <?= $obj['progression'] ?>%;"></div>
                            </div>
                            <span class="progress-text"><?= $obj['progression'] ?>%</span>
                        </div>

                        <?php if ($obj['date_cible']): ?>
                            <p class="text-sm text-muted mt-1">Échéance: <?= formatDate($obj['date_cible']) ?></p>
                        <?php endif; ?>

                        <div class="objectif-actions mt-2">
                            <?php if ($obj['statut'] === 'en_cours'): ?>
                                <form method="POST" style="display: inline;">
                                    <input type="hidden" name="action" value="objectif-save">
                                    <input type="hidden" name="objectif_id" value="<?= $obj['id'] ?>">
                                    <input type="hidden" name="client_id" value="<?= $clientId ?>">
                                    <input type="hidden" name="statut" value="atteint">
                                    <button type="submit" class="btn btn-success btn-sm">Marquer atteint</button>
                                </form>
                                <button type="button" class="btn btn-outline btn-sm" onclick="editProgression(<?= $obj['id'] ?>, <?= $obj['progression'] ?>)">Modifier progression</button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<!-- Modal Nouvel Objectif -->
<div id="objectif-modal" class="modal" style="display: none;">
    <div class="modal-backdrop" onclick="closeObjectifModal()"></div>
    <div class="modal-content">
        <div class="modal-header">
            <h3>Nouvel objectif</h3>
            <button type="button" class="modal-close" onclick="closeObjectifModal()">&times;</button>
        </div>
        <form method="POST" action="<?= url('client-objectifs', ['id' => $clientId]) ?>">
            <input type="hidden" name="action" value="objectif-save">
            <input type="hidden" name="client_id" value="<?= $clientId ?>">
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Titre <span class="required">*</span></label>
                    <input type="text" name="titre" class="form-control" required placeholder="Ex: Perdre 5kg">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Type d'objectif</label>
                        <select name="type_objectif" class="form-control">
                            <?php foreach (OBJECTIF_TYPES as $key => $label): ?>
                                <option value="<?= $key ?>"><?= $label ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Date cible</label>
                        <input type="date" name="date_cible" class="form-control">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Valeur initiale</label>
                        <input type="text" name="valeur_initiale" class="form-control" placeholder="Ex: 75kg">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Valeur cible</label>
                        <input type="text" name="valeur_cible" class="form-control" placeholder="Ex: 70kg">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="2" placeholder="Détails de l'objectif..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeObjectifModal()">Annuler</button>
                <button type="submit" class="btn btn-primary">Créer l'objectif</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Progression -->
<div id="progression-modal" class="modal" style="display: none;">
    <div class="modal-backdrop" onclick="closeProgressionModal()"></div>
    <div class="modal-content" style="max-width: 400px;">
        <div class="modal-header">
            <h3>Modifier la progression</h3>
            <button type="button" class="modal-close" onclick="closeProgressionModal()">&times;</button>
        </div>
        <form method="POST">
            <input type="hidden" name="action" value="objectif-save">
            <input type="hidden" name="objectif_id" id="prog_objectif_id">
            <input type="hidden" name="client_id" value="<?= $clientId ?>">
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Progression (%)</label>
                    <div class="score-range">
                        <input type="range" name="progression" id="prog_value" min="0" max="100" value="0" oninput="document.getElementById('prog_display').textContent = this.value + '%'">
                        <span class="score-value" id="prog_display">0%</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeProgressionModal()">Annuler</button>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
    </div>
</div>

<style>
.objectifs-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 1.5rem; }
.objectif-card h4 { margin: 0.5rem 0; font-size: 1.1rem; }
.objectif-atteint { border-color: var(--success); background: linear-gradient(135deg, #f8fdf9 0%, white 100%); }
.objectif-header { display: flex; justify-content: space-between; }
.objectif-values { display: flex; gap: 1rem; }
.objectif-progress { display: flex; align-items: center; gap: 0.5rem; }
.progress-bar { flex: 1; height: 8px; background: var(--cream-300); border-radius: 4px; overflow: hidden; }
.progress-fill { height: 100%; background: var(--sage-500); border-radius: 4px; transition: width 0.3s; }
.progress-fill.progress-success { background: var(--success); }
.progress-text { font-weight: 600; min-width: 40px; text-align: right; }
.objectif-actions { display: flex; gap: 0.5rem; }
</style>

<script>
function openObjectifModal() {
    document.getElementById('objectif-modal').style.display = 'flex';
}
function closeObjectifModal() {
    document.getElementById('objectif-modal').style.display = 'none';
}
function editProgression(id, current) {
    document.getElementById('prog_objectif_id').value = id;
    document.getElementById('prog_value').value = current;
    document.getElementById('prog_display').textContent = current + '%';
    document.getElementById('progression-modal').style.display = 'flex';
}
function closeProgressionModal() {
    document.getElementById('progression-modal').style.display = 'none';
}
</script>
