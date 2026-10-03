<?php
/**
 * Schéma des abonnements : packs (subscription_plans), abonnement courant
 * par praticien (subscriptions), codes d'essai générés par l'admin
 * (trial_codes). Auto-réparé à chaque déploiement, comme pour les autres
 * tables (voir phv-schema.php, tenant-schema.php).
 */
function syncSubscriptionSchema(PDO $db): array
{
    $log = [];

    $subscriptionsTableExisted = (bool) $db->query("SHOW TABLES LIKE 'subscriptions'")->fetch();

    $db->exec("CREATE TABLE IF NOT EXISTS subscription_plans (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nom VARCHAR(100) NOT NULL,
        description TEXT NULL,
        prix_mensuel DECIMAL(10,2) NULL,
        duree_jours INT NULL,
        actif TINYINT(1) NOT NULL DEFAULT 1,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

    $db->exec("CREATE TABLE IF NOT EXISTS subscriptions (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL UNIQUE,
        plan_id INT NULL,
        statut ENUM('aucun','essai','actif','expire','annule') NOT NULL DEFAULT 'aucun',
        date_debut DATE NULL,
        date_fin DATE NULL,
        source VARCHAR(50) NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

    $db->exec("CREATE TABLE IF NOT EXISTS trial_codes (
        id INT AUTO_INCREMENT PRIMARY KEY,
        code VARCHAR(50) NOT NULL UNIQUE,
        duree_jours INT NOT NULL,
        usage_max INT NOT NULL DEFAULT 1,
        usage_count INT NOT NULL DEFAULT 0,
        actif TINYINT(1) NOT NULL DEFAULT 1,
        expires_at DATE NULL,
        created_by INT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

    $log[] = 'Tables abonnements vérifiées (subscription_plans, subscriptions, trial_codes).';

    $nbPlans = (int) $db->query("SELECT COUNT(*) FROM subscription_plans")->fetchColumn();
    if ($nbPlans === 0) {
        $db->prepare("INSERT INTO subscription_plans (nom, description, prix_mensuel, duree_jours, actif) VALUES (?, ?, ?, NULL, 1)")
            ->execute(['Standard', 'Accès complet à l\'outil PHV Naturo.', 29.00]);
        $log[] = 'Pack "Standard" créé par défaut (paiement en ligne à venir).';
    }

    // La table subscriptions vient d'être créée : les praticiens déjà présents
    // avant l'introduction de cette fonctionnalité ne doivent pas être
    // bloqués rétroactivement. On leur conserve un accès actif ; seuls les
    // praticiens créés après cette migration seront verrouillés par défaut.
    if (!$subscriptionsTableExisted) {
        $existingUserIds = $db->query("SELECT id FROM users WHERE role != 'admin'")->fetchAll(PDO::FETCH_COLUMN);
        foreach ($existingUserIds as $uid) {
            $db->prepare("INSERT IGNORE INTO subscriptions (user_id, plan_id, statut, date_debut, source) VALUES (?, NULL, 'actif', CURDATE(), 'grandfather')")
                ->execute([$uid]);
        }
        if (!empty($existingUserIds)) {
            $log[] = count($existingUserIds) . " praticien(s) déjà existant(s) conservé(s) en accès actif (pas de verrouillage rétroactif).";
        }
    }

    return $log;
}
