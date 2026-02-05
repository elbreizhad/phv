<?php
/**
 * API: Sauvegarder les notes d'un RDV (AJAX)
 */
header('Content-Type: application/json');

if (!isLoggedIn()) {
    echo json_encode(['success' => false, 'error' => 'Non authentifié']);
    exit;
}

$rdvId = (int)($_POST['rdv_id'] ?? 0);
$notes = $_POST['notes'] ?? '';

if (!$rdvId) {
    echo json_encode(['success' => false, 'error' => 'ID RDV manquant']);
    exit;
}

$db = getDB();
$userId = currentUserId();

$stmt = $db->prepare("UPDATE rendez_vous SET notes = ?, updated_at = NOW() WHERE id = ? AND user_id = ?");
$stmt->execute([$notes, $rdvId, $userId]);

echo json_encode(['success' => true]);
