<?php
/**
 * Abonnement du praticien : statut courant, activation d'un code d'essai,
 * et packs disponibles (paiement en ligne à venir).
 */
$db = getDB();
$sub = getSubscription(currentUserId());
$plans = $db->query("SELECT * FROM subscription_plans WHERE actif = 1 ORDER BY prix_mensuel IS NULL, prix_mensuel ASC")->fetchAll();

$isActive = hasActiveSubscription(currentUserId());
?>

<div class="page-header">
    <div>
        <h1>Abonnement</h1>
        <p class="subtitle">Gérez votre accès à PHV Naturo</p>
    </div>
</div>

<div class="page-body animate-in">

    <div class="card" style="margin-bottom:1.5rem;">
        <div class="card-header">
            <h3>Statut actuel</h3>
        </div>
        <div class="card-body">
            <?php if (!$sub || $sub['statut'] === 'aucun'): ?>
                <p class="text-muted">Vous n'avez pas encore d'abonnement actif. Activez un code d'essai ci-dessous ou choisissez un pack.</p>
            <?php elseif ($isActive && $sub['statut'] === 'essai'): ?>
                <span class="badge badge-sage">Période d'essai</span>
                <p class="mt-2">Votre essai est actif jusqu'au <strong><?= formatDate($sub['date_fin']) ?></strong>.</p>
            <?php elseif ($isActive && $sub['statut'] === 'actif'): ?>
                <span class="badge badge-success">Abonnement actif</span>
                <p class="mt-2">Pack <strong><?= e($sub['plan_nom'] ?? '-') ?></strong><?= $sub['date_fin'] ? ' — valable jusqu\'au ' . formatDate($sub['date_fin']) : '' ?>.</p>
            <?php else: ?>
                <span class="badge badge-danger">Expiré</span>
                <p class="mt-2">Votre accès a expiré le <strong><?= formatDate($sub['date_fin']) ?></strong>. Activez un nouveau code ou souscrivez un pack pour continuer.</p>
            <?php endif; ?>
        </div>
    </div>

    <?php if (!$isActive): ?>
    <div class="card" style="margin-bottom:1.5rem;">
        <div class="card-header">
            <h3>Activer un code d'essai</h3>
        </div>
        <div class="card-body">
            <form method="POST" class="form-inline" style="display:flex;gap:0.75rem;align-items:flex-end;flex-wrap:wrap;">
                <input type="hidden" name="action" value="abonnement-activer-code">
                <div class="form-group" style="margin-bottom:0;">
                    <label>Code reçu de votre administrateur</label>
                    <input type="text" name="code" class="form-control" placeholder="EX: A1B2C3D4" style="text-transform:uppercase;" required>
                </div>
                <button type="submit" class="btn btn-primary">Activer</button>
            </form>
        </div>
    </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-header">
            <h3>Packs disponibles</h3>
        </div>
        <div class="card-body">
            <?php if (empty($plans)): ?>
                <p class="text-muted">Aucun pack configuré pour le moment.</p>
            <?php else: ?>
                <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:1rem;">
                    <?php foreach ($plans as $plan): ?>
                        <div class="card" style="margin:0;border:1px solid var(--border-color, #e5e0d8);">
                            <div class="card-body">
                                <h4 style="margin-top:0;"><?= e($plan['nom']) ?></h4>
                                <?php if ($plan['description']): ?>
                                    <p class="text-sm text-muted"><?= e($plan['description']) ?></p>
                                <?php endif; ?>
                                <p style="font-size:1.4rem;font-weight:600;">
                                    <?= $plan['prix_mensuel'] !== null ? number_format((float) $plan['prix_mensuel'], 2) . ' € / mois' : 'Sur devis' ?>
                                </p>
                                <button type="button" class="btn btn-outline" disabled title="Paiement en ligne bientôt disponible">
                                    Souscrire (bientôt)
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <p class="text-sm text-muted mt-2">Le paiement en ligne n'est pas encore activé — contactez votre administrateur pour un code d'accès en attendant.</p>
            <?php endif; ?>
        </div>
    </div>

</div>
