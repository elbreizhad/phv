<?php
/**
 * API Agenda - Endpoints AJAX
 */
header('Content-Type: application/json');

$db = getDB();
$userId = currentUserId();
$action = getGet('action');

switch ($action) {
    case 'get':
        $id = (int)getGet('id');
        $stmt = $db->prepare("
            SELECT r.*, c.nom AS client_nom, c.prenom AS client_prenom, c.telephone AS client_tel, c.email AS client_email
            FROM rendez_vous r
            LEFT JOIN clients c ON r.client_id = c.id
            WHERE r.id = ? AND r.user_id = ?
        ");
        $stmt->execute([$id, $userId]);
        $rdv = $stmt->fetch();

        if ($rdv) {
            $rdv['date_rdv_formatted'] = date('d/m/Y', strtotime($rdv['date_rdv']));
            $rdv['type_label'] = RDV_TYPES[$rdv['type_rdv']]['label'] ?? $rdv['type_rdv'];
            $rdv['statut_label'] = RDV_STATUTS[$rdv['statut']]['label'] ?? $rdv['statut'];
            $rdv['statut_badge'] = RDV_STATUTS[$rdv['statut']]['badge'] ?? 'badge-info';
            echo json_encode(['success' => true, 'rdv' => $rdv]);
        } else {
            echo json_encode(['success' => false, 'error' => 'RDV non trouvé']);
        }
        break;

    case 'list':
        $dateDebut = getGet('start', date('Y-m-01'));
        $dateFin = getGet('end', date('Y-m-t'));

        $stmt = $db->prepare("
            SELECT r.*, c.nom AS client_nom, c.prenom AS client_prenom
            FROM rendez_vous r
            LEFT JOIN clients c ON r.client_id = c.id
            WHERE r.user_id = ? AND r.date_rdv BETWEEN ? AND ?
            ORDER BY r.date_rdv, r.heure_debut
        ");
        $stmt->execute([$userId, $dateDebut, $dateFin]);
        $rdvs = $stmt->fetchAll();

        echo json_encode(['success' => true, 'rdvs' => $rdvs]);
        break;

    default:
        echo json_encode(['success' => false, 'error' => 'Action inconnue']);
}
