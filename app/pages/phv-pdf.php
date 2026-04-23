<?php
/**
 * Export PHV au format PDF via Dompdf.
 * - Récupère la même données que phv-export.php
 * - Réutilise l'HTML/CSS existant en capturant via output buffering
 * - Produit un téléchargement direct d'un fichier .pdf
 */

require_once __DIR__ . '/../lib/vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

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

// Capturer le HTML de phv-export.php (mode preview = sans JS auto-print)
$_GET['preview'] = 1;
ob_start();
require __DIR__ . '/phv-export.php';
$html = ob_get_clean();

// Retirer les éléments interactifs non pertinents pour le PDF
$html = preg_replace('/<div class="print-bar[^"]*"[^>]*>.*?<\/div>\s*<\/div>/s', '', $html);
$html = preg_replace('/<script[^>]*>.*?<\/script>/s', '', $html);
$html = preg_replace('/<button[^>]*>.*?<\/button>/s', '', $html);

$options = new Options();
$options->set('isRemoteEnabled', false); // désactive le chargement de polices externes (Google Fonts)
$options->set('isHtml5ParserEnabled', true);
$options->set('defaultFont', 'DejaVu Sans');
$options->set('chroot', [__DIR__ . '/..']);

$dompdf = new Dompdf($options);
$dompdf->loadHtml($html, 'UTF-8');
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

$filename = 'PHV_' . preg_replace('/[^a-zA-Z0-9_-]/', '_', strtolower($consultation['client_prenom'] . '_' . $consultation['client_nom']))
          . '_' . date('Y-m-d', strtotime($consultation['date_consultation'])) . '.pdf';

$dompdf->stream($filename, ['Attachment' => true]);
exit;
