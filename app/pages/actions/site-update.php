<?php
/**
 * Action: Actualiser le site depuis GitHub (bouton Paramètres)
 */

$deployConfigFile = __DIR__ . '/../../config/deploy-config.php';

if (!file_exists($deployConfigFile)) {
    flashSet('error', "Le déploiement n'est pas configuré sur ce serveur (config/deploy-config.php manquant).");
    redirect('parametres');
}

require_once $deployConfigFile;
require_once __DIR__ . '/../../includes/deploy-logic.php';

try {
    $log = runSiteDeploy();
    flashSet('success', implode("\n", $log));
} catch (Throwable $e) {
    flashSet('error', "Échec de l'actualisation : " . $e->getMessage());
}

redirect('parametres');
