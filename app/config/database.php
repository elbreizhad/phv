<?php
/**
 * Configuration de la base de données
 *
 * PRODUCTION: Modifiez ces valeurs selon votre hébergeur
 */

define('DB_HOST', 'localhost');
define('DB_NAME', 'pertec_natu');       // Nom de la base
define('DB_USER', 'pertec_naturo');     // Utilisateur
define('DB_PASS', 'VOTRE_MOT_DE_PASSE'); // À modifier sur le serveur !
define('DB_CHARSET', 'utf8mb4');

function getDB(): PDO {
    static $pdo = null;
    if ($pdo === null) {
        try {
            $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;
            $pdo = new PDO($dsn, DB_USER, DB_PASS, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        } catch (PDOException $e) {
            die('Erreur de connexion : ' . $e->getMessage());
        }
    }
    return $pdo;
}
