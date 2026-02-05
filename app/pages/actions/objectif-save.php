<?php
/**
 * Action: Sauvegarder ou modifier un objectif
 */
$db = getDB();
$userId = currentUserId();

$objectifId = (int)getPost('objectif_id');
$clientId = (int)getPost('client_id');
$titre = getPost('titre');
$description = getPost('description');
$typeObjectif = getPost('type_objectif', 'autre');
$valeurInitiale = getPost('valeur_initiale');
$valeurCible = getPost('valeur_cible');
$dateCible = getPost('date_cible') ?: null;
$progression = getPost('progression');
$statut = getPost('statut');

// Vérifier que le client appartient au praticien
$clientStmt = $db->prepare("SELECT id FROM clients WHERE id = ? AND user_id = ?");
$clientStmt->execute([$clientId, $userId]);
if (!$clientStmt->fetch()) {
    flashSet('error', 'Client invalide.');
    redirect('clients');
}

if ($objectifId) {
    // Modification
    if ($statut) {
        // Changement de statut
        $stmt = $db->prepare("UPDATE client_objectifs SET statut = ?, progression = CASE WHEN ? = 'atteint' THEN 100 ELSE progression END WHERE id = ? AND client_id = ?");
        $stmt->execute([$statut, $statut, $objectifId, $clientId]);
        flashSet('success', 'Objectif mis à jour.');
    } elseif ($progression !== '') {
        // Mise à jour progression
        $stmt = $db->prepare("UPDATE client_objectifs SET progression = ? WHERE id = ? AND client_id = ?");
        $stmt->execute([$progression, $objectifId, $clientId]);
        flashSet('success', 'Progression mise à jour.');
    }
} else {
    // Création
    $stmt = $db->prepare("
        INSERT INTO client_objectifs (client_id, titre, description, type_objectif, valeur_initiale, valeur_cible, date_debut, date_cible)
        VALUES (?, ?, ?, ?, ?, ?, CURDATE(), ?)
    ");
    $stmt->execute([$clientId, $titre, $description, $typeObjectif, $valeurInitiale, $valeurCible, $dateCible]);
    flashSet('success', 'Objectif créé avec succès.');
}

redirect('client-objectifs', ['id' => $clientId]);
