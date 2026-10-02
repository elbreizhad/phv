<?php
/**
 * Action admin : créer ou modifier un compte praticien
 */
$db = getDB();

$userId = (int) getPost('user_id');
$prenom = trim(getPost('prenom'));
$nom = trim(getPost('nom'));
$username = trim(getPost('username'));
$email = trim(getPost('email'));
$telephone = trim(getPost('telephone'));
$role = getPost('role') === 'admin' ? 'admin' : 'praticien';
$password = getPost('password');

if ($prenom === '' || $nom === '' || $username === '') {
    flashSet('error', 'Prénom, nom et identifiant sont obligatoires.');
    redirect('admin-user-edit', $userId ? ['id' => $userId] : []);
}

// Un administrateur ne peut pas changer son propre rôle (évite de se
// retrouver sans accès à l'admin par erreur).
if ($userId === currentUserId()) {
    $currentRoleStmt = $db->prepare("SELECT role FROM users WHERE id = ?");
    $currentRoleStmt->execute([$userId]);
    $role = $currentRoleStmt->fetchColumn() ?: $role;
}

// Identifiant unique
$dupCheck = $db->prepare("SELECT id FROM users WHERE username = ? AND id != ?");
$dupCheck->execute([$username, $userId ?: 0]);
if ($dupCheck->fetch()) {
    flashSet('error', 'Cet identifiant est déjà utilisé par un autre compte.');
    redirect('admin-user-edit', $userId ? ['id' => $userId] : []);
}

if ($userId) {
    $check = $db->prepare("SELECT id FROM users WHERE id = ?");
    $check->execute([$userId]);
    if (!$check->fetch()) {
        flashSet('error', 'Praticien introuvable.');
        redirect('admin-users');
    }

    if ($password !== '') {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $db->prepare("UPDATE users SET prenom = ?, nom = ?, username = ?, email = ?, telephone = ?, role = ?, password_hash = ? WHERE id = ?");
        $stmt->execute([$prenom, $nom, $username, $email ?: null, $telephone ?: null, $role, $hash, $userId]);
    } else {
        $stmt = $db->prepare("UPDATE users SET prenom = ?, nom = ?, username = ?, email = ?, telephone = ?, role = ? WHERE id = ?");
        $stmt->execute([$prenom, $nom, $username, $email ?: null, $telephone ?: null, $role, $userId]);
    }
    flashSet('success', 'Praticien modifié.');
} else {
    if ($password === '') {
        flashSet('error', 'Un mot de passe est requis pour créer un compte.');
        redirect('admin-user-edit');
    }
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $db->prepare("INSERT INTO users (prenom, nom, username, email, telephone, role, password_hash, actif) VALUES (?, ?, ?, ?, ?, ?, ?, 1)");
    $stmt->execute([$prenom, $nom, $username, $email ?: null, $telephone ?: null, $role, $hash]);
    flashSet('success', 'Praticien créé.');
}

redirect('admin-users');
