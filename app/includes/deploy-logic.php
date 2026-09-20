<?php
/**
 * Logique partagée de déploiement depuis GitHub, utilisée à la fois par
 * deploy.php (accès public par clé secrète) et par le bouton "Actualiser le
 * site" dans les Paramètres (accès réservé aux utilisateurs connectés).
 *
 * Ce fichier EST écrasé à chaque déploiement : la configuration sensible
 * (clé, token) vit dans config/deploy-config.php, jamais ici.
 */

/**
 * Télécharge la dernière version du dépôt, l'installe par-dessus le site
 * courant et synchronise les fiches pathologies en base.
 * @return string[] Lignes de log à afficher à l'utilisateur
 * @throws RuntimeException en cas d'échec bloquant
 */
function runSiteDeploy(): array {
    $log = [];

    if (!class_exists('ZipArchive')) {
        throw new RuntimeException("L'extension PHP ZipArchive est requise.");
    }

    $log[] = "Téléchargement de la branche " . GITHUB_BRANCH . " depuis GitHub...";

    // L'API GitHub (zipball) accepte l'authentification par jeton, contrairement
    // au lien "archive/refs/heads/...zip" qui ne fonctionne que sur un dépôt public.
    $zipUrl = "https://api.github.com/repos/" . GITHUB_REPO . "/zipball/" . GITHUB_BRANCH;
    $tmpZip = tempnam(sys_get_temp_dir(), 'deploy_') . '.zip';

    $zipContent = deployDownloadFile($zipUrl, GITHUB_TOKEN);
    if ($zipContent === false) {
        throw new RuntimeException("Échec du téléchargement depuis GitHub.");
    }
    file_put_contents($tmpZip, $zipContent);

    $log[] = "Extraction de l'archive...";

    $tmpDir = sys_get_temp_dir() . '/deploy_extract_' . uniqid();
    mkdir($tmpDir);

    $zip = new ZipArchive();
    if ($zip->open($tmpZip) !== true) {
        throw new RuntimeException("Échec de l'ouverture de l'archive ZIP.");
    }
    $zip->extractTo($tmpDir);
    $zip->close();
    unlink($tmpZip);

    // GitHub extrait dans un sous-dossier du type "phv-main"
    $extractedFolders = glob($tmpDir . '/*', GLOB_ONLYDIR);
    if (empty($extractedFolders)) {
        throw new RuntimeException("Dossier extrait introuvable.");
    }
    $sourceDir = $extractedFolders[0] . '/app';
    if (!is_dir($sourceDir)) {
        throw new RuntimeException("Le dossier 'app' est introuvable dans l'archive.");
    }

    $targetDir = dirname(__DIR__);

    // Dossiers/fichiers à ne jamais écraser lors du déploiement
    $excludeFromOverwrite = [
        'config/database.php',
        'config/deploy-config.php',
        'exports',
    ];

    $log[] = "Copie des fichiers vers $targetDir...";
    deployCopyRecursive($sourceDir, $targetDir, $excludeFromOverwrite);

    deployDeleteRecursive($tmpDir);

    $log[] = "Synchronisation des fiches pathologies en base...";
    try {
        require_once __DIR__ . '/../config/database.php';
        require_once __DIR__ . '/../data/fiches-pathologies.php';
        $added = syncFichesPathologies(getDB());
        if (empty($added)) {
            $log[] = "Aucune nouvelle fiche à ajouter (déjà à jour).";
        } else {
            $log[] = "Fiches ajoutées en base (" . count($added) . ") : " . implode(', ', $added);
        }
    } catch (Throwable $e) {
        $log[] = "Attention : la synchronisation des fiches a échoué (" . $e->getMessage() . ").";
    }

    $log[] = "Déploiement terminé avec succès.";

    return $log;
}

function deployDownloadFile(string $url, string $token = '')
{
    $headers = ['User-Agent: php-deploy-script'];
    if ($token !== '') {
        $headers[] = 'Authorization: token ' . $token;
    }

    if (function_exists('curl_init')) {
        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_TIMEOUT => 120,
        ]);
        $content = curl_exec($ch);
        $ok = $content !== false && curl_getinfo($ch, CURLINFO_HTTP_CODE) === 200;
        curl_close($ch);
        return $ok ? $content : false;
    }

    $context = stream_context_create([
        'http' => ['header' => implode("\r\n", $headers)],
    ]);
    return @file_get_contents($url, false, $context);
}

function deployCopyRecursive(string $source, string $target, array $excludeFromOverwrite, string $relative = '')
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
            deployCopyRecursive($srcPath, $dstPath, $excludeFromOverwrite, $relPath);
        } else {
            copy($srcPath, $dstPath);
        }
    }
}

function deployDeleteRecursive(string $dir)
{
    if (!is_dir($dir)) {
        return;
    }
    foreach (scandir($dir) as $item) {
        if ($item === '.' || $item === '..') {
            continue;
        }
        $path = $dir . '/' . $item;
        is_dir($path) ? deployDeleteRecursive($path) : unlink($path);
    }
    rmdir($dir);
}
