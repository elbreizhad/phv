<?php
$db = getDB();
$userId = currentUserId();
$consultId = (int) getPost('consultation_id');

$stmt = $db->prepare("SELECT * FROM consultations WHERE id = ? AND user_id = ?");
$stmt->execute([$consultId, $userId]);
if (!$stmt->fetch()) { redirect('dashboard'); }

$data = [
    'priorite_1' => getPost('priorite_1'),
    'priorite_2' => getPost('priorite_2'),
    'priorite_3' => getPost('priorite_3'),
    'observations' => getPost('observations'),
];

// Vérifier si une synthèse existe déjà
$check = $db->prepare("SELECT id FROM consultation_synthese WHERE consultation_id = ?");
$check->execute([$consultId]);

if ($check->fetch()) {
    $stmt = $db->prepare("UPDATE consultation_synthese SET priorite_1 = ?, priorite_2 = ?, priorite_3 = ?, observations = ?, updated_at = NOW() WHERE consultation_id = ?");
    $stmt->execute([$data['priorite_1'], $data['priorite_2'], $data['priorite_3'], $data['observations'], $consultId]);
} else {
    $stmt = $db->prepare("INSERT INTO consultation_synthese (consultation_id, priorite_1, priorite_2, priorite_3, observations) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$consultId, $data['priorite_1'], $data['priorite_2'], $data['priorite_3'], $data['observations']]);
}

// Mettre à jour la consultation
$db->prepare("UPDATE consultations SET current_step = 6, statut = 'phv', updated_at = NOW() WHERE id = ?")->execute([$consultId]);

redirect('consultation-step6', ['id' => $consultId]);
