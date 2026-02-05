<?php
/**
 * Export PDF de facture (version imprimable)
 */
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/helpers.php';

initSession();
requireAuth();

$db = getDB();
$userId = currentUserId();
$factureId = (int)getGet('id');

// Récupérer la facture
$stmt = $db->prepare("
    SELECT f.*, c.nom AS client_nom, c.prenom AS client_prenom, c.adresse AS client_adresse, c.email AS client_email, c.telephone AS client_tel
    FROM factures f
    JOIN clients c ON f.client_id = c.id
    WHERE f.id = ? AND f.user_id = ?
");
$stmt->execute([$factureId, $userId]);
$facture = $stmt->fetch();

if (!$facture) {
    die('Facture non trouvée');
}

// Récupérer les lignes
$lignesStmt = $db->prepare("SELECT * FROM facture_lignes WHERE facture_id = ?");
$lignesStmt->execute([$factureId]);
$lignes = $lignesStmt->fetchAll();

// Paramètres praticien
$settingsStmt = $db->prepare("SELECT * FROM user_settings WHERE user_id = ?");
$settingsStmt->execute([$userId]);
$settings = $settingsStmt->fetch() ?: [];

// Info praticien
$userStmt = $db->prepare("SELECT * FROM users WHERE id = ?");
$userStmt->execute([$userId]);
$praticien = $userStmt->fetch();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture <?= e($facture['numero_facture']) ?></title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            font-size: 11pt;
            line-height: 1.5;
            color: #333;
            padding: 2cm;
            max-width: 21cm;
            margin: 0 auto;
        }
        .header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #4a6741;
        }
        .logo h1 {
            font-size: 1.5rem;
            color: #4a6741;
            margin-bottom: 0.3rem;
        }
        .logo p { font-size: 0.85rem; color: #666; }
        .facture-title {
            text-align: right;
        }
        .facture-title h2 {
            font-size: 2rem;
            color: #4a6741;
            margin-bottom: 0.5rem;
        }
        .facture-title .numero {
            font-size: 1rem;
            color: #666;
        }
        .parties {
            display: flex;
            justify-content: space-between;
            margin: 2rem 0;
        }
        .partie { width: 45%; }
        .partie h3 {
            font-size: 0.8rem;
            text-transform: uppercase;
            color: #999;
            margin-bottom: 0.5rem;
            letter-spacing: 1px;
        }
        .partie p { font-size: 0.95rem; }
        .infos {
            display: flex;
            gap: 2rem;
            padding: 1rem;
            background: #f5f5f5;
            margin: 2rem 0;
        }
        .info-item span { display: block; font-size: 0.75rem; color: #999; text-transform: uppercase; }
        .info-item strong { font-size: 0.95rem; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 2rem 0;
        }
        th {
            text-align: left;
            padding: 0.8rem;
            background: #4a6741;
            color: white;
            font-size: 0.85rem;
            text-transform: uppercase;
        }
        th:last-child, td:last-child { text-align: right; }
        th:nth-child(2), th:nth-child(3), td:nth-child(2), td:nth-child(3) { text-align: center; }
        td {
            padding: 0.8rem;
            border-bottom: 1px solid #eee;
        }
        .totaux {
            display: flex;
            justify-content: flex-end;
            margin: 2rem 0;
        }
        .totaux-table { width: 250px; }
        .totaux-row {
            display: flex;
            justify-content: space-between;
            padding: 0.5rem 0;
        }
        .totaux-row.final {
            border-top: 2px solid #4a6741;
            margin-top: 0.5rem;
            padding-top: 1rem;
            font-size: 1.2rem;
            font-weight: bold;
            color: #4a6741;
        }
        .notes {
            padding: 1rem;
            background: #f9f9f9;
            border-left: 3px solid #4a6741;
            margin: 2rem 0;
            font-size: 0.9rem;
        }
        .mentions {
            margin-top: 2rem;
            padding-top: 1rem;
            border-top: 1px solid #ddd;
            font-size: 0.8rem;
            color: #999;
        }
        .paye-stamp {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-15deg);
            font-size: 4rem;
            color: rgba(74, 155, 90, 0.15);
            font-weight: bold;
            text-transform: uppercase;
            pointer-events: none;
        }
        @media print {
            body { padding: 0; }
            @page { margin: 1.5cm; }
        }
    </style>
</head>
<body>
    <?php if ($facture['statut'] === 'payee'): ?>
    <div class="paye-stamp">PAYÉ</div>
    <?php endif; ?>

    <div class="header">
        <div class="logo">
            <h1><?= e($settings['nom_cabinet'] ?? 'Cabinet de Naturopathie') ?></h1>
            <p>
                <?= e($praticien['prenom'] . ' ' . $praticien['nom']) ?><br>
                <?= nl2br(e($settings['adresse_cabinet'] ?? $praticien['adresse'] ?? '')) ?>
                <?php if ($praticien['telephone']): ?><br>Tél: <?= e($praticien['telephone']) ?><?php endif; ?>
                <?php if ($praticien['siret']): ?><br>SIRET: <?= e($praticien['siret']) ?><?php endif; ?>
            </p>
        </div>
        <div class="facture-title">
            <h2>FACTURE</h2>
            <div class="numero"><?= e($facture['numero_facture']) ?></div>
        </div>
    </div>

    <div class="parties">
        <div class="partie"></div>
        <div class="partie">
            <h3>Facturé à</h3>
            <p>
                <strong><?= e($facture['client_prenom'] . ' ' . $facture['client_nom']) ?></strong><br>
                <?php if ($facture['client_adresse']): ?><?= nl2br(e($facture['client_adresse'])) ?><br><?php endif; ?>
                <?php if ($facture['client_email']): ?><?= e($facture['client_email']) ?><?php endif; ?>
            </p>
        </div>
    </div>

    <div class="infos">
        <div class="info-item">
            <span>Date d'émission</span>
            <strong><?= formatDate($facture['date_facture']) ?></strong>
        </div>
        <div class="info-item">
            <span>Date d'échéance</span>
            <strong><?= formatDate($facture['date_echeance']) ?></strong>
        </div>
        <?php if ($facture['statut'] === 'payee'): ?>
        <div class="info-item">
            <span>Date de paiement</span>
            <strong><?= formatDate($facture['date_paiement']) ?></strong>
        </div>
        <?php endif; ?>
    </div>

    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Montant</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($lignes as $ligne): ?>
            <tr>
                <td><?= e($ligne['description']) ?></td>
                <td><?= number_format($ligne['quantite'], 2, ',', ' ') ?></td>
                <td><?= number_format($ligne['prix_unitaire'], 2, ',', ' ') ?> €</td>
                <td><?= number_format($ligne['montant'], 2, ',', ' ') ?> €</td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <div class="totaux">
        <div class="totaux-table">
            <div class="totaux-row">
                <span>Total HT</span>
                <span><?= number_format($facture['montant_ht'], 2, ',', ' ') ?> €</span>
            </div>
            <?php if ($facture['montant_tva'] > 0): ?>
            <div class="totaux-row">
                <span>TVA (<?= $facture['taux_tva'] ?>%)</span>
                <span><?= number_format($facture['montant_tva'], 2, ',', ' ') ?> €</span>
            </div>
            <?php endif; ?>
            <div class="totaux-row final">
                <span>Total TTC</span>
                <span><?= number_format($facture['montant_ttc'], 2, ',', ' ') ?> €</span>
            </div>
        </div>
    </div>

    <?php if ($facture['notes']): ?>
    <div class="notes">
        <strong>Notes :</strong><br>
        <?= nl2br(e($facture['notes'])) ?>
    </div>
    <?php endif; ?>

    <?php if ($facture['mentions_legales']): ?>
    <div class="mentions">
        <?= nl2br(e($facture['mentions_legales'])) ?>
    </div>
    <?php endif; ?>

    <script>window.onload = function() { window.print(); }</script>
</body>
</html>
