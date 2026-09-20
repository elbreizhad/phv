<?php
/**
 * Action: Actualiser le site depuis GitHub (bouton Paramètres)
 * Réutilise les fonctions de deploy.php (chargées sans exécuter sa logique
 * de vérification de clé, réservée à l'appel direct de ce fichier).
 */

$deployScript = dirname(__DIR__, 2) . '/deploy.php';

if (!file_exists($deployScript)) {
    flashSet('error', "Le déploiement n'est pas configuré sur ce serveur (deploy.php manquant).");
    redirect('parametres');
}

require_once $deployScript;

try {
    $log = deployRun(dirname(__DIR__, 2));
    flashSet('success', implode("\n", $log));
} catch (Throwable $e) {
    flashSet('error', "Échec de l'actualisation : " . $e->getMessage());
}

redirect('parametres');
