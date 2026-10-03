<?php
/**
 * Action admin : activer/désactiver un code d'essai
 */
$codeId = (int) getPost('code_id');
$db = getDB();
$db->prepare("UPDATE trial_codes SET actif = NOT actif WHERE id = ?")->execute([$codeId]);
flashSet('success', 'Code mis à jour.');
redirect('admin-codes');
