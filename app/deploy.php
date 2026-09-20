<?php
/**
 * Script de déploiement.
 * Utilisation : appeler cette URL avec la bonne clé pour mettre à jour le site
 * depuis GitHub, ex: https://tonsite.com/deploy.php?key=CHANGE_MOI
 *
 * Ne dépend que de config/deploy-config.php (jamais écrasé par un déploiement).
 * Ce fichier lui-même EST écrasé à chaque déploiement : les correctifs futurs
 * s'appliquent automatiquement.
 */

require_once __DIR__ . '/config/deploy-config.php';

// Le bloc ci-dessous ne s'exécute que si ce fichier est appelé directement
// (URL /deploy.php?key=...). Quand il est inclus par un autre script (ex: le
// bouton "Actualiser le site" des Paramètres), seules les fonctions ci-dessous
// sont chargées et cette section est ignorée.
if (realpath($_SERVER['SCRIPT_FILENAME'] ?? '') === __FILE__) {
    header('Content-Type: text/plain; charset=utf-8');

    $providedKey = $_GET['key'] ?? '';
    if (!hash_equals(DEPLOY_KEY, $providedKey)) {
        http_response_code(403);
        exit("Accès refusé.\n");
    }

    try {
        foreach (deployRun(__DIR__) as $line) {
            echo $line . "\n";
        }
    } catch (Throwable $e) {
        http_response_code(500);
        echo "Erreur : " . $e->getMessage() . "\n";
    }
}

// ---- Fonctions ----

/**
 * Télécharge la dernière version du dépôt, l'installe par-dessus $targetDir
 * et synchronise les fiches pathologies en base.
 * @return string[] Lignes de log
 */
function deployRun(string $targetDir): array {
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

    // Dossiers/fichiers à ne jamais écraser lors du déploiement
    $excludeFromOverwrite = [
        'config/database.php',
        'config/deploy-config.php',
        'exports',
    ];

    $log[] = "Copie des fichiers vers $targetDir...";
    deployCopyRecursive($sourceDir, $targetDir, $excludeFromOverwrite);

    deployDeleteRecursive($tmpDir);

    require_once $targetDir . '/config/database.php';

    $log[] = "Synchronisation des fiches pathologies en base...";
    try {
        require_once $targetDir . '/data/fiches-pathologies.php';
        $added = syncFichesPathologies(getDB());
        $log[] = empty($added)
            ? "Aucune nouvelle fiche à ajouter (déjà à jour)."
            : "Fiches ajoutées en base (" . count($added) . ") : " . implode(', ', $added);
    } catch (Throwable $e) {
        $log[] = "Attention : la synchronisation des fiches a échoué (" . $e->getMessage() . ").";
    }

    $log[] = "Synchronisation des recettes en base...";
    try {
        if (!file_exists($targetDir . '/data/recettes.php')) {
            throw new RuntimeException('fichier data/recettes.php introuvable');
        }
        require_once $targetDir . '/data/recettes.php';
        $added = syncRecettesTypes(getDB());
        $log[] = empty($added)
            ? "Aucune nouvelle recette à ajouter (déjà à jour)."
            : "Recettes ajoutées en base (" . count($added) . ") : " . implode(', ', $added);
    } catch (Throwable $e) {
        $log[] = "Attention : la synchronisation des recettes a échoué (" . $e->getMessage() . ").";
    }

    $log[] = "Synchronisation des protocoles en base...";
    try {
        if (!file_exists($targetDir . '/data/protocoles.php')) {
            throw new RuntimeException('fichier data/protocoles.php introuvable');
        }
        require_once $targetDir . '/data/protocoles.php';
        $added = syncProtocoles(getDB());
        $log[] = empty($added)
            ? "Aucun nouveau protocole à ajouter (déjà à jour)."
            : "Protocoles ajoutés en base (" . count($added) . ") : " . implode(', ', $added);
    } catch (Throwable $e) {
        $log[] = "Attention : la synchronisation des protocoles a échoué (" . $e->getMessage() . ").";
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
