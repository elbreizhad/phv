<?php
$db = getDB();
$userId = currentUserId();
$consultId = (int) getPost('consultation_id');

$stmt = $db->prepare("SELECT * FROM consultations WHERE id = ? AND user_id = ?");
$stmt->execute([$consultId, $userId]);
if (!$stmt->fetch()) { redirect('dashboard'); }

// Construire les compléments en JSON
$complements = [];
$noms = $_POST['complement_nom'] ?? [];
$posologies = $_POST['complement_posologie'] ?? [];
$durees = $_POST['complement_duree'] ?? [];

for ($i = 0; $i < count($noms); $i++) {
    if (!empty(trim($noms[$i]))) {
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
];

$data = [
    'alimentation' => getPost('alimentation'),
    'alimentation_eviter' => getPost('alimentation_eviter'),
    'alimentation_privilegier' => getPost('alimentation_privilegier'),
    'menu_type' => getPost('menu_type'),
    'activite_physique' => getPost('activite_physique'),
    'gestion_stress' => getPost('gestion_stress'),
    'routine_matin' => getPost('routine_matin'),
    'routine_soir' => getPost('routine_soir'),
    'complements' => json_encode($complements, JSON_UNESCAPED_UNICODE),
    'soins_naturels' => getPost('soins_naturels'),
    'recommandations_complementaires' => getPost('recommandations_complementaires'),
    'notes' => getPost('notes_phv'),
    'commentaires_praticien' => json_encode($commentaires, JSON_UNESCAPED_UNICODE),
];

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
