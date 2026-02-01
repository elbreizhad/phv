<?php
/**
 * Système d'authentification simple
 */

function initSession(): void {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

function login(string $username, string $password): bool {
    $db = getDB();
    $stmt = $db->prepare('SELECT id, username, password_hash, nom, prenom FROM users WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_nom'] = $user['nom'];
        $_SESSION['user_prenom'] = $user['prenom'];
        $_SESSION['user_username'] = $user['username'];
        return true;
    }
    return false;
}

function logout(): void {
    session_destroy();
}

function isLoggedIn(): bool {
    return isset($_SESSION['user_id']);
}

function requireAuth(): void {
    if (!isLoggedIn()) {
        header('Location: ' . APP_URL . '/index.php?page=login');
        exit;
    }
}

function currentUserId(): int {
    return (int) ($_SESSION['user_id'] ?? 0);
}

function currentUserName(): string {
    return ($_SESSION['user_prenom'] ?? '') . ' ' . ($_SESSION['user_nom'] ?? '');
}

/**
 * Créer le hash du mot de passe par défaut (à exécuter une fois)
 */
function createDefaultUser(): void {
    $db = getDB();
    $hash = password_hash('naturo2026', PASSWORD_DEFAULT);
    $stmt = $db->prepare('UPDATE users SET password_hash = ? WHERE username = ?');
    $stmt->execute([$hash, 'praticien']);
}
