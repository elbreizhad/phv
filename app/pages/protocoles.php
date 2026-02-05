<?php
/**
 * Bibliothèque de protocoles
 */
$db = getDB();
$userId = currentUserId();

$protocolesStmt = $db->prepare("SELECT * FROM protocoles WHERE user_id = ? ORDER BY nom");
$protocolesStmt->execute([$userId]);
$protocoles = $protocolesStmt->fetchAll();
?>

<div class="page-header">
    <div>
        <h1>Protocoles</h1>
        <p class="subtitle">Bibliothèque de protocoles naturopathiques</p>
    </div>
    <a href="<?= url('protocole-edit') ?>" class="btn btn-primary">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Nouveau protocole
    </a>
</div>

<div class="page-body animate-in">
    <?php if (empty($protocoles)): ?>
        <div class="card">
            <div class="card-body">
                <div class="empty-state">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="48" height="48"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
                    <h3>Aucun protocole</h3>
                    <p>Créez des protocoles types (détox, reminéralisation, etc.) pour les réutiliser avec vos clients.</p>
                    <a href="<?= url('protocole-edit') ?>" class="btn btn-primary">Créer un protocole</a>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="protocoles-grid">
            <?php foreach ($protocoles as $p): ?>
                <div class="card protocole-card">
                    <div class="card-body">
                        <div class="protocole-header">
                            <span class="badge badge-sage"><?= PROTOCOLE_TYPES[$p['type_protocole']] ?? $p['type_protocole'] ?></span>
                            <?php if ($p['duree_jours']): ?>
                                <span class="text-sm text-muted"><?= $p['duree_jours'] ?> jours</span>
                            <?php endif; ?>
                        </div>
                        <h4><?= e($p['nom']) ?></h4>
                        <?php if ($p['description']): ?>
                            <p class="text-sm text-muted"><?= e(mb_strimwidth($p['description'], 0, 120, '...')) ?></p>
                        <?php endif; ?>

                        <?php if ($p['objectifs']): ?>
                            <div class="protocole-objectifs mt-1">
                                <strong class="text-sm">Objectifs:</strong>
                                <p class="text-sm"><?= e(mb_strimwidth($p['objectifs'], 0, 80, '...')) ?></p>
                            </div>
                        <?php endif; ?>

                        <div class="protocole-actions mt-2">
                            <a href="<?= url('protocole-edit', ['id' => $p['id']]) ?>" class="btn btn-outline btn-sm">Voir / Modifier</a>
                            <form method="POST" style="display: inline;" onsubmit="return confirm('Supprimer ce protocole ?');">
                                <input type="hidden" name="action" value="protocole-delete">
                                <input type="hidden" name="protocole_id" value="<?= $p['id'] ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<style>
.protocoles-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 1.5rem; }
.protocole-card h4 { margin: 0.5rem 0; font-size: 1.1rem; }
.protocole-header { display: flex; justify-content: space-between; align-items: center; }
.protocole-objectifs { padding: 0.5rem; background: var(--cream-50); border-radius: var(--radius-sm); }
.protocole-actions { display: flex; gap: 0.5rem; }
</style>
