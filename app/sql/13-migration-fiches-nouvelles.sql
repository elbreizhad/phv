-- ============================================
-- PHV Naturo - Nouvelles Fiches Pathologies & Santé
-- Intégrées depuis les fiches visuelles naturo 2026
-- ============================================

-- ============================================
-- SYSTÈME DIGESTIF (nouvelles)
-- ============================================

INSERT INTO fiches_pathologies (nom, systeme, description, causes, signes_cliniques, aliments_eviter, aliments_privilegier, complements, phytotherapie, aromatherapie, notes) VALUES

('SIBO (Small Intestinal Bacterial Overgrowth)', 'Digestif',
'Prolifération anormale de bactéries dans l''intestin grêle, qui est normalement un lieu de digestion et d''absorption, NON de fermentation. Il existe aussi l''IMO (Intestinal Methanogen Overgrowth) : prolifération d''archées productrices de méthane.',
'- Digestion affaiblie : déficits enzymatiques, hypochlorhydrie, insuffisance biliaire, atrophie muqueuse, IPP, FUT2 non sécréteur\n- Troubles de la motricité : hypothyroïdie, dysfonction axe intestin-cerveau, lésions nerveuses\n- Troubles immunitaires : déficit IgA, Lyme, mycotoxines\n- Troubles mécaniques : adhérences, endométriose, diverticules',
'Digestifs : ballonnements, gaz (éructations, borborygmes), distension abdominale, douleurs, troubles du transit (diarrhée ou constipation), brûlures d''estomac avec/sans RGO.\nExtra-digestifs : fatigue chronique, carences (fer, calcium, B12, vitamines liposolubles), troubles de la peau (acné, eczéma), douleurs articulaires, troubles psychologiques (stress, anxiété), brain fog.',
'Glucides fermentescibles (FODMAPs), amidons résistants, sucres fermentescibles (fructose, lactose, polyols), fruits post-repas',
'Alimentation pauvre en glucides fermentescibles, repas bien mastiqués et mangés tranquillement, ne pas grignoter entre les repas (stimule le MMC)',
'- Enzymes digestives spécifiques (gélules non gastrorésistantes HPMC pour mélange dès l''estomac)\n- L-Glutamine (réparation muqueuse)\n- Zinc, vitamines liposolubles (A, D, E, K) si malabsorption\n- Probiotiques en phase de long terme uniquement',
'Court terme substances bactéricides :\n- Contre méthane : allicine, origan, neem\n- Contre hydrogène : berbérine, origan, neem\nProkinétiques digestifs (moyen terme) :\n- Carvi, fenouil, gingembre pour stimuler le nettoyage intestinal (MMC)',
'- HE Origan (antibactérien large spectre)\n- HE Thym à thymol (puissant antimicrobien)\n- HE Cannelle (antibactérien)\n- Utiliser en gélules gastrorésistantes pour action intestinale',
'Diagnostic par test respiratoire au lactulose ou glucose (mesure des gaz expirés H2 et CH4 toutes les 20 min pendant 180 min). Seuils : H2 > 20 ppm, CH4 > 12 ppm dans les 120 premières minutes. 3 phases : court terme 1-3 mois (symptomatique), moyen terme 3-6 mois (préventif/prokinétiques), long terme >6 mois (traitement causaliste). Ne jamais commencer par les probiotiques. Chaque prise en charge doit être unique et personnalisée.'),

('Hernie hiatale', 'Digestif',
'Passage d''une partie de l''estomac à travers le hiatus du diaphragme dans le thorax. Cause fréquente de RGO. 3 types : Type 1 par glissement (la plus fréquente - jonction œsogastrique remonte), Type 2 par roulement (fundus remonte), Type 3 mixte.',
'- Cause exacte souvent inconnue\n- Obésité = facteur favorisant majeur (pression abdominale augmentée)\n- Âge (relâchement des tissus liés au vieillissement de l''organisme ou terrain déminéralisé)\n- Grossesses multiples\n- Efforts physiques intenses répétés',
'- Brûlures d''estomac (pyrosis)\n- RGO (conséquence fréquente)\n- Régurgitations acides ou goût amer dans la bouche\n- Symptômes aggravés après les repas, en position allongée ou en se penchant\n- Dysphagie possible\n- Hoquet, nausées, toux chronique',
'Café, alcool, tabac, chocolat, épices fortes, aliments gras, repas copieux le soir, boissons gazeuses, agrumes en excès',
'Repas légers et fréquents (fractionnés), légumes cuits, riz, pomme de terre, banane, pomme cuite, poisson vapeur, viandes maigres, amandes (alcalinisantes), aliments riches en minéraux (algues, légumes verts)',
'- Argile verte en eau (apaise l''acidité)\n- Aloe vera gel buvable (protège la muqueuse)\n- Lithothamne (tamponne l''acidité)\n- DGL (réglisse déglycyrrhizinée - protège muqueuse sans effet tenseur)',
'- Réglisse DGL (protège la muqueuse gastrique)\n- Guimauve (émolliente, protège)\n- Plantain (répare la muqueuse)\n- Fenugrec (si RGO associé)',
'- HE Citron zeste (1 goutte dans le miel : digestif léger)\n- HE Cardamome (digestion, ballonnements)\n- ÉVITER HE Menthe poivrée (relâche le sphincter œsophagien)',
'Objectif naturopathique : corriger les erreurs d''hygiène de vie, soutenir la digestion et la fonction gastrique, limiter les facteurs favorisant le RGO, réduire la pression abdominale (perte de poids si surpoids), gérer le stress. Consulter un médecin en cas de douleurs intenses/persistantes, difficultés à avaler, perte de poids inexpliquée, vomissements sanglants.'),

('Lithiase biliaire', 'Digestif',
'Formation de calculs (cristaux de cholestérol calcifié) dans la vésicule biliaire. Souvent silencieuse, mais peut entraîner des complications sérieuses (colique hépatique, pancréatite) en cas de migration dans les voies biliaires.',
'- Variation de la composition chimique de la bile (excès cholestérol, manque de sels biliaires)\n- Diabète\n- Obésité\n- Âge avancé\n- Grossesses multiples\n- Prédispositions génétiques\n- Régime riche en graisses saturées',
'- Souvent asymptomatique (découverte fortuite)\n- Colique hépatique : douleur intense sous le foie irradiant vers l''épaule droite\n- Nausées, vomissements\n- Selles grasses (stéatorrhée) si obstruction du canal biliaire\n- Jaunisse possible si obstruction totale',
'Aliments très gras (fritures, viandes grasses, charcuteries, fromages gras), repas copieux, alcool, aliments ultra-transformés, sucres rapides en excès',
'Alimentation légère, graisses de qualité (huile d''olive, poissons gras), fibres (légumes, fruits), artichaut, betterave (soutient le foie)',
'- Taurine et L-glycine (optimisent la qualité de la bile)\n- Vitamine B3 (niacine)\n- Fer si carence\n- Lécithine de soja (émulsifie le cholestérol biliaire)',
'ATTENTION ⚠️ : NE JAMAIS prescrire de plantes hépatiques/cholérétiques en cas de calculs présents (risque de migration dans les voies biliaires et pancréatite aiguë). Si ablation de la vésicule biliaire : soutenir la digestion des graisses avec enzymes et acides biliaires.',
'- Huiles essentielles hépatiques à éviter si calculs présents\n- Post-ablation vésicule : HE Citron (léger drainage hépatique en usage externe uniquement)',
'Questions clés en consultation : Y a-t-il des calculs biliaires dans la famille ? Avez-vous encore votre vésicule biliaire ? Quel est votre taux de cholestérol ? Vos selles sont-elles grasses ? Bilan recommandé : acides biliaires, carence en fer, manque de L-glycine ou taurine, dysbiose, malabsorption vitamines ADEK, carence B3.'),

('Pancréatite aiguë', 'Digestif',
'Inflammation aiguë du pancréas avec œdème et/ou nécrose des cellules pancréatiques. URGENCE MÉDICO-CHIRURGICALE fréquente. La naturopathie n''intervient PAS en phase aiguë.',
'- Alcoolisme (cause principale)\n- Migration de calculs biliaires dans les voies biliaires (2e cause)\n- Alimentation trop riche en graisses\n- Tabagisme\n- Hypertriglycéridémie\n- Certains médicaments\n- Prédispositions génétiques',
'- Douleur violente, brutale dans la moitié supérieure de l''abdomen\n- Irradiation dans le dos possible\n- Nausées, vomissements\n- Fièvre possible\n- Taux anormalement élevé d''enzymes pancréatiques dans le sang (lipase, amylase)',
'Alcool (absolument), aliments très gras, repas copieux, fritures',
'Post-crise uniquement : alimentation douce et pauvre en graisses, légumes cuits, céréales complètes, protéines maigres',
'Aucun en phase aiguë (urgence médicale). Post-crise : soutien enzymatique digestif sous supervision médicale.',
'Aucune en phase aiguë. Post-crise uniquement et sous supervision.',
'Aucune en phase aiguë.',
'URGENCE MÉDICALE : hospitalisation, arrêt de l''alimentation (mise au repos du pancréas), réhydratation par perfusion, antalgiques puissants, antibiotiques si infection, ablation de la vésicule biliaire si calculs. LA NATUROPATHIE NE PEUT ACCOMPAGNER QUE LA PRÉVENTION des récidives. Prévention : limiter/arrêter l''alcool, alimentation équilibrée et pauvre en graisses, limiter le tabac, hydratation suffisante, surveillance des troubles biliaires.'),

('Mycose/Candidose buccale', 'Digestif',
'Prolifération anormale de Candida albicans dans la bouche et/ou le tube digestif, créant une dysbiose. Souvent révélatrice d''un terrain acidifié et/ou d''une immunodépression. Peut être associée à des mycoses vaginales, unguéales ou cutanées.',
'- Antibiothérapies répétées (déséquilibre de la flore)\n- Alimentation riche en sucres et acidifiante\n- Pilule contraceptive\n- Acidose du terrain (pH bas)\n- Immunodéficience (souvent chez personnes âgées)\n- Stress chronique\n- Corticothérapie\n- Diabète',
'- Langue blanche, coating épais\n- Douleurs ou brûlures dans la bouche\n- Goût altéré, mauvaise haleine\n- Envies de sucre irrépressibles\n- Troubles digestifs associés (ballonnements, candidose digestive)\n- Fatigue chronique\n- Mycoses vaginales ou cutanées récidivantes\n- Brain fog',
'Aliments acidifiants + aliments riches en sucre rapide + aliments fermentés + champignons + fromages à moisissures + pomme de terre + pain blanc (favorisent Candida)',
'Aliments alcalinisants + antifongiques naturels : ail cru, noix de coco et huile de coco, Lapacho (pau d''arco), légumes verts crus, tisanes drainantes, graines germées',
'- Probiotiques spécifiques : Pileje Lactibiane Buccodental, Lactibiane H-Py\n- Vitamine D et Zinc (immuno-modulation)\n- Vitamine C\n- Oligo-éléments (cuivre-or-argent antifongiques)\n- Extrait de pépins de pamplemousse',
'- Ail (antifongique puissant - allicine)\n- Lapacho/Pau d''arco (antifongique naturel)\n- Propolis (protectrice, antifongique)',
'- Bains de bouche à l''huile de coco (oil pulling)\n- Hydrolat de tea tree (antibactérien/antifongique)\n- Hydrolat de laurier noble (antiseptique buccal)',
'Questions clés : Avez-vous pris des antibiotiques récemment ? Quel est votre rapport au sucre ? Êtes-vous sous pilule contraceptive ? Souffrez-vous de mycoses vaginales/unguéales ? Technique d''analyse de la langue (lampe de Wood possible). Rechercher signes d''acidification : arthrose, calculs rénaux, eczéma sec, psoriasis. Demander si amalgames dentaires. Gratte-langue quotidien. Un terrain acidifié favorise le développement de la candidose.'),

('Gingivite', 'Digestif',
'Inflammation des gencives liée à un déséquilibre du microbiote buccal. Peut évoluer vers une parodontite chronique augmentant le risque de maladies systémiques (cardiovasculaires, MICI, diabète, Alzheimer).',
'- Mauvaise hygiène bucco-dentaire\n- Prise de certains traitements (antidépresseurs, anti-épileptiques)\n- Modifications hormonales (grossesse notamment avec la progestérone)\n- Carences (vitamine C - souvent liée au tabagisme)\n- Tabagisme\n- Stress chronique\n- Dysbiose buccale',
'- Gencives rouges, gonflées, saignant au brossage\n- Mauvaise haleine (halitose)\n- Sensibilité des dents\n- Douleurs lors de la mastication',
'Sucres raffinés, tabac, alcool, alimentation ultra-transformée, excès de café',
'Aliments fermentés (fibres prébiotiques), oméga-3, fruits et légumes riches en vitamine C, aliments riches en antioxydants',
'- Vitamine C (soutien des gencives, anti-inflammatoire)\n- Zinc (cicatrisation, immuno-modulation)\n- CoQ10 (santé des gencives)\n- Probiotiques (rééquilibrage flore buccale)',
'- Tea tree (antibactérien)\n- Clou de girofle (antalgique, antiseptique)\n- Sauge (purifiante)\n- Thym (antiseptique)\n- Propolis (protectrice)',
'Nettoyage brosse à dents avec HE tea tree. Bains de bouche à l''hydrolat de sauge ou de thym. Dentifrice à base de propolis (ex: RoyalDent).',
'Objectif : limiter l''accumulation de plaque dentaire pour prévenir la parodontite. Brossage 3 min minimum, fil dentaire quotidien, détartrage 2x/an, changer brosse tous les 3 mois. En naturopathie : action sur le terrain (modulation de l''inflammation). Si tabagisme : accompagnement à l''arrêt. Les bactéries buccales peuvent passer dans le sang et atteindre les organes (lien scientifique prouvé avec maladies cardiovasculaires, MICI, cancers).'),

('Microbiote buccal et santé globale', 'Digestif',
'Votre bouche abrite des milliards de micro-organismes (bactéries, levures, champignons). S''il est déséquilibré, le microbiote buccal peut impacter tout le corps via le passage des bactéries dans le sang.',
'- Mauvaise hygiène bucco-dentaire\n- Excès de sucres, tabac, alcool\n- Inflammation chronique\n- Antibiotiques (amoxicilline, azithromycine...)\n- Stress, fatigue, manque de sommeil',
'Maladies liées à une dysbiose buccale : maladies cardiovasculaires (AVC, infarctus), MICI (Crohn, rectocolite), polyarthrite rhumatoïde, diabète, cancers (bouche, côlon, pancréas, foie, œsophage), Alzheimer et maladies neurodégénératives.',
'Sucres raffinés, tabac, alcool, aliments ultra-transformés',
'Aliments fermentés (riches en probiotiques), fibres prébiotiques, oméga-3, fruits et légumes bio',
'- Probiotiques oraux (rééquilibrage flore buccale)\n- Vitamine C (soutien gencives)\n- Zinc (antimicrobien)\n- CoQ10 (santé parodontale)',
'- Tea tree (antibactérien)\n- Clou de girofle (antalgique, antibactérien)\n- Sauge (purifiante)\n- Thym (antiseptique)\n- Propolis (protectrice)',
'- Oil pulling (bain de bouche à l''huile) : 1 c. à s. d''huile de coco/sésame, faire circuler doucement 10-15 min, recracher. Réduit plaque, gingivites, caries.\n- Hydrolat de sauge ou de thym pour bains de bouche naturels',
'Liens scientifiques prouvés : les bactéries buccales peuvent passer dans le sang. Excès de P. gingivalis et F. nucleatum impliqué dans nombreuses maladies. La parodontite chronique augmente le risque de maladies systémiques. Éviter la chlorhexidine en usage prolongé. Privilégier implants biocompatibles. Éviter amalgames au mercure.'),

-- ============================================
-- SYSTÈME NERVEUX / PSYCHO-ÉMOTIONNEL (nouvelles)
-- ============================================

('Burn-out (épuisement psychique et physique)', 'Nerveux/Psycho-émotionnel',
'Épuisement psychique et physique total quand l''organisme arrive à rupture. Cortisol, dopamine et sérotonine s''effondrent. Inflammation et carences s''installent. Ce n''est PAS un échec : c''est un signal biologique clair.',
'- Stress chronique non résolu sur une longue période\n- Surcharge professionnelle et/ou personnelle\n- Hyperactivité, perfectionnisme, difficulté à déléguer\n- Manque de récupération et de sommeil\n- Exposition à des environnements toxiques (professionnels, relationnels)',
'- Fatigue extrême et permanente (ne cédant pas au repos)\n- Anxiété généralisée, attaques de panique\n- Troubles du sommeil majeurs (insomnie ou hypersomnie)\n- Troubles digestifs importants\n- Perte de confiance en soi, repli sur soi\n- Dépression réactionnelle\n- Douleurs physiques (maux de tête, douleurs musculaires)',
'Excitants (café, thé fort, sucre, sodas) pour masquer la fatigue - risque de rechute. Alimentation industrielle, ultra-transformée. Alcool en compensation. Repas sautés ou mangés debout/devant l''écran.',
'Alimentation simple, régulière et digeste : repas doux, cuits, faciles à digérer. Correction des carences (magnésium, protéines, micronutriments). Soutenir l''immunité : fruits, légumes colorés, plantes douces, épices douces. Dîner léger, tôt et apaisant pour favoriser le sommeil.',
'- Magnésium bisglycinate (anti-stress, relaxation musculaire et nerveuse)\n- Complexe vitamines B (énergie cellulaire, neurotransmetteurs)\n- Vitamine C (soutien surrénales)\n- Oméga-3 (inflammation, humeur)\n- Ashwagandha (adaptogène - reconstruction progressive)',
'- Plantes adaptogènes douces (ne pas stimuler mais reconstruire) : Ashwagandha, Rhodiola (progressive)\n- Mélisse, Passiflore (nervines réparatrices)\n- Valériane (si insomnie)\n- Griffonia (si dépression légère avec déficit sérotonine)',
'- HE Lavande vraie (relaxante, réparatrice)\n- HE Orange douce (apaisante, équilibrante)\n- HE Petit grain bigarade (système nerveux)\n- En diffusion le soir ou en massage plexus solaire dilué',
'Erreurs fréquentes : vouloir aller mieux trop vite (la récupération a besoin de temps), utiliser excitants ou sucre pour masquer la fatigue (épuise encore plus), reprendre un rythme trop intense (risque de rechute). Évolution : le sommeil s''améliore en premier, l''anxiété diminue progressivement, l''énergie revient par vagues, la digestion se stabilise, la confiance se reconstruit lentement. Accompagnement psychologique recommandé en parallèle.'),

('Stress - Physiologie (les 3 phases)', 'Nerveux/Psycho-émotionnel',
'Le stress suit 3 phases physiologiques distinctes décrites par Hans Selye. Comprendre ces mécanismes est essentiel pour adapter l''accompagnement naturopathique.',
'- Perception d''un stresseur physique ou psychologique\n- Activation du système nerveux autonome sympathique\n- Puis activation de l''axe hypothalamo-hypophyso-surrénalien (HHS)\n- Stress chronique non résolu menant à l''épuisement des systèmes de compensation',
'Phase 1 - Alarme (réaction immédiate) : libération rapide de catécholamines (adrénaline, noradrénaline) par la médullosurrénale. Tachycardie, vasoconstriction périphérique, dilatation bronches, hyperglycémie, augmentation de la vigilance.\nPhase 2 - Résistance (adaptation prolongée) : axe HHS activé. Hypothalamus sécrète CRH, hypophyse libère ACTH, corticosurrénale sécrète cortisol. Objectif : maintenir l''homéostasie.\nPhase 3 - Épuisement (dérégulation) : hypercortisolémie chronique, inflammation, résistance à l''insuline, perturbations thyroïdiennes, immunosuppression, troubles du sommeil et de l''humeur, risque burn-out, troubles cardio-métaboliques.',
'Excitants (café, alcool, sodas, sucres rapides) qui aggravent la dérégulation de l''axe cortisol',
'Aliments riches en magnésium, tryptophane, vitamines B, oméga-3 pour soutenir le système nerveux',
'- Magnésium (anti-stress de fond, déficit accru par cortisol)\n- Ashwagandha (régule l''axe HHS)\n- Rhodiola (adaptogène, phase de résistance)\n- Vitamines B (métabolisme énergétique, neurotransmetteurs)',
'- Phase alarme : Passiflore, Valériane (calmantes)\n- Phase résistance : Plantes adaptogènes (Ginseng, Rhodiola, Éleuthérocoque)\n- Phase épuisement : Ashwagandha, Mélisse (reconstruction)',
'- HE Lavande vraie (system parasympathique)\n- HE Petit grain bigarade (régulation neuro-végétative)\n- HE Marjolaine à coquilles (para-sympathicotonique)',
'Pour mieux gérer son stress : bouger régulièrement, respirer profondément (cohérence cardiaque), bien dormir (priorité absolue), manger équilibré, s''exprimer/tenir un journal, s''entourer, prendre du temps pour soi. L''organisme perd sa capacité d''adaptation en phase 3 : risque de pathologies chroniques.'),

('Alimentation anti-stress', 'Nerveux/Psycho-émotionnel',
'Une alimentation équilibrée aide à réguler le stress, stabiliser l''humeur et soutenir l''énergie au quotidien. Nourrir le corps pour apaiser le mental.',
'Déficits nutritionnels aggravant le stress :\n- Carence magnésium (le stress en consomme et y rend encore plus sensible)\n- Déficit en oméga-3 (inflammation neuro-endocrinienne)\n- Insuffisance en tryptophane (précurseur sérotonine/mélatonine)\n- Carences en vitamines B (neurotransmission)\n- Déficit zinc (régulation humeur/immunité)',
'- Anxiété, irritabilité, nervosité\n- Fatigue mentale et physique\n- Troubles du sommeil\n- Difficultés de concentration\n- Baisse de moral',
'Excitants (café, thé noir, alcool, tabac, sodas), sucres rapides et aliments ultra-transformés (perturbent la glycémie et aggravent le stress oxydatif), plats industriels pauvres en micronutriments',
'Magnésium : amande, noix de cajou, épinards, avocat, cacao, noix de cajou, légumineuses, graines de courge.\nOméga-3 : saumon, maquereau, sardines, graines de lin, chia, noix.\nTryptophane : dinde, œufs, banane, avoine, tofu, graines de sésame, chocolat noir.\nVitamines B : céréales complètes, légumineuses, œufs, levure de bière, légumes verts.\nVitamine C : agrumes, kiwi, fruits rouges, poivron cru, persil, chou, brocoli.\nZinc : huîtres, graines de courge, pois chiches, cajou, œufs, cacao.',
'- Magnésium bisglycinate (mieux assimilé)\n- Oméga-3 EPA/DHA (bon ratio)\n- Rhodiola rosea (adaptogène)\n- Ashwagandha (réduit cortisol)\n- Complexe vitamines B\n- Vitamine D (humeur, immunité)\n- L-Théanine (thé vert : détente mentale sans somnolence)',
'Plantes sédatives et adaptogènes :\n- Aubépine (cardiovasculaire, éréthisme)\n- Eschscholtzia (anxiolytique, sédative)\n- Mélisse (antispasmodique, digestive)\n- Lavande (relaxante)\n- Passiflore (anxiolytique)\n- Rhodiole, éleuthérocoque, griffonia (adaptogènes et neurotransmetteurs)',
'- YlangYlang (équilibrant émotionnel)\n- Lavande vraie (relaxante)\n- Basilic exotique (antispasmodique)\n- Estragon (anxiolytique)\n- Petit grain bigarade (nerveux végétatif)\n- Mandarine, Orange douce (apaisantes)',
'Les bons réflexes alimentaires : privilégier les aliments bruts, non transformés et colorés. Stabiliser la glycémie avec des repas réguliers (fibres, protéines, bonnes graisses). Bien s''hydrater (eau, tisanes camomille, verveine, mélisse). Limiter excitants. Manger en pleine conscience.'),

('Stratégie phytologie - Anxiété et troubles de l''adaptation', 'Nerveux/Psycho-émotionnel',
'Approche phytologique pour la prise en charge des troubles anxieux et du stress. Les plantes sont choisies selon la polarité du stress (extériorisé vs intériorisé) et les manifestations somatiques associées.',
'Troubles anxieux généralisés, troubles de l''adaptation, stress chronique, anxiété fonctionnelle',
'Stress extériorisé : agitation, hyperactivité, manifestations psychosomatiques (palpitations, crampes, spasmophilie, nervosité +++). Stress intériorisé : signes psychiques prédominants (tensions intérieures, ruminations anxieuses, somatisations neuro-musculaires, cervicalgies). Progression : trouble de l''adaptation normale → trouble de l''adaptation → fatigue/anxiété/insomnie → dépression/épuisement.',
'Alcool, cannabis (aggrave l''anxiété à long terme), excitants, sucres rapides',
'Magnésium, tryptophane (précurseur sérotonine), oméga-3, vitamines B',
'- Safran Saf''Inside (30 mg/jour : adaptogène cognitif et émotionnel)\n- Griffonia (5-HTP : précurseur sérotonine)\n- Magnésium bisglycinate\n- Complexe vitamines B',
'Algorithme de décision :\nStress extériorisé → PASSIFLORE (plante maîtresse, polyvalente) :\n  → Si S. fonctionnels cardiovasculaires → + Aubépine (palpitations, éréthisme cardiaque)\n  → Si S. fonctionnels digestifs → + Mélisse (nausées, spasmes intestinaux)\n  → Si S. fonctionnels neuro-musculaires → + Valériane (crampes, courbatures)\nStress intériorisé → VALÉRIANE (anxiolytique, hypnotique) :\n  → Si agitations/endormissement difficile/engourdissement → + Griffonia\n  → Si angoisses/phobies/troubles du sommeil → + Eschscholtzia\nAutres plantes clés :\n- Houblon (sédatif, hypnotique léger, ménopause)\n- Mucuna (antidépresseur, déficit dopamine)\n- Rhodiola (adaptogène, antidépresseur)\n- Réglisse (anti-inflammatoire, corticotrope)\n- Millepertuis (antidépresseur, dépression légère anxieuse)\n- Ginseng (renforcement cognitif, asthénie psychique)\n- Gentiane (antidépresseur dépression légère)',
'Association possible de 3 plantes si troubles mixtes.\nComplément ANXIORegul (exemple) : Sorenzo, Griffonia, Rhodiola, Passiflore, Acide ptéroylglutamique, Safran, Nicotinamide, B6.',
'Déconseillé femmes enceintes et allaitantes, personnes traitées antidépresseurs, enfants -15 ans. Programme 2 mois, à renouveler si nécessaire. Millepertuis : interactions médicamenteuses nombreuses (anticoagulants, contraceptifs oraux, chimiothérapie). Safran contre-indiqué si grossesse.'),

('Cohérence cardiaque', 'Nerveux/Cardiovasculaire',
'Technique de respiration simple et scientifiquement validée permettant de réduire le stress, améliorer la concentration et réguler les émotions. En respirant lentement et régulièrement, le cœur, la respiration et le cerveau se synchronisent (activation du système nerveux parasympathique).',
'- Stress chronique\n- Anxiété et troubles émotionnels\n- Hypertension légère\n- Difficultés de concentration\n- Troubles du sommeil',
'- Stress et anxiété élevés\n- Manque de concentration\n- Sommeil difficile\n- Dérégulation émotionnelle\n- Fatigue mentale',
'Aucun aliment spécifique à éviter',
'Alimentation équilibrée anti-stress (magnésium, oméga-3)',
'Aucun complément spécifique - la pratique suffit',
'- Peut être combinée avec des plantes adaptogènes\n- Efficace seule en pratique quotidienne',
'- HE Lavande en diffusion pendant la pratique\n- HE Camomille romaine (calme profond)',
'LA PRATIQUE : 365 - Inspirez 5 secondes par le nez (remplir les poumons, gonfler légèrement le ventre). Expirez 5 secondes par la bouche (vider l''air doucement, relâcher le ventre et les tensions). Répétez pendant 5 minutes. 3 fois par jour (matin, milieu de journée, soir). Cette harmonie active le système nerveux parasympathique qui apaise le corps et l''esprit et favorise un état de calme et d''équilibre durable. Bienfaits : réduit stress et anxiété, améliore la concentration, favorise un meilleur sommeil, renforce le système immunitaire, apporte calme, énergie et bien-être. À utiliser : le matin pour démarrer la journée, au travail pour améliorer la concentration, en cas de stress pour retrouver calme et sérénité, le soir pour favoriser un sommeil réparateur.'),

('Prévention maladies neurodégénératives', 'Nerveux/Psycho-émotionnel',
'Protocole de prévention des troubles neurodégénératifs : Alzheimer et autres démences, Parkinson, SLA. Objectif : protéger le cerveau, préserver les fonctions cognitives et motrices, favoriser une meilleure qualité de vie.',
'- Inflammation chronique de bas grade\n- Stress oxydatif cérébral\n- Déséquilibre de la flore intestinale (axe intestin-cerveau)\n- Déficits en micronutriments (oméga-3, vitamines B, D)\n- Sédentarité\n- Isolement social\n- Mauvaise qualité du sommeil\n- Hypertension, diabète, obésité',
'Troubles cognitifs progressifs (mémoire, concentration, langage, orientation), troubles moteurs (rigidité, tremblements), troubles du comportement et de l''humeur',
'Sucres raffinés, sel en excès, graisses saturées et aliments ultra-transformés, tabac, alcool en excès',
'Régime méditerranéen : fruits, légumes colorés, céréales complètes, légumineuses, poissons gras (sardines, maquereau, saumon), huile d''olive. Antioxydants : vitamines C et E, polyphénols (curcuma, baies, thé vert), caroténoïdes. Oméga-3 (lin, chia, noix, poissons gras). Limiter sucres raffinés, sel, graisses saturées.',
'- Vitamines B (B6, B9, B12) : homocystéine et neuroprotection\n- Vitamine D : protection neuronale\n- Magnésium, zinc, sélénium, fer\n- Oméga-3 EPA/DHA (plasticité neuronale)\n- CoQ10 (énergie mitochondriale)\n- Curcumine (anti-inflammatoire cérébral)',
'- Ginkgo biloba (circulation cérébrale, mémoire)\n- Bacopa monnieri (cognition)\n- Ashwagandha (neuroprotecteur)\n- Lion''s mane / Crinière de lion (BDNF - facteur neurotrophique)',
'- HE Romarin à cinéole (stimulant cognitif, mémoire)\n- HE Citron (clarté mentale)\n- HE Lavande (protection neuronale, sommeil réparateur)\n- Diffusion 20-30 min/jour',
'7 axes de prévention : 1) Alimentation neuroprotectrice. 2) Activité physique régulière (150 min/semaine d''activité modérée, renforcement musculaire 2x/sem). 3) Stimulation cognitive et sociale (lire, apprendre, jeux de réflexion, maintenir liens sociaux). 4) Gestion du stress et sommeil de qualité (7-8h/nuit, méditation, respiration). 5) Équilibre des micronutriments. 6) Éviter les facteurs de risque (tabac, alcool, sédentarité, hypertension, diabète). 7) Suivi et dépistage précoce. Bilans réguliers, surveillance des facteurs de risque, dépistage précoce des troubles cognitifs ou moteurs.'),

-- ============================================
-- MICRONUTRIMENTS (nouvelles)
-- ============================================

('Carence en Magnésium', 'Micronutriments',
'Le magnésium est indispensable à plus de 300 réactions enzymatiques dans le corps. Il soutient le système nerveux, l''énergie, les muscles, le cœur, le sommeil et l''équilibre émotionnel. Appelé le "minéral anti-stress". Un manque peut créer un cercle vicieux : le stress épuise les réserves de magnésium, et le manque de magnésium rend encore plus sensible au stress.',
'- Stress chronique (consomme le magnésium)\n- Activité physique intense (pertes sudorales)\n- Sols appauvris, eau traitée\n- Excès de sucre et d''aliments ultra-transformés\n- Caféine et alcool en excès\n- Excès de calcium (compétition d''absorption)',
'Fatigue, irritabilité, nervosité, stress, anxiété, déprime, troubles du sommeil et insomnies, crampes et tremblements musculaires, palpitations et rythme irrégulier, difficultés de concentration et mémoire, perte de cheveux et ongles cassants, faiblesse musculaire, perte de poids musculaire.',
'Sucre raffiné, café et caféine, alcool, aliments ultra-transformés, excès de calcium (bloque l''absorption)',
'Graines de courge (530mg/100g), graines de lin (390mg), graines de tournesol (325mg), amandes (270mg), noix du Brésil (225-370mg).\nCacao non sucré (410-500mg), chocolat noir ≥70% (200-250mg).\nLégumes verts : épinards (75-80mg), blettes (80mg), brocoli (20mg), chou kale (33mg), artichaut (50mg).\nSarrasin (230mg), quinoa (64mg), céréales complètes (100-150mg).\nHerbes séchées : coriandre (690mg), basilic séché (420mg), menthe séchée (600mg), agar séché (770mg).\nKéfir, sel marin gris non iodé, eaux riches en magnésium (Rozana 160mg/L, Hépar 119mg/L).',
'Formes bien assimilées :\n- Bisglycinate de magnésium (priorité : très bien absorbé, pas de diarrhée)\n- Malate de magnésium (énergie)\n- Citrate de magnésium (transit)\n- Glycérophosphate de magnésium\nBesoins quotidiens : Hommes 380-420 mg/jour, Femmes 300-360 mg/jour.\nBesoins augmentés : stress, sport, grossesse/allaitement, fatigue chronique, âge avancé.',
'Les plantes elles-mêmes ne compensent pas la carence, mais certaines soutiennent l''assimilation et réduisent les pertes.',
'Aucune aromathérapie spécifique pour la carence',
'Petits gestes pour booster : faire tremper graines, noix, légumineuses quelques heures (réduit anti-nutriments acide phytique). Privilégier aliments bio. Laver fruits et légumes avant consommation. Contre-indications et précautions : à éviter sans avis médical en cas d''insuffisance rénale, de certaines maladies cardiaques ou de prise de certains médicaments. Un excès de compléments peut provoquer diarrhées, troubles digestifs, nausées, hypotension.'),

('Carence en Vitamine D', 'Micronutriments',
'La vitamine du soleil. Indispensable à la santé, elle est en carence chez environ 80% des Français. Elle n''est pas seulement pour les os : elle joue un rôle essentiel dans l''immunité, l''humeur, les muscles et le système nerveux.',
'- Manque d''exposition au soleil (principale cause)\n- Alimentation pauvre en vitamine D\n- Peau foncée (moins de synthèse UV)\n- Âge (synthèse cutanée diminuée)\n- Surpoids (séquestration dans les graisses)\n- Troubles digestifs (malabsorption)\n- Problèmes hépatiques ou rénaux\n- Vie sédentaire, stress',
'Fatigue et baisse de moral, faiblesse musculaire, douleurs osseuses et articulaires, infections fréquentes (immuno-suppression), carences très fréquentes (≈ 80% des Français).',
'Alcool et tabac (interfèrent avec le métabolisme)',
'Poissons gras : saumon, sardine, maquereau, thon, hareng. Autres sources : huître, œuf, champignons, cresson, avocat, gruyère, edam, mûre.',
'- Vitamine D3 (cholécalciférol - mieux assimilée que D2)\n- Dose : 800 à 2 000 UI/jour en moyenne (selon bilan sanguin)\n- Associer impérativement à : vitamine K2 (répartition calcium), magnésium (activation de la D), vitamine A, zinc, fer\n- FAIRE DOSER son taux sanguin avant supplémentation\n- Consommer avec corps gras (liposoluble)',
'Aucune plante ne remplace la vitamine D, mais certaines soutiennent l''immunité en synergie',
'Aucune aromathérapie spécifique',
'ATTENTION AU SURDOSAGE : un excès prolongé peut entraîner une accumulation de calcium dans le sang (hypercalcémie) : fatigue, troubles digestifs, atteintes rénales. La juste dose fait toute la différence - bilan sanguin recommandé. S''exposer au soleil 10 à 20 min/jour (bras et visage) sans écran solaire quand possible. À consommer avec des corps gras pour une meilleure assimilation.'),

('Carences en vitamines - Signes et reconnaître', 'Micronutriments',
'Guide de reconnaissance des principales carences en vitamines selon les signes cliniques visibles. Chaque vitamine a ses signes spécifiques permettant d''orienter l''investigation et la supplémentation.',
'- Alimentation déséquilibrée et/ou appauvrie en micronutriments\n- Malabsorption intestinale (SIBO, Crohn, cœliaque)\n- Stress chronique (consomme vitamines B et C)\n- Médicaments (IPP, pilule, antibiotiques appauvrissent en certaines vitamines)\n- Âge avancé\n- Végétalisme (risque B12)',
'Vitamine A : mauvaise vision nocturne, peau sèche, affaiblissement immunitaire.\nVitamine B2 : fissures aux extrémités de la bouche (chéilite angulaire), mal de gorge, inflammation de la peau.\nVitamine B6 : fatigue, irritabilité, sautes d''humeur, inflammation cutanée.\nVitamine B9 (folate) : anémie, fatigue, baisse de la concentration.\nVitamine B12 : fatigue, faiblesse, picotements, perte de sensation des extrémités.\nVitamine C : système immunitaire faible, cicatrisation lente, saignement des gencives.\nVitamine D : douleurs osseuses, faiblesse musculaire, sautes d''humeur, infections fréquentes.\nVitamine E : faiblesse musculaire, problèmes de vision, affaiblissement immunitaire.\nVitamine K : saignements excessifs, ecchymoses fréquentes, affaiblissement osseux.',
'Alcool, tabac, sucres raffinés, aliments ultra-transformés, café en excès (appauvrissent en vitamines B)',
'Alimentation variée, colorée et de saison. Priorité aux aliments crus ou peu cuits (préserver vitamines). Légumes verts (B9, B2, C, K), poissons gras (D, B12), viandes maigres (B12, B6), agrumes et baies (C), oléagineux (E, B6), produits laitiers (B2, D), légumineuses (B9, B6), céréales complètes (B1, B6, E).',
'- Complexe vitamines B complet (B1, B2, B3, B5, B6, B9, B12)\n- Vitamine C naturelle (acérola, baies de cassis)\n- Vitamine D3 + K2\n- Vitamine E naturelle\n- Vitamine A (bêta-carotène de préférence, moins toxique)',
'Aucune phytothérapie spécifique',
'Aucune aromathérapie spécifique',
'Une alimentation équilibrée et variée est essentielle pour prévenir les carences et rester en bonne santé. Bilan biologique recommandé avant toute supplémentation (25-OH vitamine D, B12, B9, ferritine, zinc). Ne jamais supplémenter en vitamine A (rétinol) à fortes doses sans bilan (toxique à l''excès).'),

-- ============================================
-- SYSTÈME LYMPHATIQUE / DÉTOX (nouvelles)
-- ============================================

('Drainage lymphatique et système lymphatique', 'Lymphatique',
'La lymphe est le grand réseau de nettoyage du corps. Elle élimine les toxines, soutient l''immunité et prévient les gonflements. Système de vaisseaux, ganglions et organes filtrants transportant la lymphe (liquide riche en globules blancs) éliminant déchets, toxines et excès de liquides.',
'- Sédentarité (la lymphe n''a pas de pompe, elle est propulsée par le mouvement)\n- Alimentation pro-inflammatoire (sel, sucre, alcool, mauvaises graisses)\n- Stress chronique (contracte les vaisseaux lymphatiques)\n- Vêtements serrés\n- Chaleur excessive\n- Déshydratation',
'Signaux d''alerte : jambes lourdes, rétention d''eau (œdèmes), fatigue chronique, peau terne et tacheuse, infections fréquentes, gonflements (œdèmes généralisés).',
'Sel en excès, sucre, alcool, mauvaises graisses, aliments ultra-transformés (encrassent la lymphe)',
'Alimentation anti-inflammatoire et alcalinisante : fruits et légumes frais, fibres (légumes verts, céréales complètes), oméga-3 (lin, chia, noix, poissons gras), herbes et épices drainantes.',
'Tisanes drainantes :\n- Pissenlit (détox foie et lymphe)\n- Reine des prés (anti-rétention)\n- Orthosiphon (draine et purifie)\n- Bouleau (détox et reminéralise)\n- Queue de cerise (diurétique)',
'Plantes alliées :\n- Fucus (draine)\n- Piloselle (diurétique)\n- Châtaignier (tonique veineux)\n- Frêne (détoxifiant)\n- Marronnier d''Inde (décongestiomme)\n- Sève de bouleau (drainante, à prendre en cure de printemps)',
'- Massage lymphatique maison avec : macérat de calendula + HE de cyprès + HE de citron\n- HE Cyprès (drainage veineux et lymphatique)\n- HE Citron (tonique lymphatique)\n- Mouvements doux et légers du bas vers le haut (des chevilles vers les cuisses, des mains vers les aisselles, du cou vers les clavicules)',
'Comment stimuler la lymphe : bouger chaque jour (marche, yoga, rebond sur trampoline), respirer profondément, boire suffisamment (30-35 ml/kg de poids), brossage à sec avant la douche, massages doux et drainage lymphatique manuel, douche froide/chaude alternée. Éviter sédentarité et chaleur excessive. Dormir suffisamment. Limiter vêtements serrés. CONTRE-INDICATIONS : contre-indiqué en cas d''infection aiguë, de cancer non traité, de thrombose ou de maladies graves. Demandez toujours conseil à un professionnel de santé en cas de doute.'),

-- ============================================
-- MÉTABOLISME / PRÉVENTION (nouvelles)
-- ============================================

('Équilibre acido-basique', 'Métabolisme',
'Notre corps maintient un pH sanguin stable (entre 7,35 et 7,45) grâce à des mécanismes naturels (poumons, reins, systèmes tampons). L''alimentation, le stress, le manque de sommeil ou la sédentarité peuvent créer trop d''acidité dans les tissus (acidose métabolique latente) qui surcharge les organes d''élimination.',
'- Alimentation trop acidifiante (produits animaux, céréales raffinées, sucres)\n- Stress chronique (produit des acides)\n- Sédentarité (accumulation acides lactiques)\n- Manque de sommeil\n- Déshydratation\n- Déficit en fruits et légumes alcalinisants',
'Fatigue chronique, baisse des défenses immunitaires, douleurs et inflammations chroniques, troubles digestifs, prise de poids et rétention d''eau, fragilisation des os et des articulations, troubles de l''humeur et du sommeil, risques cardiovasculaires augmentés, terrain favorable aux maladies chroniques. Le pH urinaire est un miroir du terrain : pH < 6 = tendance acide, pH > 7 = tendance alcaline.',
'Produits animaux (viandes rouges, charcuteries, fromages gras, poissons d''élevage), produits laitiers (fromages, lait de vache, yaourts sucrés), céréales raffinées (pain blanc, pâtes blanches, riz blanc, viennoiseries), sucres et aliments sucrés (sucre blanc, pâtisseries, biscuits, sodas), alcool, sel raffiné et aliments ultra-transformés.',
'ALIMENTS ALCALINISANTS à privilégier : légumes verts (épinards, brocoli, chou vert, roquette, courgette), fruits frais (citron, pomme, banane, kiwi, fruits rouges), légumineuses (lentilles, pois chiches, haricots rouges, pois cassés), fruits à coque et graines (amandes, noisettes, noix, graines de chia et lin), céréales complètes et pseudo-céréales (quinoa, riz complet, sarrasin, avoine, millet), eaux et tisanes (eau pure, ortie, pissenlit, queue de cerise, romarin).',
'- Chlorophylle liquide (alcalinise et détoxifie)\n- Minéraux alcalinisants (magnésium, calcium, potassium)\n- Lithothamne (tampon acide-base naturel)\n- Jus de légumes verts',
'- Ortie (reminéralisante et alcalinisante)\n- Pissenlit (drainage et alcalinisation)\n- Prêle (reminéralisante silicée)',
'- HE Citron (1 goutte dans eau tiède le matin : alcalinisante paradoxale)\n- HE Genièvre (drainante rénale)\n- Usage externe : massage drainage',
'Les bons réflexes au quotidien : boire suffisamment (1,5 à 2 L/jour d''eau pure), bouger chaque jour (marche, sport, étirements), gérer le stress (respiration, méditation, relaxation), dormir suffisamment (7 à 9 h de sommeil de qualité), utiliser les épices et herbes (curcuma, gingembre, ail, persil, romarin), prendre soin de son intestin (fibres, aliments fermentés, probiotiques). Le pH urinaire peut se tester avec des bandelettes urinaires (disponibles en pharmacie).'),

('Glycation et produits AGEs', 'Métabolisme',
'La glycation est la 2e étape de la formation des AGEs (Advanced Glycation End-products). C''est une réaction NON ENZYMATIQUE entre un sucre réducteur et un groupement amine d''une protéine, d''un lipide ou d''un acide nucléique. Les AGEs s''accumulent avec l''âge et une alimentation riche en sucre/ultra-transformés.',
'- Alimentation riche en sucres rapides et aliments ultra-transformés\n- Cuisson à haute température (friture, grillade, four très chaud → accélère la glycation)\n- Diabète et hyperglycémie chronique\n- Âge avancé (accumulation progressive)\n- Stress oxydatif',
'Les AGEs entraînent : rigidité des protéines et lipides, inflammation chronique, stress oxydatif, vieillissement accéléré des tissus (peau, vaisseaux, cristallin, collagène). Impliqués dans : diabète, maladies cardiovasculaires, arthrose, Alzheimer, accélération du vieillissement cutané.',
'Sucres rapides et raffinés, aliments ultra-transformés, fritures, cuissons à très haute température (grillade brûlée, four très chaud), HbA1c élevé (reflet glycation chronique)',
'Cuissons douces (vapeur, poché, mijoté à basse température). Aliments antioxydants : baies, légumes colorés, épices (curcuma, cannelle, clou de girofle, origan). Bonnes graisses (oméga-3). Restriction calorique modérée.',
'- Benfotiamine (vitamine B1 lipophile : réduit formation AGEs)\n- Carnosine (inhibiteur de glycation)\n- Alpha-lipoïque (antioxydant mitochondrial)\n- Curcumine (anti-inflammatoire, anti-AGEs)\n- Quercétine (antioxydant flavonoïde)',
'- Curcuma + poivre noir (puissant anti-inflammatoire et anti-glycation)\n- Cannelle (régule la glycémie)',
'- HE Cannelle (contrôle glycémique)\n- HE Clou de girofle (antioxydant puissant)',
'Processus de glycation : 1) Le sucre (glucose) rencontre une protéine. 2) Liaison de Schiff (réversible). 3) Produit d''Amadori (liaison plus stable). 4) AGEs (irréversibles, modifications permanentes). Ce processus est progressif et dépend du temps et du taux de sucre dans le sang. En une phrase : la glycation, c''est quand le sucre se "colle" aux protéines et les modifie petit à petit, jusqu''à les rendre toxiques pour l''organisme.'),

-- ============================================
-- CARDIOVASCULAIRE (nouvelles)
-- ============================================

('HDL et LDL - Comprendre le cholestérol', 'Cardiovasculaire',
'HDL (Lipoprotéine de haute densité) = "bon cholestérol" : aide à transporter le cholestérol depuis la circulation sanguine et les tissus vers le foie pour élimination ou recyclage. LDL (Lipoprotéine de basse densité) = "mauvais cholestérol" : quand élevé, peut favoriser l''accumulation de plaques dans les artères (athérosclérose).',
'- Alimentation riche en graisses saturées et trans\n- Sédentarité (baisse HDL)\n- Tabac et alcool (baisse HDL, augmente LDL)\n- Génétique (hypercholestérolémie familiale)\n- Diabète, obésité, hypothyroïdie\n- Stress chronique',
'Cholestérol élevé est souvent asymptomatique (silencieux). Les signes tardifs : xanthelasma (dépôts sur les paupières, rares), arc cornéen (signe oculaire rare), nodules tendineux. Risque cardiovasculaire accru (infarctus, AVC) à long terme.',
'Graisses saturées et trans (viandes grasses, charcuteries, fromages très gras, beurre en excès, huile de palme, fritures), sucres raffinés, alcool, tabac',
'Fruits et légumes (antioxydants, fibres solubles), céréales complètes (bêta-glucanes de l''avoine abaissent le LDL), légumineuses, poissons gras (oméga-3 augmentent le HDL), huile d''olive (phytostérols), noix et amandes, avocat, ail.',
'- Oméga-3 EPA/DHA (augmentent HDL, diminuent triglycérides)\n- Bergamote (citrus bergamia : réduit LDL, augmente HDL)\n- Levure de riz rouge (statine naturelle - avec précautions)\n- Phytostérols (compétition avec cholestérol alimentaire)\n- Artichaut (hépato-protecteur, cholestérol)',
'- Artichaut (drainage hépatique, cholestérol)\n- Ail (allicine : effet hypocholestérolémiant)\n- Aubépine (cardiovasculaire, régulation)\n- Chardon-Marie (protection hépatique)',
'- HE Citron (drainage hépatique léger)\n- HE Cyprès (circulatoire)',
'Le HDL est votre allié : il aide à nettoyer et à éliminer l''excès de cholestérol. Le LDL est à surveiller : il peut provoquer l''accumulation dans les artères. Adopter de bonnes habitudes : alimentation équilibrée, activité physique régulière (30 min/jour → augmente le HDL), contrôles réguliers, éviter tabac et excès d''alcool. Rappelez-vous : un cœur en bonne santé, c''est un mode de vie sain et un suivi médical régulier. La levure de riz rouge contient de la monacoline K (statine naturelle) : à utiliser sous supervision et avec CoQ10 (les statines épuisent la CoQ10).'),

-- ============================================
-- OSTÉO-ARTICULAIRE (nouvelles)
-- ============================================

('Bursite', 'Ostéo-articulaire',
'Inflammation de la bourse séreuse, petit sac rempli de liquide qui réduit les frottements entre les tissus articulaires. Souvent liée à l''acidification de l''organisme et aux micro-traumatismes répétés.',
'- Micro-traumatismes répétés (gestes répétitifs, port de charges)\n- Acidification de l''organisme (excès de protéines animales, ancien tabac, sport excessif, pas assez de fruits et légumes, transpiration insuffisante)\n- Terrain inflammatoire et acidifié (favorise tendinopathies et douleurs chroniques)\n- Vieillissement des tissus',
'- Douleur et gonflement autour d''une articulation (épaule, coude, hanche, genou le plus souvent)\n- Douleur à la pression et au mouvement\n- Chaleur locale\n- Limitation des mouvements\n- Douleur chronique si non traitée',
'Excès de protéines animales (PRAL > 0), excès de fromages à pâte dure, alcool, café, aliments ultra-transformés, sucres raffinés (acidifiants)',
'Fruits et légumes alcalinisants (PRAL < 0), curcuma, gingembre (anti-inflammatoires), aliments riches en magnésium, eau de qualité, bonne hydratation',
'- Magnésium (alcalinisant, anti-inflammatoire)\n- Oméga-3 EPA/DHA (anti-inflammatoires)\n- Chlorophylle (rééquilibre terrain acido-basique, détoxifiante)\n- CoQ10 (énergie cellulaire, anti-stress oxydatif)\n- Vitamine C (formation collagène)\n- Curcumine (anti-inflammatoire puissant)',
'- Harpagophytum (anti-inflammatoire articulaire)\n- Reine des prés (anti-inflammatoire naturel, "aspirine des plantes")\n- Cassis feuilles (anti-inflammatoire, drainant)\n- Boswellia (résine anti-inflammatoire)',
'- HE Gaulthérie (anti-inflammatoire local, dilué dans huile végétale, massage)\n- HE Lavandin (muscle et articulations)\n- HE Eucalyptus citronné (anti-inflammatoire articulaire)\n- Jamais pure sur la peau, toujours dilué dans huile végétale (arnica, millepertuis)',
'L''acidification de l''organisme et les micro-traumatismes sont des facteurs clés. Agir sur le terrain et soutenir les fonctions d''élimination permettent de prévenir et d''améliorer les troubles. Bilans utiles : dosage CoQ10, questionnaire sérotonine, intolérances alimentaires, typage lymphocytaire (TH2, Treg, TH17). Objectif naturopathique : rééquilibrer l''alimentation, soutenir les émonctoires, restaurer le terrain, réduire l''inflammation.'),

('Tendinite', 'Ostéo-articulaire',
'Inflammation d''un tendon, bande de fibres qui relie le muscle à l''os. Les tendinites chroniques inexpliquées sont souvent associées à un terrain acidifié.',
'- Micro-traumatismes répétés professionnels ou sportifs (epicondylite chez joueurs de tennis, tendinite des adducteurs chez danseurs)\n- Maladie articulaire inflammatoire (spondylarthrite ankylosante)\n- Terrain acidifié\n- Vieillissement des tissus et rupture des fibres de collagène (périarthrite scapulo-humérale)',
'- Douleur au tendon lors du mouvement ou à la pression\n- Raideur matinale\n- Gonflement local possible\n- Douleur à l''effort et parfois au repos dans les formes chroniques\n- Limite fonctionnelle progressive',
'Excès de protéines animales (PRAL > 0), excès de fromages à pâte dure, sucres raffinés, alcool (acidifiants)',
'Fruits et légumes alcalinisants, curcuma, gingembre, aliments riches en collagène (bouillon d''os, vitamine C), magnésium',
'- Collagène natif type II ou hydrolysé (réparation tendineuse)\n- Vitamine C (synthèse collagène)\n- Magnésium (anti-inflammatoire, alcalinisant)\n- Oméga-3 (anti-inflammatoires)\n- Silice organique (renfonce les tendons)\n- Curcumine (anti-inflammatoire)',
'- Harpagophytum (anti-inflammatoire articulaire)\n- Cassis feuilles (anti-inflammatoire, cortisone-like)\n- Reine des prés (anti-inflammatoire et antalgique)\n- Boswellia serrata',
'- HE Gaulthérie (anti-inflammatoire local puissant)\n- HE Eucalyptus citronné (anti-inflammatoire articulaire)\n- HE Romarin camphré (décontracturant musculaire)\n- Diluer dans huile d''arnica ou de millepertuis',
'Si tendinite chronique inexpliquée, rechercher terrain acidifié. Agir sur le terrain et soutenir les fonctions d''élimination (foie, reins, intestin, peau) permettent de prévenir et améliorer les troubles. Repos relatif (ne pas bloquer complètement). Physiothérapie en complément.'),

('Fibromyalgie', 'Ostéo-articulaire',
'Syndrome de douleurs diffuses chroniques associé à une fatigue, des troubles du sommeil et souvent une anxiété. Souvent lié à un terrain acidifié, un stress chronique et des troubles du sommeil.',
'- Stress chronique (facteur déclenchant et aggravant)\n- Terrain acidifié (acidose métabolique latente)\n- Troubles du sommeil (déficit de phase 3-4 du sommeil)\n- Dysbiose intestinale\n- Déficits en micronutriments (magnésium, vitamine D, B)\n- Traumatismes physiques ou psychologiques',
'- Douleurs musculaires et articulaires diffuses (points douloureux multiples)\n- Fatigue chronique sévère\n- Troubles du sommeil (sommeil non réparateur)\n- Syndrome anxio-dépressif\n- Troubles cognitifs (fibro-fog)\n- Troubles digestifs fréquents (colopathie associée)',
'Excès de protéines animales (acidifiants), gluten (inflammation), lactose, sucres rapides, café, alcool, glutamate (exhausteur de goût), aspartame',
'Alimentation anti-inflammatoire et alcalinisante : fruits et légumes colorés, curcuma, gingembre, poissons gras, huile d''olive, légumineuses, éviter les aliments pro-inflammatoires',
'- Magnésium malate (myalgie et énergie)\n- Vitamine D (douleurs et immunité)\n- 5-HTP (sérotonine et sommeil)\n- Coenzyme Q10 (énergie mitochondriale)\n- Acides aminés soufrés (MSM)\n- Oméga-3 (anti-inflammatoires)',
'- Rhodiola (adaptogène, fatigue)\n- Ashwagandha (stress, douleurs)\n- Griffonia (sérotonine, humeur et sommeil)\n- Valériane + Houblon (sommeil)\n- Harpagophytum (douleurs articulaires)',
'- HE Lavande vraie (relaxante, sommeil)\n- HE Gaulthérie (antalgique, massage)\n- HE Marjolaine (parasympathicotonique, douleurs)\n- En massage dilué sur les zones douloureuses',
'Approche globale indispensable : gestion du stress (méditation, cohérence cardiaque, yoga doux), amélioration du sommeil (priorité absolue), activité physique douce progressive (aquagym, marche, yoga), équilibre acido-basique, soutien psychologique. La fibromyalgie est souvent associée à stress chronique, terrain acidifié et dysbiose. Pas de traitement uniquement symptomatique sans traitement du terrain.'),

-- ============================================
-- GROSSESSE (nouvelles)
-- ============================================

('Grossesse - Super-aliments et nutrition', 'Grossesse',
'Les super-aliments sont des concentrés de nutriments essentiels qui soutiennent l''énergie, la vitalité, l''immunité et le bon développement du bébé pendant la grossesse. À varier au quotidien, privilégier la qualité (crus, bio, peu transformés), associer à une alimentation équilibrée et bien s''hydrater.',
'Besoins nutritionnels accrus pendant la grossesse (protéines, acide folique, fer, iode, DHA, vitamine D, calcium, magnésium)',
'Fatigue, carences potentielles, développement optimal du bébé à soutenir',
'Spiruline en excès (caféine), algues en excès (iode), éviter compléments riches en vitamine A (rétinol) à fortes doses, limiter les algues trop riches en iode',
'1. Spiruline (1-3g/j) : protéines, B12, chlorophylle, antioxydants, soutien énergie et immunité.\n2. AFA Klamath (1-3g/j) : source complète de nutriments, vitalité, oxygénation.\n3. Jus d''herbe de blé/orge (30-60ml/j) : minéraux, enzymes, chlorophylle, détoxifiant.\n4. Algues de mer (1-2 c. à soupe/j) : iode, minéraux, calcium, magnésium, thyroïde.\n5. Baies (Goji, Myrtille, Açaï, Canneberge) : antioxydants, anti-inflammatoires, vitamines.\n6. Pollen frais (1-2 c. à café/j) : protéines, vitamines, enzymes, oligo-éléments.\n7. Gelée royale (1/2 à 1 c. à café/j à jeun) : vitalité, résistance, nutriments complets.\n8. Chia et Lin (2-3 c. à soupe/j) : oméga-3, fibres, lignanes, hormones, cerveau bébé.\n9. Cacao cru >70% (1-2 carrés/j) : magnésium, fer, antioxydants, théobromine.\n10. Graines germées (2-3 c. à soupe/j) : vitamines, minéraux, enzymes, digestion.\n11. Aliments lacto-fermentés (2-3 c. à soupe/j) : probiotiques, immunité, digestion.\n12. K-Philus (1 gél/j à jeun) : probiotique complet.\n13. Curcuma, épices, germe de blé : anti-inflammatoires, antioxydants, B, E, minéraux.\n14. Eau de mer (1-2 c. à café/j diluée) : iode, magnésium, calcium, anti-stress naturel.',
'Compléments grossesse recommandés : Ergyfol (acide folique forme active), Prénatal Nutriens''s (multivitamines), Ergynatal oméga-3, Ferrasyn fer bisglycinate, Vitamine D3, Vitamines B complexe, Iodé 150, Calcium Marin Magnésium, K-Philus probiotiques, Oligophytum oligo-éléments.',
'Précautions grossesse : éviter plantes abortives ou hormonales, limiter la menthe poivrée, ne pas prendre de teintures-mères alcoolisées',
'Précautions grossesse : voir fiche aromathérapie grossesse. Aucune HE par voie interne sans avis médical.',
'Précautions : consommer avec modération spiruline, cacao, thé vert (caféine). Éviter les compléments riches en vitamine A (rétinol) à fortes doses. Limiter les algues trop riches en iode. Toujours privilégier la qualité (bio, non irradié, non transformé). Demander conseil au naturopathe.'),

('Grossesse - Aromathérapie sécurisée', 'Grossesse',
'L''aromathérapie n''est pas anodine pendant la grossesse. Privilégier la douceur, la qualité et toujours l''accompagnement d''un professionnel. Écouter son corps, respecter son rythme.',
'Usage d''huiles essentielles pendant la grossesse requiert une attention particulière : certaines HE sont abortives, toxiques pour le fœtus, ou hormon-like',
'Nausées, fatigue, stress, anxiété, douleurs diverses, jambes lourdes, ballonnements selon le trimestre',
'Toutes HE à cétones (abortives, toxiques pour le fœtus), toutes HE à phénols (hépatotoxiques), Achillée millefeuille, Acore calamus, Ail, Ajowan, Aneth, Armoise, Cannelle (écorce et feuille), Carvi, Cèdre, Curcuma, Cyprès, Eucalyptus globulus, Menthe poivrée, Sauge sclarée, Thym à thuyanol, Romarin à camphre, Origan, Sarriette, Ciste, Hysope, Persil, Fenouil amer',
'Alimentation équilibrée pendant la grossesse (voir fiche super-aliments grossesse)',
'Compléments spécifiques grossesse (voir fiche compléments grossesse)',
'HE autorisées après le 3e mois (et allaitement) à utiliser avec précautions : Basilic à linalol, Bois de Rose, Camomille allemande, Camomille romaine, Cardamome, Ciste ladanifère, Citron, Cumin, Épinette noire, Estragon, Eucalyptus citronné, Eucalyptus radié, Eucalyptus smithii, Géranium Rosat, Gingembre, Hélichryse italienne, Inule odorante. SYNERGIES SÉCURISÉES (dès le 3e mois) : Nausées/fatigue : Citron 2g + Gingembre 1g + Menthe verte 1g dans 10ml HV (olfaction ou massage plexus solaire). Sommeil/anxiété : Camomille romaine 2g + Bois de Rose 2g + Mandarine verte 2g dans 10ml HV (massage plexus solaire ou pieds). Jambes lourdes/rétention : Cyprès 2g + Hélichryse italienne 2g + Eucalyptus citronné 2g dans 10ml HV (massage bas des jambes). Digestion/ballonnements : Cardamome 2g + Cumin 2g + Estragon 2g dans 10ml HV (massage ventre dans le sens horaire).',
'Voies d''utilisation recommandées : voie cutanée diluée (≤3% d''HE), olfaction (5-10 min, 2-3x/jour), qualité biologique et traçabilité. Pas d''application sur le ventre, proche du bébé, ni des seins en cas d''allaitement. La voie interne est réservée à l''avis médical (sauf HE de citron : 1 goutte + 3 mélangée avec miel ou huile). PRÉCAUTIONS : toujours diluer dans une huile végétale (amande douce, noyau d''abricot, jojoba). Faire un test cutané dans le pli du coude 24h avant. Ne jamais utiliser par voie orale sans avis médical. Respecter les dosages et durées. En cas de doute ou de pathologie : professionnel de santé.'),

('Grossesse - Compléments alimentaires essentiels', 'Grossesse',
'Les besoins en compléments alimentaires varient en fonction des besoins de chaque femme, de son alimentation, de son terrain et des résultats des analyses sanguines. Ne jamais remplacer une alimentation variée et équilibrée.',
'Besoins nutritionnels accrus pendant la grossesse : acide folique (tube neural), fer (anémie maternelle et fœtale), iode (thyroïde et développement neurologique bébé), DHA (cerveau et rétine), vitamine D (immunité, calcium), vitamines B (métabolisme énergétique)',
'Carences potentielles pendant la grossesse avec conséquences sur la mère et le bébé',
'Éviter la prise concomitante de fer et calcium (compétition), de thé et café (réduction absorption fer), dépasser les doses recommandées',
'Alimentation équilibrée couvrant les besoins de base. Protéines de qualité (poissons maigres, œufs, légumineuses, viandes blanches). Éviter viandes grasses, charcuteries, fritures, excès de produits laitiers. Aliments bio, frais, peu transformés si possible.',
'Besoins majeurs :\n- Acide folique B9 (600µg/j, débuter 3 mois avant : Ergyfol/PhytoPrevent, forme active 5-MTHF)\n- Fer bisglycinate (si carence : Ferrasyn/Synphonat, 1 gél/j à distance calcium, thé, café + Vit C)\n- Iode (200-250µg/j, ne pas dépasser 500µg/j : Iodé 150/PhytoPrevent)\n- Oméga-3 DHA (200-300mg/j à partir du 2e trimestre : Ergynatal/Nutrergia)\n- Vitamine D3 (800-2000 UI/j selon bilan : Nutripure)\n- Vitamines B complexe (1 gél/j : Nutripure)\n- Calcium-Magnésium marin (2 gél/j, à distance du fer : Nutripure)\n- Probiotiques (K-Philus/Synphonat, 1 gél/j à jeun, cure 2-3 mois)\n- Oligo-éléments (Oligophytum/PhytoPrevent, 1 ampoule/j)\n- Complexe grossesse (Prénatal Nutriens''s/Espadiet OU Grossesse Total/Solgar)',
'Précautions grossesse : éviter plantes abortives, hormonales, huiles essentielles à cétones',
'Aucune aromathérapie par voie interne sans avis médical pendant la grossesse',
'Règles générales : prendre les compléments au bon moment et selon les posologies. Respecter les associations et espacements (fer/calcium, iode). Faire des cures adaptées et raisonnables. Hydratation suffisante. Quand faire des bilans ? Idéalement avant la conception ou dès le 1er trimestre, puis au 2e trimestre si besoin : NFS (ferritine), vitamine D, B12, folates, iode, fonction thyroïdienne. Ces produits sont des exemples. Toujours choisir des compléments de qualité, adaptés à vos besoins et bien tolérés.'),

-- ============================================
-- PRÉVENTION / HYGIÈNE DE VIE (nouvelles)
-- ============================================

('Maison saine - Environnement et perturbateurs endocriniens', 'Prévention/Environnement',
'Nos choix quotidiens à la maison impactent notre santé hormonal et général. Les perturbateurs endocriniens (PE) peuvent s''accumuler dans l''organisme et impacter la fertilité, la grossesse, le développement du bébé et la santé globale.',
'- Utilisation de poêles en Teflon (PTFE libère des substances chimiques nocives à haute température, rayé ou usé)\n- Produits ménagers chimiques (perturbateurs endocriniens, allergènes)\n- Plastiques pour cuisson et stockage (migration de PE à la chaleur)\n- Produits d''entretien conventionnels',
'Exposition aux perturbateurs endocriniens : accumulation dans l''organisme, impact sur la fertilité, la grossesse et le développement du bébé, risque allergies et irritations, moins d''exposition = moins de risques.',
'Poêles en Teflon (surtout rayées ou usées), plastiques pour cuisson, produits ménagers chimiques conventionnels, lessive et adoucissants parfumés synthétiques',
'Aucun aliment particulier mais privilégier une alimentation biologique pour réduire l''exposition aux pesticides',
'Pas de compléments spécifiques mais une alimentation bio et riche en antioxydants aide à combattre les effets des PE.',
'Aucune spécifique',
'HE dans les produits ménagers maison (quelques gouttes dans les préparations nettoyantes) : lavande (antibactérienne), tea tree (antiseptique), citron (dégraissant, parfumant), eucalyptus (désinfectant).',
'PRODUITS D''ENTRETIEN NATURELS (simples, économiques, efficaces) : Vinaigre blanc (détartre, désinfecte, dégraisse : salle de bain, cuisine, WC, vitres). Bicarbonate de soude (nettoie, récure, absorbe odeurs : éviers, plaques, moquettes). Savon noir (dégraisse, nettoie, nourrit les surfaces : sols, cuisine, meubles). Acide citrique (détartre en profondeur : bouilloire, lave-vaisselle, robinetterie). Percarbonate de soude (blanchit, détache, désodorise). Huiles essentielles (parfument, assainissent, antibactériennes, antifongiques). BONNES HABITUDES : aérer l''intérieur 10 min matin et soir. Privilégier matériaux naturels (bois, coton, lin, verre). Réduire le plastique, surtout pour la cuisson et le stockage. Laver le linge à basse température avec lessives naturelles. Lavez-vous les mains avec des savons doux et naturels. Poêles : privilégier l''INOX (sain, durable, recyclable, ne libère aucune substance toxique). Pour éviter que ça accroche : préchauffer la poêle, ajouter matière grasse, ne pas retourner trop tôt les aliments.'),

('Ayurvéda - Les fondamentaux', 'Médecine traditionnelle',
'Médecine traditionnelle indienne vieille de plus de 5 000 ans. "Ayurvéda" signifie "connaissance de la vie". Elle vise à maintenir l''harmonie entre le corps, l''esprit et la nature pour une santé durable, une énergie stable et une vie pleine de vitalité. Médecine holistique, naturelle, préventive et personnalisée.',
'Déséquilibres des 3 doshas selon le mode de vie, les saisons, les émotions, l''alimentation ou le stress. Chaque personne a une constitution unique (Prakriti). Les déséquilibres (Vikruti) apparaissent avec le mode de vie.',
'Déséquilibre VATA (Air+Éther) : anxiété, peur, nervosité, constipation, douleurs articulaires, instabilité. Déséquilibre PITTA (Feu+Eau) : colère, irritabilité, impatience, inflammation, troubles digestifs, excès de chaleur. Déséquilibre KAPHA (Terre+Eau) : léthargie, passivité, manque d''énergie, lourdeur, congestion, prise de poids.',
'Aliments contraires à sa constitution (ex: Vata doit éviter les aliments froids, secs, crus ; Pitta les épices fortes ; Kapha les aliments lourds et gras)',
'Alimentation adaptée selon la constitution, la saison et la digestion. RECETTES AYURVÉDIQUES : Golden Milk (lait doré) : lait végétal + curcuma + gingembre + cannelle + poivre noir + cardamome (anti-inflammatoire, renforce immunité). Tisane équilibrante : mélisse + camomille + fenouil + réglisse (apaise le stress, favorise digestion et sommeil). Eau au cuivre : boire l''eau conservée dans un récipient en cuivre (laissée toute une nuit) au réveil. Détox Triphala : 1/2 c. à c. en poudre dans verre d''eau tiède le soir (soutient digestion, élimination, foie).',
'- Ashwagandha + Tulsi (calme le stress)\n- Curcuma + Gingembre (anti-inflammatoire naturel)\n- Triphala + Fenouil (digestion légère)\n- Brahmi + Gotu kola (clarté mentale)\n- Réglisse + Fenugrec (équilibre Pitta)',
'Massage Abhyanga à l''huile de sésame (réchauffe, nourrit les tissus, détend corps et mental, à faire 15-20 min avant la douche). Le Panchakarma : cure ayurvédique profonde visant à éliminer les toxines accumulées dans le corps par 5 actions (Vamana, Virechana, Basti, Nasya, Raktamoksha).',
'Routines quotidiennes ayurvédiques : se lever avant le lever du soleil, gratter la langue (déchet nocturne), boire eau chaude, huile à la bouche (oil pulling 5-10 min), manger à heures régulières, dîner 2-3h avant le coucher, dormir tôt, pratiquer yoga et respiration. PRÉCAUTIONS : consulter un professionnel de santé en cas de maladie chronique ou de traitement médicamenteux. Certaines plantes sont contre-indiquées pendant la grossesse, l''allaitement ou en cas de pathologie. Ne remplace pas un avis médical ni un traitement prescrit. Citer les sources (Institut Ayurveda, Dr Vasant Lad).');
