<?php
/**
 * Base de suggestions PHV contextuelles
 * Chaque suggestion a :
 * - categorie : la section du PHV concernée
 * - tags : les profils pour lesquels cette suggestion est pertinente
 * - titre : titre court affiché sur le bouton
 * - contenu : texte inséré dans le textarea
 */

return [
    // ============================================
    // ALIMENTATION
    // ============================================
    [
        'categorie' => 'alimentation',
        'tags' => ['diabete', 'poids', 'metabolique'],
        'titre' => 'Index glycémique bas',
        'contenu' => "ALIMENTATION À INDEX GLYCÉMIQUE BAS :
- Privilégier : légumineuses, céréales complètes, légumes verts
- Éviter : pain blanc, riz blanc, pommes de terre, sucres rapides
- Associer protéines + fibres à chaque repas pour ralentir l'absorption
- Consommer les fruits entiers (pas en jus) en fin de repas"
    ],
    [
        'categorie' => 'alimentation',
        'tags' => ['diabete'],
        'titre' => 'Chrononutrition diabète',
        'contenu' => "CHRONONUTRITION ADAPTÉE :
- Petit-déjeuner protéiné (oeufs, fromage) - éviter le sucré
- Déjeuner : protéines + légumes + féculents complets (portion modérée)
- Collation 16h : oléagineux (amandes, noix) si besoin
- Dîner léger et tôt : légumes + petite protéine, sans féculents"
    ],
    [
        'categorie' => 'alimentation',
        'tags' => ['digestif', 'sii', 'ballonnements'],
        'titre' => 'Régime pauvre en FODMAPs',
        'contenu' => "RÉGIME PAUVRE EN FODMAPs :
Phase d'éviction (4-6 semaines) :
- Éviter : oignon, ail, blé, lait, pomme, poire, miel, champignons
- Privilégier : riz, quinoa, carottes, courgettes, banane mûre, oranges
- Protéines : viande, poisson, oeufs, tofu ferme

Phase de réintroduction : réintroduire 1 aliment à la fois sur 3 jours"
    ],
    [
        'categorie' => 'alimentation',
        'tags' => ['digestif', 'inflammation', 'permeabilite'],
        'titre' => 'Sans gluten',
        'contenu' => "ALIMENTATION SANS GLUTEN :
- Éviter : blé, orge, seigle, épeautre, kamut, avoine (sauf certifié)
- Remplacer par : riz, quinoa, sarrasin, millet, maïs, pomme de terre
- Attention aux sources cachées : sauces, charcuteries, plats préparés
- Durée conseillée : 3 mois minimum pour évaluer les effets"
    ],
    [
        'categorie' => 'alimentation',
        'tags' => ['digestif', 'inflammation'],
        'titre' => 'Sans produits laitiers',
        'contenu' => "ÉVICTION DES PRODUITS LAITIERS :
- Supprimer : lait de vache, yaourts, fromages, crème, beurre
- Alternatives : laits végétaux (amande, avoine, coco), yaourts végétaux
- Fromages de chèvre/brebis parfois mieux tolérés (à tester)
- Attention au calcium : sardines, amandes, légumes verts, eaux minérales"
    ],
    [
        'categorie' => 'alimentation',
        'tags' => ['inflammation', 'douleurs', 'articulaire'],
        'titre' => 'Anti-inflammatoire',
        'contenu' => "ALIMENTATION ANTI-INFLAMMATOIRE :
Privilégier :
- Poissons gras (sardines, maquereaux, saumon) 3x/semaine
- Huiles : olive, colza, noix, lin (crues)
- Épices : curcuma + poivre noir, gingembre
- Légumes colorés, baies, thé vert

Réduire/Éviter :
- Sucres raffinés, produits ultra-transformés
- Huiles de tournesol, maïs, fritures
- Viande rouge, charcuteries
- Alcool"
    ],
    [
        'categorie' => 'alimentation',
        'tags' => ['detox', 'hepatique', 'foie'],
        'titre' => 'Soutien hépatique',
        'contenu' => "ALIMENTATION DÉTOX HÉPATIQUE :
Privilégier :
- Crucifères : brocoli, chou, chou-fleur, radis noir
- Légumes amers : artichaut, endive, pissenlit
- Ail, oignon, citron
- Curcuma, romarin

Éviter :
- Alcool (strictement)
- Graisses cuites, fritures
- Excès de protéines animales
- Additifs, édulcorants"
    ],
    [
        'categorie' => 'alimentation',
        'tags' => ['stress', 'anxiete', 'nervosite'],
        'titre' => 'Alimentation anti-stress',
        'contenu' => "ALIMENTATION ANTI-STRESS :
Privilégier :
- Magnésium : oléagineux, chocolat noir 70%, légumineuses, banane
- Oméga-3 : poissons gras, huile de lin/colza, noix
- Tryptophane : dinde, oeufs, banane, chocolat noir
- Vitamines B : céréales complètes, légumes verts, levure de bière

Éviter :
- Café, thé fort (après 14h)
- Sucres rapides (pics glycémiques = stress)
- Alcool (perturbe le sommeil)"
    ],
    [
        'categorie' => 'alimentation',
        'tags' => ['menopause', 'hormonal', 'femme'],
        'titre' => 'Ménopause',
        'contenu' => "ALIMENTATION MÉNOPAUSE :
Privilégier :
- Phytoestrogènes : soja (si pas de CI), lin, lentilles
- Calcium : sardines, amandes, légumes verts, eaux calciques
- Oméga-3 : poissons gras, huile de colza
- Aliments riches en bore : pruneaux, raisins secs

Éviter/Limiter :
- Excitants (café, alcool) - bouffées de chaleur
- Sucres rapides - prise de poids
- Sel excessif - rétention"
    ],
    [
        'categorie' => 'alimentation',
        'tags' => ['immunite', 'infections'],
        'titre' => 'Soutien immunitaire',
        'contenu' => "ALIMENTATION IMMUNITÉ :
- Vitamine C : kiwi, agrumes, poivron, persil frais
- Zinc : huîtres, viande, graines de courge
- Vitamine D : poissons gras, oeufs (+ exposition soleil)
- Probiotiques naturels : choucroute crue, kéfir, miso
- Ail, oignon, gingembre, curcuma quotidiennement"
    ],
    [
        'categorie' => 'alimentation',
        'tags' => ['fatigue', 'anemie'],
        'titre' => 'Alimentation anti-fatigue',
        'contenu' => "ALIMENTATION ANTI-FATIGUE :
- Fer : viande rouge 2x/sem, boudin noir, lentilles + vitamine C
- B12 : viande, poisson, oeufs (si végétarien : supplémenter)
- Magnésium : oléagineux, chocolat noir, eaux magnésiennes
- Éviter les pics glycémiques (fatigue réactionnelle)
- Petit-déjeuner protéiné obligatoire"
    ],

    // ============================================
    // MENU TYPE
    // ============================================
    [
        'categorie' => 'menu_type',
        'tags' => ['general'],
        'titre' => 'Menu type équilibré',
        'contenu' => "PETIT-DÉJEUNER (protéiné) :
- 1-2 oeufs (mollets, brouillés) OU fromage chèvre/brebis
- Pain complet au levain + beurre ou avocat
- Fruit frais de saison
- Thé vert ou infusion

DÉJEUNER (repas principal) :
- Crudités + vinaigrette huile olive/colza
- Protéine : poisson, volaille, légumineuses
- Légumes cuits + féculents complets
- Huile d'olive en assaisonnement

COLLATION 16h (si faim) :
- Poignée d'oléagineux
- Fruit frais OU carré chocolat noir 70%

DÎNER (léger, 3h avant coucher) :
- Soupe ou légumes cuits vapeur
- Petite protéine légère (poisson blanc, oeuf)
- Éviter féculents lourds le soir"
    ],
    [
        'categorie' => 'menu_type',
        'tags' => ['diabete', 'metabolique'],
        'titre' => 'Menu type diabète',
        'contenu' => "PETIT-DÉJEUNER (sans sucre) :
- 2 oeufs + avocat OU fromage + jambon
- 1 tranche pain complet au levain (IG bas)
- Thé vert sans sucre

DÉJEUNER :
- Légumes verts en entrée
- Protéine (poisson, volaille, légumineuses)
- Petite portion féculents IG bas (lentilles, quinoa)
- Pas de dessert sucré

COLLATION 16h :
- 10 amandes + 1 carré chocolat 85%

DÎNER (tôt, sans féculents) :
- Grande portion de légumes
- Petite protéine
- Pas de fruit le soir"
    ],
    [
        'categorie' => 'menu_type',
        'tags' => ['digestif', 'sii'],
        'titre' => 'Menu type digestif sensible',
        'contenu' => "PETIT-DÉJEUNER :
- Porridge de riz ou sarrasin (sans lait)
- Banane bien mûre
- Infusion fenouil ou menthe

DÉJEUNER :
- Carottes râpées (bien mâcher)
- Poisson vapeur ou poulet
- Riz basmati + courgettes cuites
- Pas de crudités en excès

DÎNER (léger, 19h max) :
- Soupe de légumes mixée
- Poisson blanc ou oeuf
- Compote sans sucre ajouté

CONSEILS :
- Manger lentement, bien mâcher
- Éviter de boire pendant les repas
- Pas de fruits crus en fin de repas"
    ],

    // ============================================
    // PHYTOLOGIE
    // ============================================
    [
        'categorie' => 'phytologie',
        'tags' => ['diabete', 'glycemie'],
        'titre' => 'Plantes hypoglycémiantes',
        'contenu' => "PLANTES POUR LA GLYCÉMIE :
- Berbérine : 500mg 2-3x/jour avant repas (excellent régulateur)
- Gymnema sylvestre : 400mg/jour (réduit envies de sucre)
- Cannelle de Ceylan : 1-2g/jour ou en infusion
- Fenugrec : 2-5g graines/jour
- Olivier (feuilles) : en infusion ou extrait

Attention : surveiller la glycémie, risque d'hypoglycémie si traitement"
    ],
    [
        'categorie' => 'phytologie',
        'tags' => ['stress', 'anxiete', 'sommeil'],
        'titre' => 'Plantes calmantes',
        'contenu' => "PLANTES SYSTÈME NERVEUX :
Anxiété/Stress :
- Passiflore : anxiété, ruminations (infusion ou extrait)
- Valériane : tension nerveuse, insomnie (extrait sec)
- Mélisse : anxiété avec troubles digestifs
- Aubépine : palpitations liées au stress

Infusion du soir :
Tilleul + Mélisse + Camomille : 1 c.à.s. du mélange, 10 min infusion"
    ],
    [
        'categorie' => 'phytologie',
        'tags' => ['stress', 'fatigue', 'burnout'],
        'titre' => 'Plantes adaptogènes',
        'contenu' => "PLANTES ADAPTOGÈNES :
- Rhodiola : fatigue, stress, performances cognitives (matin)
- Ashwagandha : stress chronique, anxiété, sommeil
- Éleuthérocoque : fatigue, immunité, convalescence
- Ginseng : énergie, vitalité (éviter si HTA)
- Schisandra : équilibre nerveux, endurance

Cure de 1-3 mois, prendre le matin (sauf ashwagandha = soir possible)"
    ],
    [
        'categorie' => 'phytologie',
        'tags' => ['digestif', 'ballonnements', 'sii'],
        'titre' => 'Plantes digestives',
        'contenu' => "PLANTES DIGESTIVES :
Ballonnements/Gaz :
- Fenouil : carminatif, antispasmodique
- Anis vert : carminatif
- Cumin, carvi : en cuisine ou infusion

Spasmes/Douleurs :
- Mélisse : antispasmodique digestif et nerveux
- Menthe poivrée : (attention RGO) - en gélules gastro-résistantes pour SII

Transit :
- Constipation : mauve, guimauve (mucilages doux)
- Diarrhée : salicaire, potentille"
    ],
    [
        'categorie' => 'phytologie',
        'tags' => ['hepatique', 'detox', 'foie'],
        'titre' => 'Plantes hépatiques',
        'contenu' => "PLANTES SOUTIEN HÉPATIQUE :
Protection/Régénération :
- Chardon-marie (silymarine) : hépato-protecteur majeur
- Desmodium : régénération hépatocytes, post-chimio

Drainage/Détox :
- Artichaut : cholérétique, cholagogue
- Radis noir : drainage biliaire
- Pissenlit (racine) : détox hépatique et rénal
- Romarin : antioxydant hépatique

Cure détox : 3 semaines au changement de saison"
    ],
    [
        'categorie' => 'phytologie',
        'tags' => ['inflammation', 'douleurs', 'articulaire'],
        'titre' => 'Plantes anti-inflammatoires',
        'contenu' => "PLANTES ANTI-INFLAMMATOIRES :
- Curcuma + poivre noir : inflammation générale, articulaire
- Harpagophytum : douleurs articulaires, arthrose
- Reine des prés : anti-inflammatoire, antalgique (contient salicylés)
- Cassis (feuilles) : anti-inflammatoire, cortisone-like
- Boswellia : inflammation articulaire et intestinale

Association synergique : Curcuma + Boswellia + Harpagophytum"
    ],
    [
        'categorie' => 'phytologie',
        'tags' => ['menopause', 'hormonal', 'femme'],
        'titre' => 'Plantes ménopause',
        'contenu' => "PLANTES MÉNOPAUSE :
Bouffées de chaleur :
- Sauge officinale : anti-sudorifique, phytoestrogène
- Houblon : sédatif, phytoestrogène
- Actée à grappes noires (Cimicifuga) : régulateur hormonal

Humeur/Sommeil :
- Mélisse + Passiflore : anxiété, irritabilité
- Valériane : troubles du sommeil

CI : cancers hormonodépendants (sein, utérus) pour les phytoestrogènes"
    ],
    [
        'categorie' => 'phytologie',
        'tags' => ['immunite', 'infections', 'hiver'],
        'titre' => 'Plantes immunité',
        'contenu' => "PLANTES IMMUNOSTIMULANTES :
Prévention :
- Échinacée : stimulant immunitaire (cures de 3 semaines)
- Astragale : tonique immunitaire (usage long terme)
- Sureau (baies) : antiviral, prévention hivernale

Infection déclarée :
- Thym : anti-infectieux respiratoire majeur
- Propolis : antibactérien, antiviral
- Cyprès : antiviral

Convalescence :
- Éleuthérocoque + Ginseng : récupération"
    ],
    [
        'categorie' => 'phytologie',
        'tags' => ['circulation', 'jambes_lourdes'],
        'titre' => 'Plantes circulation',
        'contenu' => "PLANTES CIRCULATION VEINEUSE :
- Vigne rouge : tonique veineux, jambes lourdes
- Marronnier d'Inde : insuffisance veineuse, hémorroïdes
- Hamamélis : fragilité capillaire
- Petit houx (fragon) : jambes lourdes, hémorroïdes
- Ginkgo biloba : microcirculation, mémoire

En cure de 2-3 mois, renouvelable"
    ],

    // ============================================
    // AROMATHÉRAPIE
    // ============================================
    [
        'categorie' => 'aromatherapie',
        'tags' => ['stress', 'anxiete', 'sommeil'],
        'titre' => 'HE relaxantes',
        'contenu' => "HUILES ESSENTIELLES RELAXANTES :
Diffusion (20 min avant coucher) :
- Lavande vraie + Orange douce + Petit grain bigarade

Application cutanée :
- HE Lavande vraie : 2 gouttes pures sur poignets et plexus
- HE Camomille romaine : 1 goutte sur plexus (anxiété aiguë)

Bain relaxant :
- 10 gouttes HE Lavande dans 1 c.à.s. de base neutre

Olfaction :
- HE Ylang-ylang ou Néroli : respirer au flacon si stress"
    ],
    [
        'categorie' => 'aromatherapie',
        'tags' => ['digestif', 'ballonnements', 'nausees'],
        'titre' => 'HE digestives',
        'contenu' => "HUILES ESSENTIELLES DIGESTIVES :
Ballonnements/Digestion lente :
- HE Menthe poivrée : 1 goutte sur comprimé neutre après repas
- HE Basilic tropical : 1-2 gouttes en massage sur ventre (diluée)

Nausées :
- HE Citron ou Gingembre : respirer au flacon
- HE Menthe poivrée : 1 goutte sous la langue

Massage abdominal (dans 1 c.à.s. huile végétale) :
- 2 gttes Basilic + 2 gttes Menthe poivrée + 1 gte Estragon"
    ],
    [
        'categorie' => 'aromatherapie',
        'tags' => ['immunite', 'infections', 'hiver'],
        'titre' => 'HE anti-infectieuses',
        'contenu' => "HUILES ESSENTIELLES ANTI-INFECTIEUSES :
Prévention (diffusion 15 min 2x/jour) :
- Ravintsara + Eucalyptus radié + Citron

Infection respiratoire :
- HE Ravintsara : 2 gouttes 4x/jour sous plante des pieds
- HE Tea tree + Eucalyptus radié : inhalation

Mal de gorge :
- HE Tea tree : 2 gouttes dans miel, 3x/jour

Massage thorax/dos (dilué 20% dans HV) :
- Ravintsara + Eucalyptus radié + Niaouli"
    ],
    [
        'categorie' => 'aromatherapie',
        'tags' => ['douleurs', 'articulaire', 'musculaire'],
        'titre' => 'HE antidouleur',
        'contenu' => "HUILES ESSENTIELLES ANTIDOULEUR :
Douleurs musculaires :
- HE Gaulthérie : puissant anti-inflammatoire (diluer 10% dans HV)
- HE Eucalyptus citronné : anti-inflammatoire

Douleurs articulaires :
- HE Gaulthérie + Eucalyptus citronné + Genévrier (dilué 20%)
- Appliquer 2-3x/jour sur zone douloureuse

Maux de tête :
- HE Menthe poivrée : 1 goutte sur tempes (éviter yeux)

CI : Gaulthérie si anticoagulants, allergie aspirine"
    ],
    [
        'categorie' => 'aromatherapie',
        'tags' => ['menopause', 'hormonal'],
        'titre' => 'HE ménopause',
        'contenu' => "HUILES ESSENTIELLES MÉNOPAUSE :
Bouffées de chaleur :
- HE Sauge sclarée : 1-2 gouttes sur plexus ou bas-ventre (diluée)
- HE Menthe poivrée : effet rafraîchissant (1 gte nuque)

Équilibre émotionnel :
- HE Géranium rosat : équilibrant hormonal et nerveux
- HE Ylang-ylang : anxiété, irritabilité

Massage bas-ventre/lombaires :
- Dans 10ml HV : 5 gttes Sauge sclarée + 5 gttes Géranium

CI Sauge sclarée : cancers hormonodépendants"
    ],

    // ============================================
    // GEMMOTHÉRAPIE
    // ============================================
    [
        'categorie' => 'gemmotherapie',
        'tags' => ['stress', 'sommeil', 'nervosite'],
        'titre' => 'Bourgeons système nerveux',
        'contenu' => "GEMMOTHÉRAPIE SYSTÈME NERVEUX :
- Bourgeon de Tilleul : anxiété, insomnie, nervosité (15 gttes/jour)
- Bourgeon de Figuier : stress, somatisation digestive (15 gttes/jour)
- Bourgeon d'Aubépine : palpitations, émotivité (10-15 gttes/jour)

Association anti-stress :
Figuier + Tilleul : 10 gttes de chaque le soir

Cure de 3 semaines, renouveler si besoin"
    ],
    [
        'categorie' => 'gemmotherapie',
        'tags' => ['digestif', 'hepatique', 'detox'],
        'titre' => 'Bourgeons digestifs',
        'contenu' => "GEMMOTHÉRAPIE DIGESTIVE :
- Bourgeon de Noyer : dysbiose, diarrhées, candidose (15 gttes/jour)
- Bourgeon de Genévrier : détox hépatique et rénal (10 gttes/jour)
- Bourgeon de Romarin : drainage hépatobiliaire (15 gttes/jour)

Association détox :
Genévrier + Romarin : 10 gttes de chaque le matin à jeun

Cure de 3 semaines au changement de saison"
    ],
    [
        'categorie' => 'gemmotherapie',
        'tags' => ['inflammation', 'articulaire', 'allergies'],
        'titre' => 'Bourgeons anti-inflammatoires',
        'contenu' => "GEMMOTHÉRAPIE ANTI-INFLAMMATOIRE :
- Bourgeon de Cassis : cortisone-like, anti-inflammatoire puissant (15 gttes/jour)
- Bourgeon de Pin : articulations, reminéralisant (15 gttes/jour)
- Bourgeon de Vigne : articulations, inflammation (15 gttes/jour)

Association arthrose/douleurs :
Cassis + Pin + Vigne : 10 gttes de chaque le matin

Cure de 2-3 mois"
    ],
    [
        'categorie' => 'gemmotherapie',
        'tags' => ['immunite', 'infections'],
        'titre' => 'Bourgeons immunité',
        'contenu' => "GEMMOTHÉRAPIE IMMUNITÉ :
- Bourgeon de Rosier sauvage : immunité enfant et adulte (10-15 gttes/jour)
- Bourgeon d'Aulne glutineux : infections ORL, sinusites (15 gttes/jour)
- Bourgeon de Charme : voies respiratoires hautes (15 gttes/jour)

Prévention hivernale :
Rosier sauvage + Aulne : 10 gttes de chaque le matin

Commencer 1 mois avant l'hiver"
    ],
    [
        'categorie' => 'gemmotherapie',
        'tags' => ['menopause', 'hormonal', 'femme'],
        'titre' => 'Bourgeons féminins',
        'contenu' => "GEMMOTHÉRAPIE FÉMININE :
- Bourgeon de Framboisier : régulateur hormonal féminin (15 gttes/jour)
- Bourgeon de Pommier : bouffées de chaleur (15 gttes/jour)
- Bourgeon d'Airelle : ménopause, ostéoporose (15 gttes/jour)

Association ménopause :
Framboisier + Pommier + Airelle : 10 gttes de chaque le matin

Cure de 3 mois minimum"
    ],

    // ============================================
    // COMPLÉMENTS ALIMENTAIRES
    // ============================================
    [
        'categorie' => 'complements',
        'tags' => ['stress', 'anxiete', 'fatigue', 'sommeil'],
        'titre' => 'Magnésium',
        'contenu' => "MAGNÉSIUM :
- Forme : bisglycinate ou citrate (meilleure absorption)
- Posologie : 300-400mg/jour
- Moment : soir de préférence (effet relaxant)
- Durée : cure de 2-3 mois, renouvelable

Indications : stress, anxiété, crampes, fatigue, troubles du sommeil, SPM"
    ],
    [
        'categorie' => 'complements',
        'tags' => ['digestif', 'dysbiose', 'immunite'],
        'titre' => 'Probiotiques',
        'contenu' => "PROBIOTIQUES :
- Souches : Lactobacillus + Bifidobacterium (multi-souches)
- Posologie : 10-20 milliards UFC/jour
- Moment : le matin à jeun ou avant repas
- Durée : cure de 1-3 mois

Souches spécifiques :
- SII : L. plantarum, B. infantis
- Immunité : L. rhamnosus GG
- Après antibiotiques : S. boulardii"
    ],
    [
        'categorie' => 'complements',
        'tags' => ['digestif', 'permeabilite', 'sii'],
        'titre' => 'L-Glutamine',
        'contenu' => "L-GLUTAMINE :
- Posologie : 3-5g/jour
- Moment : à jeun le matin ou entre les repas
- Durée : cure de 6-8 semaines

Action : répare la muqueuse intestinale, réduit la perméabilité

Association recommandée : + Zinc + Vitamine A pour muqueuses"
    ],
    [
        'categorie' => 'complements',
        'tags' => ['fatigue', 'immunite', 'depression', 'os'],
        'titre' => 'Vitamine D',
        'contenu' => "VITAMINE D :
- Forme : D3 (cholécalciférol)
- Posologie : 2000-4000 UI/jour (selon dosage sanguin)
- Moment : pendant un repas avec graisses
- Durée : octobre à avril minimum, ou toute l'année si carence

Cible : taux sanguin entre 40-60 ng/ml

Association : + Vitamine K2 si forte dose (pour fixation calcium)"
    ],
    [
        'categorie' => 'complements',
        'tags' => ['inflammation', 'cardiovasculaire', 'depression', 'peau'],
        'titre' => 'Oméga-3',
        'contenu' => "OMÉGA-3 (EPA/DHA) :
- Posologie : 1-2g EPA+DHA/jour
- Forme : huile de poissons sauvages (qualité EPAX ou équivalent)
- Moment : pendant les repas
- Durée : cure de 3 mois minimum

Ratio conseillé :
- Inflammation/douleurs : EPA dominant
- Dépression/cerveau : DHA dominant
- Équilibre général : 50/50"
    ],
    [
        'categorie' => 'complements',
        'tags' => ['fatigue', 'anemie', 'femme', 'regles'],
        'titre' => 'Fer',
        'contenu' => "FER :
- Forme : bisglycinate de fer (moins d'effets secondaires)
- Posologie : 14-28mg/jour selon carence
- Moment : à jeun avec vitamine C (jus de citron)
- Durée : 3-6 mois selon dosage sanguin

Ne pas prendre avec : thé, café, produits laitiers, zinc (espacer 2h)

Contrôle ferritine après 3 mois"
    ],
    [
        'categorie' => 'complements',
        'tags' => ['immunite', 'peau', 'fertilite', 'thyroide'],
        'titre' => 'Zinc',
        'contenu' => "ZINC :
- Forme : bisglycinate ou citrate
- Posologie : 15-30mg/jour
- Moment : pendant un repas
- Durée : cure de 2-3 mois

Indications : immunité, peau/acné, fertilité, thyroïde, cicatrisation

Ne pas associer au fer (espacer les prises de 2h)"
    ],
    [
        'categorie' => 'complements',
        'tags' => ['diabete', 'glycemie', 'poids'],
        'titre' => 'Chrome',
        'contenu' => "CHROME :
- Forme : picolinate de chrome
- Posologie : 200-400 µg/jour
- Moment : avant les repas
- Durée : cure de 2-3 mois

Action : améliore sensibilité à l'insuline, réduit envies de sucre

Association : + Berbérine pour effet synergique sur glycémie"
    ],
    [
        'categorie' => 'complements',
        'tags' => ['hepatique', 'detox', 'foie'],
        'titre' => 'NAC + Glutathion',
        'contenu' => "NAC (N-Acétyl-Cystéine) :
- Posologie : 600-1200mg/jour
- Moment : à jeun
- Durée : cure de 4-6 semaines

Action : précurseur du glutathion, détoxification hépatique

Alternative : Glutathion liposomal 250-500mg/jour (absorption directe)"
    ],

    // ============================================
    // PROGRAMME DÉTOX 4R
    // ============================================
    [
        'categorie' => 'detox',
        'tags' => ['digestif', 'dysbiose', 'permeabilite', 'candidose'],
        'titre' => 'Programme 4R intestinal',
        'contenu' => "PROGRAMME 4R INTESTINAL :

1. RETIRER (2-4 semaines) :
- Éviction allergènes : gluten, laitages, sucres
- Antipathogènes : EPP, berbérine, ail

2. RÉPARER (4-6 semaines) :
- L-Glutamine 5g/jour
- Zinc 30mg/jour
- Vitamine A
- Aloe vera gel

3. RÉINOCULER (4-8 semaines) :
- Probiotiques multi-souches 20 milliards UFC
- Prébiotiques (FOS, inuline)

4. RENFORCER :
- Enzymes digestives si besoin
- HCl bétaïne si hypochlorhydrie
- Soutien hépatique"
    ],
    [
        'categorie' => 'detox',
        'tags' => ['hepatique', 'detox', 'foie'],
        'titre' => 'Cure détox hépatique',
        'contenu' => "CURE DÉTOX HÉPATIQUE (3 semaines) :

SEMAINE 1-2 - Préparation :
- Alimentation légère, sans alcool, bio
- Jus de citron tiède le matin
- Artichaut + Radis noir en EPS

SEMAINE 3 - Détox :
- Chardon-marie 200mg silymarine 3x/jour
- Desmodium 10ml/jour
- Bouillotte chaude sur le foie 20 min/soir

SOUTIEN :
- NAC 600mg/jour
- Antioxydants (Vit C, E, sélénium)

DRAINAGE :
- Pissenlit + Romarin en infusion
- Hydratation +++ (2L eau/jour)"
    ],
    [
        'categorie' => 'detox',
        'tags' => ['candidose', 'mycose'],
        'titre' => 'Protocole anti-candidose',
        'contenu' => "PROTOCOLE ANTI-CANDIDOSE (6-8 semaines) :

PHASE 1 - Affamer (2 semaines) :
- Régime sans sucres, sans levures, sans alcool
- Éviter : pain, pâtes blanches, fruits sucrés, champignons

PHASE 2 - Attaquer (4 semaines) :
- Extrait de pépins de pamplemousse
- Acide caprylique ou huile de coco
- Ail frais ou en gélules
- HE Origan (en gélules gastro-résistantes)

PHASE 3 - Restaurer :
- Probiotiques spécifiques (S. boulardii, L. rhamnosus)
- L-Glutamine pour muqueuse

ATTENTION : réaction Herxheimer possible (fatigue, maux de tête)"
    ],

    // ============================================
    // ROUTINES
    // ============================================
    [
        'categorie' => 'routine_matin',
        'tags' => ['general', 'detox', 'digestif'],
        'titre' => 'Routine réveil détox',
        'contenu' => "AU RÉVEIL :
1. Gratte-langue (5-7 passages) - élimine toxines de la nuit
2. Verre d'eau tiède + jus de citron (si bien toléré)
3. Auto-massage du ventre 2 min (sens horaire)
4. 5 min de respiration/étirements"
    ],
    [
        'categorie' => 'routine_matin',
        'tags' => ['stress', 'anxiete'],
        'titre' => 'Routine anti-stress matin',
        'contenu' => "ROUTINE MATIN ANTI-STRESS :
1. Réveil 15 min avant l'heure nécessaire (pas de précipitation)
2. Cohérence cardiaque 5 min (inspiration 5s / expiration 5s)
3. 3 intentions positives pour la journée
4. Petit-déjeuner calme, assis, sans écran"
    ],
    [
        'categorie' => 'routine_soir',
        'tags' => ['general', 'sommeil'],
        'titre' => 'Routine sommeil',
        'contenu' => "ROUTINE DU SOIR :
1. Dîner léger 3h avant coucher minimum
2. Écrans éteints 1h avant coucher
3. Tisane relaxante (tilleul, mélisse, camomille)
4. Lecture ou musique douce
5. Chambre fraîche (18°C), obscure, aérée"
    ],
    [
        'categorie' => 'routine_soir',
        'tags' => ['hepatique', 'detox', 'foie'],
        'titre' => 'Routine soir hépatique',
        'contenu' => "ROUTINE SOIR SOUTIEN HÉPATIQUE :
1. Dîner léger et tôt (19h max)
2. Infusion romarin ou artichaut après repas
3. Bouillotte chaude sur le foie 20 min (allongé côté droit)
4. Coucher avant 23h (régénération hépatique 1h-3h du matin)"
    ],

    // ============================================
    // ACTIVITÉ PHYSIQUE
    // ============================================
    [
        'categorie' => 'activite',
        'tags' => ['stress', 'anxiete', 'depression'],
        'titre' => 'Activité anti-stress',
        'contenu' => "ACTIVITÉ PHYSIQUE ANTI-STRESS :
Recommandées :
- Yoga : 2-3 séances/semaine (Hatha, Yin ou Nidra)
- Marche en nature : 30-45 min/jour
- Natation : effet relaxant de l'eau
- Tai Chi / Qi Gong : méditation en mouvement

À éviter :
- Sport intensif le soir (cortisol)
- Compétition (stress supplémentaire)

Idéal : marche 30 min après le déjeuner (baisse cortisol)"
    ],
    [
        'categorie' => 'activite',
        'tags' => ['diabete', 'poids', 'metabolique'],
        'titre' => 'Activité métabolisme',
        'contenu' => "ACTIVITÉ PHYSIQUE DIABÈTE/POIDS :
Essentiel :
- Marche après chaque repas (10-15 min) - régule glycémie
- 30 min activité modérée quotidienne minimum

Recommandé :
- Renforcement musculaire 2x/semaine (muscles = capteurs glucose)
- Endurance modérée : vélo, natation, marche rapide

Conseils :
- Progressif si reprise d'activité
- Surveiller glycémie avant/après au début
- Collation si sport > 1h"
    ],
    [
        'categorie' => 'activite',
        'tags' => ['articulaire', 'douleurs', 'inflammation'],
        'titre' => 'Activité articulations',
        'contenu' => "ACTIVITÉ PHYSIQUE DOULEURS ARTICULAIRES :
Recommandées (non traumatisantes) :
- Natation / Aquagym : pas de charge sur articulations
- Vélo (position adaptée)
- Marche sur terrain souple
- Yoga doux, Pilates
- Stretching / Mobilisations douces

À éviter :
- Course à pied (impact)
- Sports avec sauts
- Charges lourdes

Bouger même si douleur (immobilité = raideur)"
    ],

    // ============================================
    // GESTION STRESS
    // ============================================
    [
        'categorie' => 'stress',
        'tags' => ['stress', 'anxiete', 'general'],
        'titre' => 'Cohérence cardiaque',
        'contenu' => "COHÉRENCE CARDIAQUE :
Technique 365 :
- 3 fois par jour
- 6 respirations par minute
- 5 minutes

Pratique :
- Inspirer 5 secondes par le nez
- Expirer 5 secondes par la bouche
- 30 cycles = 5 minutes

Moments clés : au réveil, avant déjeuner, en fin d'après-midi

Applications : Respirelax, Kardia, RespiRelax+"
    ],
    [
        'categorie' => 'stress',
        'tags' => ['stress', 'anxiete', 'sommeil'],
        'titre' => 'Techniques relaxation',
        'contenu' => "TECHNIQUES DE RELAXATION :

Respiration 4-7-8 (endormissement) :
- Inspirer 4 secondes
- Retenir 7 secondes
- Expirer 8 secondes
- Répéter 4 cycles

Scan corporel (10 min) :
- Allongé, yeux fermés
- Parcourir le corps des pieds à la tête
- Relâcher chaque zone consciemment

Ancrage (anxiété aiguë) :
- 5 choses que je vois
- 4 choses que je touche
- 3 choses que j'entends
- 2 choses que je sens
- 1 chose que je goûte"
    ],

    // ============================================
    // EXAMENS BIOLOGIQUES
    // ============================================
    [
        'categorie' => 'examens',
        'tags' => ['fatigue', 'general'],
        'titre' => 'Bilan fatigue',
        'contenu' => "BILAN BIOLOGIQUE FATIGUE :
- NFS (anémie)
- Ferritine + fer sérique (carence martiale)
- Vitamine D (25-OH)
- TSH (thyroïde)
- Vitamine B12, B9
- Glycémie à jeun
- Ionogramme (Na, K, Mg)"
    ],
    [
        'categorie' => 'examens',
        'tags' => ['digestif', 'sii', 'permeabilite'],
        'titre' => 'Bilan digestif',
        'contenu' => "BILAN DIGESTIF :
Standard :
- Calprotectine fécale (inflammation)
- Coproculture + parasitologie

Approfondis (sur prescription spécialisée) :
- Zonuline (perméabilité intestinale)
- IgG alimentaires (intolérances)
- Test respiratoire SIBO
- Analyse du microbiote"
    ],
    [
        'categorie' => 'examens',
        'tags' => ['diabete', 'metabolique', 'poids'],
        'titre' => 'Bilan métabolique',
        'contenu' => "BILAN MÉTABOLIQUE :
- Glycémie à jeun
- HbA1c (moyenne glycémique 3 mois)
- Insulinémie à jeun (+ calcul HOMA-IR)
- Bilan lipidique complet
- Acide urique
- ASAT/ALAT (stéatose)
- CRP ultrasensible (inflammation)"
    ],
    [
        'categorie' => 'examens',
        'tags' => ['thyroide', 'fatigue', 'poids'],
        'titre' => 'Bilan thyroïdien',
        'contenu' => "BILAN THYROÏDIEN COMPLET :
- TSH
- T4 libre
- T3 libre
- Anticorps anti-TPO
- Anticorps anti-thyroglobuline

Si TSH anormale ou symptômes persistants malgré TSH normale"
    ],
    [
        'categorie' => 'examens',
        'tags' => ['hormonal', 'menopause', 'femme'],
        'titre' => 'Bilan hormonal femme',
        'contenu' => "BILAN HORMONAL FÉMININ :
Préménopause/Ménopause :
- FSH, LH
- Estradiol
- Progestérone (J21 si cycles)

Complémentaire :
- DHEA-S
- Testostérone
- SHBG
- Cortisol 8h"
    ],
    [
        'categorie' => 'examens',
        'tags' => ['stress', 'burnout', 'fatigue'],
        'titre' => 'Bilan stress/burnout',
        'contenu' => "BILAN STRESS / BURNOUT :
- Cortisol 8h (ou cortisol salivaire 4 points)
- DHEA-S
- Magnésium érythrocytaire
- Vitamine B6, B9, B12
- Fer, ferritine
- Vitamine D
- TSH"
    ],

    // ============================================
    // HYDROLOGIE
    // ============================================
    [
        'categorie' => 'hydrologie',
        'tags' => ['detox', 'circulation', 'stress'],
        'titre' => 'Bains et douches',
        'contenu' => "HYDROLOGIE :
Bain détox :
- Eau chaude 38-40°C + 500g sel d'Epsom (magnésium)
- 20 min, 1-2x/semaine
- Effet : détox, relaxation musculaire, magnésium transdermique

Douche écossaise :
- Alterner eau chaude (2 min) / eau froide (30 sec)
- Terminer par le froid
- Effet : circulation, tonus, immunité

Bain de pieds :
- Eau chaude + gros sel + HE Lavande
- 15-20 min le soir
- Effet : relaxation, améliore sommeil"
    ],
    [
        'categorie' => 'hydrologie',
        'tags' => ['digestif', 'constipation', 'detox'],
        'titre' => 'Irrigation colonique',
        'contenu' => "IRRIGATION COLONIQUE :
(chez un professionnel formé)

Indications :
- Constipation chronique
- Début de cure détox
- Ballonnements persistants

Fréquence : 1-3 séances espacées de 1-2 semaines

Alternative maison : lavement doux à l'eau tiède
- 500ml eau tiède
- Position allongée côté gauche
- Retenir quelques minutes

Après irrigation : restaurer flore avec probiotiques"
    ],

    // ============================================
    // ALIMENTATION SPORT & TERRAIN INFLAMMATOIRE (issues de cas pratiques PHV)
    // ============================================
    [
        'categorie' => 'alimentation',
        'tags' => ['sportif', 'inflammation', 'douleurs', 'articulaire'],
        'titre' => 'Alimentation anti-inflammatoire sportif blessé',
        'contenu' => "ALIMENTATION SPORTIF - BLESSURES À RÉPÉTITION :
- Petit-déjeuner protéiné impératif (œufs, jambon qualité, saumon fumé) + glucides complexes (pain complet au levain, flocons d'avoine)
- Limiter 3 mois : produits laitiers et gluten industriel (terrain pro-inflammatoire)
- Protéines variées à chaque repas : varier viandes blanches, poissons gras 2-3x/sem, légumineuses
- Grande portion de légumes variés midi ET soir (pas seulement crudités râpées)
- Bien mastiquer (30x/bouchée) pour soutenir la digestion
- Après l'effort : boisson de récupération (eau + électrolytes + protéines), pas d'alcool"
    ],
    [
        'categorie' => 'activite',
        'tags' => ['sportif', 'articulaire', 'douleurs'],
        'titre' => 'Prévention des blessures : étirements et renforcement',
        'contenu' => "PROGRAMME PRÉVENTION BLESSURES SPORTIF :
- Étirements quotidiens 15-20 min, même les jours sans entraînement (ischios, mollets, tendon d'Achille, adducteurs, psoas, quadriceps, dos)
- Jamais d'étirement juste après l'effort intense (2h après ou le lendemain)
- Renforcement musculaire 2x/semaine 30-40 min : squats, fentes, gainage, pont fessier, proprioception (équilibre sur 1 pied, plateau instable)
- Automassages voûte plantaire / zones sensibles au réveil et au coucher (balle de tennis, 5-10 min)
- Consultation kiné du sport et vérification des chaussures/semelles si douleurs récurrentes"
    ],
    [
        'categorie' => 'complements',
        'tags' => ['articulaire', 'douleurs', 'sportif'],
        'titre' => 'Collagène et curcuma - tendons, ligaments, articulations',
        'contenu' => "PROTOCOLE TENDONS / LIGAMENTS / ARTICULATIONS :
- Collagène marin : cure d'attaque 20g/j pendant 2 mois puis entretien 10g/j pendant 2 mois (confort articulaire, tendons, ligaments, tissus conjonctifs)
- Curcuma : 3 gélules/j pendant 1 mois minimum (réduction inflammation, douleurs articulaires/tendineuses)
- Magnésium bisglycinate : prévention des crampes et récupération musculaire
- Vitamine D3/K2 : minéralisation osseuse et construction des tendons/ligaments
- Phytothérapie : Harpagophytum (griffe du diable) en cure d'attaque 3 semaines puis entretien - anti-inflammatoire pour tendinites, entorses, arthrose"
    ],
    [
        'categorie' => 'stress',
        'tags' => ['sportif', 'stress', 'sommeil'],
        'titre' => 'Respiration carrée pour sportif réservé/stress contenu',
        'contenu' => "RESPIRATION CARRÉE - GESTION DU STRESS CONTENU :
- Méthode : 4 sec inspiration + 4 sec rétention + 4 sec expiration + 4 sec rétention
- Fréquence : 2-3x/jour, 5 minutes (matin, avant l'effort, soir avant coucher)
- Utile chez les profils qui minimisent leur stress ressenti (fatigue post-prandiale, coups de mou inexpliqués = signes de stress latent)
- Bénéfices : anti-stress, gestion des émotions contenues, amélioration du sommeil et de la concentration
- Orientation possible vers un(e) sophrologue pour libérer les tensions émotionnelles accumulées"
    ],

    // ============================================
    // FERTILITÉ, AUTO-IMMUNITÉ & ÉPUISEMENT SURRÉNALIEN
    // ============================================
    [
        'categorie' => 'alimentation',
        'tags' => ['fertilite', 'thyroide', 'hormonal', 'inflammation'],
        'titre' => 'Alimentation sans gluten - terrain auto-immun et fertilité',
        'contenu' => "ALIMENTATION SANS GLUTEN - AUTO-IMMUNITÉ / FERTILITÉ :
- Éviction impérative du gluten (lien auto-immunité thyroïdienne / fausses couches à répétition)
- Remplacer par : pâtes riz/maïs/sarrasin, pain sans gluten, sarrasin, quinoa, patate douce
- Remplacer les féculents à IG haut par : riz basmati, quinoa, sarrasin, patate douce, courges
- Ajouter des fibres à chaque repas : légumes variés, légumineuses, fruits, oléagineux
- Curcuma + poivre noir, sélénium (graines de sésame) en soutien thyroïdien
- Dîner : protéines de qualité + féculents à IG bas + légumes"
    ],
    [
        'categorie' => 'phytologie',
        'tags' => ['immunite', 'inflammation', 'hormonal'],
        'titre' => 'TM Astragale + Sureau - modulation immunitaire (Treg)',
        'contenu' => "PHYTOTHÉRAPIE MODULATION IMMUNITAIRE :
- TM Astragale + TM Sureau : 5 mL dans un verre d'eau matin et soir avant les repas
- Objectif : augmenter les lymphocytes T régulateurs (Treg) pour moduler une auto-immunité
- Astragale : immunomodulateur doux, adaptogène
- Sureau : immunorégulateur, anti-inflammatoire
- Cure de 3 semaines à réévaluer avant renouvellement"
    ],
    [
        'categorie' => 'complements',
        'tags' => ['fertilite', 'hormonal', 'thyroide'],
        'titre' => 'Protocole micronutrition fertilité et auto-immunité',
        'contenu' => "MICRONUTRITION - SOUTIEN FERTILITÉ / AUTO-IMMUNITÉ THYROÏDIENNE :
- Vitamine D3/K2 : 3 gouttes/j le matin, après dosage sanguin
- Sélénium : 200 µg/j en cure de 3 mois (cofacteur T4→T3, peut réduire les anticorps anti-TPO)
- Zinc : selon bilan biologique (immunité, fertilité, barrière intestinale)
- Oméga-3 EPA/DHA : 3 gélules/j le soir (anti-inflammatoire, qualité des ovocytes, humeur)
- Magnésium B6 : 3 gélules/j fractionnées (anxiété, stress, soutien surrénalien)
- Toujours demander un bilan thyroïdien complet et un dosage de vitamine D avant complémentation"
    ],
    [
        'categorie' => 'stress',
        'tags' => ['fatigue', 'burnout', 'hormonal'],
        'titre' => 'Luminothérapie et soutien des surrénales',
        'contenu' => "SOUTIEN SURRÉNALIEN - ÉPUISEMENT / CORTISOL BAS :
- Luminothérapie ou exposition à la lumière naturelle : 20 minutes le matin (boost cortisol naturel)
- Aromathérapie surrénales : HE Pin sylvestre + HE Épinette noire en olfaction/diffusion le matin, 10 min
- Objectif coucher : avancer l'horaire pour gagner en sommeil réparateur (viser 22h30 max)
- Envisager une réduction de la charge de travail (délégation) en parallèle
- Sophrologie en soutien de la gestion du stress chronique"
    ],
    [
        'categorie' => 'complements',
        'tags' => ['anemie', 'fatigue', 'femme'],
        'titre' => 'Carence martiale : ferritine liposomale et lactoferrine',
        'contenu' => "PROTOCOLE CARENCE MARTIALE (ferritine basse) :
- Ferritine liposomale + lactoferrine à jeun le matin, cure à évaluer selon dosage
- Alimentaire : associer les aliments riches en fer (viande, boudin, légumineuses, légumes verts, oléagineux) à de la vitamine C pour l'absorption
- Limiter les chélateurs du fer autour des repas riches en fer : thé, café, produits laitiers
- Toujours objectiver par un dosage sanguin (ferritine) avant et après la cure"
    ],

    // ============================================
    // ÉQUILIBRE HORMONAL FÉMININ & DOULEURS MENSTRUELLES
    // ============================================
    [
        'categorie' => 'aromatherapie',
        'tags' => ['regles', 'douleurs', 'femme'],
        'titre' => 'Massage HE douleurs menstruelles',
        'contenu' => "MASSAGE AROMATHÉRAPIE - DOULEURS MENSTRUELLES :
- 2 gouttes HE Gaulthérie couchée (anti-inflammatoire, antalgique)
- + 2 gouttes HE Camomille romaine (spasmolytique, apaisante)
- Diluées dans 1 c.à.c. d'huile végétale (millepertuis ou noyau d'abricot)
- Massage abdominal en cercles dans le sens des aiguilles d'une montre
- 2-3 fois par jour pendant les règles, peut être commencé 2 jours avant
- Associer une bouillotte chaude sur le ventre dès les premières douleurs"
    ],
    [
        'categorie' => 'phytologie',
        'tags' => ['hormonal', 'regles', 'femme'],
        'titre' => 'TM Achillée millefeuille + Curcuma - balance œstro-progestative',
        'contenu' => "PHYTOTHÉRAPIE BALANCE ŒSTROGÈNES / PROGESTÉRONE :
- TM Achillée millefeuille + Curcuma en synergie
- 5 mL dans un verre d'eau matin et soir avant les repas
- Achillée millefeuille : emménagogue, régule le cycle, anti-inflammatoire pelvienne
- Curcuma : anti-inflammatoire puissant, soutien hépatique (métabolisme des œstrogènes)
- Cure de 3 semaines, à renouveler selon les symptômes
- Compléter par de l'huile d'onagre en 2e partie de cycle (SPM, douleurs menstruelles)"
    ],
    [
        'categorie' => 'stress',
        'tags' => ['anxiete', 'sommeil', 'femme'],
        'titre' => 'Cohérence cardiaque contre cauchemars et anxiété (GABA)',
        'contenu' => "COHÉRENCE CARDIAQUE - ANXIÉTÉ / CAUCHEMARS FRÉQUENTS :
- Protocole 5-5-5 : inspirer 5 secondes, retenir 5 secondes, expirer 5 secondes
- 3 fois par jour, particulièrement le soir avant le coucher
- Particulièrement efficace contre les cauchemars fréquents (active le système GABA)
- Applications gratuites : RespiRelax, Kardia
- Compléter par des techniques d'ancrage (5 sens : 5-4-3-2-1) et la lecture avant le sommeil plutôt que les écrans"
    ],
    [
        'categorie' => 'alimentation',
        'tags' => ['inflammation', 'permeabilite', 'sii', 'poids'],
        'titre' => 'Alimentation anti-inflammatoire à petit budget',
        'contenu' => "ALIMENTATION ANTI-INFLAMMATOIRE - PETIT BUDGET :
- Tester l'éviction du gluten 4 semaines : pâtes riz/maïs (marques économiques), pain maison au maïs
- Remplacer les yaourts vache par des yaourts végétaux (coco, soja) - prix comparables
- Remplacer la viande rouge par des légumineuses (lentilles, pois chiches) et du poisson en conserve (sardines, maquereaux) - économique et riche en oméga-3
- Légumes surgelés : aussi nutritifs que le frais et moins coûteux
- Curcuma, gingembre frais, graines de lin moulues : petits prix, grand impact anti-inflammatoire
- Prioriser les compléments à fort impact (oméga-3, magnésium) plutôt qu'une multiplication de produits"
    ],

    // ============================================
    // PEAU, HORMONES ET ADOLESCENCE
    // ============================================
    [
        'categorie' => 'complements',
        'tags' => ['peau', 'digestif'],
        'titre' => 'Cure de chlorophylle - transit et peau',
        'contenu' => "CURE DE CHLOROPHYLLE - ACNÉ / CONSTIPATION :
- Posologie : 10 gouttes pendant 3 jours puis 20 gouttes jusqu'à amélioration du transit
- Cure d'environ 1 mois
- Actions sur l'acné : réduit l'inflammation cutanée, protège contre l'oxydation du sébum, détoxifie le foie (moins d'hormones en excès), soutient la flore intestinale
- Actions sur la constipation : stimule en douceur le transit, protège et répare l'intestin, améliore la flore"
    ],
    [
        'categorie' => 'complements',
        'tags' => ['peau', 'hormonal'],
        'titre' => 'Zinc + probiotiques + ortie - acné hormonale',
        'contenu' => "PROTOCOLE ACNÉ INFLAMMATOIRE HORMONALE (3 mois) :
- Zinc : régule la production de sébum, anti-inflammatoire et antibactérien, favorise la cicatrisation, module les androgènes
- Probiotiques : rééquilibrent le microbiote intestinal (axe intestin-peau), modulent l'immunité cutanée, restaurent la barrière cutanée
- Ortie : dépurative (foie et reins), anti-inflammatoire, modulation des androgènes
- Posologie type : 2 gélules le matin avant le petit-déjeuner
- Compléter par une huile d'onagre/bourrache (GLA) en 2e intention pour la régulation hormonale et l'hydratation cutanée"
    ],
    [
        'categorie' => 'alimentation',
        'tags' => ['peau', 'inflammation', 'hormonal'],
        'titre' => 'Rééquilibrage alimentaire acné adolescent',
        'contenu' => "ALIMENTATION ANTI-ACNÉ (ADOLESCENT) :
- Petit-déjeuner protéiné et lipidique obligatoire (œufs + pain complet + fromage OU porridge yaourt + flocons d'avoine + fruits rouges + oléagineux)
- Répartition assiette midi et soir : 50% légumes (crus + cuits), 25% protéines, 15% glucides complexes, 10% bons gras
- Diminuer drastiquement les sucres raffinés (bonbons, sodas, viennoiseries, gâteaux industriels)
- Réduire les protéines animales excessives - viande rouge maximum 3x/mois, privilégier poissons gras 2-3x/semaine
- Huiles riches en oméga-3 (colza, chanvre, lin) : 2 c.à.s./jour
- Coucher plus tôt (22h/22h30) et écrans coupés dès 21h"
    ],

    // ============================================
    // FEMME SPORTIVE : REPRISE, TFL, POST-PARTUM
    // ============================================
    [
        'categorie' => 'activite',
        'tags' => ['sportif', 'articulaire', 'femme'],
        'titre' => 'Renforcement musculaire prévention TFL (syndrome essuie-glace)',
        'contenu' => "PRÉVENTION TENDINOPATHIE TFL - COUREUSE :
- Renforcement 2x/semaine, 20-30 min : abducteurs de hanche (coquillages, élastique), fessiers ++ (pont fessier, squats, fentes), gainage central (planche, superman)
- Reprise progressive : ne jamais augmenter les distances de plus de 10%/semaine
- Étirements post-séance : quadriceps, fessiers, TFL
- Massage TFL à la balle : balle caoutchouc ferme allongée sur le côté, 10-12 pressions progressives
- Cataplasme d'argile verte sur la zone douloureuse la nuit si besoin
- HE Gaulthérie couchée diluée en huile végétale (calophylle), massage local 3x/j sur la zone"
    ],
    [
        'categorie' => 'hydrologie',
        'tags' => ['sportif'],
        'titre' => 'Hydratation à l\'effort - calcul et repères',
        'contenu' => "HYDRATATION À L'EFFORT :
- Gourde systématique même pour les sorties courtes
- Boire toutes les 15 minutes par petites gorgées
- Minimum 500 mL par heure d'entraînement
- Électrolytes ou boisson isotonique pour les efforts de plus d'1h
- Calcul post-effort : (poids avant - poids après) × 1,5 = mL à boire pour compenser la perte
- Au quotidien : 1er verre d'eau au lever, avant toute autre boisson, en dehors des repas"
    ],
    [
        'categorie' => 'phytologie',
        'tags' => ['articulaire', 'hormonal', 'douleurs'],
        'titre' => 'Ortie piquante - reminéralisant tendons et hormones',
        'contenu' => "ORTIE PIQUANTE - REMINÉRALISATION ET SOUTIEN HORMONAL :
- 5 mL dans un verre d'eau, matin et soir avant les repas
- Cure de 3 semaines, renouvelable
- Riche en silice : soutient les tendons, douleurs articulaires
- Riche en fer : intéressant en cas de fatigue/anémie associée
- Action hormonale bénéfique documentée en complément d'un rééquilibrage alimentaire
- Bien adaptée en période de reprise sportive post-partum ou de charge d'entraînement élevée"
    ],
    [
        'categorie' => 'routine_matin',
        'tags' => ['sportif', 'general'],
        'titre' => 'Méthode SMART et journal de bord - reprise progressive',
        'contenu' => "REPRISE D'ACTIVITÉ PROGRESSIVE - MÉTHODE SMART :
- Formuler des objectifs Spécifiques, Mesurables, Atteignables, Réalistes, Temporellement définis
- Exemple : « Je marche 30 min, 3x/semaine pendant 15 jours »
- Tenir un journal de bord quotidien : activités physiques (durée, ressenti), alimentation et hydratation du jour, émotions et état général, progrès observés
- Utile pour maintenir la motivation et objectiver les progrès sur les prises en charge de longue durée (fatigue, reprise sportive, rééquilibrage alimentaire)"
    ],

    // ============================================
    // SYSTÈME NERVEUX, ALIMENTATION ÉMOTIONNELLE & FOIE
    // ============================================
    [
        'categorie' => 'stress',
        'tags' => ['depression', 'digestif', 'stress'],
        'titre' => 'Respiration yogique complète contre les pulsions sucrées',
        'contenu' => "RESPIRATION YOGIQUE COMPLÈTE - PULSIONS ÉMOTIONNELLES :
- Pratiquer allongé(e) sur le dos, 5-10 minutes
- Inspiration abdominale (le ventre monte) → thoracique (la poitrine monte) → claviculaire
- Expiration : vider le ventre puis la poitrine progressivement
- Objectif : oxygénation cellulaire, détente nerveuse, massage interne des organes
- À utiliser comme alternative au grignotage émotionnel en cas de pulsion sucrée ou de stress"
    ],
    [
        'categorie' => 'alimentation',
        'tags' => ['digestif', 'hormonal', 'stress', 'poids'],
        'titre' => 'Alimentation soutien neurotransmetteurs et glycémie stable',
        'contenu' => "ALIMENTATION SOUTIEN HUMEUR / GLYCÉMIE STABLE :
- Protéines à chaque repas (précurseurs de sérotonine et dopamine)
- Remplacer les bonbons/grignotages par du chocolat noir 70%+ ou une compote sans sucre
- Limiter le café à 1/jour, réduire l'alcool progressivement
- Curcuma (anti-inflammatoire) et cannelle (régule les pulsions sucrées) à intégrer au quotidien
- Fibres et légumes à chaque repas : la moitié de l'assiette, pour drainer les œstrogènes en excès (constipation = mauvaise élimination hormonale)
- Repas ritualisés, assis, sans écran, avec mastication prolongée"
    ],
    [
        'categorie' => 'phytologie',
        'tags' => ['hepatique', 'hormonal', 'stress'],
        'titre' => 'Mélisse + Chardon-Marie - détox hépatique et apaisement',
        'contenu' => "PHYTOTHÉRAPIE FOIE ET SYSTÈME NERVEUX :
- Mélisse (2/3) + Chardon-Marie (1/3) en synergie
- 5 mL dans un verre d'eau, matin et soir avant les repas
- Mélisse : détente du système nerveux, antispasmodique digestif
- Chardon-Marie : soutien hépatique doux, aide au métabolisme des œstrogènes en excès
- Cure de 3 semaines
- Particulièrement indiqué en cas d'hyperœstrogénie relative associée à un stress chronique"
    ],
];
