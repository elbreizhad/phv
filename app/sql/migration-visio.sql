-- ============================================
-- Migration: Ajout téléconsultation
-- ============================================

USE pertec_natu;

-- Ajout colonnes visio à rendez_vous
ALTER TABLE rendez_vous
ADD COLUMN visio_enabled BOOLEAN DEFAULT FALSE,
ADD COLUMN visio_room_id VARCHAR(100),
ADD COLUMN visio_token VARCHAR(100),
ADD COLUMN visio_password VARCHAR(20);

-- Mise à jour du type_rdv pour inclure visio
ALTER TABLE rendez_vous
MODIFY COLUMN type_rdv ENUM('premiere_consultation', 'suivi', 'telephone', 'visio', 'autre') DEFAULT 'premiere_consultation';
