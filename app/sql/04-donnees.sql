-- ============================================
-- PARTIE 4: DONNEES INITIALES
-- ============================================

-- Utilisateur par défaut (mot de passe: naturo2026)
INSERT INTO users (username, password_hash, nom, prenom, email) VALUES (
    'praticien',
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
    'Praticien',
    'PHV',
    'praticien@phv.fr'
);

-- Prestations par défaut
INSERT INTO prestations (user_id, nom, description, duree_minutes, tarif) VALUES
(1, 'Première consultation', 'Bilan complet et PHV personnalisé', 90, 70.00),
(1, 'Consultation de suivi', 'Suivi et ajustements du PHV', 60, 50.00),
(1, 'Consultation téléphonique', 'Suivi rapide par téléphone', 30, 30.00),
(1, 'Téléconsultation vidéo', 'Consultation en visioconférence', 60, 55.00),
(1, 'Bilan alimentaire', 'Analyse détaillée des habitudes alimentaires', 45, 40.00);

-- Paramètres utilisateur par défaut
INSERT INTO user_settings (user_id, nom_cabinet, mentions_facture) VALUES
(1, 'Cabinet de Naturopathie', 'Naturopathe certifié - Non conventionné - Règlement à réception');

-- Contre-indications de base
INSERT INTO contre_indications (type_element, nom_element, condition_ci, description, niveau_gravite) VALUES
('plante', 'Millepertuis', 'Pilule contraceptive', 'Diminue efficacité contraception', 'danger'),
('plante', 'Millepertuis', 'Antidépresseurs', 'Risque syndrome sérotoninergique', 'danger'),
('plante', 'Millepertuis', 'Anticoagulants', 'Diminue effet anticoagulant', 'danger'),
('plante', 'Ginkgo biloba', 'Anticoagulants', 'Augmente risque saignement', 'danger'),
('plante', 'Réglisse', 'Hypertension', 'Peut augmenter tension', 'attention'),
('plante', 'Réglisse', 'Grossesse', 'Risque accouchement prématuré', 'danger'),
('plante', 'Echinacée', 'Maladies auto-immunes', 'Stimulation immunitaire non souhaitée', 'danger'),
('huile_essentielle', 'Menthe poivrée', 'Grossesse', 'Contre-indiquée grossesse', 'danger'),
('huile_essentielle', 'Menthe poivrée', 'Enfants < 6 ans', 'Risque spasme laryngé', 'danger'),
('huile_essentielle', 'Sauge officinale', 'Epilepsie', 'Peut déclencher crises', 'danger'),
('huile_essentielle', 'Sauge officinale', 'Grossesse', 'Abortive', 'danger'),
('huile_essentielle', 'Romarin CT camphre', 'Epilepsie', 'Neurotoxique', 'danger'),
('complement', 'Fer', 'Hémochromatose', 'Surcharge fer contre-indiquée', 'danger'),
('complement', 'Vitamine K', 'Anticoagulants AVK', 'Diminue efficacité traitement', 'danger'),
('complement', 'Potassium', 'Insuffisance rénale', 'Risque hyperkaliémie', 'danger'),
('aliment', 'Pamplemousse', 'Statines', 'Inhibe métabolisme hépatique', 'danger');
