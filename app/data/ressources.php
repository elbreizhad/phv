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
            'indication' => "Hypotenseur majeur : vasodilatateur + diurétique\nHypocholestérolémiant : ↓ LDL ↑ HDL (protecteur)\nCardioprotecteur : nourrit et protège le muscle cardiaque\nAnti-athérogène : prévention athérosclérose\nArythmies légères, tachycardie, extrasystoles\nPrévention risque d'infarctus (à associer à l'aubépine)",
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
    ];

    foreach ($sections as $section => $items) {
        if (empty($items)) continue;
        $result = syncRessourcesSection($db, $section, $items);
        $totalInserted = array_merge($totalInserted, $result['inserted']);
        $totalUpdated = array_merge($totalUpdated, $result['updated']);
    }

    return ['inserted' => $totalInserted, 'updated' => $totalUpdated];
}
