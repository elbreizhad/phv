-- ============================================
-- PARTIE 2: TABLES AGENDA, FACTURES, etc.
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

CREATE TABLE IF NOT EXISTS facture_lignes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    facture_id INT NOT NULL,
    description VARCHAR(255) NOT NULL,
    quantite DECIMAL(10,2) DEFAULT 1,
    prix_unitaire DECIMAL(10,2) NOT NULL,
    montant DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (facture_id) REFERENCES factures(id) ON DELETE CASCADE
) ENGINE=InnoDB;

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
