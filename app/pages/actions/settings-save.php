<?php
/**
 * Action: Sauvegarder les paramètres
 */
$db = getDB();
$userId = currentUserId();

$tab = getPost('tab', 'cabinet');

if ($tab === 'cabinet') {
    // Paramètres cabinet
    $nomCabinet = getPost('nom_cabinet');
    $siteWeb = getPost('site_web');
    $adresseCabinet = getPost('adresse_cabinet');
    $telephoneCabinet = getPost('telephone_cabinet');
    $emailCabinet = getPost('email_cabinet');
    $siret = getPost('siret');
    $codeApe = getPost('code_ape');
    $mentionsFacture = getPost('mentions_facture');
    $premiereHeure = getPost('premiere_heure_agenda');
    $derniereHeure = getPost('derniere_heure_agenda');
    $dureeRdv = (int)getPost('duree_rdv_defaut');
    $trameV2 = !empty($_POST['trame_v2_enabled']) ? 1 : 0;

    // Vérifier si settings existe
    $checkStmt = $db->prepare("SELECT id FROM user_settings WHERE user_id = ?");
    $checkStmt->execute([$userId]);

    if ($checkStmt->fetch()) {
        try {
            $stmt = $db->prepare("
                UPDATE user_settings SET
                    nom_cabinet = ?, site_web = ?, adresse_cabinet = ?, telephone_cabinet = ?, email_cabinet = ?,
                    siret = ?, code_ape = ?, mentions_facture = ?,
                    premiere_heure_agenda = ?, derniere_heure_agenda = ?, duree_rdv_defaut = ?,
                    trame_v2_enabled = ?
                WHERE user_id = ?
            ");
            $stmt->execute([
                $nomCabinet, $siteWeb, $adresseCabinet, $telephoneCabinet, $emailCabinet,
                $siret, $codeApe, $mentionsFacture,
                $premiereHeure, $derniereHeure, $dureeRdv, $trameV2,
                $userId
            ]);
        } catch (PDOException $e) {
            // Colonne trame_v2_enabled absente -> fallback sans elle
            $stmt = $db->prepare("
                UPDATE user_settings SET
                    nom_cabinet = ?, site_web = ?, adresse_cabinet = ?, telephone_cabinet = ?, email_cabinet = ?,
                    siret = ?, code_ape = ?, mentions_facture = ?,
                    premiere_heure_agenda = ?, derniere_heure_agenda = ?, duree_rdv_defaut = ?
                WHERE user_id = ?
            ");
            $stmt->execute([
                $nomCabinet, $siteWeb, $adresseCabinet, $telephoneCabinet, $emailCabinet,
                $siret, $codeApe, $mentionsFacture,
                $premiereHeure, $derniereHeure, $dureeRdv,
                $userId
            ]);
            flashSet('error', "Migration SQL manquante : exécuter app/sql/12-migration-trame-v2.sql via phpMyAdmin pour activer la trame V2.");
            redirect('parametres');
        }
    } else {
        try {
            $stmt = $db->prepare("
                INSERT INTO user_settings (user_id, nom_cabinet, site_web, adresse_cabinet, telephone_cabinet, email_cabinet, siret, code_ape, mentions_facture, premiere_heure_agenda, derniere_heure_agenda, duree_rdv_defaut, trame_v2_enabled)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");
            $stmt->execute([
                $userId, $nomCabinet, $siteWeb, $adresseCabinet, $telephoneCabinet, $emailCabinet,
                $siret, $codeApe, $mentionsFacture, $premiereHeure, $derniereHeure, $dureeRdv, $trameV2
            ]);
        } catch (PDOException $e) {
            $stmt = $db->prepare("
                INSERT INTO user_settings (user_id, nom_cabinet, site_web, adresse_cabinet, telephone_cabinet, email_cabinet, siret, code_ape, mentions_facture, premiere_heure_agenda, derniere_heure_agenda, duree_rdv_defaut)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");
            $stmt->execute([
                $userId, $nomCabinet, $siteWeb, $adresseCabinet, $telephoneCabinet, $emailCabinet,
                $siret, $codeApe, $mentionsFacture, $premiereHeure, $derniereHeure, $dureeRdv
            ]);
            flashSet('error', "Migration SQL manquante : exécuter app/sql/12-migration-trame-v2.sql via phpMyAdmin pour activer la trame V2.");
            redirect('parametres');
        }
    }

    // Mettre à jour SIRET dans users aussi
    if ($siret) {
        $db->prepare("UPDATE users SET siret = ? WHERE id = ?")->execute([$siret, $userId]);
    }

    flashSet('success', 'Paramètres du cabinet enregistrés.');

} elseif ($tab === 'profil') {
    // Profil utilisateur
    $prenom = getPost('prenom');
    $nom = getPost('nom');
    $email = getPost('email');
    $telephone = getPost('telephone');
    $adresse = getPost('adresse');
    $newPassword = getPost('new_password');
    $confirmPassword = getPost('confirm_password');

    $stmt = $db->prepare("UPDATE users SET prenom = ?, nom = ?, email = ?, telephone = ?, adresse = ? WHERE id = ?");
    $stmt->execute([$prenom, $nom, $email, $telephone, $adresse, $userId]);

    // Changement de mot de passe
    if ($newPassword) {
        if ($newPassword !== $confirmPassword) {
            flashSet('error', 'Les mots de passe ne correspondent pas.');
            redirect('parametres');
        }
        if (strlen($newPassword) < 6) {
            flashSet('error', 'Le mot de passe doit faire au moins 6 caractères.');
            redirect('parametres');
        }
        $hash = password_hash($newPassword, PASSWORD_DEFAULT);
        $db->prepare("UPDATE users SET password_hash = ? WHERE id = ?")->execute([$hash, $userId]);
    }

    flashSet('success', 'Profil mis à jour.');
}

redirect('parametres');
