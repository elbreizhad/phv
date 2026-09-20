<?php
/**
 * Recettes types en dur - construites à partir des principes alimentaires
 * enseignés dans les cours (index glycémique bas, FODMAP, anti-inflammatoire,
 * sans gluten, détox hépatique, richesse en oméga-3, végétal...).
 * Recettes globales (user_id NULL), visibles par tous les praticiens.
 */

function getRecettesTypes(): array {
    return [
        // ==========================================
        // PETIT-DÉJEUNER
        // ==========================================
        [
            'nom' => 'Bol protéiné aux œufs et avocat',
            'categorie' => 'petit_dejeuner',
            'temps_preparation' => 10,
            'temps_cuisson' => 8,
            'portions' => 1,
            'ingredients' => "2 œufs\n1/2 avocat\n1 poignée d'épinards frais\n1 c. à soupe d'huile d'olive\nSel, poivre, curcuma\n1 tranche de pain sans gluten (optionnel)",
            'instructions' => "1. Faire chauffer l'huile d'olive dans une poêle.\n2. Faire revenir les épinards 1 minute jusqu'à ce qu'ils réduisent.\n3. Casser les œufs dans la poêle et cuire au plat ou brouillés selon préférence.\n4. Écraser grossièrement l'avocat, assaisonner de sel, poivre et curcuma.\n5. Servir les œufs sur les épinards avec l'avocat écrasé à côté.",
            'regimes' => ['Sans gluten', 'Cétogène'],
            'allergenes' => ['Oeufs'],
            'saison' => 'toutes',
            'source' => 'Principe index glycémique bas - petit-déjeuner protéiné',
        ],
        [
            'nom' => 'Porridge de sarrasin aux fruits rouges',
            'categorie' => 'petit_dejeuner',
            'temps_preparation' => 5,
            'temps_cuisson' => 10,
            'portions' => 2,
            'ingredients' => "80 g de flocons de sarrasin\n300 ml de boisson végétale (amande ou avoine)\n1 c. à soupe de graines de chia\n1 poignée de fruits rouges (frais ou surgelés)\n1 c. à café de cannelle\n1 c. à soupe de purée d'amande",
            'instructions' => "1. Faire chauffer la boisson végétale dans une casserole.\n2. Ajouter les flocons de sarrasin et les graines de chia, cuire à feu doux 8 à 10 minutes en remuant.\n3. Ajouter la cannelle en fin de cuisson.\n4. Verser dans un bol, garnir de fruits rouges et d'une cuillère de purée d'amande.",
            'regimes' => ['Végétarien', 'Vegan', 'Sans gluten', 'Sans lactose'],
            'allergenes' => ['Fruits à coque'],
            'saison' => 'toutes',
            'source' => 'Principe sans gluten / microbiote',
        ],
        [
            'nom' => 'Pudding de chia au lait de coco',
            'categorie' => 'petit_dejeuner',
            'temps_preparation' => 5,
            'temps_cuisson' => 0,
            'portions' => 2,
            'ingredients' => "4 c. à soupe de graines de chia\n250 ml de lait de coco\n1 c. à café de vanille\n1 c. à café de miel ou sirop d'érable\nQuelques amandes effilées",
            'instructions' => "1. Mélanger les graines de chia, le lait de coco, la vanille et le miel dans un bocal.\n2. Bien remuer et laisser reposer au réfrigérateur au moins 4 heures ou toute une nuit.\n3. Remuer à nouveau avant de servir, garnir d'amandes effilées.",
            'regimes' => ['Vegan', 'Sans gluten', 'Sans lactose', 'Paléo'],
            'allergenes' => ['Fruits à coque'],
            'saison' => 'ete',
            'source' => 'Préparation anticipée - collation riche en oméga-3',
        ],

        // ==========================================
        // ENTRÉES
        // ==========================================
        [
            'nom' => 'Velouté de courgette au curcuma anti-inflammatoire',
            'categorie' => 'entree',
            'temps_preparation' => 10,
            'temps_cuisson' => 20,
            'portions' => 4,
            'ingredients' => "4 courgettes\n1 oignon\n1 gousse d'ail\n1 c. à café de curcuma\n1 pincée de poivre noir (active la curcumine)\n500 ml de bouillon de légumes\n1 c. à soupe d'huile d'olive\nCrème de coco (facultatif)",
            'instructions' => "1. Faire revenir l'oignon et l'ail émincés dans l'huile d'olive.\n2. Ajouter les courgettes coupées en morceaux, le curcuma et le poivre.\n3. Couvrir avec le bouillon et laisser mijoter 20 minutes.\n4. Mixer jusqu'à obtenir une texture lisse.\n5. Ajouter une touche de crème de coco au moment de servir si désiré.",
            'regimes' => ['Végétarien', 'Vegan', 'Sans gluten', 'Sans lactose', 'Anti-inflammatoire'],
            'allergenes' => [],
            'saison' => 'ete',
            'source' => 'Principe alimentation anti-inflammatoire (curcuma + poivre noir)',
        ],
        [
            'nom' => 'Salade de lentilles corail, carottes et coriandre',
            'categorie' => 'entree',
            'temps_preparation' => 15,
            'temps_cuisson' => 15,
            'portions' => 4,
            'ingredients' => "200 g de lentilles corail\n2 carottes râpées\n1 poignée de coriandre fraîche\n1 citron (jus)\n2 c. à soupe d'huile d'olive\n1 c. à café de cumin\nSel, poivre",
            'instructions' => "1. Cuire les lentilles corail dans l'eau bouillante 10 à 15 minutes, égoutter et laisser refroidir.\n2. Mélanger avec les carottes râpées et la coriandre ciselée.\n3. Préparer la vinaigrette avec le jus de citron, l'huile d'olive, le cumin, sel et poivre.\n4. Mélanger le tout et servir tiède ou froid.",
            'regimes' => ['Végétarien', 'Vegan', 'Sans gluten', 'Sans lactose'],
            'allergenes' => [],
            'saison' => 'toutes',
            'source' => 'Index glycémique bas - légumineuses',
        ],

        // ==========================================
        // PLATS
        // ==========================================
        [
            'nom' => 'Saumon vapeur, brocolis et riz complet',
            'categorie' => 'plat',
            'temps_preparation' => 10,
            'temps_cuisson' => 20,
            'portions' => 2,
            'ingredients' => "2 pavés de saumon\n1 brocoli\n150 g de riz complet\n1 citron\n1 c. à soupe d'huile d'olive\nAneth frais\nSel, poivre",
            'instructions' => "1. Cuire le riz complet selon les indications du paquet.\n2. Cuire le saumon et les brocolis à la vapeur 12 à 15 minutes.\n3. Arroser le saumon de jus de citron et d'huile d'olive, parsemer d'aneth.\n4. Servir avec le riz complet et les brocolis.",
            'regimes' => ['Sans gluten', 'Sans lactose'],
            'allergenes' => ['Poisson'],
            'saison' => 'toutes',
            'source' => 'Oméga-3 / alimentation anti-inflammatoire',
        ],
        [
            'nom' => 'Poulet mariné au gingembre, quinoa et légumes rôtis',
            'categorie' => 'plat',
            'temps_preparation' => 20,
            'temps_cuisson' => 25,
            'portions' => 4,
            'ingredients' => "4 filets de poulet\n2 cm de gingembre frais râpé\n2 c. à soupe de sauce tamari (sans gluten)\n200 g de quinoa\n1 poivron, 1 courgette, 1 oignon rouge\n2 c. à soupe d'huile d'olive",
            'instructions' => "1. Mariner le poulet avec le gingembre et le tamari au moins 30 minutes.\n2. Couper les légumes en morceaux, les enrober d'huile d'olive et les faire rôtir au four à 200°C pendant 20-25 minutes.\n3. Cuire le poulet à la poêle ou au four jusqu'à cuisson complète.\n4. Cuire le quinoa selon les indications du paquet.\n5. Servir le poulet avec le quinoa et les légumes rôtis.",
            'regimes' => ['Sans gluten', 'Sans lactose', 'Anti-inflammatoire'],
            'allergenes' => ['Soja'],
            'saison' => 'toutes',
            'source' => 'Alimentation IG bas - protéines maigres',
        ],
        [
            'nom' => 'Curry de légumes et pois chiches au lait de coco',
            'categorie' => 'plat',
            'temps_preparation' => 15,
            'temps_cuisson' => 25,
            'portions' => 4,
            'ingredients' => "400 g de pois chiches cuits\n1 boîte de lait de coco\n1 courgette, 1 carotte, 1 poignée d'épinards\n1 oignon\n2 c. à café de curry\n1 c. à café de curcuma\n1 gousse d'ail\nRiz basmati pour l'accompagnement",
            'instructions' => "1. Faire revenir l'oignon et l'ail dans un peu d'huile.\n2. Ajouter les épices, puis les légumes coupés en morceaux.\n3. Verser le lait de coco et les pois chiches, laisser mijoter 20 minutes.\n4. Ajouter les épinards en fin de cuisson.\n5. Servir avec du riz basmati.",
            'regimes' => ['Végétarien', 'Vegan', 'Sans gluten', 'Sans lactose', 'Anti-inflammatoire'],
            'allergenes' => [],
            'saison' => 'automne',
            'source' => 'Alimentation anti-inflammatoire / FODMAP adapté (sans ail en phase stricte)',
        ],
        [
            'nom' => 'Papillote de cabillaud, fenouil et tomates confites',
            'categorie' => 'plat',
            'temps_preparation' => 15,
            'temps_cuisson' => 20,
            'portions' => 2,
            'ingredients' => "2 filets de cabillaud\n1 fenouil émincé\n10 tomates cerises\n1 c. à soupe d'huile d'olive\nHerbes de Provence\nSel, poivre",
            'instructions' => "1. Préchauffer le four à 180°C.\n2. Répartir le fenouil émincé et les tomates cerises dans deux papillotes.\n3. Déposer le cabillaud par-dessus, arroser d'huile d'olive, assaisonner.\n4. Fermer les papillotes et cuire 20 minutes au four.",
            'regimes' => ['Sans gluten', 'Sans lactose', 'Paléo'],
            'allergenes' => ['Poisson'],
            'saison' => 'ete',
            'source' => 'Alimentation légère et digestive',
        ],
        [
            'nom' => 'Bouillon de légumes reminéralisant',
            'categorie' => 'plat',
            'temps_preparation' => 15,
            'temps_cuisson' => 40,
            'portions' => 4,
            'ingredients' => "2 poireaux\n3 carottes\n1/4 de chou vert\n2 branches de céleri\n1 morceau d'algue kombu (facultatif)\nSel non raffiné, persil frais",
            'instructions' => "1. Laver et couper grossièrement tous les légumes.\n2. Les placer dans une grande casserole avec l'algue kombu et couvrir d'eau froide.\n3. Porter à ébullition puis laisser mijoter à couvert 40 minutes.\n4. Filtrer le bouillon, saler légèrement et parsemer de persil frais avant de servir. Les légumes peuvent être mixés à part en velouté pour ne rien perdre.",
            'regimes' => ['Végétarien', 'Vegan', 'Sans gluten', 'Sans lactose'],
            'allergenes' => [],
            'saison' => 'hiver',
            'source' => 'Reminéralisation / détox douce',
        ],

        // ==========================================
        // DESSERTS
        // ==========================================
        [
            'nom' => 'Mousse au chocolat avocat-cacao (sans sucre ajouté)',
            'categorie' => 'dessert',
            'temps_preparation' => 10,
            'temps_cuisson' => 0,
            'portions' => 4,
            'ingredients' => "2 avocats mûrs\n4 c. à soupe de cacao cru non sucré\n3 c. à soupe de sirop d'érable ou purée de dattes\n1 c. à café de vanille\nUne pincée de sel",
            'instructions' => "1. Mixer tous les ingrédients ensemble jusqu'à obtenir une texture lisse et crémeuse.\n2. Répartir dans des ramequins.\n3. Réfrigérer au moins 1 heure avant de servir.",
            'regimes' => ['Végétarien', 'Vegan', 'Sans gluten', 'Sans lactose'],
            'allergenes' => [],
            'saison' => 'toutes',
            'source' => 'Alternative sans sucre raffiné - protocole arrêt du sucre',
        ],
        [
            'nom' => 'Compote pomme-cannelle maison',
            'categorie' => 'dessert',
            'temps_preparation' => 10,
            'temps_cuisson' => 15,
            'portions' => 4,
            'ingredients' => "6 pommes\n1 c. à café de cannelle\n1 filet de jus de citron\nUn peu d'eau",
            'instructions' => "1. Éplucher et couper les pommes en morceaux.\n2. Les mettre dans une casserole avec un fond d'eau, la cannelle et le jus de citron.\n3. Cuire à couvert 15 minutes à feu doux en remuant régulièrement.\n4. Mixer plus ou moins selon la texture désirée.",
            'regimes' => ['Végétarien', 'Vegan', 'Sans gluten', 'Sans lactose', 'Paléo'],
            'allergenes' => [],
            'saison' => 'automne',
            'source' => 'Dessert sans sucre ajouté',
        ],

        // ==========================================
        // BOISSONS
        // ==========================================
        [
            'nom' => 'Infusion détox foie citron-romarin',
            'categorie' => 'boisson',
            'temps_preparation' => 5,
            'temps_cuisson' => 5,
            'portions' => 1,
            'ingredients' => "1 citron (jus)\n1 branche de romarin frais\n1 c. à café de curcuma\n250 ml d'eau chaude",
            'instructions' => "1. Faire infuser le romarin dans l'eau chaude 5 minutes.\n2. Ajouter le jus de citron et le curcuma.\n3. Boire tiède, idéalement le matin à jeun.",
            'regimes' => ['Vegan', 'Sans gluten', 'Sans lactose'],
            'allergenes' => [],
            'saison' => 'toutes',
            'source' => 'Protocole détox hépatique',
        ],
        [
            'nom' => 'Smoothie vert digestif',
            'categorie' => 'boisson',
            'temps_preparation' => 5,
            'temps_cuisson' => 0,
            'portions' => 1,
            'ingredients' => "1 poignée d'épinards\n1/2 banane\n1/2 concombre\nJus d'1/2 citron\n1 c. à café de gingembre frais râpé\n200 ml d'eau ou boisson végétale",
            'instructions' => "1. Mixer tous les ingrédients ensemble jusqu'à obtenir une texture lisse.\n2. Consommer immédiatement pour préserver les nutriments.",
            'regimes' => ['Vegan', 'Sans gluten', 'Sans lactose'],
            'allergenes' => [],
            'saison' => 'ete',
            'source' => 'Soutien digestif quotidien',
        ],
        [
            'nom' => 'Lait doré au curcuma (golden milk)',
            'categorie' => 'boisson',
            'temps_preparation' => 5,
            'temps_cuisson' => 5,
            'portions' => 1,
            'ingredients' => "250 ml de boisson végétale (amande ou coco)\n1 c. à café de curcuma\n1 pincée de poivre noir\n1/2 c. à café de gingembre en poudre\n1 c. à café de miel ou sirop d'érable\nUne pincée de cannelle",
            'instructions' => "1. Faire chauffer la boisson végétale à feu doux sans bouillir.\n2. Ajouter le curcuma, le poivre noir, le gingembre et la cannelle.\n3. Fouetter pour bien mélanger, ajouter le miel hors du feu.\n4. Servir chaud.",
            'regimes' => ['Végétarien', 'Vegan', 'Sans gluten', 'Sans lactose', 'Anti-inflammatoire'],
            'allergenes' => ['Fruits à coque'],
            'saison' => 'hiver',
            'source' => 'Anti-inflammatoire - curcuma + poivre noir',
        ],

        // ==========================================
        // COLLATIONS
        // ==========================================
        [
            'nom' => 'Boules d\'énergie dattes-amandes-cacao',
            'categorie' => 'collation',
            'temps_preparation' => 15,
            'temps_cuisson' => 0,
            'portions' => 8,
            'ingredients' => "150 g de dattes dénoyautées\n100 g d'amandes\n2 c. à soupe de cacao cru\n1 c. à soupe de graines de chia\nNoix de coco râpée pour l'enrobage",
            'instructions' => "1. Mixer les dattes, les amandes et le cacao jusqu'à obtenir une pâte homogène.\n2. Ajouter les graines de chia et mélanger.\n3. Former des petites boules avec les mains.\n4. Rouler dans la noix de coco râpée.\n5. Conserver au réfrigérateur.",
            'regimes' => ['Végétarien', 'Vegan', 'Sans gluten', 'Sans lactose'],
            'allergenes' => ['Fruits à coque'],
            'saison' => 'toutes',
            'source' => 'Collation à index glycémique modéré - énergie stable',
        ],
        [
            'nom' => 'Houmous de betterave et bâtonnets de légumes',
            'categorie' => 'collation',
            'temps_preparation' => 10,
            'temps_cuisson' => 0,
            'portions' => 4,
            'ingredients' => "1 betterave cuite\n200 g de pois chiches cuits\n1 c. à soupe de tahin\n1 gousse d'ail\nJus d'1/2 citron\n2 c. à soupe d'huile d'olive\nCarottes et concombre pour tremper",
            'instructions' => "1. Mixer la betterave, les pois chiches, le tahin, l'ail, le jus de citron et l'huile d'olive jusqu'à obtenir une texture lisse.\n2. Ajuster l'assaisonnement.\n3. Servir avec des bâtonnets de légumes crus.",
            'regimes' => ['Végétarien', 'Vegan', 'Sans gluten', 'Sans lactose'],
            'allergenes' => [],
            'saison' => 'toutes',
            'source' => 'Collation riche en fibres - soutien microbiote',
        ],
    ];
}

/**
 * Ajoute en base uniquement les recettes de getRecettesTypes() qui n'existent
 * pas encore (comparaison par nom), en tant que recettes globales (user_id NULL).
 * @return array Liste des noms de recettes effectivement ajoutées
 */
function syncRecettesTypes(PDO $db): array {
    $recettes = getRecettesTypes();

    $existingNoms = $db->query("SELECT nom FROM recettes WHERE user_id IS NULL")->fetchAll(PDO::FETCH_COLUMN);
    $existingNoms = array_map('mb_strtolower', $existingNoms);

    $stmt = $db->prepare("INSERT INTO recettes (user_id, nom, categorie, temps_preparation, temps_cuisson, portions, ingredients, instructions, regimes, allergenes, saison, source) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $added = [];
    foreach ($recettes as $r) {
        if (in_array(mb_strtolower($r['nom']), $existingNoms, true)) {
            continue;
        }
        $stmt->execute([
            $r['nom'], $r['categorie'], $r['temps_preparation'], $r['temps_cuisson'], $r['portions'],
            $r['ingredients'], $r['instructions'],
            json_encode($r['regimes']), json_encode($r['allergenes']),
            $r['saison'], $r['source'],
        ]);
        $added[] = $r['nom'];
    }

    return $added;
}
