<?php
/**
 * Action admin : activer / désactiver un compte praticien
 */
$db = getDB();
$userId = (int) getPost('user_id');

if ($userId === currentUserId()) {
    flashSet('error', 'Vous ne pouvez pas désactiver votre propre compte.');
    redirect('admin-users');
}

$stmt = $db->prepare("SELECT actif FROM users WHERE id = ?");
$stmt->execute([$userId]);
$actif = $stmt->fetchColumn();

if ($actif === false) {
    flashSet('error', 'Praticien introuvable.');
    redirect('admin-users');
}

$db->prepare("UPDATE users SET actif = ? WHERE id = ?")->execute([$actif ? 0 : 1, $userId]);
flashSet('success', $actif ? 'Compte désactivé.' : 'Compte réactivé.');
redirect('admin-users');
