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

$debug = [
    'handler_entry' => date('H:i:s'),
    'file_mtime' => date('Y-m-d H:i:s', filemtime(__FILE__)),
    'user_id' => $userId,
    'post_consultation_id' => $consultId,
    'post_step' => $step,
    'post_keys' => array_keys($_POST),
    'request_method' => $_SERVER['REQUEST_METHOD'],
];

try {
    $stmt = $db->prepare("SELECT * FROM consultations WHERE id = ? AND user_id = ?");
    $stmt->execute([$consultId, $userId]);
    $consultation = $stmt->fetch();
    $debug['consultation_found'] = $consultation !== false;
    if (!$consultation) {
        $_SESSION['v2_save_debug'] = $debug;
        redirect('dashboard');
    }

    $section = 'v2_step' . $step;
    $systemFields = ['action', 'consultation_id', 'step'];

    $checkboxData = [];
    foreach ($_POST as $key => $value) {
        if (substr($key, -3) === '_cb' && is_array($value)) {
            $realKey = substr($key, 0, -3);
            $checkboxData[$realKey] = implode(',', $value);
        }
    }

    $jsonData = [];
    foreach ($_POST as $key => $value) {
        if (substr($key, -5) === '_json' && is_string($value) && $value !== '') {
            $realKey = substr($key, 0, -5);
            $jsonData[$realKey] = $value;
        }
    }

    $questions = [];
    foreach ($_POST as $key => $value) {
        if (in_array($key, $systemFields, true)) continue;
        if (substr($key, -3) === '_cb' || substr($key, -5) === '_json') continue;
        if (!is_string($value)) continue;
        $val = trim($value);
        if ($val === '') continue;
        $questions[] = ['key' => $key, 'value' => $val];
    }
    foreach ($checkboxData as $k => $v) $questions[] = ['key' => $k, 'value' => $v];
    foreach ($jsonData as $k => $v)     $questions[] = ['key' => $k, 'value' => $v];

    $debug['questions_count'] = count($questions);
    $debug['section'] = $section;

    $db->prepare('DELETE FROM consultation_reponses WHERE consultation_id = ? AND section = ?')
        ->execute([$consultId, $section]);

    $insertStmt = $db->prepare('INSERT INTO consultation_reponses (consultation_id, section, question_key, reponse) VALUES (?, ?, ?, ?)');
    foreach ($questions as $q) {
        $insertStmt->execute([$consultId, $section, $q['key'], $q['value']]);
    }

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

    $nextStep = $step + 1;
    $debug['next_step'] = $nextStep;

    if ($nextStep >= 16) {
        $db->prepare("UPDATE consultations SET current_step = 6, statut = 'phv', updated_at = NOW() WHERE id = ?")
           ->execute([$consultId]);
        $debug['redirect_to'] = 'consultation-step6';
        $_SESSION['v2_save_debug'] = $debug;
        redirect('consultation-step6', ['id' => $consultId]);
    } else {
        $statut = $nextStep === 15 ? 'synthese' : 'questionnaire';
        $updateStmt = $db->prepare("UPDATE consultations SET current_step = ?, statut = ?, updated_at = NOW() WHERE id = ?");
        $updateStmt->execute([$nextStep, $statut, $consultId]);
        $debug['update_rowcount'] = $updateStmt->rowCount();
        $debug['redirect_to'] = 'consultation-v2 step=' . $nextStep;
        $_SESSION['v2_save_debug'] = $debug;
        redirect('consultation-v2', ['id' => $consultId, 'step' => $nextStep]);
    }
} catch (Throwable $e) {
    $debug['exception'] = get_class($e) . ': ' . $e->getMessage();
    $debug['exception_file'] = $e->getFile() . ':' . $e->getLine();
    $_SESSION['v2_save_debug'] = $debug;
    // Rediriger vers la même étape pour afficher le debug
    redirect('consultation-v2', ['id' => $consultId, 'step' => $step]);
}
