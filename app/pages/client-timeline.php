<?php
/**
 * Timeline client - Historique visuel des interactions
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

// Récupérer tous les événements
$events = [];

// Consultations
$consultStmt = $db->prepare("
    SELECT id, 'consultation' as type, date_consultation as date_event, motif as description, statut, type_seance
    FROM consultations WHERE client_id = ? ORDER BY date_consultation DESC
");
$consultStmt->execute([$clientId]);
foreach ($consultStmt->fetchAll() as $row) {
    $events[] = $row;
}

// RDV
$rdvStmt = $db->prepare("
    SELECT id, 'rdv' as type, date_rdv as date_event, titre as description, statut, type_rdv
    FROM rendez_vous WHERE client_id = ? ORDER BY date_rdv DESC
");
$rdvStmt->execute([$clientId]);
foreach ($rdvStmt->fetchAll() as $row) {
    $events[] = $row;
}

// Factures
$facturesStmt = $db->prepare("
    SELECT id, 'facture' as type, date_facture as date_event, CONCAT(numero_facture, ' - ', montant_ttc, '€') as description, statut
    FROM factures WHERE client_id = ? ORDER BY date_facture DESC
");
$facturesStmt->execute([$clientId]);
foreach ($facturesStmt->fetchAll() as $row) {
    $events[] = $row;
}

// Mesures
$mesuresStmt = $db->prepare("
    SELECT id, 'mesure' as type, date_mesure as date_event, CONCAT('Poids: ', COALESCE(poids_kg, '-'), 'kg, Stress: ', COALESCE(niveau_stress, '-'), '/10') as description, 'complete' as statut
    FROM client_mesures WHERE client_id = ? ORDER BY date_mesure DESC
");
$mesuresStmt->execute([$clientId]);
foreach ($mesuresStmt->fetchAll() as $row) {
    $events[] = $row;
}

// Trier par date décroissante
usort($events, function($a, $b) {
    return strtotime($b['date_event']) - strtotime($a['date_event']);
});

// Regrouper par mois
$eventsByMonth = [];
foreach ($events as $event) {
    $month = date('Y-m', strtotime($event['date_event']));
    $eventsByMonth[$month][] = $event;
}

$mois = ['01' => 'Janvier', '02' => 'Février', '03' => 'Mars', '04' => 'Avril', '05' => 'Mai', '06' => 'Juin', '07' => 'Juillet', '08' => 'Août', '09' => 'Septembre', '10' => 'Octobre', '11' => 'Novembre', '12' => 'Décembre'];
?>

<div class="page-header">
    <div>
        <h1>Historique - <?= e($client['prenom'] . ' ' . $client['nom']) ?></h1>
        <p class="subtitle"><?= count($events) ?> événement(s)</p>
    </div>
    <a href="<?= url('client-view', ['id' => $clientId]) ?>" class="btn btn-secondary">Retour au profil</a>
</div>

<div class="page-body animate-in">
    <?php if (empty($events)): ?>
        <div class="card">
            <div class="card-body">
                <div class="empty-state">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="48" height="48"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    <h3>Aucun historique</h3>
                    <p>Les consultations, rendez-vous et factures apparaîtront ici.</p>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="timeline">
            <?php foreach ($eventsByMonth as $monthKey => $monthEvents): ?>
                <?php
                list($year, $month) = explode('-', $monthKey);
                $monthLabel = $mois[$month] . ' ' . $year;
                ?>
                <div class="timeline-month">
                    <div class="timeline-month-label"><?= $monthLabel ?></div>
                    <div class="timeline-events">
                        <?php foreach ($monthEvents as $event): ?>
                            <div class="timeline-event timeline-event-<?= $event['type'] ?>">
                                <div class="timeline-event-icon">
                                    <?php if ($event['type'] === 'consultation'): ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                                    <?php elseif ($event['type'] === 'rdv'): ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/></svg>
                                    <?php elseif ($event['type'] === 'facture'): ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                                    <?php else: ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
                                    <?php endif; ?>
                                </div>
                                <div class="timeline-event-content">
                                    <div class="timeline-event-date"><?= formatDate($event['date_event']) ?></div>
                                    <div class="timeline-event-title">
                                        <?php
                                        switch ($event['type']) {
                                            case 'consultation':
                                                echo ($event['type_seance'] === 'premiere' ? 'Première consultation' : 'Consultation de suivi');
                                                break;
                                            case 'rdv':
                                                echo 'Rendez-vous';
                                                break;
                                            case 'facture':
                                                echo 'Facture';
                                                break;
                                            case 'mesure':
                                                echo 'Mesure';
                                                break;
                                        }
                                        ?>
                                    </div>
                                    <div class="timeline-event-desc"><?= e($event['description']) ?></div>
                                    <?php if ($event['type'] === 'consultation'): ?>
                                        <a href="<?= url('consultation-view', ['id' => $event['id']]) ?>" class="btn btn-outline btn-sm mt-1">Voir</a>
                                    <?php elseif ($event['type'] === 'facture'): ?>
                                        <a href="<?= url('facture-view', ['id' => $event['id']]) ?>" class="btn btn-outline btn-sm mt-1">Voir</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<style>
.timeline { max-width: 800px; }
.timeline-month { margin-bottom: 2rem; }
.timeline-month-label {
    font-family: 'Playfair Display', serif;
    font-size: 1.1rem;
    color: var(--sage-700);
    padding-bottom: 0.5rem;
    border-bottom: 2px solid var(--sage-200);
    margin-bottom: 1rem;
}
.timeline-events {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    padding-left: 1rem;
    border-left: 2px solid var(--cream-300);
}
.timeline-event {
    display: flex;
    gap: 1rem;
    position: relative;
    padding: 1rem;
    background: white;
    border-radius: var(--radius-sm);
    box-shadow: var(--shadow-sm);
}
.timeline-event::before {
    content: '';
    position: absolute;
    left: -1.5rem;
    top: 1.2rem;
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: var(--sage-400);
    border: 2px solid white;
}
.timeline-event-consultation::before { background: var(--sage-500); }
.timeline-event-rdv::before { background: var(--info); }
.timeline-event-facture::before { background: var(--terra-500); }
.timeline-event-mesure::before { background: var(--warning); }

.timeline-event-icon {
    width: 36px;
    height: 36px;
    border-radius: var(--radius-sm);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.timeline-event-consultation .timeline-event-icon { background: var(--sage-100); color: var(--sage-600); }
.timeline-event-rdv .timeline-event-icon { background: #eef4f9; color: var(--info); }
.timeline-event-facture .timeline-event-icon { background: var(--terra-50); color: var(--terra-500); }
.timeline-event-mesure .timeline-event-icon { background: #fdf6e8; color: var(--warning); }

.timeline-event-content { flex: 1; }
.timeline-event-date { font-size: 0.75rem; color: var(--text-muted); }
.timeline-event-title { font-weight: 600; color: var(--text-primary); margin: 0.2rem 0; }
.timeline-event-desc { font-size: 0.85rem; color: var(--text-secondary); }
</style>
