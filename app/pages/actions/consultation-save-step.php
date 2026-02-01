<?php
$db = getDB();
$userId = currentUserId();
$consultId = (int) getPost('consultation_id');
$step = (int) getPost('step');

// Vérifier que la consultation appartient à l'utilisateur
$stmt = $db->prepare("SELECT * FROM consultations WHERE id = ? AND user_id = ?");
$stmt->execute([$consultId, $userId]);
$consultation = $stmt->fetch();
if (!$consultation) { redirect('dashboard'); }

// Sauvegarder toutes les données POST (sauf les champs système)
$systemFields = ['action', 'consultation_id', 'step'];

// Déterminer la section selon l'étape
$sectionMap = [
    1 => ['infos_generales', 'historique_medical'],
    2 => ['mode_de_vie'],
    3 => ['bilan_digestif', 'bilan_nerveux', 'bilan_endocrinien', 'bilan_cardio', 'bilan_respiratoire', 'bilan_uro_genital', 'bilan_osteo', 'bilan_tegumentaire', 'bilan_immunitaire'],
    4 => ['bilan_complementaire'],
];

// Supprimer les anciennes réponses pour les sections de cette étape
$sections = $sectionMap[$step] ?? ['step' . $step];

// Traitement spécial pour les checkboxes (convertir en chaîne séparée par des virgules)
$checkboxData = [];
foreach ($_POST as $key => $value) {
    if (str_ends_with($key, '_cb') && is_array($value)) {
        $realKey = str_replace('_cb', '', $key);
        $checkboxData[$realKey] = implode(',', $value);
    }
}

// Construire la liste des questions à sauvegarder
$questions = [];
foreach ($_POST as $key => $value) {
    if (in_array($key, $systemFields) || str_ends_with($key, '_cb')) continue;
    if (!is_string($value)) continue;

    // Déterminer la section
    $section = 'step' . $step;
    if ($step === 1) {
        $section = str_starts_with($key, 'med_') ? 'historique_medical' : 'infos_generales';
    } elseif ($step === 2) {
        $section = 'mode_de_vie';
    } elseif ($step === 3) {
        // Déterminer la section du bilan selon le préfixe
        if (str_starts_with($key, 'dig_')) $section = 'bilan_digestif';
        elseif (str_starts_with($key, 'nerv_')) $section = 'bilan_nerveux';
        elseif (str_starts_with($key, 'endo_')) $section = 'bilan_endocrinien';
        elseif (str_starts_with($key, 'cardio_')) $section = 'bilan_cardio';
        elseif (str_starts_with($key, 'resp_')) $section = 'bilan_respiratoire';
        elseif (str_starts_with($key, 'uro_')) $section = 'bilan_uro_genital';
        elseif (str_starts_with($key, 'osteo_')) $section = 'bilan_osteo';
        elseif (str_starts_with($key, 'peau_')) $section = 'bilan_tegumentaire';
        elseif (str_starts_with($key, 'immu_')) $section = 'bilan_immunitaire';
        else $section = 'bilan_complementaire';
    } elseif ($step === 4) {
        $section = 'bilan_complementaire';
    }

    $val = trim($value);
    if ($val !== '') {
        $questions[] = [
            'section' => $section,
            'key' => $key,
            'value' => $val,
        ];
    }
}

// Ajouter les données de checkboxes
foreach ($checkboxData as $key => $val) {
    $section = 'step' . $step;
    if ($step === 2) $section = 'mode_de_vie';
    elseif ($step === 3) {
        if (str_starts_with($key, 'dig_')) $section = 'bilan_digestif';
        elseif (str_starts_with($key, 'peau_')) $section = 'bilan_tegumentaire';
        else $section = 'bilan_complementaire';
    }

    $questions[] = [
        'section' => $section,
        'key' => $key,
        'value' => $val,
    ];
}

// Supprimer toutes les anciennes réponses des sections concernées
foreach ($sections as $sec) {
    $stmt = $db->prepare('DELETE FROM consultation_reponses WHERE consultation_id = ? AND section = ?');
    $stmt->execute([$consultId, $sec]);
}

// Insérer les nouvelles
$insertStmt = $db->prepare('INSERT INTO consultation_reponses (consultation_id, section, question_key, reponse) VALUES (?, ?, ?, ?)');
foreach ($questions as $q) {
    $insertStmt->execute([$consultId, $q['section'], $q['key'], $q['value']]);
}

// Mettre à jour l'étape courante et le statut
$nextStep = min($step + 1, 6);
$statut = match(true) {
    $nextStep <= 4 => 'questionnaire',
    $nextStep === 5 => 'synthese',
    $nextStep === 6 => 'phv',
    default => 'en_cours',
};

$db->prepare("UPDATE consultations SET current_step = ?, statut = ?, updated_at = NOW() WHERE id = ?")->execute([$nextStep, $statut, $consultId]);

redirect('consultation-step' . $nextStep, ['id' => $consultId]);
