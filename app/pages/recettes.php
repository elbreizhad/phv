<?php
/**
 * Bibliothèque de recettes
 */
$db = getDB();
$userId = currentUserId();

// Filtres
$categorie = getGet('categorie', '');
$recherche = getGet('q', '');

$where = ["(user_id = ? OR user_id IS NULL)"];
$params = [$userId];

if ($categorie) {
    $where[] = "categorie = ?";
    $params[] = $categorie;
}

if ($recherche) {
    $where[] = "(nom LIKE ? OR ingredients LIKE ?)";
    $params[] = "%$recherche%";
    $params[] = "%$recherche%";
}

$whereClause = implode(' AND ', $where);

$recettesStmt = $db->prepare("SELECT * FROM recettes WHERE $whereClause ORDER BY nom");
$recettesStmt->execute($params);
$recettes = $recettesStmt->fetchAll();

$categories = [
    'petit_dejeuner' => 'Petit-déjeuner',
    'entree' => 'Entrée',
    'plat' => 'Plat',
    'dessert' => 'Dessert',
    'boisson' => 'Boisson',
    'collation' => 'Collation'
];
?>

<div class="page-header">
    <div>
        <h1>Recettes</h1>
        <p class="subtitle">Bibliothèque de recettes saines</p>
    </div>
    <a href="<?= url('recette-edit') ?>" class="btn btn-primary">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Nouvelle recette
    </a>
</div>

<div class="page-body animate-in">
    <!-- Filtres -->
    <div class="card mb-2">
        <div class="card-body">
            <form method="GET" class="d-flex gap-1 align-center flex-wrap">
                <input type="hidden" name="page" value="recettes">
                <input type="text" name="q" class="form-control" placeholder="Rechercher..." value="<?= e($recherche) ?>" style="flex: 1; min-width: 200px;">
                <select name="categorie" class="form-control" style="width: auto;">
                    <option value="">Toutes catégories</option>
                    <?php foreach ($categories as $key => $label): ?>
                        <option value="<?= $key ?>" <?= $categorie === $key ? 'selected' : '' ?>><?= $label ?></option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" class="btn btn-secondary">Filtrer</button>
            </form>
        </div>
    </div>

    <?php if (empty($recettes)): ?>
        <div class="card">
            <div class="card-body">
                <div class="empty-state">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="48" height="48"><path d="M18 8h1a4 4 0 0 1 0 8h-1"/><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"/><line x1="6" y1="1" x2="6" y2="4"/><line x1="10" y1="1" x2="10" y2="4"/><line x1="14" y1="1" x2="14" y2="4"/></svg>
                    <h3>Aucune recette</h3>
                    <p>Ajoutez des recettes à votre bibliothèque pour les partager avec vos clients.</p>
                    <a href="<?= url('recette-edit') ?>" class="btn btn-primary">Ajouter une recette</a>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="recettes-grid">
            <?php foreach ($recettes as $r): ?>
                <div class="card recette-card">
                    <div class="card-body">
                        <div class="recette-header">
                            <span class="badge badge-sage"><?= $categories[$r['categorie']] ?? $r['categorie'] ?></span>
                            <?php if ($r['temps_preparation'] || $r['temps_cuisson']): ?>
                                <span class="text-sm text-muted">
                                    <?= $r['temps_preparation'] ? $r['temps_preparation'] . ' min prep' : '' ?>
                                    <?= $r['temps_cuisson'] ? '+ ' . $r['temps_cuisson'] . ' min cuisson' : '' ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        <h4><?= e($r['nom']) ?></h4>
                        <?php if ($r['ingredients']): ?>
                            <p class="text-sm text-muted recette-ingredients"><?= e(mb_strimwidth($r['ingredients'], 0, 100, '...')) ?></p>
                        <?php endif; ?>

                        <?php
                        $regimes = $r['regimes'] ? json_decode($r['regimes'], true) : [];
                        if (!empty($regimes)):
                        ?>
                        <div class="recette-tags mt-1">
                            <?php foreach (array_slice($regimes, 0, 3) as $regime): ?>
                                <span class="tag"><?= e($regime) ?></span>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>

                        <div class="recette-actions mt-2">
                            <a href="<?= url('recette-edit', ['id' => $r['id']]) ?>" class="btn btn-outline btn-sm">Voir</a>
                            <?php if ($r['user_id'] == $userId): ?>
                            <form method="POST" style="display: inline;" onsubmit="return confirm('Supprimer cette recette ?');">
                                <input type="hidden" name="action" value="recette-delete">
                                <input type="hidden" name="recette_id" value="<?= $r['id'] ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                            </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<style>
.recettes-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem; }
.recette-card h4 { margin: 0.5rem 0; font-size: 1.1rem; }
.recette-header { display: flex; justify-content: space-between; align-items: center; }
.recette-ingredients { line-height: 1.4; }
.recette-tags { display: flex; flex-wrap: wrap; gap: 0.3rem; }
.recette-tags .tag {
    font-size: 0.7rem;
    padding: 0.15rem 0.4rem;
    background: var(--terra-50);
    color: var(--terra-600);
    border-radius: 4px;
}
.recette-actions { display: flex; gap: 0.5rem; }
</style>
