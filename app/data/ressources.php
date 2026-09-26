<?php
/**
 * Ressources documentaires transversales : phytologie, aromatologie,
 * micronutrition, hydrologie, gestion du stress, alimentation générale...
 *
 * Une seule table `ressources`, auto-créée au premier déploiement, avec des
 * champs génériques réutilisés différemment selon la section (une huile
 * essentielle n'a pas de "sources_alimentaires", une vitamine n'a pas de
 * "synergies", etc. - les champs non pertinents restent simplement vides).
 */

/**
 * Phytologie — 66 plantes médicinales, 9 sphères (ESN).
 */
function getRessourcesPhytologie(): array {
    return [
        // ===== Sphère nerveuse (13 plantes) =====
        [
            'categorie' => 'Sphère nerveuse',
            'nom' => 'Lavande vraie (Lavandula angustifolia)',
            'partie_utilisee' => 'Fleurs',
            'indication' => "Stress, nervosité, irritabilité\nInsomnie (anxiété ou épuisement nerveux)\nCéphalées, migraines, névralgies\nPalpitations, tachycardie nerveuse\nÉtourdissements (prudence si hypotension)\nConvient aux enfants, personnes âgées, convalescents",
            'contre_indications' => "Prudence si hypotension marquée\nHE : éviter aux 3 premiers mois de grossesse\nSurdosage → effet excitant paradoxal",
            'posologie' => "Infusion : 1 c.s./tasse, 1–3×/j\nHE : 10 gttes bain / diffusion / massage 5–10%\nTM : 25–50 gttes, 2–3×/j\nHydrolat : 1 c.s./verre d'eau",
            'synergies' => "Passiflore, Valériane\nMélisse, Camomille\nTilleul (sommeil)",
        ],
        [
            'categorie' => 'Sphère nerveuse',
            'nom' => 'Aubépine (Crataegus monogyna/oxyacantha)',
            'partie_utilisee' => 'Fleurs, feuilles, fruits',
            'indication' => "Anxiolytique douce, 'plante des cœurs brisés'\nAnxiété d'origine cardiaque ou émotionnelle\nHyperactivité, nervosité, irritabilité\nTroubles du sommeil (sans sédation excessive)\nChoc émotionnel, instabilité émotionnelle\nCardiotonique, vasodilatateur périphérique\nRégule cholestérol/triglycérides",
            'contre_indications' => "Prudence avec médicaments cardiovasculaires (antihypertenseurs, digitaliques)\nSurveiller TA, avis médical recommandé",
            'posologie' => "Infusion : 1 c.s./25 cl, 10 min\nTM : 30 gttes matin et APM\nGélules : 250 mg × 2 matin & soir\nEPS : 1 c.c. matin et APM\nGemmothérapie : 10 gttes, 1–4×/j",
            'synergies' => "Agripaume (arythmies, palpitations)\nPassiflore, Valériane (anxiété/insomnie)\nOlivier (HTA, athérosclérose)",
        ],
        [
            'categorie' => 'Sphère nerveuse',
            'nom' => 'Agripaume (Leonurus cardiaca)',
            'partie_utilisee' => 'Parties aériennes fleuries',
            'indication' => "Agitation, irritabilité, sautes d'humeur, angoisse\nChoc émotionnel, deuil\nDéprime, neurasthénie (épuisement nerveux)\nInsomnie nerveuse\nCœur sensible au stress + palpitations\nSoutien émotionnel profond",
            'contre_indications' => "Contre-indiqué grossesse (utérotonique)\nPrudence si hypotension marquée",
            'posologie' => "Infusion : 1 c.s. (2–3 g)/200 ml, 10 min, 2–3×/j\nTM : 20–30 gttes, 2–3×/j\nGélules : 200–400 mg, 1–2×/j\nEPS : 5 ml, 1–2×/j",
            'synergies' => "Aubépine (insuffisance cardiaque)\nLycope (hyperthyroïdie avec angoisse)\nPassiflore, Mélisse (anxiété, insomnie)",
        ],
        [
            'categorie' => 'Sphère nerveuse',
            'nom' => 'Camomille matricaire (Matricaria recutita)',
            'partie_utilisee' => 'Fleurs (capitules)',
            'indication' => "États nerveux explosifs, instables, hypersensibles\nIrritabilité, hyperréactivité, colères soudaines\nAgitation nerveuse, hyperactivité infantile\nAnxiété légère, dépression légère\nInsomnie, cauchemars\nMigraines d'origine nerveuse\nAdaptée enfants, femmes enceintes, cyclothymiques",
            'contre_indications' => "Pas de CI majeure\nAttention allergie Astéracées\nNe pas dépasser 15 g/200 ml (effet inverse — soufre)",
            'posologie' => "Infusion : 10–15 g/L (max 15 g/200 ml !), 10 min, 2–3×/j\nTM : 25–40 gttes, 2–3×/j\nHE (externe) : 2–5% dans HV (tempes, nuque)\nBain : 50 g fleurs dans l'eau du bain",
            'synergies' => "Mélisse, Passiflore (SPM nerveux)\nAchillée, Viorne (dysménorrhées)\nCalendula, Sauge (infections vaginales)",
        ],
        [
            'categorie' => 'Sphère nerveuse',
            'nom' => 'Marjolaine (Origanum majorana)',
            'partie_utilisee' => 'Feuilles et sommités fleuries',
            'indication' => "Anxiété, stress, irritabilité\nDépression légère, épuisement nerveux\nInsomnie, troubles du sommeil\nMigraine & céphalées d'origine nerveuse\nSpasmes, tics, agitation\nSpasmes digestifs d'origine émotionnelle",
            'contre_indications' => "Pas de CI majeure connue",
            'posologie' => "Infusion : 1 c.c./tasse 150 ml, 10 min, 2–3×/j (idéal le soir)\nTM : 20–40 gttes, 2–3×/j\nHE (externe) : 2% dans HV → plexus solaire ou tempes",
            'synergies' => "Mélisse, Valériane (nerveux/digestif)\nLavande (stress)",
        ],
        [
            'categorie' => 'Sphère nerveuse',
            'nom' => 'Mélisse (Melissa officinalis)',
            'partie_utilisee' => 'Feuilles',
            'indication' => "GABAergique : garde plus de GABA dans l'environnement cérébral\nAnxiété, stress, spasmophiles\nInsomnie des anxieux, sommeil agité, cauchemars\nHyperémotivité, irritabilité\nChocs psychologiques — plante 'anti-choc'\nDépression (y compris post-partum, ménopause)\nÉpuisement nerveux, effondrement psychique\nSevrages (tabac, médicaments, addictions)\nVertiges, syncopes, convulsions infantiles",
            'contre_indications' => "Éviter si stress post-traumatique sévère\nPréférer à la Valériane si effet 'groggy' non souhaité",
            'posologie' => "Infusion : 1,5–3 g/tasse, 10 min, 2–3×/j\nTM : 20–40 gttes, 2–3×/j\nHydrolat : 1 c.s./verre d'eau, 1–2×/j",
            'synergies' => "Passiflore, Valériane\nLavande, Camomille\nAubépine (stress cardiaque)",
        ],
        [
            'categorie' => 'Sphère nerveuse',
            'nom' => 'Passiflore (Passiflora incarnata)',
            'partie_utilisee' => 'Sommités fleuries',
            'indication' => "Anxiété, nervosité, agitation\nHyperactivité cérébrale (ruminations, pensées 'en boucle')\nSurmenage, excitation cérébrale\nCrises d'angoisse, panique\nInsomnie liée au stress\nAddictions : aide au sevrage (réduction craving)\nCardiovasculaire : hypotenseur doux, ↓ palpitations",
            'contre_indications' => "Pas de CI majeure\nPrudence en association avec sédatifs",
            'posologie' => "Infusion : 2–4 g/tasse, 1–3×/j\nTM : 30–50 gttes, 1–3×/j\nExtrait sec : 200–600 mg/j\nEPS : 1–2 c.c./j",
            'synergies' => "Valériane (insomnie réveils nocturnes)\nMélisse (anxiété)\nGriffonia (dépression légère + anxiété)",
        ],
        [
            'categorie' => 'Sphère nerveuse',
            'nom' => 'Lotier corniculé (Lotus corniculatus)',
            'partie_utilisee' => 'Partie aérienne',
            'indication' => "États nerveux aigus, agitation, neurasthénie\nDépression légère, anxiété, hyperémotivité\nFatigue nerveuse, pré-burn-out\nPalpitations nerveuses, tachycardie fonctionnelle\nVertiges liés au stress, spasmophilie\nInsomnies avec agitation nocturne, réveils fréquents",
            'contre_indications' => "Cures courtes (10 jours)\nEffet œstrogénique léger",
            'posologie' => "Infusion : 2–4 g/tasse, 1–2×/j (soir)\nTM : 20–40 gttes, le soir (cure courte)\nEPS : 1–2 c.c./j",
            'synergies' => "Mélisse, Aubépine",
        ],
        [
            'categorie' => 'Sphère nerveuse',
            'nom' => 'Eschscholtzia (Pavot de Californie) (Eschscholtzia californica)',
            'partie_utilisee' => 'Plante entière fleurie',
            'indication' => "Sédative, anxiolytique, analgésique — riche en alcaloïdes, sans accoutumance\nIrritabilité, agitation, humeur fébrile\nAnxiété, tension nerveuse\nInsomnie (réveils nocturnes), cauchemars\nEnfants, personnes âgées, convalescents, ménopausées\nSevrages (alcool, tabac — sauf opiacés)\nCéphalées, migraines, douleurs musculaires/articulaires\nHypotenseur doux",
            'contre_indications' => "Antécédents addiction aux opiacés\nPrudence avec sédatifs, anxiolytiques (effet additif)\nGrossesse & allaitement : à éviter",
            'posologie' => "Infusion : 2–4 g/tasse, 1–2×/j le soir\nTM : 30–50 gttes, le soir (3×/j si anxiété diurne)\nGélules : 500–1000 mg/j",
            'synergies' => "Valériane, Houblon\nPassiflore (insomnie)",
        ],
        [
            'categorie' => 'Sphère nerveuse',
            'nom' => 'Valériane (Valeriana officinalis)',
            'partie_utilisee' => 'Racine',
            'indication' => "GABAergique : favorise l'action du GABA\nInsomnie (surtout réveils nocturnes, difficultés d'endormissement)\nAnxiété, stress, nervosité, surmenage\nDépression légère, fatigue nerveuse\nDouleurs chroniques avec tension musculaire\nSevrage : anxiolytiques, somnifères, tabac\nTensions abdominales liées au stress",
            'contre_indications' => "Effet paradoxal stimulant chez 2–3% des personnes\nNe pas associer avec barbituriques, benzodiazépines\nPrudence avec alcool (effet additif)\nGrossesse & allaitement : éviter",
            'posologie' => "Décoction : 2–3 g/200 ml, bouillir 3–5 min + infuser 10 min, 1–2 tasses soir\nTM : 30–50 gttes, 2–3×/j ou le soir\nGélules : 400–900 mg extrait standardisé, 30 min–2h avant coucher",
            'synergies' => "Houblon, Passiflore\nMélisse, Eschscholtzia\nAubépine (anxiété cardiaque)",
        ],
        [
            'categorie' => 'Sphère nerveuse',
            'nom' => "Millepertuis — 'l'Arnica des nerfs' (Hypericum perforatum)",
            'partie_utilisee' => 'Sommités fleuries',
            'indication' => "Antidépresseur naturel (dépression légère à modérée, saisonnière)\nInhibe recapture sérotonine, noradrénaline, dopamine, GABA et glutamate\nDeuil, choc, anxiété, irritabilité, stress soutenu\nInsomnie nerveuse, cauchemars enfants\nSevrage (alcool, anxiolytiques, tabac)\nSciatique, névralgies, douleurs nerveuses, zona\nUsage externe : brûlures, coups de soleil, herpès, cicatrices",
            'contre_indications' => "Phototoxicité (éviter soleil intense, UV)\nInteractions majeures (CYP3A4) : antidépresseurs, anxiolytiques, somnifères ; contraceptifs oraux (inefficacité !) ; anticoagulants, immunosuppresseurs, anticancéreux",
            'posologie' => "Infusion : 2–4 g/tasse, 1–2×/j\nTM : 30–50 gttes, 2–3×/j\nExtrait sec standardisé : 300 mg × 2–3/j (titré 0,3% hypéricine), 6–8 sem. minimum\nExterne : huile ou teinture sur nerfs/lésions",
            'synergies' => "Rhodiola (fatigue + dépression)\nHoublon, Actée (dépression ménopause)\nSafran, Griffonia",
        ],
        [
            'categorie' => 'Sphère nerveuse',
            'nom' => 'Griffonia (Griffonia simplicifolia)',
            'partie_utilisee' => 'Graines',
            'indication' => "Riche en 5-HTP : précurseur direct de la sérotonine\nAnxiété, angoisses, dépression légère à modérée\nPerte d'estime de soi, agressivité\nFavorise le sommeil (endormissement)\nRégule la satiété : boulimie, compulsions sucrées, obésité\nCéphalées, migraines, fibromyalgie\nDysménorrhée",
            'contre_indications' => "NE PAS associer avec antidépresseurs (ISRS, IMAO, tricycliques) → syndrome sérotoninergique\nÉpileptiques, grossesse, allaitement, enfants\nPrudence avec anxiolytiques/hypnotiques",
            'posologie' => "Extrait sec standardisé 5-HTP : 50–100 mg, 1–3×/j (200–300 mg/j)\nGélules (stabilité du PA)\nCommencer par doses faibles",
            'synergies' => "Rhodiola (dépression légère avec fatigue + anxiété)\nMillepertuis (prudence)",
        ],
        [
            'categorie' => 'Sphère nerveuse',
            'nom' => "Safran — 'l'Épice de la joie' (Crocus sativus)",
            'partie_utilisee' => 'Stigmates',
            'indication' => "Antidépresseur naturel (léger à modéré)\nInhibe recapture sérotonine, dopamine et noradrénaline\nAnxiété, optimisme, énergie vitale, joie de vivre\nSommeil : ↓ insomnie liée à l'anxiété/dépression\nDouleurs chroniques, céphalées\nÉquilibre cycle féminin, préménopause/ménopause\nNeuroprotection (Alzheimer, Parkinson — études)\nEffets visibles après 2 à 4 semaines",
            'contre_indications' => "Grossesse (utérotonique)\nPrudence avec antidépresseurs (IRS, IMAO)\nDoses très élevées (> 5 g) : toxique",
            'posologie' => "Poudre stigmates : 30–50 mg/j\nExtrait sec standardisé : 20–30 mg/j (titré safranal/crocine)\nInfusion : 3–4 pistils/tasse, 10 min, 1–2×/j",
            'synergies' => "Millepertuis (dépression)\nGriffonia (anxiété + dépression)",
        ],

        // ===== Plantes adaptogènes (6 plantes) =====
        [
            'categorie' => 'Plantes adaptogènes',
            'nom' => 'Ashwagandha (Withania somnifera)',
            'partie_utilisee' => 'Racine — Solanaceae',
            'indication' => "Adaptogène 'calmo-tonique' : ↓ hypercortisolémie, restaure vitalité phase 3\nAnxiolytique doux, facilite endormissement et qualité du sommeil (GABAergique)\nSoutien surrénalien ; stimulation douce de la thyroïde (↑ T3)\nImmunomodulante, anti-inflammatoire, antioxydante\nReproduction : améliore paramètres spermatiques ; soutien FSH/LH\nNeuroprotection/cognition : mémoire, concentration (brouillard mental)\nStress avec troubles du sommeil, anxiété de fond, surmenage\nFatigue chronique/convalescence (action lente mais profonde)\nHypothyroïdie fruste / ralentissement métabolique",
            'contre_indications' => "Grossesse/allaitement\nHémochromatose / excès de fer (plante riche en fer)\nPotentialise sédatifs (barbituriques, benzos) → commencer bas\nHyperthyroïdie déclarée : prudence (peut majorer)",
            'posologie' => "Gélules d'extrait : 500 mg matin + 500 mg soir\nPoudre : ½ à 1 c.c. matin et soir (eau/yaourt/compote)\nDurée : effets en 4–6 semaines ; cure 3 mois, pause 1 mois",
            'synergies' => "Mélisse/Passiflore (sommeil/anxiété)\nL-Tyrosine + Fucus (thyroïde lente)\nSchisandra + Éleuthérocoque (cerveau)",
        ],
        [
            'categorie' => 'Plantes adaptogènes',
            'nom' => 'Schisandra (Schisandra chinensis)',
            'partie_utilisee' => 'Baies/fruits — Magnoliaceae',
            'indication' => "'Baie aux 5 saveurs' — Adaptogène calmant avec tonicité mentale\nHépatoprotectrice puissante : ↑ glutathion, régénération hépatique\nImmunité & anti-âge : antivirale, antioxydante, anti-inflammatoire\nNeuro : améliore mémoire, clarté mentale ; sérotoninergique (humeur/sommeil)\nCardio : normalise la PA (↓ si haute, ↑ si basse)\nFoie : hépatite, stéatose, co-support chimio/radio\nInfections virales récurrentes (rhume/angine) ; EBV débutant\nSport : anti-inflammatoire (tendinites), récupération",
            'contre_indications' => "Grossesse/allaitement\nRares : gastralgies, baisse d'appétit, prurit\nInteractions enzymatiques hépatiques (CYP) : prudence si médication quotidienne",
            'posologie' => "Teinture (fruits secs) : 50–100 gouttes 3×/j\nDécoction : 1 c.c. fruits/200 ml ; 5 min frémir + 30 min infuser ; 2 tasses/j\nPoudre/gélules : 500 mg matin + 500 mg soir\nCure : 6–8 sem. (ou 3 mois) → pause 10–30 j",
            'synergies' => "Chardon-Marie + Desmodium (foie)\nAshwagandha (sommeil + humeur)\nBasilic sacré + Ortie/Plantain (allergies)",
        ],
        [
            'categorie' => 'Plantes adaptogènes',
            'nom' => 'Éleuthérocoque (Eleutherococcus senticosus)',
            'partie_utilisee' => 'Racine — Araliaceae',
            'indication' => "Adaptogène neutre (très polyvalent) : endurance physique & cognitive\nImmunité : ↓ incidence infections (hiver), soutient convalescence\nCardio-métabo : vasorelaxant, améliore profil lipidique\nSoutien récupération sportive (↓ acide lactique, ↑ ATP)\nFatigue fonctionnelle, charge mentale, rythmes soutenus\nTDA/H (enfant/ado/adulte) — énergie stable sans sur-exciter",
            'contre_indications' => "< 12 ans, grossesse, cancers hormono-dépendants\nNe pas prendre après 16h (insomnie)\nVigilance si traitements hypoglycémiants/hypotenseurs",
            'posologie' => "Décoction : 2 c.c. racines/500 ml départ à froid → 5 min frémir + 10 min ; 1 tasse matin, 1 début APM\nExtrait hydroalcoolique : 30–100 gouttes matin & APM\nGélules (~220 mg) : 2 matin + 2 midi\nCures : 6–8 sem. → pause 10 j",
            'synergies' => "Rhodiola (optimisme/bonne humeur)\nGinkgo biloba (concentration)\nAstragale + Échinacée (convalescence)",
        ],
        [
            'categorie' => 'Plantes adaptogènes',
            'nom' => 'Rhodiola (Rhodiola rosea)',
            'partie_utilisee' => 'Racine — Crassulaceae',
            'indication' => "Adaptogène rapide d'action : effets ressentis dès les premiers jours\nÉnergie & fatigue : lutte contre fatigue physique et intellectuelle\nCognitif & nerveux : concentration, mémoire, créativité, vigilance\nÉmotionnel : ↓ stress, anxiété, burnout, stabilité émotionnelle\nSommeil : améliore endormissement si fatigue nerveuse (sans sédation)\nMétabolisme : régulation cortisol, effet protecteur sur thyroïde\nFatigue chronique, burnout, surmenage professionnel ou scolaire\nPerformance sportive et récupération",
            'contre_indications' => "HTA non équilibrée\nTroubles bipolaires (peut stimuler la phase maniaque)\nGrossesse, allaitement\nÉviter si anxiété forte\nÉviter le soir (risque d'insomnie)",
            'posologie' => "Extrait sec standardisé (rosavines 3%, salidroside 1%) : 200–400 mg/j en 1 prise le matin\nTM : 30–50 gouttes 1–2×/jour\nPoudre de racine : 1–2 g/j\nDurée : 3 à 6 semaines — Pause : 1 à 2 semaines",
            'synergies' => "Ginkgo biloba (mémoire, vigilance)\nÉleuthérocoque ou Ginseng (endurance sportive)\nMélisse ou Passiflore (si anxiété — évite effet trop stimulant)\nGriffonia (5-HTP) (dépression légère + fatigue)",
        ],
        [
            'categorie' => 'Plantes adaptogènes',
            'nom' => 'Basilic sacré (Tulsi) (Ocimum sanctum)',
            'partie_utilisee' => 'Feuilles & sommités — Lamiaceae',
            'indication' => "Adaptogène doux et spirituel, relié au cœur et à la respiration\nNerveux & émotionnel : anxiolytique, anti-stress, clarté mentale\nRespiratoire : expectorant, toux, asthme, bronchite\nImmunité & inflammation : immunomodulant, antiviral, antibactérien\nMétabolisme : régule la glycémie (diabète type 2)\nCardio : ↓ cholestérol/triglycérides\nNeuroprotecteur : mémoire, attention, prévention neurodégénérative\nTroubles digestifs nerveux",
            'contre_indications' => "Grossesse (effet emménagogue possible)\nPrudence avec anticoagulants (eugénol fluidifie le sang)\nPrudence avec hypoglycémiants",
            'posologie' => "Infusion : 2–3 g de feuilles séchées/200 ml, 2–3 tasses/j\nTM : 30–50 gouttes, 2–3×/jour\nExtrait sec : 300–500 mg/j\nDurée : 6 à 12 semaines",
            'synergies' => "Ashwagandha (anti-stress + thyroïde)\nMélisse ou Aubépine (stress cardiaque)\nSchisandra (foie + immunité)",
        ],
        [
            'categorie' => 'Plantes adaptogènes',
            'nom' => 'Ginseng asiatique (Panax ginseng)',
            'partie_utilisee' => 'Racine — Araliaceae',
            'indication' => "Tonique majeur, stimulant puissant\nÉnergie physique, intellectuelle, sexuelle, immunitaire\nFatigue profonde, convalescence\nDiabète type 2, hypotension\nBaisse libido, immunité",
            'contre_indications' => "Hypertension\nExcès nerveux\nGrossesse/allaitement\nPerturbe le sommeil",
            'posologie' => "Selon dosage fabricant",
            'synergies' => "Rhodiola, Maca (endurance)\nÉleuthérocoque (tonus)",
        ],

        // ===== Sphère gynécologique (12 plantes) =====
        [
            'categorie' => 'Sphère gynécologique',
            'nom' => 'Achillée millefeuille (Achillea millefolium)',
            'partie_utilisee' => 'Sommités fleuries — Asteraceae',
            'indication' => "Régulatrice du cycle, hémostatique (ménorragies/métrorragies)\nEmménagogue, antispasmodique (dysménorrhées)\nSPM, fibromes, endométriose, ptôse utérine, aménorrhée fonctionnelle\nFoie/digestion : amer cholérétique doux, anti-inflammatoire digestif\nCirculatoire : tonique veineux, vasodilatatrice périphérique, varices, HTA légère\nUro-rénal : antiseptique urinaire léger, diurétique doux\nImmunité/fièvres : diaphorétique, fébrifuge, antihistaminique (allergies)",
            'contre_indications' => "Allergie aux Astéracées (lactones)\nPrudence si traitement anticoagulant\nDéconseillée en grossesse/allaitement\nParfois flux menstruel augmenté (terrain 'chaud/circulant')",
            'posologie' => "Infusion (sommités fleuries) : 30 g/L, 2–3 tasses/jour\nTeinture (fraîche de préférence) : 20–40 gouttes, jusqu'à 3–5×/j\nHydrolat (interne ou externe)",
            'synergies' => "Alchémille + Bourse-à-pasteur (flux abondant)\nAchillée + Armoise + Gattilier (dysménorrhées)\nAchillée + Sauge + Gattilier (ménopause sécheresse/libido)",
        ],
        [
            'categorie' => 'Sphère gynécologique',
            'nom' => 'Armoise commune (Artemisia vulgaris)',
            'partie_utilisee' => 'Feuilles ou sommités fleuries — Asteraceae',
            'indication' => "Emménagogue : régularise et déclenche les règles (aménorrhée, irrégularités)\nAntispasmodique utérin : soulage dysménorrhées\nFavorise la fertilité (tradition)\nSoutien périménopause : tonique, relaxant\nAmère cholérétique : stimule bile, enzymes, appétit\nVermifuge doux, antifongique",
            'contre_indications' => "Grossesse & allaitement (utérotonique, thuyone)\nAllergie aux Astéracées\nPrudence si règles déjà abondantes\nÉviter usage prolongé",
            'posologie' => "Infusion : 20–30 g/L (feuilles sèches), 2–3 tasses/j\nTeinture : 30–40 gouttes, 2–3×/j\nUsage court à moyen terme",
            'synergies' => "Achillée + Sauge + Gingembre (retard de règles/aménorrhée)\nArmoise + Achillée + Viorne (douleurs menstruelles)",
        ],
        [
            'categorie' => 'Sphère gynécologique',
            'nom' => 'Sauge officinale (Salvia officinalis)',
            'partie_utilisee' => 'Feuilles — Lamiaceae',
            'indication' => "Phytoestrogénique, régulatrice du cycle (hypo-œstrogénie, irrégularités, post-pilule, ménopause)\nAntispasmodique utérine : crampes menstruelles, dysménorrhée\nEmménagogue : aménorrhée fonctionnelle\nAntisudorifique : sueurs nocturnes, bouffées de chaleur\nNeuro-psy : brouillard mental lié aux variations hormonales (SPM, ménopause)\nAnti-lait : freine/arrête la lactation",
            'contre_indications' => "Grossesse\nAllaitement (arrête la lactation — sauf sevrage volontaire)\nCancers hormonodépendants (sein, endomètre, etc.)\nÉpilepsie/terrain convulsif (prudence HE ; plante entière mieux tolérée)",
            'posologie' => "Infusion (feuilles sèches) : 15–20 g/L, 2–3 tasses/jour\nTeinture (feuilles fraîches 1:2 alcool 80–96°) : 25–40 gouttes, 2–3×/jour\nUsage court en prise seule ; plus long si fraction d'un mélange",
            'synergies' => "Achillée (crampes/flux)\nSauge + Actée/Trèfle rouge/Houblon (ménopause)\nGattilier (SOPK hypo-œstrogénie relative)",
        ],
        [
            'categorie' => 'Sphère gynécologique',
            'nom' => 'Bourse-à-pasteur (Capsella bursa-pastoris)',
            'partie_utilisee' => 'Parties aériennes — Brassicaceae',
            'indication' => "Hémostatique rapide : stoppe/freine les saignements utérins\nRègles abondantes (ménorragies), saignements entre les règles (métrorragies)\nSaignements de périménopause, post-partum\nSaignements liés aux fibromes\nAstringente des muqueuses utérines (resserre les tissus)\nTonique du muscle utérin",
            'contre_indications' => "Grossesse (emménagogue/utérotonique)\nAllaitement : éviter en routine (glucosinolates) ; usage ponctuel post-partum sous supervision\nHypothyroïdie : crucifère goitrogène — éviter prise au long cours\nPrudence avec anticoagulants\nTerrain cardio : peut entraîner légère baisse de tension",
            'posologie' => "Teinture de plante fraîche (préférable) : 20–30 gouttes, répéter toutes les 10–30 min jusqu'à ↓ flux\nInfusion de plante fraîche : ~100 g/L (sèche : 20 g/L — moins fiable)",
            'synergies' => "Achillée millefeuille (hémostatique + décongestion)\nAlchémille (astringente tissulaire)\nMarron d'Inde / Vigne rouge (si hémorroïdes associées)",
        ],
        [
            'categorie' => 'Sphère gynécologique',
            'nom' => 'Framboisier (Rubus idaeus)',
            'partie_utilisee' => 'Feuille — Rosaceae',
            'indication' => "Tonique utérin majeur : nourrit, tonifie, équilibre le système reproducteur\nHémostatique : ménorragie, métrorragie, leucorrhées\nRégulateur du cycle (endométriose, fibrome, ménopause)\nGrossesse et accouchement : prépare l'utérus au travail (3ᵉ trimestre)\nSoutien de la fertilité : fausses couches à répétition (souvent avec agripaume)\nSoutien psycho-émotionnel (traumatismes liés à la 'matrice')",
            'contre_indications' => "Riche en tanins → espacer la prise par rapport aux repas, compléments et médicaments",
            'posologie' => "Infusion (préférée) : 30 g/L, infuser 30 min ; 1–3 tasses/jour (ventre vide)\nTeinture (moins utilisée) : 60–100 gouttes, 2–3×/jour\nUsages locaux : bains de siège, douches vaginales, compresses",
            'synergies' => "Agripaume (fertilité, fausses couches)\nViorne obier (accouchement difficile)",
        ],
        [
            'categorie' => 'Sphère gynécologique',
            'nom' => 'Alchémille (Alchemilla vulgaris)',
            'partie_utilisee' => 'Sommités fleuries, feuilles — Rosaceae',
            'indication' => "Lutéotrope (progestérone-like) : hyperœstrogénie relative, spotting, cycles courts\nTonique et astringente utérine : ↓ règles abondantes, métrorragies\nDécongestionnante pelvienne : dysménorrhée congestive, fibromes, endométriose\nAnti-inflammatoire, cytoprotectrice\nAntimycosique : candidoses vaginales récidivantes\nSoutien post fausse-couche/avortement/accouchement",
            'contre_indications' => "Riche en tanins → prendre loin des repas, médicaments ou compléments\nPeut accentuer une tendance à la constipation",
            'posologie' => "Infusion : 20–30 g/L, 10 min, 2–3 tasses/jour\nTeinture : 30–50 gouttes, 2–3×/jour",
            'synergies' => "Vigne rouge, Bourse-à-pasteur (règles hémorragiques)\nGattilier (SPM avec mastodynie)\nBaby blues (sans allaitement) : sauge",
        ],
        [
            'categorie' => 'Sphère gynécologique',
            'nom' => 'Gattilier (Vitex agnus-castus)',
            'partie_utilisee' => 'Fruit (baie poivrée) — Lamiaceae',
            'indication' => "Lutéotrope → stimule corps jaune → ↑ progestérone\nEffet dopaminergique → ↓ prolactine → améliore ovulation, régularise cycle\nSPM : mastodynies, rétention d'eau, irritabilité, céphalées\nInfertilité liée à insuffisance lutéale ou hyperprolactinémie\nHyperandrogénie (acné, pilosité, SOPK)\nFibromes, endométriose (action modulante hormonale)\nPériménopause : cycles irréguliers, bouffées de chaleur",
            'contre_indications' => "Peut aggraver un état dépressif (surtout SPM de type dépressif, PMS-D)\nPeut provoquer troubles du cycle : règles plus abondantes ou rapprochées\nEffets paradoxaux possibles : aggravation mastalgie, acné, céphalées\nPrudence avec traitements hormonaux (progestérone synthèse, THS)\nGrossesse/allaitement sans supervision",
            'posologie' => "Teinture : 30–100 gouttes le matin\nPoudre/gélules : 200–500 mg/j, jusqu'à 2,5 g/j dans pathologies lourdes\nDurée : 3–6 mois (action progressive)",
            'synergies' => "Achillée, alchémille, mélisse, griffonia (SPM)\nPivoine + réglisse (hyperprolactinémie, SOPK)\nSauge, trèfle rouge (bouffées de chaleur)",
        ],
        [
            'categorie' => 'Sphère gynécologique',
            'nom' => 'Houblon (Humulus lupulus)',
            'partie_utilisee' => 'Cônes femelles (strobiles) — Cannabaceae',
            'indication' => "Phytoestrogénique et anti-androgénique\nMénopause : bouffées de chaleur nocturnes (efficace si perturbent le sommeil)\nSOPK / hyperandrogénie : acné, hirsutisme\nSédative et hypnotique : insomnie nerveuse, hyperexcitabilité\nGalactogène (stimule la lactation, usage traditionnel)",
            'contre_indications' => "Contre-indiqué cancer hormono-dépendant (sein, utérus, ovaire, col)\nPeut entraîner somnolence, maux de tête, engourdissement\nParfois 'gueule de bois' le matin (prises trop rapprochées)\nEffet œstrogénique marqué → prudence chez l'homme (gynécomastie)",
            'posologie' => "Infusion : 15–20 g/L (amer, mieux en mélange)\nTeinture : 60–100 gouttes, 2–3×/j (plutôt soir)\nGaléniques modernes : gélules, EPS, extraits secs standardisés",
            'synergies' => "Sauge + Actée à grappes noires + Trèfle rouge (ménopause)\nValériane + Eschscholtzia (insomnie)\nBardane + Ortie racine (hyperandrogénie/acné)",
        ],
        [
            'categorie' => 'Sphère gynécologique',
            'nom' => 'Actée à grappes noires (Actaea racemosa, syn. Cimicifuga racemosa)',
            'partie_utilisee' => 'Racine — Renonculacées',
            'indication' => "Bouffées de chaleur & ménopause : régule thermorégulation (action sérotoninergique)\nSystème nerveux : antispasmodique, sédative, stabilise l'humeur (anxiété, insomnie, irritabilité)\nDouleurs : anti-inflammatoire et antalgique (articulations, névralgies, crampes menstruelles)\nMénopause avec dépression : association efficace avec le Millepertuis",
            'contre_indications' => "Surdosage → maux de tête frontaux, pulsations derrière les yeux\nNe pas utiliser au-delà de 2–3 mois sans surveillance (principe de précaution Renonculacées)\nSurveillance hépatique conseillée (controverse sur toxicité — probablement due à adultérations)\nAntécédents de cancer hormonodépendant : prudence, données contradictoires",
            'posologie' => "Teinture (racine, 1:5) : 0,5 à 2 ml, 2–3×/jour (dose max. 7,5 ml/jour)\nExtrait sec standardisé (ex. Remifemin®) : 1 comprimé matin + soir\nGélules : 1 à 2 gélules (taille 00), 2–3×/jour (selon produit)",
            'synergies' => "Trèfle rouge (bouffées de chaleur + émotions)\nMillepertuis (ménopause avec état dépressif)\nSauge (sueurs nocturnes)",
        ],
        [
            'categorie' => 'Sphère gynécologique',
            'nom' => 'Trèfle rouge (Trifolium pratense)',
            'partie_utilisee' => 'Sommités fleuries — Fabacées',
            'indication' => "Phytoestrogénique régulatrice : équilibre hormonal\nBouffées de chaleur modérées, ménopause 'pas trop explosive'\nCycles irréguliers en périménopause\nReminéralisante : protège le capital osseux\nSPM léger ou dysménorrhées modérées",
            'contre_indications' => "Prudence si cancer hormonodépendant (principe de précaution)\nAttention théorique avec anticoagulants (effet fluidifiant discuté)",
            'posologie' => "Infusion : 30 g/L, 2 tasses/jour (reminéralisation, traitement de fond)\nTeinture (plante fraîche) : 40–60 gouttes, 2–3×/jour\nExtraits standardisés (isoflavones) : 40–80 mg/jour (formes les plus efficaces sur bouffées)",
            'synergies' => "Sauge officinale (antisudoral + phytoestrogène)\nActée à grappes noires (bouffées + émotions/douleurs articulaires)\nHoublon (ménopause avec insomnie nocturne)",
        ],
        [
            'categorie' => 'Sphère gynécologique',
            'nom' => 'Maca (Lepidium meyenii)',
            'partie_utilisee' => 'Racine — Brassicaceae',
            'indication' => "Adaptogène nutritif : énergie, résistance au stress, endurance, récupération\nTonique sexuel & fertilité : stimule libido (homme & femme), améliore qualité sperme\nHormonal : régule hormones sexuelles\nMénopause : améliore énergie, humeur, libido, densité osseuse (non strictement phyto-œstrogénique)",
            'contre_indications' => "Cancer hormono-dépendant (stimulation hormonale possible)\nPrudence si hyperthyroïdie (famille Brassicaceae, influence sur thyroïde)",
            'posologie' => "Poudre de racine : 1,5 à 3 g/jour (jusqu'à 5 g pour sportifs), en cure\nGélules : selon standardisation (équiv. 1–3 g poudre/jour)",
            'synergies' => "Ginseng + Rhodiola (énergie/endurance sportifs)\nGattilier + Alchémille (fertilité féminine)\nSauge + Actée à grappes noires (ménopause fatigue & libido)",
        ],
        [
            'categorie' => 'Sphère gynécologique',
            'nom' => 'Shatavari (Asparagus racemosus)',
            'partie_utilisee' => 'Racine — Asparagaceae',
            'indication' => "Tonique féminin majeur de l'Ayurveda ('celle aux cent maris')\nPhyto-œstrogénique doux : régule le cycle, améliore fertilité\nAdaptogène : résistance au stress, équilibre nerveux\nMénopause : atténue bouffées de chaleur, sécheresses vaginales, fatigue\nGalactogène : stimule la lactation",
            'contre_indications' => "Cancer hormono-dépendant (activité phyto-œstrogénique)\nPrudence si terrain congestif ou œdémateux",
            'posologie' => "Poudre (racine séchée) : 3–6 g/jour (dans lait chaud, eau ou miel)\nGélules : selon équivalence poudre, en cures longues\nExtrait liquide : 20–40 gouttes, 2–3×/jour",
            'synergies' => "Gattilier + Maca (fertilité féminine)\nSauge + Alchémille (SOPK & régulation hormonale)\nSauge sclarée ou Maca + Actée (ménopause sécheresse + bouffées)",
        ],

        // ===== Sphère ostéo-articulaire & rhumatologie (7 plantes) =====
        [
            'categorie' => 'Sphère ostéo-articulaire & rhumatologie',
            'nom' => 'Cassis (Ribes nigrum)',
            'partie_utilisee' => 'Feuille, fruit, bourgeon — Grossulariaceae',
            'indication' => "Anti-inflammatoire et antirhumatismal majeur\nInhibit médiateurs inflammation, ↓ douleurs articulaires et musculaires\nFavorise élimination toxines acides (crises de goutte, arthrose)\nBourgeon : stimule surrénales, production équilibrée de cortisol\nAntiallergique puissant (asthme, rhume des foins, urticaire, eczéma)\nFatigue post-infectieuse et convalescences",
            'contre_indications' => "Pas de CI majeure connue",
            'posologie' => "Tisane de feuilles : 1 c.s./250 ml eau bouillante, 2–3 tasses/j avant 17h\nTM : 30–50 gouttes, 2–3×/j, cure 20 jours\nEPS/SIPF : 5 ml, 2×/j avant repas\nMacérât glycériné de bourgeons (MG 1D) : 5–30 gouttes chaque matin",
            'synergies' => "Reine des prés, Saule blanc (anti-inflammatoire articulaire)\nFrêne, Orthosiphon (drainage acide urique)\nPlantain, Sureau, Échinacée (allergies/immunité)",
        ],
        [
            'categorie' => 'Sphère ostéo-articulaire & rhumatologie',
            'nom' => 'Reine des prés (Filipendula ulmaria)',
            'partie_utilisee' => 'Sommités fleuries, feuilles, racines — Rosaceae',
            'indication' => "Un des meilleurs anti-inflammatoires et antalgiques végétaux du système locomoteur\nArthrose, arthrite, polyarthrite\nGoutte, excès d'acide urique, rhumatismes douloureux\nDigestif : antiulcéreuse, antireflux, antispasmodique, diarrhées légères\nCardiovasculaire : fluidifiante du sang (salicylés), prévention thrombose\nSudorifique : fièvres et états grippaux",
            'contre_indications' => "Allergie à l'aspirine ou aux salicylés\nGrossesse et allaitement\nEnfants (risque syndrome de Reye)\nTraitements anticoagulants ou antiplaquettaires\nNE PAS utiliser en teinture (principes actifs salicylés peu solubles dans l'alcool)",
            'posologie' => "Tisane/infusion : 1 c.s. sommités/tasse, infuser 10–15 min à couvert, 2–3 tasses/j\nExtrait fluide / EPS : 5 ml, 1–2×/j\nPoudre ou gélules : 300–600 mg, 2–3×/j",
            'synergies' => "Cassis, Saule blanc, Harpagophytum (anti-inflammatoire + antalgique)\nFrêne, Orthosiphon (drainage acides)\nOrtie, Prêle (reminéralisation + régénération cartilage)",
        ],
        [
            'categorie' => 'Sphère ostéo-articulaire & rhumatologie',
            'nom' => 'Prêle des champs (Equisetum arvense)',
            'partie_utilisee' => 'Tige et feuilles — Equisetaceae',
            'indication' => "Plante reminéralisante par excellence (silice organique)\nFavorise fixation du calcium et synthèse du collagène (cartilage, tendons, os)\nArthrose, ostéoporose, ostéopénie, fractures, tendinites\nTégumentaire : cicatrisation, renforce cheveux, ongles et dents\nUrinaire : diurétique doux, goutte, œdèmes",
            'contre_indications' => "Forte dose ou usage prolongé : possible toxicité hépatique ou neurologique\nGrossesse, allaitement, enfants\nInsuffisance rénale sévère\nNe pas confondre avec la Prêle des marais (Equisetum palustre) — TOXIQUE (troubles digestifs, cardiaques, vertiges)",
            'posologie' => "Décoction : 20 g/L, bouillir 10 min, infuser 15 min ; 1–2 tasses/j\nPoudre / gélules : 1 à 5 g/j selon les besoins\nEPS/SIPF : 5 ml, 1–2×/j",
            'synergies' => "Ortie, Bambou tabashir, Avoine (reminéralisation + consolidation osseuse)\nCassis, Reine des prés, Saule blanc (anti-inflammatoire + drainage articulaire)\nConsoude (usage externe — régénération, fractures)",
        ],
        [
            'categorie' => 'Sphère ostéo-articulaire & rhumatologie',
            'nom' => 'Bouleau (Betula alba)',
            'partie_utilisee' => 'Feuille, écorce, sève — Betulaceae',
            'indication' => "Anti-inflammatoire et antalgique doux\nGrand draineur : stimule élimination déchets métaboliques (acide urique, urée)\nArthrose, arthrite, goutte, rhumatismes chroniques\nŒdèmes, jambes lourdes, rétention d'eau\nCures de drainage de printemps\nDépuratif cutané (acné, eczéma)",
            'contre_indications' => "Insuffisance cardiaque ou rénale sévère (effet diurétique)\nAllergie aux dérivés salicylés (surtout avec la sève)\nPrudence si traitement diurétique ou hypotenseur",
            'posologie' => "Infusion (feuilles) : 1–2 c.s./250 ml, 10–15 min, 2–3 tasses/j\nSève fraîche : 100–150 ml chaque matin à jeun, cure 3 semaines au printemps\nTM : 30–50 gouttes, 2–3×/j\nEPS : 5 ml, 2×/j",
            'synergies' => "Cassis, Reine des prés, Saule blanc (anti-inflammatoire articulaire)\nPrêle, Ortie (tissu conjonctif)\nFrêne, Orthosiphon, Pissenlit (drainage acides)",
        ],
        [
            'categorie' => 'Sphère ostéo-articulaire & rhumatologie',
            'nom' => 'Saule blanc (Salix alba)',
            'partie_utilisee' => 'Écorce — Salicaceae',
            'indication' => "Anti-inflammatoire naturel majeur (dérivés salicylés)\nSans irriter l'estomac comme les AINS de synthèse\nArthrose, arthrite, polyarthrite rhumatoïde\nRhumatismes chroniques, douleurs lombaires et cervicales\nTendinites, douleurs post-traumatiques\nÉtats fébriles, grippaux, maux de tête, migraines",
            'contre_indications' => "Allergie à l'aspirine ou aux salicylés\nUlcères gastriques ou duodénaux\nHémorragies, troubles de la coagulation, anticoagulants\nGoutte ou insuffisance rénale\nFemmes enceintes, allaitantes, enfants",
            'posologie' => "Infusion : 2–3 g écorce/250 ml, 2–3×/j\nDécoction : 5 g/½ litre, bouillir 10 min + infuser 10 min\nTM : 30–50 gouttes, 2–3×/j\nGélules : 200 mg, 3–5×/j (selon titrage en salicosides)",
            'synergies' => "Harpagophytum, Cassis, Curcuma (douleurs ostéo-articulaires)\nReine des prés (anti-inflammatoire + fébrifuge renforcé)\nFrêne, Bouleau (goutte, arthrose)",
        ],
        [
            'categorie' => 'Sphère ostéo-articulaire & rhumatologie',
            'nom' => 'Harpagophytum (Griffe du diable) (Harpagophytum procumbens)',
            'partie_utilisee' => 'Tubercule — Pedaliaceae',
            'indication' => "Un des meilleurs anti-inflammatoires naturels (iridoïdes inhibent enzymes dégradation cartilage + PGE2)\nArthrose, arthrite, polyarthrite rhumatoïde\nRhumatismes chroniques, douleurs lombaires et cervicales\nTendinites, bursites, douleurs musculaires\nGoutte et crises d'acide urique",
            'contre_indications' => "Femmes enceintes ou allaitantes, enfant\nUlcères gastriques ou duodénaux\nTroubles cardiovasculaires, diabète ou calculs biliaires\nAnticoagulants, antiarythmiques, antiplaquettaires\nPeut irriter légèrement l'estomac (prendre au cours des repas)",
            'posologie' => "Poudre de racine : 3–6 g/j\nExtrait normalisé : 600–1200 mg/j (titré 2,5–3% harpagosides)\nDécoction : 1 c.s. racines/1 L, boire ½ L/j, 3 semaines de cure\nTM : 30 gouttes, 2–3×/j",
            'synergies' => "Reine des prés + Saule blanc (anti-inflammatoire + antalgique renforcé)\nCassis + Frêne (drainage acide urique)\nCurcuma + Boswellia (arthrose chronique ou inflammations diffuses)",
        ],
        [
            'categorie' => 'Sphère ostéo-articulaire & rhumatologie',
            'nom' => 'Boswellia (Boswellia serrata)',
            'partie_utilisee' => 'Résine (gomme oléorésine) — Burseraceae',
            'indication' => "Anti-inflammatoire naturel puissant comparable à certains AINS (sans EI digestifs)\nRéduit inflammation de bas grade et freine dégradation du cartilage\nArthrose, polyarthrite rhumatoïde, tendinites\nDigestif : colite, Crohn, SII avec diarrhée\nRespiratoire : asthme, BPCO, bronchites chroniques\nSystème immunitaire & oncologique (immunomodulant)",
            'contre_indications' => "Hypersensibilité aux acides boswelliques\nGrossesse, allaitement, enfants < 12 ans\nPotentialise médicaments inhibiteurs synthèse des leucotriènes (asthme)",
            'posologie' => "Gélules extrait standardisé (65% acides boswelliques ou 30% AKBA) : 300–600 mg, 2–3×/j\nTM : 30–50 gouttes, 2×/j\nPoudre : 1–2 g/j\nUsage externe : pommade ou baume sur articulations douloureuses\nEn cure de 6–8 semaines, renouvelable",
            'synergies' => "Curcuma + Gingembre (anti-inflammatoire global)\nOrtie + Harpagophytum (rhumatismes dégénératifs)\nReishi ou Griffe du chat (immunité + inflammation systémique)",
        ],
        [
            'categorie' => 'Sphère ostéo-articulaire & rhumatologie',
            'nom' => 'Frêne (Fraxinus excelsior)',
            'partie_utilisee' => 'Feuille (écorce, bourgeon, parfois graine) — Oleaceae',
            'indication' => "Plante anti-goutte par excellence : ↑ diurèse, favorise l'élimination de l'acide urique\nExcellent draineur sur terrain acide ou surchargé en déchets métaboliques\nArthrite, arthrose, rhumatismes chroniques, douleurs articulaires avec gonflement ou chaleur\nCalculs rénaux et troubles d'élimination\nDiurétique urique (uricosurique), oxalique et uréique léger, anti-inflammatoire et anti-œdémateux\nDigestif : légèrement laxatif (feuilles), astringent (écorce, diarrhée) ; bourgeon régule cholestérol/lipides\nSudorifique : cures dépuratives printanières, états fébriles",
            'contre_indications' => "Insuffisance rénale sévère\nDéshydratation ou hypotension marquée\nFemme enceinte ou allaitante\nEnfant < 12 ans (usage interne prolongé)\nSurveiller traitements diurétiques ou hypotenseurs (effet cumulatif)",
            'posologie' => "Infusion : 1 c.s. feuilles séchées/250 ml, 10 min, 3–4 tasses/j\nDécoction (écorce) : 10 g/L, bouillir 10 min, filtrer\nTM : 30–50 gouttes, 2–3×/j\nBourgeon (macérât glycériné) : 5–15 gouttes/j, cure 3 semaines/mois\nUsage externe : décoction concentrée en compresses (goutte, rhumatismes)",
            'synergies' => "Cassis + Reine des prés (« tisane des centenaires » : anti-inflammatoire, diurétique, antalgique)\nBouleau + Fragon (drainage lymphatique et circulatoire)\nHarpagophytum ou Scrofulaire (douleurs articulaires chroniques)\nVergerette du Canada (drainage rénal, acide urique)",
        ],

        // ===== Sphère tégumentaire (peau) (6 plantes) =====
        [
            'categorie' => 'Sphère tégumentaire (peau)',
            'nom' => 'Bardane (Arctium lappa)',
            'partie_utilisee' => 'Racine — Asteraceae',
            'indication' => "Grande dépurative cutanée et hépatique (foie, reins, peau)\nAntibactérienne et antiseptique : infections cutanées (furoncles, acné infectée)\nAnti-inflammatoire : eczéma, psoriasis, urticaire chronique\nRégulatrice du sébum, cicatrisante, kératorégulatrice\nHépatoprotectrice, cholérétique, cholagogue\nHypoglycémiante douce (syndrome pré-diabétique)",
            'contre_indications' => "Allergie aux Astéracées\nDéconseillée grossesse/allaitement\nPrudence diabète insulinodépendant (effet hypoglycémiant)\nInteraction antidiabétiques, anticoagulants, diurétiques",
            'posologie' => "Décoction courte : 5 g/tasse, frémir 10–15 min, 2–3 tasses/j, cure 3 sem.\nTM : 30–50 gouttes, 2–3×/j\nEPS ou extrait fluide glycériné : 5 ml, 1–2×/j",
            'synergies' => "Fumeterre (psoriasis)\nRéglisse (acné inflammatoire)\nOrtie racine (acné de l'adolescent)\nPensée sauvage (eczéma suintant, acné débutante)",
        ],
        [
            'categorie' => 'Sphère tégumentaire (peau)',
            'nom' => 'Pensée sauvage (Viola tricolor)',
            'partie_utilisee' => 'Partie aérienne fleurie — Violaceae',
            'indication' => "Anti-inflammatoire cutanée : eczéma, psoriasis, rougeurs, démangeaisons\nDépurative et drainante (reins et peau)\nKératorégulatrice (acné, peau grasse, séborrhée)\nAdoucissante : restaure souplesse et hydratation des peaux sensibles\nLégèrement diurétique et laxative douce\nAntioxydante",
            'contre_indications' => "Ne pas consommer la plante fraîche (risque de toxicité)\nGrossesse, allaitante, enfant < 12 ans\nInteraction possible traitements diurétiques ou antihypertenseurs",
            'posologie' => "Infusion (interne ou externe) : 5–8 g/250 ml, 10 min, 2–3 tasses/j\nTM : 30–50 gouttes, 2–3×/j\nEPS ou extrait fluide : 5 ml, 1–2×/j, cure 21 jours",
            'synergies' => "Bardane (acné débutante ou surinfectée)\nOrtie + Alchémille (acné hormonale)\nPlantain (allergies cutanées et prurit)",
        ],
        [
            'categorie' => 'Sphère tégumentaire (peau)',
            'nom' => 'Scrofulaire noueuse (Scrophularia nodosa)',
            'partie_utilisee' => 'Plante entière (feuille, tige, racine) — Scrophulariaceae',
            'indication' => "Grande anti-inflammatoire cutanée et lymphatique\nDépurative profonde : drainage lymphatique et hépatique\nAntiprurigineuse et cicatrisante\nAntibactérienne et antivirale douce (impétigo, herpès)\nArthrose douloureuse, rhumatismes (usage interne)",
            'contre_indications' => "Grossesse et allaitement (abortive à forte dose)\nEnfants < 12 ans\nTroubles cardiaques (tachycardie ventriculaire, arythmie)\nUlcère gastro-duodénal évolutif",
            'posologie' => "Infusion (interne) : 1 c.s. plante sèche/tasse, 10–15 min, 2–3 tasses/j\nDécoction (externe) : 30 g/L, 15 min, en bain/compresse/lotion\nTM : 30–50 gouttes, 2–3×/j",
            'synergies' => "Pensée sauvage + Bardane + Ortie (eczéma/psoriasis)\nSaule blanc + Cassis (arthrose)\nCurcuma ou Boswellia (douleurs inflammatoires chroniques)",
        ],
        [
            'categorie' => 'Sphère tégumentaire (peau)',
            'nom' => 'Bourrache (Borago officinalis)',
            'partie_utilisee' => 'Graines (huile) et sommités fleuries — Boraginaceae',
            'indication' => "Régénérante et nourrissante cutanée (restaure film hydrolipidique)\nAnti-inflammatoire et apaisante (eczéma, dermatite atopique)\nHydratante, améliore élasticité cutanée, prévient vieillissement prématuré\nAntioxydante, rééquilibrante hormonale cutanée (ménopause, SPM)",
            'contre_indications' => "Ne pas utiliser les feuilles fraîches (alcaloïdes pyrrolizidiniques) — pas d'usage interne des feuilles\nHuile fragile → conserver au froid et à l'abri de la lumière\nPrudence anticoagulants\nGrossesse/allaitement déconseillée",
            'posologie' => "Huile de graines (interne) : 1–2 gélules (500–1000 mg) matin et soir (avec repas)\nHuile végétale (externe) : pure ou mélangée avec onagre/macadamia/calendula",
            'synergies' => "Bourrache + Onagre + Rose + Prêle (peau sèche/mature/relâchée)\nBourrache + Pensée sauvage + Bardane + Scrofulaire (dermatoses inflammatoires)\nBourrache + Sauge + Alchémille + Onagre (hormonal féminin)",
        ],
        [
            'categorie' => 'Sphère tégumentaire (peau)',
            'nom' => 'Hélichryse italienne (Immortelle) (Helichrysum italicum)',
            'partie_utilisee' => 'Sommités fleuries (HE ou hydrolat) — Asteraceae',
            'indication' => "Anti-hématome et circulatoire exceptionnelle (microcirculation, œdèmes, ecchymoses, couperose)\nAnti-inflammatoire cutanée et vasculaire\nCicatrisante et régénérante profonde (plaies, cicatrices, brûlures, vergetures)\nAntioxydante et anti-âge\nSoutien émotionnel : apaise traumatismes émotionnels, stress post-choc, colère",
            'contre_indications' => "Déconseillée pendant les 3 premiers mois de grossesse\nHE puissante — à diluer systématiquement (5–20%) sur la peau\nPossible allergie (famille des Astéracées)",
            'posologie' => "HE : 2–3 gouttes diluées (contusions, bleus)\nHE soin visage : 1–2 gouttes dans 1 c.s. huile de soin, matin et soir\nHydrolat : brumisation pure ou 1 c.s./verre d'eau 1–2×/j (drainage + anti-inflammatoire)",
            'synergies' => "Arnica, calendula, macadamia (dilution HE)\nPrêle, Onagre (peau mature/relâchée)",
        ],
        [
            'categorie' => 'Sphère tégumentaire (peau)',
            'nom' => 'Rose de Damas (Rosa damascena)',
            'partie_utilisee' => 'Pétales (HE, hydrolat, absolue) — Rosaceae',
            'indication' => "Régénérante cutanée profonde (collagène, renouvellement cellulaire)\nTonique et raffermissante (peau mature)\nApaisante et anti-rougeurs\nAntioxydante majeure\nHydratante et équilibrante (film hydrolipidique, sébum)\nAntidépressive et harmonisante nerveuse\nTonique cardiaque : harmonise cœur et émotions",
            'contre_indications' => "Aucune aux doses usuelles\nHE très coûteuse et concentrée : à diluer impérativement (0,5 à 1%)\nFemmes enceintes : usage externe seulement, olfactif privilégié",
            'posologie' => "HE : 1 goutte pour 10 ml huile végétale (macadamia, rose musquée)\nHydrolat : brumisation quotidienne, ou 1 c.s./verre d'eau 1–2×/j\nMacérât huileux/crème : peaux sèches et matures",
            'synergies' => "Bourrache + Onagre + Prêle (peau sèche/mature/relâchée)",
        ],
        [
            'categorie' => 'Sphère tégumentaire (peau)',
            'nom' => 'Saponaire (Saponaria officinalis)',
            'partie_utilisee' => 'Racine principalement, parfois partie aérienne fleurie — Caryophyllaceae',
            'indication' => "Nettoyante et purifiante naturelle (riche en saponines) : élimine les impuretés de la peau\nDépurative et drainante : dermatoses congestives (acné, eczéma, psoriasis)\nAdoucissante et anti-prurigineuse : apaise irritations et démangeaisons\nAntimicrobienne et légèrement antifongique\nExpectorante et mucolytique (toux grasse), légèrement diurétique et cholérétique\nTonique hépatique : élimination des déchets et toxines",
            'contre_indications' => "Plante irritante à forte dose (riche en saponines)\nDéconseillée pendant grossesse et allaitement\nÉviter en cas de pathologies digestives ou rénales aiguës\nNe pas utiliser sur peau lésée ou en application trop concentrée (risque d'irritation)",
            'posologie' => "Décoction (interne) : 3–5 g racine sèche/250 ml, bouillir 10–15 min à couvert, filtrer, 1–2 tasses/j, cure 2–3 semaines (jamais prolongée)\nUsage externe (lotion/shampooing) : décoction concentrée 30 g/L, bouillir 15 min",
            'synergies' => "Pensée sauvage + Bardane + Fumeterre (peau impure, acné, surcharges cutanées)\nPissenlit + Fumeterre + Ortie (cure dépurative de printemps)\nPrimevère + Thym + Pulmonaire (affections respiratoires chroniques)",
        ],

        // ===== Sphère immunitaire (4 plantes) =====
        [
            'categorie' => 'Sphère immunitaire',
            'nom' => 'Sureau noir (Sambucus nigra)',
            'partie_utilisee' => 'Fleurs, fruits (baies) — Caprifoliaceae',
            'indication' => "Immunostimulant (baies, riches en anthocyanes)\nAntiviral puissant : inhibe neuraminidase (réplication virus grippaux)\nFébrifuge & diaphorétique : fièvres éruptives et infectieuses\nPrévention et traitement infections virales (grippe, rhume, herpès, zona)\nRespiratoire : mucostatique & béchique (fluidifie mucus, calme toux)",
            'contre_indications' => "Maladies auto-immunes, greffes, immunosuppresseurs\nNe pas consommer les fruits non mûrs crus, ni les feuilles, l'écorce ou les graines → sambunigrine (glycoside cyanogène)\nDéconseillé chez femme enceinte, allaitante et jeune enfant\nRare effet secondaire : effet laxatif",
            'posologie' => "Infusion de fleurs : 40 g/L, 2 tasses/jour\nSirop de baies prévention : 2–3 prises/jour\nSirop de baies en infection : 1 c.s. toutes les 2h (adulte)\nTM / EPS : 2,5 à 7,5 ml/jour (teinture)",
            'synergies' => "Échinacée, Cyprès (infections virales hivernales, herpès, zona)\nAstragale (prévention infections hivernales après 65 ans)\nCassis (prévention infections récidivantes chez l'enfant, terrain allergique)",
        ],
        [
            'categorie' => 'Sphère immunitaire',
            'nom' => 'Échinacée (Echinacea purpurea)',
            'partie_utilisee' => 'Racine, partie aérienne fleurie — Astéracées',
            'indication' => "Immunostimulante : ↑ nombre et activité globules blancs (phagocytose)\nStimulante lymphatique : ganglions enflés lors d'infections\n↓ durée & intensité infections aiguës si prise dès les 1ers symptômes\nAntivirale, antibactérienne, antifongique\nORL : rhumes, grippes, amygdalites, otites, sinusites, laryngites\nUrinaire : cystites, infections urinaires\nReproducteur : candida, prostatites, mastites",
            'contre_indications' => "Maladies auto-immunes, greffes, immunosuppresseurs\nEnfant < 1 an\nGrossesse & allaitement (par prudence)\nPas d'usage prolongé (risque épuisement immunitaire) — max 6–8 semaines d'affilée",
            'posologie' => "TM : 1 c.c. (~50 gouttes) toutes les 2–3h en phase aiguë, max 5 prises/jour\nGélules/extraits standardisés : cures de 7–10 jours\nSirop : en synergie avec sureau, thym (ORL)",
            'synergies' => "Sureau noir (infections respiratoires & ORL)\nThym ou Sarriette (infections bactériennes respiratoires)\nCalendula ou Bardane (peau : acné, furoncles, eczéma)\nCassis (gemmo) : modulation immunitaire & allergies",
        ],
        [
            'categorie' => 'Sphère immunitaire',
            'nom' => 'Lapacho (Tabebuia impetiginosa)',
            'partie_utilisee' => "Aubier (bois interne, sous l'écorce) — Bignoniaceae",
            'indication' => "Immunomodulant : stimule si faiblesse, freine si suractivation\nFavorise prolifération équilibrée des lymphocytes T\nAntimicrobien, antifongique, antiviral : staphylocoque doré résistant\nAntifongique majeur : Candida albicans (buccal, vaginal, intestinal)\nUtile contre Helicobacter pylori (ulcères)\nAnti-inflammatoire : réduit inflammation chronique, régule acidité gastrique (anti-RGO)",
            'contre_indications' => "Prudence avec traitements anticoagulants (léger effet fluidifiant)\nÉviter chez femme enceinte ou allaitante (précaution)",
            'posologie' => "Décoction (aubier) : 1 c.s. pour ½ L d'eau, bouillir 5–10 min, infuser 15 min, 2–3 tasses/j\nTM : 30–50 gouttes, 2–3×/j\nPoudre/gélules : 500 mg–1 g, 2–3×/j\nUsage externe : décoction en compresses ou bains pour plaies, eczéma, mycoses\nDurée : cures de 3 semaines/mois, sur plusieurs mois si nécessaire",
            'synergies' => "Lapacho + Desmodium + Chardon-Marie (immunité & soutien foie)\nLapacho + Propolis + HE Tea tree (infections fongiques)\nLapacho + Gentiane + Cassis (soutien immunitaire en cure)",
        ],
        [
            'categorie' => 'Sphère immunitaire',
            'nom' => 'Griffe du chat (Uncaria tomentosa)',
            'partie_utilisee' => 'Écorce et racines — Rubiaceae',
            'indication' => "Stimulant immunitaire puissant → ↑ activité lymphocytes T et cellules NK\nImmunomodulant : régule réponses inflammatoires\nSoutien prévention et accompagnement des cancers (co chimio/radio)\nAnti-inflammatoire (arthrite, rhumatismes, douleurs articulaires/digestives)\nRégulateur du microbiote : colites, MICI (hors contexte auto-immun actif)",
            'contre_indications' => "Maladies auto-immunes (polyarthrite, SEP, Crohn, lupus)\nGrossesse & allaitement, enfant\nPrudence anticoagulants (effet fluidifiant modéré)\nInteractions immunosuppresseurs (greffe)",
            'posologie' => "Décoction (écorce) : 10 g/½ L, bouillir 10–15 min, 2 tasses/j\nTM : 30–50 gouttes, 2–3×/j\nExtrait sec/gélules : 250–500 mg, 1–2×/j (selon titrage en alcaloïdes)\nEn cures de 3 semaines, avec pauses",
            'synergies' => "Lapacho + Desmodium + Chardon-Marie (oncologie + foie)\nCurcuma + Boswellia (anti-inflammatoire renforcé)\nNigelle ou Reishi (immunomodulation équilibrée — hors auto-immunes)",
        ],

        // ===== Sphère cardiovasculaire (6 plantes) =====
        [
            'categorie' => 'Sphère cardiovasculaire',
            'nom' => 'Aubépine (cardio) (Crataegus monogyna/oxyacantha)',
            'partie_utilisee' => 'Feuilles, fleurs, fruits — Rosaceae',
            'indication' => "Cardiotonique : renforce muscle cardiaque, ↑ circulation coronaire\nCardioprotectrice & antioxydante : prévient athérosclérose\nHypotenseur doux par vasodilatation périphérique\nRégule rythme cardiaque : arythmies, palpitations, tachycardie\nHTA légère à modérée\nInsuffisance cardiaque (stades I et II)\nAthérosclérose, varices, hémorroïdes",
            'contre_indications' => "Prudence avec médicaments cardiovasculaires (antihypertenseurs, hypocholestérolémiants, digitaliques) → surveiller TA et avis médical recommandé",
            'posologie' => "Infusion fleurs/feuilles : 1 c.s./tasse (25 cl), 1–3 tasses/j\nTM : 30 gouttes, 2–3×/j\nEPS / SIPF : 1 c.c., 1–2×/j\nGélules : 250 mg, 2 matin & soir (possibilité d'augmenter à 6/j)\nGemmothérapie (bourgeon) : 10 gouttes, 1–4×/j",
            'synergies' => "Olivier, Ail, Ail des ours (HTA & athérosclérose)\nAgripaume (arythmies, palpitations)\nPassiflore, Valériane, Escholtzia (anxiété, insomnie)",
        ],
        [
            'categorie' => 'Sphère cardiovasculaire',
            'nom' => 'Agripaume (cardio) (Leonurus cardiaca)',
            'partie_utilisee' => 'Parties aériennes fleuries — Lamiaceae',
            'indication' => "Tonique cardiaque, cardiorégulateur\nRégule le rythme : arythmies, tachycardie, bradycardie\nApaise palpitations accompagnées d'angoisse\nSoutien insuffisance cardiaque (↑ efficacité contraction sans ↑ O₂)\nHyperthyroïdie : calme palpitations, sueurs, angoisses (associer au lycope)",
            'contre_indications' => "Contre-indiquée pendant la grossesse (effet utérotonique)\nPrudence en cas d'hypotension marquée (effet légèrement hypotenseur)",
            'posologie' => "Infusion : 1 c.s. (2–3 g)/200 ml eau bouillante, 10 min, 2–3 tasses/j\nTM : 20–30 gouttes, 2–3×/j\nExtrait sec (gélules) : 200–400 mg, 1–2×/j\nEPS : 5 ml, 1–2×/j",
            'synergies' => "Aubépine (arythmies, palpitations, insuffisance cardiaque)\nLycope (hyperthyroïdie avec angoisse)\nPassiflore, Mélisse, Escholtzia (anxiété, insomnie)",
        ],
        [
            'categorie' => 'Sphère cardiovasculaire',
            'nom' => 'Olivier (Olea europaeae)',
            'partie_utilisee' => 'Feuille — Oleaceae',
            'indication' => "Hypotenseur majeur : vasodilatateur + diurétique\nHypocholestérolémiant : ↓ LDL ↑ HDL (protecteur)\nCardioprotecteur : nourrit et protège le muscle cardiaque\nAnti-athérogène : prévention athérosclérose\nArythmies légères, tachycardie, extrasystoles\nPrévention risque d'infarctus (à associer à l'aubépine)\nMétabolisme & pancréas : hypoglycémiant doux, améliore la sensibilité à l'insuline et sa sécrétion — utile diabète de type 2\nSyndrome métabolique : corrige hyperglycémie + hyperlipidémie + hypertension + surpoids (souvent associé à fenugrec, cannelle, ginseng, myrtille)\nDigestif & hépatique : cholagogue, légèrement hépato-protecteur (coliques hépatiques, lithiases biliaires, constipation chronique)\nAnti-infectieux : antibactérien & antiviral, altère le biofilm bactérien\nNerveux : anxiolytique léger, soutient mémoire et humeur chez la personne âgée",
            'contre_indications' => "Prudence si hypotension (risque d'accentuation)\nPeut potentialiser l'effet d'antidiabétiques ou d'antihypertenseurs (surveillance médicale)",
            'posologie' => "Infusion : 10–15 g/L, 2–3 tasses/j\nTM : 30–50 gouttes, 2–3×/j\nEPS ou gélules d'extrait sec : selon recommandations du laboratoire",
            'synergies' => "Aubépine (hypertension, arythmies, coronaropathies)\nAil frais (athérosclérose et hypercholestérolémie)\nVigne rouge, Marron d'Inde (tonus veineux, varices, hémorroïdes)",
        ],
        [
            'categorie' => 'Sphère cardiovasculaire',
            'nom' => 'Vigne rouge (Vitis vinifera)',
            'partie_utilisee' => 'Feuille — Vitaceae',
            'indication' => "Insuffisance veineuse : jambes lourdes, varices, hémorroïdes\n↓ perméabilité capillaire (tanins) → limite œdèmes\nAntioxydant puissant (resvératrol, OPC) → vieillissement vasculaire\nHémostatique : règles trop abondantes, métrorragies\nAstringente digestive : diarrhées infectieuses ou chroniques",
            'contre_indications' => "Attention si anticoagulants : possible effet additif\nPrudence en cas de grossesse (prises concentrées)",
            'posologie' => "Tisane : 1 c.s./25 cl, 10 min, 2–3 tasses/j, cure 3 semaines\nAmpoules / EPS / Extraits fluides : 1–2/j, cures saisonnières\nGélules : 300–400 mg, 2–4/j\nBains de pieds : décoction 2 poignées dans 3 L eau bouillante 2 min, tiédir, 15 min bain",
            'synergies' => "Hamamélis & Marron d'Inde (hémorroïdes, insuffisance veineuse)\nPetit houx & Mélilot (jambes lourdes, varices)",
        ],
        [
            'categorie' => 'Sphère cardiovasculaire',
            'nom' => "Marronnier d'Inde (Aesculus hippocastanum)",
            'partie_utilisee' => 'Graines (riches en aescine), écorce — Hippocastanaceae',
            'indication' => "Protecteur veineux, capillaire et lymphatique\n↓ fragilité et perméabilité capillaire\nInsuffisance veineuse chronique : varices, jambes lourdes, œdèmes ulcéreux\nHémorroïdes (interne/externe)\nCongestions : pelvienne, prostatique, hépatique\nTroubles circulatoires cérébraux : céphalées, acouphènes, vertiges (stase veineuse)",
            'contre_indications' => "Grossesse, allaitement\nUlcère gastrique ou duodénal\nInsuffisance rénale ou cardiaque grave\nAnticoagulants (risque majoré de saignements)",
            'posologie' => "Décoction (écorce ou graines concassées) : 40 g/L, 1–2 tasses/j entre les repas\nTM : 5–15 gouttes/j ou 10 gouttes avant repas, 15–20 j/mois\nExtrait standardisé : 200 mg, 2–3×/j\nUsage externe : teinture diluée (1:4) en compresse sur hémorroïdes",
            'synergies' => "Vigne rouge (insuffisance veino-lymphatique, jambes lourdes)\nGinkgo biloba (hémorroïdes, acouphènes, vertiges)\nCyprès ou Fragon (Petit houx) : tonus veineux et hémorroïdes",
        ],
        [
            'categorie' => 'Sphère cardiovasculaire',
            'nom' => 'Mélilot (Melilotus officinalis)',
            'partie_utilisee' => 'Sommités fleuries — Fabaceae',
            'indication' => "Tonique lymphatique (rare !) : drainage lymphatique, lymphœdèmes post-opératoires\nVeinotonique & retour veineux : jambes lourdes, varices, hémorroïdes\nAnti-exsudatif : ↓ perméabilité veineuse, œdèmes\nAnti-inflammatoire & spasmolytique : migraines congestives, névralgies, douleurs menstruelles\nCongestions pelviennes, mastites",
            'contre_indications' => "Grossesse et allaitement\nTraitements anticoagulants ou prise d'aspirine (risque hémorragique — coumarine)\nTroubles hépatiques (enzymes élevées, risque d'hépatite)\nBien sécher la plante pour éviter formation de dicoumarol — anticoagulant puissant et toxique",
            'posologie' => "TM : 4–6 g/j (~1 c.c.)\nInfusion : 50 g plante sèche/L, boire dans la journée\nUsage externe : macérât huileux/crème pour massage jambes lourdes",
            'synergies' => "Fragon (Petit houx) : circulation veineuse et drainage lymphatique\nVigne rouge + Hamamélis (insuffisance veineuse, hémorroïdes)\nAchillée millefeuille (douleurs pelviennes congestives, règles abondantes)",
        ],

        // ===== Sphère respiratoire (5 plantes) =====
        [
            'categorie' => 'Sphère respiratoire',
            'nom' => 'Thym (Thymus vulgaris)',
            'partie_utilisee' => 'Feuille et sommités fleuries — Lamiaceae',
            'indication' => "Antiseptique puissant des voies respiratoires (thymol, carvacrol)\nExpectorant et mucolytique\nAntispasmodique : calme spasmes bronchiques (asthme, toux nerveuse)\nStimulant des mouvements ciliaires → dégage voies aériennes\nTonique pulmonaire et immunitaire\nBronchites, rhumes, sinusites hivernales",
            'contre_indications' => "Ne pas utiliser sur le long terme (irritation rénale et hépatique — HE riches en thymol)\nContre-indiqué si néphrite, grossesse à forte dose\nPrudence enfants < 6 ans (HE non recommandées)",
            'posologie' => "Infusion : 1 c.c. de plante/tasse (5 g/200 ml), 2–3 tasses/j\nTM (1:10) : 20–40 gouttes, 2–3×/j\nInhalations : 2–3 gouttes HE dans un bol d'eau chaude\nGargarismes : infusion concentrée (angine, maux de gorge)",
            'synergies' => "Lierre grimpant + Primevère (bronchites, toux grasses)\nPlantain + Guimauve (toux sèche et irritation)\nSureau + Échinacée (immunité hivernale)",
        ],
        [
            'categorie' => 'Sphère respiratoire',
            'nom' => 'Eucalyptus (Eucalyptus globulus)',
            'partie_utilisee' => 'Feuille — Myrtaceae',
            'indication' => "Antiseptique pulmonaire puissant (bactéries, virus, champignons)\nExpectorant et mucolytique\nPectoral et antitussif : calme toux grasse\nFébrifuge et anti-inflammatoire\nDécongestionnant des voies nasales et pulmonaires\nEffet hypoglycémiant modéré",
            'contre_indications' => "Contre-indiqué femme enceinte/allaitante et enfant < 6 ans (HE)\nPas d'usage prolongé à fortes doses (hépatotoxique — cinéole)\nNe pas utiliser si irritation rénale ou insuffisance hépatique\nPrudence chez l'asthmatique (vérifier tolérance)",
            'posologie' => "Infusion : 1 c.s. feuilles/250 ml, 10 min, 1–3 tasses/j\nTM : 30–50 gouttes, 2–3×/j\nInhalation : 2–3 gouttes HE dans bol eau chaude\nSirop pectoral : souvent associé au pin, thym ou mauve",
            'synergies' => "Thym + Pin sylvestre + Mauve (bronchite/toux grasse)\nThym + Menthe poivrée + Romarin (sinusite/rhume)\nSureau + Cannelle + Girofle + Thym (fièvre/grippe)",
        ],
        [
            'categorie' => 'Sphère respiratoire',
            'nom' => 'Pin sylvestre (Pinus sylvestris)',
            'partie_utilisee' => 'Bourgeons — Pinaceae',
            'indication' => "Antiseptique pulmonaire et bronchique\nExpectorant et mucolytique (sécrétions épaisses)\nAnti-inflammatoire des muqueuses pulmonaires (effet cortisone-like)\nAnti-allergique respiratoire (asthme, bronchite allergique)\nStimulant surrénalien → ↑ production de cortisol (fatigue chronique, convalescence)\nAnti-inflammatoire articulaire (arthrose, rhumatismes, goutte)",
            'contre_indications' => "HE hypertensive → éviter chez sujets à tension élevée\nDéconseillé enfant < 2 ans (HE)\nÉviter usage prolongé formes aromatiques (irritantes pour les reins)",
            'posologie' => "Décoction : 5–7 g/250 ml, bouillir 10 min à couvert, 1–3 tasses/j\nTM : 25–50 gouttes, 2–3×/j\nGemmothérapie (macérât glycériné 1D) : 50 gouttes matin et soir\nInhalation : associé à Eucalyptus ou Thym",
            'synergies' => "Thym + Eucalyptus + Mauve (toux grasse/bronchite)\nRomarin + Éleuthérocoque + Ortie (fatigue/convalescence)\nCassis + Vigne rouge (douleurs articulaires)",
        ],
        [
            'categorie' => 'Sphère respiratoire',
            'nom' => 'Bouillon blanc (Molène) (Verbascum thapsus)',
            'partie_utilisee' => 'Fleurs (principalement) et feuilles — Scrofulariacées',
            'indication' => "Adoucissante et émolliente : apaise inflammations des muqueuses respiratoires\nExpectorante douce : aide à fluidifier sécrétions sans irriter\nAnti-inflammatoire et calmante\nPlante de fond : restaure muqueuses respiratoires fragiles ou irritées (usage long terme)\nBronchite aiguë ou chronique, asthme (non allergique), toux grasses persistantes\nLaryngite, rhinite allergique, sinusite, grippe, oreillons",
            'contre_indications' => "Bien filtrer les infusions (poils peuvent irriter bouche et gorge)\nAucune toxicité connue aux doses recommandées\nCompatible avec un usage prolongé et chez l'enfant",
            'posologie' => "Infusion : 1,5–2 g de fleurs/tasse, infuser 15 min, 2–3 tasses/j\nTeinture : 20–30 gouttes, 2–3×/j",
            'synergies' => "Guimauve + Plantain (poumons fragiles, toux chronique)\nThym + Mauve (inflammation aiguë ORL)\nCassis (bourgeons) + Plantain (asthme, bronchite allergique)",
        ],
        [
            'categorie' => 'Sphère respiratoire',
            'nom' => 'Plantain (Plantago lanceolata, Plantago major)',
            'partie_utilisee' => 'Feuille — Plantaginaceae',
            'indication' => "Adoucit, répare et renforce les muqueuses respiratoires\nToux sèche, toux spasmodique, coqueluche\nAsthme, bronchite allergique ou chronique\nAllergies saisonnières, rhinite allergique (plante de fond antiallergique)\nDigestif : gastrite, ulcère, colite, diarrhée\nCutané : urticaire, eczéma, piqûres d'insectes\nUrinaire : cystite, urétrite, hématurie",
            'contre_indications' => "Pas de CI majeure connue aux doses usuelles",
            'posologie' => "Infusion : 1 c.s./tasse, 3–4 tasses/j\nTM ou EPS : 30–50 gouttes, 2–3×/j\nGélules : extraits secs standardisés (20–40 mg polyphénols/j)\nInfusion concentrée externe : hémorroïdes, piqûres, brûlures",
            'synergies' => "Cassis + Romarin + Sureau (allergies respiratoires)\nGuimauve + Bouillon-blanc + Réglisse (toux sèche)\nMauve + Camomille matricaire (muqueuses irritées/reflux)",
        ],
        [
            'categorie' => 'Sphère respiratoire',
            'nom' => 'Lierre terrestre (Glechoma hederacea)',
            'partie_utilisee' => 'Partie aérienne fleurie — Lamiaceae',
            'indication' => "Expectorant et mucolytique : évacuation des sécrétions bronchiques abondantes\nAntitussif doux (uniquement toux grasses)\nAnti-inflammatoire et décongestionnant des voies respiratoires supérieures\nBronchodilatateur léger, antispasmodique\nAsséchant et tonifiant des muqueuses (excès de mucus)\nDigestif : stimule sécrétion biliaire, tonifie muqueuses digestives, colites\nUrinaire : diurétique, soutien rénal (lithiase, cystite)",
            'contre_indications' => "Ne jamais utiliser sur toux sèche ou muqueuses irritées (effet asséchant)\nUsage prolongé : peut occasionner de la diarrhée\nDéconseillé chez la femme enceinte ou allaitante\nÀ éviter avec un traitement anticoagulant\nBien différencier du lierre grimpant (Hedera helix), toxique à fortes doses",
            'posologie' => "Infusion : 1 c.c./tasse, 3–4 tasses/j, 10 min à couvert\nDécoction : 15–30 g/L (usage interne ou gargarisme)\nTM : 1 c.c., 2×/j\nUsage externe : cataplasmes sur plaies, abcès, furoncles",
            'synergies' => "Thym + Pin sylvestre + Bouillon blanc (toux grasse, catarrhe bronchique)\nMyrte + Eucalyptus (sinusite, congestion ORL)\nArtichaut + Pissenlit (drainage hépatique et biliaire)",
        ],
        [
            'categorie' => 'Sphère respiratoire',
            'nom' => 'Aunée (Inula helenium)',
            'partie_utilisee' => 'Racine — Asteraceae',
            'indication' => "Expectorante, mucolytique et béchique : évacuation du mucus épais\nAntiseptique et anti-infectieuse pulmonaire : bronchites aiguës/chroniques, asthme, pneumonie\nTonique et réparatrice des muqueuses bronchiques (inflammations profondes et chroniques)\nAntispasmodique et légèrement fébrifuge\nDigestif : amère tonique et cholagogue\nUrinaire et locomotrice : diurétique et antiseptique urinaire",
            'contre_indications' => "Déconseillée pendant la grossesse et l'allaitement\nÀ fortes doses → vomissements, crampes, diarrhée\nUtiliser par cures (fenêtres thérapeutiques)\nPrudence en cas d'allergie aux Astéracées",
            'posologie' => "Infusion froide : 4–10 g/L pendant 8–10h, puis réchauffer légèrement\nDécoction : 4–10 g/L, 5–10 min (usage court) ou 30–45 min (usage de fond)\nTM : 30–90 gouttes, 2–3×/j\nUsage externe : décoction concentrée en compresse ou cataplasme",
            'synergies' => "Thym + Lierre terrestre + Pin sylvestre (bronchite chronique)\nGuimauve + Réglisse + Plantain (asthme)\nRomarin + Pissenlit (digestion lente, foie)\nBardane + Pensée sauvage (peau, élimination)",
        ],

        // ===== Sphère urinaire (10 plantes) =====
        [
            'categorie' => 'Sphère urinaire',
            'nom' => 'Tilleul (aubier) (Tilia cordata)',
            'partie_utilisee' => 'Aubier — Tiliaceae',
            'indication' => "Puissant draineur rénal : stimule diurèse, élimine urée, acide urique, créatinine\nActive la fonction rénale ('rince le filtre rénal')\nAide à dissoudre les petits calculs rénaux\nCellulite aqueuse, œdèmes, hyperuricémie\nDraineur hépatique et dépuratif majeur\nHypocholestérolémiant, légèrement antidiabétique\nHypotenseur doux",
            'contre_indications' => "Fragilité hépatique, antécédents de coliques hépatiques (peut déclencher crise de nettoyage)\nCalculs volumineux (risque d'obstruction et de colique)\nGrossesse et allaitement : éviter les cures prolongées",
            'posologie' => "Décoction : 30 g d'aubier coupé/1 L eau froide, porter à frémissement 10 min à couvert, filtrer et boire le litre dans la journée\nCure de 10–20 jours, à renouveler selon les besoins\nPoudre ou gélules : cures détox courtes",
            'synergies' => "Piloselle, Orthosiphon, Bouleau, Solidago (drainage rénal)\nRomarin, Chardon-Marie, Pissenlit (soutien hépatique + détox foie-reins)\nFrêne, Cassis, Reine-des-prés (acide urique + prévention goutte)",
        ],
        [
            'categorie' => 'Sphère urinaire',
            'nom' => 'Piloselle (Hieracium pilosella)',
            'partie_utilisee' => 'Plante entière — Astéracées',
            'indication' => "Véritable plante du rein : stimule fortement la diurèse sans irriter les voies urinaires\n↑ débit de filtration glomérulaire\nRétentions hydriques, œdèmes, goutte, lithiases rénales\nActivité antibactérienne et antifongique (E. coli, Staphylococcus aureus, Brucella)\nPrévention cystites, urétrites (antiseptique doux)",
            'contre_indications' => "Aucune majeure signalée aux doses usuelles",
            'posologie' => "Infusion : 5–10 g plante sèche/1 L eau bouillante, 10 min, 2–3 tasses/j avant repas\nTM : 30–50 gouttes, matin et midi avant les repas\nExtrait fluide (EPS ou Quantis) : 1–2 c.c./j",
            'synergies' => "Busserole + Bruyère + Orthosiphon (infections urinaires récidivantes)\nSolidago + Bouleau + Pissenlit (drainage rénal + détoxification)\nArtichaut + Aubier de tilleul + Romarin (détox hépato-rénale)",
        ],
        [
            'categorie' => 'Sphère urinaire',
            'nom' => 'Orthosiphon (Orthosiphon stamineus)',
            'partie_utilisee' => 'Feuille — Lamiacées',
            'indication' => "Grand diurétique naturel et protecteur rénal\n↑ filtration glomérulaire, élimine toxines, urée, chlorures, acide urique\nDissolution et élimination des petits calculs urinaires et biliaires\nAnti-inflammatoire, antioxydant, antibactérien, antifongique\nHépatobiliaire et cholagogue : stimule sécrétion biliaire\nHypotenseur doux, hypoglycémiant modéré",
            'contre_indications' => "Ne pas utiliser pendant une crise néphrétique aiguë (risque de mobilisation de calculs)\nDéconseillé femme enceinte/allaitante et enfant < 18 ans\nS'hydrater pendant la cure",
            'posologie' => "Infusion : 1 c.s./tasse eau bouillante, 10–15 min, 2–3 tasses/j\nTM : 30–50 gouttes, 2×/j avant les repas\nExtrait fluide (EPS ou Quantis) : 1–2 c.c./j",
            'synergies' => "Piloselle + Bouleau + Solidago (drainage rénal, rétention hydrique)\nReine-des-prés + Cassis (hyperuricémie, prévention goutte)\nBusserole + Canneberge (cystites récidivantes)",
        ],
        [
            'categorie' => 'Sphère urinaire',
            'nom' => "Verge d'or (Solidago virgaurea)",
            'partie_utilisee' => 'Sommités fleuries — Astéracées',
            'indication' => "Drainage rénal majeur (sans irriter les reins)\n↑ diurèse, élimine eau, urée et acide urique\nAnti-inflammatoire et antiseptique doux sur les voies urinaires\nCystites, pyélonéphrites, lithiases rénales, néphrites chroniques\nRégénère le tissu rénal, améliore filtration glomérulaire",
            'contre_indications' => "Allergie connue aux Astéracées\nInsuffisance cardiaque ou rénale sévère\nCure discontinue pour éviter irritation rénale (3 semaines maximum)",
            'posologie' => "Infusion : 2 c.s./1 L eau bouillante, 10–15 min, 2–3 tasses/j\nTM : 30–50 gouttes, 2×/j\nEPS : 1–2 c.c./j, cure 3 sem.",
            'synergies' => "Piloselle + Bouleau + Orthosiphon (drainage rénal)\nFragon + Mélilot + Vigne rouge (œdèmes, rétention)\nBusserole + Bruyère (infections urinaires récidivantes)",
        ],
        [
            'categorie' => 'Sphère urinaire',
            'nom' => 'Bruyère (Calluna vulgaris)',
            'partie_utilisee' => 'Fleurs séchées — Éricacées',
            'indication' => "Diurétique et antiseptique urinaire\nDésinfecte voies urinaires (arbutine, acide ursolique, flavonoïdes)\nCystites, pyélonéphrites légères, prostatites\nFacilite évacuation des petits calculs\nSédative du système urinaire : améliore confort mictionnel",
            'contre_indications' => "Aucune majeure aux doses usuelles\nContient arbutoside (dérivé d'hydroquinone) : éviter cures > 20 jours/mois\nPathologie rénale sévère ou grossesse sans avis médical",
            'posologie' => "Infusion prévention : 1 c.c. fleurs/25 cl, 10 min\nInfusion curatif : 4 c.c./1 L, boire dans la journée (3–4 tasses/j)\nTM : 30–50 gouttes, 2–3×/j",
            'synergies' => "Busserole + Piloselle + Orthosiphon (infections urinaires récidivantes)\nCanneberge + D-mannose + probiotiques (prévention cystites récidivantes)\nCassis + Reine-des-prés (inflammations articulaires et rhumatismales)",
        ],
        [
            'categorie' => 'Sphère urinaire',
            'nom' => 'Busserole (Arctostaphylos uva-ursi)',
            'partie_utilisee' => 'Feuille — Éricacées',
            'indication' => "Plante de référence des infections urinaires\nAntiseptique urinaire puissant : arbutine → hydroquinone (efficace en milieu alcalin)\nCystites, urétrites, pyélonéphrites récidivantes (E. coli, Proteus, Klebsiella)\nAntifongique : Candida albicans, Mycoplasma, Ureaplasma\nAntilithique et lithotritique : dissout petits calculs\nUsage externe : vaginites, leucorrhées, cervicites, bains de siège post-partum",
            'contre_indications' => "Grossesse et allaitement (risque ocytocique)\nEnfant < 12 ans\nCancer ou inflammation chronique des voies urinaires\nUlcère gastrique ou constipation chronique (tanins)\nCure courte obligatoire (7–10 jours max, 5 fois/an maximum)",
            'posologie' => "Infusion : 1 c.s. feuilles/25 cl eau froide, porter à ébullition 2–3 min, infuser 10 min ; 2–3 tasses/j\n→ Toujours alcaliniser les urines (eaux bicarbonatées, alimentation végétale)\nTM : 30–50 gouttes, 2–3×/j",
            'synergies' => "Bruyère + Piloselle + Orthosiphon (cystites, urétrites récidivantes)\nÉchinacée + Cassis (prévention récidives, stimulation immunitaire)\nGuimauve + Plantain (protection muqueuses irritées)",
        ],
        [
            'categorie' => 'Sphère urinaire',
            'nom' => 'Canneberge (Vaccinium macrocarpon)',
            'partie_utilisee' => 'Baies — Éricacées',
            'indication' => "Préventive infections urinaires à colibacilles (E. coli)\nProanthocyanidines (PACs) : empêchent adhérence bactérienne sur parois vésicale\nPrévention cystites récidivantes (utilisation prolongée possible)\nAnti-lithiasique : prévention calculs phosphocalciques\nAntioxydante (flavonoïdes, polyphénols)\nCardiovasculaire : prévention athérosclérose, ↓ oxydation LDL",
            'contre_indications' => "Prudence si hyperuricémie ou antécédents calculs urinaires uriques (acidification urinaire peut favoriser leur apparition)\nDiabétiques : préférer extraits secs ou gélules standardisées (certains jus très sucrés)",
            'posologie' => "Jus pur non sucré : 1–2 verres/j (prévention continue ou cure 3 semaines)\nGélules standardisées PACs type A : dose efficace = 36 mg PACs/j\nEPS / Quantis : 1 c.c./j dans verre d'eau",
            'synergies' => "Échinacée + Piloselle (prévention récidives infections urinaires)\nBruyère + Busserole (cystites aiguës et inflammations urinaires)\nSauge + Trèfle rouge (prévention infections urinaires femme ménopausée)",
        ],
        [
            'categorie' => 'Sphère urinaire',
            'nom' => 'Épilobe à petites fleurs (Epilobium parviflorum)',
            'partie_utilisee' => 'Parties aériennes fleuries — Onagracées',
            'indication' => "Plante de choix pour les troubles prostatiques\nHBP : réduit œdème de la prostate, facilite la miction, calme douleurs\nAnti-inflammatoire, astringent, légèrement diurétique\nTonifie et répare la muqueuse urinaire\nAnti-inflammatoire puissant du tube digestif et des muqueuses intestinales\nSoutien post-opératoire (chirurgie prostate ou bas appareil urinaire)",
            'contre_indications' => "Femme enceinte ou allaitante (données insuffisantes)\nConstipation chronique (tanins)\nPrendre loin des repas et des médicaments (tanins ↓ absorption)",
            'posologie' => "Infusion : 1 c.s. plante sèche/25 cl, 10 min, 2–3 tasses/j\nTM : 30–50 gouttes, 2×/j\nEPS : 1–2 c.c./j",
            'synergies' => "Ortie racine + Sabal + Pygeum africanum (HBP complet)\nCassis + Reine-des-prés (douleurs et inflammations urinaires chroniques)\nBruyère + Busserole + Piloselle (infections urinaires avec gêne mictionnelle)",
        ],
        [
            'categorie' => 'Sphère urinaire',
            'nom' => 'Sabal – Palmier nain (Serenoa repens)',
            'partie_utilisee' => 'Fruit (baies mûres) — Arécacées',
            'indication' => "Plante de la prostate par excellence\nHBP : inhibe 5-alpha-réductase → ↓ DHT → freine augmentation volume prostatique\nAméliore la vidange vésicale, antispasmodique urinaire\nAnti-inflammatoire et décongestionnant prostatique\nTonique des tissus génito-urinaires (prostatites chroniques, incontinence)",
            'contre_indications' => "Femme enceinte ou allaitante\nEnfant et adolescent\nPrudence avec traitements hormonaux (anti-androgènes, substituts)",
            'posologie' => "EPS ou Quantis : 1 c.c. matin et soir\nTM : 40–50 gouttes, 2×/j\nGélules : 1–2/j selon le dosage",
            'synergies' => "Épilobe + Ortie racine + Pygeum africanum (traitement complet HBP)\nCassis + Reine-des-prés (inflammation chronique prostate)\nBruyère + Busserole (infections urinaires ou cystites associées)",
        ],
        [
            'categorie' => 'Sphère urinaire',
            'nom' => 'Ortie dioïque (racine) (Urtica dioica)',
            'partie_utilisee' => 'Racine — Urticacées',
            'indication' => "Régulateur de la prostate (phytostérols, lignanes)\nTroubles mictionnels HBP : jet faible, nycturie, sensation vidange incomplète\nInhibe partiellement 5-alpha-réductase → ↓ DHT\nAméliore symptômes urinaires (sans réduire le volume prostatique)\nDépurative et diurétique douce : élimine urée, acide urique\nRégulatrice hormonale masculine",
            'contre_indications' => "Prudence si traitement antihypertenseur ou anticoagulant (effet diurétique léger)",
            'posologie' => "EPS ou Quantis : 1–2 c.c./j, cure 1–3 mois\nTM : 30–50 gouttes, 2×/j\nGélules (poudre cryobroyée de racine) : 250–500 mg, 2×/j",
            'synergies' => "Sabal serrulata (synergique HBP — action hormonale + anti-inflammatoire)\nÉpilobe à petites fleurs (prostatites et congestion pelvienne)\nCassis + Reine-des-prés + Solidago (inflammation urinaire et douleurs pelviennes)",
        ],

        // ===== Sphère digestive et santé du foie (18 plantes) =====
        [
            'categorie' => 'Sphère digestive et santé du foie',
            'nom' => 'Chardon-Marie (Silybum marianum)',
            'partie_utilisee' => 'Feuille et graines — Astéracées',
            'indication' => "Hépato-protecteur et régénérateur majeur : protège et stimule la régénération des hépatocytes\nAntioxydant et antiradicalaire : utile contre effets rayons X, chimiothérapie, toxiques chimiques\nCholérétique : stimule production et élimination de la bile (n'est pas un dépuratif)\nFoie : cirrhose, stéatose hépatique, congestion de la veine porte, cholestase, prévention calculs biliaires\nPeau : améliore psoriasis et dermatoses (réduit leucotriènes et endotoxines)\nSystème hormonal : favorise l'élimination du surplus d'œstrogènes (fibrome, kyste, endométriose, SPM)\nReins : protège des effets néphrotoxiques de certains médicaments (chimio)",
            'contre_indications' => "Diabète : peut augmenter la sensibilité à l'insuline → risque d'hypoglycémie si association antidiabétiques\nInteractions possibles (enzymes hépatiques) : demander avis médical\nGrossesse et allaitement : déconseillée\nObstruction biliaire : contre-indiquée\nUsage prolongé possible jusqu'à 9 mois → faire ensuite des pauses régulières",
            'posologie' => "Graines moulues : 2–5 g/jour, en gélules ou saupoudrées (amertume prononcée)\nExtrait sec standardisé (65–80% silymarine) : 200–400 mg, 2–3×/j (soit ~600–1200 mg/j)\nPoudre de graines : en gélules",
            'synergies' => "Desmodium (foie, oncologie)\nSchisandra (hépatoprotection renforcée)\nPissenlit, Artichaut (cure hépato-rénale)",
        ],
        [
            'categorie' => 'Sphère digestive et santé du foie',
            'nom' => 'Romarin (Rosmarinus officinalis)',
            'partie_utilisee' => 'Feuilles et sommités fleuries — Lamiacées',
            'indication' => "Anti-inflammatoire digestif, favorise la motilité gastrique, anti-nausée\nAmère, cholérétique et cholagogue doux : stimule sucs gastriques, pancréatiques et biliaires\nStimulant de l'appétit et de la digestion\nBactéricide digestif (anti-candidosique, anti-fermentation)\nCarminatif et antispasmodique (gaz, crampes)\nHépatoprotecteur (moins puissant que le chardon-marie, mais réel)\nAstringent digestif sur muqueuses irritées ou infectées",
            'contre_indications' => "Pas de CI majeure aux doses usuelles ; prudence si épilepsie ou HTA avec formes concentrées (HE)",
            'posologie' => "Infusion : 1–2 c.c. feuilles/200 ml eau bouillante, 10 min, 2 tasses/j avant repas\nTM : 30–50 gouttes, 1–2×/j dans un peu d'eau",
            'synergies' => "Aunée + Pissenlit (digestion lente, foie)\nLierre terrestre + Artichaut + Pissenlit (drainage hépatique et biliaire)\nÉleuthérocoque + Ortie (fatigue, convalescence)",
        ],
        [
            'categorie' => 'Sphère digestive et santé du foie',
            'nom' => 'Pissenlit (Taraxacum officinale)',
            'partie_utilisee' => 'Racine (foie, pancréas, digestion) et feuilles (rein, diurétique) — Astéracées',
            'indication' => "Plante pivot du triangle foie–rein–cœur : cholérétique, diurétique, hypoglycémiante, dépurative cutanée\nCholérétique et cholagogue : stimule sécrétion et contraction de la vésicule biliaire (décoction = triple le flux biliaire)\nAmère, apéritive, digestive : relance appétit et sécrétions digestives\nDépuratif hépatique : congestion du foie, insuffisance hépatique, ictère, hépatites chroniques\nHypoglycémiant : stimule la production d'insuline, tonique pancréas (riche en inuline) — diabète de type 2\nDiurétique puissant apportant du potassium ; peau (acné, eczéma, association pissenlit-bardane)\nOs & reminéralisation : favorise fixation calcium et vitamine D",
            'contre_indications' => "Personnes fines, frêles, frileuses (plante trop drainante)\nHypotension (risque d'aggravation)\nSécheresse cutanée ou muqueuse (effet diurétique aggravant)\nObstruction des voies biliaires, calculs biliaires\nPossibles interactions médicamenteuses (hépatobiliaires, diurétiques)",
            'posologie' => "Décoction (racines) : 25 g/L, bouillir 5 min, infuser 10 min ; 1 tasse avant chaque repas\nInfusion (feuilles) : 2 c.c./200 ml, 10 min, 2–3 tasses/j\nTM : 30–50 gouttes, 2–3×/j",
            'synergies' => "Bardane + Fumeterre (drainage hépatique, cure de printemps)\nMyrtille + Gymnema + Olivier (diabète de type 2)\nAubier de tilleul, Romarin (détox hépato-rénale)",
        ],
        [
            'categorie' => 'Sphère digestive et santé du foie',
            'nom' => 'Myrtille (Vaccinium myrtillus)',
            'partie_utilisee' => 'Feuilles et baies — Ericaceae',
            'indication' => "Astringente (tanins) : anti-diarrhéique, anti-colibacillaire (E. coli)\nAnti-inflammatoire et antiseptique (digestif, urinaire)\nVeinotonique et microcirculatoire : fragilité capillaire, insuffisance veineuse/lymphatique\nAntioxydante (anthocyanes) : protection vasculaire et oculaire\nAntidiabétique (feuilles surtout) : action hypoglycémiante, stabilise la glycémie post-prandiale (diabète de type 2)\nEffet protecteur sur complications diabétiques : microcirculation, rétine, reins et petits vaisseaux",
            'contre_indications' => "Prudence avec les feuilles : pas d'usage prolongé sans suivi (risque hypoglycémie marquée)\nSurveillance si déjà sous antidiabétiques oraux ou insuline (effet additif)",
            'posologie' => "Infusion (feuilles) : 10–30 g/L, 1 tasse 2–3×/j avant repas, cure de 2–3 semaines max puis pause\nPoudre/lyophilisat d'anthocyanes (baies) : 1–2 doses/j en soutien de la rémission (RCH)",
            'synergies' => "Gymnema + Olivier + Pissenlit + Bardane + Aigremoine (mélange détox diabète type 2)\nCurcuma (soutien RCH/inflammation intestinale)",
        ],
        [
            'categorie' => 'Sphère digestive et santé du foie',
            'nom' => 'Gymnema (Gymnema sylvestre)',
            'partie_utilisee' => 'Feuille — Asclépiadacées',
            'indication' => "Antidiabétique majeur : stimule la production d'insuline (action pancréatique)\nAméliore la sensibilité à l'insuline, inhibe partiellement l'absorption intestinale du glucose\nDiminue la conversion du sucre en graisses (soutien poids & métabolisme)\nCoupe-faim du sucre : acides gymnémiques bloquent les récepteurs du goût sucré\nHypolipémiant : baisse triglycérides et cholestérol\nTonique du pancréas, diabète de type 2 avec insulino-résistance",
            'contre_indications' => "Hypoglycémie : peut potentialiser antidiabétiques oraux et insuline\nSurveillance médicale indispensable chez les diabétiques sous traitement",
            'posologie' => "Poudre/gélules : 200–400 mg, 2–3×/j avant repas\nExtrait sec standardisé (25% acides gymnémiques) : 200–300 mg, 2×/j\nCure de 3 à 6 mois, souvent en association (cannelle, myrtille, fenugrec, olivier)",
            'synergies' => "Myrtille + Olivier + Pissenlit (diabète de type 2, syndrome métabolique)\nBerbérine, Chrome (alternance en cure, terrain diabétique)",
        ],
        [
            'categorie' => 'Sphère digestive et santé du foie',
            'nom' => 'Fenouil (Foeniculum vulgare)',
            'partie_utilisee' => 'Graines — Apiacées',
            'indication' => "Carminatif digestif doux : réduit gaz, ballonnements, flatulences, aérophagie, fermentation intestinale\nSpasmolytique : colites, crampes digestives, hoquet\nCholérétique léger : meilleure digestion des graisses\nSoulage nausées, vomissements, aigreurs d'estomac\nRégule le transit (diarrhée ou constipation spastique, souvent combiné à pissenlit, mauve)\nPédiatrie : apaise les coliques du nourrisson\nGalactogène : stimule production de lait maternel\nRespiratoire : expectorant léger",
            'contre_indications' => "Femme enceinte (activité œstrogène-like)\nAntécédent de cancer hormonodépendant\nÀ forte dose (>7 g/j, usage prolongé) : risque de convulsions/épilepsie",
            'posologie' => "Infusion : 1–3 g/tasse (≈1 c.c. rase), 10 min à couvert, 2–3 tasses/j après repas\nTM : 25–50 gouttes, 2–3×/j\nColique du nourrisson : ½ c.c. par tasse, donner 1 c.c. d'infusion diluée",
            'synergies' => "Mélisse + Camomille matricaire (côlon irritable, ballonnements)\nMenthe poivrée + Curcuma (digestion lente, lourdeur)",
        ],
        [
            'categorie' => 'Sphère digestive et santé du foie',
            'nom' => 'Menthe poivrée (Mentha x piperita)',
            'partie_utilisee' => 'Feuilles — Lamiaceae',
            'indication' => "Digestive : carminative, antispasmodique, stimule la sécrétion biliaire\nAntalgique et antinauséeuse : céphalées, migraines, mal des transports\nTonique : stimule le système nerveux (effet coup de fouet)\nAntiseptique et rafraîchissante (menthol), inhibe la synthèse du biofilm d'Helicobacter pylori\nTroubles digestifs : ballonnements, nausées, coliques, flatulences, crampes abdominales\nInsuffisance hépatique légère (stimule bile, estomac lourd)\nCôlon irritable : soulage crampes et ballonnements (effet clinique validé)",
            'contre_indications' => "Femmes enceintes/allaitantes, enfants < 6 ans (HE)\nReflux gastro-œsophagien sévère, ulcères, épilepsie\nHE dermocaustique (jamais pure sur grande surface)",
            'posologie' => "Infusion : 1 c.c. feuilles sèches/tasse, 2–3 tasses/j après repas\nTM : 30–50 gouttes dans un peu d'eau, 1–3×/j\nHydrolat : 1 c.s. dans de l'eau\nHE encapsulée gastro-résistante (côlon irritable) : 0,2 ml, 1–2 capsules/j, à éviter si reflux important",
            'synergies' => "Mélisse + Fenouil + Camomille matricaire (côlon irritable)\nCurcuma (protocole côlon irritable, digestion lente)",
        ],
        [
            'categorie' => 'Sphère digestive et santé du foie',
            'nom' => 'Souci / Calendula (Calendula officinalis)',
            'partie_utilisee' => 'Fleurs — Astéracées',
            'indication' => "Vulnéraire interne : cicatrisant de la muqueuse digestive\nUlcères peptiques, duodénaux, colite ulcéreuse, hyperperméabilité intestinale\nApaise inflammations gastro-intestinales et œsophagiennes\nRiche en mucilages : adoucissant, protecteur\nSphère cutanée : vulnéraire, cicatrisant, anti-inflammatoire, antiseptique, antifongique\nSphère gynécologique : emménagogue doux, régularise et apaise les règles\nAction veineuse, circulatoire et lymphatique : décongestionne, prévient œdèmes",
            'contre_indications' => "Allergie aux Astéracées\nGrossesse : prudence (effet emménagogue léger)",
            'posologie' => "Infusion (muqueuses digestives) : 2–4 g de fleurs séchées/tasse, 10 min à couvert, 2–3 tasses/j (souvent avec mauve, guimauve, mélisse, camomille)\nTeinture mère : usage dilué interne/externe (infection, plaie, mycose)\nMacérât huileux : peau, radiothérapie, eczéma, brûlures\nCompresse/lavage : plaies, gencives, yeux, muqueuses",
            'synergies' => "Mauve, Guimauve (adoucissantes digestives)\nMélisse, Camomille matricaire (digestion nerveuse)\nAchillée (troubles gynécologiques et digestifs associés)",
        ],
        [
            'categorie' => 'Sphère digestive et santé du foie',
            'nom' => 'Gentiane (Gentiana lutea)',
            'partie_utilisee' => 'Racine — Gentianaceae',
            'indication' => "Amère par excellence : apéritive, stimule l'appétit\nEupeptique : facilite la digestion gastrique (inappétence, gastrites chroniques, indigestions)\nAccélère la vidange gastrique\nStimule les sécrétions digestives (HCl, pepsine, salive, enzymes pancréatiques, sécrétion biliaire)\nCholagogue et hépato-protectrice : aide en cas de constipation chronique liée à paresse biliaire\nAntispasmodique intestinal, vermifuge traditionnel, fébrifuge léger",
            'contre_indications' => "Grossesse et allaitement\nUlcère gastro-duodénal\nÀ éviter le soir (peut perturber le sommeil)\nFortes doses : risque de maux de tête, vomissements, irritation gastrique",
            'posologie' => "Décoction : 1–2 g racine séchée/tasse (≈½ c.c.), macérer 5–10 min à froid puis ébullition douce 2–3 min, infuser 10 min ; ½–1 tasse avant repas (cures courtes, goût très amer)\nTM : 15–25 gouttes dans un peu d'eau, 1–3×/j avant les repas",
            'synergies' => "Lapacho + Cassis (soutien immunitaire en cure)\nAigremoine, Romarin (tonique digestif)",
        ],
        [
            'categorie' => 'Sphère digestive et santé du foie',
            'nom' => 'Aigremoine (Agrimonia eupatoria)',
            'partie_utilisee' => 'Sommités fleuries — Rosaceae',
            'indication' => "Astringente douce (tanins) : diarrhées légères, colites\nCholagogue, cholérétique : stimule les sécrétions biliaires\nApaisante des muqueuses digestives : gastrites, entérites, dyspepsies\nFavorise la fonction hépatique (insuffisance hépatobiliaire légère), légère action dépurative\nVoies respiratoires & ORL : astringente et anti-inflammatoire des muqueuses (angines, pharyngites, gargarisme)\nLégèrement hémostatique (saignements mineurs, gencives), tonique veineux léger",
            'contre_indications' => "Peut diminuer l'absorption de médicaments pris simultanément (attendre 1h entre les prises)",
            'posologie' => "Infusion : 10–15 g/L eau bouillante, 10 min, 2–3 tasses/j\nDécoction (gargarismes/externe) : 20–30 g/L, bouillir 5 min\nTM (1:10) : 30–50 gouttes, 2–3×/j\nPoudre : 1–2 g, 1–2×/j",
            'synergies' => "Myrtille, Gymnema, Olivier, Pissenlit, Bardane (mélange détox/diabète de type 2)\nAchillée millefeuille (astringence digestive)",
        ],
        [
            'categorie' => 'Sphère digestive et santé du foie',
            'nom' => 'Noyer (Juglans regia) - bourgeon',
            'partie_utilisee' => 'Bourgeons frais (gemmothérapie) — Juglandacées',
            'indication' => "Régulateur de la flore intestinale : restaure l'équilibre du microbiote après désordres digestifs ou antibiotiques\nAntiseptique intestinal doux : limite fermentations excessives, ballonnements, diarrhées ou alternances\nColites, entérocolites et troubles inflammatoires légers du tube digestif\nStimulant digestif : améliore assimilation, travail enzymatique et sécrétion biliaire\nProtecteur muqueux (intestin grêle, côlon), soutien candidoses intestinales (avec autres bourgeons)\nMétabolique : aide à réguler les sucres sanguins ; peau : soutien indirect (axe foie-intestin-peau)",
            'contre_indications' => "Prudence chez la femme enceinte/allaitante\nSurveiller en cas de traitement hypoglycémiant (effet possible sur la glycémie)",
            'posologie' => "Gemmothérapie : 5–15 gouttes/jour dans un peu d'eau, en 1 à 3 prises, avant les repas",
            'synergies' => "Probiotiques (S. boulardii, multi-souches) en soutien de la flore\nCurcuma, Réglisse (inflammation intestinale)",
        ],
        [
            'categorie' => 'Sphère digestive et santé du foie',
            'nom' => 'Mauve (Malva sylvestris)',
            'partie_utilisee' => 'Fleurs (parfois feuilles, graines) — Malvaceae',
            'indication' => "Laxative douce à mucilages (effet mécanique)\nÉmolliente et anti-inflammatoire : protège muqueuses digestives, respiratoires, urinaires, cutanées\nAdoucissante et protectrice des muqueuses\nPectorale : calme toux, gorge irritée, voies respiratoires\nVulnéraire : cicatrisante, apaisante sur la peau",
            'contre_indications' => "Grossesse et allaitement\nEnfants < 15 ans\nUsage occasionnel uniquement (pas plus de 10 jours)\nPas en cas d'occlusion intestinale, colites, gastralgies\nPrendre avec beaucoup d'eau (risque d'arrêt œsophagien des mucilages)\nEspacer d'au moins 1h avec d'autres médicaments (mucilages gênent l'absorption)",
            'posologie' => "Infusion (pas de teinture, les mucilages ne s'extraient pas dans l'alcool)",
            'synergies' => "Guimauve, Plantain (protection des muqueuses)\nTilleul, Verveine, Anis vert, Basilic (tisane ballonnements et gaz)",
        ],
        [
            'categorie' => 'Sphère digestive et santé du foie',
            'nom' => 'Guimauve (Althaea officinalis)',
            'partie_utilisee' => 'Racine (parfois feuille, moins concentrée) — Malvaceae',
            'indication' => "Émolliente par excellence : hydrate, adoucit, protège (40% de mucilages dans la racine)\nProtectrice et régénératrice des muqueuses digestives, respiratoires, urinaires, cutanées\nAnti-inflammatoire douce : apaise rougeurs, irritations, sécheresses\nHyperacidité, reflux, brûlures d'estomac, ulcères gastriques et duodénaux\nGastrite, entérite, colite, inflammations digestives chroniques\nHydrate le bol alimentaire et facilite le transit",
            'contre_indications' => "Aucune majeure aux doses usuelles ; pas de décoction (détruit les mucilages)",
            'posologie' => "Infusion douce ou macération à froid : ¼ tasse de copeaux de racine + ¾ eau froide, laisser reposer toute une nuit\nPoudre : 6 g/200 ml eau froide, laisser 1h en remuant les 10 premières minutes",
            'synergies' => "Plantain, Bouillon blanc (poumons fragiles, toux chronique)\nMauve, Réglisse (muqueuses digestives)\nTisane SOS muqueuse : guimauve racine + plantain + camomille matricaire (MICI, infusion longue 20–30 min)",
        ],
        [
            'categorie' => 'Sphère digestive et santé du foie',
            'nom' => 'Réglisse (Glycyrrhiza glabra)',
            'partie_utilisee' => 'Racine — Fabaceae',
            'indication' => "Anti-acide et protectrice : dépose un film protecteur, cicatrisation des muqueuses (ulcères, gastrites)\nAnti-Helicobacter pylori (acide glycyrrhétinique)\nRéduit les sécrétions gastriques : bénéfique en cas de reflux gastro-œsophagien\nÉmolliente, adoucissante dans les MICI (Crohn, RCH), hyperperméabilité intestinale\nAntispasmodique, hépatoprotectrice et antioxydante ; diurétique et laxative douce\nHormonale : stimule surrénales (hypotension, épuisement), cortisone-like ; antivirale et immunostimulante",
            'contre_indications' => "Pas plus de 6 semaines sans avis médical\nDéconseillée chez la femme enceinte et allaitante\nÀ éviter : hypertension, hypokaliémie, insuffisance rénale ou cardiaque, œdèmes, antécédents de cancer hormonodépendant\nForme non-DGL : prudence si HTA ou traitement cardiovasculaire (préférer la réglisse déglycyrrhizinée en usage muqueux au long cours)",
            'posologie' => "Décoction : 5–10 g racine sèche/500 ml, 10–15 min, 2–3×/j\nTeinture : 25–50 gouttes, 1–3×/j, avant les repas\nForme DGL (déglycyrrhizinée) en tisane : associée à camomille matricaire + mélisse (protocole MICI)",
            'synergies' => "Camomille matricaire + Mélisse (tisane apaisement muqueuse, protocole Crohn)\nGuimauve, Mauve, Plantain (protection des muqueuses)",
        ],
        [
            'categorie' => 'Sphère digestive et santé du foie',
            'nom' => 'Curcuma (Curcuma longa)',
            'partie_utilisee' => 'Rhizome — Zingiberaceae',
            'indication' => "Anti-inflammatoire viscéral et antibactérien, effet prébiotique\nAnti-inflammatoire gastrique, effet antibactérien contre Helicobacter pylori\n↑ sécrétion de gastrine, protection des muqueuses (ulcères induits par alcool, AINS, stress)\nDyspepsie, lenteur digestive, ballonnements ; gastrites & ulcères gastro-duodénaux (adjuvant)\nMICI (RCH, Crohn), troubles fonctionnels intestinaux (SII, hyperperméabilité, diarrhée)\nFoie & voies biliaires : cholagogue et hépato-protecteur léger\nCôlon irritable : régule le transit, soutient le foie, calme les fermentations intestinales",
            'contre_indications' => "Obstruction des voies biliaires, cholangite, maladies biliaires ou hépatiques actives, calculs biliaires (sauf avis médical)\nGrossesse/allaitement : éviter les fortes doses de compléments\nInteractions : prudence avec anticoagulants et antiagrégants",
            'posologie' => "Extrait de curcuminoïdes avec adjuvant d'absorption (pipérine) : 500–1500 mg/j en 1–3 prises\nDécoction : 2 c.c. racines concassées/250 ml, bouillir 3–5 min puis infuser 5–10 min, 1–3 tasses/j\nMICI (cure douce) : 500–750 mg/j ; cure renforcée : 500–750 mg 2×/j",
            'synergies' => "Boswellia + PEA (protocole Crohn/RCH)\nGingembre, Boswellia (anti-inflammatoire global articulations/intestins)\nMenthe poivrée, Mélisse, Camomille matricaire (côlon irritable)",
        ],
        [
            'categorie' => 'Sphère digestive et santé du foie',
            'nom' => 'Cannelle (Cinnamomum verum)',
            'partie_utilisee' => 'Écorce — Lauracées',
            'indication' => "Métabolisme & diabète : régule la glycémie (↑ sensibilité à l'insuline), utile diabète de type 2\nDigestive : carminative, diminue les ballonnements, stimule la digestion\nCardio-métabolique : aide à réduire cholestérol et triglycérides\nAnti-infectieuse : antibactérienne, antivirale, antifongique (surtout HE)\nTonique : réchauffante, stimule la circulation, utile en cas de fatigue ou frilosité",
            'contre_indications' => "Grossesse et allaitement (fortes doses)\nEnfant < 6 ans (huile essentielle)\nIrritante pour muqueuses et peau (HE)\nPrudence si traitement anticoagulant ou antidiabétique (effet additif potentiel)",
            'posologie' => "Infusion/décoction (écorce en morceaux) : 1 bâton ou 1 c.c./250 ml, bouillir 5 min, 1–2 tasses/j\nPoudre : 1–4 g/jour en cure courte\nHydrolat : 1 c.s. dans un verre d'eau tiède, matin et soir avant de manger (tonique, anti-fringale de sucre, hypoglycémiante)",
            'synergies' => "Myrtille, Gymnema, Olivier (protocole diabète de type 2)\nGingembre, Citron, Origan (mélange HE santé intestinale)",
        ],
        [
            'categorie' => 'Sphère digestive et santé du foie',
            'nom' => 'Ail (Allium sativum)',
            'partie_utilisee' => 'Bulbe — Amaryllidaceae',
            'indication' => "Métabolisme & diabète : hypoglycémiant léger, améliore la sensibilité à l'insuline\nHypolipémiant : ↓ cholestérol total et LDL, ↑ HDL, régule triglycérides\nCardiovasculaire : hypotenseur doux, fluidifie le sang (antiagrégant plaquettaire), prévention athérosclérose\nAnti-infectieux à large spectre : antibactérien, antiviral, antifongique (mycoses digestives, candidoses)\nDigestif & hépatique : cholagogue, stimule sécrétions digestives, vermifuge doux, favorise la détox hépatique",
            'contre_indications' => "Prudence si traitement anticoagulant/antiagrégant (risque hémorragique)\nUlcère gastro-duodénal actif, gastrite sévère (peut majorer l'irritation digestive)",
            'posologie' => "Bulbe cru ou cuit : 1–2 gousses/jour (équiv. 2–5 g bulbe frais)\nPoudre : 600–1200 mg/j\nExtrait sec standardisé : 300–600 mg, 2–3×/j\nTM (1:10) : 20–50 gouttes, 1–3×/j",
            'synergies' => "Olivier, Aubépine (prévention athérosclérose et hypercholestérolémie)\nCurcuma, Gingembre (anti-inflammatoire, détox hépatique)",
        ],
        [
            'categorie' => 'Sphère digestive et santé du foie',
            'nom' => 'Aloe vera (Aloe vera / barbadensis)',
            'partie_utilisee' => 'Gel de la feuille — Asphodelaceae',
            'indication' => "Apaisement de la muqueuse intestinale et cicatrisation (formes légères à modérées de RCH)\nRégule le transit, diminue la fermentation intestinale\nCôlon irritable : apaise la muqueuse, régule le transit lent\nSoutien dans les MICI (Crohn, RCH) en complément d'un suivi médical",
            'contre_indications' => "Utiliser un gel buvable pur, sans aloïne (laxatif irritant)\nGrossesse/allaitement : avis médical avant usage\nCe document ne remplace pas un avis médical — les MICI nécessitent un suivi spécialisé",
            'posologie' => "Gel buvable pur : 25–50 ml, 1–2×/j, loin des repas ou à jeun\nCôlon irritable : 1 c.c. de gel après les repas, si toléré",
            'synergies' => "Curcuma (protocole RCH et côlon irritable)\nMyrtille (soutien de la rémission RCH)\nProbiotiques (S. boulardii, E. coli Nissle 1917, multi-souches) en entretien MICI/SII",
        ],
    ];
}

/**
 * Aromatologie — 20 huiles essentielles (notes de cours manuscrites).
 */
function getRessourcesAromatologie(): array {
    return [
        [
            'categorie' => 'Système digestif',
            'nom' => 'HE Citron (Citrus limon)',
            'partie_utilisee' => 'Zeste (péricarpe)',
            'description' => "Famille botanique : Rutacées. Mode d'obtention : expression à froid du zeste. Famille biochimique : monoterpènes (limonène majoritaire, pinène, terpinène), aldéhydes (géranial), coumarines et furocoumarines, traces de monoterpénols (linalol) et d'esters (acétate de géranyle/néryle).",
            'indication' => "Anti-infectieuse puissante : bactéries, virus, champignons\nImmunomodulante\nDécongestionnante respiratoire, fébrifuge\nDigestive : apéritive, stomachique, carminative, anti-acidité\nHépatoprotectrice et dépurative hépatique : cholagogue, cholérétique, régénère les hépatocytes, stimule le pancréas\nAnti-nauséeuse (utilisable en olfaction même chez la femme enceinte)\nDépurative générale des émonctoires\nAction type « vitamine P » : tonifie les parois vasculaires, favorise la microcirculation et le drainage des toxines\nHypolipémiante, hypocholestérolémiante\nDiurétique, lymphotonique, antihypertensive\nCicatrisante, antiprurigineuse, anti-couperose, anti-séborrhéique (entretient la jeunesse des tissus cutanés)\nTonique psychique et nerveux : clarté d'esprit, détente, anxiolytique, antidépressive, stimule la concentration, favorise l'optimisme et la flexibilité mentale",
            'contre_indications' => "Irritante pour la peau et photosensibilisante (éviter l'exposition au soleil après application cutanée)\nDéconseillée en cas de traitement anticoagulant",
            'posologie' => "Voie cutanée, olfaction, diffusion (bien diluer, huile épaisse) ou ingestion (pure, dans HV, en gélule ou dans du miel)\nSoutien du foie : application locale + voie orale, jusqu'à 10 gouttes 3×/jour\nInfections : application locale diluée dans le dos et sous la voûte plantaire + voie orale\nBien tolérée chez l'enfant, y compris en diffusion",
            'conseil_du_moment' => "",
            'synergies' => "",
            'notes' => "",
        ],
        [
            'categorie' => 'Système respiratoire',
            'nom' => 'HE Niaouli (Melaleuca quinquenervia)',
            'partie_utilisee' => 'Jeunes rameaux feuillés',
            'description' => "Famille botanique : Myrtacées. Mode d'obtention : distillation par entraînement à la vapeur d'eau. Famille biochimique : oxydes (1,8-cinéole 50-65%), monoterpènes 15-20% (pinène, limonène), sesquiterpénols 5-20% (viridiflorol, nérolidol), monoterpénols 7-15% (terpinéol, géraniol, linalol).",
            'indication' => "Anti-infectieuse à large spectre : bactéries, virus, champignons, parasites\nStimulante immunitaire, immunomodulatrice\nDécongestionnant respiratoire, balsamique, expectorant, mucolytique\nStimulante du pancréas, du foie et de la vésicule biliaire : cholérétique, cholagogue, aide à la digestion des graisses\nDécongestionnante veineuse, tonifiante circulatoire\nAntispasmodique, anti-inflammatoire\nProtectrice et régénératrice cutanée, radioprotectrice\nÉquilibrante du système nerveux\nAide à se protéger émotionnellement (« vampirisme énergétique »), soutient face à la trahison, favorise la concentration",
            'contre_indications' => "À éviter chez la femme enceinte de moins de 6 mois et l'enfant de moins de 4 ans\nÀ éviter en cas d'antécédents de cancer hormono-dépendant",
            'posologie' => "Toux/bronches : massage sur le dos avec menthe poivrée\nPrévention hivernale : olfaction ou application locale\nRadiothérapie : pure avant la séance (ou diluée dans gel d'aloe vera)\nDigestion/foie : synergie avec menthe poivrée\nInhalation avec eucalyptus radié pour bronchite/sinusite ; avec ravintsara + menthe poivrée pour fièvre/sinusite\nHerpès : pure, 1-2 gouttes (seule ou + menthe poivrée)\nJambes lourdes : avec cyprès\nDouleurs musculaires, fatigue : application sur les surrénales\nDigestion avec cannelle de Ceylan diluée (parasites intestinaux) ou avec basilic exotique",
            'conseil_du_moment' => "",
            'synergies' => "Menthe poivrée (toux, migraines), eucalyptus radié (bronchite, sinusite), ravintsara (fièvre, sinusite, immunité hiver), cyprès (jambes lourdes), cannelle de Ceylan / basilic exotique (digestion)",
            'notes' => "",
        ],
        [
            'categorie' => 'Système cutané',
            'nom' => 'HE Palmarosa (Cymbopogon martinii var. motia)',
            'partie_utilisee' => 'Parties aériennes fleuries (herbe)',
            'description' => "Famille botanique : Poacées. Mode d'obtention : distillation par entraînement à la vapeur d'eau. Famille biochimique : monoterpénols 80-95% (géraniol, linalol), esters 5-35% (acétate de géranyle, butanoate de géranyle).",
            'indication' => "Anti-infectieuse bien tolérée : bactéries, virus, champignons, parasites, insectes\nStimulante immunitaire\nStimulante de la circulation lymphatique, drainante\nStimulante de la circulation sanguine et du système neuro-hormonal, légèrement cardiotonique\nUtérotonique, spasmolytique\nNeurotonique, harmonisante nerveuse\nStimulante cellulaire cutanée : cicatrisante, revitalisante, apaisante\nRégulatrice du sébum et de la transpiration, hydratante cutanée (peaux sèches, eczéma, acné, plaies)\nSur le plan émotionnel : nettoie l'excès de « chaleur » des émotions, travaille sur la culpabilité, ouvre le chakra du cœur, aide à s'affirmer face au manque d'amour maternel ou à des relations parentales non aidantes",
            'contre_indications' => "Interdite chez la femme enceinte (sauf usage bas-ventre lors de l'accouchement)",
            'posologie' => "Crème de jour : 2 gouttes pour sébum/acné\nImmunité : 1 goutte/jour\nAcné : 1 goutte pure sur coton-tige\nMycoses : diluée dans HV de coco (usage externe et parfois voie orale)\nCheveux gras : dans le shampoing / après-shampoing\nTranspiration : application locale diluée\nMassage dos/épaules : détente et regain d'énergie\nMycoses vaginales : diluée (coco, calendula, aloe vera), en synergie avec lavande vraie / tea tree / géranium\nOtite : pourtour de l'oreille uniquement (jamais dans l'oreille)\nSinusite : application sur les sinus ou inhalation\nDiffusion : prévention des infections et des moustiques",
            'conseil_du_moment' => "",
            'synergies' => "Lavande vraie, tea tree, géranium (mycoses cutanées et vaginales, eczéma)",
            'notes' => "",
        ],
        [
            'categorie' => 'Système digestif',
            'nom' => 'HE Gingembre (Zingiber officinale)',
            'partie_utilisee' => 'Rhizome',
            'description' => "Famille botanique : Zingibéracées. Mode d'obtention : distillation par entraînement à la vapeur d'eau. Famille biochimique : sesquiterpènes 50-60% (zingibérène, sesquiphellandrène, bisabolène, curcumène), monoterpènes 15-25% (camphène, pinène, limonène), traces de sesquiterpénols, monoterpénols et aldéhydes.",
            'indication' => "Anti-infectieuse (bactéries, champignons), immunomodulante\nStimulante digestive, antiulcéreuse, anti-nauséeuse\nAnti-inflammatoire, antalgique, antispasmodique\nAntitussive, expectorante\nDécongestionnante veineuse, lymphatique et prostatique\nRégénérante tissulaire, antihypertensive, antioxydante\nRéchauffante, sudorifique, facilite l'élimination des toxines\nTonique générale et tonique sexuelle, surtout masculine\nAide à lâcher prise, à traverser les crises, à transformer les peurs, stimule la créativité",
            'contre_indications' => "Précaution chez la femme enceinte de moins de 3 mois et l'enfant de moins de 3 ans\nDéconseillée en cas de traitement anticoagulant (fluidifiante)",
            'posologie' => "Digestion : inappétence, nausées (y compris mal des transports, en olfaction chez la femme enceinte), flatulences, constipation\nDouleurs articulaires et musculaires, rhumatismes\nDouleurs dentaires (abcès)\nSphère reproductrice : douleurs menstruelles, ménopause, impuissance, frigidité\nChute de cheveux : stimule la microcirculation du cuir chevelu\nVoie cutanée diluée dans HV, voie orale ou diffusion",
            'conseil_du_moment' => "",
            'synergies' => "",
            'notes' => "",
        ],
        [
            'categorie' => 'Système cardiovasculaire',
            'nom' => 'HE Immortelle (Helichrysum italicum)',
            'partie_utilisee' => 'Sommités fleuries',
            'description' => "Famille botanique : Astéracées. Mode d'obtention : distillation par entraînement à la vapeur d'eau. Famille biochimique : esters ~70% (acétate de néryle, propionate de néryle), monoterpènes (pinène, curcumène, limonène), dicétones (italidiones), sesquiterpènes, sesquiterpénols, monoterpénols (nérol).",
            'indication' => "Anti-infectieuse légère, immunomodulante\nTonique veineuse et lymphatique, fluidifiante sanguine, protectrice capillaire, anticoagulante, anti-hématome — surnommée « l'arnica des HE » (antiphlébitique, fibrinolytique)\nMucolytique, expectorante, anticatarrhale\nAnti-inflammatoire, antalgique, antispasmodique (musculaire et vasculaire)\nStimulante hépatobiliaire\nAntidiabétique, hypocholestérolémiante\nCicatrisante\nStimulante du SNC, neurotonique, calmante, relaxante, sédative, légèrement hypotensive, équilibrante nerveuse\nSur le plan émotionnel : relie à la Terre, apporte la résilience, fait remonter les traumatismes physiques et psychiques, libère la cage thoracique, débloque le bassin (traumatismes, abus), cicatrisante émotionnelle ; utile chez l'enfant pour les traumatismes de naissance ; grande huile des chocs et des deuils (associée à la camomille noble)",
            'contre_indications' => "Déconseillée chez la femme enceinte/allaitante et l'enfant de moins de 12 mois\nÀ éviter en cas de traitement anticoagulant",
            'posologie' => "Avant/après interventions chirurgicales : application locale (en complément d'arnica en homéopathie)\nEntorses, tendinites : massage dans HV\nCouperose, varices : avec cyprès\nJambes lourdes : avec menthe poivrée\nŒdèmes, hématomes, contusions : massage local\nCrises de nerfs, stress : olfaction\nSoins du visage : avec camomille noble + calendula\nProblèmes circulatoires : fragilité capillaire, couperose, insuffisance veineuse/lymphatique, hémorroïdes, engelures, syndrome de Raynaud, cellulite\nVoies respiratoires : encombrement, coqueluche (toux spasmodique)\nRhumatismes, arthrose, arthrite, polyarthrite\nPeau : acné, psoriasis, brûlures, plaies, coups de soleil, vergétures, rides\nAntidiabétique/hypocholestérolémiant : application sur le ventre avec ylang-ylang",
            'conseil_du_moment' => "",
            'synergies' => "Cyprès (couperose, varices), menthe poivrée (jambes lourdes), camomille noble (chocs émotionnels, soins visage), ylang-ylang (diabète, cholestérol)",
            'notes' => "",
        ],
        [
            'categorie' => 'Système nerveux',
            'nom' => 'HE de Bergamote (Citrus bergamia)',
            'partie_utilisee' => 'Zeste (péricarpe)',
            'description' => "Famille botanique : Rutacées. Mode d'obtention : expression à froid du zeste. Famille biochimique : monoterpènes (limonène, pinène), esters (acétate de linalyle ~40%), monoterpénols (linalol, nérol, géraniol, terpinéol), traces de coumarines/furocoumarines (bergaptène) et de sesquiterpènes.",
            'indication' => "Très antispasmodique\nAnti-infectieuse intéressante (bactéries, champignons, parasites), notamment en diffusion atmosphérique\nDigestive : cholérétique, cholagogue, carminative, laxative, anti-nauséeuse\nAntalgique, anti-inflammatoire\nHypocholestérolémiante, hypoglycémiante\nCalmante, sédative, joyeuse, optimiste : épuisement nerveux, anxiété, troubles du sommeil\nRégulatrice hormonale (ovaires)\nCicatrisante cutanée\nRégulatrice du système nerveux autonome (sympathique/parasympathique)\nSur le plan émotionnel : dilate le cœur, aide à lâcher le contrôle et les dépendances, dissout les rigidités mentales, libère du jugement et de la culpabilité, apporte gaieté, fraîcheur, confiance, spontanéité, facilite la prise de parole en public",
            'contre_indications' => "Irritante pour la peau, photosensibilisante\nÀ ne pas utiliser en cas de calculs biliaires (mobilise les calculs)\nÀ distance des médicaments à marge thérapeutique étroite (lévothyrox, anticancéreux, immunosuppresseurs)",
            'posologie' => "Digestion, spasmes : massage avec menthe poivrée\nMal des transports\nPerte de vitalité, élan : olfaction, poignets, plexus\nPéri-ménopause/ménopause : olfaction, régulation hormonale (avec géranium, hélichryse, lavande)\nDéprime, anxiété, stress, endormissement, manque de confiance : olfaction\nInfections bactériennes/mycosiques : diffusion\nPeau : dermatoses, eczéma ; cheveux gras\nRoll-on poignets 50/50 avec ylang-ylang",
            'conseil_du_moment' => "",
            'synergies' => "Menthe poivrée (spasmes digestifs), ylang-ylang (roll-on relaxant), géranium/hélichryse/lavande (ménopause), gingembre (digestion)",
            'notes' => "",
        ],
        [
            'categorie' => 'Système nerveux',
            'nom' => 'HE Orange douce (Citrus sinensis)',
            'partie_utilisee' => 'Zeste (péricarpe)',
            'description' => "Famille botanique : Rutacées. Mode d'obtention : expression à froid du zeste. Famille biochimique : monoterpènes 60-95% (limonène, myrcène, pinène), monoterpénols (linalol, géraniol, farnésol), aldéhydes terpéniques (citrals), coumarines/furocoumarines.",
            'indication' => "Belle anti-infectieuse : bactéries, virus, champignons ; désinfectante atmosphérique (à diluer, huile épaisse)\nCalmante, sédative, anxiolytique\nAction sur la digestion : stomachique, carminative, stimule la motilité gastrique, cholérétique, cholagogue\nFluidifiante sanguine, vasodilatatrice\nSpasmolytique, immunomodulante\nSur le plan émotionnel : s'adresse à l'enfant intérieur avec tendresse, aide à lâcher le contrôle et à sortir de la zone de confort, agit sur le foie en libérant les colères en douceur",
            'contre_indications' => "Éviter l'application pure sur peaux sensibles\nLégèrement photosensibilisante\nAttention si calculs biliaires (mobilise les calculs)",
            'posologie' => "Diffusion pour assainir l'air (avec menthe poivrée + citron)\nNervosité, sommeil : olfaction, en synergie avec lavande vraie et petit grain bigarade\nTroubles digestifs : voie orale diluée dans huile d'olive\nDétox du foie : avec menthe poivrée, basilic ou livèche\nNausées, vésicule paresseuse (repas gras)\nConstipation/diarrhée : avec gingembre\nCirculation : cellulite, rétention d'eau, jambes lourdes, varices\nConcentration, créativité : avec romarin à cinéole",
            'conseil_du_moment' => "",
            'synergies' => "Lavande vraie + petit grain bigarade (sommeil), menthe poivrée/basilic (détox foie), gingembre (transit), romarin à cinéole (concentration)",
            'notes' => "",
        ],
        [
            'categorie' => 'Système cardiovasculaire',
            'nom' => "HE d'Ylang-ylang (Cananga odorata)",
            'partie_utilisee' => 'Fleurs',
            'description' => "Famille botanique : Annonacées. Mode d'obtention : distillation par entraînement à la vapeur d'eau. Famille biochimique : sesquiterpènes (germacrène-D, caryophyllène, farnésène, humulène), monoterpénols (linalol, géraniol), esters (acétate de géranyle, benzoate de benzyle, salicylate de benzyle, acétate de farnésyle).",
            'indication' => "Anti-infectieuse : bactéries, champignons, parasites\nTrès intéressante antispasmodique\nCalmante respiratoire et cardiaque (débloque le plexus cardiaque et respiratoire), hypotensive, adaptogène, plutôt antihypertensive\nRégénératrice cellulaire, anti-inflammatoire, antidiabétique\nSéborégulatrice (peau et cheveux), tonique cutanée et capillaire\nTonique et stimulante intellectuelle et sexuelle, décontractante (l'une des meilleures huiles décontractantes avec le petit grain bigarade)\nSur le plan émotionnel : calme les colères et frustrations d'enfance, travaille sur la peur de l'intimité et du rejet, intègre les peurs autour de la sécurité et de la sensualité sans culpabilité, invite à la spontanéité et à la jouissance de la vie, facilite la communication (utile aux introvertis)",
            'contre_indications' => "Déconseillée durant les 3 premiers mois de grossesse\nÉviter la voie interne",
            'posologie' => "Ne jamais diffuser seule (associer citron, litsée citronnée ou orange)\nOlfaction prolongée, massage du ventre, oreiller, touche de parfumeur\nMassage du plexus cardiaque : hypertension, rythme cardiaque\nCheveux : avec cèdre de l'Atlas (après-shampoing, gel d'aloe vera)\nAssociée au petit grain bigarade : phobies, décontraction musculaire et nerveuse, stress, insomnie, examens\nDouleurs de ventre (SPM, ménopause) : application locale\nCourbatures, arthrite, rhumatismes, crampes\nProtection de la peau après radiothérapie ; anti-âge",
            'conseil_du_moment' => "",
            'synergies' => "Petit grain bigarade (décontraction, phobies, stress), cèdre de l'Atlas (cheveux), citron/litsée citronnée/orange (diffusion)",
            'notes' => "",
        ],
        [
            'categorie' => 'Système respiratoire',
            'nom' => 'HE Épinette Noire (Picea mariana)',
            'partie_utilisee' => 'Rameaux avec aiguilles et petits cônes',
            'description' => "Autre nom : sapinette noire. Famille botanique : Abiétacées. Mode d'obtention : distillation par entraînement à la vapeur d'eau. Famille biochimique : monoterpènes 40-60% (pinène, camphène, carène, myrcène), esters terpéniques 30-50% (acétate de bornyle), monoterpénols 3-5%.",
            'indication' => "Anti-infectieuse : bactéries, virus, champignons, parasites ; très bon anesthésique atmosphérique\nImmunomodulante, stimule bien l'immunité\nAntitussive, expectorante, décongestionnante pulmonaire : tropisme respiratoire très important\nAntalgique locale, antispasmodique\nAnti-inflammatoire, pour les articulations et au-delà\nCirculatoire\nStimulante hormonale (corticosurrénales, gonades, thyroïde), légèrement cortisone-like\nTonique générale, neurotonique : énergie, force, persévérance, générosité, joie\nTrès purifiante et assainissante, dynamise le corps et l'esprit tout en équilibrant les fonctions physiques et psychiques\nClarifie les pensées, légèrement ancrante et verticalisante\nApporte vitalité, aide en cas de fatigue, apathie, dépression, burn-out\nTransmet force, persévérance, confiance en soi, aide à intégrer les expériences de vie en combattant peurs, honte et humiliation\nAide en période de procrastination",
            'contre_indications' => "Éviter chez la femme enceinte et l'enfant de moins de 6 ans\nPeut être irritante pour les peaux fragiles employée pure",
            'posologie' => "Maladies hivernales : diluée dans HV avec orange et cannelle (attention à la cannelle), en olfaction ou application cutanée\nDécongestionner les bronches, renforcer le système immunitaire : synergie avec citron et gingembre\nBurn-out, épuisement, infections respiratoires hivernales : inhalation, massage\nAvant un examen : synergie avec laurier noble\nRhumatismes : massage avec eucalyptus citronné ou ylang-ylang dans HV\nArticulations douloureuses : HV d'arnica + épinette noire + eucalyptus citronné + lavande vraie\nDépression, stress, anxiété : synergie avec petit grain bigarade\nMigraines : avec menthe poivrée sur les tempes\nAsthme : grâce à son activité légèrement cortisone-like",
            'conseil_du_moment' => "",
            'synergies' => "Citron + gingembre (bronches, immunité), laurier noble (avant examen), eucalyptus citronné/ylang-ylang (rhumatismes), petit grain bigarade (stress), menthe poivrée (migraines)",
            'notes' => "",
        ],
        [
            'categorie' => 'Système immunitaire',
            'nom' => 'HE Clou de Girofle (Syzygium aromaticum)',
            'partie_utilisee' => 'Boutons floraux',
            'description' => "Famille botanique : Myrtacées. Mode d'obtention : distillation par entraînement à la vapeur d'eau. Famille biochimique : phénols (eugénol 72-88%), esters (acétate d'eugényle 4-22%), sesquiterpènes (β-caryophyllène, anti-inflammatoire).",
            'indication' => "Anti-infectieuse majeure à large spectre : bactéries (y compris multirésistantes), champignons, virus\nStimulante du système immunitaire\nTropisme pour le système digestif : eupeptique, carminative, antiputride\nAntispasmodique générale\nAnti-inflammatoire\nAnalgésique, antalgique, anesthésiante (l'eugénol serait plus puissant que la lidocaïne)\nAntiagrégante plaquettaire, anticoagulante, fluidifiante sanguine\nDiminue glycémie, triglycérides et cholestérol\nAntioxydante\nTonique générale : neurotonique, utérotonique, tonique sexuel et endocrinien\nRépulsive pour les insectes\nSur le plan émotionnel : permet de canaliser l'énergie profonde, d'accepter de « mordre la vie à pleines dents », apporte de l'équilibre",
            'contre_indications' => "Interdite chez la femme enceinte/allaitante\nInterdite chez le bébé et l'enfant de moins de 6 ans\nDermocaustique : à utiliser diluée\nNe pas utiliser dans le bain ni en inhalation\nÀ éviter sous anticoagulants par voie orale (olfaction possible)",
            'posologie' => "Colère : olfaction ou massage sur le plexus solaire\nInfection intestinale : application locale + voie orale\nInfections dentaires, pulmonaires\nDeuil, fatigue, déprime, stress, émotions bloquées\nRésistance à l'insuline\nMycoses, candidose, dysbiose, parasitose\nDéficience immunitaire : 1 goutte/jour\nDouleurs musculaires, maux de ventre : application locale\nProblèmes circulatoires : application locale après dilution\nMassage lymphatique : 1-2 gouttes avec 8 gouttes de citron\nEn journée : gélules ; le soir : massage",
            'conseil_du_moment' => "",
            'synergies' => "Citron (drainage lymphatique)",
            'notes' => "",
        ],
        [
            'categorie' => 'Système digestif',
            'nom' => 'HE Basilic Exotique (Ocimum basilicum var. basilicum)',
            'partie_utilisee' => 'Sommités fleuries',
            'description' => "Autres noms : basilic tropical, herbe royale, grand basilic, basilic aux sauces. Famille botanique : Lamiacées. Mode d'obtention : distillation par entraînement à la vapeur d'eau. Famille biochimique : phényl-méthyl-éthers (méthylchavicol 50-75%), monoterpénols (linalol), sesquiterpènes (cadinène, β-bisabolène), oxydes (1,8-cinéole).",
            'indication' => "Antispasmodique musculotrope puissant : muscles lisses\nAntalgique, analgésique\nAnti-infectieuse : bactéries (action aléatoire), virus (très intéressante), champignons\nAnti-inflammatoire\nTonique digestive : carminative, eupeptique, stomachique — la première à laquelle on pense pour spasmes, tourista, diarrhées\nAntiallergique\nLégèrement stimulante surrénalienne\nDécongestionnante veineuse et prostatique\nSédative, calmante, antistress tout en restant dynamisante\nNeurorégulatrice\nTonique et décongestionnante hépatique\nEmpêche les ruminations, favorise le discernement\nDonne tonus, dynamisme, courage, volonté, persévérance",
            'contre_indications' => "Irritation possible à l'état pur\nDéconseillée chez la femme enceinte/allaitante et l'enfant de moins de 6 ans",
            'posologie' => "Douleurs de règles : avec camomille noble/romaine, massage de la zone pelvienne diluée\nDouleurs de ventre : synergie avec gingembre dans HV\nDigestion : synergie avec menthe poivrée ou citron (5 gouttes basilic + 1 goutte menthe)\n1 goutte pure ou diluée sous la langue en fin de repas\nNausées digestives : 1 goutte basilic + 1 menthe poivrée + 1 citron dans huile d'olive\nBallonnements : diluée dans HV d'amande douce, massage dans le sens des aiguilles d'une montre\nCirculation : massage des jambes dans HV\nGastro-entérite : 1 goutte avec menthe poivrée + HV\nDouleurs et inflammations : avec litsée citronnée ou cannelle de Ceylan (bien diluer)\nAérophagie, hoquet, transit perturbé, nausées, vomissements\nToux spasmodique, crampes, céphalées\nAllergie : 2 gouttes/jour",
            'conseil_du_moment' => "",
            'synergies' => "Camomille noble/romaine (douleurs de règles), gingembre (douleurs de ventre), menthe poivrée/citron (digestion), petit grain bigarade (diffusion)",
            'notes' => "",
        ],
        [
            'categorie' => 'Système respiratoire',
            'nom' => 'HE de Laurier Noble (Laurus nobilis)',
            'partie_utilisee' => 'Feuilles',
            'description' => "Autres noms : laurier sauce, laurier vrai, laurier d'Apollon. Famille botanique : Lauracées. Mode d'obtention : distillation par entraînement à la vapeur d'eau. Famille biochimique : oxydes 35-45% (1,8-cinéole), monoterpènes 10-35% (pinène, sabinène, limonène), monoterpénols (terpinéol, linalol), traces de phénols (eugénol), esters (acétate de terpényle, acétate de linalyle), lactones sesquiterpéniques (costunolide).",
            'indication' => "Anti-infectieuse très intéressante sur la plupart des bactéries, virus et champignons ; multipotente, aussi anti-infectieuse sur insectes et parasites\nImmunomodulante\nMucolytique et expectorante\nAntalgique et antinévralgique\nAntispasmodique, antiputride\nAnticoagulante légère\nÉquilibrante nerveuse (tonique et relaxante)\nApaise peurs, angoisses, mélancolies, phobies\nDonne confiance en soi aux personnes qui se sous-estiment (mais uniquement aux personnes méritantes) — juste équilibre entre humilité et accueil (dignité)\nStimule la mémoire et la concentration",
            'contre_indications' => "Peut provoquer des irritations cutanées\nRisque épileptogène à forte dose",
            'posologie' => "Sinusite : inhalation humide avec quelques gouttes de menthe poivrée\nDiffusion pour concentration et courage : avec cèdre de l'Atlas et un peu de menthe\nÉpidémie de grippe : diffusion avec ravintsara\nAngoisses/phobies : olfaction (stick portatif)\nAvant un examen : 1 goutte sur le poignet (ou avec citron/verveine)\nDigestion : 1 goutte sur un support\nBronchite : diluée dans HV, massage de la poitrine\nDouleurs du bas-ventre : avec basilic exotique, massage dans HV\nTourista, entérocolite, diarrhée, intoxication alimentaire : avec cannelle dans HV\nDouleurs musculaires, arthrose : avec menthe poivrée, gaulthérie, eucalyptus citronné\nGrippe, bronchite, sinusite : très efficace, plus puissant que le tea tree ou le ravintsara\nMycoses digestives/gynécologiques : application locale ou voie orale\nAbcès, aphtes buccaux : 1-2 gouttes sur coton ; parodontite avec myrrhe (en bain de bouche, pause 1 semaine sur 4)\nMiel pour la gorge/toux : 4-6 gouttes selon l'intensité\nHerpès : application pure\nPsoriasis, squames : dilué dans HV avec lavande",
            'conseil_du_moment' => "",
            'synergies' => "Cèdre de l'Atlas + menthe (concentration), ravintsara (grippe), citron/verveine (examen), basilic exotique (bas-ventre), cannelle (tourista), myrrhe (parodontite, oil pulling)",
            'notes' => "",
        ],
        [
            'categorie' => 'Système nerveux',
            'nom' => 'HE de Lavande Vraie (Lavandula angustifolia)',
            'partie_utilisee' => 'Sommités fleuries',
            'description' => "Autre nom : lavande officinale. Famille botanique : Lamiacées. Mode d'obtention : distillation par entraînement à la vapeur d'eau. Famille biochimique : monoterpénols jusqu'à 50% (linalol, terpinène-4-ol), esters terpéniques 30-40% (acétate de linalyle, acétate de lavandulyle), monoterpènes (ocimènes, caryophyllène), très peu de sesquiterpènes.",
            'indication' => "Anti-infectieuse : bactéries, champignons, parasites, vers, insectes\nCalmante, sédative, antidépressive, anxiolytique, régulatrice du système nerveux (peut être un peu tonique, calme l'hyperémotivité et la tension nerveuse)\nAntalgique, anti-inflammatoire\nAntispasmodique, décontractante musculaire (activité sur les neurotransmetteurs)\nTonicardiaque, hypotensive, antihypertensive\nAnticoagulante légère, fluidifiante\nDigestive : carminative, cholagogue, cholérétique\nEmménagogue, légèrement régulatrice des règles\nRégénératrice cutanée, cicatrisante\nSur le plan émotionnel : ouvre à l'amour maternel, apporte harmonie et équilibre, nettoie et purifie l'extérieur comme l'intérieur, aide en cas d'addictions, parle d'humilité",
            'contre_indications' => "Pas de contre-indications",
            'posologie' => "Mal de gorge : 5-6 gouttes diluées dans HV en massage\nInfections : jusqu'à 10 gouttes (thym à thymol + citron + lavande) diluées dans HV, en massage dans le dos ou par voie orale, plusieurs fois par jour\nEndormissement : avec camomille romaine et petit grain bigarade, en diffusion, bain ou massage le long de la colonne ; 2 gouttes sur l'oreiller\nNervosité : 1 goutte sous la voûte plantaire ou sur le plexus solaire\nSystème cardiovasculaire : baisse la tension, régularise le rythme cardiaque (HTA, extrasystole, tachycardie) — voie orale, olfactive ou cutanée diluée\nSystème digestif : spasmes (diluée avec basilic exotique), colites, douleurs de règles, flatulences, mauvaise haleine\nSystème locomoteur : synergie avec citron et basilic exotique pour les douleurs inflammatoires\nMénopause : avec sauge sclarée\nSystème cutané : eczéma, piqûres d'insectes, varices, acné (avec tea tree), régénération cutanée\nBrûlures : avec lemongrass et romarin à cinéole\nHématomes : directement + HV",
            'conseil_du_moment' => "",
            'synergies' => "Camomille romaine + petit grain bigarade (endormissement), thym à thymol + citron (infections), basilic exotique (spasmes digestifs, douleurs inflammatoires), sauge sclarée (ménopause), tea tree (acné, eczéma)",
            'notes' => "",
        ],
        [
            'categorie' => 'Système respiratoire',
            'nom' => 'HE Eucalyptus Radié (Eucalyptus radiata)',
            'partie_utilisee' => 'Feuilles',
            'description' => "Famille botanique : Myrtacées. Mode d'obtention : distillation par entraînement à la vapeur d'eau. Famille biochimique : oxydes (1,8-cinéole 60-80%), monoterpénols 10-20% (α-terpinéol), monoterpènes 7-12% (limonène, α-pinène, α-thujène, myrcène, sabinène, γ-terpinène), aldéhydes 2-8%, esters 3-5% (acétate de terpényle).",
            'indication' => "Anti-infectieuse : bactéries, virus, antiseptique aérien\nStimulante immunitaire, immunomodulatrice\nExpectorante et mucolytique, principalement pour les voies respiratoires hautes\nAnti-inflammatoire\nDynamisante et relaxante, inductrice enzymatique\nStimule le système immunitaire physique et énergétique\nTropisme sur le chakra de la gorge : facilite l'expression de soi et de l'autre\nFavorise la concentration, donne du courage d'entreprendre, facilite les relations interpersonnelles",
            'contre_indications' => "Convient à la femme enceinte (>3 mois) et à l'enfant (>3 ans)\nÀ éviter chez les asthmatiques en période de crise",
            'posologie' => "Infections : synergie avec citron, voie orale ou application locale (dos, toux)\nDigestion : application sur la zone du foie\nPurification de l'air : diffusion avec litsée citronnée\nRhumes : inhalation avec menthe poivrée, ou massage autour de l'oreille pour l'otite (jusqu'à 20-30 gouttes/jour en cas de grosse infection)\nMaux d'hiver (ORL, sinusite, rhinite, bronchite) : synergie avec orange ou citron, en olfaction ou massage plexus solaire\nRépulsif à insectes\nFatigue : application sur la colonne vertébrale, inhalation\nCuir chevelu (pellicules, démangeaisons) : dans HV ou aloe vera, antifongique, agit sur les pellicules",
            'conseil_du_moment' => "",
            'synergies' => "Citron (infections, digestion), menthe poivrée (rhumes, otite), litsée citronnée (purification air), orange (maux d'hiver)",
            'notes' => "",
        ],
        [
            'categorie' => 'Système cardiovasculaire',
            'nom' => "HE Cèdre de l'Atlas (Cedrus atlantica)",
            'partie_utilisee' => 'Copeaux de bois',
            'description' => "Famille botanique : Abiétacées (ex-Pinacées). Mode d'obtention : distillation par entraînement à la vapeur d'eau. Famille biochimique : sesquiterpènes (α/β/γ-himachalène, α-cédrène, trans-α-atlantone), sesquiterpénols (atlantol), cétones sesquiterpéniques (atlantones), oxydes sesquiterpéniques (himachalénoxyde).",
            'indication' => "Grande huile de la circulation : stimulante de la circulation artérielle et veineuse, décongestionnante veineuse, lymphotonique\nLipolytique (due aux cétones)\nAnti-inflammatoire (due aux sesquiterpènes)\nCicatrisante, régénérante cellulaire\nAntiprurigineuse, antiallergique (surtout cutanée)\nDrainante, diurétique modérée\nExpectorante, mucolytique, décongestionnante\nAnti-infectieuse, immunomodulatrice\nAntidépressive, anxiolytique, calmante, harmonisante\nTrès enracinante : donne la sensation d'avoir un socle, aide à prendre sa place, indiquée pour les personnes en manque de confiance",
            'contre_indications' => "Ne se prend pas par voie orale, uniquement en externe\nÉviter chez la femme enceinte (impact hormonal possible)\nNe pas utiliser chez l'enfant de moins de 6 ans\nÉviter en cas d'antécédents de convulsions ou d'épilepsie\nPrécaution en cas de pathologies hormono-dépendantes",
            'posologie' => "Circulation des jambes : massage dans HV\nEczéma : avec camomille matricaire ou romaine\nAnticellulite : mélangé avec menthe poivrée\nAncrage, relaxation : diffusion\nDouleurs : massage en synergie avec citron, eucalyptus citronné, gaulthérie et lavande\nAllergies cutanées : application locale\nAcouphènes : autour des oreilles ; hémorroïdes : diluée ; petit bassin : décongestionner\nCoups de froid, petits rhumes : synergie avec ravintsara en massage\nPellicules : dans gel d'aloe vera\nLipomes : diluée dans huile de ricin\nHuile considérée comme « sacrée » pour la méditation",
            'conseil_du_moment' => "",
            'synergies' => "Menthe poivrée (anticellulite), camomille (eczéma), ravintsara (rhumes), citron/eucalyptus citronné/gaulthérie/lavande (douleurs)",
            'notes' => "",
        ],
        [
            'categorie' => 'Système digestif',
            'nom' => 'HE de Menthe Poivrée (Mentha x piperita)',
            'partie_utilisee' => 'Parties aériennes (feuilles)',
            'description' => "Famille botanique : Lamiacées. Mode d'obtention : distillation par entraînement à la vapeur d'eau. Famille biochimique : monoterpénols 50% (menthol, néomenthol, isopulégol), monoterpénones 30% (menthone, isomenthone, pulégone, pipéritone), traces d'oxydes (1,8-cinéole), esters (acétate de menthyle), monoterpènes (limonène, pinène, myrcène, sabinène).",
            'indication' => "Cardiotonique : tonique et stimulante cardiaque, antihypotensive (stimule le muscle cardiaque)\nTonique et stimulante digestive, cholagogue et cholérétique (grâce à la menthone), régulatrice et protectrice hépatique\nNeurotonique : améliore la vigilance, la concentration, la clarté d'esprit\nAnti-infectieuse : très belle activité sur bactéries, virus, champignons, parasites\nSystème respiratoire : anticatarrhale, expectorante, mucolytique\nAntalgique local, anesthésiant, antiprurigineux (le menthol crée un effet froid local qui diminue la douleur et anesthésie légèrement la muqueuse gastrique en voie orale, d'où son effet anti-nauséeux)\nAntispasmodique, anti-inflammatoire\nUtérotonique : favoriserait les règles\nFacilite la cicatrisation, rafraîchissante\nAction sur le 6e chakra : pour les personnes soucieuses, abattues, déprimées, en excès de rumination",
            'contre_indications' => "Irritante utilisée pure sur la peau\nFortement déconseillée chez la femme enceinte, allaitante, les sujets épileptiques, les personnes âgées et l'enfant de moins de 6 ans\nStrictement interdite chez le nourrisson\nLes voies orale et inhalée sont celles qui demandent le plus d'attention",
            'posologie' => "Maux de tête : sur les tempes avec camomille (éloigné des yeux, ne pas se toucher les yeux avec les doigts)\nDigestion : diluée dans HV, massage du ventre\nDégager les voies respiratoires : massage du thorax dans HV\nMoral, travail intellectuel : diffusion diluée avec petit grain bigarade (ne jamais mettre de menthe pure dans le diffuseur)\nInflammations : massage des zones douloureuses\nNausées (repas copieux) : voie orale, 1 à 3 gouttes diluées\nDouleurs musculaires : dans HV d'arnica\nMal de gorge : 1 goutte dans une cuillère de miel\nBleus, inflammations : application directe\nJambes lourdes : synergie ou diluée dans HV\nDigestion, nausées : avec basilic exotique et citron",
            'conseil_du_moment' => "",
            'synergies' => "Camomille (maux de tête), petit grain bigarade (diffusion moral), basilic exotique + citron (digestion, nausées)",
            'notes' => "",
        ],
        [
            'categorie' => 'Système nerveux',
            'nom' => 'HE de Camomille Noble (Chamaemelum nobile / Anthemis nobilis)',
            'partie_utilisee' => 'Sommités fleuries',
            'description' => "Autre nom : camomille romaine. Famille botanique : Astéracées. Mode d'obtention : distillation par entraînement à la vapeur d'eau. Famille biochimique : esters 70-90% (angélate d'isobutyle, angélate d'isoamyle, angélate de méthylallyle, isobutyrate d'amyle), monoterpènes ~10% (α-pinène), traces de cétones monoterpéniques (pinocarvone), monoterpénols (trans-pinocarvéol, myrténol).",
            'indication' => "Antispasmodique puissante : action très importante sur le SNC, d'où son action physique (un peu moins malgré tout que le petit grain bigarade et l'ylang-ylang)\nPré-anesthésiante, antalgique (notamment par olfaction)\nCalmante du SNC et du SN autonome, relaxante, sédative — très calmante\nAnti-inflammatoire, y compris sur le plan émotionnel\nAntiprurigineuse, antiallergique\nAnti-infectieuse, surtout sur les parasites macroscopiques (utilisée autrefois en vermifuge)\nDigestive : carminative, stomachique, cholagogue, apéritive\nActivité calmante sur la thyroïde, équilibre les glandes endocrines (épiphyse, thyroïde, surrénales)\nEn MTC : régulation au niveau du foie, libère la tension nerveuse accumulée avec colère et ressentiment\nSur le plan émotionnel : grande huile des hypersensibles, aide à s'aimer et à se respecter dans sa sensibilité, recharge énergétique pour le SN, belle huile contre les chocs (émotionnels, chirurgicaux), anxiolytique légère",
            'contre_indications' => "Peut s'utiliser chez la femme enceinte de plus de 5 mois, allaitante, ainsi que chez l'enfant à partir de 12 mois (par voie cutanée)\nL'usage interne ne doit se faire que sur conseil d'un spécialiste",
            'posologie' => "Crises d'angoisse, lâcher-prise : massage sur le plexus dans HV ou en olfaction\nRègles douloureuses ; poussées dentaires : 1 goutte directement sur les gencives\nEndormissement : tisane avec tilleul, ou sur les poignets, ou 1 goutte sur l'oreiller\nColiques du bébé, intestins irritables : massage sur le ventre\nStress : 2 gouttes en massage sur le plexus solaire\nParasitose intestinale : 2 gouttes avec 1 goutte de poivre noir, par voie orale et application sur le ventre\nSystème respiratoire : antiallergique, anti-inflammatoire, légèrement anti-infectieuse — très intéressante dans l'asthme nerveux, en synergie avec un anti-infectieux (ravintsara) pour éviter les surinfections\nPeau : dermatoses, eczéma, psoriasis, acné, prurit, allergies, couperose\nBain de siège : infections urinaires, vulvites",
            'conseil_du_moment' => "",
            'synergies' => "Petit grain bigarade + orange (chocs émotionnels), ravintsara (asthme nerveux avec surinfection), tilleul (endormissement)",
            'notes' => "",
        ],
        [
            'categorie' => 'Système nerveux',
            'nom' => 'HE Verveine du Yunnan / Litsée citronnée (Litsea cubeba)',
            'partie_utilisee' => 'Fruits (baies) et feuilles',
            'description' => "Autres noms : litsée citronnée, verveine exotique, verveine tropicale. Famille botanique : Lauracées. Mode d'obtention : distillation par entraînement à la vapeur d'eau. Famille biochimique : aldéhydes terpéniques (géranial, néral, citronellal), monoterpènes (limonène, pinène, sabinène, camphène, myrcène), monoterpénols (linalol, géraniol, nérol).",
            'indication' => "Anti-infectieuse, notamment sur les champignons et les virus ; un peu moins marquée sur les bactéries\nInsectifuge, antiseptique atmosphérique et cutanée\nPeut faire légèrement baisser la tension\nAnti-inflammatoire et antalgique\nTonique digestive, eupeptique\nÉquilibrante neurovégétative\nCalmante nerveuse, anxiolytique, antidépressive\nApporte de la lumière et de la joie, aide à se détacher du passé et du futur, comble un manque de joie, intéressante pour les personnes introverties, facilite les rapports humains",
            'contre_indications' => "Peut être irritante cutanée et photosensibilisante : diluer et protéger du soleil\nDéconseillée en cas de traitement anticoagulant",
            'posologie' => "Olfaction pour l'émotionnel et l'énergétique : déprime légère, envies de sucre, préparation à l'endormissement\nApplication locale pour tout ce qui est physique (système digestif) — la voie orale n'est pas la plus adaptée pour cette HE\nAcné, eczéma, psoriasis : diluée dans HV de jojoba ou de nigelle (éviter la coco)\nMaladies inflammatoires chroniques de l'intestin : en synergie\nZona, herpès : pur en tamponnant localement\nDouleurs articulaires : dilué en massage (avec gaulthérie et ylang-ylang)\nMycose des pieds : diluée dans HV de coco\nDouleurs musculaires après effort intense : diluée dans huile d'arnica\nBallonnements, colite, entérocolite",
            'conseil_du_moment' => "",
            'synergies' => "Cannelle (mycoses), gaulthérie odorante + ylang-ylang (douleurs articulaires)",
            'notes' => "",
        ],
        [
            'categorie' => 'Système nerveux',
            'nom' => 'HE Petit Grain Bigarade (Citrus aurantium ssp. aurantium / amara)',
            'partie_utilisee' => 'Feuilles fraîches et petits rameaux',
            'description' => "Famille botanique : Rutacées. Mode d'obtention : distillation par entraînement à la vapeur d'eau. Famille biochimique : esters terpéniques 50-70% (acétate de linalyle, acétate de géranyle, acétate de néryle), monoterpénols 20-40% (linalol, α-terpinéol), monoterpènes.",
            'indication' => "Antispasmodique neurotrope majeur : agit sur les spasmes d'origine nerveuse (stress, examens, diarrhées ou maux de tête liés au stress) mais aussi gynécologiques, vasculaires...\nAnti-inflammatoire, antalgique, anesthésiante locale, antidouleur\nAnti-infectieuse : bactéries, champignons notamment\nRégulatrice cardiaque, tonique de la microcirculation artérielle\nRégénérante, tonique cutanée, cicatrisante, astringente, revitalisante cellulaire\nRégulatrice de la sécrétion de sébum, désodorisante (avec sauge et cyprès dans les déodorants)\nCalmante nerveuse, sédative, antidépressive, équilibrante, y compris pour le jetlag\nEn cas de période de soucis : permet d'encaisser les chocs (mieux que l'hélichryse, qui peut faire remonter des traumatismes)\nAide à se reconnecter à soi, soutient l'enfant intérieur, aide à avoir une meilleure image de soi, très intéressante pour les ruptures amoureuses\nIntéressante pour l'hyperémotivité, en synergie de choix avec la camomille romaine",
            'contre_indications' => "Peut provoquer des irritations à l'état pur",
            'posologie' => "Diffusion, olfaction : avec lavande pour la détente et le calme\nDigestion : avec basilic exotique, par voie orale ou massage du ventre\nEnfant anxieux : olfaction, 1 goutte\nExercices de relaxation, détente, insomnies, endormissement\nDouleurs musculaires : dans HV d'arnica avec 1 goutte de menthe poivrée ou de gaulthérie\nDystonie neurovégétative (troubles du SNA) sur n'importe quel système : cardiaque (tachycardie, arythmie, HTA, palpitations), respiratoire (oppression, toux)\nRègles douloureuses : avec basilic exotique\nAnxiété : avec camomille romaine\nDigestif : gastralgie, dyspepsie, acidité, colites, côlon irritable, aérophagie, ballonnements, flatulences\nSpasmes et crampes musculaires, système locomoteur (arthrite, rhumatismes)\nAcné, squames, plaies\nHypertension\nCuir chevelu : avec gel d'aloe vera et ravintsara\nExcès de sébum : 1 goutte dans la crème de jour",
            'conseil_du_moment' => "",
            'synergies' => "Lavande (détente), basilic exotique (digestion, règles douloureuses), camomille romaine (anxiété, hyperémotivité), menthe poivrée/gaulthérie (douleurs musculaires)",
            'notes' => "",
        ],
        [
            'categorie' => 'Système immunitaire',
            'nom' => 'HE de Cannelle de Ceylan (Cinnamomum zeylanicum / verum)',
            'partie_utilisee' => 'Écorce (ou feuilles)',
            'description' => "Famille botanique : Lauracées. Mode d'obtention : distillation par entraînement à la vapeur d'eau. Famille biochimique : aldéhydes aromatiques 70-85% (trans-cinnamaldéhyde), monoterpènes 5-10% (limonène, terpinène, phellandrène, cymène), phénols (eugénol), monoterpénol (linalol), esters (acétate de cinnamyle, benzoate de benzyle), sesquiterpènes (caryophyllène), coumarines 1-4% (propriétés très puissantes malgré la faible quantité).",
            'indication' => "Anti-infectieuse majeure : bactéries, virus, champignons, parasites, insectes\nImmunostimulante\nAnti-inflammatoire, antalgique, anesthésiante\nAntispasmodique des muscles lisses\nStimulante digestive, carminative, augmente le péristaltisme intestinal, antifermentaire (avec le girofle et le laurier noble)\nSympathicotonique\nLégèrement fluidifiante sanguine, anticoagulante\nTonique et stimulante générale, stimulante sexuelle\nHyperémiante\nTrès intéressante en cas d'hyperglycémie, notamment chez les personnes diabétiques de type 2\nSur le plan énergétique : débloque l'énergie vitale, réchauffe la rate, ancrée à la terre et à la vie, importante pour l'immunité physique et psychique, favorise la circulation énergétique",
            'contre_indications' => "Interdite chez la femme enceinte, allaitante et l'enfant de moins de 6 ans\nInterdite en cas de traitement anticoagulant\nDermocaustique : toujours utiliser en synergie diluée, jamais pure sauf strictement sur les ongles (avec un coton-tige)\nIrritante en diffusion : bien diluer dans le mélange choisi et en mettre peu (irrite les voies respiratoires)",
            'posologie' => "Dépistage/traitement parasites : voie orale et cutanée sur le ventre, en synergie, 3×/jour et massage le soir\nGlycémie : voie orale (2×/jour) et cutanée (massage le soir)\nAnti-inflammatoire articulaire : 1 goutte cannelle + 2 gouttes laurier noble + 3 gouttes gingembre dans 10 gouttes d'HV\nOngles (mycose) : pure au coton-tige, strictement sur l'ongle\nDouleurs bas-ventre, digestives, règles douloureuses : diluée dans HV, en massage\nGastro : voie orale\nBurn-out : synergie avec orange, mandarine\nBaisse de forme : synergie avec épinette noire\nCirculation sanguine : synergie avec citron et menthe poivrée dans une HV\nTourista : avec une HE à monoterpénols par voie orale\nHelicobacter pylori : mélangée avec curcuma, gingembre, citron pendant 3 mois ; Candida albicans jusqu'à 6 mois\nSentiment d'impuissance",
            'conseil_du_moment' => "",
            'synergies' => "Laurier noble + gingembre (anti-inflammatoire, antifermentaire), épinette noire (baisse de forme), orange/mandarine (burn-out), citron + menthe poivrée (circulation), curcuma + gingembre + citron (Helicobacter pylori)",
            'notes' => "",
        ],
    ];
}

function getRessourcesHydrologie(): array {
    return array (
  0 => 
  array (
    'categorie' => 'Techniques par le chaud',
    'nom' => 'Bain hyperthermique (méthode Salmanoff)',
    'partie_utilisee' => '',
    'description' => 'Bain très chaud (au-delà de 39-40°C, jusqu\'à 42°C) créant une fièvre artificielle. Technique décrite par le Dr Salmanoff : la vasodilatation intense du réseau capillaire active le métabolisme et l\'élimination des toxines via une sudation abondante. Selon Salmanoff, un bain hyperthermique élimine plus de substances acides que les reins en 24h. Permet d\'élever la température corporelle sans dépense énergétique (source de chaleur externe).',
    'indication' => 'Arthrose, arthrite, rhumatismes en général
Acidose, terrain acide, élimination des toxines
Problèmes digestifs (diabète, obésité, maigreur), favorise la digestion
Maladies hivernales déclarées (rhume, grippe sans fièvre)
Angoisse, dépression nerveuse, nervosité, insomnie
Maladies éruptives, dermatoses non infectées et sans plaies
Frilosité des "neuro-arthritiques", grands frileux
Douleurs dentaires
Aide à condition d\'avoir une bonne vitalité',
    'contre_indications' => 'Hypertension intracrânienne, œdème cérébral
Hypertension artérielle (attention en se relevant du bain)
Myocardite, coronarites, arythmie cardiaque, phlébites, varices
Ulcères variqueux, plaies
Hémorroïdes
Capillaires fragiles, couperose
Déshydratation
Femme enceinte (ne pas dépasser 39°C)
Infection urinaire en période évolutive
Personnes sujettes aux vertiges ou hypotension
Fièvre
Autres maladies graves sans avis médical',
    'posologie' => 'Préparer l\'eau à 35-36°C puis ouvrir progressivement le robinet d\'eau chaude (thermomètre de bain)
Bain à 38-39°C -> 20 minutes ; bain à 42°C -> 5 à 10 minutes
Attendre la sueur sur le front (objectif) ; si absente, ne pas insister mais augmenter progressivement durée et/ou température
2 à 3 fois par semaine en cure, jusqu\'à 3-4 fois par jour en cas de grippe/refroidissement sans fièvre
Sortie : laisser l\'eau s\'écouler par le siphon, s\'asseoir avant de se relever (risque de baisse de tension), ne pas s\'essuyer, se rhabiller rapidement et rester au chaud
La température corporelle peut rester élevée jusqu\'à 1h après',
    'conseil_du_moment' => 'De préférence le soir (active le système nerveux parasympathique et favorise le sommeil). Aérer la pièce avant (pas pendant) le bain. Boire chaud pendant le bain favorise la sudation.',
    'proprietes' => '',
    'sources_alimentaires' => '',
    'synergies' => 'Boire chaud (favorise la sudation), gant ou linge froid sur le front, musique relaxante, diffuseur d\'huiles essentielles, épices réchauffantes (cannelle, girofle) dans la boisson chaude',
    'notes' => 'Les femmes transpirent souvent moins que les hommes (normal). Technique de Salmanoff : la vitesse de vieillissement d\'un individu serait en rapport direct avec l\'assèchement de son réseau capillaire ; le bain hyperthermique améliore les échanges cellulaires par le système capillaire (80% de la circulation générale).',
  ),
  1 => 
  array (
    'categorie' => 'Techniques par le chaud',
    'nom' => 'Demi-bain chaud ou hyperthermique',
    'partie_utilisee' => '',
    'description' => 'Variante du bain chaud complet ou hyperthermique lorsque celui-ci n\'est pas réalisable : eau uniquement jusqu\'au nombril.',
    'indication' => 'Mêmes indications que le bain chaud ou hyperthermique complet',
    'contre_indications' => 'Mêmes contre-indications que le bain chaud/hyperthermique complet, à adapter',
    'posologie' => 'Eau jusqu\'au nombril uniquement
Mêmes températures et durées que le bain complet
Mêmes précautions de sortie (ne pas se relever trop vite, ne pas s\'essuyer)',
    'conseil_du_moment' => '',
    'proprietes' => '',
    'sources_alimentaires' => '',
    'synergies' => '',
    'notes' => 'Moins exigeant pour le système cardiovasculaire. Alternative pour les personnes fragiles (avec avis médical), en cas de plaie, de bras cassé, etc.',
  ),
  2 => 
  array (
    'categorie' => 'Techniques par le chaud',
    'nom' => 'Bain chaud complet',
    'partie_utilisee' => '',
    'description' => 'Bain de détente à température agréable (37 à 39°C, jusqu\'à 40°C), sans recherche de transpiration intense. Le corps immergé reçoit une stimulation nerveuse par les terminaisons nerveuses de la peau : le cerveau perçoit le corps dans son ensemble, effet rassurant et de reconnexion à soi.',
    'indication' => 'Relaxation musculaire, détente, soulagement du stress et des tensions, relâchement du système nerveux
Augmentation de la sérotonine et des endorphines
Amélioration du sommeil, lutte contre l\'insomnie (étude Hôpital Mac Lean de Belmont, Massachusetts)
Amélioration de la circulation sanguine, baisse de la tension artérielle
Amélioration de la digestion
Décongestion ORL
Courbatures, douleurs musculaires, récupération physique
Revitalisation
Crampes menstruelles, facilite l\'accouchement (bain à 38°C maximum)',
    'contre_indications' => 'Problèmes cardio-vasculaires, varices, insuffisance veineuse chronique ou antécédent de thrombose veineuse profonde
Maladies cardiaques, HTA, AVC : à adapter
Fièvre
Ulcères variqueux, plaies
Déshydratation
Infections urinaires en crise',
    'posologie' => 'Température : 37 à 39°C
Durée : 20 minutes idéalement (15 à 30 minutes), peut se terminer par une douche plus fraîche ou juste les extrémités',
    'conseil_du_moment' => 'Le soir au coucher ou avant le dîner (1h à 1h30 avant le coucher pour l\'insomnie), dans un environnement apaisant (musique douce, bougies).',
    'proprietes' => '',
    'sources_alimentaires' => '',
    'synergies' => 'Peut se combiner avec des huiles essentielles (bain aromatique), des sels ou des plantes',
    'notes' => '',
  ),
  3 => 
  array (
    'categorie' => 'Techniques par le chaud',
    'nom' => 'Bain aromatique (huiles essentielles)',
    'partie_utilisee' => '',
    'description' => 'Bain chaud (37-39°C) combinant les bienfaits de l\'eau avec les propriétés thérapeutiques des huiles essentielles, qui pénètrent la barrière cutanée et agissent aussi par inhalation des vapeurs (voies respiratoires, sphère ORL, système nerveux, circulation).',
    'indication' => 'Insomnie, difficulté à dormir : lavande vraie, géranium rosat, mandarine, orange douce, petit grain bigarade, camomille romaine, marjolaine à coquilles
Anxiété, stress : petit grain bigarade, lavande, camomille, mandarine, orange douce, marjolaine, ylang ylang, basilic ou estragon
Récupération après sport, courbatures, douleurs : gaulthérie, hélichryse, arnica (HV), romarin camphré, eucalyptus citronné, ylang ylang, citron, gingembre
Congestion des voies respiratoires : romarin à cinéole, tea tree, ravintsara, eucalyptus radié, pins, sapins, cyprès
Début de grippe : ravintsara, tea tree, thym à linalol
Fatigue : niaouli, pins, sapins, épinette noire, gingembre, bois de Hô, encens, pin sylvestre',
    'contre_indications' => 'Éviter les HE à phénols, le thym à thymol, la cannelle, l\'origan, le clou de girofle ; menthe poivrée à éviter ou 1 goutte maximum (risque d\'hypothermie)
Précautions habituelles de l\'aromathérapie (grossesse, allaitement, enfants, épilepsie selon les huiles)',
    'posologie' => 'Diluer 5 à 10 gouttes d\'HECT (5 gouttes maximum en synergie) dans un dispersant avant de les ajouter au bain : huile végétale, lait entier ou en poudre, produit de bain spécialement formulé, shampoing ou gel douche
Ne jamais verser les huiles essentielles directement dans l\'eau (non solubles)
Choisir une huile essentielle seule ou en synergie pour optimiser les effets',
    'conseil_du_moment' => '',
    'proprietes' => '',
    'sources_alimentaires' => '',
    'synergies' => 'Se combine avec le bain chaud complet ou le bain hyperthermique',
    'notes' => '',
  ),
  4 => 
  array (
    'categorie' => 'Techniques par le chaud',
    'nom' => 'Bain aux plantes (phytologie)',
    'partie_utilisee' => '',
    'description' => 'Ajout de décoctions, infusions ou ampoules de plantes dans l\'eau du bain. Préparations prêtes à l\'emploi disponibles (Wéléda, magasins bio) ou préparation maison.',
    'indication' => 'Bain stimulant : affections cutanées, tonus général
Bain aux bourgeons de sapin ou de pin : affections "nez-gorge-oreille", stimule les fonctions cutanées et nerveuses, diurétique (reins, vessie), dynamisant
Bain relaxant : détente, apaisement
Bain anti-contractures et tensions : soulage les contractures et tensions passagères, action sur les troubles circulatoires et l\'hypertension',
    'contre_indications' => '',
    'posologie' => 'Bain stimulant : 100 g de plantes au choix ou mélangées (noyer, thym, serpolet, sauge, romarin, hysope, menthe, absinthe, origan, lavande) en décoction 1/4 d\'heure, ajoutée au bain
Bain relaxant : lavande, tilleul, camomille, mélisse, 1 à 2 poignées infusées en amont ou en sachet de mousseline directement dans l\'eau
Bain anti-contractures : infuser 2 poignées de romarin séché dans 1L d\'eau chaude, filtrer, verser dans le bain et ajouter une tasse de bicarbonate',
    'conseil_du_moment' => '',
    'proprietes' => '',
    'sources_alimentaires' => '',
    'synergies' => '',
    'notes' => '',
  ),
  5 => 
  array (
    'categorie' => 'Techniques par le chaud',
    'nom' => 'Bain d\'algues',
    'partie_utilisee' => '',
    'description' => 'Bain chaud additionné de poudre, liquide ou crème d\'algues, pratiqué en thalassothérapie ou à domicile. Très revitalisant et riche en principes actifs.',
    'indication' => 'Amélioration de la circulation sanguine (jambes lourdes, œdèmes)
Rhumatismes, arthrose, traumatismes musculaires et osseux, séquelles d\'entorses et de fractures, douleurs : effets décontractants, anti-inflammatoires et stimulants
Maladies de peau : effet purifiant, cicatrisant
Vasodilatation des capillaires
Intensification du métabolisme cellulaire, de la cicatrisation tissulaire, régénération
Intensification des fonctions glandulaires
Activation des défenses immunitaires
Reminéralisation et revitalisation',
    'contre_indications' => 'Pas de contre-indication à l\'iode avec les bains aux algues, même en cas d\'hyperthyroïdie',
    'posologie' => 'Baignoire à demi remplie : verser 100 g (3 poignées) de produit sec puis finir le remplissage à l\'eau bien chaude, ou suivre la posologie d\'une forme liquide/crème
Durée : 10 minutes au début puis 20 minutes ensuite
Cure de 10 à 20 bains à raison de 2 à 3 fois par semaine
À la sortie, ne pas se savonner, se tamponner pour sécher (les principes actifs continuent d\'agir), repos 10 minutes au chaud',
    'conseil_du_moment' => '',
    'proprietes' => '',
    'sources_alimentaires' => '',
    'synergies' => 'Synergie possible avec sel de mer et argile verte : 5 cuillères à soupe de chaque ingrédient, 15 minutes, pour une détente et une revitalisation maximales',
    'notes' => '',
  ),
  6 => 
  array (
    'categorie' => 'Techniques par le chaud',
    'nom' => 'Bain au sel de mer',
    'partie_utilisee' => '',
    'description' => 'Bain additionné de gros sel ou sel gris, extrait de la mer, de marais salants ou de mines.',
    'indication' => 'Bienfaits de l\'eau de mer
Relaxation, effet anti-stress et anti-tension
Soulage les douleurs musculaires et articulaires, après un entraînement (action anti-inflammatoire et analgésique)
Favorise la circulation sanguine et l\'élimination des toxines
Exfoliation de la peau : élimination des cellules mortes, renouvellement cellulaire',
    'contre_indications' => 'Tester d\'abord avec une petite quantité pour vérifier les allergies ou irritations potentielles',
    'posologie' => '2 bonnes poignées ou 1/2 tasse à 1 tasse par bain (1 à 2 cuillères à soupe pour un bain de pieds)',
    'conseil_du_moment' => '',
    'proprietes' => '',
    'sources_alimentaires' => '',
    'synergies' => '',
    'notes' => '',
  ),
  7 => 
  array (
    'categorie' => 'Techniques par le chaud',
    'nom' => 'Bain au sel de Yunohana',
    'partie_utilisee' => '',
    'description' => 'Sel volcanique des thermes de Beppu au Japon (ville géothermique au pied d\'un volcan actif), concentré en oligo-éléments naturels, extraits d\'argile et éléments d\'origine volcanique. Bain basique.',
    'indication' => 'Revitalisation et régénération ++
Dermatoses, psoriasis, eczémas, mycoses
Affections articulaires et musculaires
Apaisement du système nerveux, relaxation',
    'contre_indications' => '',
    'posologie' => 'Cure de 10 jours à raison d\'1 bain par jour de 20 minutes à 38-39°C avec un sachet, ou en bain 2 fois par semaine',
    'conseil_du_moment' => '',
    'proprietes' => '',
    'sources_alimentaires' => '',
    'synergies' => '',
    'notes' => '',
  ),
  8 => 
  array (
    'categorie' => 'Techniques par le chaud',
    'nom' => 'Bain au sel d\'Epsom',
    'partie_utilisee' => '',
    'description' => 'Sel amer originaire d\'Angleterre, riche en magnésium, issu de la Dolomie (roche naturelle). Contient majoritairement des ions sulfate et du magnésium biodisponible (sulfate de magnésium).',
    'indication' => 'Apport en magnésium, reminéralisation
Apaisement du système nerveux, relaxation
Relaxation musculaire, décontractant
Anti-inflammatoire, douleurs articulaires
Bon pour la peau et les cheveux fatigués, effet gommage',
    'contre_indications' => '',
    'posologie' => '2 à 3 poignées dans un bain chaud, durée 20 minutes, 2 à 3 fois par semaine
Se rincer à l\'eau claire avant de sortir',
    'conseil_du_moment' => '',
    'proprietes' => '',
    'sources_alimentaires' => '',
    'synergies' => '',
    'notes' => '',
  ),
  9 => 
  array (
    'categorie' => 'Techniques par le chaud',
    'nom' => 'Bain au sel de la Mer Morte',
    'partie_utilisee' => '',
    'description' => 'Sel provenant du lac salé entre Israël, Jordanie et Cisjordanie, très forte concentration en sel (27,5% contre 2 à 4% en moyenne dans les autres mers), riche en minéraux et oligo-éléments (calcium, potassium, bore, magnésium).',
    'indication' => 'Cicatrisation et apaisement de la peau : acné, eczéma, urticaire, psoriasis
Soulagement des douleurs musculaires et articulaires, action anti-inflammatoire, raideurs
Élimination des toxines
Apaisement du système nerveux, relaxation, sommeil
Tonique circulatoire, régulation de la tension',
    'contre_indications' => '',
    'posologie' => '3 à 4 cuillères à soupe par bain, 20 minutes, 3 fois par semaine ou plus
Se rincer à l\'eau claire en sortant',
    'conseil_du_moment' => '',
    'proprietes' => '',
    'sources_alimentaires' => '',
    'synergies' => '',
    'notes' => '',
  ),
  10 => 
  array (
    'categorie' => 'Techniques par le chaud',
    'nom' => 'Bain au bicarbonate de sodium',
    'partie_utilisee' => '',
    'description' => 'Bain additionné de bicarbonate de sodium (qualité alimentaire), mélange d\'ions sodium et d\'ions bicarbonate.',
    'indication' => 'Régule le pH, alcalinise
Désintoxication de l\'organisme
Apaise les irritations (même vulvaires), démangeaisons, adoucit et assouplit la peau
Infections fongiques (candida albicans, ongles déformés)
Prurit de la personne âgée, dermatose prurigineuse, eczéma, psoriasis
Irritations dues aux hémorroïdes',
    'contre_indications' => 'Grossesse et allaitement
Blessure ouverte
Vertiges, HTA
Diabète
Risque d\'assèchement de la peau : bien sécher et hydrater la peau après le bain',
    'posologie' => '100 à 250 g de bicarbonate de qualité alimentaire (1/2 à 1 verre à eau), se rincer à l\'eau claire après le bain',
    'conseil_du_moment' => '',
    'proprietes' => '',
    'sources_alimentaires' => '',
    'synergies' => '',
    'notes' => '',
  ),
  11 => 
  array (
    'categorie' => 'Techniques par le chaud',
    'nom' => 'Bouillotte',
    'partie_utilisee' => '',
    'description' => 'Application de chaleur locale (bouillotte à eau ou version sèche à graines/noyaux) sur une zone ciblée : foie, reins, ventre, plexus solaire, zone de douleur ou de tension.',
    'indication' => 'Stimule et soutient l\'activité hépatique, accompagne le foie en cure détox (filtration, élimination)
Agit sur la circulation, décongestionne les organes
Soutient la digestion paresseuse, aide à lutter contre la constipation
Action antispasmodique (abdomen, gynécologie), endométriose, SPM, règles douloureuses
Action sur le système nerveux : stress, anxiété, détente
Réchauffe les types "rétractés" et les grands frileux
Mal de gorge, angoisse',
    'contre_indications' => 'Ne jamais poser sur la tête ou sur le cœur
Si muscles ou zone enflés : appliquer du froid, pas de chaud
Éviter sur le ventre en cas de douleur aiguë (suspicion d\'appendicite)
Éviter sur l\'estomac en cas d\'ulcère
Ne pas laisser trop longtemps : risque de peau rouge, violette, brûlures',
    'posologie' => '20 à 30 minutes sur la zone à traiter
Bien étanche, entourée d\'un torchon ou d\'un linge
Pour les enfants : petit format adapté, dans un doudou, en surveillant poids et température',
    'conseil_du_moment' => '',
    'proprietes' => '',
    'sources_alimentaires' => '',
    'synergies' => 'Associer bouillotte et huiles essentielles pour le stress, l\'anxiété, les tensions ou le diaphragme spasmé : lavande + estragon ou basilic, ylang ylang, en massage + bouillotte + respiration. Se combine avec la méthode Gardelle (compresse chaude sur le ventre/foie).',
    'notes' => '',
  ),
  12 => 
  array (
    'categorie' => 'Techniques par le chaud',
    'nom' => 'Sauna',
    'partie_utilisee' => '',
    'description' => 'Bain de vapeur sèche d\'origine finlandaise, vieux de 2000 ans. La chaleur (70 à 100°C) est procurée par des pierres volcaniques posées dans un poêle. Provoque une transpiration abondante (jusqu\'à 1,5L). Technique considérée comme la plus puissante pour activer les glandes sudoripares et drainer les acides (vision naturopathique traditionnelle).',
    'indication' => 'Problèmes articulaires, élongations, contractures, lumbagos, torticolis, courbatures, douleurs rhumatismales
Acidose
Stress, relaxation
Infection virale (grippe)
Stimulation du système respiratoire (asthme, bronchite, avec prudence)
Boost des défenses immunitaires
Prévention des maladies cardiovasculaires et longévité (études finlandaises)
Nettoyage de la peau en profondeur
Troubles digestifs, ménopause',
    'contre_indications' => 'Plaies non cicatrisées, psoriasis
Enfants, femmes enceintes
Claustrophobie
Fièvre
Consommation importante d\'alcool
À éviter sans avis médical : varices, sténose aortique, angine de poitrine instable, infarctus, AVC récent, arythmie cardiaque, hypotension, hypertension non contrôlée
Certaines personnes asthmatiques peuvent être incommodées (stimulation des mécanorécepteurs bronchiques par la vapeur d\'eau)',
    'posologie' => 'Douche chaude avant d\'entrer, estomac vide, de préférence nu(e), commencer par les places basses
Rester 5 à 10 minutes (15 avec l\'habitude) dès que la sueur roule sur tout le corps
Sortir et prendre une douche fraîche à froide, se relaxer, puis reprendre une douche chaude avant de retourner au sauna
Faire 2 à 3 passages en alternance avec douches froides et pauses de 10 à 15 minutes
En cas de maladie cardiovasculaire stable et traitée (avis du Dr Daniel Gagnon) : température 60-80°C, s\'asseoir d\'abord sur les bancs inférieurs 2-3 min, séances courtes de 5-10 min, bien s\'hydrater, éviter l\'eau glacée après (préférer eau fraîche/tiède), éviter le bain à remous après le sauna',
    'conseil_du_moment' => '',
    'proprietes' => '',
    'sources_alimentaires' => '',
    'synergies' => 'Combiné avec douches froides en alternance, ou associé au hammam (idéalement hammam puis sauna)',
    'notes' => 'Ne fait pas maigrir : le corps perd de l\'eau, pas de la graisse. Ne pas lire à cause des émanations toxiques du plomb.',
  ),
  13 => 
  array (
    'categorie' => 'Techniques par le chaud',
    'nom' => 'Hammam',
    'partie_utilisee' => '',
    'description' => 'Chaleur humide (37 à 50°C, taux d\'humidité proche de 100%) agissant sur les glandes sébacées ; les pores dilatés favorisent l\'évacuation des cellules mortes et des toxines. Hammam traditionnel organisé en 2 ou 3 salles de températures croissantes.',
    'indication' => 'Libère le corps des toxines
Soulage les voies respiratoires (renforcé par des huiles essentielles)
Favorise le sommeil, détend
Favorise la récupération des sportifs (douleurs, courbatures, relaxation musculaire)
Fièvre artificielle
Troubles digestifs, ménopause',
    'contre_indications' => 'Problèmes cardiaques, varices (voir contre-indications du bain chaud)
Maladie respiratoire grave
Affection cutanée, plaies, mycoses
Fièvre, maladies contagieuses
Femmes enceintes (à moduler selon la température des salles et avis médical)',
    'posologie' => '1ère salle : repos ; 2ème salle tiède : acclimatation ; 3ème salle (environ 45°C, 100% d\'humidité) : sudation, 10 à 15 minutes après préparation progressive
Débutant.e : à l\'écoute du corps, préférer 3 phases de 5 minutes si incommodé.e
Penser au savon noir pour un gommage avec un gant spécifique
Bien s\'hydrater, finir à l\'eau froide et un temps de repos',
    'conseil_du_moment' => '',
    'proprietes' => '',
    'sources_alimentaires' => '',
    'synergies' => 'Possible de faire hammam et sauna ensemble, idéalement hammam puis sauna',
    'notes' => '',
  ),
  14 => 
  array (
    'categorie' => 'Techniques par le chaud',
    'nom' => 'Pédiluves et maniluves chauds',
    'partie_utilisee' => '',
    'description' => 'Bain local des pieds (pédiluve) et/ou des mains et avant-bras (maniluve) dans l\'eau chaude, seuls ou combinés. Le sang est drainé vers les extrémités par l\'eau chaude vasodilatatrice, ce qui décongestionne la tête et le tronc (dérivation).',
    'indication' => 'Pieds toujours froids, personnes stressées aux extrémités glacées
Décongestion des voies respiratoires et de la tête : migraines, céphalées, travail intellectuel intense, sinusites, otites, congestions oculaires
Apaisement et décongestion du plexus solaire : tensions nerveuses, émotionnelles, anxiété
Au coucher pour se détendre
Montée de tension (bain de pieds chaud salé)',
    'contre_indications' => 'Pédiluve : grosses varices, phlébite
Maniluve : précaution chez les personnes sujettes aux tachycardies (arrêter et préférer l\'alternance chaud/froid), contre-indiqué en cas de phlébite',
    'posologie' => 'Eau chaude entre 39° et 43°C, montée progressivement
Durée : 5 à 15 minutes, jusqu\'à ce que la peau rougisse
Massage préalable des pieds
Optionnel : gros sel complet, argile verte, ampoule de vigne rouge ou hamamélis, huiles essentielles diluées dans un dispersant
Version alternée recommandée : 2 bassines, chaud (37-40°C) 2 minutes / froid 30 secondes, répéter 3 à 4 fois, finir par le froid
Montée de tension : bain de pieds chaud salé (1 poignée de gros sel marin), 15 à 20 minutes',
    'conseil_du_moment' => '',
    'proprietes' => '',
    'sources_alimentaires' => '',
    'synergies' => 'Peut remplacer la baignoire lorsque le bain complet est impossible',
    'notes' => '',
  ),
  15 => 
  array (
    'categorie' => 'Techniques par le chaud',
    'nom' => 'Boire chaud',
    'partie_utilisee' => '',
    'description' => 'Conseil simple et polyvalent consistant à boire de l\'eau chaude ou tiède (jamais brûlante) régulièrement dans la journée, éventuellement agrémentée de plantes fraîches ou d\'hydrolat.',
    'indication' => 'Réchauffe et stimule la digestion, stimule le "feu digestif" (agni en ayurvéda)
Favorise l\'élimination des toxines, bénéfique en cas de gaz et de constipation
Favorise la transpiration et l\'élimination urinaire
Apaise et calme le système digestif : ballonnements, gaz, douleurs abdominales, crampes, spasmes, SPM, endométriose
Améliore la circulation sanguine vers les organes digestifs
Favorise la relaxation musculaire et le bien-être général
Réchauffement du corps (périodes froides, fatigue, convalescence, post-partum), particulièrement bénéfique pour le profil ayurvédique Vata
Mal de gorge',
    'contre_indications' => '',
    'posologie' => 'Au lever ++ (après le jeûne de la nuit)
Dans la journée, entre les repas et un peu pendant les repas
Finir le repas par un verre ou une tisane d\'eau chaude',
    'conseil_du_moment' => 'Commencer la journée par un grand verre d\'eau chaude à jeun.',
    'proprietes' => '',
    'sources_alimentaires' => '',
    'synergies' => '',
    'notes' => '',
  ),
  16 => 
  array (
    'categorie' => 'Techniques par le froid',
    'nom' => 'Bain froid et douche froide',
    'partie_utilisee' => '',
    'description' => 'Immersion ou douche à l\'eau froide (0 à 17°C). Provoque une réaction centripète : les liquides sont envoyés vers l\'intérieur (reins, poumons), sollicitant les émonctoires profonds. Réaction de vasoconstriction puis vasodilatation par réaction de chaleur (thermogénèse), signe de l\'acclimatation au froid.',
    'indication' => 'Stimulation immunitaire (production de globules blancs et de lymphocytes T), prévention des maladies hivernales
Vitalisant et tonique (stimule les glandes surrénales)
Favorise la circulation sanguine et le drainage lymphatique (varices, hémorroïdes, cœur)
Régule le système nerveux, renforce la résistance au stress
Augmente le métabolisme et les réserves de graisse brune
Active le nerf vague et la libération de noradrénaline
Augmente le taux de spermatozoïdes et de testostérone (libido, fertilité)
Raffermit la peau
Fatigue',
    'contre_indications' => 'Grands frileux et personnes sous vitalité, anergie
Hyperthyroïdie
Problèmes cardiaques, AVC, HTA, glaucome
Problèmes ou blocages psychologiques
Peut provoquer une insomnie si pratiqué juste avant le coucher
En début de règles : à moduler selon la personne, pas une contre-indication ferme',
    'posologie' => 'Bain froid (technique spartiate) : force vitale importante requise, échauffement préalable et friction, efficace entre 10 et 18°C dans une pièce à 20°C minimum, 7-8 secondes au départ puis 1 à 2 minutes, frictions dans le bain pour éviter le choc thermique, 2 fois par semaine le matin de préférence, attendre 1h avant de manger
Douche froide (alternative plus accessible) : échauffement préalable, commencer par les jambes et les bras puis étendre progressivement, commencer par 20-30 secondes puis 1 à 2 minutes, température tiède puis fraîche puis froide, bien respirer, boire chaud après si besoin
Si frissons : arrêter immédiatement (vitalité trop faible)',
    'conseil_du_moment' => 'Pratiquer de préférence le matin, dans une pièce chauffée, car cela dynamise. Toujours sur un corps chaud au préalable.',
    'proprietes' => '',
    'sources_alimentaires' => '',
    'synergies' => 'Méthode Wim Hof : combine respiration (hyperventilation et apnée), mouvements dynamisants, entraînement au froid et concentration mentale',
    'notes' => 'Important : constater une réaction de chaleur de l\'organisme après l\'application froide (test de vitalité) ; sinon, se réchauffer par friction énergique, serviettes chaudes, exercices, boisson chaude ou bouillotte.',
  ),
  17 => 
  array (
    'categorie' => 'Techniques par le froid',
    'nom' => 'Bain nordique',
    'partie_utilisee' => '',
    'description' => 'Pratique consistant à se baigner dans une eau très froide (5 à 8°C) en hiver, populaire en Finlande, au Québec et au Canada, souvent après un sauna.',
    'indication' => 'Mêmes bienfaits que le bain/douche froide : stimulation immunitaire, vitalité, circulation, résistance au froid',
    'contre_indications' => 'Mêmes contre-indications générales de l\'eau froide',
    'posologie' => 'Plus l\'eau est froide, plus le temps de bain doit être court
Se couvrir rapidement après la sortie',
    'conseil_du_moment' => '',
    'proprietes' => '',
    'sources_alimentaires' => '',
    'synergies' => 'Souvent pratiqué en sortie de sauna : la différence avec la température extérieure très froide (parfois -20°C) fait percevoir l\'eau comme moins froide',
    'notes' => '',
  ),
  18 => 
  array (
    'categorie' => 'Techniques par le froid',
    'nom' => 'Demi-bain froid',
    'partie_utilisee' => '',
    'description' => 'Variante plus douce et plus accessible du bain froid complet, préférée par Kneipp. Eau au-dessous de l\'estomac, bras hors de l\'eau, avec friction du dos et du thorax.',
    'indication' => 'Mêmes indications que le bain/douche froide, avec une approche progressive',
    'contre_indications' => 'Mêmes contre-indications que le bain froid',
    'posologie' => 'Eau au-dessous de l\'estomac
Friction du dos et du thorax pendant le bain',
    'conseil_du_moment' => '',
    'proprietes' => '',
    'sources_alimentaires' => '',
    'synergies' => '',
    'notes' => '',
  ),
  19 => 
  array (
    'categorie' => 'Techniques par le froid',
    'nom' => 'Bain de siège froid',
    'partie_utilisee' => '',
    'description' => 'Outil préféré de Kneipp mais surtout vulgarisé par Louis Kuhne. Selon Kuhne, le bas-ventre est le siège de substances nocives ; lorsqu\'il y a un trop-plein, les toxines s\'expriment par les émonctoires (peau, poumons, gorge, sinus). Principe = froid + friction, pour rafraîchir ce "volcan" et régulariser les différences thermiques entre organes.',
    'indication' => 'Combattre les fermentations, ballonnements
Stimuler le péristaltisme, la constipation
Stimuler le système nerveux, les reins, la circulation sanguine, les organes génitaux, les glandes surrénales
Peut aider à l\'endormissement
Régulation de la fièvre
Hémorroïdes
Décongestion par dérivation des zones périphériques et supérieures (poumons, cœur, tête)
Endométriose, SPM, ménopause
Fatigue',
    'contre_indications' => 'Grands dévitalisé.es
Asthénie
En début de règles : à moduler selon la personne, pas une contre-indication ferme',
    'posologie' => 'Bac, bidet, fond de baignoire ou grande cuvette, eau aussi froide que possible (glaçons) jusqu\'au nombril
Le reste du corps est couvert, les pieds au sol au chaud
Le matin avant le petit-déjeuner
Friction des organes génitaux, du ventre et des reins pendant le bain avec une toile rugueuse de jute
Réaction très rapide, pas d\'essuyage
Si possible, eau coulante très froide (rivière) plutôt qu\'eau stagnante',
    'conseil_du_moment' => 'Le matin, avant le petit-déjeuner.',
    'proprietes' => '',
    'sources_alimentaires' => '',
    'synergies' => 'À l\'origine des bains dérivatifs modernes',
    'notes' => '',
  ),
  20 => 
  array (
    'categorie' => 'Techniques par le froid',
    'nom' => 'Bains dérivatifs',
    'partie_utilisee' => '',
    'description' => 'Adaptation moderne du bain de siège froid (technique décrite par Louis Kuhne, prolongée par les recherches de France Guillain). Rafraîchissement de l\'entre-jambes (plis inguinaux et périnée) à l\'eau froide ou par poche de gel, dans le but de faire vibrer et rendre motiles les intestins et l\'ensemble du fascia. Cette motilité provoque l\'expulsion des selles et le déplacement des graisses (brunes/fluides) dans tout le corps vers les intestins et les reins pour évacuation. Selon France Guillain, le bain dérivatif réduit l\'état inflammatoire et ramène le corps à sa température interne idéale de 36,6°C.',
    'indication' => 'Meilleure élimination, diminution des inflammations
Remodelage de la silhouette, régulation et perte de poids, cellulite
Augmentation de la résistance au froid
Amélioration de la circulation sanguine et lymphatique, jambes lourdes
Amélioration de l\'état de la peau : acné, éruptions cutanées, eczéma
Détoxication et revitalisation
Acouphènes, allergies aux pollens, angines, sinusites
Arthrose, arthrite, asthme
Constipation, problèmes digestifs
Dépendances (alcool, tabac, café)
Maux de tête, migraines
Hémorroïdes, congestion du petit bassin
Insomnie
Endométriose, ménopause, postpartum
Infections, baisse immunitaire, fatigue chronique
Enfants et bébés (avec des temps adaptés)',
    'contre_indications' => 'Plaies sur la zone de friction
Épuisement total
Prothèse chirurgicale ou stimulateur cardiaque (méthode à l\'eau non recommandée, poche de gel possible après stabilisation)
Opération récente ou greffe (méthode à l\'eau non recommandée)
Grossesse au 1er trimestre ou grossesse à risque
En début de règles ou après une césarienne/un accouchement : à moduler selon la personne, pas une contre-indication ferme',
    'posologie' => 'Matériel : linge, éponge ou gant de toilette + bassine, bidet ou seau d\'eau fraîche
S\'asseoir avec la bassine sous le niveau des fesses, habillé.e chaudement (pull, chaussettes) sauf le slip, pieds au sec et au chaud, pièce chauffée
Commencer par de l\'eau tiède puis fraîche/froide (jamais glacée)
Geste continu de va-et-vient entre l\'eau fraîche et la zone à rafraîchir (de chaque côté du pubis jusqu\'à l\'anus)
Durée : 10, 15, 20 ou 30 minutes, 1 à 2 fois par jour ou plus en cas de maladie aiguë ou de douleurs importantes
En cure : 6 jours sur 7, sinon en cas de besoin (fièvre, migraine) autant que nécessaire
Pas de bain dérivatif après le repas (laisser 1h d\'intervalle)
Variante avec poches de gel (4 ou plus, type 36.6°) : plus pratique et portable',
    'conseil_du_moment' => '',
    'proprietes' => '',
    'sources_alimentaires' => '',
    'synergies' => 'Combiné parfois avec la bouillotte (bains dérivatifs + bouillotte) pour l\'endométriose, le SPM ou les hémorroïdes',
    'notes' => 'Réactions possibles au début (crise curative) : réactions cutanées, fatigue saine le soir, réveil de douleurs anciennes, perte d\'appétit, crampes d\'estomac, nausées ; effets provisoires, varier les heures de pratique pour les réduire. Éviter les frissons et le refroidissement pendant la pratique.',
  ),
  21 => 
  array (
    'categorie' => 'Techniques par le froid',
    'nom' => 'Pédiluve froid (bain de pieds froid)',
    'partie_utilisee' => '',
    'description' => 'Bain local des pieds à l\'eau froide. Le choc thermique provoque un afflux de sang sur les pieds refroidis, libérant par réaction les congestions des autres parties du corps.',
    'indication' => 'Excellent pour les cérébraux, les surmenés
Peut aider en cas de risques de glaucome et de ruptures des vaisseaux sanguins
Améliore les varices, les œdèmes, les pieds douloureux
Soulage les maux de tête d\'origine congestive
Combat la fatigue, facilite le sommeil
Bon en été quand il fait trop chaud',
    'contre_indications' => 'Jamais de bain de pieds froid sur des pieds déjà froids
En cas de frissons',
    'posologie' => 'Bassine d\'eau à mi-mollet (rivière, eau de mer) ; Kneipp conseillait la marche dans un filet d\'eau courante
1 à 2 minutes, 3 fois par semaine
Ne pas se sécher, mais faire de la gymnastique ou marcher ensuite',
    'conseil_du_moment' => '',
    'proprietes' => '',
    'sources_alimentaires' => '',
    'synergies' => '',
    'notes' => '',
  ),
  22 => 
  array (
    'categorie' => 'Techniques par le froid',
    'nom' => 'Maniluve froid (bain de bras froid)',
    'partie_utilisee' => '',
    'description' => 'Bain local des mains et des avant-bras à l\'eau froide. Comme le pédiluve froid, il décongestionne le sang de la tête par un appel sanguin vers les bras.',
    'indication' => 'Combat les vertiges, les céphalées congestives
Cas de glaucome
Régularise la tension
Aide les problèmes cardiaques d\'origine nerveuse ou organique (effet tonicardiaque)
Effet calmant, apaisant des oppressions, des angoisses, du stress',
    'contre_indications' => '',
    'posologie' => 'Cuvette ou lavabo, eau jusqu\'au milieu du biceps
Environ 14°C pendant 30 secondes, à répéter 3 à 4 fois
Séchage par balancement des bras',
    'conseil_du_moment' => '',
    'proprietes' => '',
    'sources_alimentaires' => '',
    'synergies' => 'Possibilité d\'utiliser 2 cuvettes pour alterner chaud/froid',
    'notes' => '',
  ),
  23 => 
  array (
    'categorie' => 'Techniques par le froid',
    'nom' => 'Bain de tête et de visage froid',
    'partie_utilisee' => '',
    'description' => 'Immersion du visage dans un récipient d\'eau froide suffisamment grand, en arrosant en même temps l\'arrière du crâne.',
    'indication' => 'Décongestion des sinus et de la tête
Raccourcit les rhumes et les rhinites, céphalées d\'origine congestive
Tonique, rafraîchissant du visage et de la peau (cosmétique naturelle)
Bain d\'œil associé (ouvrir/fermer les yeux plusieurs fois) : endurcit l\'œil, conjonctivite',
    'contre_indications' => 'Glaucome (tension extrême intra-oculaire)',
    'posologie' => 'Eau froide à 14-15°C, 20 à 40 secondes, 2 à 3 fois après inspiration, 3 à 5 fois par semaine',
    'conseil_du_moment' => '',
    'proprietes' => '',
    'sources_alimentaires' => '',
    'synergies' => '',
    'notes' => '',
  ),
  24 => 
  array (
    'categorie' => 'Techniques alternées chaud/froid',
    'nom' => 'Douche écossaise',
    'partie_utilisee' => '',
    'description' => 'Alternance de jets d\'eau chaude et d\'eau fraîche sur tout ou partie du corps. Conjugue les principes de contraction et de dilatation des vaisseaux sanguins pour induire une "gymnastique" des gaines vasculaires et les inciter à retrouver leur tonicité et leur autonomie.',
    'indication' => 'Sensation de lourdeur dans les jambes (par temps chaud, stagnation veineuse)
Tonification des circuits veineux et lymphatiques
Régulation cardiaque (stress adaptatif bénéfique sur les capteurs qui régulent les contractions du cœur et l\'irrigation du cerveau)
Brassage des liquides organiques et activation des émonctoires du foie et surtout du rein
Stimulation générale par la tonification des surrénales
Fatigue, troubles de la ménopause',
    'contre_indications' => 'Peu de contre-indications, car il est possible d\'adapter durée, zone d\'application et température de l\'eau
Prudence chez les personnes souffrant de pathologies cardiaques et d\'hypertension artérielle non stabilisées : zones réduites, faible amplitude thermique',
    'posologie' => 'Debout ou assis.e sur le rebord d\'une baignoire (jambes, puis éventuellement périnée, organes génitaux, bas du dos, tout le dos, face ventrale, ou bras)
Eau tiède/chaude (38-39°C, non brûlante) en comptant lentement jusqu\'à 10 ou 15
Eau fraîche (non glacée), jet plus puissant, en remontant des pieds vers le haut des cuisses en comptant jusqu\'à 30, de bas en haut
Alterner plusieurs fois (3, 5...), terminer par le froid (sauf si frileux)
Étendre progressivement la pratique à tout le corps, des pieds vers la tête, en respirant et en se frictionnant
Repos ensuite, allongé.e, jambes légèrement surélevées, respirations lentes abdominales',
    'conseil_du_moment' => '',
    'proprietes' => '',
    'sources_alimentaires' => '',
    'synergies' => '',
    'notes' => '',
  ),
  25 => 
  array (
    'categorie' => 'Techniques alternées chaud/froid',
    'nom' => 'Méthode Gardelle',
    'partie_utilisee' => '',
    'description' => 'Technique développée par Pierre Gardelle (décédé en 2005 à 95 ans), fondée sur le "principe de Carnot" : pour créer une énergie, il faut une source chaude et une source froide. Lorsqu\'un site organique est accidenté ou en morbidité, sa température augmente (inflammation) ; on refroidit alors le site atteint et on place de la chaleur sur une zone d\'élimination majeure (plexus solaire, abdomen, foie, rate), créant une différence de température qui provoque une circulation et une dérivation.',
    'indication' => 'Capsulite de l\'épaule
Lumbago, hernie discale, douleurs de dos
Migraine/céphalée (ne fonctionne pas pour tous les types de migraines)
AVC et troubles suite à un AVC (hémiplégie, aphasie)
Tumeur non cancéreuse cérébrale
Paralysie des jambes
Alzheimer
Gangrène à la jambe
Douleurs dentaires',
    'contre_indications' => 'Articles parus dans des revues de santé naturelle mais pas d\'études scientifiques sur le sujet',
    'posologie' => '1. Sur le site à soigner : vessie de glace à 10-13°C avec un linge interposé (ne pas utiliser de pains de glacière)
2. Simultanément, sur le ventre (foie compris) : serviette ou linge mouillé le plus chaud possible + bouillotte à 40-44°C par-dessus pour tenir la chaleur
En moyenne : 20 minutes à 1 heure, à renouveler 2 à 3 fois dans la journée si besoin
Cas plus graves : séances de 1h trois fois par jour, ou jusqu\'à 3-4h d\'affilée par jour selon le problème
Changer la bouillotte ou la poche de froid si nécessaire pour garder la bonne température',
    'conseil_du_moment' => '',
    'proprietes' => '',
    'sources_alimentaires' => '',
    'synergies' => 'Otites : variante en dérivation avec un linge trempé dans l\'eau très froide autour du cou et un gant de toilette trempé dans l\'eau très chaude (40-42°C) sur l\'oreille, à changer toutes les 5 minutes (4 fois), durée totale 20 minutes, 1 à 2 fois par jour',
    'notes' => 'Ne nécessite aucun appareil ni produit, seulement de l\'eau chaude et des glaçons. Ne pas remplacer la compresse chaude par une simple bouillotte : le linge humide en dessous est essentiel (une exsudation de la peau, petits boutons ou petits abcès "de décharge" peuvent apparaître, c\'est normal). Le refroidissement de la tête peut entraîner un état de somnolence, ce qui est normal.',
  ),
  26 => 
  array (
    'categorie' => 'Techniques alternées chaud/froid',
    'nom' => 'Pédiluves et maniluves alternés (2 bassines)',
    'partie_utilisee' => '',
    'description' => 'Alternance de bains de pieds et/ou de mains chauds et froids à l\'aide de deux bassines, pour stimuler la circulation par un effet de "gymnastique vasculaire" locale.',
    'indication' => 'Circulation sanguine
Fatigue
Jambes lourdes',
    'contre_indications' => 'Grosses varices, phlébites (contre-indication du volet chaud)',
    'posologie' => 'Bassine chaude (37-40°C) : 2 minutes ; bassine froide : 30 secondes
Répéter 3 à 4 fois, terminer par le froid',
    'conseil_du_moment' => '',
    'proprietes' => '',
    'sources_alimentaires' => '',
    'synergies' => 'Souvent citée en complément du sauna ou du hammam suivis d\'une douche ou d\'un bain froid',
    'notes' => '',
  ),
  27 => 
  array (
    'categorie' => 'Techniques internes',
    'nom' => 'Lota / douche nasale (Neti)',
    'partie_utilisee' => '',
    'description' => 'Méthode de nettoyage nasal issue de la tradition ayurvédique ("Neti" ou "Jala néti"). Nettoie les fosses nasales des impuretés, mucus et poussières à l\'eau salée tiède. Relaxe et nettoie toute la cavité nasale, avec un effet sur les yeux, les oreilles, la gorge et le cerveau.',
    'indication' => 'Rhumes, sinusite (prévention, entretien, curatif)
Asthme, allergies au pollen et autres allergies
Décongestion ORL
En cas de pollution',
    'contre_indications' => '',
    'posologie' => 'Utiliser un pot de Neti/Lota dont le tube s\'insère de façon étanche dans la narine
Remplir d\'eau tiède additionnée de sel (1 cuillère à café rase de sel fin complet ou gris pour une teneur en sel proche de 0,9%, comme le sang)
Pencher la tête en avant et sur le côté, laisser l\'eau traverser d\'une narine à l\'autre en emportant les impuretés, respirer par la bouche
Verser la moitié de l\'eau par une narine, souffler doucement, puis répéter de l\'autre côté
En cas de nez sec : ajouter une goutte d\'huile végétale ; en cas d\'infection : oligo-éléments (cuivre, argent)
Utilisation régulière dans l\'hygiène matinale en cure, ou plusieurs fois par jour en situation aiguë (rhume, sinusite, allergie)
Entretien du lota : rinçage à l\'eau claire après chaque utilisation, lavage à l\'eau vinaigrée 1 fois par semaine en usage régulier',
    'conseil_du_moment' => '',
    'proprietes' => '',
    'sources_alimentaires' => '',
    'synergies' => '',
    'notes' => '',
  ),
  28 => 
  array (
    'categorie' => 'Techniques internes',
    'nom' => 'Inhalation',
    'partie_utilisee' => '',
    'description' => 'Traitement consistant à inhaler des vapeurs d\'eau chaude chargées de molécules aromatiques (huiles essentielles), qui pénètrent ainsi plus facilement dans les fosses nasales, les sinus et les bronches. Hydrate la muqueuse et réactive le mécanisme d\'auto-nettoyage des poumons.',
    'indication' => 'Dès les premiers symptômes d\'un rhume, pour enrayer son évolution
Soulage une congestion nasale, sinusite, nez bouché
Bronchite aiguë, bronchite chronique, toux grasse ou sèche
Anti-infectieux, décongestionnant, humidifiant, hydratant, fluidifiant
Rééquilibre les muqueuses, facilite l\'expectoration
Maintien de la fonction pulmonaire',
    'contre_indications' => 'Asthmatiques, notamment avec l\'huile essentielle d\'eucalyptus globulus
Antécédents d\'épilepsie ou de convulsions
À adapter pour les enfants, femmes enceintes et allaitantes selon les huiles autorisées
Attention aux huiles essentielles à phénols et à cétones',
    'posologie' => 'Faire chauffer de l\'eau jusqu\'à ce qu\'elle soit frémissante, verser dans un inhalateur ou un bol
Disperser 3 à 7 gouttes d\'huiles essentielles (idéalement avec un dispersant) ou un mélange prêt à l\'emploi
Patienter 2 à 3 minutes, retirer lunettes ou lentilles, fermer les yeux
Se placer au-dessus du bol (serviette sur la tête) ou de l\'inhalateur, respirer normalement pendant 10 minutes
2 à 3 fois par jour, pendant 10 minutes
HE selon l\'indication : rhume (eucalyptus radié, lavande fine, pin sylvestre, niaouli), nez bouché (menthe poivrée 1 goutte max, eucalyptus radié, pin sylvestre), sinusite (eucalyptus radié, niaouli, myrte verte, pin sylvestre, thym à linalol), infection/état grippal (niaouli, tea tree, ravintsara, thym à linalol), toux grasse (eucalyptus radié, lavande fine, pin sylvestre, myrte, thym à linalol), toux sèche (eucalyptus radié, lavande fine, cyprès, niaouli, thym à linalol)
Huiler le nez (huile ou beurre de karité) pour protéger la peau',
    'conseil_du_moment' => '',
    'proprietes' => '',
    'sources_alimentaires' => '',
    'synergies' => '',
    'notes' => '',
  ),
  29 => 
  array (
    'categorie' => 'Techniques internes',
    'nom' => 'Gargarisme',
    'partie_utilisee' => '',
    'description' => 'Gargarisme à base d\'eau chaude non brûlante, additionnée de sel et citron et/ou de teinture-mère de calendula ou de propolis, à pratiquer dès les premiers signes d\'inconfort dans la gorge.',
    'indication' => 'Mal de gorge, sensation d\'inconfort, déglutition douloureuse
Angine, extinction de voix, amygdalite
Infections buccales
Maladie des gencives (sans citron)',
    'contre_indications' => '',
    'posologie' => '1/2 verre d\'eau chaude avec une bonne pincée de sel et du citron, et/ou 1 cuillère à café de teinture-mère de calendula (apaisante, antiseptique, anti-inflammatoire) et/ou de propolis
Prendre la solution en bouche par petites gorgées, tête inclinée en arrière, faire le son "A" pour la vibration
Garder chaque bouchée 30 secondes
3 fois par jour jusqu\'à guérison, avec un accompagnement global ou médical',
    'conseil_du_moment' => '',
    'proprietes' => '',
    'sources_alimentaires' => '',
    'synergies' => 'Boire chaud, bouillotte sur la gorge',
    'notes' => '',
  ),
  30 => 
  array (
    'categorie' => 'Techniques internes',
    'nom' => 'Douche rectale',
    'partie_utilisee' => '',
    'description' => 'Injection de 300 à 500 g/ml d\'eau tiède dans le rectum pour activer naturellement l\'évacuation des selles accumulées et stimuler le péristaltisme du côlon par réflexe. Stimule également par voie réflexe les organes du petit bassin (urinaires, gynécologiques, sexuelles, circulatoires, hormonales).',
    'indication' => 'Constipation, dérangements digestifs, transit ralenti
Troubles aigus infectieux, inflammatoires, allergiques, nerveux, migraine, grippe, rhume
Crises de sciatique, lumbagos
Règles douloureuses
Facilite la détox et la perte de poids
Pendant les monodiètes et les jeûnes',
    'contre_indications' => 'Tumeurs du rectum, de l\'anus
Intervention chirurgicale récente de l\'abdomen
Hémorroïdes, fissures anales
Saignements intestinaux, rectocolite hémorragique
Grossesse, règles
Diarrhées à répétition',
    'posologie' => 'Se munir d\'une poire ou d\'un bock à lavement mural ou de voyage
Préparer 300 à 500 g d\'eau tiède du robinet
Injecter dans l\'anus en position à quatre pattes ou sur le côté
Ne pas garder l\'eau : la rejeter de suite',
    'conseil_du_moment' => '',
    'proprietes' => '',
    'sources_alimentaires' => '',
    'synergies' => '',
    'notes' => 'L\'eau se déversant dans le rectum (partie finale du côlon) provoque une réaction d\'évacuation réflexe immédiate.',
  ),
  31 => 
  array (
    'categorie' => 'Techniques internes',
    'nom' => 'Lavement',
    'partie_utilisee' => '',
    'description' => 'Introduction de 2 à 2,5 litres d\'eau tiède salée dans le côlon, pour activer l\'évacuation des matières accumulées, nettoyer le gros intestin, décongestionner et stimuler les organes digestifs et du petit bassin. Va plus loin que la douche rectale.',
    'indication' => 'Mêmes indications que la douche rectale, avec un nettoyage plus profond du gros intestin
Sensation de légèreté et de clarté mentale
Détox et perte de poids, changement de saison',
    'contre_indications' => 'Troubles cardiaques sévères
Grossesse, règles
Intervention chirurgicale récente de l\'abdomen
Hémorroïdes, fissures anales
Tumeurs du rectum, de l\'anus, du côlon
Saignements intestinaux, rectocolite hémorragique
Possibles crises d\'élimination et libérations émotionnelles',
    'posologie' => 'Se munir d\'une poche ou d\'un bock à lavement
Remplir avec 2 à 2,5 L d\'eau tiède du robinet salée à 1 cuillère à soupe de sel par litre (ou remplacer par une tisane de camomille)
Fixer le récipient à 1 mètre du sol ou un peu plus
S\'allonger sur le côté ou se mettre à quatre pattes, introduire la canule huilée sur 5 à 8 cm
Après l\'injection, garder l\'eau en respirant profondément et en massant le ventre dans le sens des aiguilles d\'une montre
Laisser l\'évacuation se faire au rythme du corps
En cure : une à deux fois par mois sur 2 à 3 mois ; plus souvent lors d\'un jeûne ou d\'une monodiète ; 3 à 4 fois par an au changement de saison',
    'conseil_du_moment' => '',
    'proprietes' => '',
    'sources_alimentaires' => '',
    'synergies' => '',
    'notes' => 'Cas particulier : un lavement peut être effectué en préparation à l\'accouchement, validé par la sage-femme ou le gynécologue.',
  ),
  32 => 
  array (
    'categorie' => 'Techniques internes',
    'nom' => 'Hydrothérapie du côlon',
    'partie_utilisee' => '',
    'description' => 'Version moderne du lavement, pratiquée avec un praticien : introduction d\'eau dans le rectum par une canule à deux voies, à l\'aide d\'un appareil qui maîtrise le débit, la température et la quantité d\'eau, avec massage abdominal simultané. Stimule les mouvements de l\'intestin et déclenche l\'évacuation des selles, mucus et cellules mortes.',
    'indication' => 'Pathologies du côlon : constipation, diarrhées, ballonnements, gaz, parasitoses, dysbioses, diverticuloses
Signes d\'auto-intoxication chronique (dépression, migraine, troubles du sommeil, dorsalgie, dermatoses, insuffisance rénale, sinusite, troubles veineux et lymphatiques, infections urinaires, dysménorrhée, allergies)
Avant/après une anesthésie générale ou un traitement lourd
En accompagnement d\'une psychothérapie ou d\'un changement de vie
En soutien lors d\'une nouvelle hygiène alimentaire
En cas de cures de détoxication, diètes ou jeûnes
En soutien immunitaire, pour retrouver de l\'énergie',
    'contre_indications' => 'Chirurgie récente du côlon ou du rectum
Carcinome évolué du côlon ou du rectum
Traitement par radiothérapie au niveau du sigmoïde, du rectum ou de l\'anus
Cardiopathies sévères
Nécrose par irradiation
Insuffisance rénale, cirrhose
Anémie sévère
Grossesse, règles
Pathologies inflammatoires aiguës du côlon (rectocolite hémorragique, maladie de Crohn)
À éviter en cas de candidose',
    'posologie' => 'Séance de 45 minutes à 1 heure, avec massage du ventre
Idéalement 3 séances pour commencer, puis 1 à 2 par an en cas de problèmes chroniques',
    'conseil_du_moment' => '',
    'proprietes' => '',
    'sources_alimentaires' => '',
    'synergies' => '',
    'notes' => 'Les bénéfices de l\'hydrothérapie du côlon n\'ont pas été démontrés scientifiquement et font débat au sein du corps médical (risques de perforation et d\'infection selon certains médecins). Pratique non réglementée : à réaliser avec une personne sérieuse, certifiée et recommandée, en vérifiant la propreté des lieux et de l\'équipement.',
  ),
  33 => 
  array (
    'categorie' => 'Techniques internes',
    'nom' => 'Douche Xantis',
    'partie_utilisee' => '',
    'description' => 'Réflexologie intestinale qui active et rééduque les réflexes neuro-musculaires de la dernière partie du côlon (sigmoïde et ampoule rectale), à l\'aide d\'une préparation à base de sels de potassium, grande absinthe et mauve, associée à une prise de fibres. Provoque un lavement instantané et une activation réflexe de la motricité intestinale, avec assainissement du milieu intestinal et rééquilibrage neuro-végétatif.',
    'indication' => 'Colopathies fonctionnelles : transit lent, constipation, alternance diarrhée/constipation, spasmes digestifs, digestion difficile, acidité gastrique, ballonnements, flatulences, côlon irritable, parasitoses
Excès de poids dans la zone abdominale, cellulite
Dérèglement de la glycémie et du cholestérol
Difficulté à prendre du poids, mauvaise assimilation
Manque de tonicité de la peau, dermatoses diverses
Stress, troubles légers du sommeil, anxiété, fatigue chronique
Manque de souplesse articulaire, douleurs, rhumatismes, arthrose
Fragilité aux infections, allergies, pathologies auto-immunes
Infertilité',
    'contre_indications' => 'Les trois semaines suivant une intervention chirurgicale
Troubles cardiaques, hypertension artérielle mal contrôlée
Grossesse, règles
Insuffisance rénale terminale
Rectocolite hémorragique active
Nécrose colique suite à une radiothérapie
Tumeurs du rectum, de l\'anus
Hémorroïdes, fissures anales',
    'posologie' => 'Cure de 6 jours : 1 séance par jour, 6 jours de suite, le matin à jeun ou le soir avant le dîner (ne pas avoir mangé depuis 5 heures). Séance de 30 minutes. Fréquence : tous les 3 mois.
Cure de 30 jours : 1 semaine de préparation avec sachets diététiques seuls, puis 3 semaines de nettoyage avec 1 sachet diététique par jour + 1 séance de douche Xantis, avec 1 jour d\'interruption par semaine. Fréquence : tous les 18 mois.',
    'conseil_du_moment' => '',
    'proprietes' => '',
    'sources_alimentaires' => '',
    'synergies' => '',
    'notes' => 'Réalisée avec un praticien.',
  ),
  34 => 
  array (
    'categorie' => 'Thermalisme et thalassothérapie',
    'nom' => 'Cure thermale',
    'partie_utilisee' => '',
    'description' => 'Ensemble de soins médicaux fondés sur les propriétés des eaux thermales (environ 100 à 105 stations en France, 1200 sources répertoriées et classées selon leur composition chimique). Combine un traitement interne (cure de boisson) et des traitements externes (bains, douches, bains de boue, bains de vapeur, cataplasmes, massages, gargarismes, inhalations, irrigations vaginales ou intestinales).',
    'indication' => 'Rhumatologie (25% des cures) : Bourbonne-les-Bains, Dax
Affections respiratoires (20%)
Urologie : Vittel, Contrexéville, Capvern, Evian
Dermatologie : La Roche-Posay (eczéma), La Bourboule (allergies)
Gynécologie : Bagnères-de-Bigorre, Ussat, Bagnole-de-l\'Orne, Barèges, Salies-les-Bains, Plombières
Circulation : Aix-en-Provence, Argelès, Bains-les-Bains, Royat
Neurologie : Bagnères-de-Bigorre, Divonne-les-Bains, Néris-les-Bains, Ussat
Nutrition (cholestérol, diabète, obésité) : Brides-les-Bains, Pougues-les-Eaux, Vichy, Vittel, Contrexéville',
    'contre_indications' => '',
    'posologie' => 'Durée d\'une cure : environ 3 semaines
Sur ordonnance médicale, après acceptation de la Sécurité Sociale : frais partiellement ou totalement remboursés',
    'conseil_du_moment' => '',
    'proprietes' => '',
    'sources_alimentaires' => '',
    'synergies' => '',
    'notes' => 'Ce ne sont pas des vacances : la cure peut être contraignante et fatigante. Possible "crise thermale" en première partie de cure (insomnie légère, perte d\'appétit, fatigue, éruptions, courbatures), réaction normale et globale de l\'organisme. Bien respecter le protocole (horaires, traitements, exercices, repos, conseils nutritionnels) et prévoir un temps de repos post-cure.',
  ),
  35 => 
  array (
    'categorie' => 'Thermalisme et thalassothérapie',
    'nom' => 'Thalassothérapie',
    'partie_utilisee' => '',
    'description' => 'Utilisation de l\'eau de mer, riche en sels minéraux et oligo-éléments, associée à des substances organiques (algues) et à de nombreux micro-organismes (planctons). Comprend des bains de mer souvent chauds (meilleure pénétration des minéraux) et l\'application d\'algues ou de boues marines riches en minéraux (iode, fer, silice).',
    'indication' => 'Reminéralisation profonde, revitalisation
Détente et récupération
Amélioration de la circulation
Bienfaits concentrés de l\'eau de mer',
    'contre_indications' => '',
    'posologie' => 'Le climat marin (iode, particules marines) et le soleil complètent la cure',
    'conseil_du_moment' => '',
    'proprietes' => '',
    'sources_alimentaires' => '',
    'synergies' => '',
    'notes' => 'La prise en charge peut être différente de celle d\'une cure thermale : vérifier le remboursement au préalable.',
  ),
);
}

function getRessourcesAlimentation(): array {
    return array (
  0 => 
  array (
    'categorie' => 'Fondamentaux de la nutrition',
    'nom' => 'Approche holistique vs réductionniste de la nutrition',
    'partie_utilisee' => '',
    'description' => 'La science de la nutrition oppose deux approches : le réductionnisme, qui réduit l\'aliment à la somme de ses nutriments isolés (d\'où le nutritionnisme fonctionnel, les alicaments, les superaliments, les aliments enrichis), et l\'holisme, qui étudie l\'aliment dans sa matrice globale et ses interactions.
La matrice alimentaire (organisation structurelle de l\'aliment) gouverne la biodisponibilité des nutriments : deux aliments de même composition nutritionnelle mais de structures différentes n\'ont pas le même devenir métabolique (ex : pain à mie dense vs aérée, sucre du fruit avec matrice vs sucre libre ajouté).
Les aliments ultra-transformés (classification NOVA) dégradent cette matrice : dérégulation de la satiété, augmentation de l\'index glycémique, absorption lipidique accrue.',
    'indication' => 'Comprendre pourquoi privilégier les aliments bruts et peu transformés plutôt que des nutriments isolés
Éduquer le consultant à la lecture critique des allégations santé et du marketing nutritionnel
Développer un regard critique sur les études scientifiques en nutrition (biais du réductionnisme, essais sur nutriments isolés non transposables aux aliments)',
    'contre_indications' => '',
    'posologie' => 'Privilégier des aliments avec une matrice préservée (peu transformés) plutôt que des aliments fractionnés ou enrichis
Limiter les aliments ultra-transformés (classification NOVA groupe 4)
Garder un regard critique face aux tendances alimentaires et aux "aliments miracles"',
    'conseil_du_moment' => '',
    'proprietes' => 'Une matrice alimentaire préservée optimise la biodisponibilité et les effets physiologiques des nutriments (meilleure satiété, index glycémique plus bas, meilleure absorption)',
    'sources_alimentaires' => 'Aliments bruts, peu transformés, cuisinés maison plutôt que produits industriels enrichis ou fractionnés',
    'synergies' => 'S\'articule avec toutes les approches alimentaires ciblées (anti-inflammatoire, low carb, microbiote...) comme principe transversal de choix des aliments',
    'notes' => 'Aucun consensus scientifique stable sur les recommandations nutritionnelles : des aliments jugés sains à une époque sont ensuite déconseillés puis réhabilités (graisses, œufs, avocat...). La connaissance des molécules bioactives des aliments reste très partielle (moins de 0,5% des composés identifiés ont été étudiés).',
  ),
  1 => 
  array (
    'categorie' => 'Stratégies pratiques',
    'nom' => 'Chronobiologie alimentaire',
    'partie_utilisee' => '',
    'description' => 'La chronobiologie étudie les rythmes biologiques (circadien ~24h, ultradiens <20h, infradiens >28h) régis par l\'horloge centrale (noyaux suprachiasmatiques de l\'hypothalamus, synchronisée par la lumière) et des horloges périphériques (foie, intestin, reins...) synchronisées notamment par l\'heure des repas.
L\'heure et la régularité des repas influencent la synchronisation des horloges périphériques (et non l\'horloge centrale), la qualité de la digestion, l\'assimilation des nutriments et la sécrétion hormonale (cortisol le matin, mélatonine la nuit).',
    'indication' => 'Troubles digestifs liés à un rythme alimentaire irrégulier
Fatigue, troubles de l\'humeur ou du sommeil en lien avec le timing des repas
Travail de nuit ou horaires décalés (adapter le rythme alimentaire au rythme veille/sommeil)
Optimisation de la synthèse musculaire (répartition des protéines) et du bien-être cognitif',
    'contre_indications' => '',
    'posologie' => 'Manger à heures régulières, tous les jours (peu importe le nombre de repas : 1 à 4, l\'important est la régularité)
Répartir les apports en protéines de façon égale sur les repas plutôt que de les concentrer le soir (30g par repas favoriserait +25% de synthèse musculaire) ; les études suggèrent un meilleur anabolisme protéique le matin
Petit déjeuner protéiné pour la synthèse de dopamine/noradrénaline (vigilance, motivation) ; le "petit déjeuner de roi" convient aux personnes du matin, actives, en surpoids métabolique ; le jeûne intermittent du matin peut convenir aux personnes du soir ou sédentaires
Privilégier un apport glucidique en fin d\'après-midi (vers 17h) pour favoriser le passage du tryptophane et la synthèse de sérotonine puis mélatonine
Dîner léger et pris tôt (digestion complète avant le coucher, environ 4h avant)
Personne travaillant de nuit : s\'alimenter principalement pendant la nuit (période d\'éveil) plutôt que le jour',
    'conseil_du_moment' => 'Prendre le temps de bien mâcher et de manger dans un contexte détendu (éviter les repas stressants ou pris devant un écran)',
    'proprietes' => 'Une alimentation régulière stabilise le rythme circadien, optimise la digestion, l\'assimilation cellulaire et le bien-être émotionnel',
    'sources_alimentaires' => 'Petit déjeuner : protéines (œufs, poisson, viande), un peu de lipides de qualité, glucides de qualité
Déjeuner : protéines + légumes + féculents + lipides, moment privilégié pour l\'apport protéique
Collation d\'après-midi (~17h) : glucides de qualité (fruit, chocolat noir)
Dîner : léger, végétarien de préférence, riche en fibres',
    'synergies' => 'S\'articule avec le jeûne intermittent, l\'arrêt du sucre et l\'alimentation anti-stress',
    'notes' => 'La méthode commerciale de "chrono-nutrition" du Dr Delabos est partiellement infirmée par la recherche scientifique ; ce cours se limite aux données validées sur le rythme des repas',
  ),
  2 => 
  array (
    'categorie' => 'Stratégies pratiques',
    'nom' => 'Stratégie d\'accompagnement de l\'arrêt du sucre',
    'partie_utilisee' => '',
    'description' => 'Approche naturopathique visant à réduire la consommation de sucres raffinés/ajoutés, responsables de résistance à l\'insuline, inflammation chronique, dysbiose intestinale, candidose et d\'un cercle vicieux de fringales et fatigue chronique. L\'addiction au sucre au sens strict n\'est pas prouvée scientifiquement, mais des mécanismes neuronaux de renforcement (appétence, valeur calorique) sont documentés.',
    'indication' => 'Compulsions et envies irrépressibles de sucre, notamment en fin de journée
Fatigue chronique avec coups de barre post-prandiaux, hypoglycémies réactionnelles
Surpoids, résistance à l\'insuline (HOMA > 2.4), prédiabète
Troubles de l\'humeur, irritabilité liés aux fluctuations glycémiques
Terrain acide, dysbiose ou candidose intestinale',
    'contre_indications' => 'Arrêt trop brutal et restrictif chez une personne à risque de troubles du comportement alimentaire (TCA)',
    'posologie' => 'Anamnèse ciblée : repérer les sources de sucre caché (boissons, produits transformés, féculents raffinés), la charge glycémique des repas, individualiser le terrain (HOMA, inflammation, terrain acide)
Choisir entre suppression progressive (mieux tolérée, tenable sur le long terme) ou arrêt net (effets plus rapides mais risque de rechute ou de TCA) selon le profil
Rééquilibrage chrononutritionnel : petit déjeuner avec ~25-30g de protéines (tester le salé), déjeuner structuré (protéines + légumes + féculents), dîner similaire avec jeûne de 12h jusqu\'au petit déjeuner
Substituer progressivement : sucrants à IG bas (sirop de yacon, sucre de coco), gâteaux maison, alterner féculents raffinés/semi-complets/complets
Accompagner d\'une hygiène de vie globale : sommeil (7-9h), activité physique (10 000 pas/j), gestion du stress (cohérence cardiaque, méditation)
Outils : carnet alimentaire sur 1 semaine, fiches recettes alternatives, programme sur au moins 1 mois',
    'conseil_du_moment' => 'Éviter toute prise de produits sucrés isolés : toujours les intégrer dans un repas',
    'proprietes' => 'Stabilisation de la glycémie et de l\'insulinémie, réduction de l\'inflammation de bas grade, amélioration de l\'énergie et de l\'humeur, réduction des compulsions',
    'sources_alimentaires' => 'Privilégier : aliments bruts, sucre naturellement présent dans la matrice (fruits, féculents complets)
Éviter : sucre raffiné (sucre blanc, sirop de glucose-fructose, farines blanches), boissons sucrées, desserts industriels, édulcorants (goût sucré sans satiété calorique, effet de compensation possible)',
    'synergies' => 'Chronobiologie alimentaire, alimentation anti-inflammatoire, gestion du stress, hygiène du sommeil',
    'notes' => 'Compléments possibles selon profil : magnésium (jusqu\'à 800mg/j), vitamine D, berbérine, chrome, cannelle de Ceylan, gymnema sylvestre, resvératrol, acide alpha-lipoïque (voir suivi et dosages avec un professionnel). Cas pratique illustratif : profil de dépendance au sucre avec fatigue, stress, sommeil perturbé, nécessitant une prise en charge globale progressive.',
  ),
  3 => 
  array (
    'categorie' => 'Régimes thérapeutiques',
    'nom' => 'Alimentation low carb et cétogène',
    'partie_utilisee' => '',
    'description' => 'Régimes réduisant fortement les glucides au profit des lipides. Low carb : 50-130g glucides/jour, protéines 20-30%, lipides 40-65%, glucides 15-30%. Kéto : glucides <20-50g/jour (5-10% des apports), lipides 70-80%, protéines 5-10%. En kéto, l\'insulinopénie active la lipolyse et la cétogenèse hépatique (production de corps cétoniques : acétoacétate, béta-hydroxybutyrate, acétone), utilisables comme carburant par le cerveau et les cellules. La phase de kéto-adaptation dure 2 à 8 semaines.',
    'indication' => 'Résistance à l\'insuline, diabète de type 2, syndrome métabolique
Surpoids et obésité avec objectif de perte de poids
Troubles de l\'énergie, de l\'humeur ou de la concentration liés aux fluctuations glycémiques
Dans le cadre thérapeutique historique : épilepsie (origine du régime kéto dans les années 1920)
Prévention de maladies chroniques liées à l\'inflammation et à l\'insulinorésistance',
    'contre_indications' => 'Pancréatites ou pathologies hépatiques, troubles du métabolisme des graisses, déficit héréditaire en carnitine ou en pyruvate kinase, diabète de type 1 ou DT2 traité (suivi médical impératif), grossesse (à éviter)
Risques : "grippe cétogène" (fatigue, brouillard cérébral, crampes, déshydratation/perte d\'électrolytes), carences en régime d\'exclusion prolongé, calculs rénaux, acidocétose (à distinguer de la cétose nutritionnelle, état métabolique sain)',
    'posologie' => 'Low carb : rééquilibrage alimentaire progressif, moins contraignant, adapté à tous, pas d\'exclusion stricte mais optimisation de la qualité des glucides
Kéto : passage plutôt brutal (switch des habitudes), recommandé de suivre un plan strict 4 à 6 semaines pour l\'adaptation ; individualiser le grammage de glucides toléré (tracking macros, cétones sanguins 0,5-3 mmol/L, glycémie 80-120mg/dL)
Gérer la transition (grippe cétogène) : hydratation (2L/j minimum), électrolytes (sodium, potassium, magnésium, calcium)
Sortie du kéto : transition lente et progressive vers le low carb (augmenter progressivement protéines et glucides par paliers) pour éviter la reprise de poids
Variantes : kéto cyclique, kéto ciblé (TKD autour de l\'effort), Atkins modifié (haut en protéines) — réservés aux personnes expérimentées, non débutants',
    'conseil_du_moment' => '',
    'proprietes' => 'Stabilisation de la glycémie et de l\'insulinémie, augmentation de l\'énergie, diminution de la faim (satiété via AG circulants), amélioration de l\'humeur et des fonctions cognitives (cétones = carburant cérébral alternatif), perte de poids (utilisation des réserves graisseuses, réduction de l\'appétit)',
    'sources_alimentaires' => 'Autorisés (kéto) : viandes, poissons, œufs, légumes verts/choux/champignons, fruits rouges pauvres en glucides, huiles de qualité (olive, avocat, coco, MCT), oléagineux (avec modération), produits laitiers non pasteurisés bio full-fat
À limiter/éviter : aliments >5g glucides par portion, cacahuètes, huiles de tournesol/maïs/soja, aliments ultra-transformés, fruits très glucidiques (banane, raisin, mangue)
Électrolytes pendant la transition : avocat, poissons gras, légumes verts, sel',
    'synergies' => 'Jeûne intermittent (accélère la production de cétones), activité physique (stimule la lipolyse), alimentation paléo (compatible avec le kéto)',
    'notes' => 'Nécessite d\'individualiser fortement l\'approche (tolérance aux glucides variable). Différent du régime Atkins classique (pas nécessairement d\'état de cétose) et du régime paléo (pas de restriction stricte des glucides, focus qualité). Version végétarienne/végane possible mais plus complexe (attention aux quotas protéiques).',
  ),
  4 => 
  array (
    'categorie' => 'Régimes thérapeutiques',
    'nom' => 'Régime pauvre en FODMAPs',
    'partie_utilisee' => '',
    'description' => 'Les FODMAPs (Fermentable Oligosaccharides, Disaccharides, Monosaccharides And Polyols) sont des glucides fermentescibles peu digérés dans l\'intestin grêle, qui arrivent quasi intacts dans le côlon où ils sont fermentés par le microbiote, produisant des gaz à l\'origine de ballonnements et douleurs chez les personnes à l\'intestin sensible (SII notamment). Ce ne sont pas des aliments "mauvais" en soi : ce sont d\'excellents prébiotiques, mais mal tolérés en excès par les intestins hypersensibles. Il s\'agit d\'une approche temporaire d\'épargne digestive, non d\'un régime d\'exclusion permanent : efficace à court terme dans environ 70% des cas de troubles digestifs chroniques/SII, mais entraîne à terme une baisse de la diversité bactérienne si prolongé sans réintroduction.',
    'indication' => 'Syndrome de l\'intestin irritable (SII), troubles digestifs fonctionnels chroniques (ballonnements, douleurs abdominales, transit perturbé)
Hypersensibilité viscérale avec forte composante émotionnelle associée',
    'contre_indications' => 'Ne se justifie pas si les ballonnements ont une autre cause (sédentarité, boissons gazeuses, stress, effet secondaire de traitement, déficit enzymatique...)
Ne doit pas être un régime d\'exclusion strict et prolongé sans réintroduction (risque de perte de diversité du microbiote, de carences)
Ne doit pas être confondu avec un régime "sans" (sans gluten, sans lactose) au long cours',
    'posologie' => 'Approche progressive par étapes (sur 3 jours chacune, en observant les effets avant de passer à l\'étape suivante) :
1) Suppression des aliments ultra-transformés (plats préparés, additifs)
2) + suppression du gluten (pain, pâtes, pizza...)
3) + suppression des produits laitiers (lactose)
4) Application d\'un programme structuré pauvre en FODMAPs (élimination des principales sources, puis réintroduction progressive et individualisée pour identifier les aliments réellement mal tolérés)
L\'objectif final est de retrouver le maximum de diversité alimentaire tolérée, pas l\'exclusion permanente',
    'conseil_du_moment' => '',
    'proprietes' => 'Réduction de la fermentation colique excessive, des gaz et des douleurs associées ; "mise au repos" digestive transitoire',
    'sources_alimentaires' => 'Riches en FODMAPs à limiter en phase d\'attaque : oignon, ail cru, poireau, légumineuses (lentilles, haricots secs, pois), blé et orge, produits laitiers riches en lactose, certains fruits (pomme, poire, mangue, pastèque, fruits à noyau peu mûrs), miel, sirop de glucose-fructose, édulcorants (polyols), champignons, artichaut, chou-fleur, betterave crue
Mieux tolérés : viandes, poissons, œufs, riz, pommes de terre, carottes, courgettes, agrumes, fromages affinés (peu de lactose), huile d\'olive',
    'synergies' => 'Régime d\'épargne digestive, prise en charge de la porosité intestinale et du microbiote, gestion du stress et des émotions (axe intestin-cerveau très impliqué dans l\'hypersensibilité viscérale)',
    'notes' => 'L\'hypersensibilité digestive est fortement liée à des facteurs émotionnels et au fonctionnement du système nerveux entérique (axe intestin-cerveau) ; une prise en charge globale (alimentation + gestion émotionnelle) est recommandée plutôt qu\'une approche uniquement alimentaire. Distinguer ballonnements (gaz) de distension abdominale (relâchement musculaire/surcharge graisseuse), qui relève d\'une prise en charge différente.',
  ),
  5 => 
  array (
    'categorie' => 'Alimentation ciblée par système',
    'nom' => 'Alimentation anti-inflammatoire',
    'partie_utilisee' => '',
    'description' => 'Approche visant à réduire l\'inflammation chronique de bas grade (silencieuse, à l\'origine de fatigue, troubles digestifs, surpoids, maladies auto-immunes et cardiovasculaires) en agissant sur la digestion (porosité et dysbiose intestinales), le stress oxydatif, la glycation et l\'équilibre des acides gras (oméga 3/oméga 6).',
    'indication' => 'Fatigue et douleurs chroniques, troubles digestifs (ballonnements, SII), malabsorptions
Syndrome métabolique, surpoids, résistance à l\'insuline
Maladies auto-immunes, maladies cardiovasculaires, arthrose
Terrain inflammatoire général (CRPus élevée, rapport AA/EPA élevé)',
    'contre_indications' => 'Pas de contre-indication propre ; à adapter en cas d\'intolérances alimentaires spécifiques (surveiller notamment l\'histamine)',
    'posologie' => 'Travailler en priorité la digestion : réduire la porosité intestinale (L-glutamine, zinc-carnosine, bouillon d\'os) et la dysbiose (fibres 30g/j, prébiotiques, probiotiques, aliments fermentés)
Adopter un modèle de type méditerranéen anti-inflammatoire : fruits et légumes variés à chaque repas, féculents complets et légumineuses, huile d\'olive, oméga-3 (poissons gras 3x/semaine), épices (curcuma, gingembre, cannelle)
Éviter/réduire : excès d\'oméga-6, acides gras saturés et trans, sucres raffinés, aliments ultra-transformés, cuissons à haute température (grillades, fritures), alcool, gluten en excès
Envisager un jeûne intermittent léger et une réduction de la charge glycémique globale
Possibilité de s\'appuyer sur des modèles étudiés : régime méditerranéen, Okinawa, Seignalet (controversé), paléo, low carb',
    'conseil_du_moment' => 'Marcher 10-20 minutes après les repas pour améliorer le métabolisme du glucose',
    'proprietes' => 'Réduction des marqueurs inflammatoires (CRP, IL-6, TNF-α), amélioration de la sensibilité à l\'insuline, protection de la barrière intestinale et du stress oxydatif',
    'sources_alimentaires' => 'À privilégier : polyphénols (fruits, légumes, thé vert, cacao), oméga-3 (petits poissons gras, lin, colza, chia), fibres, épices anti-inflammatoires (curcuma, gingembre), aliments fermentés, caroténoïdes (légumes colorés)
À limiter : huile de tournesol/maïs/soja, charcuteries, produits laitiers industriels, sucre raffiné, farines blanches, fritures et grillades',
    'synergies' => 'Alimentation microbiote, low carb, gestion du stress oxydatif, activité physique modérée régulière, sommeil de qualité',
    'notes' => 'Distinguer inflammation aiguë (mécanisme de défense normal et rapide) de l\'inflammation chronique de bas grade (invisible, entretient un cercle vicieux). Le jeûne intermittent montre des effets sur l\'inflammation surtout lorsqu\'il s\'accompagne d\'une perte de poids/masse grasse significative, moins par simple restriction de la fenêtre alimentaire.',
  ),
  6 => 
  array (
    'categorie' => 'Alimentation ciblée par système',
    'nom' => 'Alimentation et équilibre du microbiote intestinal',
    'partie_utilisee' => '',
    'description' => 'Le microbiote intestinal (environ 38 000 milliards de bactéries, ~200g) assure des fonctions de protection (barrière intestinale), de collaboration immunitaire et de fonction métabolique (production de vitamines, d\'acides gras à chaîne courte/AGCC comme le butyrate, dégradation des fibres). Le "tryptique IDH" (Immunité - Dysbiose - Hyperperméabilité) est au centre de l\'inflammation de bas grade systémique lorsqu\'il est déséquilibré.',
    'indication' => 'Troubles digestifs chroniques : ballonnements, gaz, troubles du transit
SII, SIBO, maladies inflammatoires chroniques de l\'intestin (MICI)
Hyperperméabilité intestinale (leaky gut) associée à intolérances, maladies auto-immunes, troubles métaboliques
Toute prise en charge visant à renforcer le terrain immunitaire ou l\'axe intestin-cerveau',
    'contre_indications' => 'Adapter la quantité de fibres fermentescibles en cas de SIBO ou de sensibilité aux FODMAPs (5g/j de fibres fermentescibles peuvent suffire dans ce cas)',
    'posologie' => 'Diversifier au maximum les végétaux consommés : plus de 30 types de fruits et légumes différents par semaine est corrélé à une meilleure diversité bactérienne (plus important que le régime végétalien ou omnivore en soi)
Apporter des prébiotiques (ail, oignon, artichaut, asperge, banane peu mûre, pomme de terre refroidie) et des probiotiques via aliments fermentés (kéfir, kombucha, légumes lactofermentés, miso, tempeh)
Consommer au moins 30g de fibres par jour et des polyphénols (baies, céréales complètes, thé vert, cacao)
En cas de troubles digestifs : d\'abord un régime d\'épargne digestive (aliments faciles à digérer, bien mastiqués), puis réintroduction progressive
Pratiquer une activité physique régulière (150-300 min/semaine) qui augmente la diversité microbienne',
    'conseil_du_moment' => '',
    'proprietes' => 'Production d\'AGCC (butyrate) nourrissant les colonocytes, renforcement de la barrière intestinale et de la couche de mucus, régulation de l\'inflammation, de la satiété et de la sensibilité à l\'insuline',
    'sources_alimentaires' => 'Fibres fermentescibles : topinambour, artichaut, salsifis, son de blé, poireaux, ail, lentilles, asperges
Amidon résistant : sarrasin, pomme de terre refroidie, banane plantain, pois, pois chiches, flocons d\'avoine
Polyphénols : artichaut, persil, choux de Bruxelles, fruits rouges, thé vert, café, cacao
Aliments fermentés : kéfir, légumes lactofermentés, pain au levain, tempeh, miso, kombucha
À éviter en excès : sucre/fructose ajouté, émulsifiants (polysorbate 80, carboxyméthylcellulose), excès de graisses et de glucides raffinés',
    'synergies' => 'Alimentation anti-inflammatoire, gestion du stress (axe intestin-cerveau via le nerf vague), activité physique régulière',
    'notes' => 'Le régime pauvre en FODMAPs et le régime pauvre en histamine sont des outils ponctuels d\'optimisation du confort digestif, non des solutions permanentes. Les antinutriments (phytates, lectines, oxalates) des céréales/légumineuses/oléagineux peuvent être neutralisés par trempage, germination, toastage ou fermentation.',
  ),
  7 => 
  array (
    'categorie' => 'Alimentation ciblée par système',
    'nom' => 'Alimentation et équilibre nerveux (cerveau et neurotransmetteurs)',
    'partie_utilisee' => '',
    'description' => 'Le cerveau, organe le plus gras et le plus vulnérable au stress oxydatif, dépend fortement de la qualité de l\'alimentation pour son fonctionnement (neuroinflammation, glycation, stress chronique via l\'axe HHS accélèrent la neurodégénérescence). La régulation alimentaire des neurotransmetteurs (dopamine, noradrénaline, sérotonine, acétylcholine, GABA) repose sur l\'apport de leurs acides aminés précurseurs et cofacteurs (vitamines B, magnésium, zinc, fer, vitamine C).',
    'indication' => 'Troubles cognitifs : difficultés de mémorisation, de concentration, fatigue cérébrale
Troubles de l\'humeur, anxiété, stress chronique
Prévention du vieillissement cérébral et des maladies neurodégénératives
Troubles du sommeil liés à un déficit de production de sérotonine/mélatonine',
    'contre_indications' => '',
    'posologie' => 'Cuisiner des aliments bruts et limiter les produits de glycation avancée (AGE) : privilégier les cuissons douces (vapeur, pochage) et éviter grillades/fritures/four à micro-ondes ; mariner les viandes (jus de citron, vinaigre) pour réduire la formation d\'AGE
Éviter les pics de glycémie : privilégier les aliments à IG bas (légumineuses, céréales complètes riches en amylose), cuissons al dente
Choisir des acides gras de qualité : oméga-3 (EPA/DHA, poissons gras 1-3x/semaine selon l\'âge), huile d\'olive vierge, cholestérol de qualité, lécithine/choline (œufs, foie, soja)
Adapter les protéines au moment de la journée : petit déjeuner énergétique riche en glucides IG bas + protéines + lipides ; déjeuner riche en protéines ; dîner avec poisson/protéines végétales et fibres
Régler la dopamine avec un petit déjeuner protéiné peu glucidique (chronobiologie), la sérotonine avec un dîner à dominante végétarienne et un apport glucidique en fin d\'après-midi
Soutenir l\'axe intestin-cerveau (nerf vague, microbiote), pratiquer une activité physique régulière (20-30 min, effet sur le BDNF) et des exercices mentaux',
    'conseil_du_moment' => '',
    'proprietes' => 'Amélioration de la fluidité membranaire neuronale, soutien de la neurogenèse (DHA), régulation des neurotransmetteurs, protection contre le stress oxydatif et la neuroinflammation',
    'sources_alimentaires' => 'Oméga-3 (DHA/EPA) : poissons gras (saumon, maquereau, sardine, anchois, hareng), huiles de colza/noix/cameline/lin
Précurseurs de neurotransmetteurs : tyrosine/phénylalanine (viandes, poissons, œufs, légumineuses) pour la dopamine ; tryptophane (dinde, poulet, œufs, oléagineux, légumineuses) pour la sérotonine ; choline (jaune d\'œuf, foie, lécithine de soja) pour l\'acétylcholine ; acide glutamique/B6 pour le GABA
Antioxydants protecteurs (voir fiche dédiée) : vitamine C, bêta-carotène, lycopène, polyphénols (EGCG, resvératrol, quercétine), coenzyme Q10, sélénium, zinc, vitamine E
À limiter : aliments riches en AGE (grillades, produits laitiers entiers, fritures), aliments et boissons sucrés, aliments ultra-transformés',
    'synergies' => 'Alimentation anti-inflammatoire, gestion du stress et des surrénales, psychobiotiques (probiotiques ciblant l\'axe intestin-cerveau : Lactobacillus helveticus, Bifidobacterium longum...), phytothérapie adaptogène (rhodiole, ginseng, ashwagandha)',
    'notes' => 'Le cerveau consomme 20% de l\'énergie totale et 40% des glucides alimentaires malgré 2% du poids corporel. Un rapport oméga-6/oméga-3 déséquilibré (excès d\'oméga-6 dans l\'alimentation moderne) est un facteur majeur de neuroinflammation. Voir fiche annexe "Antioxydants et protection du cerveau" pour le détail des molécules antioxydantes.',
  ),
  8 => 
  array (
    'categorie' => 'Alimentation ciblée par système',
    'nom' => 'Antioxydants et protection du cerveau',
    'partie_utilisee' => '',
    'description' => 'Ensemble de vitamines, minéraux et polyphénols protégeant les neurones du stress oxydatif et de la neuroinflammation, en synergie les uns avec les autres (ex : vitamine C recycle la vitamine E).',
    'indication' => 'Prévention du déclin cognitif et du vieillissement cérébral
Protection contre le stress oxydatif chez les personnes exposées (tabac, pollution, stress chronique, excès de sport)
Soutien en cas de pathologies neurodégénératives (Parkinson, Alzheimer)',
    'contre_indications' => '',
    'posologie' => 'Adopter une alimentation variée et colorée riche en fruits et légumes, thé vert infusé 8-9 min (2 tasses/jour), raisin rouge/vin rouge avec modération, noix du Brésil (2-3/jour pour le sélénium)',
    'conseil_du_moment' => '',
    'proprietes' => 'Vitamine C : recycle la vitamine E, synthèse de la noradrénaline
Bêta-carotène : précurseur de la vitamine A
Lycopène : lié à la protection du vieillissement cérébral (étude EVA)
EGCG (thé vert) : améliore le flux sanguin cérébral
Resvératrol : traverse la barrière hémato-encéphalique, propriétés anti-inflammatoires et neuroprotectrices
Quercétine : antioxydant puissant, renforce les capillaires
Coenzyme Q10 : freine le déclin cognitif (Parkinson)
Acide alpha-lipoïque : antioxydant universel, protège les mitochondries
Zinc, sélénium, vitamine E : cofacteurs antioxydants majeurs du cerveau',
    'sources_alimentaires' => 'Vitamine C : kiwi, agrumes, poivron cru, persil, cassis
Bêta-carotène : carottes, potimarron, abricots
Lycopène : tomate (cuite de préférence)
EGCG : thé vert (variétés japonaises les plus concentrées)
Resvératrol : raisin rouge, mûres, vin rouge, pistaches
Quercétine : câpres, oignon rouge, chocolat noir, brocoli cru
Coenzyme Q10 : bœuf, sardine, noix
Zinc : huîtres, foie, viandes
Sélénium : noix du Brésil (2-3/jour)',
    'synergies' => 'Alimentation anti-inflammatoire, gestion du stress oxydatif, alimentation méditerranéenne',
    'notes' => 'Annexe complémentaire à la fiche "Alimentation et équilibre nerveux"',
  ),
  9 => 
  array (
    'categorie' => 'Alimentation ciblée par système',
    'nom' => 'Alimentation et équilibres endocriniens',
    'partie_utilisee' => '',
    'description' => 'Le système endocrinien régule le métabolisme, l\'énergie, la réaction au stress et la reproduction via un réseau de glandes et d\'hormones sensibles au mode de vie et à l\'alimentation. Les principaux axes concernés : axe hypothalamo-hypophyso-surrénalien (cortisol/stress), thyroïde, axe hypothalamo-hypophyso-gonadique (œstrogènes, progestérone, testostérone), pancréas (insuline/glycémie), tissu adipeux (organe endocrinien à part entière).',
    'indication' => 'Fatigue surrénalienne, stress chronique, troubles du rythme circadien du cortisol
Hypothyroïdie (très fréquente chez la femme) : fatigue, frilosité, prise de poids, chute de cheveux
Déséquilibres du cycle féminin : SPM, carence en progestérone, SOPK
Baisse de testostérone (andropause), troubles de la libido
Exposition aux perturbateurs endocriniens',
    'contre_indications' => 'Attention au jeûne, même intermittent, chez la femme (impact potentiel sur l\'axe hormonal)
Supplémentation en micronutriments (zinc, sélénium, fer, iode) à ajuster avec analyses biologiques, risques de surdosage',
    'posologie' => 'Réguler le cortisol : sommeil de qualité (8h), réduire les excitants, petit déjeuner gras et protéiné (pas sucré), exposition à la lumière matinale, activité physique modérée quotidienne, gestion du stress (cohérence cardiaque, méditation)
Soutenir la thyroïde : assurer les apports en iode, tyrosine, fer, vitamine D, zinc, sélénium, magnésium, vitamine A et vitamines B (cofacteurs de conversion T4→T3) ; limiter les aliments goitrigènes (crucifères crus en excès) en cas de dysfonction
Équilibrer les hormones sexuelles : alimentation riche en graisses de qualité (précurseurs stéroïdiens), protéines suffisantes, zinc/magnésium/vitamine D, gestion du poids (le tissu adipeux abdominal favorise la conversion testostérone→œstrogènes via l\'aromatase)
Soutenir la conversion T4-T3 : oméga-3, protéines de qualité, vitamines du groupe B, chronobiologie alimentaire respectée
Limiter l\'exposition aux perturbateurs endocriniens : privilégier le bio, éviter plastiques/conserves chauffés, cosmétiques et produits ménagers propres',
    'conseil_du_moment' => '',
    'proprietes' => 'Soutien de la synthèse hormonale (précurseurs et cofacteurs), régulation du rythme circadien des hormones, réduction de l\'impact du stress chronique sur l\'axe HHS',
    'sources_alimentaires' => 'Iode : algues, produits de la mer, sel iodé
Tyrosine : œufs, poissons, tofu, protéines animales et végétales
Fer : viande rouge, abats, légumineuses, légumes à feuilles vertes
Zinc : huîtres, foie, viandes rouges, légumineuses
Sélénium : noix du Brésil, produits de la mer
Oméga-3 : petits poissons gras, graines de lin/chia/colza
Aliments goitrigènes (à limiter en cas d\'hypothyroïdie) : crucifères crus, radis, navets, graines de moutarde et de colza',
    'synergies' => 'Alimentation anti-stress, chronobiologie alimentaire, gestion des perturbateurs endocriniens, alimentation anti-inflammatoire',
    'notes' => 'Analyses biologiques utiles selon le contexte : cortisol (CAR), T3L/T4L/TSH, ferritine, zinc, sélénium, vitamine D. Toute supplémentation ciblée doit idéalement s\'appuyer sur des résultats d\'analyses et un accompagnement professionnel.',
  ),
  10 => 
  array (
    'categorie' => 'Stratégies pratiques',
    'nom' => 'Alimentation et gestion du stress (anti-stress)',
    'partie_utilisee' => '',
    'description' => 'Approche nutritionnelle visant à soutenir le système nerveux et surrénalien en période de stress : éviction des excitants et sucres rapides, reminéralisation, comblement des carences fréquemment associées au stress chronique (magnésium, vitamines B, oméga-3, tryptophane, fer, vitamine C).',
    'indication' => 'Stress chronique ou ponctuel, anxiété, irritabilité
Fatigue nerveuse, épuisement des surrénales
Carence en magnésium liée au stress (contractions musculaires, cortisol)
Troubles digestifs et dysbiose associés au stress',
    'contre_indications' => 'Levure de bière déconseillée en cas de candidose ou mycose (nourrit les levures pathogènes)',
    'posologie' => 'Éviter les excitants (café, thé noir, alcool, tabac, sodas) et les sucres rapides responsables de pics d\'adrénaline/cortisol/insuline et d\'hypoglycémie réactionnelle
Favoriser l\'équilibre acido-basique : jus de légumes, crudités, aliments complets et semi-complets, spiruline, algues, graines germées
Combler les besoins accrus en magnésium (contribue à réduire la fatigue et soutenir le système nerveux), vitamines du groupe B (en synergie/complexe), tryptophane, vitamine C, fer, oméga-3
Soigner le microbiote (le stress impacte la digestion et la dysbiose aggrave l\'anxiété)
Assainir la flore en cas de parasitose suspectée (vermifugation ponctuelle)',
    'conseil_du_moment' => 'Associer systématiquement magnésium et vitamines B (synergie renforcée)',
    'proprietes' => 'Magnésium : réduit la fatigue, soutient le métabolisme énergétique et le système nerveux et musculaire
Vitamines B : transmission des signaux nerveux, production de neurotransmetteurs (noradrénaline, mélatonine)
Tryptophane : précurseur de la sérotonine, favorise le calme
Oméga-3 : prévention du stress et de la dépression
Vitamine C : antioxydant, soutien immunitaire',
    'sources_alimentaires' => 'Magnésium : oléagineux, légumes verts, cacao
Tryptophane : légumineuses, soja/tofu/tempeh, crucifères, œufs, chocolat noir, bananes, oléagineux
Vitamine C : kiwi, cassis, citron, papaye, persil, poivron cru
Fer : lentilles, viande rouge, abats, feuilles vertes, ortie, spiruline
Oméga-3 : poissons gras, graines de lin/chia moulues, huiles de colza/noix/cameline',
    'synergies' => 'Chronobiologie alimentaire, arrêt du sucre, alimentation et équilibre nerveux, alimentation et équilibres endocriniens, phyto/aromathérapie adaptogène (rhodiole, éleuthérocoque, ashwagandha, aubépine, mélisse, lavande)',
    'notes' => 'Approche complémentaire à la phytothérapie et à la gemmothérapie (cassis, tilleul) et à l\'aromathérapie (ylang-ylang, lavande) pour la gestion du stress. Nécessite une adaptation individuelle et un suivi si supplémentation.',
  ),
  11 => 
  array (
    'categorie' => 'Stratégies pratiques',
    'nom' => 'Protéines animales et végétales : qualité et complémentation',
    'partie_utilisee' => '',
    'description' => 'Panorama comparatif des sources de protéines animales et végétales : besoins quotidiens, qualité (score PDCAAS, digestibilité), avantages et risques de chaque famille d\'aliments, et principes de complémentation des protéines végétales pour compenser leurs acides aminés limitants.',
    'indication' => 'Optimisation de l\'apport protéique selon le profil (omnivore, végétarien, végan, sportif, senior)
Prévention de la sarcopénie, des carences en acides aminés essentiels
Accompagnement d\'une transition vers plus de protéines végétales',
    'contre_indications' => 'Excès de protéines animales (>95g/j) : acidification, perte osseuse calcique, surcharge rénale, dysbiose pro-inflammatoire
Blanc d\'œuf cru : avidine inactive la biotine (B8) → toujours cuire le blanc
Soja jaune : jamais consommé cru
Poissons à mercure élevé (thon, espadon, requin...) à éviter ou limiter',
    'posologie' => 'Besoins protéiques : 0,8g/kg/j pour un omnivore adulte ; 1g/kg/j pour un végétarien/végan (digestibilité végétale moindre, 70-93% vs 80-100% pour l\'animal)
Répartir les apports sur tous les repas (environ 30g/repas favorise +25% de synthèse musculaire) plutôt que de les concentrer au dîner
Loi de complémentation des protéines végétales : associer 3-4 parts de céréales pour 1 part de légumineuse (céréales pauvres en lysine, légumineuses pauvres en méthionine/cystéine) ; l\'association peut se faire sur 24h, pas nécessairement au même repas
Neutraliser l\'acide phytique des céréales/légumineuses/oléagineux complets par trempage (1 nuit, jeter l\'eau), germination, toastage ou fermentation (pain au levain)
Limiter la fréquence des viandes rouges (0-1x/semaine) et charcuteries (0-3x/semaine max), privilégier poissons (2-3x/semaine, hors espèces à mercure élevé) et œufs (jusqu\'à 5/semaine)',
    'conseil_du_moment' => '',
    'proprietes' => 'Score PDCAAS (qualité protéique) : œuf et lait/caséine = 1,00 (référence), bœuf 0,92, soja isolé 0,92, pois 0,61-0,68, lentilles 0,52, blé complet 0,57
Les protéines animales ont une digestibilité supérieure (80-100%) aux protéines végétales (70-93%, sauf soja)',
    'sources_alimentaires' => 'Animales : viandes (rouges à limiter, blanches modérées), poissons et fruits de mer (2-3x/sem, privilégier petits poissons bleus), œufs (référence OMS, PDCAAS 1,00), produits laitiers (max 1-2/j, privilégier chèvre/brebis)
Végétales : céréales (avoine, épeautre, quinoa, sarrasin), légumineuses (lentilles, pois chiches, haricots, tofu), oléagineux et graines, soja jaune (tofu, tempeh, miso, tonyu — seul végétal qui coagule comme le lait animal, 38-45% de protéines, 8 AAE complets), algues, seitan (80% protéines)',
    'synergies' => 'Alimentation anti-inflammatoire (limiter viande rouge/charcuterie), alimentation microbiote (protéines végétales favorisent des bactéries bénéfiques), régimes low carb/kéto (choix des sources protéiques)',
    'notes' => 'Une alimentation omnivore riche en protéines animales est associée à un microbiote plus dysbiotique et pro-inflammatoire qu\'une alimentation végétale équilibrée (étude comparative citée : 67 000 microbes/mm³ vs 2260/mm³ après 5 jours de régime végétarien). Densité protéique la plus élevée : viandes/poissons (11,9g/100kcal) puis œufs (8,1g/100kcal) puis légumes-feuilles (8,4g/100kcal, mais faible densité calorique).',
  ),
);
}

function getRessourcesMicronutrition(): array {
    return array (
  0 => 
  array (
    'categorie' => 'Vitamines liposolubles',
    'nom' => 'Vitamine A (Rétinol)',
    'partie_utilisee' => '',
    'description' => 'Rôle principal : vision, différenciation cellulaire, immunité. Type : vitamine liposoluble (rétinoïde).',
    'indication' => 'Vision crépusculaire
Différenciation cellulaire
Maintien des muqueuses
Fonctionnement immunitaire',
    'contre_indications' => 'À proscrire en supplémentation chez la femme enceinte et la femme ménopausée
Contre-indiquée avec les traitements rétinoïdes
Le bêta-carotène est contre-indiqué chez les fumeurs',
    'posologie' => 'RNP : 750 µg/j équivalent rétinol',
    'conseil_du_moment' => '',
    'proprietes' => 'Vision crépusculaire, différenciation cellulaire, maintien des muqueuses, fonctionnement immunitaire.',
    'sources_alimentaires' => 'Forme animale : esters de rétinol (forme active). Forme végétale : provitamine A (bêta-carotène).',
    'synergies' => '',
    'notes' => 'Principale cause de cécité dans le monde en cas de carence ; dégrade aussi la fonction immunitaire et la différenciation cellulaire.',
  ),
  1 => 
  array (
    'categorie' => 'Vitamines liposolubles',
    'nom' => 'Vitamine D3 (Cholécalciférol)',
    'partie_utilisee' => '',
    'description' => 'Rôle principal : construction osseuse, absorption du calcium, immunité, régulation de l\'inflammation. Type : vitamine liposoluble, synthétisée par la peau sous l\'effet des UV.',
    'indication' => 'Construction osseuse
Absorption du calcium
Fonctionnement immunitaire
Régulation de l\'inflammation
Différenciation cellulaire (cutanée)
Prévention cardiovasculaire
Modulation des lymphocytes Treg',
    'contre_indications' => 'Attention aux interactions médicamenteuses qui diminuent son taux
Besoins augmentés chez les personnes obèses',
    'posologie' => 'Faibles apports alimentaires, supplémentation le plus souvent nécessaire. Vérifier le taux sanguin de 25 OH D3, reflet des réserves de vitamine D.',
    'conseil_du_moment' => '',
    'proprietes' => 'Métabolisme : synthèse cutanée de vitamine D3 (cholécalciférol) sous l\'action des UV à partir du 7-déhydrocholestérol, hydroxylation hépatique en 25-hydroxycholécalciférol (calcifédiol, forme de réserve, reflet des stocks, activée par la PTH), puis hydroxylation rénale en 1,25-dihydroxycholécalciférol (calcitriol, forme active). Rôle essentiel sur les lymphocytes Treg (immunotolérance).',
    'sources_alimentaires' => 'Faibles apports alimentaires ; l\'exposition solaire est la principale source.',
    'synergies' => 'Interaction avec le magnésium : la vitamine D augmente l\'absorption intestinale du magnésium, et le magnésium est nécessaire au transport et au métabolisme de la vitamine D. Un manque de magnésium peut compromettre l\'efficacité d\'une supplémentation en vitamine D. Association intéressante avec le magnésium en supplémentation.',
    'notes' => 'Maladie de carence historique : rachitisme. Carence fréquente en pratique ; à ajuster notamment dans un contexte inflammatoire, la vitamine D ayant un rôle essentiel sur les lymphocytes Treg.',
  ),
  2 => 
  array (
    'categorie' => 'Vitamines liposolubles',
    'nom' => 'Vitamine E (Tocophérols, tocotriénols)',
    'partie_utilisee' => '',
    'description' => 'Rôle principal : antioxydant lipidique. Type : vitamine liposoluble.',
    'indication' => 'Protection antioxydante des membranes cellulaires (lipides)',
    'contre_indications' => '',
    'posologie' => 'RNP : 12 mg/j',
    'conseil_du_moment' => '',
    'proprietes' => 'Antioxydant lipidique.',
    'sources_alimentaires' => 'Aliments gras : huiles, graines, oléagineux…',
    'synergies' => 'En supplémentation, privilégier une forme naturelle (mélange de tocophérols et de tocotriénols).',
    'notes' => '',
  ),
  3 => 
  array (
    'categorie' => 'Vitamines liposolubles',
    'nom' => 'Vitamine K1 (Phylloquinone)',
    'partie_utilisee' => '',
    'description' => 'Rôle principal : coagulation sanguine. Type : vitamine liposoluble d\'origine végétale.',
    'indication' => 'Coagulation sanguine (synthèse des protéines de la coagulation)',
    'contre_indications' => 'À proscrire chez les patients sous AVK (anticoagulants antivitamine K)',
    'posologie' => 'RNP : 45 µg/j',
    'conseil_du_moment' => '',
    'proprietes' => 'Coagulation sanguine (synthèse des protéines de la coagulation).',
    'sources_alimentaires' => 'Aliments végétaux : choux, blettes, épinards…',
    'synergies' => '',
    'notes' => '',
  ),
  4 => 
  array (
    'categorie' => 'Vitamines liposolubles',
    'nom' => 'Vitamine K2 (Ménaquinone)',
    'partie_utilisee' => '',
    'description' => 'Rôle principal : coagulation sanguine et fixation du calcium osseux. Type : vitamine liposoluble d\'origine animale/fermentée.',
    'indication' => 'Coagulation sanguine
Fixation du calcium et construction osseuse',
    'contre_indications' => 'À proscrire chez les patients sous AVK',
    'posologie' => '',
    'conseil_du_moment' => '',
    'proprietes' => 'Coagulation sanguine, fixation du calcium (construction osseuse).',
    'sources_alimentaires' => 'Aliments animaux : foies, produits fermentés.',
    'synergies' => 'En supplémentation, privilégier la forme MK7.',
    'notes' => '',
  ),
  5 => 
  array (
    'categorie' => 'Vitamines hydrosolubles',
    'nom' => 'Vitamine B1 (Thiamine)',
    'partie_utilisee' => '',
    'description' => 'Rôle principal : métabolisme énergétique et fonctionnement cérébral. Type : vitamine hydrosoluble.',
    'indication' => 'Métabolisme énergétique (glucides)
Fonctionnement cérébral',
    'contre_indications' => '',
    'posologie' => 'RNP : 1,5 mg/j homme, 1,2 mg/j femme',
    'conseil_du_moment' => '',
    'proprietes' => 'Métabolisme énergétique (métabolisme des glucides), coenzyme de la pyruvate décarboxylase. Fonctionnement cérébral.',
    'sources_alimentaires' => 'Tout type d\'aliments : céréales, oléagineux, viandes…',
    'synergies' => '',
    'notes' => 'Carences rares (malnutrition, alcoolisme). Maladie de carence historique : béribéri.',
  ),
  6 => 
  array (
    'categorie' => 'Vitamines hydrosolubles',
    'nom' => 'Vitamine B2 (Riboflavine)',
    'partie_utilisee' => '',
    'description' => 'Rôle principal : métabolisme énergétique et réactions d\'oxydoréduction. Type : vitamine hydrosoluble.',
    'indication' => 'Métabolisme énergétique
Réactions d\'oxydoréduction
Production de kératine',
    'contre_indications' => '',
    'posologie' => 'RNP : 1,8 mg/j homme, 1,5 mg/j femme',
    'conseil_du_moment' => '',
    'proprietes' => 'Précurseur du FAD (métabolisme énergétique) et du FMN (réactions rédox, notamment CYP450). Production de kératine.',
    'sources_alimentaires' => 'Tout type d\'aliments.',
    'synergies' => '',
    'notes' => 'Carences rares (malnutrition, alcoolisme).',
  ),
  7 => 
  array (
    'categorie' => 'Vitamines hydrosolubles',
    'nom' => 'Vitamine B3 (Niacine, vitamine PP)',
    'partie_utilisee' => '',
    'description' => 'Rôle principal : métabolisme énergétique et réactions d\'oxydoréduction. Type : vitamine hydrosoluble.',
    'indication' => 'Métabolisme énergétique
Réactions d\'oxydoréduction',
    'contre_indications' => 'À forte dose, risque de toxicité hépatique.',
    'posologie' => 'RNP : 17,4 mg/j homme, 14 mg/j femme. À forte dose : diminution de la cholestérolémie et des triglycérides mais attention à la toxicité hépatique.',
    'conseil_du_moment' => '',
    'proprietes' => 'Précurseur du NAD+ (métabolisme énergétique), coenzyme de réactions rédox.',
    'sources_alimentaires' => 'Fromages, œufs, laitages…',
    'synergies' => '',
    'notes' => 'Carences rares (malnutrition, alcoolisme). Maladie de carence historique : pellagre.',
  ),
  8 => 
  array (
    'categorie' => 'Vitamines hydrosolubles',
    'nom' => 'Vitamine B5 (Acide pantothénique)',
    'partie_utilisee' => '',
    'description' => 'Rôle principal : métabolisme énergétique. Type : vitamine hydrosoluble.',
    'indication' => 'Métabolisme énergétique
Biosynthèse des lipides et des corps cétoniques',
    'contre_indications' => '',
    'posologie' => 'RNP : 5,8 mg/j homme, 4,7 mg/j femme',
    'conseil_du_moment' => '',
    'proprietes' => 'Précurseur du coenzyme A (métabolisme énergétique, biosynthèse des lipides, des corps cétoniques).',
    'sources_alimentaires' => 'Tout type d\'aliments.',
    'synergies' => '',
    'notes' => '',
  ),
  9 => 
  array (
    'categorie' => 'Vitamines hydrosolubles',
    'nom' => 'Vitamine B6 (Pyridoxine)',
    'partie_utilisee' => '',
    'description' => 'Rôle principal : coenzyme des transaminases, régulation de l\'anxiété et métabolisme de l\'homocystéine. Type : vitamine hydrosoluble.',
    'indication' => 'Régulation de l\'anxiété
Métabolisme de l\'homocystéine
Synthèse de la taurine et du glutathion',
    'contre_indications' => 'Présente dans beaucoup de compléments alimentaires : attention à l\'accumulation, une forte dose pouvant entraîner une neuropathie.',
    'posologie' => 'RNP : 1,8 mg/j homme, 1,5 mg/j femme',
    'conseil_du_moment' => '',
    'proprietes' => 'Coenzyme des transaminases. Régulation de l\'anxiété via la transformation du glutamate en GABA. Métabolisme de l\'homocystéine, synthèse de la taurine et du glutathion.',
    'sources_alimentaires' => 'Tout type d\'aliments.',
    'synergies' => 'Coenzyme nécessaire à la synthèse du glutathion à partir de l\'homocystéine.',
    'notes' => 'Carences rares (malnutrition, alcoolisme).',
  ),
  10 => 
  array (
    'categorie' => 'Vitamines hydrosolubles',
    'nom' => 'Vitamine B8 (Biotine)',
    'partie_utilisee' => '',
    'description' => 'Rôle principal : coenzyme de carboxylation, synthèse des acides gras et néoglucogenèse. Type : vitamine hydrosoluble.',
    'indication' => 'Synthèse des acides gras
Néoglucogenèse',
    'contre_indications' => '',
    'posologie' => 'RNP : 1,5 mg/j homme, 1,2 mg/j femme',
    'conseil_du_moment' => '',
    'proprietes' => 'Coenzyme de réactions de carboxylation ATP-dépendantes : synthèse des acides gras, néoglucogenèse.',
    'sources_alimentaires' => 'Tout type d\'aliments : céréales, oléagineux, viandes…',
    'synergies' => '',
    'notes' => '',
  ),
  11 => 
  array (
    'categorie' => 'Vitamines hydrosolubles',
    'nom' => 'Vitamine B9 (Folates)',
    'partie_utilisee' => '',
    'description' => 'Rôle principal : réplication de l\'ADN, méthylation et métabolisme de l\'homocystéine, en tandem avec la vitamine B12. Type : vitamine hydrosoluble.',
    'indication' => 'Réplication de l\'ADN
Réactions de méthylation
Métabolisme de l\'homocystéine
Prévention des anomalies de fermeture du tube neural en péri-conception',
    'contre_indications' => 'Ne pas supplémenter en cas de carence en B12 associée (risque de masquer une carence en B12).
Nombreuses interactions médicamenteuses : méthotrexate (prendre les folates 48h après pour limiter la toxicité), antiépileptiques (diminution d\'efficacité mutuelle), sulfasalazine (diminution de l\'absorption et du métabolisme des folates, l\'acide folinique n\'étant pas affecté), 5-Fluoro-Uracile/Capécitabine (potentialisation des effets et de la toxicité), triméthoprime (inhibiteur de la DHFR).',
    'posologie' => 'RNP : 330 µg/j (homme et femme), 400 µg/j chez la femme enceinte. Biodisponibilité : 50 à 60 % pour les folates alimentaires (augmentée par la vitamine C et le lait), 85 % pour l\'acide folique de synthèse. Unité d\'équivalence DFE : 1 µg DFE = 1 µg folates alimentaires = 0,6 µg folates (aliments enrichis) = 0,5 µg acide folique de synthèse (à jeun). En supplémentation, privilégier la forme méthylée (type Quatrefolic®).',
    'conseil_du_moment' => '',
    'proprietes' => '« Folates » = ensemble de molécules comprenant l\'acide folique et ses dérivés (dihydrofolate, tétrahydrofolate, 5-Méthyl THF, 5,10-Méthylène THF, 10-formyl THF, 5-formyl THF = acide folinique). Synthèse des bases azotées de l\'ADN (réplication), réactions de méthylation, métabolisme de l\'homocystéine via le cycle des folates couplé au cycle de l\'homocystéine (dépendant de la vitamine B12). Digestion : déconjugaison en monoglutamates (glutamate carboxypeptidase II entérocytaire, cofacteur zinc), absorption active au duodénum/jéjunum proximal (Reduced Folate Carrier), activation intra-entérocytaire en Méthyl-THF. Stockage hépatique (4 mois de réserves) et érythrocytaire (bon reflet des réserves tissulaires).',
    'sources_alimentaires' => 'Légumes à feuilles vertes : épinards, courgettes, blettes, choux… ; foies.',
    'synergies' => 'Fonctionne en tandem avec la vitamine B12 (voies métaboliques communes, cycle des folates/homocystéine) : un déficit de l\'une peut impacter le fonctionnement de l\'autre, avec des conséquences cliniques et biologiques similaires.',
    'notes' => 'Carence chez la femme enceinte : risque d\'anomalies de fermeture du tube neural (spina bifida, encéphalocèle, anencéphalie). Carences aussi en cas de malnutrition et de nombreuses interactions médicamenteuses.',
  ),
  12 => 
  array (
    'categorie' => 'Vitamines hydrosolubles',
    'nom' => 'Vitamine B12 (Cobalamine)',
    'partie_utilisee' => '',
    'description' => 'Rôle principal : métabolisme des folates, méthylation, synthèse de la myéline, en tandem avec la vitamine B9. Type : vitamine hydrosoluble d\'origine exclusivement animale.',
    'indication' => 'Métabolisme des folates
Réactions de méthylation
Synthèse de la myéline
Métabolisme de l\'homocystéine',
    'contre_indications' => 'Carences à rechercher en cas de régime d\'éviction (végan/végétalien), d\'hypochlorhydrie, de gastrite, de chirurgie bariatrique. Interactions médicamenteuses : IPP (diminution de l\'acidité gastrique donc de la dissociation de la B12 de ses protéines), metformine (inhibition réversible de l\'absorption calcium-dépendante, réversible par apport calcique), colchicine (diminution de l\'absorption).',
    'posologie' => 'RNP : 4 µg/j. Absorption par diffusion passive sur tout le tube digestif (biodisponibilité 1 à 5 %) ou via le facteur intrinsèque (biodisponibilité 20 %), qui diminue drastiquement au-delà des 2-3 premiers µg. Pour combler une carence : recours à de (très) fortes doses. Forme méthylée non nécessaire. Stockage hépatique de quelques mg pour des besoins de 4 µg/j (3 à 6 ans de réserves via le cycle entéro-hépatique).',
    'conseil_du_moment' => '',
    'proprietes' => 'Cobalamine à noyau corrine (tétrapyrrole) et atome de cobalt hexavalent, avec radical variable (méthylcobalamine, 5\'-désoxyadénosylcobalamine, cyanocobalamine, hydroxycobalamine). Métabolisme des folates, réactions de méthylation (transfert du groupement méthyle depuis les folates via la cobalamine intermédiaire : méthyl-THF + cobalamine → méthylcobalamine → méthionine → SAM, donneur universel de méthyle), synthèse de la myéline, métabolisme de l\'homocystéine. Pierre angulaire du cycle des folates et de la méthylation : une carence en B12 entraîne une carence fonctionnelle en folates, une accumulation d\'homocystéine et une hypométhylation.',
    'sources_alimentaires' => 'Exclusivement animale.',
    'synergies' => 'Fonctionne en tandem avec la vitamine B9 (folates), voies métaboliques communes (cycle des folates/homocystéine).',
    'notes' => 'Carence : anémie de Biermer (anémie pernicieuse). Ne pas confondre les causes de carence en B12 (maladie de Biermer, malabsorption fonctionnelle, chirurgie bariatrique, pathologie du grêle distal) avec celles en folates (carence d\'apport/malnutrition, cuisson, besoins accrus, pathologie du grêle proximal).',
  ),
  13 => 
  array (
    'categorie' => 'Vitamines hydrosolubles',
    'nom' => 'Vitamine C (Acide ascorbique)',
    'partie_utilisee' => '',
    'description' => 'Rôle principal : antioxydant, synthèse du collagène et immunité. Type : vitamine hydrosoluble.',
    'indication' => 'Antioxydant
Synthèse du collagène
Immunité
Amélioration de l\'absorption du fer végétal',
    'contre_indications' => 'Éviter une supplémentation isolée à long terme. Les IPP diminuent son absorption.',
    'posologie' => 'RNP : 110 mg/j',
    'conseil_du_moment' => '',
    'proprietes' => 'Antioxydant. Coenzyme de la synthèse du collagène. Immunité. Favorise l\'absorption du fer végétal (réduction Fe3+ en Fe2+).',
    'sources_alimentaires' => 'Fruits et légumes.',
    'synergies' => 'En supplémentation, éviter l\'association avec le fer.',
    'notes' => 'Maladie de carence historique : scorbut.',
  ),
  14 => 
  array (
    'categorie' => 'Minéraux',
    'nom' => 'Calcium',
    'partie_utilisee' => '',
    'description' => 'Rôle principal : minéralisation osseuse, coagulation et influx nerveux. Type : minéral.',
    'indication' => 'Minéralisation osseuse
Coagulation sanguine
Influx nerveux',
    'contre_indications' => '',
    'posologie' => 'RNP : 1000 mg/j',
    'conseil_du_moment' => '',
    'proprietes' => 'Minéralisation de l\'os, coagulation sanguine, agrégation plaquettaire, influx nerveux, messager intracellulaire.',
    'sources_alimentaires' => 'Produits laitiers (bonne biodisponibilité).',
    'synergies' => '',
    'notes' => '',
  ),
  15 => 
  array (
    'categorie' => 'Minéraux',
    'nom' => 'Magnésium',
    'partie_utilisee' => '',
    'description' => 'Rôle principal : cofacteur de très nombreuses réactions ATP-dépendantes, santé osseuse, cardiovasculaire et nerveuse, antagoniste physiologique du calcium. Type : minéral.',
    'indication' => 'Santé osseuse
Santé cardiovasculaire (tension artérielle, agrégation plaquettaire)
Fonctionnement thyroïdien
Système nerveux, gestion du stress, de l\'anxiété et du sommeil
Immunité
Action anti-inflammatoire',
    'contre_indications' => 'Dose rectificatrice de carence contre-indiquée chez les insuffisants rénaux. Formes à éviter : oxyde de magnésium (magnésium marin, faible biodisponibilité, effet laxatif), chlorure de magnésium (effet laxatif).',
    'posologie' => 'Dose rectificatrice de carence : 6 mg/kg/j (à fractionner, l\'absorption étant partiellement saturable). Formes biodisponibles à privilégier : bisglycinate de magnésium, citrate de magnésium, glycérophosphate de magnésium. Toujours accompagné d\'un vecteur en supplémentation.',
    'conseil_du_moment' => '',
    'proprietes' => 'Crucial pour l\'ADN (réplication, transcription en ARN, réparation, stabilité) et pour tous les processus ATP-dépendants (synthèse d\'ATP, transports actifs, pompe Na/K ATPase, réactions d\'anabolisme via le complexe Mg-ATP2-). Entre dans la composition de l\'os et induit la croissance des ostéoblastes. Antagoniste physiologique du calcium : régule le calcium intracellulaire et les processus calcium-dépendants. Santé cardiovasculaire : effet anticalcique, diminution du tonus vasculaire, régulation de l\'agrégation plaquettaire. Système endocrinien : nécessaire au métabolisme de la vitamine D ; une hypomagnésémie peut diminuer la synthèse des hormones thyroïdiennes (inhibition de l\'adénylate cyclase, diminution de la captation d\'iode). Système nerveux : module le récepteur NMDA au glutamate, diminue le stress via la baisse de libération d\'ACTH, agit sur l\'endormissement et l\'anxiété (action agoniste sur les récepteurs GABA). Immunité : participe à la synthèse des anticorps, module la réponse allergique (activité calcique des mastocytes). Propriétés anti-inflammatoires reconnues.',
    'sources_alimentaires' => '',
    'synergies' => 'Association intéressante avec la vitamine D (le magnésium est nécessaire au transport et au métabolisme de la vitamine D, qui augmente en retour l\'absorption intestinale du magnésium ; un manque de magnésium peut compromettre l\'efficacité d\'une supplémentation en vitamine D).',
    'notes' => 'Signes de carence : fatigue, irritabilité, anxiété/nervosité, faiblesse musculaire, spasmes gastro-intestinaux, constipation, crampes, maux de tête, troubles du sommeil, nausées/vomissements, spasmophilie, convulsions. Causes de carence : défaut d\'apport (alimentation déséquilibrée ou industrielle, anorexie, malnutrition, alcool), troubles gastro-intestinaux (Crohn, cœliaque, résection du grêle, chirurgie bariatrique, diarrhées chroniques, cirrhose alcoolique, diabète, hyperthyroïdie), traitements médicamenteux (diurétiques de l\'anse, IPP, certains anticancéreux comme le cisplatine, certains anticonvulsivants), stress chronique (augmentation des pertes urinaires). Cercle vicieux stress/magnésium : le stress libère adrénaline/cortisol, qui font sortir le magnésium des cellules puis l\'éliminent dans les urines, la déplétion en magnésium augmentant à son tour la susceptibilité au stress. Populations à risque : personnes âgées (polymédication notamment diurétiques, masse osseuse réduite, fonction rénale perturbée, capacités d\'absorption réduites, diminution de l\'appétit) et sportifs (activité métabolique augmentée, pertes urinaires et sudorales accrues).',
  ),
  16 => 
  array (
    'categorie' => 'Oligo-éléments',
    'nom' => 'Fer',
    'partie_utilisee' => '',
    'description' => 'Rôle principal : fabrication de l\'hémoglobine et transport de l\'oxygène. Type : oligo-élément.',
    'indication' => 'Fabrication de l\'hémoglobine et transport de l\'oxygène
Prévention de l\'anémie ferriprive',
    'contre_indications' => 'Supplémentation à mener de façon intelligente et surveillée (éviter la surcharge, évaluer la remontée). Le fer héminique de la viande rouge peut promouvoir des réactions d\'oxydation délétères (lien évoqué avec le cancer colorectal), en partie contrebalancées par les antioxydants alimentaires, les végétaux et les produits laitiers. Attention à la surcharge en fer (ex. hémochromatose HFE, maladie génétique par mutation C282Y du gène HFE : hyperabsorption digestive et libération excessive du fer macrophagique par déficit de production d\'hepcidine, avec atteinte hépatique, pancréatique, gonadique et myocardique). Le diagnostic de surcharge repose sur le coefficient de saturation de la transferrine (un CST normal avec ferritine élevée exclut le diagnostic d\'hémochromatose).',
    'posologie' => 'Carence en fer = la plus répandue dans le monde (source OMS).',
    'conseil_du_moment' => '',
    'proprietes' => 'Fonctionne en circuit fermé : recyclage par les macrophages (rate, foie, moelle rouge) après phagocytose des globules rouges en fin de vie (120 jours de circulation), transport par la transferrine (Fe3+), érythropoïèse. On distingue le fer héminique (animal) du fer non héminique (végétal).',
    'sources_alimentaires' => 'Fer héminique (bonne biodisponibilité 25-30 %, indépendante des autres aliments) : viandes noires/gibier, boudin noir, viandes rouges. Fer non héminique (faible biodisponibilité 5-10 % et variable) : cacao, légumineuses, céréales, olives noires ; biodisponibilité augmentée par la vitamine C (réduction Fe3+ en Fe2+), les protéines animales et l\'acidité, diminuée par les tanins, phosphates, oxalates, phytates et les cations métalliques (compétition sur le transporteur DMT1).',
    'synergies' => 'La vitamine C améliore l\'absorption du fer non héminique (végétal).',
    'notes' => 'Signes de carence : fatigue, difficulté de concentration, perte de cheveux, essoufflement, pâleur des muqueuses (anémie ferriprive microcytaire hypochrome arégénérative). Anémie et carence en fer sont souvent confondues à tort : l\'anémie se définit uniquement par le taux d\'hémoglobine (Hb < 13 g/dL chez l\'homme, < 12 g/dL chez la femme) et n\'implique pas forcément une carence en fer. Mécanismes de carence : carence d\'apport (besoins augmentés en grossesse/allaitement/enfance, régime végan/végétalien, dénutrition), malabsorption (hypochlorhydrie, gastrectomie, MICI, maladie cœliaque, SIBO/dysbiose), saignements/prélèvements (menstruations, dons de sang, hémorragies occultes notamment digestives — à rechercher chez l\'homme et la femme ménopausée, en particulier sous AINS, chlorure de potassium, biphosphonates, ou en cas d\'antécédent d\'ulcère ou de polypes intestinaux).',
  ),
  17 => 
  array (
    'categorie' => 'Oligo-éléments',
    'nom' => 'Zinc',
    'partie_utilisee' => '',
    'description' => 'Rôle principal : immunité, division cellulaire et protection antioxydante. Type : oligo-élément.',
    'indication' => 'Immunité
Division cellulaire
Protection antioxydante (cofacteur de la SOD)
Métabolisme thyroïdien',
    'contre_indications' => 'Interactions médicamenteuses : diurétiques, IPP, certains antihypertenseurs (inhibiteurs de l\'enzyme de conversion).',
    'posologie' => 'RNP : 14 mg/j homme, 11 mg/j femme',
    'conseil_du_moment' => '',
    'proprietes' => 'Cofacteur de la réplication de l\'ADN (division cellulaire), cofacteur de la SOD (superoxyde dismutase, avec le cuivre), synthèse protéique, immunité, métabolisme des hormones thyroïdiennes, métabolisme de la vitamine A.',
    'sources_alimentaires' => 'Aliments animaux.',
    'synergies' => 'Antagonisme d\'absorption avec le cuivre.',
    'notes' => '',
  ),
  18 => 
  array (
    'categorie' => 'Oligo-éléments',
    'nom' => 'Sélénium',
    'partie_utilisee' => '',
    'description' => 'Rôle principal : fonctionnement thyroïdien et protection antioxydante. Type : oligo-élément.',
    'indication' => 'Fonctionnement thyroïdien
Protection antioxydante
Chélation des métaux lourds',
    'contre_indications' => '',
    'posologie' => 'Apport satisfaisant : 70 µg/j. Toujours rester à dose nutritionnelle en supplémentation.',
    'conseil_du_moment' => '',
    'proprietes' => 'Métabolisme des hormones thyroïdiennes (cofacteur de la 5\'-désiodase), cofacteur de la glutathion peroxydase (GPX, protection contre le stress oxydant), chélateur des métaux lourds.',
    'sources_alimentaires' => 'Aliment majeur : noix du Brésil.',
    'synergies' => '',
    'notes' => '',
  ),
  19 => 
  array (
    'categorie' => 'Oligo-éléments',
    'nom' => 'Cuivre',
    'partie_utilisee' => '',
    'description' => 'Rôle principal : protection antioxydante (cofacteur de la SOD) et métabolisme énergétique. Type : oligo-élément.',
    'indication' => 'Protection antioxydante (cofacteur de la SOD)
Métabolisme énergétique
Métabolisme du fer',
    'contre_indications' => '',
    'posologie' => 'RNP : 1,3 mg/j homme, 1 mg/j femme',
    'conseil_du_moment' => '',
    'proprietes' => 'Cofacteur de la SOD avec le zinc, métabolisme énergétique (cofacteur du complexe IV mitochondrial), participe au métabolisme du fer (cofacteur de la ferroxydase).',
    'sources_alimentaires' => 'Abats, crustacés et mollusques.',
    'synergies' => 'Antagonisme d\'absorption avec le zinc.',
    'notes' => '',
  ),
  20 => 
  array (
    'categorie' => 'Acides gras',
    'nom' => 'Oméga 3 (ALA, EPA, DHA)',
    'partie_utilisee' => '',
    'description' => 'Rôle principal : fluidité membranaire et régulation/résolution de l\'inflammation. Type : acides gras polyinsaturés essentiels (substance à but nutritionnel ou physiologique).',
    'indication' => 'Fluidité des membranes cellulaires
Équilibre et régulation de l\'inflammation
Résolution de l\'inflammation
Protection cardiovasculaire et neurologique',
    'contre_indications' => '',
    'posologie' => 'Utilisés en supplémentation (EPA + DHA, huile de poisson) pour corriger la balance oméga 6/oméga 3 et le terrain pro-inflammatoire. Équilibre recherché oméga 6/oméga 3 : environ 4/1.',
    'conseil_du_moment' => '',
    'proprietes' => 'Représentés par l\'acide alpha-linolénique (ALA, acide gras essentiel précurseur des acides gras allongés), l\'EPA, le DPA et le DHA. Entrent dans la composition des membranes cellulaires (fluidité membranaire) et sont précurseurs de médiateurs de l\'inflammation (eicosanoïdes) via les phospholipides membranaires : à la différence des oméga 6 (acide arachidonique → PGE2, pro-inflammatoires et pro-agrégants), l\'EPA/DHA donnent des PGE3 anti-inflammatoires et anti-agrégants. L\'EPA et le DHA fournissent aussi des médiateurs de résolution de l\'inflammation (SPMs : résolvines, marésines, protectines), synthétisés en phase de résolution une fois les dégâts réparés ; les protectines protègent en particulier la microglie (neurones). L\'huile de lin, de colza ou de cameline (sources d\'ALA) ne suffisent pas toujours car la conversion en EPA/DHA (delta-6-désaturase) peut être défaillante en cas de stress, d\'excès d\'acides gras saturés, d\'inflammation, de manque de zinc ou de magnésium, ou de carence en vitamine D.',
    'sources_alimentaires' => 'Huile de poisson (EPA/DHA) ; huile de lin, de colza, de cameline (ALA) ; escargots, pourpier.',
    'synergies' => 'La conversion de l\'ALA en EPA/DHA (delta-6-désaturase) dépend du zinc, du magnésium et de la vitamine D.',
    'notes' => 'Un manque d\'oméga 3 est l\'un des facteurs contribuant à l\'inflammation systémique de bas grade (ISBG).',
  ),
  21 => 
  array (
    'categorie' => 'Antioxydants',
    'nom' => 'Polyphénols et caroténoïdes',
    'partie_utilisee' => '',
    'description' => 'Rôle principal : action anti-inflammatoire, antioxydante indirecte et protection cardiovasculaire. Type : substances à but nutritionnel ou physiologique (grande famille de métabolites secondaires des plantes).',
    'indication' => 'Action anti-inflammatoire
Action antioxydante indirecte
Protection cardiovasculaire
Protection oculaire (lutéine)
Équilibre hormonal (isoflavones, lignanes)
Tonus veineux (flavonoïdes, anthocyanes)',
    'contre_indications' => '',
    'posologie' => '',
    'conseil_du_moment' => '',
    'proprietes' => 'Vaste famille de plus de 5000 composés, métabolites secondaires des plantes (défense contre les prédateurs, pollinisation, pigmentation, protection contre les UV). Propriétés antimicrobiennes, antiallergiques (inhibition des enzymes de libération de l\'histamine), anti-inflammatoires (inhibition de la production d\'ERO par les globules blancs activés, inhibition de la cyclooxygénase par la quercétine et la myricétine), anticancer (élimination d\'agents carcinogéniques, modulation du cycle cellulaire, induction de l\'apoptose, modulation de diverses enzymes). Ne sont pas à proprement parler des antioxydants directs mais agissent indirectement en inhibant des enzymes pro-oxydantes (NADPH-oxydase) et en modulant les voies de signalisation des enzymes antioxydantes ; modulent aussi l\'inflammation via les cascades de kinases, l\'expression de NFkB et l\'inflammasome. Sous-familles particulières utilisées en supplémentation : flavonoïdes/anthocyanes (fruits rouges, action vitaminique P, tonus veineux), isoflavones (soja, agonistes partiels œstrogéniques, troubles menstruels), lignanes (lin, phyto-œstrogènes inhibiteurs de l\'aromatase), quercétine (oignon, action anti-allergique), resvératrol (raisin, vin rouge, « anti-vieillissement ») ; caroténoïdes : lutéine (action sur la DMLA), bêta-carotène (préparation de la peau au soleil, précurseur de vitamine A), lycopène (prévention du cancer de la prostate).',
    'sources_alimentaires' => 'Fruits, légumes, vin rouge (diète méditerranéenne) ; fruits rouges (flavonoïdes/anthocyanes) ; soja (isoflavones) ; lin (lignanes) ; oignon (quercétine) ; raisin/vin rouge (resvératrol).',
    'synergies' => '',
    'notes' => 'Étude de référence : Zutphen Elderly Study (1993), lien entre flavonoïdes et réduction de la mortalité par maladies coronariennes (réduction du cholestérol par inhibition de l\'HMG-CoA réductase, baisse de l\'agrégation plaquettaire, inhibition de l\'oxydation des LDL, baisse de la réponse inflammatoire).',
  ),
  22 => 
  array (
    'categorie' => 'Antioxydants',
    'nom' => 'Glutathion',
    'partie_utilisee' => '',
    'description' => 'Rôle principal : antioxydant majeur et détoxication de phase 2. Type : tripeptide endogène (substance à but nutritionnel ou physiologique).',
    'indication' => 'Défense antioxydante majeure
Détoxication hépatique (phase 2)
Chélation des métaux lourds',
    'contre_indications' => '',
    'posologie' => 'Supplémentation indirecte via la N-acétylcystéine (NAC), précurseur et acide aminé limitant de la biosynthèse du glutathion.',
    'conseil_du_moment' => '',
    'proprietes' => 'Tripeptide (acide glutamique, cystéine, glycine), synthétisé à partir de l\'homocystéine (coenzyme nécessaire : vitamine B6). Antioxydant majeur de l\'organisme (notamment contre les peroxydes tels que H2O2), rôle dans la détoxication de phase 2, chélateur de métaux lourds.',
    'sources_alimentaires' => '',
    'synergies' => 'Nécessite la vitamine B6 comme coenzyme pour sa synthèse à partir de l\'homocystéine.',
    'notes' => 'Baisse du glutathion en cas de stress oxydant, de traitement chronique par paracétamol, avec l\'âge, l\'alcoolisme, la dénutrition ou l\'anorexie.',
  ),
  23 => 
  array (
    'categorie' => 'Autres',
    'nom' => 'Curcumine (Curcuma)',
    'partie_utilisee' => 'Rhizome',
    'description' => 'Rôle principal : modulation de l\'inflammation (kinases, NFkB, inflammasome). Type : polyphénol issu du curcuma (substance à but nutritionnel ou physiologique).',
    'indication' => 'Modulation de l\'inflammation (cascade de kinases, NFkB, inflammasome)
Action anti-inflammatoire',
    'contre_indications' => 'Contre-indiquée en complément alimentaire chez les personnes allergiques au curcuma et chez celles présentant une obstruction des voies biliaires. À utiliser avec précaution en cas de pathologie hépatique. Les formulations avec pipérine sont à utiliser avec beaucoup de précaution (augmentation de la biodisponibilité et effet sur la détoxication/glucuronidation) ; la pipérine peut interférer avec la pharmacocinétique de nombreux médicaments (diclofénac, ibuprofène, fexofénadine, carbamazépine, chlorzoxazone, ampicilline, norfloxacine, névirapine, docétaxel, glimépiride, natéglinide, metformine).',
    'posologie' => 'Biodisponibilité faible, à améliorer par la prise au cours d\'un repas lipidique (curcumine lipophile), l\'association au gingembre (usage traditionnel indien), ou historiquement à la pipérine (à utiliser avec prudence).',
    'conseil_du_moment' => '',
    'proprietes' => 'Polyphénol hydrophobe, principe actif du curcuma (Curcuma longa), qui ne représente que 1 à 4 % du rhizome (autres polyphénols présents : monodéméthoxy-curcumine, bidesméthoxy-curcumine, etc.). Module l\'activité des kinases (voie de signalisation NFkB) et inhibe les protéines de l\'inflammasome. Faible biodisponibilité : passe difficilement la barrière intestinale.',
    'sources_alimentaires' => 'Curcuma (rhizome).',
    'synergies' => 'Le curcuma associé au poivre noir dans l\'alimentation (à dose culinaire) ne représente pas de danger particulier. Association traditionnelle avec le gingembre pour améliorer sa biodisponibilité.',
    'notes' => '',
  ),
  24 => 
  array (
    'categorie' => 'Autres',
    'nom' => 'Gingembre',
    'partie_utilisee' => 'Rhizome',
    'description' => 'Rôle principal : action anti-inflammatoire par inhibition sélective de la COX-2. Type : plante aromatique et médicinale (substance à but nutritionnel ou physiologique).',
    'indication' => 'Action anti-inflammatoire (inhibition sélective de la COX-2)
Modulation de la voie NF-κB',
    'contre_indications' => '',
    'posologie' => '',
    'conseil_du_moment' => '',
    'proprietes' => 'Gingiber officinalis, ingrédient de la cuisine traditionnelle indienne, contient des molécules anti-inflammatoires : gingérols et shogaols, capables d\'inhiber la cyclooxygénase 2 (COX-2) sans impact sur la cyclooxygénase 1 (COX-1). Inhibe aussi l\'activité IKKβ nécessaire à l\'activation de NF-κB, supprimant l\'expression de gènes inflammatoires régulés par NF-κB.',
    'sources_alimentaires' => 'Gingembre (rhizome frais ou en poudre).',
    'synergies' => 'Utilisé traditionnellement en association avec le curcuma pour améliorer la biodisponibilité de ce dernier et potentialiser l\'effet anti-inflammatoire.',
    'notes' => '',
  ),
  25 => 
  array (
    'categorie' => 'Antioxydants',
    'nom' => 'Catéchines de thé vert (EGCG)',
    'partie_utilisee' => '',
    'description' => 'Rôle principal : réduction de l\'inflammation systémique de bas grade et action antioxydante. Type : polyphénols flavonoïdes (substance à but nutritionnel ou physiologique).',
    'indication' => 'Réduction de l\'inflammation systémique de bas grade
Action antioxydante
Amélioration du profil lipidique et glycémique
Prévention cardiovasculaire',
    'contre_indications' => '',
    'posologie' => '',
    'conseil_du_moment' => '',
    'proprietes' => 'Polyphénols de la famille des flavonoïdes, présents notamment dans le thé vert (le thé matcha en étant le plus riche) mais aussi dans les haricots, le raisin noir, les cerises ou le cacao. Agissent sur l\'inflammation systémique de bas grade, réduisent le stress oxydatif, l\'athérogénèse, et améliorent le profil lipidique ainsi que la glycémie. Action préventive sur le cancer, notamment via l\'EGCG (catéchine la plus abondante).',
    'sources_alimentaires' => 'Thé vert (thé matcha en particulier), haricots, raisin noir, cerises, cacao.',
    'synergies' => 'Effets synergiques anti-inflammatoires entre les catéchines de thé vert et la quercétine (inhibition conjointe des voies NF-κB et MAPK médiées par TLR4-MyD88), raison pour laquelle elles sont souvent associées dans les compléments alimentaires.',
    'notes' => '',
  ),
  26 => 
  array (
    'categorie' => 'Antioxydants',
    'nom' => 'Quercétine',
    'partie_utilisee' => '',
    'description' => 'Rôle principal : action anti-inflammatoire, antioxydante et antihistaminique. Type : flavonoïde (substance à but nutritionnel ou physiologique).',
    'indication' => 'Action anti-inflammatoire
Action antihistaminique / anti-allergique
Action antioxydante',
    'contre_indications' => '',
    'posologie' => '',
    'conseil_du_moment' => '',
    'proprietes' => 'Flavonoïde présent dans le thé vert, les pépins de raisin, le vin rouge, les oignons (rouges), le chocolat noir, les baies de goji et les fruits rouges. Action anti-inflammatoire, antioxydante et antihistaminique. Inhibe la cyclooxygénase, à l\'origine des prostaglandines et leucotriènes inflammatoires. Action anti-allergique par inhibition des enzymes responsables de la libération d\'histamine.',
    'sources_alimentaires' => 'Oignons (rouges), pépins de raisin, vin rouge, chocolat noir, baies de goji, fruits rouges, thé vert.',
    'synergies' => 'Effets synergiques anti-inflammatoires avec les catéchines de thé vert (voies NF-κB/MAPK) et avec le resvératrol (expression des cytokines pro-inflammatoires) ; associations fréquentes en complémentation.',
    'notes' => '',
  ),
  27 => 
  array (
    'categorie' => 'Antioxydants',
    'nom' => 'Resvératrol',
    'partie_utilisee' => 'Rhizome (renouée du Japon), raisin',
    'description' => 'Rôle principal : action anti-inflammatoire par inhibition de l\'inflammasome. Type : polyphénol de la famille des stilbènes (substance à but nutritionnel ou physiologique).',
    'indication' => 'Action anti-inflammatoire (inhibition de l\'inflammasome)
Action sur le système immunitaire
Action « anti-vieillissement »',
    'contre_indications' => '',
    'posologie' => '',
    'conseil_du_moment' => '',
    'proprietes' => 'Polyphénol de la famille des stilbènes, découvert en 1939. Présent dans le raisin (Vitis vinifera) et surtout dans la renouée du Japon (Polygonum cuspidatum), dont le rhizome est la source la plus riche. Inhibe les protéines de l\'inflammasome, dans le cadre de la modulation de l\'activité des kinases et de l\'inflammasome.',
    'sources_alimentaires' => 'Raisin (Vitis vinifera), vin rouge, renouée du Japon (Polygonum cuspidatum).',
    'synergies' => 'Effets synergiques anti-inflammatoires avec la quercétine sur l\'expression des cytokines pro-inflammatoires des macrophages.',
    'notes' => '',
  ),
);
}

function getRessourcesStress(): array {
    return array (
  0 => 
  array (
    'categorie' => 'Évaluation et prise de conscience',
    'nom' => 'Auto-évaluation du niveau de stress',
    'partie_utilisee' => '',
    'description' => 'Première étape face au stress : prendre conscience de sa présence. À force de vivre avec, le stress passe inaperçu et semble un état « normal », ce qui est dangereux quand le niveau de base est élevé en permanence.
Outil simple : s\'évaluer sur une échelle de 0 (aucun stress) à 10 (stress maximal), à refaire régulièrement pour suivre l\'évolution.',
    'indication' => 'Début de tout accompagnement du stress
Suivi de l\'évolution d\'une personne dans le temps
Repérage d\'un stress chronique passé inaperçu',
    'contre_indications' => '',
    'posologie' => 'Se poser la question : « Sur une échelle de 1 à 10, je me situe à combien en ce moment ? » et la répéter à chaque séance ou régulièrement (ex : chaque jour).
Compléter avec des questions ouvertes :
- Qu\'est-ce qui me stresse ? (travail, famille, maison, relations, santé, finances...)
- Comment je ressens ce stress dans le corps et dans les pensées ? (oppression, boule au ventre, tensions, ruminations...)
- Comment je dors ? (réveils nocturnes, endormissement difficile, cauchemars, sommeil agité)
- Ai-je du mal à récupérer, à me détendre ?
- Le soir, ai-je du mal à laisser les événements de la journée derrière moi ?',
    'conseil_du_moment' => 'À faire en début d\'accompagnement puis régulièrement pour objectiver l\'évolution.',
    'proprietes' => 'Permet de sortir du déni ou de la banalisation du stress chronique et de mesurer objectivement les effets des techniques mises en place.',
    'sources_alimentaires' => '',
    'synergies' => 'À associer à l\'exercice du curseur de stress et à l\'analyse des cercles vicieux du stress.',
    'notes' => '',
  ),
  1 => 
  array (
    'categorie' => 'Évaluation et prise de conscience',
    'nom' => 'Exercice du curseur de stress',
    'partie_utilisee' => '',
    'description' => 'Exercice de visualisation (inspiré d\'un exercice d\'auto-hypnose de Kévin Finel) permettant de prendre conscience de son niveau de stress puis d\'apprendre à le faire redescendre volontairement, comme sur commande.',
    'indication' => 'Stress diffus ou situation stressante identifiée
Apprentissage de l\'auto-régulation avant de savoir la mobiliser en situation réelle
Entraînement à la modulation volontaire du stress',
    'contre_indications' => '',
    'posologie' => 'Yeux fermés :
1. Se connecter à un moment SANS stress (détente, calme, vacances) : sentir le corps, la respiration, les sensations, l\'état d\'esprit.
2. Imaginer un curseur gradué de 1 à 10, le visualiser (forme, couleur, chiffres) et noter le niveau ressenti : c\'est le point de référence.
3. Se connecter ensuite à un moment AVEC stress : scanner les sensations (tête, ventre, poitrine, tensions musculaires, respiration) et visualiser le curseur à ce moment (chiffre, couleur).
4. Visualiser le curseur redescendre progressivement, comme la descente rapide après la montée d\'une montagne russe : tous les signaux de stress diminuent jusqu\'à devenir trop faibles pour être perçus. Sentir la différence dans la respiration et les zones du corps concernées.
5. Répéter le cycle complet 2 à 3 fois pour s\'entraîner à le refaire sur commande en cas de besoin.',
    'conseil_du_moment' => 'À pratiquer en séance dans un premier temps, en dehors de toute situation de crise, avant de pouvoir le mobiliser en situation réelle.',
    'proprietes' => 'Donne un point de référence de l\'état de calme et améliore la capacité à évaluer et moduler volontairement les états de stress, par ancrage d\'une image mentale associée à la détente.',
    'sources_alimentaires' => '',
    'synergies' => 'Cohérence cardiaque, écoute du pouls, relaxation express des 5 zones.',
    'notes' => 'Référence : Kévin Finel, Explorez les capacités de votre cerveau avec l\'auto-hypnose, éd. Leduc.',
  ),
  2 => 
  array (
    'categorie' => 'Évaluation et prise de conscience',
    'nom' => 'Analyse des cercles vicieux du stress',
    'partie_utilisee' => '',
    'description' => 'Outil d\'auto-analyse (approche cognitivo-comportementale) pour comprendre l\'engrenage stresseur → pensées → émotions → comportements → conséquences → stress renforcé, et identifier où agir.',
    'indication' => 'Stress chronique ou récurrent avec schémas répétitifs
Comportements toxiques associés au stress (procrastination, agressivité, fuite, conduites addictives)
Besoin de prendre du recul sur son fonctionnement face au stress',
    'contre_indications' => '',
    'posologie' => 'Sur papier, répondre honnêtement à :
1. Quels sont mes principaux stresseurs ?
2. Quelles sont mes réactions émotionnelles (irritabilité, colère, angoisse, découragement, peur) ?
3. Quelles sont les manifestations sur mon corps (sommeil, maux de tête, digestion, palpitations, douleurs, fatigue) ?
4. Quelles méthodes j\'utilise pour faire face, sont-elles efficaces ou nuisibles (tabac, alcool, café, sucre, médicaments) ?
5. Quelles sont les conséquences concrètes (relations, loisirs, vie sociale, objectifs) ?
6. Suis-je soutenu(e) par mon entourage ?
7. Y a-t-il eu des traumatismes dans ma vie ?
8. Suis-je de nature émotive, anxieuse, colérique ?
Puis identifier où agir : sur les pensées (méditation, pensées positives, thérapie cognitive, remise en question des croyances), sur les émotions (communication non-violente, écriture, respiration, gratitude), sur les comportements (identifier et remplacer les comportements toxiques, demander de l\'aide) ou sur les conséquences (réparer, apprendre, ajuster).',
    'conseil_du_moment' => 'À pratiquer au calme, avec du temps, idéalement en dehors des pics de stress.',
    'proprietes' => 'Modèle du cercle vicieux du stress : stresseur → pensées → émotions → comportements → conséquences → renforcement du stress. S\'appuie sur les 3 réactions décrites par Henri Laborit face au stress : fuite, lutte, inhibition — l\'inhibition de l\'action étant la plus délétère pour la santé.',
    'sources_alimentaires' => '',
    'synergies' => 'Alignement avec ses valeurs, journal des gratitudes, accompagnement thérapeutique si besoin.',
    'notes' => '',
  ),
  3 => 
  array (
    'categorie' => 'Techniques respiratoires',
    'nom' => 'Ralentissement du pouls par la respiration',
    'partie_utilisee' => '',
    'description' => 'Technique de base consistant à ralentir volontairement l\'expiration pour activer le système nerveux parasympathique (« la pédale de frein ») et faire baisser le rythme cardiaque perçu au pouls.',
    'indication' => 'Montée de stress, tension
Apprentissage progressif de l\'auto-régulation avant de l\'utiliser en situation stressante réelle',
    'contre_indications' => '',
    'posologie' => '1. Prendre son pouls : poser index, majeur et annulaire sur la gouttière du cou, percevoir le rythme cardiaque (rapide ou lent) et s\'y concentrer quelques instants.
2. Ralentir et favoriser l\'expiration : vider les poumons sans forcer, prendre un peu d\'air et le garder un instant, puis expirer sans forcer, comme un ballon qui se dégonfle.
3. Sentir le pouls ralentir petit à petit ; si besoin recommencer jusqu\'à obtenir ce ralentissement.
4. Avec la pratique, le ralentissement et la détente (relâchement de la poitrine, baisse de vigilance) sont ressentis directement, sans avoir besoin de prendre le pouls.
S\'entraîner progressivement, d\'abord dans le calme puis dans des situations de plus en plus stressantes.',
    'conseil_du_moment' => 'À pratiquer d\'abord dans un contexte calme avant de la mobiliser en situation de stress, comme un entraînement musculaire progressif.',
    'proprietes' => 'Active le système nerveux parasympathique via l\'allongement de l\'expiration ; boucle d\'inhibition réciproque entre sympathique et parasympathique.',
    'sources_alimentaires' => '',
    'synergies' => 'Cohérence cardiaque, exercice du curseur de stress.',
    'notes' => '',
  ),
  4 => 
  array (
    'categorie' => 'Techniques respiratoires',
    'nom' => 'Cohérence cardiaque (méthode 365)',
    'partie_utilisee' => '',
    'description' => 'Méthode de respiration rythmée popularisée par le Dr David Servan-Schreiber, visant à réguler le système nerveux autonome par une respiration lente et régulière calée sur 6 cycles par minute.',
    'indication' => 'Prévention et régulation du stress au quotidien
Baisse du niveau de stress de fond
Avant un événement stressant (réveil, avant un repas, avant une échéance)',
    'contre_indications' => '',
    'posologie' => 'Méthode 365 : 3 fois par jour, 6 cycles de respiration par minute (5 secondes d\'inspiration + 5 secondes d\'expiration), pendant 5 minutes.
1. Inspirer par le nez sur 5 secondes (compter mentalement).
2. Expirer par la bouche sur 5 secondes (compter mentalement).
3. Répéter pendant 5 minutes.
Une application de cohérence cardiaque ou une vidéo guidée peut aider à tenir le rythme.',
    'conseil_du_moment' => 'Trois moments privilégiés dans la journée : au réveil, avant le déjeuner, en fin d\'après-midi (avant 17h).',
    'proprietes' => 'Une respiration lente et profonde induit une baisse du taux de cortisol, une hausse des ondes alpha (calme, concentration, apprentissage, mémorisation), une sécrétion d\'ocytocine et une régulation du système nerveux autonome.',
    'sources_alimentaires' => '',
    'synergies' => 'Ralentissement du pouls, relaxation, alimentation anti-stress (magnésium, oméga 3).',
    'notes' => 'Référence : Dr David Servan-Schreiber, Guérir le stress, l\'anxiété et la dépression sans médicaments ni psychanalyse, 2003.',
  ),
  5 => 
  array (
    'categorie' => 'Techniques respiratoires',
    'nom' => 'Respiration anti-stress express (5-7)',
    'partie_utilisee' => '',
    'description' => 'Technique de respiration rapide à utiliser en cas de montée soudaine de stress, basée sur une expiration très allongée par rapport à l\'inspiration.',
    'indication' => 'Montée de stress soudaine, pic d\'anxiété
Situation stressante ponctuelle (prise de parole, imprévu, conflit)',
    'contre_indications' => '',
    'posologie' => '1. Inspirer brièvement par le nez.
2. Retenir la respiration poumons pleins pendant environ 5 secondes.
3. Expirer lentement sur environ 7 temps, comme pour souffler une bougie.
Répéter 5 à 10 fois. Compter mentalement aide à détourner l\'attention de la source de stress.',
    'conseil_du_moment' => 'Dès les premiers signes de montée de stress, avant que la réaction ne s\'intensifie.',
    'proprietes' => 'L\'allongement marqué de l\'expiration favorise l\'activation du système nerveux parasympathique et un ralentissement rapide du rythme cardiaque.',
    'sources_alimentaires' => '',
    'synergies' => 'Protocole en cas de crise d\'angoisse, cohérence cardiaque.',
    'notes' => '',
  ),
  6 => 
  array (
    'categorie' => 'Techniques de relaxation',
    'nom' => 'Relaxation express des 5 zones (body scan rapide)',
    'partie_utilisee' => '',
    'description' => 'Technique de relaxation rapide par balayage corporel en 5 zones, à pratiquer en imagination/visualisation pour apprendre à activer une réponse de détente, y compris en situation difficile.',
    'indication' => 'Tensions musculaires, fin de journée chargée
Entre deux activités pour relâcher la pression
Apprentissage progressif d\'une détente mobilisable en situation de stress',
    'contre_indications' => '',
    'posologie' => 'S\'installer confortablement (assis ou allongé). Parcourir mentalement et détendre successivement 5 zones :
1. Pieds → Genoux
2. Genoux → Hanches
3. Buste/Dos → Épaules
4. Épaules → Doigts
5. Cou → Tête
Puis sentir tout le corps détendu en même temps. Refaire le cycle 2 à 3 fois, de plus en plus rapidement, avec de moins en moins de mots au fil des répétitions.
Durée totale : environ 5 à 10 minutes.',
    'conseil_du_moment' => 'Le soir, entre deux activités, ou dès que des tensions apparaissent.',
    'proprietes' => 'Diminution des tensions musculaires et nerveuses, activation du système nerveux parasympathique, retour au calme par le corps.',
    'sources_alimentaires' => '',
    'synergies' => 'Cohérence cardiaque, exercice du curseur de stress, relaxation profonde guidée.',
    'notes' => '',
  ),
  7 => 
  array (
    'categorie' => 'Techniques de relaxation',
    'nom' => 'Relaxation profonde guidée (voyage de la conscience dans le corps)',
    'partie_utilisee' => '',
    'description' => 'Séance de relaxation profonde combinant ancrage, scan corporel, focalisation respiratoire et visualisation, inspirée du Yoga Nidra (rotation de la conscience) et de sa version occidentale, la sophronisation de base (sophrologie du Pr Caycedo). Vise une descente de l\'état de veille vers l\'état alpha, puis une remontée progressive.',
    'indication' => 'Troubles du sommeil
Stress et pathologies liées au stress, surmenage, burn-out
Douleurs, troubles du système nerveux, cardio-vasculaire ou immunitaire
Préparation à un examen, à un accouchement ; convalescence, séniors
Action préventive générale',
    'contre_indications' => 'Grande dépression et états psychotiques.',
    'posologie' => '1. S\'installer confortablement (allongé ou assis).
2. Ancrage : se situer dans la pièce avec des points de repère (sol, murs, points de contact).
3. Scan physique : prendre conscience de chaque partie du corps pour la relâcher, en continu (de la tête aux pieds ou l\'inverse), puis sentir tout le corps détendu en même temps.
4. Focalisation et approfondissement de la respiration : observer le trajet, l\'amplitude, la température du souffle ; éventuellement compter de 21 à 0 ou 11 à 0 ; approfondir la respiration abdominale ou complète ; ralentir le souffle.
5. Temps de silence, ou visualisation guidée une fois l\'état alpha atteint : se rendre dans un lieu ressource imaginaire (forêt, plage, jardin, lieu sacré...) en mobilisant les représentations visuelles, auditives et kinesthésiques (VAK) ; possibilité de rencontrer un guide intérieur ou un animal ressource.
6. Retour progressif : prévenir avant de partir, repasser les étapes en sens inverse en accéléré, revenir à la conscience du corps, de la pièce, des bruits, puis ouvrir les yeux, en augmentant progressivement le volume et le débit de la voix.
7. Temps d\'intégration après la séance : échange bienveillant sur le vécu, sans interprétation sauf formation spécifique.
Rythme conseillé : 2 à 3 séances par semaine, idéalement complétées en autonomie entre les séances.',
    'conseil_du_moment' => 'Prévoir un temps calme sans contrainte immédiate après la séance ; éviter de trop manger, l\'alcool et les drogues avant ; porter des vêtements souples.',
    'proprietes' => 'Fait passer le cerveau des ondes bêta (stress, veille active) vers les ondes alpha, voire thêta : diminution du rythme cardiaque et respiratoire, meilleure cohérence cardiaque, apaisement du système nerveux autonome et du nerf vague, régulation émotionnelle, ralentissement des pensées, activation de l\'imaginaire et de la créativité, sentiment d\'ancrage et de présence.',
    'sources_alimentaires' => '',
    'synergies' => 'Relaxation express des 5 zones, sophrologie, hypnose, méditation de pleine conscience (body scan).',
    'notes' => 'Origines : Yoga Nidra (Satyananda Saraswati, popularisation au milieu du XXe siècle) ; sophrologie (Pr Alfonso Caycedo). Le thérapeute doit avoir lui-même expérimenté la technique, adopter une posture de neutralité bienveillante et se synchroniser avec le client (se détendre et respirer en même temps que lui).',
  ),
  8 => 
  array (
    'categorie' => 'Approches cognitives et émotionnelles',
    'nom' => 'Le sourire (outil anti-stress)',
    'partie_utilisee' => '',
    'description' => 'Outil simple d\'activation des émotions positives : le fait de sourire, même volontairement, envoie un signal positif au cerveau.',
    'indication' => 'Prévention du stress au quotidien
Activation rapide d\'un état émotionnel plus positif',
    'contre_indications' => '',
    'posologie' => 'Sourire plusieurs fois par jour, y compris seul(e) et même si le sourire est forcé au départ.',
    'conseil_du_moment' => 'À intégrer plusieurs fois dans la journée, notamment lors de moments de tension.',
    'proprietes' => 'Active les hormones du bien-être ; les émotions positives ont un impact démontré sur le bien-être mental et physique (optimisme, sommeil, anxiété, dépression, pression artérielle).',
    'sources_alimentaires' => '',
    'synergies' => 'Journal des gratitudes, bulle de souvenir positif.',
    'notes' => 'Étude Mayo Clinic (30 ans) : espérance de vie supérieure de 19 % chez les personnes optimistes (Maruta et al., 2000).',
  ),
  9 => 
  array (
    'categorie' => 'Approches cognitives et émotionnelles',
    'nom' => 'Journal des gratitudes',
    'partie_utilisee' => '',
    'description' => 'Pratique d\'écriture quotidienne consistant à noter des éléments positifs de la journée pour cultiver les émotions positives et réduire le stress.',
    'indication' => 'Prévention du stress, entretien du bien-être mental
Travail de fond sur l\'optimisme et la qualité du sommeil',
    'contre_indications' => '',
    'posologie' => 'Chaque soir, noter 3 choses positives de la journée, par exemple :
« Aujourd\'hui, j\'ai apprécié... »
« J\'ai été touché(e) par... »
« J\'ai réussi à... »',
    'conseil_du_moment' => 'Le soir, avant le coucher.',
    'proprietes' => 'Favorise l\'optimisme, améliore la qualité du sommeil, diminue l\'anxiété et la dépression.',
    'sources_alimentaires' => '',
    'synergies' => 'Le sourire, bulle de souvenir positif, prise de rendez-vous avec soi-même.',
    'notes' => '',
  ),
  10 => 
  array (
    'categorie' => 'Approches cognitives et émotionnelles',
    'nom' => 'Bulle de souvenir positif',
    'partie_utilisee' => '',
    'description' => 'Technique de visualisation consistant à se reconnecter volontairement à un souvenir heureux pour réactiver les sensations et émotions associées.',
    'indication' => 'Besoin d\'un apaisement rapide
Entretien régulier des émotions positives',
    'contre_indications' => '',
    'posologie' => '1. Fermer les yeux.
2. Se reconnecter à un souvenir heureux.
3. Revivre les sensations, les émotions et les images associées.
4. Y retourner chaque fois que le besoin s\'en fait sentir.',
    'conseil_du_moment' => 'Dès qu\'un besoin d\'apaisement se fait sentir, ou en entretien régulier.',
    'proprietes' => 'Réactive un état émotionnel positif par ancrage mental, participe à la régulation du stress.',
    'sources_alimentaires' => '',
    'synergies' => 'Le sourire, journal des gratitudes, exercice du curseur de stress.',
    'notes' => '',
  ),
  11 => 
  array (
    'categorie' => 'Approches cognitives et émotionnelles',
    'nom' => 'Alignement avec ses valeurs (boussole anti-stress)',
    'partie_utilisee' => '',
    'description' => 'Travail de réflexion sur l\'écart entre les valeurs profondes d\'une personne et ses actions concrètes, cet écart étant identifié comme une source importante de stress toxique.',
    'indication' => 'Stress lié au sens, insatisfaction diffuse, questionnement existentiel
Accompagnement de fond en complément des techniques de régulation immédiate',
    'contre_indications' => '',
    'posologie' => 'Se poser les questions suivantes :
1. Quelles sont mes valeurs ? (famille, liberté, créativité, justice, aventure, sécurité, authenticité, nature, solidarité...)
2. Mes actions sont-elles en accord avec mes valeurs ? (ex : valoriser la famille mais travailler 60h/semaine ; valoriser la créativité mais avoir un travail répétitif ; valoriser la nature mais vivre en ville sans jamais sortir)
Puis engager un travail progressif pour aligner ses choix de vie avec ses valeurs profondes.',
    'conseil_du_moment' => 'En dehors des périodes de crise aiguë, dans un temps de réflexion posé.',
    'proprietes' => 'Un décalage entre aspirations et actions génère un stress important et toxique ; un alignement valeurs/actions favorise un sentiment d\'épanouissement et de sérénité.',
    'sources_alimentaires' => '',
    'synergies' => 'Analyse des cercles vicieux du stress, accompagnement thérapeutique.',
    'notes' => '',
  ),
  12 => 
  array (
    'categorie' => 'Approches cognitives et émotionnelles',
    'nom' => 'Prendre rendez-vous avec soi-même',
    'partie_utilisee' => '',
    'description' => 'Démarche organisationnelle consistant à planifier délibérément dans son agenda des activités ressourçantes, sans but ni objectif de performance.',
    'indication' => 'Manque de temps pour soi, agenda saturé par les obligations
Prévention de l\'épuisement',
    'contre_indications' => '',
    'posologie' => '1. Lister au moins 5 choses qui apaisent et rechargent (nature, créativité, sport, relations, lecture, musique...).
2. Quantifier la fréquence nécessaire pour se sentir apaisé(e) et rechargé(e).
3. Chercher comment en faire plus concrètement (ex : « l\'eau me fait du bien » → s\'inscrire à la natation chaque semaine, prévoir des vacances à la mer).
4. Noter ces rendez-vous dans l\'agenda en priorité, au même titre que les autres obligations.
Privilégier les activités sans but ni objectif : loisirs, créativité, sport, relations, nature.',
    'conseil_du_moment' => 'À planifier chaque semaine ou chaque mois, en priorité dans l\'agenda.',
    'proprietes' => 'Redonne de l\'espace aux activités générant des émotions positives, en équilibre avec les obligations quotidiennes.',
    'sources_alimentaires' => '',
    'synergies' => 'Journal des gratitudes, alignement avec ses valeurs, activité physique.',
    'notes' => '',
  ),
  13 => 
  array (
    'categorie' => 'Hygiène de vie anti-stress',
    'nom' => 'Sommeil et respect du chronotype',
    'partie_utilisee' => '',
    'description' => 'Le sommeil est un pilier essentiel de la gestion du stress : le manque de sommeil génère tensions, angoisses et dépression, et les troubles du sommeil eux-mêmes sont souvent causés par le stress, créant un cercle vicieux. Le sommeil permet la digestion des émotions et le traitement de nombreuses informations.',
    'indication' => 'Stress chronique avec troubles du sommeil associés
Fatigue, irritabilité, difficultés de concentration',
    'contre_indications' => '',
    'posologie' => 'Identifier son besoin réel de sommeil (variable selon l\'âge, le genre, la grossesse, la maladie, l\'adolescence, les saisons). Le sommeil est de bonne qualité si la personne se réveille spontanément, en forme, avec la sensation d\'avoir passé une bonne nuit.
Identifier et respecter son chronotype (plutôt du matin ou du soir), à l\'aide par exemple du questionnaire de Horne and Ostberg (Morningness/Eveningness Questionnaire, MEQ), et adapter son emploi du temps en conséquence.',
    'conseil_du_moment' => 'Adapter les horaires de coucher/lever et l\'organisation de la journée au chronotype individuel plutôt qu\'à des normes générales.',
    'proprietes' => 'Un sommeil suffisant et de qualité soutient la régénération nerveuse, la digestion des émotions vécues pendant la journée et la récupération globale de l\'organisme.',
    'sources_alimentaires' => '',
    'synergies' => 'La sieste, activité physique, alimentation anti-stress.',
    'notes' => '',
  ),
  14 => 
  array (
    'categorie' => 'Hygiène de vie anti-stress',
    'nom' => 'La sieste',
    'partie_utilisee' => '',
    'description' => 'Courte période de repos en début d\'après-midi permettant de répondre au creux naturel de vigilance de milieu de journée, plutôt que de le combattre par le café ou des efforts redoublés.',
    'indication' => 'Baisse de concentration et de motivation en milieu d\'après-midi
Tensions musculaires, raideur de nuque, yeux secs, envie de sucre liés à la fatigue',
    'contre_indications' => '',
    'posologie' => 'Sieste de 15 à 20 minutes en début d\'après-midi.',
    'conseil_du_moment' => 'Dès les premiers signes de somnolence du milieu d\'après-midi, plutôt que de lutter contre.',
    'proprietes' => 'Restaure la concentration, réduit les tensions et améliore la productivité pour le reste de la journée.',
    'sources_alimentaires' => '',
    'synergies' => 'Respect du chronotype, activité physique.',
    'notes' => 'Référence : rapport du think tank Terra Nova, « Retrouver le sommeil, une affaire publique » (avril 2016), qui préconise une sieste de 15 minutes au travail.',
  ),
  15 => 
  array (
    'categorie' => 'Hygiène de vie anti-stress',
    'nom' => 'Activité physique et mouvement',
    'partie_utilisee' => '',
    'description' => 'Le mouvement permet de libérer la tension physique accumulée par le stress et de déclencher une impulsion naturelle au repos et à la récupération, en stimulant le système parasympathique.',
    'indication' => 'Stress avec tensions physiques accumulées
Prévention du stress au quotidien',
    'contre_indications' => '',
    'posologie' => 'Activité physique régulière : 2 à 3 fois par semaine, environ 30 minutes, en gardant la notion de plaisir pour éviter l\'abandon.
Marche : au moins 20 minutes par jour.
Favoriser le mouvement au quotidien : prendre les escaliers, se déplacer à pied ou à vélo, travailler en bougeant, danser, jardiner.',
    'conseil_du_moment' => 'À intégrer dans la routine quotidienne plutôt que réservé à des séances isolées.',
    'proprietes' => 'Stimule le système parasympathique et la libération de sérotonine, dopamine, noradrénaline et endorphines ; améliore l\'élimination, la nutrition cellulaire, la circulation sanguine, la respiration, l\'oxygénation, l\'équilibre nerveux et glandulaire et le sommeil.
Formule du Dr James Loehr : intensité (phases d\'effort) + récupération de qualité = grande résistance au stress.',
    'sources_alimentaires' => '',
    'synergies' => 'Sommeil, alimentation anti-stress, relaxation.',
    'notes' => '',
  ),
  16 => 
  array (
    'categorie' => 'Gestion de crise',
    'nom' => 'Protocole en cas de crise d\'angoisse',
    'partie_utilisee' => '',
    'description' => 'Ensemble de gestes simples à mobiliser en cas de crise d\'angoisse aiguë (peur intense et soudaine, difficulté à respirer, boule dans la gorge ou le ventre, cœur qui s\'emballe, vertiges, nausées).',
    'indication' => 'Crise d\'angoisse, attaque de panique',
    'contre_indications' => '',
    'posologie' => '1. S\'allonger ou s\'asseoir, ne pas résister à ce qui se passe.
2. Respirer le plus lentement possible : inspiration brève, garder 5 secondes, expirer sur 7 temps.
3. Fermer les yeux ou fixer un point.
4. Sentir le contact du sol.
5. Se mettre en position fœtale ou en position de l\'enfant (yoga).
6. Appliquer une source de chaleur (bouillotte).
7. Sentir une huile essentielle relaxante (lavande, orange douce).
Rescue (Fleurs de Bach) : 4 gouttes sous la langue.
Se rappeler : « ça va passer, c\'est temporaire, je ne risque rien ».',
    'conseil_du_moment' => 'Au moment même de la crise, sans attendre.',
    'proprietes' => 'Vise à ralentir la réponse physiologique d\'alarme (respiration, rythme cardiaque) et à ramener l\'attention au moment présent et au corps pour désamorcer la spirale anxieuse.',
    'sources_alimentaires' => '',
    'synergies' => 'Respiration anti-stress express, relaxation express des 5 zones.',
    'notes' => 'En cas de crises répétées, orienter vers un accompagnement professionnel (médecin, psychologue).',
  ),
  17 => 
  array (
    'categorie' => 'Alimentation anti-stress',
    'nom' => 'Alimentation anti-stress',
    'partie_utilisee' => '',
    'description' => 'Ensemble de mesures alimentaires visant à soutenir le système nerveux, limiter l\'impact du stress sur l\'organisme et éviter d\'aggraver le stress par l\'alimentation.',
    'indication' => 'Stress chronique, terrain fragilisé par le stress
Soutien du système nerveux et du microbiote en période de stress',
    'contre_indications' => '',
    'posologie' => 'À limiter/éviter : excitants (café, thé noir, alcool, tabac, sodas, boissons énergisantes), sucres rapides, alimentation déséquilibrée et carencée, déshydratation.
À favoriser : équilibre acido-basique et reminéralisation (jus de légumes, crudités, aliments complets et semi-complets, spiruline, algues, graines germées) ; aliments riches en magnésium, vitamines B, tryptophane, vitamine C, fer, oméga 3 et protéines de qualité ; aliments fermentés et prébiotiques pour le microbiote (le stress perturbe la flore intestinale, et une flore perturbée augmente le stress).',
    'conseil_du_moment' => 'Mesures à intégrer dans la durée, en base de l\'hygiène de vie anti-stress.',
    'proprietes' => 'Le magnésium est particulièrement consommé par les contractions musculaires liées au cortisol puis éliminé dans les urines : le stress est à la fois cause et conséquence de carence en magnésium. Les vitamines B interviennent dans la transmission nerveuse et la production de neurotransmetteurs. Le tryptophane est précurseur de la sérotonine. La vitamine C est un antioxydant qui protège du stress oxydatif. Les oméga 3 protègent le système cardiovasculaire et préviennent stress et dépression. Les protéines fournissent les acides aminés nécessaires aux neurotransmetteurs.',
    'sources_alimentaires' => 'Magnésium : légumes verts (épinards, blettes), noix et graines, légumineuses, chocolat noir, bananes.
Vitamines B : légumineuses, céréales complètes, œufs, viandes bio, poissons gras, levure de bière.
Tryptophane : légumineuses, tofu/tempeh, crucifères, œufs, produits laitiers, poissons gras, chocolat noir, bananes, noix et graines.
Vitamine C : kiwi, cassis, citron, papaye, persil, poivron cru, agrumes.
Fer : lentilles, viande rouge et abats bio, épinards, plantes sauvages (ortie, plantain), spiruline.
Oméga 3 : poissons gras, noix, graines de lin et chia, huiles de colza/noix/lin/cameline/chanvre.
Protéines : œufs, poissons, fruits de mer, volaille, légumineuses, céréales complètes, graines de chanvre, spiruline.
Microbiote : aliments fermentés (choucroute, kéfir, kombucha, miso), prébiotiques (poireaux, ail, oignon, asperges).',
    'synergies' => 'Cohérence cardiaque, sommeil, activité physique.',
    'notes' => 'Les plantes anti-stress (sédatives, adaptogènes, gemmothérapie, huiles essentielles) relèvent de fiches dédiées en phyto-aromathérapie.',
  ),
  18 => 
  array (
    'categorie' => 'Techniques complémentaires (aperçu)',
    'nom' => 'Autres approches recommandées en gestion du stress',
    'partie_utilisee' => '',
    'description' => 'Panorama des approches complémentaires citées en soutien de la gestion du stress, chacune pouvant faire l\'objet d\'un accompagnement ou d\'un cours dédié plus détaillé.',
    'indication' => 'Complément aux techniques de respiration et de relaxation, selon les préférences et le profil de la personne',
    'contre_indications' => '',
    'posologie' => 'Techniques citées : méditation, sophrologie, hypnose/auto-hypnose, yoga, Qi Gong, Tai Chi, massage et automassage, chant/musique/sons, hydrologie (bains, douches alternées), réflexologie, médecines complémentaires (acupuncture, ostéopathie, chiropractie), psychothérapie et accompagnement thérapeutique.',
    'conseil_du_moment' => 'À choisir selon les affinités de la personne, en complément des techniques de respiration et de relaxation déjà mises en place.',
    'proprietes' => '',
    'sources_alimentaires' => '',
    'synergies' => 'Relaxation profonde guidée, cohérence cardiaque, alignement avec ses valeurs.',
    'notes' => 'Voir les cours dédiés à chacune de ces techniques pour le détail des pratiques et des indications.',
  ),
);
}

function getRessourcesMycotherapie(): array {
    return array (
  0 => 
  array (
    'categorie' => 'Immunomodulateurs',
    'nom' => 'Champignon du soleil (Agaricus blazei Murill / brasiliensis, ABM)',
    'partie_utilisee' => 'Fructification (carpophore), parfois mycélium',
    'description' => 'Aussi appelé Agaricus brasiliensis / Agaricus Subrufescens, "champignon Piedade", "champignon amande", "pleurote brésilien" ; Ji Song Rong en Chine, Himematsutake au Japon, Cogumelo do sol / Cogumelo da vida / Cogumelo santo au Brésil. Découvert au Brésil dans les forêts tropicales, saprophyte poussant en environnement chaud et humide, même au soleil. Un des champignons les plus étudiés et utilisés en oncologie intégrative, cultivé au Japon depuis 60 ans et en Europe depuis 20 ans pour ses propriétés thérapeutiques.',
    'indication' => 'Immunomodulation, un des plus puissants immunomodulateurs connus
Accompagnement en oncologie intégrative (antinéoplasique, cytotoxique, pro-apoptotique, anti-angiogénique)
Réduction des effets secondaires des traitements en oncologie
Anti-allergique, anti-inflammatoire
Hépatoprotection
Régulation lipidique et glycémique, anti-diabétique
Antioxydant, anti-génotoxique, antimutagène
Antifongique (Candida albicans)
Cicatrisant, antiasthénique
Soutien du système endocrinien et métabolique
Activités anti-infectieuses (viral, bactérien, parasitaire)',
    'contre_indications' => 'Grossesse et allaitement
Enfants de moins de 6 ans (adapter les formules)
Allergie connue aux champignons
Traitements anticoagulants et/ou antifibrinolytiques (prudence, activité antiplaquettaire possible)
Arrêter la prise 5 jours avant une intervention chirurgicale ou une extraction dentaire',
    'posologie' => 'Formes galéniques : poudre de champignon séché (mycélium et/ou carpophore), comprimés, gélules, extraits liquides, extraits liquides standardisés, super extraits ultraconcentrés
Poudre : usage préventif et effet prébiotique, en superaliment
Extraits : accompagnement actif, concentration plus élevée en biomolécules ; gélules pour un dosage optimisé, liquide pour une meilleure bio-assimilation et le renforcement des synergies
Extraits ultraconcentrés : privilégiés en oncologie intégrative
Privilégier une monothérapie sans mélange, bio, tracée, riche en bêta-1,3/1,6-D-glucanes',
    'conseil_du_moment' => '',
    'proprietes' => 'Riche en bêta-glucanes (système immunitaire), lipides (acide linoléique, phospholipides), protéoglycanes (immunité, cancer), coenzyme Q10, vitamines B, minéraux (sodium, potassium, calcium, magnésium, fer, cuivre, manganèse, zinc, sélénium), GABA, lovastatine naturelle, ergostérol, enzymes.',
    'sources_alimentaires' => '',
    'synergies' => 'Système immunitaire : associable au Reishi, Coriolus, Shiitake, Cordyceps, Chaga
Système nerveux : associable au Hericium, Reishi, Cordyceps
Système endocrinien : associable au Reishi, Cordyceps, Maitake
Troubles métaboliques : associable au Maitake, Shiitake, Coprin, Reishi
Activités anti-infectieuses : associable au Shiitake, Coriolus, Reishi, Cordyceps
Les champignons thérapeutiques peuvent être associés entre eux sans risque particulier et n\'interfèrent pas de façon significative avec les traitements conventionnels (faible effet sur le CYP450)',
    'notes' => 'La mycothérapie est la science des soins par l\'emploi des champignons médicinaux ; usage documenté depuis la dynastie Han (200 av. J.-C.) en Chine et le Pen Ts\'ao Kang Mu (1575). Les champignons médicinaux sont considérés comme des adaptogènes et des BRM (biological response modifiers, modificateurs de la réponse biologique) qui contribuent à l\'homéostasie ; ils appartiennent à la catégorie des nutraceutiques. Critères de choix : agriculture biologique, labels (Eurofeuille, GMP/BPF, sans gluten/lactose, vegan, RAW), traçabilité, présence de bêta-1,3 et 1,6 D-glucanes, concentration en principes actifs, absence d\'additifs, monothérapies sans mélange.',
  ),
  1 => 
  array (
    'categorie' => 'Digestif/Foie',
    'nom' => 'Coprin chevelu (Coprinus comatus)',
    'partie_utilisee' => 'Fructification (carpophore), cueilli jeune',
    'description' => 'Aussi appelé "pilon de poulet", "perruque de l\'avocat", "champignon barbu". Champignon fragile qui s\'autodigère (déliquescence) à maturité ; risque de confusion avec Coprinus atramentarius. Sauvage ou cultivé, pousse au printemps et à l\'automne. Peut servir d\'indicateur de la charge en métaux lourds des sols ; à consommer uniquement cueilli jeune et dans les 4 à 6h suivant la cueillette.',
    'indication' => 'Hypoglycémiant, anti-diabétique
Hypolipémiant, régulation métabolique
Contrôle du poids
Soutien du système endocrinien
Potentiel anticancer
Hépatoprotecteur, notamment en cas de consommation d\'alcool
Antioxydant, anti-inflammatoire
Inhibition de l\'acétylcholinestérase
Antimicrobien (virus, nématodes, moisissures)
Soutien digestif et prébiotique',
    'contre_indications' => 'Peut créer des réactions cutanées en cas de dermatites atopiques
Grossesse et allaitement
Enfants de moins de 6 ans (adapter les formules)
Allergie connue aux champignons
Traitements anticoagulants et/ou antifibrinolytiques
Arrêter la prise 5 jours avant une intervention chirurgicale ou une extraction dentaire',
    'posologie' => 'Formes galéniques : poudre de champignon séché, comprimés, gélules, extraits liquides, extraits liquides standardisés, super extraits ultraconcentrés
Poudre : usage préventif et effet prébiotique
Extraits : accompagnement actif notamment sur le terrain métabolique (glycémie, lipides)
Privilégier une monothérapie bio, tracée et riche en bêta-1,3/1,6-D-glucanes',
    'conseil_du_moment' => '',
    'proprietes' => 'Riche en polysaccharides, lipides (acide linoléique), protéines (jusqu\'à 25%), vitamines et minéraux, vanadium (impliqué dans la régulation glycémique).',
    'sources_alimentaires' => '',
    'synergies' => 'Troubles métaboliques : associable au Maitake, Shiitake, Champignon du soleil, Reishi
Système digestif et microbiote : associable au Hericium, Pleurotes, Shiitake, Reishi',
    'notes' => 'Champignon utilisé notamment pour son bio-accumulation en vanadium, en lien avec ses effets hypoglycémiants. À différencier de son sosie toxique Coprinus atramentarius (interaction avec l\'alcool).',
  ),
  2 => 
  array (
    'categorie' => 'Immunomodulateurs',
    'nom' => 'Queue de dinde (Coriolus versicolor / Trametes versicolor)',
    'partie_utilisee' => 'Fructification (carpophore) ; extraits standardisés PSK et PSP',
    'description' => 'Aussi appelé "champignon nuageux", "champignon arc-en-ciel" ; Yun-zhi en Chine, Karawatake au Japon. Polypore poussant sur les troncs d\'arbres (chêne, peuplier, acacia possibles en culture), non consommable en l\'état. Un des champignons médicinaux les plus étudiés en immunologie et cancérologie, utilisé en traitement anticancéreux au Japon depuis les années 1980. Statut en France/UE : "novel food" en liste rouge du fait de l\'absence de présence alimentaire avérée avant 1997 (statut non lié à une toxicité).',
    'indication' => 'Cancérologie : cytotoxique, anti-métastatique, immunostimulant, chimio-sensibilisant en adjuvant des traitements conventionnels, anti-angiogénique
Antiviral puissant, antimicrobien
Hépatoprotection, soutien des gastropathies
Fatigue chronique, antiasthénique
Soutien du système immunitaire
Antioxydant, anti-âge
Amélioration de la fonction cognitive, neuroprotection
Anti-inflammatoire',
    'contre_indications' => 'Grossesse et allaitement
Enfants de moins de 6 ans (adapter les formules)
Allergie connue aux champignons
Traitements anticoagulants et/ou antifibrinolytiques
Arrêter la prise 5 jours avant une intervention chirurgicale ou une extraction dentaire
Vente encadrée en France/UE (statut "novel food")',
    'posologie' => 'Formes galéniques : poudre de champignon séché, comprimés, gélules, extraits liquides, extraits liquides standardisés (PSP, PSK), super extraits ultraconcentrés, biomolécules isolées (PSK/Krestin et PSP approuvées comme médicaments en Chine et au Japon)
Extraits ultraconcentrés privilégiés en oncologie intégrative en accompagnement des traitements conventionnels',
    'conseil_du_moment' => '',
    'proprietes' => 'Riche en polysaccharides PSP et PSK (jusqu\'à 92% de glucanes), protéoglycanes, ergostérol.',
    'sources_alimentaires' => '',
    'synergies' => 'Système immunitaire : associable au Champignon du soleil, Reishi, Shiitake, Cordyceps, Chaga
Activités anti-infectieuses : associable au Champignon du soleil, Shiitake, Reishi, Cordyceps
Oncologie intégrative : peut être associé à d\'autres champignons thérapeutiques et aux traitements conventionnels (faible interaction CYP450)',
    'notes' => 'PSK (Krestin) et PSP sont deux polysaccharopeptides extraits du mycélium, parmi les biomolécules fongiques les mieux documentées scientifiquement et approuvées comme médicaments en oncologie en Asie.',
  ),
  3 => 
  array (
    'categorie' => 'Adaptogènes',
    'nom' => 'Cordyceps (Cordyceps sinensis / Ophiocordyceps sinensis)',
    'partie_utilisee' => 'Ensemble champignon-insecte parasité (état sauvage) ou mycélium cultivé (souches Cordyceps militaris, Paecilomyces hepiali CBG-CS-2, Cordyceps sinensis CS-4)',
    'description' => 'Aussi appelé "champignon chenille", "remède de l\'empereur" ; Dong chong Xia cao / Chong cao ("ver d\'hiver, herbe d\'été") en Chine, Tochukaso au Japon, Yartsa gunbu au Tibet. Champignon entomophage parasitant des larves de lépidoptères, poussant sur les plateaux tibétains entre 3000 et 5000 mètres d\'altitude. Premières mentions écrites en 620 av. J.-C. (dynastie Tang). Considéré en MTC comme "tonique supérieur". Introduit en Europe au 18e siècle par un prêtre jésuite qui le compare au ginseng. Considéré non toxique ; le sauvage vaut plus que son poids en or, d\'où le développement de souches cultivées.',
    'indication' => 'Tonifiant général, convalescence, antiasthénique
Soutien du système rénal
Soutien du système cardio-respiratoire, affections respiratoires chroniques
Anti-âge, anti-oxydant
Hépatoprotecteur
Soutien du système hormonal/endocrinien
Soutien du système immunitaire, immunomodulation
Anticancer, antitumoral (via la cordycépine)
Anti-inflammatoire (aigu et chronique)
Anti-diabétique, anti-hyperlipidémiant
Anti-ostéoporose, antiarthritique
Antimicrobien, anti-infectieux (virus, bactéries)
Soutien du système nerveux',
    'contre_indications' => 'Femmes enceintes et allaitantes (contre-indication spécifique de la cordycépine)
Enfants de moins de 6 ans (adapter les formules)
Allergie connue aux champignons
Traitements anticoagulants et/ou antifibrinolytiques
Arrêter la prise 5 jours avant une intervention chirurgicale ou une extraction dentaire',
    'posologie' => 'Formes galéniques : poudre de champignon séché (mycélium cultivé le plus souvent), comprimés, gélules, extraits liquides, extraits liquides standardisés (cordycépine), super extraits ultraconcentrés
Extraits : accompagnement actif du terrain inflammatoire, de la fatigue chronique et de la convalescence
Monothérapie bio et tracée recommandée, vérifier la souche (éviter la confusion avec le sauvage menacé/coûteux)',
    'conseil_du_moment' => '',
    'proprietes' => 'Riche en polysaccharides, cordycépine (analogue nucléosidique de l\'adénosine) et acide cordycépique, ergostérol, mannitol, acides aminés, vitamines B et K, minéraux, ophiocordyne, cordymine.',
    'sources_alimentaires' => '',
    'synergies' => 'Système immunitaire : associable au Champignon du soleil, Reishi, Coriolus, Shiitake, Chaga
Système nerveux : associable au Hericium, Reishi, Champignon du soleil
Système endocrinien : associable au Champignon du soleil, Reishi, Maitake
Système respiratoire : associable au Polypore en ombelle, Reishi
Activités anti-infectieuses : associable au Champignon du soleil, Shiitake, Coriolus, Reishi',
    'notes' => 'Sujet du mémoire de fin d\'études de l\'auteure du cours ("L\'intérêt de l\'utilisation du Cordyceps sinensis en naturopathie afin de réduire les phénomènes d\'inflammation aiguë ou chronique", 2021). La cordycépine est la molécule la plus étudiée du champignon.',
  ),
  4 => 
  array (
    'categorie' => 'Adaptogènes',
    'nom' => 'Reishi (Ganoderma lucidum)',
    'partie_utilisee' => 'Fructification (carpophore), non consommable en l\'état (chair coriace, goût amer)',
    'description' => '"Le Roi des champignons", "Champignon de l\'immortalité", "Elixir de vie", "Champignon de l\'éternelle jeunesse", "Ganoderme luisant" ; Ling Zhi / Chizhi en Chine, Youngzhi en Corée. Champignon saprophyte et parasite, répandu en Europe. Peut-être le champignon médicinal le mieux étudié au monde, considéré comme la substance naturelle la plus précieuse de la médecine traditionnelle chinoise. Très utilisé en cancérologie en Asie, en synergie avec les traitements conventionnels. Contient plus de 400 composants bioactifs, une richesse particulière en germanium et plus de 100 terpènes. Protéines bioactives isolées : LZ-8, GLP, ganodermine.',
    'indication' => 'Immunomodulation (systèmes immunitaire, endocrinien, cardio-vasculaire)
Propriétés anticancer et cytotoxiques, accompagnement en oncologie intégrative
Anti-oxydant, radio-protecteur
Anti-stress, adaptogène
Anti-inflammatoire, anti-allergique (activité antihistaminique des triterpènes)
Neuroprotection, soutien du système nerveux
Hépatoprotection
Hypotenseur, hypoglycémiant
Antibactérien, antiviral, antifongique
Antiasthénique
Effet myorelaxant et sédatif (adénosine, guanosine), effet antiplaquettaire',
    'contre_indications' => 'Grossesse et allaitement
Enfants de moins de 6 ans (adapter les formules)
Allergie connue aux champignons
Traitements anticoagulants et/ou antifibrinolytiques (prudence renforcée : effet antiplaquettaire propre au Reishi)
Arrêter la prise 5 jours avant une intervention chirurgicale ou une extraction dentaire',
    'posologie' => 'Formes galéniques : poudre de champignon séché, comprimés, gélules, extraits liquides, extraits liquides standardisés (triterpènes/bêta-glucanes), super extraits ultraconcentrés
Extraits liquides : renforcement des synergies et meilleure bio-assimilation
Extraits ultraconcentrés : privilégiés en oncologie intégrative en accompagnement des traitements conventionnels',
    'conseil_du_moment' => '',
    'proprietes' => 'Riche en bêta-glucanes, triterpènes (acides ganodériques), adénosine et guanosine, stérols, 17 acides aminés dont tous les essentiels, minéraux (fer, zinc, cuivre, manganèse, magnésium, potassium, germanium, calcium), vitamines du groupe B (notamment B9).',
    'sources_alimentaires' => '',
    'synergies' => 'Système immunitaire : associable au Champignon du soleil, Coriolus, Shiitake, Cordyceps, Chaga
Système nerveux : associable au Hericium, Cordyceps, Champignon du soleil
Système endocrinien : associable au Champignon du soleil, Cordyceps, Maitake
Système respiratoire : associable au Cordyceps, Polypore en ombelle
Système cardio-vasculaire : associable au Polypore en ombelle, Chaga
Troubles métaboliques : associable au Maitake, Shiitake, Coprin, Champignon du soleil
Activités anti-infectieuses : associable au Champignon du soleil, Shiitake, Coriolus, Cordyceps',
    'notes' => 'Considéré comme la substance naturelle la plus précieuse de la médecine traditionnelle chinoise. A fait l\'objet d\'une thèse dédiée à ses mécanismes d\'action anticancéreux (Lallet Daher H., 2019).',
  ),
  5 => 
  array (
    'categorie' => 'Digestif/Foie',
    'nom' => 'Maitake (Grifola frondosa)',
    'partie_utilisee' => 'Fructification (carpophore)',
    'description' => '"Le Roi des champignons" (avec Reishi, Shiitake et ABM), "champignon dansant", "poule des bois" / "hen of the woods", "polypore en touffe", "fleur de frêne" ; Hui shu/zhu hua en Chine, Signorina en Italie. Pousse dans les forêts caduques tempérées, sur souches de vieux chênes, châtaigniers, hêtres. Comestible à texture charnue et saveur umami. Concentration parmi les plus élevées en polysaccharides. Très utilisé en MTC pour son rôle tonique et adaptogène, particulièrement étudié sur les axes métaboliques et endocriniens ainsi qu\'en cancérologie. Culture lancée au Japon dans les années 1980.',
    'indication' => 'Régulation du métabolisme, gestion du poids
Soutien du système immunitaire, immunomodulation
Antitumoral, cytotoxique, accompagnement en oncologie intégrative
Anti-diabétique
Effets antiviraux et antibactériens
Antihypertenseur
Régulation lipidique
Régulation du microbiote, antioxydant
Soutien du système cardio-vasculaire
Soutien des axes endocriniens',
    'contre_indications' => 'Grossesse et allaitement
Enfants de moins de 6 ans (adapter les formules)
Allergie connue aux champignons
Traitements anticoagulants et/ou antifibrinolytiques
Arrêter la prise 5 jours avant une intervention chirurgicale ou une extraction dentaire',
    'posologie' => 'Formes galéniques : poudre de champignon séché, comprimés, gélules, extraits liquides, extraits liquides standardisés, super extraits ultraconcentrés
Extraits : accompagnement actif du terrain métabolique et endocrinien
Extraits ultraconcentrés : privilégiés en oncologie intégrative',
    'conseil_du_moment' => '',
    'proprietes' => 'Riche en polysaccharides (concentration parmi les plus élevées des champignons médicinaux), ergostérol, ergothionéine, acides aminés essentiels, magnésium, phosphore, potassium, vitamines B, lectines, acides gras.',
    'sources_alimentaires' => '',
    'synergies' => 'Système endocrinien : associable au Champignon du soleil, Reishi, Cordyceps
Troubles métaboliques : associable au Shiitake, Coprin, Champignon du soleil, Reishi',
    'notes' => 'À bien différencier du Polypore en ombelle (Polyporus umbellatus / Grifola umbellata), avec lequel il partage l\'apparence et le genre mais pas les mêmes usages thérapeutiques.',
  ),
  6 => 
  array (
    'categorie' => 'Cognitif/Nerveux',
    'nom' => 'Crinière de lion (Hericium erinaceus)',
    'partie_utilisee' => 'Fructification (carpophore)',
    'description' => 'Aussi appelé "hydne hérisson", "pom-pom blanc", "lion\'s mane", "champignon à tête de singe" ; Yamabushitake au Japon, Hou Tou Gu en Chine. Champignon comestible très prisé (saveur homard), très utilisé en MTC pour ses vertus médicinales. Polypore poussant à l\'état sauvage sur arbres vieux ou morts (hêtraies, chênaies) ; protégé par la loi dans plusieurs pays européens (Croatie, Hongrie, Pologne, Serbie, Slovénie, Suède, Royaume-Uni). Considéré comme le champignon de l\'axe intestin-cerveau.',
    'indication' => 'Neuroprotection, effets nootropes et neurotrophiques
Antidépresseur
Soutien cognitif, troubles cognitifs, prévention des neurodégénérescences
Intégrité de la barrière intestinale, effets prébiotiques
Soutien du système digestif et du microbiote
Aide face aux intolérances alimentaires
Anti-inflammatoire, antioxydant
Soutien du système immunitaire
Potentiel anticancer',
    'contre_indications' => 'Grossesse et allaitement
Enfants de moins de 6 ans (adapter les formules)
Allergie connue aux champignons
Traitements anticoagulants et/ou antifibrinolytiques
Arrêter la prise 5 jours avant une intervention chirurgicale ou une extraction dentaire',
    'posologie' => 'Formes galéniques : poudre de champignon séché, comprimés, gélules, extraits liquides, extraits liquides standardisés, super extraits ultraconcentrés
Usage régulier recommandé sur le terrain digestif et cognitif, en cure de fond pour un soutien neurotrophique',
    'conseil_du_moment' => '',
    'proprietes' => 'Riche en polysaccharides, SOD, acides aminés essentiels, triterpènes, ergothionéine, ergostérol, potassium, fer, sélénium, zinc, germanium. Molécules d\'intérêt spécifiques : érinacines, héricénones, GABA.',
    'sources_alimentaires' => '',
    'synergies' => 'Système nerveux : associable au Reishi, Cordyceps, Champignon du soleil
Système digestif et microbiote : associable au Pleurotes, Shiitake, Reishi, Coprin',
    'notes' => 'Les érinacines et héricénones sont des terpènes propres à ce champignon, à l\'origine de son intérêt spécifique pour l\'axe intestin-cerveau et la stimulation du facteur de croissance nerveuse (NGF).',
  ),
  7 => 
  array (
    'categorie' => 'Immunomodulateurs',
    'nom' => 'Chaga (Inonotus obliquus)',
    'partie_utilisee' => 'Sclérote/masse externe noire (chaga) prélevée sur le tronc du bouleau',
    'description' => '"Perle noire", "diamant de la forêt", "polypore du cancer", "champignon du bouleau" ; Kaba No Ana Take au Japon, Tchaga/Tsyr en Sibérie, Saagaategan chez les nord-amérindiens, Bai Hua Rong en Chine. Pousse sur les arbres à bois tendre (notamment le bouleau) dans l\'hémisphère nord, avec une forme sexuée et une forme asexuée. Utilisé en médecine traditionnelle par les peuples nordiques depuis des siècles. Inscrit à la Pharmacopée russe et considéré comme remède anticancer, intégré dans des formulations thérapeutiques (ex. Befungin). Espèce très étudiée en oncologie.',
    'indication' => 'Antitumoral, anticancer, cytotoxique, accompagnement en oncologie intégrative
Immunomodulation, anti-inflammatoire
Hépatoprotection, hypolipémiant
Hypoglycémiant, anti-diabétique
Antioxydant, antiviral, antifongique
Antiasthénique
Néphroprotecteur
Soutien du système cardio-vasculaire
Soutien du microbiote',
    'contre_indications' => 'Grossesse et allaitement
Enfants de moins de 6 ans (adapter les formules)
Allergie connue aux champignons
Traitements anticoagulants et/ou antifibrinolytiques
Arrêter la prise 5 jours avant une intervention chirurgicale ou une extraction dentaire',
    'posologie' => 'Formes galéniques : poudre de champignon séché, comprimés, gélules, extraits liquides, extraits liquides standardisés, super extraits ultraconcentrés
Extraits ultraconcentrés : privilégiés en oncologie intégrative
Traditionnellement également préparé en décoction/infusion dans les pays nordiques',
    'conseil_du_moment' => '',
    'proprietes' => 'Grande variété de polysaccharides, acide bétulinique, bétuline, ergostérol, inotodiol, vitamines, minéraux.',
    'sources_alimentaires' => '',
    'synergies' => 'Système immunitaire : associable au Champignon du soleil, Reishi, Coriolus, Shiitake, Cordyceps
Système cardio-vasculaire : associable au Reishi, Polypore en ombelle',
    'notes' => 'Richesse particulière en acide bétulinique et bétuline, molécules issues du bouleau hôte transformées par le champignon. A fait l\'objet d\'une thèse dédiée à ses propriétés anticancéreuses (Géry A., 2022).',
  ),
  8 => 
  array (
    'categorie' => 'Immunomodulateurs',
    'nom' => 'Shiitake (Lentinula edodes)',
    'partie_utilisee' => 'Fructification (carpophore), toujours consommé cuit',
    'description' => '"Elixir de vie", "lentin des chênes", "champignon des Samouraïs" ; Himematsutake au Japon, Xianggu en Chine. 2e champignon le plus consommé au monde. Comestible très prisé en Asie, ne se mange jamais cru. Pousse naturellement en Chine, en altitude. En MTC, considéré pour renforcer l\'énergie vitale et la résistance aux agents pathogènes externes. Cultivé à 90% en Chine, inclus dans les traitements intégratifs du cancer au Japon.',
    'indication' => 'Antinéoplasique, antitumoral, anticancer, accompagnement en oncologie
Antiviral, antibactérien, antimicrobien
Immunomodulation, anti-inflammatoire
Tonifiant général
Soutien du métabolisme, anti-diabétique, contrôle du poids
Hépatoprotection, hypocholestérolémiant
Soutien du système cardio-vasculaire
Antioxydant
Soutien du système immunitaire et du microbiote (effet prébiotique par les fibres)',
    'contre_indications' => 'Toujours consommer cuit (jamais cru)
Grossesse et allaitement
Enfants de moins de 6 ans (adapter les formules)
Allergie connue aux champignons
Traitements anticoagulants et/ou antifibrinolytiques
Arrêter la prise 5 jours avant une intervention chirurgicale ou une extraction dentaire',
    'posologie' => 'Formes galéniques : poudre de champignon séché, comprimés, gélules, extraits liquides, extraits liquides standardisés (lentinane), super extraits ultraconcentrés
Lentinane : utilisé en approche intégrative du cancer, en complément des traitements conventionnels
Poudre : usage préventif et effet prébiotique en cure de fond',
    'conseil_du_moment' => '',
    'proprietes' => 'Riche en polysaccharides (dont le lentinane), protéoglycanes, vitamines B, C, E, minéraux, acide linoléique, éritadénine, ergostérol, acides aminés essentiels, GABA, vitamine D.',
    'sources_alimentaires' => '',
    'synergies' => 'Système immunitaire : associable au Champignon du soleil, Reishi, Coriolus, Cordyceps, Chaga
Système digestif et microbiote : associable au Hericium, Pleurotes, Reishi, Coprin
Troubles métaboliques : associable au Maitake, Coprin, Champignon du soleil, Reishi
Activités anti-infectieuses : associable au Champignon du soleil, Coriolus, Reishi, Cordyceps',
    'notes' => 'Le lentinane, bêta-glucane extrait du Shiitake, est l\'une des molécules fongiques les plus étudiées sur les effets humains, en particulier en approche intégrative du cancer.',
  ),
  9 => 
  array (
    'categorie' => 'Digestif/Foie',
    'nom' => 'Pleurote en huître (Pleurotus ostreatus)',
    'partie_utilisee' => 'Fructification (carpophore)',
    'description' => 'Champignon comestible très consommé, comme le Shiitake, apprécié pour ses qualités gastronomiques.',
    'indication' => 'Soutien du système gastro-intestinal et du microbiote (effet prébiotique par la richesse en fibres)
Soutien du système immunitaire
Prévention santé, accompagnement en prévention du cancer
Antioxydant (composés phénoliques)',
    'contre_indications' => 'Grossesse et allaitement
Enfants de moins de 6 ans (adapter les formules)
Allergie connue aux champignons
Traitements anticoagulants et/ou antifibrinolytiques
Arrêter la prise 5 jours avant une intervention chirurgicale ou une extraction dentaire',
    'posologie' => 'Formes galéniques : poudre de champignon séché, comprimés, gélules, extraits liquides
Poudre : usage préventif et effet prébiotique, consommation également possible comme aliment cuit',
    'conseil_du_moment' => '',
    'proprietes' => 'Riche en acides aminés essentiels, acides gras, vitamines B, minéraux, enzymes, composés phénoliques, fibres.',
    'sources_alimentaires' => 'Champignon comestible pouvant être intégré directement à l\'alimentation (cuit).',
    'synergies' => 'Système digestif et microbiote : associable au Hericium, Shiitake, Reishi, Coprin',
    'notes' => '',
  ),
  10 => 
  array (
    'categorie' => 'Digestif/Foie',
    'nom' => 'Pleurote du panicaut (Pleurotus eryngii)',
    'partie_utilisee' => 'Fructification (carpophore)',
    'description' => 'Champignon comestible à haute valeur nutritionnelle et intérêt gustatif marqué.',
    'indication' => 'Soutien du système digestif et du microbiote
Accompagnement en oncologie (potentiel préventif)
Antioxydant, anti-âge',
    'contre_indications' => 'Grossesse et allaitement
Enfants de moins de 6 ans (adapter les formules)
Allergie connue aux champignons
Traitements anticoagulants et/ou antifibrinolytiques
Arrêter la prise 5 jours avant une intervention chirurgicale ou une extraction dentaire',
    'posologie' => 'Formes galéniques : poudre de champignon séché, comprimés, gélules, extraits liquides
Poudre : usage préventif et effet prébiotique, consommation également possible comme aliment cuit',
    'conseil_du_moment' => '',
    'proprietes' => 'Riche en polysaccharides, acides aminés, acides gras insaturés, lectines, enzymes, vitamines B et D, zinc, fibres.',
    'sources_alimentaires' => 'Champignon comestible pouvant être intégré directement à l\'alimentation (cuit).',
    'synergies' => '',
    'notes' => '',
  ),
  11 => 
  array (
    'categorie' => 'Digestif/Foie',
    'nom' => 'Polypore en ombelle (Polyporus umbellatus)',
    'partie_utilisee' => 'Sclérote/rhizome (Zhu Ling), fructification',
    'description' => 'Aussi appelé Grifola umbellata, "umbrella polypore" ; Chorei maitake / Tsuchi maitake au Japon, Zhu-ling en Chine. Retrouvé parmi les affaires de l\'homme des glaces Ötzi. À bien différencier du Maitake, avec lequel il partage l\'apparence, le genre et certains usages. Comestible mais sans intérêt gustatif particulier. Considéré en MTC comme le champignon du drainage lymphatique, utilisé pour combattre les mucosités (Tang) et employé depuis plus de 1000 ans comme antibiotique traditionnel.',
    'indication' => 'Soutien du système lymphatique, drainage
Mucolytique
Diurétique, néphroprotection
Soutien du système génito-urinaire
Accompagnement des cancers dits liquides (hématologiques)
Soutien du système respiratoire
Activité anticancer
Hépatoprotection
Immunostimulation, anti-inflammatoire
Antioxydant
Soutien de la croissance des cheveux',
    'contre_indications' => 'Grossesse et allaitement
Enfants de moins de 6 ans (adapter les formules)
Allergie connue aux champignons
Traitements anticoagulants et/ou antifibrinolytiques
Arrêter la prise 5 jours avant une intervention chirurgicale ou une extraction dentaire',
    'posologie' => 'Formes galéniques : poudre de champignon séché, comprimés, gélules, extraits liquides, extraits liquides standardisés, super extraits ultraconcentrés',
    'conseil_du_moment' => '',
    'proprietes' => 'Polysaccharides en haute concentration, triterpènes, protéoglycanes, ergostérol, vitamines B, calcium, potassium, fer, zinc, manganèse. Riche en protéines, teneur relative notable en cuivre et zinc.',
    'sources_alimentaires' => '',
    'synergies' => 'Système respiratoire : associable au Cordyceps, Reishi
Système cardio-vasculaire : associable au Reishi, Chaga',
    'notes' => 'Ne pas confondre avec le Maitake (Grifola frondosa), malgré une apparence et un genre proches : les usages thérapeutiques diffèrent.',
  ),
  12 => 
  array (
    'categorie' => 'Digestif/Foie',
    'nom' => 'Eponge de pin (Poria cocos)',
    'partie_utilisee' => 'Sclérote (masse souterraine)',
    'description' => '"Le champignon vital". Récolté à la racine des pins, où il se développe en profondeur, sous forme de sclérote.',
    'indication' => 'Anti-inflammatoire, anti-œdémateux
Diurétique
Tonifiant
Accompagnement en oncologie
Soutien du système digestif
Soutien du système rénal',
    'contre_indications' => 'Grossesse et allaitement
Enfants de moins de 6 ans (adapter les formules)
Allergie connue aux champignons
Traitements anticoagulants et/ou antifibrinolytiques
Arrêter la prise 5 jours avant une intervention chirurgicale ou une extraction dentaire',
    'posologie' => 'Formes galéniques : poudre de sclérote séché, comprimés, gélules, extraits liquides, extraits liquides standardisés',
    'conseil_du_moment' => '',
    'proprietes' => 'Riche en polysaccharides, triterpènes, ergostérol.',
    'sources_alimentaires' => '',
    'synergies' => '',
    'notes' => 'Utilisé traditionnellement en médecine traditionnelle chinoise notamment pour son action diurétique et sur la sphère digestive.',
  ),
);
}

function getRessourcesActivitePhysique(): array {
    return array (
  0 => 
  array (
    'categorie' => 'Activité physique - Fondamentaux',
    'nom' => 'Rôle de l\'activité physique dans la santé globale',
    'partie_utilisee' => '',
    'description' => 'Définition de l\'activité physique selon l\'OMS : « tout mouvement corporel produit par les muscles squelettiques qui requiert une dépense d\'énergie », incluant les loisirs, les déplacements, le travail et les tâches ménagères — pas seulement la pratique sportive. Distinction avec l\'inactivité physique (niveau insuffisant d\'activité d\'intensité modérée à élevée par rapport aux seuils recommandés) et la sédentarité (dépense énergétique inférieure à 1,6 MET, temps passé en position assise ou allongée). L\'activité physique est l\'un des piliers de la naturopathie, aux côtés de l\'alimentation et de la gestion psycho-émotionnelle, et s\'inscrit dans les 5 principes fondamentaux (humorisme, vitalisme, holisme, causalisme, hygiénisme). Technique préventive par excellence : elle ouvre et stimule les émonctoires (poumons via la respiration, peau via les glandes sudoripares et sébacées, mais aussi reins, foie, intestins) pour favoriser l\'évacuation des toxines et déchets.',
    'indication' => 'Rappel pédagogique pour situer l\'activité physique parmi les techniques naturopathiques.
Toute personne dans une démarche de prévention et d\'hygiène de vie.',
    'contre_indications' => '',
    'posologie' => 'Seuils de référence retenus par l\'OMS (2010) pour éviter l\'inactivité :
Adultes : au moins 150 min/semaine d\'activité d\'intensité modérée (soit 30 min x 5 jours/semaine).
Enfants et adolescents : 60 min/jour, soit 420 min/semaine.',
    'conseil_du_moment' => '',
    'proprietes' => 'Régulation, stimulation et purification de l\'organisme (et de l\'esprit).
Ouverture et stimulation des émonctoires pour favoriser l\'élimination des toxines et déchets.',
    'sources_alimentaires' => '',
    'synergies' => 'S\'articule avec les deux autres piliers naturopathiques : l\'alimentation et la gestion psycho-émotionnelle.',
    'notes' => '« Le mouvement, c\'est la vie. » (Andrew Still). Sources : OMS, Activité physique, 26 juin 2024 ; Anses, Actualisation des repères du PNNS - Révision des repères relatifs à l\'activité physique et à la sédentarité, 2016.',
  ),
  1 => 
  array (
    'categorie' => 'Activité physique - Fondamentaux',
    'nom' => 'Bénéfices de l\'activité physique sur les grands systèmes du corps',
    'partie_utilisee' => '',
    'description' => 'L\'activité physique a un impact démontré sur l\'ensemble des systèmes physiologiques du corps : cardiovasculaire, lymphatique, respiratoire, ostéo-articulaire, immunitaire, nerveux, digestif et tégumentaire.',
    'indication' => 'Accompagnement global en prévention, quel que soit le système ciblé en priorité par la demande du consultant.',
    'contre_indications' => '',
    'posologie' => '',
    'conseil_du_moment' => '',
    'proprietes' => 'Cardiovasculaire : relance la circulation sanguine ; augmente la santé cardiaque et la capacité à l\'effort ; augmente le cholestérol-HDL ; diminue le cholestérol-LDL, les triglycérides et la lipémie post-prandiale ; diminue la tension artérielle systolique et le risque d\'HTA ; diminue la fréquence cardiaque de repos et la vitesse de récupération ; diminue l\'agrégation plaquettaire (effet antithrombogène).
Lymphatique : relance la circulation de la lymphe ; augmente l\'élimination des déchets, virus et bactéries dans les tissus.
Respiratoire : augmente la capacité pulmonaire et la capacité maximale aérobie (VO2 max) ; augmente l\'oxygénation du corps et la quantité d\'air inspiré et utilisé.
Ostéo-articulaire : augmente la formation et la densité osseuse (ralentit la perte osseuse et les fractures ostéoporotiques) ; augmente l\'oxygénation des muscles et tissus ; augmente la force musculaire.
Immunitaire : immunostimulant (augmente les immunoglobulines) ; augmente les lymphocytes circulants et la sécrétion musculaire d\'interleukine 6 ; action anti-inflammatoire ; effet anti-tumoral (diminue le risque de cancer du côlon ou du sein) ; augmente les défenses contre les infections rhinopharyngées.
Nerveux : diminue l\'anxiété, le stress et le risque de dépression ; augmente la qualité du sommeil.
Digestif : favorise l\'absorption des nutriments ; augmente la motilité gastro-intestinale ; augmente la concentration et la diversité du microbiote ; augmente le butyrate (composé bénéfique au microbiote).
Tégumentaire : action vasodilatatrice cutanée ; augmente l\'hydratation cutanée et la structure de la peau.',
    'sources_alimentaires' => '',
    'synergies' => '',
    'notes' => 'Sources : Thierry Paillard, Effets physiologiques de l\'activité physique, 2016, ffhal-02360915 ; Frédéric Costes, Revue du Rhumatisme Monographies, 2021 ; FFAAIR, Les Bienfaits de l\'Activité physique ; Ribeiro FM et al., Front Nutr, 2021 ; Oizumi R et al., JMIR Dermatol, 2024.',
  ),
  2 => 
  array (
    'categorie' => 'Activité physique - Cycle féminin et hormones',
    'nom' => 'Activité physique et équilibre hormonal féminin (cycle et ménopause)',
    'partie_utilisee' => '',
    'description' => 'Effets d\'une activité physique modérée sur le cycle menstruel et sur la ménopause. Rappel : à chaque cycle, différentes étapes physiologiques préparent l\'organisme à une éventuelle fécondation. Deux cycles se coordonnent : le cycle ovarien (axe hypothalamus/hypophyse : GnRH, FSH, LH, mécanismes au niveau des ovaires) et le cycle utérin (phase proliférative sous l\'action des œstrogènes = reconstitution de l\'endomètre ; phase sécrétoire sous l\'action de la progestérone = vascularisation de l\'endomètre). Un cycle débute à J1 (1er jour des règles), durée moyenne de 28 jours (24 à 38 jours selon les femmes).',
    'indication' => 'Femmes en âge de procréer souhaitant soutenir l\'équilibre de leur cycle et leur fertilité.
Femmes ménopausées, pour la santé osseuse.',
    'contre_indications' => '',
    'posologie' => 'Activité physique modérée et régulière (l\'excès n\'est pas recherché).',
    'conseil_du_moment' => '',
    'proprietes' => 'Augmente le taux d\'hormones sexuelles féminines (œstradiol, FSH, LH), ce qui peut améliorer potentiellement la fertilité féminine et l\'équilibre du cycle.
Favorise une « détox hormonale » et diminue le stress et le taux de cortisol.
Diminue le risque d\'hyperoestrogénie relative et le syndrome prémenstruel (SPM).
À la ménopause : la baisse d\'œstradiol et de progestérone impacte l\'ossification ; l\'activité physique aide à augmenter la densité minérale osseuse.',
    'sources_alimentaires' => '',
    'synergies' => 'Alimentation et gestion du stress dans l\'équilibre hormonal global.',
    'notes' => 'Sources : S. Fendri, I. Kamel et al., Variation hormonale après exercice physique chez la femme en âge de procréation, Annales d\'Endocrinologie, 2022 ; Thierry Paillard, 2016.',
  ),
  3 => 
  array (
    'categorie' => 'Activité physique - Fondamentaux',
    'nom' => 'Groupes musculaires et effets de l\'activité physique',
    'partie_utilisee' => '',
    'description' => 'Un groupe musculaire est un ensemble de muscles du corps qui travaillent en collaboration pour des mouvements dont la fonctionnalité contribue à une même réponse physique ; ils sont fixés sur les mêmes articulations (ex : le bras = biceps brachial, triceps brachial). Principaux groupes : membres supérieurs/bras (biceps, triceps, fléchisseurs, extenseurs) ; épaules (deltoïdes, trapèzes, grand rond, coiffe des rotateurs) ; pectoraux (petit et grand pectoral) ; dos (muscles de la colonne vertébrale, trapèzes, dorsaux) ; paroi abdominale (transverses, obliques, grand droit) ; membres inférieurs (fessiers, abducteurs, adducteurs, ischio-jambiers, quadriceps, jumeaux).',
    'indication' => 'Orienter le choix d\'une activité physique en fonction des groupes musculaires à renforcer ou à ménager selon la pathologie ou l\'objectif du consultant.',
    'contre_indications' => '',
    'posologie' => '',
    'conseil_du_moment' => '',
    'proprietes' => 'Exercices « endurants » : augmentent la capillarité des fibres musculaires et la sensibilité à l\'insuline.
Exercices « résistants » : augmentent la masse et la force des groupes musculaires.
Chaque activité physique/sport développe et sollicite des muscles ciblés (ex : la course à pied sollicite notamment les fléchisseurs de la hanche).',
    'sources_alimentaires' => '',
    'synergies' => 'Complémentarité entre exercices d\'endurance et exercices de résistance selon l\'objectif visé.',
    'notes' => 'Sources : Thierry Paillard, 2016 ; Institut de Myologie ; schémas des sites planeteforme.club, espacefitness.ca, Nataswim.fr, sante-medecine.net, muscu-street-et-crossfit.fr.',
  ),
  4 => 
  array (
    'categorie' => 'Activité physique - Individualisation en consultation',
    'nom' => 'Individualiser l\'activité physique en consultation : cerner les besoins',
    'partie_utilisee' => '',
    'description' => 'L\'accompagnement individualisé répond aux 5 principes fondamentaux de la naturopathie et à la singularité de chaque consultant : nous sommes tous différents, y compris avec des tempéraments et constitutions similaires, du fait de différences liées à l\'histoire de vie, à l\'hérédité, au rythme de vie, à la gestion des émotions et à l\'hygiène de vie. L\'anamnèse est essentielle pour cerner précisément les besoins avant de proposer une activité physique adaptée.',
    'indication' => 'Informations essentielles à recueillir en consultation : l\'âge ; le type d\'activité professionnelle ; la demande/le besoin du consultant ; le tempérament ; l\'historique de la pratique sportive (passée et actuelle) ; les antécédents physiques ; le niveau de forme actuel ; la motivation et les envies ; les contraintes physiques actuelles ; le temps possible à allouer ; le budget ; les infrastructures à proximité ; l\'objectif de l\'activité physique en réponse à la demande.',
    'contre_indications' => '',
    'posologie' => 'Démarche en 3 étapes : définir les objectifs ensemble avec le consultant ; cibler les activités en fonction des objectifs (connaître de nombreux sports, les zones/groupes musculaires concernés et leurs effets sur les différents systèmes, les infrastructures/salles/parcs du secteur, des chaînes YouTube, coachs et livres ressources) ; construire un rétroplanning motivationnel en établissant AVEC le consultant les étapes et dates clés (méthodes motivationnelles).
Si une activité est déjà pratiquée : échanger sur la fréquence et la durée des séances et vérifier son adéquation à l\'individu et à sa problématique (ex : blessures répétitives sur la même zone, activité intensive en cas d\'infertilité, activités intensives/cardio le soir en cas de troubles du sommeil). Si elle semble peu adaptée : proposer une autre typologie de sport en complément ou remplacement (ex : yoga en complément de séances intensives), aménager l\'emploi du temps (ex : cardio le matin plutôt que le soir) ou aménager la pratique (ex : trail plutôt que course sur macadam en cas de problème de genou).',
    'conseil_du_moment' => '',
    'proprietes' => '',
    'sources_alimentaires' => '',
    'synergies' => '',
    'notes' => '',
  ),
  5 => 
  array (
    'categorie' => 'Activité physique - Individualisation en consultation',
    'nom' => 'Objectifs de consultation et choix d\'activité physique associés',
    'partie_utilisee' => '',
    'description' => 'Correspondance, à titre d\'exemples non exhaustifs, entre objectifs fréquents exprimés en consultation et types d\'activités physiques à cibler pour y répondre.',
    'indication' => 'Réduire le niveau de stress : yoga, qi gong, Pilates, marche dans la nature.
Prise de poids (développement musculaire) : musculation, crossfit.
Perte de poids (graisses) : cardio.
Troubles du cycle, problèmes circulatoires, problèmes respiratoires ou besoin de muscler des zones spécifiques : activité ciblée selon la zone et l\'objectif visé.',
    'contre_indications' => '',
    'posologie' => '',
    'conseil_du_moment' => '',
    'proprietes' => '',
    'sources_alimentaires' => '',
    'synergies' => '',
    'notes' => 'Liste non exhaustive, à adapter au cas par cas selon les besoins cernés du consultant.',
  ),
  6 => 
  array (
    'categorie' => 'Activité physique - Individualisation en consultation',
    'nom' => 'Tempéraments hippocratiques et choix d\'activité physique',
    'partie_utilisee' => '',
    'description' => 'Le tempérament donne de premières pistes de propositions d\'activité physique ; l\'identifier permet d\'orienter les recommandations les plus adaptées selon la morphologie, la constitution et le type de personnalité. Chacun possède les 4 tempéraments, avec un tempérament dominant plus ou moins tempéré par les autres.',
    'indication' => 'Lymphatique (Eau, dilaté) : natation, aquagym, marche, yoga.
Nerveux (Air, dilaté) : escalade, tir à l\'arc, golf, randonnée.
Sanguin (Feu) : sports en équipe (rugby, basket-ball), course à pied piste/vitesse, danse.
Bilieux (Terre, rétracté) : arts martiaux, tennis, trail, crossfit, pilates.',
    'contre_indications' => '',
    'posologie' => '',
    'conseil_du_moment' => '',
    'proprietes' => '',
    'sources_alimentaires' => '',
    'synergies' => '',
    'notes' => 'À noter : les tempéraments hippocratiques se basent sur la médecine hippocratique et il n\'existe pas de fondement scientifique actuel validant ces propos. Source : schéma de Céline Javanet, lasantedanslassiette.com.',
  ),
  7 => 
  array (
    'categorie' => 'Activité physique - Individualisation en consultation',
    'nom' => 'Prévention des risques lors de la reprise d\'une activité physique',
    'partie_utilisee' => '',
    'description' => 'Une activité physique mal adaptée, mal dosée ou mal équipée peut représenter en soi un risque pour le consultant. Vigilance sur les bonnes pratiques pour limiter le risque de blessures et/ou l\'apparition d\'autres problématiques, en particulier lors d\'une reprise.',
    'indication' => 'Toute reprise d\'activité physique, en particulier après une longue interruption ou en présence d\'antécédents de blessures.',
    'contre_indications' => 'Signaux de vigilance : surentraînement (ne pas tomber dans l\'excès), douleurs, fatigue excessive, stress et anxiété générés par la reprise (emploi du temps, performance).',
    'posologie' => 'Bonnes pratiques : consultation médicale en amont au besoin, selon les antécédents de blessures (actuels ou passés), ou avis d\'un autre spécialiste ; qualité et adaptation du matériel requis selon le sport (ex : chaussures neuves et adaptées, achetées en magasin spécialisé pour une reprise de course à pied) ; intensité et fréquence des séances progressives lors d\'une reprise (ex : ne pas passer de 3 km à 10 km en 2 semaines) ; échauffements et étirements systématiques pour réduire le risque de blessures ; adapter l\'alimentation et l\'hydratation à la dépense énergétique selon le sport pratiqué (ex : en-cas avant une séance d\'intensité modérée à élevée, augmentation des protéines le jour de la séance) ; être attentif aux signaux du corps.',
    'conseil_du_moment' => '',
    'proprietes' => '',
    'sources_alimentaires' => '',
    'synergies' => '',
    'notes' => '',
  ),
  8 => 
  array (
    'categorie' => 'Activité physique - Prévention et pathologies',
    'nom' => 'Activité physique et pathologies chroniques : recommandations par pathologie',
    'partie_utilisee' => '',
    'description' => 'Adapter l\'activité physique proposée en fonction de la ou des pathologies existantes et actuelles du consultant : pour une proposition adaptée, pour prendre en compte les contraintes physiques possibles, pour prioriser certaines actions si l\'agenda ne permet pas de tout mettre en place, et pour mettre en avant les bienfaits en rapport avec la pathologie (liste non exhaustive de pathologies).',
    'indication' => 'Maladies cardiovasculaires : jogging, avec consultation cardiologue et épreuve d\'effort en amont dans un contexte à risque, suivi de la symptomatologie puis augmentation progressive de l\'intensité selon la tolérance.
Diabète : musculation associée à une activité aérobie (mix aérobie/résistance : poids, appareils à contrepoids, bandes élastiques), objectif de réduction de la glycémie et du risque de mortalité cardiovasculaire, en augmentant force et endurance musculaires.
Fibromyalgie : activité physique régulière de type aérobie/endurance (natation, aquagym) pour diminuer l\'impact sur les articulations et les muscles à l\'effort ; renforcement musculaire et souplesse nécessaires (yoga, pilates) ; musculation selon les cas.
Endométriose : yoga, natation, marche — soulager la douleur, augmenter la circulation sanguine, diminuer le stress.
SOPK (syndrome des ovaires polykystiques) : marche, cyclisme, danse — soutenir la gestion de la glycémie et la stabilisation du poids si besoin.',
    'contre_indications' => 'Dans un contexte à risque (ex : maladie cardiovasculaire), une consultation avec un spécialiste (cardiologue) et une épreuve d\'effort sont nécessaires avant la reprise.',
    'posologie' => 'Toujours suivre la symptomatologie du consultant puis progresser dans l\'intensité en fonction de sa tolérance.',
    'conseil_du_moment' => '',
    'proprietes' => '',
    'sources_alimentaires' => '',
    'synergies' => '',
    'notes' => 'Liste non exhaustive. Sources : Fédération Française de Cardiologie ; Ronald J. Sigal et al., Activité physique et diabète, 2018 ; Busch A. et al., Exercise for treating fibromyalgia syndrome, Cochrane Database Syst Rev, 2002.',
  ),
  9 => 
  array (
    'categorie' => 'Activité physique - Cycle féminin et hormones',
    'nom' => 'Adapter l\'activité physique aux phases du cycle féminin',
    'partie_utilisee' => '',
    'description' => 'À chaque phase du cycle féminin, les niveaux hormonaux diffèrent et peuvent modifier l\'énergie, le niveau de performance et le risque de blessure.',
    'indication' => 'Menstruations (J1 à J6 environ, phase « hiver ») : chute hormonale et de certains neurotransmetteurs (dopamine, sérotonine) entraînant de la fatigue.
Phase folliculaire (J7 à J13 environ, phase « printemps ») : l\'énergie remonte, plus grande tolérance à la douleur, impact positif sur la masse musculaire.
Phase ovulatoire (J14 à J20 environ, phase « été ») : risque accru de blessures par relâchement des ligaments/tendons, hausse de la température corporelle.
Phase lutéale (J21 à J28 environ, phase « automne ») : baisse progressive de la vitalité, syndrome prémenstruel possible pour certaines femmes.',
    'contre_indications' => 'Phase ovulatoire : risque accru de blessures (relâchement ligamentaire/tendineux) et conditions parfois plus difficiles (hausse de température corporelle), nécessitant un échauffement soigné et de la vigilance face au risque d\'épuisement plus rapide.',
    'posologie' => 'Menstruations : privilégier une activité physique douce et des étirements ; bouger reste important.
Phase folliculaire : exercice physique intense, entraînement musculaire renforcé.
Phase ovulatoire : bien s\'échauffer avant l\'effort.
Phase lutéale : yoga, pilates, marche, activité de faible intensité.',
    'conseil_du_moment' => '',
    'proprietes' => '',
    'sources_alimentaires' => '',
    'synergies' => '',
    'notes' => '',
  ),
  10 => 
  array (
    'categorie' => 'Activité physique - Cycle féminin et hormones',
    'nom' => 'Activité physique à la ménopause et à l\'andropause',
    'partie_utilisee' => '',
    'description' => 'Recommandations d\'exercices modérés adaptés à la ménopause et à l\'andropause.',
    'indication' => 'Ménopause : atténuer les symptômes potentiels, améliorer l\'humeur, maintenir un poids de forme et la masse musculaire, prévention de l\'ostéoporose.
Andropause : favoriser la production d\'hormones androgènes, améliorer l\'humeur, maintenir la masse musculaire, préserver le capital ostéo-articulaire et soutenir la santé cardiovasculaire.',
    'contre_indications' => '',
    'posologie' => 'Exercices d\'intensité modérée.
Exemples pour la ménopause : renforcement musculaire.
Exemples pour l\'andropause : qi gong, musculation.',
    'conseil_du_moment' => '',
    'proprietes' => '',
    'sources_alimentaires' => '',
    'synergies' => '',
    'notes' => '',
  ),
  11 => 
  array (
    'categorie' => 'Activité physique - Individualisation en consultation',
    'nom' => 'Leviers et méthodes motivationnels pour la reprise d\'activité physique',
    'partie_utilisee' => '',
    'description' => '3 leviers motivationnels majeurs pour accompagner une reprise d\'activité physique : donner du sens (expliquer, en restant accessible, pourquoi et comment l\'activité physique aura des effets bénéfiques par rapport au besoin du consultant) ; fixer des objectifs individualisés (clairs et réalisables) ; planifier et assurer le suivi du consultant (établir AVEC lui les étapes et dates clés, définir un rythme de suivi, par exemple tous les 15 jours, avec un système d\'évaluation des progrès).',
    'indication' => 'Accompagnement de toute reprise ou instauration d\'une activité physique, en particulier en cas de manque de motivation ou de sédentarité importante.',
    'contre_indications' => '',
    'posologie' => 'Méthode SMART (Spécifique, Mesurable, Atteignable, Réaliste, Temporel) : ex. « Je vais marcher 30 minutes, trois fois par semaine sur les 15 prochains jours. »
N.E.A.T (Non-Exercise Activity Thermogenesis) : dépense énergétique de toutes les activités quotidiennes (marcher, jardiner, faire le ménage, taper sur un clavier, se lever) contribuant significativement à la dépense calorique ; exemples : se garer plus loin pour marcher davantage, marcher pendant un appel, prendre les escaliers plutôt que l\'ascenseur.
Journal de bord : consigner ses activités physiques (durée, rythme), ses ressentis, ses progrès éventuels, son hydratation et son alimentation spécifique.
Technique des petits pas : démarrer par de petites actions facilement atteignables pour ne pas se décourager, puis augmenter progressivement (ex. 10 min/jour pendant 2 semaines, puis 15 min/jour pendant 2 nouvelles semaines).
Micro-exercices ou micro-entraînements : intégrer dans la journée de petites périodes d\'exercices ciblés, faciles à mettre en place, pour redonner du mouvement à une journée trop sédentaire (ex : squats, quelques postures de yoga, étirements du dos/de la nuque).',
    'conseil_du_moment' => '',
    'proprietes' => '',
    'sources_alimentaires' => '',
    'synergies' => '',
    'notes' => '',
  ),
  12 => 
  array (
    'categorie' => 'Activité physique - Prévention et pathologies',
    'nom' => 'Sport et prévention : impact sur la santé et la longévité',
    'partie_utilisee' => '',
    'description' => 'L\'être humain est génétiquement sélectionné (fruit de plus de 300 000 ans d\'évolution) pour l\'endurance et la mobilité : peuple nomade et de marcheurs/marathoniens (30 à 50 km de migration par génération), doté d\'acquisitions génétiques majeures pour la mobilité (ligament nuchal, sudation, tendon d\'Achille) permettant la chasse à l\'épuisement. Le mode de vie moderne a profondément réduit l\'activité physique en à peine quelques siècles : constat mondial actuel, 31% de la population adulte mondiale inactive (moins de 150 min/semaine d\'exercice modéré), avec une augmentation de 5% par an, les femmes étant moins actives que les hommes, et 81% des adolescents (11-17 ans) inactifs ; en France, une étude (Pr Carré, CHU Rennes) sur 9000 élèves de 6ème montre que 3 enfants sur 5 ne savent pas enchaîner 4 sauts à cloche-pied et une perte de 1 km/h de VMA en 20-30 ans. L\'activité physique est aujourd\'hui une pierre angulaire de la santé publique, à introduire précocement.',
    'indication' => 'Prévention primaire et secondaire des cancers, des maladies cardiovasculaires et de la dépression.
Ralentissement du vieillissement cellulaire (action sénolytique).',
    'contre_indications' => '',
    'posologie' => 'Recommandation générale évoquée : oser au moins 2 heures d\'exercice physique par semaine.',
    'conseil_du_moment' => '',
    'proprietes' => 'Cancer : 15 à 30% de diminution de l\'incidence de cancer en population active ; 30 à 45% de réduction de la mortalité liée au cancer chez les personnes actives, y compris en cas de cancer déclaré ou en rémission (l\'activité physique est alors recommandée).
Maladies cardiovasculaires : baisse de la mortalité cardiovasculaire de 25 à 40% ; dans l\'insuffisance cardiaque, baisse des hospitalisations de 28% et de la mortalité de 35% ; diminution majeure de la progression des plaques d\'athérome dans la maladie coronaire ; incidence du diabète diminuée de 58% par amélioration de la réponse à l\'insuline ; baisse moyenne de la pression artérielle systolique de 5 à 7 mmHg ; baisse du LDL-cholestérol de 0,3 à 1,0 g/L. Aucun médicament ne fait mieux que le sport, en prévention primaire ou secondaire cardiovasculaire.
Syndrome dépressif : plus l\'exercice est régulier et intense, plus la réponse thérapeutique est forte, avec une efficacité supérieure aux traitements dans une approche globale (méta-analyse rassemblant plus de 200 études).
Vieillissement cellulaire : action sénolytique (anti-sénescence), limitant l\'accumulation de cellules sénescentes liée au temps (attrition télomérique), aux agressions (UV, traitements) et à l\'épigénétique (obésité, sédentarité).',
    'sources_alimentaires' => '',
    'synergies' => '',
    'notes' => 'Source : Dr Thomas d\'Humières, cardiologue-physiologiste, CHU Henri Mondor, PhD/Post-Doc Biologie Cellulaire, Inserm.',
  ),
  13 => 
  array (
    'categorie' => 'Activité physique - Cas pratiques',
    'nom' => 'Accompagnement de la femme sportive : post-partum, désir de grossesse et SOPK',
    'partie_utilisee' => '',
    'description' => 'Cas pratique d\'une consultante de 28 ans, sportive de haut niveau amateur (trail, vélo, natation/triathlon avant sa grossesse), 1 an post-partum et allaitante encore un peu, souhaitant reprendre le trail en vue d\'un objectif marathon. Présente un syndrome de l\'essuie-glace (tendinopathie du TFL, tenseur du fascia lata, avec inflammation de la bandelette ilio-tibiale et douleurs à l\'effort en face latérale du genou), des céphalées à l\'effort (douleurs remontant des cervicales/occiput vers la tête), un SOPK diagnostiqué à 16 ans et une absence de retour de couches depuis 1 an, dans un contexte de désir d\'un 2ème enfant.',
    'indication' => 'Femmes sportives en post-partum/allaitement souhaitant reprendre un entraînement intensif, avec antécédents de SOPK, désir de grossesse, douleurs ostéo-articulaires liées à la pratique (TFL) et céphalées à l\'effort.',
    'contre_indications' => 'Facteurs de risque/causes probables identifiés : reprise sportive trop brutale après un long arrêt, manque d\'échauffement, chaussures inadaptées, alimentation trop acide et pro-inflammatoire, déshydratation, manque de sommeil, stress, terrain allergique, consommation de café importante (acidification).',
    'posologie' => 'Axes de travail : réduire l\'inflammation (alimentation, stress), soulager les douleurs et maux à l\'effort, travailler l\'hyperperméabilité intestinale, combler les carences potentielles.
Entraînement : progression prudente de l\'allongement des distances, renforcement musculaire environ 2 fois/semaine ciblant abducteurs de la hanche, fessiers et dos ; étirements quotidiens de la nuque/haut du dos et des jambes (quadriceps, TFL, fessiers) ; massage du TFL à la balle en caoutchouc ferme (10 à 12 répétitions, pression progressive, abdominaux gainés).
Alimentation : 4 prises alimentaires/jour en période d\'entraînement (3 repas + 1 collation), mastication accrue, restructuration des apports en protéines (2 portions/jour), collation avant le sport, arrêt des produits laitiers, limitation des produits sucrés, huiles riches en oméga-3 (lin, colza, noix), épices favorisant la gestion de la glycémie (vinaigre de cidre, ortie en poudre).
Hydratation : environ 1,5 L d\'eau plate/jour (eau faiblement minéralisée), boire régulièrement toutes les 15 min à l\'effort (minimum 500 mL/h d\'entraînement), électrolytes si besoin ; calcul post-effort : (poids avant l\'effort - poids après l\'effort) x 1,5 = quantité à boire.
Aromathérapie : pour la tendinite, 3 gouttes HE Gaulthérie couchée dans 1 c. à s. d\'HV Calophylle, en massage 3 fois/jour, associé à un cataplasme d\'argile verte la nuit.
Phytothérapie : Ortie piquante (LPEV), 5 mL dilués dans un verre d\'eau matin et soir avant repas, pendant 3 semaines, à renouveler si besoin.
Compléments alimentaires évoqués : Vitamine D3/K2 (3 gouttes/jour), Magnésium B6 (3 gélules/jour), Oméga 3 EPA/DHA vegan (2 gélules/jour).',
    'conseil_du_moment' => '',
    'proprietes' => '',
    'sources_alimentaires' => '',
    'synergies' => 'Alimentation, hydratation, étirements, respiration, aromathérapie, phytothérapie ; orientation complémentaire vers bilan sanguin et hormonal (magnésium, zinc, vitamine D, vitamines du groupe B, ferritine, statut en acides gras, FSH/LH/progestérone/TSH) auprès du médecin traitant et du gynécologue.',
    'notes' => 'Le (la) naturopathe ne fait pas de diagnostic ni de pronostic et ne se substitue pas à une consultation médicale (suivi médecin traitant, podologue, ostéopathe, dentiste dans ce cas).',
  ),
  14 => 
  array (
    'categorie' => 'Activité physique - Cas pratiques',
    'nom' => 'Accompagnement de la femme active : dépression, perte de poids et rééquilibrage alimentaire',
    'partie_utilisee' => '',
    'description' => 'Cas pratique d\'une consultante de 46 ans, cadre à temps complet, pratiquant la danse (modern jazz) reprise depuis 2 ans mais interrompue depuis 2 mois par manque d\'énergie et de motivation, marchant 30 min 3 fois par semaine. Traverse une phase dépressive (traitement antidépresseur depuis quelques mois, traumatismes vécus dans l\'enfance), avec un historique de régimes restrictifs efficaces à court terme mais non tenables dans la durée. Souhaite se réconcilier avec l\'alimentation et son corps plutôt que de se focaliser sur le chiffre de la balance.',
    'indication' => 'Femmes en période dépressive et/ou en sortie de régimes restrictifs, avec sédentarité relative et souhait de reprendre une activité physique en douceur en lien avec le bien-être mental et le rapport au corps.',
    'contre_indications' => 'Reprise à mener progressivement, sans objectifs trop ambitieux ; traitement antidépresseur en cours à prendre en compte ; traumatismes de l\'enfance pouvant justifier un accompagnement psychologique complémentaire.',
    'posologie' => 'Axes de travail : réduire l\'inflammation, travailler la gestion des émotions, travailler l\'hyperperméabilité intestinale, combler les carences potentielles.
Entraînement : maintien de la marche 3 fois/semaine, reprise progressive de la danse 1 fois/semaine, reprise de la course à pied en fractionné marche/course (viser 2 fois/semaine, s\'équiper de bonnes chaussures), renforcement musculaire environ 2 fois/semaine ciblant quadriceps, ischio-jambiers et fessiers pour limiter le risque au genou (syndrome fémoro-patellaire, vigilance au syndrome de la fesse morte), étirements réguliers des jambes et fessiers.
Méthodes motivationnelles : méthode SMART, journal de bord (activités, ressentis, progrès, hydratation, alimentation).
Alimentation : rééquilibrage de l\'assiette (moitié légumes), apports en acides gras (huiles vierges de lin/colza/noix), glucides à index glycémique bas, limitation des produits laitiers de vache (privilégier chèvre/brebis) et des produits sucrés, alternance petit-déjeuner sucré/salé, épices comme le curcuma (anti-inflammatoire) et la cannelle (envies de sucre).
Hydratation : progression vers 1 L d\'eau plate/jour (eau faiblement minéralisée).
Gestion du stress : respiration yogique complète, 5 à 10 min, allongée sur le dos.
Aromathérapie : détente du plexus nerveux, 2 gouttes HE Lavande vraie dans 1 c. à s. d\'HV Jojoba, en massage 1 fois/jour le soir sur le plexus.
Phytothérapie : Mélisse (2/3) + Chardon Marie (1/3) LPEV, 5 mL dilués dans un verre d\'eau matin et soir avant repas, pendant 3 semaines.
Compléments alimentaires évoqués : Vitamine D3/K2 (3 gouttes/jour), Magnésium B6 (3 gélules/jour), Oméga 3 EPA/DHA vegan (3 gélules/jour).',
    'conseil_du_moment' => '',
    'proprietes' => '',
    'sources_alimentaires' => '',
    'synergies' => 'Alimentation, hydratation, respiration/gestion du stress, aromathérapie, phytothérapie, suivi psychologique complémentaire si besoin ; orientation vers bilan sanguin (magnésium, zinc, vitamine D, vitamines du groupe B, ferritine, statut en acides gras, bilan thyroïdien) auprès du médecin traitant.',
    'notes' => 'Le (la) naturopathe ne fait pas de diagnostic ni de pronostic, ne se substitue pas au suivi médical/psychologique en cours et ne demande jamais d\'interrompre un traitement médical (ici, le traitement antidépresseur).',
  ),
);
}

function ressourcesCreerTable(PDO $db): void {
    $db->exec("CREATE TABLE IF NOT EXISTS ressources (
        id INT AUTO_INCREMENT PRIMARY KEY,
        section VARCHAR(50) NOT NULL,
        categorie VARCHAR(150) NOT NULL,
        nom VARCHAR(200) NOT NULL,
        partie_utilisee VARCHAR(200),
        description TEXT,
        indication TEXT,
        contre_indications TEXT,
        posologie TEXT,
        conseil_du_moment TEXT,
        proprietes TEXT,
        sources_alimentaires TEXT,
        synergies TEXT,
        notes TEXT,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        INDEX idx_section (section)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

    // Nettoyage de doublons existants (section + nom identiques, ex: déploiements
    // lancés en double avant la mise en place de la contrainte d'unicité
    // ci-dessous) : ne garde que la ligne la plus ancienne (id le plus bas).
    $db->exec("DELETE r1 FROM ressources r1
        INNER JOIN ressources r2
        WHERE r1.section = r2.section AND r1.nom = r2.nom AND r1.id > r2.id");

    // Empêche toute future duplication (double clic, double déploiement...).
    try {
        $db->exec("ALTER TABLE ressources ADD UNIQUE KEY uniq_section_nom (section, nom)");
    } catch (PDOException $e) {
        // La contrainte existe déjà (Duplicate key name) : rien à faire.
    }
}

/**
 * Synchronise une section de ressources : crée la table si besoin, insère les
 * fiches manquantes et met à jour celles déjà présentes (comparaison par
 * section + nom).
 * @return array{inserted: string[], updated: string[]}
 */
function syncRessourcesSection(PDO $db, string $section, array $items): array {
    ressourcesCreerTable($db);

    $existingStmt = $db->prepare("SELECT id, nom FROM ressources WHERE section = ?");
    $existingStmt->execute([$section]);
    $existingByNom = [];
    foreach ($existingStmt->fetchAll() as $row) {
        $existingByNom[mb_strtolower($row['nom'])] = $row['id'];
    }

    $insertStmt = $db->prepare("INSERT INTO ressources (section, categorie, nom, partie_utilisee, description, indication, contre_indications, posologie, conseil_du_moment, proprietes, sources_alimentaires, synergies, notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $updateStmt = $db->prepare("UPDATE ressources SET categorie = ?, partie_utilisee = ?, description = ?, indication = ?, contre_indications = ?, posologie = ?, conseil_du_moment = ?, proprietes = ?, sources_alimentaires = ?, synergies = ?, notes = ? WHERE id = ?");

    $inserted = [];
    $updated = [];
    foreach ($items as $it) {
        $it += ['partie_utilisee' => '', 'description' => '', 'indication' => '', 'contre_indications' => '', 'posologie' => '', 'conseil_du_moment' => '', 'proprietes' => '', 'sources_alimentaires' => '', 'synergies' => '', 'notes' => ''];
        $key = mb_strtolower($it['nom']);
        if (isset($existingByNom[$key])) {
            $updateStmt->execute([
                $it['categorie'], $it['partie_utilisee'], $it['description'], $it['indication'],
                $it['contre_indications'], $it['posologie'], $it['conseil_du_moment'], $it['proprietes'],
                $it['sources_alimentaires'], $it['synergies'], $it['notes'], $existingByNom[$key],
            ]);
            $updated[] = $it['nom'];
        } else {
            $insertStmt->execute([
                $section, $it['categorie'], $it['nom'], $it['partie_utilisee'], $it['description'], $it['indication'],
                $it['contre_indications'], $it['posologie'], $it['conseil_du_moment'], $it['proprietes'],
                $it['sources_alimentaires'], $it['synergies'], $it['notes'],
            ]);
            $inserted[] = $it['nom'];
        }
    }

    return ['inserted' => $inserted, 'updated' => $updated];
}

/**
 * Synchronise toutes les sections de ressources actuellement disponibles.
 * @return array{inserted: string[], updated: string[]}
 */
function syncRessources(PDO $db): array {
    $totalInserted = [];
    $totalUpdated = [];

    $sections = [
        'phytologie' => getRessourcesPhytologie(),
        'aromatologie' => getRessourcesAromatologie(),
        'hydrologie' => getRessourcesHydrologie(),
        'alimentation' => getRessourcesAlimentation(),
        'micronutrition' => getRessourcesMicronutrition(),
        'stress' => getRessourcesStress(),
        'mycotherapie' => getRessourcesMycotherapie(),
        'activite_physique' => getRessourcesActivitePhysique(),
    ];

    foreach ($sections as $section => $items) {
        if (empty($items)) continue;
        $result = syncRessourcesSection($db, $section, $items);
        $totalInserted = array_merge($totalInserted, $result['inserted']);
        $totalUpdated = array_merge($totalUpdated, $result['updated']);
    }

    return ['inserted' => $totalInserted, 'updated' => $totalUpdated];
}
