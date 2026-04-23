<?php
/**
 * Sauvegarde d'une étape du questionnaire V2.
 * Stocke toutes les réponses dans consultation_reponses avec section = 'v2_step{N}'.
 * Les cases à cocher sont envoyées en tableau ('key_cb[]') et concaténées en CSV.
 */
$db = getDB();
$userId = currentUserId();
$consultId = (int) getPost('consultation_id');
$step = (int) getPost('step');

$stmt = $db->prepare("SELECT * FROM consultations WHERE id = ? AND user_id = ?");
$stmt->execute([$consultId, $userId]);
$consultation = $stmt->fetch();
if (!$consultation) { redirect('dashboard'); }

$section = 'v2_step' . $step;
$systemFields = ['action', 'consultation_id', 'step'];

// Checkboxes multi-valeurs
$checkboxData = [];
foreach ($_POST as $key => $value) {
    if (str_ends_with($key, '_cb') && is_array($value)) {
        $realKey = substr($key, 0, -3);
        $checkboxData[$realKey] = implode(',', $value);
    }
}

// Champs JSON (ex: tableau antécédents familiaux) encodés côté client
$jsonData = [];
foreach ($_POST as $key => $value) {
    if (str_ends_with($key, '_json') && is_string($value) && $value !== '') {
        $realKey = substr($key, 0, -5);
        $jsonData[$realKey] = $value;
    }
}

$questions = [];
foreach ($_POST as $key => $value) {
    if (in_array($key, $systemFields, true) || str_ends_with($key, '_cb') || str_ends_with($key, '_json')) continue;
    if (!is_string($value)) continue;
    $val = trim($value);
    if ($val === '') continue;
    $questions[] = ['key' => $key, 'value' => $val];
}
foreach ($checkboxData as $k => $v) $questions[] = ['key' => $k, 'value' => $v];
foreach ($jsonData as $k => $v)     $questions[] = ['key' => $k, 'value' => $v];

// Remplacement atomique des réponses de la section
$db->prepare('DELETE FROM consultation_reponses WHERE consultation_id = ? AND section = ?')
    ->execute([$consultId, $section]);

$insertStmt = $db->prepare('INSERT INTO consultation_reponses (consultation_id, section, question_key, reponse) VALUES (?, ?, ?, ?)');
foreach ($questions as $q) {
    $insertStmt->execute([$consultId, $section, $q['key'], $q['value']]);
}

// Étape 15 : synchronise aussi la table consultation_synthese pour compatibilité PHV (step6)
if ($step === 15) {
    $p1 = trim((string) getPost('priorite_1'));
    $p2 = trim((string) getPost('priorite_2'));
    $p3 = trim((string) getPost('priorite_3'));
    $obs = trim((string) getPost('signes_desequilibre'));
    $terrains = isset($_POST['terrains_cb']) && is_array($_POST['terrains_cb']) ? $_POST['terrains_cb'] : [];
    $axes = isset($_POST['priorites_axes_cb']) && is_array($_POST['priorites_axes_cb']) ? $_POST['priorites_axes_cb'] : [];

    $exists = $db->prepare('SELECT id FROM consultation_synthese WHERE consultation_id = ?');
    $exists->execute([$consultId]);
    if ($exists->fetch()) {
        $db->prepare('UPDATE consultation_synthese SET priorite_1 = ?, priorite_2 = ?, priorite_3 = ?, observations = ?, organes_desequilibre = ?, axes_travail = ?, updated_at = NOW() WHERE consultation_id = ?')
            ->execute([$p1, $p2, $p3, $obs, json_encode($terrains, JSON_UNESCAPED_UNICODE), json_encode($axes, JSON_UNESCAPED_UNICODE), $consultId]);
    } else {
        $db->prepare('INSERT INTO consultation_synthese (consultation_id, priorite_1, priorite_2, priorite_3, observations, organes_desequilibre, axes_travail) VALUES (?, ?, ?, ?, ?, ?, ?)')
            ->execute([$consultId, $p1, $p2, $p3, $obs, json_encode($terrains, JSON_UNESCAPED_UNICODE), json_encode($axes, JSON_UNESCAPED_UNICODE)]);
    }
}

// Progression : next step ou PHV
$nextStep = $step + 1;
if ($nextStep >= 16) {
    // Transition vers le PHV (réutilise consultation-step6)
    $db->prepare("UPDATE consultations SET current_step = 6, statut = 'phv', updated_at = NOW() WHERE id = ?")
       ->execute([$consultId]);
    redirect('consultation-step6', ['id' => $consultId]);
} else {
    $statut = $nextStep === 15 ? 'synthese' : 'questionnaire';
    $db->prepare("UPDATE consultations SET current_step = ?, statut = ?, updated_at = NOW() WHERE id = ?")
       ->execute([$nextStep, $statut, $consultId]);
    redirect('consultation-v2', ['id' => $consultId, 'step' => $nextStep]);
}
