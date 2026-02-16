-- ============================================
-- PHV Naturo - Migration Production Simple
-- Version compatible hébergement mutualisé
-- ============================================

-- ============================================
-- 1. COLONNES PHV (ignorer erreurs si existent)
-- ============================================
-- Exécuter ces ALTER un par un, ignorer l'erreur "Duplicate column name"
ALTER TABLE phv ADD COLUMN protocoles_ids JSON DEFAULT NULL;
ALTER TABLE phv ADD COLUMN recettes_ids JSON DEFAULT NULL;
ALTER TABLE phv ADD COLUMN pathologies_ids JSON DEFAULT NULL;

-- ============================================
-- 2. TABLE PROTOCOLES
-- ============================================
CREATE TABLE IF NOT EXISTS protocoles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    nom VARCHAR(200) NOT NULL,
    type_protocole ENUM('detox', 'digestif', 'stress', 'immunite', 'hormonal', 'peau', 'poids', 'remineralisation', 'autre') DEFAULT 'autre',
    duree_jours INT DEFAULT 21,
    description TEXT,
    objectifs TEXT,
    phases JSON,
    complements JSON,
    alimentation TEXT,
    contre_indications TEXT,
    actif BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================
-- 3. TABLE RECETTES
-- ============================================
CREATE TABLE IF NOT EXISTS recettes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(200) NOT NULL,
    categorie ENUM('petit_dejeuner', 'entree', 'plat', 'collation', 'boisson', 'dessert') DEFAULT 'plat',
    temps_preparation INT DEFAULT 15,
    temps_cuisson INT DEFAULT 0,
    portions INT DEFAULT 2,
    ingredients TEXT NOT NULL,
    instructions TEXT NOT NULL,
    bienfaits TEXT,
    regimes JSON,
    saison VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================
-- 4. TABLE FICHES PATHOLOGIES
-- ============================================
CREATE TABLE IF NOT EXISTS fiches_pathologies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(200) NOT NULL,
    systeme ENUM('Digestif', 'Nerveux', 'Immunitaire', 'Endocrinien', 'Ostéo-articulaire', 'Tégumentaire', 'Cardiovasculaire', 'Respiratoire', 'Urinaire', 'Autre') DEFAULT 'Autre',
    description TEXT,
    causes TEXT,
    signes_cliniques TEXT,
    aliments_eviter TEXT,
    aliments_privilegier TEXT,
    complements TEXT,
    phytotherapie TEXT,
    aromatherapie TEXT,
    hygiene_vie TEXT,
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
