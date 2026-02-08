-- ============================================
-- PHV Naturo - Recettes Naturopathiques
-- Basées sur les cours de nutrition
-- ============================================

-- Supprimer les anciennes recettes pour éviter doublons
DELETE FROM recettes WHERE user_id IS NULL OR user_id = 1;

-- ============================================
-- PETITS-DÉJEUNERS ÉNERGÉTIQUES
-- ============================================

INSERT INTO recettes (user_id, nom, categorie, temps_preparation, temps_cuisson, portions, ingredients, instructions, regimes, saison, source) VALUES

(NULL, 'Porridge protéiné aux graines', 'petit_dejeuner', 10, 5, 1,
'- 40g de flocons d''avoine (ou sarrasin si sans gluten)
- 200ml de lait végétal (amande, avoine)
- 1 c. à soupe de graines de chia
- 1 c. à soupe de graines de lin moulues
- 1 c. à soupe de purée d''amande
- 1/2 banane ou fruits de saison
- 1 c. à café de cannelle
- Quelques noix concassées',
'1. Dans une casserole, verser le lait végétal et les flocons
2. Cuire à feu doux 5 min en remuant
3. Hors du feu, ajouter les graines de chia et lin
4. Laisser gonfler 2 minutes
5. Verser dans un bol, ajouter la purée d''amande
6. Garnir de fruits frais, noix et cannelle
7. Déguster tiède

Conseil: Préparer la veille en version overnight oats (sans cuisson)',
'["Végétarien", "Vegan", "Riche en fibres", "IG bas"]', 'toutes', 'Cours Nutrition - Petit-déjeuner idéal'),

(NULL, 'Smoothie vert détox', 'petit_dejeuner', 5, 0, 1,
'- 1 poignée d''épinards frais
- 1/2 concombre
- 1 branche de céleri
- 1/2 pomme verte
- 1/2 citron pressé
- 1 cm de gingembre frais
- 200ml d''eau ou eau de coco
- Quelques feuilles de menthe',
'1. Laver tous les légumes et fruits
2. Couper grossièrement
3. Mettre tous les ingrédients dans un blender
4. Mixer jusqu''à consistance lisse
5. Ajuster la consistance avec de l''eau
6. Servir immédiatement

Astuce: Ajouter 1 c. à soupe de spiruline pour plus de protéines',
'["Végétarien", "Vegan", "Sans gluten", "Détox", "Alcalinisant"]', 'toutes', 'Cours Détox - Boissons vertes'),

(NULL, 'Œufs brouillés aux légumes', 'petit_dejeuner', 5, 10, 2,
'- 3 œufs bio
- 1 tomate
- 1 poignée d''épinards
- 1/2 avocat
- 1 c. à soupe d''huile d''olive
- Herbes fraîches (ciboulette, persil)
- Sel, poivre
- Curcuma (optionnel)',
'1. Battre les œufs avec une pincée de sel et curcuma
2. Chauffer l''huile dans une poêle
3. Ajouter la tomate coupée et les épinards
4. Faire revenir 2 minutes
5. Verser les œufs et remuer doucement
6. Cuire à feu doux jusqu''à consistance crémeuse
7. Servir avec l''avocat et les herbes

Conseil: Ne pas trop cuire pour garder les œufs moelleux',
'["Sans gluten", "Keto", "Riche en protéines", "IG bas"]', 'toutes', 'Cours Nutrition - Protéines matin'),

(NULL, 'Pudding de chia chocolat', 'petit_dejeuner', 5, 0, 2,
'- 4 c. à soupe de graines de chia
- 300ml de lait de coco
- 2 c. à soupe de cacao cru
- 1 c. à soupe de sirop d''érable ou miel
- 1/2 c. à café de vanille
- Fruits rouges pour servir
- Éclats de cacao',
'1. Mélanger le lait de coco, cacao, sirop et vanille
2. Ajouter les graines de chia et bien remuer
3. Laisser reposer 5 min puis remuer à nouveau
4. Réfrigérer minimum 4h ou toute la nuit
5. Servir avec fruits rouges et éclats de cacao

Variante: Remplacer le cacao par de la poudre de matcha',
'["Végétarien", "Vegan", "Sans gluten", "Oméga-3"]', 'toutes', 'Cours Nutrition - Super-aliments'),

(NULL, 'Tartines avocat-sarrasin', 'petit_dejeuner', 10, 3, 2,
'- 2 tranches de pain au sarrasin
- 1 avocat mûr
- 1/2 citron
- Graines de sésame
- Piment d''Espelette
- Fleur de sel
- Quelques pousses (roquette, cresson)',
'1. Toaster légèrement les tranches de pain
2. Écraser l''avocat à la fourchette
3. Ajouter le jus de citron, sel et piment
4. Tartiner généreusement sur le pain
5. Parsemer de graines de sésame
6. Ajouter les pousses fraîches

Option: Ajouter un œuf poché pour plus de protéines',
'["Végétarien", "Vegan", "Sans gluten", "Bonnes graisses"]', 'toutes', 'Cours Nutrition - Graisses saines'),

-- ============================================
-- ENTRÉES ET SOUPES
-- ============================================

(NULL, 'Soupe miso régénérante', 'entree', 10, 15, 2,
'- 1 L d''eau
- 3 c. à soupe de miso (non pasteurisé)
- 100g de tofu ferme
- 1 feuille d''algue wakame
- 2 champignons shiitake
- 2 oignons verts
- 1 c. à café de gingembre râpé',
'1. Faire tremper le wakame 10 min dans l''eau froide
2. Chauffer l''eau avec les shiitake émincés
3. Ajouter le tofu en dés et le gingembre
4. Porter à frémissement (ne pas bouillir)
5. Retirer du feu, diluer le miso dans un peu de bouillon
6. Incorporer le miso et le wakame égoutté
7. Servir avec les oignons verts émincés

Important: Ne jamais faire bouillir le miso (détruit les probiotiques)',
'["Végétarien", "Vegan", "Sans gluten", "Probiotiques", "Reminéralisant"]', 'automne', 'Cours Microbiote - Aliments fermentés'),

(NULL, 'Velouté de courge curcuma', 'entree', 15, 30, 4,
'- 800g de courge butternut
- 1 oignon
- 2 gousses d''ail
- 1 c. à café de curcuma
- 1/2 c. à café de gingembre
- 400ml de lait de coco
- 500ml de bouillon de légumes
- Huile d''olive
- Poivre noir (active le curcuma)',
'1. Éplucher et couper la courge en cubes
2. Faire revenir l''oignon et l''ail dans l''huile
3. Ajouter le curcuma et le gingembre, mélanger
4. Ajouter la courge, le bouillon
5. Cuire 25 min jusqu''à tendreté
6. Mixer finement
7. Ajouter le lait de coco, le poivre
8. Réchauffer sans bouillir

Conseil: Le poivre noir augmente l''absorption du curcuma de 2000%',
'["Végétarien", "Vegan", "Sans gluten", "Anti-inflammatoire"]', 'automne', 'Cours Anti-inflammation'),

(NULL, 'Gaspacho betterave-pomme', 'entree', 15, 0, 4,
'- 2 betteraves cuites
- 1 pomme verte
- 1/2 concombre
- 1 gousse d''ail
- 2 c. à soupe de vinaigre de cidre
- 3 c. à soupe d''huile d''olive
- 200ml d''eau froide
- Sel, poivre
- Aneth frais',
'1. Couper tous les légumes en morceaux
2. Mixer avec l''ail, le vinaigre et l''eau
3. Ajouter l''huile en filet en mixant
4. Assaisonner
5. Réfrigérer 1h minimum
6. Servir froid avec l''aneth

Bienfaits: La betterave soutient le foie et la circulation',
'["Végétarien", "Vegan", "Sans gluten", "Détox", "Cru"]', 'ete', 'Cours Détox - Cures saisonnières'),

(NULL, 'Soupe Thai coco-citronnelle', 'entree', 15, 20, 4,
'- 400ml de lait de coco
- 500ml de bouillon de légumes
- 2 tiges de citronnelle
- 3 feuilles de combava (ou zeste citron vert)
- 200g de champignons
- 1 poivron rouge
- 100g de pousses de soja
- 2 c. à soupe de sauce tamari
- Jus d''1 citron vert
- Coriandre fraîche',
'1. Écraser la citronnelle et infuser dans le bouillon chaud 10 min
2. Retirer la citronnelle
3. Ajouter le lait de coco, le tamari
4. Ajouter les champignons et poivron émincés
5. Cuire 10 min à feu doux
6. Ajouter les pousses de soja et le citron vert
7. Servir avec la coriandre

Variante: Ajouter des crevettes ou du tofu',
'["Végétarien", "Vegan", "Sans gluten", "Réchauffant"]', 'hiver', 'Cours Nutrition - Cuisine du monde'),

-- ============================================
-- PLATS PRINCIPAUX
-- ============================================

(NULL, 'Buddha bowl équilibré', 'plat', 20, 25, 2,
'- 100g de quinoa
- 200g de pois chiches (bocal ou cuits)
- 1 patate douce
- 1 avocat
- 100g de chou rouge
- 1 carotte
- 2 poignées de jeunes pousses
- 2 c. à soupe de graines de courge
Sauce tahini:
- 2 c. à soupe de tahini
- Jus d''1 citron
- 1 gousse d''ail
- Eau pour diluer',
'1. Cuire le quinoa selon les instructions
2. Couper la patate douce en cubes, rôtir 25 min à 200°C
3. Égoutter et rincer les pois chiches
4. Râper la carotte, émincer le chou rouge
5. Préparer la sauce: mélanger tahini, citron, ail, eau
6. Disposer tous les éléments dans un bol
7. Arroser de sauce tahini
8. Parsemer de graines de courge

Conseil: Varier les légumes selon la saison',
'["Végétarien", "Vegan", "Sans gluten", "Protéines complètes", "Fibres"]', 'toutes', 'Cours Nutrition - Assiette équilibrée'),

(NULL, 'Curry de lentilles corail', 'plat', 10, 25, 4,
'- 250g de lentilles corail
- 400ml de lait de coco
- 400g de tomates concassées
- 1 oignon
- 3 gousses d''ail
- 1 c. à soupe de curry en poudre
- 1 c. à café de cumin
- 1 c. à café de curcuma
- 200g d''épinards frais
- Coriandre fraîche
- Riz basmati pour servir',
'1. Rincer les lentilles
2. Faire revenir l''oignon et l''ail
3. Ajouter les épices, faire torréfier 1 min
4. Ajouter les lentilles, tomates, lait de coco
5. Cuire 20 min en remuant
6. Ajouter les épinards en fin de cuisson
7. Servir sur du riz avec la coriandre

Astuce: Les lentilles corail n''ont pas besoin de trempage',
'["Végétarien", "Vegan", "Sans gluten", "Riche en fer", "Protéines végétales"]', 'toutes', 'Cours Protéines végétales'),

(NULL, 'Saumon mariné et légumes rôtis', 'plat', 15, 25, 2,
'- 2 pavés de saumon sauvage
- 2 c. à soupe de sauce tamari
- 1 c. à soupe de miel
- 1 c. à café de gingembre râpé
- 1 brocoli
- 1 courgette
- 1 poivron
- Huile d''olive
- Graines de sésame',
'1. Mélanger tamari, miel, gingembre pour la marinade
2. Mariner le saumon 30 min au frais
3. Couper les légumes, les huiler légèrement
4. Rôtir les légumes 20 min à 200°C
5. Ajouter le saumon sur une plaque
6. Cuire 12-15 min selon l''épaisseur
7. Servir avec les graines de sésame

Bienfaits: Oméga-3 anti-inflammatoires',
'["Sans gluten", "Oméga-3", "Protéines", "Anti-inflammatoire"]', 'toutes', 'Cours Oméga-3 et inflammation'),

(NULL, 'Risotto d''épeautre aux champignons', 'plat', 10, 35, 4,
'- 300g de petit épeautre
- 300g de champignons variés
- 1 oignon
- 2 gousses d''ail
- 150ml de vin blanc (optionnel)
- 800ml de bouillon de légumes chaud
- 2 c. à soupe de levure nutritionnelle
- Thym frais
- Huile d''olive
- Persil',
'1. Faire revenir l''oignon dans l''huile
2. Ajouter l''épeautre, nacrer 2 min
3. Verser le vin, laisser évaporer
4. Ajouter le bouillon louche par louche en remuant
5. Pendant ce temps, poêler les champignons avec l''ail
6. Cuire l''épeautre environ 30 min
7. Incorporer les champignons et la levure nutritionnelle
8. Servir avec le persil

Note: L''épeautre a un IG plus bas que le riz arborio',
'["Végétarien", "Vegan", "Fibres", "IG modéré"]', 'automne', 'Cours Céréales anciennes'),

(NULL, 'Poulet rôti aux herbes et légumes racines', 'plat', 20, 50, 4,
'- 4 cuisses de poulet fermier
- 2 carottes
- 2 panais
- 1 patate douce
- 4 gousses d''ail
- Romarin, thym, sauge
- 3 c. à soupe d''huile d''olive
- Jus d''1 citron
- Sel, poivre',
'1. Préchauffer le four à 200°C
2. Couper les légumes en gros morceaux
3. Mélanger herbes, huile, citron pour la marinade
4. Badigeonner le poulet
5. Disposer poulet et légumes dans un plat
6. Ajouter l''ail en chemise
7. Rôtir 45-50 min en arrosant régulièrement

Conseil: Privilégier le poulet fermier label rouge ou bio',
'["Sans gluten", "Paléo", "Protéines"]', 'automne', 'Cours Protéines animales qualité'),

(NULL, 'Wok de légumes au tofu', 'plat', 15, 10, 2,
'- 200g de tofu ferme
- 1 brocoli
- 1 carotte
- 1 poivron rouge
- 100g de pois mange-tout
- 2 c. à soupe de sauce tamari
- 1 c. à soupe d''huile de sésame
- 1 c. à café de gingembre râpé
- 2 gousses d''ail
- Graines de sésame
- Nouilles de riz (optionnel)',
'1. Presser le tofu, couper en cubes
2. Faire dorer le tofu dans l''huile de sésame
3. Réserver le tofu
4. Sauter les légumes coupés 5-7 min (rester croquants)
5. Ajouter ail et gingembre
6. Remettre le tofu, ajouter le tamari
7. Servir avec graines de sésame

Astuce: Ne pas surcharger le wok pour garder le croustillant',
'["Végétarien", "Vegan", "Sans gluten", "Riche en protéines"]', 'toutes', 'Cours Cuisine asiatique santé'),

(NULL, 'Gratin de légumes sans lactose', 'plat', 20, 35, 4,
'- 2 courgettes
- 2 aubergines
- 4 tomates
- 1 oignon
- 3 gousses d''ail
- Herbes de Provence
- Huile d''olive
Béchamel végétale:
- 30g de farine de riz
- 300ml de lait d''amande
- 2 c. à soupe de levure nutritionnelle
- Muscade',
'1. Trancher les légumes finement
2. Les disposer en alternance dans un plat
3. Parsemer d''ail, herbes, huile
4. Pour la béchamel: chauffer le lait, ajouter la farine en fouettant
5. Ajouter levure nutritionnelle et muscade
6. Verser sur les légumes
7. Cuire 35 min à 180°C

Alternative: Remplacer la béchamel par du fromage de cajou',
'["Végétarien", "Vegan", "Sans lactose", "Sans gluten"]', 'ete', 'Cours Alternatives aux produits laitiers'),

-- ============================================
-- SALADES ET ACCOMPAGNEMENTS
-- ============================================

(NULL, 'Salade de quinoa méditerranéenne', 'plat', 15, 15, 4,
'- 200g de quinoa
- 1 concombre
- 200g de tomates cerises
- 1 poivron jaune
- 100g d''olives noires
- 1 oignon rouge
- Feta végétale ou classique (optionnel)
- Menthe et persil frais
Vinaigrette:
- 4 c. à soupe d''huile d''olive
- 2 c. à soupe de jus de citron
- 1 gousse d''ail pressée
- Origan',
'1. Rincer et cuire le quinoa 15 min
2. Laisser refroidir
3. Couper tous les légumes en dés
4. Préparer la vinaigrette
5. Mélanger quinoa, légumes, herbes
6. Assaisonner avec la vinaigrette
7. Servir frais

Conseil: Se conserve 2-3 jours au frais',
'["Végétarien", "Vegan", "Sans gluten", "Protéines complètes"]', 'ete', 'Cours Alimentation méditerranéenne'),

(NULL, 'Taboulé de chou-fleur cru', 'plat', 15, 0, 4,
'- 1 chou-fleur
- 1 botte de persil
- 1/2 botte de menthe
- 4 tomates
- 1 concombre
- 4 oignons verts
- Jus de 2 citrons
- 4 c. à soupe d''huile d''olive
- Sel, poivre
- Sumac (optionnel)',
'1. Mixer le chou-fleur pour obtenir une semoule
2. Hacher finement les herbes
3. Couper tomates et concombre en petits dés
4. Émincer les oignons verts
5. Mélanger le tout
6. Assaisonner avec citron, huile, sel
7. Réfrigérer 30 min avant de servir

Bienfaits: Version IG très bas, riche en vitamine C',
'["Végétarien", "Vegan", "Sans gluten", "Cru", "IG très bas", "Keto"]', 'ete', 'Cours Alimentation vivante'),

(NULL, 'Carottes rôties au cumin', 'plat', 10, 30, 4,
'- 600g de carottes
- 2 c. à soupe d''huile d''olive
- 1 c. à café de cumin en poudre
- 1/2 c. à café de cannelle
- 2 c. à soupe de miel
- Jus d''1 orange
- Coriandre fraîche
- Graines de sésame',
'1. Préchauffer le four à 200°C
2. Couper les carottes en bâtonnets
3. Mélanger huile, cumin, cannelle, miel, jus d''orange
4. Enrober les carottes
5. Rôtir 25-30 min en retournant à mi-cuisson
6. Servir avec coriandre et sésame

Astuce: Fonctionne aussi avec panais ou betteraves',
'["Végétarien", "Vegan", "Sans gluten", "Antioxydant"]', 'automne', 'Cours Cuisson des légumes'),

-- ============================================
-- COLLATIONS ET EN-CAS SAINS
-- ============================================

(NULL, 'Energy balls cacao-dattes', 'collation', 15, 0, 12,
'- 150g de dattes Medjool dénoyautées
- 100g d''amandes
- 3 c. à soupe de cacao cru
- 2 c. à soupe de beurre de coco
- 1 c. à soupe de graines de chia
- 1 pincée de sel
- Noix de coco râpée pour enrober',
'1. Mixer les amandes en poudre grossière
2. Ajouter les dattes, mixer à nouveau
3. Ajouter cacao, beurre de coco, chia, sel
4. Former des boules avec les mains humides
5. Rouler dans la noix de coco
6. Réfrigérer 1h minimum

Conservation: 2 semaines au frigo, 2 mois au congélateur',
'["Végétarien", "Vegan", "Sans gluten", "Énergie naturelle"]', 'toutes', 'Cours Snacks santé'),

(NULL, 'Houmous maison', 'collation', 10, 0, 6,
'- 400g de pois chiches cuits
- 3 c. à soupe de tahini (purée de sésame)
- Jus d''1 citron
- 2 gousses d''ail
- 4 c. à soupe d''huile d''olive
- 1 c. à café de cumin
- Sel
- Paprika pour servir',
'1. Égoutter les pois chiches, garder un peu d''eau
2. Mixer les pois chiches avec l''ail
3. Ajouter tahini, citron, cumin
4. Mixer en ajoutant l''huile en filet
5. Ajuster la texture avec l''eau de cuisson
6. Servir avec un filet d''huile et du paprika

Variantes: Houmous betterave, avocat, poivrons grillés',
'["Végétarien", "Vegan", "Sans gluten", "Protéines végétales"]', 'toutes', 'Cours Protéines végétales'),

(NULL, 'Crackers aux graines', 'collation', 10, 25, 20,
'- 50g de graines de tournesol
- 50g de graines de courge
- 30g de graines de lin
- 30g de graines de sésame
- 20g de graines de chia
- 1 c. à café de sel
- 1/2 c. à café de curcuma
- 150ml d''eau',
'1. Mélanger toutes les graines et épices
2. Ajouter l''eau, laisser gonfler 15 min
3. Étaler finement sur une plaque (papier cuisson)
4. Cuire 20 min à 160°C
5. Retourner, cuire encore 10 min
6. Laisser refroidir et casser en morceaux

Conseil: Doivent être bien secs et croustillants',
'["Végétarien", "Vegan", "Sans gluten", "Oméga-3", "Keto"]', 'toutes', 'Cours Graines et oléagineux'),

(NULL, 'Compote pomme-cannelle sans sucre', 'collation', 5, 15, 4,
'- 4 pommes
- 1 c. à café de cannelle
- 1/2 c. à café de vanille
- 100ml d''eau
- Optionnel: quelques dattes',
'1. Éplucher et couper les pommes en morceaux
2. Mettre dans une casserole avec l''eau
3. Cuire à couvert 15 min
4. Écraser à la fourchette ou mixer
5. Ajouter cannelle et vanille
6. Servir tiède ou froid

Bienfaits: La cannelle aide à réguler la glycémie',
'["Végétarien", "Vegan", "Sans gluten", "Sans sucre ajouté", "IG bas"]', 'automne', 'Cours Index glycémique'),

-- ============================================
-- BOISSONS SANTÉ
-- ============================================

(NULL, 'Golden milk (lait d''or)', 'boisson', 5, 5, 2,
'- 400ml de lait de coco ou amande
- 1 c. à café de curcuma en poudre
- 1/2 c. à café de gingembre
- 1/4 c. à café de cannelle
- 1 pincée de poivre noir
- 1 c. à café de miel ou sirop d''érable
- 1/2 c. à café d''huile de coco',
'1. Chauffer le lait à feu doux
2. Ajouter toutes les épices
3. Fouetter pour bien mélanger
4. Ajouter le miel et l''huile de coco
5. Servir chaud

Important: Le poivre et les graisses optimisent l''absorption du curcuma',
'["Végétarien", "Vegan", "Sans gluten", "Anti-inflammatoire"]', 'hiver', 'Cours Curcuma et inflammation'),

(NULL, 'Tisane digestive', 'boisson', 5, 10, 2,
'- 1 c. à café de graines de fenouil
- 1 c. à café de graines de cumin
- Quelques feuilles de menthe fraîche
- 1 rondelle de gingembre frais
- 500ml d''eau chaude',
'1. Écraser légèrement fenouil et cumin
2. Mettre dans une théière avec menthe et gingembre
3. Verser l''eau frémissante (pas bouillante)
4. Infuser 10 min à couvert
5. Filtrer et boire après les repas

Conseil: Idéale 30 min après un repas copieux',
'["Végétarien", "Vegan", "Sans gluten", "Digestive"]', 'toutes', 'Cours Troubles digestifs'),

(NULL, 'Jus vert reminéralisant', 'boisson', 10, 0, 2,
'- 2 branches de céleri
- 1 concombre
- 1 pomme verte
- 1 poignée d''épinards
- 1/2 citron pelé
- 1 cm de gingembre
- Quelques feuilles de persil',
'1. Laver tous les ingrédients
2. Passer à l''extracteur de jus
3. Ou mixer puis filtrer au tamis fin
4. Boire immédiatement

Astuce: Consommer à jeun le matin pour une meilleure absorption',
'["Végétarien", "Vegan", "Sans gluten", "Cru", "Alcalinisant", "Reminéralisant"]', 'printemps', 'Cours Reminéralisation'),

(NULL, 'Chocolat chaud healthy', 'boisson', 5, 5, 2,
'- 400ml de lait d''amande
- 2 c. à soupe de cacao cru
- 1 c. à soupe de purée de noisette
- 1 c. à café de maca (optionnel)
- 1 c. à café de miel
- 1 pincée de cannelle',
'1. Chauffer le lait à feu doux
2. Fouetter avec le cacao et la purée de noisette
3. Ajouter maca, miel, cannelle
4. Servir chaud avec un peu de cannelle

Bienfaits: Le cacao cru est riche en magnésium et antioxydants',
'["Végétarien", "Vegan", "Sans gluten", "Réconfortant", "Magnésium"]', 'hiver', 'Cours Super-aliments'),

-- ============================================
-- DESSERTS LÉGERS
-- ============================================

(NULL, 'Mousse au chocolat avocat', 'dessert', 10, 0, 4,
'- 2 avocats bien mûrs
- 4 c. à soupe de cacao cru
- 3 c. à soupe de sirop d''érable
- 1 c. à café de vanille
- 1 pincée de sel
- 50ml de lait de coco
- Fruits rouges pour servir',
'1. Mixer les avocats jusqu''à consistance lisse
2. Ajouter le cacao, mixer à nouveau
3. Incorporer sirop d''érable, vanille, sel
4. Ajuster avec le lait de coco si besoin
5. Réfrigérer 2h minimum
6. Servir avec des fruits rouges

Astuce: On ne sent pas l''avocat mais il apporte l''onctuosité',
'["Végétarien", "Vegan", "Sans gluten", "Sans sucre raffiné", "Bonnes graisses"]', 'toutes', 'Cours Desserts sans sucre'),

(NULL, 'Panna cotta coco-mangue', 'dessert', 15, 5, 4,
'- 400ml de lait de coco
- 2 c. à soupe de sirop d''érable
- 1 c. à café d''agar-agar
- 1/2 c. à café de vanille
- 1 mangue mûre
- Quelques feuilles de menthe',
'1. Chauffer le lait de coco avec sirop et vanille
2. Ajouter l''agar-agar, fouetter 2 min
3. Verser dans des ramequins
4. Réfrigérer minimum 4h
5. Mixer la mangue en coulis
6. Démouler et servir avec le coulis

Note: L''agar-agar prend au frigo, pas besoin de gélatine animale',
'["Végétarien", "Vegan", "Sans gluten", "Sans lactose"]', 'ete', 'Cours Alternatives végétales'),

(NULL, 'Crumble aux pommes IG bas', 'dessert', 15, 30, 6,
'Garniture:
- 4 pommes
- 1 c. à café de cannelle
- Jus d''1/2 citron
Crumble:
- 80g de farine d''amande
- 50g de flocons d''avoine
- 40g d''huile de coco fondue
- 2 c. à soupe de sirop d''érable
- 1 pincée de sel',
'1. Préchauffer le four à 180°C
2. Couper les pommes, mélanger avec cannelle et citron
3. Disposer dans un plat à gratin
4. Mélanger les ingrédients du crumble
5. Émietter sur les pommes
6. Cuire 30 min jusqu''à doré

Variante: Fonctionne aussi avec poires, prunes, fruits rouges',
'["Végétarien", "Vegan", "Sans gluten", "IG bas"]', 'automne', 'Cours Desserts IG bas'),

(NULL, 'Nice cream banane-cacao', 'dessert', 5, 0, 2,
'- 3 bananes mûres congelées
- 2 c. à soupe de cacao cru
- 2 c. à soupe de beurre de cacahuète
- Un peu de lait végétal si besoin
- Toppings: éclats de cacao, noix',
'1. Couper les bananes congelées en rondelles
2. Mixer au robot ou blender puissant
3. Ajouter cacao et beurre de cacahuète
4. Mixer jusqu''à consistance crémeuse
5. Servir immédiatement avec les toppings

Astuce: Congeler les bananes bien mûres pour plus de sucre naturel',
'["Végétarien", "Vegan", "Sans gluten", "Sans sucre ajouté"]', 'ete', 'Cours Desserts crus');

SELECT 'Recettes insérées avec succès!' AS message;
