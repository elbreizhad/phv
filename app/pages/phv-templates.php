<?php
/**
 * Templates PHV réutilisables
 */
$db = getDB();
$userId = currentUserId();

$templatesStmt = $db->prepare("SELECT * FROM phv_templates WHERE user_id = ? ORDER BY nom");
$templatesStmt->execute([$userId]);
$templates = $templatesStmt->fetchAll();
?>

<div class="page-header">
    <div>
        <h1>Templates PHV</h1>
        <p class="subtitle">Modèles réutilisables pour vos programmes d'hygiène de vie</p>
    </div>
    <a href="<?= url('phv-template-edit') ?>" class="btn btn-primary">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Nouveau template
    </a>
</div>

<div class="page-body animate-in">
    <?php if (empty($templates)): ?>
        <div class="card">
            <div class="card-body">
                <div class="empty-state">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="48" height="48"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="21" x2="9" y2="9"/></svg>
                    <h3>Aucun template</h3>
                    <p>Créez des templates PHV pour accélérer la génération de vos programmes.</p>
                    <a href="<?= url('phv-template-edit') ?>" class="btn btn-primary">Créer un template</a>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="templates-grid">
            <?php foreach ($templates as $t): ?>
                <div class="card template-card">
                    <div class="card-body">
                        <div class="template-header">
                            <h4><?= e($t['nom']) ?></h4>
                            <?php if ($t['motif_categorie']): ?>
                                <span class="badge badge-sage"><?= MOTIF_CATEGORIES[$t['motif_categorie']] ?? $t['motif_categorie'] ?></span>
                            <?php endif; ?>
                        </div>
                        <?php if ($t['description']): ?>
                            <p class="text-sm text-muted mb-1"><?= e(mb_strimwidth($t['description'], 0, 100, '...')) ?></p>
                        <?php endif; ?>
                        <div class="template-preview">
                            <?php if ($t['alimentation']): ?><span class="preview-tag">Alimentation</span><?php endif; ?>
                            <?php if ($t['activite_physique']): ?><span class="preview-tag">Activité</span><?php endif; ?>
                            <?php if ($t['gestion_stress']): ?><span class="preview-tag">Stress</span><?php endif; ?>
                            <?php if ($t['complements']): ?><span class="preview-tag">Compléments</span><?php endif; ?>
                        </div>
                        <div class="template-actions mt-2">
                            <a href="<?= url('phv-template-edit', ['id' => $t['id']]) ?>" class="btn btn-outline btn-sm">Modifier</a>
                            <form method="POST" style="display: inline;" onsubmit="return confirm('Supprimer ce template ?');">
                                <input type="hidden" name="action" value="phv-template-delete">
                                <input type="hidden" name="template_id" value="<?= $t['id'] ?>">
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
.templates-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 1.5rem; }
.template-card h4 { margin: 0; font-size: 1.1rem; }
.template-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 0.5rem; }
.template-preview { display: flex; flex-wrap: wrap; gap: 0.3rem; }
.preview-tag {
    font-size: 0.7rem;
    padding: 0.2rem 0.5rem;
    background: var(--cream-100);
    border-radius: var(--radius-sm);
    color: var(--text-muted);
}
.template-actions { display: flex; gap: 0.5rem; }
</style>
