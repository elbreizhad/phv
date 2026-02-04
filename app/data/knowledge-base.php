<?php
/**
 * Base de connaissances naturopathiques
 * Extraites des cours PHV - Modules 1 à 6
 *
 * Structure pour le système de suggestions contextuelles
 */

/**
 * Retourne la base de connaissances complète
 */
function getKnowledgeBase(): array {
    return [
        // ==========================================
        // ALIMENTATION & NUTRITION (Module 4)
        // ==========================================
        'alimentation' => [
            'principes_generaux' => [
                'mastication' => "Mastiquer chaque bouchée 20 à 30 fois. La digestion commence dans la bouche grâce à l'amylase salivaire. Une bonne mastication réduit le travail gastrique et intestinal.",
                'hydratation' => "Boire 1,5 à 2L d'eau par jour, en dehors des repas (arrêter 30 min avant et reprendre 1h après). Eau faiblement minéralisée (résidu sec < 150mg/L). Éviter l'eau froide qui ralentit la digestion.",
                'fractionnement' => "3 repas principaux + 1 collation si besoin. Ne pas sauter le petit-déjeuner (idéalement protéiné). Dîner léger au moins 3h avant le coucher.",
                'associations' => "Éviter de mélanger protéines animales et féculents dans le même repas (digestion difficile). Commencer le repas par des crudités (enzymes). Fruits en dehors des repas.",
                'cuisson' => "Privilégier les cuissons douces : vapeur, étouffée, pochage. Éviter les fritures et le micro-ondes. Température < 100°C pour préserver les nutriments.",
                'bio_local' => "Privilégier les aliments bio, locaux et de saison. Réduire les produits ultra-transformés (NOVA 4).",
            ],
            'chronobiologie' => [
                'matin' => "7h-12h : Phase catabolique. Petit-déjeuner protéiné et gras (œufs, avocat, oléagineux, fromage). Éviter les sucres rapides qui provoquent un pic d'insuline suivi d'hypoglycémie.",
                'midi' => "12h-14h : Pic enzymatique digestif. Repas principal de la journée. Protéines + légumes + céréales complètes. Moment idéal pour les aliments plus lourds.",
                'apres_midi' => "16h-17h : Collation possible si besoin. Fruits frais, oléagineux, chocolat noir 70%. Éviter les grignotages entre les repas.",
                'soir' => "19h-20h : Repas léger, digeste. Légumes cuits, soupe, poisson blanc. Éviter les protéines animales lourdes et les crudités (fermentation nocturne).",
            ],
            'regimes_specifiques' => [
                'anti_inflammatoire' => "Oméga-3 (petits poissons gras, lin, noix), curcuma + poivre noir, gingembre, fruits rouges, légumes colorés, huile d'olive. Réduire oméga-6 (huiles tournesol, maïs), viandes rouges, sucres.",
                'fodmaps' => "Phase d'élimination (2-6 sem) puis réintroduction progressive. Éviter : oignon, ail, blé, lactose, pomme, poire, légumineuses. Toléré : riz, quinoa, banane mûre, courgette, carotte, épinard.",
                'sans_gluten' => "Remplacer blé par riz, sarrasin, quinoa, millet, amarante. Attention au gluten caché (sauces, charcuterie). Privilégier les aliments naturellement sans gluten.",
                'hypotoxique' => "Suppression temporaire : gluten, produits laitiers, sucres raffinés, cuissons haute température. Durée : 3-4 semaines minimum pour évaluer les effets.",
            ],
            'aliments_therapeutiques' => [
                'probiotiques_naturels' => "Choucroute crue, kimchi, kéfir, kombucha, miso, tempeh. Introduire progressivement pour éviter les ballonnements.",
                'prebiotiques' => "Ail, oignon, poireau, asperge, banane verte, chicorée, topinambour. Nourrissent les bonnes bactéries intestinales.",
                'superaliments' => "Spiruline (protéines, fer), chlorelle (détox métaux lourds), curcuma (anti-inflammatoire), gingembre (digestif), ail (antibactérien).",
                'bouillon_os' => "Riche en collagène, glutamine, glycine. Répare la muqueuse intestinale. Cuisson longue (12-24h) à feu doux.",
            ],
        ],

        // ==========================================
        // GESTION DU STRESS (Module 2)
        // ==========================================
        'stress' => [
            'comprendre' => [
                'phases' => "1. Alarme (adrénaline) - 2. Résistance (cortisol) - 3. Épuisement. Le stress chronique maintient un cortisol élevé qui déséquilibre tous les systèmes.",
                'impacts' => "Système digestif (perméabilité intestinale, SII), immunité (inflammation), hormones (thyroïde, surrénales), sommeil, humeur, peau.",
                'lien_intestin' => "Axe intestin-cerveau : 95% de la sérotonine est produite dans l'intestin. Le stress altère le microbiote et la perméabilité intestinale.",
            ],
            'techniques' => [
                'respiration_ventrale' => "Inspirer 4 sec par le nez (ventre se gonfle), bloquer 4 sec, expirer 6 sec par la bouche (ventre rentre). 5 min matin et soir. Active le système parasympathique.",
                'coherence_cardiaque' => "5 sec inspiration, 5 sec expiration, pendant 5 minutes, 3 fois par jour (365). Régule le système nerveux autonome, réduit cortisol et tension.",
                'relaxation_jacobson' => "Contracter puis relâcher chaque groupe musculaire (10 sec contraction, 20 sec relâchement). Du bas vers le haut du corps.",
                'ancrage' => "Technique 5-4-3-2-1 : nommer 5 choses vues, 4 entendues, 3 touchées, 2 senties, 1 goûtée. Ramène au moment présent.",
                'visualisation' => "Imaginer un lieu ressource (plage, forêt, montagne). Activer tous les sens. 10-15 min dans un endroit calme.",
            ],
            'hygiene_vie' => [
                'sommeil' => "Coucher et lever à heures fixes. Éviter écrans 1h avant. Chambre fraîche (18°C), sombre, sans appareil électronique.",
                'nature' => "30 min de marche en nature par jour si possible. Le contact avec la nature (arbres, terre) réduit le cortisol.",
                'limites' => "Apprendre à dire non. Identifier les sources de stress évitables. Déléguer. Prendre des pauses régulières.",
                'social' => "Maintenir des relations sociales positives. Éviter les personnes toxiques. Partager ses émotions.",
            ],
        ],

        // ==========================================
        // ACTIVITÉ PHYSIQUE (Module 5)
        // ==========================================
        'activite_physique' => [
            'bienfaits' => [
                'metabolisme' => "Améliore la sensibilité à l'insuline, stimule la lipolyse, augmente le métabolisme de base, régule l'appétit.",
                'stress' => "Libère des endorphines (hormones du bien-être). Réduit cortisol à long terme. Améliore la qualité du sommeil.",
                'digestion' => "Stimule le péristaltisme intestinal. La marche après le repas facilite la digestion. Éviter sport intense juste après manger.",
                'immunite' => "Activité modérée renforce l'immunité. Attention : activité intense et prolongée peut temporairement affaiblir les défenses.",
                'mental' => "Réduit anxiété et dépression. Améliore la concentration et la mémoire. Favorise la neuroplasticité.",
            ],
            'recommandations' => [
                'frequence' => "Minimum 150 min d'activité modérée par semaine (30 min x 5 jours) ou 75 min d'activité intense. Idéal : combiner les deux.",
                'types' => "Cardio (marche rapide, vélo, natation), renforcement musculaire (2x/semaine), étirements/souplesse (yoga, Pilates), équilibre.",
                'progressivite' => "Commencer doucement, augmenter progressivement (10% par semaine max). Respecter les temps de récupération.",
                'adaptation' => "Adapter au profil : sédentaire → marche 10 min/jour puis augmenter. Stressé → yoga, tai chi. Problèmes articulaires → natation, vélo.",
            ],
            'contre_indications' => [
                'fatigue_chronique' => "Activité très douce uniquement (marche lente, yoga restauratif). Ne pas épuiser les réserves surrénaliennes.",
                'inflammation' => "Éviter activité intense qui augmente l'inflammation. Préférer marche, natation, stretching doux.",
                'cardio' => "Toujours vérifier l'avis médical. Adapter l'intensité (test de la parole : pouvoir parler pendant l'effort).",
            ],
            'exercices_specifiques' => [
                'digestion' => "Marche 15-20 min après les repas. Torsions douces (yoga). Massage abdominal sens horaire.",
                'dos' => "Étirements quotidiens. Renforcement de la sangle abdominale. Éviter les charges lourdes mal portées.",
                'circulation' => "Marche rapide, vélo, natation. Mouvements des mollets (montée sur pointes). Éviter station debout prolongée.",
                'sommeil' => "Activité le matin ou en fin d'après-midi. Éviter le sport intense 3h avant le coucher (sauf yoga/stretching).",
            ],
        ],

        // ==========================================
        // PHYTOTHÉRAPIE (Module 6)
        // ==========================================
        'phytotherapie' => [
            'digestif' => [
                'artichaut' => "Cynara scolymus. Cholérétique et cholagogue. Soutient le foie et la vésicule. Améliore la digestion des graisses. CI : obstruction biliaire.",
                'radis_noir' => "Raphanus sativus. Draineur hépatique puissant. Stimule la production de bile. Cure de 3 semaines. CI : calculs biliaires.",
                'chardon_marie' => "Silybum marianum. Hépatoprotecteur (silymarine). Régénère les cellules hépatiques. Antioxydant. Safe même à long terme.",
                'desmodium' => "Desmodium adscendens. Protège le foie. Utilisé en cure post-médicaments ou excès. Pas de CI connue.",
                'fenouil' => "Foeniculum vulgare. Carminatif (anti-ballonnements). Antispasmodique digestif. Favorise la lactation. CI : cancers hormono-dépendants.",
                'melisse' => "Melissa officinalis. Antispasmodique digestif et nerveux. Calme l'anxiété. Améliore le sommeil. CI : hypothyroïdie.",
                'menthe_poivree' => "Mentha piperita. Antispasmodique puissant. SII (en gélules gastro-résistantes). Attention reflux (peut aggraver).",
                'reglisse' => "Glycyrrhiza glabra. Protège la muqueuse gastrique. Anti-inflammatoire. CI : hypertension (sauf forme DGL).",
                'guimauve' => "Althaea officinalis. Mucilages protecteurs. Apaise les muqueuses irritées (estomac, intestin, gorge).",
            ],
            'nerveux' => [
                'valériane' => "Valeriana officinalis. Sédative, anxiolytique. Améliore le sommeil. Pas d'accoutumance. Goût/odeur désagréable.",
                'passiflore' => "Passiflora incarnata. Anxiolytique douce. Calme le mental agité. Idéale pour l'endormissement.",
                'aubepine' => "Crataegus spp. Régule le rythme cardiaque. Anxiété avec palpitations. Hypotenseur léger.",
                'rhodiola' => "Rhodiola rosea. Adaptogène. Augmente la résistance au stress. Améliore performances mentales. Matin/midi (stimulante).",
                'ashwagandha' => "Withania somnifera. Adaptogène. Réduit le cortisol. Anti-fatigue. Améliore le sommeil malgré effet adaptogène.",
                'griffonia' => "Griffonia simplicifolia. Précurseur de sérotonine (5-HTP). Améliore humeur et sommeil. CI : antidépresseurs.",
                'safran' => "Crocus sativus. Antidépresseur naturel validé. Aussi efficace que certains ISRS. Améliore l'humeur.",
            ],
            'immunite' => [
                'echinacee' => "Echinacea purpurea. Immunostimulante. Prévention et début d'infections. Cures de 10 jours max (puis pause). CI : maladies auto-immunes.",
                'sureau' => "Sambucus nigra. Antiviral (grippe, rhume). Diaphorétique (fait transpirer). Sirop ou tisane.",
                'propolis' => "Résine d'abeilles. Antibactérien, antiviral, antifongique. Spray gorge, gélules ou teinture.",
                'astragale' => "Astragalus membranaceus. Adaptogène immunitaire. Renforce le terrain. Cure de fond (pas en phase aiguë).",
                'thym' => "Thymus vulgaris. Antiseptique respiratoire. Expectorant. Infections ORL. Tisane ou sirop.",
            ],
            'circulation' => [
                'vigne_rouge' => "Vitis vinifera. Tonique veineux. Jambes lourdes, varices. Riche en polyphénols.",
                'marron_inde' => "Aesculus hippocastanum. Veinotonique puissant. Insuffisance veineuse, hémorroïdes.",
                'ginkgo' => "Ginkgo biloba. Circulation cérébrale et périphérique. Mémoire, concentration. CI : anticoagulants.",
                'hamamelis' => "Hamamelis virginiana. Astringent veineux. Hémorroïdes, varices. Usage interne et externe.",
            ],
            'femme' => [
                'gattilier' => "Vitex agnus-castus. Régulateur hormonal. SPM, cycles irréguliers. Agit sur l'hypophyse. Résultats après 3 mois.",
                'sauge' => "Salvia officinalis. Œstrogen-like. Bouffées de chaleur, transpiration excessive. CI : cancers hormono-dépendants.",
                'alchemille' => "Alchemilla vulgaris. Règles abondantes, dysménorrhée. Tonique utérin.",
                'dong_quai' => "Angelica sinensis. Tonique féminin chinois. Régule les cycles. CI : anticoagulants, grossesse.",
            ],
            'osteo_articulaire' => [
                'harpagophytum' => "Harpagophytum procumbens. Anti-inflammatoire articulaire. Arthrose, douleurs. CI : ulcère gastrique.",
                'reine_des_pres' => "Filipendula ulmaria. Aspirine naturelle (salicylés). Anti-douleur, anti-inflammatoire. CI : allergie aspirine.",
                'cassis' => "Ribes nigrum (bourgeons). Anti-inflammatoire cortison-like. Allergies, douleurs articulaires.",
                'prele' => "Equisetum arvense. Reminéralisante (silicium). Renforce os, cartilages, ongles, cheveux.",
                'ortie' => "Urtica dioica. Reminéralisante. Douleurs articulaires. Diurétique. Riche en fer.",
            ],
        ],

        // ==========================================
        // AROMATHÉRAPIE (Module 6)
        // ==========================================
        'aromatherapie' => [
            'regles_securite' => [
                'dilution' => "Toujours diluer les HE dans une huile végétale pour application cutanée. Adulte : 5-10%. Enfant > 7 ans : 2-3%. Jamais pure sauf exception (lavande, tea tree, ponctuellement).",
                'voies' => "Cutanée (la plus sûre), olfactive (diffusion max 15-20 min), orale (avec grande prudence, avis professionnel). Jamais dans les yeux, oreilles, muqueuses.",
                'contre_indications' => "Grossesse (surtout 1er trimestre), allaitement, enfants < 7 ans, épilepsie, asthme, insuffisance hépatique/rénale. Certaines HE photosensibilisantes (agrumes).",
                'test' => "Toujours faire un test dans le pli du coude 24h avant première utilisation. Arrêter si irritation.",
                'qualite' => "Choisir HE 100% pures et naturelles, HEBBD ou HECT, bio de préférence. Nom latin, organe, chémotype indiqués.",
            ],
            'huiles_essentielles' => [
                'tea_tree' => [
                    'nom' => "Tea Tree (Melaleuca alternifolia)",
                    'proprietes' => "Antibactérien puissant, antifongique, antiviral, immunostimulant.",
                    'usages' => "Infections cutanées (acné, mycoses), ORL, bucco-dentaire. 1 goutte pure locale possible.",
                    'ci' => "Prudence avant 7 ans.",
                ],
                'lavande_vraie' => [
                    'nom' => "Lavande vraie (Lavandula angustifolia)",
                    'proprietes' => "Calmante, cicatrisante, antispasmodique, anti-inflammatoire.",
                    'usages' => "Stress, anxiété, sommeil, brûlures, piqûres, douleurs. L'HE la plus polyvalente.",
                    'ci' => "Très bien tolérée. Rare allergie possible.",
                ],
                'menthe_poivree' => [
                    'nom' => "Menthe poivrée (Mentha piperita)",
                    'proprietes' => "Antalgique (effet froid), digestive, tonique mental.",
                    'usages' => "Maux de tête (tempes), nausées, digestion difficile, fatigue mentale.",
                    'ci' => "Interdite < 7 ans, épilepsie, grossesse. Pas le soir (stimulante).",
                ],
                'ravintsara' => [
                    'nom' => "Ravintsara (Cinnamomum camphora ct cinéole)",
                    'proprietes' => "Antiviral puissant, immunostimulant, expectorant.",
                    'usages' => "Grippe, rhume, bronchite, fatigue hivernale. En prévention ou curatif.",
                    'ci' => "Asthme (prudence), enfants < 3 ans.",
                ],
                'eucalyptus_radie' => [
                    'nom' => "Eucalyptus radié (Eucalyptus radiata)",
                    'proprietes' => "Expectorant, antiviral, décongestionnant respiratoire.",
                    'usages' => "Infections ORL, sinusite, bronchite. Plus doux que globulus.",
                    'ci' => "Asthme, enfants < 3 ans.",
                ],
                'citron' => [
                    'nom' => "Citron (Citrus limon)",
                    'proprietes' => "Antiseptique, tonique digestif, fluidifiant sanguin.",
                    'usages' => "Digestion, détox, assainissement air, concentration.",
                    'ci' => "Photosensibilisant (pas d'exposition soleil 8h après application cutanée).",
                ],
                'basilic_tropical' => [
                    'nom' => "Basilic tropical (Ocimum basilicum)",
                    'proprietes' => "Antispasmodique puissant (digestif et musculaire), antalgique.",
                    'usages' => "Crampes, spasmes digestifs, règles douloureuses, stress.",
                    'ci' => "Dermocaustique (bien diluer). Grossesse.",
                ],
                'gaultherie' => [
                    'nom' => "Gaulthérie couchée (Gaultheria procumbens)",
                    'proprietes' => "Anti-inflammatoire et antalgique puissant (salicylate de méthyle).",
                    'usages' => "Douleurs musculaires, articulaires, tendinites. En massage dilué.",
                    'ci' => "Allergie aspirine, anticoagulants, enfants, grossesse. Max 10% dilution.",
                ],
                'ylang_ylang' => [
                    'nom' => "Ylang-ylang (Cananga odorata)",
                    'proprietes' => "Calmante, hypotensive, aphrodisiaque, régule le cœur.",
                    'usages' => "Stress, anxiété, palpitations, hypertension, cheveux.",
                    'ci' => "Concentration élevée peut donner nausées/maux de tête.",
                ],
                'helichryse' => [
                    'nom' => "Hélichryse italienne (Helichrysum italicum)",
                    'proprietes' => "Anti-hématome puissant, cicatrisant, anti-inflammatoire.",
                    'usages' => "Bleus, couperose, cicatrices, phlébite. HE précieuse (chère).",
                    'ci' => "Anticoagulants (prudence). Grossesse.",
                ],
            ],
            'synergies' => [
                'stress_sommeil' => "Lavande vraie + Petit grain bigarade + Marjolaine à coquilles. En diffusion ou massage plexus solaire dilué à 10% dans huile végétale.",
                'digestion' => "Menthe poivrée + Basilic tropical + Citron. 1 goutte de chaque sur comprimé neutre ou dans cuillère miel après repas.",
                'immunite' => "Ravintsara + Tea tree + Eucalyptus radié. En application sur poignets et thorax diluée, ou en diffusion.",
                'douleurs' => "Gaulthérie + Eucalyptus citronné + Menthe poivrée. En massage local dilué à 10% dans huile d'arnica.",
            ],
            'huiles_vegetales' => [
                'amande_douce' => "Peau sèche, sensible. Massage doux. Convient aux bébés.",
                'jojoba' => "Tous types de peau. Régule le sébum. Stable, ne rancit pas.",
                'arnica' => "Anti-inflammatoire, anti-ecchymose. Douleurs musculaires. Pas sur plaies.",
                'calendula' => "Cicatrisante, apaisante. Peaux irritées, eczéma, érythème fessier.",
                'nigelle' => "Anti-inflammatoire, anti-allergique. Eczéma, psoriasis, douleurs articulaires.",
                'coco' => "Antifongique, nourrissante. Mycoses, cheveux. Se solidifie sous 25°C.",
            ],
        ],

        // ==========================================
        // ROUTINES & SOINS NATURELS
        // ==========================================
        'routines' => [
            'matin' => [
                'reveil_doux' => "Se réveiller 5-10 min avant le lever. Étirements au lit. Éviter de sauter du lit brusquement.",
                'gratte_langue' => "Gratter la langue 5-7 fois avec un gratte-langue en cuivre ou inox. Élimine les toxines accumulées la nuit (ama en ayurvéda).",
                'eau_tiede_citron' => "1 verre d'eau tiède + jus d'un demi-citron à jeun. Stimule la digestion et le foie. Attendre 20 min avant de manger. CI : ulcère, sensibilité émail.",
                'brossage_a_sec' => "Avant la douche, brosser la peau avec une brosse en fibres naturelles. Du bas vers le cœur. Stimule circulation lymphatique et élimine cellules mortes.",
                'douche_ecossaise' => "Terminer la douche par jet d'eau froide (10-30 sec) sur les jambes puis le corps. Stimule circulation, tonifie, renforce immunité. Progressif.",
                'automassage' => "Masser le ventre dans le sens des aiguilles d'une montre (1-2 min). Stimule le transit et les organes digestifs.",
            ],
            'soir' => [
                'bouillotte_foie' => "Bouillotte chaude sur le foie (côté droit, sous les côtes) 20-30 min après le dîner. Favorise la détox et la digestion. Relaxant.",
                'bain_relaxant' => "Bain chaud (37-38°C max) avec sels d'Epsom (magnésium) ou bicarbonate. Ajout possible d'HE relaxantes. 20 min max.",
                'rituel_coucher' => "Écrans éteints 1h avant. Lumière tamisée. Tisane relaxante. Lecture, méditation ou respiration.",
                'pieds' => "Massage des pieds à l'huile (sésame en ayurvéda). Points réflexes. Chaussettes ensuite pour la chaleur.",
            ],
            'hebdomadaire' => [
                'hammam_sauna' => "1x/semaine si bien toléré. Élimination toxines par la sueur. CI : problèmes cardiaques, grossesse, varices.",
                'cataplasme_argile' => "Argile verte sur zone douloureuse ou foie. Poser 1-2h (ne pas laisser sécher complètement). Détoxifiant, anti-inflammatoire.",
                'lavement' => "Lavement à l'eau tiède pour nettoyer le côlon (controversé, à encadrer). Hydrothérapie du côlon chez un professionnel.",
                'jeune_intermittent' => "16h de jeûne / 8h d'alimentation (ex: dernier repas 20h, premier repas 12h). Repos digestif, autophagie. Pas pour tous.",
            ],
        ],

        // ==========================================
        // COMPLÉMENTS ALIMENTAIRES
        // ==========================================
        'complements' => [
            'probiotiques' => [
                'description' => "Bactéries bénéfiques pour le microbiote intestinal.",
                'indications' => "Dysbiose, après antibiotiques, SII, immunité, infections à répétition, eczéma.",
                'posologie' => "10 à 20 milliards UFC/jour. À jeun ou avant repas. Cure de 1 à 3 mois.",
                'souches' => "Lactobacillus (rhamnosus, acidophilus), Bifidobacterium (longum, lactis), Saccharomyces boulardii (après antibiotiques).",
            ],
            'magnesium' => [
                'description' => "Minéral essentiel, souvent carencé (stress, alimentation moderne).",
                'indications' => "Stress, fatigue, crampes, sommeil, migraines, SPM, constipation.",
                'posologie' => "300-400 mg/jour. Formes biodisponibles : bisglycinate, citrate, malate. Éviter oxyde.",
                'associations' => "Vitamine B6 améliore l'absorption. Taurine pour le stress.",
            ],
            'omega3' => [
                'description' => "Acides gras essentiels anti-inflammatoires (EPA, DHA).",
                'indications' => "Inflammation, articulations, cerveau, cœur, peau sèche, dépression.",
                'posologie' => "1 à 2 g/jour (EPA + DHA combinés). Pendant les repas. Qualité EPAX ou équivalent.",
                'sources' => "Petits poissons gras (sardines, maquereaux, anchois). Huiles de poisson ou algues (végétalien).",
            ],
            'vitamine_d' => [
                'description' => "Hormone-vitamine liposoluble, carencée chez 80% des Français en hiver.",
                'indications' => "Immunité, os, humeur, fatigue, maladies auto-immunes.",
                'posologie' => "1000 à 4000 UI/jour selon taux sanguin (objectif > 60 ng/ml). Avec repas gras.",
                'associations' => "Vitamine K2 (MK7) pour diriger le calcium vers les os et non les artères.",
            ],
            'zinc' => [
                'description' => "Oligo-élément essentiel pour immunité, peau, hormones.",
                'indications' => "Immunité faible, acné, chute de cheveux, cicatrisation, fertilité masculine.",
                'posologie' => "15-30 mg/jour. Bisglycinate ou picolinate. Loin du fer et du calcium.",
                'sources' => "Huîtres, viande rouge, graines de courge, légumineuses.",
            ],
            'fer' => [
                'description' => "Minéral essentiel pour le transport de l'oxygène.",
                'indications' => "Anémie, fatigue, essoufflement, règles abondantes, végétalisme.",
                'posologie' => "14-20 mg/jour si carence confirmée par analyse. Bisglycinate mieux toléré.",
                'associations' => "Vitamine C améliore l'absorption. Éviter thé/café pendant le repas.",
            ],
            'vitamine_c' => [
                'description' => "Antioxydant, soutien immunitaire, synthèse du collagène.",
                'indications' => "Immunité, fatigue, cicatrisation, gencives, fer (absorption).",
                'posologie' => "500-1000 mg/jour. Acérola ou forme liposomale pour meilleure absorption.",
                'timing' => "Le matin ou midi (peut être stimulante). Fractionner les doses.",
            ],
            'glutamine' => [
                'description' => "Acide aminé carburant des cellules intestinales.",
                'indications' => "Perméabilité intestinale, après gastro, sport intense, cicatrisation.",
                'posologie' => "3-5 g/jour à jeun. Cure de 1 à 3 mois.",
            ],
            'curcumine' => [
                'description' => "Principe actif du curcuma, puissant anti-inflammatoire.",
                'indications' => "Inflammation, articulations, digestion, foie.",
                'posologie' => "400-600 mg/jour de curcumine biodisponible (pipérine, phytosome, micellaire).",
                'associations' => "Poivre noir (pipérine) multiplie l'absorption par 20.",
            ],
        ],
    ];
}

/**
 * Recherche dans la base de connaissances par mots-clés
 */
function searchKnowledge(string $query, array $contexts = []): array {
    $knowledge = getKnowledgeBase();
    $results = [];
    $query = strtolower($query);
    $keywords = array_filter(explode(' ', $query));

    // Recherche dans les sections pertinentes
    foreach ($knowledge as $section => $data) {
        // Si des contextes sont spécifiés, filtrer
        if (!empty($contexts) && !in_array($section, $contexts)) {
            continue;
        }

        searchRecursive($data, $keywords, $section, '', $results);
    }

    // Trier par pertinence (nombre de mots-clés trouvés)
    usort($results, fn($a, $b) => $b['score'] - $a['score']);

    return array_slice($results, 0, 10); // Max 10 résultats
}

/**
 * Recherche récursive dans les tableaux
 */
function searchRecursive(array $data, array $keywords, string $section, string $path, array &$results): void {
    foreach ($data as $key => $value) {
        $currentPath = $path ? "$path > $key" : $key;

        if (is_array($value)) {
            // Si c'est un tableau associatif avec 'description' ou 'proprietes', c'est une entrée finale
            if (isset($value['description']) || isset($value['proprietes']) || isset($value['nom'])) {
                $text = implode(' ', array_map(fn($v) => is_string($v) ? $v : '', $value));
                $score = countKeywordMatches($text, $keywords);
                if ($score > 0) {
                    $results[] = [
                        'section' => $section,
                        'path' => $currentPath,
                        'key' => $key,
                        'data' => $value,
                        'score' => $score
                    ];
                }
            } else {
                // Continuer la recherche récursive
                searchRecursive($value, $keywords, $section, $currentPath, $results);
            }
        } else if (is_string($value)) {
            $score = countKeywordMatches($value, $keywords);
            if ($score > 0) {
                $results[] = [
                    'section' => $section,
                    'path' => $currentPath,
                    'key' => $key,
                    'content' => $value,
                    'score' => $score
                ];
            }
        }
    }
}

/**
 * Compte le nombre de mots-clés trouvés dans un texte
 */
function countKeywordMatches(string $text, array $keywords): int {
    $text = strtolower($text);
    $count = 0;
    foreach ($keywords as $keyword) {
        if (strlen($keyword) > 2 && str_contains($text, $keyword)) {
            $count++;
        }
    }
    return $count;
}

/**
 * Obtient des suggestions contextuelles basées sur les données de consultation
 */
function getContextualSuggestions(array $consultationData): array {
    $suggestions = [
        'alimentation' => [],
        'stress' => [],
        'activite' => [],
        'complements' => [],
        'phyto' => [],
        'aroma' => [],
        'routines' => [],
    ];

    $knowledge = getKnowledgeBase();

    // Analyser le motif de consultation
    $motif = strtolower($consultationData['motif'] ?? '');
    $motifCat = $consultationData['motif_categorie'] ?? '';

    // Analyser les réponses
    $stressNiveau = (int)($consultationData['stress_niveau'] ?? 5);
    $sommeilQualite = (int)($consultationData['sommeil_qualite'] ?? 5);
    $activiteNiveau = (int)($consultationData['activite_niveau'] ?? 5);
    $digTroubles = strtolower($consultationData['dig_troubles'] ?? '');

    // Suggestions alimentation basées sur les troubles
    if (str_contains($motif, 'digest') || str_contains($digTroubles, 'ballonnement') || str_contains($digTroubles, 'gaz')) {
        $suggestions['alimentation'][] = $knowledge['alimentation']['principes_generaux']['mastication'];
        $suggestions['alimentation'][] = $knowledge['alimentation']['principes_generaux']['associations'];
        $suggestions['alimentation'][] = "Éviter les crudités le soir (fermentation). Préférer les légumes cuits.";
    }

    if (str_contains($motif, 'inflammat') || str_contains($motif, 'douleur')) {
        $suggestions['alimentation'][] = $knowledge['alimentation']['regimes_specifiques']['anti_inflammatoire'];
    }

    // Suggestions stress si niveau élevé
    if ($stressNiveau >= 6) {
        $suggestions['stress'][] = $knowledge['stress']['techniques']['coherence_cardiaque'];
        $suggestions['stress'][] = $knowledge['stress']['techniques']['respiration_ventrale'];
        $suggestions['complements'][] = $knowledge['complements']['magnesium']['description'] . ' ' . $knowledge['complements']['magnesium']['posologie'];
    }

    // Suggestions sommeil si mauvaise qualité
    if ($sommeilQualite <= 5) {
        $suggestions['stress'][] = $knowledge['stress']['hygiene_vie']['sommeil'];
        $suggestions['routines'][] = $knowledge['routines']['soir']['rituel_coucher'];
        $suggestions['phyto'][] = "Passiflore : " . $knowledge['phytotherapie']['nerveux']['passiflore'];
    }

    // Suggestions activité physique si sédentaire
    if ($activiteNiveau <= 4) {
        $suggestions['activite'][] = $knowledge['activite_physique']['recommandations']['progressivite'];
        $suggestions['activite'][] = "Commencer par 10-15 min de marche quotidienne, augmenter progressivement.";
    }

    // Suggestions routines de base
    $suggestions['routines'][] = $knowledge['routines']['matin']['gratte_langue'];
    $suggestions['routines'][] = $knowledge['routines']['soir']['bouillotte_foie'];

    // Filtrer les suggestions vides
    foreach ($suggestions as $key => $values) {
        $suggestions[$key] = array_filter(array_unique($values));
    }

    return $suggestions;
}
