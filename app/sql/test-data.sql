-- ============================================
-- PHV App - Données de test
-- Clients, consultations et rendez-vous fictifs
-- IMPORTANT: Sélectionnez pertec_natu dans phpMyAdmin avant d'importer
-- ============================================

-- ============================================
-- CLIENTS DE TEST
-- ============================================
INSERT INTO clients (user_id, nom, prenom, date_naissance, age, sexe, adresse, email, telephone, profession, lieu_de_vie, taille_cm, poids_kg, notes, allergies, traitements_en_cours, antecedents_medicaux, grossesse, allaitement) VALUES

(1, 'Martin', 'Sophie', '1985-03-15', 39, 'femme',
'12 rue des Lilas, 75011 Paris', 'sophie.martin@email.fr', '06 12 34 56 78',
'Cadre marketing', 'Appartement en ville, 2 enfants',
165, 62.5,
'Première consultation suite à fatigue chronique. Motivation élevée pour changement alimentaire.',
'Fruits à coque (noix, noisettes)', 'Aucun', 'Thyroïdite de Hashimoto diagnostiquée en 2019', FALSE, FALSE),

(1, 'Dubois', 'Jean-Pierre', '1972-08-22', 52, 'homme',
'45 avenue de la République, 69003 Lyon', 'jp.dubois@gmail.com', '06 98 76 54 32',
'Chef d''entreprise', 'Maison avec jardin, vit seul',
178, 89.0,
'Stress professionnel important. Troubles du sommeil. Souhaite perdre du poids.',
NULL, 'Oméprazole 20mg (RGO)', 'Hypertension artérielle contrôlée, RGO', FALSE, FALSE),

(1, 'Leroy', 'Marie', '1990-11-08', 34, 'femme',
'8 place du Marché, 33000 Bordeaux', 'marie.leroy@outlook.fr', '07 11 22 33 44',
'Infirmière', 'Appartement, en couple sans enfant',
170, 58.0,
'Problèmes digestifs récurrents (ballonnements, transit irrégulier). Travail en horaires décalés.',
'Lactose (intolérance)', 'Pilule contraceptive', 'Syndrome de l''intestin irritable', FALSE, FALSE),

(1, 'Bernard', 'Lucas', '1998-05-30', 26, 'homme',
'22 rue de la Gare, 44000 Nantes', 'lucas.bernard@proton.me', '06 55 44 33 22',
'Développeur web', 'Colocation en centre-ville',
182, 70.0,
'Acné persistante malgré traitements dermatologiques. Alimentation déséquilibrée (beaucoup de fast-food).',
NULL, 'Zinc (prescription dermato)', 'Acné depuis adolescence', FALSE, FALSE),

(1, 'Petit', 'Isabelle', '1965-01-12', 60, 'femme',
'156 chemin des Vignes, 13100 Aix-en-Provence', 'isabelle.petit@free.fr', '04 42 12 34 56',
'Retraitée (ex-enseignante)', 'Maison, vit avec son mari',
162, 68.0,
'Ménopause difficile : bouffées de chaleur, prise de poids, humeur instable. Refuse THS.',
'Aspirine', NULL, 'Arthrose cervicale, ostéopénie', FALSE, FALSE),

(1, 'Moreau', 'Antoine', '1988-07-19', 36, 'homme',
'3 bis rue Pasteur, 31000 Toulouse', 'a.moreau@entreprise.com', '06 77 88 99 00',
'Commercial', 'Appartement, divorcé, garde alternée 2 enfants',
175, 82.0,
'Surmenage, début de burn-out. Douleurs dorsales chroniques. Mange souvent au restaurant.',
NULL, 'Doliprane occasionnel', 'Hernie discale L4-L5 (2020)', FALSE, FALSE),

(1, 'Garcia', 'Emma', '1995-12-03', 29, 'femme',
'67 boulevard Victor Hugo, 06000 Nice', 'emma.garcia@yahoo.fr', '07 22 33 44 55',
'Professeure de yoga', 'Studio, célibataire',
168, 54.0,
'Aménorrhée depuis 6 mois (arrêt pilule). Souhaite conception dans l''année. Végétarienne.',
NULL, NULL, 'Endométriose légère diagnostiquée', FALSE, FALSE),

(1, 'Roux', 'Philippe', '1958-04-25', 66, 'homme',
'89 rue du Commerce, 35000 Rennes', 'philippe.roux@orange.fr', '02 99 12 34 56',
'Retraité (ex-artisan)', 'Maison, vit avec son épouse',
172, 91.0,
'Diabète type 2 récent. Cholestérol. Motivation pour éviter les médicaments si possible.',
NULL, 'Metformine 500mg x2/jour', 'Diabète T2, hypercholestérolémie, surpoids', FALSE, FALSE),

(1, 'Simon', 'Camille', '2008-09-14', 16, 'femme',
'14 allée des Cerisiers, 67000 Strasbourg', 'parents.simon@gmail.com', '06 11 22 33 44',
'Lycéenne', 'Maison familiale avec parents et frère',
163, 52.0,
'Consultation demandée par les parents. Fatigue, difficultés de concentration, maux de tête fréquents. Alimentation ado classique.',
'Arachides', NULL, 'Migraines (bilan neuro normal)', FALSE, FALSE),

(1, 'Laurent', 'Nathalie', '1980-06-28', 44, 'femme',
'5 square des Tilleuls, 59000 Lille', 'nathalie.laurent@hotmail.fr', '06 66 77 88 99',
'Avocate', 'Appartement, mariée, 3 enfants',
167, 71.0,
'Épuisement maternel et professionnel. Infections ORL à répétition. Demande d''accompagnement global.',
'Pénicilline', 'Levothyrox 75µg', 'Hypothyroïdie, terrain anxieux', FALSE, FALSE),

(1, 'Michel', 'David', '1992-02-17', 33, 'homme',
'28 rue de la Liberté, 21000 Dijon', 'd.michel@startup.io', '07 99 88 77 66',
'Entrepreneur tech', 'Loft, en couple',
180, 75.0,
'Troubles anxieux, attaques de panique occasionnelles. Gros consommateur de café. Peu de sport.',
NULL, 'Xanax occasionnel (prescrit)', 'Trouble anxieux généralisé', FALSE, FALSE),

(1, 'Fournier', 'Claire', '1975-10-05', 49, 'femme',
'92 route de Genève, 74000 Annecy', 'claire.fournier@lac.fr', '04 50 12 34 56',
'Gestionnaire de patrimoine', 'Maison au bord du lac, mariée',
164, 66.0,
'Pré-ménopause, cycles irréguliers. SPM intense. Rétention d''eau. Sportive (trail, natation).',
NULL, 'Magnésium, Vitamine D', 'Fibrome utérin surveillé', FALSE, FALSE);

-- ============================================
-- CONSULTATIONS DE TEST
-- ============================================
INSERT INTO consultations (client_id, user_id, motif, motif_categorie, date_consultation, duree_minutes, type_seance, statut, current_step, notes_praticien) VALUES

-- Sophie Martin - consultation terminée
(1, 1, 'Fatigue chronique depuis 6 mois, difficultés de concentration', 'Fatigue / Energie',
'2024-12-15', 90, 'premiere', 'terminee', 6,
'Bilan thyroïdien à jour. Carence ferritine probable. Terrain acidifié.'),

-- Jean-Pierre Dubois - consultation en cours
(2, 1, 'Stress et troubles du sommeil, souhait de perte de poids', 'Stress / Sommeil',
'2025-01-20', 75, 'premiere', 'phv', 5,
'Terrain hépatique surchargé. Résistance à l''insuline probable.'),

-- Marie Leroy - suivi
(3, 1, 'Suivi troubles digestifs - amélioration notable', 'Digestif',
'2025-02-01', 60, 'suivi', 'terminee', 6,
'Bonne évolution avec protocole FODMAP adapté.'),

-- Emma Garcia - consultation récente
(7, 1, 'Aménorrhée post-pilule, projet de grossesse', 'Hormonal / Fertilité',
'2025-01-28', 90, 'premiere', 'synthese', 4,
'Axe hypothalamo-hypophysaire à soutenir. Carences possibles (végétarienne).');

-- ============================================
-- RENDEZ-VOUS A VENIR (si table existe)
-- ============================================
INSERT INTO rendez_vous (user_id, client_id, titre, date_rdv, heure_debut, heure_fin, duree_minutes, type_rdv, statut, lieu, tarif, notes) VALUES

(1, 2, 'Suivi Jean-Pierre Dubois', '2025-02-10', '09:00:00', '10:00:00', 60, 'suivi', 'confirme', 'Cabinet', 50.00, 'Vérifier évolution sommeil et poids'),

(1, 4, 'Première consultation Lucas Bernard', '2025-02-12', '14:00:00', '15:30:00', 90, 'premiere_consultation', 'planifie', 'Cabinet', 70.00, 'Acné - prévoir questionnaire alimentaire détaillé'),

(1, 5, 'Suivi Isabelle Petit', '2025-02-14', '10:30:00', '11:30:00', 60, 'suivi', 'confirme', 'Cabinet', 50.00, 'Point ménopause - 1 mois après début protocole'),

(1, 6, 'Première consultation Antoine Moreau', '2025-02-15', '11:00:00', '12:30:00', 90, 'premiere_consultation', 'planifie', 'Cabinet', 70.00, 'Burn-out - prévoir temps d''écoute'),

(1, 8, 'Suivi Philippe Roux', '2025-02-17', '09:00:00', '10:00:00', 60, 'suivi', 'confirme', 'Cabinet', 50.00, 'Contrôle glycémie à apporter'),

(1, 10, 'Première consultation Nathalie Laurent', '2025-02-18', '17:00:00', '18:30:00', 90, 'premiere_consultation', 'planifie', 'Cabinet', 70.00, 'RDV tardif à sa demande (avocate)'),

(1, NULL, 'Réunion réseau naturopathes', '2025-02-20', '19:00:00', '21:00:00', 120, 'autre', 'planifie', 'Visio', NULL, 'Réunion mensuelle du réseau'),

(1, 11, 'Suivi David Michel', '2025-02-22', '15:00:00', '16:00:00', 60, 'suivi', 'planifie', 'Visio', 50.00, 'Consultation à distance - point anxiété'),

(1, 7, 'Suivi Emma Garcia', '2025-02-25', '11:00:00', '12:00:00', 60, 'suivi', 'planifie', 'Cabinet', 50.00, 'Point cycle et fertilité');

-- ============================================
-- MESURES CLIENTS (évolution)
-- ============================================
INSERT INTO client_mesures (client_id, consultation_id, date_mesure, poids_kg, niveau_stress, qualite_sommeil, niveau_energie, niveau_digestion, notes) VALUES

-- Sophie Martin - évolution
(1, 1, '2024-12-15', 62.5, 7, 4, 3, 6, 'Première consultation'),
(1, NULL, '2025-01-15', 61.0, 5, 6, 5, 7, 'Suivi 1 mois'),
(1, NULL, '2025-02-01', 60.0, 4, 7, 6, 8, 'Bonne progression'),

-- Jean-Pierre Dubois - évolution
(2, 2, '2025-01-20', 89.0, 9, 3, 4, 5, 'Première consultation'),
(2, NULL, '2025-02-01', 87.5, 7, 5, 5, 6, 'Début amélioration sommeil'),

-- Marie Leroy - évolution
(3, NULL, '2024-11-01', 58.0, 5, 6, 5, 3, 'Avant protocole'),
(3, 3, '2025-02-01', 57.5, 4, 7, 7, 7, 'Nette amélioration digestive');

-- ============================================
-- OBJECTIFS CLIENTS
-- ============================================
INSERT INTO client_objectifs (client_id, titre, description, type_objectif, valeur_cible, valeur_initiale, date_debut, date_cible, statut, progression) VALUES

(1, 'Retrouver énergie stable', 'Niveau d''énergie à 7/10 minimum en fin de journée', 'energie', '7/10', '3/10', '2024-12-15', '2025-03-15', 'en_cours', 60),
(1, 'Équilibrer alimentation', 'Intégrer légumes à chaque repas', 'alimentation', '2 portions/repas', '0-1 portion', '2024-12-15', '2025-02-15', 'atteint', 100),

(2, 'Perte de poids progressive', 'Objectif -8kg sur 4 mois', 'poids', '81 kg', '89 kg', '2025-01-20', '2025-05-20', 'en_cours', 20),
(2, 'Améliorer sommeil', 'Dormir 7h minimum sans réveil', 'sommeil', '7h', '5h fragmentées', '2025-01-20', '2025-03-20', 'en_cours', 40),

(3, 'Confort digestif', 'Réduire ballonnements à 1-2x/semaine max', 'autre', '1-2x/sem', 'Quotidien', '2024-11-01', '2025-02-01', 'atteint', 100),

(7, 'Retour des cycles', 'Retrouver cycles réguliers pour projet bébé', 'autre', 'Cycles 28-32j', 'Aménorrhée', '2025-01-28', '2025-07-28', 'en_cours', 10);

-- ============================================
-- FACTURES DE TEST
-- ============================================
INSERT INTO factures (user_id, client_id, consultation_id, numero_facture, date_facture, montant_ht, montant_ttc, statut, mode_paiement, date_paiement) VALUES

(1, 1, 1, 'FAC-2024-001', '2024-12-15', 70.00, 70.00, 'payee', 'cheque', '2024-12-15'),
(1, 2, 2, 'FAC-2025-001', '2025-01-20', 70.00, 70.00, 'payee', 'cb', '2025-01-20'),
(1, 3, 3, 'FAC-2025-002', '2025-02-01', 50.00, 50.00, 'payee', 'especes', '2025-02-01'),
(1, 7, 4, 'FAC-2025-003', '2025-01-28', 70.00, 70.00, 'envoyee', NULL, NULL);

INSERT INTO facture_lignes (facture_id, description, quantite, prix_unitaire, montant) VALUES
(1, 'Première consultation naturopathie', 1, 70.00, 70.00),
(2, 'Première consultation naturopathie', 1, 70.00, 70.00),
(3, 'Consultation de suivi', 1, 50.00, 50.00),
(4, 'Première consultation naturopathie', 1, 70.00, 70.00);

SELECT 'Données de test insérées avec succès!' AS message;
