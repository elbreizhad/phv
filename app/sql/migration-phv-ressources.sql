-- Migration pour ajouter les ressources sélectionnées au PHV

ALTER TABLE phv
ADD COLUMN protocoles_ids JSON DEFAULT NULL,
ADD COLUMN recettes_ids JSON DEFAULT NULL,
ADD COLUMN pathologies_ids JSON DEFAULT NULL;
