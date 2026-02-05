<?php
/**
 * Édition d'un template PHV
 */
$db = getDB();
$userId = currentUserId();
$templateId = (int)getGet('id');

$template = null;
if ($templateId) {
    $stmt = $db->prepare("SELECT * FROM phv_templates WHERE id = ? AND user_id = ?");
    $stmt->execute([$templateId, $userId]);
    $template = $stmt->fetch();
    if (!$template) {
        flashSet('error', 'Template non trouvé.');
        redirect('phv-templates');
    }
}

$isEdit = $template !== null;
?>

<div class="page-header">
    <div>
        <h1><?= $isEdit ? 'Modifier le template' : 'Nouveau template PHV' ?></h1>
        <p class="subtitle"><?= $isEdit ? e($template['nom']) : 'Créez un modèle réutilisable' ?></p>
    </div>
    <a href="<?= url('phv-templates') ?>" class="btn btn-secondary">Retour</a>
</div>

<div class="page-body animate-in">
    <form method="POST" action="<?= url('phv-templates') ?>">
        <input type="hidden" name="action" value="phv-template-save">
        <input type="hidden" name="template_id" value="<?= $templateId ?>">

        <div class="card mb-2">
            <div class="card-header">
                <h3>Informations générales</h3>
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Nom du template <span class="required">*</span></label>
                        <input type="text" name="nom" class="form-control" required value="<?= e($template['nom'] ?? '') ?>" placeholder="Ex: Template troubles digestifs">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Catégorie de motif</label>
                        <select name="motif_categorie" class="form-control">
                            <option value="">-- Toutes catégories --</option>
                            <?php foreach (MOTIF_CATEGORIES as $key => $label): ?>
                                <option value="<?= $key ?>" <?= ($template['motif_categorie'] ?? '') === $key ? 'selected' : '' ?>><?= $label ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="2" placeholder="Description du template..."><?= e($template['description'] ?? '') ?></textarea>
                </div>
            </div>
        </div>

        <div class="card mb-2">
            <div class="card-header">
                <h3>Alimentation</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Conseils alimentation généraux</label>
                    <textarea name="alimentation" class="form-control" rows="3"><?= e($template['alimentation'] ?? '') ?></textarea>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Aliments à éviter</label>
                        <textarea name="alimentation_eviter" class="form-control" rows="3"><?= e($template['alimentation_eviter'] ?? '') ?></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Aliments à privilégier</label>
                        <textarea name="alimentation_privilegier" class="form-control" rows="3"><?= e($template['alimentation_privilegier'] ?? '') ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Menu type</label>
                    <textarea name="menu_type" class="form-control" rows="4"><?= e($template['menu_type'] ?? '') ?></textarea>
                </div>
            </div>
        </div>

        <div class="card mb-2">
            <div class="card-header">
                <h3>Mode de vie</h3>
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Activité physique</label>
                        <textarea name="activite_physique" class="form-control" rows="3"><?= e($template['activite_physique'] ?? '') ?></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Gestion du stress</label>
                        <textarea name="gestion_stress" class="form-control" rows="3"><?= e($template['gestion_stress'] ?? '') ?></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Routine matin</label>
                        <textarea name="routine_matin" class="form-control" rows="3"><?= e($template['routine_matin'] ?? '') ?></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Routine soir</label>
                        <textarea name="routine_soir" class="form-control" rows="3"><?= e($template['routine_soir'] ?? '') ?></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-2">
            <div class="card-header">
                <h3>Compléments & Soins</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Compléments recommandés (JSON)</label>
                    <textarea name="complements" class="form-control" rows="4" placeholder='[{"nom": "Probiotiques", "posologie": "1 gélule/jour", "duree": "3 mois"}]'><?= e($template['complements'] ?? '') ?></textarea>
                    <p class="form-hint">Format JSON : [{"nom": "...", "posologie": "...", "duree": "..."}]</p>
                </div>
                <div class="form-group">
                    <label class="form-label">Soins naturels</label>
                    <textarea name="soins_naturels" class="form-control" rows="3"><?= e($template['soins_naturels'] ?? '') ?></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Recommandations complémentaires</label>
                    <textarea name="recommandations_complementaires" class="form-control" rows="3"><?= e($template['recommandations_complementaires'] ?? '') ?></textarea>
                </div>
            </div>
        </div>

        <div class="form-actions d-flex justify-between">
            <a href="<?= url('phv-templates') ?>" class="btn btn-secondary">Annuler</a>
            <button type="submit" class="btn btn-primary"><?= $isEdit ? 'Enregistrer les modifications' : 'Créer le template' ?></button>
        </div>
    </form>
</div>
