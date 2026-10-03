<?php
/**
 * Action admin : générer un nouveau code d'essai
 */
$dureeJours = (int) getPost('duree_jours', '30');
$usageMax = (int) getPost('usage_max', '1');
$expiresAt = getPost('expires_at', '');

if ($dureeJours <= 0) {
    $dureeJours = 30;
}
if ($usageMax <= 0) {
    $usageMax = 1;
}

$code = generateTrialCode(currentUserId(), $dureeJours, $usageMax, $expiresAt ?: null);
flashSet('success', "Code créé : $code");
redirect('admin-codes');
