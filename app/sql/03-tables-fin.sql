-- ============================================
-- PARTIE 3: TABLES RESTANTES
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
