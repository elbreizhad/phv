<?php
/**
 * Statistiques du cabinet
 */
$db = getDB();
$userId = currentUserId();

$annee = (int)getGet('annee', date('Y'));
$moisActuel = (int)date('n');

// CA par mois
$caMensuel = [];
for ($m = 1; $m <= 12; $m++) {
    $stmt = $db->prepare("
        SELECT COALESCE(SUM(montant_ttc), 0) as ca
        FROM factures
        WHERE user_id = ? AND statut = 'payee' AND MONTH(date_paiement) = ? AND YEAR(date_paiement) = ?
    ");
    $stmt->execute([$userId, $m, $annee]);
    $caMensuel[$m] = (float)$stmt->fetchColumn();
}

// Consultations par mois
$consultMensuel = [];
for ($m = 1; $m <= 12; $m++) {
    $stmt = $db->prepare("
        SELECT COUNT(*) as nb
        FROM consultations
        WHERE user_id = ? AND MONTH(date_consultation) = ? AND YEAR(date_consultation) = ?
    ");
    $stmt->execute([$userId, $m, $annee]);
    $consultMensuel[$m] = (int)$stmt->fetchColumn();
}

// Totaux annuels
$totalCA = array_sum($caMensuel);
$totalConsult = array_sum($consultMensuel);
$moyenneParConsult = $totalConsult > 0 ? $totalCA / $totalConsult : 0;

// Nouveaux clients cette année
$stmt = $db->prepare("SELECT COUNT(*) FROM clients WHERE user_id = ? AND YEAR(created_at) = ?");
$stmt->execute([$userId, $annee]);
$nouveauxClients = $stmt->fetchColumn();

// Top motifs de consultation
$stmt = $db->prepare("
    SELECT motif_categorie, COUNT(*) as nb
    FROM consultations
    WHERE user_id = ? AND YEAR(date_consultation) = ? AND motif_categorie IS NOT NULL
    GROUP BY motif_categorie
    ORDER BY nb DESC
    LIMIT 5
");
$stmt->execute([$userId, $annee]);
$topMotifs = $stmt->fetchAll();

// Taux de suivi (clients avec > 1 consultation)
$stmt = $db->prepare("
    SELECT COUNT(DISTINCT client_id) as clients_fideles
    FROM consultations c1
    WHERE user_id = ? AND EXISTS (
        SELECT 1 FROM consultations c2 WHERE c2.client_id = c1.client_id AND c2.id != c1.id
    )
");
$stmt->execute([$userId]);
$clientsFideles = $stmt->fetchColumn();

$stmt = $db->prepare("SELECT COUNT(*) FROM clients WHERE user_id = ?");
$stmt->execute([$userId]);
$totalClients = $stmt->fetchColumn();
$tauxFidelite = $totalClients > 0 ? round(($clientsFideles / $totalClients) * 100) : 0;

// RDV stats
$stmt = $db->prepare("
    SELECT
        COUNT(*) as total,
        SUM(CASE WHEN statut = 'termine' THEN 1 ELSE 0 END) as termines,
        SUM(CASE WHEN statut = 'annule' THEN 1 ELSE 0 END) as annules,
        SUM(CASE WHEN statut = 'no_show' THEN 1 ELSE 0 END) as no_shows
    FROM rendez_vous
    WHERE user_id = ? AND YEAR(date_rdv) = ?
");
$stmt->execute([$userId, $annee]);
$rdvStats = $stmt->fetch();
$tauxAnnulation = $rdvStats['total'] > 0 ? round((($rdvStats['annules'] + $rdvStats['no_shows']) / $rdvStats['total']) * 100) : 0;

$moisNoms = ['', 'Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'];
?>

<div class="page-header">
    <div>
        <h1>Statistiques</h1>
        <p class="subtitle">Analyse de votre activité</p>
    </div>
    <div class="d-flex gap-1 align-center">
        <a href="<?= url('statistiques', ['annee' => $annee - 1]) ?>" class="btn btn-secondary btn-sm">&larr; <?= $annee - 1 ?></a>
        <span style="padding: 0 1rem; font-weight: 600;"><?= $annee ?></span>
        <?php if ($annee < date('Y')): ?>
            <a href="<?= url('statistiques', ['annee' => $annee + 1]) ?>" class="btn btn-secondary btn-sm"><?= $annee + 1 ?> &rarr;</a>
        <?php endif; ?>
    </div>
</div>

<div class="page-body animate-in">
    <!-- KPIs -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon green">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="22" height="22"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
            </div>
            <div class="stat-info">
                <h3><?= number_format($totalCA, 0, ',', ' ') ?> €</h3>
                <p>CA Total <?= $annee ?></p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon terra">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="22" height="22"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
            </div>
            <div class="stat-info">
                <h3><?= $totalConsult ?></h3>
                <p>Consultations</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon blue">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="22" height="22"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
            </div>
            <div class="stat-info">
                <h3><?= $nouveauxClients ?></h3>
                <p>Nouveaux clients</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon gold">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="22" height="22"><polyline points="20 6 9 17 4 12"/></svg>
            </div>
            <div class="stat-info">
                <h3><?= number_format($moyenneParConsult, 0, ',', ' ') ?> €</h3>
                <p>Panier moyen</p>
            </div>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem; margin-top: 1.5rem;">
        <!-- Graphique CA -->
        <div class="card">
            <div class="card-header">
                <h3>Chiffre d'affaires mensuel</h3>
            </div>
            <div class="card-body">
                <div class="chart-container" style="height: 300px;">
                    <canvas id="caChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Top motifs -->
        <div class="card">
            <div class="card-header">
                <h3>Motifs de consultation</h3>
            </div>
            <div class="card-body">
                <?php if (empty($topMotifs)): ?>
                    <p class="text-muted">Aucune donnée disponible.</p>
                <?php else: ?>
                    <div class="motifs-list">
                        <?php foreach ($topMotifs as $motif): ?>
                            <?php $label = MOTIF_CATEGORIES[$motif['motif_categorie']] ?? $motif['motif_categorie']; ?>
                            <div class="motif-item">
                                <div class="motif-info">
                                    <span class="motif-label"><?= e($label) ?></span>
                                    <span class="motif-count"><?= $motif['nb'] ?></span>
                                </div>
                                <div class="motif-bar">
                                    <div class="motif-bar-fill" style="width: <?= round(($motif['nb'] / $totalConsult) * 100) ?>%;"></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; margin-top: 1.5rem;">
        <!-- Graphique Consultations -->
        <div class="card">
            <div class="card-header">
                <h3>Consultations / mois</h3>
            </div>
            <div class="card-body">
                <div class="chart-container" style="height: 200px;">
                    <canvas id="consultChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Taux de fidélité -->
        <div class="card">
            <div class="card-header">
                <h3>Fidélisation</h3>
            </div>
            <div class="card-body text-center">
                <div class="gauge-container">
                    <div class="gauge">
                        <svg viewBox="0 0 100 50" style="width: 150px;">
                            <path d="M 10 50 A 40 40 0 0 1 90 50" fill="none" stroke="#e4ebe0" stroke-width="10" stroke-linecap="round"/>
                            <path d="M 10 50 A 40 40 0 0 1 90 50" fill="none" stroke="#4a6741" stroke-width="10" stroke-linecap="round" stroke-dasharray="<?= $tauxFidelite * 1.26 ?> 126"/>
                        </svg>
                        <div class="gauge-value"><?= $tauxFidelite ?>%</div>
                    </div>
                    <p class="text-sm text-muted mt-1">Clients avec plusieurs consultations</p>
                </div>
            </div>
        </div>

        <!-- Taux d'annulation -->
        <div class="card">
            <div class="card-header">
                <h3>Rendez-vous</h3>
            </div>
            <div class="card-body">
                <div class="rdv-stats">
                    <div class="rdv-stat-item">
                        <span class="rdv-stat-label">Total RDV</span>
                        <span class="rdv-stat-value"><?= $rdvStats['total'] ?? 0 ?></span>
                    </div>
                    <div class="rdv-stat-item">
                        <span class="rdv-stat-label">Terminés</span>
                        <span class="rdv-stat-value text-success"><?= $rdvStats['termines'] ?? 0 ?></span>
                    </div>
                    <div class="rdv-stat-item">
                        <span class="rdv-stat-label">Annulés</span>
                        <span class="rdv-stat-value text-danger"><?= $rdvStats['annules'] ?? 0 ?></span>
                    </div>
                    <div class="rdv-stat-item">
                        <span class="rdv-stat-label">No-shows</span>
                        <span class="rdv-stat-value text-danger"><?= $rdvStats['no_shows'] ?? 0 ?></span>
                    </div>
                    <div class="rdv-stat-item" style="border-top: 1px solid var(--cream-200); padding-top: 0.5rem; margin-top: 0.5rem;">
                        <span class="rdv-stat-label">Taux d'annulation</span>
                        <span class="rdv-stat-value <?= $tauxAnnulation > 15 ? 'text-danger' : '' ?>"><?= $tauxAnnulation ?>%</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
const mois = <?= json_encode(array_slice($moisNoms, 1)) ?>;
const caData = <?= json_encode(array_values($caMensuel)) ?>;
const consultData = <?= json_encode(array_values($consultMensuel)) ?>;

// Graphique CA
new Chart(document.getElementById('caChart'), {
    type: 'bar',
    data: {
        labels: mois,
        datasets: [{
            label: 'CA (€)',
            data: caData,
            backgroundColor: 'rgba(74, 103, 65, 0.7)',
            borderColor: 'rgba(74, 103, 65, 1)',
            borderWidth: 1,
            borderRadius: 4
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            y: { beginAtZero: true, ticks: { callback: v => v + ' €' } }
        }
    }
});

// Graphique Consultations
new Chart(document.getElementById('consultChart'), {
    type: 'line',
    data: {
        labels: mois,
        datasets: [{
            label: 'Consultations',
            data: consultData,
            borderColor: '#a85a3a',
            backgroundColor: 'rgba(168, 90, 58, 0.1)',
            fill: true,
            tension: 0.3
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: true } }
    }
});
</script>

<style>
.motifs-list { display: flex; flex-direction: column; gap: 0.8rem; }
.motif-item {}
.motif-info { display: flex; justify-content: space-between; margin-bottom: 0.3rem; }
.motif-label { font-size: 0.85rem; color: var(--text-secondary); }
.motif-count { font-weight: 600; color: var(--sage-700); }
.motif-bar { height: 6px; background: var(--cream-200); border-radius: 3px; overflow: hidden; }
.motif-bar-fill { height: 100%; background: var(--sage-500); border-radius: 3px; transition: width 0.5s ease; }

.gauge-container { padding: 1rem 0; }
.gauge { position: relative; display: inline-block; }
.gauge-value { position: absolute; bottom: 0; left: 50%; transform: translateX(-50%); font-size: 1.5rem; font-weight: 700; color: var(--sage-700); }

.rdv-stats { display: flex; flex-direction: column; gap: 0.5rem; }
.rdv-stat-item { display: flex; justify-content: space-between; align-items: center; }
.rdv-stat-label { font-size: 0.85rem; color: var(--text-muted); }
.rdv-stat-value { font-weight: 600; }
.text-success { color: var(--success); }
.text-danger { color: var(--danger); }
</style>
