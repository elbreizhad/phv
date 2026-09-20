<?php
/**
 * Script de déploiement.
 * Utilisation : appeler cette URL avec la bonne clé pour mettre à jour le site
 * depuis GitHub, ex: https://tonsite.com/deploy.php?key=CHANGE_MOI
 */

// ---- Configuration à adapter avant l'upload ----
define('DEPLOY_KEY', 'CHANGE_MOI_PAR_UNE_CLE_SECRETE_LONGUE');
define('GITHUB_REPO', 'elbreizhad/phv');
define('GITHUB_BRANCH', 'main');

// Dossiers/fichiers à ne jamais écraser lors du déploiement
$excludeFromOverwrite = [
    'deploy.php',
    'config/database.php',
    'exports',
];

// -------------------------------------------------

header('Content-Type: text/plain; charset=utf-8');

$providedKey = $_GET['key'] ?? '';
if (!hash_equals(DEPLOY_KEY, $providedKey)) {
    http_response_code(403);
    exit("Accès refusé.\n");
}

if (!class_exists('ZipArchive')) {
    http_response_code(500);
    exit("L'extension PHP ZipArchive est requise.\n");
}

echo "Téléchargement de la branche " . GITHUB_BRANCH . " depuis GitHub...\n";

$zipUrl = "https://github.com/" . GITHUB_REPO . "/archive/refs/heads/" . GITHUB_BRANCH . ".zip";
$tmpZip = tempnam(sys_get_temp_dir(), 'deploy_') . '.zip';

$zipContent = downloadFile($zipUrl);
if ($zipContent === false) {
    http_response_code(500);
    exit("Échec du téléchargement depuis GitHub.\n");
}
file_put_contents($tmpZip, $zipContent);

echo "Extraction de l'archive...\n";

$tmpDir = sys_get_temp_dir() . '/deploy_extract_' . uniqid();
mkdir($tmpDir);

$zip = new ZipArchive();
if ($zip->open($tmpZip) !== true) {
    http_response_code(500);
    exit("Échec de l'ouverture de l'archive ZIP.\n");
}
$zip->extractTo($tmpDir);
$zip->close();
unlink($tmpZip);

// GitHub extrait dans un sous-dossier du type "phv-main"
$extractedFolders = glob($tmpDir . '/*', GLOB_ONLYDIR);
if (empty($extractedFolders)) {
    http_response_code(500);
    exit("Dossier extrait introuvable.\n");
}
$sourceDir = $extractedFolders[0] . '/app';
if (!is_dir($sourceDir)) {
    http_response_code(500);
    exit("Le dossier 'app' est introuvable dans l'archive.\n");
}

$targetDir = __DIR__;

echo "Copie des fichiers vers $targetDir...\n";
copyRecursive($sourceDir, $targetDir, $excludeFromOverwrite);

deleteRecursive($tmpDir);

echo "Déploiement terminé avec succès.\n";

// ---- Fonctions utilitaires ----

function downloadFile(string $url)
{
    if (function_exists('curl_init')) {
        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_USERAGENT => 'php-deploy-script',
            CURLOPT_TIMEOUT => 120,
        ]);
        $content = curl_exec($ch);
        $ok = $content !== false && curl_getinfo($ch, CURLINFO_HTTP_CODE) === 200;
        curl_close($ch);
        return $ok ? $content : false;
    }

    return @file_get_contents($url);
}

function copyRecursive(string $source, string $target, array $excludeFromOverwrite, string $relative = '')
{
    if (!is_dir($target)) {
        mkdir($target, 0755, true);
    }

    foreach (scandir($source) as $item) {
        if ($item === '.' || $item === '..') {
            continue;
        }

        $relPath = $relative === '' ? $item : $relative . '/' . $item;
        if (in_array($relPath, $excludeFromOverwrite, true)) {
            continue;
        }

        $srcPath = $source . '/' . $item;
        $dstPath = $target . '/' . $item;

        if (is_dir($srcPath)) {
            copyRecursive($srcPath, $dstPath, $excludeFromOverwrite, $relPath);
        } else {
            copy($srcPath, $dstPath);
        }
    }
}

function deleteRecursive(string $dir)
{
    if (!is_dir($dir)) {
        return;
    }
    foreach (scandir($dir) as $item) {
        if ($item === '.' || $item === '..') {
            continue;
        }
        $path = $dir . '/' . $item;
        is_dir($path) ? deleteRecursive($path) : unlink($path);
    }
    rmdir($dir);
}
