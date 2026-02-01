<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e(APP_NAME) ?></title>
    <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/style.css">
</head>
<body>
<div class="app-layout">
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <h1>PHV Naturo</h1>
            <div class="brand-subtitle">Outil de consultation</div>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section">Principal</div>
            <a href="<?= url('dashboard') ?>" class="nav-link <?= $page === 'dashboard' ? 'active' : '' ?>">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                Tableau de bord
            </a>
            <a href="<?= url('clients') ?>" class="nav-link <?= in_array($page, ['clients','client-new','client-edit','client-view']) ? 'active' : '' ?>">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                Clients
            </a>

            <div class="nav-section" style="margin-top: 1rem;">Ressources</div>
            <a href="<?= url('fiches') ?>" class="nav-link <?= in_array($page, ['fiches','fiche-view']) ? 'active' : '' ?>">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                Fiches pathologies
            </a>
        </nav>

        <div class="sidebar-footer">
            <span><?= e(currentUserName()) ?></span>
            <a href="<?= url('logout') ?>">Quitter</a>
        </div>
    </aside>

    <!-- Main -->
    <main class="main-content">
<?php
$flash = flashGet();
if ($flash): ?>
    <div class="page-body" style="padding-bottom:0;">
        <div class="alert alert-<?= e($flash['type']) ?> animate-in">
            <?= e($flash['message']) ?>
        </div>
    </div>
<?php endif; ?>
