<?php
/**
 * Action: Sauvegarder une prestation
 */
$db = getDB();
$userId = currentUserId();

$prestationId = (int)getPost('prestation_id');
$nom = getPost('nom');
$description = getPost('description');
$dureeMinutes = (int)getPost('duree_minutes', 60);
$tarif = (float)getPost('tarif');

if ($prestationId) {
    // Vérifier propriété
    $checkStmt = $db->prepare("SELECT id FROM prestations WHERE id = ? AND user_id = ?");
    $checkStmt->execute([$prestationId, $userId]);
    if (!$checkStmt->fetch()) {
        flashSet('error', 'Prestation non trouvée.');
        redirect('parametres');
    }

    $stmt = $db->prepare("UPDATE prestations SET nom = ?, description = ?, duree_minutes = ?, tarif = ? WHERE id = ? AND user_id = ?");
    $stmt->execute([$nom, $description, $dureeMinutes, $tarif, $prestationId, $userId]);
    flashSet('success', 'Prestation modifiée.');
} else {
    $stmt = $db->prepare("INSERT INTO prestations (user_id, nom, description, duree_minutes, tarif) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$userId, $nom, $description, $dureeMinutes, $tarif]);
    flashSet('success', 'Prestation créée.');
}

redirect('parametres');
