<?php
/**
 * Liste des factures
 */
$db = getDB();
$userId = currentUserId();

// Filtres
$statut = getGet('statut', '');
$periode = getGet('periode', 'mois'); // mois, trimestre, annee, tout
$recherche = getGet('q', '');

// Construction de la requête
$where = ["f.user_id = ?"];
$params = [$userId];

if ($statut) {
    $where[] = "f.statut = ?";
    $params[] = $statut;
}

if ($recherche) {
    $where[] = "(c.nom LIKE ? OR c.prenom LIKE ? OR f.numero_facture LIKE ?)";
    $params[] = "%$recherche%";
    $params[] = "%$recherche%";
    $params[] = "%$recherche%";
}

// Période
switch ($periode) {
    case 'mois':
        $where[] = "f.date_facture >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
        break;
    case 'trimestre':
        $where[] = "f.date_facture >= DATE_SUB(CURDATE(), INTERVAL 3 MONTH)";
        break;
    case 'annee':
        $where[] = "YEAR(f.date_facture) = YEAR(CURDATE())";
        break;
}

$whereClause = implode(' AND ', $where);

$stmt = $db->prepare("
    SELECT f.*, c.nom AS client_nom, c.prenom AS client_prenom
    FROM factures f
    JOIN clients c ON f.client_id = c.id
    WHERE $whereClause
    ORDER BY f.date_facture DESC, f.id DESC
");
$stmt->execute($params);
$factures = $stmt->fetchAll();

// Statistiques
$statsStmt = $db->prepare("
    SELECT
        COUNT(*) as total,
        SUM(CASE WHEN statut = 'payee' THEN montant_ttc ELSE 0 END) as total_paye,
        SUM(CASE WHEN statut = 'envoyee' THEN montant_ttc ELSE 0 END) as total_attente,
        SUM(CASE WHEN statut = 'en_retard' THEN montant_ttc ELSE 0 END) as total_retard
    FROM factures
    WHERE user_id = ? AND YEAR(date_facture) = YEAR(CURDATE())
");
$statsStmt->execute([$userId]);
$stats = $statsStmt->fetch();

// CA mensuel
$caMoisStmt = $db->prepare("
    SELECT SUM(montant_ttc) as ca
    FROM factures
    WHERE user_id = ? AND statut = 'payee' AND MONTH(date_paiement) = MONTH(CURDATE()) AND YEAR(date_paiement) = YEAR(CURDATE())
");
$caMoisStmt->execute([$userId]);
$caMois = $caMoisStmt->fetchColumn() ?: 0;
?>

<div class="page-header">
    <div>
        <h1>Facturation</h1>
        <p class="subtitle"><?= count($factures) ?> facture(s)</p>
    </div>
    <a href="<?= url('facture-new') ?>" class="btn btn-primary">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Nouvelle facture
    </a>
</div>

<div class="page-body animate-in">
    <!-- Stats -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon green">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="22" height="22"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
            </div>
            <div class="stat-info">
                <h3><?= number_format($caMois, 2, ',', ' ') ?> €</h3>
                <p>CA ce mois</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon blue">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="22" height="22"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            </div>
            <div class="stat-info">
                <h3><?= number_format($stats['total_attente'] ?? 0, 2, ',', ' ') ?> €</h3>
                <p>En attente</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon terra">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="22" height="22"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
            </div>
            <div class="stat-info">
                <h3><?= number_format($stats['total_retard'] ?? 0, 2, ',', ' ') ?> €</h3>
                <p>En retard</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon gold">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="22" height="22"><polyline points="20 6 9 17 4 12"/></svg>
            </div>
            <div class="stat-info">
                <h3><?= number_format($stats['total_paye'] ?? 0, 2, ',', ' ') ?> €</h3>
                <p>Payé (année)</p>
            </div>
        </div>
    </div>

    <!-- Filtres -->
    <div class="card" style="margin-bottom: 1.5rem;">
        <div class="card-body">
            <form method="GET" action="<?= url('factures') ?>" class="d-flex gap-1 align-center flex-wrap">
                <input type="hidden" name="page" value="factures">
                <div class="form-group" style="margin-bottom: 0; flex: 1; min-width: 200px;">
                    <input type="text" name="q" class="form-control" placeholder="Rechercher..." value="<?= e($recherche) ?>">
                </div>
                <select name="statut" class="form-control" style="width: auto;">
                    <option value="">Tous les statuts</option>
                    <?php foreach (FACTURE_STATUTS as $key => $s): ?>
                        <option value="<?= $key ?>" <?= $statut === $key ? 'selected' : '' ?>><?= $s['label'] ?></option>
                    <?php endforeach; ?>
                </select>
                <select name="periode" class="form-control" style="width: auto;">
                    <option value="mois" <?= $periode === 'mois' ? 'selected' : '' ?>>Ce mois</option>
                    <option value="trimestre" <?= $periode === 'trimestre' ? 'selected' : '' ?>>3 derniers mois</option>
                    <option value="annee" <?= $periode === 'annee' ? 'selected' : '' ?>>Cette année</option>
                    <option value="tout" <?= $periode === 'tout' ? 'selected' : '' ?>>Tout</option>
                </select>
                <button type="submit" class="btn btn-secondary">Filtrer</button>
            </form>
        </div>
    </div>

    <!-- Liste -->
    <div class="card">
        <div class="card-body" style="padding: 0;">
            <?php if (empty($factures)): ?>
                <div class="empty-state">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                    <h3>Aucune facture</h3>
                    <p>Créez votre première facture pour commencer.</p>
                    <a href="<?= url('facture-new') ?>" class="btn btn-primary">Créer une facture</a>
                </div>
            <?php else: ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>N° Facture</th>
                            <th>Date</th>
                            <th>Client</th>
                            <th>Montant</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($factures as $f): ?>
                        <tr>
                            <td><strong><?= e($f['numero_facture']) ?></strong></td>
                            <td><?= formatDate($f['date_facture']) ?></td>
                            <td>
                                <a href="<?= url('client-view', ['id' => $f['client_id']]) ?>">
                                    <?= e($f['client_prenom'] . ' ' . $f['client_nom']) ?>
                                </a>
                            </td>
                            <td><strong><?= number_format($f['montant_ttc'], 2, ',', ' ') ?> €</strong></td>
                            <td>
                                <span class="badge <?= FACTURE_STATUTS[$f['statut']]['badge'] ?? 'badge-info' ?>">
                                    <?= FACTURE_STATUTS[$f['statut']]['label'] ?? $f['statut'] ?>
                                </span>
                            </td>
                            <td class="actions">
                                <a href="<?= url('facture-view', ['id' => $f['id']]) ?>" class="btn btn-outline btn-sm">Voir</a>
                                <?php if ($f['statut'] === 'envoyee'): ?>
                                    <form method="POST" style="display: inline;">
                                        <input type="hidden" name="action" value="facture-payer">
                                        <input type="hidden" name="facture_id" value="<?= $f['id'] ?>">
                                        <button type="submit" class="btn btn-success btn-sm">Encaisser</button>
                                    </form>
                                <?php endif; ?>
                                <a href="<?= url('facture-export', ['id' => $f['id']]) ?>" class="btn btn-secondary btn-sm" target="_blank">PDF</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>
