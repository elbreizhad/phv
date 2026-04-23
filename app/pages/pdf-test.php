<?php
/**
 * Test autonome de Dompdf — sans toucher à aucune donnée consultation.
 * URL : https://naturo.pertec.fr/index.php?page=pdf-test
 *
 * 3 résultats possibles :
 * 1. Téléchargement d'un fichier "test-dompdf.pdf" -> Dompdf fonctionne parfaitement,
 *    le problème est dans la génération du PHV (tenter phv-pdf?&debug=1).
 * 2. Page blanche / URL qui charge sans rien -> output parasite avant headers,
 *    à diagnostiquer (voir les notes en bas).
 * 3. Message d'erreur affiché en texte -> la cause est dans le message.
 */

ini_set('display_errors', 1);
error_reporting(E_ALL);

$autoload = __DIR__ . '/../lib/vendor/autoload.php';

// Diagnostic avant de tenter Dompdf
$debug = "=== TEST DOMPDF ===\n";
$debug .= "PHP : " . PHP_VERSION . "\n";
$debug .= "Extension DOM : " . (extension_loaded('dom') ? 'OK' : 'MANQUANTE') . "\n";
$debug .= "Extension mbstring : " . (extension_loaded('mbstring') ? 'OK' : 'MANQUANTE') . "\n";
$debug .= "Extension GD : " . (extension_loaded('gd') ? 'OK' : 'MANQUANTE') . "\n";
$debug .= "Autoload : " . (file_exists($autoload) ? 'OK' : 'MANQUANT') . "\n";
$debug .= "Autoload path : $autoload\n";
$debug .= "tempDir : " . sys_get_temp_dir() . " (writable: " . (is_writable(sys_get_temp_dir()) ? 'oui' : 'NON') . ")\n";
$debug .= "memory_limit : " . ini_get('memory_limit') . "\n";

if (isset($_GET['diag'])) {
    header('Content-Type: text/plain; charset=utf-8');
    echo $debug;
    if (!file_exists($autoload)) {
        echo "\n!!! app/lib/vendor/ n'est pas uploadé. C'est la cause racine.\n";
        exit;
    }
    echo "\nDompdf peut être chargé. Retire &diag=1 pour générer un PDF test.\n";
    exit;
}

try {
    if (!file_exists($autoload)) {
        throw new RuntimeException("app/lib/vendor/autoload.php introuvable. Upload app/lib/vendor/ sur le serveur.");
    }
    require_once $autoload;

    if (!class_exists('Dompdf\Dompdf')) {
        throw new RuntimeException("Classe Dompdf non trouvée après autoload.");
    }

    $options = new \Dompdf\Options();
    $options->set('isRemoteEnabled', false);
    $options->set('defaultFont', 'DejaVu Sans');
    $options->set('tempDir', sys_get_temp_dir());
    $options->set('fontDir', __DIR__ . '/../lib/vendor/dompdf/dompdf/lib/fonts');
    $options->set('fontCache', sys_get_temp_dir());

    $html = '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Test</title>'
          . '<style>body{font-family:DejaVu Sans;padding:40px;}h1{color:#4a6741;}table{width:100%;border-collapse:collapse;}td{border:1px solid #ccc;padding:8px;}</style>'
          . '</head><body>'
          . '<h1>✓ Test Dompdf</h1>'
          . '<p>Généré le ' . date('d/m/Y à H:i:s') . ' — si tu lis ce PDF, Dompdf fonctionne parfaitement.</p>'
          . '<table><tr><td>Français</td><td>éàèç âêîôû — OK</td></tr>'
          . '<tr><td>PHP</td><td>' . PHP_VERSION . '</td></tr>'
          . '<tr><td>Memory</td><td>' . ini_get('memory_limit') . '</td></tr></table>'
          . '<p style="margin-top:30px;color:#666;">→ Le problème du PHV PDF n\'est donc pas Dompdf lui-même,'
          . ' mais soit la génération du HTML (phv-export.php), soit une sortie parasite avant headers.</p>'
          . '</body></html>';

    $dompdf = new \Dompdf\Dompdf($options);
    $dompdf->loadHtml($html, 'UTF-8');
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    $output = $dompdf->output();
    while (ob_get_level() > 0) ob_end_clean();

    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="test-dompdf.pdf"');
    header('Content-Length: ' . strlen($output));
    echo $output;
    exit;

} catch (Throwable $e) {
    header('Content-Type: text/plain; charset=utf-8');
    echo $debug;
    echo "\n!!! ERREUR !!!\n";
    echo get_class($e) . " : " . $e->getMessage() . "\n";
    echo "Fichier : " . $e->getFile() . ":" . $e->getLine() . "\n\n";
    echo $e->getTraceAsString() . "\n";
    exit;
}
