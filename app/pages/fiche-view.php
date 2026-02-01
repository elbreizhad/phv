<?php
$db = getDB();
$ficheId = (int) getGet('id');

$stmt = $db->prepare("SELECT * FROM fiches_pathologies WHERE id = ?");
$stmt->execute([$ficheId]);
$fiche = $stmt->fetch();
if (!$fiche) { redirect('fiches'); }
?>

<div class="page-header">
    <div>
        <h1><?= e($fiche['nom']) ?></h1>
        <p class="subtitle"><?= e($fiche['systeme']) ?></p>
    </div>
    <a href="<?= url('fiches') ?>" class="btn btn-secondary">Retour aux fiches</a>
</div>

<div class="page-body animate-in">
    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem;">
        <div>
            <!-- Description -->
            <div class="card mb-3">
                <div class="card-header"><h3>Description</h3></div>
                <div class="card-body">
                    <p><?= nl2br(e($fiche['description'])) ?></p>
                </div>
            </div>

            <!-- Causes -->
            <div class="card mb-3">
                <div class="card-header"><h3>Causes possibles</h3></div>
                <div class="card-body">
                    <p><?= nl2br(e($fiche['causes'])) ?></p>
                </div>
            </div>

            <!-- Signes cliniques -->
            <div class="card mb-3">
                <div class="card-header"><h3>Signes cliniques</h3></div>
                <div class="card-body">
                    <p><?= nl2br(e($fiche['signes_cliniques'])) ?></p>
                </div>
            </div>

            <!-- Alimentation -->
            <div class="card mb-3">
                <div class="card-header"><h3>Conseils alimentaires</h3></div>
                <div class="card-body">
                    <p><?= nl2br(e($fiche['conseils_alimentation'])) ?></p>

                    <?php if ($fiche['aliments_eviter']): ?>
                    <div style="margin-top: 1rem; padding: 1rem; background: #fde8e6; border-radius: var(--radius-sm);">
                        <h4 style="font-family: Inter, sans-serif; font-size: 0.85rem; font-weight: 600; color: var(--danger); margin-bottom: 0.3rem;">A éviter</h4>
                        <p class="text-sm"><?= nl2br(e($fiche['aliments_eviter'])) ?></p>
                    </div>
                    <?php endif; ?>

                    <?php if ($fiche['aliments_privilegier']): ?>
                    <div style="margin-top: 0.8rem; padding: 1rem; background: #e8f5ea; border-radius: var(--radius-sm);">
                        <h4 style="font-family: Inter, sans-serif; font-size: 0.85rem; font-weight: 600; color: var(--success); margin-bottom: 0.3rem;">A privilégier</h4>
                        <p class="text-sm"><?= nl2br(e($fiche['aliments_privilegier'])) ?></p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Activité -->
            <?php if ($fiche['conseils_activite']): ?>
            <div class="card mb-3">
                <div class="card-header"><h3>Activité physique</h3></div>
                <div class="card-body"><p><?= nl2br(e($fiche['conseils_activite'])) ?></p></div>
            </div>
            <?php endif; ?>

            <!-- Stress -->
            <?php if ($fiche['conseils_stress']): ?>
            <div class="card mb-3">
                <div class="card-header"><h3>Gestion du stress</h3></div>
                <div class="card-body"><p><?= nl2br(e($fiche['conseils_stress'])) ?></p></div>
            </div>
            <?php endif; ?>
        </div>

        <!-- Colonne droite -->
        <div>
            <!-- Routine -->
            <?php if ($fiche['conseils_routine']): ?>
            <div class="card mb-3">
                <div class="card-header"><h3>Routine & Soins</h3></div>
                <div class="card-body"><p class="text-sm"><?= nl2br(e($fiche['conseils_routine'])) ?></p></div>
            </div>
            <?php endif; ?>

            <!-- Compléments -->
            <?php if ($fiche['complements']): ?>
            <div class="card mb-3">
                <div class="card-header"><h3>Compléments</h3></div>
                <div class="card-body"><p class="text-sm"><?= nl2br(e($fiche['complements'])) ?></p></div>
            </div>
            <?php endif; ?>

            <!-- Phyto -->
            <?php if ($fiche['phytotherapie']): ?>
            <div class="card mb-3">
                <div class="card-header"><h3>Phytothérapie</h3></div>
                <div class="card-body"><p class="text-sm"><?= nl2br(e($fiche['phytotherapie'])) ?></p></div>
            </div>
            <?php endif; ?>

            <!-- Aroma -->
            <?php if ($fiche['aromatherapie']): ?>
            <div class="card mb-3">
                <div class="card-header"><h3>Aromathérapie</h3></div>
                <div class="card-body"><p class="text-sm"><?= nl2br(e($fiche['aromatherapie'])) ?></p></div>
            </div>
            <?php endif; ?>

            <!-- Notes -->
            <?php if ($fiche['notes']): ?>
            <div class="card mb-3">
                <div class="card-header"><h3>Notes</h3></div>
                <div class="card-body"><p class="text-sm"><?= nl2br(e($fiche['notes'])) ?></p></div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
