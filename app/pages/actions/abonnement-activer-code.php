<?php
/**
 * Action : un praticien active un code d'essai reçu de son administrateur
 */
$result = redeemTrialCode(currentUserId(), getPost('code'));
flashSet($result['success'] ? 'success' : 'error', $result['message']);
redirect('abonnement');
