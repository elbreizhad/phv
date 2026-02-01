<?php
$db = getDB();
$userId = currentUserId();
$id = getPost('id');

$data = [
    'nom' => getPost('nom'),
    'prenom' => getPost('prenom'),
    'date_naissance' => getPost('date_naissance') ?: null,
    'sexe' => getPost('sexe') ?: null,
    'adresse' => getPost('adresse'),
    'email' => getPost('email'),
    'telephone' => getPost('telephone'),
    'profession' => getPost('profession'),
    'lieu_de_vie' => getPost('lieu_de_vie'),
    'taille_cm' => getPost('taille_cm') ?: null,
    'poids_kg' => getPost('poids_kg') ?: null,
    'notes' => getPost('notes'),
];

// Calcul de l'âge
if ($data['date_naissance']) {
    $data['age'] = (new DateTime($data['date_naissance']))->diff(new DateTime())->y;
}

if ($id) {
    // Mise à jour
    $sets = [];
    $values = [];
    foreach ($data as $key => $val) {
        $sets[] = "$key = ?";
        $values[] = $val;
    }
    $values[] = $id;
    $values[] = $userId;
    $db->prepare("UPDATE clients SET " . implode(', ', $sets) . " WHERE id = ? AND user_id = ?")->execute($values);
    flashSet('success', 'Client mis à jour.');
    redirect('client-view', ['id' => $id]);
} else {
    // Création
    $data['user_id'] = $userId;
    $cols = implode(', ', array_keys($data));
    $placeholders = implode(', ', array_fill(0, count($data), '?'));
    $db->prepare("INSERT INTO clients ($cols) VALUES ($placeholders)")->execute(array_values($data));
    $newId = $db->lastInsertId();
    flashSet('success', 'Client créé avec succès.');
    redirect('client-view', ['id' => $newId]);
}
