<?php
/**
 * Édition d'une recette
 */
$db = getDB();
$userId = currentUserId();
$recetteId = (int)getGet('id');

$recette = null;
if ($recetteId) {
    $stmt = $db->prepare("SELECT * FROM recettes WHERE id = ? AND (user_id = ? OR user_id IS NULL)");
    $stmt->execute([$recetteId, $userId]);
    $recette = $stmt->fetch();
    if (!$recette) {
        flashSet('error', 'Recette non trouvée.');
        redirect('recettes');
    }
}

$isEdit = $recette !== null;
$isOwner = $recette === null || $recette['user_id'] == $userId;
$regimes = $recette ? json_decode($recette['regimes'] ?? '[]', true) : [];
$allergenes = $recette ? json_decode($recette['allergenes'] ?? '[]', true) : [];

$categories = [
    'petit_dejeuner' => 'Petit-déjeuner',
    'entree' => 'Entrée',
    'plat' => 'Plat',
    'dessert' => 'Dessert',
    'boisson' => 'Boisson',
    'collation' => 'Collation'
];

$regimesList = ['Végétarien', 'Vegan', 'Sans gluten', 'Sans lactose', 'Paléo', 'Cétogène', 'FODMAP', 'Anti-inflammatoire'];
$allergenesList = ['Gluten', 'Lactose', 'Oeufs', 'Arachides', 'Fruits à coque', 'Soja', 'Poisson', 'Crustacés'];
?>

<div class="page-header">
    <div>
        <h1><?= $isEdit ? ($isOwner ? 'Modifier la recette' : 'Voir la recette') : 'Nouvelle recette' ?></h1>
        <p class="subtitle"><?= $isEdit ? e($recette['nom']) : 'Ajoutez une recette à votre bibliothèque' ?></p>
    </div>
    <a href="<?= url('recettes') ?>" class="btn btn-secondary">Retour</a>
</div>

<div class="page-body animate-in">
    <form method="POST" action="<?= url('recettes') ?>">
        <input type="hidden" name="action" value="recette-save">
        <input type="hidden" name="recette_id" value="<?= $recetteId ?>">

        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem;">
            <div>
                <div class="card mb-2">
                    <div class="card-header">
                        <h3>Informations</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group" style="flex: 2;">
                                <label class="form-label">Nom de la recette <span class="required">*</span></label>
                                <input type="text" name="nom" class="form-control" required value="<?= e($recette['nom'] ?? '') ?>" <?= !$isOwner ? 'readonly' : '' ?>>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Catégorie</label>
                                <select name="categorie" class="form-control" <?= !$isOwner ? 'disabled' : '' ?>>
                                    <?php foreach ($categories as $key => $label): ?>
                                        <option value="<?= $key ?>" <?= ($recette['categorie'] ?? 'plat') === $key ? 'selected' : '' ?>><?= $label ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Temps préparation (min)</label>
                                <input type="number" name="temps_preparation" class="form-control" value="<?= e($recette['temps_preparation'] ?? '') ?>" <?= !$isOwner ? 'readonly' : '' ?>>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Temps cuisson (min)</label>
                                <input type="number" name="temps_cuisson" class="form-control" value="<?= e($recette['temps_cuisson'] ?? '') ?>" <?= !$isOwner ? 'readonly' : '' ?>>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Portions</label>
                                <input type="number" name="portions" class="form-control" value="<?= e($recette['portions'] ?? '4') ?>" <?= !$isOwner ? 'readonly' : '' ?>>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-2">
                    <div class="card-header">
                        <h3>Ingrédients</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <textarea name="ingredients" class="form-control" rows="8" placeholder="- 200g de quinoa&#10;- 1 concombre&#10;- 2 tomates&#10;..." <?= !$isOwner ? 'readonly' : '' ?>><?= e($recette['ingredients'] ?? '') ?></textarea>
                            <p class="form-hint">Un ingrédient par ligne, avec les quantités</p>
                        </div>
                    </div>
                </div>

                <div class="card mb-2">
                    <div class="card-header">
                        <h3>Instructions</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <textarea name="instructions" class="form-control" rows="10" placeholder="1. Rincer le quinoa...&#10;2. Faire cuire...&#10;3. Couper les légumes..." <?= !$isOwner ? 'readonly' : '' ?>><?= e($recette['instructions'] ?? '') ?></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="card mb-2">
                    <div class="card-header">
                        <h3>Régimes compatibles</h3>
                    </div>
                    <div class="card-body">
                        <?php foreach ($regimesList as $regime): ?>
                            <label class="form-check">
                                <input type="checkbox" name="regimes[]" value="<?= $regime ?>" <?= in_array($regime, $regimes) ? 'checked' : '' ?> <?= !$isOwner ? 'disabled' : '' ?>>
                                <span><?= $regime ?></span>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="card mb-2">
                    <div class="card-header">
                        <h3>Allergènes</h3>
                    </div>
                    <div class="card-body">
                        <?php foreach ($allergenesList as $allergene): ?>
                            <label class="form-check">
                                <input type="checkbox" name="allergenes[]" value="<?= $allergene ?>" <?= in_array($allergene, $allergenes) ? 'checked' : '' ?> <?= !$isOwner ? 'disabled' : '' ?>>
                                <span><?= $allergene ?></span>
                            </label>
                        <?php endforeach; ?>
                        <p class="form-hint mt-1">Cochez les allergènes présents dans la recette</p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3>Source</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label">Source / Référence</label>
                            <input type="text" name="source" class="form-control" value="<?= e($recette['source'] ?? '') ?>" placeholder="Livre, site web..." <?= !$isOwner ? 'readonly' : '' ?>>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if ($isOwner): ?>
        <div class="form-actions mt-2 d-flex justify-between">
            <a href="<?= url('recettes') ?>" class="btn btn-secondary">Annuler</a>
            <button type="submit" class="btn btn-primary"><?= $isEdit ? 'Enregistrer' : 'Créer la recette' ?></button>
        </div>
        <?php endif; ?>
    </form>
</div>
