<?php
/**
 * Configuration générale de l'application
 */

define('APP_NAME', 'PHV Naturo');
define('APP_VERSION', '1.0.0');
define('APP_URL', '/app');

// Catégories de motifs de consultation
define('MOTIF_CATEGORIES', [
    'digestif' => 'Troubles digestifs',
    'stress_sommeil' => 'Stress / Sommeil',
    'hormonal' => 'Déséquilibre hormonal',
    'peau' => 'Problèmes de peau',
    'poids' => 'Gestion du poids',
    'immunitaire' => 'Immunité / Fatigue',
    'douleurs' => 'Douleurs articulaires / musculaires',
    'gyneco' => 'Troubles gynécologiques',
    'uro' => 'Troubles urinaires',
    'cardio' => 'Troubles cardiovasculaires',
    'respiratoire' => 'Troubles respiratoires',
    'sportif' => 'Accompagnement sportif',
    'general' => 'Bilan général / Prévention',
    'autre' => 'Autre',
]);

// Systèmes corporels pour le bilan
define('SYSTEMES', [
    'digestif' => 'Système digestif',
    'nerveux' => 'Système nerveux / Psycho-émotionnel',
    'endocrinien' => 'Système endocrinien',
    'cardio' => 'Système cardiovasculaire',
    'respiratoire' => 'Système respiratoire',
    'uro_genital' => 'Système uro-génital',
    'osteo' => 'Système ostéo-articulaire',
    'tegumentaire' => 'Peau / Phanères',
    'immunitaire' => 'Système immunitaire',
]);

// Mapping motif -> systèmes prioritaires à explorer
define('MOTIF_SYSTEMES_PRIORITAIRES', [
    'digestif' => ['digestif', 'nerveux', 'endocrinien'],
    'stress_sommeil' => ['nerveux', 'endocrinien', 'digestif'],
    'hormonal' => ['endocrinien', 'uro_genital', 'nerveux'],
    'peau' => ['tegumentaire', 'digestif', 'endocrinien'],
    'poids' => ['digestif', 'endocrinien', 'nerveux'],
    'immunitaire' => ['immunitaire', 'digestif', 'nerveux'],
    'douleurs' => ['osteo', 'nerveux', 'digestif'],
    'gyneco' => ['uro_genital', 'endocrinien', 'nerveux'],
    'uro' => ['uro_genital', 'digestif', 'immunitaire'],
    'cardio' => ['cardio', 'nerveux', 'digestif'],
    'respiratoire' => ['respiratoire', 'immunitaire', 'nerveux'],
    'sportif' => ['osteo', 'digestif', 'nerveux'],
    'general' => ['digestif', 'nerveux', 'endocrinien'],
    'autre' => ['digestif', 'nerveux', 'endocrinien'],
]);

// Étapes de la consultation
define('CONSULTATION_STEPS', [
    1 => ['slug' => 'accueil', 'label' => 'Accueil & Motif', 'icon' => 'clipboard-list'],
    2 => ['slug' => 'general', 'label' => 'Informations générales', 'icon' => 'user'],
    3 => ['slug' => 'mode-de-vie', 'label' => 'Mode de vie', 'icon' => 'heart'],
    4 => ['slug' => 'bilan', 'label' => 'Bilan systémique', 'icon' => 'activity'],
    5 => ['slug' => 'synthese', 'label' => 'Synthèse', 'icon' => 'search'],
    6 => ['slug' => 'phv', 'label' => 'Programme PHV', 'icon' => 'file-text'],
]);
