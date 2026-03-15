<?php
/**
 * Système de détection des tags du profil client
 * Basé sur le questionnaire, motif, synthèse et réponses
 */

/**
 * Détecte les tags du profil client
 * @param array $consultation Données de la consultation
 * @param array|null $synthese Synthèse du praticien
 * @param array $reponses Réponses au questionnaire
 * @return array Liste des tags détectés avec leur priorité
 */
function detecterTagsProfil(array $consultation, ?array $synthese, array $reponses): array {
    $tags = [];

    // Récupérer les données textuelles pour analyse
    $motif = strtolower($consultation['motif'] ?? '');
    $motifCat = strtolower($consultation['motif_categorie'] ?? '');
    $sexe = strtoupper($consultation['client_sexe'] ?? '');

    $priorite1 = strtolower($synthese['priorite_1'] ?? '');
    $priorite2 = strtolower($synthese['priorite_2'] ?? '');
    $priorite3 = strtolower($synthese['priorite_3'] ?? '');
    $allPriorites = "$priorite1 $priorite2 $priorite3";

    // Helper pour récupérer valeur réponse
    $getR = function($key, $default = '') use ($reponses) {
        $val = $reponses[$key] ?? $default;
        return is_array($val) ? implode(' ', $val) : (string)$val;
    };

    // Scores
    $stressNiveau = (int)$getR('stress_niveau', 5);
    $sommeilQualite = (int)$getR('sommeil_qualite', 5);
    $immuNiveau = (int)$getR('immu_niveau', 5);

    // Textes réponses
    $digTroubles = strtolower($getR('dig_troubles'));
    $antecedents = strtolower($getR('antecedents_medicaux'));
    $traitements = strtolower($getR('traitements_en_cours'));
    $desequilibres = strtolower($getR('pre_synthese_desequilibres'));
    $allergies = strtolower($getR('allergies'));

    // ============================================
    // DÉTECTION PAR PATHOLOGIE / MOTIF
    // ============================================

    // Diabète
    if (contientMot($motif . $antecedents . $traitements, ['diabète', 'diabete', 'glycémie', 'glycemie', 'insuline', 'metformine'])) {
        $tags['diabete'] = 10;
        $tags['metabolique'] = 8;
    }

    // Troubles digestifs
    if (contientMot($motif . $digTroubles . $desequilibres, ['digestif', 'digestion', 'ballonnement', 'gaz', 'constipation', 'diarrhée', 'diarrhee', 'intestin', 'colon', 'ventre'])) {
        $tags['digestif'] = 10;
    }

    // SII spécifique
    if (contientMot($motif . $antecedents . $digTroubles, ['sii', 'colopathie', 'intestin irritable', 'ibs', 'fodmap'])) {
        $tags['sii'] = 10;
        $tags['digestif'] = 8;
    }

    // Candidose
    if (contientMot($motif . $antecedents . $digTroubles, ['candidose', 'candida', 'mycose'])) {
        $tags['candidose'] = 10;
        $tags['digestif'] = 8;
        $tags['dysbiose'] = 8;
    }

    // Perméabilité intestinale
    if (contientMot($motif . $desequilibres, ['perméabilité', 'permeabilite', 'leaky gut', 'hyperperméabilité'])) {
        $tags['permeabilite'] = 10;
        $tags['digestif'] = 8;
    }

    // Dysbiose
    if (contientMot($motif . $desequilibres, ['dysbiose', 'microbiote', 'flore'])) {
        $tags['dysbiose'] = 10;
        $tags['digestif'] = 8;
    }

    // Hépatique / Détox
    if (contientMot($motif . $desequilibres . $allPriorites, ['foie', 'hépatique', 'hepatique', 'détox', 'detox', 'drainage'])) {
        $tags['hepatique'] = 10;
        $tags['detox'] = 8;
        $tags['foie'] = 8;
    }

    // Stress / Anxiété
    if ($stressNiveau >= 7 || contientMot($motif . $allPriorites, ['stress', 'anxiété', 'anxiete', 'angoisse', 'nervosité', 'nervosite'])) {
        $tags['stress'] = $stressNiveau >= 7 ? 10 : 8;
        $tags['anxiete'] = 8;
    }

    // Burnout
    if (contientMot($motif . $antecedents . $allPriorites, ['burnout', 'burn-out', 'épuisement', 'epuisement'])) {
        $tags['burnout'] = 10;
        $tags['stress'] = 8;
        $tags['fatigue'] = 8;
    }

    // Dépression
    if (contientMot($motif . $antecedents . $traitements, ['dépression', 'depression', 'déprime', 'deprime', 'antidépresseur'])) {
        $tags['depression'] = 10;
        $tags['stress'] = 6;
    }

    // Sommeil
    if ($sommeilQualite <= 4 || contientMot($motif . $allPriorites, ['sommeil', 'insomnie', 'réveil nocturne', 'endormissement'])) {
        $tags['sommeil'] = 10;
    }

    // Fatigue
    if (contientMot($motif . $allPriorites, ['fatigue', 'asthénie', 'asthenie', 'énergie', 'energie', 'épuisé'])) {
        $tags['fatigue'] = 10;
    }

    // Inflammation / Douleurs
    if (contientMot($motif . $desequilibres . $allPriorites, ['inflammation', 'inflammatoire', 'douleur', 'douleurs'])) {
        $tags['inflammation'] = 10;
        $tags['douleurs'] = 8;
    }

    // Articulaire
    if (contientMot($motif . $antecedents, ['arthrose', 'arthrite', 'articulation', 'articulaire', 'rhumat'])) {
        $tags['articulaire'] = 10;
        $tags['inflammation'] = 8;
        $tags['douleurs'] = 8;
    }

    // Thyroïde
    if (contientMot($motif . $antecedents . $traitements . $desequilibres, ['thyroïde', 'thyroide', 'hypothyroïdie', 'hyperthyroïdie', 'hashimoto', 'levothyrox', 'tsh'])) {
        $tags['thyroide'] = 10;
        $tags['hormonal'] = 8;
    }

    // Ménopause / Hormonal féminin
    if (contientMot($motif . $antecedents . $allPriorites, ['ménopause', 'menopause', 'préménopause', 'bouffée de chaleur', 'hormonal'])) {
        $tags['menopause'] = 10;
        $tags['hormonal'] = 8;
        $tags['femme'] = 8;
    }

    // SPM / Cycles
    if (contientMot($motif . $antecedents, ['spm', 'règles douloureuses', 'cycle', 'menstruel', 'endométriose', 'sopk'])) {
        $tags['hormonal'] = 10;
        $tags['femme'] = 8;
        $tags['regles'] = 8;
    }

    // Poids
    if (contientMot($motif . $allPriorites, ['poids', 'surpoids', 'obésité', 'minceur', 'maigrir', 'kilos'])) {
        $tags['poids'] = 10;
        $tags['metabolique'] = 8;
    }

    // Immunité
    if ($immuNiveau <= 4 || contientMot($motif . $allPriorites, ['immunité', 'immunite', 'infection', 'défenses', 'defenses'])) {
        $tags['immunite'] = 10;
        $tags['infections'] = 8;
    }

    // Allergies
    if (contientMot($motif . $allergies . $antecedents, ['allergie', 'allergique', 'histamine', 'rhume des foins'])) {
        $tags['allergies'] = 10;
    }

    // Cardiovasculaire
    if (contientMot($motif . $antecedents . $traitements, ['cardiovasculaire', 'coeur', 'hypertension', 'cholestérol', 'cholesterol', 'statine'])) {
        $tags['cardiovasculaire'] = 10;
    }

    // Circulation
    if (contientMot($motif . $antecedents, ['circulation', 'jambes lourdes', 'varices', 'hémorroïdes', 'rétention'])) {
        $tags['circulation'] = 10;
        $tags['jambes_lourdes'] = 8;
    }

    // Peau
    if (contientMot($motif . $antecedents, ['peau', 'acné', 'eczéma', 'psoriasis', 'dermat'])) {
        $tags['peau'] = 10;
    }

    // Anémie / Fer
    if (contientMot($motif . $antecedents . $traitements, ['anémie', 'anemie', 'fer', 'ferritine'])) {
        $tags['anemie'] = 10;
        $tags['fatigue'] = 8;
    }

    // Fertilité
    if (contientMot($motif, ['fertilité', 'fertilite', 'grossesse', 'conception', 'pma'])) {
        $tags['fertilite'] = 10;
        $tags['hormonal'] = 8;
    }

    // ============================================
    // TAGS GÉNÉRAUX TOUJOURS PRÉSENTS
    // ============================================
    $tags['general'] = 5;

    // Sexe
    if ($sexe === 'F') {
        $tags['femme'] = isset($tags['femme']) ? $tags['femme'] : 5;
    } elseif ($sexe === 'M') {
        $tags['homme'] = 5;
    }

    // Saison (pour suggestions saisonnières)
    $mois = (int)date('n');
    if ($mois >= 10 || $mois <= 3) {
        $tags['hiver'] = 5;
    }

    // Trier par priorité décroissante
    arsort($tags);

    return $tags;
}

/**
 * Filtre les suggestions par tags
 * @param array $suggestions Toutes les suggestions
 * @param array $tagsProfil Tags du profil client avec priorités
 * @param string $categorie Catégorie à filtrer (alimentation, phytologie, etc.)
 * @return array Suggestions filtrées et triées par pertinence
 */
function filtrerSuggestions(array $suggestions, array $tagsProfil, string $categorie): array {
    $resultats = [];
    $tagsClient = array_keys($tagsProfil);

    foreach ($suggestions as $sugg) {
        if ($sugg['categorie'] !== $categorie) {
            continue;
        }

        // Calculer le score de pertinence
        $score = 0;
        $tagsMatches = [];

        foreach ($sugg['tags'] as $tag) {
            if (isset($tagsProfil[$tag])) {
                $score += $tagsProfil[$tag];
                $tagsMatches[] = $tag;
            }
        }

        // Inclure si au moins un tag matche (ou si c'est général)
        if ($score > 0 || in_array('general', $sugg['tags'])) {
            $resultats[] = [
                'titre' => $sugg['titre'],
                'contenu' => $sugg['contenu'],
                'score' => $score,
                'tags' => $tagsMatches
            ];
        }
    }

    // Trier par score décroissant
    usort($resultats, fn($a, $b) => $b['score'] - $a['score']);

    return $resultats;
}

/**
 * Récupère les suggestions pour une catégorie
 * @param array $tagsProfil Tags du profil
 * @param string $categorie Catégorie
 * @return array Suggestions triées
 */
function getSuggestionsCategorie(array $tagsProfil, string $categorie): array {
    static $suggestions = null;

    if ($suggestions === null) {
        $suggestions = require __DIR__ . '/suggestions-phv.php';
    }

    return filtrerSuggestions($suggestions, $tagsProfil, $categorie);
}

/**
 * Vérifie si un texte contient un des mots-clés
 */
function contientMot(string $texte, array $motsClefs): bool {
    foreach ($motsClefs as $mot) {
        if (mb_stripos($texte, $mot) !== false) {
            return true;
        }
    }
    return false;
}

/**
 * Génère le HTML des badges de tags
 */
function renderTagsBadges(array $tags, int $limit = 8): string {
    $html = '<div class="profil-tags">';
    $count = 0;

    $couleurs = [
        'diabete' => '#e65100', 'metabolique' => '#ef6c00',
        'digestif' => '#2e7d32', 'sii' => '#388e3c', 'candidose' => '#4caf50',
        'hepatique' => '#5d4037', 'detox' => '#795548', 'foie' => '#6d4c41',
        'stress' => '#7b1fa2', 'anxiete' => '#9c27b0', 'burnout' => '#6a1b9a',
        'depression' => '#4a148c', 'sommeil' => '#311b92',
        'fatigue' => '#0d47a1', 'anemie' => '#1565c0',
        'inflammation' => '#c62828', 'douleurs' => '#d32f2f', 'articulaire' => '#b71c1c',
        'thyroide' => '#00838f', 'hormonal' => '#0097a7',
        'menopause' => '#d81b60', 'femme' => '#ec407a', 'regles' => '#f06292',
        'poids' => '#ff8f00', 'immunite' => '#00695c', 'infections' => '#00796b',
        'allergies' => '#f9a825', 'peau' => '#8d6e63',
        'cardiovasculaire' => '#ad1457', 'circulation' => '#c2185b',
    ];

    foreach ($tags as $tag => $score) {
        if ($tag === 'general' || $score < 6) continue;
        if (++$count > $limit) break;

        $couleur = $couleurs[$tag] ?? '#607d8b';
        $label = strtoupper(str_replace('_', ' ', $tag));
        $html .= "<span class=\"profil-tag\" style=\"background-color: {$couleur}\">{$label}</span>";
    }

    $html .= '</div>';
    return $html;
}
