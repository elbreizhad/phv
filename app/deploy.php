<?php
/**
 * Script de déploiement.
 * Utilisation : appeler cette URL avec la bonne clé pour mettre à jour le site
 * depuis GitHub, ex: https://tonsite.com/deploy.php?key=CHANGE_MOI
 *
 * La configuration (clé, dépôt, token) est dans config/deploy-config.php,
 * qui n'est jamais écrasé par un déploiement.
 */

require __DIR__ . '/config/deploy-config.php';
require __DIR__ . '/includes/deploy-logic.php';

header('Content-Type: text/plain; charset=utf-8');

$providedKey = $_GET['key'] ?? '';
if (!hash_equals(DEPLOY_KEY, $providedKey)) {
    http_response_code(403);
    exit("Accès refusé.\n");
}

try {
    foreach (runSiteDeploy() as $line) {
        echo $line . "\n";
    }
} catch (Throwable $e) {
    http_response_code(500);
    echo "Erreur : " . $e->getMessage() . "\n";
}
