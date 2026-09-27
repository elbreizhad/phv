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
$moments = $_POST['complement_moment'] ?? [];
$durees = $_POST['complement_duree'] ?? [];
$associations = $_POST['complement_association'] ?? [];
$actifs = $_POST['complement_actif'] ?? [];

for ($i = 0; $i < count($noms); $i++) {
    // Vérifier si le complément est actif (coché) et a un nom
    if (in_array((string)$i, $actifs) && !empty(trim($noms[$i]))) {
        $complements[] = [
            'nom' => trim($noms[$i]),
            'posologie' => trim($posologies[$i] ?? ''),
            'moment' => trim($moments[$i] ?? ''),
            'duree' => trim($durees[$i] ?? ''),
            'association' => trim($associations[$i] ?? ''),
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

// Blocs structurés "conseils alimentaires" / "menu type" (cartes ajoutées à
// l'étape 6) : on en tire aussi une version texte pour les anciens
// consommateurs (PDF praticien, exports antérieurs) qui lisent encore
// alimentation/menu_type en texte libre.
$conseilsAlimentaires = json_decode(getPost('conseils_alimentaires') ?: '[]', true) ?: [];
$conseilsAlimentaires = array_values(array_filter($conseilsAlimentaires, function ($c) {
    return trim($c['titre'] ?? '') !== '' || trim($c['texte'] ?? '') !== '';
}));
$alimentationTexte = implode("\n\n", array_map(function ($c) {
    $titre = trim($c['titre'] ?? '');
    $texte = trim($c['texte'] ?? '');
    if ($titre !== '' && $texte !== '') return $titre . ' — ' . $texte;
    return $titre !== '' ? $titre : $texte;
}, $conseilsAlimentaires));

$menuStructure = json_decode(getPost('menu_structure') ?: '[]', true) ?: [];
$menuStructure = array_values(array_filter($menuStructure, function ($m) {
    return trim($m['nom_repas'] ?? '') !== '' || trim($m['contenu'] ?? '') !== '';
}));
$menuTypeTexte = implode("\n\n", array_map(function ($m) {
    $lignes = [];
    if (trim($m['nom_repas'] ?? '') !== '') $lignes[] = strtoupper(trim($m['nom_repas'])) . ' :';
    if (trim($m['contenu'] ?? '') !== '') $lignes[] = trim($m['contenu']);
    if (trim($m['astuce'] ?? '') !== '') $lignes[] = 'Astuce : ' . trim($m['astuce']);
    return implode("\n", $lignes);
}, $menuStructure));

$ressourcesExternes = json_decode(getPost('ressources_externes') ?: '[]', true) ?: [];
$ressourcesExternes = array_values(array_filter($ressourcesExternes, function ($r) {
    return trim($r['titre'] ?? '') !== '';
}));

$data = [
    'alimentation' => $alimentationTexte . $regimesString,
    'alimentation_eviter' => getPost('alimentation_eviter'),
    'alimentation_privilegier' => getPost('alimentation_privilegier'),
    'menu_type' => $menuTypeTexte,
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
$examensBioTexte = getPost('examens_bio_texte') ?: $examensBioText;
try {
    $db->query("SELECT examens_bio FROM phv LIMIT 0");
    $data['examens_bio'] = $examensBioTexte;
} catch (PDOException $e) {
    // Colonne pas encore créée - stocker dans recommandations_complementaires
    if ($examensBioTexte) {
        $data['recommandations_complementaires'] .= "\n\n--- EXAMENS BIOLOGIQUES SUGGÉRÉS ---\n" . $examensBioTexte;
    }
}

// Ajouter les nouveaux champs si les colonnes existent
$nouveauxChamps = [
    'phytologie' => getPost('phytologie'),
    'aromatherapie' => getPost('aromatherapie'),
    'gemmotherapie' => getPost('gemmotherapie'),
    'programme_detox' => getPost('programme_detox'),
    'hydrologie' => getPost('hydrologie'),
    'complements_texte' => getPost('complements_texte'),
    'objectifs' => getPost('objectifs'),
    'soutien_emotionnel' => getPost('soutien_emotionnel'),
    'points_attention' => getPost('points_attention'),
    'prochain_rdv_notes' => getPost('prochain_rdv_notes'),
    'conseils_alimentaires' => json_encode($conseilsAlimentaires, JSON_UNESCAPED_UNICODE),
    'menu_structure' => json_encode($menuStructure, JSON_UNESCAPED_UNICODE),
    'ressources_externes' => json_encode($ressourcesExternes, JSON_UNESCAPED_UNICODE),
];

foreach ($nouveauxChamps as $champ => $valeur) {
    if ($valeur) {
        try {
            $db->query("SELECT $champ FROM phv LIMIT 0");
            $data[$champ] = $valeur;
        } catch (PDOException $e) {
            // Colonne pas encore créée - ignorer ou stocker ailleurs
        }
    }
}

// Date du prochain RDV (peut être vide pour effacer une date déjà saisie)
try {
    $db->query("SELECT prochain_rdv FROM phv LIMIT 0");
    $data['prochain_rdv'] = getPost('prochain_rdv') ?: null;
} catch (PDOException $e) {
    // Colonne pas encore créée
}

// Case à cocher "inclure le tableau IG" : toujours enregistrée (y compris
// pour repasser à 0 quand elle est décochée), contrairement aux textarea
// ci-dessus qu'on ne veut pas écraser par du vide.
try {
    $db->query("SELECT inclure_tableau_ig FROM phv LIMIT 0");
    $data['inclure_tableau_ig'] = getPost('inclure_tableau_ig') ? 1 : 0;
} catch (PDOException $e) {
    // Colonne pas encore créée
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
