<?php
/**
 * Suppression d'un client (et de toutes ses consultations/factures en cascade).
 */
$db = getDB();
$userId = currentUserId();
$clientId = (int) getPost('client_id');

if (!$clientId) { redirect('clients'); }

// Vérifier la propriété
$stmt = $db->prepare('SELECT id, prenom, nom FROM clients WHERE id = ? AND user_id = ?');
$stmt->execute([$clientId, $userId]);
$client = $stmt->fetch();
if (!$client) { redirect('clients'); }

// Cascade via FK : consultations, reponses, synthese, phv, mesures, objectifs, documents,
// rendez_vous (SET NULL), factures (CASCADE).
$db->prepare('DELETE FROM clients WHERE id = ? AND user_id = ?')->execute([$clientId, $userId]);

flashSet('success', 'Client ' . $client['prenom'] . ' ' . $client['nom'] . ' et toutes ses données ont été supprimés.');
redirect('clients');
