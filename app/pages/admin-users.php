<?php
/**
 * Administration - Liste des praticiens
 */
$db = getDB();

$users = $db->query("
    SELECT u.*, us.nom_cabinet,
        (SELECT COUNT(*) FROM clients c WHERE c.user_id = u.id) AS nb_clients
    FROM users u
    LEFT JOIN user_settings us ON us.user_id = u.id
    ORDER BY u.id
")->fetchAll();
?>

<div class="page-header">
    <div>
        <h1>Administration — Praticiens</h1>
        <p class="subtitle"><?= count($users) ?> compte<?= count($users) > 1 ? 's' : '' ?></p>
    </div>
    <a href="<?= url('admin-user-edit') ?>" class="btn btn-primary">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Nouveau praticien
    </a>
</div>

<div class="page-body animate-in">
    <div class="card">
        <div class="card-body" style="padding:0;">
            <table class="table">
                <thead>
                    <tr>
                        <th>Praticien</th>
                        <th>Identifiant</th>
                        <th>Email</th>
                        <th>Rôle</th>
                        <th>Clients</th>
                        <th>Statut</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $u): ?>
                    <tr>
                        <td>
                            <strong><?= e($u['prenom'] . ' ' . $u['nom']) ?></strong>
                            <?php if (!empty($u['nom_cabinet'])): ?>
                                <br><span class="text-sm text-muted"><?= e($u['nom_cabinet']) ?></span>
                            <?php endif; ?>
                        </td>
                        <td class="text-muted"><?= e($u['username']) ?></td>
                        <td class="text-muted"><?= e($u['email'] ?: '-') ?></td>
                        <td>
                            <span class="badge <?= $u['role'] === 'admin' ? 'badge-sage' : 'badge-secondary' ?>">
                                <?= $u['role'] === 'admin' ? 'Admin' : 'Praticien' ?>
                            </span>
                        </td>
                        <td><?= (int) $u['nb_clients'] ?></td>
                        <td>
                            <span class="badge <?= $u['actif'] ? 'badge-success' : 'badge-danger' ?>">
                                <?= $u['actif'] ? 'Actif' : 'Désactivé' ?>
                            </span>
                        </td>
                        <td class="actions">
                            <a href="<?= url('admin-user-edit', ['id' => $u['id']]) ?>" class="btn btn-outline btn-sm">Modifier</a>
                            <?php if ($u['id'] != currentUserId()): ?>
                            <form method="POST" style="display:inline;" onsubmit="return confirm('<?= $u['actif'] ? 'Désactiver' : 'Réactiver' ?> ce compte ?');">
                                <input type="hidden" name="action" value="admin-user-toggle">
                                <input type="hidden" name="user_id" value="<?= $u['id'] ?>">
                                <button type="submit" class="btn btn-sm" style="background:<?= $u['actif'] ? '#fee' : '#e8f5ea' ?>;color:<?= $u['actif'] ? '#d85a3d' : '#2e7d32' ?>;border:1px solid <?= $u['actif'] ? '#f5c5b8' : '#c9e5c9' ?>;">
                                    <?= $u['actif'] ? 'Désactiver' : 'Réactiver' ?>
                                </button>
                            </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
