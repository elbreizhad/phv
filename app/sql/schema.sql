-- PHV App - Schema de la base de données
-- Outil d'aide à la consultation en naturopathie

CREATE DATABASE IF NOT EXISTS phv_app CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE phv_app;

-- ============================================
-- UTILISATEURS (authentification praticien)
-- ============================================
CREATE TABLE users (
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

-- ============================================
-- CLIENTS
-- ============================================
CREATE TABLE clients (
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
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- ============================================
-- CONSULTATIONS
-- ============================================
CREATE TABLE consultations (
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

-- ============================================
-- REPONSES AU QUESTIONNAIRE
-- ============================================
CREATE TABLE consultation_reponses (
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

-- ============================================
-- SYNTHESE DE CONSULTATION
-- ============================================
CREATE TABLE consultation_synthese (
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

-- ============================================
-- PHV (Programme d'Hygiène de Vie)
-- ============================================
CREATE TABLE phv (
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
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (consultation_id) REFERENCES consultations(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- ============================================
-- FICHES PATHOLOGIES
-- ============================================
CREATE TABLE fiches_pathologies (
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

-- ============================================
-- UTILISATEUR PAR DEFAUT
-- ============================================
-- Mot de passe par défaut: naturo2026
INSERT INTO users (username, password_hash, nom, prenom, email) VALUES (
    'praticien',
    '$2y$10$YourHashWillBeGeneratedByPHP',
    'Praticien',
    'PHV',
    'praticien@phv.fr'
);
