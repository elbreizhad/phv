<?php
$db = getDB();
$userId = currentUserId();

$clientId = (int) getPost('client_id');
$motif = getPost('motif');
$motifCategorie = getPost('motif_categorie');
$typeSeance = getPost('type_seance');
$dateConsultation = getPost('date_consultation');

// Déterminer la version de trame selon les paramètres utilisateur
// (résilient si la migration SQL n'a pas encore été jouée)
$useV2 = false;
try {
    $settingsStmt = $db->prepare("SELECT trame_v2_enabled FROM user_settings WHERE user_id = ?");
    $settingsStmt->execute([$userId]);
    $useV2 = (bool) ($settingsStmt->fetchColumn() ?: false);
} catch (PDOException $e) {
    // Colonne absente -> migration pas encore exécutée, on reste en V1
    $useV2 = false;
}
$trameVersion = $useV2 ? 'v2' : 'v1';

try {
    $stmt = $db->prepare("INSERT INTO consultations (client_id, user_id, motif, motif_categorie, date_consultation, type_seance, trame_version, statut, current_step) VALUES (?, ?, ?, ?, ?, ?, ?, 'en_cours', 1)");
    $stmt->execute([$clientId, $userId, $motif, $motifCategorie, $dateConsultation, $typeSeance, $trameVersion]);
} catch (PDOException $e) {
    // Si la colonne trame_version n'existe pas, insertion sans
    $stmt = $db->prepare("INSERT INTO consultations (client_id, user_id, motif, motif_categorie, date_consultation, type_seance, statut, current_step) VALUES (?, ?, ?, ?, ?, ?, 'en_cours', 1)");
    $stmt->execute([$clientId, $userId, $motif, $motifCategorie, $dateConsultation, $typeSeance]);
}
$consultId = $db->lastInsertId();

flashSet('success', 'Consultation créée. Remplissez le questionnaire étape par étape.');
if ($useV2) {
    redirect('consultation-v2', ['id' => $consultId, 'step' => 1]);
} else {
    redirect('consultation-step1', ['id' => $consultId]);
}
