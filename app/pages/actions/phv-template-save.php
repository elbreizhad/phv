<?php
/**
 * Action: Sauvegarder un template PHV
 */
$db = getDB();
$userId = currentUserId();

$templateId = (int)getPost('template_id');
$nom = getPost('nom');
$motifCategorie = getPost('motif_categorie') ?: null;
$description = getPost('description');
$alimentation = getPost('alimentation');
$alimentationEviter = getPost('alimentation_eviter');
$alimentationPrivilegier = getPost('alimentation_privilegier');
$menuType = getPost('menu_type');
$activitePhysique = getPost('activite_physique');
$gestionStress = getPost('gestion_stress');
$routineMatin = getPost('routine_matin');
$routineSoir = getPost('routine_soir');
$complements = getPost('complements');
$soinsNaturels = getPost('soins_naturels');
$recommandations = getPost('recommandations_complementaires');

if ($templateId) {
    // Vérifier propriété
    $checkStmt = $db->prepare("SELECT id FROM phv_templates WHERE id = ? AND user_id = ?");
    $checkStmt->execute([$templateId, $userId]);
    if (!$checkStmt->fetch()) {
        flashSet('error', 'Template non trouvé.');
        redirect('phv-templates');
    }

    $stmt = $db->prepare("
        UPDATE phv_templates SET
            nom = ?, motif_categorie = ?, description = ?,
            alimentation = ?, alimentation_eviter = ?, alimentation_privilegier = ?, menu_type = ?,
            activite_physique = ?, gestion_stress = ?, routine_matin = ?, routine_soir = ?,
            complements = ?, soins_naturels = ?, recommandations_complementaires = ?
        WHERE id = ? AND user_id = ?
    ");
    $stmt->execute([
        $nom, $motifCategorie, $description,
        $alimentation, $alimentationEviter, $alimentationPrivilegier, $menuType,
        $activitePhysique, $gestionStress, $routineMatin, $routineSoir,
        $complements, $soinsNaturels, $recommandations,
        $templateId, $userId
    ]);
    flashSet('success', 'Template modifié avec succès.');
} else {
    $stmt = $db->prepare("
        INSERT INTO phv_templates (user_id, nom, motif_categorie, description, alimentation, alimentation_eviter, alimentation_privilegier, menu_type, activite_physique, gestion_stress, routine_matin, routine_soir, complements, soins_naturels, recommandations_complementaires)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt->execute([
        $userId, $nom, $motifCategorie, $description,
        $alimentation, $alimentationEviter, $alimentationPrivilegier, $menuType,
        $activitePhysique, $gestionStress, $routineMatin, $routineSoir,
        $complements, $soinsNaturels, $recommandations
    ]);
    flashSet('success', 'Template créé avec succès.');
}

redirect('phv-templates');
