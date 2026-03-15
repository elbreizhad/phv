-- Migration: Ajouter la colonne examens_bio au PHV

ALTER TABLE phv
ADD COLUMN examens_bio TEXT DEFAULT NULL AFTER recommandations_complementaires;

-- Pour mettre a jour les installations existantes avec le script install.sql,
-- ajouter cette colonne manuellement ou re-executer cette migration
