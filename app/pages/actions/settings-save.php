<?php
/**
 * Action: Sauvegarder les paramètres
 */
$db = getDB();
$userId = currentUserId();

$tab = getPost('tab', 'cabinet');

// Mode debug trame V2 - capture tout le cycle save
$debug = [
    'tab' => $tab,
    'user_id' => $userId,
    'post_trame_v2_enabled' => $_POST['trame_v2_enabled'] ?? '(absent du POST)',
    'post_keys' => array_keys($_POST),
    'php_file' => __FILE__,
    'php_mtime' => date('Y-m-d H:i:s', filemtime(__FILE__)),
];

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
    $debug['trameV2_valeur_a_sauver'] = $trameV2;

    // Vérifier structure table
    try {
        $colStmt = $db->query("SHOW COLUMNS FROM user_settings LIKE 'trame_v2_enabled'");
        $debug['colonne_trame_v2_enabled_existe'] = (bool) $colStmt->fetch();
    } catch (Throwable $e) {
        $debug['colonne_trame_v2_enabled_existe'] = 'ERREUR: ' . $e->getMessage();
    }

    // Vérifier si settings existe
    $checkStmt = $db->prepare("SELECT id FROM user_settings WHERE user_id = ?");
    $checkStmt->execute([$userId]);
    $exists = (bool) $checkStmt->fetch();
    $debug['ligne_existe_deja'] = $exists;

    if ($exists) {
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
            $debug['requete_executee'] = 'UPDATE (avec trame_v2_enabled)';
            $debug['rowcount'] = $stmt->rowCount();
        } catch (PDOException $e) {
            $debug['pdo_exception_update'] = $e->getMessage();
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
            $debug['requete_executee'] = 'UPDATE (fallback sans trame_v2_enabled)';
            $_SESSION['trame_v2_debug'] = $debug;
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
            $debug['requete_executee'] = 'INSERT (avec trame_v2_enabled)';
        } catch (PDOException $e) {
            $debug['pdo_exception_insert'] = $e->getMessage();
            $stmt = $db->prepare("
                INSERT INTO user_settings (user_id, nom_cabinet, site_web, adresse_cabinet, telephone_cabinet, email_cabinet, siret, code_ape, mentions_facture, premiere_heure_agenda, derniere_heure_agenda, duree_rdv_defaut)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");
            $stmt->execute([
                $userId, $nomCabinet, $siteWeb, $adresseCabinet, $telephoneCabinet, $emailCabinet,
                $siret, $codeApe, $mentionsFacture, $premiereHeure, $derniereHeure, $dureeRdv
            ]);
            $debug['requete_executee'] = 'INSERT (fallback sans trame_v2_enabled)';
            $_SESSION['trame_v2_debug'] = $debug;
            flashSet('error', "Migration SQL manquante : exécuter app/sql/12-migration-trame-v2.sql via phpMyAdmin pour activer la trame V2.");
            redirect('parametres');
        }
    }

    // Vérifier la valeur effectivement stockée
    try {
        $verif = $db->prepare("SELECT trame_v2_enabled FROM user_settings WHERE user_id = ?");
        $verif->execute([$userId]);
        $debug['valeur_relue_en_base'] = var_export($verif->fetchColumn(), true);
    } catch (Throwable $e) {
        $debug['valeur_relue_en_base'] = 'ERREUR relecture: ' . $e->getMessage();
    }

    $_SESSION['trame_v2_debug'] = $debug;

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
