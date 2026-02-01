<?php
// Redirige vers l'étape courante de la consultation
$db = getDB();
$consultId = (int) getGet('id');
$userId = currentUserId();

$stmt = $db->prepare("SELECT current_step FROM consultations WHERE id = ? AND user_id = ?");
$stmt->execute([$consultId, $userId]);
$c = $stmt->fetch();

if ($c) {
    redirect('consultation-step' . $c['current_step'], ['id' => $consultId]);
} else {
    redirect('dashboard');
}
