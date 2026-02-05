<?php
/**
 * PHV Naturo - Point d'entrée principal (router)
 */

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/helpers.php';

initSession();

$page = getGet('page', 'dashboard');

// Pages accessibles sans authentification
$publicPages = ['login', 'install'];

if (!in_array($page, $publicPages)) {
    requireAuth();
}

// API endpoints (AJAX, JSON response, pas de layout)
$apiPages = ['suggestions-api', 'agenda-api', 'factures-api', 'stats-api'];
if (in_array($page, $apiPages)) {
    $apiFile = $page === 'suggestions-api' ? '/pages/actions/suggestions-api.php' : '/pages/' . $page . '.php';
    require __DIR__ . $apiFile;
    exit;
}

// Routing
$validPages = [
    'login',
    'logout',
    'install',
    'dashboard',
    // Clients
    'clients',
    'client-new',
    'client-edit',
    'client-view',
    'client-evolution',
    'client-objectifs',
    'client-documents',
    'client-timeline',
    // Consultations
    'consultation-new',
    'consultation-step1',
    'consultation-step2',
    'consultation-step3',
    'consultation-step4',
    'consultation-step5',
    'consultation-step6',
    'consultation-view',
    // Agenda
    'agenda',
    'agenda-api',
    // Facturation
    'factures',
    'facture-new',
    'facture-edit',
    'facture-view',
    'facture-export',
    // Ressources
    'fiches',
    'fiche-view',
    'phv-export',
    'phv-templates',
    'phv-template-edit',
    'protocoles',
    'protocole-edit',
    'recettes',
    'recette-edit',
    // Bilans
    'bilan-alimentaire',
    'bilan-alimentaire-edit',
    // Statistiques
    'statistiques',
    // Paramètres
    'parametres',
    'parametres-cabinet',
    'parametres-prestations',
    // Questionnaire pré-consultation (public)
    'questionnaire-pre',
];

if (!in_array($page, $validPages)) {
    $page = 'dashboard';
}

// Actions POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = getPost('action');

    switch ($action) {
        case 'login':
            if (login(getPost('username'), getPost('password'))) {
                redirect('dashboard');
            } else {
                flashSet('error', 'Identifiants incorrects.');
                redirect('login');
            }
            break;

        case 'client-save':
            require __DIR__ . '/pages/actions/client-save.php';
            break;

        case 'consultation-create':
            require __DIR__ . '/pages/actions/consultation-create.php';
            break;

        case 'consultation-save-step':
            require __DIR__ . '/pages/actions/consultation-save-step.php';
            break;

        case 'synthese-save':
            require __DIR__ . '/pages/actions/synthese-save.php';
            break;

        case 'phv-save':
            require __DIR__ . '/pages/actions/phv-save.php';
            break;

        // Agenda
        case 'rdv-save':
            require __DIR__ . '/pages/actions/rdv-save.php';
            break;

        case 'rdv-confirm':
            $rdvId = (int)getPost('rdv_id');
            $db = getDB();
            $stmt = $db->prepare("UPDATE rendez_vous SET statut = 'confirme' WHERE id = ? AND user_id = ?");
            $stmt->execute([$rdvId, currentUserId()]);
            flashSet('success', 'Rendez-vous confirmé.');
            redirect('agenda');
            break;

        case 'rdv-cancel':
            $rdvId = (int)getPost('rdv_id');
            $db = getDB();
            $stmt = $db->prepare("UPDATE rendez_vous SET statut = 'annule' WHERE id = ? AND user_id = ?");
            $stmt->execute([$rdvId, currentUserId()]);
            flashSet('success', 'Rendez-vous annulé.');
            redirect('agenda');
            break;

        // Factures
        case 'facture-save':
            require __DIR__ . '/pages/actions/facture-save.php';
            break;

        case 'facture-payer':
            require __DIR__ . '/pages/actions/facture-payer.php';
            break;

        // Client - Mesures et objectifs
        case 'mesure-save':
            require __DIR__ . '/pages/actions/mesure-save.php';
            break;

        case 'objectif-save':
            require __DIR__ . '/pages/actions/objectif-save.php';
            break;

        // Templates et protocoles
        case 'phv-template-save':
            require __DIR__ . '/pages/actions/phv-template-save.php';
            break;

        case 'protocole-save':
            require __DIR__ . '/pages/actions/protocole-save.php';
            break;

        // Paramètres
        case 'settings-save':
            require __DIR__ . '/pages/actions/settings-save.php';
            break;

        case 'prestation-save':
            require __DIR__ . '/pages/actions/prestation-save.php';
            break;

        case 'prestation-delete':
            $prestationId = (int)getPost('prestation_id');
            $db = getDB();
            $db->prepare("DELETE FROM prestations WHERE id = ? AND user_id = ?")->execute([$prestationId, currentUserId()]);
            flashSet('success', 'Prestation supprimée.');
            redirect('parametres');
            break;

        // Recettes
        case 'recette-save':
            require __DIR__ . '/pages/actions/recette-save.php';
            break;

        case 'recette-delete':
            $recetteId = (int)getPost('recette_id');
            $db = getDB();
            $db->prepare("DELETE FROM recettes WHERE id = ? AND user_id = ?")->execute([$recetteId, currentUserId()]);
            flashSet('success', 'Recette supprimée.');
            redirect('recettes');
            break;

        // Protocoles
        case 'protocole-delete':
            $protocoleId = (int)getPost('protocole_id');
            $db = getDB();
            $db->prepare("DELETE FROM protocoles WHERE id = ? AND user_id = ?")->execute([$protocoleId, currentUserId()]);
            flashSet('success', 'Protocole supprimé.');
            redirect('protocoles');
            break;

        // Templates PHV
        case 'phv-template-delete':
            $templateId = (int)getPost('template_id');
            $db = getDB();
            $db->prepare("DELETE FROM phv_templates WHERE id = ? AND user_id = ?")->execute([$templateId, currentUserId()]);
            flashSet('success', 'Template supprimé.');
            redirect('phv-templates');
            break;
    }
}

// Logout
if ($page === 'logout') {
    logout();
    redirect('login');
}

// Pages sans layout (login, install, export PDF, questionnaire public)
$noLayout = ['login', 'install', 'phv-export', 'facture-export', 'questionnaire-pre'];

if (in_array($page, $noLayout)) {
    require __DIR__ . '/pages/' . $page . '.php';
    exit;
}

// Pages avec layout sidebar
require __DIR__ . '/includes/header.php';
require __DIR__ . '/pages/' . $page . '.php';
require __DIR__ . '/includes/footer.php';
