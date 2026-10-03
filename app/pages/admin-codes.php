<?php
/**
 * Administration - Codes d'essai
 */
$db = getDB();
$codes = $db->query("
    SELECT tc.*, u.prenom AS createur_prenom, u.nom AS createur_nom
    FROM trial_codes tc
    LEFT JOIN users u ON u.id = tc.created_by
    ORDER BY tc.created_at DESC
")->fetchAll();
?>

<div class="page-header">
    <div>
        <h1>Administration — Codes d'essai</h1>
        <p class="subtitle">Générez des codes pour débloquer une période d'essai aux praticiens</p>
    </div>
</div>

<div class="page-body animate-in">

    <div class="card" style="margin-bottom:1.5rem;">
        <div class="card-header">
            <h3>Générer un code</h3>
        </div>
        <div class="card-body">
            <form method="POST" style="display:flex;gap:1rem;align-items:flex-end;flex-wrap:wrap;">
                <input type="hidden" name="action" value="admin-code-save">
                <div class="form-group" style="margin-bottom:0;">
                    <label>Durée de l'essai (jours)</label>
                    <input type="number" name="duree_jours" class="form-control" value="30" min="1" required>
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label>Nombre d'utilisations max</label>
                    <input type="number" name="usage_max" class="form-control" value="1" min="1" required>
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label>Expiration du code (optionnel)</label>
                    <input type="date" name="expires_at" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Générer</button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body" style="padding:0;">
            <table class="table">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Durée</th>
                        <th>Utilisations</th>
                        <th>Expiration du code</th>
                        <th>Créé par</th>
                        <th>Statut</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($codes as $c): ?>
                    <tr>
                        <td><code><?= e($c['code']) ?></code></td>
                        <td><?= (int) $c['duree_jours'] ?> j</td>
                        <td><?= (int) $c['usage_count'] ?> / <?= (int) $c['usage_max'] ?></td>
                        <td class="text-muted"><?= $c['expires_at'] ? formatDate($c['expires_at']) : '-' ?></td>
                        <td class="text-muted"><?= $c['createur_prenom'] ? e($c['createur_prenom'] . ' ' . $c['createur_nom']) : '-' ?></td>
                        <td>
                            <span class="badge <?= $c['actif'] ? 'badge-success' : 'badge-danger' ?>">
                                <?= $c['actif'] ? 'Actif' : 'Désactivé' ?>
                            </span>
                        </td>
                        <td class="actions">
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="action" value="admin-code-toggle">
                                <input type="hidden" name="code_id" value="<?= $c['id'] ?>">
                                <button type="submit" class="btn btn-outline btn-sm">
                                    <?= $c['actif'] ? 'Désactiver' : 'Réactiver' ?>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php if (empty($codes)): ?>
                    <tr><td colspan="7" class="text-muted" style="padding:1rem;">Aucun code généré pour le moment.</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
