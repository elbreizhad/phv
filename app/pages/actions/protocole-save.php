<?php
/**
 * Action: Sauvegarder un protocole
 */
$db = getDB();
$userId = currentUserId();

$protocoleId = (int)getPost('protocole_id');
$nom = getPost('nom');
$typeProtocole = getPost('type_protocole', 'autre');
$dureeJours = (int)getPost('duree_jours') ?: null;
$description = getPost('description');
$objectifs = getPost('objectifs');
$alimentation = getPost('alimentation');
$contreIndications = getPost('contre_indications');

// Phases
$phasesRaw = $_POST['phases'] ?? [];
$phases = [];
foreach ($phasesRaw as $phase) {
    if (!empty($phase['nom'])) {
        $phases[] = [
            'nom' => $phase['nom'],
            'duree' => (int)($phase['duree'] ?? 7),
            'description' => $phase['description'] ?? ''
        ];
    }
}
$phasesJson = !empty($phases) ? json_encode($phases) : null;

// Compléments
$complementsRaw = $_POST['complements'] ?? [];
$complements = [];
foreach ($complementsRaw as $comp) {
    if (!empty($comp['nom'])) {
        $complements[] = [
            'nom' => $comp['nom'],
            'posologie' => $comp['posologie'] ?? '',
            'duree' => $comp['duree'] ?? ''
        ];
    }
}
$complementsJson = !empty($complements) ? json_encode($complements) : null;

if ($protocoleId) {
    // Vérifier propriété
    $checkStmt = $db->prepare("SELECT id FROM protocoles WHERE id = ? AND user_id = ?");
    $checkStmt->execute([$protocoleId, $userId]);
    if (!$checkStmt->fetch()) {
        flashSet('error', 'Protocole non trouvé.');
        redirect('protocoles');
    }

    $stmt = $db->prepare("
        UPDATE protocoles SET
            nom = ?, type_protocole = ?, duree_jours = ?, description = ?, objectifs = ?,
            phases = ?, complements = ?, alimentation = ?, contre_indications = ?
        WHERE id = ? AND user_id = ?
    ");
    $stmt->execute([
        $nom, $typeProtocole, $dureeJours, $description, $objectifs,
        $phasesJson, $complementsJson, $alimentation, $contreIndications,
        $protocoleId, $userId
    ]);
    flashSet('success', 'Protocole modifié avec succès.');
} else {
    $stmt = $db->prepare("
        INSERT INTO protocoles (user_id, nom, type_protocole, duree_jours, description, objectifs, phases, complements, alimentation, contre_indications)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt->execute([
        $userId, $nom, $typeProtocole, $dureeJours, $description, $objectifs,
        $phasesJson, $complementsJson, $alimentation, $contreIndications
    ]);
    flashSet('success', 'Protocole créé avec succès.');
}

redirect('protocoles');
