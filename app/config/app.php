<?php
/**
 * Configuration générale de l'application
 */

define('APP_NAME', 'PHV Naturo');
define('APP_VERSION', '2.0.0');
define('APP_URL', ''); // Racine du site (vide = racine)

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

// Types de rendez-vous
define('RDV_TYPES', [
    'premiere_consultation' => ['label' => 'Première consultation', 'duree' => 90, 'couleur' => '#4a6741'],
    'suivi' => ['label' => 'Suivi', 'duree' => 60, 'couleur' => '#5a7a4c'],
    'telephone' => ['label' => 'Téléphone', 'duree' => 30, 'couleur' => '#4a7a9b'],
    'visio' => ['label' => 'Téléconsultation', 'duree' => 60, 'couleur' => '#6b4a9b'],
    'autre' => ['label' => 'Autre', 'duree' => 60, 'couleur' => '#7a8370'],
]);

// Statuts de rendez-vous
define('RDV_STATUTS', [
    'planifie' => ['label' => 'Planifié', 'badge' => 'badge-info'],
    'confirme' => ['label' => 'Confirmé', 'badge' => 'badge-success'],
    'en_cours' => ['label' => 'En cours', 'badge' => 'badge-warning'],
    'termine' => ['label' => 'Terminé', 'badge' => 'badge-sage'],
    'annule' => ['label' => 'Annulé', 'badge' => 'badge-danger'],
    'no_show' => ['label' => 'Absent', 'badge' => 'badge-danger'],
]);

// Statuts de factures
define('FACTURE_STATUTS', [
    'brouillon' => ['label' => 'Brouillon', 'badge' => 'badge-secondary'],
    'envoyee' => ['label' => 'Envoyée', 'badge' => 'badge-info'],
    'payee' => ['label' => 'Payée', 'badge' => 'badge-success'],
    'annulee' => ['label' => 'Annulée', 'badge' => 'badge-danger'],
    'en_retard' => ['label' => 'En retard', 'badge' => 'badge-warning'],
]);

// Modes de paiement
define('MODES_PAIEMENT', [
    'especes' => 'Espèces',
    'cheque' => 'Chèque',
    'cb' => 'Carte bancaire',
    'virement' => 'Virement',
    'autre' => 'Autre',
]);

// Types de protocoles
define('PROTOCOLE_TYPES', [
    'detox' => 'Détox',
    'remineralisation' => 'Reminéralisation',
    'immunite' => 'Immunité',
    'digestif' => 'Digestif',
    'stress' => 'Gestion du stress',
    'hormonal' => 'Équilibre hormonal',
    'peau' => 'Santé de la peau',
    'poids' => 'Gestion du poids',
    'autre' => 'Autre',
]);

// Types d'objectifs
define('OBJECTIF_TYPES', [
    'poids' => 'Poids',
    'stress' => 'Gestion du stress',
    'sommeil' => 'Qualité du sommeil',
    'energie' => 'Niveau d\'énergie',
    'alimentation' => 'Habitudes alimentaires',
    'activite' => 'Activité physique',
    'autre' => 'Autre',
]);
