<?php
/**
 * Suppression d'une consultation (cascade sur reponses, synthese, phv).
 */
$db = getDB();
$userId = currentUserId();
$consultId = (int) getPost('consultation_id');
$returnTo = getPost('return_to', 'dashboard');

if (!$consultId) { redirect('dashboard'); }

$stmt = $db->prepare('SELECT id, client_id FROM consultations WHERE id = ? AND user_id = ?');
$stmt->execute([$consultId, $userId]);
$consult = $stmt->fetch();
if (!$consult) { redirect('dashboard'); }

$db->prepare('DELETE FROM consultations WHERE id = ? AND user_id = ?')->execute([$consultId, $userId]);

flashSet('success', 'Consultation supprimée.');

if ($returnTo === 'client-view') {
    redirect('client-view', ['id' => $consult['client_id']]);
} else {
    redirect($returnTo);
}
