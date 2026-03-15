-- Migration: Ajouter les nouvelles colonnes PHV pour le système contextuel
-- Version: 11
-- Date: 2026-03-15

-- Nouvelles sections du PHV
ALTER TABLE phv
ADD COLUMN IF NOT EXISTS phytologie TEXT DEFAULT NULL AFTER recommandations_complementaires,
ADD COLUMN IF NOT EXISTS aromatherapie TEXT DEFAULT NULL AFTER phytologie,
ADD COLUMN IF NOT EXISTS gemmotherapie TEXT DEFAULT NULL AFTER aromatherapie,
ADD COLUMN IF NOT EXISTS programme_detox TEXT DEFAULT NULL AFTER gemmotherapie,
ADD COLUMN IF NOT EXISTS hydrologie TEXT DEFAULT NULL AFTER programme_detox,
ADD COLUMN IF NOT EXISTS complements_texte TEXT DEFAULT NULL AFTER hydrologie,
ADD COLUMN IF NOT EXISTS examens_bio TEXT DEFAULT NULL AFTER complements_texte;

-- Note: Si ADD COLUMN IF NOT EXISTS n'est pas supporté (MySQL < 8.0.16),
-- utiliser les commandes suivantes une par une et ignorer les erreurs de colonnes existantes:
--
-- ALTER TABLE phv ADD COLUMN phytologie TEXT DEFAULT NULL;
-- ALTER TABLE phv ADD COLUMN aromatherapie TEXT DEFAULT NULL;
-- ALTER TABLE phv ADD COLUMN gemmotherapie TEXT DEFAULT NULL;
-- ALTER TABLE phv ADD COLUMN programme_detox TEXT DEFAULT NULL;
-- ALTER TABLE phv ADD COLUMN hydrologie TEXT DEFAULT NULL;
-- ALTER TABLE phv ADD COLUMN complements_texte TEXT DEFAULT NULL;
-- ALTER TABLE phv ADD COLUMN examens_bio TEXT DEFAULT NULL;
