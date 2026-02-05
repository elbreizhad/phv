<?php
/**
 * Action: Marquer une facture comme payée
 */
$db = getDB();
$userId = currentUserId();

$factureId = (int)getPost('facture_id');
$modePaiement = getPost('mode_paiement', 'especes');
$datePaiement = getPost('date_paiement', date('Y-m-d'));
$reference = getPost('reference_paiement', '');

$stmt = $db->prepare("
    UPDATE factures
    SET statut = 'payee', mode_paiement = COALESCE(?, mode_paiement), date_paiement = ?, reference_paiement = ?
    WHERE id = ? AND user_id = ?
");
$stmt->execute([$modePaiement, $datePaiement, $reference, $factureId, $userId]);

flashSet('success', 'Facture marquée comme payée.');
redirect('factures');
