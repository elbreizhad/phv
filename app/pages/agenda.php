<?php
/**
 * Agenda - Vue calendrier des rendez-vous
 */
$db = getDB();
$userId = currentUserId();

// Paramètres de vue
$vue = getGet('vue', 'semaine'); // jour, semaine, mois
$dateParam = getGet('date', date('Y-m-d'));
$dateActuelle = new DateTime($dateParam);

// Calcul des bornes selon la vue
switch ($vue) {
    case 'jour':
        $dateDebut = clone $dateActuelle;
        $dateFin = clone $dateActuelle;
        break;
    case 'mois':
        $dateDebut = new DateTime($dateActuelle->format('Y-m-01'));
        $dateFin = new DateTime($dateActuelle->format('Y-m-t'));
        break;
    case 'semaine':
    default:
        $jourSemaine = (int)$dateActuelle->format('N');
        $dateDebut = clone $dateActuelle;
        $dateDebut->modify('-' . ($jourSemaine - 1) . ' days');
        $dateFin = clone $dateDebut;
        $dateFin->modify('+6 days');
        break;
}

// Récupérer les rendez-vous
$stmt = $db->prepare("
    SELECT r.*, c.nom AS client_nom, c.prenom AS client_prenom, c.telephone AS client_tel
    FROM rendez_vous r
    LEFT JOIN clients c ON r.client_id = c.id
    WHERE r.user_id = ? AND r.date_rdv BETWEEN ? AND ?
    ORDER BY r.date_rdv, r.heure_debut
");
$stmt->execute([$userId, $dateDebut->format('Y-m-d'), $dateFin->format('Y-m-d')]);
$rdvs = $stmt->fetchAll();

// Organiser par date
$rdvParDate = [];
foreach ($rdvs as $rdv) {
    $rdvParDate[$rdv['date_rdv']][] = $rdv;
}

// Liste des clients pour le formulaire
$clientsStmt = $db->prepare("SELECT id, nom, prenom FROM clients WHERE user_id = ? ORDER BY nom, prenom");
$clientsStmt->execute([$userId]);
$clients = $clientsStmt->fetchAll();

// Stats du jour
$today = date('Y-m-d');
$stmtToday = $db->prepare("SELECT COUNT(*) FROM rendez_vous WHERE user_id = ? AND date_rdv = ?");
$stmtToday->execute([$userId, $today]);
$rdvAujourdhui = $stmtToday->fetchColumn();

// Navigation
$prevDate = clone $dateActuelle;
$nextDate = clone $dateActuelle;
switch ($vue) {
    case 'jour':
        $prevDate->modify('-1 day');
        $nextDate->modify('+1 day');
        break;
    case 'mois':
        $prevDate->modify('-1 month');
        $nextDate->modify('+1 month');
        break;
    default:
        $prevDate->modify('-1 week');
        $nextDate->modify('+1 week');
        break;
}

// Heures de travail
$heureDebut = 8;
$heureFin = 20;

// Jours de la semaine
$joursSemaine = ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'];
$joursSemaineComplet = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
$mois = ['janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'];
?>

<div class="page-header">
    <div>
        <h1>Agenda</h1>
        <p class="subtitle">
            <?php if ($vue === 'jour'): ?>
                <?= $joursSemaineComplet[(int)$dateActuelle->format('N') - 1] ?> <?= $dateActuelle->format('j') ?> <?= $mois[(int)$dateActuelle->format('n') - 1] ?> <?= $dateActuelle->format('Y') ?>
            <?php elseif ($vue === 'mois'): ?>
                <?= ucfirst($mois[(int)$dateActuelle->format('n') - 1]) ?> <?= $dateActuelle->format('Y') ?>
            <?php else: ?>
                Semaine du <?= $dateDebut->format('j') ?> au <?= $dateFin->format('j') ?> <?= $mois[(int)$dateFin->format('n') - 1] ?> <?= $dateFin->format('Y') ?>
            <?php endif; ?>
        </p>
    </div>
    <div class="d-flex gap-1">
        <button type="button" class="btn btn-primary" onclick="openRdvModal()">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Nouveau RDV
        </button>
    </div>
</div>

<div class="page-body animate-in">
    <!-- Stats rapides -->
    <div class="stats-grid" style="margin-bottom: 1.5rem;">
        <div class="stat-card">
            <div class="stat-icon green">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="22" height="22"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            </div>
            <div class="stat-info">
                <h3><?= $rdvAujourdhui ?></h3>
                <p>RDV aujourd'hui</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon terra">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="22" height="22"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            </div>
            <div class="stat-info">
                <h3><?= count($rdvs) ?></h3>
                <p>RDV cette <?= $vue === 'mois' ? 'période' : $vue ?></p>
            </div>
        </div>
    </div>

    <!-- Navigation calendrier -->
    <div class="calendar-nav card" style="margin-bottom: 1.5rem;">
        <div class="card-body d-flex justify-between align-center" style="padding: 0.8rem 1.2rem;">
            <div class="d-flex gap-1">
                <a href="<?= url('agenda', ['vue' => $vue, 'date' => $prevDate->format('Y-m-d')]) ?>" class="btn btn-secondary btn-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><polyline points="15 18 9 12 15 6"/></svg>
                </a>
                <a href="<?= url('agenda', ['vue' => $vue, 'date' => date('Y-m-d')]) ?>" class="btn btn-outline btn-sm">Aujourd'hui</a>
                <a href="<?= url('agenda', ['vue' => $vue, 'date' => $nextDate->format('Y-m-d')]) ?>" class="btn btn-secondary btn-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><polyline points="9 18 15 12 9 6"/></svg>
                </a>
            </div>
            <div class="vue-selector d-flex gap-1">
                <a href="<?= url('agenda', ['vue' => 'jour', 'date' => $dateParam]) ?>" class="btn btn-sm <?= $vue === 'jour' ? 'btn-primary' : 'btn-secondary' ?>">Jour</a>
                <a href="<?= url('agenda', ['vue' => 'semaine', 'date' => $dateParam]) ?>" class="btn btn-sm <?= $vue === 'semaine' ? 'btn-primary' : 'btn-secondary' ?>">Semaine</a>
                <a href="<?= url('agenda', ['vue' => 'mois', 'date' => $dateParam]) ?>" class="btn btn-sm <?= $vue === 'mois' ? 'btn-primary' : 'btn-secondary' ?>">Mois</a>
            </div>
        </div>
    </div>

    <!-- Calendrier -->
    <div class="card">
        <?php if ($vue === 'mois'): ?>
            <!-- Vue Mois -->
            <div class="calendar-month">
                <div class="calendar-header-row">
                    <?php foreach ($joursSemaine as $jour): ?>
                        <div class="calendar-header-cell"><?= $jour ?></div>
                    <?php endforeach; ?>
                </div>
                <div class="calendar-body">
                    <?php
                    $premierJourMois = new DateTime($dateActuelle->format('Y-m-01'));
                    $premierJourSemaine = (int)$premierJourMois->format('N');
                    $joursTotal = (int)$dateActuelle->format('t');
                    $cellule = 1;
                    ?>
                    <div class="calendar-week">
                        <?php for ($i = 1; $i < $premierJourSemaine; $i++): ?>
                            <div class="calendar-day empty"></div>
                            <?php $cellule++; ?>
                        <?php endfor; ?>

                        <?php for ($jour = 1; $jour <= $joursTotal; $jour++): ?>
                            <?php
                            $dateJour = $dateActuelle->format('Y-m-') . str_pad($jour, 2, '0', STR_PAD_LEFT);
                            $isToday = $dateJour === $today;
                            $rdvJour = $rdvParDate[$dateJour] ?? [];
                            ?>
                            <div class="calendar-day <?= $isToday ? 'today' : '' ?>">
                                <div class="day-number"><?= $jour ?></div>
                                <?php foreach (array_slice($rdvJour, 0, 3) as $rdv): ?>
                                    <div class="day-event" style="background-color: <?= e($rdv['couleur'] ?? '#4a6741') ?>20; border-left-color: <?= e($rdv['couleur'] ?? '#4a6741') ?>;" onclick="viewRdv(<?= $rdv['id'] ?>)">
                                        <span class="event-time"><?= substr($rdv['heure_debut'], 0, 5) ?></span>
                                        <span class="event-title"><?= e($rdv['client_prenom'] ?? $rdv['titre']) ?></span>
                                    </div>
                                <?php endforeach; ?>
                                <?php if (count($rdvJour) > 3): ?>
                                    <div class="day-more">+<?= count($rdvJour) - 3 ?> autres</div>
                                <?php endif; ?>
                            </div>
                            <?php
                            $cellule++;
                            if ($cellule > 7 && $jour < $joursTotal):
                                $cellule = 1;
                            ?>
                    </div><div class="calendar-week">
                            <?php endif; ?>
                        <?php endfor; ?>

                        <?php while ($cellule <= 7 && $cellule > 1): ?>
                            <div class="calendar-day empty"></div>
                            <?php $cellule++; ?>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        <?php elseif ($vue === 'jour'): ?>
            <!-- Vue Jour -->
            <div class="calendar-day-view">
                <div class="day-header">
                    <h3><?= $joursSemaineComplet[(int)$dateActuelle->format('N') - 1] ?> <?= $dateActuelle->format('j/m/Y') ?></h3>
                </div>
                <div class="day-timeline">
                    <?php for ($h = $heureDebut; $h <= $heureFin; $h++): ?>
                        <div class="timeline-hour">
                            <div class="hour-label"><?= str_pad($h, 2, '0', STR_PAD_LEFT) ?>:00</div>
                            <div class="hour-slot" data-date="<?= $dateActuelle->format('Y-m-d') ?>" data-hour="<?= $h ?>">
                                <?php
                                $dateJour = $dateActuelle->format('Y-m-d');
                                if (isset($rdvParDate[$dateJour])) {
                                    foreach ($rdvParDate[$dateJour] as $rdv) {
                                        $heureRdv = (int)substr($rdv['heure_debut'], 0, 2);
                                        if ($heureRdv === $h) {
                                            $duree = $rdv['duree_minutes'] ?? 60;
                                            $hauteur = ($duree / 60) * 100;
                                            ?>
                                            <div class="timeline-event" style="height: <?= $hauteur ?>%; background-color: <?= e($rdv['couleur'] ?? '#4a6741') ?>;" onclick="viewRdv(<?= $rdv['id'] ?>)">
                                                <div class="event-content">
                                                    <strong><?= e($rdv['client_prenom'] ? $rdv['client_prenom'] . ' ' . $rdv['client_nom'] : $rdv['titre']) ?></strong>
                                                    <span><?= substr($rdv['heure_debut'], 0, 5) ?> - <?= substr($rdv['heure_fin'], 0, 5) ?></span>
                                                    <span class="badge <?= RDV_STATUTS[$rdv['statut']]['badge'] ?? 'badge-info' ?>"><?= RDV_STATUTS[$rdv['statut']]['label'] ?? $rdv['statut'] ?></span>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        <?php else: ?>
            <!-- Vue Semaine -->
            <div class="calendar-week-view">
                <div class="week-header">
                    <div class="week-time-col"></div>
                    <?php
                    $jourCourant = clone $dateDebut;
                    for ($i = 0; $i < 7; $i++):
                        $isToday = $jourCourant->format('Y-m-d') === $today;
                    ?>
                        <div class="week-day-header <?= $isToday ? 'today' : '' ?>">
                            <span class="day-name"><?= $joursSemaine[$i] ?></span>
                            <span class="day-num"><?= $jourCourant->format('j') ?></span>
                        </div>
                    <?php
                        $jourCourant->modify('+1 day');
                    endfor;
                    ?>
                </div>
                <div class="week-body">
                    <?php for ($h = $heureDebut; $h <= $heureFin; $h++): ?>
                        <div class="week-row">
                            <div class="week-time-col"><?= str_pad($h, 2, '0', STR_PAD_LEFT) ?>:00</div>
                            <?php
                            $jourCourant = clone $dateDebut;
                            for ($j = 0; $j < 7; $j++):
                                $dateJour = $jourCourant->format('Y-m-d');
                                $isToday = $dateJour === $today;
                            ?>
                                <div class="week-cell <?= $isToday ? 'today' : '' ?>" data-date="<?= $dateJour ?>" data-hour="<?= $h ?>">
                                    <?php
                                    if (isset($rdvParDate[$dateJour])) {
                                        foreach ($rdvParDate[$dateJour] as $rdv) {
                                            $heureRdv = (int)substr($rdv['heure_debut'], 0, 2);
                                            if ($heureRdv === $h) {
                                                ?>
                                                <div class="week-event" style="background-color: <?= e($rdv['couleur'] ?? '#4a6741') ?>;" onclick="viewRdv(<?= $rdv['id'] ?>)">
                                                    <span class="event-time"><?= substr($rdv['heure_debut'], 0, 5) ?></span>
                                                    <span class="event-client"><?= e($rdv['client_prenom'] ?? $rdv['titre']) ?></span>
                                                </div>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                                </div>
                            <?php
                                $jourCourant->modify('+1 day');
                            endfor;
                            ?>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Liste des RDV du jour (si vue jour) -->
    <?php if ($vue === 'jour' && !empty($rdvParDate[$dateActuelle->format('Y-m-d')])): ?>
    <div class="card mt-3">
        <div class="card-header">
            <h3>Rendez-vous du jour</h3>
        </div>
        <div class="card-body" style="padding: 0;">
            <table class="table">
                <thead>
                    <tr>
                        <th>Heure</th>
                        <th>Client</th>
                        <th>Type</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($rdvParDate[$dateActuelle->format('Y-m-d')] as $rdv): ?>
                    <tr>
                        <td><strong><?= substr($rdv['heure_debut'], 0, 5) ?> - <?= substr($rdv['heure_fin'], 0, 5) ?></strong></td>
                        <td>
                            <?php if ($rdv['client_id']): ?>
                                <a href="<?= url('client-view', ['id' => $rdv['client_id']]) ?>"><?= e($rdv['client_prenom'] . ' ' . $rdv['client_nom']) ?></a>
                                <?php if ($rdv['client_tel']): ?>
                                    <br><span class="text-sm text-muted"><?= e($rdv['client_tel']) ?></span>
                                <?php endif; ?>
                            <?php else: ?>
                                <?= e($rdv['titre']) ?>
                            <?php endif; ?>
                        </td>
                        <td><?= RDV_TYPES[$rdv['type_rdv']]['label'] ?? $rdv['type_rdv'] ?></td>
                        <td><span class="badge <?= RDV_STATUTS[$rdv['statut']]['badge'] ?? 'badge-info' ?>"><?= RDV_STATUTS[$rdv['statut']]['label'] ?? $rdv['statut'] ?></span></td>
                        <td class="actions">
                            <button type="button" class="btn btn-outline btn-sm" onclick="viewRdv(<?= $rdv['id'] ?>)">Voir</button>
                            <?php if ($rdv['statut'] === 'planifie' || $rdv['statut'] === 'confirme'): ?>
                                <a href="<?= url('consultation-new', ['client_id' => $rdv['client_id'], 'rdv_id' => $rdv['id']]) ?>" class="btn btn-primary btn-sm">Démarrer</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php endif; ?>
</div>

<!-- Modal Nouveau RDV -->
<div id="rdv-modal" class="modal" style="display: none;">
    <div class="modal-backdrop" onclick="closeRdvModal()"></div>
    <div class="modal-content">
        <div class="modal-header">
            <h3 id="modal-title">Nouveau rendez-vous</h3>
            <button type="button" class="modal-close" onclick="closeRdvModal()">&times;</button>
        </div>
        <form id="rdv-form" method="POST" action="<?= url('agenda') ?>">
            <input type="hidden" name="action" value="rdv-save">
            <input type="hidden" name="rdv_id" id="rdv_id" value="">
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Client</label>
                        <select name="client_id" id="rdv_client_id" class="form-control">
                            <option value="">-- Sans client --</option>
                            <?php foreach ($clients as $c): ?>
                                <option value="<?= $c['id'] ?>"><?= e($c['prenom'] . ' ' . $c['nom']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Type de RDV</label>
                        <select name="type_rdv" id="rdv_type" class="form-control" onchange="updateDuree()">
                            <?php foreach (RDV_TYPES as $key => $type): ?>
                                <option value="<?= $key ?>" data-duree="<?= $type['duree'] ?>" data-couleur="<?= $type['couleur'] ?>"><?= $type['label'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group" id="titre-group" style="display: none;">
                    <label class="form-label">Titre</label>
                    <input type="text" name="titre" id="rdv_titre" class="form-control" placeholder="Titre du rendez-vous">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Date <span class="required">*</span></label>
                        <input type="date" name="date_rdv" id="rdv_date" class="form-control" required value="<?= $dateActuelle->format('Y-m-d') ?>">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Heure début <span class="required">*</span></label>
                        <input type="time" name="heure_debut" id="rdv_heure_debut" class="form-control" required value="09:00" onchange="updateHeureFin()">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Heure fin</label>
                        <input type="time" name="heure_fin" id="rdv_heure_fin" class="form-control" value="10:30">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Durée (min)</label>
                        <input type="number" name="duree_minutes" id="rdv_duree" class="form-control" value="90" min="15" step="15">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tarif (€)</label>
                        <input type="number" name="tarif" id="rdv_tarif" class="form-control" step="0.01" placeholder="70.00">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Notes</label>
                    <textarea name="notes" id="rdv_notes" class="form-control" rows="2" placeholder="Notes internes..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeRdvModal()">Annuler</button>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Vue RDV -->
<div id="rdv-view-modal" class="modal" style="display: none;">
    <div class="modal-backdrop" onclick="closeViewModal()"></div>
    <div class="modal-content">
        <div class="modal-header">
            <h3>Détails du rendez-vous</h3>
            <button type="button" class="modal-close" onclick="closeViewModal()">&times;</button>
        </div>
        <div class="modal-body" id="rdv-view-content">
            <!-- Contenu chargé en AJAX -->
        </div>
        <div class="modal-footer" id="rdv-view-actions">
            <!-- Actions chargées en AJAX -->
        </div>
    </div>
</div>

<script>
function openRdvModal(date = null, hour = null) {
    document.getElementById('rdv-modal').style.display = 'flex';
    document.getElementById('modal-title').textContent = 'Nouveau rendez-vous';
    document.getElementById('rdv_id').value = '';
    document.getElementById('rdv-form').reset();

    if (date) {
        document.getElementById('rdv_date').value = date;
    }
    if (hour) {
        document.getElementById('rdv_heure_debut').value = hour.toString().padStart(2, '0') + ':00';
        updateHeureFin();
    }

    updateTitreVisibility();
}

function closeRdvModal() {
    document.getElementById('rdv-modal').style.display = 'none';
}

function closeViewModal() {
    document.getElementById('rdv-view-modal').style.display = 'none';
}

function updateDuree() {
    const select = document.getElementById('rdv_type');
    const option = select.options[select.selectedIndex];
    const duree = option.dataset.duree || 60;
    document.getElementById('rdv_duree').value = duree;
    updateHeureFin();
    updateTitreVisibility();
}

function updateHeureFin() {
    const debut = document.getElementById('rdv_heure_debut').value;
    const duree = parseInt(document.getElementById('rdv_duree').value) || 60;

    if (debut) {
        const [h, m] = debut.split(':').map(Number);
        const totalMin = h * 60 + m + duree;
        const finH = Math.floor(totalMin / 60);
        const finM = totalMin % 60;
        document.getElementById('rdv_heure_fin').value =
            finH.toString().padStart(2, '0') + ':' + finM.toString().padStart(2, '0');
    }
}

function updateTitreVisibility() {
    const clientSelect = document.getElementById('rdv_client_id');
    const titreGroup = document.getElementById('titre-group');
    titreGroup.style.display = clientSelect.value ? 'none' : 'block';
}

document.getElementById('rdv_client_id').addEventListener('change', updateTitreVisibility);
document.getElementById('rdv_duree').addEventListener('change', updateHeureFin);

function viewRdv(id) {
    fetch('<?= APP_URL ?>/index.php?page=agenda-api&action=get&id=' + id)
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                const rdv = data.rdv;
                let html = `
                    <div class="rdv-detail">
                        <p><strong>Date:</strong> ${rdv.date_rdv_formatted}</p>
                        <p><strong>Horaire:</strong> ${rdv.heure_debut.substring(0,5)} - ${rdv.heure_fin.substring(0,5)}</p>
                        <p><strong>Type:</strong> ${rdv.type_label}</p>
                        <p><strong>Statut:</strong> <span class="badge ${rdv.statut_badge}">${rdv.statut_label}</span></p>
                `;
                if (rdv.client_nom) {
                    html += `<p><strong>Client:</strong> <a href="<?= APP_URL ?>/index.php?page=client-view&id=${rdv.client_id}">${rdv.client_prenom} ${rdv.client_nom}</a></p>`;
                    if (rdv.client_tel) {
                        html += `<p><strong>Téléphone:</strong> ${rdv.client_tel}</p>`;
                    }
                }
                if (rdv.tarif) {
                    html += `<p><strong>Tarif:</strong> ${parseFloat(rdv.tarif).toFixed(2)} €</p>`;
                }
                if (rdv.notes) {
                    html += `<p><strong>Notes:</strong> ${rdv.notes}</p>`;
                }
                html += '</div>';

                document.getElementById('rdv-view-content').innerHTML = html;

                let actions = `<button type="button" class="btn btn-secondary" onclick="closeViewModal()">Fermer</button>`;
                actions += `<button type="button" class="btn btn-outline" onclick="editRdv(${rdv.id})">Modifier</button>`;
                if (rdv.statut === 'planifie') {
                    actions += `<form method="POST" style="display:inline;"><input type="hidden" name="action" value="rdv-confirm"><input type="hidden" name="rdv_id" value="${rdv.id}"><button type="submit" class="btn btn-success">Confirmer</button></form>`;
                }
                if (rdv.statut !== 'termine' && rdv.statut !== 'annule') {
                    actions += `<form method="POST" style="display:inline;" onsubmit="return confirm('Annuler ce RDV ?');"><input type="hidden" name="action" value="rdv-cancel"><input type="hidden" name="rdv_id" value="${rdv.id}"><button type="submit" class="btn btn-danger">Annuler</button></form>`;
                }
                if (rdv.client_id && (rdv.statut === 'planifie' || rdv.statut === 'confirme')) {
                    actions += `<a href="<?= APP_URL ?>/index.php?page=consultation-new&client_id=${rdv.client_id}&rdv_id=${rdv.id}" class="btn btn-primary">Démarrer consultation</a>`;
                }

                document.getElementById('rdv-view-actions').innerHTML = actions;
                document.getElementById('rdv-view-modal').style.display = 'flex';
            }
        });
}

function editRdv(id) {
    closeViewModal();
    fetch('<?= APP_URL ?>/index.php?page=agenda-api&action=get&id=' + id)
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                const rdv = data.rdv;
                document.getElementById('modal-title').textContent = 'Modifier le rendez-vous';
                document.getElementById('rdv_id').value = rdv.id;
                document.getElementById('rdv_client_id').value = rdv.client_id || '';
                document.getElementById('rdv_type').value = rdv.type_rdv;
                document.getElementById('rdv_titre').value = rdv.titre || '';
                document.getElementById('rdv_date').value = rdv.date_rdv;
                document.getElementById('rdv_heure_debut').value = rdv.heure_debut.substring(0, 5);
                document.getElementById('rdv_heure_fin').value = rdv.heure_fin.substring(0, 5);
                document.getElementById('rdv_duree').value = rdv.duree_minutes;
                document.getElementById('rdv_tarif').value = rdv.tarif || '';
                document.getElementById('rdv_notes').value = rdv.notes || '';
                updateTitreVisibility();
                document.getElementById('rdv-modal').style.display = 'flex';
            }
        });
}

// Click sur cellule pour créer RDV
document.querySelectorAll('.week-cell, .hour-slot').forEach(cell => {
    cell.addEventListener('dblclick', function() {
        const date = this.dataset.date;
        const hour = this.dataset.hour;
        openRdvModal(date, hour);
    });
});
</script>
