-- ============================================
-- PHV Naturo - Installation Complète Production
-- Base de données: pertec_natu
-- Version 2.0 avec téléconsultation
-- ============================================

USE pertec_natu;

-- ============================================
-- 1. STRUCTURE DES TABLES
-- ============================================

-- UTILISATEURS (authentification praticien)
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(255),
    telephone VARCHAR(20),
    siret VARCHAR(20),
    adresse TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- CLIENTS
CREATE TABLE IF NOT EXISTS clients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    date_naissance DATE,
    age INT,
    sexe ENUM('homme', 'femme', 'autre') DEFAULT NULL,
    adresse TEXT,
    email VARCHAR(255),
    telephone VARCHAR(20),
    profession VARCHAR(150),
    lieu_de_vie VARCHAR(255),
    taille_cm INT,
    poids_kg DECIMAL(5,1),
    notes TEXT,
    allergies TEXT,
    traitements_en_cours TEXT,
    antecedents_medicaux TEXT,
    grossesse BOOLEAN DEFAULT FALSE,
    allaitement BOOLEAN DEFAULT FALSE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- CONSULTATIONS
CREATE TABLE IF NOT EXISTS consultations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT NOT NULL,
    user_id INT NOT NULL,
    motif TEXT NOT NULL,
    motif_categorie VARCHAR(100),
    date_consultation DATE NOT NULL,
    duree_minutes INT DEFAULT 75,
    type_seance ENUM('premiere', 'suivi') DEFAULT 'premiere',
    statut ENUM('en_cours', 'questionnaire', 'synthese', 'phv', 'terminee') DEFAULT 'en_cours',
    current_step INT DEFAULT 1,
    notes_praticien TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (client_id) REFERENCES clients(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- REPONSES AU QUESTIONNAIRE
CREATE TABLE IF NOT EXISTS consultation_reponses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    consultation_id INT NOT NULL,
    section VARCHAR(100) NOT NULL,
    sous_section VARCHAR(100),
    question_key VARCHAR(100) NOT NULL,
    question_label TEXT,
    reponse TEXT,
    score INT DEFAULT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (consultation_id) REFERENCES consultations(id) ON DELETE CASCADE,
    INDEX idx_section (consultation_id, section),
    INDEX idx_question (consultation_id, question_key)
) ENGINE=InnoDB;

-- SYNTHESE DE CONSULTATION
CREATE TABLE IF NOT EXISTS consultation_synthese (
    id INT AUTO_INCREMENT PRIMARY KEY,
    consultation_id INT NOT NULL UNIQUE,
    organes_desequilibre JSON,
    axes_travail JSON,
    priorite_1 TEXT,
    priorite_2 TEXT,
    priorite_3 TEXT,
    observations TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (consultation_id) REFERENCES consultations(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- PHV (Programme d'Hygiène de Vie)
CREATE TABLE IF NOT EXISTS phv (
    id INT AUTO_INCREMENT PRIMARY KEY,
    consultation_id INT NOT NULL UNIQUE,
    alimentation TEXT,
    alimentation_eviter TEXT,
    alimentation_privilegier TEXT,
    menu_type TEXT,
    activite_physique TEXT,
    gestion_stress TEXT,
    routine_matin TEXT,
    routine_soir TEXT,
    complements JSON,
    soins_naturels TEXT,
    recommandations_complementaires TEXT,
    notes TEXT,
    commentaires_praticien JSON,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (consultation_id) REFERENCES consultations(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- FICHES PATHOLOGIES
CREATE TABLE IF NOT EXISTS fiches_pathologies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(200) NOT NULL,
    systeme VARCHAR(100) NOT NULL,
    description TEXT,
    causes TEXT,
    signes_cliniques TEXT,
    conseils_alimentation TEXT,
    aliments_eviter TEXT,
    aliments_privilegier TEXT,
    conseils_activite TEXT,
    conseils_stress TEXT,
    conseils_routine TEXT,
    complements TEXT,
    phytotherapie TEXT,
    aromatherapie TEXT,
    notes TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- RENDEZ-VOUS / AGENDA (avec visio)
CREATE TABLE IF NOT EXISTS rendez_vous (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    client_id INT,
    titre VARCHAR(255) NOT NULL,
    description TEXT,
    date_rdv DATE NOT NULL,
    heure_debut TIME NOT NULL,
    heure_fin TIME NOT NULL,
    duree_minutes INT DEFAULT 60,
    type_rdv ENUM('premiere_consultation', 'suivi', 'telephone', 'visio', 'autre') DEFAULT 'premiere_consultation',
    statut ENUM('planifie', 'confirme', 'en_cours', 'termine', 'annule', 'no_show') DEFAULT 'planifie',
    lieu VARCHAR(255) DEFAULT 'Cabinet',
    tarif DECIMAL(10,2),
    notes TEXT,
    rappel_envoye BOOLEAN DEFAULT FALSE,
    rappel_date DATETIME,
    consultation_id INT,
    couleur VARCHAR(7) DEFAULT '#4a6741',
    recurrence ENUM('aucune', 'hebdomadaire', 'mensuel') DEFAULT 'aucune',
    visio_enabled BOOLEAN DEFAULT FALSE,
    visio_room_id VARCHAR(100),
    visio_token VARCHAR(100),
    visio_password VARCHAR(20),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (client_id) REFERENCES clients(id) ON DELETE SET NULL,
    FOREIGN KEY (consultation_id) REFERENCES consultations(id) ON DELETE SET NULL,
    INDEX idx_date (user_id, date_rdv),
    INDEX idx_client (client_id)
) ENGINE=InnoDB;

-- FACTURES
CREATE TABLE IF NOT EXISTS factures (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    client_id INT NOT NULL,
    consultation_id INT,
    numero_facture VARCHAR(50) NOT NULL UNIQUE,
    date_facture DATE NOT NULL,
    date_echeance DATE,
    montant_ht DECIMAL(10,2) NOT NULL,
    taux_tva DECIMAL(5,2) DEFAULT 0,
    montant_tva DECIMAL(10,2) DEFAULT 0,
    montant_ttc DECIMAL(10,2) NOT NULL,
    statut ENUM('brouillon', 'envoyee', 'payee', 'annulee', 'en_retard') DEFAULT 'brouillon',
    mode_paiement ENUM('especes', 'cheque', 'cb', 'virement', 'autre'),
    date_paiement DATE,
    reference_paiement VARCHAR(100),
    notes TEXT,
    mentions_legales TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (client_id) REFERENCES clients(id) ON DELETE CASCADE,
    FOREIGN KEY (consultation_id) REFERENCES consultations(id) ON DELETE SET NULL,
    INDEX idx_numero (numero_facture),
    INDEX idx_statut (user_id, statut),
    INDEX idx_date (user_id, date_facture)
) ENGINE=InnoDB;

-- Lignes de facture
CREATE TABLE IF NOT EXISTS facture_lignes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    facture_id INT NOT NULL,
    description VARCHAR(255) NOT NULL,
    quantite DECIMAL(10,2) DEFAULT 1,
    prix_unitaire DECIMAL(10,2) NOT NULL,
    montant DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (facture_id) REFERENCES factures(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- TARIFS / PRESTATIONS
CREATE TABLE IF NOT EXISTS prestations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    nom VARCHAR(255) NOT NULL,
    description TEXT,
    duree_minutes INT DEFAULT 60,
    tarif DECIMAL(10,2) NOT NULL,
    actif BOOLEAN DEFAULT TRUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- MESURES / EVOLUTION CLIENT
CREATE TABLE IF NOT EXISTS client_mesures (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT NOT NULL,
    consultation_id INT,
    date_mesure DATE NOT NULL,
    poids_kg DECIMAL(5,1),
    tour_taille_cm INT,
    tour_hanches_cm INT,
    imc DECIMAL(4,1),
    masse_grasse_pct DECIMAL(4,1),
    masse_musculaire_pct DECIMAL(4,1),
    niveau_stress INT,
    qualite_sommeil INT,
    niveau_energie INT,
    niveau_digestion INT,
    notes TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (client_id) REFERENCES clients(id) ON DELETE CASCADE,
    FOREIGN KEY (consultation_id) REFERENCES consultations(id) ON DELETE SET NULL,
    INDEX idx_client_date (client_id, date_mesure)
) ENGINE=InnoDB;

-- OBJECTIFS CLIENT
CREATE TABLE IF NOT EXISTS client_objectifs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT NOT NULL,
    titre VARCHAR(255) NOT NULL,
    description TEXT,
    type_objectif ENUM('poids', 'stress', 'sommeil', 'energie', 'alimentation', 'activite', 'autre') DEFAULT 'autre',
    valeur_cible VARCHAR(100),
    valeur_initiale VARCHAR(100),
    date_debut DATE,
    date_cible DATE,
    statut ENUM('en_cours', 'atteint', 'abandonne', 'en_pause') DEFAULT 'en_cours',
    progression INT DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (client_id) REFERENCES clients(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- DOCUMENTS CLIENT
CREATE TABLE IF NOT EXISTS client_documents (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT NOT NULL,
    user_id INT NOT NULL,
    type_document ENUM('photo', 'consentement', 'ordonnance', 'analyse', 'autre') DEFAULT 'autre',
    nom VARCHAR(255) NOT NULL,
    chemin_fichier VARCHAR(500) NOT NULL,
    taille_octets INT,
    mime_type VARCHAR(100),
    description TEXT,
    date_document DATE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (client_id) REFERENCES clients(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- TEMPLATES PHV
CREATE TABLE IF NOT EXISTS phv_templates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    nom VARCHAR(255) NOT NULL,
    motif_categorie VARCHAR(100),
    description TEXT,
    alimentation TEXT,
    alimentation_eviter TEXT,
    alimentation_privilegier TEXT,
    menu_type TEXT,
    activite_physique TEXT,
    gestion_stress TEXT,
    routine_matin TEXT,
    routine_soir TEXT,
    complements JSON,
    soins_naturels TEXT,
    recommandations_complementaires TEXT,
    actif BOOLEAN DEFAULT TRUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- PROTOCOLES
CREATE TABLE IF NOT EXISTS protocoles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    nom VARCHAR(255) NOT NULL,
    type_protocole ENUM('detox', 'remineralisation', 'immunite', 'digestif', 'stress', 'hormonal', 'peau', 'poids', 'autre') DEFAULT 'autre',
    duree_jours INT,
    description TEXT,
    objectifs TEXT,
    phases JSON,
    complements JSON,
    alimentation TEXT,
    contre_indications TEXT,
    actif BOOLEAN DEFAULT TRUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- CONTRE-INDICATIONS & ALERTES
CREATE TABLE IF NOT EXISTS contre_indications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    type_element ENUM('plante', 'huile_essentielle', 'complement', 'aliment') NOT NULL,
    nom_element VARCHAR(255) NOT NULL,
    condition_ci VARCHAR(255) NOT NULL,
    description TEXT,
    niveau_gravite ENUM('info', 'attention', 'danger') DEFAULT 'attention',
    source VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_element (type_element, nom_element),
    INDEX idx_condition (condition_ci)
) ENGINE=InnoDB;

-- BILAN ALIMENTAIRE
CREATE TABLE IF NOT EXISTS bilans_alimentaires (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT NOT NULL,
    consultation_id INT,
    date_debut DATE NOT NULL,
    date_fin DATE NOT NULL,
    statut ENUM('en_cours', 'complete', 'analyse') DEFAULT 'en_cours',
    observations TEXT,
    recommandations TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (client_id) REFERENCES clients(id) ON DELETE CASCADE,
    FOREIGN KEY (consultation_id) REFERENCES consultations(id) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS bilan_alimentaire_jours (
    id INT AUTO_INCREMENT PRIMARY KEY,
    bilan_id INT NOT NULL,
    date_jour DATE NOT NULL,
    petit_dejeuner TEXT,
    heure_petit_dejeuner TIME,
    collation_matin TEXT,
    dejeuner TEXT,
    heure_dejeuner TIME,
    collation_aprem TEXT,
    diner TEXT,
    heure_diner TIME,
    collation_soir TEXT,
    boissons TEXT,
    quantite_eau_ml INT,
    humeur INT,
    energie INT,
    digestion INT,
    notes TEXT,
    FOREIGN KEY (bilan_id) REFERENCES bilans_alimentaires(id) ON DELETE CASCADE,
    INDEX idx_bilan_date (bilan_id, date_jour)
) ENGINE=InnoDB;

-- QUESTIONNAIRES PRE-CONSULTATION
CREATE TABLE IF NOT EXISTS questionnaires_pre_consultation (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT NOT NULL,
    user_id INT NOT NULL,
    token VARCHAR(100) UNIQUE NOT NULL,
    date_envoi DATETIME,
    date_limite DATE,
    date_reponse DATETIME,
    statut ENUM('brouillon', 'envoye', 'complete', 'expire') DEFAULT 'brouillon',
    reponses JSON,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (client_id) REFERENCES clients(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_token (token)
) ENGINE=InnoDB;

-- COMMUNICATIONS CLIENT
CREATE TABLE IF NOT EXISTS communications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    client_id INT NOT NULL,
    type_comm ENUM('email', 'sms', 'appel', 'courrier') DEFAULT 'email',
    sujet VARCHAR(255),
    contenu TEXT,
    date_envoi DATETIME,
    statut ENUM('brouillon', 'envoye', 'echec') DEFAULT 'brouillon',
    piece_jointe VARCHAR(500),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (client_id) REFERENCES clients(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- JOURNAL D'ACTIVITE (Logs)
CREATE TABLE IF NOT EXISTS activity_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    action VARCHAR(100) NOT NULL,
    entite VARCHAR(50),
    entite_id INT,
    details JSON,
    ip_address VARCHAR(45),
    user_agent TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_user_action (user_id, action),
    INDEX idx_date (created_at)
) ENGINE=InnoDB;

-- PARAMETRES UTILISATEUR
CREATE TABLE IF NOT EXISTS user_settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL UNIQUE,
    nom_cabinet VARCHAR(255),
    logo_path VARCHAR(500),
    adresse_cabinet TEXT,
    telephone_cabinet VARCHAR(20),
    email_cabinet VARCHAR(255),
    site_web VARCHAR(255),
    siret VARCHAR(20),
    code_ape VARCHAR(10),
    numero_tva VARCHAR(30),
    mentions_facture TEXT,
    devise VARCHAR(3) DEFAULT 'EUR',
    format_date VARCHAR(20) DEFAULT 'd/m/Y',
    premiere_heure_agenda TIME DEFAULT '08:00:00',
    derniere_heure_agenda TIME DEFAULT '20:00:00',
    duree_rdv_defaut INT DEFAULT 60,
    rappel_rdv_heures INT DEFAULT 24,
    theme VARCHAR(20) DEFAULT 'light',
    rgpd_consentement_texte TEXT,
    rgpd_duree_conservation_ans INT DEFAULT 10,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- RECETTES & MENUS
CREATE TABLE IF NOT EXISTS recettes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    nom VARCHAR(255) NOT NULL,
    categorie ENUM('petit_dejeuner', 'entree', 'plat', 'dessert', 'boisson', 'collation') DEFAULT 'plat',
    temps_preparation INT,
    temps_cuisson INT,
    portions INT DEFAULT 4,
    ingredients TEXT,
    instructions TEXT,
    valeurs_nutritionnelles JSON,
    regimes JSON,
    allergenes JSON,
    saison ENUM('printemps', 'ete', 'automne', 'hiver', 'toutes') DEFAULT 'toutes',
    image_path VARCHAR(500),
    source VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- FICHES CONSEIL (imprimables)
CREATE TABLE IF NOT EXISTS fiches_conseil (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    titre VARCHAR(255) NOT NULL,
    categorie VARCHAR(100),
    contenu TEXT,
    format ENUM('a4', 'a5') DEFAULT 'a4',
    actif BOOLEAN DEFAULT TRUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB;


-- ============================================
-- 2. DONNEES INITIALES
-- ============================================

-- Utilisateur par défaut (mot de passe: naturo2026)
INSERT INTO users (username, password_hash, nom, prenom, email) VALUES (
    'praticien',
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
    'Praticien',
    'PHV',
    'praticien@phv.fr'
);

-- Prestations par défaut
INSERT INTO prestations (user_id, nom, description, duree_minutes, tarif) VALUES
(1, 'Première consultation', 'Bilan complet et PHV personnalisé', 90, 70.00),
(1, 'Consultation de suivi', 'Suivi et ajustements du PHV', 60, 50.00),
(1, 'Consultation téléphonique', 'Suivi rapide par téléphone', 30, 30.00),
(1, 'Téléconsultation vidéo', 'Consultation en visioconférence', 60, 55.00),
(1, 'Bilan alimentaire', 'Analyse détaillée des habitudes alimentaires', 45, 40.00);

-- Paramètres utilisateur par défaut
INSERT INTO user_settings (user_id, nom_cabinet, mentions_facture) VALUES
(1, 'Cabinet de Naturopathie', 'Naturopathe certifié - Non conventionné - Règlement à réception');

-- Contre-indications de base
INSERT INTO contre_indications (type_element, nom_element, condition_ci, description, niveau_gravite) VALUES
('plante', 'Millepertuis', 'Pilule contraceptive', 'Diminue l\'efficacité de la contraception', 'danger'),
('plante', 'Millepertuis', 'Antidépresseurs', 'Risque de syndrome sérotoninergique', 'danger'),
('plante', 'Millepertuis', 'Anticoagulants', 'Diminue l\'effet anticoagulant', 'danger'),
('plante', 'Ginkgo biloba', 'Anticoagulants', 'Augmente le risque de saignement', 'danger'),
('plante', 'Réglisse', 'Hypertension', 'Peut augmenter la tension artérielle', 'attention'),
('plante', 'Réglisse', 'Grossesse', 'Risque d\'accouchement prématuré', 'danger'),
('plante', 'Echinacée', 'Maladies auto-immunes', 'Stimulation immunitaire non souhaitée', 'danger'),
('huile_essentielle', 'Menthe poivrée', 'Grossesse', 'Contre-indiquée pendant la grossesse', 'danger'),
('huile_essentielle', 'Menthe poivrée', 'Enfants < 6 ans', 'Risque de spasme laryngé', 'danger'),
('huile_essentielle', 'Sauge officinale', 'Epilepsie', 'Peut déclencher des crises', 'danger'),
('huile_essentielle', 'Sauge officinale', 'Grossesse', 'Abortive', 'danger'),
('huile_essentielle', 'Romarin CT camphre', 'Epilepsie', 'Neurotoxique', 'danger'),
('complement', 'Fer', 'Hémochromatose', 'Surcharge en fer contre-indiquée', 'danger'),
('complement', 'Vitamine K', 'Anticoagulants AVK', 'Diminue l\'efficacité du traitement', 'danger'),
('complement', 'Potassium', 'Insuffisance rénale', 'Risque d\'hyperkaliémie', 'danger'),
('aliment', 'Pamplemousse', 'Statines', 'Inhibe le métabolisme hépatique', 'danger');


-- ============================================
-- 3. PROTOCOLES NATUROPATHIQUES (8 protocoles)
-- ============================================

INSERT INTO protocoles (user_id, nom, type_protocole, duree_jours, description, objectifs, phases, complements, alimentation, contre_indications) VALUES

-- DETOX HEPATIQUE
(1, 'Détox hépatique complète', 'detox', 21,
'Protocole de détoxification hépatique en 3 phases basé sur la stimulation des émonctoires.',
'- Stimuler les fonctions hépatobiliaires\n- Soutenir les phases I et II de détoxication\n- Drainer les toxines accumulées',
'[{"phase":1,"nom":"Préparation intestinale","duree":"7 jours","actions":["Réduire aliments pro-inflammatoires","Hydratation 2L minimum","Tisane romarin matin"]},{"phase":2,"nom":"Drainage actif","duree":"10 jours","actions":["Artichaut + Radis noir","Bouillotte chaude sur foie","Citron tiède matin"]},{"phase":3,"nom":"Régénération","duree":"4 jours","actions":["Chardon-Marie","Desmodium","Réintroduction progressive"]}]',
'[{"nom":"Artichaut + Radis noir","posologie":"1 ampoule avant repas midi","duree":"10 jours"},{"nom":"Chardon-Marie","posologie":"1 gélule 2x/jour","duree":"Phase 3"}]',
'Légumes cuits vapeur, riz complet, poissons maigres. Éviter: produits laitiers, gluten, viandes rouges.',
'Grossesse, calculs biliaires, obstruction voies biliaires'),

-- CONFORT DIGESTIF
(1, 'Confort digestif - SII', 'digestif', 42,
'Protocole pour syndrome intestin irritable. Approche: microbiote, muqueuse, stress.',
'- Réduire ballonnements et douleurs\n- Régulariser transit\n- Réparer perméabilité intestinale',
'[{"phase":1,"nom":"Éviction et apaisement","duree":"14 jours","actions":["Régime FODMAPs bas","Journal alimentaire","Mélisse + Menthe après repas"]},{"phase":2,"nom":"Réparation muqueuse","duree":"21 jours","actions":["L-Glutamine 5g matin","Aloe vera","Probiotiques progressifs"]},{"phase":3,"nom":"Consolidation","duree":"7 jours","actions":["Probiotiques spécifiques","Prébiotiques doux","Cohérence cardiaque"]}]',
'[{"nom":"L-Glutamine","posologie":"5g poudre matin à jeun","duree":"21 jours"},{"nom":"Probiotiques","posologie":"Lactobacillus plantarum 299v","duree":"6-8 semaines"}]',
'Phase 1: éviter oignon, ail, blé, lactose. Privilégier: riz, quinoa, carottes cuites.',
'Menthe si RGO sévère, Réglisse si hypertension'),

-- IMMUNITÉ
(1, 'Renforcement immunitaire', 'immunite', 30,
'Protocole renforcement défenses naturelles. Prévention hivernale ou post-maladie.',
'- Renforcer défenses immunitaires\n- Optimiser microbiote\n- Combler carences',
'[{"phase":1,"nom":"Optimisation terrain","duree":"10 jours","actions":["Corriger déficits zinc, vit D, vit C","Soutien microbiote","Réduire sucres"]},{"phase":2,"nom":"Stimulation active","duree":"15 jours","actions":["Échinacée (max 3 sem)","Propolis","Exercice modéré"]},{"phase":3,"nom":"Maintien","duree":"5 jours+","actions":["Arrêt échinacée","Maintien probiotiques","Antioxydants"]}]',
'[{"nom":"Vitamine D3","posologie":"2000-4000 UI/jour","duree":"Tout hiver"},{"nom":"Zinc","posologie":"15-30mg/jour","duree":"30 jours"},{"nom":"Échinacée","posologie":"Selon fabricant","duree":"3 semaines MAX"}]',
'Ail, oignon, champignons, agrumes, poissons gras, graines courge.',
'Échinacée CI si maladies auto-immunes'),

-- STRESS ET FATIGUE
(1, 'Gestion stress et fatigue', 'stress', 60,
'Accompagnement stress chronique et fatigue nerveuse. Adaptogènes + neurotransmetteurs.',
'- Restaurer adaptation au stress\n- Soutenir surrénales\n- Améliorer sommeil',
'[{"phase":1,"nom":"Phase urgence","duree":"14 jours","actions":["Magnésium haute dose","Plantes calmantes","Limiter stimulants","Cohérence cardiaque 3x/jour"]},{"phase":2,"nom":"Phase adaptogène","duree":"30 jours","actions":["Rhodiola ou Ashwagandha","Maintien magnésium + vit B","HE Épinette noire surrénales"]},{"phase":3,"nom":"Consolidation","duree":"16 jours","actions":["Diminution progressive","Maintien hygiène vie","Activité physique"]}]',
'[{"nom":"Magnésium bisglycinate","posologie":"300-400mg soir","duree":"2 mois minimum"},{"nom":"Rhodiola","posologie":"200-400mg matin et midi","duree":"Phase 2"}]',
'Oméga-3, protéines chaque repas, légumes verts, oléagineux. Éviter café après 14h.',
'Rhodiola si trouble bipolaire, Ginseng si HTA'),

-- HORMONAL FÉMININ
(1, 'Équilibre hormonal féminin', 'hormonal', 90,
'Rééquilibrage hormonal naturel. SPM, cycles irréguliers, préménopause.',
'- Régulariser cycles\n- Réduire SPM\n- Équilibrer œstrogènes/progestérone',
'[{"phase":1,"nom":"Phase folliculaire J1-J14","actions":["Phytoestrogènes doux","Soutien hépatique","Exercice cardio"]},{"phase":2,"nom":"Phase lutéale J15-J28","actions":["Gattilier","Magnésium renforcé","Onagre si mastodynies"]},{"phase":3,"nom":"Phase menstruelle J1-J5","actions":["Antispasmodiques","Chaleur bas-ventre","Fer si règles abondantes"]}]',
'[{"nom":"Gattilier","posologie":"400mg matin","duree":"3 cycles minimum"},{"nom":"Onagre","posologie":"1000-1500mg phase lutéale","duree":"Si SPM"}]',
'Crucifères 3x/sem, fibres 30g/jour, oméga-3. Phase lutéale: réduire sel et sucres.',
'Sauge CI si cancer hormono-dépendant, Gattilier éviter si FIV'),

-- PEAU / ACNÉ
(1, 'Peau nette - Accompagnement acné', 'peau', 90,
'Protocole acné adulte/ado. Détox hépatique, équilibre hormonal, microbiote cutané.',
'- Réduire inflammation cutanée\n- Équilibrer sébum\n- Rééquilibrer microbiotes',
'[{"phase":1,"nom":"Détox interne","duree":"21 jours","actions":["Bardane + Pensée sauvage","Éviction pro-inflammatoires","Hydratation +++"]},{"phase":2,"nom":"Régulation","duree":"45 jours","actions":["Zinc","Probiotiques axe intestin-peau","Soins locaux naturels"]},{"phase":3,"nom":"Consolidation","duree":"24 jours","actions":["Alimentation anti-inflammatoire","Gestion stress","Soins préventifs"]}]',
'[{"nom":"Zinc bisglycinate","posologie":"15-30mg/jour","duree":"3 mois"},{"nom":"Bardane","posologie":"300mg 2x/jour","duree":"2-3 mois"}]',
'Éviction: produits laitiers, sucres raffinés, charcuterie. Privilégier: légumes colorés, poissons gras.',
'Isotrétinoïne: pas vitamine A haute dose'),

-- PERTE DE POIDS
(1, 'Accompagnement perte de poids', 'poids', 90,
'Approche métabolique: glycémie, thyroïde, drainage, stress. Sans régime restrictif.',
'- Relancer métabolisme\n- Équilibrer glycémie\n- Soutenir émonctoires',
'[{"phase":1,"nom":"Rééquilibrage glycémique","duree":"21 jours","actions":["IG bas chaque repas","Protéines petit-déj","Chrome si résistance insuline"]},{"phase":2,"nom":"Activation métabolique","duree":"45 jours","actions":["Drainage hépatique","Activité 30min/jour","Jeûne 16/8 si adapté"]},{"phase":3,"nom":"Stabilisation","duree":"24 jours","actions":["Alimentation équilibrée pérenne","Gestion stress","Pas de restriction"]}]',
'[{"nom":"Chrome","posologie":"200µg/jour","duree":"3 mois"},{"nom":"Thé vert extrait","posologie":"300-500mg EGCG matin","duree":"Phase 2"}]',
'Protéines chaque repas, légumes 50% assiette, bonnes graisses. Éviter sucres, alcool.',
'Thé vert éviter si troubles cardiaques, anxiété'),

-- REMINÉRALISATION
(1, 'Reminéralisation profonde', 'remineralisation', 60,
'Terrain déminéralisé: fatigue, cheveux/ongles fragiles, crampes, ostéopénie.',
'- Restaurer réserves minérales\n- Renforcer os, cheveux, ongles\n- Alcaliniser terrain',
'[{"phase":1,"nom":"Correction urgente","duree":"14 jours","actions":["Magnésium haute dose","Vitamine D","Silicium","Alimentation alcalinisante"]},{"phase":2,"nom":"Reminéralisation active","duree":"30 jours","actions":["Complexe minéraux mer/algues","Vitamine K2","Activité en charge"]},{"phase":3,"nom":"Entretien","duree":"16 jours+","actions":["Alimentation reminéralisante","Eau minérale adaptée","Cures saisonnières"]}]',
'[{"nom":"Magnésium bisglycinate","posologie":"400mg/jour","duree":"2 mois"},{"nom":"Vitamine D3 + K2","posologie":"2000UI D3 + 100µg K2","duree":"Octobre-avril"}]',
'Algues, oléagineux, légumes verts, sardines, légumineuses, cacao. Éviter sodas, excès café.',
'Vitamine K2 CI si anticoagulants AVK, Calcium éviter si hypercalcémie');


-- ============================================
-- FIN DE L'INSTALLATION
-- ============================================

SELECT 'Installation terminée avec succès!' AS message;
SELECT CONCAT(COUNT(*), ' tables créées') AS info FROM information_schema.tables WHERE table_schema = 'pertec_natu';
