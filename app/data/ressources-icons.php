<?php
/**
 * Icônes visuelles pour les fiches Ressources (phytologie, aromatologie,
 * micronutrition, hydrologie, gestion du stress, alimentation générale,
 * mycothérapie, activité physique).
 *
 * Principe : une icône par thème/indication (sommeil, digestion, stress,
 * peau...) plutôt qu'une illustration unique par fiche - plus rapide à
 * repérer visuellement, cohérent avec le style d'icônes déjà utilisé
 * ailleurs dans le site, et ne nécessite pas de maintenance à chaque
 * ajout de fiche.
 */

const RESSOURCES_ICON_DEFS = [
    'sommeil' => [
        'path' => '<path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>',
        'color' => '#4a5a9b',
    ],
    'stress' => [
        'path' => '<polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/>',
        'color' => '#c47a3a',
    ],
    'immunite' => [
        'path' => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>',
        'color' => '#4a9b6e',
    ],
    'respiratoire' => [
        'path' => '<path d="M9.59 4.59A2 2 0 1 1 11 8H2m10.59 11.41A2 2 0 1 0 14 16H2m15.73-8.27A2.5 2.5 0 1 1 19.5 12H2"/>',
        'color' => '#4a8b9b',
    ],
    'cardio' => [
        'path' => '<path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>',
        'color' => '#c4514b',
    ],
    'digestion' => [
        'path' => '<path d="M3 12a9 9 0 0 0 18 0"/><line x1="3" y1="12" x2="21" y2="12"/>',
        'color' => '#a8763a',
    ],
    'detox' => [
        'path' => '<polyline points="23 4 23 10 17 10"/><polyline points="1 20 1 14 7 14"/><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"/>',
        'color' => '#6e9b4a',
    ],
    'urinaire' => [
        'path' => '<polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/>',
        'color' => '#4a7a9b',
    ],
    'feminin' => [
        'path' => '<circle cx="12" cy="9" r="5"/><line x1="12" y1="14" x2="12" y2="22"/><line x1="9" y1="19" x2="15" y2="19"/>',
        'color' => '#b04a7a',
    ],
    'peau' => [
        'path' => '<path d="M20.24 12.24a6 6 0 0 0-8.49-8.49L5 10.5V19h8.5z"/><line x1="16" y1="8" x2="2" y2="22"/><line x1="17.5" y1="15" x2="9" y2="15"/>',
        'color' => '#d4a054',
    ],
    'articulaire' => [
        'path' => '<circle cx="6" cy="6" r="3"/><circle cx="18" cy="18" r="3"/><line x1="8.5" y1="8.5" x2="15.5" y2="15.5"/>',
        'color' => '#8a6d4a',
    ],
    'energie' => [
        'path' => '<circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>',
        'color' => '#d4914a',
    ],
    'minceur' => [
        'path' => '<circle cx="12" cy="12" r="9"/><line x1="8" y1="12" x2="16" y2="12"/>',
        'color' => '#7a8b4a',
    ],
    'muscu' => [
        'path' => '<line x1="6" y1="12" x2="18" y2="12"/><rect x="2" y="9" width="4" height="6" rx="1"/><rect x="18" y="9" width="4" height="6" rx="1"/>',
        'color' => '#a8543a',
    ],
    'mycotherapie' => [
        'path' => '<path d="M4 12a8 4 0 0 1 16 0z"/><line x1="12" y1="12" x2="12" y2="20"/><path d="M9 20h6"/>',
        'color' => '#8a6d5a',
    ],
    'alimentation' => [
        'path' => '<path d="M12 3C7 3 3 7 3 12c0 4 3 7 7 7 4 0 8-4 8-9 0-3-2-6-6-7z"/><path d="M9 15c2-3 5-6 9-9"/>',
        'color' => '#5a9b5a',
    ],
    'eau' => [
        'path' => '<path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"/>',
        'color' => '#4a8bb5',
    ],
    'pediatrique' => [
        'path' => '<circle cx="12" cy="12" r="10"/><path d="M8 14s1.5 2 4 2 4-2 4-2"/><line x1="9" y1="9" x2="9.01" y2="9"/><line x1="15" y1="9" x2="15.01" y2="9"/>',
        'color' => '#4a9ba0',
    ],
    'allergie' => [
        'path' => '<path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>',
        'color' => '#c45b4b',
    ],
    'general' => [
        'path' => '<polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>',
        'color' => '#7d9b6f',
    ],
];

/**
 * Détermine l'icône thématique d'une fiche ressource, à partir de sa
 * section, sa catégorie puis (à défaut) son indication/nom.
 */
function ressourceIconKey(array $ressource): string
{
    $section = $ressource['section'] ?? '';

    // Certaines sections ont un thème visuel constant, indépendant de la
    // catégorie précise de la fiche.
    $sectionIcons = [
        'mycotherapie' => 'mycotherapie',
        'activite_physique' => 'muscu',
        'hydrologie' => 'eau',
        'alimentation' => 'alimentation',
    ];
    if (isset($sectionIcons[$section])) {
        return $sectionIcons[$section];
    }

    // Mots-clés vérifiés dans l'ordre sur catégorie, puis à défaut sur
    // indication/nom. Le premier qui matche l'emporte.
    $regles = [
        'sommeil' => ['sommeil', 'relax', 'insomnie'],
        'stress' => ['stress', 'nerveux', 'nerveuse', 'cognitif', 'émotion', 'emotion', 'crise', 'conscience', 'anxi'],
        'immunite' => ['immun'],
        'respiratoire' => ['respirat', 'pulmonaire', 'orl'],
        'cardio' => ['cardio', 'circulat', 'veineux'],
        'digestion' => ['digest', 'intestin', 'transit'],
        'detox' => ['foie', 'hépat', 'hepat', 'détox', 'detox', 'draina'],
        'urinaire' => ['urinaire', 'rénal', 'renal', 'rein'],
        'feminin' => ['gynéco', 'gyneco', 'féminin', 'feminin', 'hormon', 'cycle', 'grossesse', 'ménopaus', 'menopaus'],
        'peau' => ['cutané', 'cutane', 'peau', 'tégumentaire', 'tegumentaire', 'dermat'],
        'articulaire' => ['ostéo', 'osteo', 'articul', 'rhumato', 'muscul'],
        'pediatrique' => ['pédiatr', 'pediatr', 'enfant'],
        'allergie' => ['allerg', 'mycose', 'infection'],
        'minceur' => ['poids', 'minceur', 'métabol', 'metabol'],
        'energie' => ['adaptogèn', 'adaptogen', 'vitamin', 'minéra', 'minera', 'oligo', 'antioxydant', 'acides gras', 'fatigue', 'tonique', 'énergi', 'energi'],
    ];

    $champs = [$ressource['categorie'] ?? '', $ressource['indication'] ?? '', $ressource['nom'] ?? ''];
    foreach ($champs as $texte) {
        $texteLower = mb_strtolower($texte);
        foreach ($regles as $icone => $motsCles) {
            foreach ($motsCles as $mot) {
                if (mb_strpos($texteLower, $mot) !== false) {
                    return $icone;
                }
            }
        }
    }

    return 'general';
}

/**
 * Rend l'icône (pastille colorée + SVG) d'une fiche ressource.
 */
function renderRessourceIcon(array $ressource, int $size = 44): string
{
    $key = ressourceIconKey($ressource);
    $def = RESSOURCES_ICON_DEFS[$key] ?? RESSOURCES_ICON_DEFS['general'];
    $iconSize = (int) round($size * 0.5);

    return sprintf(
        '<span class="ressource-icon" style="width:%1$dpx;height:%1$dpx;background:%2$s20;color:%2$s;">'
        . '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="%3$d" height="%3$d">%4$s</svg>'
        . '</span>',
        $size,
        $def['color'],
        $iconSize,
        $def['path']
    );
}
