<?php
/**
 * Configuration du déploiement automatique depuis GitHub.
 * Ce fichier n'est jamais écrasé par un déploiement (voir deploy-logic.php).
 */

define('DEPLOY_KEY', 'CHANGE_MOI_PAR_UNE_CLE_SECRETE_LONGUE');
define('GITHUB_REPO', 'elbreizhad/phv');
define('GITHUB_BRANCH', 'main');
// Dépôt privé : jeton d'accès GitHub (Settings > Developer settings > Personal access tokens,
// droit "repo" en lecture suffit).
define('GITHUB_TOKEN', 'CHANGE_MOI_PAR_TON_TOKEN_GITHUB');
