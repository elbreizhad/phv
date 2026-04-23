<?php
$db = getDB();
$userId = currentUserId();

// Stats
$totalClients = $db->prepare('SELECT COUNT(*) FROM clients WHERE user_id = ?');
$totalClients->execute([$userId]);
$nbClients = $totalClients->fetchColumn();

$totalConsultations = $db->prepare('SELECT COUNT(*) FROM consultations WHERE user_id = ?');
$totalConsultations->execute([$userId]);
$nbConsultations = $totalConsultations->fetchColumn();

$enCours = $db->prepare("SELECT COUNT(*) FROM consultations WHERE user_id = ? AND statut != 'terminee'");
$enCours->execute([$userId]);
$nbEnCours = $enCours->fetchColumn();

$terminees = $db->prepare("SELECT COUNT(*) FROM consultations WHERE user_id = ? AND statut = 'terminee'");
$terminees->execute([$userId]);
$nbTerminees = $terminees->fetchColumn();

// Dernières consultations avec détection V2 (trame_version OU présence v2_step%)
try {
    $recentConsult = $db->prepare("
        SELECT c.*, cl.nom AS client_nom, cl.prenom AS client_prenom,
            CASE WHEN c.trame_version = 'v2'
                 OR EXISTS (SELECT 1 FROM consultation_reponses r WHERE r.consultation_id = c.id AND r.section LIKE 'v2_step%')
            THEN 'v2' ELSE 'v1' END AS resolved_trame
        FROM consultations c
        JOIN clients cl ON c.client_id = cl.id
        WHERE c.user_id = ?
        ORDER BY c.updated_at DESC
        LIMIT 5
    ");
    $recentConsult->execute([$userId]);
    $dernieres = $recentConsult->fetchAll();
} catch (PDOException $e) {
    $fallback = $db->prepare("SELECT c.*, cl.nom AS client_nom, cl.prenom AS client_prenom, 'v1' AS resolved_trame FROM consultations c JOIN clients cl ON c.client_id = cl.id WHERE c.user_id = ? ORDER BY c.updated_at DESC LIMIT 5");
    $fallback->execute([$userId]);
    $dernieres = $fallback->fetchAll();
}

// Derniers clients
$recentClients = $db->prepare("SELECT * FROM clients WHERE user_id = ? ORDER BY created_at DESC LIMIT 5");
$recentClients->execute([$userId]);
$dernClients = $recentClients->fetchAll();
?>

<div class="page-header">
    <div>
        <h1>Tableau de bord</h1>
        <p class="subtitle">Bienvenue, <?= e(currentUserName()) ?></p>
    </div>
    <a href="<?= url('client-new') ?>" class="btn btn-primary">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="16" height="16"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Nouveau client
    </a>
</div>

<div class="page-body animate-in">
    <!-- Stats -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon green">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="22" height="22"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
            </div>
            <div class="stat-info">
                <h3><?= $nbClients ?></h3>
                <p>Clients</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon terra">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="22" height="22"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
            </div>
            <div class="stat-info">
                <h3><?= $nbConsultations ?></h3>
                <p>Consultations</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon gold">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="22" height="22"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            </div>
            <div class="stat-info">
                <h3><?= $nbEnCours ?></h3>
                <p>En cours</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon blue">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="22" height="22"><polyline points="20 6 9 17 4 12"/></svg>
            </div>
            <div class="stat-info">
                <h3><?= $nbTerminees ?></h3>
                <p>Terminées</p>
            </div>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
        <!-- Dernières consultations -->
        <div class="card">
            <div class="card-header">
                <h3>Consultations récentes</h3>
            </div>
            <div class="card-body" style="padding: 0;">
                <?php if (empty($dernieres)): ?>
                    <div class="empty-state" style="padding: 2rem;">
                        <p>Aucune consultation pour le moment.</p>
                        <a href="<?= url('clients') ?>" class="btn btn-outline btn-sm">Voir les clients</a>
                    </div>
                <?php else: ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Client</th>
                                <th>Motif</th>
                                <th>Statut</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($dernieres as $c): ?>
                            <?php
                            $stepPage = 'consultation-step' . $c['current_step'];
                            $statusBadge = match($c['statut']) {
                                'terminee' => 'badge-success',
                                'en_cours', 'questionnaire' => 'badge-warning',
                                'synthese' => 'badge-info',
                                'phv' => 'badge-sage',
                                default => 'badge-warning',
                            };
                            $statusLabel = match($c['statut']) {
                                'terminee' => 'Terminée',
                                'en_cours' => 'En cours',
                                'questionnaire' => 'Questionnaire',
                                'synthese' => 'Synthèse',
                                'phv' => 'PHV',
                                default => $c['statut'],
                            };
                            ?>
                            <tr>
                                <td><strong><?= e($c['client_prenom'] . ' ' . $c['client_nom']) ?></strong></td>
                                <td class="text-sm text-muted"><?= e(mb_strimwidth($c['motif'], 0, 40, '...')) ?></td>
                                <td><span class="badge <?= $statusBadge ?>"><?= $statusLabel ?></span></td>
                                <td style="display:flex;gap:.3rem;">
                                    <?php
                                    $isV2 = ($c['resolved_trame'] ?? 'v1') === 'v2';
                                    if ($isV2) {
                                        if ($c['statut'] === 'phv' || $c['statut'] === 'terminee') {
                                            $continueUrl = url('consultation-step6', ['id' => $c['id']]);
                                        } else {
                                            $continueUrl = url('consultation-v2', ['id' => $c['id'], 'step' => max(1, min(15, (int)$c['current_step']))]);
                                        }
                                    } else {
                                        $continueUrl = url($stepPage, ['id' => $c['id']]);
                                    }
                                    ?>
                                    <a href="<?= $continueUrl ?>" class="btn btn-outline btn-sm">Continuer</a>
                                    <form method="POST" action="<?= url('dashboard') ?>" style="display:inline;" onsubmit="return confirm('Supprimer cette consultation ?');">
                                        <input type="hidden" name="action" value="consultation-delete">
                                        <input type="hidden" name="consultation_id" value="<?= $c['id'] ?>">
                                        <input type="hidden" name="return_to" value="dashboard">
                                        <button type="submit" class="btn btn-sm" style="background:#fee;color:#d85a3d;border:1px solid #f5c5b8;" title="Supprimer">🗑</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>

        <!-- Derniers clients -->
        <div class="card">
            <div class="card-header">
                <h3>Derniers clients</h3>
                <a href="<?= url('client-new') ?>" class="btn btn-outline btn-sm">Ajouter</a>
            </div>
            <div class="card-body" style="padding: 0;">
                <?php if (empty($dernClients)): ?>
                    <div class="empty-state" style="padding: 2rem;">
                        <p>Aucun client enregistré.</p>
                        <a href="<?= url('client-new') ?>" class="btn btn-primary btn-sm">Ajouter un client</a>
                    </div>
                <?php else: ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Profession</th>
                                <th>Ajouté</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($dernClients as $cl): ?>
                            <tr>
                                <td><strong><?= e($cl['prenom'] . ' ' . $cl['nom']) ?></strong></td>
                                <td class="text-sm text-muted"><?= e($cl['profession'] ?: '-') ?></td>
                                <td class="text-sm text-muted"><?= timeAgo($cl['created_at']) ?></td>
                                <td>
                                    <a href="<?= url('client-view', ['id' => $cl['id']]) ?>" class="btn btn-outline btn-sm">Voir</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
