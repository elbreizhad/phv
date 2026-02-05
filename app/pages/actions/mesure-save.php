<?php
/**
 * Action: Sauvegarder une mesure client
 */
$db = getDB();
$userId = currentUserId();

$clientId = (int)getPost('client_id');
$dateMesure = getPost('date_mesure');
$poidsKg = getPost('poids_kg') ?: null;
$tourTaille = getPost('tour_taille_cm') ?: null;
$niveauStress = getPost('niveau_stress') ?: null;
$qualiteSommeil = getPost('qualite_sommeil') ?: null;
$niveauEnergie = getPost('niveau_energie') ?: null;
$notes = getPost('notes');

// Vérifier que le client appartient au praticien
$clientStmt = $db->prepare("SELECT id FROM clients WHERE id = ? AND user_id = ?");
$clientStmt->execute([$clientId, $userId]);
if (!$clientStmt->fetch()) {
    flashSet('error', 'Client invalide.');
    redirect('clients');
}

// Calculer l'IMC si poids et taille disponibles
$imc = null;
if ($poidsKg) {
    $clientStmt = $db->prepare("SELECT taille_cm FROM clients WHERE id = ?");
    $clientStmt->execute([$clientId]);
    $taille = $clientStmt->fetchColumn();
    if ($taille) {
        $tailleM = $taille / 100;
        $imc = round($poidsKg / ($tailleM * $tailleM), 1);
    }

    // Mettre à jour le poids dans le profil client
    $updateClient = $db->prepare("UPDATE clients SET poids_kg = ? WHERE id = ?");
    $updateClient->execute([$poidsKg, $clientId]);
}

$stmt = $db->prepare("
    INSERT INTO client_mesures (client_id, date_mesure, poids_kg, tour_taille_cm, imc, niveau_stress, qualite_sommeil, niveau_energie, notes)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
");
$stmt->execute([
    $clientId, $dateMesure, $poidsKg, $tourTaille, $imc,
    $niveauStress, $qualiteSommeil, $niveauEnergie, $notes
]);

flashSet('success', 'Mesure enregistrée avec succès.');
redirect('client-evolution', ['id' => $clientId]);
