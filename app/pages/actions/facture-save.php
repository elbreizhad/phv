<?php
/**
 * Action: Sauvegarder une facture
 */
$db = getDB();
$userId = currentUserId();

$clientId = (int)getPost('client_id');
$consultationId = getPost('consultation_id') ?: null;
$numeroFacture = getPost('numero_facture');
$dateFacture = getPost('date_facture');
$dateEcheance = getPost('date_echeance') ?: null;
$modePaiement = getPost('mode_paiement') ?: null;
$montantHt = (float)getPost('montant_ht');
$montantTva = (float)getPost('montant_tva');
$montantTtc = (float)getPost('montant_ttc');
$statut = getPost('statut', 'brouillon');
$notes = getPost('notes');
$mentionsLegales = getPost('mentions_legales');
$lignes = $_POST['lignes'] ?? [];

// Vérifier que le client appartient à l'utilisateur
$clientStmt = $db->prepare("SELECT id FROM clients WHERE id = ? AND user_id = ?");
$clientStmt->execute([$clientId, $userId]);
if (!$clientStmt->fetch()) {
    flashSet('error', 'Client invalide.');
    redirect('factures');
}

try {
    $db->beginTransaction();

    // Créer la facture
    $stmt = $db->prepare("
        INSERT INTO factures (user_id, client_id, consultation_id, numero_facture, date_facture, date_echeance, montant_ht, taux_tva, montant_tva, montant_ttc, statut, mode_paiement, notes, mentions_legales)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt->execute([
        $userId, $clientId, $consultationId, $numeroFacture, $dateFacture, $dateEcheance,
        $montantHt, 0, $montantTva, $montantTtc, $statut, $modePaiement, $notes, $mentionsLegales
    ]);
    $factureId = $db->lastInsertId();

    // Ajouter les lignes
    $ligneStmt = $db->prepare("INSERT INTO facture_lignes (facture_id, description, quantite, prix_unitaire, montant) VALUES (?, ?, ?, ?, ?)");
    foreach ($lignes as $ligne) {
        if (!empty($ligne['description'])) {
            $qte = (float)($ligne['quantite'] ?? 1);
            $prix = (float)($ligne['prix'] ?? 0);
            $montant = $qte * $prix;
            $ligneStmt->execute([$factureId, $ligne['description'], $qte, $prix, $montant]);
        }
    }

    $db->commit();
    flashSet('success', 'Facture créée avec succès.');
    redirect('facture-view', ['id' => $factureId]);

} catch (Exception $e) {
    $db->rollBack();
    flashSet('error', 'Erreur lors de la création de la facture.');
    redirect('facture-new');
}
