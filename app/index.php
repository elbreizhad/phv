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

// Routing
$validPages = [
    'login',
    'logout',
    'install',
    'dashboard',
    'clients',
    'client-new',
    'client-edit',
    'client-view',
    'consultation-new',
    'consultation-step1',
    'consultation-step2',
    'consultation-step3',
    'consultation-step4',
    'consultation-step5',
    'consultation-step6',
    'consultation-view',
    'fiches',
    'fiche-view',
    'phv-export',
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
    }
}

// Logout
if ($page === 'logout') {
    logout();
    redirect('login');
}

// Pages sans layout (login, install, export PDF)
$noLayout = ['login', 'install', 'phv-export'];

if (in_array($page, $noLayout)) {
    require __DIR__ . '/pages/' . $page . '.php';
    exit;
}

// Pages avec layout sidebar
require __DIR__ . '/includes/header.php';
require __DIR__ . '/pages/' . $page . '.php';
require __DIR__ . '/includes/footer.php';
