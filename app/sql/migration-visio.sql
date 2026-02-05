-- ============================================
-- Migration: Ajout téléconsultation
-- ============================================

USE phv_app;

-- Ajout colonnes visio à rendez_vous
ALTER TABLE rendez_vous
ADD COLUMN IF NOT EXISTS visio_enabled BOOLEAN DEFAULT FALSE,
ADD COLUMN IF NOT EXISTS visio_room_id VARCHAR(100),
ADD COLUMN IF NOT EXISTS visio_token VARCHAR(100),
ADD COLUMN IF NOT EXISTS visio_password VARCHAR(20);

-- Mise à jour du type_rdv pour inclure visio
ALTER TABLE rendez_vous
MODIFY COLUMN type_rdv ENUM('premiere_consultation', 'suivi', 'telephone', 'visio', 'autre') DEFAULT 'premiere_consultation';
