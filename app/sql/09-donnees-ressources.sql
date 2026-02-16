-- ============================================
-- PHV Naturo - Données Ressources
-- Protocoles, Recettes, Fiches Pathologies
-- ============================================

-- ============================================
-- PROTOCOLES
-- ============================================
INSERT INTO protocoles (user_id, nom, type_protocole, duree_jours, description, objectifs, phases, complements, alimentation, contre_indications) VALUES

(1, 'Détox hépatique printanière', 'detox', 21,
'Cure de nettoyage hépatique saisonnière. Idéal au printemps ou après période d''excès.',
'Stimuler les fonctions hépatobiliaires, soutenir les phases I et II de détoxication, drainer les toxines, améliorer le teint et l''énergie',
'[{"nom":"Préparation intestinale","duree":"7 jours","actions":["Réduire alcool, café, sucres","Augmenter légumes verts","Hydratation 2L/jour","Tisane romarin matin"]},{"nom":"Drainage actif","duree":"10 jours","actions":["Artichaut + Radis noir","Bouillotte chaude sur foie","Jus citron tiède le matin"]},{"nom":"Régénération","duree":"4 jours","actions":["Chardon-Marie","Desmodium si besoin","Réintroduction progressive"]}]',
'[{"nom":"Artichaut + Radis noir","posologie":"1 ampoule avant repas midi","duree":"10 jours"},{"nom":"Chardon-Marie","posologie":"200-400mg 2x/jour","duree":"3 semaines"}]',
'Privilégier: légumes verts, crucifères, ail, curcuma, citron. Éviter: alcool, café, friture, charcuterie.',
'Grossesse, calculs biliaires, maladie hépatique grave'),

(1, 'Confort digestif - SII', 'digestif', 56,
'Protocole complet pour syndrome de l''intestin irritable.',
'Réduire ballonnements et douleurs, régulariser transit, réparer perméabilité intestinale, rééquilibrer microbiote',
'[{"nom":"Éviction FODMAPs","duree":"21 jours","actions":["Régime pauvre en FODMAPs","Journal alimentaire","Tisane fenouil après repas","Cohérence cardiaque 3x/jour"]},{"nom":"Réparation muqueuse","duree":"21 jours","actions":["L-Glutamine 5g/jour","Aloe vera","Introduction probiotiques"]},{"nom":"Réensemencement","duree":"14 jours","actions":["Probiotiques haute dose","Réintroduction FODMAP progressive"]}]',
'[{"nom":"L-Glutamine","posologie":"5g poudre le matin à jeun","duree":"6-8 semaines"},{"nom":"Probiotiques","posologie":"20 milliards UFC/jour","duree":"3 mois"}]',
'Éviter: oignon, ail, blé, lactose, légumineuses. Privilégier: riz, quinoa, carottes cuites.',
'Prudence réglisse si HTA'),

(1, 'Gestion stress chronique', 'stress', 90,
'Programme complet stress chronique et épuisement nerveux.',
'Restaurer capacité adaptation, soutenir surrénales, améliorer sommeil, retrouver énergie',
'[{"nom":"Phase urgence","duree":"21 jours","actions":["Magnésium 400mg/jour","Cohérence cardiaque 3x5min","Arrêt café","Coucher avant 22h30"]},{"nom":"Phase adaptogène","duree":"45 jours","actions":["Rhodiola ou Ashwagandha","Vitamines B","Marche nature quotidienne"]},{"nom":"Consolidation","duree":"24 jours","actions":["Diminution progressive compléments","Maintien hygiène de vie"]}]',
'[{"nom":"Magnésium bisglycinate","posologie":"300-400mg le soir","duree":"3 mois"},{"nom":"Rhodiola","posologie":"200-400mg matin","duree":"6-8 semaines"}]',
'Aliments riches en magnésium, tryptophane, oméga-3. Éviter excitants.',
'Rhodiola: troubles bipolaires. Ashwagandha: hyperthyroïdie'),

(1, 'Sommeil réparateur', 'stress', 30,
'Protocole pour troubles du sommeil et insomnies.',
'Améliorer endormissement, qualité du sommeil, réduire réveils nocturnes',
'[{"nom":"Hygiène du sommeil","duree":"30 jours","actions":["Écrans off 1h avant coucher","Chambre 18°C, obscurité","Rituel relaxation","Tisane passiflore + mélisse"]}]',
'[{"nom":"Magnésium","posologie":"300mg au dîner","duree":"1 mois"},{"nom":"Mélatonine","posologie":"1mg 30min avant coucher si besoin","duree":"2 semaines max"}]',
'Dîner léger 3h avant coucher. Éviter alcool, sucres le soir.',
'Mélatonine: grossesse, maladies auto-immunes'),

(1, 'Renforcement immunitaire hivernal', 'immunite', 60,
'Prévention des infections hivernales.',
'Renforcer défenses naturelles, prévenir infections ORL, réduire fréquence des rhumes',
'[{"nom":"Préparation","duree":"30 jours","actions":["Vitamine D 2000UI/jour","Zinc","Échinacée en cure"]},{"nom":"Maintien","duree":"30 jours","actions":["Probiotiques","Propolis si exposition","Hygiène de vie"]}]',
'[{"nom":"Vitamine D3","posologie":"2000-4000 UI/jour","duree":"Tout l''hiver"},{"nom":"Zinc","posologie":"15-30mg/jour","duree":"2 mois"}]',
'Ail, oignon, agrumes, kiwi, gingembre, curcuma.',
'Échinacée: maladies auto-immunes'),

(1, 'Équilibre hormonal féminin', 'hormonal', 90,
'Accompagnement des déséquilibres hormonaux féminins (SPM, cycles irréguliers).',
'Réguler le cycle, réduire SPM, équilibrer œstrogènes/progestérone',
'[{"nom":"Détox hépatique douce","duree":"21 jours","actions":["Soutien hépatique (métabolisme hormones)","Réduction perturbateurs endocriniens","DIM ou brocoli quotidien"]},{"nom":"Rééquilibrage","duree":"45 jours","actions":["Gattilier en continu","Onagre ou bourrache 2ème partie cycle","Magnésium"]},{"nom":"Stabilisation","duree":"24 jours","actions":["Maintien gattilier","Hygiène de vie","Gestion stress"]}]',
'[{"nom":"Gattilier","posologie":"400mg matin à jeun","duree":"3 cycles minimum"},{"nom":"Onagre","posologie":"1000mg J15 à J28","duree":"3 mois"},{"nom":"Magnésium","posologie":"300mg/jour","duree":"3 mois"}]',
'Graines de lin, légumes crucifères. Éviter xénoestrogènes (plastiques).',
'Grossesse, cancers hormonodépendants, endométriose sévère');

-- ============================================
-- RECETTES
-- ============================================
INSERT INTO recettes (nom, categorie, temps_preparation, temps_cuisson, portions, ingredients, instructions, bienfaits, regimes, saison) VALUES

('Porridge anti-inflammatoire curcuma', 'petit_dejeuner', 10, 5, 1,
'- 40g flocons d''avoine\n- 200ml lait d''amande\n- 1 c.à.c curcuma\n- 1/2 c.à.c cannelle\n- 1 c.à.s graines de chia\n- Fruits rouges\n- Noix, amandes',
'1. Chauffer le lait avec les flocons à feu doux\n2. Ajouter curcuma et cannelle\n3. Laisser gonfler 5 min hors feu\n4. Ajouter chia, fruits et oléagineux',
'Anti-inflammatoire, riche en fibres et oméga-3, satiétogène',
'["Végétarien", "Sans lactose", "Anti-inflammatoire"]', 'Toute année'),

('Smoothie vert détox', 'boisson', 5, 0, 1,
'- 1 poignée épinards frais\n- 1/2 concombre\n- 1/2 pomme verte\n- Jus de 1/2 citron\n- 1 cm gingembre frais\n- 200ml eau de coco',
'1. Laver les légumes\n2. Mixer tous les ingrédients\n3. Servir immédiatement',
'Détoxifiant, alcalinisant, riche en chlorophylle et antioxydants',
'["Vegan", "Sans gluten", "Détox", "IG bas"]', 'Printemps-Été'),

('Buddha bowl quinoa complet', 'plat', 20, 15, 2,
'- 150g quinoa\n- 1 patate douce\n- 1 avocat\n- 100g pois chiches\n- Légumes de saison\n- Sauce: tahini, citron, ail',
'1. Cuire quinoa selon paquet\n2. Rôtir patate douce en cubes\n3. Disposer tous les ingrédients en bol\n4. Arroser de sauce tahini-citron',
'Protéines végétales complètes, fibres, excellent équilibre nutritionnel',
'["Vegan", "Sans gluten", "IG bas"]', 'Toute année'),

('Soupe miso régénérante', 'entree', 10, 10, 2,
'- 1L bouillon légumes\n- 2 c.à.s miso non pasteurisé\n- 100g tofu soyeux\n- Algues wakame réhydratées\n- Oignons verts émincés',
'1. Chauffer le bouillon sans bouillir\n2. Retirer du feu, dissoudre le miso\n3. Ajouter tofu coupé et algues\n4. Garnir d''oignons verts',
'Probiotiques naturels, reminéralisant, soutien digestif',
'["Vegan", "Sans gluten", "Digestive"]', 'Automne-Hiver'),

('Energy balls cacao-dattes', 'collation', 15, 0, 12,
'- 100g dattes Medjool dénoyautées\n- 50g amandes\n- 2 c.à.s cacao cru\n- 1 c.à.s huile de coco\n- 1 pincée fleur de sel',
'1. Mixer dattes et amandes\n2. Ajouter cacao, huile et sel\n3. Former des boules (mains humides)\n4. Réfrigérer 30 min',
'Énergie durable, magnésium, antioxydants, sans sucre ajouté',
'["Vegan", "Sans gluten", "IG modéré"]', 'Toute année'),

('Golden milk (lait d''or)', 'boisson', 5, 5, 1,
'- 250ml lait végétal\n- 1 c.à.c curcuma\n- 1/2 c.à.c cannelle\n- 1 pincée poivre noir\n- 1 c.à.c huile de coco\n- Miel ou sirop d''érable',
'1. Chauffer le lait à feu doux\n2. Fouetter avec les épices\n3. Ajouter huile de coco\n4. Sucrer légèrement',
'Anti-inflammatoire puissant, réconfortant, aide au sommeil',
'["Vegan", "Sans gluten", "Anti-inflammatoire"]', 'Automne-Hiver'),

('Taboulé de chou-fleur', 'entree', 20, 0, 4,
'- 1/2 chou-fleur\n- 1 bouquet persil\n- 1 bouquet menthe\n- 2 tomates\n- 1 concombre\n- Jus de 2 citrons\n- Huile d''olive',
'1. Râper le chou-fleur (semoule)\n2. Hacher finement les herbes\n3. Couper tomates et concombre\n4. Mélanger avec citron et huile',
'Léger, riche en vitamine C, digestif, IG très bas',
'["Vegan", "Sans gluten", "IG bas", "Cru"]', 'Été'),

('Saumon en papillote et légumes', 'plat', 15, 20, 2,
'- 2 pavés de saumon\n- Courgettes, carottes\n- Citron, aneth\n- Huile d''olive\n- Sel, poivre',
'1. Préchauffer four 180°C\n2. Placer saumon et légumes sur papier sulfurisé\n3. Arroser citron et huile\n4. Fermer et cuire 20 min',
'Oméga-3, protéines, cuisson douce préservant les nutriments',
'["Sans gluten", "Sans lactose", "Anti-inflammatoire"]', 'Toute année');

-- ============================================
-- FICHES PATHOLOGIES
-- ============================================
INSERT INTO fiches_pathologies (nom, systeme, description, causes, signes_cliniques, aliments_eviter, aliments_privilegier, complements, phytotherapie, aromatherapie, hygiene_vie, notes) VALUES

('Syndrome de l''intestin irritable (SII)', 'Digestif',
'Trouble fonctionnel intestinal chronique associant douleurs abdominales et troubles du transit, sans lésion organique.',
'Dysbiose intestinale, hyperperméabilité, stress chronique, intolérances alimentaires (FODMAPs), infections passées, antibiotiques.',
'Douleurs abdominales soulagées par défécation, ballonnements, alternance diarrhée/constipation, mucus dans les selles, fatigue.',
'FODMAPs (oignon, ail, blé, lactose, légumineuses), aliments fermentescibles, alcool, café en excès, édulcorants de synthèse, graisses cuites',
'Riz, quinoa, carottes cuites, courgettes, viandes blanches, poissons, banane mûre, myrtilles, fenouil, gingembre',
'L-Glutamine 5g/jour à jeun, Probiotiques (L. plantarum 299v), Enzymes digestives, Zinc, Vitamine D',
'Mélisse (antispasmodique), Fenouil (carminatif), Menthe poivrée (gélules gastrorésistantes), Camomille matricaire',
'HE Menthe poivrée (1 goutte sur comprimé neutre après repas), HE Basilic tropical dilué en massage abdominal sens horaire',
'Mastication prolongée (30x par bouchée), manger au calme sans écran, cohérence cardiaque 3x/jour, activité physique douce régulière',
'Tenir un journal alimentaire. Régime FODMAP: éviction stricte 4-6 sem puis réintroduction méthodique.'),

('Stress chronique et épuisement', 'Nerveux',
'État de tension prolongée épuisant les réserves adaptatives de l''organisme, pouvant mener au burn-out.',
'Surcharge mentale, manque de récupération, alimentation déséquilibrée, sédentarité, dette de sommeil chronique, perfectionnisme.',
'Fatigue persistante non soulagée par repos, troubles du sommeil, irritabilité, difficultés de concentration, tensions musculaires, infections répétées.',
'Café et excitants en excès, sucres raffinés, alcool, aliments ultra-transformés, repas sautés',
'Aliments riches en magnésium (oléagineux, chocolat noir 70%), tryptophane (banane, dinde, œufs), oméga-3 (sardines, maquereaux), légumes verts',
'Magnésium bisglycinate 300-400mg/jour, Vitamines B complexe, Oméga-3 EPA/DHA 1-2g/jour, Vitamine C',
'Rhodiola rosea (adaptogène stimulant), Ashwagandha (adaptogène calmant), Eleuthérocoque, Griffonia (5-HTP pour humeur)',
'HE Lavande vraie (diffusion, sur oreiller), HE Petit grain bigarade (plexus solaire), HE Marjolaine (tensions)',
'Cohérence cardiaque 3x5min/jour, coucher avant 22h30, marche en nature 30min/jour, limitation écrans le soir, dire non',
'Les adaptogènes demandent 6-8 semaines pour effet optimal. Ne pas cumuler stimulants.'),

('Reflux gastro-œsophagien (RGO)', 'Digestif',
'Remontées acides de l''estomac vers l''œsophage causant brûlures et inconfort. Souvent lié paradoxalement à une hypochlorhydrie.',
'Hypochlorhydrie (manque d''acidité), hernie hiatale, surpoids abdominal, stress, repas trop copieux ou trop rapides, certains médicaments.',
'Brûlures rétrosternales (pyrosis), régurgitations acides, toux chronique, enrouement matinal, sensation de boule dans la gorge.',
'Café, thé fort, alcool, menthe, chocolat, tomates et agrumes, plats épicés, graisses cuites, repas copieux',
'Légumes cuits vapeur douce, protéines maigres bien mastiquées, riz, pomme de terre, banane, amandes (alcalinisantes), fenouil',
'Bicarbonate de sodium (ponctuel), Aloe vera gel buvable, Zinc-carnosine 75mg 2x/jour, L-Glutamine',
'Réglisse DGL (déglycyrrhizinée), Guimauve racine, Mélisse, Camomille matricaire, Gingembre (modéré)',
'HE Citron zeste (1 goutte dans miel après repas), HE Basilic tropical dilué en massage épigastrique',
'Ne pas s''allonger 2-3h après manger, surélever tête de lit 15cm, manger lentement, petits repas fréquents, vêtements non serrés',
'RGO chronique nécessite suivi médical (risque œsophage de Barrett). Tester vinaigre de cidre dilué pour hypochlorhydrie.'),

('Hypothyroïdie fonctionnelle', 'Endocrinien',
'Ralentissement de la fonction thyroïdienne avec TSH limite haute ou légèrement élevée, sans maladie auto-immune avérée.',
'Carence en iode, sélénium, zinc, fer ou tyrosine. Stress chronique (cortisol élevé), perturbateurs endocriniens, inflammation chronique.',
'Fatigue persistante, frilosité, prise de poids inexpliquée, constipation, peau sèche, chute de cheveux, humeur dépressive, cycles irréguliers.',
'Crucifères crus en grande quantité (goitrogènes), soja non fermenté, gluten (si Hashimoto), sucres raffinés, produits ultra-transformés',
'Algues (modérément pour iode), fruits de mer, noix du Brésil (2-3/jour pour sélénium), œufs, poissons gras, avocat',
'Sélénium 100-200µg/jour, Zinc 15-30mg, Fer (si ferritine basse), Vitamine D 2000-4000UI, L-tyrosine (précurseur)',
'Ashwagandha (attention si Hashimoto), Guggul, Coleus forskohlii, Fucus (si carence iode confirmée)',
'Pas d''HE directement sur la thyroïde. HE Épinette noire sur les surrénales (synergie), HE Menthe poivrée (énergie)',
'Éviter perturbateurs endocriniens (plastiques, parabènes), gérer le stress chronique, activité physique régulière, sommeil suffisant',
'Bilan complet indispensable: TSH, T3L, T4L, anticorps anti-TPO et anti-TG. Hashimoto = approche différente.'),

('Arthrose', 'Ostéo-articulaire',
'Dégénérescence progressive du cartilage articulaire avec inflammation locale, douleur et raideur.',
'Vieillissement articulaire, surpoids, traumatismes répétés, inflammation chronique de bas grade, acidose tissulaire, facteurs génétiques.',
'Douleurs articulaires mécaniques (aggravées à l''effort), raideur matinale de courte durée, craquements articulaires, gonflement épisodique.',
'Viandes rouges, charcuterie, produits laitiers de vache, sucres raffinés, aliments pro-inflammatoires, solanacées (tomate, aubergine, poivron pour certains)',
'Petits poissons gras (sardines, maquereaux), curcuma + poivre, gingembre frais, légumes verts, fruits rouges, huile d''olive vierge',
'Oméga-3 EPA/DHA 2g/jour, Curcumine biodisponible 500mg, Glucosamine 1500mg + Chondroïtine 1200mg, Collagène type II, Silicium organique',
'Harpagophytum (anti-inflammatoire), Cassis (feuilles - cortison-like), Reine-des-prés, Saule blanc, Prêle (reminéralisant)',
'HE Gaulthérie couchée + HE Eucalyptus citronné (5% dans huile végétale) en massage local, HE Romarin camphré',
'Activité physique adaptée (natation, vélo, marche), maintien du poids de forme, éviter port de charges lourdes, chaleur locale',
'Cure de reminéralisation (silicium, prêle, ortie) utile. Penser à la vitamine D et au magnésium.'),

('Candidose digestive', 'Digestif',
'Prolifération excessive de Candida albicans dans le tube digestif, perturbant la flore et la muqueuse.',
'Antibiothérapies répétées, alimentation riche en sucres, stress chronique, immunodépression, pilule contraceptive, IPP au long cours.',
'Ballonnements, gaz, envies de sucre irrépressibles, fatigue post-prandiale, langue chargée blanche, mycoses récidivantes, brouillard mental.',
'Sucres sous toutes formes, alcool, levures (pain, bière), champignons, produits laitiers, fruits sucrés au début, vinaigre sauf cidre',
'Légumes verts, protéines maigres, ail et oignon (antifongiques), huile de coco, citron, graines germées, kéfir de fruits (après phase 1)',
'Probiotiques (Saccharomyces boulardii), Acide caprylique, Extrait de pépin de pamplemousse, Berbérine, Zinc',
'Lapacho (Pau d''Arco), Origan (en cure courte), Cannelle de Ceylan, Ail (allicine)',
'HE Tea tree (1 goutte sur comprimé neutre), HE Origan compact (avec précaution, cure courte), HE Cannelle écorce',
'Régime anti-candida 4-8 semaines, gestion du stress, éviter antibiotiques si possible, hygiène intestinale',
'Die-off possible en début de protocole (fatigue, maux de tête). Aller progressivement. Durée: 3-6 mois.'),

('Syndrome prémenstruel (SPM)', 'Endocrinien',
'Ensemble de symptômes physiques et émotionnels survenant en phase lutéale du cycle (7-10 jours avant les règles).',
'Déséquilibre œstrogènes/progestérone, carences en magnésium et B6, stress chronique, sensibilité aux fluctuations hormonales.',
'Irritabilité, humeur dépressive, tension mammaire, rétention d''eau, ballonnements, envies de sucre, fatigue, troubles du sommeil.',
'Sel en excès, sucres raffinés, caféine, alcool, produits laitiers pour certaines, graisses trans',
'Légumes verts feuillus, graines de lin fraîchement moulues, crucifères, poissons gras, banane, chocolat noir 70%',
'Magnésium bisglycinate 300mg/jour, Vitamine B6 50-100mg, Oméga-3, Zinc, Vitamine E',
'Gattilier (Vitex) 400mg/jour matin, Onagre ou Bourrache en 2ème partie de cycle, Mélisse, Achillée millefeuille',
'HE Sauge sclarée (massage bas-ventre J14-J28), HE Géranium rosat (équilibrant), HE Ylang-ylang (émotionnel)',
'Activité physique régulière, réduction du stress, sommeil suffisant, limiter exposition perturbateurs endocriniens',
'Gattilier: effet optimal après 3 cycles. Éviter si antécédent cancer hormonodépendant.'),

('Insomnie et troubles du sommeil', 'Nerveux',
'Difficultés d''endormissement, réveils nocturnes fréquents ou réveil précoce avec impossibilité de se rendormir.',
'Stress et anxiété, mauvaise hygiène du sommeil, écrans le soir, caféine, carences (magnésium, mélatonine), douleurs chroniques.',
'Difficultés d''endormissement >30min, réveils multiples, sommeil non réparateur, fatigue diurne, irritabilité, troubles de concentration.',
'Caféine après 14h, alcool (perturbe cycles), repas copieux le soir, sucres rapides, écrans 2h avant coucher, activité physique intense le soir',
'Aliments riches en tryptophane (dinde, banane, amandes), magnésium (chocolat noir, oléagineux), glucides complexes au dîner modérés',
'Magnésium bisglycinate 300mg au dîner, L-Tryptophane 500mg ou 5-HTP 100mg, Mélatonine 1mg (court terme), GABA',
'Passiflore (anxiété), Valériane (endormissement), Mélisse (ruminations), Escholtzia (réveils), Aubépine (palpitations)',
'HE Lavande vraie (sur oreiller, diffusion), HE Petit grain bigarade (plexus), HE Camomille romaine (apaisement profond)',
'Chambre 16-18°C, obscurité totale, régularité horaires, rituel relaxation, pas d''écran 1h avant, cohérence cardiaque',
'Mélatonine: pas plus de 2-4 semaines. Rechercher causes sous-jacentes (apnées, jambes sans repos, dépression).');
