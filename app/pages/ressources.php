<?php
/**
 * Ressources documentaires (aromatologie, phytologie, micronutrition,
 * hydrologie, gestion du stress, alimentation générale...).
 * Structure calquée sur "Fiches pathologies" : section -> catégorie -> fiches.
 */

// Sections prévues à terme ; seules celles avec du contenu en base sont cliquables.
const RESSOURCES_SECTIONS = [
    'phytologie' => 'Phytologie',
    'aromatologie' => 'Aromatologie',
    'micronutrition' => 'Micronutrition',
    'hydrologie' => 'Hydrologie',
    'stress' => 'Gestion du stress',
    'alimentation' => 'Alimentation générale',
    'mycotherapie' => 'Mycothérapie',
    'activite_physique' => 'Activité physique',
];

$db = getDB();

$sectionsDisponibles = [];
try {
    $sectionsDisponibles = $db->query("SELECT DISTINCT section FROM ressources")->fetchAll(PDO::FETCH_COLUMN);
} catch (PDOException $e) {
    // Table pas encore créée (avant le premier déploiement synchronisant les ressources)
}

$sectionFilter = getGet('section', $sectionsDisponibles[0] ?? '');
$categorieFilter = getGet('categorie');

$ressources = [];
$categories = [];
if ($sectionFilter && in_array($sectionFilter, $sectionsDisponibles, true)) {
    if ($categorieFilter) {
        $stmt = $db->prepare("SELECT * FROM ressources WHERE section = ? AND categorie = ? ORDER BY nom");
        $stmt->execute([$sectionFilter, $categorieFilter]);
    } else {
        $stmt = $db->prepare("SELECT * FROM ressources WHERE section = ? ORDER BY categorie, nom");
        $stmt->execute([$sectionFilter]);
    }
    $ressources = $stmt->fetchAll();

    $catStmt = $db->prepare("SELECT DISTINCT categorie FROM ressources WHERE section = ? ORDER BY categorie");
    $catStmt->execute([$sectionFilter]);
    $categories = $catStmt->fetchAll(PDO::FETCH_COLUMN);
}

$grouped = [];
foreach ($ressources as $r) {
    $grouped[$r['categorie']][] = $r;
}
?>

<div class="page-header">
    <div>
        <h1>Ressources</h1>
        <p class="subtitle"><?= count($ressources) ?> fiche<?= count($ressources) > 1 ? 's' : '' ?> disponible<?= count($ressources) > 1 ? 's' : '' ?></p>
    </div>
</div>

<div class="page-body animate-in">
    <!-- Sections -->
    <div class="card mb-3">
        <div class="card-body" style="padding: 0.8rem 1.5rem;">
            <div class="d-flex gap-1 flex-wrap">
                <?php foreach (RESSOURCES_SECTIONS as $key => $label): ?>
                    <?php $dispo = in_array($key, $sectionsDisponibles, true); ?>
                    <?php if ($dispo): ?>
                        <a href="<?= url('ressources', ['section' => $key]) ?>" class="btn <?= $sectionFilter === $key ? 'btn-primary' : 'btn-outline' ?> btn-sm"><?= e($label) ?></a>
                    <?php else: ?>
                        <span class="btn btn-outline btn-sm" style="opacity:.4; cursor:not-allowed;" title="Bientôt disponible"><?= e($label) ?></span>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <?php if ($sectionFilter && !empty($categories)): ?>
    <!-- Catégories de la section -->
    <div class="card mb-3">
        <div class="card-body" style="padding: 0.8rem 1.5rem;">
            <div class="d-flex gap-1 flex-wrap">
                <a href="<?= url('ressources', ['section' => $sectionFilter]) ?>" class="btn <?= !$categorieFilter ? 'btn-primary' : 'btn-outline' ?> btn-sm">Toutes</a>
                <?php foreach ($categories as $cat): ?>
                    <a href="<?= url('ressources', ['section' => $sectionFilter, 'categorie' => $cat]) ?>" class="btn <?= $categorieFilter === $cat ? 'btn-primary' : 'btn-outline' ?> btn-sm"><?= e($cat) ?></a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Fiches groupées -->
    <?php foreach ($grouped as $categorie => $ressourcesGroup): ?>
    <div class="mb-3">
        <h2 style="font-size: 1.2rem; margin-bottom: 1rem;">
            <span class="badge badge-sage" style="font-size: 0.85rem; padding: 0.3rem 0.8rem;"><?= e($categorie) ?></span>
        </h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1rem;">
            <?php foreach ($ressourcesGroup as $r): ?>
            <div class="card" style="cursor:pointer;" onclick="window.location='<?= url('ressource-view', ['id' => $r['id']]) ?>'">
                <div class="card-body">
                    <h3 style="font-size: 1.05rem; margin-bottom: 0.5rem;"><?= e($r['nom']) ?></h3>
                    <?php if ($r['indication']): ?>
                    <p class="text-sm text-muted" style="line-height: 1.5;"><?= e(mb_strimwidth($r['indication'], 0, 130, '...')) ?></p>
                    <?php endif; ?>
                    <div style="margin-top: 0.8rem;">
                        <a href="<?= url('ressource-view', ['id' => $r['id']]) ?>" class="btn btn-outline btn-sm">Consulter</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endforeach; ?>

    <?php if (empty($sectionsDisponibles)): ?>
    <div class="empty-state">
        <h3>Aucune ressource pour le moment</h3>
        <p>Relancez le déploiement du site pour importer les ressources.</p>
    </div>
    <?php elseif ($sectionFilter && empty($ressources)): ?>
    <div class="empty-state">
        <h3>Aucune fiche dans cette section</h3>
    </div>
    <?php endif; ?>
</div>
