<?php
/**
 * Statut d'abonnement du praticien : essai via code, ou abonnement payant
 * (packs futurs, paiement à intégrer). Tant qu'aucun des deux n'est actif,
 * l'accès au site est verrouillé sur la page Abonnement (voir index.php).
 * Les administrateurs ne sont jamais soumis à ce verrou.
 */

function getSubscription(int $userId): ?array {
    $stmt = getDB()->prepare(
        "SELECT s.*, p.nom AS plan_nom, p.prix_mensuel
         FROM subscriptions s
         LEFT JOIN subscription_plans p ON p.id = s.plan_id
         WHERE s.user_id = ?"
    );
    $stmt->execute([$userId]);
    $sub = $stmt->fetch();
    return $sub ?: null;
}

function hasActiveSubscription(int $userId): bool {
    $sub = getSubscription($userId);
    if (!$sub || !in_array($sub['statut'], ['essai', 'actif'], true)) {
        return false;
    }
    if ($sub['date_fin'] !== null && $sub['date_fin'] < date('Y-m-d')) {
        // Expiration passée : on fige le statut pour que l'historique soit clair.
        getDB()->prepare("UPDATE subscriptions SET statut = 'expire' WHERE user_id = ?")->execute([$userId]);
        return false;
    }
    return true;
}

function redeemTrialCode(int $userId, string $code): array {
    $code = strtoupper(trim($code));
    if ($code === '') {
        return ['success' => false, 'message' => 'Merci de saisir un code.'];
    }

    $db = getDB();
    $stmt = $db->prepare("SELECT * FROM trial_codes WHERE code = ? AND actif = 1");
    $stmt->execute([$code]);
    $trial = $stmt->fetch();

    if (!$trial) {
        return ['success' => false, 'message' => 'Code invalide ou désactivé.'];
    }
    if ($trial['expires_at'] !== null && $trial['expires_at'] < date('Y-m-d')) {
        return ['success' => false, 'message' => 'Ce code a expiré.'];
    }
    if ((int) $trial['usage_count'] >= (int) $trial['usage_max']) {
        return ['success' => false, 'message' => 'Ce code a déjà été utilisé le nombre maximal de fois.'];
    }

    $dateDebut = date('Y-m-d');
    $dateFin = date('Y-m-d', strtotime('+' . (int) $trial['duree_jours'] . ' days'));

    $existing = $db->prepare("SELECT id FROM subscriptions WHERE user_id = ?");
    $existing->execute([$userId]);
    if ($existing->fetch()) {
        $db->prepare("UPDATE subscriptions SET statut = 'essai', plan_id = NULL, date_debut = ?, date_fin = ?, source = ? WHERE user_id = ?")
            ->execute([$dateDebut, $dateFin, 'code:' . $code, $userId]);
    } else {
        $db->prepare("INSERT INTO subscriptions (user_id, plan_id, statut, date_debut, date_fin, source) VALUES (?, NULL, 'essai', ?, ?, ?)")
            ->execute([$userId, $dateDebut, $dateFin, 'code:' . $code]);
    }

    $db->prepare("UPDATE trial_codes SET usage_count = usage_count + 1 WHERE id = ?")->execute([$trial['id']]);

    return ['success' => true, 'message' => "Période d'essai activée jusqu'au " . formatDate($dateFin) . "."];
}

function generateTrialCode(int $createdBy, int $dureeJours, int $usageMax, ?string $expiresAt): string {
    $db = getDB();
    do {
        $code = strtoupper(substr(bin2hex(random_bytes(4)), 0, 8));
        $exists = $db->prepare("SELECT id FROM trial_codes WHERE code = ?");
        $exists->execute([$code]);
    } while ($exists->fetch());

    $db->prepare("INSERT INTO trial_codes (code, duree_jours, usage_max, expires_at, created_by) VALUES (?, ?, ?, ?, ?)")
        ->execute([$code, $dureeJours, $usageMax, $expiresAt ?: null, $createdBy]);

    return $code;
}
