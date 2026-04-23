<?php
$db = getDB();
$userId = currentUserId();

$search = getGet('search');
if ($search) {
    $stmt = $db->prepare("SELECT * FROM clients WHERE user_id = ? AND (nom LIKE ? OR prenom LIKE ? OR email LIKE ?) ORDER BY nom, prenom");
    $like = "%$search%";
    $stmt->execute([$userId, $like, $like, $like]);
} else {
    $stmt = $db->prepare("SELECT * FROM clients WHERE user_id = ? ORDER BY created_at DESC");
    $stmt->execute([$userId]);
}
$clients = $stmt->fetchAll();
?>

<div class="page-header">
    <div>
        <h1>Clients</h1>
        <p class="subtitle"><?= count($clients) ?> client<?= count($clients) > 1 ? 's' : '' ?> enregistré<?= count($clients) > 1 ? 's' : '' ?></p>
    </div>
    <a href="<?= url('client-new') ?>" class="btn btn-primary">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Nouveau client
    </a>
</div>

<div class="page-body animate-in">
    <!-- Recherche -->
    <div class="card mb-3">
        <div class="card-body" style="padding: 0.8rem 1.5rem;">
            <form method="GET" action="<?= APP_URL ?>/index.php" style="display:flex;gap:0.8rem;align-items:center;">
                <input type="hidden" name="page" value="clients">
                <input type="text" name="search" class="form-control" placeholder="Rechercher un client..." value="<?= e($search) ?>" style="max-width: 350px;">
                <button type="submit" class="btn btn-outline btn-sm">Rechercher</button>
                <?php if ($search): ?>
                    <a href="<?= url('clients') ?>" class="btn btn-secondary btn-sm">Effacer</a>
                <?php endif; ?>
            </form>
        </div>
    </div>

    <!-- Liste -->
    <div class="card">
        <div class="card-body" style="padding:0;">
            <?php if (empty($clients)): ?>
                <div class="empty-state">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                    <h3>Aucun client</h3>
                    <p>Commencez par ajouter votre premier client.</p>
                    <a href="<?= url('client-new') ?>" class="btn btn-primary">Ajouter un client</a>
                </div>
            <?php else: ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Age</th>
                            <th>Profession</th>
                            <th>Telephone</th>
                            <th>Consultations</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($clients as $cl):
                        $nbC = $db->prepare("SELECT COUNT(*) FROM consultations WHERE client_id = ?");
                        $nbC->execute([$cl['id']]);
                        $nbConsult = $nbC->fetchColumn();
                    ?>
                        <tr>
                            <td>
                                <strong><?= e($cl['prenom'] . ' ' . $cl['nom']) ?></strong>
                                <?php if ($cl['email']): ?>
                                    <br><span class="text-sm text-muted"><?= e($cl['email']) ?></span>
                                <?php endif; ?>
                            </td>
                            <td><?= $cl['age'] ? $cl['age'] . ' ans' : '-' ?></td>
                            <td class="text-muted"><?= e($cl['profession'] ?: '-') ?></td>
                            <td class="text-muted"><?= e($cl['telephone'] ?: '-') ?></td>
                            <td>
                                <span class="badge badge-sage"><?= $nbConsult ?></span>
                            </td>
                            <td class="actions">
                                <a href="<?= url('client-view', ['id' => $cl['id']]) ?>" class="btn btn-outline btn-sm">Voir</a>
                                <a href="<?= url('consultation-new', ['client_id' => $cl['id']]) ?>" class="btn btn-terra btn-sm">Consultation</a>
                                <form method="POST" action="<?= url('clients') ?>" style="display:inline;" onsubmit="return confirm('Supprimer définitivement <?= e(addslashes($cl['prenom'] . ' ' . $cl['nom'])) ?> et TOUTES ses données (<?= $nbConsult ?> consultation<?= $nbConsult > 1 ? 's' : '' ?>, factures, mesures) ?\n\nCette action est irréversible.');">
                                    <input type="hidden" name="action" value="client-delete">
                                    <input type="hidden" name="client_id" value="<?= $cl['id'] ?>">
                                    <button type="submit" class="btn btn-sm" style="background:#fdecea;color:#c0392b;border:1px solid #f5b7b1;font-weight:500;" title="Supprimer le client">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>
