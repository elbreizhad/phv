<?php
/**
 * Bibliothèque de protocoles naturopathiques prêts à l'emploi.
 *
 * Contenu construit à partir de fiches de cours réelles (ESN — École de Santé
 * Naturelle) : protocole 4R & détoxication hépatique, SIBO, candidose,
 * microbiote, arrêt du sucre, perturbateurs endocriniens, mycothérapie,
 * maladies neurodégénératives. Les posologies indiquées reprennent celles
 * citées dans les fiches sources ; lorsque la source reste générale, la
 * posologie proposée ici reste volontairement générale (pas d'invention de
 * dosage précis).
 *
 * Rappel déontologique repris des sources : ces protocoles sont des outils de
 * réflexion clinique pour le praticien, à individualiser. Ils s'inscrivent en
 * complément du suivi médical, jamais en substitution.
 */

function getProtocolesTypes(): array {
    return [

        // 1. ------------------------------------------------------------------
        [
            'nom' => '4R digestif complet (Retirer - Réparer - Remplacer - Réinoculer)',
            'type_protocole' => 'digestif',
            'duree_jours' => 151,
            'description' => "Protocole issu du modèle 5R de l'Institute for Functional Medicine (Jeffrey Bland, années 1990), simplifié en 4R. L'ordre retenu ici — Retirer, Réparer, Remplacer, Réinoculer — correspond aux terrains naturopathiques les plus fréquents (inflammation, hyperperméabilité, MICI en rémission, SII chronique) : on apaise et on répare la muqueuse avant de stimuler la digestion et de réensemencer, car sur une muqueuse très inflammatoire les probiotiques et les stimulants digestifs peuvent aggraver le tableau. La variante IFM originale (Retirer-Remplacer-Réinoculer-Réparer) reste pertinente pour une dysbiose simple sans inflammation marquée.",
            'objectifs' => "Stopper l'agression de la muqueuse intestinale (irritants alimentaires, infectieux, environnementaux). Restaurer l'intégrité épithéliale, le mucus et les jonctions serrées. Soutenir la digestion luminale (enzymes, HCl, bile) pour limiter les antigènes non digérés. Réensemencer un microbiote diversifié et fonctionnel.",
            'phases' => [
                ['nom' => 'Retirer', 'duree' => 25, 'description' => "Régime d'éviction ciblé (gluten, produits laitiers, FODMAPs si SII). Réduction des sucres rapides, de l'alcool, des ultra-transformés et des additifs émulsifiants (E466, E433...). Réduction des AINS, IPP, anti-H2 si possible (avis médical). Diminution de la viande rouge et des graisses saturées/trans."],
                ['nom' => 'Réparer', 'duree' => 63, 'description' => "Bouillons d'os longue cuisson, légumes cuits riches en polyphénols, poissons gras 3x/semaine. Compléments ciblés selon le mécanisme dominant (inflammation, hyperperméabilité, atrophie muqueuse ou stress oxydant) : on choisit 2 à 4 compléments, jamais toute la liste."],
                ['nom' => 'Remplacer', 'duree' => 21, 'description' => "Soutien de la digestion luminale : mastication renforcée, vinaigre de cidre ou citron en début de repas si hypochlorhydrie suspectée, amers avant repas (artichaut, pissenlit, gentiane), repas au calme sans écran."],
                ['nom' => 'Réinoculer', 'duree' => 42, 'description' => "Réintroduction progressive des aliments fermentés (kéfir, kombucha, légumes lacto-fermentés) et des prébiotiques (oignon, ail cuit, poireau, asperge, topinambour, banane verte). Viser 30 aliments végétaux différents par semaine."],
            ],
            'complements' => [
                ['nom' => 'Curcumine bio-disponible (formulation type BCM-95, Meriva, Theracurmin)', 'posologie' => '1500 à 3000 mg/j (preuve la plus solide en phase Réparer, notamment inflammation type RCH)', 'duree' => 'Phase Réparer, 6 à 12 semaines'],
                ['nom' => 'N-Butyrate microencapsulé', 'posologie' => '150 à 1200 mg/j', 'duree' => 'Phase Réparer, en particulier si terrain inflammatoire type MICI'],
                ['nom' => 'Oméga-3 EPA/DHA (ratio EPA dominant en contexte inflammatoire)', 'posologie' => '2 à 3 g/j', 'duree' => 'Phase Réparer'],
                ['nom' => 'Zinc-carnosine', 'posologie' => '75 mg x2/j', 'duree' => 'Phase Réparer si hyperperméabilité documentée'],
                ['nom' => 'L-Glutamine', 'posologie' => "10 à 15 g/j à jeun (les doses naturopathiques classiques de 3 à 5 g sont probablement sous-optimales ; l'effet sur la perméabilité n'est retrouvé qu'à dose élevée) ; à éviter en cas de SIBO actif", 'duree' => 'Cure courte de 4 à 6 semaines'],
                ['nom' => 'Enzymes digestives (pancréatine, bromélaïne, papaïne) et/ou bétaïne HCl', 'posologie' => 'Selon produit, à individualiser après test d\'hypochlorhydrie', 'duree' => 'Phase Remplacer, 2 à 4 semaines'],
                ['nom' => 'Probiotiques multi-souches (Lactobacillus + Bifidobacterium)', 'posologie' => '≥ 10 milliards UFC/j', 'duree' => 'Phase Réinoculer, 4 à 8 semaines'],
                ['nom' => 'Prébiotiques (FOS, GOS, inuline)', 'posologie' => 'Introduction progressive pour limiter les ballonnements', 'duree' => 'Phase Réinoculer'],
            ],
            'alimentation' => "Éviction ciblée puis réintroduction progressive et diversifiée (objectif 30 végétaux différents/semaine). Bouillons d'os, légumes cuits riches en polyphénols (myrtille, grenade), poissons gras. Aliments fermentés en phase finale (kéfir, kombucha, légumes lacto-fermentés). Mastication et repas au calme.",
            'contre_indications' => "En MICI en poussée : pas de détox formelle, pas de prébiotiques fermentescibles, différer les amers et la phyto cholérétique. Glutamine à éviter ou à limiter en cas de SIBO actif. Toute éviction alimentaire prolongée ou tout arrêt d'IPP/AINS doit rester coordonné avec le médecin traitant. Ce protocole ne se substitue pas au suivi médical d'une MICI ou d'un SII diagnostiqué.",
        ],

        // 2. ------------------------------------------------------------------
        [
            'nom' => 'Détoxication hépatique ciblée en 3 phases',
            'type_protocole' => 'detox',
            'duree_jours' => 35,
            'description' => "La détoxication hépatique n'est pas un rituel saisonnier systématique : le foie détoxifie en continu et ne se \"vide\" pas. Ce protocole ne s'engage que sur signe d'appel réel (bilan hépatique modérément altéré, charge xénobiotique avérée, polymédication chronique, signes cliniques évocateurs comme fatigue post-prandiale ou migraines hépatiques, MICI en rémission stable, ou préparation à un changement métabolique). La règle d'or est de toujours soutenir la phase 2 (conjugaison) avant de stimuler la phase 1 (transformation), sous peine de \"bottleneck\" métabolique et de crise de détox.",
            'objectifs' => "Soutenir dans l'ordre les 3 étapes de la détoxication hépatique : transformation (cytochromes P450), conjugaison (sulfatation, glucuronoconjugaison, glutathion) et élimination (voies biliaire, rénale, cutanée) sans créer d'accumulation de métabolites réactifs.",
            'phases' => [
                ['nom' => 'Transformation (phase 1 hépatique)', 'duree' => 10, 'description' => "Chargement préalable en cofacteurs de phase 2 pendant 7 à 10 jours avant de stimuler franchement la phase 1. Cofacteurs : vitamines B2, B3, B6, B9, B12, magnésium, vitamines C et E, NAC. Plantes inductrices douces : romarin, schisandra, brocoli/sulforaphane, curcuma."],
                ['nom' => 'Conjugaison (phase 2 hépatique)', 'duree' => 14, 'description' => "Phase la plus exigeante, à ne jamais sous-supporter : glycine, taurine, glutamine, MSM, méthionine/choline, zinc, sélénium, B6/B9 sous forme méthylée. Plantes : chardon-Marie (silymarine), artichaut, desmodium."],
                ['nom' => 'Élimination', 'duree' => 14, 'description' => "Doit être active dès le début du protocole (transit, diurèse, microbiote). Fibres solubles et insolubles, hydratation 1,5 à 2 L/j, magnésium, probiotiques (régulation de la bêta-glucuronidase). Cholérétiques (artichaut, romarin, curcuma) et cholagogues (radis noir, boldo, pissenlit) ; drainage rénal (ortie, bouleau, reine-des-prés)."],
            ],
            'complements' => [
                ['nom' => 'NAC (N-acétyl-cystéine)', 'posologie' => '600 mg/j', 'duree' => 'Phase Transformation, en chargement préalable'],
                ['nom' => 'Curcuma biodisponible', 'posologie' => 'Selon formulation (type BCM-95)', 'duree' => 'Phase Transformation, à introduire après le chargement en cofacteurs de phase 2'],
                ['nom' => 'Glycine et taurine', 'posologie' => 'Selon produit, en poudre', 'duree' => 'Phase Conjugaison'],
                ['nom' => 'Chardon-Marie (silymarine)', 'posologie' => 'Selon extrait standardisé (niveau de preuve élevé sur ALAT/ASAT en stéatose hépatique)', 'duree' => 'Phase Conjugaison, 2 à 4 semaines'],
                ['nom' => 'Psyllium blond', 'posologie' => 'Selon tolérance, avec hydratation abondante', 'duree' => 'Phase Élimination'],
                ['nom' => 'Magnésium bisglycinate', 'posologie' => 'Selon produit', 'duree' => 'Phase Élimination, soutien du transit et de la diurèse'],
                ['nom' => 'Probiotiques multi-souches', 'posologie' => 'Selon produit', 'duree' => 'Phase Élimination, en soutien de la non-réabsorption des toxines'],
            ],
            'alimentation' => "Hydratation 1,5 à 2 L/j dès le début. Aliments riches en soufre (ail, oignon, brocoli, choux) pour la conjugaison. Aliments riches en polyphénols en soutien de la phase 1. Fibres solubles et insolubles pour l'élimination.",
            'contre_indications' => "Contre-indications absolues : obstruction biliaire ou lithiase vésiculaire symptomatique (aucun cholérétique-cholagogue), insuffisance hépatique sévère ou cirrhose décompensée, hépatite aiguë évolutive, grossesse et allaitement (prudence avec la majorité des plantes hépatiques), pathologie oncologique en cours sans accord de l'oncologue, MICI en poussée (différer jusqu'à rémission stable). Prudence sous anticoagulants (curcuma antiagrégant). Signal d'alerte à l'arrêt immédiat : constipation pendant la cure (les toxines reconjuguées sont réabsorbées) ou maux de tête/nausées persistants en phase 1 isolée (signe que la phase 2 ne suit pas). Durée totale à ne jamais prolonger en continu sur l'année (3 à 6 semaines maximum par cure).",
        ],

        // 3. ------------------------------------------------------------------
        [
            'nom' => 'SIBO / IMO - approche naturopathique en double temps',
            'type_protocole' => 'digestif',
            'duree_jours' => 90,
            'description' => "Le SIBO (Small Intestinal Bacterial Overgrowth) est une prolifération anormale de bactéries dans l'intestin grêle, normalement peu colonisé ; l'IMO (Intestinal Methanogen Overgrowth) désigne la prolifération d'archées méthanogènes (Methanobrevibacter smithii), souvent associée. Le SIBO représente environ 40% des SII. Diagnostic de référence : test respiratoire (H2 > 20 ppm ou CH4 > 12 ppm dans les 120 premières minutes après ingestion de glucose/lactulose).",
            'objectifs' => "Diminuer la prolifération bactérienne et les symptômes à court terme, puis identifier et corriger la ou les causes profondes (digestion affaiblie, trouble de la motricité, trouble immunitaire, trouble mécanique, dysfonction de l'axe intestin-cerveau) pour prévenir la récidive.",
            'phases' => [
                ['nom' => 'Court terme - approche symptomatique', 'duree' => 30, 'description' => "Diminution/exclusion des glucides fermentescibles (FODMAPs, amidons résistants). Substances bactéricides ciblées selon le gaz dominant : contre l'hydrogène (berbérine, origan), contre le méthane (allicine, origan, neem). Approche enzymatique en gélules non gastro-résistantes (HPMC) pour une action dès l'estomac. Prokinétiques digestifs (carvi, fenouil, gingembre) pour réguler le transit."],
                ['nom' => 'Moyen terme - approche préventive', 'duree' => 60, 'description' => "Consolidation des prokinétiques et régulation du transit. Réintroduction très progressive des FODMAPs. Poursuite de l'approche enzymatique en cas de repas plus riches, sans devenir dépendant (les enzymes agissent localement dans l'estomac, sans passer par le sang)."],
                ['nom' => 'Long terme - approche causaliste', 'duree' => 90, 'description' => "Restauration des sécrétions digestives (HCl, enzymes, bile), de la muqueuse et de l'immunité. Travail sur les axes extra-digestifs : thyroïde, nerf vague, stress chronique, hormones sexuelles. Identification précise de la cause via anamnèse et analyses complémentaires."],
            ],
            'complements' => [
                ['nom' => 'Berbérine', 'posologie' => 'Jusqu\'à 400 mg/j selon les protocoles (certains praticiens montent à 1-2 g en phase d\'attaque, avec prudence) - attention effet hypoglycémiant', 'duree' => 'Phase court terme, 1 à 3 mois maximum'],
                ['nom' => 'Huile essentielle d\'origan / allicine (ail) / neem', 'posologie' => 'Selon produit, gélules HPMC (non gastro-résistantes) pour une action dès l\'estomac', 'duree' => 'Phase court terme'],
                ['nom' => 'Prokinétiques digestifs (carvi, fenouil, gingembre)', 'posologie' => 'Artichaut : viser au moins 20 mg de cynarine (~1,5 artichaut) ; gingembre : viser 15 mg de gingérol', 'duree' => 'Phase court et moyen terme'],
                ['nom' => 'Enzymes digestives ciblées (lactase, alpha-galactosidase, etc. selon les FODMAPs mal tolérés)', 'posologie' => 'À la demande, avant les repas à risque', 'duree' => 'Continu ou ponctuel'],
                ['nom' => 'Soutien de la muqueuse (protéines animales riches en vitamine A, zinc, oméga-3, glutamine)', 'posologie' => 'Selon anamnèse alimentaire', 'duree' => 'Phase moyen et long terme'],
            ],
            'alimentation' => "Diminution ciblée des glucides fermentescibles (FODMAPs, amidons résistants, fruits pris en fin de repas) en phase aiguë, sans maintenir ce régime restrictif sur le long terme (perte de diversité bactérienne). Réintroduction progressive et guidée.",
            'contre_indications' => "Berbérine contre-indiquée en cas de grossesse, d'allaitement, et en association avec des statines ou de la metformine sans avis médical (risque hypoglycémiant). Le test respiratoire et le diagnostic différentiel avec le SII, l'hypothyroïdie ou une intolérance doivent être posés avant tout protocole. Ce protocole accompagne mais ne remplace pas la prise en charge médicale d'un SIBO documenté.",
        ],

        // 4. ------------------------------------------------------------------
        [
            'nom' => 'Candidose digestive - double approche antifongique et causaliste',
            'type_protocole' => 'digestif',
            'duree_jours' => 150,
            'description' => "Le Candida albicans est un champignon commensal du tractus digestif qui, dans certaines circonstances (alimentation riche en sucres raffinés, antibiothérapies répétées, déficience immunitaire, déséquilibre hormonal, rupture de l'axe intestin-cerveau), passe de sa forme levure inoffensive à une forme moisissure/mycélienne virulente capable de traverser la muqueuse. Le test de la salive au verre d'eau n'est pas fiable : privilégier un diagnostic différentiel rigoureux (MOU/DMI, sérologie anti-Candida).",
            'objectifs' => "Réduire la prolifération fongique et les symptômes à court terme (1 à 3 mois), puis traiter la cause profonde à long terme (plus de 6 mois) : rétablir l'axe intestin-cerveau, corriger les carences, gérer l'hypochlorhydrie et modifier l'hygiène de vie.",
            'phases' => [
                ['nom' => 'Antifongique et antibiofilm', 'duree' => 60, 'description' => "Réduction franche des sucres rapides et farines raffinées (sans hyper-restriction seule, insuffisante). Antifongiques naturels (à base d'huile essentielle d'origan notamment) et complexe antibiofilm (les bactéries/levures du SIBO et de la candidose s'entourent d'un biofilm protecteur). Gestion de l'hypochlorhydrie sous-jacente : plantes et aliments amers (gentiane, endives, roquette)."],
                ['nom' => 'Rééquilibrage du terrain et de l\'axe intestin-cerveau', 'duree' => 90, 'description' => "Correction des carences associées (fer, B12, vitamine D, zinc selon bilan). Travail sur le tonus vagal et le stress chronique (respiration, cohérence cardiaque, psychothérapie si besoin) : le stress chronique élève le cortisol, ce qui crée un contexte hyperglycémiant favorable au Candida et inhibe le système parasympathique."],
            ],
            'complements' => [
                ['nom' => 'Antifongique naturel à base d\'huile essentielle d\'origan', 'posologie' => 'Selon produit, cure de 2 mois, dernière prise au coucher', 'duree' => '2 mois'],
                ['nom' => 'Complexe antibiofilm enzymatique', 'posologie' => 'Selon produit, à jeun matin et coucher', 'duree' => '2 mois'],
                ['nom' => 'Magnésium biodisponible (citrate, glycérophosphate, bisglycinate)', 'posologie' => '≥ 300 mg/j (éviter le magnésium marin, moins bien assimilé)', 'duree' => 'Phase 2, en continu'],
                ['nom' => 'Probiotiques compétiteurs du Candida (Saccharomyces boulardii, Lactobacillus rhamnosus, L. acidophilus)', 'posologie' => 'Selon produit', 'duree' => 'Phase 2'],
            ],
            'alimentation' => "Régime pauvre en sucres rapides et en farines raffinées, sans hyper-restriction isolée. Régime méditerranéen en base. Attention aux boissons fermentées (kombucha, kéfir) et à l'alcool en cas d'intolérance à l'histamine associée.",
            'contre_indications' => "Toujours traiter l'intestin en priorité par rapport à une candidose vaginale associée. Le diagnostic par test salivaire seul n'est pas fiable et expose à une errance diagnostique (toujours croiser avec un bilan thyroïdien, une NFS et un bilan martial, car de nombreux symptômes se recoupent avec une hypothyroïdie). Prudence en cas de douleurs gastriques : privilégier l'antibiofilm à un antifongique acide qui peut irriter l'estomac.",
        ],

        // 5. ------------------------------------------------------------------
        [
            'nom' => 'Arrêt du sucre et stabilisation glycémique',
            'type_protocole' => 'poids',
            'duree_jours' => 60,
            'description' => "L'excès de sucre entretient un cercle vicieux : pic glycémique, hyperinsulinisme réactionnel, hypoglycémie, fringale, stockage graisseux, résistance à l'insuline puis à la leptine. Ce protocole vise une déshabituation progressive plutôt qu'une restriction brutale (risque de trouble du comportement alimentaire), en travaillant la chrononutrition, l'hygiène de vie et une supplémentation adaptée au terrain (insulinorésistance, inflammation).",
            'objectifs' => "Diminuer progressivement les sucres simples et raffinés. Réduire les compulsions en structurant les repas (davantage de fibres et de protéines). Stabiliser la glycémie et vérifier une éventuelle insulinorésistance (HOMA, glycémie à jeun, HbA1c). Retrouver une digestion optimale et revoir sommeil, stress et organisation.",
            'phases' => [
                ['nom' => 'Repérage et chrononutrition', 'duree' => 14, 'description' => "Anamnèse ciblée des sources de sucre (boissons sucrées, produits transformés, féculents raffinés, édulcorants, habitudes du week-end). Mise en place d'un petit-déjeuner protéiné (environ 30 g de protéines + bonnes graisses + peu de glucides), test du petit-déjeuner salé. Carnet alimentaire sur au moins une semaine."],
                ['nom' => 'Réduction progressive et stabilisation glycémique', 'duree' => 30, 'description' => "Structuration des 3 repas (protéines + légumes + féculents + lipides de qualité), dessert sucré limité et intégré au repas plutôt qu'isolé. Collations protéinées si besoin, posées et prises calmement. Réduction du café après 16h, hydratation renforcée."],
                ['nom' => 'Consolidation et hygiène de vie', 'duree' => 16, 'description' => "Ancrage des nouvelles habitudes : marche quotidienne, sommeil régulier (7 à 9h/nuit), gestion du stress (cohérence cardiaque, respiration). Réévaluation des marqueurs biologiques si bilan initial anormal."],
            ],
            'complements' => [
                ['nom' => 'Magnésium biodisponible (bisglycinate, malate, citrate)', 'posologie' => 'Jusqu\'à 800 mg/j', 'duree' => 'Toute la durée du protocole'],
                ['nom' => 'Vitamine D', 'posologie' => 'Jusqu\'à 10 000 UI/j selon dosage sanguin', 'duree' => 'Toute la durée du protocole'],
                ['nom' => 'Berbérine', 'posologie' => 'Jusqu\'à 900 mg/j répartis', 'duree' => 'Si insulinorésistance confirmée, 2 à 3 mois'],
                ['nom' => 'Chrome picolinate', 'posologie' => '25 à 250 µg/j', 'duree' => '2 à 3 mois'],
                ['nom' => 'Cannelle de Ceylan', 'posologie' => '2,5 à 5 g/j', 'duree' => '2 à 3 mois'],
                ['nom' => 'Gymnema sylvestre', 'posologie' => 'À individualiser (spray ou gélules)', 'duree' => 'Si envies de sucré marquées'],
                ['nom' => 'Resvératrol', 'posologie' => '250 à 500 mg par repas', 'duree' => 'Si insulinorésistance confirmée'],
                ['nom' => 'Acide alpha-lipoïque', 'posologie' => '200 à 600 mg/j', 'duree' => '2 à 3 mois'],
            ],
            'alimentation' => "Petit-déjeuner protéiné (~30 g de protéines), féculents complets ou semi-complets variés, dessert sucré intégré au repas 1 fois par semaine maximum plutôt qu'isolé. Sucrants naturels à index glycémique bas en dépannage (sucre de coco, sirop de yacon). Dîner léger, 2-3h avant le coucher, sans supprimer les féculents (favorisent le sommeil).",
            'contre_indications' => "Pas d'hyper-restriction brutale : risque de trouble du comportement alimentaire, notamment chez les profils anxieux ou déjà restrictifs. Berbérine et resvératrol à surveiller en cas de traitement hypoglycémiant en cours (avis médical). Vérifier une insulinorésistance par un bilan biologique avant d'introduire une supplémentation ciblée.",
        ],

        // 6. ------------------------------------------------------------------
        [
            'nom' => 'Détox œstrogènes et soutien périménopause',
            'type_protocole' => 'hormonal',
            'duree_jours' => 90,
            'description' => "Le métabolisme des œstrogènes dépend de la phase 2 hépatique (sulfo- et glucuro-conjugaison) puis de la phase 3 (élimination biliaire et fécale). Une carence en B6, B9 ou magnésium, ou un microbiote dysbiotique (estrobolome), favorisent la réabsorption des œstrogènes et peuvent entretenir syndrome prémenstruel, mastodynies ou troubles liés à la périménopause. Ce protocole articule soutien hépatique de phase 2, méthylation et microbiote.",
            'objectifs' => "Optimiser la conjugaison hépatique des œstrogènes. Soutenir la méthylation (cofacteurs B6/B9 actifs). Favoriser une élimination efficace via le microbiote (éviter la déconjugaison intestinale par la bêta-glucuronidase) et le transit.",
            'phases' => [
                ['nom' => 'Soutien méthylation et microbiote', 'duree' => 30, 'description' => "Introduction des cofacteurs de méthylation : B6, B9 sous forme méthylfolate, bétaïne. Alimentation riche en crucifères (brocoli, choux) pour le sulforaphane. Probiotiques diversifiés pour soutenir un estrobolome équilibré."],
                ['nom' => 'Détoxication hépatique phase 2 ciblée', 'duree' => 30, 'description' => "Renforcement de la conjugaison : glycine, taurine, chardon-Marie (silymarine), artichaut. Éviter d'stimuler isolément la phase 1 sans avoir préparé la phase 2."],
                ['nom' => 'Élimination et consolidation', 'duree' => 30, 'description' => "Fibres solubles et insolubles pour limiter la réabsorption intestinale des œstrogènes conjugués, hydratation, probiotiques en continu, diversité végétale (30+ végétaux/semaine)."],
            ],
            'complements' => [
                ['nom' => 'Vitamine B9 sous forme méthylfolate et B6 méthylée', 'posologie' => 'Selon produit', 'duree' => 'Toute la durée du protocole'],
                ['nom' => 'Bétaïne (soutien méthylation)', 'posologie' => 'Selon produit', 'duree' => 'Phase 1'],
                ['nom' => 'Glycine et taurine', 'posologie' => 'Selon produit, en poudre', 'duree' => 'Phase 2'],
                ['nom' => 'Chardon-Marie (silymarine)', 'posologie' => 'Selon extrait standardisé', 'duree' => 'Phase 2, 4 semaines'],
                ['nom' => 'Probiotiques diversifiés', 'posologie' => 'Selon produit', 'duree' => 'Toute la durée du protocole'],
            ],
            'alimentation' => "Crucifères (brocoli, choux) réguliers pour le sulforaphane. Diversité végétale visant 30 aliments différents par semaine pour un estrobolome équilibré. Fibres solubles et insolubles à chaque repas.",
            'contre_indications' => "Contre-indiqué en cas d'obstruction biliaire, de lithiase vésiculaire symptomatique ou d'insuffisance hépatique (pas de cholérétiques). Grossesse et allaitement : éviter la majorité des plantes hépatiques hautement dosées. Pathologie oncologique hormono-dépendante en cours : avis oncologique impératif avant toute intervention sur le métabolisme des œstrogènes.",
        ],

        // 7. ------------------------------------------------------------------
        [
            'nom' => 'Réduction de la charge en perturbateurs endocriniens',
            'type_protocole' => 'detox',
            'duree_jours' => 60,
            'description' => "Les perturbateurs endocriniens (PE) sont des agents exogènes qui interfèrent avec la synthèse, le transport, le métabolisme ou l'action des hormones. Près de 800 substances chimiques sont identifiées comme PE potentiels, avec des effets sans seuil, des effets cocktail et des fenêtres de vulnérabilité (grossesse, 1000 premiers jours, puberté). La priorité absolue reste la réduction des sources d'exposition : aucune cure détox ne remplace cette étape.",
            'objectifs' => "Identifier et réduire les principales sources d'exposition quotidienne (alimentation, cosmétiques, plastiques, air intérieur, lumière bleue). Soutenir les organes émonctoires (foie, reins, peau) déjà en charge de l'élimination continue. Ne pas se substituer à la réduction de l'exposition par une simple supplémentation.",
            'phases' => [
                ['nom' => 'Diagnostic d\'exposition et éviction des sources', 'duree' => 14, 'description' => "Audit du quotidien : cosmétiques (parabènes, phtalates), contenants alimentaires (plastique, boîtes de conserve à revêtement bisphénol), ustensiles de cuisine (téflon), produits ménagers, exposition à la lumière bleue le soir. Substitution progressive : contenants en verre/inox, cosmétiques à composition courte, produits ménagers faits maison (savon de Marseille, bicarbonate, vinaigre blanc)."],
                ['nom' => 'Soutien antioxydant et drainage', 'duree' => 30, 'description' => "Renforcement des défenses antioxydantes endogènes (glutathion, NAC) et soutien hépatique doux (chardon-Marie, artichaut). Aération quotidienne du logement (avant 8h et après 20h)."],
                ['nom' => 'Consolidation des habitudes', 'duree' => 16, 'description' => "Ancrage des nouvelles habitudes d'achat (circuits courts, bio, cosmétiques à composition courte) et de vie (limitation de la lumière bleue le soir, aération)."],
            ],
            'complements' => [
                ['nom' => 'Glutathion réduit ou NAC (précurseur)', 'posologie' => 'Selon produit', 'duree' => 'Phase 2, 4 à 6 semaines'],
                ['nom' => 'Vitamine B6, B9, B12', 'posologie' => 'Selon dosage biologique (B6 : métabolisme et fatigue ; B9 : immunité et préconception ; B12 : immunité, à surveiller chez les véganes/végétariens)', 'duree' => 'Phase 2'],
                ['nom' => 'Zéolithe clinoptilolite', 'posologie' => 'Selon produit (roche volcanique chélatrice piégeant sulfates, sulfites et bisphénol A dans l\'intestin)', 'duree' => 'Cure courte, phase 2'],
                ['nom' => 'Chardon-Marie et artichaut', 'posologie' => 'Selon extrait standardisé', 'duree' => 'Phase 2, en soutien hépatique doux'],
            ],
            'alimentation' => "Alimentation bio et locale privilégiée (circuits courts, AMAP), fait maison, frais ou surgelé non transformé. Contenants en verre ou inox, jamais de plastique ni de contenant gras chauffé au micro-ondes. Variation des espèces de poissons pour limiter l'exposition aux métaux lourds (éviter anguille, carpe, silure en excès).",
            'contre_indications' => "L'objectif n'est pas le \"zéro exposition\" mais une réduction progressive et réaliste. Ce protocole ne remplace pas une prise en charge médicale en cas d'exposition professionnelle documentée (agriculture, coiffure, chimie) : orienter vers la médecine du travail si besoin.",
        ],

        // 8. ------------------------------------------------------------------
        [
            'nom' => 'Neuroprotection cognitive - soutien naturopathique global',
            'type_protocole' => 'autre',
            'duree_jours' => 120,
            'description' => "Protocole construit sur 4 axes physiopathologiques complémentaires des maladies neurodégénératives et du vieillissement cognitif : neurogenèse/neuro-structure, neurotransmission, défenses antioxydantes, neuroinflammation (dont l'axe intestin-cerveau). Les 4 piliers transversaux (alimentation méditerranéenne à IG bas, activité physique régulière, qualité du sommeil, gestion du stress) sont la base de tout protocole, quel que soit le stade.",
            'objectifs' => "Stimuler la neurogenèse et protéger la neuro-structure. Apporter les précurseurs et cofacteurs des neurotransmetteurs (acétylcholine, dopamine, GABA). Renforcer les défenses antioxydantes endogènes (SOD, catalase, glutathion peroxydase) et exogènes. Moduler la neuroinflammation, notamment via l'axe intestin-cerveau.",
            'phases' => [
                ['nom' => 'Neurogenèse et neuro-structure', 'duree' => 30, 'description' => "Mise en place de l'alimentation méditerranéenne à index glycémique bas et des 4 piliers transversaux (sommeil, activité physique, gestion du stress). Introduction des soutiens de la neurogenèse : phosphatidylsérine, extrait d'Hericium erinaceus, sélénium et iode pour la neuro-structure."],
                ['nom' => 'Neurotransmission', 'duree' => 30, 'description' => "Poursuite des axes précédents et ajout des précurseurs de neurotransmetteurs : phosphatidylcholine et huperzine A pour la voie cholinergique, L-tyrosine et vitamine C pour la voie dopaminergique, zinc et magnésium pour l'équilibre GABA/glutamate."],
                ['nom' => 'Défenses antioxydantes', 'duree' => 30, 'description' => "Renforcement des cofacteurs des enzymes antioxydantes endogènes (zinc, cuivre, manganèse, fer, sélénium) et apport d'antioxydants exogènes ciblés (NAC, acide alpha-lipoïque, CoQ10 sous forme ubiquinol). Alimentation riche en indice ORAC (myrtille, chocolat noir, noix de pécan, gingembre)."],
                ['nom' => 'Neuroinflammation et axe intestin-cerveau', 'duree' => 30, 'description' => "Phytothérapie neuroprotectrice (resvératrol, romarin, ginkgo biloba, Centella asiatica). Optimisation du microbiote et de la barrière intestinale (glutamine gastro-résistante, n-butyrate, probiotiques ciblés) pour limiter la neuroinflammation véhiculée par l'axe intestin-cerveau."],
            ],
            'complements' => [
                ['nom' => 'Phosphatidylsérine', 'posologie' => 'Selon les études cliniques du produit choisi', 'duree' => 'Phase 1, en continu'],
                ['nom' => 'Extrait standardisé d\'Hericium erinaceus (crinière de lion)', 'posologie' => 'Selon extrait standardisé', 'duree' => 'Phase 1, cure de 2 à 3 mois'],
                ['nom' => 'Sélénium (sélénométhionine)', 'posologie' => '50 à 80 µg/j en 2 prises', 'duree' => 'Phase 1'],
                ['nom' => 'Phosphatidylcholine (lécithine)', 'posologie' => '400 mg/j', 'duree' => 'Phase 2'],
                ['nom' => 'L-Tyrosine', 'posologie' => '700 mg/j', 'duree' => 'Phase 2'],
                ['nom' => 'Magnésium', 'posologie' => '400 à 600 mg/j', 'duree' => 'Phase 2 et 3'],
                ['nom' => 'Oméga-3 EPA/DHA', 'posologie' => '500 mg/j EPA + 250 mg/j DHA', 'duree' => 'Phase 2 à 4, en continu'],
                ['nom' => 'NAC (précurseur du glutathion)', 'posologie' => 'Selon produit', 'duree' => 'Phase 3'],
                ['nom' => 'CoQ10 (forme ubiquinol de préférence)', 'posologie' => 'Selon produit', 'duree' => 'Phase 3'],
                ['nom' => 'Ginkgo biloba', 'posologie' => 'Extrait titré en ginkgolides ; dose maximale d\'acide ginkgolique de 0,6 µg/j', 'duree' => 'Phase 4'],
            ],
            'alimentation' => "Diète méditerranéenne, aliments à index glycémique bas, équilibre oméga-6/oméga-3, réduction des acides gras trans et de l'huile de palme. Privilégier les aliments à indice ORAC élevé (chocolat noir, noix de pécan, gingembre, myrtilles) pour leur capacité antioxydante.",
            'contre_indications' => "Ginkgo biloba : prudence en cas de traitement anticoagulant ou antiagrégant (avis médical). Ce protocole accompagne la santé cognitive globale mais ne remplace en aucun cas le suivi neurologique d'une pathologie neurodégénérative diagnostiquée. Toute supplémentation en fer doit rester prudente (risque de surcharge).",
        ],

        // 9. ------------------------------------------------------------------
        [
            'nom' => 'Soutien immunitaire par mycothérapie',
            'type_protocole' => 'immunite',
            'duree_jours' => 60,
            'description' => "Les champignons médicinaux (Reishi, Shiitake, Maitake, Chaga, Cordyceps, Champignon du soleil) sont des \"Biological Response Modifiers\" (BRM) riches en bêta-glucanes, considérés comme adaptogènes car ils régulent différents systèmes en favorisant l'homéostasie. Leurs polysaccharides stimulent notamment les cellules NK, les lymphocytes T et les macrophages.",
            'objectifs' => "Soutenir l'immunité de façon large et non spécifique via les bêta-glucanes fongiques. Apporter un effet antioxydant et hépatoprotecteur associé. Individualiser le choix des champignons selon le terrain (tonification pour un terrain fatigué, immunomodulation pour un terrain inflammatoire).",
            'phases' => [
                ['nom' => 'Immunomodulation à large spectre', 'duree' => 30, 'description' => "Introduction des champignons les plus documentés en immunomodulation générale : Shiitake (lentinane, riche en bêta-glucanes), Maitake (polysaccharide GFP activant macrophages et cellules NK), Chaga (polysaccharides, triterpénoïdes, activité antioxydante et hépatoprotectrice)."],
                ['nom' => 'Renfort ciblé et tonification', 'duree' => 30, 'description' => "Ajout du Cordyceps (tonique traditionnellement utilisé en médecine chinoise pour soutenir l'énergie vitale) et, en cas de terrain très affaibli ou de contexte inflammatoire chronique, du Champignon du soleil (Agaricus blazei), l'un des immunomodulateurs les plus étudiés."],
            ],
            'complements' => [
                ['nom' => 'Shiitake (Lentinula edodes) - extrait standardisé', 'posologie' => 'Selon extrait standardisé en bêta-glucanes/lentinane', 'duree' => 'Phase 1, 4 à 6 semaines'],
                ['nom' => 'Maitake (Grifola frondosa) - extrait standardisé', 'posologie' => 'Selon extrait standardisé', 'duree' => 'Phase 1, 4 à 6 semaines'],
                ['nom' => 'Chaga (Inonotus obliquus) - extrait standardisé', 'posologie' => 'Selon extrait standardisé', 'duree' => 'Phase 1, 4 à 6 semaines'],
                ['nom' => 'Cordyceps sinensis / militaris', 'posologie' => 'Repère de médecine traditionnelle chinoise : 3 à 10 g/j de champignon séché, ou équivalent en extrait standardisé', 'duree' => 'Phase 2, 4 à 6 semaines'],
                ['nom' => 'Champignon du soleil (Agaricus blazei / brasiliensis)', 'posologie' => 'Selon extrait standardisé', 'duree' => 'Phase 2, si terrain très affaibli ou inflammatoire, avis complémentaire recommandé'],
            ],
            'alimentation' => "Champignons médicinaux à privilégier sous forme d'extraits standardisés (le mycélium peut se substituer efficacement au carpophore pour les polysaccharides, mais le carpophore reste plus riche en ergostérol et composés phénoliques).",
            'contre_indications' => "La queue de dinde (Coriolus / Trametes versicolor) est interdite à la vente en France (statut \"novel food\") : à ne pas proposer malgré son intérêt documenté à l'étranger. Prudence chez les patients sous traitement immunosuppresseur ou greffés (les champignons médicinaux stimulent l'immunité). En contexte oncologique, toute mycothérapie doit être discutée avec l'oncologue référent en raison des interactions potentielles avec la chimiothérapie (certains champignons sont chimio-sensibilisants). Le Cordyceps est déconseillé en cas de vide de Yin avec chaleur vide ou d'hémoptysie selon la médecine traditionnelle chinoise.",
        ],

        // 10. -----------------------------------------------------------------
        [
            'nom' => 'Rééquilibrage du microbiote et confort digestif',
            'type_protocole' => 'digestif',
            'duree_jours' => 45,
            'description' => "Le microbiote intestinal regroupe l'ensemble des bactéries, levures, champignons et virus hébergés dans l'intestin ; sa diversité est un marqueur clé de santé. Le tryptique Immunité-Dysbiose-Hyperperméabilité définit l'intégrité de la barrière intestinale. Un régime occidental pauvre en fibres modifie le microbiote dès le premier jour, mais celui-ci est très réactif : la composition initiale peut être retrouvée 48h après la reprise d'une alimentation végétale diversifiée.",
            'objectifs' => "Optimiser la diversité et la fonctionnalité du microbiote par l'alimentation. Soutenir la production d'acides gras à chaîne courte (AGCC, dont le butyrate) et l'intégrité des jonctions serrées. Adapter transitoirement le régime (épargne digestive, pauvre en FODMAPs ou en histamine) en cas d'inconfort digestif, sans le prolonger inutilement.",
            'phases' => [
                ['nom' => 'Régime d\'épargne digestive', 'duree' => 15, 'description' => "Suppression temporaire des aliments qui retardent la vidange gastrique ou augmentent les gaz et ballonnements (choux, poivrons, fruits secs, lait animal non fermenté, excès de gluten). Renforcement de la mastication."],
                ['nom' => 'Diversification et polyphénols', 'duree' => 15, 'description' => "Réintroduction progressive d'une large variété de fruits et légumes (objectif : plus de 30 types différents par semaine, corrélé à une meilleure diversité bactérienne). Apport de polyphénols (quercétine, curcumine, resvératrol, anthocyanines) pour leur effet anti-inflammatoire et leur soutien des jonctions serrées."],
                ['nom' => 'Consolidation et aliments fermentés', 'duree' => 15, 'description' => "Introduction des aliments fermentés (pain au levain, kéfir, kombucha, légumes lacto-fermentés) et des prébiotiques naturels (ail, oignon, artichaut, asperges, banane verte, pommes de terre refroidies)."],
            ],
            'complements' => [
                ['nom' => 'Polyphénols alimentaires ciblés (quercétine, curcumine, resvératrol)', 'posologie' => 'Apport prioritairement alimentaire quotidien ; complément possible selon terrain', 'duree' => 'Toute la durée du protocole'],
                ['nom' => 'Probiotiques multi-souches diversifiés', 'posologie' => 'Selon produit', 'duree' => 'Phase 3, 4 semaines'],
            ],
            'alimentation' => "Fruits et légumes riches en fibres et polyphénols (viser 30 végétaux différents par semaine). Céréales, légumineuses, noix et graines trempées 12h avant cuisson. Aliments fermentés en phase de consolidation. En cas de régime pauvre en FODMAPs transitoire, ne pas le prolonger au-delà de la phase aiguë (perte de diversité bactérienne à terme, efficacité démontrée dans 70% des cas de SII mais réservée aux phases actives sous supervision).",
            'contre_indications' => "Le régime pauvre en FODMAPs ne doit pas être maintenu au long cours sans réintroduction progressive. Le régime pauvre en histamine est réservé aux personnes présentant une intolérance documentée (DAO basse), pas à appliquer systématiquement.",
        ],

        // 11. -----------------------------------------------------------------
        [
            'nom' => 'Hyperperméabilité intestinale (leaky gut)',
            'type_protocole' => 'digestif',
            'duree_jours' => 60,
            'description' => "L'hyperperméabilité intestinale correspond à une altération des jonctions serrées de la muqueuse, laissant passer des molécules et des antigènes qui stimulent une réponse immunitaire inadaptée (endotoxémie de bas grade). Elle est associée à de multiples sensibilités alimentaires et à un terrain inflammatoire. Ce protocole cible spécifiquement le renforcement des jonctions serrées et du mucus.",
            'objectifs' => "Retirer les facteurs aggravants (tests d'éviction, alcool, AINS). Renforcer les jonctions serrées (ZO-1, claudines, occludines) et la qualité du mucus (MUC2). Réintroduire une digestion et un microbiote fonctionnels.",
            'phases' => [
                ['nom' => 'Retirer', 'duree' => 14, 'description' => "Éviction des aliments testés positifs, réduction de l'alcool et des AINS si possible (avis médical), réduction du stress (l'axe hypothalamo-hypophyso-surrénalien influence directement la perméabilité intestinale). Antimicrobiens ciblés seulement si dysbiose associée documentée."],
                ['nom' => 'Réparer', 'duree' => 28, 'description' => "Zinc-carnosine pour renforcer les jonctions serrées, L-glutamine à dose utile (10 à 15 g/j, à distinguer des doses naturopathiques classiques de 3-5 g jugées sous-optimales), L-thréonine pour la qualité du mucus, quercétine pour limiter la dégranulation mastocytaire, vitamines D3 et A."],
                ['nom' => 'Remplacer et réinoculer', 'duree' => 18, 'description' => "Enzymes digestives à large spectre, bétaïne HCl si besoin. Probiotiques multi-souches à au moins 10 milliards d'UFC. Akkermansia muciniphila en soutien émergent selon disponibilité."],
            ],
            'complements' => [
                ['nom' => 'Zinc-carnosine', 'posologie' => '75 mg x2/j', 'duree' => 'Phase Réparer, 4 à 6 semaines'],
                ['nom' => 'L-Glutamine', 'posologie' => '10 à 15 g/j (cure de 4 à 6 semaines) ; à éviter en cas de SIBO actif', 'duree' => 'Phase Réparer, 4 à 6 semaines'],
                ['nom' => 'L-Thréonine', 'posologie' => 'Selon produit, en soutien de la synthèse de mucine MUC2', 'duree' => 'Phase Réparer'],
                ['nom' => 'Quercétine', 'posologie' => '500 mg x2/j', 'duree' => 'Phase Réparer'],
                ['nom' => 'Probiotiques multi-souches', 'posologie' => '≥ 10 milliards UFC/j', 'duree' => 'Phase Remplacer et réinoculer, 3 semaines'],
            ],
            'alimentation' => "Éviction ciblée des aliments identifiés comme irritants (tests), réduction de l'alcool. Bouillons d'os, aliments riches en vitamine A et zinc pour la cicatrisation muqueuse.",
            'contre_indications' => "L-glutamine à éviter ou à limiter en cas de SIBO actif (peut nourrir certaines bactéries du grêle). Ce protocole n'a pas vocation à traiter une MICI ou une allergie alimentaire diagnostiquée sans coordination avec le médecin traitant.",
        ],

        // 12. -----------------------------------------------------------------
        [
            'nom' => 'Restauration de la flore post-antibiothérapie',
            'type_protocole' => 'digestif',
            'duree_jours' => 21,
            'description' => "Après une antibiothérapie, la flore intestinale est déséquilibrée sans qu'il y ait nécessairement d'inflammation associée : pas de \"retirer\" agressif ni de réparation lourde nécessaire dans ce cas simple, l'accent est mis sur la protection pendant le traitement puis sur la réinoculation progressive.",
            'objectifs' => "Protéger la flore pendant l'antibiothérapie. Réensemencer un microbiote diversifié après la fin du traitement, en réintroduisant progressivement les prébiotiques.",
            'phases' => [
                ['nom' => 'Pendant l\'antibiothérapie', 'duree' => 10, 'description' => "Alimentation diversifiée et riche en fibres et polyphénols dès que la tolérance digestive le permet. Introduction de Saccharomyces boulardii dès le début du traitement, à distance de la prise d'antibiotique (2h)."],
                ['nom' => 'Après l\'antibiothérapie', 'duree' => 11, 'description' => "Poursuite de S. boulardii une semaine après la fin du traitement, puis relais par des probiotiques multi-souches et une réintroduction progressive des prébiotiques (FOS, inuline)."],
            ],
            'complements' => [
                ['nom' => 'Saccharomyces boulardii', 'posologie' => 'Selon produit, à distance de la prise d\'antibiotique (2h)', 'duree' => 'Pendant l\'antibiothérapie et 1 semaine après'],
                ['nom' => 'Probiotiques multi-souches', 'posologie' => 'Selon produit', 'duree' => 'Après l\'antibiothérapie, 2 semaines'],
                ['nom' => 'Prébiotiques (FOS, inuline)', 'posologie' => 'Introduction progressive pour limiter les ballonnements', 'duree' => 'Après l\'antibiothérapie, en réintroduction'],
            ],
            'alimentation' => "Alimentation diversifiée riche en fibres et en polyphénols dès que la tolérance digestive le permet.",
            'contre_indications' => "Saccharomyces boulardii à utiliser avec prudence (avis médical) chez les patients porteurs d'un cathéter veineux central ou sévèrement immunodéprimés (risque, bien que rare, de fongémie).",
        ],

        // 13. -----------------------------------------------------------------
        [
            'nom' => 'Gestion du stress chronique et axe intestin-cerveau',
            'type_protocole' => 'stress',
            'duree_jours' => 60,
            'description' => "Le stress chronique élève le cortisol, ce qui a un effet hyperglycémiant, inhibe le système parasympathique et perturbe le fonctionnement du nerf vague (gestion des sécrétions digestives, motricité intestinale, inflammation). Cette rupture de l'axe intestin-cerveau favorise les troubles digestifs fonctionnels et la prolifération de Candida ou d'un SIBO associé. Ce protocole travaille en parallèle la régulation neurovégétative et la correction des carences fréquemment associées au stress chronique.",
            'objectifs' => "Restaurer le tonus vagal et l'équilibre du système nerveux autonome. Soutenir la réponse au stress par des plantes adaptogènes et corriger les carences fréquemment associées (magnésium, vitamines B, D). Réduire l'impact du stress sur la glycémie et le terrain digestif.",
            'phases' => [
                ['nom' => 'Régulation du système nerveux autonome', 'duree' => 20, 'description' => "Techniques de stimulation du nerf vague : respiration lente, cohérence cardiaque (3x5 min/jour), repas pris au calme sans écran, exercices somatiques. Orientation vers une psychothérapie, une EMDR ou de l'hypnose si traumatisme ou stress ancien identifié."],
                ['nom' => 'Soutien adaptogène et correction des carences', 'duree' => 20, 'description' => "Introduction des plantes adaptogènes et correction des carences en magnésium, vitamines B et D fréquemment associées au stress chronique."],
                ['nom' => 'Consolidation des habitudes', 'duree' => 20, 'description' => "Ancrage du sommeil récupérateur, réduction des excitants, exposition à la lumière naturelle le matin, poursuite des techniques de respiration."],
            ],
            'complements' => [
                ['nom' => 'Magnésium biodisponible (citrate, glycérophosphate, bisglycinate)', 'posologie' => '≥ 300 mg/j', 'duree' => 'Toute la durée du protocole'],
                ['nom' => 'Ashwagandha', 'posologie' => 'Selon produit, prise le soir', 'duree' => 'Phase 2, 4 semaines - à éviter en cas de trouble thyroïdien non stabilisé'],
                ['nom' => 'Rhodiole ou safran (alternative à l\'ashwagandha en cas de trouble thyroïdien)', 'posologie' => 'Selon produit, prise le matin', 'duree' => 'Phase 2, 4 semaines'],
                ['nom' => 'Vitamine D', 'posologie' => 'Selon dosage sanguin', 'duree' => 'Toute la durée du protocole'],
            ],
            'alimentation' => "Repas pris au calme, sans écran, avec une mastication renforcée. Réduction des excitants (caféine, alcool) en particulier en fin de journée. Petit-déjeuner protéiné pour stabiliser la glycémie et limiter le pic de cortisol matinal.",
            'contre_indications' => "L'ashwagandha est à éviter ou à discuter avec le médecin en cas de pathologie thyroïdienne non stabilisée (hyper ou hypothyroïdie) : préférer alors la rhodiole ou le safran. Prudence chez la femme enceinte ou allaitante pour l'ensemble des plantes adaptogènes, non évaluées dans ce contexte. Ce protocole ne remplace pas une prise en charge psychologique ou psychiatrique en cas de trouble anxieux caractérisé.",
        ],

    ];
}

/**
 * Insère dans la table `protocoles` les protocoles de la bibliothèque qui
 * n'existent pas encore (comparaison insensible à la casse sur le nom), pour
 * le praticien identifié comme le premier utilisateur de l'application
 * (praticien solo). Retourne la liste des noms de protocoles ajoutés.
 */
function syncProtocoles(PDO $db): array {
    $protocoles = getProtocolesTypes();

    // Les protocoles appartiennent à un praticien (user_id NOT NULL) : on les
    // rattache au premier utilisateur de l'app (praticien solo).
    $userId = (int)$db->query("SELECT MIN(id) FROM users")->fetchColumn();
    if (!$userId) {
        return [];
    }

    $existingNoms = $db->prepare("SELECT nom FROM protocoles WHERE user_id = ?");
    $existingNoms->execute([$userId]);
    $existingNoms = array_map('mb_strtolower', $existingNoms->fetchAll(PDO::FETCH_COLUMN));

    $stmt = $db->prepare("INSERT INTO protocoles (user_id, nom, type_protocole, duree_jours, description, objectifs, phases, complements, alimentation, contre_indications) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $added = [];
    foreach ($protocoles as $p) {
        if (in_array(mb_strtolower($p['nom']), $existingNoms, true)) {
            continue;
        }
        $stmt->execute([
            $userId, $p['nom'], $p['type_protocole'], $p['duree_jours'], $p['description'], $p['objectifs'],
            json_encode($p['phases']), json_encode($p['complements']), $p['alimentation'], $p['contre_indications'],
        ]);
        $added[] = $p['nom'];
    }

    return $added;
}
