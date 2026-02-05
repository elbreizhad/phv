<?php
/**
 * Évolution des paramètres client (graphiques)
 */
$db = getDB();
$userId = currentUserId();
$clientId = (int)getGet('id');

// Vérifier que le client appartient au praticien
$clientStmt = $db->prepare("SELECT * FROM clients WHERE id = ? AND user_id = ?");
$clientStmt->execute([$clientId, $userId]);
$client = $clientStmt->fetch();

if (!$client) {
    flashSet('error', 'Client non trouvé.');
    redirect('clients');
}

// Récupérer les mesures
$mesuresStmt = $db->prepare("
    SELECT * FROM client_mesures
    WHERE client_id = ?
    ORDER BY date_mesure ASC
");
$mesuresStmt->execute([$clientId]);
$mesures = $mesuresStmt->fetchAll();

// Récupérer les objectifs
$objectifsStmt = $db->prepare("SELECT * FROM client_objectifs WHERE client_id = ? ORDER BY date_debut DESC");
$objectifsStmt->execute([$clientId]);
$objectifs = $objectifsStmt->fetchAll();

// Dernière mesure
$derniereMesure = !empty($mesures) ? end($mesures) : null;

// Préparer données pour graphiques
$dates = [];
$poids = [];
$stress = [];
$sommeil = [];
$energie = [];

foreach ($mesures as $m) {
    $dates[] = date('d/m', strtotime($m['date_mesure']));
    $poids[] = $m['poids_kg'];
    $stress[] = $m['niveau_stress'];
    $sommeil[] = $m['qualite_sommeil'];
    $energie[] = $m['niveau_energie'];
}
?>

<div class="page-header">
    <div>
        <h1>Évolution - <?= e($client['prenom'] . ' ' . $client['nom']) ?></h1>
        <p class="subtitle">Suivi des paramètres de santé</p>
    </div>
    <div class="d-flex gap-1">
        <a href="<?= url('client-view', ['id' => $clientId]) ?>" class="btn btn-secondary">Retour au profil</a>
        <button type="button" class="btn btn-primary" onclick="openMesureModal()">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Nouvelle mesure
        </button>
    </div>
</div>

<div class="page-body animate-in">
    <!-- Indicateurs actuels -->
    <?php if ($derniereMesure): ?>
    <div class="stats-grid" style="margin-bottom: 1.5rem;">
        <div class="stat-card">
            <div class="stat-icon green">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="22" height="22"><path d="M12 2a10 10 0 1 0 10 10H12V2z"/></svg>
            </div>
            <div class="stat-info">
                <h3><?= $derniereMesure['poids_kg'] ? number_format($derniereMesure['poids_kg'], 1) . ' kg' : '-' ?></h3>
                <p>Poids actuel</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon <?= $derniereMesure['niveau_stress'] > 6 ? 'terra' : 'blue' ?>">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="22" height="22"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
            </div>
            <div class="stat-info">
                <h3><?= $derniereMesure['niveau_stress'] ?? '-' ?>/10</h3>
                <p>Stress</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon <?= $derniereMesure['qualite_sommeil'] < 5 ? 'terra' : 'green' ?>">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="22" height="22"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
            </div>
            <div class="stat-info">
                <h3><?= $derniereMesure['qualite_sommeil'] ?? '-' ?>/10</h3>
                <p>Sommeil</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon gold">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="22" height="22"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
            </div>
            <div class="stat-info">
                <h3><?= $derniereMesure['niveau_energie'] ?? '-' ?>/10</h3>
                <p>Énergie</p>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem;">
        <!-- Graphiques -->
        <div>
            <?php if (count($mesures) >= 2): ?>
            <div class="card" style="margin-bottom: 1.5rem;">
                <div class="card-header">
                    <h3>Évolution du poids</h3>
                </div>
                <div class="card-body">
                    <canvas id="poidsChart" height="150"></canvas>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3>Paramètres de bien-être</h3>
                </div>
                <div class="card-body">
                    <canvas id="bienEtreChart" height="200"></canvas>
                </div>
            </div>
            <?php else: ?>
            <div class="card">
                <div class="card-body">
                    <div class="empty-state">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="48" height="48"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
                        <h3>Pas assez de données</h3>
                        <p>Ajoutez au moins 2 mesures pour voir les graphiques d'évolution.</p>
                        <button type="button" class="btn btn-primary" onclick="openMesureModal()">Ajouter une mesure</button>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <!-- Objectifs -->
        <div>
            <div class="card">
                <div class="card-header">
                    <h3>Objectifs</h3>
                    <a href="<?= url('client-objectifs', ['id' => $clientId]) ?>" class="btn btn-outline btn-sm">Gérer</a>
                </div>
                <div class="card-body">
                    <?php if (empty($objectifs)): ?>
                        <p class="text-muted text-center">Aucun objectif défini.</p>
                    <?php else: ?>
                        <div class="objectifs-list">
                        <?php foreach (array_slice($objectifs, 0, 5) as $obj): ?>
                            <div class="objectif-item">
                                <div class="objectif-header">
                                    <span class="objectif-titre"><?= e($obj['titre']) ?></span>
                                    <span class="badge <?= $obj['statut'] === 'atteint' ? 'badge-success' : ($obj['statut'] === 'en_cours' ? 'badge-info' : 'badge-secondary') ?>">
                                        <?= ucfirst(str_replace('_', ' ', $obj['statut'])) ?>
                                    </span>
                                </div>
                                <div class="objectif-progress">
                                    <div class="progress-bar">
                                        <div class="progress-fill" style="width: <?= $obj['progression'] ?>%;"></div>
                                    </div>
                                    <span class="progress-text"><?= $obj['progression'] ?>%</span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Historique mesures -->
            <div class="card mt-2">
                <div class="card-header">
                    <h3>Historique</h3>
                </div>
                <div class="card-body" style="max-height: 300px; overflow-y: auto;">
                    <?php if (empty($mesures)): ?>
                        <p class="text-muted text-center">Aucune mesure enregistrée.</p>
                    <?php else: ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Poids</th>
                                    <th>Stress</th>
                                    <th>Sommeil</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach (array_reverse($mesures) as $m): ?>
                                <tr>
                                    <td><?= formatDate($m['date_mesure']) ?></td>
                                    <td><?= $m['poids_kg'] ? number_format($m['poids_kg'], 1) : '-' ?></td>
                                    <td><?= $m['niveau_stress'] ?? '-' ?>/10</td>
                                    <td><?= $m['qualite_sommeil'] ?? '-' ?>/10</td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Nouvelle Mesure -->
<div id="mesure-modal" class="modal" style="display: none;">
    <div class="modal-backdrop" onclick="closeMesureModal()"></div>
    <div class="modal-content">
        <div class="modal-header">
            <h3>Nouvelle mesure</h3>
            <button type="button" class="modal-close" onclick="closeMesureModal()">&times;</button>
        </div>
        <form method="POST" action="<?= url('client-evolution', ['id' => $clientId]) ?>">
            <input type="hidden" name="action" value="mesure-save">
            <input type="hidden" name="client_id" value="<?= $clientId ?>">
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Date de mesure</label>
                    <input type="date" name="date_mesure" class="form-control" required value="<?= date('Y-m-d') ?>">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Poids (kg)</label>
                        <input type="number" name="poids_kg" class="form-control" step="0.1" placeholder="70.5">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tour de taille (cm)</label>
                        <input type="number" name="tour_taille_cm" class="form-control" placeholder="80">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Niveau de stress (0-10)</label>
                    <div class="score-range">
                        <input type="range" name="niveau_stress" min="0" max="10" value="5" oninput="this.nextElementSibling.textContent = this.value">
                        <span class="score-value">5</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Qualité du sommeil (0-10)</label>
                    <div class="score-range">
                        <input type="range" name="qualite_sommeil" min="0" max="10" value="5" oninput="this.nextElementSibling.textContent = this.value">
                        <span class="score-value">5</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Niveau d'énergie (0-10)</label>
                    <div class="score-range">
                        <input type="range" name="niveau_energie" min="0" max="10" value="5" oninput="this.nextElementSibling.textContent = this.value">
                        <span class="score-value">5</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Notes</label>
                    <textarea name="notes" class="form-control" rows="2" placeholder="Observations..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeMesureModal()">Annuler</button>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
    </div>
</div>

<style>
.objectifs-list { display: flex; flex-direction: column; gap: 1rem; }
.objectif-item { padding: 0.8rem; background: var(--cream-50); border-radius: var(--radius-sm); }
.objectif-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem; }
.objectif-titre { font-weight: 500; font-size: 0.9rem; }
.objectif-progress { display: flex; align-items: center; gap: 0.5rem; }
.progress-bar { flex: 1; height: 6px; background: var(--cream-300); border-radius: 3px; overflow: hidden; }
.progress-fill { height: 100%; background: var(--sage-500); border-radius: 3px; transition: width 0.3s; }
.progress-text { font-size: 0.8rem; color: var(--text-muted); min-width: 35px; text-align: right; }
</style>

<?php if (count($mesures) >= 2): ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
const dates = <?= json_encode($dates) ?>;
const poidsData = <?= json_encode($poids) ?>;
const stressData = <?= json_encode($stress) ?>;
const sommeilData = <?= json_encode($sommeil) ?>;
const energieData = <?= json_encode($energie) ?>;

// Graphique Poids
new Chart(document.getElementById('poidsChart'), {
    type: 'line',
    data: {
        labels: dates,
        datasets: [{
            label: 'Poids (kg)',
            data: poidsData,
            borderColor: '#4a6741',
            backgroundColor: 'rgba(74, 103, 65, 0.1)',
            fill: true,
            tension: 0.3,
            pointRadius: 4
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: false } }
    }
});

// Graphique Bien-être
new Chart(document.getElementById('bienEtreChart'), {
    type: 'line',
    data: {
        labels: dates,
        datasets: [
            {
                label: 'Stress',
                data: stressData,
                borderColor: '#a85a3a',
                backgroundColor: 'transparent',
                tension: 0.3
            },
            {
                label: 'Sommeil',
                data: sommeilData,
                borderColor: '#4a7a9b',
                backgroundColor: 'transparent',
                tension: 0.3
            },
            {
                label: 'Énergie',
                data: energieData,
                borderColor: '#d4a054',
                backgroundColor: 'transparent',
                tension: 0.3
            }
        ]
    },
    options: {
        responsive: true,
        scales: { y: { min: 0, max: 10 } }
    }
});
</script>
<?php endif; ?>

<script>
function openMesureModal() {
    document.getElementById('mesure-modal').style.display = 'flex';
}
function closeMesureModal() {
    document.getElementById('mesure-modal').style.display = 'none';
}
</script>
