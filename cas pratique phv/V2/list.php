<?php
/**
 * Listing minimal du dossier courant (à uploader dans data-phv/phv/).
 * Retourne la liste des fichiers en JSON + HTML pour que Claude (WebFetch)
 * puisse les énumérer, puis les récupérer un par un via leur URL directe.
 *
 * Sécurité : pas de traversal possible, lecture uniquement du dossier où
 * réside ce script. Aucun contenu de fichier n'est exposé par ce script.
 */

$dir = __DIR__;
$base = rtrim(dirname($_SERVER['REQUEST_URI'] ?? ''), '/') . '/';

$items = [];
foreach (scandir($dir) as $entry) {
    if ($entry === '.' || $entry === '..') continue;
    if ($entry === basename(__FILE__)) continue;
    $path = $dir . '/' . $entry;
    $items[] = [
        'name' => $entry,
        'is_dir' => is_dir($path),
        'size' => is_file($path) ? filesize($path) : null,
        'modified' => date('Y-m-d H:i:s', filemtime($path)),
        'url' => $base . rawurlencode($entry) . (is_dir($path) ? '/' : ''),
    ];
}

usort($items, fn($a, $b) => ($b['is_dir'] <=> $a['is_dir']) ?: strcmp($a['name'], $b['name']));

if (($_GET['format'] ?? '') === 'json') {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['dir' => $base, 'items' => $items], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    exit;
}

header('Content-Type: text/html; charset=utf-8');
?><!doctype html>
<html lang="fr">
<head><meta charset="utf-8"><title>Listing <?= htmlspecialchars($base) ?></title>
<style>body{font-family:monospace;padding:2rem;max-width:900px;margin:auto}
table{border-collapse:collapse;width:100%}
td,th{padding:.3rem .8rem;border-bottom:1px solid #eee;text-align:left}
a{color:#4a6741;text-decoration:none}a:hover{text-decoration:underline}
.dir{font-weight:bold}</style></head>
<body>
<h1>Index de <?= htmlspecialchars($base) ?></h1>
<p><?= count($items) ?> éléments — <a href="?format=json">voir en JSON</a></p>
<table>
<thead><tr><th>Nom</th><th>Taille</th><th>Modifié</th></tr></thead>
<tbody>
<?php foreach ($items as $it): ?>
<tr>
  <td class="<?= $it['is_dir'] ? 'dir' : '' ?>">
    <a href="<?= htmlspecialchars($it['url']) ?>"><?= htmlspecialchars($it['name']) ?><?= $it['is_dir'] ? '/' : '' ?></a>
  </td>
  <td><?= $it['size'] !== null ? number_format($it['size'], 0, ',', ' ') . ' o' : '-' ?></td>
  <td><?= $it['modified'] ?></td>
</tr>
<?php endforeach ?>
</tbody>
</table>
</body></html>
