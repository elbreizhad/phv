<?php
/**
 * Page d'installation - Crée les tables et l'utilisateur par défaut
 * À exécuter une seule fois puis supprimer ou désactiver
 */
require_once __DIR__ . '/../config/database.php';

$messages = [];

try {
    $db = getDB();

    // Lire et exécuter le schéma SQL
    $sql = file_get_contents(__DIR__ . '/../sql/schema.sql');

    // Séparer les requêtes
    $statements = array_filter(array_map('trim', explode(';', $sql)));

    foreach ($statements as $stmt) {
        if (!empty($stmt) && stripos($stmt, 'INSERT INTO users') === false) {
            $db->exec($stmt);
        }
    }

    // Créer l'utilisateur par défaut avec mot de passe hashé
    $hash = password_hash('naturo2026', PASSWORD_DEFAULT);
    $check = $db->query("SELECT COUNT(*) FROM users WHERE username = 'praticien'")->fetchColumn();
    if ($check == 0) {
        $stmt = $db->prepare("INSERT INTO users (username, password_hash, nom, prenom, email) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute(['praticien', $hash, 'Praticien', 'PHV', 'praticien@phv.fr']);
        $messages[] = ['success', 'Utilisateur par defaut cree : praticien / naturo2026'];
    } else {
        $messages[] = ['info', 'Utilisateur "praticien" existe deja.'];
    }

    // Insérer les fiches pathologies
    require_once __DIR__ . '/../data/fiches-pathologies.php';
    $fichesCount = insertFichesPathologies($db);
    $messages[] = ['success', $fichesCount . ' fiches pathologies inserees.'];

    $messages[] = ['success', 'Installation terminee avec succes !'];
} catch (Exception $e) {
    $messages[] = ['error', 'Erreur : ' . $e->getMessage()];
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Installation - <?= APP_NAME ?></title>
    <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/style.css">
</head>
<body>
<div class="login-page">
    <div class="login-card animate-in" style="max-width: 520px;">
        <div class="brand">
            <h1>Installation PHV Naturo</h1>
            <div class="leaf-accent"></div>
        </div>

        <?php foreach ($messages as [$type, $msg]): ?>
            <div class="alert alert-<?= $type ?>"><?= e($msg) ?></div>
        <?php endforeach; ?>

        <a href="<?= url('login') ?>" class="btn btn-primary btn-block btn-lg" style="margin-top: 1rem;">
            Aller a la page de connexion
        </a>
    </div>
</div>
</body>
</html>
