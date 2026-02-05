<?php
/**
 * Action: Sauvegarder une recette
 */
$db = getDB();
$userId = currentUserId();

$recetteId = (int)getPost('recette_id');
$nom = getPost('nom');
$categorie = getPost('categorie', 'plat');
$tempsPreparation = getPost('temps_preparation') ?: null;
$tempsCuisson = getPost('temps_cuisson') ?: null;
$portions = (int)getPost('portions', 4);
$ingredients = getPost('ingredients');
$instructions = getPost('instructions');
$source = getPost('source');

$regimes = $_POST['regimes'] ?? [];
$allergenes = $_POST['allergenes'] ?? [];

$regimesJson = !empty($regimes) ? json_encode($regimes) : null;
$allergenesJson = !empty($allergenes) ? json_encode($allergenes) : null;

if ($recetteId) {
    // Vérifier propriété
    $checkStmt = $db->prepare("SELECT id FROM recettes WHERE id = ? AND user_id = ?");
    $checkStmt->execute([$recetteId, $userId]);
    if (!$checkStmt->fetch()) {
        flashSet('error', 'Vous ne pouvez pas modifier cette recette.');
        redirect('recettes');
    }

    $stmt = $db->prepare("
        UPDATE recettes SET
            nom = ?, categorie = ?, temps_preparation = ?, temps_cuisson = ?, portions = ?,
            ingredients = ?, instructions = ?, regimes = ?, allergenes = ?, source = ?
        WHERE id = ? AND user_id = ?
    ");
    $stmt->execute([
        $nom, $categorie, $tempsPreparation, $tempsCuisson, $portions,
        $ingredients, $instructions, $regimesJson, $allergenesJson, $source,
        $recetteId, $userId
    ]);
    flashSet('success', 'Recette modifiée avec succès.');
} else {
    $stmt = $db->prepare("
        INSERT INTO recettes (user_id, nom, categorie, temps_preparation, temps_cuisson, portions, ingredients, instructions, regimes, allergenes, source)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt->execute([
        $userId, $nom, $categorie, $tempsPreparation, $tempsCuisson, $portions,
        $ingredients, $instructions, $regimesJson, $allergenesJson, $source
    ]);
    flashSet('success', 'Recette créée avec succès.');
}

redirect('recettes');
