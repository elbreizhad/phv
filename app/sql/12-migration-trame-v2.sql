-- ============================================
-- MIGRATION : Trame V2 (parallèle à V1)
-- ============================================
-- Ajoute le choix de version de trame au niveau utilisateur
-- et la version utilisée par consultation.

ALTER TABLE consultations
    ADD COLUMN trame_version ENUM('v1', 'v2') NOT NULL DEFAULT 'v1' AFTER type_seance;

ALTER TABLE user_settings
    ADD COLUMN trame_v2_enabled BOOLEAN NOT NULL DEFAULT FALSE AFTER theme;
