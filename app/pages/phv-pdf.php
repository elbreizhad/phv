<?php
/**
 * Export PHV au format PDF via Dompdf.
 * - Récupère la même données que phv-export.php
 * - Réutilise l'HTML/CSS existant en capturant via output buffering
 * - Produit un téléchargement direct d'un fichier .pdf
 */

// DEBUG activé si ?debug=1 dans l'URL
$debugMode = isset($_GET['debug']);
if ($debugMode) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    header('Content-Type: text/plain; charset=utf-8');
    echo "=== DEBUG phv-pdf ===\n";
    echo "PHP : " . PHP_VERSION . "\n";
    echo "ID consultation : " . ($_GET['id'] ?? 'MANQUANT') . "\n";
    echo "\n-- Vérification des dépendances --\n";
    echo "Extension DOM : " . (extension_loaded('dom') ? 'OK' : 'MANQUANTE') . "\n";
    echo "Extension mbstring : " . (extension_loaded('mbstring') ? 'OK' : 'MANQUANTE') . "\n";
    echo "Extension GD : " . (extension_loaded('gd') ? 'OK' : 'MANQUANTE') . "\n";
    $autoload = __DIR__ . '/../lib/vendor/autoload.php';
    echo "Autoload attendu : $autoload\n";
    echo "Autoload existe : " . (file_exists($autoload) ? 'OK' : 'MANQUANT') . "\n";
    $dompdfDir = __DIR__ . '/../lib/vendor/dompdf/dompdf/src';
    echo "Dompdf src existe : " . (is_dir($dompdfDir) ? 'OK' : 'MANQUANT') . "\n";
    echo "sys_get_temp_dir : " . sys_get_temp_dir() . " (writable: " . (is_writable(sys_get_temp_dir()) ? 'oui' : 'NON') . ")\n";
    echo "memory_limit : " . ini_get('memory_limit') . "\n";
    echo "max_execution_time : " . ini_get('max_execution_time') . "\n";
}

try {
    $autoload = __DIR__ . '/../lib/vendor/autoload.php';
    if (!file_exists($autoload)) {
        throw new RuntimeException("Bibliothèque Dompdf non installée. Le dossier app/lib/vendor/ doit être uploadé.");
    }
    require_once $autoload;
    if ($debugMode) echo "Autoload chargé OK\n";

    if (!class_exists('Dompdf\Dompdf')) {
        throw new RuntimeException("Classe Dompdf introuvable malgré l'autoload.");
    }
    if ($debugMode) echo "Classe Dompdf OK\n";

    $db = getDB();
    $consultId = (int) getGet('id');
    $userId = currentUserId();

    $stmt = $db->prepare("
        SELECT c.*, cl.nom AS client_nom, cl.prenom AS client_prenom, cl.sexe AS client_sexe,
               cl.email AS client_email, cl.telephone AS client_telephone
        FROM consultations c
        JOIN clients cl ON c.client_id = cl.id
        WHERE c.id = ? AND c.user_id = ?
    ");
    $stmt->execute([$consultId, $userId]);
    $consultation = $stmt->fetch();
    if (!$consultation) { exit('Consultation introuvable.'); }

    if ($debugMode) echo "Consultation trouvée : " . $consultation['client_prenom'] . ' ' . $consultation['client_nom'] . "\n";

    // Capturer le HTML de phv-export.php (mode preview = sans JS auto-print)
    $_GET['preview'] = 1;
    ob_start();
    require __DIR__ . '/phv-export.php';
    $html = ob_get_clean();

    if ($debugMode) {
        echo "HTML capturé : " . strlen($html) . " caractères\n";
        if (strlen($html) < 100) { echo "Début HTML : " . substr($html, 0, 500) . "\n"; }
    }

    // Retirer les éléments interactifs non pertinents pour le PDF
    $html = preg_replace('/<div class="print-bar[^"]*"[^>]*>.*?<\/div>\s*<\/div>/s', '', $html);
    $html = preg_replace('/<script[^>]*>.*?<\/script>/s', '', $html);
    $html = preg_replace('/<button[^>]*>.*?<\/button>/s', '', $html);

    $options = new \Dompdf\Options();
    $options->set('isRemoteEnabled', false);
    $options->set('isHtml5ParserEnabled', true);
    $options->set('defaultFont', 'DejaVu Sans');
    $options->set('chroot', [__DIR__ . '/..']);
    $options->set('tempDir', sys_get_temp_dir());
    $options->set('fontDir', __DIR__ . '/../lib/vendor/dompdf/dompdf/lib/fonts');
    $options->set('fontCache', sys_get_temp_dir());

    if ($debugMode) echo "Options Dompdf configurées\n";

    $dompdf = new \Dompdf\Dompdf($options);
    $dompdf->loadHtml($html, 'UTF-8');
    if ($debugMode) echo "HTML chargé dans Dompdf\n";

    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    if ($debugMode) {
        echo "Rendu Dompdf OK\n";
        echo "Pages générées : " . $dompdf->getCanvas()->get_page_count() . "\n";
        echo "\nDEBUG terminé sans erreur. Retire ?debug=1 pour télécharger le PDF.\n";
        exit;
    }

    $filename = 'PHV_' . preg_replace('/[^a-zA-Z0-9_-]/', '_', strtolower($consultation['client_prenom'] . '_' . $consultation['client_nom']))
              . '_' . date('Y-m-d', strtotime($consultation['date_consultation'])) . '.pdf';

    $dompdf->stream($filename, ['Attachment' => true]);
    exit;

} catch (Throwable $e) {
    if ($debugMode) {
        echo "\n!!! EXCEPTION !!!\n";
        echo "Type : " . get_class($e) . "\n";
        echo "Message : " . $e->getMessage() . "\n";
        echo "Fichier : " . $e->getFile() . ":" . $e->getLine() . "\n";
        echo "\nStack trace :\n" . $e->getTraceAsString() . "\n";
    } else {
        // En mode normal, afficher un message lisible
        http_response_code(500);
        header('Content-Type: text/html; charset=utf-8');
        echo '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Erreur PDF</title></head><body style="font-family:sans-serif;padding:2rem;max-width:800px;margin:auto;">';
        echo '<h1 style="color:#c0392b;">Erreur lors de la génération du PDF</h1>';
        echo '<p>' . htmlspecialchars($e->getMessage()) . '</p>';
        echo '<p><a href="?page=phv-pdf&id=' . (int)($_GET['id'] ?? 0) . '&debug=1">Lancer le mode debug</a> pour plus d\'informations.</p>';
        echo '<p><a href="javascript:history.back()">← Retour</a></p>';
        echo '</body></html>';
    }
    exit;
}
