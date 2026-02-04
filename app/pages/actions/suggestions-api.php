<?php
/**
 * API de suggestions contextuelles
 * Endpoint AJAX pour récupérer des suggestions basées sur les données de consultation
 */

require_once __DIR__ . '/../../config/app.php';
require_once __DIR__ . '/../../data/knowledge-base.php';

header('Content-Type: application/json');

// Vérifier l'authentification
if (!isLoggedIn()) {
    http_response_code(401);
    echo json_encode(['error' => 'Non authentifié']);
    exit;
}

$action = $_GET['action'] ?? $_POST['action'] ?? '';

switch ($action) {
    case 'search':
        // Recherche libre dans la base de connaissances
        $query = $_GET['q'] ?? $_POST['q'] ?? '';
        $contexts = isset($_GET['contexts']) ? explode(',', $_GET['contexts']) : [];

        if (strlen($query) < 2) {
            echo json_encode(['results' => []]);
            exit;
        }

        $results = searchKnowledge($query, $contexts);
        echo json_encode(['results' => $results]);
        break;

    case 'contextual':
        // Suggestions contextuelles basées sur une consultation
        $consultId = (int)($_GET['consultation_id'] ?? $_POST['consultation_id'] ?? 0);

        if (!$consultId) {
            http_response_code(400);
            echo json_encode(['error' => 'ID consultation requis']);
            exit;
        }

        $db = getDB();
        $userId = currentUserId();

        // Récupérer les données de la consultation
        $stmt = $db->prepare("
            SELECT c.*, cl.sexe AS client_sexe, cl.date_naissance AS client_dob
            FROM consultations c
            JOIN clients cl ON c.client_id = cl.id
            WHERE c.id = ? AND c.user_id = ?
        ");
        $stmt->execute([$consultId, $userId]);
        $consultation = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$consultation) {
            http_response_code(404);
            echo json_encode(['error' => 'Consultation non trouvée']);
            exit;
        }

        // Récupérer les réponses du questionnaire
        $repStmt = $db->prepare("SELECT question_key, reponse FROM consultation_reponses WHERE consultation_id = ?");
        $repStmt->execute([$consultId]);
        $reponses = $repStmt->fetchAll(PDO::FETCH_KEY_PAIR);

        // Fusionner les données
        $consultationData = array_merge($consultation, $reponses);

        // Obtenir les suggestions
        $suggestions = getContextualSuggestions($consultationData);

        echo json_encode([
            'suggestions' => $suggestions,
            'consultation' => [
                'motif' => $consultation['motif'],
                'motif_categorie' => $consultation['motif_categorie']
            ]
        ]);
        break;

    case 'phv-prefill':
        // Pré-remplissage intelligent du PHV basé sur la synthèse et les réponses
        $consultId = (int)($_GET['consultation_id'] ?? $_POST['consultation_id'] ?? 0);

        if (!$consultId) {
            http_response_code(400);
            echo json_encode(['error' => 'ID consultation requis']);
            exit;
        }

        $db = getDB();
        $userId = currentUserId();

        // Récupérer la consultation et la synthèse
        $stmt = $db->prepare("
            SELECT c.*, cs.priorite_1, cs.priorite_2, cs.priorite_3, cs.observations,
                   cl.sexe AS client_sexe
            FROM consultations c
            LEFT JOIN consultation_synthese cs ON cs.consultation_id = c.id
            JOIN clients cl ON c.client_id = cl.id
            WHERE c.id = ? AND c.user_id = ?
        ");
        $stmt->execute([$consultId, $userId]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            http_response_code(404);
            echo json_encode(['error' => 'Consultation non trouvée']);
            exit;
        }

        // Récupérer les réponses
        $repStmt = $db->prepare("SELECT question_key, reponse FROM consultation_reponses WHERE consultation_id = ?");
        $repStmt->execute([$consultId]);
        $reponses = $repStmt->fetchAll(PDO::FETCH_KEY_PAIR);

        // Générer les pré-remplissages
        $prefill = generatePhvPrefill($data, $reponses);

        echo json_encode(['prefill' => $prefill]);
        break;

    case 'get-section':
        // Récupérer une section spécifique de la base de connaissances
        $section = $_GET['section'] ?? '';
        $subsection = $_GET['subsection'] ?? '';

        $knowledge = getKnowledgeBase();

        if (!isset($knowledge[$section])) {
            http_response_code(404);
            echo json_encode(['error' => 'Section non trouvée']);
            exit;
        }

        $result = $knowledge[$section];
        if ($subsection && isset($result[$subsection])) {
            $result = $result[$subsection];
        }

        echo json_encode(['data' => $result]);
        break;

    default:
        http_response_code(400);
        echo json_encode(['error' => 'Action non reconnue']);
}

/**
 * Génère le pré-remplissage intelligent du PHV
 */
function generatePhvPrefill(array $consultation, array $reponses): array {
    $knowledge = getKnowledgeBase();
    $prefill = [
        'alimentation' => '',
        'alimentation_eviter' => '',
        'alimentation_privilegier' => '',
        'menu_type' => '',
        'gestion_stress' => '',
        'activite_physique' => '',
        'routine_matin' => '',
        'routine_soir' => '',
        'soins_naturels' => '',
        'complements' => [],
        'recommandations_complementaires' => '',
    ];

    $motif = strtolower($consultation['motif'] ?? '');
    $priorite1 = strtolower($consultation['priorite_1'] ?? '');
    $priorite2 = strtolower($consultation['priorite_2'] ?? '');

    $stressNiveau = (int)($reponses['stress_niveau'] ?? 5);
    $sommeilQualite = (int)($reponses['sommeil_qualite'] ?? 5);
    $activiteNiveau = (int)($reponses['activite_niveau'] ?? 5);
    $digTroubles = strtolower($reponses['dig_troubles'] ?? '');

    // === ALIMENTATION ===
    $alimConseils = [];
    $alimEviter = [];
    $alimPrivilegier = [];

    // Conseils de base
    $alimConseils[] = "• Mastiquer chaque bouchée 20-30 fois (la digestion commence dans la bouche)";
    $alimConseils[] = "• Boire 1,5L d'eau par jour, en dehors des repas";
    $alimConseils[] = "• Manger dans le calme, sans écran, en conscience";

    // Selon les troubles digestifs
    if (str_contains($digTroubles, 'ballonnement') || str_contains($digTroubles, 'gaz') || str_contains($priorite1, 'digest')) {
        $alimConseils[] = "• Fractionner les repas si besoin (3 repas + 1 collation)";
        $alimConseils[] = "• Éviter les crudités le soir (préférer légumes cuits)";
        $alimConseils[] = "• Ne pas mélanger trop d'aliments différents dans le même repas";
        $alimEviter = array_merge($alimEviter, ['Crudités le soir', 'Boissons gazeuses', 'Chewing-gums', 'Excès de fibres crues']);
        $alimPrivilegier = array_merge($alimPrivilegier, ['Légumes cuits à la vapeur', 'Fenouil (digestif)', 'Gingembre frais', 'Tisanes digestives (menthe, verveine)']);
    }

    // Selon inflammation/douleur
    if (str_contains($motif, 'inflammat') || str_contains($motif, 'douleur') || str_contains($motif, 'arthro') || str_contains($motif, 'articul')) {
        $alimEviter = array_merge($alimEviter, ['Sucres raffinés', 'Viandes rouges (max 1-2x/semaine)', 'Produits laitiers (tester éviction)', 'Aliments ultra-transformés', 'Huiles riches en oméga-6 (tournesol, maïs)']);
        $alimPrivilegier = array_merge($alimPrivilegier, ['Petits poissons gras (sardines, maquereaux)', 'Curcuma + poivre noir', 'Huile d\'olive vierge', 'Légumes colorés', 'Fruits rouges']);
    }

    // Si stress élevé
    if ($stressNiveau >= 6) {
        $alimPrivilegier = array_merge($alimPrivilegier, ['Aliments riches en magnésium (oléagineux, chocolat noir)', 'Légumineuses', 'Céréales complètes']);
        $alimEviter = array_merge($alimEviter, ['Café (max 1/jour le matin)', 'Alcool', 'Sucres rapides (pics glycémiques)']);
    }

    $prefill['alimentation'] = implode("\n", array_unique($alimConseils));
    $prefill['alimentation_eviter'] = implode("\n", array_map(fn($a) => "• $a", array_unique($alimEviter)));
    $prefill['alimentation_privilegier'] = implode("\n", array_map(fn($a) => "• $a", array_unique($alimPrivilegier)));

    // Menu type selon chronobiologie
    $prefill['menu_type'] = "PETIT-DÉJEUNER (protéiné + gras) :
• 2 œufs (brouillés, mollets ou au plat)
• 1 tranche de pain complet au levain + beurre ou avocat
• 1 fruit frais de saison
• Thé vert ou infusion

DÉJEUNER (repas principal) :
• Crudités en entrée (carottes râpées, salade)
• Protéine (poisson, volaille, légumineuses)
• Légumes cuits + céréale complète (quinoa, riz complet)
• 1 c. à soupe d'huile d'olive

COLLATION (si besoin, 16-17h) :
• Poignée d'oléagineux (amandes, noix)
• 1 fruit ou carré de chocolat noir 70%

DÎNER (léger, digeste) :
• Soupe de légumes ou légumes cuits vapeur
• Petite portion de protéine légère (poisson blanc, œuf)
• Éviter féculents et crudités le soir";

    // === GESTION DU STRESS ===
    $stressConseils = [];
    if ($stressNiveau >= 5) {
        $stressConseils[] = "COHÉRENCE CARDIAQUE (3x/jour, 5 min) :";
        $stressConseils[] = "• Inspirer 5 secondes, expirer 5 secondes";
        $stressConseils[] = "• Idéalement : au réveil, avant le déjeuner, avant le coucher";
        $stressConseils[] = "• Applications recommandées : Respirelax, Petit Bambou";
        $stressConseils[] = "";
    }
    if ($stressNiveau >= 7) {
        $stressConseils[] = "RESPIRATION VENTRALE (en cas de stress aigu) :";
        $stressConseils[] = "• Inspirer 4 sec (ventre se gonfle), bloquer 4 sec, expirer 6 sec (ventre rentre)";
        $stressConseils[] = "• Répéter 5 à 10 cycles";
        $stressConseils[] = "";
    }
    if ($sommeilQualite <= 5) {
        $stressConseils[] = "RITUEL DU SOIR :";
        $stressConseils[] = "• Éteindre les écrans 1h avant le coucher";
        $stressConseils[] = "• Tisane relaxante (tilleul, mélisse, passiflore)";
        $stressConseils[] = "• 10 min de lecture ou méditation guidée";
    }
    $stressConseils[] = "";
    $stressConseils[] = "• Marche quotidienne en nature si possible (30 min)";
    $stressConseils[] = "• Prendre des pauses régulières (toutes les 90 min)";

    $prefill['gestion_stress'] = implode("\n", $stressConseils);

    // === ACTIVITÉ PHYSIQUE ===
    $activiteConseils = [];
    if ($activiteNiveau <= 3) {
        $activiteConseils[] = "REPRISE PROGRESSIVE :";
        $activiteConseils[] = "• Semaine 1-2 : Marche 10-15 min/jour";
        $activiteConseils[] = "• Semaine 3-4 : Marche 20-30 min/jour";
        $activiteConseils[] = "• Ensuite : augmenter durée ou ajouter activité douce";
    } else {
        $activiteConseils[] = "MAINTENIR L'ACTIVITÉ :";
        $activiteConseils[] = "• 30 min d'activité modérée, 5x/semaine";
    }
    $activiteConseils[] = "";
    $activiteConseils[] = "RECOMMANDATIONS :";
    $activiteConseils[] = "• Marche rapide (le plus accessible et complet)";
    $activiteConseils[] = "• Natation ou vélo (doux pour les articulations)";
    $activiteConseils[] = "• Yoga ou Pilates (souplesse + gestion du stress)";
    $activiteConseils[] = "";
    $activiteConseils[] = "• Éviter le sport intense 3h avant le coucher";
    $activiteConseils[] = "• Marche légère après les repas (10-15 min) pour la digestion";

    $prefill['activite_physique'] = implode("\n", $activiteConseils);

    // === ROUTINES ===
    $prefill['routine_matin'] = "1. GRATTE-LANGUE (5-7 passages) - Élimine les toxines nocturnes
2. EAU TIÈDE + CITRON (optionnel, si bien toléré) - Stimule le foie
3. BROSSAGE À SEC (2-3 min) - Stimule la circulation lymphatique
4. DOUCHE terminée par JET FROID sur les jambes (15 sec) - Tonifie
5. AUTOMASSAGE DU VENTRE (sens des aiguilles d'une montre)";

    $prefill['routine_soir'] = "1. DÎNER LÉGER au moins 3h avant le coucher
2. BOUILLOTTE CHAUDE SUR LE FOIE (20 min) - Favorise la détox
3. ÉCRANS ÉTEINTS 1h avant de dormir
4. TISANE RELAXANTE (tilleul, mélisse, camomille)
5. COHÉRENCE CARDIAQUE ou respiration profonde (5 min)
6. LECTURE ou MÉDITATION guidée";

    // === COMPLÉMENTS (selon profil) ===
    $complements = [];

    // Magnésium si stress élevé
    if ($stressNiveau >= 6) {
        $complements[] = [
            'nom' => 'Magnésium bisglycinate',
            'posologie' => '300-400 mg/jour, le soir au repas',
            'duree' => '3 mois (cure renouvelable)'
        ];
    }

    // Probiotiques si troubles digestifs
    if (str_contains($digTroubles, 'ballonnement') || str_contains($priorite1, 'digest') || str_contains($priorite1, 'flore')) {
        $complements[] = [
            'nom' => 'Probiotiques (Lactobacillus + Bifidobacterium)',
            'posologie' => '10-20 milliards UFC/jour, à jeun',
            'duree' => '2-3 mois'
        ];
    }

    // Oméga-3 si inflammation
    if (str_contains($motif, 'inflammat') || str_contains($motif, 'articul')) {
        $complements[] = [
            'nom' => 'Oméga-3 EPA/DHA',
            'posologie' => '1-2 g/jour au repas (midi)',
            'duree' => '3 mois minimum'
        ];
    }

    // Vitamine D (quasi systématique)
    $complements[] = [
        'nom' => 'Vitamine D3 + K2',
        'posologie' => '2000 UI/jour au petit-déjeuner',
        'duree' => 'Octobre à avril (ou selon dosage sanguin)'
    ];

    // Limiter à 3 compléments
    $prefill['complements'] = array_slice($complements, 0, 3);

    // === RECOMMANDATIONS COMPLÉMENTAIRES ===
    $reco = [];
    if ($stressNiveau >= 7) {
        $reco[] = "• Sophrologie ou hypnose pour la gestion du stress";
    }
    if (str_contains($priorite1, 'digest') || str_contains($priorite2, 'digest')) {
        $reco[] = "• Massage abdominal ou réflexologie plantaire";
    }
    $reco[] = "• Suivi naturopathique dans 4-6 semaines pour ajuster le programme";

    $prefill['recommandations_complementaires'] = implode("\n", $reco);

    return $prefill;
}
