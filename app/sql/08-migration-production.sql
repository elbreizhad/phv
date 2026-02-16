-- ============================================
-- PHV Naturo - Migration Production Complète
-- Ajoute protocoles, recettes, fiches pathologies
-- et les colonnes nécessaires au PHV
-- ============================================

-- ============================================
-- 1. MIGRATION TABLE PHV (colonnes ressources)
-- ============================================
-- Vérifier si les colonnes existent avant de les ajouter
SET @dbname = DATABASE();
SET @tablename = 'phv';
SET @columnname = 'protocoles_ids';
SET @preparedStatement = (SELECT IF(
  (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE
    TABLE_SCHEMA = @dbname AND TABLE_NAME = @tablename AND COLUMN_NAME = @columnname) > 0,
  'SELECT 1',
  'ALTER TABLE phv ADD COLUMN protocoles_ids JSON DEFAULT NULL'
));
PREPARE alterIfNotExists FROM @preparedStatement;
EXECUTE alterIfNotExists;
DEALLOCATE PREPARE alterIfNotExists;

SET @columnname = 'recettes_ids';
SET @preparedStatement = (SELECT IF(
  (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE
    TABLE_SCHEMA = @dbname AND TABLE_NAME = @tablename AND COLUMN_NAME = @columnname) > 0,
  'SELECT 1',
  'ALTER TABLE phv ADD COLUMN recettes_ids JSON DEFAULT NULL'
));
PREPARE alterIfNotExists FROM @preparedStatement;
EXECUTE alterIfNotExists;
DEALLOCATE PREPARE alterIfNotExists;

SET @columnname = 'pathologies_ids';
SET @preparedStatement = (SELECT IF(
  (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE
    TABLE_SCHEMA = @dbname AND TABLE_NAME = @tablename AND COLUMN_NAME = @columnname) > 0,
  'SELECT 1',
  'ALTER TABLE phv ADD COLUMN pathologies_ids JSON DEFAULT NULL'
));
PREPARE alterIfNotExists FROM @preparedStatement;
EXECUTE alterIfNotExists;
DEALLOCATE PREPARE alterIfNotExists;

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

-- ============================================
-- 5. DONNÉES PROTOCOLES (exemples)
-- ============================================
INSERT IGNORE INTO protocoles (id, user_id, nom, type_protocole, duree_jours, description, objectifs, phases, complements, alimentation, contre_indications) VALUES

(1, 1, 'Détox hépatique printanière', 'detox', 21,
'Cure de nettoyage hépatique saisonnière. Idéal au printemps ou après période d''excès.',
'Stimuler les fonctions hépatobiliaires, soutenir les phases I et II de détoxication, drainer les toxines, améliorer le teint et l''énergie',
'[{"nom":"Préparation intestinale","duree":"7 jours","actions":["Réduire alcool, café, sucres","Augmenter légumes verts","Hydratation 2L/jour","Tisane romarin matin"]},{"nom":"Drainage actif","duree":"10 jours","actions":["Artichaut + Radis noir","Bouillotte chaude sur foie","Jus citron tiède le matin"]},{"nom":"Régénération","duree":"4 jours","actions":["Chardon-Marie","Desmodium si besoin","Réintroduction progressive"]}]',
'[{"nom":"Artichaut + Radis noir","posologie":"1 ampoule avant repas midi","duree":"10 jours"},{"nom":"Chardon-Marie","posologie":"200-400mg 2x/jour","duree":"3 semaines"}]',
'Privilégier: légumes verts, crucifères, ail, curcuma, citron. Éviter: alcool, café, friture, charcuterie.',
'Grossesse, calculs biliaires, maladie hépatique grave'),

(2, 1, 'Confort digestif - SII', 'digestif', 56,
'Protocole complet pour syndrome de l''intestin irritable.',
'Réduire ballonnements et douleurs, régulariser transit, réparer perméabilité intestinale, rééquilibrer microbiote',
'[{"nom":"Éviction FODMAPs","duree":"21 jours","actions":["Régime pauvre en FODMAPs","Journal alimentaire","Tisane fenouil après repas","Cohérence cardiaque 3x/jour"]},{"nom":"Réparation muqueuse","duree":"21 jours","actions":["L-Glutamine 5g/jour","Aloe vera","Introduction probiotiques"]},{"nom":"Réensemencement","duree":"14 jours","actions":["Probiotiques haute dose","Réintroduction FODMAP progressive"]}]',
'[{"nom":"L-Glutamine","posologie":"5g poudre le matin à jeun","duree":"6-8 semaines"},{"nom":"Probiotiques","posologie":"20 milliards UFC/jour","duree":"3 mois"}]',
'Éviter: oignon, ail, blé, lactose, légumineuses. Privilégier: riz, quinoa, carottes cuites.',
'Prudence réglisse si HTA'),

(3, 1, 'Gestion stress chronique', 'stress', 90,
'Programme complet stress chronique et épuisement nerveux.',
'Restaurer capacité adaptation, soutenir surrénales, améliorer sommeil, retrouver énergie',
'[{"nom":"Phase urgence","duree":"21 jours","actions":["Magnésium 400mg/jour","Cohérence cardiaque 3x5min","Arrêt café","Coucher avant 22h30"]},{"nom":"Phase adaptogène","duree":"45 jours","actions":["Rhodiola ou Ashwagandha","Vitamines B","Marche nature quotidienne"]},{"nom":"Consolidation","duree":"24 jours","actions":["Diminution progressive compléments","Maintien hygiène de vie"]}]',
'[{"nom":"Magnésium bisglycinate","posologie":"300-400mg le soir","duree":"3 mois"},{"nom":"Rhodiola","posologie":"200-400mg matin","duree":"6-8 semaines"}]',
'Aliments riches en magnésium, tryptophane, oméga-3. Éviter excitants.',
'Rhodiola: troubles bipolaires. Ashwagandha: hyperthyroïdie'),

(4, 1, 'Sommeil réparateur', 'stress', 30,
'Protocole pour troubles du sommeil et insomnies.',
'Améliorer endormissement, qualité du sommeil, réduire réveils nocturnes',
'[{"nom":"Hygiène du sommeil","duree":"30 jours","actions":["Écrans off 1h avant coucher","Chambre 18°C, obscurité","Rituel relaxation","Tisane passiflore + mélisse"]}]',
'[{"nom":"Magnésium","posologie":"300mg au dîner","duree":"1 mois"},{"nom":"Mélatonine","posologie":"1mg 30min avant coucher si besoin","duree":"2 semaines max"}]',
'Dîner léger 3h avant coucher. Éviter alcool, sucres le soir.',
'Mélatonine: grossesse, maladies auto-immunes'),

(5, 1, 'Renforcement immunitaire hivernal', 'immunite', 60,
'Prévention des infections hivernales.',
'Renforcer défenses naturelles, prévenir infections ORL, réduire fréquence des rhumes',
'[{"nom":"Préparation","duree":"30 jours","actions":["Vitamine D 2000UI/jour","Zinc","Échinacée en cure"]},{"nom":"Maintien","duree":"30 jours","actions":["Probiotiques","Propolis si exposition","Hygiène de vie"]}]',
'[{"nom":"Vitamine D3","posologie":"2000-4000 UI/jour","duree":"Tout l''hiver"},{"nom":"Zinc","posologie":"15-30mg/jour","duree":"2 mois"}]',
'Ail, oignon, agrumes, kiwi, gingembre, curcuma.',
'Échinacée: maladies auto-immunes');

-- ============================================
-- 6. DONNÉES RECETTES (exemples)
-- ============================================
INSERT IGNORE INTO recettes (id, nom, categorie, temps_preparation, temps_cuisson, portions, ingredients, instructions, bienfaits, regimes, saison) VALUES

(1, 'Porridge anti-inflammatoire', 'petit_dejeuner', 10, 5, 1,
'- 40g flocons d''avoine\n- 200ml lait d''amande\n- 1 c.à.c curcuma\n- 1/2 c.à.c cannelle\n- 1 c.à.s graines de chia\n- Fruits rouges\n- Noix',
'1. Chauffer le lait avec les flocons\n2. Ajouter curcuma et cannelle\n3. Laisser gonfler 5 min\n4. Ajouter chia, fruits et noix',
'Anti-inflammatoire, riche en fibres et oméga-3',
'["Végétarien", "Sans lactose", "Anti-inflammatoire"]', 'Toute année'),

(2, 'Smoothie vert détox', 'boisson', 5, 0, 1,
'- 1 poignée épinards\n- 1/2 concombre\n- 1/2 pomme verte\n- Jus de 1/2 citron\n- 1 cm gingembre\n- 200ml eau de coco',
'1. Mixer tous les ingrédients\n2. Servir frais',
'Détoxifiant, alcalinisant, riche en chlorophylle',
'["Vegan", "Sans gluten", "Détox", "IG bas"]', 'Printemps-Été'),

(3, 'Buddha bowl quinoa légumes', 'plat', 20, 15, 2,
'- 150g quinoa\n- 1 patate douce\n- 1 avocat\n- 100g pois chiches\n- Légumes de saison\n- Sauce tahini citron',
'1. Cuire quinoa et patate douce\n2. Disposer tous les ingrédients\n3. Arroser de sauce tahini',
'Protéines complètes, fibres, bon équilibre nutritionnel',
'["Vegan", "Sans gluten", "IG bas"]', 'Toute année'),

(4, 'Soupe miso réconfortante', 'entree', 10, 10, 2,
'- 1L bouillon légumes\n- 2 c.à.s miso\n- 100g tofu soyeux\n- Algues wakame\n- Oignons verts',
'1. Chauffer le bouillon (ne pas bouillir)\n2. Dissoudre le miso\n3. Ajouter tofu et algues\n4. Garnir d''oignons verts',
'Probiotiques naturels, reminéralisant, digestif',
'["Vegan", "Sans gluten", "Digestive"]', 'Automne-Hiver'),

(5, 'Energy balls cacao', 'collation', 15, 0, 12,
'- 100g dattes Medjool\n- 50g amandes\n- 2 c.à.s cacao cru\n- 1 c.à.s huile coco\n- 1 pincée sel',
'1. Mixer dattes et amandes\n2. Ajouter cacao et huile\n3. Former des boules\n4. Réfrigérer 30 min',
'Énergie durable, magnésium, antioxydants',
'["Vegan", "Sans gluten", "IG bas"]', 'Toute année');

-- ============================================
-- 7. DONNÉES FICHES PATHOLOGIES (exemples)
-- ============================================
INSERT IGNORE INTO fiches_pathologies (id, nom, systeme, description, causes, signes_cliniques, aliments_eviter, aliments_privilegier, complements, phytotherapie, aromatherapie, hygiene_vie, notes) VALUES

(1, 'Syndrome de l''intestin irritable (SII)', 'Digestif',
'Trouble fonctionnel intestinal chronique associant douleurs abdominales et troubles du transit.',
'Dysbiose intestinale, hyperperméabilité, stress chronique, intolérances alimentaires (FODMAPs), infections passées.',
'Douleurs abdominales soulagées par défécation, ballonnements, alternance diarrhée/constipation, mucus dans les selles.',
'FODMAPs (oignon, ail, blé, lactose, légumineuses), aliments fermentescibles, alcool, café en excès, édulcorants',
'Riz, quinoa, carottes cuites, courgettes, viandes blanches, poissons, banane mûre, myrtilles',
'L-Glutamine 5g/jour, Probiotiques (L. plantarum), Enzymes digestives, Zinc',
'Mélisse, Fenouil, Menthe poivrée (en gélules gastrorésistantes), Camomille',
'HE Menthe poivrée (1 goutte sur comprimé neutre), HE Basilic tropical en massage abdominal',
'Mastication +++, manger au calme, cohérence cardiaque, gestion du stress, activité physique douce',
'Tenir un journal alimentaire. Régime FODMAP en phase d''éviction puis réintroduction.'),

(2, 'Stress chronique et épuisement', 'Nerveux',
'État de tension prolongée épuisant les réserves adaptatives de l''organisme.',
'Surcharge mentale, manque de récupération, alimentation déséquilibrée, sédentarité, dette de sommeil.',
'Fatigue persistante, troubles du sommeil, irritabilité, difficultés de concentration, tensions musculaires, infections fréquentes.',
'Café et excitants, sucres raffinés, alcool, aliments ultra-transformés',
'Aliments riches en magnésium (oléagineux, chocolat noir), tryptophane (banane, dinde), oméga-3 (petits poissons gras)',
'Magnésium bisglycinate 300-400mg/jour, Vitamines B complexe, Oméga-3 EPA/DHA',
'Rhodiola, Ashwagandha, Eleuthérocoque, Griffonia (5-HTP)',
'HE Lavande vraie (diffusion, oreiller), HE Petit grain bigarade, HE Marjolaine à coquilles',
'Cohérence cardiaque 3x5min/jour, coucher avant 22h30, marche en nature, limitation des écrans',
'Les adaptogènes ne sont pas des stimulants. Cure de 6-8 semaines minimum.'),

(3, 'Reflux gastro-œsophagien (RGO)', 'Digestif',
'Remontées acides de l''estomac vers l''œsophage causant brûlures et inconfort.',
'Hypochlorhydrie paradoxale, hernie hiatale, surpoids, stress, repas trop copieux, médicaments.',
'Brûlures rétrosternales, régurgitations acides, toux chronique, enrouement matinal.',
'Café, alcool, menthe, chocolat, tomates, agrumes, plats épicés, graisses cuites',
'Légumes cuits vapeur, protéines maigres, riz, pomme de terre, banane, amandes',
'Bicarbonate (ponctuellement), Aloe vera gel, Zinc-carnosine, Glutamine',
'Réglisse DGL, Guimauve, Mélisse, Camomille matricaire',
'HE Citron zeste (1 goutte dans miel après repas), HE Basilic tropical en massage',
'Ne pas s''allonger après manger (2h), surélever tête de lit, manger lentement, petits repas',
'Attention: RGO chronique nécessite suivi médical (risque œsophage de Barrett).'),

(4, 'Hypothyroïdie fonctionnelle', 'Endocrinien',
'Ralentissement de la fonction thyroïdienne avec TSH limite haute ou légèrement élevée.',
'Carence en iode, sélénium, zinc, fer. Stress chronique, perturbateurs endocriniens, inflammation.',
'Fatigue, frilosité, prise de poids, constipation, peau sèche, chute de cheveux, humeur dépressive.',
'Crucifères crus en excès, soja non fermenté, gluten (si Hashimoto), sucres raffinés',
'Algues (modérément), fruits de mer, noix du Brésil, œufs, poissons gras',
'Sélénium 100-200µg, Zinc 15mg, Fer (si carence), Vitamine D, Iode (prudence)',
'Ashwagandha (si pas Hashimoto), Guggul, Coleus forskohlii',
'Pas d''HE directement sur thyroïde. HE Épinette noire sur surrénales.',
'Éviter perturbateurs endocriniens (plastiques, cosmétiques), gérer le stress, activité physique régulière',
'Toujours faire un bilan complet: TSH, T3L, T4L, anticorps anti-TPO et anti-TG.'),

(5, 'Arthrose', 'Ostéo-articulaire',
'Dégénérescence du cartilage articulaire avec inflammation et douleur.',
'Vieillissement, surpoids, traumatismes, inflammation chronique, acidose tissulaire.',
'Douleurs articulaires mécaniques, raideur matinale, craquements, gonflement.',
'Viandes rouges, charcuterie, produits laitiers, sucres, aliments pro-inflammatoires, solanacées (tomate, aubergine, poivron)',
'Petits poissons gras (sardines, maquereaux), curcuma, gingembre, légumes verts, fruits rouges, huile d''olive',
'Oméga-3 EPA/DHA 2g/jour, Curcumine biodisponible, Glucosamine + Chondroïtine, Collagène type II, Silicium',
'Harpagophytum, Cassis (feuilles), Reine-des-prés, Saule blanc',
'HE Gaulthérie + Eucalyptus citronné (5% dans HV) en massage local',
'Activité physique adaptée (natation, vélo), maintien poids de forme, éviter port de charges',
'Cure de reminéralisation avec silicium et prêle peut aider.');
