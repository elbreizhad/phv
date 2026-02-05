<?php
/**
 * Action: Sauvegarder un rendez-vous
 */
$db = getDB();
$userId = currentUserId();

$rdvId = (int)getPost('rdv_id');
$clientId = getPost('client_id') ?: null;
$typeRdv = getPost('type_rdv', 'premiere_consultation');
$titre = getPost('titre') ?: (RDV_TYPES[$typeRdv]['label'] ?? 'Rendez-vous');
$dateRdv = getPost('date_rdv');
$heureDebut = getPost('heure_debut');
$heureFin = getPost('heure_fin');
$dureeMinutes = (int)getPost('duree_minutes', 60);
$tarif = getPost('tarif') ?: null;
$notes = getPost('notes');
$couleur = RDV_TYPES[$typeRdv]['couleur'] ?? '#4a6741';

// Si client sélectionné, utiliser son nom comme titre
if ($clientId) {
    $clientStmt = $db->prepare("SELECT nom, prenom FROM clients WHERE id = ? AND user_id = ?");
    $clientStmt->execute([$clientId, $userId]);
    $client = $clientStmt->fetch();
    if ($client) {
        $titre = $client['prenom'] . ' ' . $client['nom'];
    }
}

// Calcul heure fin si pas fournie
if (!$heureFin && $heureDebut && $dureeMinutes) {
    $debut = strtotime($heureDebut);
    $fin = $debut + ($dureeMinutes * 60);
    $heureFin = date('H:i', $fin);
}

if ($rdvId) {
    // Mise à jour
    $stmt = $db->prepare("
        UPDATE rendez_vous SET
            client_id = ?, titre = ?, type_rdv = ?, date_rdv = ?,
            heure_debut = ?, heure_fin = ?, duree_minutes = ?,
            tarif = ?, notes = ?, couleur = ?, updated_at = NOW()
        WHERE id = ? AND user_id = ?
    ");
    $stmt->execute([
        $clientId, $titre, $typeRdv, $dateRdv,
        $heureDebut, $heureFin, $dureeMinutes,
        $tarif, $notes, $couleur, $rdvId, $userId
    ]);
    flashSet('success', 'Rendez-vous modifié avec succès.');
} else {
    // Création
    $stmt = $db->prepare("
        INSERT INTO rendez_vous (user_id, client_id, titre, type_rdv, date_rdv, heure_debut, heure_fin, duree_minutes, tarif, notes, couleur)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt->execute([
        $userId, $clientId, $titre, $typeRdv, $dateRdv,
        $heureDebut, $heureFin, $dureeMinutes, $tarif, $notes, $couleur
    ]);
    flashSet('success', 'Rendez-vous créé avec succès.');
}

redirect('agenda', ['date' => $dateRdv]);
