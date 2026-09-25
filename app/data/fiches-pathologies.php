<?php
/**
 * Fiches pathologies en dur - extraites des cours PHV
 * À actualiser via GitHub au fil du temps
 */

function getFichesPathologies(): array {
    return [
        // ==========================================
        // SYSTÈME DIGESTIF
        // ==========================================
        [
            'nom' => 'Candidose buccale',
            'systeme' => 'Système digestif',
            'description' => 'Infection fongique de la cavité buccale causée par Candida albicans. Se manifeste par des plaques blanchâtres sur la langue et les muqueuses buccales.',
            'causes' => "Déséquilibre de la flore buccale, immunité affaiblie, prise d'antibiotiques, diabète, stress, alimentation riche en sucres, port de prothèses dentaires.",
            'signes_cliniques' => "Plaques blanches sur la langue et les muqueuses, rougeurs, sensation de brûlure, goût métallique, difficulté à avaler, sécheresse buccale.",
            'conseils_alimentation' => "Limiter les sucres rapides et raffinés. Réduire les levures alimentaires. Privilégier les aliments anti-fongiques naturels : ail, oignon, huile de coco. Augmenter les légumes verts, les protéines de qualité.",
            'aliments_eviter' => "Sucre blanc, miel, sirops, jus de fruits, produits industriels, alcool, pain blanc, pâtes blanches, produits laitiers riches en lactose.",
            'aliments_privilegier' => "Ail cru, huile de coco, curcuma, légumes verts, protéines maigres, aliments fermentés (en petite quantité selon tolérance), prébiotiques.",
            'conseils_activite' => "Activité physique modérée régulière pour soutenir le système immunitaire. Marche, yoga.",
            'conseils_stress' => "Le stress affaiblit le système immunitaire. Pratiquer la respiration ventrale, la cohérence cardiaque.",
            'conseils_routine' => "Bain de bouche eau tiède + bicarbonate. Gratte-langue quotidien. Hygiène buccale douce.",
            'complements' => "Probiotiques buccaux. Extrait de pépins de pamplemousse. Propolis.",
            'phytotherapie' => "Échinacée (soutien immunitaire). Lapacho (antifongique naturel).",
            'aromatherapie' => "HE Tea Tree (1 goutte dans huile de coco en bain de bouche). HE Laurier noble.",
            'notes' => '',
        ],
        [
            'nom' => 'Gingivite',
            'systeme' => 'Système digestif',
            'description' => "Inflammation des gencives, souvent liée à l'accumulation de plaque dentaire. Peut évoluer en parodontite si non traitée.",
            'causes' => "Mauvaise hygiène buccale, carence en vitamine C, stress, tabac, déséquilibre de la flore buccale, médicaments.",
            'signes_cliniques' => "Gencives rouges, gonflées, saignantes au brossage, mauvaise haleine, sensibilité.",
            'conseils_alimentation' => "Augmenter les apports en vitamine C (agrumes, kiwi, persil, poivron). Aliments riches en coenzyme Q10. Réduire les sucres.",
            'aliments_eviter' => "Sucres raffinés, aliments acides en excès, alcool.",
            'aliments_privilegier' => "Fruits riches en vitamine C, légumes crus, thé vert, aliments riches en oméga-3.",
            'conseils_activite' => "Activité physique régulière pour la circulation.",
            'conseils_stress' => "Le stress fragilise le système immunitaire buccal.",
            'conseils_routine' => "Brossage doux après chaque repas. Fil dentaire. Bain de bouche à l'eau salée ou au bicarbonate.",
            'complements' => "Vitamine C naturelle. Coenzyme Q10. Probiotiques.",
            'phytotherapie' => "Sauge (bain de bouche). Myrrhe (antiseptique gingival).",
            'aromatherapie' => "HE Tea Tree. HE Clou de girofle (antiseptique).",
            'notes' => '',
        ],
        [
            'nom' => 'RGO - Reflux Gastro-Oesophagien',
            'systeme' => 'Système digestif',
            'description' => "Remontée du contenu acide de l'estomac vers l'oesophage, provoquant brûlures et irritation.",
            'causes' => "Hernie hiatale, surpoids, stress, alimentation trop riche/grasse/acide, tabac, grossesse, certains médicaments, repas trop copieux le soir.",
            'signes_cliniques' => "Brûlures rétrosternales (pyrosis), régurgitations acides, toux chronique, enrouement, goût amer dans la bouche, douleurs thoraciques.",
            'conseils_alimentation' => "Fractionner les repas. Dîner léger 3h avant le coucher. Bien mastiquer. Éviter de boire pendant les repas. Manger dans le calme.",
            'aliments_eviter' => "Café, thé, chocolat, menthe, agrumes, tomates, épices fortes, alcool, boissons gazeuses, aliments gras et frits.",
            'aliments_privilegier' => "Banane, pomme de terre, riz, avoine, légumes cuits, amandes, gingembre frais, aloe vera (jus).",
            'conseils_activite' => "Éviter le sport après les repas. Marche douce. Yoga (éviter les postures inversées).",
            'conseils_stress' => "Le stress augmente l'acidité gastrique. Cohérence cardiaque avant les repas. Respiration ventrale.",
            'conseils_routine' => "Surélever la tête du lit (15 cm). Ne pas s'allonger après manger. Vêtements non serrés à la taille.",
            'complements' => "Lithothamne (alcalinisant). Jus d'aloe vera. Glutamine (réparation muqueuse).",
            'phytotherapie' => "Réglisse déglycyrrhizinée (DGL). Guimauve (mucilage protecteur). Mélisse.",
            'aromatherapie' => "HE Basilic tropical (antispasmodique digestif).",
            'notes' => 'Vérifier les interactions avec IPP (inhibiteurs pompe à protons) si le client en prend.',
        ],
        [
            'nom' => 'Gastrite chronique',
            'systeme' => 'Système digestif',
            'description' => "Inflammation chronique de la muqueuse gastrique.",
            'causes' => "Helicobacter pylori, AINS, stress chronique, alcool, tabac, alimentation irritante.",
            'signes_cliniques' => "Douleurs épigastriques, nausées, perte d'appétit, sensation de plénitude, éructations.",
            'conseils_alimentation' => "Fractionner les repas. Manger dans le calme. Mastiquer longuement. Éviter les irritants gastriques.",
            'aliments_eviter' => "Café, alcool, épices fortes, aliments acides, fritures, produits ultra-transformés.",
            'aliments_privilegier' => "Chou (jus), pomme de terre, banane, riz, avoine, miel de manuka, bouillon d'os.",
            'conseils_activite' => "Activité douce : marche, yoga, tai chi.",
            'conseils_stress' => "Le stress est un facteur majeur. Cohérence cardiaque, sophrologie.",
            'conseils_routine' => "Eau tiède citronnée le matin (si toléré). Pas de repas tardif.",
            'complements' => "Glutamine. Aloe vera. Zinc-carnosine.",
            'phytotherapie' => "Réglisse DGL. Guimauve. Matricaire (camomille allemande).",
            'aromatherapie' => "HE Menthe poivrée (avec prudence). HE Basilic tropical.",
            'notes' => '',
        ],
        [
            'nom' => 'SII - Syndrome de l\'Intestin Irritable',
            'systeme' => 'Système digestif',
            'description' => "Trouble fonctionnel chronique du côlon associant douleurs abdominales et troubles du transit (constipation, diarrhée ou alternance).",
            'causes' => "Stress, dysbiose intestinale, perméabilité intestinale, intolérances alimentaires (FODMAPs), post-infectieux.",
            'signes_cliniques' => "Douleurs abdominales, ballonnements, gaz, alternance constipation/diarrhée, urgences, mucus dans les selles.",
            'conseils_alimentation' => "Régime pauvre en FODMAPs (phase d'élimination puis réintroduction). Mastiquer longuement. Fractionner. Tenir un journal alimentaire.",
            'aliments_eviter' => "FODMAPs élevés : oignon, ail, blé, lactose, pomme, poire, légumineuses en excès. Aliments ultra-transformés.",
            'aliments_privilegier' => "Légumes à faible FODMAP (courgette, carotte, épinard), riz, quinoa, protéines maigres, banane mûre.",
            'conseils_activite' => "Activité régulière modérée. Yoga (postures pour le ventre). Marche après les repas.",
            'conseils_stress' => "Lien fort intestin-cerveau. Hypnose, sophrologie, cohérence cardiaque, TCC.",
            'conseils_routine' => "Bouillotte chaude sur le ventre. Massage abdominal doux (sens des aiguilles d'une montre). Infusions digestives.",
            'complements' => "Probiotiques ciblés SII. Glutamine. Huile de menthe poivrée (gélules gastro-résistantes).",
            'phytotherapie' => "Mélisse, fenouil, menthe poivrée, matricaire.",
            'aromatherapie' => "HE Menthe poivrée (en gélule). HE Basilic tropical (massage abdominal dilué).",
            'notes' => 'Orienter vers un gastro-entérologue si symptômes d\'alarme (sang, perte de poids, fièvre).',
        ],
        [
            'nom' => 'Constipation chronique',
            'systeme' => 'Système digestif',
            'description' => "Transit ralenti avec moins de 3 selles par semaine, selles dures et difficiles à évacuer.",
            'causes' => "Manque de fibres, déshydratation, sédentarité, stress, dysbiose, mauvaises graisses, alimentation raffinée, abus de laxatifs.",
            'signes_cliniques' => "Selles rares et dures, effort à la défécation, ballonnements, inconfort abdominal, hémorroïdes.",
            'conseils_alimentation' => "Augmenter progressivement les fibres (solubles et insolubles). Boire 1,5 à 2L d'eau/jour. Mastiquer. Huile d'olive à jeun.",
            'aliments_eviter' => "Aliments raffinés (pain blanc, riz blanc), excès de fromage, banane non mûre, excès de thé.",
            'aliments_privilegier' => "Pruneaux, figues, graines de lin (trempées), psyllium, légumes cuits et crus, céréales complètes, légumineuses.",
            'conseils_activite' => "Marche rapide quotidienne (stimule le péristaltisme). Abdominaux doux. Yoga.",
            'conseils_stress' => "Le stress contracte l'intestin. Respiration ventrale. Cohérence cardiaque.",
            'conseils_routine' => "Position physiologique aux toilettes (marche-pied). Massage abdominal matin. Eau tiède + citron à jeun. Bouillotte sur le foie.",
            'complements' => "Magnésium (citrate ou bisglycinate). Probiotiques. Psyllium blond.",
            'phytotherapie' => "Mauve, guimauve (mucilages). Artichaut, romarin (soutien hépatique). Séné à éviter au long cours.",
            'aromatherapie' => "HE Gingembre (massage abdominal). HE Estragon.",
            'notes' => 'Vérifier la prise de médicaments constipants (opioïdes, fer, antidépresseurs).',
        ],
        // ==========================================
        // SYSTÈME URO-GÉNITAL
        // ==========================================
        [
            'nom' => 'Mycose vaginale',
            'systeme' => 'Système uro-génital',
            'description' => "Mycose vaginale récidivante (candidose à Candida albicans) : infection liée à une prolifération de levures du genre Candida, favorisée par un déséquilibre de la flore de Döderlein (lactobacilles) et une élévation du pH vaginal. Devient « récidivante » à partir de 4 épisodes/an ; l'allopathie seule (antifongiques répétés) est souvent insuffisante si le terrain n'est pas corrigé.",
            'causes' => "1) Déséquilibre de la flore de Döderlein : baisse des lactobacilles → moins d'acide lactique/peroxyde d'hydrogène → protection diminuée ; lien intestin-vagin via dysbiose intestinale et transfert bactérien périnéal. 2) pH vaginal élevé (>4,5 au lieu de 3,8-4,5) : règles, rapports non protégés (sperme pH 7,2-8), savons agressifs, périménopause alcalinisent le milieu et favorisent Candida. 3) Contexte hormonal (préménopause) : baisse des œstrogènes → moins de glycogène → moins de nourriture pour les lactobacilles → muqueuse plus fine/sèche, immunité locale moins efficace. 4) Hygiène inadaptée : produits intimes trop alcalins (pH 8), protections synthétiques/parfumées, sous-vêtements synthétiques ou serrés (humidité). 5) Facteurs métaboliques/immunitaires : sucres rapides (nourriture du Candida), stress chronique (cortisol → immunosuppression), carences (vitamine D, zinc, fer), fatigue chronique, infections virales latentes. 6) Biofilm de Candida résistant aux antifongiques classiques, expliquant certaines récidives.",
            'signes_cliniques' => "Démangeaisons et brûlures vulvo-vaginales, muqueuse rouge et inflammée, pertes vaginales NON odorantes (différencie d'une vaginose bactérienne), intensification en période périmenstruelle, récidives malgré traitements antifongiques répétés. Terrain associé possible : SII, fatigue, stress chronique, symptômes de préménopause.",
            'conseils_alimentation' => "Alimentation antifongique ciblée 4 à 6 semaines : zéro sucre rapide autant que possible (sucre, miel, sirops, jus de fruits, produits industriels). Limitation temporaire du gluten (fragilise la perméabilité intestinale) et des produits laitiers/lactose (substrat du Candida). Protocole quotidien : 1 c. à soupe d'huile de coco/jour (acide caprylique) + curcuma frais râpé. Régénération du microbiote sur 4 semaines minimum : prébiotiques et aliments fermentés en petite quantité selon tolérance. Soutien hépatique (artichaut, radis noir, citron à jeun). Fractionner les repas, dîner léger pauvre en glucides pour stabiliser la glycémie. Bien mastiquer, 1,5 L d'eau/jour.",
            'aliments_eviter' => "Sucre, miel, sirops, jus de fruits, produits industriels/raffinés. Gluten (limitation temporaire). Produits laitiers riches en lactose. Aliments fermentés contenant des levures en phase aiguë (fromages, pain).",
            'aliments_privilegier' => "Huile de coco (acide caprylique, antifongique naturel), curcuma frais. Prébiotiques : carottes cuites, bananes peu mûres, flocons d'avoine (attention FODMAP si SII associé). Fermentés en petite quantité : miso, kimchi, choucroute crue, tempeh, kéfir type K-Philus. Bouillon d'os (collagène + glutamine) pour la muqueuse intestinale. Artichaut, radis noir, citron à jeun (drainage hépatique).",
            'conseils_activite' => "Marche rapide 5 j/semaine, 30 à 45 min (circulation, régulation digestive). Yin yoga 1x/semaine (parasympathique). Exercices de Kegel quotidiens : 3 séries de 10 contractions (alterner longues 10s et rapides), renforcent le périnée, améliorent le retour veino-lymphatique pelvien, aident à maintenir un pH vaginal acide. Respiration diaphragmatique/cohérence cardiaque avant les repas.",
            'conseils_stress' => "Objectif : diminuer le cortisol (immunosuppresseur et déséquilibrant hormonal). Cohérence cardiaque/respiration diaphragmatique 3 à 5 min avant chaque repas (5s inspir/5s expir). Marche en nature (15 min suffisent). Soigner le sommeil, souvent impacté par les crises et le stress chronique. Aliments riches en oméga-3.",
            'conseils_routine' => "Bain de siège antifongique en période de crise (10 min/j) : infusion de camomille + 1 c. à soupe de vinaigre de cidre + 2 gouttes d'HE tea tree diluées. Toilette intime douce : eau tiède + eau florale de rose ; éviter les nettoyants alcalins (pH 8, physiologique 5-6). Protections en coton bio non blanchi ou culottes menstruelles, sans synthétique ni parfum. Sous-vêtements coton uniquement, éviter vêtements serrés. Rapports protégés pendant le traitement (sperme alcalin).",
            'complements' => "Stratégie en 3 phases sur ~3 mois : 1) Assainissement (3-8 sem) : antifongiques naturels, bain de siège, HE tea tree diluée en externe. 2) Réparation de la muqueuse (4-8 sem) : gel/ovules à l'acide lactique + lactobacilles rhamnosus, huile d'argousier. 3) Réensemencement (8-12 sem) : probiotiques locaux et oraux ciblés (L. crispatus, rhamnosus, reuteri), échinacée. Doses citées : Dysbios'Aroma 2 gél./repas 3 sem puis 2 gél./dîner 2 mois ; huile d'argousier 2 caps/j 2 mois ; propolis noire 1 goutte sublinguale 15j-3 sem/mois 3 mois ; probiotiques intimes oraux 2 gél. à jeun (après 3 sem d'HE) 3 mois ; probiotiques vaginaux 1 ovule au coucher 1x/sem 2 mois ; chardon-marie TM 20 gouttes avant chaque repas ; vitamine D3 + zinc après dosage médical. Si récidive : argent colloïdal 10-15 ppm max en externe sur la vulve matin/soir (jamais intravaginal).",
            'phytotherapie' => "HE Tea Tree (diluée, externe uniquement, jamais intravaginal). HE Origan compact (carvacrol, antifongique puissant, 3 sem intensif puis entretien, hépatoprotection conseillée en parallèle). HE Cannelle de Ceylan écorce et HE Girofle (antifongique/antibiofilm, déconseillées si allergie, ulcère, épilepsie, grossesse/allaitement — eugénol). HE Palmarosa/Lemongrass (douces, externe diluées). Chardon-Marie (protecteur hépatique). Échinacée (immunité, cure courte, à éviter si maladie auto-immune). Berbérine, curcumine, extrait d'ail (allicine), extrait d'olivier (oléuropéine) : anti-biofilm de Candida, avis professionnel recommandé pour la berbérine (interactions).",
            'aromatherapie' => "Argent colloïdal (10-15 ppm max), application externe matin et soir sur la vulve en cas de récidive uniquement (jamais intravaginal, respecter le titrage).",
            'notes' => "Classification de la flore de Döderlein (frottis, Type I flore idéale à Type V dysbiose sévère) utile pour objectiver et suivre la cure. Si récidives malgré protocole bien suivi, creuser : microbiote intestinal (PCR/culture selles), glycémie/HbA1c/HOMA, immunité (carences, infections latentes EBV/CMV), terrain hormonal (périménopause), autres souches (glabrata, krusei), biofilm résistant. Posture : ne pas juger, écoute active, vérifier l'acceptabilité émotionnelle et pratique (temps/énergie/budget) avant de construire le PHV — un protocole simple réellement suivi vaut mieux qu'un protocole parfait trop lourd. Toujours réorienter vers un médecin/gynécologue si besoin, ne jamais critiquer les professionnels déjà consultés.",
        ],
        [
            'nom' => 'Cystite / Infection urinaire',
            'systeme' => 'Système uro-génital',
            'description' => "Infection/inflammation de la vessie, très fréquente chez la femme (proximité anatomique avec le rectum). À distinguer : cystite aiguë et cystite chronique/récidivante, dont la prise en charge diffère.",
            'causes' => "Causes souvent invisibles à explorer : dysbiose vaginale ou intestinale, constipation chronique, inflammation de bas grade, irritation de la muqueuse vésicale, fatigue chronique, hypo-immunité, déséquilibre hormonal (notamment œstrogènes), stress chronique, tensions pelviennes, hygiène intime inadaptée, carences en nutriments clés. À explorer selon le contexte : transit perturbé, ballonnements, sécheresse des muqueuses, ménopause ou contraception hormonale, récidives après les rapports, produits d'hygiène irritants, sous-vêtements synthétiques, absence de miction après les rapports, hydratation insuffisante.",
            'signes_cliniques' => "Douleurs sus-pubiennes, brûlures à la miction, mictions fréquentes avec faibles quantités d'urine, parfois sang dans les urines. Forme chronique : infections à répétition, fièvre possible si passage à une pyélonéphrite (infection des voies urinaires hautes).",
            'conseils_alimentation' => "Boire abondamment pour soutenir les reins et favoriser l'élimination des bactéries. Associer des plantes diurétiques (piloselle, orthosiphon, reine des prés). Alimentation anti-inflammatoire et alcalinisante. Aliments prébiotiques à privilégier. Canneberge riche en D-mannose : inhibe l'adhérence d'E. coli à la paroi vésicale.",
            'aliments_eviter' => "Sucres rapides (terrain propice aux infections), alcool, épices fortes et excitants (irritants vésicaux). L'hydratation insuffisante est le point à corriger en priorité.",
            'aliments_privilegier' => "Eau en abondance. Canneberge (riche en D-mannose). Prébiotiques : fructanes (chicorée, ail, topinambour, poireau, artichaut, banane), amidons résistants (légumineuses, banane peu mûre, pommes de terre, céréales complètes cuites puis refroidies), bêta-glucanes (avoine).",
            'conseils_activite' => "Bouger régulièrement, éviter la station assise prolongée en cas de constipation ou de congestion du petit bassin ; soutenir le transit en douceur.",
            'conseils_stress' => "Le stress chronique, la fatigue et les tensions pelviennes entretiennent le terrain, et peuvent fragiliser l'immunité de façon indirecte (sommeil insuffisant, charge mentale). Pistes : respiration, cohérence cardiaque, relaxation, pauses régulières, sommeil réparateur, relâchement du plancher pelvien.",
            'conseils_routine' => "Boire abondamment. Adapter le « nettoyage » intestinal au système digestif du consultant (argile, chlorophylle, aloe vera, charbon végétal). Sauna hors phase aiguë si terrain acidifié (jamais en phase aiguë : la peau est un émonctoire secondaire des reins). Maintien d'une flore intestinale équilibrée (symbiotiques). Sous-vêtements coton, vêtements non serrés. Tisanes associant drainantes (piloselle, orthosiphon), antiseptiques (bruyère, busserole) et adoucissantes (guimauve, mauve). Ne jamais se retenir d'uriner ; uriner après les rapports pour limiter la stase urinaire.",
            'complements' => "Soutien barrière intestinale/muqueuses : L-glutamine, zinc, L-thréonine, quercétine, vitamines A et D. D-mannose ou canneberge (limite l'adhésion bactérienne). Symbiotiques/probiotiques (microbiote intestinal et vaginal, notamment après antibiotiques). Vitamine C et zinc (immunité, réparation des muqueuses). Canneberge + propolis en soutien des récidives (adhésion bactérienne et biofilm). Exemple de formule complète : DUAB Fort® Confort urinaire (Granions) — D-mannose 2000 mg, canneberge 240 mg, propolis 400 mg, bruyère 250 mg, zinc 5 mg.",
            'phytotherapie' => "Antiseptiques urinaires : busserole, bruyère, genévrier, canneberge. Diurétiques/draineurs : piloselle, orthosiphon, pissenlit, bouleau, verge d'or, vergerette, chiendent, reine des prés. Anti-inflammatoires/adoucissants des muqueuses : guimauve, mauve, plantain, cassis. Récidives : canneberge, busserole, cassis, ortie, sureau, échinacée, piloselle. Femme ménopausée (terrain hormonal) : canneberge, sauge, trèfle rouge. Gemmothérapie : bourgeon de Bruyère (drainant, antiseptique, apaisant), bourgeon de Cassis (anti-inflammatoire général), bourgeon d'Airelle rouge (cystites récidivantes, fragilité des muqueuses uro-génitales, terrain hormonal/ménopausique).",
            'aromatherapie' => "Formulations pour cystite aiguë si le consultant ne prend pas déjà d'antibiotiques : HE d'origan (carvacrol), sarriette, lavande, girofle, myrte, géranium (type GynFlash LPEV) ; ou HE origan vulgaire, cannelle de Chine, sarriette des montagnes, lemongrass, giroflier, thym CT thymol, fenouil (type Oleobiotic Pranarôm). Mycologie en soutien : Cordyceps sinensis (effet diurétique, rinçage des voies urinaires, effet réchauffant), Polyporus umbellatus (très diurétique sans perturber les électrolytes), Reishi/Ganoderma lucidum (anti-inflammatoire, immunomodulateur, calme les irritations).",
            'notes' => "Allopathie (antibiotiques) très efficace mais peut déstabiliser la flore intestinale ; objectif naturopathique : éliminer les germes tout en rééquilibrant la flore et renforçant la barrière intestinale (moins rapide mais plus respectueux du terrain). Questions d'enquête utiles : fréquence (aiguë/chronique ?), antibiotiques déjà pris, ECBU récent, état du système digestif. Piste génétique à connaître : statut FUT2 non-sécréteur (muqueuses moins protégées, microbiote urinaire moins stable) chez certaines femmes aux cystites récidivantes ; le 2'-fucosyllactose (sucre du lait maternel) est une piste ciblée à l'étude pour limiter l'adhésion bactérienne. Bilans utiles : rapport AA/EPA (inflammation), zonuline (perméabilité intestinale), analyse du microbiote intestinal, ECBU sur indication médicale. Orienter vers un médecin en cas de fièvre, sang dans les urines, douleurs lombaires, grossesse ou symptômes persistants.",
        ],
        // ==========================================
        // SYSTÈME ENDOCRINIEN
        // ==========================================
        [
            'nom' => 'Hypothyroïdie',
            'systeme' => 'Système endocrinien',
            'description' => "Production insuffisante d'hormones thyroïdiennes, ralentissant le métabolisme.",
            'causes' => "Auto-immunité (Hashimoto), carence en iode/sélénium/zinc, stress chronique, perturbateurs endocriniens, inflammation.",
            'signes_cliniques' => "Fatigue, frilosité, prise de poids, constipation, peau sèche, cheveux cassants, déprime, bradycardie.",
            'conseils_alimentation' => "Apports en iode (poissons, algues), sélénium (noix du Brésil), zinc, fer. Cuisson des crucifères (brocoli, chou).",
            'aliments_eviter' => "Crucifères crus en excès (goitrogènes), soja en excès, gluten (si Hashimoto), produits ultra-transformés.",
            'aliments_privilegier' => "Poissons gras, noix du Brésil, algues (avec prudence), oeufs, légumes colorés, huile de coco.",
            'conseils_activite' => "Activité douce à modérée. Éviter le surmenage physique. Yoga, marche, natation.",
            'conseils_stress' => "Le stress affecte directement la thyroïde via l'axe HPA. Techniques de relaxation essentielles.",
            'conseils_routine' => "Éviter les perturbateurs endocriniens (cosmétiques, plastiques). Sommeil suffisant.",
            'complements' => "Sélénium (200 µg/j). Zinc. Vitamine D. Oméga-3. Fer (si carence vérifiée).",
            'phytotherapie' => "Ashwagandha (adaptogène thyroïdien). Guggul. Rhodiola.",
            'aromatherapie' => "HE Myrte verte (régulatrice thyroïdienne - usage encadré).",
            'notes' => 'Ne jamais interférer avec le traitement Levothyrox. Travailler en complément.',
        ],
        // ==========================================
        // PEAU / PHANÈRES
        // ==========================================
        [
            'nom' => 'Eczéma',
            'systeme' => 'Peau / Phanères',
            'description' => "Dermatose inflammatoire chronique caractérisée par des plaques rouges, sèches et prurigineuses.",
            'causes' => "Terrain atopique, perméabilité intestinale, stress, allergènes, dysbiose, carences (zinc, oméga-3, vitamine D).",
            'signes_cliniques' => "Plaques rouges, sécheresse cutanée, démangeaisons intenses, suintements, épaississement de la peau.",
            'conseils_alimentation' => "Régime anti-inflammatoire. Identifier les intolérances alimentaires (journal alimentaire). Soutenir l'intestin.",
            'aliments_eviter' => "Produits laitiers, gluten (test d'éviction), oeufs (si intolérance), sucres raffinés, alcool, histaminolibérateurs.",
            'aliments_privilegier' => "Oméga-3 (petits poissons gras), huiles vierges (colza, lin), légumes colorés, curcuma, bouillon d'os.",
            'conseils_activite' => "Activité modérée. Attention à la transpiration qui peut irriter. Douche rapide après sport.",
            'conseils_stress' => "Lien psychosomatique fort. Sophrologie, hypnose, cohérence cardiaque.",
            'conseils_routine' => "Hydratation cutanée quotidienne (huile de coco, beurre de karité). Savon surgras. Vêtements en coton. Éviter les lessives parfumées.",
            'complements' => "Oméga-3 EPA/DHA. Zinc. Vitamine D. Probiotiques (souches Lactobacillus). Huile de bourrache ou onagre.",
            'phytotherapie' => "Bardane (dépurative cutanée). Pensée sauvage. Réglisse (anti-inflammatoire).",
            'aromatherapie' => "HE Lavande vraie (apaisante). HE Camomille allemande (anti-inflammatoire). Diluées dans huile de calendula.",
            'notes' => '',
        ],
        // ==========================================
        // SYSTÈME OSTÉO-ARTICULAIRE
        // ==========================================
        [
            'nom' => 'Arthrose',
            'systeme' => 'Système ostéo-articulaire',
            'description' => "Dégénérescence du cartilage articulaire, touchant principalement genoux, hanches, mains et colonne vertébrale.",
            'causes' => "Vieillissement, surpoids, surmenage articulaire, inflammation chronique, carences nutritionnelles, sédentarité.",
            'signes_cliniques' => "Douleurs articulaires à l'effort, raideur matinale, craquements, perte de mobilité, gonflement.",
            'conseils_alimentation' => "Régime anti-inflammatoire riche en oméga-3. Réduire les aliments pro-inflammatoires. Collagène.",
            'aliments_eviter' => "Sucres raffinés, viandes rouges en excès, charcuterie, aliments ultra-transformés, alcool, produits laitiers en excès.",
            'aliments_privilegier' => "Petits poissons gras, curcuma + poivre noir, gingembre, fruits rouges, légumes verts, bouillon d'os, huile d'olive.",
            'conseils_activite' => "Activité douce indispensable : natation, vélo, marche, yoga doux, Pilates. Éviter les impacts violents.",
            'conseils_stress' => "La douleur chronique génère du stress. Sophrologie, méditation, bain chaud.",
            'conseils_routine' => "Cataplasme d'argile verte sur les articulations. Bain chaud aux sels d'Epsom. Massage aux huiles.",
            'complements' => "Curcumine (biodisponible). Oméga-3. Collagène marin ou de type II. Silicium organique. Glucosamine/Chondroïtine.",
            'phytotherapie' => "Harpagophytum (griffe du diable). Cassis (bourgeons). Reine-des-prés.",
            'aromatherapie' => "HE Gaulthérie couchée (anti-inflammatoire, en massage diluée). HE Eucalyptus citronné.",
            'notes' => '',
        ],
        // ==========================================
        // SYSTÈME ENDOCRINIEN (SUITE)
        // ==========================================
        [
            'nom' => 'Fatigue surrénalienne / Épuisement de l\'axe du stress',
            'systeme' => 'Système endocrinien',
            'description' => "Épuisement fonctionnel de l'axe hypothalamo-hypophyso-surrénalien (HHS) lié à un stress chronique, avec dérèglement de la sécrétion de cortisol et retentissement sur l'énergie, le sommeil et l'immunité.",
            'causes' => "Stress chronique professionnel ou personnel, manque de sommeil, sédentarité ou excès de sport avec mauvaise récupération, alimentation hyperglucidique et sucres raffinés, excès de caféine/boissons énergisantes, déficits en zinc/magnésium/vitamines C et B, perturbateurs endocriniens, travail de nuit, traumatismes émotionnels, perfectionnisme, inflammation chronique (désensibilisation des récepteurs au cortisol).",
            'signes_cliniques' => "Fatigue chronique non améliorée par le repos, difficulté au réveil, coup de barre en milieu de journée, baisse de motivation, troubles du sommeil, sensibilité accrue au stress, baisse de libido, infections à répétition, hypoglycémies réactionnelles, cortisol matinal effondré ou profil aplati au bilan.",
            'conseils_alimentation' => "Petit-déjeuner gras/protéiné non sucré, lipides et protéines suffisants à chaque repas, attention aux pics glycémiques, repas réguliers, réduction des excitants.",
            'aliments_eviter' => "Sucres raffinés, aliments ultra-transformés, excès de caféine et boissons énergisantes, alcool, féculents raffinés en excès.",
            'aliments_privilegier' => "Œufs, poissons gras, oléagineux, légumes colorés, aliments riches en vitamine C et en vitamines B, sel de qualité en quantité suffisante, bouillons.",
            'conseils_activite' => "Activité modérée et régulière, éviter le surentraînement et l'excès de sport avec mauvaise récupération, exposition à la lumière naturelle le matin (20 min, boost du cortisol naturel).",
            'conseils_stress' => "Cohérence cardiaque, méditation, contact avec la nature, réduction de la charge mentale, thérapie en cas de traumatismes ou de perfectionnisme, respiration.",
            'conseils_routine' => "Coucher tôt et lever régulier (viser 8h de sommeil), rituel du soir sans écran, exposition à la lumière du matin, pauses dans la journée.",
            'complements' => "Magnésium bisglycinate, vitamine C, complexe vitamines B, zinc, ferritine si carence associée.",
            'phytotherapie' => "Plantes adaptogènes (rhodiole, éleuthérocoque, ashwagandha, astragale) pour soutenir la résistance non spécifique au stress et l'homéostasie.",
            'aromatherapie' => "HE Pin sylvestre et HE Épinette noire en olfaction ou diffusion le matin (tonique surrénalien), 10 minutes.",
            'notes' => "Éliminer une insuffisance surrénale primaire (Addison) ou secondaire avant toute prise en charge naturopathique ; toujours vérifier les bilans biologiques (cortisol, ACTH) avec le médecin.",
        ],
        [
            'nom' => 'Thyroïdite de Hashimoto',
            'systeme' => 'Système endocrinien',
            'description' => "Thyroïdite auto-immune la plus fréquente (environ 15 % de la population, 3 fois plus chez la femme), caractérisée par une destruction lymphocytaire progressive de la thyroïde évoluant vers une hypothyroïdie.",
            'causes' => "Prédisposition génétique (HLA B8DR3), infection virale, stress chronique, excès d'iode, irradiation, tabagisme, hormones stéroïdiennes féminines (puberté), immunomodulateurs. Facteurs aggravants : carence en vitamine D, insulino-résistance, inflammation de bas grade, intolérance au gluten (jusqu'à 80 % des cas), dysbiose/candidose (environ 50 % des cas).",
            'signes_cliniques' => "Fatigue marquée (souvent associée à une fatigue surrénalienne), frilosité, prise de poids, constipation, peau sèche, cheveux cassants, déprime, goitre ou nodule (environ 50 % des cas), anticorps anti-TPO élevés (90 %) et anti-Tg (20-50 %).",
            'conseils_alimentation' => "Diète méditerranéenne, index glycémique bas, alimentation riche en antioxydants, éviction du gluten et test d'éviction du lactose, cuisson des crucifères.",
            'aliments_eviter' => "Gluten, produits laitiers en cas d'intolérance, excès de crucifères crus (effet goitrogène), excès d'iode.",
            'aliments_privilegier' => "Poisson 2 fois par semaine (iode), noix du Brésil (sélénium), légumes colorés, curcuma associé au poivre noir.",
            'conseils_activite' => "Activité physique douce à modérée, éviter le surmenage, privilégier des pratiques qui réduisent le stress (yoga, marche).",
            'conseils_stress' => "Gestion du stress chronique, facteur aggravant direct de l'auto-immunité ; sophrologie, plantes adaptogènes, sommeil de qualité prioritaire.",
            'conseils_routine' => "Vérifier la vitamine D (cible 40-60 ng/mL), gestion de l'insulino-résistance, hygiène de vie anti-inflammatoire globale.",
            'complements' => "Sélénium (cofacteur TPO et désiodase, réduit les Ac anti-TPO), zinc, cuivre, manganèse, vitamines A/C/E, NAC, CoQ10, vitamine D, L-tyrosine associée à l'iode et au zinc.",
            'phytotherapie' => "Gugul (stimule la conversion T4→T3), Bacopa et Éleuthérocoque (adaptogènes, énergie), Réglisse et Prêle en soutien de l'auto-immunité.",
            'aromatherapie' => "Pas d'HE spécifique documentée pour Hashimoto ; privilégier les huiles de soutien du stress (Pin sylvestre, Épinette noire) en olfaction.",
            'notes' => "Pathologie avérée = prise en charge médicale préalable obligatoire, la naturopathie intervient en soutien. Ne jamais interférer avec le Levothyrox. Co-pathologies à rechercher : Biermer, lupus, polyarthrite rhumatoïde, insuffisance surrénale, SOPK. Attention, l'iode est contre-indiqué en excès dans Hashimoto.",
        ],
        [
            'nom' => 'Maladie de Basedow (hyperthyroïdie auto-immune)',
            'systeme' => 'Système endocrinien',
            'description' => "Thyroïdite auto-immune provoquant une hyperthyroïdie par anticorps anti-récepteur de la TSH (TRAK) stimulants, sans frein possible sur la production de T3/T4.",
            'causes' => "Auto-immunité (TRAK stimulants), déclencheurs : stress, infection (mimétisme moléculaire avec Yersinia enterocolitica), tabagisme (facteur de risque et d'évolution plus sévère). Touche 10 femmes pour 1 homme.",
            'signes_cliniques' => "Tachycardie, amaigrissement, nervosité, tremblements, thermophobie, diarrhée, orbitopathie basedowienne (exophtalmie), association possible à vitiligo, syndrome de Gougerot, anémie de Biermer, diabète.",
            'conseils_alimentation' => "Diète méditerranéenne, index glycémique bas, alimentation riche en antioxydants ; jus de chou en apéritif (effet goitrogène naturel qui ralentit la fixation de l'iode).",
            'aliments_eviter' => "Excès d'iode, excitants (café, thé), tabac.",
            'aliments_privilegier' => "Légumes crucifères (effet goitrogène doux), aliments riches en antioxydants.",
            'conseils_activite' => "Activité douce, éviter les efforts intenses tant que la tachycardie n'est pas stabilisée.",
            'conseils_stress' => "Le stress est un déclencheur direct ; sophrologie, plantes adaptogènes, sommeil prioritaire.",
            'conseils_routine' => "Sevrage tabagique impératif car il aggrave l'évolution et l'orbitopathie.",
            'complements' => "L-carnitine 2 à 4 g/j (inhibe la pénétration de T3/T4 dans le noyau, lutte contre la myopathie et la fatigue musculaire), antioxydants (vitamines A/C/E, sélénium, zinc).",
            'phytotherapie' => "Lycope (TM 30 gouttes 3 fois/j, antithyréotrope, inhibe la désiodase T4→T3 et l'IgG Basedow, réduit la tachycardie), Mélisse (inhibe la fixation de la TSH, anxiolytique), Lithosperme (activité antithyréotrope).",
            'aromatherapie' => "Pas d'HE spécifique documentée ; privilégier les huiles calmantes générales (Lavande vraie) pour l'anxiété associée.",
            'notes' => "Pathologie avérée = prise en charge médicale obligatoire, la naturopathie intervient en soutien uniquement. Ne jamais interférer avec le traitement médical.",
        ],
        // ==========================================
        // SYSTÈME URO-GÉNITAL (SUITE)
        // ==========================================
        [
            'nom' => 'Endométriose et adénomyose',
            'systeme' => 'Système uro-génital',
            'description' => "Maladie inflammatoire chronique œstrogéno-dépendante caractérisée par la présence de tissu endométrial en dehors de l'utérus (péritoine, ovaires, organes) ou dans le muscle utérin (adénomyose), à l'origine de douleurs pelviennes et de troubles de la fertilité. Touche environ 1 femme sur 10 en France.",
            'causes' => "Maladie multifactorielle selon la HAS : génétique (héritabilité 50 %), reflux menstruel de cellules endométriales (présent chez 90 % des femmes mais seules 10 % développent la maladie), anomalies épigénétiques et perturbateurs endocriniens in utero, hyperœstrogénie relative auto-entretenue par l'aromatase des cellules endométriosiques, déficit en progestérone (dysovulation liée au stress, à l'hypothyroïdie), dysbiose intestinale (estrobolome perturbé).",
            'signes_cliniques' => "Les « 5 D » : dysménorrhée, dyspareunie profonde, dysurie, dyschésie, douleurs pelviennes chroniques ; règles abondantes, infertilité (30 % des femmes infertiles), fatigue, dépression, troubles digestifs associés dans 50 à 60 % des cas (SII, ballonnements).",
            'conseils_alimentation' => "Alimentation anti-inflammatoire type protocole AIP (éviction du gluten et des produits laitiers), régime pauvre en FODMAPs si SII associé, jeûne intermittent selon le cycle si la vitalité le permet.",
            'aliments_eviter' => "Gluten, produits laitiers, sucres raffinés, alcool, aliments ultra-transformés qui entretiennent l'inflammation et l'hyperœstrogénie.",
            'aliments_privilegier' => "Aliments riches en oméga-3 (huile de lin, colza, poissons gras), fibres pour le drainage des œstrogènes, aliments antioxydants, curcuma.",
            'conseils_activite' => "Yoga (postures qui délient les adhérences et améliorent le transit), danse, activité douce en dehors des crises douloureuses, congé menstruel pour le repos.",
            'conseils_stress' => "Yoga nidra, sophrologie, hypnose, respiration et activation du nerf vague (expiration prolongée, cohérence cardiaque, respiration alternée) pour baisser l'inflammation et la douleur.",
            'conseils_routine' => "Bouillotte chaude, bains chauds préventifs les jours précédant les règles (diminution démontrée de l'intensité douloureuse), cataplasmes d'huile de ricin, automassages abdominaux.",
            'complements' => "Mélatonine (antioxydante et anti-inflammatoire), PEA (palmitoyléthanolamide, anti-inflammatoire et analgésique), oméga-3 (EPA), probiotiques, magnésium, vitamine D, fer, iode, vitamines B2/B6/B9/B12.",
            'phytotherapie' => "Alchémille et Achillée millefeuille (lutéotropes, tempèrent l'hyperœstrogénie), Onagre (soutien progestérone, anti-inflammatoire), Houblon et Lin (phyto-œstrogènes modulateurs), Gattilier (baisse LH/FSH/prolactine), Ortie racine, Passiflore et Mélisse (inhibition de l'aromatase), Chardon-Marie, Pissenlit, Artichaut, Radis noir et Romarin (détoxification hépatique), Framboisier (tempère les crampes utérines).",
            'aromatherapie' => "Massage bas-ventre : HE Gaulthérie couchée + HE Camomille romaine diluées dans une huile végétale, en massage circulaire ; olfaction de Petit Grain Bigarade et Lavande pour la détente du système nerveux.",
            'notes' => "Accompagnement complémentaire, ne remplace pas le traitement hormonal éventuel (agonistes GnRH, progestatifs, DIU). Repérer les intolérances alimentaires associées et travailler la réparation intestinale. L'adénomyose (atteinte du muscle utérin) répond au même terrain hyperœstrogénique et inflammatoire.",
        ],
        // ==========================================
        // SYSTÈME CARDIO-VASCULAIRE
        // ==========================================
        [
            'nom' => 'Maladies cardiovasculaires : athérosclérose, infarctus, AVC',
            'systeme' => 'Système cardio-vasculaire',
            'description' => "Ensemble des pathologies liées à l'atteinte des artères (athérosclérose) pouvant conduire à l'infarctus du myocarde ou à l'AVC ischémique — 2e cause de mortalité en France.",
            'causes' => "Facteurs modifiables (tabagisme, obésité, sédentarité, alcool, stress, mauvaise alimentation), facteurs métaboliques (HTA, hypercholestérolémie/LDL oxydé, diabète, insulino-résistance), hyperhomocystéinémie (carence en vitamines B6/B9/B12), dysbiose intestinale et voie TMA/TMAO (métabolites bactériens pro-athérogènes), inflammation vasculaire de bas grade, stress chronique agissant via l'axe PNEI et le nerf vague.",
            'signes_cliniques' => "Douleur thoracique rétrosternale irradiant dans le bras gauche, le dos ou la mâchoire (infarctus) ; déficit moteur unilatéral, aphasie ou troubles visuels d'apparition brutale (AVC) ; essoufflement, angor, douleurs des membres inférieurs (artériopathie).",
            'conseils_alimentation' => "Diète méditerranéenne, équilibre oméga-6/oméga-3, aliments à index glycémique bas, riches en antioxydants (polyphénols, caroténoïdes), réduction des viandes rouges et charcuteries.",
            'aliments_eviter' => "Viandes rouges et charcuterie en excès, graisses saturées et fritures, sucres raffinés, excès de sel, alcool, tabac.",
            'aliments_privilegier' => "Petits poissons gras (oméga-3 EPA/DHA), huile d'olive, curcuma, romarin, ginkgo biloba, aliments riches en vitamines B pour le recyclage de l'homocystéine, aliments fermentés (vitamine K2).",
            'conseils_activite' => "Activité physique régulière, adaptée et progressive ; sevrage tabagique accompagné (hypnose, Kudzu).",
            'conseils_stress' => "Cohérence cardiaque, méditation, sophrologie, plantes adaptogènes (astragale) — le stress mental a un impact cardiovasculaire direct via le nerf vague et le système immunitaire cardiaque.",
            'conseils_routine' => "Priorité absolue au sommeil réparateur, soin du microbiote (axe intestin-cœur), surveillance du cholestérol et du taux d'homocystéine.",
            'complements' => "CoQ10 et PQQ (protection mitochondriale cardiaque, indispensables en cas de traitement par statines), vitamines K2-MK7 + D3 (prévention de la calcification artérielle), oméga-3 EPA/DHA (environ 1 g/j en cardioprotection), magnésium taurate, vitamines B6/B9/B12, zinc, cuivre, sélénium, manganèse, glutathion, NAC, acide alpha-lipoïque, resvératrol, L-carnitine.",
            'phytotherapie' => "Curcuma + Romarin + Ginkgo biloba pour la prévention de l'athérome ; Astragale + Cyprès + Sureau pour la prévention de rupture de plaque ; Astragale + Ginkgo biloba + Marron d'Inde en cas de risque CV élevé associé à une insuffisance cérébrale.",
            'aromatherapie' => "Non documentée spécifiquement ; privilégier les approches de gestion du stress (cohérence cardiaque) en complément.",
            'notes' => "Prise en charge médicale impérative et urgente en phase aiguë (fenêtre thérapeutique de 3h pour l'AVC). La naturopathie intervient en prévention primaire et en accompagnement complémentaire, jamais en remplacement des anti-agrégants/anticoagulants. Toujours signaler au médecin une supplémentation en CoQ10 sous statines.",
        ],
        // ==========================================
        // SYSTÈME IMMUNITAIRE
        // ==========================================
        [
            'nom' => 'Inflammation chronique de bas grade',
            'systeme' => 'Système immunitaire',
            'description' => "Inflammation systémique persistante et subclinique qui échappe à la régulation normale et contribue à la majorité des maladies dites de civilisation (maladies auto-immunes, cardiovasculaires, diabète, arthrite, cancers).",
            'causes' => "Âge, obésité et syndrome métabolique (hyperinsulinisme pro-inflammatoire), alimentation pro-inflammatoire (viande rouge/charcuterie, huiles saturées, sucres raffinés, gluten, caséine), stress chronique (baisse du cortisol puis baisse de l'activité des Treg), manque de sommeil, perturbateurs endocriniens, métaux lourds, tabac/pollution/UV, dysbiose et hyperperméabilité intestinale.",
            'signes_cliniques' => "Douleurs chroniques (muscles, articulations, tendons, céphalées), prise de poids et résistance à l'insuline, fatigue et insomnies récurrentes, troubles de l'humeur, troubles gastro-intestinaux, infections fréquentes, irritations cutanées.",
            'conseils_alimentation' => "Régime méditerranéen ou hypotoxique, réduction des sucres raffinés, des viandes rouges et du gluten/caséine, augmentation des AGPI oméga-3 (poissons gras, lin, chanvre, colza), aliments à IG bas riches en antioxydants et phytonutriments.",
            'aliments_eviter' => "Sucres raffinés, viande rouge et charcuterie, huiles saturées et fritures, gluten et caséine en excès, alcool.",
            'aliments_privilegier' => "Poissons gras (EPA/DHA), huile de lin/chanvre/colza (ratio oméga-6/oméga-3 idéal proche de 4:1), algues, aliments riches en polyphénols.",
            'conseils_activite' => "Activité physique régulière et adaptée : effet anti-inflammatoire et augmentation des médiateurs de résolution (SPMs).",
            'conseils_stress' => "Repos, relaxation, sophrologie, plantes adaptogènes (astragale, ashwagandha) pour assainir les glandes surrénales.",
            'conseils_routine' => "Sommeil prioritaire, sevrage tabac/toxiques, soutien de la perméabilité intestinale (L-glutamine gastro-résistante, n-butyrate, pré/probiotiques, enzymes digestives).",
            'complements' => "Curcuma (ou Boswellia en cas de maladie auto-immune), quercétine, resvératrol, gingembre, phycocyanine (spiruline), astaxanthine, magnésium bisglycinate 400-600 mg/j, vitamines A/C/E, zinc, cuivre, sélénium, manganèse, acide alpha-lipoïque, NAC/glutathion, CoQ10.",
            'phytotherapie' => "Curcuma, thé vert, raisin, gingembre, boswellia, rutine et quercétine pour moduler NF-κB et les kinases ; plantes adaptogènes (astragale, ashwagandha) pour le terrain de stress.",
            'aromatherapie' => "Non spécifiquement documentée ; privilégier les approches nutritionnelles et de gestion du stress.",
            'notes' => "Toujours rechercher un foyer infectieux ignoré (dentaire, gynécologique) en cas d'inflammation systémique de bas grade persistante. Toute question sur les anti-inflammatoires (aspirine, AINS) relève du médecin.",
        ],
        [
            'nom' => 'Allergies alimentaires',
            'systeme' => 'Système immunitaire',
            'description' => "Réaction d'hypersensibilité immédiate de type I (IgE-médiée) à un aliment normalement inoffensif, en progression exponentielle depuis 1970 (30 à 40 % de la population mondiale touchée actuellement).",
            'causes' => "Dysfonctionnement conjoint du microbiote (dysbiose), des muqueuses (rupture de barrière) et du système immunitaire (défaut de tolérance, déséquilibre Th2). Les 1000 premiers jours de vie sont une période clé (microbiote maternel, mode d'accouchement, allaitement). Théorie hygiéniste : manque d'exposition aux allergènes, excès d'hygiène, antibiotiques.",
            'signes_cliniques' => "Manifestations extrêmement variables : digestives (douleurs, diarrhées), respiratoires (dysphonie, dyspnée), cutanées (urticaire, eczéma), neurologiques (céphalées, vertiges), musculo-squelettiques (arthrite, fibromyalgie). « Marche atopique » : dermatite atopique → allergie alimentaire → asthme → rhinite allergique.",
            'conseils_alimentation' => "Éviction stricte de l'aliment identifié, diversification alimentaire précoce (4 à 6 mois) pour l'induction de tolérance chez l'enfant, alimentation favorisant un microbiote diversifié.",
            'aliments_eviter' => "Lait, œuf, arachide, blé, fruits à coque, poisson, crustacés, soja, moutarde, céleri, sésame — selon l'allergène identifié par les tests.",
            'aliments_privilegier' => "Aliments favorisant la diversité du microbiote (fibres variées, aliments fermentés selon tolérance), aliments riches en oméga-3.",
            'conseils_activite' => "Activité physique adaptée en cas de composante respiratoire (asthme associé), avec trousse d'urgence à proximité si allergie sévère connue.",
            'conseils_stress' => "Accompagnement psycho-émotionnel face à la vigilance alimentaire permanente et à l'anxiété liée au risque de réaction sévère.",
            'conseils_routine' => "Carnet alimentaire, lecture systématique des étiquettes, trousse d'urgence (adrénaline auto-injectable) si prescrite.",
            'complements' => "Probiotiques ciblés pour restaurer l'équilibre du microbiote et la tolérance immunitaire, oméga-3.",
            'phytotherapie' => "Non substituable au traitement d'urgence ; approche de terrain à moyen terme sur le microbiote et la barrière intestinale.",
            'aromatherapie' => "Non indiquée en phase aiguë (risque allergique croisé) — à proscrire sans avis spécialisé.",
            'notes' => "Diagnostic médical impératif (prick-tests, IgE spécifiques, test de provocation orale). Le traitement d'urgence (adrénaline IM, antihistaminiques, corticoïdes) est médical — la naturopathie n'intervient jamais en phase aiguë mais sur le terrain, en coordination avec l'allergologue.",
        ],
        // ==========================================
        // SYSTÈME DIGESTIF (SUITE)
        // ==========================================
        [
            'nom' => 'Maladie cœliaque',
            'systeme' => 'Système digestif',
            'description' => "Maladie auto-immune déclenchée par le gluten (gliadine), entraînant une atrophie villositaire de l'intestin grêle et une malabsorption des nutriments. Touche environ 1 % de la population européenne, souvent non diagnostiquée (seulement 10 à 20 % des cas).",
            'causes' => "Prédisposition génétique (HLA-DQ2/DQ8), risque de 10 % chez les apparentés au 1er degré, facteurs associés (diabète de type 1, thyroïdite, déficit en IgA), infection virale dans l'enfance ; le gluten est le principal facteur environnemental déclenchant.",
            'signes_cliniques' => "Chez l'enfant : syndrome de malabsorption, stéatorrhée, distension abdominale, retard de croissance ; chez l'adulte : symptômes aspécifiques, ballonnements, troubles du transit, carence en fer, chevauchement avec le SII. Expressions extra-digestives : dermatite herpétiforme, ataxie au gluten.",
            'conseils_alimentation' => "Éviction totale et définitive du gluten (seul traitement reconnu), lecture attentive des étiquettes, attention aux contaminations croisées.",
            'aliments_eviter' => "Blé, seigle, orge, épeautre, kamut, triticale, avoine non certifiée, et tous les produits transformés contenant ces céréales.",
            'aliments_privilegier' => "Riz, quinoa, sarrasin, millet, maïs, pommes de terre et tous les aliments naturellement sans gluten.",
            'conseils_activite' => "Activité physique douce à modérée pour soutenir l'énergie pendant la phase de guérison de la muqueuse (6 mois à 2 ans).",
            'conseils_stress' => "Accompagner l'adaptation psychologique au changement alimentaire à vie, tenir un carnet alimentaire pour objectiver les progrès.",
            'conseils_routine' => "Interrogatoire minutieux des aliments consommés et de la temporalité des symptômes ; ne jamais commencer le régime sans gluten avant confirmation diagnostique (fausserait les résultats).",
            'complements' => "L-glutamine (cicatrisation muqueuse), zinc (réparation tissulaire), L-thréonine (production de mucus), quercétine (renforce les jonctions serrées), vitamine A (intégrité des muqueuses), fer et vitamine C si anémie, calcium et vitamine D (prévention ostéoporose), folates B9, vitamine B12, magnésium, enzymes digestives en soutien temporaire.",
            'phytotherapie' => "Réglisse DGL et guimauve (cicatrisation muqueuse gastro-intestinale), curcuma (anti-inflammatoire cicatrisant), plantain (cicatrisant intestinal), camomille (apaisante anti-inflammatoire).",
            'aromatherapie' => "Non documentée spécifiquement pour cette pathologie.",
            'notes' => "Diagnostic médical obligatoire (sérologie IgA anti-transglutaminase + biopsie duodénale) avant toute éviction. Guérison de la muqueuse en 6 mois à 2 ans sous régime strict. Suivi gastro-entérologique indispensable ; probiotiques (Lactobacillus, Bifidobacterium) en soutien du microbiote.",
        ],
        [
            'nom' => 'Intolérances alimentaires (FODMAP, histamine, hypersensibilité retardée)',
            'systeme' => 'Système digestif',
            'description' => "Réactions d'hypersensibilité à un aliment normalement inoffensif, distinctes de l'allergie : soit immunologiques retardées (type III, IgG, 2h à 72h après ingestion), soit non-immunologiques (déficit enzymatique comme la lactase ou la DAO).",
            'causes' => "Perte de tolérance immunitaire par monotonie alimentaire, dysbiose, hyperperméabilité intestinale, prise médicamenteuse, pathologie inflammatoire digestive, maldigestion/malabsorption. Les FODMAP (fructose, lactose, fructanes, galactanes, polyols) sont mal absorbés et fermentés par le côlon ; l'histamine s'accumule en cas de déficit en enzyme DAO.",
            'signes_cliniques' => "Douleurs digestives et crampes, ballonnements, flatulences, diarrhée ou constipation, rougeurs cutanées, démangeaisons, céphalées/migraines, fatigue chronique — symptômes à distance de l'ingestion (2 à 72h pour le type III).",
            'conseils_alimentation' => "Programme des 4R (Retirer, Remplacer, Réensemencer, Réparer), éviction stricte pendant 3 à 6 semaines minimum puis réintroduction progressive pour déterminer le seuil de tolérance individuel, tenue d'un carnet alimentaire.",
            'aliments_eviter' => "Sources de FODMAP (oignon, ail, blé, lactose, miel, légumineuses en excès, édulcorants) ; sources d'histamine (vin rouge, fromages affinés, poissons fumés, charcuterie, chocolat, aliments fermentés) selon la sensibilité individuelle.",
            'aliments_privilegier' => "Riz, quinoa, carottes, courgettes, banane mûre — alimentation anti-inflammatoire et alcalinisante, apport suffisant en oméga-3.",
            'conseils_activite' => "Activité physique régulière pour soutenir la digestion et réduire le stress, facteur aggravant de la dysbiose.",
            'conseils_stress' => "Gestion du stress indispensable, lien direct avec la dysbiose et la perméabilité intestinale ; techniques de relaxation.",
            'conseils_routine' => "Carnet alimentaire systématique, réintroduction progressive et méthodique aliment par aliment.",
            'complements' => "Enzymes digestives (lactase, DAO selon le cas), L-glutamine, zinc, quercétine, vitamine A pour la réparation de la barrière intestinale, probiotiques spécifiques.",
            'phytotherapie' => "Modulation du système immunitaire : cassis, curcuma, desmodium, plantain, réglisse, sureau ; anti-histaminiques naturels : cassis, plantain, réglisse ; plantes anti-biofilm : ail, canneberge, curcuma, ginkgo, ortie, prêle ; adaptogènes anti-stress : éleuthérocoque, astragale, rhodiola, safran.",
            'aromatherapie' => "Non documentée spécifiquement.",
            'notes' => "Les tests d'intolérance (IgG) sont une aide à l'orientation, jamais un outil diagnostique à eux seuls. La tolérance peut varier dans le temps et est généralement récupérable en travaillant l'axe intestin, système immunitaire et foie.",
        ],
        // ==========================================
        // SYSTÈME RESPIRATOIRE
        // ==========================================
        [
            'nom' => 'Asthme',
            'systeme' => 'Système respiratoire',
            'description' => "Affection inflammatoire chronique des bronches provoquant des crises de dyspnée sifflante par bronchoconstriction et hypersécrétion muqueuse, d'origine multifactorielle (inflammatoire, immunitaire, environnementale et neurologique).",
            'causes' => "Hérédité, réactivité anormale à des allergènes (excès Th2), déclencheurs : infections respiratoires, exercice, tabac, aspirine, stress. Le nerf vague joue un rôle dans la bronchoconstriction ; le stress peut déclencher ou aggraver une crise sans en être la cause.",
            'signes_cliniques' => "Essoufflement ou insuffisance respiratoire surtout le soir/la nuit, expiration sifflante et difficile pouvant durer plusieurs dizaines de minutes.",
            'conseils_alimentation' => "Alimentation anti-inflammatoire, réduction des sucres et graisses saturées, apport en oméga-3 (AGPI).",
            'aliments_eviter' => "Sucres raffinés, graisses saturées, allergènes alimentaires identifiés, excès de produits laitiers et de féculents.",
            'aliments_privilegier' => "Fruits et légumes frais, oméga-3, aliments peu transformés.",
            'conseils_activite' => "Respirateurs Frolov ou Samozdrav (30 min, 1 à 2 fois/jour, hors phase de crise) pour maintenir un taux de CO2 normal — le CO2 est un dilatateur naturel des vaisseaux qui réduit les spasmes bronchiques. Activité physique adaptée en complément du traitement de fond.",
            'conseils_stress' => "Gestion du stress et travail sur le système nerveux autonome (nerf vague) : la contrariété est un facteur émotionnel modulant reconnu, sans être la cause de l'asthme.",
            'conseils_routine' => "Identifier et éliminer les facteurs déclenchants (tabac, allergènes, pollution), traiter les foyers infectieux dentaires associés.",
            'complements' => "Zinc (10 à 20 mg/j, active les lymphocytes T), vitamine D, phycocyanine, gelée royale, vitamine C.",
            'phytotherapie' => "Nigelle (thymoquinone, stabilise les mastocytes et inhibe la libération d'histamine), Quercétine, Astragale et Sureau (freinent Th2, augmentent les Treg) en cure de 3 semaines à chaque changement de saison.",
            'aromatherapie' => "HE Estragon, Khella, Ylang ylang, Tanaisie annuelle, Lédon du Groenland en suppositoires (voie rectale, absorption rapide) en prévention (1/soir) ou en crise (2 à 3/j), sous accompagnement formé. HE Estragon par voie orale (comprimé neutre) en cas de composante allergique.",
            'notes' => "Ne jamais chercher à remplacer le traitement de fond médical — le naturopathe accompagne le confort, la convalescence et l'hygiène de vie en coordination avec le pneumologue. La désensibilisation aux acariens par voie orale peut être efficace pour l'asthme allergique (avis médical). Terrain à surveiller : femmes enceintes, personnes immunodéprimées.",
        ],
        [
            'nom' => 'Bronchite et infections respiratoires récidivantes (ORL)',
            'systeme' => 'Système respiratoire',
            'description' => "Inflammation aiguë ou récidivante des bronches et de la sphère ORL (rhinite, sinusite, pharyngite, laryngite, otite), d'origine virale, bactérienne ou allergique, dont la chronicité oriente vers un travail de terrain naturopathique.",
            'causes' => "Infection virale ou bactérienne, tabagisme, pollution ; en cas de récidive : excès de déchets colloïdaux (glucides, graisses saturées, produits laitiers en excès), faiblesse émonctorielle (foie, intestins, peau), déséquilibre immunitaire (excès Th2 = allergies, manque de Th1 = immunodéficience), infection dentaire chronique, dysbiose intestinale (axe intestin-poumon).",
            'signes_cliniques' => "Toux, expectorations, fièvre ; en cas de bronchite récidivante de l'enfant, au moins un épisode par mois pendant 3 mois — rechercher alors une carence en fer, un terrain allergique ou un RGO sévère.",
            'conseils_alimentation' => "Réduire les glucides, graisses saturées et féculents en excès ; remplacer les produits laitiers animaux par des végétaux ; augmenter les fruits (au lieu des sucres industriels) et les AGPI.",
            'aliments_eviter' => "Excès de sucres, graisses saturées, produits laitiers animaux, féculents raffinés.",
            'aliments_privilegier' => "Fruits frais, légumes, AGPI (oméga-3), aliments riches en zinc et en vitamine C.",
            'conseils_activite' => "Activité physique régulière pour soutenir l'immunité, en dehors des phases aiguës.",
            'conseils_stress' => "Gestion du stress : le cortisol chronique augmente les Treg mais diminue Th1, ce qui affaiblit la défense antivirale.",
            'conseils_routine' => "Ne pas nettoyer le nez les 2 premiers jours d'une rhinorrhée (le mucus contient anticorps et enzymes antiseptiques), laisser la fièvre en dessous de 38,5°C les 2 premiers jours, traiter les foyers infectieux dentaires, soigner le microbiote intestinal (axe intestin-poumon).",
            'complements' => "Zinc bisglycinate/gluconate 10 à 20 mg/j (active les lymphocytes T), probiotiques systématiques après antibiothérapie (souches Lactobacillus et Bifidobacterium), vitamine C, phycocyanine, gelée royale, vitamine D si carence.",
            'phytotherapie' => "Cure préventive de 3 semaines à chaque changement de saison : Échinacée (antivirale, stimule Th1 — à éviter en cas de maladie auto-immune active) associée à Cyprès TM (virostatique) pour les infections virales à répétition ; Astragale + Réglisse + Sureau pour les allergies à répétition ; Alchémille + Échinacea + Bardane pour les mycoses à répétition.",
            'aromatherapie' => "Phase virale (moins de 4 jours) : inhalation d'HE antivirales (Arbre à thé, Thym à linalol, Eucalyptus radié, Ravintsara) puis HE expectorantes (Laurier noble, Myrte). Phase bactérienne : HE phénolées en gélules par voie orale uniquement (Cannelle, Sariette, Giroflier, Origan, Thym à thymol) avec probiotiques obligatoires — jamais en application directe (dermocaustiques). Voie rectale possible dès 30 mois (absorption rapide, faible premier passage hépatique).",
            'notes' => "Distinguer origine virale (moins de 4 jours, pas d'antibiotique) et bactérienne/surinfection (plus de 4 jours, TDR utile pour les angines). Toujours coupler une antibiothérapie à des probiotiques. Ne jamais remplacer un avis médical en cas de fièvre élevée, de difficulté respiratoire ou chez le nourrisson.",
        ],
        // ==========================================
        // ONCOLOGIE
        // ==========================================
        [
            'nom' => 'Accompagnement naturopathique en oncologie',
            'systeme' => 'Oncologie',
            'description' => "Accompagnement complémentaire, jamais substitutif, de la personne atteinte de cancer, centré sur le soutien du terrain, la gestion des effets secondaires des traitements et l'accompagnement psycho-émotionnel de l'annonce et du parcours de soins.",
            'causes' => "Cancérisation multifactorielle : mutation de gènes suppresseurs de tumeurs et de proto-oncogènes, facteurs de risque modifiables à environ 50 % (tabac 19,8 % des cancers, alcool 8 %, alimentation déséquilibrée 5,4 %, surpoids/obésité 5,4 %), facteurs environnementaux (perturbateurs endocriniens, radiations, expositions professionnelles), inflammation chronique et stress oxydatif favorisant l'angiogenèse tumorale et l'effet Warburg (glycolyse anaérobie même en présence d'oxygène).",
            'signes_cliniques' => "Variables selon la localisation ; sur le plan psychologique, l'annonce provoque des phases de choc, réaction, retrait pouvant évoluer vers un état proche du psychotraumatisme (pensées intrusives, évitement, hypervigilance).",
            'conseils_alimentation' => "Recommandations WCRF : maintenir un poids stable et sain (IMC 18,5-25), consommer fruits, légumes, céréales complètes et légumineuses, limiter les glucides raffinés — piste ouverte par l'effet Warburg, les cellules cancéreuses privilégiant la glycolyse du glucose.",
            'aliments_eviter' => "Fast-foods et aliments ultra-transformés riches en graisses saturées et glucides raffinés, viandes rouges et charcuteries, alcool, excès de sel.",
            'aliments_privilegier' => "Fruits, légumes, céréales complètes, légumineuses ; l'allaitement est favorisé après un accouchement en prévention.",
            'conseils_activite' => "Activité physique régulière, l'un des piliers de la prévention primaire et de la qualité de vie pendant et après les traitements.",
            'conseils_stress' => "Protocole SPIKES pour l'annonce (Setting, Perception, Invitation, Knowledge, Emotions, Strategy) : écoute empathique, temps et mots justes ; accompagnement psycho-émotionnel du choc et du traumatisme de l'annonce.",
            'conseils_routine' => "Suivi des dépistages organisés selon l'âge (sein, col de l'utérus, colorectal), limitation des expositions aux facteurs de risque professionnels et environnementaux connus.",
            'complements' => "Le resvératrol est cité comme antioxydant de soutien des gènes suppresseurs de tumeurs ; toute complémentation antioxydante doit être validée avec l'équipe oncologique en raison d'interactions possibles avec la chimiothérapie ou la radiothérapie.",
            'phytotherapie' => "Aucun protocole phytothérapeutique spécifique validé dans les sources de cours ; nécessite une formation spécifique du praticien en oncologie intégrative avant toute proposition.",
            'aromatherapie' => "Non documentée ; prudence maximale requise en raison du risque d'interactions avec les traitements.",
            'notes' => "Accompagnement strictement complémentaire et non substitutif au traitement médical. Nécessite une formation spécifique du praticien en oncologie intégrative. Ne jamais interférer avec le parcours thérapeutique (chirurgie, chimiothérapie, radiothérapie). Toujours travailler en coordination avec l'équipe médicale. Trois mots-clés lors de l'annonce : le temps, l'écoute, les mots.",
        ],
        // ==========================================
        // GROSSESSE / PÉRINATALITÉ
        // ==========================================
        [
            'nom' => 'Accompagnement naturopathique de la grossesse',
            'systeme' => 'Grossesse / Périnatalité',
            'description' => "Accompagnement global de la femme de la conception au post-partum, en complément du suivi médical et sage-femme, visant à soutenir le terrain, prévenir les carences et accompagner les transformations physiques et émotionnelles de chaque trimestre. La grossesse est un état naturel, pas une maladie, mais elle sollicite fortement le foie, le pancréas et les reins (36 hormones impliquées).",
            'causes' => "Terrain à accompagner plutôt que pathologie : hypersensibilité émotionnelle liée au bouleversement hormonal, acidification du terrain au 1er trimestre, besoins accrus en micronutriments à chaque trimestre, expositions à éviter (perturbateurs endocriniens, tabac, alcool, métaux lourds que le placenta ne filtre pas).",
            'signes_cliniques' => "1er trimestre : nausées, fatigue, hypersensibilité olfactive, tension mammaire ; 2e trimestre : regain d'énergie, constipation, anémie possible ; 3e trimestre : troubles du sommeil, respiration courte, instabilité glycémique, moins bonne circulation veino-lymphatique.",
            'conseils_alimentation' => "Manger « 2 fois mieux, pas 2 fois plus », fractionner en 5 repas par jour à heures régulières (jamais de jeûne pendant la grossesse), petit-déjeuner protéiné, alimentation revitalisante et reminéralisante individualisée.",
            'aliments_eviter' => "Alcool (0 absolu), sucres rapides et produits raffinés, excitants, poissons riches en métaux lourds (thon, espadon, requin...), excès de soja, fromages au lait cru et poissons fumés (listériose), œufs et viandes crus (salmonellose).",
            'aliments_privilegier' => "Lipides de qualité (oméga-3/DHA : petits poissons gras 2 à 3 fois/semaine, huiles vierges), protéines variées (70 à 80 g/j dès le 2e trimestre), légumes et crudités bio quotidiens, super-aliments (spiruline, algues, graines germées, aliments lacto-fermentés), aliments riches en fer associés à la vitamine C.",
            'conseils_activite' => "Marche quotidienne, natation, yoga prénatal, vélo, danse, Chi Gong/Tai Chi — alterner mouvement et repos tout au long de la grossesse ; ostéopathie au moins une fois par trimestre.",
            'conseils_stress' => "Journal de grossesse et des gratitudes, méditation d'accueil des émotions, respirations (ventrale, cohérence cardiaque, alternée), relaxation (body-scan, sophrologie), haptonomie et chant prénatal pour créer le lien avec le bébé.",
            'conseils_routine' => "Siestes et repos parasympathique, adaptation du rythme de vie et du travail, hydratation d'au moins 2L par jour d'eau de qualité (moins de 180 mg/L de résidus), soin du microbiote en prévision du post-partum et de la flore du bébé.",
            'complements' => "Vitamine B9/folates (400 µg/j, idéalement 3 mois avant conception), fer (formes bisglycinate/fumarate mieux tolérées), DHA (100 à 200 mg/j supplémentaires recommandés par l'EFSA), vitamine D (à doser systématiquement), iode, calcium, magnésium, zinc, complexes grossesse dédiés.",
            'phytotherapie' => "Plantes sans danger pendant la grossesse : ortie, mélisse, verveine, tilleul, mauve, framboisier (dernier mois uniquement). À proscrire formellement : plantes drainantes, œstrogéno-mimétiques, sauge, armoise, fenouil, réglisse, valériane, millepertuis, entre autres.",
            'aromatherapie' => "Attendre le 4e mois de grossesse, voie externe diluée (3 % maximum) et olfaction uniquement, jamais de voie interne (sauf citron ponctuel avec avis). HE autorisées après le 4e mois : Camomille, Citron, Eucalyptus radié, Lavande fine, Mandarine, Ravintsara, Ylang-ylang, entre autres. HE formellement interdites toute la grossesse : toutes les HE à cétones et à phénols, Cannelle, Girofle, Romarin, Sauge officinale, Menthe poivrée, Genévrier, entre autres — liste longue à toujours vérifier avant utilisation.",
            'notes' => "Le naturopathe oriente et complète l'équipe médicale (sage-femme, médecin, ostéopathe, doula), il ne la remplace jamais. Toujours vérifier au cas par cas la liste des huiles essentielles et plantes autorisées avant toute proposition.",
        ],
        // ==========================================
        // SYSTÈME ENDOCRINIEN (LOT 2)
        // ==========================================
        [
            'nom' => 'Diabète (type 1, type 2, gestationnel et pré-diabète)',
            'systeme' => 'Système endocrinien',
            'description' => "Maladie chronique caractérisée par un excès de glucose dans le sang (hyperglycémie), lié à un défaut de production ou d'utilisation de l'insuline. Le diabète de type 2 représente environ 92 % des cas, le type 1 environ 6 %, le reste se répartissant entre diabète gestationnel et formes plus rares. Le pré-diabète (insulino-résistance) est un stade réversible avant l'installation du diabète de type 2.",
            'causes' => "Type 1 : maladie auto-immune détruisant les cellules bêta du pancréas (génétique + environnement). Type 2 : insulinorésistance progressive liée au surpoids abdominal, à la sédentarité, à une alimentation riche en sucres rapides/graisses saturées et pauvre en fibres, au stress chronique (cortisol hyperglycémiant), à la dysbiose intestinale/inflammation chronique (endotoxémie métabolique via LPS) et aux carences en magnésium, vitamine D, chrome et oméga-3. Diabète gestationnel : insulinorésistance physiologique induite par les hormones placentaires (hPL, progestérone) que le pancréas ne compense pas suffisamment.",
            'signes_cliniques' => "Type 1 : polyurie, polydipsie, perte de poids rapide, fatigue intense, glycosurie. Type 2 : évolution progressive et silencieuse, souvent découverte tardive. Pré-diabète : HbA1c entre 5,7 et 6,4 %, possible même chez une personne mince. Complications à long terme si non contrôlé : athérosclérose/infarctus/AVC, rétinopathie diabétique, néphropathie, neuropathies périphériques et pied diabétique.",
            'conseils_alimentation' => "Régime méditerranéen, réduction de l'index et de la charge glycémiques (fibres, légumes, féculents complets), fractionnement des repas, vinaigre en assaisonnement (ralentit la digestion et lisse la glycémie). Cannelle en cuisine (active GLUT4, effet hypoglycémiant). Limiter les graisses saturées (lien avec l'endotoxémie LPS). Pas de régime hypocalorique strict en cas de grossesse.",
            'aliments_eviter' => "Sucres rapides et raffinés, pain blanc/riz blanc/pommes de terre frites (IG élevé), céréales soufflées, glucose pur, graisses saturées et fritures, boissons sucrées.",
            'aliments_privilegier' => "Légumes, légumineuses, lentilles, pois chiches, fruits entiers (pomme, poire, agrumes), féculents complets, cannelle, berbérine (dans le cadre d'un avis professionnel), aliments riches en magnésium.",
            'conseils_activite' => "NEAT (objectif 10 000 pas/jour), musculation (améliore directement la sensibilité à l'insuline), natation en cas de limitations articulaires — l'activité physique réduit l'insulinorésistance indépendamment du poids.",
            'conseils_stress' => "Le cortisol du stress chronique est hyperglycémiant. Cohérence cardiaque, méditation, réduction du café (fuite de magnésium), amélioration du sommeil (le cortisol nocturne dérègle la glycémie).",
            'conseils_routine' => "Surveiller le sommeil, éviter le grignotage, répartir les glucides sur la journée, associer fibres/protéines/graisses aux glucides pour lisser la glycémie.",
            'complements' => "Magnésium (sensibilité à l'insuline), vitamine D (anti-inflammatoire), oméga-3, chrome (régulation glycémique), berbérine (hypoglycémiante, anti-inflammatoire — équivalent à la Metformine selon les études, à utiliser avec un encadrement professionnel), probiotiques ciblés (souche Akkermansia notamment) selon le profil.",
            'phytotherapie' => "Berbérine (origan, olivier, cannelle en synergie). Cannelle en cure. Toujours en coordination avec le traitement médical.",
            'aromatherapie' => "Non spécifiquement documentée dans les sources ; prudence et vérification systématique des contre-indications avec le traitement en cours.",
            'notes' => "Marqueurs à connaître : glycémie à jeun (<1,10 g/L normale, diabète si >1,26 g/L à 2 reprises), HbA1c (<5,7 % normal, 5,7-6,4 % pré-diabète, ≥6,5 % diabète), indice HOMA et QUICKI, peptide C. Le naturopathe travaille en complément du suivi médical, jamais en substitut : ne jamais conseiller d'arrêt ou de modification du traitement (insuline, metformine). Le pré-diabète est réversible avec une hygiène de vie adaptée avant l'épuisement pancréatique.",
        ],
        [
            'nom' => 'Exposition aux perturbateurs endocriniens',
            'systeme' => 'Système endocrinien',
            'description' => "Les perturbateurs endocriniens (PE) sont des substances exogènes, naturelles ou synthétiques, qui interfèrent avec la synthèse, le transport, l'action ou l'élimination des hormones. Plus de 800 substances chimiques identifiées comme PE sur environ 85 000 substances fabriquées ; l'exposition humaine est quasi universelle (taux détectables dans le sang, l'urine, le placenta, le tissu adipeux).",
            'causes' => "Sources principales : plastiques et cosmétiques (phtalates), plastiques durs et boîtes de conserve (bisphénol A/S), pesticides (organochlorés, résidus dans l'eau du robinet), parabènes des cosmétiques, retardateurs de flamme (mobilier, électronique), composés perfluorés (PFAS, ustensiles antiadhésifs), alkylphénols (détergents), hydrocarbures aromatiques (combustion). Agissent à faibles doses, sans seuil, avec effets cocktail et effets transgénérationnels via l'épigénétique ; fenêtres de vulnérabilité maximales pendant la grossesse, les 1000 premiers jours et la puberté. Mécanismes : mimétisme hormonal (agoniste), blocage de récepteur (antagoniste) ou interférence avec la synthèse/le transport/l'élimination des hormones.",
            'signes_cliniques' => "Système reproducteur : oligospermie, baisse de testostérone, endométriose, puberté précoce, dysfonction ovarienne. Thyroïde : perturbation de la synthèse hormonale. Métabolisme : obésité, diabète de type 2. Système immunitaire : allergies, asthme, maladies auto-immunes. Neuropsychiatrique : troubles de l'humeur, TDAH, troubles d'apprentissage. Cancers hormono-dépendants (sein, utérus, ovaires, testicules, prostate).",
            'conseils_alimentation' => "Privilégier le bio, le fait maison, le frais ou surgelé peu transformé. Éviter les contenants plastiques (surtout au contact du chaud) et le téflon, préférer verre et inox. Varier les espèces de poisson et limiter les poissons gras à 2 fois/semaine (mercure), éviter anguille/carpe/silure. Ustensiles de cuisine en bois.",
            'aliments_eviter' => "Aliments emballés dans du plastique chauffé, boîtes de conserve, poissons prédateurs riches en mercure, produits ultra-transformés contenant des additifs de type parabènes (E214-219) ou BHA (E320).",
            'aliments_privilegier' => "Fruits et légumes bio de saison, aliments riches en antioxydants (glutathion, curcuma, ail des ours, coriandre, pourpier) pour soutenir la détoxification.",
            'conseils_activite' => "Non spécifique ; l'activité physique régulière soutient les fonctions de détoxification globales et l'équilibre hormonal.",
            'conseils_stress' => "Réduire l'exposition à la lumière bleue le soir (inhibe la mélatonine, perturbe le rythme circadien et la sécrétion de dopamine) : écrans coupés 2-3h avant le coucher, filtres/lunettes anti-lumière bleue.",
            'conseils_routine' => "Aérer le logement 10 min/jour, limiter les produits d'entretien chimiques (préférer vinaigre blanc + bicarbonate), éviter bougies parfumées et sprays d'intérieur, choisir des cosmétiques aux labels INCI vérifiés (attention particulière chez la femme enceinte et le nourrisson), limiter les pesticides de jardinage.",
            'complements' => "Antioxydants : glutathion réduit, NAC (précurseur du glutathion), vitamines B6/B9/B12 (fatigue, immunité, préconception). Chélateurs : zéolithe clinoptilolite (piège métaux lourds, sulfates, sulfites, BPA dans l'intestin).",
            'phytotherapie' => "Plantes drainantes : coriandre (caroténoïdes, flavonoïdes), ail des ours (antioxydant et chélateur), pourpier (dépuratif, vitamine C), curcuma (piégeur de radicaux libres).",
            'aromatherapie' => "Non documentée spécifiquement pour cette thématique.",
            'notes' => "Selon l'OMS, 24 % des maladies humaines seraient imputables à des facteurs environnementaux. Le rapport Générations Futures (2020) montre que 78,5 % des quantifications de pesticides dans l'eau du robinet française correspondent à des molécules CMR et/ou PE. Approche naturopathique essentiellement préventive : réduction de l'exposition plutôt que détoxification agressive.",
        ],
        [
            'nom' => 'Préménopause et périménopause',
            'systeme' => 'Système endocrinien',
            'description' => "Étapes de transition hormonale précédant la ménopause (absence de règles depuis 12 mois consécutifs, en moyenne à 51,3 ans). La préménopause (~40 ans, âge moyen 46,5 ans) se caractérise par des cycles encore réguliers mais une évolution progressive des équilibres hormonaux ; la périménopause (âge moyen 49,5 ans) correspond à l'arrêt progressif des cycles. La baisse des œstrogènes et de la progestérone débute environ 10 ans avant la ménopause.",
            'causes' => "Préménopause : dominance en œstrogènes par dysovulation (insuffisance en progestérone), foie engorgé (recirculation des œstrogènes), excès de cortisol (vol de prégnénolone), perturbateurs endocriniens, cycles anovulatoires. Facteurs aggravants : stress chronique, carences en zinc/magnésium/B6, hypothyroïdie, sédentarité, excès de sucre/résistance à l'insuline, désynchronisation circadienne. Périménopause : chute hormonale globale et inégale (une synthèse résiduelle d'œstrogènes est assurée par l'aromatase du tissu adipeux, sous condition d'une bonne santé surrénalienne).",
            'signes_cliniques' => "Préménopause : cycles courts, spottings, SPM marqué, mastoses, kystes, fibromes, baisse de libido, constipation, ballonnements, prise de poids, irritabilité. Périménopause : cycles espacés/irréguliers, hyperménorrhées, bouffées de chaleur (durée moyenne >7 ans après la ménopause selon l'étude SWAN), sécheresse vaginale, troubles de l'humeur, troubles cognitifs/concentration, insomnie. Risques évolutifs : pathologies œstrogéno-dépendantes (fibromes, adénomyose, kystes) en préménopause ; effondrement surrénalien, risque d'ostéoporose et troubles neurologiques en périménopause.",
            'conseils_alimentation' => "Préménopause : alimentation pauvre en glucides raffinés mais riche en bons gras (Low Carb High Fat), apport en protéines (1 à 2 g/kg de poids), oméga-3 (poissons gras, graines de lin), petit-déjeuner protéiné, suppression des régimes hypocaloriques stricts. Périménopause : graisses saines indispensables (beurre, œufs, huile de coco, poissons gras, avocats), pauvre en glucides raffinés et laitages, approche LCHF/cétogène si indiquée.",
            'aliments_eviter' => "Sucres raffinés, huiles végétales industrielles pro-inflammatoires (tournesol, maïs, soja), céréales raffinées, produits ultra-transformés, margarines et graisses hydrogénées, produits laitiers écrémés allégés.",
            'aliments_privilegier' => "Beurre/ghee, œufs entiers, poissons gras (sardines, maquereaux, saumon sauvage), avocats, huile d'olive et de coco, légumes non féculents, oléagineux, produits fermentés (kéfir, choucroute, miso), graines de lin moulues (lignanes).",
            'conseils_activite' => "Sport de plein air, yoga, Qi Gong, mouvements du bassin (préménopause) ; maintien de la masse musculaire, Yoga/Tai Chi et rééducation périnéale (périménopause). Éviter la sédentarité et l'immobilité pelvienne.",
            'conseils_stress' => "Écoute active, prise de conscience de l'étape de vie traversée ('crise de la quarantaine' puis quête de sens de la cinquantaine), gestion des émotions, équilibre vie pro/perso, respect du cycle (repos pendant les règles).",
            'conseils_routine' => "Détox printanière et jeûne intermittent le soir (préménopause) ; diètes séquentielles régulières, rééducation périnéale, méthode d'observation du cycle (MOC) pour le suivi des ovulations.",
            'complements' => "Préménopause : magnésium, vitamine D3, chrome, zinc, plantes équilibrantes (alchémille, onagre, damiana, fenugrec, mélisse, griffonia). Périménopause : phosphatidylsérine, choline, tryptophane, tyrosine, DHEA si indiqué (bilan médical), soutien surrénalien préventif.",
            'phytotherapie' => "Alchémille (progestérone-like, tonique utérin), onagre, damiana, fenugrec, griffonia (préménopause). Houblon, actée à grappes noires, safran + rhodiole, trèfle rouge, graines de lin, rhodiole, schisandra, ashwagandha, éleuthérocoque, ginseng, bacopa (périménopause). Attention aux antécédents de cancer hormono-dépendant avec les phyto-œstrogènes.",
            'aromatherapie' => "Massage du ventre avec HE Basilic tropical (antispasmodique digestif, rééquilibrant hormonal), en dilution.",
            'notes' => "La ménopause est une étape évolutive naturelle et non une maladie par déficit hormonal (approche du Dr Elizabeth Bright). Les traitements hormonaux substitutifs comportent des risques documentés (étude WHI 2001) à discuter avec le médecin. En cas de règles hémorragiques : bilan thyroïdien systématique (hypothyroïdie impliquée dans ~48 % des saignements utérins anormaux) et évaluation gynécologique si fibrome/adénomyose actif.",
        ],
        // ==========================================
        // SYSTÈME NERVEUX
        // ==========================================
        [
            'nom' => 'Troubles anxieux : TAG, trouble panique, phobies et TOC',
            'systeme' => 'Système nerveux',
            'description' => "Ensemble de troubles anxieux regroupant le trouble anxieux généralisé (TAG, prévalence vie entière 5 %), le trouble panique (attaques de panique récurrentes, 1 à 3 %), les phobies spécifiques et sociales (10-12 % et 5 %) et le trouble obsessionnel compulsif (TOC, 2-3 %, 4e pathologie psychiatrique la plus invalidante). Tous impliquent une hyperactivation de l'amygdale et un déséquilibre des neurotransmetteurs (sérotonine, GABA, noradrénaline).",
            'causes' => "Multifactorielles : vulnérabilité génétique (tempérament anxieux), facteurs environnementaux (stress, traumatismes, style éducatif dénigrant ou surprotecteur), facteurs cognitifs (attribution erronée de danger, intolérance à l'incertitude, interprétation catastrophique de sensations physiologiques normales). Neurobiologie : hyperactivation de l'amygdale et du tronc cérébral, hypoactivité du cortex préfrontal (contrôle émotionnel), baisse de sérotonine et de GABA, hausse de la noradrénaline. Dysbiose intestinale et perméabilité intestinale → neuroinflammation → comportements anxio-dépressifs (axe intestin-cerveau). Pour le TOC : dysfonctionnement du circuit orbito-fronto-striato-thalamocortical et du noyau sous-thalamique.",
            'signes_cliniques' => "TAG : hypervigilance, ruminations (avenir, santé, argent), troubles de concentration/mémoire, difficultés d'endormissement, palpitations, tensions musculaires, irritabilité. Trouble panique : attaques de panique brutales (palpitations, sensation d'étouffement, peur de mourir/de perdre le contrôle) avec anxiété anticipatoire et évitement (agoraphobie possible). Phobies : peur disproportionnée et conduites d'évitement (spécifique à un objet, ou sociale généralisée). TOC : obsessions intrusives (contamination, erreur, pensées interdites) et compulsions/rituels visant à neutraliser l'anxiété. Comorbidité fréquente avec la dépression (50-70 %) et les addictions.",
            'conseils_alimentation' => "Alimentation anti-stress et anti-inflammatoire, index glycémique bas, réduction des acides gras trans, augmentation des antioxydants, équilibre oméga-6/oméga-3. Éviter les exhausteurs de goût type glutamate. Réduction des excitants (café, alcool).",
            'aliments_eviter' => "Sucres rapides, excitants (café, thé en excès), alcool, glutamate de monosodium (exhausteur excitateur), aliments ultra-transformés.",
            'aliments_privilegier' => "Aliments riches en tryptophane et en oméga-3 (EPA/DHA), légumes colorés, curcuma, quercétine, sources de magnésium et de vitamines B/D.",
            'conseils_activite' => "Activité physique douce et régulière : yoga, tai-chi, stretching. Techniques de désensibilisation progressive en cas de phobie (en lien avec un thérapeute TCC).",
            'conseils_stress' => "Cohérence cardiaque, respiration abdominale et respiration alternée, sophrologie, méditation pleine conscience, EMDR/hypnose selon le contexte, TCC en première intention pour la restructuration cognitive. Acupression et tapotement du thymus pour relâcher la tension aiguë. Programme des 4R pour l'axe intestin-cerveau.",
            'conseils_routine' => "Hygiène de sommeil stricte, arrêt des excitants, tenue d'un journal des déclencheurs, techniques de respiration à pratiquer quotidiennement (pas seulement en crise).",
            'complements' => "Magnésium, zinc, vitamines B et D, EPA/DHA, L-glutamine et N-butyrate pour la muqueuse intestinale, GABA à faible dose progressive.",
            'phytotherapie' => "Passiflore (anxiété extériorisée, hyperactivité), valériane (stress intériorisé, ruminations), aubépine (manifestations cardiovasculaires de l'anxiété), mélisse (troubles digestifs anxieux), eschscholtzia (insomnie, agitation), griffonia/5-HTP (déficit sérotoninergique, à commencer à faible dose), rhodiole et éleuthérocoque (adaptogènes du stress chronique), safran (à privilégier si le millepertuis est contre-indiqué, notamment sous pilule). Attention : millepertuis photosensibilisant et inducteur enzymatique (interactions médicamenteuses, notamment avec la pilule).",
            'aromatherapie' => "HE en olfaction pour l'agitation/anxiété : orange, lavande, marjolaine à coquilles, verveine citronnée, camomille matricaire. Mélange plexus solaire/poignets : petit grain bigarade + néroli + yuzu dilués dans HV noyaux d'abricot.",
            'notes' => "Prise en charge médicale de référence : benzodiazépines en phase aiguë uniquement (risque d'accoutumance, max 12 semaines), IRS/IRSN en traitement de fond, TCC recommandée avec un taux de succès élevé pour les phobies (90 %). L'approche naturopathique agit en amont sur le terrain (stress, microbiote, micronutrition) et ne remplace jamais un traitement psychiatrique en cours ; toujours vérifier les interactions avec les traitements allopathiques avant toute phytothérapie.",
        ],
        [
            'nom' => "Troubles de l'humeur : dépression et troubles bipolaires",
            'systeme' => 'Système nerveux',
            'description' => "L'épisode dépressif caractérisé (EDC) représente environ 90 % des troubles de l'humeur (prévalence 10 % en France, 11 % des hommes et 22 % des femmes sur la vie entière). Le trouble bipolaire de type I (alternance manie/dépression) touche environ 9 % des troubles de l'humeur, le type II alterne hypomanie et dépression.",
            'causes' => "Multifactorielle : vulnérabilité génétique (15 % de risque avec antécédent familial au 1er degré), facteurs développementaux (abus, séparations, dépression adolescente), déficits nutritionnels (tryptophane, oméga-3, acide folique, vitamines B), stress répété et perturbation des rythmes circadiens, isolement social. Physiopathologie : dérégulation des 3 systèmes monoaminergiques (sérotonine, noradrénaline, dopamine), déséquilibre glutamate/GABA, stress chronique → axe HHS activé → hypercortisolémie → baisse du BDNF → réduction du volume hippocampique (spirale dépressive), neuro-inflammation (cytokines pro-inflammatoires) et dysbiose intestinale (baisse des cannabinoïdes endogènes).",
            'signes_cliniques' => "Triade de l'EDC (≥15 jours) : humeur dépressive (tristesse pathologique, idéation suicidaire, anhédonie), ralentissement psychomoteur (aboulie, hypoactivité), signes somatiques (asthénie matinale, troubles du sommeil, troubles de l'appétit, troubles sexuels). Formes cliniques : mélancolique, anxieuse, saisonnière, masquée, trouble dysphorique prémenstruel, post-partum. Syndrome maniaque : euphorie, idées mégalomaniaques, insomnie sans fatigue, hyperphagie, comportements à risque, projets irréalistes ; durée 2 à 6 mois. Risque suicidaire élevé : 30-35 % des suicides liés à une dépression, 13-20 % chez les personnes bipolaires.",
            'conseils_alimentation' => "Équilibre alimentaire riche en tryptophane et tyrosine (précurseurs de sérotonine et dopamine/noradrénaline), oméga-3, acide folique et vitamines B. Alimentation anti-inflammatoire pour limiter la neuro-inflammation.",
            'aliments_eviter' => "Excitants (café, alcool, tabac), sucres raffinés en excès, produits ultra-transformés.",
            'aliments_privilegier' => "Poissons gras, œufs, oléagineux, légumineuses, légumes colorés riches en antioxydants (resvératrol, polyphénols).",
            'conseils_activite' => "Activité physique aérobie régulière (stimule le BDNF et améliore l'humeur), exposition à la lumière naturelle et à l'air frais.",
            'conseils_stress' => "TCC recommandée en première intention (individuelle, familiale ou de groupe), techniques de relaxation, respiration, gestion du stress pour freiner l'axe HHS.",
            'conseils_routine' => "Hygiène du sommeil stricte (horaires réguliers), exposition lumineuse ≥30 min/jour, sevrage des excitants, suivi régulier avec éducation thérapeutique sur les risques iatrogènes des antidépresseurs.",
            'complements' => "Vitamines B6/B9/B12, vitamine C, vitamine D3, vitamine E, fer, zinc, magnésium, sélénium, resvératrol, CoQ10, probiotiques/prébiotiques pour l'axe microbiote-intestin-cerveau, tryptophane et tyrosine en précurseurs.",
            'phytotherapie' => "Dépression légère à modérée à versant sérotoninergique : millepertuis (ISRS végétal, attention aux interactions médicamenteuses majeures : ISRS, anticoagulants, contraceptifs) + griffoni ; versant dopaminergique : mucuna + rhodiole. Neuro-inflammation : bacopa, curcuma, gingembre, safran. Contre-indication au millepertuis : rhodiole + safran. Adaptogènes de soutien : ginseng, éleuthérocoque, guarana.",
            'aromatherapie' => "Non spécifiquement documentée ; privilégier les approches nutritionnelles, le sommeil et la gestion du stress en complément.",
            'notes' => "1ère intention médicale : ISRS/IRSN (délai d'action 2 à 4 semaines) ; pour le trouble bipolaire, ne jamais prescrire d'antidépresseur seul (risque de virage maniaque), les thymorégulateurs sont la référence. L'approche naturopathique (mémo NEURO : Nutrition, Équilibre microbiote, Unwind/gestion du stress, Rythmes circadiens, Oxygénation) intervient en complément, jamais en substitution d'un traitement psychiatrique en cours.",
        ],
        [
            'nom' => 'Troubles de la personnalité',
            'systeme' => 'Système nerveux',
            'description' => "Traits de personnalité rigides, envahissants et peu adaptables, source de souffrance psychologique ou relationnelle, débutant à l'adolescence ou au début de l'âge adulte. Prévalence de 10 % en population générale ; le trouble borderline (6 %) est le plus fréquent. Classification en 3 clusters DSM-5 : Cluster A (psychotique : paranoïaque, schizoïde, schizotypique), Cluster B (émotionnelle : antisociale, borderline, histrionique, narcissique), Cluster C (anxieuse : évitante, dépendante, obsessionnelle-compulsive).",
            'causes' => "Facteurs génétiques (polymorphismes des systèmes de neurotransmission), traumatismes infantiles (abus, négligence), hypersensibilité émotionnelle constitutionnelle, stress chronique. Physiopathologie : hyperréactivité de l'amygdale, dérégulation dopaminergique/noradrénergique/sérotoninergique, dysfonction de l'axe HHS, hyperméthylation épigénétique de l'ADN, stress oxydatif (ROS) et neuro-inflammation (IL-6, TNF-alpha) altérant la maturation cérébrale.",
            'signes_cliniques' => "Déviation par rapport à la norme culturelle dans au moins 2 domaines : cognition, affectivité, fonctionnement interpersonnel, contrôle des impulsions. Personnalité borderline : oscillation idéalisation/désillusion, angoisses d'abandon, fluctuations de l'humeur, impulsivité, sentiment de vide, symptômes dissociatifs sous stress. Comorbidités fréquentes : addictions, dépression, troubles anxieux. Risque suicidaire élevé (2-4 %, jusqu'à 10 % chez l'adolescent), particulièrement dans le Cluster B.",
            'conseils_alimentation' => "Alimentation anti-inflammatoire et antioxydante pour réduire le stress oxydatif systémique (mécanisme impliqué dans la maturation cérébrale altérée).",
            'aliments_eviter' => "Aliments ultra-transformés, excès de sucre et de graisses saturées entretenant l'inflammation.",
            'aliments_privilegier' => "Aliments riches en antioxydants et en oméga-3, soutien du microbiote (axe intestin-cerveau).",
            'conseils_activite' => "Activité physique douce et régulière pour la régulation émotionnelle et la neuroprotection.",
            'conseils_stress' => "TCC, sophrologie, pleine conscience/relaxation ; approche bio-psycho-sociale multidisciplinaire indispensable. La psychothérapie (TCC) fonctionne en synergie avec un traitement médicamenteux éventuel.",
            'conseils_routine' => "Hygiène de vie globale de soutien du système nerveux et de l'axe HHS, régularité du sommeil.",
            'complements' => "Antioxydants et cofacteurs de neuro-nutrition (zinc, magnésium, vitamines du groupe B) en soutien de terrain, à individualiser.",
            'phytotherapie' => "Approche de terrain non spécifique documentée dans les sources ; toujours vérifier la compatibilité avec les traitements en cours (IRS, thymorégulateurs, neuroleptiques atypiques).",
            'aromatherapie' => "Non documentée spécifiquement pour cette pathologie.",
            'notes' => "Pathologie relevant du suivi psychiatrique/psychothérapeutique spécialisé. La naturopathie n'intervient qu'en accompagnement du terrain (stress oxydatif, neuro-nutrition, hygiène de vie, microbiote), jamais en remplacement du suivi. Grande prudence avec les benzodiazépines (risque accru d'agressivité et d'idées suicidaires chez le patient borderline).",
        ],
        [
            'nom' => 'Accompagnement des personnes addictes',
            'systeme' => 'Système nerveux',
            'description' => "L'addiction est une pathologie de dépendance à une substance (tabac, alcool, médicaments détournés, drogues illicites) ou à un comportement (jeux, écrans, achats compulsifs), caractérisée par une perte de contrôle de la consommation, une modification de l'équilibre émotionnel et des perturbations médicales, sociales et professionnelles.",
            'causes' => "Facteurs personnels : événements traumatisants, maladie psychiatrique, faible estime de soi, recherche de sensations, prédisposition neurobiologique et génétique — consommer avant 20-25 ans est un facteur de risque majeur de dépendance. Facteurs liés à la substance : la nicotine, l'héroïne et la cocaïne présentent un très haut risque de dépendance rapide. Facteurs environnementaux : éducation, influence des pairs, contextes festifs, environnement stressant. Mécanisme central : le circuit de la récompense dépendant de la dopamine ; les substances imitent les neurotransmetteurs et, à force de décharges répétées, provoquent une baisse de la sensibilité du circuit (état émotionnel négatif), une perte de plasticité cérébrale et un stade de craving expliquant les rechutes.",
            'signes_cliniques' => "Modification du caractère (impulsivité, troubles de mémoire et d'attention), troubles de l'humeur (notamment anxiété), symptômes de sevrage à l'arrêt (tremblements, transpiration, anxiété, insomnie, nausées ; formes graves : crises d'épilepsie, delirium tremens). Conséquences physiques selon la substance : risque cardiovasculaire et cancers (tabac), risque cognitif et tumoral (alcool), troubles neuropsychiatriques (drogues illicites), risque infectieux (drogues injectables).",
            'conseils_alimentation' => "Hydratation abondante, alimentation riche en tryptophane et tyrosine (précurseurs dopamine/sérotonine), oméga-3 et magnésium, aliments fermentés (riches en GABA, favorables au microbiote), petit-déjeuner protéiné avec bons acides gras, légumes colorés riches en polyphénols. Remplacer le café par une tisane de romarin (soutien hépatique, attention en cas d'HTA).",
            'aliments_eviter' => "Sucre et acides gras trans (à remplacer par fruits et oléagineux), excès de café.",
            'aliments_privilegier' => "Aliments fermentés, oméga-3, magnésium, tryptophane et tyrosine, légumes colorés antioxydants.",
            'conseils_activite' => "Exercice physique adapté à l'état de la personne, à son traitement et à sa phase de sevrage, en soutien du microbiote et de la récupération nerveuse.",
            'conseils_stress' => "Relaxation, respiration, soutien des organes d'élimination mis à mal (foie : desmodium, chardon-marie, NAC, vitamine B, glutathion ; pancréas : bardane, gentiane ; reins : sève de bouleau, aubier de tilleul). Lever à heure fixe.",
            'conseils_routine' => "Coordination systématique avec le médecin/psychiatre/addictologue ; vérifier la composition des compléments (teintures mère, gemmothérapie) pour éviter tout apport d'alcool chez la personne sevrée.",
            'complements' => "Carences fréquentes chez la personne alcoolique : vitamines B (surtout B1 thiamine, carencée chez 20-73 % des patients), vitamines liposolubles, antioxydants (A, E, C, sélénium, zinc), électrolytes (magnésium, phosphate, potassium).",
            'phytotherapie' => "Déficit en sérotonine : griffonia/5-HTP seul (léger/modéré) ou associé au millepertuis (modéré/sévère, nombreuses contre-indications) ; addiction du soir : griffonia + passiflore. Déficit en dopamine : mucuna seul ou associé au millepertuis ; matin mucuna + rhodiole, soir passiflore + griffonia + safran. Kudzu : plante de référence pour le sevrage tabagique, alcoolique, médicamenteux et cannabique (molécules se fixant à la place des récepteurs nicotiniques, daidzine réduisant la consommation d'alcool) — contre-indiqué en cas d'antécédent de cancer hormono-dépendant, grossesse et allaitement (phyto-œstrogènes).",
            'aromatherapie' => "Non détaillée spécifiquement dans les sources pour l'accompagnement des addictions.",
            'notes' => "RÈGLE D'OR : en première intention, toute personne addicte doit être réorientée immédiatement vers un médecin — le naturopathe n'évalue pas le degré d'addiction. Pour une personne suivie et en sevrage : informer le médecin/psychiatre, connaître le traitement en cours, ne jamais recommander de plantes agissant sur le système nerveux en cas de traitement anxiolytique/antidépresseur/addictolytique sans avis médical. Accompagnement strictement complémentaire au suivi médical.",
        ],
        [
            'nom' => 'Maladies neurodégénératives : Alzheimer, Parkinson et SLA',
            'systeme' => 'Système nerveux',
            'description' => "Maladies chroniques progressives caractérisées par la mort progressive et irréversible des neurones, liée à l'accumulation de protéines mal repliées et toxiques. La maladie d'Alzheimer représente 60-70 % des maladies neurodégénératives (MND) et touche plus d'1 million de personnes en France (1,8 million estimé en 2050) ; la maladie de Parkinson touche environ 160 000 personnes traitées ; la sclérose latérale amyotrophique (SLA, maladie de Charcot) compte environ 2 300 nouveaux cas par an.",
            'causes' => "Point commun : accumulation d'agrégats protéiques toxiques (protéine Tau hyperphosphorylée et peptide amyloïde-bêta dans Alzheimer ; alpha-synucléine et corps de Lewy dans Parkinson) qui se propagent et provoquent la mort neuronale. Cycle étiologique commun : stress oxydatif ↔ agrégation protéique ↔ excitotoxicité → dysfonction mitochondriale → apoptose, avec neuro-inflammation (activation de la microglie, cytokines TNFα/IL-1β/IL-6) et perméabilité accrue de la barrière hémato-encéphalique. Facteurs de risque : âge, prédispositions génétiques, hypertension, diabète, inflammation chronique de bas grade (« inflammaging »), glycation, toxines (métaux lourds, pesticides, champs électromagnétiques), dysbiose intestinale (axe intestin-cerveau).",
            'signes_cliniques' => "Alzheimer : troubles de la mémoire des faits récents, altérations du jugement et du langage, changements comportementaux. Parkinson : tremblement de repos, bradykinésie, rigidité musculaire, constipation, anxiété, déclin cognitif ; premier signe typique : micrographie. SLA : paralysie progressive des muscles, troubles de la parole et de la déglutition, troubles cognitifs/comportementaux dans 50 % des cas, évolution rapide vers le décès (2-3 mois en phase terminale). Aucun traitement curatif à ce jour pour ces 3 pathologies.",
            'conseils_alimentation' => "Diète méditerranéenne, index glycémique bas, riche en antioxydants, équilibre des acides gras oméga-6/oméga-3, éviction des acides gras trans et de l'huile de palme. Apport en acides aminés précurseurs des neurotransmetteurs et de leurs cofacteurs. Aliments à indice ORAC élevé : chocolat noir, noix de pécan, gingembre, cassis, ail, myrtilles.",
            'aliments_eviter' => "Acides gras trans, huile de palme, sucres raffinés, aliments ultra-transformés favorisant la glycation et l'inflammation.",
            'aliments_privilegier' => "Poissons gras (EPA/DHA), myrtilles (anthocyanosides neuroprotecteurs), curcuma, gingembre, ail, chocolat noir, aliments riches en polyphénols.",
            'conseils_activite' => "Activité physique régulière et adaptée : stimule le BDNF (facteur neurotrophique), améliore la perfusion cérébrale, réduit l'inflammaging. Activités quotidiennes stimulantes : musique, jardinage, vie sociale, voyage.",
            'conseils_stress' => "Gestion du stress avec plantes adaptogènes (ashwagandha, rhodiola), techniques corps-esprit (sophrologie, respiration) — le stress chronique aggrave la neuro-inflammation.",
            'conseils_routine' => "Qualité du sommeil prioritaire (phase de nettoyage cérébral via le système glymphatique), réduction de l'exposition aux toxines (métaux lourds, pesticides, champs électromagnétiques), stimulation cognitive régulière.",
            'complements' => "Axe neurogenèse : phosphatidylsérine, hydne hérisson (stimule le NGF), polygala tenuifolia, sélénium (inhibe l'hyperphosphorylation de Tau), iode, bacopa monnieri, guarana. Axe neurotransmission : phosphatidylcholine et huperzine A (voie cholinergique), L-tyrosine et vitamine C liposomale (voie dopaminergique), zinc + magnésium + oméga-3 (voie GABA/glutamate, anti-excitotoxique). Axe antioxydant : zinc/cuivre/manganèse (cofacteurs SOD), sélénium (GPx), acide alpha-lipoïque, NAC, glutathion, CoQ10 ubiquinol.",
            'phytotherapie' => "Resvératrol (réduit la perméabilité de la BHE, améliore la mémoire), romarin (anti-inflammatoire cérébral, soutien de la synthèse des plasmalogènes), ginkgo biloba (vascularisation cérébrale, captage glucose/O2), centella asiatica (croissance dendritique), datte (réduit les cytokines liées à la bêta-amyloïde), astaxanthine. Sauge, lavande et romarin en synergie : soutien cholinergique et dopaminergique, activation de la voie antioxydante NRF2, activation ERK/CREB/BDNF.",
            'aromatherapie' => "HE de romarin en olfaction pour le soutien cognitif ; approche à individualiser selon le profil et les traitements en cours.",
            'notes' => "Traitements allopathiques : L-Dopa pour Parkinson, inhibiteurs de l'acétylcholinestérase pour Alzheimer (efficacité controversée, déremboursés en France), stimulation cérébrale profonde. La classification naturopathique en 3 types d'Alzheimer (inflammatoire, atrophique, toxique) n'est pas validée par la médecine conventionnelle (HAS) — approche à mentionner avec prudence. Accompagnement strictement complémentaire au suivi neurologique ; en institution, privilégier les thérapies non médicamenteuses (musicothérapie, stimulation multisensorielle, aromathérapie en diffusion/voie cutanée).",
        ],
        [
            'nom' => 'Troubles du sommeil et fatigue chronique',
            'systeme' => 'Système nerveux',
            'description' => "L'insomnie chronique (troubles plus de 3 fois par semaine depuis plus de 3 mois) regroupe la difficulté d'endormissement (>20 min), les réveils fréquents ou prolongés, le réveil matinal précoce et le sommeil non réparateur, avec un retentissement direct sur l'immunité, le métabolisme, l'humeur et les fonctions cognitives.",
            'causes' => "Dérèglement de la mélatonine (hormone du sommeil produite par la glande pinéale à partir de la sérotonine, sous contrôle du noyau suprachiasmatique) : exposition à la lumière bleue des écrans en soirée (retarde l'endormissement), manque de lumière naturelle le matin, désynchronisation des rythmes circadiens. Carences en tryptophane/magnésium/vitamines B, stress chronique et hyperactivité du système nerveux sympathique, excitants (café, alcool, psychotropes), pathologies associées (RGO, hyperthyroïdie, asthme nocturne, syndrome des jambes sans repos, apnée du sommeil, dysbiose intestinale perturbant l'axe intestin-cerveau).",
            'signes_cliniques' => "Endormissement prolongé (>20 min), réveils nocturnes, réveil matinal précoce, sommeil non récupérateur, fatigue diurne, irritabilité, troubles de la concentration. Le manque de sommeil favorise le grignotage, l'hyperphagie et le risque d'obésité par dérégulation de la leptine et de l'insuline.",
            'conseils_alimentation' => "Dîner 2 à 3h avant le coucher, associer au repas du soir des aliments riches en tryptophane (dinde, poulet, œufs, noix de cajou, banane) à des glucides complexes (riz complet, quinoa, patate douce) pour favoriser l'absorption cérébrale du tryptophane. Infusions relaxantes (camomille, tilleul, verveine).",
            'aliments_eviter' => "Café, thé, boissons énergisantes en fin de journée, alcool (perturbe le sommeil paradoxal), repas trop gras ou tardifs.",
            'aliments_privilegier' => "Aliments riches en tryptophane associés à des glucides complexes, oméga-3 (poissons gras), aliments riches en magnésium.",
            'conseils_activite' => "Sport doux le soir (yoga, marche, étirements) ; éviter le sport intense dans les 2h précédant le coucher. Exposition à la lumière naturelle le matin pour synchroniser l'horloge biologique (luminothérapie en hiver).",
            'conseils_stress' => "Rituel pré-sommeil de 30 à 60 minutes (lecture, méditation, douche chaude, respiration), cohérence cardiaque, techniques de relaxation, hypnose ou sophrologie selon le profil.",
            'conseils_routine' => "Lever et coucher à heure fixe 7j/7, chambre à 18-20°C, obscure et silencieuse, arrêt des écrans après 22h (voire dès 17h chez les personnes très sensibles), pas de repas trop gras/épicé le soir.",
            'complements' => "Magnésium bisglycinate (300 mg/j réparti), oméga-3 EPA/DHA, vitamines B, tryptophane (500-1000 mg/j), 5-HTP (100-300 mg/j) ou griffonia en alternative végétale, GABA, psychobiotiques, mélatonine en supplémentation (1 à 3 mg 30-60 min avant le coucher, utile pour le décalage horaire et le vieillissement — attention aux interactions avec bêtabloquants, antidépresseurs et benzodiazépines).",
            'phytotherapie' => "Valériane (agitation nerveuse, relaxation musculaire), mélisse (stress, troubles digestifs), passiflore (endormissement, anxiété), aubépine (palpitations), ashwagandha (module le cortisol), houblon (endormissement, phyto-œstrogènes — CI antécédent de cancer du sein), eschscholtzia (sédatif), rhodiola et mucuna (humeur, dopamine), tilleul (sédatif doux).",
            'aromatherapie' => "HE Lavande officinale (diffusion ou massage nuque-pieds dilué), camomille romaine, petit grain bigarade, ylang-ylang, marjolaine à coquilles, néroli, mandarine — en diffusion ou application cutanée diluée selon la tolérance.",
            'notes' => "Toujours rechercher la cause de la cause : un même trouble du sommeil peut relever de causes très différentes (dérèglement circadien et déficit en sérotonine vs dysbiose/RGO/SOPK), nécessitant un accompagnement individualisé. Le programme des 4 à 6 cycles de 90 minutes par nuit doit être respecté ; le sommeil lent profond (réparation tissulaire, immunité) prédomine en début de nuit et le sommeil paradoxal (mémoire) en fin de nuit.",
        ],
        // ==========================================
        // SYSTÈME URO-GÉNITAL (LOT 2)
        // ==========================================
        [
            'nom' => 'Troubles de la fertilité, contraception et syndrome post-pilule',
            'systeme' => 'Système uro-génital',
            'description' => "L'infertilité se définit par l'incapacité d'un couple actif sans contraception à obtenir une grossesse après 1 an d'essais (15 à 25 % des couples concernés, répartition environ 20-30 % cause féminine, 20 % masculine, 40 % mixte, 7-10 % inexpliquée). Le syndrome post-pilule regroupe les symptômes liés à l'arrêt d'une contraception hormonale (résidus hormonaux, carences micronutritionnelles accumulées, dérèglement transitoire du cycle).",
            'causes' => "Causes féminines : troubles de l'ovulation (stress, restriction alimentaire, activité physique intense, hyperprolactinémie, dysthyroïdies), SOPK (75 % des troubles de l'ovulation), endométriose, troubles tubo-péritonéaux (séquelles d'IST). Causes masculines : anomalies du spermogramme (OATS), azoospermie, troubles métaboliques/vasculaires. Facteurs communs : âge biologique (>35 ans femme, >45 ans homme), IMC>30, perturbateurs endocriniens, tabac/alcool/drogues, stress chronique (l'axe hypothalamo-hypophyso-surrénalien active le cortisol qui entre en concurrence avec les hormones ovariennes). Syndrome post-pilule : la pilule crée des carences micronutritionnelles (fer, zinc, vitamines B, magnésium) et sollicite fortement le foie (détoxification des hormones de synthèse) et les intestins (microbiote, perméabilité).",
            'signes_cliniques' => "Infertilité inexpliquée (7-25 % des cas) malgré un bilan hormonal normal. Syndrome post-pilule : acné rebond, aménorrhée ou cycles irréguliers, syndrome prémenstruel marqué (40 % des femmes), chute de cheveux, migraines, anxiété, troubles digestifs, fatigue, brouillard mental. Dérèglements du cycle à rechercher : hyper-œstrogénie relative, cycles anovulatoires, spotting prémenstruel (insuffisance en progestérone), douleurs menstruelles à ne jamais banaliser.",
            'conseils_alimentation' => "Alimentation vivante, variée et peu transformée (3V), riche en oméga-3 et en antioxydants (fruits rouges, kiwis, légumes colorés), petit-déjeuner protéiné, alimentation alcalinisante (indice PRAL) pour soutenir le foie et réduire l'hyper-œstrogénie.",
            'aliments_eviter' => "Sources de FODMAP en excès, sucres raffinés, laitages et alcool (acidifiants), excès de café et de thé (chélateur du fer), soja en excès.",
            'aliments_privilegier' => "Poissons gras, huiles végétales de qualité, graines de chanvre décortiquées, algues, graines germées, légumes crus et aliments hépatoprotecteurs (radis noir, artichaut, curcuma, ail).",
            'conseils_activite' => "Activité physique modérée et régulière (éviter le surentraînement qui freine l'ovulation), symptothermie (température basale + glaire cervicale + col de l'utérus) pour identifier la fenêtre fertile et objectiver la reprise du cycle.",
            'conseils_stress' => "Sophrologie, cohérence cardiaque, méditation, respirations (4/7/8, carrée, alternée), HE en olfaction (laurier noble, litsée citronnée, marjolaine à coquilles), Fleurs de Bach, acupuncture, EFT — décorréler la conception de l'agenda professionnel.",
            'conseils_routine' => "Sommeil de 7 à 9h, réduction des perturbateurs endocriniens (plastiques, cosmétiques conventionnels), soin du microbiote intestinal et vaginal (estrobolome, flore à Lactobacillus).",
            'complements' => "Vitamine C et E (antioxydants, protection des gamètes), vitamine B6 (synthèse hormonale), B9/folates, B12 (véganisme), zinc (spermatogenèse, ovulation), sélénium (motilité des spermatozoïdes), oméga-3 (phase œstrogénique) et oméga-6/onagre (phase progestéronique). Post-pilule : plasma de Quinton, multivitaminé en cure courte, complexe alchémille/chardon-marie/framboisier/rhodiole.",
            'phytotherapie' => "Soutien hépatique : romarin, radis noir, artichaut, chardon-marie, pissenlit. Synchronisation du cycle : sauge officinale, cimicifuga, angélique ou framboisier en phase folliculaire ; alchémille, achillée millefeuille ou yam en phase lutéale. Post-pilule : armoise + framboisier pour les muscles utérins en cas d'aménorrhée, gattilier + onagre pour le SPM.",
            'aromatherapie' => "HE sauge sclarée et baume de Copahu en automassage abdominal pour l'acné post-pilule et les cycles irréguliers ; formules à individualiser selon les antécédents hormono-dépendants.",
            'notes' => "Le naturopathe n'est pas professionnel de la contraception et redirige systématiquement vers une sage-femme ou un gynécologue pour toute question de méthode contraceptive. Toujours explorer le versant masculin et la dimension de couple dans un bilan de fertilité. Si pas de grossesse après 12 mois d'essai malgré l'accompagnement : orientation vers un bilan médical de fertilité complet du couple.",
        ],
        [
            'nom' => 'Fibromes utérins, kystes ovariens et SMOP',
            'systeme' => 'Système uro-génital',
            'description' => "Le fibrome utérin (myome) est une tumeur bénigne de la paroi utérine touchant plus de 50 % des femmes après 30 ans, le plus souvent asymptomatique. Le kyste ovarien est un sac rempli de liquide sur ou dans l'ovaire, le plus souvent fonctionnel et résolutif spontanément. Le syndrome métabolique ovarien et polyendocrinien (SMOP/SOPK) se distingue des kystes simples par un trouble hormonal global (résistance à l'insuline, hyperandrogénie) provoquant de nombreux follicules immatures.",
            'causes' => "Fibrome : climat œstrogénique (l'estradiol stimule la prolifération cellulaire, la progestérone bloque l'apoptose des cellules du fibrome), antécédents familiaux, surpoids, nulliparité, hypovitaminose D. Kyste fonctionnel : dysfonctionnement hormonal œstro-progestéronique, follicule non libéré. Kyste organique : cystadénome, kyste chocolat (endométriosique), kyste dermoïde — sans lien avec le cycle. SMOP : résistance à l'insuline et hyperandrogénie majeures, nécessitant des changements de mode de vie durables.",
            'signes_cliniques' => "Fibrome : plus de 50 % asymptomatiques ; sinon règles abondantes, sensation de pesanteur pelvienne, pollakiurie, constipation, troubles de la fertilité. Kyste : le plus souvent indolore ; si volumineux : douleur pelvienne/dorsale, ballonnement, dyspareunie, métrorragies. SMOP : règles irrégulières, hyperandrogénie, hirsutisme, acné, prise de poids, résistance à l'insuline.",
            'conseils_alimentation' => "Réduction de l'inflammation et du climat hyperœstrogénique : légumes verts, aliments riches en bêta-carotène, jus verts chlorophylliens, aliments soutenant le foie (radis noir, artichaut, crucifères), bonnes huiles (lin, noix, cameline, onagre), antioxydants et vitamine C.",
            'aliments_eviter' => "Aliments riches en phytoœstrogènes en excès et maïs, produits laitiers (surtout de vache) et graisses saturées, gluten (blé raffiné), viande rouge, sucres rapides, sel en excès, alcool.",
            'aliments_privilegier' => "Légumes crucifères (brocoli, chou), bêta-carotène (carotte, patate douce, épinards), jus verts, huiles de qualité (lin, onagre), antioxydants (fruits rouges, agrumes, persil).",
            'conseils_activite' => "Marche et course douce (stimulation du retour veineux), trampoline doux (renforcement périnéal, circulation lymphatique), shaking, danse du ventre, pilates, yoga de décongestion du petit bassin avec pranayamas.",
            'conseils_stress' => "Soutien psycho-émotionnel : le stress est identifié comme un terrain propice aux kystes ; travail sur la relation au corps féminin, à la fertilité et à la charge mentale.",
            'conseils_routine' => "Jeûne intermittent calé sur le cycle, monodiète hebdomadaire de drainage doux, bains dérivatifs (méthode France Guillain) à partir de 3 mois post-partum, réduction des perturbateurs endocriniens (cosmétiques, eau filtrée, ustensiles de cuisine sans revêtement).",
            'complements' => "Fer en cas de règles abondantes (bisglycinate, tisane d'ortie), bromélaïne (soutien de l'autophagie tissulaire, hors repas), oméga-3, vitamine D, vitamine E, sélénium, vitamine B6, zinc, complexes régulateurs hormonaux (broccoli, vitamine E, gattilier, achillée millefeuille, alchémille, chardon-marie).",
            'phytotherapie' => "Trio astringent 'assèchant' pour les fibromes : bourse à pasteur + alchémille + achillée millefeuille, associé à une plante circulatoire (vigne rouge, hamamélis) et une plante hémostatique (persicaire ou chardon-marie) en décoction. Gattilier (stimule la progestérone, réduit le volume des fibromes en cure du 8e au 21e jour du cycle) et yam (précurseur de progestérone). Plantes œstrogènes-like à manier avec précaution : lin, fenugrec, trèfle rouge, sauge officinale, houblon, réglisse, fenouil.",
            'aromatherapie' => "HE d'estragon ou de basilic tropical (antispasmodique) et hélichryse italienne (microcirculatoire) en automassage bas-ventre. Protocole fibrome (Dr Aude Maillard) : petit grain bigaradier + romarin à verbénone + noix de muscade dans une huile végétale neutre, les 15 derniers jours du cycle.",
            'notes' => "Dans la majorité des cas, fibromes et kystes fonctionnels sont bénins et évoluent favorablement ; l'enjeu naturopathique est de soutenir le terrain hormonal et inflammatoire, en coordination avec le suivi gynécologique (échographie, bilan hormonal). Le fibrome n'augmente pas le risque de cancer de l'endomètre (structures différentes). HE de sauge sclarée à éviter en cas d'antécédent personnel ou familial de cancer hormono-dépendant.",
        ],
        [
            'nom' => 'Santé des seins : mastodynie, seins fibrokystiques et hyperprolactinémie',
            'systeme' => 'Système uro-génital',
            'description' => "Ensemble des troubles bénins de la poitrine liés aux fluctuations hormonales du cycle, de la préménopause et de la ménopause : congestion mammaire cyclique (mastodynie/mastalgie), seins fibrokystiques (mastose) touchant 20 à 40 % des femmes de 35 à 50 ans, et hyperprolactinémie pouvant provoquer galactorrhée et troubles du cycle.",
            'causes' => "Dominance des œstrogènes (hyperœstrogénie vraie ou dominance relative par baisse de la progestérone liée à une dysovulation), causes exogènes (carences nutritionnelles, pilule/THS, inflammation) et endogènes (baisse de la fonction ovarienne, détoxification hépatique altérée, dysbiose intestinale augmentant la réabsorption des œstrogènes, aromatisation par le tissu adipeux). Hyperprolactinémie : régulée par l'inhibition dopaminergique, à confirmer par bilan sanguin (recherche d'un adénome hypophysaire si besoin).",
            'signes_cliniques' => "Congestion/mastodynie cyclique dans le cadre du SPM : seins tendus, douloureux, granuleux. Seins fibrokystiques : kystes mammaires peu douloureux hors SPM, non facteurs de risque de cancer du sein mais nécessitant un suivi médical. Hyperprolactinémie : galactorrhée hors grossesse/allaitement, congestion continue, aménorrhée/oligoménorrhée, infertilité.",
            'conseils_alimentation' => "Cinq axes : nourrir le système hormonal et les tissus mammaires, soutenir le foie, éviter le surpoids, équilibrer le système hormonal en vigilant sur les perturbateurs endocriniens. Brocoli (sulforaphane, limite l'aromatase), graines de lin (lignanes modulatrices des récepteurs aux œstrogènes).",
            'aliments_eviter' => "Produits non bio et eau du robinet (perturbateurs endocriniens), laitages et fromages (facteurs de croissance IGF-1), alcool, fructose, café et charcuteries (toxiques du foie).",
            'aliments_privilegier' => "Légumes verts et choux (soutien hépatique), brocoli, graines de lin, aliments riches en iode, sélénium, vitamine K2 et vitamine D3.",
            'conseils_activite' => "Exercice physique régulier pour la circulation sanguine (apport de nutriments, évacuation des œstrogènes) et lymphatique (évacuation des toxines). Choisir un soutien-gorge adapté sans compression excessive.",
            'conseils_stress' => "Prendre soin du terrain émotionnel : le sein est lié symboliquement à la féminité, à la nourriture et à la relation au corps — offrir un espace d'écoute et de self-care.",
            'conseils_routine' => "Automassage régulier des seins (prévention du relâchement tissulaire, stimulation lymphatique, régulation hormonale, réduction des douleurs) avec des macérats de calendula ou pâquerette. Suivi gynécologique et dépistage réguliers.",
            'complements' => "Iode et sélénium (vigilance thyroïdienne), vitamine K2, collagène, vitamine D3, acides gras de qualité pour le système hormonal.",
            'phytotherapie' => "Gattilier (inhibiteur de la prolactine, dopaminergique — SPM, mastodynies), alchémille (régulateur de la progestérone, hémostatique), houblon (œstrogénique, sédatif), achillée millefeuille (hémostatique, antispasmodique), lin (modulateur des récepteurs aux œstrogènes, SOPK).",
            'aromatherapie' => "Massage des congestions mammaires (Dr Aude Maillard) : HE palmarosa (décongestionnant lymphatique) + baume de Copahu (anti-inflammatoire, antikystique) + HE laurier noble (tonique circulatoire) dans une huile de noyau d'abricot, en massage circulaire sans le mamelon — contre-indiqué en phase de cancer actif, toujours tester la tolérance.",
            'notes' => "Ne jamais confondre mastite (infectieuse, avec fièvre), mastodynie (douleur), mastose (seins fibrokystiques) et congestion (SPM). Le soutien-gorge n'est pas scientifiquement corrélé au risque de cancer du sein (source Inserm). Rééquilibrer les hormones et limiter le SPM participe à la prévention du cancer du sein, sans se substituer au dépistage organisé.",
        ],
        [
            'nom' => 'Libido, périnée et santé sexuelle féminine',
            'systeme' => 'Système uro-génital',
            'description' => "Ensemble des troubles de la sphère sexuelle et périnéale de la femme : baisse de libido, sécheresse vaginale, mycoses et cystites récidivantes, et troubles du périnée (incontinence urinaire touchant 56 % des femmes, prolapsus, douleurs pelviennes). Le périnée n'est pas qu'un muscle mais une région anatomique complète soutenant vessie, rectum et vagin.",
            'causes' => "Libido : déséquilibres hormonaux (œstrogènes, progestérone, testostérone, prolactine, hormones thyroïdiennes), cortisol du stress chronique (« vol de prégnénolone », inhibition de la production d'hormones sexuelles), fatigue physique et mentale, circuit de la récompense sur-sollicité (écrans, sucre), causes médicamenteuses (antidépresseurs, pilule progestative). Périnée : grossesse et accouchement (la relaxine détend les tissus), efforts de poussée répétés, sports à impact, constipation chronique, ménopause (chute des œstrogènes → amyotrophie et perte de collagène). Sécheresse vaginale et mycoses : fluctuations hormonales, déséquilibre du microbiote vaginal (pH normal 3,8-4,5), antibiothérapie, stress, diabète.",
            'signes_cliniques' => "Baisse de libido et de désir, sécheresse vaginale, dyspareunie. Mycoses vaginales récidivantes. Cystites (brûlures mictionnelles, envies fréquentes). Troubles du périnée : fuites urinaires à l'effort (toux, sport), pesanteur pelvienne, prolapsus, difficulté de récupération post-accouchement.",
            'conseils_alimentation' => "Alimentation riche en vitamines A et C, zinc, magnésium, oméga-3 et protéines pour nourrir le système hormonal. Légumes stimulants : céleri (soutien de la testostérone), poivron (capsaïcine, endorphines), ail et oignon (circulation). Herbes et épices aphrodisiaques : basilic, romarin, cardamome, cannelle, gingembre, safran.",
            'aliments_eviter' => "Sucre raffiné (impact hormonal majeur via l'insuline, concurrence avec les androgènes), graisses saturées et aliments ultra-transformés, excès de sel, alcool et excitants, soja en excès (perturbateur des androgènes).",
            'aliments_privilegier' => "Huîtres (zinc), cacao cru, oléagineux, légumes colorés, fibres et lactofermentés (microbiote vaginal-intestinal), collagène/bouillon d'os et silice (élasticité tissulaire du périnée).",
            'conseils_activite' => "Mouvement régulier pour la circulation pelvienne et l'équilibre hormonal (endorphines). Renforcement périnéal doux : contractions de Kegel, respiration diaphragmatique, pont pelvien, danse orientale ; éviter le crunch abdominal classique (préférer les abdominaux hypopressifs de B. de Gasquet).",
            'conseils_stress' => "Respiration pour se reconnecter aux sensations corporelles et traverser d'éventuels traumatismes sexuels enfouis, avec réorientation vers un sexologue ou psychologue si besoin. HE en olfaction : laurier noble (confiance), géranium rosat/fragonia/sauge sclarée (féminin), ylang-ylang (sensualité), patchouli, encens oliban.",
            'conseils_routine' => "Éviter les douches vaginales et nettoyants agressifs (le vagin s'autorégule), éviter vêtements serrés et sources de chaleur prolongée, uriner après chaque rapport, rééquilibrer le microbiote après une antibiothérapie (probiotiques). Rééducation périnéale prioritaire après l'accouchement (kinésithérapeute ou sage-femme), quel que soit l'âge.",
            'complements' => "Plantes adaptogènes : ashwagandha, maca, ginseng, éleuthérocoque, schizandra, cordyceps, damiana. Huile d'argousier et gel d'aloe vera en application locale pour la sécheresse vaginale.",
            'phytotherapie' => "Sécheresse vaginale : trèfle rouge, actée à grappe noire, graines de lin, shatavari (isoflavones/lignanes, sauf antécédent de cancer hormono-dépendant). Mycose vaginale : extrait de pépins de pamplemousse, propolis, lapacho ou échinacée. Cystites : canneberge, D-mannose, busserole, bruyère.",
            'aromatherapie' => "Formule locale régulatrice (Dr Aude Maillard) : HE lavande fine + pin sylvestre + sauge sclarée + sarriette des montagnes dans HV calophylle et bourrache. Formule antibactérienne cystites (D. Festy) : HE santal jaune + sarriette des montagnes + thym à thujanol + basilic tropical dans HV calophylle, en massage bas-ventre.",
            'notes' => "Le naturopathe a un rôle de prévention, d'éducation et d'écoute — jamais de diagnostic ni de traitement des pathologies sexuelles ou urinaires. Toujours rediriger vers un médecin, une sage-femme, un kinésithérapeute spécialisé ou un sexologue selon la problématique. Les fuites urinaires ne sont jamais une normalité, quel que soit l'âge.",
        ],
        // ==========================================
        // SYSTÈME DIGESTIF (LOT 2)
        // ==========================================
        [
            'nom' => 'Dysbiose intestinale : candidose digestive et SIBO',
            'systeme' => 'Système digestif',
            'description' => "La candidose digestive est une prolifération pathologique du Candida albicans (champignon commensal du tube digestif) qui, sous sa forme mycélienne virulente, traverse la muqueuse et libère des toxines systémiques. Le SIBO (Small Intestinal Bacterial Overgrowth) est une prolifération anormale de bactéries dans l'intestin grêle, lieu normalement dédié à la digestion et non à la fermentation ; l'IMO (Intestinal Methanogen Overgrowth) désigne la prolifération d'archées productrices de méthane. Le SIBO est une composante retrouvée dans environ 40 % des syndromes de l'intestin irritable (SII).",
            'causes' => "Causes communes de dysbiose : alimentation pauvre en fibres et riche en sucres raffinés, antibiothérapies répétées, déficience immunitaire, déséquilibre hormonal (hypothyroïdie), altération du pH intestinal (le Candida produit de l'ammoniac pour passer en forme virulente), rupture de l'axe intestin-cerveau via le nerf vague (stress chronique, TCA, traumatismes). SIBO : digestion affaiblie (hypochlorhydrie, insuffisance biliaire/enzymatique, IPP au long cours), troubles de la motricité (hypothyroïdie, neuropathie), troubles immunitaires, troubles mécaniques (adhérences, chirurgies). Le stress chronique élève le cortisol, ce qui a un effet hyperglycémiant favorisant la prolifération fongique et inhibe le système parasympathique (dysfonction du nerf vague).",
            'signes_cliniques' => "Candidose : symptômes peu spécifiques — ballonnements, diarrhée/constipation, prurit anal, fatigue chronique, anxiété/dépression, troubles de concentration, baisse de libido, mycoses cutanéo-muqueuses à répétition, muguet buccal, pulsions sucrées intenses. SIBO : ballonnements et distension abdominale, gaz odorants (sulfure) ou non (hydrogène), tendance diarrhéique (hydrogène) ou constipation (méthane), brûlures d'estomac, fatigue chronique, carences (fer, B12, vitamines liposolubles), troubles cutanés (acné, eczéma), brouillard mental.",
            'conseils_alimentation' => "Protocole des 4R (Retirer, Remplacer, Réensemencer, Réparer) : diminuer les glucides fermentescibles (FODMAP, amidons résistants), les sucres raffinés et les produits transformés. En cas de constipation associée, améliorer le transit diminue la fermentation.",
            'aliments_eviter' => "Sucres rapides, gluten et produits laitiers avec lactose (temporairement), alcool, aliments histaminiques en cas d'intolérance associée (vin, fromages affinés, charcuterie).",
            'aliments_privilegier' => "Ail cru, huile de coco (acide caprylique), curcuma frais, légumes verts, protéines de qualité, aliments amers pour stimuler la sécrétion digestive (gentiane, endives, roquette).",
            'conseils_activite' => "Activité physique modérée régulière pour soutenir l'immunité et le transit ; éviter le surentraînement qui aggrave le stress oxydatif et le déséquilibre du nerf vague.",
            'conseils_stress' => "Travail sur l'axe intestin-cerveau et le tonus vagal : cohérence cardiaque, respiration avant les repas, EMDR/hypnose en cas de traumatisme, exercices somatiques de reconnexion corporelle.",
            'conseils_routine' => "Approche en deux temps : court terme (1-3 mois, antifongiques/antibactériens naturels et gestion de l'hypochlorhydrie) puis long terme (>6 mois, traitement de la cause profonde : axe intestin-cerveau, carences, hygiène de vie).",
            'complements' => "Enzymes digestives (soutien de l'hypochlorhydrie), probiotiques ciblés selon le type de dysbiose, L-glutamine, zinc, magnésium biodisponible (bisglycinate, citrate).",
            'phytotherapie' => "Candidose : lapacho, échinacée, origan (antifongique, prudence sur l'estomac à jeun, préférer les formes anti-biofilm). SIBO : contre le méthane : allicine, origan, neem ; contre l'hydrogène : berbérine, origan, neem ; prokinétiques digestifs : carvi, fenouil, gingembre.",
            'aromatherapie' => "HE Tea Tree diluée en usage local pour les mycoses cutanéo-muqueuses associées ; approche générale essentiellement nutritionnelle et micronutritionnelle pour la sphère digestive.",
            'notes' => "Le test de la salive (verre d'eau) pour diagnostiquer une candidose n'est pas fiable ; privilégier une sérologie ou un dénombrement du microbiote intestinal (MOU/DMI) en laboratoire spécialisé. Diagnostic du SIBO par test respiratoire (H2 >20 ppm ou CH4 >12 ppm dans les 120 premières minutes). Toujours traiter l'intestin en priorité par rapport à une candidose vaginale associée.",
        ],
        // ==========================================
        // PEAU / PHANÈRES (LOT 2)
        // ==========================================
        [
            'nom' => 'Acné',
            'systeme' => 'Peau / Phanères',
            'description' => "Dermatose inflammatoire chronique du follicule pilosébacé due à l'augmentation de la production de sébum, la kératinisation du follicule (comédons) et la prolifération de la bactérie Cutibacterium acnes, avec formation de papules, pustules, nodules et kystes. Formes cliniques : juvénile (80 % des adolescents), tardive (femmes de plus de 25 ans, bas du visage), grave (garçons 15-20 ans) et médicamenteuse (corticoïdes, lithium, androgènes).",
            'causes' => "Déficit en prostaglandines anti-inflammatoires, dysbiose cutanée (C. acnes) et intestinale (axe intestin-peau), déséquilibre hormonal (excès d'androgènes et/ou manque de progestérone), surcharge émonctorielle du foie et des intestins, carences en zinc/vitamines A/B/D/oméga-3. Le stress aggrave l'acné via le cortisol : hausse de l'insuline (hausse des androgènes ovariens et du sébum), hausse de la DHEA, baisse de la progestérone (hyperœstrogénie/hyperandrogénie relative), favorise la dysbiose et ralentit la cicatrisation. Les aliments à IG élevé et les produits laitiers (IGF-1) augmentent l'insuline, stimulent la 5-alpha-réductase (production de DHT) et le sébum.",
            'signes_cliniques' => "Papules, pustules, nodules et kystes, souvent avant les règles (pic androgénique péri-ovulatoire). Signes d'hyperandrogénie à rechercher : séborrhée, alopécie, hirsutisme, dysménorrhée (orienter vers bilan hormonal : testostérone libre, 17-OH-progestérone, DHEA-S).",
            'conseils_alimentation' => "Éviter les aliments à IG élevé, la viande rouge, le gluten, le sucre et les produits laitiers (IGF-1) ; augmenter les oméga-3 et le curcuma anti-inflammatoire.",
            'aliments_eviter' => "Aliments à index glycémique élevé, produits laitiers (IGF-1), viande rouge, gluten, sucre raffiné.",
            'aliments_privilegier' => "Oméga-3, curcuma, légumes colorés, aliments riches en zinc et vitamine A.",
            'conseils_activite' => "Activité physique régulière pour soutenir la circulation et l'élimination émonctorielle ; identifier le maillon faible foie/intestin (constipation, langue chargée au réveil orientent vers une surcharge hépatique).",
            'conseils_stress' => "Sophrologie, relaxation, psychothérapie pour la gestion émotionnelle à long terme (le cortisol chronique aggrave directement l'acné hormonale).",
            'conseils_routine' => "Nettoyage doux au savon charbon actif, démaquillage à l'huile végétale non comédogène (jojoba, chanvre, argan, calendula — « le gras dissout le gras »), pas d'intervention active sur l'acné du nourrisson (nettoyage doux à l'eau uniquement).",
            'complements' => "Zinc (15-30 mg/j, antibactérien contre C. acnes, cicatrisant, inhibiteur de la 5-alpha-réductase), vitamines A/B/D, oméga-3, probiotiques ciblés (L. acidophilus, L. rhamnosus, Bifidobacterium) selon le type de dysbiose, PEA (anti-inflammatoire).",
            'phytotherapie' => "Hyperandrogénie : ortie racine (inhibiteur de la 5-alpha-réductase), graines de lin et de courge, houblon (chez la femme uniquement). Hyperœstrogénie/manque de progestérone : gattilier, alchémille, achillée millefeuille (J15-J25 du cycle), huile d'onagre. Émonctoires : bardane, pensée sauvage, crucifères, radis noir, curcuma, romarin. Attention : PAS de phytothérapie hormonale sous Androcur, ni de plante hépatique agressive sous Roaccutane.",
            'aromatherapie' => "HE antibactériennes en application locale diluée : tea tree, lavande, géranium rosat (équilibrant du sébum), ciste ladanifère et hélichryse italienne pour la cicatrisation, dans une huile végétale non comédogène.",
            'notes' => "Traitements allopathiques de référence : rétinoïdes locaux, peroxyde de benzoyle, zinc, antibiotiques locaux (formes légères) ; Roaccutane (isotrétinoïne, tératogène, contraception stricte obligatoire, suivi hépatique/lipidique) et Androcur (anti-androgène) pour les formes sévères. Après l'arrêt de ces traitements, prévoir une détoxification hépatique (phases I et II) et un soutien du microbiote cutané et intestinal. L'accompagnement naturopathique reste complémentaire et non substitutif au suivi dermatologique.",
        ],
        [
            'nom' => 'Rosacée',
            'systeme' => 'Peau / Phanères',
            'description' => "Maladie inflammatoire chronique du visage associant rougeurs, couperose et papulopustules, touchant surtout la femme de 30 à 50 ans à peau claire ; peut affecter les yeux (rosacée oculaire). Quatre formes : vasculaire (érythro-couperose, flushes), papulopustuleuse, hypertrophique (rhinophyma) et oculaire.",
            'causes' => "Anomalie de la vascularisation (dilatation des vaisseaux, altération de l'endothélium), dysbiose du microbiote cutané (acarien Demodex folliculorum), dysbiose intestinale (candidose notamment), prédisposition génétique (peau claire, yeux clairs, type nordique), déficit en prostaglandines anti-inflammatoires. Facteurs aggravants : climat (vent, soleil, froid), sources de chaleur (bain, sauna, sport intensif), alcool, plats épicés, boissons chaudes, stress et émotions fortes.",
            'signes_cliniques' => "Forme vasculaire : bouffées de chaleur, rougeurs permanentes (érythrose), couperose (télangiectasies). Forme papulopustuleuse : papules et pustules sur fond de rougeurs. Forme hypertrophique : rhinophyma (aspect rouge et soufflé du nez). Peut coexister avec un psoriasis sur le même terrain inflammatoire chronique, bien que les mécanismes soient différents (vasculaire/immunitaire versus auto-immun).",
            'conseils_alimentation' => "Alimentation anti-inflammatoire, apport en oméga-3 et oméga-7.",
            'aliments_eviter' => "Alcool, plats épicés, boissons très chaudes.",
            'aliments_privilegier' => "Aliments riches en oméga-3 et oméga-7, alimentation anti-inflammatoire globale.",
            'conseils_activite' => "Activité physique modérée, massage drainant, douche écossaise pour la microcirculation ; éviter les efforts intenses générant une forte chaleur corporelle.",
            'conseils_stress' => "Le stress est un facteur déclencheur majeur (hyperréactivité vasculaire cutanée) : techniques de relaxation à intégrer systématiquement.",
            'conseils_routine' => "Éviter les facteurs aggravants (chaleur, soleil direct, sport intensif sans protection), rééquilibrer le microbiote intestinal selon le type de dysbiose identifié.",
            'complements' => "Non spécifiquement détaillés dans les sources ; suivre les principes généraux anti-inflammatoires (oméga-3/7).",
            'phytotherapie' => "Approche de soutien de la microcirculation et anti-inflammatoire, en complément du traitement dermatologique (métronidazole, ivermectine dans les formes sévères).",
            'aromatherapie' => "HE apaisantes et microcirculatoires en application locale diluée : ciste ladanifère, camomille allemande, lavande aspic, hélichryse italienne, dans une HV de calendula ou calophylle inophylle. Hydrolats pour la rosacée oculaire : bleuet, camomille allemande, hamamélis, hélichryse italienne.",
            'notes' => "Pathologie multifactorielle vasculaire, immunitaire et microbienne — pas uniquement liée au foie. Toujours orienter vers un dermatologue pour confirmer la forme clinique et écarter d'autres diagnostics différentiels ; accompagnement naturopathique en soutien du terrain (microcirculation, microbiote, gestion du stress).",
        ],
        [
            'nom' => 'Psoriasis',
            'systeme' => 'Peau / Phanères',
            'description' => "Maladie cutanée inflammatoire et auto-immune chronique caractérisée par des plaques érythématosquameuses (rouges et squameuses), le plus souvent aux coudes, genoux, dans le dos et sur le cuir chevelu (une forme localisée au cuir chevelu seul est possible), liée à un renouvellement cutané accéléré (4-6 jours au lieu de 3 semaines).",
            'causes' => "Activation des lymphocytes T CD4+ vers les voies Th1/Th17/Th22 (production d'IL-17, IL-22, IFN-gamma, TNF-alpha) provoquant l'hyperkératose des kératinocytes, avec un déficit en lymphocytes T régulateurs. Dysbiose intestinale (axe intestin-peau) et cutanée (Staphylococcus aureus), stress et choc émotionnel (facteur déclencheur fréquent bien documenté), déséquilibre acido-basique, hérédité (antécédents familiaux dans environ 40 % des cas, terrain auto-immun), certains médicaments (lithium, bêta-bloquants).",
            'signes_cliniques' => "Plaques érythématosquameuses, formes en plaques, en gouttes, pustuleuses ou érythrodermiques. Toujours rechercher un rhumatisme psoriasique associé (douleurs articulaires) et des antécédents familiaux de maladies auto-immunes.",
            'conseils_alimentation' => "Réduction des aliments à IG élevé et pro-inflammatoires, augmentation des oméga-3/7, curcuma et gingembre ; alimentation alcalinisante.",
            'aliments_eviter' => "Aliments à index glycémique élevé, aliments pro-inflammatoires (sucres raffinés, graisses saturées, produits ultra-transformés).",
            'aliments_privilegier' => "Oméga-3 et oméga-7, curcuma, gingembre, aliments alcalinisants (légumes verts).",
            'conseils_activite' => "Activité physique douce et régulière pour soutenir l'équilibre immunitaire et réduire l'inflammation systémique.",
            'conseils_stress' => "EMDR, EFT, hypnose, plantes adaptogènes — la gestion du stress est un levier majeur car un choc émotionnel est un déclencheur fréquemment rapporté.",
            'conseils_routine' => "Alcaliniser l'alimentation, plantes diurétiques, cure de chlorophylle en cas de dysbiose associée ; exclure les intolérances alimentaires identifiées.",
            'complements' => "L-glutamine, zinc, vitamine A, quercétine, vitamine D (augmente les lymphocytes T régulateurs).",
            'phytotherapie' => "Astragale, curcuma, réglisse, sureau (à utiliser avec prudence en cas de traitement immunosuppresseur, car immunostimulant), ortie piquante, reine-des-prés.",
            'aromatherapie' => "HE ciste ladanifère, tea tree et myrrhe en application locale diluée (mêmes précautions que pour l'eczéma sévère).",
            'notes' => "Le sureau est déconseillé ou à utiliser avec prudence en cas de maladie auto-immune active ou de traitement immunosuppresseur/biothérapie en cours (effet immunostimulant). Traitements allopathiques : émollients et dermocorticoïdes/dérivés de vitamine D3 en 1ère intention, puvathérapie et biothérapies anti-TNF/anti-IL dans les formes sévères. Toujours travailler en coordination avec le dermatologue, sans jamais interférer avec un traitement biologique en cours.",
        ],
        // ==========================================
        // SYSTÈME OSTÉO-ARTICULAIRE (LOT 2)
        // ==========================================
        [
            'nom' => 'Pathologies ostéo-articulaires : ostéoporose, arthrites inflammatoires, goutte et troubles musculo-tendineux',
            'systeme' => 'Système ostéo-articulaire',
            'description' => "Ensemble des pathologies ostéo-articulaires distinctes de l'arthrose mécanique : l'ostéoporose (diminution progressive de la trame protéique osseuse et déséquilibre ostéoblastes/ostéoclastes), les arthrites inflammatoires aseptiques (polyarthrite rhumatoïde, spondylarthrite ankylosante) et microcristallines (goutte, chondrocalcinose), ainsi que les troubles musculo-tendineux (tendinites, crampes, syndrome des jambes sans repos et fibromyalgie), qui partagent un terrain commun d'acidification et d'inflammation.",
            'causes' => "Ostéoporose : chute des œstrogènes à la ménopause (perte de protection du tissu osseux), âge (baisse de la synthèse de collagène dès 25 ans), sédentarité, carence en calcium/protéines/vitamine D, alcool et tabac, causes endocriniennes (hyperparathyroïdie, corticoïdes/Cushing). Arthrites inflammatoires : dysfonctionnement du système immunitaire, perméabilité intestinale (axe intestin-immunité) ; prédisposition génétique HLA-B27 pour la spondylarthrite ankylosante. Goutte : excès d'acide urique lié aux aliments riches en purines (viandes rouges, abats, alcool). Troubles musculo-tendineux : microtraumatismes répétés, terrain acidifié (excès de protéines animales et de fromages à pâte dure, insuffisance de fruits/légumes, stress, activité physique excessive — voir PRAL), déficit en fer/dopamine (syndrome des jambes sans repos), déficit en coenzyme Q10 (blessures musculaires à répétition). Fibromyalgie : cause inconnue, lien possible avec les métaux lourds (amalgames dentaires).",
            'signes_cliniques' => "Ostéoporose : fractures du poignet/humérus/col du fémur, tassements vertébraux, souvent découverte tardive (ostéopénie précède). Polyarthrite rhumatoïde/spondylarthrite : douleurs articulaires nocturnes, raideur matinale prolongée, articulation gonflée. Goutte : crise articulaire aiguë très douloureuse (souvent gros orteil). Tendinites : douleur à l'insertion tendineuse (épaule, coude, cheville, talon). Fibromyalgie : douleurs diffuses sans anomalie biologique, au moins 11 des 18 points douloureux à la palpation, fatigue matinale, troubles du sommeil, syndrome dépressif associé possible. Syndrome des jambes sans repos : besoin irrépressible de bouger les jambes au repos, gênant le sommeil.",
            'conseils_alimentation' => "Alimentation anti-inflammatoire, alcalinisante et reminéralisante : riche en fruits et légumes (PRAL négatif), protéines suffisantes, calcium. Limiter les aliments riches en purines en cas de goutte.",
            'aliments_eviter' => "Excès de protéines animales et de fromages à pâte dure (acidifiants), viandes rouges et abats et alcool (goutte), sucres raffinés, alcool et tabac (ostéoporose).",
            'aliments_privilegier' => "Fruits et légumes alcalinisants, calcium et protéines de qualité (ostéoporose), petits poissons gras et curcuma (anti-inflammatoire), aliments riches en tyrosine (protéines animales/végétales, tofu, algues) en cas de syndrome des jambes sans repos.",
            'conseils_activite' => "Activité physique en charge (seule à stimuler la formation osseuse) pour l'ostéoporose, activité douce avec étirements pour les tendinites, endurance plutôt qu'efforts courts pour les crampes du sportif.",
            'conseils_stress' => "Sophrologie et techniques de relaxation, en particulier pour la fibromyalgie (massage en effleurage uniquement, personne très sensible) et le déclenchement des poussées inflammatoires.",
            'conseils_routine' => "Désacidifier et reminéraliser le terrain (alimentation, complémentation ciblée), techniques manuelles (massages, ostéopathie, kinésithérapie), hydrothérapie (bouillotte), cataplasmes d'argile verte répétés jusqu'à disparition des symptômes.",
            'complements' => "Ostéoporose : calcium, vitamine D, collagène marin de type II. Tendinites/articulations : glucosamine et chondroïtine sulfate (efficacité clinique comparable au paracétamol/AINS sur la douleur, effet persistant 2 mois après l'arrêt), collagène marin, cassis et prêle (synthèse de protéoglycanes), manganèse. Coenzyme Q10 (forme ubiquinol après 40 ans) en cas de blessures musculaires à répétition. Syndrome des jambes sans repos : fer bisglycinate si ferritine basse (<75 µg/mL), L-tyrosine si végétalien.",
            'phytotherapie' => "Anti-inflammatoire articulaire : harpagophytum (griffe du diable, anti-métalloprotéases), saule blanc et reine-des-prés (dérivés salicylés, inhibiteurs de la COX2). Curcuma (immunomodulant, limite la dégradation du cartilage). Goutte : hydratation abondante en complément de la réduction des purines.",
            'aromatherapie' => "Décontractant musculaire : lavandin super, romarin à camphre. Réparateur tissulaire : hélichryse italienne (CI cancer hormono-dépendant, remplacer par pin sylvestre). Analgésique : gaulthérie couchée, clou de girofle à faible dose. Anti-inflammatoire : eucalyptus citronné, gingembre, laurier noble.",
            'notes' => "Toujours orienter vers le médecin pour une arthrite septique (antibiothérapie ciblée) et vérifier les traitements en cours (AINS, corticoïdes, colchicine, bisphosphonates). Pour les maladies auto-immunes articulaires (polyarthrite rhumatoïde, spondylarthrite), l'axe naturopathique prioritaire est la modulation immunitaire et le travail de la perméabilité intestinale, en complément strict du traitement de fond prescrit.",
        ],
        // ==========================================
        // ONCOLOGIE (LOT 2)
        // ==========================================
        [
            'nom' => 'Accompagnement des effets secondaires des traitements oncologiques',
            'systeme' => 'Oncologie',
            'description' => "Accompagnement naturopathique intégratif, ciblé sur les effets secondaires spécifiques de chaque type de traitement oncologique conventionnel : chimiothérapie, radiothérapie, thérapies ciblées, hormonothérapie, immunothérapie, curiethérapie et cryothérapie. Approche toujours complémentaire, jamais substitutive, nécessitant une connaissance précise du protocole médical en cours (molécules, rythme, cytochromes P450) avant toute proposition.",
            'causes' => "Chimiothérapie : agents cytostatiques/cytotoxiques (alkylants, sels de platine, taxanes, antimétabolites...) provoquant hématotoxicité, toxicité gonadique, mucites, nausées. Radiothérapie : effets à partir du 10e jour de traitement pouvant persister plusieurs semaines/mois, parfois définitifs. Hormonothérapie : déplétion ou blocage hormonal prolongé (années), avec risque d'ostéoporose, de troubles métaboliques et cardiovasculaires. Immunothérapie : levée des freins immunitaires pouvant provoquer des réactions auto-immunes multisystémiques. Radiochimiothérapie concomitante : effets cumulatifs et additifs des deux traitements.",
            'signes_cliniques' => "Chimiothérapie : nausées/vomissements, diarrhées ou constipation, hépatotoxicité, leucopénie/thrombopénie/anémie, mucites buccales, chute des cheveux et ongles fragilisés, cardiotoxicité, troubles circulatoires, neurotoxicité, fatigue, anxiété/troubles du sommeil, douleurs. Radiothérapie : brûlures cutanées (jamais rien appliquer avant une séance), fibrose tissulaire tardive. Hormonothérapie : bouffées de chaleur, prise de poids, troubles gynécologiques (kystes, sécheresse vaginale), ostéoporose, arthralgies, risques cardiovasculaires et thromboemboliques. Immunothérapie : troubles pulmonaires, digestifs, rénaux, hépatiques, cutanés et endocriniens d'origine auto-immune.",
            'conseils_alimentation' => "Formules liquides sans alcool ni agents sucrants pendant les traitements ; alimentation adaptée selon l'effet secondaire (légère et fractionnée en cas de nausées, riche en fibres et probiotiques en cas de constipation).",
            'aliments_eviter' => "Alcool, pamplemousse (jus et chair, inhibiteur du CYP450, interactions avec de nombreuses molécules de chimiothérapie), aliments riches en fer et cuivre sans avis médical (le métabolisme du fer est impliqué dans la dissémination tumorale).",
            'aliments_privilegier' => "Selon la phase : jus de myrtille (réduit la diarrhée), eau citronnée et jus de grenade (nausées, hors jours de traitement), aliments riches en protéines pour la cicatrisation et la récupération.",
            'conseils_activite' => "Activité physique adaptée et progressive, essentielle pour la qualité de vie pendant et après les traitements ; contribue à limiter la fatigue chronique et le risque cardiovasculaire des hormonothérapies.",
            'conseils_stress' => "Sophrologie, yoga, méditation, shiatsu, acupuncture, relaxation guidée pour l'anxiété et les troubles du sommeil associés aux traitements et à l'annonce diagnostique.",
            'conseils_routine' => "Ne jamais appliquer de produit sur la peau avant une séance de radiothérapie (risque de brûlure grave) ; soins locaux uniquement après les séances (aloe vera, calendula, propolis). Toujours vérifier le protocole précis (molécules, demi-vie, métabolisme CYP450) avant toute proposition de complément.",
            'complements' => "Chimiothérapie : probiotiques, magnésium, vitamine D, oméga-3 (attention : arrêter les oméga-3 pendant la radiothérapie). Radiothérapie : vitamine D, silicium organique, alkylglycérols (avant/pendant). Hormonothérapie : vitamine D3/K2 + calcium + magnésium + B6 pour l'ostéoporose, CoQ10 pour la fatigue oxydative. Cardiotoxicité : CoQ10, oméga-3 (attention à l'aspirine associée).",
            'phytotherapie' => "Nausées : gingembre, desmodium, angélique. Constipation : aloe arborescens. Hépatotoxicité : desmodium, chardon-marie (interfère avec le cytochrome, prudence), chrysanthellum, romarin (stimulant, à doser). Fatigue/immunité : éleuthérocoque, rhodiola (prudence selon le cancer), argousier, cassis. Anxiété/sommeil : passiflore, eschscholtzia, valériane. Hormonothérapie : AUCUN remède à effet hormone-like n'est autorisé (phyto-œstrogènes proscrits).",
            'aromatherapie' => "Après les séances de radiothérapie uniquement : HE lavande vraie, camomille allemande, tea tree en soins locaux très dilués (jamais avant une séance). Prudence maximale et vérification systématique des interactions avec le traitement en cours pour toute huile essentielle pendant la chimiothérapie.",
            'notes' => "Contre-indications majeures à connaître : millepertuis (interactions médicamenteuses), pamplemousse (inhibiteur CYP450), L-glutamine/fer/cuivre à évaluer au cas par cas (les cellules cancéreuses utilisent la glutamine et le fer), argile/zéolithe/charbon actif (absorption des médicaments), plantes hormone-like (proscrites sous hormonothérapie), plantes photosensibilisantes sous chimiothérapie. Accompagnement nécessitant une formation spécifique en oncologie intégrative et une coordination permanente avec l'équipe médicale ; jamais de substitution au traitement en cours.",
        ],
        // ==========================================
        // GROSSESSE / PÉRINATALITÉ (LOT 2)
        // ==========================================
        [
            'nom' => 'Post-partum : maux courants, allaitement, baby blues et dépression post-partum',
            'systeme' => 'Grossesse / Périnatalité',
            'description' => "Les suites de couches désignent la période allant de l'accouchement au retour des règles : retour à la normale des fonctions de l'organisme, installation de la lactation, grandes fluctuations hormonales et réadaptation physique et psychique. Bernadette de Gasquet parle d'une véritable « entorse physiologique » impliquant une grande vulnérabilité physique, psychique et émotionnelle pendant ce 4e trimestre.",
            'causes' => "Chute hormonale brutale après l'accouchement (œstrogènes, progestérone), grande fatigue physique et nerveuse liée à l'accouchement et aux nuits fractionnées, pression sociale (absence de statut reconnu pour les suites de couches dans nos sociétés occidentales, à l'inverse des sociétés traditionnelles où la mère est « maternée »), carences accumulées de la grossesse (fer, B9/B12, oméga-3). Baby blues : chute hormonale brutale 2 à 4 jours après la naissance. Dépression post-partum : baby blues intense et prolongé non pris en charge.",
            'signes_cliniques' => "Lochies (pertes sanguines physiologiques jusqu'à 6 semaines, pas de tampon ni de coupe menstruelle), tranchées (contractions d'involution utérine, majorées par l'allaitement), douleurs d'épisiotomie, fatigue intense, chute de cheveux, anémie possible. Baby blues : variations d'humeur, pleurs, peur de ne pas y arriver, durée maximale d'une semaine. Dépression post-partum : tristesse profonde sans raison apparente, épuisement ou troubles du sommeil, culpabilité excessive, anxiété centrée sur le bébé, désintérêt, isolement — signes d'urgence : désespoir, idées suicidaires. Stress post-traumatique après un accouchement difficile : 4-6 % des femmes, souvenirs intrusifs perturbant le sommeil et le lien à l'enfant.",
            'conseils_alimentation' => "Continuer à manger comme pendant la grossesse (protéines, lipides, vitamines, minéraux), privilégier une nourriture chaude et réconfortante (bouillons, mijotés, soupes), éviter le froid/glacé ; en cas d'allaitement, besoins énergétiques augmentés de +360 kcal/j le 1er mois puis +500 kcal/j, +20 g/j de protéines.",
            'aliments_eviter' => "Amaigrissement volontaire rapide (le corps a besoin de réserves), sauge et persil pendant l'allaitement (tarissent le lait), aliments et boissons froids en excès selon les approches traditionnelles.",
            'aliments_privilegier' => "Bouillon d'os, bouillon de miso, aliments riches en fer (prévention anémie/dépression post-partum), oméga-3 EPA/DHA (prévention baby blues), calcium (1500-1800 mg/j si allaitement), vitamines B9/B12, aliments galactogènes en cas de manque de lait (fenugrec, fenouil, anis, carvi, aneth, ortie).",
            'conseils_activite' => "Repos et lutte contre la pesanteur en priorité (vivre couchée le plus possible les 21 premiers jours, bassin surélevé), éviter le sport et les abdominaux avant la rééducation périnéale, reprise très progressive.",
            'conseils_stress' => "Écriture, journal, groupe de soutien (Maman Blues, Les Louves), parole libérée, HE de rose en olfaction (réconfort psychique, trauma), accompagnement psycho-émotionnel prioritaire en cas d'accouchement difficile (EMDR, hypnose).",
            'conseils_routine' => "Cocooning et création du lien (peu de visites, intimité avec le bébé et le co-parent), délégation des tâches ménagères, uriner tôt après la naissance, resserrage du bassin (rebozzo), rééducation du périnée le plus tôt possible (ne pas attendre 4 mois).",
            'complements' => "Fer, vitamines B9/B12, oméga-3 EPA/DHA, magnésium, ortie, eau de mer hypertonique, spiruline, vitamine D — mêmes précautions que pendant la grossesse si allaitement en cours ; éviter tout drainage ou détoxification intense les 3 à 6 premiers mois post-partum.",
            'phytotherapie' => "Allaitement (manque de lait) : fenugrec, fenouil, anis, carvi, aneth, ortie, houblon en tisane. Engorgement : cataplasme de feuilles de chou vert après la tétée (jamais de plante galactogène en cas d'engorgement). Tranchées : bouillotte, bandage du ventre, homéopathie (Arnica).",
            'aromatherapie' => "Hydrolats rose + fleur d'oranger + camomille romaine (interne et externe, réconfort et détente). HE rose, lavande, orange, néroli, jasmin, ylang-ylang en olfaction pour le soutien émotionnel du post-partum.",
            'notes' => "MASTITE (engorgement + fièvre + syndrome grippal) = urgence médicale. Dépression post-partum avec idées suicidaires ou désespoir = consultation d'urgence impérative. Principe général du post-partum : REVITALISATION avant tout, jamais de drainage ni de détoxification intense les 3 à 6 premiers mois. Le naturopathe oriente vers sage-femme, consultante en lactation, psychologue ou psychiatre selon la situation, sans jamais se substituer au suivi médical.",
        ],
        // ==========================================
        // ACCOMPAGNEMENT PÉDIATRIQUE
        // ==========================================
        [
            'nom' => "Accompagnement naturopathique du nourrisson et du jeune enfant",
            'systeme' => 'Accompagnement pédiatrique',
            'description' => "Accompagnement global de l'alimentation, de la diversification et de l'hygiène de vie du nourrisson et du jeune enfant (0-3 ans), tenant compte de l'immaturité physiologique de ses organes (pancréas, vésicule biliaire, reins, intestins, système nerveux et immunitaire mature seulement vers 6-7 ans). La naturopathie y privilégie la douceur, le jeu et le soutien émonctoriel, jamais le drainage intense ni l'approche anti-symptomatique agressive.",
            'causes' => "Les fragilités du jeune enfant tiennent à l'immaturité de ses organes : pancréas sensible aux sucres rapides et graisses saturées, vésicule biliaire non prête pour une supplémentation en graisses avant 3 mois, reins sensibles au sel/aux purines/à l'excès de protéines avant 1 an, enzymes digestives limitées jusqu'à 18 mois, intestins poreux exposant à un risque accru d'allergies et d'eczéma en cas de diversification trop précoce ou trop rapide. Le risque allergique est multifactorielle (génétique non automatique : 30 % si un parent allergique, 60 % si les deux) et modulé par l'état de la barrière intestinale et le microbiote (1000 premiers jours de vie, mode d'accouchement, allaitement).",
            'signes_cliniques' => "Signes de disponibilité à la diversification (vers 4-6 mois) : tenue assise avec appui, premières dents, curiosité pour la nourriture des parents, tétées plus fréquentes. Signes d'alerte digestive : régurgitations, coliques, gaz, selles anormales (vertes = possible intolérance au lactose), retard de croissance. Signes évocateurs d'une allergie/intolérance : troubles cutanés (eczéma), digestifs, respiratoires apparaissant après l'introduction d'un aliment.",
            'conseils_alimentation' => "Le lait (maternel ou préparation pour nourrisson) reste l'aliment principal jusqu'à 1 an ; les solides ne font que le compléter jusqu'à la 2e année. Diversification à partir de 4-6 mois, un aliment nouveau à la fois avec 3 à 5 jours d'écart, en commençant par les légumes racines cuits (carotte, pomme de terre, patate douce). Apprentissage précoce de la mastication (textures de moins en moins homogènes). Lipides de qualité indispensables dès la diversification (35-40 % des apports) : huiles de colza/lin/cameline bio 1ère pression à froid, beurre cru, poissons gras. Attention au doublon protéique (ne pas cumuler viande et laitage au même repas).",
            'aliments_eviter' => "Sel, sucre blanc, édulcorants et miel avant 1 an (risque de botulisme infantile), biscuits industriels et plats préparés, épices fortes, légumes acides/fibreux (épinards, asperges, oseille) en début de diversification, poissons riches en métaux lourds, charcuterie, produits de la ruche avant 1 an, tofu/soja non recommandés chez le nourrisson.",
            'aliments_privilegier' => "Légumes racines cuits, fruits doux (pomme, poire, banane), céréales sans gluten puis variétés anciennes de blé, huiles végétales bio de qualité variées, purée d'amande et de sésame, spiruline en cure de quelques semaines dès 7 mois, oméga-3 (petits poissons gras dès 9 mois).",
            'conseils_activite' => "Respecter le développement moteur spontané de l'enfant ; favoriser le peau à peau et le portage pour l'apaisement du système nerveux immature du nourrisson.",
            'conseils_stress' => "Accompagner la compétence émotionnelle dès la naissance (le bébé est sensible aux émotions de ses parents) : mise en mots des émotions, outils ludiques (dessin, boîte à peurs, coussin de colère), respiration ventrale sous forme de jeu (bulle de savon, doudou sur le ventre), massage du ventre et des pieds avec présence.",
            'conseils_routine' => "Repas dans une ambiance détendue, respect de l'appétit et des refus de l'enfant (jusqu'à 20 présentations d'un aliment sans forcer), hydratation suffisante (l'eau reste la seule boisson nécessaire), vermifuge préventif de toute la famille en cas de suspicion d'oxyures.",
            'complements' => "Vitamine D3 naturelle (400-800 UI/j dès la naissance, surtout en période hivernale), oméga-3 (huile de poisson ou végane dès la diversification), spiruline (poudre, dès la diversification), lithothamne (reminéralisant), probiotiques (dès la naissance selon besoin), oligo-éléments Catalyons selon le poids.",
            'phytotherapie' => "Utilisables dès la naissance en infusion ou extrait fluide très dilué (1 goutte/kg/prise) : camomille matricaire (apaisante, digestive), fenouil et mélisse (coliques, ballonnements). Dès 2-3 ans : passiflore (agitation, sommeil), thym (infections respiratoires), sureau (immunité). Formes : infusion, gélules ouvertes en poudre dans une compote (dès 6 ans en général), extraits fluides sans alcool (EPS, SIPF).",
            'aromatherapie' => "Les hydrolats (eaux florales) sont adaptés dès la naissance, beaucoup moins concentrés que les huiles essentielles : camomille noble et lavande (apaisantes, anti-inflammatoires locales), fenouil et mélisse (digestion, coliques), fleur d'oranger (sommeil, sédatif doux). Les huiles essentielles pures nécessitent une formation spécifique et une adaptation stricte à l'âge, au poids et à la voie d'administration.",
            'notes' => "Toujours orienter vers le pédiatre, la PMI ou une consultante en lactation pour toute question de lait infantile ou de suspicion d'allergie. Ne jamais remplacer une préparation pour nourrisson par un lait végétal ou un lait animal classique avant 1 an. L'argile est à éviter avant 3 ans (risque de contamination au plomb sauf provenance vérifiée). L'introduction précoce (4-6 mois) est aujourd'hui privilégiée pour la prévention des allergies, y compris pour les aliments à haut potentiel allergisant (œuf, poisson), en accord avec les recommandations actuelles.",
        ],
        // ==========================================
        // ACCOMPAGNEMENT PERSONNES ÂGÉES
        // ==========================================
        [
            'nom' => 'Accompagnement naturopathique des personnes âgées',
            'systeme' => 'Accompagnement personnes âgées',
            'description' => "Accompagnement global du vieillissement, à domicile (personne autonome ou fragile) ou en EHPAD (personne dépendante, classée selon la grille GIR de 1 à 6). Le vieillissement biologique s'explique par 4 théories complémentaires : l'oxydation (radicaux libres), l'accumulation de déchets (lipofuscine), la réticulation du collagène/élastine et la sénescence cellulaire (érosion des télomères, SASP pro-inflammatoire).",
            'causes' => "Stress oxydatif chronique (UV, tabac, pollution, inflammation, mitochondries), glycation (fixation des sucres sur les protéines via la réaction de Maillard, accélérée par les cuissons sèches à haute température et le tabac), polymédication (90 % des personnes âgées prennent au moins un médicament, 36 % au moins cinq), diminution de l'eau corporelle et augmentation du tissu adipeux modifiant la pharmacocinétique des traitements, foie et reins moins efficaces pour éliminer les molécules. Modifications physiologiques par système : baisse des neurotransmetteurs (acétylcholine, sérotonine), diminution de la capacité respiratoire, baisse des sécrétions digestives et du péristaltisme, sarcopénie et ostéopénie, diminution de la filtration rénale, rigidification artérielle, immunosénescence (baisse des lymphocytes T, hausse des cytokines pro-inflammatoires IL-1/IL-6).",
            'signes_cliniques' => "Profils de vieillissement : robuste (autonome), fragile/réversible (perte de poids, épuisement, faiblesse musculaire, marche lente — environ 40 % des plus de 65 ans), dépendant/irréversible. Pathologies fréquentes : cardiovasculaires (HTA, athérosclérose, AVC), neurodégénératives (Alzheimer, Parkinson), musculo-squelettiques (arthrose, ostéoporose), diabète de type 2, dépression et troubles anxieux, constipation (20 à 50 % des résidents en EHPAD), prurit sénile, escarres, ulcères variqueux, douleurs chroniques souvent difficiles à exprimer verbalement (signes non verbaux à surveiller : mimiques, repli sur soi, positions antalgiques, agressivité inhabituelle, perte d'appétit).",
            'conseils_alimentation' => "Moins de calories mais toujours autant de nutriments essentiels : protéines 1 à 1,5 g/kg/jour (maintien de la masse musculaire), fibres selon tolérance (prévention constipation), calcium et vitamine D (1200 mg Ca/j, prévention ostéoporose), hydratation impérative (2,5 L/j malgré une sensation de soif réduite), alimentation antioxydante variée (vitamines A/C/E, zinc, sélénium, cuivre, CoQ10) et anti-glycation (IG bas, cuissons douces).",
            'aliments_eviter' => "Aliments à cuisson sèche et haute température (favorisent la glycation/AGEs : pain très cuit, fritures), excès de sucres rapides, alcool, tabac.",
            'aliments_privilegier' => "Protéines de qualité à chaque repas, fruits et légumes riches en antioxydants (huître, sésame pour le zinc ; thon, noix du Brésil pour le sélénium ; carotte pour la vitamine A ; agrumes pour la vitamine C), ail (antioxydant puissant), huiles végétales de qualité associées aux légumes (améliore l'absorption des caroténoïdes).",
            'conseils_activite' => "4 types d'exercice à associer : endurance (marche, vélo, natation — santé cardiovasculaire), renforcement musculaire (poids du corps, bandes de résistance — masse et densité osseuse), équilibre (tai-chi, yoga — prévention des chutes), souplesse (étirements doux).",
            'conseils_stress' => "Techniques de relaxation, sophrologie, musicothérapie réceptive, aromathérapie en diffusion ou voie cutanée (agrumes, lavande, marjolaine à coquille, camomille romaine, ylang-ylang, géranium, ravintsara, néroli, mélisse) — la voie cutanée est la voie reine en EHPAD. Jamais de sevrage des benzodiazépines en première intention ; préparer le système nerveux 1 mois avant tout sevrage encadré médicalement (EPA/DHA, vitamines B, magnésium).",
            'conseils_routine' => "4 règles d'or à domicile : soutenir les grandes fonctions sans surcharger, ne jamais détoxifier un organisme fragilisé, toujours prendre en compte la polymédication, faire preuve de patience et de constance (la personne âgée n'aime pas le changement). En EHPAD : coordination impérative avec l'équipe médicale, communication avec les familles, maîtrise d'au moins une technique manuelle ou de gestion du stress, disponibilité pour l'accompagnement de fin de vie.",
            'complements' => "Selon le terrain : collagène et vitamine D pour l'articulaire (attention silice contre-indiquée en insuffisance rénale), enzymes digestives et probiotiques pour le digestif, gelée royale/zinc/probiotiques pour l'immunitaire, CoQ10 en cas de traitement par statines. Vérifier systématiquement les interactions avec la polymédication en cours.",
            'phytotherapie' => "Cognition/humeur : ginkgo, safran, rhodiole, bacopa, astragale (contre-indiqué en maladie auto-immune, sous immunosuppresseurs/anticoagulants). Articulaire : curcuma, harpagophytum, prêle, ortie, cassis (contre-indiqués en cas d'ulcère gastrique, insuffisance rénale, calculs biliaires, hypotension, ou sous anticoagulants/antihypertenseurs/antidiabétiques). Digestif : gentiane, gingembre, cardamome, angélique, fenugrec (contre-indiqués en cas de RGO, calculs biliaires, HTA, diabète, troubles cardiaques). Toute plante doit être vérifiée au cas par cas avec les traitements en cours.",
            'aromatherapie' => "Douleurs articulaires et musculaires (voie cutanée uniquement) : eucalyptus citronné, katafray, baume de copahu, lavandin super (raideur). Cicatrisation/escarres : laurier noble, hélichryse italienne, tea tree, ciste ladanifère, myrrhe, encens, camomille noble (protocole préventif en préparation à 3 %). Ces huiles sont sélectionnées pour leur risque d'interaction minimal avec les traitements habituels, toujours avec l'accord du médecin traitant.",
            'notes' => "Les compléments alimentaires et la phytothérapie restent peu efficaces sur les douleurs sévères et chroniques en gériatrie : l'approche la plus adaptée en EHPAD reste le massage aromatique doux. Jamais de détoxification chez la personne âgée (organisme fragilisé). Toujours coordonner avec le médecin coordonnateur et l'équipe pluridisciplinaire (IDE, aide-soignant, kiné, psychologue) en EHPAD. Leçon des zones bleues pour le bien-vieillir : activité physique régulière intégrée au quotidien, alimentation végétale peu transformée, vie sociale riche, environnement peu stressant, consommation d'alcool raisonnée.",
        ],
    ];
}

function insertFichesPathologies(PDO $db): int {
    $fiches = getFichesPathologies();
    $count = 0;

    // Vérifier si des fiches existent déjà
    $existing = $db->query("SELECT COUNT(*) FROM fiches_pathologies")->fetchColumn();
    if ($existing > 0) return 0;

    $stmt = $db->prepare("INSERT INTO fiches_pathologies (nom, systeme, description, causes, signes_cliniques, conseils_alimentation, aliments_eviter, aliments_privilegier, conseils_activite, conseils_stress, conseils_routine, complements, phytotherapie, aromatherapie, notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    foreach ($fiches as $f) {
        $stmt->execute([
            $f['nom'], $f['systeme'], $f['description'], $f['causes'], $f['signes_cliniques'],
            $f['conseils_alimentation'], $f['aliments_eviter'], $f['aliments_privilegier'],
            $f['conseils_activite'], $f['conseils_stress'], $f['conseils_routine'],
            $f['complements'], $f['phytotherapie'], $f['aromatherapie'], $f['notes'],
        ]);
        $count++;
    }

    return $count;
}

/**
 * Ajoute en base uniquement les fiches de getFichesPathologies() qui n'existent
 * pas encore (comparaison par nom), sans toucher aux fiches déjà présentes.
 * @return array Liste des noms de fiches effectivement ajoutées
 */
/**
 * Synchronise la table fiches_pathologies avec getFichesPathologies() :
 * insère les fiches manquantes et MET À JOUR le contenu des fiches déjà
 * présentes (comparaison par nom), pour que les améliorations de contenu
 * apportées ici (nouvelles sources, corrections) atteignent bien la base
 * même quand la fiche existait déjà.
 * @return array{inserted: string[], updated: string[]}
 */
function syncFichesPathologies(PDO $db): array {
    $fiches = getFichesPathologies();

    $existingRows = $db->query("SELECT id, nom FROM fiches_pathologies")->fetchAll();
    $existingByNom = [];
    foreach ($existingRows as $row) {
        $existingByNom[mb_strtolower($row['nom'])] = $row['id'];
    }

    $insertStmt = $db->prepare("INSERT INTO fiches_pathologies (nom, systeme, description, causes, signes_cliniques, conseils_alimentation, aliments_eviter, aliments_privilegier, conseils_activite, conseils_stress, conseils_routine, complements, phytotherapie, aromatherapie, notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $updateStmt = $db->prepare("UPDATE fiches_pathologies SET systeme = ?, description = ?, causes = ?, signes_cliniques = ?, conseils_alimentation = ?, aliments_eviter = ?, aliments_privilegier = ?, conseils_activite = ?, conseils_stress = ?, conseils_routine = ?, complements = ?, phytotherapie = ?, aromatherapie = ?, notes = ? WHERE id = ?");

    $inserted = [];
    $updated = [];
    foreach ($fiches as $f) {
        $key = mb_strtolower($f['nom']);
        if (isset($existingByNom[$key])) {
            $updateStmt->execute([
                $f['systeme'], $f['description'], $f['causes'], $f['signes_cliniques'],
                $f['conseils_alimentation'], $f['aliments_eviter'], $f['aliments_privilegier'],
                $f['conseils_activite'], $f['conseils_stress'], $f['conseils_routine'],
                $f['complements'], $f['phytotherapie'], $f['aromatherapie'], $f['notes'],
                $existingByNom[$key],
            ]);
            $updated[] = $f['nom'];
        } else {
            $insertStmt->execute([
                $f['nom'], $f['systeme'], $f['description'], $f['causes'], $f['signes_cliniques'],
                $f['conseils_alimentation'], $f['aliments_eviter'], $f['aliments_privilegier'],
                $f['conseils_activite'], $f['conseils_stress'], $f['conseils_routine'],
                $f['complements'], $f['phytotherapie'], $f['aromatherapie'], $f['notes'],
            ]);
            $inserted[] = $f['nom'];
        }
    }

    return ['inserted' => $inserted, 'updated' => $updated];
}
