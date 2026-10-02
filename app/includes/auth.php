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
    // Résilient si la migration (role/actif) n'a pas encore été jouée.
    try {
        $stmt = $db->prepare('SELECT id, username, password_hash, nom, prenom, role, actif FROM users WHERE username = ?');
        $stmt->execute([$username]);
    } catch (PDOException $e) {
        $stmt = $db->prepare('SELECT id, username, password_hash, nom, prenom FROM users WHERE username = ?');
        $stmt->execute([$username]);
    }
    $user = $stmt->fetch();

    if (!$user || !password_verify($password, $user['password_hash'])) {
        return false;
    }
    if (isset($user['actif']) && !$user['actif']) {
        return false;
    }

    // Empêche la réutilisation d'un identifiant de session pré-connexion.
    session_regenerate_id(true);

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_nom'] = $user['nom'];
    $_SESSION['user_prenom'] = $user['prenom'];
    $_SESSION['user_username'] = $user['username'];
    $_SESSION['user_role'] = $user['role'] ?? 'praticien';
    return true;
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
    // Un compte désactivé par un administrateur perd l'accès immédiatement,
    // pas seulement à la prochaine tentative de connexion.
    try {
        $stmt = getDB()->prepare('SELECT actif FROM users WHERE id = ?');
        $stmt->execute([currentUserId()]);
        $actif = $stmt->fetchColumn();
        if ($actif === false || (int) $actif === 0) {
            logout();
            header('Location: ' . APP_URL . '/index.php?page=login');
            exit;
        }
    } catch (PDOException $e) {
        // Colonne pas encore migrée : on laisse passer.
    }
}

function currentUserId(): int {
    return (int) ($_SESSION['user_id'] ?? 0);
}

function currentUserName(): string {
    return ($_SESSION['user_prenom'] ?? '') . ' ' . ($_SESSION['user_nom'] ?? '');
}

function isAdmin(): bool {
    return ($_SESSION['user_role'] ?? 'praticien') === 'admin';
}

function requireAdmin(): void {
    requireAuth();
    if (!isAdmin()) {
        header('Location: ' . APP_URL . '/index.php?page=dashboard');
        exit;
    }
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
