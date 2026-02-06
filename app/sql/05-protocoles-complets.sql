-- ============================================
-- PHV Naturo - Protocoles Complets
-- Basés sur l'ensemble des cours de naturopathie
-- À importer APRÈS les fichiers 01 à 04
-- ============================================

-- Supprimer les anciens protocoles pour éviter les doublons
DELETE FROM protocoles WHERE user_id = 1;

-- ============================================
-- 1. PROTOCOLES DIGESTIFS
-- ============================================

INSERT INTO protocoles (user_id, nom, type_protocole, duree_jours, description, objectifs, phases, complements, alimentation, contre_indications) VALUES

(1, 'Détox hépatique printanière', 'detox', 21,
'Cure de nettoyage hépatique saisonnière. Idéal au printemps ou après période d''excès.',
'- Stimuler les fonctions hépatobiliaires\n- Soutenir les phases I et II de détoxication\n- Drainer les toxines accumulées\n- Améliorer le teint et l''énergie',
'[{"phase":1,"nom":"Préparation intestinale","duree":"7 jours","actions":["Réduire progressivement alcool, café, sucres","Augmenter légumes verts et fibres","Hydratation 2L/jour","Tisane romarin ou pissenlit matin"]},{"phase":2,"nom":"Drainage actif","duree":"10 jours","actions":["Artichaut + Radis noir en ampoules","Bouillotte chaude sur foie 20min/soir","Jus citron tiède le matin","Monodiètes légères 1-2x/semaine"]},{"phase":3,"nom":"Régénération","duree":"4 jours","actions":["Chardon-Marie pour régénérer","Desmodium si besoin","Réintroduction progressive","Maintien hygiène alimentaire"]}]',
'[{"nom":"Artichaut + Radis noir","posologie":"1 ampoule avant repas midi","duree":"10 jours"},{"nom":"Chardon-Marie","posologie":"200-400mg extrait standardisé 2x/jour","duree":"Phase 3 + 2 semaines"},{"nom":"Desmodium","posologie":"Si fatigue hépatique, selon notice","duree":"10 jours"}]',
'Privilégier: légumes verts, crucifères, ail, oignon, curcuma, citron, huile olive.\nÉviter: alcool, café, friture, charcuterie, produits laitiers, sucres raffinés, gluten si sensible.',
'Grossesse et allaitement, calculs biliaires, obstruction voies biliaires, maladie hépatique grave, prise de médicaments métabolisés par le foie'),

(1, 'Confort digestif - Intestin irritable', 'digestif', 56,
'Protocole complet pour SII. Approche en 3 axes: microbiote, muqueuse intestinale, axe intestin-cerveau.',
'- Réduire ballonnements et douleurs abdominales\n- Régulariser le transit\n- Réparer la perméabilité intestinale\n- Rééquilibrer le microbiote',
'[{"phase":1,"nom":"Éviction et apaisement","duree":"21 jours","actions":["Régime pauvre en FODMAPs","Journal alimentaire quotidien","Tisane mélisse + fenouil après repas","Gestion stress (cohérence cardiaque 3x/jour)"]},{"phase":2,"nom":"Réparation muqueuse","duree":"21 jours","actions":["L-Glutamine 5g le matin à jeun","Aloe vera gel buvable","Introduction progressive probiotiques","Bouillon d''os ou collagène"]},{"phase":3,"nom":"Réensemencement","duree":"14 jours","actions":["Probiotiques multi-souches haute dose","Prébiotiques doux (FOS en petite quantité)","Réintroduction FODMAP un par un","Maintien cohérence cardiaque"]}]',
'[{"nom":"L-Glutamine","posologie":"5g poudre le matin à jeun dans eau tiède","duree":"6-8 semaines"},{"nom":"Probiotiques SII","posologie":"Lactobacillus plantarum 299v ou VSL#3","duree":"3 mois minimum"},{"nom":"Enzymes digestives","posologie":"1 gélule au début des repas","duree":"Phase 1-2"}]',
'Phase 1 éviter: oignon, ail, blé, lactose, pomme, poire, légumineuses.\nPrivilégier: riz, quinoa, carottes cuites, courgettes, viandes blanches, poissons.\nMastication +++ (30x par bouchée), manger lentement et au calme.',
'Attention aux plantes amères si RGO sévère. Prudence réglisse si hypertension. L-Glutamine éviter si insuffisance rénale.'),

(1, 'Rééquilibrage microbiote post-antibiotiques', 'digestif', 42,
'Restauration du microbiote intestinal après traitement antibiotique ou gastro-entérite.',
'- Restaurer la diversité du microbiote\n- Renforcer la barrière intestinale\n- Prévenir les infections opportunistes\n- Retrouver un transit normal',
'[{"phase":1,"nom":"Protection","duree":"7 jours","actions":["Saccharomyces boulardii (pendant ou après ATB)","Éviter sucres et levures","Bouillon d''os quotidien","Légumes cuits uniquement"]},{"phase":2,"nom":"Réensemencement","duree":"21 jours","actions":["Probiotiques multi-souches 20+ milliards","Aliments fermentés quotidiens","Fibres prébiotiques progressives","L-Glutamine si perméabilité"]},{"phase":3,"nom":"Diversification","duree":"14 jours","actions":["30 végétaux différents par semaine","Maintien probiotiques","Introduction kéfir ou kombucha","Réduire sucres raffinés"]}]',
'[{"nom":"Saccharomyces boulardii","posologie":"250-500mg 2x/jour","duree":"Pendant ATB + 1 semaine après"},{"nom":"Probiotiques multi-souches","posologie":"20-50 milliards UFC/jour à jeun","duree":"2-3 mois"},{"nom":"L-Glutamine","posologie":"3-5g/jour si troubles persistants","duree":"4-6 semaines"}]',
'Semaine 1: riz, patate douce, carottes cuites, poulet, poisson blanc.\nProgressivement: choucroute crue, kéfir, miso, légumes variés, fibres douces.',
'Immunodépression sévère: prudence avec les probiotiques. SIBO: éviter prébiotiques au début.');

-- ============================================
-- 2. PROTOCOLES STRESS ET SOMMEIL
-- ============================================

INSERT INTO protocoles (user_id, nom, type_protocole, duree_jours, description, objectifs, phases, complements, alimentation, contre_indications) VALUES

(1, 'Gestion du stress chronique', 'stress', 90,
'Programme complet pour stress chronique et épuisement nerveux. Basé sur les adaptogènes et la régulation du système nerveux.',
'- Restaurer la capacité d''adaptation au stress\n- Soutenir les glandes surrénales\n- Améliorer la qualité du sommeil\n- Retrouver énergie et clarté mentale',
'[{"phase":1,"nom":"Phase d''urgence","duree":"21 jours","actions":["Magnésium haute dose (400mg/jour)","Cohérence cardiaque 3x5min/jour","Arrêt café ou max 1 le matin","Coucher avant 22h30","Marche 20min nature quotidienne"]},{"phase":2,"nom":"Phase adaptogène","duree":"45 jours","actions":["Introduction Rhodiola ou Ashwagandha","Maintien magnésium + vitamines B","HE Épinette noire sur surrénales","Activité physique douce régulière","Techniques de relaxation"]},{"phase":3,"nom":"Consolidation","duree":"24 jours","actions":["Diminution progressive compléments","Maintien hygiène de vie","Activité physique plus intense si OK","Gestion des facteurs de stress"]}]',
'[{"nom":"Magnésium bisglycinate","posologie":"300-400mg le soir au repas","duree":"3 mois minimum"},{"nom":"Complexe vitamines B","posologie":"1 gélule le matin","duree":"2-3 mois"},{"nom":"Rhodiola rosea","posologie":"200-400mg matin et midi (pas le soir)","duree":"Phase 2 (6-8 semaines)"},{"nom":"Ashwagandha","posologie":"300-600mg/jour (alternative Rhodiola)","duree":"Phase 2"}]',
'Protéines à chaque repas (stabilité glycémique), oméga-3 (poissons gras 3x/sem), magnésium (oléagineux, chocolat noir), éviter café après 14h, limiter alcool et sucres.',
'Rhodiola: éviter si trouble bipolaire, insomnie sévère. Ashwagandha: prudence si hyperthyroïdie. Ginseng: éviter si HTA non contrôlée.'),

(1, 'Amélioration du sommeil', 'stress', 42,
'Protocole pour insomnie et troubles du sommeil. Approche chronobiologique et naturelle.',
'- Réduire le temps d''endormissement\n- Diminuer les réveils nocturnes\n- Améliorer la qualité du sommeil profond\n- Retrouver un rythme circadien stable',
'[{"phase":1,"nom":"Hygiène du sommeil","duree":"14 jours","actions":["Heure de coucher fixe (±30min)","Écrans éteints 2h avant coucher","Chambre fraîche (18°C) et obscure","Pas de caféine après 14h","Dîner léger 3h avant coucher"]},{"phase":2,"nom":"Soutien naturel","duree":"21 jours","actions":["Tisane du soir (tilleul, passiflore, mélisse)","Magnésium le soir","Mélatonine si jet-lag ou décalage","HE Lavande vraie sur oreiller","Cohérence cardiaque avant coucher"]},{"phase":3,"nom":"Consolidation","duree":"7 jours","actions":["Maintien rituels","Exposition lumière naturelle le matin","Activité physique (pas le soir)","Gestion des ruminations"]}]',
'[{"nom":"Magnésium bisglycinate","posologie":"300mg 1h avant coucher","duree":"6-8 semaines"},{"nom":"Passiflore + Valériane","posologie":"300-500mg 30min avant coucher","duree":"3-4 semaines"},{"nom":"Mélatonine (si décalage)","posologie":"1-2mg 30min avant heure souhaitée","duree":"Max 3-4 semaines"},{"nom":"L-Théanine","posologie":"200mg le soir si anxiété","duree":"Selon besoin"}]',
'Dîner: protéines légères + glucides complexes (favorise sérotonine). Éviter: excitants, repas lourds, alcool (perturbe sommeil profond).',
'Mélatonine: avis médical si grossesse, dépression, épilepsie. Valériane: peut donner effet paradoxal chez certains.');

-- ============================================
-- 3. PROTOCOLES IMMUNITAIRES
-- ============================================

INSERT INTO protocoles (user_id, nom, type_protocole, duree_jours, description, objectifs, phases, complements, alimentation, contre_indications) VALUES

(1, 'Renforcement immunitaire hivernal', 'immunite', 90,
'Préparation du terrain immunitaire pour la saison froide. À commencer en septembre.',
'- Renforcer les défenses naturelles\n- Optimiser le microbiote intestinal (70% immunité)\n- Combler les carences courantes (D, zinc, C)\n- Réduire les infections hivernales',
'[{"phase":1,"nom":"Préparation terrain","duree":"30 jours","actions":["Bilan et correction carences (D, fer, zinc)","Cure probiotiques pour microbiote","Réduction sucres et aliments pro-inflammatoires","Sommeil et gestion stress"]},{"phase":2,"nom":"Stimulation","duree":"21 jours","actions":["Échinacée (cure 3 semaines MAX)","Propolis quotidienne","Vitamine C naturelle","Exercice modéré régulier"]},{"phase":3,"nom":"Entretien hivernal","duree":"39 jours","actions":["Arrêt échinacée, maintien autres","Gelée royale ou ginseng si fatigue","Alimentation réchauffante","Maintien hygiène de vie"]}]',
'[{"nom":"Vitamine D3","posologie":"2000-4000 UI/jour (selon dosage)","duree":"Octobre à avril"},{"nom":"Zinc","posologie":"15-30mg/jour pendant les repas","duree":"3 mois"},{"nom":"Vitamine C","posologie":"500-1000mg/jour en plusieurs prises","duree":"Tout l''hiver"},{"nom":"Échinacée","posologie":"Selon fabricant - extrait standardisé","duree":"3 semaines MAXIMUM (pause 2 sem)"}]',
'Quotidien: ail, oignon, gingembre, curcuma, agrumes, kiwi. Hebdomadaire: champignons, bouillon os, graines courge. Éviter: sucres raffinés (immunosuppresseurs).',
'Échinacée: CONTRE-INDIQUÉE si maladies auto-immunes (SEP, lupus, PR). Prudence si immunosuppresseurs.'),

(1, 'Soutien post-infection', 'immunite', 28,
'Récupération après maladie infectieuse (grippe, COVID, gastro...). Restaurer énergie et immunité.',
'- Accélérer la convalescence\n- Restaurer le microbiote\n- Reminéraliser l''organisme\n- Prévenir les rechutes',
'[{"phase":1,"nom":"Repos actif","duree":"7 jours","actions":["Repos mais pas alitement total","Bouillons reminéralisants","Hydratation +++","Probiotiques post-infection"]},{"phase":2,"nom":"Reconstruction","duree":"14 jours","actions":["Alimentation riche en nutriments","Gelée royale ou spiruline","Reprise progressive activité","Sommeil récupérateur"]},{"phase":3,"nom":"Consolidation","duree":"7 jours","actions":["Retour activité normale progressif","Maintien complémentation légère","Prévention rechute"]}]',
'[{"nom":"Probiotiques multi-souches","posologie":"20 milliards/jour","duree":"1 mois"},{"nom":"Spiruline","posologie":"3-5g/jour","duree":"3-4 semaines"},{"nom":"Vitamine C + Zinc","posologie":"1g vit C + 20mg zinc","duree":"2 semaines"}]',
'Bouillons d''os maison, soupes de légumes, protéines facilement digestibles, fruits cuits, compotes. Éviter efforts digestifs.',
'Adapter selon infection (ex: éviter fibres si gastro récente).');

-- ============================================
-- 4. PROTOCOLES HORMONAUX
-- ============================================

INSERT INTO protocoles (user_id, nom, type_protocole, duree_jours, description, objectifs, phases, complements, alimentation, contre_indications) VALUES

(1, 'Équilibre hormonal féminin - SPM', 'hormonal', 90,
'Rééquilibrage du cycle et réduction des symptômes prémenstruels. Approche naturelle.',
'- Réduire les symptômes du SPM\n- Régulariser les cycles\n- Équilibrer œstrogènes/progestérone\n- Améliorer l''humeur cyclique',
'[{"phase":1,"nom":"Phase folliculaire J1-J14","actions":["Phytoestrogènes doux (lin, soja si toléré)","Soutien hépatique (élimination œstrogènes)","Exercice cardio modéré","Fer si règles abondantes"]},{"phase":2,"nom":"Phase lutéale J15-J28","actions":["Gattilier quotidien","Magnésium dose renforcée","Onagre si mastodynies","Réduire sel et sucres"]},{"phase":3,"nom":"Phase menstruelle J1-J5","actions":["Plantes antispasmodiques (camomille)","Chaleur sur bas-ventre","Fer si règles abondantes","Repos adapté"]}]',
'[{"nom":"Gattilier (Vitex)","posologie":"400mg matin à jeun","duree":"3 cycles minimum pour évaluer"},{"nom":"Huile d''onagre","posologie":"1000-1500mg en phase lutéale","duree":"2ème partie de cycle"},{"nom":"Magnésium","posologie":"400mg/jour en phase lutéale","duree":"J15 à J28"}]',
'Crucifères 3x/sem (détox œstrogènes), graines de lin moulues, oméga-3, fibres 30g/jour. Réduire: caféine, alcool, sucres (surtout J15-28).',
'Gattilier: éviter si FIV ou traitement hormonal. Prudence si antécédent cancer hormono-dépendant. Sauge: CI si ATCD cancer sein.'),

(1, 'Accompagnement péri-ménopause', 'hormonal', 180,
'Soutien naturel pendant la transition ménopausique. Alternative ou complément au THS.',
'- Réduire bouffées de chaleur et sueurs\n- Maintenir densité osseuse\n- Préserver humeur et sommeil\n- Accompagner la transition',
'[{"phase":1,"nom":"Bilan et terrain","duree":"30 jours","actions":["Bilan hormonal et osseux","Alimentation anti-inflammatoire","Gestion stress (crucial)","Activité physique régulière"]},{"phase":2,"nom":"Phytoestrogènes","duree":"90 jours","actions":["Trèfle rouge ou kudzu ou soja","Sauge si bouffées de chaleur","Huile de bourrache pour peau","Magnésium + B6"]},{"phase":3,"nom":"Maintien","duree":"60 jours","actions":["Adaptation selon symptômes","Focus os (D, K2, calcium)","Maintien exercice en charge","Équilibre émotionnel"]}]',
'[{"nom":"Extrait trèfle rouge","posologie":"40-80mg isoflavones/jour","duree":"3-6 mois"},{"nom":"Sauge officinale","posologie":"300mg 2x/jour","duree":"Si bouffées de chaleur"},{"nom":"Vitamine D3 + K2","posologie":"2000 UI D3 + 100µg K2","duree":"Continue"},{"nom":"Magnésium","posologie":"300-400mg/jour","duree":"Continue"}]',
'Phytoestrogènes alimentaires: soja (si bien toléré), graines de lin. Calcium: amandes, légumes verts, sardines. Protéines chaque repas. Oméga-3.',
'Sauge: CI si ATCD cancer hormono-dépendant, épilepsie. Soja: débat si ATCD cancer sein (avis oncologue).');

-- ============================================
-- 5. PROTOCOLES PEAU
-- ============================================

INSERT INTO protocoles (user_id, nom, type_protocole, duree_jours, description, objectifs, phases, complements, alimentation, contre_indications) VALUES

(1, 'Peau nette - Acné adulte', 'peau', 120,
'Approche globale de l''acné: détox hépatique, équilibre hormonal, microbiote cutané.',
'- Réduire l''inflammation cutanée\n- Équilibrer la production de sébum\n- Rééquilibrer les microbiotes (intestin-peau)\n- Améliorer la qualité de la peau',
'[{"phase":1,"nom":"Détox interne","duree":"30 jours","actions":["Bardane + Pensée sauvage quotidien","Éviction totale produits laitiers","Réduction drastique sucres","Hydratation 2L/jour","Nettoyage doux visage"]},{"phase":2,"nom":"Rééquilibrage","duree":"60 jours","actions":["Zinc quotidien","Probiotiques axe intestin-peau","Oméga-3 anti-inflammatoires","Soins locaux naturels (tea tree dilué)"]},{"phase":3,"nom":"Maintien","duree":"30 jours","actions":["Alimentation anti-inflammatoire","Gestion stress","Routine de soins adaptée","Complémentation d''entretien"]}]',
'[{"nom":"Zinc bisglycinate","posologie":"15-30mg/jour au repas","duree":"3-4 mois"},{"nom":"Bardane","posologie":"300mg 2x/jour","duree":"2-3 mois"},{"nom":"Probiotiques","posologie":"Lactobacillus rhamnosus","duree":"3 mois"},{"nom":"Oméga-3","posologie":"1-2g EPA+DHA/jour","duree":"3 mois"}]',
'ÉVITER: produits laitiers (tous), sucres raffinés, charcuterie, fritures, alcool. PRIVILÉGIER: légumes colorés, poissons gras, noix, graines, curcuma.',
'Si traitement Roaccutane: pas de vitamine A haute dose. Bardane: prudence si diabète (hypoglycémiante).'),

(1, 'Eczéma et terrain atopique', 'peau', 90,
'Approche de fond pour eczéma chronique. Travail sur l''intestin et l''immunité.',
'- Réduire l''inflammation chronique\n- Identifier et éviter les déclencheurs\n- Renforcer la barrière cutanée\n- Moduler la réponse immunitaire',
'[{"phase":1,"nom":"Éviction et apaisement","duree":"30 jours","actions":["Journal alimentaire + symptômes","Éviction suspects (lait, œuf, gluten)","Réduction stress (facteur clé)","Émollients naturels quotidiens"]},{"phase":2,"nom":"Réparation","duree":"45 jours","actions":["L-Glutamine pour intestin","Oméga-3 anti-inflammatoires","Probiotiques (Lactobacillus rhamnosus GG)","Huile de bourrache ou onagre"]},{"phase":3,"nom":"Réintroduction","duree":"15 jours","actions":["Réintroduction alimentaire progressive","Identification déclencheurs","Protocole de maintenance"]}]',
'[{"nom":"Huile de bourrache ou onagre","posologie":"1000-1500mg/jour","duree":"3 mois"},{"nom":"Oméga-3","posologie":"2g EPA+DHA/jour","duree":"3 mois"},{"nom":"Probiotiques","posologie":"Souches spécifiques eczéma","duree":"3 mois"},{"nom":"Zinc","posologie":"15mg/jour","duree":"2 mois"}]',
'Éviter: lait de vache (souvent en cause), sucres, additifs, aliments pro-inflammatoires. Privilégier: oméga-3, légumes, curcuma.',
'Vérifier allergies alimentaires réelles. Adapter si asthme associé (terrain atopique global).');

-- ============================================
-- 6. PROTOCOLES POIDS / MÉTABOLISME
-- ============================================

INSERT INTO protocoles (user_id, nom, type_protocole, duree_jours, description, objectifs, phases, complements, alimentation, contre_indications) VALUES

(1, 'Rééquilibrage métabolique', 'poids', 120,
'Approche métabolique sans régime restrictif. Focus sur glycémie, thyroïde, stress, et inflammation.',
'- Relancer le métabolisme\n- Équilibrer la glycémie\n- Réduire l''inflammation chronique\n- Perdre du poids durablement',
'[{"phase":1,"nom":"Rééquilibrage glycémique","duree":"30 jours","actions":["Petit-déjeuner protéiné + gras","Index glycémique bas à chaque repas","Pas de grignotage (3 vrais repas)","Chrome si résistance insuline"]},{"phase":2,"nom":"Activation métabolique","duree":"60 jours","actions":["Soutien thyroïdien si besoin","Activité physique quotidienne 30min","Jeûne intermittent 16/8 si adapté","Drainage hépatique léger"]},{"phase":3,"nom":"Stabilisation","duree":"30 jours","actions":["Alimentation équilibrée pérenne","Maintien activité physique","Gestion stress (cortisol = stockage)","Pas de restriction calorique"]}]',
'[{"nom":"Chrome","posologie":"200µg/jour si glycémie limite","duree":"3 mois"},{"nom":"Thé vert extrait","posologie":"300-500mg EGCG le matin","duree":"Phase 2"},{"nom":"Oméga-3","posologie":"1-2g/jour","duree":"Continue"},{"nom":"Magnésium","posologie":"300mg/jour","duree":"Continue"}]',
'Protéines à chaque repas, légumes 50% assiette, bonnes graisses. Index glycémique bas. Éviter: sucres, produits raffinés, alcool (bloque lipolyse).',
'Thé vert: prudence si troubles cardiaques, anxiété, insomnie. Jeûne: déconseillé si TCA, diabète insulino-dépendant.'),

(1, 'Rétention d''eau et cellulite', 'poids', 60,
'Drainage et amélioration de la circulation. Approche lymphatique et veineuse.',
'- Réduire la rétention d''eau\n- Améliorer la circulation lymphatique\n- Atténuer l''aspect cellulite\n- Éliminer les toxines',
'[{"phase":1,"nom":"Drainage","duree":"21 jours","actions":["Plantes drainantes (orthosiphon, piloselle)","Réduction sel drastique","Hydratation paradoxale (2L/jour)","Brossage à sec quotidien"]},{"phase":2,"nom":"Circulation","duree":"28 jours","actions":["Vigne rouge ou marron d''Inde","Activité physique (marche, natation)","Surélever jambes le soir","Douche écossaise sur jambes"]},{"phase":3,"nom":"Maintien","duree":"11 jours","actions":["Alimentation peu salée pérenne","Maintien activité","Bas de contention si besoin","Massages drainants réguliers"]}]',
'[{"nom":"Orthosiphon + Piloselle","posologie":"Infusion ou gélules selon fabricant","duree":"3 semaines avec pause"},{"nom":"Vigne rouge","posologie":"300-600mg/jour","duree":"2 mois"},{"nom":"Marron d''Inde","posologie":"300mg 2x/jour si insuffisance veineuse","duree":"2 mois"}]',
'Réduire: sel, charcuterie, fromage, pain. Privilégier: asperge, concombre, céleri, persil, ananas, agrumes.',
'Marron d''Inde: CI si anticoagulants, insuffisance rénale. Diurétiques: attention aux pertes potassium.');

-- ============================================
-- 7. PROTOCOLES ÉNERGIE / REMINÉRALISATION
-- ============================================

INSERT INTO protocoles (user_id, nom, type_protocole, duree_jours, description, objectifs, phases, complements, alimentation, contre_indications) VALUES

(1, 'Fatigue chronique et épuisement', 'autre', 90,
'Approche globale de la fatigue persistante. Recherche des causes et soutien multi-systèmes.',
'- Identifier les causes de fatigue\n- Soutenir les surrénales\n- Optimiser la mitochondrie\n- Retrouver une énergie stable',
'[{"phase":1,"nom":"Bilan et repos","duree":"21 jours","actions":["Bilan sanguin (fer, thyroïde, vitamines)","Sommeil prioritaire (8h minimum)","Réduction stimulants","Alimentation régénérante"]},{"phase":2,"nom":"Soutien ciblé","duree":"45 jours","actions":["Complémentation selon carences","Adaptogènes doux","Coenzyme Q10 pour mitochondrie","Activité physique légère progressive"]},{"phase":3,"nom":"Reconstruction","duree":"24 jours","actions":["Augmentation progressive activité","Gestion énergie (pas de pics)","Maintien complémentation","Prévention rechute"]}]',
'[{"nom":"Fer bisglycinate","posologie":"Si carence: 14-20mg/jour avec vit C","duree":"Selon ferritine"},{"nom":"Vitamines B (complexe)","posologie":"1/jour le matin","duree":"3 mois"},{"nom":"Coenzyme Q10","posologie":"100-200mg/jour","duree":"3 mois"},{"nom":"Magnésium","posologie":"300-400mg/jour","duree":"Continue"}]',
'Protéines chaque repas, fer (viande rouge 2x/sem si carence), vitamine C avec fer, B12 si végétarien. Éviter: sucres rapides (fausse énergie puis crash).',
'CoQ10: interaction possible avec anticoagulants. Fer: uniquement si carence confirmée (toxique en excès).'),

(1, 'Reminéralisation profonde', 'remineralisation', 90,
'Pour terrain déminéralisé: fatigue, crampes, cheveux/ongles cassants, ostéopénie.',
'- Restaurer les réserves minérales\n- Renforcer os, cheveux, ongles\n- Alcaliniser le terrain\n- Prévenir l''ostéoporose',
'[{"phase":1,"nom":"Correction urgente","duree":"30 jours","actions":["Magnésium haute dose","Vitamine D3 + K2","Silicium organique","Alimentation alcalinisante","Réduction acidifiants"]},{"phase":2,"nom":"Reminéralisation active","duree":"45 jours","actions":["Lithothamne ou complexe marin","Ortie et prêle (silice)","Oméga-3 (os)","Activité physique en charge"]},{"phase":3,"nom":"Entretien","duree":"15 jours","actions":["Alimentation reminéralisante pérenne","Cures saisonnières","Eau minéralisée adaptée"]}]',
'[{"nom":"Magnésium bisglycinate","posologie":"400mg/jour","duree":"3 mois"},{"nom":"Vitamine D3 + K2","posologie":"2000-4000 UI D3 + 100µg K2","duree":"Continue"},{"nom":"Silicium organique","posologie":"Selon fabricant","duree":"3 mois"},{"nom":"Lithothamne","posologie":"1g/jour","duree":"3 mois"}]',
'Minéraux: algues, oléagineux, légumes verts, sardines entières, légumineuses, cacao cru. Éviter: sodas, excès café (fuite calcium), excès sel et protéines animales.',
'Vitamine K2: CI si anticoagulants AVK. Calcium: prudence si hypercalcémie, calculs rénaux.');

-- ============================================
-- 8. PROTOCOLES CARDIOVASCULAIRES
-- ============================================

INSERT INTO protocoles (user_id, nom, type_protocole, duree_jours, description, objectifs, phases, complements, alimentation, contre_indications) VALUES

(1, 'Santé cardiovasculaire', 'autre', 120,
'Prévention et accompagnement des facteurs de risque cardiovasculaire.',
'- Optimiser le profil lipidique\n- Réduire l''inflammation vasculaire\n- Améliorer la circulation\n- Contrôler les facteurs de risque',
'[{"phase":1,"nom":"Alimentation cardioprotectrice","duree":"30 jours","actions":["Régime méditerranéen strict","Oméga-3 quotidiens","Réduction sel et sucres","Arrêt tabac si concerné"]},{"phase":2,"nom":"Soutien actif","duree":"60 jours","actions":["Coenzyme Q10 (surtout si statines)","Ail vieilli","Exercice cardio progressif","Gestion stress (HTA)"]},{"phase":3,"nom":"Maintien","duree":"30 jours","actions":["Alimentation pérenne","Activité régulière","Suivi biologique","Phytothérapie entretien"]}]',
'[{"nom":"Oméga-3 EPA/DHA","posologie":"2-3g/jour (si triglycérides élevés)","duree":"Continue"},{"nom":"Coenzyme Q10","posologie":"100-200mg/jour","duree":"Continue si statines"},{"nom":"Ail noir vieilli","posologie":"600-1200mg/jour","duree":"Continue"},{"nom":"Magnésium","posologie":"300mg/jour","duree":"Continue"}]',
'Modèle méditerranéen: huile olive, poissons gras, légumes, fruits, légumineuses, noix. Éviter: charcuterie, viande rouge excessive, friture, sucres, sel.',
'Ail: prudence si anticoagulants. Oméga-3 haute dose: discuter avec cardiologue si antiagrégants. Réglisse: éviter si HTA.');

-- ============================================
-- 9. PROTOCOLES ARTICULAIRES
-- ============================================

INSERT INTO protocoles (user_id, nom, type_protocole, duree_jours, description, objectifs, phases, complements, alimentation, contre_indications) VALUES

(1, 'Confort articulaire - Arthrose', 'autre', 120,
'Accompagnement de l''arthrose. Réduction inflammation, nutrition du cartilage.',
'- Réduire la douleur et l''inflammation\n- Freiner la dégradation du cartilage\n- Améliorer la mobilité\n- Soutenir la régénération',
'[{"phase":1,"nom":"Anti-inflammation","duree":"30 jours","actions":["Alimentation anti-inflammatoire stricte","Curcuma + poivre noir quotidien","Oméga-3 haute dose","Arrêt sucres et produits laitiers"]},{"phase":2,"nom":"Régénération","duree":"60 jours","actions":["Silicium organique","Collagène ou glucosamine","Exercice doux (natation, vélo)","Cataplasmes argile si crise"]},{"phase":3,"nom":"Maintien","duree":"30 jours","actions":["Alimentation anti-inflammatoire","Maintien complémentation","Activité physique adaptée","Gestion du poids"]}]',
'[{"nom":"Curcuma BCM-95","posologie":"500-1000mg/jour","duree":"Continue"},{"nom":"Oméga-3 EPA/DHA","posologie":"2g/jour","duree":"Continue"},{"nom":"Collagène type II","posologie":"5-10g/jour","duree":"3 mois"},{"nom":"Silicium","posologie":"Selon fabricant","duree":"3 mois"}]',
'Anti-inflammatoire: curcuma, gingembre, poissons gras, légumes colorés, cerises, noix. Éviter: sucres, produits laitiers, viande rouge, solanacées (pour certains).',
'Glucosamine: prudence si allergie fruits de mer. Harpagophytum: CI si ulcère gastrique, lithiase biliaire.');

SELECT 'Protocoles complets insérés avec succès!' AS message;
