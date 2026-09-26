<?php
$db = getDB();
$userId = currentUserId();

$search = getGet('search');
$statutFiltre = getGet('statut');

$sql = "
    SELECT c.*, cl.nom AS client_nom, cl.prenom AS client_prenom,
        CASE WHEN c.trame_version = 'v2'
             OR EXISTS (SELECT 1 FROM consultation_reponses r WHERE r.consultation_id = c.id AND r.section LIKE 'v2_step%')
        THEN 'v2' ELSE 'v1' END AS resolved_trame
    FROM consultations c
    JOIN clients cl ON c.client_id = cl.id
    WHERE c.user_id = ?
";
$params = [$userId];

if ($search) {
    $sql .= " AND (cl.nom LIKE ? OR cl.prenom LIKE ? OR c.motif LIKE ?)";
    $like = "%$search%";
    $params[] = $like;
    $params[] = $like;
    $params[] = $like;
}
if ($statutFiltre) {
    $sql .= " AND c.statut = ?";
    $params[] = $statutFiltre;
}
$sql .= " ORDER BY c.updated_at DESC";

try {
    $stmt = $db->prepare($sql);
    $stmt->execute($params);
    $consultations = $stmt->fetchAll();
} catch (PDOException $e) {
    $fallback = $db->prepare("SELECT c.*, cl.nom AS client_nom, cl.prenom AS client_prenom, 'v1' AS resolved_trame FROM consultations c JOIN clients cl ON c.client_id = cl.id WHERE c.user_id = ? ORDER BY c.updated_at DESC");
    $fallback->execute([$userId]);
    $consultations = $fallback->fetchAll();
}
?>

<div class="page-header">
    <div>
        <h1>Consultations</h1>
        <p class="subtitle"><?= count($consultations) ?> consultation<?= count($consultations) > 1 ? 's' : '' ?></p>
    </div>
    <a href="<?= url('clients') ?>" class="btn btn-primary">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Nouvelle consultation
    </a>
</div>

<div class="page-body animate-in">
    <!-- Recherche / filtres -->
    <div class="card mb-3">
        <div class="card-body" style="padding: 0.8rem 1.5rem;">
            <form method="GET" action="<?= APP_URL ?>/index.php" style="display:flex;gap:0.8rem;align-items:center;flex-wrap:wrap;">
                <input type="hidden" name="page" value="consultations">
                <input type="text" name="search" class="form-control" placeholder="Rechercher un client ou un motif..." value="<?= e($search) ?>" style="max-width: 300px;">
                <select name="statut" class="form-control" style="max-width: 200px;">
                    <option value="">Tous les statuts</option>
                    <option value="questionnaire" <?= $statutFiltre === 'questionnaire' ? 'selected' : '' ?>>Questionnaire</option>
                    <option value="en_cours" <?= $statutFiltre === 'en_cours' ? 'selected' : '' ?>>En cours</option>
                    <option value="synthese" <?= $statutFiltre === 'synthese' ? 'selected' : '' ?>>Synthèse</option>
                    <option value="phv" <?= $statutFiltre === 'phv' ? 'selected' : '' ?>>PHV</option>
                    <option value="terminee" <?= $statutFiltre === 'terminee' ? 'selected' : '' ?>>Terminée</option>
                </select>
                <button type="submit" class="btn btn-outline btn-sm">Filtrer</button>
                <?php if ($search || $statutFiltre): ?>
                    <a href="<?= url('consultations') ?>" class="btn btn-secondary btn-sm">Effacer</a>
                <?php endif; ?>
            </form>
        </div>
    </div>

    <!-- Liste -->
    <div class="card">
        <div class="card-body" style="padding:0;">
            <?php if (empty($consultations)): ?>
                <div class="empty-state">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                    <h3>Aucune consultation</h3>
                    <p>Commencez une consultation depuis la fiche d'un client.</p>
                    <a href="<?= url('clients') ?>" class="btn btn-primary">Voir les clients</a>
                </div>
            <?php else: ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Client</th>
                            <th>Motif</th>
                            <th>Statut</th>
                            <th>Mis à jour</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($consultations as $c):
                        $stepPage = 'consultation-step' . $c['current_step'];
                        $statusBadge = match($c['statut']) {
                            'terminee' => 'badge-success',
                            'en_cours', 'questionnaire' => 'badge-warning',
                            'synthese' => 'badge-info',
                            'phv' => 'badge-sage',
                            default => 'badge-warning',
                        };
                        $statusLabel = match($c['statut']) {
                            'terminee' => 'Terminée',
                            'en_cours' => 'En cours',
                            'questionnaire' => 'Questionnaire',
                            'synthese' => 'Synthèse',
                            'phv' => 'PHV',
                            default => $c['statut'],
                        };
                        $isV2 = ($c['resolved_trame'] ?? 'v1') === 'v2';
                        if ($isV2) {
                            if ($c['statut'] === 'phv' || $c['statut'] === 'terminee') {
                                $continueUrl = url('consultation-step6', ['id' => $c['id']]);
                            } else {
                                $continueUrl = url('consultation-v2', ['id' => $c['id'], 'step' => max(1, min(15, (int)$c['current_step']))]);
                            }
                        } else {
                            $continueUrl = url($stepPage, ['id' => $c['id']]);
                        }
                    ?>
                        <tr>
                            <td>
                                <strong><a href="<?= url('client-view', ['id' => $c['client_id']]) ?>"><?= e($c['client_prenom'] . ' ' . $c['client_nom']) ?></a></strong>
                            </td>
                            <td class="text-sm text-muted"><?= e(mb_strimwidth($c['motif'] ?? '', 0, 50, '...')) ?></td>
                            <td><span class="badge <?= $statusBadge ?>"><?= $statusLabel ?></span></td>
                            <td class="text-sm text-muted"><?= timeAgo($c['updated_at']) ?></td>
                            <td class="actions">
                                <a href="<?= $continueUrl ?>" class="btn btn-outline btn-sm">Continuer</a>
                                <form method="POST" action="<?= url('consultations') ?>" style="display:inline;" onsubmit="return confirm('Supprimer cette consultation ?');">
                                    <input type="hidden" name="action" value="consultation-delete">
                                    <input type="hidden" name="consultation_id" value="<?= $c['id'] ?>">
                                    <input type="hidden" name="return_to" value="consultations">
                                    <button type="submit" class="btn btn-sm" style="background:#fee;color:#d85a3d;border:1px solid #f5c5b8;" title="Supprimer">🗑</button>
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
