<?php
/**
 * Ressources documentaires transversales : phytologie, aromatologie,
 * micronutrition, hydrologie, gestion du stress, alimentation générale...
 *
 * Une seule table `ressources`, auto-créée au premier déploiement, avec des
 * champs génériques réutilisés différemment selon la section (une huile
 * essentielle n'a pas de "sources_alimentaires", une vitamine n'a pas de
 * "synergies", etc. - les champs non pertinents restent simplement vides).
 */

/**
 * Phytologie — 66 plantes médicinales, 9 sphères (ESN).
 */
function getRessourcesPhytologie(): array {
    return [
        // Chaque entrée : nom, partie_utilisee, indication, contre_indications,
        // posologie (galénique), synergies. 'categorie' = la sphère (ex: "Sphère nerveuse").
    ];
}

function ressourcesCreerTable(PDO $db): void {
    $db->exec("CREATE TABLE IF NOT EXISTS ressources (
        id INT AUTO_INCREMENT PRIMARY KEY,
        section VARCHAR(50) NOT NULL,
        categorie VARCHAR(150) NOT NULL,
        nom VARCHAR(200) NOT NULL,
        partie_utilisee VARCHAR(200),
        description TEXT,
        indication TEXT,
        contre_indications TEXT,
        posologie TEXT,
        conseil_du_moment TEXT,
        proprietes TEXT,
        sources_alimentaires TEXT,
        synergies TEXT,
        notes TEXT,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        INDEX idx_section (section)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
}

/**
 * Synchronise une section de ressources : crée la table si besoin, insère les
 * fiches manquantes et met à jour celles déjà présentes (comparaison par
 * section + nom).
 * @return array{inserted: string[], updated: string[]}
 */
function syncRessourcesSection(PDO $db, string $section, array $items): array {
    ressourcesCreerTable($db);

    $existingStmt = $db->prepare("SELECT id, nom FROM ressources WHERE section = ?");
    $existingStmt->execute([$section]);
    $existingByNom = [];
    foreach ($existingStmt->fetchAll() as $row) {
        $existingByNom[mb_strtolower($row['nom'])] = $row['id'];
    }

    $insertStmt = $db->prepare("INSERT INTO ressources (section, categorie, nom, partie_utilisee, description, indication, contre_indications, posologie, conseil_du_moment, proprietes, sources_alimentaires, synergies, notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $updateStmt = $db->prepare("UPDATE ressources SET categorie = ?, partie_utilisee = ?, description = ?, indication = ?, contre_indications = ?, posologie = ?, conseil_du_moment = ?, proprietes = ?, sources_alimentaires = ?, synergies = ?, notes = ? WHERE id = ?");

    $inserted = [];
    $updated = [];
    foreach ($items as $it) {
        $it += ['partie_utilisee' => '', 'description' => '', 'indication' => '', 'contre_indications' => '', 'posologie' => '', 'conseil_du_moment' => '', 'proprietes' => '', 'sources_alimentaires' => '', 'synergies' => '', 'notes' => ''];
        $key = mb_strtolower($it['nom']);
        if (isset($existingByNom[$key])) {
            $updateStmt->execute([
                $it['categorie'], $it['partie_utilisee'], $it['description'], $it['indication'],
                $it['contre_indications'], $it['posologie'], $it['conseil_du_moment'], $it['proprietes'],
                $it['sources_alimentaires'], $it['synergies'], $it['notes'], $existingByNom[$key],
            ]);
            $updated[] = $it['nom'];
        } else {
            $insertStmt->execute([
                $section, $it['categorie'], $it['nom'], $it['partie_utilisee'], $it['description'], $it['indication'],
                $it['contre_indications'], $it['posologie'], $it['conseil_du_moment'], $it['proprietes'],
                $it['sources_alimentaires'], $it['synergies'], $it['notes'],
            ]);
            $inserted[] = $it['nom'];
        }
    }

    return ['inserted' => $inserted, 'updated' => $updated];
}

/**
 * Synchronise toutes les sections de ressources actuellement disponibles.
 * @return array{inserted: string[], updated: string[]}
 */
function syncRessources(PDO $db): array {
    $totalInserted = [];
    $totalUpdated = [];

    $sections = [
        'phytologie' => getRessourcesPhytologie(),
        // 'aromatologie' => getRessourcesAromatologie(), // à venir
    ];

    foreach ($sections as $section => $items) {
        if (empty($items)) continue;
        $result = syncRessourcesSection($db, $section, $items);
        $totalInserted = array_merge($totalInserted, $result['inserted']);
        $totalUpdated = array_merge($totalUpdated, $result['updated']);
    }

    return ['inserted' => $totalInserted, 'updated' => $totalUpdated];
}
