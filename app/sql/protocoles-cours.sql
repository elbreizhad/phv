-- ============================================
-- PHV App - Protocoles basés sur les cours
-- Protocoles naturopathiques professionnels
-- ============================================

USE pertec_natu;

-- ============================================
-- PROTOCOLES COMPLETS
-- ============================================

INSERT INTO protocoles (user_id, nom, type_protocole, duree_jours, description, objectifs, phases, complements, alimentation, contre_indications) VALUES

-- ============================================
-- 1. PROTOCOLE DETOX HEPATIQUE
-- ============================================
(1, 'Détox hépatique complète', 'detox', 21,
'Protocole de détoxification hépatique en 3 phases basé sur la stimulation des émonctoires et le soutien des phases I et II de détoxication. Issu des cours sur le cycle des 4 piliers - LE FOIE.',

'- Stimuler les fonctions hépatobiliaires
- Soutenir les phases I et II de détoxication
- Drainer les toxines accumulées
- Régénérer les hépatocytes
- Améliorer la digestion des graisses',

'[
  {
    "phase": 1,
    "nom": "Préparation intestinale",
    "duree": "7 jours",
    "description": "Préparer le terrain intestinal avant drainage hépatique",
    "actions": [
      "Réduire les aliments pro-inflammatoires",
      "Augmenter les fibres douces (légumes cuits)",
      "Hydratation renforcée (2L minimum)",
      "Tisane de romarin le matin à jeun"
    ],
    "plantes": ["Romarin (infusion)", "Mélisse"],
    "huiles_essentielles": []
  },
  {
    "phase": 2,
    "nom": "Drainage actif",
    "duree": "10 jours",
    "description": "Stimulation hépatobiliaire intensive",
    "actions": [
      "Artichaut + Radis noir en synergie (gélules ou ampoules)",
      "Bouillotte chaude sur le foie 20min après repas",
      "Jus de citron tiède le matin",
      "Éviter alcool, café, sucres raffinés"
    ],
    "plantes": ["Artichaut (Cynara scolymus)", "Radis noir (Raphanus sativus)", "Desmodium"],
    "huiles_essentielles": ["Citron (2 gttes matin)", "Romarin à verbénone (hépatoprotecteur)"]
  },
  {
    "phase": 3,
    "nom": "Régénération",
    "duree": "4 jours",
    "description": "Régénération et protection hépatique",
    "actions": [
      "Chardon-Marie pour régénération hépatocytes",
      "Desmodium en soutien",
      "Réintroduction progressive alimentation normale",
      "Maintien hydratation"
    ],
    "plantes": ["Chardon-Marie (Silybum marianum)", "Desmodium adscendens"],
    "huiles_essentielles": ["Carotte (régénérant hépatique)"]
  }
]',

'[
  {"nom": "Artichaut + Radis noir", "posologie": "1 ampoule ou 2 gélules avant repas midi", "duree": "10 jours phase 2"},
  {"nom": "Desmodium", "posologie": "1 gélule 3x/jour", "duree": "14 jours (phases 2-3)"},
  {"nom": "Chardon-Marie", "posologie": "1 gélule 2x/jour", "duree": "Phase 3 + 10 jours après"},
  {"nom": "HE Citron", "posologie": "2 gouttes dans cuillère huile olive le matin", "duree": "Phase 2"},
  {"nom": "HE Romarin verbénone", "posologie": "1 goutte sur foie en massage avec HV", "duree": "Phase 2"}
]',

'PHASE PRÉPARATION:
- Légumes cuits vapeur (courgette, carotte, fenouil)
- Riz complet, quinoa
- Poissons maigres
- Éviter: produits laitiers, gluten, viandes rouges

PHASE DRAINAGE:
- Monodiète possible 1-2 jours (compote pomme ou riz)
- Légumes verts (artichaut, endive, pissenlit)
- Huile olive 1ère pression à froid
- Citron dans eau tiède matin

PHASE RÉGÉNÉRATION:
- Réintroduction progressive
- Crucifères (brocoli, chou) pour sulforaphane
- Protéines légères
- Maintenir éviction alcool 1 semaine',

'- Grossesse et allaitement
- Calculs biliaires (lithiase) - AVIS MÉDICAL obligatoire
- Obstruction des voies biliaires
- Traitement immunosuppresseur
- Chimiothérapie en cours (sauf Desmodium sur avis)
- Enfants < 12 ans'),

-- ============================================
-- 2. PROTOCOLE CONFORT DIGESTIF (SII)
-- ============================================
(1, 'Confort digestif - Syndrome intestin irritable', 'digestif', 42,
'Protocole pour le syndrome de l''intestin irritable (SII/colopathie fonctionnelle). Approche en 3 axes: rééquilibrage microbiote, réparation muqueuse, gestion du stress digestif. Basé sur les cours MICI/SII.',

'- Réduire ballonnements et douleurs abdominales
- Régulariser le transit (diarrhée ou constipation)
- Réparer la perméabilité intestinale
- Rééquilibrer le microbiote
- Diminuer l''hypersensibilité viscérale',

'[
  {
    "phase": 1,
    "nom": "Éviction et apaisement",
    "duree": "14 jours",
    "description": "Réduire l''inflammation et identifier les déclencheurs",
    "actions": [
      "Régime pauvre en FODMAPs strict",
      "Tenir journal alimentaire + symptômes",
      "Mélisse + Menthe poivrée en infusion après repas",
      "Éviter crudités et aliments fermentescibles"
    ],
    "plantes": ["Mélisse (Melissa officinalis)", "Menthe poivrée (Mentha piperita)", "Camomille matricaire"],
    "huiles_essentielles": ["Basilic exotique (antispasmodique)", "Estragon"]
  },
  {
    "phase": 2,
    "nom": "Réparation muqueuse",
    "duree": "21 jours",
    "description": "Réparer la barrière intestinale et réduire hyperperméabilité",
    "actions": [
      "L-Glutamine 5g le matin à jeun",
      "Aloe vera gel buvable",
      "Introduction progressive probiotiques",
      "Réintroduction FODMAPs un par un"
    ],
    "plantes": ["Aloe vera", "Réglisse DGL", "Guimauve (mucilages)"],
    "huiles_essentielles": ["Lavande vraie (anti-inflammatoire)", "Gingembre (massage abdominal)"]
  },
  {
    "phase": 3,
    "nom": "Consolidation microbiote",
    "duree": "7 jours minimum",
    "description": "Stabiliser le microbiote et maintenir les acquis",
    "actions": [
      "Probiotiques souches spécifiques SII",
      "Prébiotiques doux (FOS en petite quantité)",
      "Maintien alimentation adaptée",
      "Gestion du stress (cohérence cardiaque)"
    ],
    "plantes": ["Fenouil (carminatif)", "Curcuma"],
    "huiles_essentielles": []
  }
]',

'[
  {"nom": "L-Glutamine", "posologie": "5g poudre dans eau, matin à jeun", "duree": "21 jours minimum"},
  {"nom": "Probiotiques SII", "posologie": "Lactobacillus plantarum 299v ou Bifidobacterium infantis - 1 gélule/jour", "duree": "6-8 semaines"},
  {"nom": "HE Basilic exotique", "posologie": "1-2 gouttes dans huile olive après repas si spasmes", "duree": "À la demande"},
  {"nom": "HE Gingembre", "posologie": "3-4 gouttes dans HV, massage abdominal sens horaire", "duree": "Quotidien phase 2"},
  {"nom": "Aloe vera gel", "posologie": "30ml matin à jeun", "duree": "21 jours"}
]',

'PHASE 1 - FODMAPS BAS:
Éviter: oignon, ail, blé, lactose, légumineuses, pomme, poire, miel, champignons
Privilégier: riz, quinoa, carottes cuites, courgettes, banane mûre, oranges, tofu ferme

PHASE 2 - RÉPARATION:
- Bouillons d''os maison (collagène)
- Légumes cuits vapeur
- Protéines maigres
- Huiles omega-3 (lin, noix)

PHASE 3 - CONSOLIDATION:
- Réintroduction progressive des FODMAPs (1 nouveau tous les 3 jours)
- Fibres solubles douces
- Aliments fermentés si tolérés (kéfir, choucroute)',

'- Menthe poivrée: éviter si RGO sévère
- Réglisse: éviter si hypertension
- Aloe vera: éviter si grossesse, occlusion
- Diarrhées sanglantes = AVIS MÉDICAL urgent
- Perte de poids inexpliquée = bilan médical'),

-- ============================================
-- 3. PROTOCOLE IMMUNITÉ
-- ============================================
(1, 'Renforcement immunitaire', 'immunite', 30,
'Protocole de renforcement du système immunitaire. Approche terrain + stimulation des défenses naturelles. Particulièrement adapté en prévention hivernale ou après maladie.',

'- Renforcer les défenses immunitaires naturelles
- Optimiser le microbiote (70% immunité)
- Combler les carences impactant l''immunité
- Prévenir les infections récurrentes
- Soutenir la convalescence',

'[
  {
    "phase": 1,
    "nom": "Optimisation du terrain",
    "duree": "10 jours",
    "description": "Préparer le terrain pour une réponse immunitaire optimale",
    "actions": [
      "Corriger déficits zinc, vitamine D, vitamine C",
      "Soutien microbiote intestinal",
      "Réduire sucres raffinés (immunosuppresseurs)",
      "Sommeil 7-8h minimum"
    ],
    "plantes": ["Échinacée (Echinacea purpurea)", "Sureau noir (baies)"],
    "huiles_essentielles": ["Ravintsara", "Tea tree"]
  },
  {
    "phase": 2,
    "nom": "Stimulation active",
    "duree": "15 jours",
    "description": "Stimulation des défenses immunitaires",
    "actions": [
      "Échinacée en cure (pas plus de 3 semaines)",
      "Propolis",
      "Champignons adaptogènes si terrain fatigué",
      "Exercice modéré (30min marche/jour)"
    ],
    "plantes": ["Échinacée", "Astragale (Astragalus membranaceus)", "Eleuthérocoque"],
    "huiles_essentielles": ["Ravintsara (immunostimulant)", "Eucalyptus radiata"]
  },
  {
    "phase": 3,
    "nom": "Maintien",
    "duree": "5 jours et +",
    "description": "Maintenir les défenses sur le long terme",
    "actions": [
      "Arrêt échinacée (pause obligatoire)",
      "Maintien probiotiques",
      "Alimentation riche en antioxydants",
      "Gestion du stress (cortisol immunosuppresseur)"
    ],
    "plantes": ["Astragale (peut continuer)", "Reishi ou Shiitake"],
    "huiles_essentielles": []
  }
]',

'[
  {"nom": "Vitamine D3", "posologie": "2000-4000 UI/jour selon dosage sanguin", "duree": "Tout le protocole + hiver"},
  {"nom": "Zinc", "posologie": "15-30mg/jour au repas", "duree": "30 jours"},
  {"nom": "Vitamine C", "posologie": "500-1000mg/jour en 2 prises", "duree": "30 jours"},
  {"nom": "Probiotiques", "posologie": "10 milliards UFC minimum", "duree": "30 jours"},
  {"nom": "Échinacée", "posologie": "Extrait standardisé selon fabricant", "duree": "3 semaines MAX puis pause"},
  {"nom": "HE Ravintsara", "posologie": "2 gouttes sur poignets matin", "duree": "Prévention: 5j/7"}
]',

'ALIMENTS IMMUNOSTIMULANTS:
- Ail, oignon, poireau (alliacées)
- Champignons (shiitake, maitake)
- Agrumes, kiwi, baies (vitamine C)
- Légumes colorés (caroténoïdes)
- Poissons gras (oméga-3, vitamine D)
- Graines de courge, huîtres (zinc)
- Noix du Brésil (sélénium - 2/jour)

ÉVITER:
- Sucres raffinés (diminuent activité leucocytes)
- Alcool (immunosuppresseur)
- Aliments ultra-transformés
- Excès de produits laitiers si mucus',

'- Échinacée: CONTRE-INDIQUÉE si maladies auto-immunes (SEP, lupus, PR)
- Échinacée: éviter si immunosuppresseurs
- Astragale: éviter si fièvre aiguë
- Grossesse: demander avis pour HE
- VIH/immunodépression sévère: avis médical obligatoire'),

-- ============================================
-- 4. PROTOCOLE STRESS ET FATIGUE
-- ============================================
(1, 'Gestion du stress et fatigue nerveuse', 'stress', 60,
'Protocole d''accompagnement du stress chronique et de la fatigue nerveuse. Approche adaptogène + soutien des neurotransmetteurs + hygiène de vie. Basé sur les cours Phytologie Sphère Nerveuse.',

'- Restaurer les capacités d''adaptation au stress
- Soutenir les surrénales (fatigue adrénale)
- Rééquilibrer les neurotransmetteurs
- Améliorer la qualité du sommeil
- Retrouver énergie et concentration',

'[
  {
    "phase": 1,
    "nom": "Phase d''urgence",
    "duree": "14 jours",
    "description": "Calmer le système nerveux et stopper l''hémorragie énergétique",
    "actions": [
      "Magnésium haute dose",
      "Plantes calmantes (pas encore adaptogènes)",
      "Limiter les stimulants (café, écrans)",
      "Cohérence cardiaque 3x/jour",
      "Coucher avant 23h"
    ],
    "plantes": ["Mélisse", "Passiflore", "Aubépine (si palpitations)"],
    "huiles_essentielles": ["Lavande vraie", "Petit grain bigarade", "Marjolaine à coquilles"]
  },
  {
    "phase": 2,
    "nom": "Phase adaptogène",
    "duree": "30 jours",
    "description": "Restaurer les capacités d''adaptation avec plantes adaptogènes",
    "actions": [
      "Introduction adaptogènes selon profil",
      "Rhodiola si fatigue + stress",
      "Ashwagandha si anxiété + épuisement",
      "Ginseng si fatigue physique intense",
      "Maintien magnésium + vitamines B"
    ],
    "plantes": ["Rhodiola rosea", "Ashwagandha (Withania somnifera)", "Eleuthérocoque"],
    "huiles_essentielles": ["Épinette noire (surrénales)", "Pin sylvestre (fatigue)"]
  },
  {
    "phase": 3,
    "nom": "Phase de consolidation",
    "duree": "16 jours",
    "description": "Ancrer les nouvelles habitudes et sevrer progressivement",
    "actions": [
      "Diminution progressive adaptogènes",
      "Maintien hygiène de vie",
      "Techniques de gestion du stress autonomes",
      "Activité physique régulière"
    ],
    "plantes": ["Ginkgo biloba (si brouillard mental)", "Mélisse (maintien)"],
    "huiles_essentielles": []
  }
]',

'[
  {"nom": "Magnésium bisglycinate", "posologie": "300-400mg le soir (ou 2x150mg)", "duree": "Minimum 2 mois"},
  {"nom": "Complexe vitamines B", "posologie": "1 gélule le matin", "duree": "60 jours"},
  {"nom": "Rhodiola rosea", "posologie": "200-400mg extrait standardisé, matin et midi (pas le soir)", "duree": "Phase 2"},
  {"nom": "Ashwagandha", "posologie": "300-600mg extrait KSM-66, soir", "duree": "Phase 2 si profil anxieux"},
  {"nom": "HE Lavande vraie", "posologie": "2 gouttes sur poignets ou oreiller", "duree": "Au besoin"},
  {"nom": "HE Épinette noire", "posologie": "2 gouttes en massage zone surrénales matin", "duree": "Phase 2"}
]',

'SOUTIEN SYSTÈME NERVEUX:
- Oméga-3 (poissons gras 3x/sem, huile lin/noix)
- Protéines à chaque repas (précurseurs neurotransmetteurs)
- Glucides complexes (énergie stable)
- Légumes verts (magnésium, folates)
- Oléagineux (magnésium, tryptophane)

ÉVITER:
- Café après 14h (max 2 tasses/jour)
- Alcool (perturbe sommeil)
- Sucres rapides (yo-yo glycémique)
- Repas copieux le soir
- Écrans 1h avant coucher

RYTHME:
- Petit-déjeuner protéiné
- Déjeuner complet
- Dîner léger et tôt',

'- Rhodiola: éviter si trouble bipolaire
- Ashwagandha: prudence si hyperthyroïdie
- Ginseng: éviter si hypertension non contrôlée
- Adaptogènes: éviter si cancer hormono-dépendant
- Grossesse/allaitement: avis professionnel'),

-- ============================================
-- 5. PROTOCOLE HORMONAL FÉMININ
-- ============================================
(1, 'Équilibre hormonal féminin - Cycle', 'hormonal', 90,
'Protocole de rééquilibrage hormonal féminin naturel. Pour SPM, cycles irréguliers, préménopause. Approche sur 3 cycles minimum. Basé sur cours Phytologie Sphère Gynécologique.',

'- Régulariser les cycles menstruels
- Réduire les symptômes prémenstruels (SPM)
- Équilibrer le ratio œstrogènes/progestérone
- Soutenir la détox des œstrogènes
- Préparer la périménopause en douceur',

'[
  {
    "phase": 1,
    "nom": "Phase folliculaire (J1-J14)",
    "duree": "Répéter chaque cycle",
    "description": "Soutenir la phase œstrogénique et la maturation folliculaire",
    "actions": [
      "Plantes phytoestrogéniques douces",
      "Soutien hépatique (métabolisation œstrogènes)",
      "Alimentation riche en phytoestrogènes",
      "Exercice cardio modéré"
    ],
    "plantes": ["Trèfle rouge", "Sauge officinale (fin de phase)", "Houblon (si bouffées de chaleur)"],
    "huiles_essentielles": ["Sauge sclarée (œstrogen-like)"]
  },
  {
    "phase": 2,
    "nom": "Phase lutéale (J15-J28)",
    "duree": "Répéter chaque cycle",
    "description": "Soutenir la progestérone et calmer le SPM",
    "actions": [
      "Gattilier pour soutien progestérone-like",
      "Magnésium renforcé",
      "Onagre/Bourrache pour mastodynies",
      "Réduire sel et sucres (rétention)"
    ],
    "plantes": ["Gattilier (Vitex agnus-castus)", "Alchémille", "Achillée millefeuille"],
    "huiles_essentielles": ["Estragon (antispasmodique)", "Basilic exotique"]
  },
  {
    "phase": 3,
    "nom": "Phase menstruelle (J1-J5)",
    "duree": "Répéter chaque cycle",
    "description": "Soulager les douleurs et accompagner les règles",
    "actions": [
      "Plantes antispasmodiques",
      "Chaleur sur le bas-ventre",
      "Repos si possible",
      "Fer si règles abondantes"
    ],
    "plantes": ["Matricaire (Camomille allemande)", "Framboisier (feuilles)", "Gingembre"],
    "huiles_essentielles": ["Estragon", "Lavande vraie", "Ylang-ylang"]
  }
]',

'[
  {"nom": "Gattilier", "posologie": "400mg extrait sec le matin, phase lutéale ou tout le cycle", "duree": "3 cycles minimum"},
  {"nom": "Onagre ou Bourrache", "posologie": "1000-1500mg/jour phase lutéale", "duree": "Si mastodynies/SPM"},
  {"nom": "Magnésium", "posologie": "300mg/jour, augmenter à 400mg phase lutéale", "duree": "Continu"},
  {"nom": "Vitamine B6", "posologie": "50mg/jour (ou complexe B)", "duree": "Continu"},
  {"nom": "HE Sauge sclarée", "posologie": "2 gouttes en massage bas-ventre J5-J14, diluées dans HV", "duree": "Phase folliculaire"},
  {"nom": "HE Estragon", "posologie": "2 gouttes HV massage bas-ventre si douleurs", "duree": "Règles"}
]',

'ALIMENTATION HORMONALE:
- Crucifères (métabolisation œstrogènes): brocoli, chou, chou-fleur - 3x/semaine
- Phytoestrogènes doux: lin, soja fermenté (si toléré)
- Fibres (élimination œstrogènes): 30g/jour
- Oméga-3 anti-inflammatoires

PHASE FOLLICULAIRE (J1-J14):
- Légumes verts, graines germées
- Protéines maigres
- Aliments fermentés

PHASE LUTÉALE (J15-J28):
- Réduire sel (rétention)
- Limiter sucres (humeur)
- Magnésium++ (cacao, oléagineux)
- Glucides complexes (sérotonine)',

'- Sauge officinale: CI si cancer hormono-dépendant, grossesse
- Sauge sclarée HE: CI si antécédent cancer sein/utérus
- Gattilier: éviter si traitement hormonal, FIV
- Houblon: CI si cancer hormono-dépendant
- Grossesse: arrêter le protocole immédiatement'),

-- ============================================
-- 6. PROTOCOLE PEAU / ACNÉ
-- ============================================
(1, 'Peau nette - Accompagnement acné', 'peau', 90,
'Protocole naturopathique pour l''acné de l''adulte ou adolescent. Approche globale: détox hépatique, équilibre hormonal, microbiote cutané, alimentation anti-inflammatoire. Issu des cours Sphère Tégumentaire.',

'- Réduire l''inflammation cutanée
- Équilibrer la production de sébum
- Soutenir la détox hépatique (élimination cutanée)
- Rééquilibrer le microbiote cutané et intestinal
- Réduire les cicatrices et marques',

'[
  {
    "phase": 1,
    "nom": "Détox et nettoyage interne",
    "duree": "21 jours",
    "description": "Soulager le foie pour réduire l''élimination cutanée",
    "actions": [
      "Drainage hépatique doux (bardane, pensée sauvage)",
      "Éviction aliments pro-inflammatoires",
      "Hydratation +++ (2L eau/jour)",
      "Réduire produits laitiers et sucres"
    ],
    "plantes": ["Bardane (Arctium lappa)", "Pensée sauvage (Viola tricolor)", "Ortie"],
    "huiles_essentielles": ["Tea tree (application locale)"]
  },
  {
    "phase": 2,
    "nom": "Régulation et réparation",
    "duree": "45 jours",
    "description": "Équilibrer hormones et réparer la peau",
    "actions": [
      "Zinc pour régulation sébum",
      "Probiotiques pour axe intestin-peau",
      "Bardane en continu",
      "Soins locaux naturels (argile, hydrolats)"
    ],
    "plantes": ["Bardane", "Gattilier (si acné hormonale femme)", "Saw palmetto (si acné hormonale homme)"],
    "huiles_essentielles": ["Lavande vraie (cicatrisant)", "Géranium rosat", "Hélichryse (cicatrices)"]
  },
  {
    "phase": 3,
    "nom": "Consolidation",
    "duree": "24 jours",
    "description": "Maintenir les acquis et prévenir les rechutes",
    "actions": [
      "Alimentation anti-inflammatoire en routine",
      "Maintien zinc et probiotiques",
      "Soins locaux préventifs",
      "Gestion du stress (cortisol = sébum)"
    ],
    "plantes": ["Ortie (reminéralisante)", "Bardane (entretien)"],
    "huiles_essentielles": []
  }
]',

'[
  {"nom": "Zinc bisglycinate", "posologie": "15-30mg/jour au repas (15mg ado, 30mg adulte)", "duree": "3 mois minimum"},
  {"nom": "Probiotiques", "posologie": "Lactobacillus rhamnosus - 10 milliards/jour", "duree": "3 mois"},
  {"nom": "Oméga-3", "posologie": "1000-2000mg EPA+DHA/jour", "duree": "3 mois"},
  {"nom": "Bardane", "posologie": "Extrait sec 300mg 2x/jour ou décoction racine", "duree": "2-3 mois"},
  {"nom": "HE Tea tree", "posologie": "1 goutte pure sur bouton (coton-tige)", "duree": "Application locale ponctuelle"},
  {"nom": "Hydrolat Lavande ou Hamamélis", "posologie": "Brumisation visage matin et soir", "duree": "Quotidien"}
]',

'ÉVICTION STRICTE (phase 1):
- Produits laitiers (IGF-1 = sébum)
- Sucres raffinés et index glycémique haut
- Charcuterie, fritures
- Alcool

ALIMENTATION PEAU SAINE:
- Légumes colorés (antioxydants)
- Poissons gras 3x/semaine (oméga-3)
- Noix, graines (zinc, vitamine E)
- Eau +++, tisanes

ÉVITER AUSSI:
- Produits cosmétiques comédogènes
- Toucher le visage
- Soleil sans protection (rebond)',

'- Isotrétinoïne (Roaccutane): ne pas associer vitamine A
- Grossesse: pas de vitamine A haute dose, pas certaines HE
- Anticoagulants: prudence avec oméga-3 haute dose
- Gattilier: éviter si contraception hormonale'),

-- ============================================
-- 7. PROTOCOLE PERTE DE POIDS
-- ============================================
(1, 'Accompagnement perte de poids', 'poids', 90,
'Protocole naturopathique d''accompagnement à la perte de poids durable. Approche métabolique: équilibre glycémique, soutien thyroïdien, drainage, gestion du stress (cortisol). Sans régime restrictif.',

'- Relancer le métabolisme de base
- Équilibrer la glycémie (résistance insuline)
- Soutenir les émonctoires (élimination)
- Réduire l''inflammation de bas grade
- Gérer le stress et le sommeil (cortisol = stockage)',

'[
  {
    "phase": 1,
    "nom": "Rééquilibrage glycémique",
    "duree": "21 jours",
    "description": "Stabiliser la glycémie et réduire les fringales",
    "actions": [
      "Index glycémique bas à chaque repas",
      "Protéines au petit-déjeuner",
      "Chrome et cannelle si résistance insuline",
      "3 repas, pas de grignotage"
    ],
    "plantes": ["Gymnema sylvestre (envies sucré)", "Cannelle (glycémie)", "Fenugrec"],
    "huiles_essentielles": ["Citron (drainage)", "Genévrier (rétention)"]
  },
  {
    "phase": 2,
    "nom": "Activation métabolique",
    "duree": "45 jours",
    "description": "Stimuler le métabolisme et drainer",
    "actions": [
      "Drainage hépatique et rénal doux",
      "Activité physique régulière (30min/jour)",
      "Plantes thermogéniques si besoin",
      "Jeûne intermittent 16/8 si adapté"
    ],
    "plantes": ["Thé vert (EGCG)", "Guarana (caféine naturelle)", "Queue de cerise (drainage)"],
    "huiles_essentielles": ["Pamplemousse (drainage lymphatique)", "Cèdre de l''Atlas"]
  },
  {
    "phase": 3,
    "nom": "Stabilisation",
    "duree": "24 jours",
    "description": "Ancrer les nouvelles habitudes, éviter l''effet yoyo",
    "actions": [
      "Alimentation équilibrée pérenne",
      "Activité physique plaisir",
      "Gestion du stress",
      "Pas de restriction excessive"
    ],
    "plantes": ["Konjac (satiété si besoin)", "Nopal (capteur graisses repas festifs)"],
    "huiles_essentielles": []
  }
]',

'[
  {"nom": "Chrome", "posologie": "200µg/jour au repas", "duree": "3 mois"},
  {"nom": "Thé vert extrait", "posologie": "300-500mg EGCG/jour, matin et midi", "duree": "Phase 2 (pas le soir)"},
  {"nom": "CLA ou L-Carnitine", "posologie": "Selon produit, avant activité physique", "duree": "Phase 2"},
  {"nom": "Probiotiques minceur", "posologie": "Lactobacillus gasseri 10 milliards", "duree": "3 mois"},
  {"nom": "HE Pamplemousse", "posologie": "2 gouttes dans HV massage zones concernées", "duree": "Phase 2"},
  {"nom": "HE Cèdre Atlas", "posologie": "2 gouttes dans HV massage", "duree": "Phase 2, lipolyse"}
]',

'PRINCIPES ALIMENTAIRES:
- Protéines à chaque repas (satiété, muscles)
- Légumes 50% de l''assiette
- Glucides complexes IG bas
- Bonnes graisses (olive, avocat, poissons gras)
- Hydratation 2L/jour

PETIT-DÉJEUNER PROTÉINÉ:
- Œufs, fromage blanc, jambon
- Pain complet ou flocons d''avoine
- Oléagineux

ÉVITER:
- Sucres raffinés, sodas, jus de fruits
- Pain blanc, pâtes blanches
- Plats industriels
- Grignotage
- Alcool (calories vides + stockage)',

'- Thé vert/Guarana: éviter si troubles cardiaques, anxiété, insomnie
- Chrome: prudence si diabète traité (ajuster traitement)
- HE Pamplemousse: photosensibilisant (pas avant soleil)
- Grossesse/allaitement: pas de protocole restrictif
- Troubles alimentaires (anorexie, boulimie): accompagnement psy obligatoire'),

-- ============================================
-- 8. PROTOCOLE REMINÉRALISATION
-- ============================================
(1, 'Reminéralisation profonde', 'remineralisation', 60,
'Protocole de reminéralisation pour terrain déminéralisé: fatigue chronique, cheveux/ongles fragiles, crampes, ostéopénie. Apport minéraux + cofacteurs d''assimilation. Basé sur cours Micronutrition.',

'- Restaurer les réserves minérales de l''organisme
- Renforcer os, dents, cheveux, ongles
- Réduire crampes et fatigue musculaire
- Soutenir le système nerveux
- Alcaliniser le terrain',

'[
  {
    "phase": 1,
    "nom": "Bilan et correction urgente",
    "duree": "14 jours",
    "description": "Identifier et corriger les carences prioritaires",
    "actions": [
      "Magnésium haute dose",
      "Vitamine D si carence (très fréquent)",
      "Silicium organique",
      "Alimentation alcalinisante"
    ],
    "plantes": ["Prêle (silicium)", "Ortie (minéraux)", "Lithothamne (calcium naturel)"],
    "huiles_essentielles": []
  },
  {
    "phase": 2,
    "nom": "Reminéralisation active",
    "duree": "30 jours",
    "description": "Apport minéraux complet avec cofacteurs d''absorption",
    "actions": [
      "Complexe minéraux (mer ou algues)",
      "Vitamine K2 (fixation calcium sur os)",
      "Bore (métabolisme osseux)",
      "Activité physique en charge"
    ],
    "plantes": ["Bambou (silicium)", "Ortie", "Luzerne (alfalfa)"],
    "huiles_essentielles": []
  },
  {
    "phase": 3,
    "nom": "Entretien",
    "duree": "16 jours et +",
    "description": "Maintenir l''équilibre minéral par l''alimentation",
    "actions": [
      "Alimentation reminéralisante quotidienne",
      "Eau minérale adaptée (Hépar, Contrex)",
      "Cures saisonnières de reminéralisation",
      "Éviter les déminéralisants"
    ],
    "plantes": ["Ortie (infusion quotidienne possible)"],
    "huiles_essentielles": []
  }
]',

'[
  {"nom": "Magnésium bisglycinate", "posologie": "400mg/jour en 2 prises", "duree": "2 mois puis entretien"},
  {"nom": "Vitamine D3", "posologie": "2000-4000 UI/jour selon dosage", "duree": "Octobre à avril minimum"},
  {"nom": "Vitamine K2 MK7", "posologie": "100-200µg/jour", "duree": "Avec vitamine D"},
  {"nom": "Silicium organique", "posologie": "Selon produit (buvable ou gélules)", "duree": "2 mois"},
  {"nom": "Lithothamne ou Calcium marin", "posologie": "500-800mg calcium élément/jour", "duree": "Si apports alimentaires insuffisants"},
  {"nom": "Complexe trace minéraux", "posologie": "Plasma de Quinton ou eau de mer", "duree": "21 jours cure"}
]',

'ALIMENTS REMINÉRALISANTS:
- Algues: wakamé, kombu, nori (tous minéraux)
- Oléagineux: amandes (Ca), noix du Brésil (Se), graines courge (Zn)
- Légumes verts: épinards, chou kale (Ca, Mg)
- Sardines avec arêtes (Ca)
- Légumineuses (Fe, Zn)
- Cacao cru (Mg)
- Eau minérale (Hépar: Mg, Contrex: Ca)

COFACTEURS ABSORPTION:
- Vitamine C avec fer végétal
- Gras avec vitamines D, K
- Éviter thé/café au repas (chélateurs)

ÉVITER (acidifiants/déminéralisants):
- Excès protéines animales
- Sodas (acide phosphorique)
- Sucres raffinés
- Café en excès (>3/jour)
- Alcool',

'- Vitamine D: ne pas dépasser 4000UI/jour sans suivi médical
- Calcium: éviter si hypercalcémie, lithiase rénale calcique
- Vitamine K2: CI si anticoagulants AVK (Préviscan, Coumadine)
- Silicium: éviter si insuffisance rénale sévère
- Fer: uniquement si carence avérée');

SELECT CONCAT(COUNT(*), ' protocoles insérés') AS resultat FROM protocoles WHERE user_id = 1;
