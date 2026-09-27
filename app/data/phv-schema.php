<?php
/**
 * Colonnes de la table `phv` ajoutées progressivement au fil des demandes,
 * jusqu'ici appliquées à la main via des fichiers SQL de migration.
 * Ce fichier auto-répare le schéma à chaque déploiement (comme pour
 * ressources/fiches/recettes/protocoles), pour éviter qu'un champ saisi
 * dans le formulaire ne soit jamais sauvegardé faute de colonne créée
 * (cas vécu avec prochain_rdv / prochain_rdv_notes).
 */

const PHV_COLONNES_ATTENDUES = [
    'objectifs' => 'TEXT NULL',
    'soutien_emotionnel' => 'TEXT NULL',
    'points_attention' => 'TEXT NULL',
    'inclure_tableau_ig' => 'TINYINT(1) NOT NULL DEFAULT 0',
    'prochain_rdv' => 'DATE NULL',
    'prochain_rdv_notes' => 'TEXT NULL',
];

/**
 * Ajoute les colonnes manquantes de la table `phv`. Sûr à ré-exécuter à
 * chaque déploiement (vérifie l'existence avant d'ajouter).
 */
function syncPhvSchema(PDO $db): array
{
    $ajoutees = [];

    $existantes = $db->query("SHOW COLUMNS FROM phv")->fetchAll(PDO::FETCH_COLUMN);

    foreach (PHV_COLONNES_ATTENDUES as $colonne => $definition) {
        if (in_array($colonne, $existantes, true)) {
            continue;
        }
        try {
            $db->exec("ALTER TABLE phv ADD COLUMN `$colonne` $definition");
            $ajoutees[] = $colonne;
        } catch (PDOException $e) {
            // Colonne déjà ajoutée entre-temps (déploiement concurrent) ou autre souci : on continue.
        }
    }

    return $ajoutees;
}
