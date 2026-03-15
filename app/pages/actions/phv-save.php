<?php
$db = getDB();
$userId = currentUserId();
$consultId = (int) getPost('consultation_id');

$stmt = $db->prepare("SELECT * FROM consultations WHERE id = ? AND user_id = ?");
$stmt->execute([$consultId, $userId]);
if (!$stmt->fetch()) { redirect('dashboard'); }

// Construire les compléments en JSON (seulement ceux cochés)
$complements = [];
$noms = $_POST['complement_nom'] ?? [];
$posologies = $_POST['complement_posologie'] ?? [];
$durees = $_POST['complement_duree'] ?? [];
$actifs = $_POST['complement_actif'] ?? [];

for ($i = 0; $i < count($noms); $i++) {
    // Vérifier si le complément est actif (coché) et a un nom
    if (in_array((string)$i, $actifs) && !empty(trim($noms[$i]))) {
        $complements[] = [
            'nom' => trim($noms[$i]),
            'posologie' => trim($posologies[$i] ?? ''),
            'duree' => trim($durees[$i] ?? ''),
        ];
    }
}

// Collecter les commentaires du praticien
$commentaires = [
    'alimentation' => trim(getPost('commentaire_alimentation') ?? ''),
    'stress' => trim(getPost('commentaire_stress') ?? ''),
    'activite' => trim(getPost('commentaire_activite') ?? ''),
    'routines' => trim(getPost('commentaire_routines') ?? ''),
    'complements' => trim(getPost('commentaire_complements') ?? ''),
    'examens_bio' => trim(getPost('examens_bio_notes') ?? ''),
];

// Collecter les examens biologiques sélectionnés
$examensBioIds = $_POST['examens_bio'] ?? [];
$examensBioLabels = [
    'vit_d' => 'Vitamine D (25-OH)',
    'tsh' => 'TSH',
    't3_t4' => 'T3/T4 libres',
    'ferritine' => 'Ferritine + Fer sérique',
    'b12_b9' => 'Vitamine B12 + B9',
    'zinc' => 'Zinc',
    'magnesium' => 'Magnésium érythrocytaire',
    'homocysteine' => 'Homocystéine',
    'glycemie' => 'Glycémie à jeun + HbA1c',
    'insuline' => 'Insulinémie à jeun',
    'cortisol' => 'Cortisol (8h)',
    'crp' => 'CRP ultrasensible',
    'omega' => 'Profil acides gras / Oméga-3 Index',
    'igg_aliments' => 'IgG alimentaires',
];
$examensText = [];
foreach ($examensBioIds as $id) {
    if (isset($examensBioLabels[$id])) {
        $examensText[] = "▸ " . $examensBioLabels[$id];
    }
}
$examensNotes = trim(getPost('examens_bio_notes') ?? '');
if ($examensNotes) {
    $examensText[] = "\nNotes : " . $examensNotes;
}
$examensBioText = implode("\n", $examensText);

// Collecter les régimes alimentaires sélectionnés
$regimesIds = $_POST['regimes'] ?? [];
$regimesLabels = [
    'sans_gluten' => 'Sans gluten',
    'sans_lactose' => 'Sans lactose',
    'sans_lait_vache' => 'Sans lait de vache',
    'sans_sucre' => 'Sans sucre ajouté',
    'fodmap' => 'Pauvre en FODMAPs',
    'anti_inflammatoire' => 'Anti-inflammatoire',
    'hypotoxique' => 'Hypotoxique',
    'cetogene' => 'Cétogène',
    'vegetarien' => 'Végétarien',
    'ig_bas' => 'Index glycémique bas',
];
$regimesText = [];
foreach ($regimesIds as $id) {
    if (isset($regimesLabels[$id])) {
        $regimesText[] = $regimesLabels[$id];
    }
}
$regimesString = !empty($regimesText) ? "\n\nRÉGIMES SPÉCIFIQUES : " . implode(', ', $regimesText) : '';

// Traiter les items de routine sélectionnés
function processRoutineItems(array $selectedIds, array $itemsData): string {
    $lines = [];
    foreach ($selectedIds as $id) {
        if (isset($itemsData[$id])) {
            $item = json_decode($itemsData[$id], true);
            if ($item) {
                $line = "▸ " . ($item['titre'] ?? $id);
                if (!empty($item['description'])) {
                    $line .= " : " . $item['description'];
                }
                $lines[] = $line;
            }
        }
    }
    return implode("\n", $lines);
}

$routineMatinIds = $_POST['routine_matin_items'] ?? [];
$routineMatinData = $_POST['routine_matin_data'] ?? [];
$routineSoirIds = $_POST['routine_soir_items'] ?? [];
$routineSoirData = $_POST['routine_soir_data'] ?? [];

$routineMatinText = processRoutineItems($routineMatinIds, $routineMatinData);
$routineSoirText = processRoutineItems($routineSoirIds, $routineSoirData);

// Collecter les ressources sélectionnées
$protocolesIds = $_POST['protocoles_selectionnes'] ?? [];
$recettesIds = $_POST['recettes_selectionnees'] ?? [];
$pathologiesIds = $_POST['pathologies_selectionnees'] ?? [];

// Nettoyer et convertir en entiers
$protocolesIds = array_values(array_unique(array_filter(array_map('intval', $protocolesIds))));
$recettesIds = array_values(array_unique(array_filter(array_map('intval', $recettesIds))));
$pathologiesIds = array_values(array_unique(array_filter(array_map('intval', $pathologiesIds))));

$data = [
    'alimentation' => getPost('alimentation') . $regimesString,
    'alimentation_eviter' => getPost('alimentation_eviter'),
    'alimentation_privilegier' => getPost('alimentation_privilegier'),
    'menu_type' => getPost('menu_type'),
    'activite_physique' => getPost('activite_physique'),
    'gestion_stress' => getPost('gestion_stress'),
    'routine_matin' => $routineMatinText ?: getPost('routine_matin'),
    'routine_soir' => $routineSoirText ?: getPost('routine_soir'),
    'complements' => json_encode($complements, JSON_UNESCAPED_UNICODE),
    'soins_naturels' => getPost('soins_naturels'),
    'recommandations_complementaires' => getPost('recommandations_complementaires'),
    'notes' => getPost('notes_phv'),
    'commentaires_praticien' => json_encode($commentaires, JSON_UNESCAPED_UNICODE),
];

// Ajouter les ressources si les colonnes existent
try {
    $db->query("SELECT protocoles_ids FROM phv LIMIT 0");
    $data['protocoles_ids'] = json_encode($protocolesIds);
    $data['recettes_ids'] = json_encode($recettesIds);
    $data['pathologies_ids'] = json_encode($pathologiesIds);
} catch (PDOException $e) {
    // Colonnes pas encore créées, ignorer les ressources
}

// Ajouter les examens biologiques si la colonne existe
try {
    $db->query("SELECT examens_bio FROM phv LIMIT 0");
    $data['examens_bio'] = $examensBioText;
} catch (PDOException $e) {
    // Colonne pas encore créée - stocker dans recommandations_complementaires
    if ($examensBioText) {
        $data['recommandations_complementaires'] .= "\n\n--- EXAMENS BIOLOGIQUES SUGGÉRÉS ---\n" . $examensBioText;
    }
}

// Vérifier si un PHV existe déjà
$check = $db->prepare("SELECT id FROM phv WHERE consultation_id = ?");
$check->execute([$consultId]);

if ($check->fetch()) {
    $sets = [];
    $values = [];
    foreach ($data as $key => $val) {
        $sets[] = "$key = ?";
        $values[] = $val;
    }
    $values[] = $consultId;
    $db->prepare("UPDATE phv SET " . implode(', ', $sets) . ", updated_at = NOW() WHERE consultation_id = ?")->execute($values);
} else {
    $data['consultation_id'] = $consultId;
    $cols = implode(', ', array_keys($data));
    $placeholders = implode(', ', array_fill(0, count($data), '?'));
    $db->prepare("INSERT INTO phv ($cols) VALUES ($placeholders)")->execute(array_values($data));
}

// Finaliser ?
$finalize = getPost('finalize');
if ($finalize === '1') {
    $db->prepare("UPDATE consultations SET statut = 'terminee', updated_at = NOW() WHERE id = ?")->execute([$consultId]);
    flashSet('success', 'Consultation terminée ! Le PHV est prêt à être exporté.');
} else {
    flashSet('success', 'PHV enregistré.');
}

redirect('consultation-step6', ['id' => $consultId]);
