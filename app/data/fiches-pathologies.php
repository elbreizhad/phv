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
            'description' => "Infection fongique vaginale à Candida albicans, très fréquente. Souvent récidivante si le terrain n'est pas corrigé.",
            'causes' => "Dysbiose vaginale, antibiotiques, stress, alimentation riche en sucres, contraception hormonale, vêtements serrés/synthétiques, toilette intime agressive.",
            'signes_cliniques' => "Démangeaisons vulvo-vaginales, pertes blanches épaisses (aspect cottage cheese), rougeurs, brûlures mictionnelles, douleurs.",
            'conseils_alimentation' => "Protocole anti-candida : limiter sucres rapides, gluten, produits laitiers. Huile de coco quotidienne (acide caprylique). Curcuma frais. Prébiotiques.",
            'aliments_eviter' => "Sucres rapides, gluten (temporairement), produits laitiers avec lactose, alcool, produits industriels.",
            'aliments_privilegier' => "Huile de coco, ail, oignon, légumes verts, protéines de qualité, aliments fermentés (miso, kimchi en petite quantité), bouillon d'os.",
            'conseils_activite' => "Marche rapide 5x/semaine 30-45 min. Yin yoga 1x/semaine. Exercices de Kegel quotidiens (3 séries de 10 contractions).",
            'conseils_stress' => "Respirer 3-5 min avant chaque repas (respiration ventrale). Marche en nature. Le stress favorise le candida.",
            'conseils_routine' => "Toilette intime eau tiède + eau florale de rose uniquement. Sous-vêtements coton. Éviter pantalons serrés. Protections en coton bio.",
            'complements' => "Dysbios'Aroma (2 caps/repas 3 sem puis 2 caps/soir 2 mois). Huile d'argousier (2 caps/j, 2 mois). Propolis noire (1 goutte/j, 15j/mois). Probiotiques (après 3 sem d'HE). Ovules probiotiques (1/sem, 2 mois). Chardon-marie TM (20 gttes avant repas).",
            'phytotherapie' => "Lapacho (antifongique). Échinacée (immunité). Chardon-marie (soutien hépatique).",
            'aromatherapie' => "HE Tea Tree + huile de coco en application externe (1 goutte, 1x/jour).",
            'notes' => 'Cas de référence : Sophie (candidose vaginale). Vérifier vitamine D3 et Zinc avec le médecin.',
        ],
        [
            'nom' => 'Cystite / Infection urinaire',
            'systeme' => 'Système uro-génital',
            'description' => "Infection bactérienne de la vessie, très fréquente chez la femme.",
            'causes' => "E. coli (80% des cas), déshydratation, hygiène intime inadaptée, rapports sexuels, constipation, immunité faible.",
            'signes_cliniques' => "Brûlures mictionnelles, envies fréquentes, urines troubles/odorantes, douleurs pelviennes.",
            'conseils_alimentation' => "Hydratation abondante (2L/jour). Canneberge. Éviter les irritants vésicaux.",
            'aliments_eviter' => "Café, alcool, épices fortes, sucres raffinés, sodas.",
            'aliments_privilegier' => "Eau, canneberge (jus pur ou complément), myrtille, ail, oignon, persil.",
            'conseils_activite' => "Activité régulière pour la circulation pelvienne.",
            'conseils_stress' => "Le stress affaiblit les défenses immunitaires locales.",
            'conseils_routine' => "Uriner après chaque rapport. S'essuyer d'avant en arrière. Sous-vêtements coton. Uriner régulièrement.",
            'complements' => "D-Mannose. Canneberge concentrée. Probiotiques spécifiques (Lactobacillus). Propolis.",
            'phytotherapie' => "Busserole (antiseptique urinaire). Bruyère. Piloselle.",
            'aromatherapie' => "HE Sarriette des montagnes. HE Origan compact (en capsule, cure courte).",
            'notes' => 'Orienter vers un médecin si fièvre, sang dans les urines, douleurs lombaires.',
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
