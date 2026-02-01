<?php
$db = getDB();
$userId = currentUserId();

$clientId = (int) getPost('client_id');
$motif = getPost('motif');
$motifCategorie = getPost('motif_categorie');
$typeSeance = getPost('type_seance');
$dateConsultation = getPost('date_consultation');

$stmt = $db->prepare("INSERT INTO consultations (client_id, user_id, motif, motif_categorie, date_consultation, type_seance, statut, current_step) VALUES (?, ?, ?, ?, ?, ?, 'en_cours', 1)");
$stmt->execute([$clientId, $userId, $motif, $motifCategorie, $dateConsultation, $typeSeance]);
$consultId = $db->lastInsertId();

flashSet('success', 'Consultation créée. Remplissez le questionnaire étape par étape.');
redirect('consultation-step1', ['id' => $consultId]);
