-- ============================================
-- PHV App - Migrations v2.0
-- Nouvelles fonctionnalités : Agenda, Facturation, Statistiques, etc.
-- ============================================

USE pertec_natu;

-- ============================================
-- RENDEZ-VOUS / AGENDA
-- ============================================
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
    type_rdv ENUM('premiere_consultation', 'suivi', 'telephone', 'autre') DEFAULT 'premiere_consultation',
    statut ENUM('planifie', 'confirme', 'en_cours', 'termine', 'annule', 'no_show') DEFAULT 'planifie',
    lieu VARCHAR(255) DEFAULT 'Cabinet',
    tarif DECIMAL(10,2),
    notes TEXT,
    rappel_envoye BOOLEAN DEFAULT FALSE,
    rappel_date DATETIME,
    consultation_id INT,
    couleur VARCHAR(7) DEFAULT '#4a6741',
    recurrence ENUM('aucune', 'hebdomadaire', 'mensuel') DEFAULT 'aucune',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (client_id) REFERENCES clients(id) ON DELETE SET NULL,
    FOREIGN KEY (consultation_id) REFERENCES consultations(id) ON DELETE SET NULL,
    INDEX idx_date (user_id, date_rdv),
    INDEX idx_client (client_id)
) ENGINE=InnoDB;

-- ============================================
-- FACTURES
-- ============================================
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

-- ============================================
-- TARIFS / PRESTATIONS
-- ============================================
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

-- ============================================
-- MESURES / EVOLUTION CLIENT
-- ============================================
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
    niveau_stress INT CHECK (niveau_stress BETWEEN 0 AND 10),
    qualite_sommeil INT CHECK (qualite_sommeil BETWEEN 0 AND 10),
    niveau_energie INT CHECK (niveau_energie BETWEEN 0 AND 10),
    niveau_digestion INT CHECK (niveau_digestion BETWEEN 0 AND 10),
    notes TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (client_id) REFERENCES clients(id) ON DELETE CASCADE,
    FOREIGN KEY (consultation_id) REFERENCES consultations(id) ON DELETE SET NULL,
    INDEX idx_client_date (client_id, date_mesure)
) ENGINE=InnoDB;

-- ============================================
-- OBJECTIFS CLIENT
-- ============================================
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
    progression INT DEFAULT 0 CHECK (progression BETWEEN 0 AND 100),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (client_id) REFERENCES clients(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- ============================================
-- DOCUMENTS CLIENT (Photos, consentements, etc.)
-- ============================================
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

-- ============================================
-- TEMPLATES PHV
-- ============================================
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

-- ============================================
-- PROTOCOLES
-- ============================================
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

-- ============================================
-- CONTRE-INDICATIONS & ALERTES
-- ============================================
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

-- Conditions client (pour vérifier les contre-indications)
ALTER TABLE clients
ADD COLUMN IF NOT EXISTS allergies TEXT AFTER notes,
ADD COLUMN IF NOT EXISTS traitements_en_cours TEXT AFTER allergies,
ADD COLUMN IF NOT EXISTS antecedents_medicaux TEXT AFTER traitements_en_cours,
ADD COLUMN IF NOT EXISTS grossesse BOOLEAN DEFAULT FALSE AFTER antecedents_medicaux,
ADD COLUMN IF NOT EXISTS allaitement BOOLEAN DEFAULT FALSE AFTER grossesse;

-- ============================================
-- BILAN ALIMENTAIRE
-- ============================================
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
    humeur INT CHECK (humeur BETWEEN 1 AND 5),
    energie INT CHECK (energie BETWEEN 1 AND 5),
    digestion INT CHECK (digestion BETWEEN 1 AND 5),
    notes TEXT,
    FOREIGN KEY (bilan_id) REFERENCES bilans_alimentaires(id) ON DELETE CASCADE,
    INDEX idx_bilan_date (bilan_id, date_jour)
) ENGINE=InnoDB;

-- ============================================
-- QUESTIONNAIRES PRE-CONSULTATION
-- ============================================
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

-- ============================================
-- COMMUNICATIONS CLIENT
-- ============================================
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

-- ============================================
-- JOURNAL D'ACTIVITE (Logs)
-- ============================================
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

-- ============================================
-- PARAMETRES UTILISATEUR
-- ============================================
CREATE TABLE IF NOT EXISTS user_settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL UNIQUE,
    -- Identité cabinet
    nom_cabinet VARCHAR(255),
    logo_path VARCHAR(500),
    adresse_cabinet TEXT,
    telephone_cabinet VARCHAR(20),
    email_cabinet VARCHAR(255),
    site_web VARCHAR(255),
    -- Mentions légales facture
    siret VARCHAR(20),
    code_ape VARCHAR(10),
    numero_tva VARCHAR(30),
    mentions_facture TEXT,
    -- Préférences
    devise VARCHAR(3) DEFAULT 'EUR',
    format_date VARCHAR(20) DEFAULT 'd/m/Y',
    premiere_heure_agenda TIME DEFAULT '08:00:00',
    derniere_heure_agenda TIME DEFAULT '20:00:00',
    duree_rdv_defaut INT DEFAULT 60,
    rappel_rdv_heures INT DEFAULT 24,
    theme VARCHAR(20) DEFAULT 'light',
    -- RGPD
    rgpd_consentement_texte TEXT,
    rgpd_duree_conservation_ans INT DEFAULT 10,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- ============================================
-- RECETTES & MENUS
-- ============================================
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

-- ============================================
-- FICHES CONSEIL (imprimables)
-- ============================================
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
-- DONNEES INITIALES
-- ============================================

-- Prestations par défaut
INSERT INTO prestations (user_id, nom, description, duree_minutes, tarif) VALUES
(1, 'Première consultation', 'Bilan complet et PHV personnalisé', 90, 70.00),
(1, 'Consultation de suivi', 'Suivi et ajustements du PHV', 60, 50.00),
(1, 'Consultation téléphonique', 'Suivi rapide par téléphone', 30, 30.00),
(1, 'Bilan alimentaire', 'Analyse détaillée des habitudes alimentaires', 45, 40.00);

-- Contre-indications de base (plantes courantes)
INSERT INTO contre_indications (type_element, nom_element, condition_ci, description, niveau_gravite) VALUES
('plante', 'Millepertuis', 'Pilule contraceptive', 'Diminue l\'efficacité de la contraception', 'danger'),
('plante', 'Millepertuis', 'Antidépresseurs', 'Risque de syndrome sérotoninergique', 'danger'),
('plante', 'Ginkgo biloba', 'Anticoagulants', 'Augmente le risque de saignement', 'danger'),
('plante', 'Réglisse', 'Hypertension', 'Peut augmenter la tension artérielle', 'attention'),
('plante', 'Réglisse', 'Grossesse', 'Risque d\'accouchement prématuré', 'danger'),
('huile_essentielle', 'Menthe poivrée', 'Grossesse', 'Contre-indiquée pendant la grossesse', 'danger'),
('huile_essentielle', 'Menthe poivrée', 'Enfants < 6 ans', 'Risque de spasme laryngé', 'danger'),
('huile_essentielle', 'Sauge officinale', 'Epilepsie', 'Peut déclencher des crises', 'danger'),
('huile_essentielle', 'Sauge officinale', 'Grossesse', 'Abortive', 'danger'),
('huile_essentielle', 'Romarin CT camphre', 'Epilepsie', 'Neurotoxique', 'danger'),
('huile_essentielle', 'Romarin CT camphre', 'Grossesse', 'Contre-indiqué', 'danger'),
('complement', 'Fer', 'Hémochromatose', 'Surcharge en fer contre-indiquée', 'danger'),
('complement', 'Vitamine K', 'Anticoagulants AVK', 'Diminue l\'efficacité du traitement', 'danger'),
('complement', 'Potassium', 'Insuffisance rénale', 'Risque d\'hyperkaliémie', 'danger'),
('complement', 'Mélatonine', 'Grossesse', 'Déconseillé par prudence', 'attention'),
('complement', 'Mélatonine', 'Enfants', 'Avis médical nécessaire', 'attention');

-- Paramètres utilisateur par défaut
INSERT INTO user_settings (user_id, nom_cabinet, mentions_facture) VALUES
(1, 'Cabinet de Naturopathie', 'Naturopathe certifié - Non conventionné - Règlement à réception');
