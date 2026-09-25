<?php
$db = getDB();
$id = (int) getGet('id');

$stmt = $db->prepare("SELECT * FROM ressources WHERE id = ?");
$stmt->execute([$id]);
$ressource = $stmt->fetch();
if (!$ressource) { redirect('ressources'); }

$sousTitre = trim(($ressource['categorie'] ?? '') . (!empty($ressource['partie_utilisee']) ? ' · Partie utilisée : ' . $ressource['partie_utilisee'] : ''));
?>

<div class="page-header">
    <div>
        <h1><?= e($ressource['nom']) ?></h1>
        <p class="subtitle"><?= e($sousTitre) ?></p>
    </div>
    <a href="<?= url('ressources', ['section' => $ressource['section']]) ?>" class="btn btn-secondary">Retour</a>
</div>

<div class="page-body animate-in">
    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem;">
        <div>
            <?php if (!empty($ressource['description'])): ?>
            <div class="card mb-3">
                <div class="card-header"><h3>Description</h3></div>
                <div class="card-body"><p><?= nl2br(e($ressource['description'])) ?></p></div>
            </div>
            <?php endif; ?>

            <?php if (!empty($ressource['indication'])): ?>
            <div class="card mb-3">
                <div class="card-header"><h3>✓ Indications</h3></div>
                <div class="card-body"><p><?= nl2br(e($ressource['indication'])) ?></p></div>
            </div>
            <?php endif; ?>

            <?php if (!empty($ressource['contre_indications'])): ?>
            <div class="card mb-3" style="border-left: 4px solid var(--danger, #d85a3d);">
                <div class="card-header"><h3>⚠ Contre-indications</h3></div>
                <div class="card-body"><p><?= nl2br(e($ressource['contre_indications'])) ?></p></div>
            </div>
            <?php endif; ?>

            <?php if (!empty($ressource['posologie'])): ?>
            <div class="card mb-3">
                <div class="card-header"><h3>⚗ Posologie / Galénique</h3></div>
                <div class="card-body"><p><?= nl2br(e($ressource['posologie'])) ?></p></div>
            </div>
            <?php endif; ?>

            <?php if (!empty($ressource['proprietes'])): ?>
            <div class="card mb-3">
                <div class="card-header"><h3>Propriétés</h3></div>
                <div class="card-body"><p><?= nl2br(e($ressource['proprietes'])) ?></p></div>
            </div>
            <?php endif; ?>
        </div>

        <div>
            <?php if (!empty($ressource['synergies'])): ?>
            <div class="card mb-3">
                <div class="card-header"><h3>⟐ Synergies</h3></div>
                <div class="card-body"><p class="text-sm"><?= nl2br(e($ressource['synergies'])) ?></p></div>
            </div>
            <?php endif; ?>

            <?php if (!empty($ressource['conseil_du_moment'])): ?>
            <div class="card mb-3">
                <div class="card-header"><h3>Conseil du moment</h3></div>
                <div class="card-body"><p class="text-sm"><?= nl2br(e($ressource['conseil_du_moment'])) ?></p></div>
            </div>
            <?php endif; ?>

            <?php if (!empty($ressource['sources_alimentaires'])): ?>
            <div class="card mb-3">
                <div class="card-header"><h3>Sources alimentaires</h3></div>
                <div class="card-body"><p class="text-sm"><?= nl2br(e($ressource['sources_alimentaires'])) ?></p></div>
            </div>
            <?php endif; ?>

            <?php if (!empty($ressource['notes'])): ?>
            <div class="card mb-3">
                <div class="card-header"><h3>Notes</h3></div>
                <div class="card-body"><p class="text-sm"><?= nl2br(e($ressource['notes'])) ?></p></div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
