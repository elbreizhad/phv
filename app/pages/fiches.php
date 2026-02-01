<?php
$db = getDB();

$systemeFilter = getGet('systeme');
if ($systemeFilter) {
    $stmt = $db->prepare("SELECT * FROM fiches_pathologies WHERE systeme = ? ORDER BY nom");
    $stmt->execute([$systemeFilter]);
} else {
    $stmt = $db->query("SELECT * FROM fiches_pathologies ORDER BY systeme, nom");
}
$fiches = $stmt->fetchAll();

// Grouper par système
$grouped = [];
foreach ($fiches as $f) {
    $grouped[$f['systeme']][] = $f;
}

// Liste des systèmes disponibles
$systemes = $db->query("SELECT DISTINCT systeme FROM fiches_pathologies ORDER BY systeme")->fetchAll(PDO::FETCH_COLUMN);
?>

<div class="page-header">
    <div>
        <h1>Fiches pathologies</h1>
        <p class="subtitle"><?= count($fiches) ?> fiche<?= count($fiches) > 1 ? 's' : '' ?> disponible<?= count($fiches) > 1 ? 's' : '' ?></p>
    </div>
</div>

<div class="page-body animate-in">
    <!-- Filtre par système -->
    <div class="card mb-3">
        <div class="card-body" style="padding: 0.8rem 1.5rem;">
            <div class="d-flex gap-1 flex-wrap">
                <a href="<?= url('fiches') ?>" class="btn <?= !$systemeFilter ? 'btn-primary' : 'btn-outline' ?> btn-sm">Toutes</a>
                <?php foreach ($systemes as $sys): ?>
                    <a href="<?= url('fiches', ['systeme' => $sys]) ?>" class="btn <?= $systemeFilter === $sys ? 'btn-primary' : 'btn-outline' ?> btn-sm"><?= e($sys) ?></a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Fiches groupées -->
    <?php foreach ($grouped as $systeme => $fichesGroup): ?>
    <div class="mb-3">
        <h2 style="font-size: 1.2rem; margin-bottom: 1rem;">
            <span class="badge badge-sage" style="font-size: 0.85rem; padding: 0.3rem 0.8rem;"><?= e($systeme) ?></span>
        </h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 1rem;">
            <?php foreach ($fichesGroup as $f): ?>
            <div class="card" style="cursor:pointer;" onclick="window.location='<?= url('fiche-view', ['id' => $f['id']]) ?>'">
                <div class="card-body">
                    <h3 style="font-size: 1.05rem; margin-bottom: 0.5rem;"><?= e($f['nom']) ?></h3>
                    <p class="text-sm text-muted" style="line-height: 1.5;"><?= e(mb_strimwidth($f['description'], 0, 150, '...')) ?></p>
                    <div style="margin-top: 0.8rem;">
                        <a href="<?= url('fiche-view', ['id' => $f['id']]) ?>" class="btn btn-outline btn-sm">Consulter</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endforeach; ?>

    <?php if (empty($fiches)): ?>
    <div class="empty-state">
        <h3>Aucune fiche pathologie</h3>
        <p>Exécutez la page d'installation pour importer les fiches.</p>
        <a href="<?= url('install') ?>" class="btn btn-primary">Installer</a>
    </div>
    <?php endif; ?>
</div>
