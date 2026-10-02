<?php
/**
 * Schéma multi-praticien : rôle/statut sur `users`, protocoles communs
 * (comme les recettes le sont déjà), et unicité des numéros de facture par
 * praticien au lieu d'être globale. Auto-réparé à chaque déploiement, comme
 * pour la table `phv` (voir phv-schema.php) : évite de dépendre d'un script
 * SQL à exécuter à la main.
 */
function syncTenantSchema(PDO $db): array
{
    $log = [];

    // --- users : rôle + statut actif ---
    $userCols = $db->query("SHOW COLUMNS FROM users")->fetchAll(PDO::FETCH_COLUMN);

    if (!in_array('role', $userCols, true)) {
        $db->exec("ALTER TABLE users ADD COLUMN role ENUM('admin','praticien') NOT NULL DEFAULT 'praticien' AFTER username");
        $log[] = 'users.role ajoutée';
    }
    if (!in_array('actif', $userCols, true)) {
        $db->exec("ALTER TABLE users ADD COLUMN actif TINYINT(1) NOT NULL DEFAULT 1 AFTER role");
        $log[] = 'users.actif ajoutée';
    }

    // Promouvoir le premier compte en admin s'il n'y a encore aucun admin
    // (cas du passage d'une installation solo à multi-praticien).
    $hasAdmin = (int) $db->query("SELECT COUNT(*) FROM users WHERE role = 'admin'")->fetchColumn();
    if ($hasAdmin === 0) {
        $firstId = (int) $db->query("SELECT MIN(id) FROM users")->fetchColumn();
        if ($firstId) {
            $db->prepare("UPDATE users SET role = 'admin' WHERE id = ?")->execute([$firstId]);
            $log[] = "utilisateur #$firstId promu administrateur (aucun admin existant)";
        }
    }

    // --- protocoles : rendre user_id nullable pour une bibliothèque commune,
    //     comme pour les recettes (user_id NULL = protocole partagé) ---
    $protoCol = $db->query("SHOW COLUMNS FROM protocoles WHERE Field = 'user_id'")->fetch();
    if ($protoCol && stripos((string) $protoCol['Null'], 'NO') === 0) {
        try {
            $db->exec("ALTER TABLE protocoles MODIFY COLUMN user_id INT NULL");
            $log[] = 'protocoles.user_id rendue nullable (bibliothèque commune)';
        } catch (PDOException $e) {
            // Déjà modifiée ou contrainte en cours ailleurs : on continue.
        }
    }

    // --- factures : unicité du numéro par praticien, pas globale ---
    try {
        $oldIndex = $db->query("SHOW INDEX FROM factures WHERE Key_name = 'numero_facture'")->fetchAll();
        if (!empty($oldIndex)) {
            $db->exec("ALTER TABLE factures DROP INDEX numero_facture");
            $log[] = "factures : ancienne contrainte d'unicité globale retirée";
        }
    } catch (PDOException $e) {
        // Pas trouvée / déjà retirée.
    }
    try {
        $newIndex = $db->query("SHOW INDEX FROM factures WHERE Key_name = 'uniq_user_numero'")->fetchAll();
        if (empty($newIndex)) {
            $db->exec("ALTER TABLE factures ADD UNIQUE KEY uniq_user_numero (user_id, numero_facture)");
            $log[] = 'factures : unicité du numéro par praticien ajoutée';
        }
    } catch (PDOException $e) {
        // Doublons existants empêchant la contrainte, ou déjà présente : on continue sans bloquer le déploiement.
    }

    return $log;
}
