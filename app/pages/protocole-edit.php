<?php
/**
 * Édition d'un protocole
 */
$db = getDB();
$userId = currentUserId();
$protocoleId = (int)getGet('id');

$protocole = null;
if ($protocoleId) {
    $stmt = $db->prepare("SELECT * FROM protocoles WHERE id = ? AND user_id = ?");
    $stmt->execute([$protocoleId, $userId]);
    $protocole = $stmt->fetch();
    if (!$protocole) {
        flashSet('error', 'Protocole non trouvé.');
        redirect('protocoles');
    }
}

$isEdit = $protocole !== null;
$phases = $protocole ? json_decode($protocole['phases'] ?? '[]', true) : [];
$complements = $protocole ? json_decode($protocole['complements'] ?? '[]', true) : [];
?>

<div class="page-header">
    <div>
        <h1><?= $isEdit ? 'Modifier le protocole' : 'Nouveau protocole' ?></h1>
        <p class="subtitle"><?= $isEdit ? e($protocole['nom']) : 'Créez un protocole naturopathique' ?></p>
    </div>
    <a href="<?= url('protocoles') ?>" class="btn btn-secondary">Retour</a>
</div>

<div class="page-body animate-in">
    <form method="POST" action="<?= url('protocoles') ?>">
        <input type="hidden" name="action" value="protocole-save">
        <input type="hidden" name="protocole_id" value="<?= $protocoleId ?>">

        <div class="card mb-2">
            <div class="card-header">
                <h3>Informations générales</h3>
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Nom du protocole <span class="required">*</span></label>
                        <input type="text" name="nom" class="form-control" required value="<?= e($protocole['nom'] ?? '') ?>" placeholder="Ex: Protocole Détox Printanière">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Type</label>
                        <select name="type_protocole" class="form-control">
                            <?php foreach (PROTOCOLE_TYPES as $key => $label): ?>
                                <option value="<?= $key ?>" <?= ($protocole['type_protocole'] ?? '') === $key ? 'selected' : '' ?>><?= $label ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Durée (jours)</label>
                        <input type="number" name="duree_jours" class="form-control" value="<?= e($protocole['duree_jours'] ?? '21') ?>" min="1">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3"><?= e($protocole['description'] ?? '') ?></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Objectifs</label>
                    <textarea name="objectifs" class="form-control" rows="2" placeholder="Objectifs du protocole..."><?= e($protocole['objectifs'] ?? '') ?></textarea>
                </div>
            </div>
        </div>

        <div class="card mb-2">
            <div class="card-header">
                <h3>Phases du protocole</h3>
                <button type="button" class="btn btn-outline btn-sm" onclick="addPhase()">+ Ajouter une phase</button>
            </div>
            <div class="card-body">
                <div id="phases-container">
                    <?php if (empty($phases)): ?>
                        <p class="text-muted text-center" id="no-phases">Ajoutez des phases pour structurer le protocole.</p>
                    <?php else: ?>
                        <?php foreach ($phases as $i => $phase): ?>
                            <div class="phase-item" data-index="<?= $i ?>">
                                <div class="phase-header">
                                    <span class="phase-number">Phase <?= $i + 1 ?></span>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="removePhase(this)">&times;</button>
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label class="form-label">Nom</label>
                                        <input type="text" name="phases[<?= $i ?>][nom]" class="form-control" value="<?= e($phase['nom'] ?? '') ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Durée (jours)</label>
                                        <input type="number" name="phases[<?= $i ?>][duree]" class="form-control" value="<?= e($phase['duree'] ?? '7') ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Description / Actions</label>
                                    <textarea name="phases[<?= $i ?>][description]" class="form-control" rows="2"><?= e($phase['description'] ?? '') ?></textarea>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="card mb-2">
            <div class="card-header">
                <h3>Alimentation & Mode de vie</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Recommandations alimentaires</label>
                    <textarea name="alimentation" class="form-control" rows="4"><?= e($protocole['alimentation'] ?? '') ?></textarea>
                </div>
            </div>
        </div>

        <div class="card mb-2">
            <div class="card-header">
                <h3>Compléments alimentaires</h3>
                <button type="button" class="btn btn-outline btn-sm" onclick="addComplement()">+ Ajouter</button>
            </div>
            <div class="card-body">
                <div id="complements-container">
                    <?php if (empty($complements)): ?>
                        <p class="text-muted text-center" id="no-complements">Ajoutez des compléments si nécessaire.</p>
                    <?php else: ?>
                        <?php foreach ($complements as $i => $comp): ?>
                            <div class="complement-item">
                                <div class="form-row" style="align-items: flex-end;">
                                    <div class="form-group" style="flex: 2;">
                                        <label class="form-label">Nom</label>
                                        <input type="text" name="complements[<?= $i ?>][nom]" class="form-control" value="<?= e($comp['nom'] ?? '') ?>">
                                    </div>
                                    <div class="form-group" style="flex: 2;">
                                        <label class="form-label">Posologie</label>
                                        <input type="text" name="complements[<?= $i ?>][posologie]" class="form-control" value="<?= e($comp['posologie'] ?? '') ?>">
                                    </div>
                                    <div class="form-group" style="flex: 1;">
                                        <label class="form-label">Durée</label>
                                        <input type="text" name="complements[<?= $i ?>][duree]" class="form-control" value="<?= e($comp['duree'] ?? '') ?>">
                                    </div>
                                    <button type="button" class="btn btn-danger btn-sm" style="margin-bottom: 1.3rem;" onclick="removeComplement(this)">&times;</button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="card mb-2">
            <div class="card-header">
                <h3>Contre-indications</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Contre-indications et précautions</label>
                    <textarea name="contre_indications" class="form-control" rows="3" placeholder="Grossesse, allaitement, pathologies spécifiques..."><?= e($protocole['contre_indications'] ?? '') ?></textarea>
                </div>
            </div>
        </div>

        <div class="form-actions d-flex justify-between">
            <a href="<?= url('protocoles') ?>" class="btn btn-secondary">Annuler</a>
            <button type="submit" class="btn btn-primary"><?= $isEdit ? 'Enregistrer' : 'Créer le protocole' ?></button>
        </div>
    </form>
</div>

<style>
.phase-item, .complement-item {
    padding: 1rem;
    background: var(--cream-50);
    border-radius: var(--radius-sm);
    margin-bottom: 1rem;
    border: 1px solid var(--cream-200);
}
.phase-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.5rem;
}
.phase-number {
    font-weight: 600;
    color: var(--sage-700);
}
</style>

<script>
let phaseIndex = <?= count($phases) ?>;
let complementIndex = <?= count($complements) ?>;

function addPhase() {
    document.getElementById('no-phases')?.remove();
    const container = document.getElementById('phases-container');
    const html = `
        <div class="phase-item" data-index="${phaseIndex}">
            <div class="phase-header">
                <span class="phase-number">Phase ${phaseIndex + 1}</span>
                <button type="button" class="btn btn-danger btn-sm" onclick="removePhase(this)">&times;</button>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Nom</label>
                    <input type="text" name="phases[${phaseIndex}][nom]" class="form-control" placeholder="Ex: Phase de préparation">
                </div>
                <div class="form-group">
                    <label class="form-label">Durée (jours)</label>
                    <input type="number" name="phases[${phaseIndex}][duree]" class="form-control" value="7">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Description / Actions</label>
                <textarea name="phases[${phaseIndex}][description]" class="form-control" rows="2"></textarea>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', html);
    phaseIndex++;
}

function removePhase(btn) {
    btn.closest('.phase-item').remove();
}

function addComplement() {
    document.getElementById('no-complements')?.remove();
    const container = document.getElementById('complements-container');
    const html = `
        <div class="complement-item">
            <div class="form-row" style="align-items: flex-end;">
                <div class="form-group" style="flex: 2;">
                    <label class="form-label">Nom</label>
                    <input type="text" name="complements[${complementIndex}][nom]" class="form-control">
                </div>
                <div class="form-group" style="flex: 2;">
                    <label class="form-label">Posologie</label>
                    <input type="text" name="complements[${complementIndex}][posologie]" class="form-control">
                </div>
                <div class="form-group" style="flex: 1;">
                    <label class="form-label">Durée</label>
                    <input type="text" name="complements[${complementIndex}][duree]" class="form-control">
                </div>
                <button type="button" class="btn btn-danger btn-sm" style="margin-bottom: 1.3rem;" onclick="removeComplement(this)">&times;</button>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', html);
    complementIndex++;
}

function removeComplement(btn) {
    btn.closest('.complement-item').remove();
}
</script>
