<?php
/**
 * Vue détaillée d'une facture
 */
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
    flashSet('error', 'Facture non trouvée.');
    redirect('factures');
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

<div class="page-header">
    <div>
        <h1>Facture <?= e($facture['numero_facture']) ?></h1>
        <p class="subtitle">
            <span class="badge <?= FACTURE_STATUTS[$facture['statut']]['badge'] ?? 'badge-info' ?>">
                <?= FACTURE_STATUTS[$facture['statut']]['label'] ?? $facture['statut'] ?>
            </span>
        </p>
    </div>
    <div class="d-flex gap-1">
        <a href="<?= url('factures') ?>" class="btn btn-secondary">Retour</a>
        <a href="<?= url('facture-export', ['id' => $factureId]) ?>" class="btn btn-outline" target="_blank">Imprimer / PDF</a>
        <?php if ($facture['statut'] === 'envoyee'): ?>
            <form method="POST" style="display: inline;">
                <input type="hidden" name="action" value="facture-payer">
                <input type="hidden" name="facture_id" value="<?= $factureId ?>">
                <button type="submit" class="btn btn-success">Encaisser</button>
            </form>
        <?php endif; ?>
    </div>
</div>

<div class="page-body animate-in">
    <div class="card">
        <div class="card-body">
            <!-- En-tête facture -->
            <div class="facture-header" style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
                <div class="facture-from">
                    <h4 style="color: var(--sage-700); margin-bottom: 0.5rem;"><?= e($settings['nom_cabinet'] ?? 'Cabinet de Naturopathie') ?></h4>
                    <p class="text-sm text-muted">
                        <?= e($praticien['prenom'] . ' ' . $praticien['nom']) ?><br>
                        <?= nl2br(e($settings['adresse_cabinet'] ?? $praticien['adresse'] ?? '')) ?><br>
                        <?php if ($praticien['telephone']): ?>Tel: <?= e($praticien['telephone']) ?><br><?php endif; ?>
                        <?php if ($praticien['email']): ?>Email: <?= e($praticien['email']) ?><br><?php endif; ?>
                        <?php if ($praticien['siret']): ?>SIRET: <?= e($praticien['siret']) ?><?php endif; ?>
                    </p>
                </div>
                <div class="facture-to" style="text-align: right;">
                    <h4 style="color: var(--text-muted); margin-bottom: 0.5rem;">Facturé à</h4>
                    <p>
                        <strong><?= e($facture['client_prenom'] . ' ' . $facture['client_nom']) ?></strong><br>
                        <?php if ($facture['client_adresse']): ?><?= nl2br(e($facture['client_adresse'])) ?><br><?php endif; ?>
                        <?php if ($facture['client_email']): ?><?= e($facture['client_email']) ?><br><?php endif; ?>
                        <?php if ($facture['client_tel']): ?><?= e($facture['client_tel']) ?><?php endif; ?>
                    </p>
                </div>
            </div>

            <!-- Infos facture -->
            <div class="facture-info" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; padding: 1rem; background: var(--cream-50); border-radius: var(--radius-sm); margin-bottom: 2rem;">
                <div>
                    <span class="text-sm text-muted">N° Facture</span><br>
                    <strong><?= e($facture['numero_facture']) ?></strong>
                </div>
                <div>
                    <span class="text-sm text-muted">Date d'émission</span><br>
                    <strong><?= formatDate($facture['date_facture']) ?></strong>
                </div>
                <div>
                    <span class="text-sm text-muted">Date d'échéance</span><br>
                    <strong><?= formatDate($facture['date_echeance']) ?></strong>
                </div>
                <div>
                    <span class="text-sm text-muted">Mode de paiement</span><br>
                    <strong><?= MODES_PAIEMENT[$facture['mode_paiement']] ?? '-' ?></strong>
                </div>
            </div>

            <!-- Lignes -->
            <table class="table" style="margin-bottom: 2rem;">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th style="text-align: right;">Quantité</th>
                        <th style="text-align: right;">Prix unitaire</th>
                        <th style="text-align: right;">Montant</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($lignes as $ligne): ?>
                    <tr>
                        <td><?= e($ligne['description']) ?></td>
                        <td style="text-align: right;"><?= number_format($ligne['quantite'], 2, ',', ' ') ?></td>
                        <td style="text-align: right;"><?= number_format($ligne['prix_unitaire'], 2, ',', ' ') ?> €</td>
                        <td style="text-align: right;"><strong><?= number_format($ligne['montant'], 2, ',', ' ') ?> €</strong></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Totaux -->
            <div style="display: flex; justify-content: flex-end;">
                <div style="width: 300px;">
                    <div class="total-row" style="display: flex; justify-content: space-between; padding: 0.5rem 0;">
                        <span>Total HT</span>
                        <span><?= number_format($facture['montant_ht'], 2, ',', ' ') ?> €</span>
                    </div>
                    <?php if ($facture['montant_tva'] > 0): ?>
                    <div class="total-row" style="display: flex; justify-content: space-between; padding: 0.5rem 0;">
                        <span>TVA (<?= $facture['taux_tva'] ?>%)</span>
                        <span><?= number_format($facture['montant_tva'], 2, ',', ' ') ?> €</span>
                    </div>
                    <?php endif; ?>
                    <div class="total-row" style="display: flex; justify-content: space-between; padding: 1rem 0; border-top: 2px solid var(--sage-300); margin-top: 0.5rem; font-size: 1.3rem; font-weight: 700; color: var(--sage-700);">
                        <span>Total TTC</span>
                        <span><?= number_format($facture['montant_ttc'], 2, ',', ' ') ?> €</span>
                    </div>
                </div>
            </div>

            <?php if ($facture['statut'] === 'payee' && $facture['date_paiement']): ?>
            <div class="alert alert-success mt-2">
                <strong>Payée le <?= formatDate($facture['date_paiement']) ?></strong>
                <?php if ($facture['reference_paiement']): ?> - Réf: <?= e($facture['reference_paiement']) ?><?php endif; ?>
            </div>
            <?php endif; ?>

            <?php if ($facture['notes']): ?>
            <div style="margin-top: 2rem; padding: 1rem; background: var(--sage-50); border-radius: var(--radius-sm);">
                <strong>Notes :</strong><br>
                <?= nl2br(e($facture['notes'])) ?>
            </div>
            <?php endif; ?>

            <?php if ($facture['mentions_legales']): ?>
            <div style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid var(--cream-200); font-size: 0.8rem; color: var(--text-muted);">
                <?= nl2br(e($facture['mentions_legales'])) ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
