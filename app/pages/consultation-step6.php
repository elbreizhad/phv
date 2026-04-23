<?php
/**
 * Étape 6 : Programme d'Hygiène de Vie (PHV)
 * SYSTÈME CONTEXTUEL : suggestions adaptées au profil + liberté totale du praticien
 */

// DEBUG - Afficher les erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Vérifier que le fichier knowledge-base existe
$kbPath = __DIR__ . '/../data/knowledge-base.php';
if (!file_exists($kbPath)) {
    die("ERREUR: Fichier knowledge-base.php introuvable: " . $kbPath);
}
require_once $kbPath;

// Charger le système de profil et suggestions
require_once __DIR__ . '/../data/profil-tags.php';

$db = getDB();
$consultId = (int) getGet('id');
$userId = currentUserId();

$stmt = $db->prepare("SELECT c.*, cl.nom AS client_nom, cl.prenom AS client_prenom, cl.sexe AS client_sexe FROM consultations c JOIN clients cl ON c.client_id = cl.id WHERE c.id = ? AND c.user_id = ?");
$stmt->execute([$consultId, $userId]);
$consultation = $stmt->fetch();
if (!$consultation) { redirect('dashboard'); }

$currentStep = 6;

// Détection V2 : trame_version explicite OU présence de réponses v2_step%
$isV2 = ($consultation['trame_version'] ?? 'v1') === 'v2';
if (!$isV2) {
    $checkV2 = $db->prepare("SELECT 1 FROM consultation_reponses WHERE consultation_id = ? AND section LIKE 'v2_step%' LIMIT 1");
    $checkV2->execute([$consultId]);
    $isV2 = (bool) $checkV2->fetchColumn();
}
if ($isV2) { $currentStep = 16; }

// Récupérer la synthèse
$synthStmt = $db->prepare("SELECT * FROM consultation_synthese WHERE consultation_id = ?");
$synthStmt->execute([$consultId]);
$synthese = $synthStmt->fetch() ?: null;

// Récupérer le PHV existant
$phvStmt = $db->prepare("SELECT * FROM phv WHERE consultation_id = ?");
$phvStmt->execute([$consultId]);
$phv = $phvStmt->fetch();

// Toutes les réponses du questionnaire
$allReponses = getReponses($consultId);

// ============================================
// RÉCUPÉRER LES PROTOCOLES SUGGÉRÉS
// ============================================
$allProtocoles = [];
$suggestedProtocoles = [];
try {
    $protocolesStmt = $db->prepare("SELECT * FROM protocoles WHERE user_id = ? AND actif = TRUE ORDER BY type_protocole, nom");
    $protocolesStmt->execute([$userId]);
    $allProtocoles = $protocolesStmt->fetchAll();
    $suggestedProtocoles = matchProtocolesToConsultation($consultation, $synthese, $allReponses, $allProtocoles);
} catch (PDOException $e) {
    // Table protocoles n'existe pas encore
}

// ============================================
// RÉCUPÉRER LES FICHES PATHOLOGIES
// ============================================
$allPathologies = [];
$suggestedPathologies = [];
try {
    $pathosStmt = $db->prepare("SELECT * FROM fiches_pathologies ORDER BY systeme, nom");
    $pathosStmt->execute();
    $allPathologies = $pathosStmt->fetchAll();
    $suggestedPathologies = matchPathologiesToConsultation($consultation, $synthese, $allReponses, $allPathologies);
} catch (PDOException $e) {
    // Table fiches_pathologies n'existe pas encore
}

// ============================================
// RÉCUPÉRER LES RECETTES
// ============================================
$allRecettes = [];
$suggestedRecettes = [];
try {
    $recettesStmt = $db->prepare("SELECT * FROM recettes ORDER BY categorie, nom");
    $recettesStmt->execute();
    $allRecettes = $recettesStmt->fetchAll();
    $suggestedRecettes = matchRecettesToConsultation($consultation, $synthese, $allReponses, $allRecettes);
} catch (PDOException $e) {
    // Table recettes n'existe pas encore
}

// ============================================
// DÉTECTION DU PROFIL CLIENT (TAGS)
// ============================================
$tagsProfil = detecterTagsProfil($consultation, $synthese, $allReponses);

// ============================================
// GÉNÉRATION AUTOMATIQUE DU CONTENU PHV
// ============================================
$autoContent = generateAutoPhvContent($consultation, $synthese, $allReponses);

// Si PHV déjà sauvegardé, utiliser les données existantes
$commentaires = $phv ? json_decode($phv['commentaires_praticien'] ?? '{}', true) : [];

// Récupérer les suggestions par catégorie
$suggestionsAlimentation = getSuggestionsCategorie($tagsProfil, 'alimentation');
$suggestionsMenuType = getSuggestionsCategorie($tagsProfil, 'menu_type');
$suggestionsPhyto = getSuggestionsCategorie($tagsProfil, 'phytologie');
$suggestionsAroma = getSuggestionsCategorie($tagsProfil, 'aromatherapie');
$suggestionsGemmo = getSuggestionsCategorie($tagsProfil, 'gemmotherapie');
$suggestionsComplements = getSuggestionsCategorie($tagsProfil, 'complements');
$suggestionsDetox = getSuggestionsCategorie($tagsProfil, 'detox');
$suggestionsRoutineMatin = getSuggestionsCategorie($tagsProfil, 'routine_matin');
$suggestionsRoutineSoir = getSuggestionsCategorie($tagsProfil, 'routine_soir');
$suggestionsActivite = getSuggestionsCategorie($tagsProfil, 'activite');
$suggestionsStress = getSuggestionsCategorie($tagsProfil, 'stress');
$suggestionsExamens = getSuggestionsCategorie($tagsProfil, 'examens');
$suggestionsHydrologie = getSuggestionsCategorie($tagsProfil, 'hydrologie');
?>

<div class="page-header">
    <div>
        <h1>Programme d'Hygiène de Vie</h1>
        <p class="subtitle"><?= e($consultation['client_prenom'] . ' ' . $consultation['client_nom']) ?></p>
        <?= renderTagsBadges($tagsProfil) ?>
    </div>
    <div class="d-flex gap-1" style="flex-wrap:wrap;">
        <?php if ($phv): ?>
        <a href="<?= url('phv-pdf', ['id' => $consultId]) ?>" class="btn btn-terra" title="Version courte pour le client (PHV seul)">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
            PDF client
        </a>
        <?php endif; ?>
        <a href="<?= url('phv-pdf-praticien', ['id' => $consultId]) ?>" class="btn btn-primary" title="Dossier complet avec toutes les questions/réponses (interne)">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
            PDF praticien
        </a>
        <?php if ($phv): ?>
        <a href="<?= url('phv-export', ['id' => $consultId, 'preview' => 1]) ?>" class="btn btn-outline" target="_blank" title="Aperçu HTML">
            Aperçu
        </a>
        <?php endif; ?>
    </div>
</div>

<div class="page-body animate-in">
    <?php require __DIR__ . ($isV2 ? '/../includes/stepper-v2.php' : '/../includes/stepper.php'); ?>

    <div class="alert alert-info mb-3">
        <strong>Mode contextuel :</strong> Les suggestions s'adaptent au profil du client. Cliquez sur [+] pour ajouter une suggestion, modifiez librement le texte.
    </div>

    <form method="POST" action="<?= url('consultation-step6', ['id' => $consultId]) ?>">
        <input type="hidden" name="action" value="phv-save">
        <input type="hidden" name="consultation_id" value="<?= $consultId ?>">

        <!-- ============================================ -->
        <!-- ALIMENTATION -->
        <!-- ============================================ -->
        <div class="card mb-3">
            <div class="card-header">
                <h3>Alimentation</h3>
            </div>
            <div class="card-body">
                <div class="phv-section">
                    <div class="phv-section-main">
                        <label class="form-label">Conseils alimentaires</label>
                        <textarea name="alimentation" id="field-alimentation" rows="8"><?= e($phv['alimentation'] ?? $autoContent['alimentation']['conseils']) ?></textarea>
                    </div>
                    <div class="phv-section-suggestions">
                        <h4>Suggestions</h4>
                        <div class="suggestion-list">
                            <?php foreach (array_slice($suggestionsAlimentation, 0, 8) as $sugg): ?>
                            <div class="suggestion-item" onclick="insertSuggestion('field-alimentation', this)" data-content="<?= e($sugg['contenu']) ?>">
                                <span class="add-icon">+</span>
                                <span class="suggestion-titre"><?= e($sugg['titre']) ?></span>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <div class="form-row mt-2">
                    <div class="phv-section" style="flex:1">
                        <div class="phv-section-main">
                            <label class="form-label text-danger">A éviter / limiter</label>
                            <textarea name="alimentation_eviter" id="field-eviter" rows="5"><?= e($phv['alimentation_eviter'] ?? $autoContent['alimentation']['eviter']) ?></textarea>
                        </div>
                    </div>
                    <div class="phv-section" style="flex:1">
                        <div class="phv-section-main">
                            <label class="form-label text-success">A privilégier</label>
                            <textarea name="alimentation_privilegier" id="field-privilegier" rows="5"><?= e($phv['alimentation_privilegier'] ?? $autoContent['alimentation']['privilegier']) ?></textarea>
                        </div>
                    </div>
                </div>

                <div class="phv-section mt-2">
                    <div class="phv-section-main">
                        <label class="form-label">Menu type</label>
                        <textarea name="menu_type" id="field-menu" rows="10"><?= e($phv['menu_type'] ?? $autoContent['alimentation']['menu_type']) ?></textarea>
                    </div>
                    <div class="phv-section-suggestions">
                        <h4>Menus types</h4>
                        <div class="suggestion-list">
                            <?php foreach (array_slice($suggestionsMenuType, 0, 5) as $sugg): ?>
                            <div class="suggestion-item" onclick="insertSuggestion('field-menu', this)" data-content="<?= e($sugg['contenu']) ?>">
                                <span class="add-icon">+</span>
                                <span class="suggestion-titre"><?= e($sugg['titre']) ?></span>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <!-- Régimes spécifiques -->
                <div class="auto-content-section mt-2">
                    <div class="auto-content-label">Régimes / Restrictions alimentaires :</div>
                    <div class="regimes-grid">
                        <?php
                        $regimesOptions = [
                            ['id' => 'sans_gluten', 'nom' => 'Sans gluten', 'icon' => 'SG'],
                            ['id' => 'sans_lactose', 'nom' => 'Sans lactose', 'icon' => 'SL'],
                            ['id' => 'sans_lait_vache', 'nom' => 'Sans lait de vache', 'icon' => 'SLV'],
                            ['id' => 'sans_sucre', 'nom' => 'Sans sucre ajouté', 'icon' => 'SS'],
                            ['id' => 'fodmap', 'nom' => 'Pauvre en FODMAPs', 'icon' => 'FM'],
                            ['id' => 'anti_inflammatoire', 'nom' => 'Anti-inflammatoire', 'icon' => 'AI'],
                            ['id' => 'hypotoxique', 'nom' => 'Hypotoxique', 'icon' => 'HT'],
                            ['id' => 'cetogene', 'nom' => 'Cétogène', 'icon' => 'CG'],
                            ['id' => 'vegetarien', 'nom' => 'Végétarien', 'icon' => 'VG'],
                            ['id' => 'ig_bas', 'nom' => 'Index glycémique bas', 'icon' => 'IG'],
                        ];
                        $regimesSuggeres = $autoContent['alimentation']['regimes_suggeres'] ?? [];
                        ?>
                        <?php foreach ($regimesOptions as $regime): ?>
                        <label class="regime-option">
                            <input type="checkbox" name="regimes[]" value="<?= e($regime['id']) ?>"
                                <?= in_array($regime['id'], $regimesSuggeres) ? 'checked' : '' ?>>
                            <span class="regime-icon"><?= e($regime['icon']) ?></span>
                            <span class="regime-nom"><?= e($regime['nom']) ?></span>
                        </label>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Commentaire praticien -->
                <div class="form-group mt-2 praticien-comment">
                    <label class="form-label">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        Commentaire du praticien (optionnel)
                    </label>
                    <textarea name="commentaire_alimentation" class="form-control" rows="2" placeholder="Ajustements spécifiques à ce client..."><?= e($commentaires['alimentation'] ?? '') ?></textarea>
                </div>
            </div>
        </div>

        <!-- ============================================ -->
        <!-- GESTION DU STRESS -->
        <!-- ============================================ -->
        <div class="card mb-3">
            <div class="card-header">
                <h3>Gestion du stress & émotions</h3>
                <?php $stressNiveau = (int)getReponseValue($allReponses, 'stress_niveau', '5'); ?>
                <?php if ($stressNiveau >= 7): ?>
                    <span class="badge badge-danger">Stress élevé (<?= $stressNiveau ?>/10)</span>
                <?php elseif ($stressNiveau >= 5): ?>
                    <span class="badge badge-warning">Stress modéré (<?= $stressNiveau ?>/10)</span>
                <?php else: ?>
                    <span class="badge badge-success">Stress faible (<?= $stressNiveau ?>/10)</span>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <div class="phv-section">
                    <div class="phv-section-main">
                        <textarea name="gestion_stress" id="field-stress" rows="8"><?= e($phv['gestion_stress'] ?? $autoContent['stress']['conseils']) ?></textarea>
                    </div>
                    <div class="phv-section-suggestions">
                        <h4>Techniques</h4>
                        <div class="suggestion-list">
                            <?php foreach (array_slice($suggestionsStress, 0, 6) as $sugg): ?>
                            <div class="suggestion-item" onclick="insertSuggestion('field-stress', this)" data-content="<?= e($sugg['contenu']) ?>">
                                <span class="add-icon">+</span>
                                <span class="suggestion-titre"><?= e($sugg['titre']) ?></span>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ============================================ -->
        <!-- ACTIVITÉ PHYSIQUE -->
        <!-- ============================================ -->
        <div class="card mb-3">
            <div class="card-header">
                <h3>Activité physique</h3>
                <?php $activiteNiveau = (int)getReponseValue($allReponses, 'activite_niveau', '5'); ?>
                <?php if ($activiteNiveau <= 3): ?>
                    <span class="badge badge-warning">Sédentaire (<?= $activiteNiveau ?>/10)</span>
                <?php elseif ($activiteNiveau <= 6): ?>
                    <span class="badge badge-info">Modéré (<?= $activiteNiveau ?>/10)</span>
                <?php else: ?>
                    <span class="badge badge-success">Actif (<?= $activiteNiveau ?>/10)</span>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <div class="phv-section">
                    <div class="phv-section-main">
                        <textarea name="activite_physique" id="field-activite" rows="6"><?= e($phv['activite_physique'] ?? $autoContent['activite']['conseils']) ?></textarea>
                    </div>
                    <div class="phv-section-suggestions">
                        <h4>Activités</h4>
                        <div class="suggestion-list">
                            <?php foreach (array_slice($suggestionsActivite, 0, 6) as $sugg): ?>
                            <div class="suggestion-item" onclick="insertSuggestion('field-activite', this)" data-content="<?= e($sugg['contenu']) ?>">
                                <span class="add-icon">+</span>
                                <span class="suggestion-titre"><?= e($sugg['titre']) ?></span>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ============================================ -->
        <!-- ROUTINES MATIN / SOIR -->
        <!-- ============================================ -->
        <div class="card mb-3">
            <div class="card-header">
                <h3>Routines quotidiennes</h3>
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="phv-section" style="flex:1">
                        <div class="phv-section-main">
                            <label class="form-label">Routine Matin</label>
                            <textarea name="routine_matin" id="field-routine-matin" rows="8"><?= e($phv['routine_matin'] ?? $autoContent['routines']['matin']) ?></textarea>
                        </div>
                        <div class="phv-section-suggestions">
                            <h4>Suggestions matin</h4>
                            <div class="suggestion-list">
                                <?php foreach (array_slice($suggestionsRoutineMatin, 0, 4) as $sugg): ?>
                                <div class="suggestion-item" onclick="insertSuggestion('field-routine-matin', this)" data-content="<?= e($sugg['contenu']) ?>">
                                    <span class="add-icon">+</span>
                                    <span class="suggestion-titre"><?= e($sugg['titre']) ?></span>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="phv-section" style="flex:1">
                        <div class="phv-section-main">
                            <label class="form-label">Routine Soir</label>
                            <textarea name="routine_soir" id="field-routine-soir" rows="8"><?= e($phv['routine_soir'] ?? $autoContent['routines']['soir']) ?></textarea>
                        </div>
                        <div class="phv-section-suggestions">
                            <h4>Suggestions soir</h4>
                            <div class="suggestion-list">
                                <?php foreach (array_slice($suggestionsRoutineSoir, 0, 4) as $sugg): ?>
                                <div class="suggestion-item" onclick="insertSuggestion('field-routine-soir', this)" data-content="<?= e($sugg['contenu']) ?>">
                                    <span class="add-icon">+</span>
                                    <span class="suggestion-titre"><?= e($sugg['titre']) ?></span>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ============================================ -->
        <!-- PHYTOLOGIE -->
        <!-- ============================================ -->
        <div class="card mb-3">
            <div class="card-header">
                <h3>Phytologie</h3>
            </div>
            <div class="card-body">
                <div class="phv-section">
                    <div class="phv-section-main">
                        <textarea name="phytologie" id="field-phyto" rows="8" placeholder="Plantes recommandées, posologies, durées..."><?= e($phv['phytologie'] ?? '') ?></textarea>
                    </div>
                    <div class="phv-section-suggestions">
                        <h4>Plantes suggérées</h4>
                        <div class="suggestion-list">
                            <?php foreach (array_slice($suggestionsPhyto, 0, 8) as $sugg): ?>
                            <div class="suggestion-item" onclick="insertSuggestion('field-phyto', this)" data-content="<?= e($sugg['contenu']) ?>">
                                <span class="add-icon">+</span>
                                <span class="suggestion-titre"><?= e($sugg['titre']) ?></span>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ============================================ -->
        <!-- AROMATHÉRAPIE -->
        <!-- ============================================ -->
        <div class="card mb-3">
            <div class="card-header">
                <h3>Aromathérapie</h3>
            </div>
            <div class="card-body">
                <div class="phv-section">
                    <div class="phv-section-main">
                        <textarea name="aromatherapie" id="field-aroma" rows="6" placeholder="Huiles essentielles, modes d'utilisation, précautions..."><?= e($phv['aromatherapie'] ?? '') ?></textarea>
                    </div>
                    <div class="phv-section-suggestions">
                        <h4>HE suggérées</h4>
                        <div class="suggestion-list">
                            <?php foreach (array_slice($suggestionsAroma, 0, 6) as $sugg): ?>
                            <div class="suggestion-item" onclick="insertSuggestion('field-aroma', this)" data-content="<?= e($sugg['contenu']) ?>">
                                <span class="add-icon">+</span>
                                <span class="suggestion-titre"><?= e($sugg['titre']) ?></span>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ============================================ -->
        <!-- GEMMOTHÉRAPIE -->
        <!-- ============================================ -->
        <div class="card mb-3">
            <div class="card-header">
                <h3>Gemmothérapie</h3>
            </div>
            <div class="card-body">
                <div class="phv-section">
                    <div class="phv-section-main">
                        <textarea name="gemmotherapie" id="field-gemmo" rows="5" placeholder="Bourgeons recommandés, posologies..."><?= e($phv['gemmotherapie'] ?? '') ?></textarea>
                    </div>
                    <div class="phv-section-suggestions">
                        <h4>Bourgeons</h4>
                        <div class="suggestion-list">
                            <?php foreach (array_slice($suggestionsGemmo, 0, 6) as $sugg): ?>
                            <div class="suggestion-item" onclick="insertSuggestion('field-gemmo', this)" data-content="<?= e($sugg['contenu']) ?>">
                                <span class="add-icon">+</span>
                                <span class="suggestion-titre"><?= e($sugg['titre']) ?></span>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ============================================ -->
        <!-- PROGRAMME DÉTOX -->
        <!-- ============================================ -->
        <?php if (!empty($suggestionsDetox)): ?>
        <div class="card mb-3">
            <div class="card-header">
                <h3>Programme Détox / Protocole</h3>
            </div>
            <div class="card-body">
                <div class="phv-section">
                    <div class="phv-section-main">
                        <textarea name="programme_detox" id="field-detox" rows="8" placeholder="Programme détox, 4R intestinal, protocole spécifique..."><?= e($phv['programme_detox'] ?? '') ?></textarea>
                    </div>
                    <div class="phv-section-suggestions">
                        <h4>Protocoles</h4>
                        <div class="suggestion-list">
                            <?php foreach (array_slice($suggestionsDetox, 0, 5) as $sugg): ?>
                            <div class="suggestion-item" onclick="insertSuggestion('field-detox', this)" data-content="<?= e($sugg['contenu']) ?>">
                                <span class="add-icon">+</span>
                                <span class="suggestion-titre"><?= e($sugg['titre']) ?></span>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- ============================================ -->
        <!-- COMPLÉMENTS ALIMENTAIRES -->
        <!-- ============================================ -->
        <div class="card mb-3">
            <div class="card-header">
                <h3>Compléments alimentaires</h3>
            </div>
            <div class="card-body">
                <div class="phv-section">
                    <div class="phv-section-main">
                        <textarea name="complements_texte" id="field-complements" rows="8" placeholder="Compléments recommandés avec posologies et durées..."><?= e($phv['complements_texte'] ?? '') ?></textarea>
                    </div>
                    <div class="phv-section-suggestions">
                        <h4>Compléments</h4>
                        <div class="suggestion-list">
                            <?php foreach (array_slice($suggestionsComplements, 0, 8) as $sugg): ?>
                            <div class="suggestion-item" onclick="insertSuggestion('field-complements', this)" data-content="<?= e($sugg['contenu']) ?>">
                                <span class="add-icon">+</span>
                                <span class="suggestion-titre"><?= e($sugg['titre']) ?></span>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <!-- Ancienne liste éditable (gardée pour compatibilité) -->
                <details class="mt-3">
                    <summary class="text-muted" style="cursor:pointer">Mode liste détaillée (optionnel)</summary>
                    <div class="complements-edit-list mt-2" id="complements-list">
                    <?php
                    $complements = $autoContent['complements'];
                    $totalSlots = max(count($complements) + 2, 5);
                    for ($i = 0; $i < $totalSlots; $i++):
                        $comp = $complements[$i] ?? ['nom' => '', 'posologie' => '', 'duree' => '', 'raison' => ''];
                        $hasContent = !empty($comp['nom']);
                    ?>
                    <div class="complement-edit-item <?= $hasContent ? 'has-content' : 'empty-slot' ?>" data-index="<?= $i ?>">
                        <label class="complement-checkbox">
                            <input type="checkbox" name="complement_actif[]" value="<?= $i ?>" <?= $hasContent ? 'checked' : '' ?>>
                        </label>
                        <div class="complement-fields">
                            <input type="text" name="complement_nom[]" class="form-control complement-nom"
                                placeholder="Nom du complément" value="<?= e($comp['nom']) ?>">
                            <input type="text" name="complement_posologie[]" class="form-control complement-poso"
                                placeholder="Posologie (ex: 1 gélule/jour)" value="<?= e($comp['posologie']) ?>">
                            <input type="text" name="complement_duree[]" class="form-control complement-duree"
                                placeholder="Durée (ex: 3 mois)" value="<?= e($comp['duree']) ?>">
                        </div>
                        <?php if (!empty($comp['raison'])): ?>
                        <div class="complement-raison"><?= e($comp['raison']) ?></div>
                        <?php endif; ?>
                        <button type="button" class="complement-remove" onclick="removeComplement(this)" title="Supprimer">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                        </button>
                    </div>
                    <?php endfor; ?>
                    </div>
                </details>
            </div>
        </div>

        <!-- ============================================ -->
        <!-- EXAMENS BIOLOGIQUES -->
        <!-- ============================================ -->
        <div class="card mb-3">
            <div class="card-header">
                <h3>Examens biologiques à suggérer</h3>
            </div>
            <div class="card-body">
                <div class="phv-section">
                    <div class="phv-section-main">
                        <textarea name="examens_bio_texte" id="field-examens" rows="6" placeholder="Examens biologiques recommandés..."><?= e($phv['examens_bio'] ?? '') ?></textarea>
                    </div>
                    <div class="phv-section-suggestions">
                        <h4>Bilans suggérés</h4>
                        <div class="suggestion-list">
                            <?php foreach (array_slice($suggestionsExamens, 0, 6) as $sugg): ?>
                            <div class="suggestion-item" onclick="insertSuggestion('field-examens', this)" data-content="<?= e($sugg['contenu']) ?>">
                                <span class="add-icon">+</span>
                                <span class="suggestion-titre"><?= e($sugg['titre']) ?></span>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ============================================ -->
        <!-- HYDROLOGIE -->
        <!-- ============================================ -->
        <?php if (!empty($suggestionsHydrologie)): ?>
        <div class="card mb-3">
            <div class="card-header">
                <h3>Hydrologie</h3>
            </div>
            <div class="card-body">
                <div class="phv-section">
                    <div class="phv-section-main">
                        <textarea name="hydrologie" id="field-hydrologie" rows="5" placeholder="Bains, douches, lavements..."><?= e($phv['hydrologie'] ?? '') ?></textarea>
                    </div>
                    <div class="phv-section-suggestions">
                        <h4>Techniques</h4>
                        <div class="suggestion-list">
                            <?php foreach (array_slice($suggestionsHydrologie, 0, 4) as $sugg): ?>
                            <div class="suggestion-item" onclick="insertSuggestion('field-hydrologie', this)" data-content="<?= e($sugg['contenu']) ?>">
                                <span class="add-icon">+</span>
                                <span class="suggestion-titre"><?= e($sugg['titre']) ?></span>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- ============================================ -->
        <!-- RECOMMANDATIONS COMPLÉMENTAIRES -->
        <!-- ============================================ -->
        <div class="card mb-3">
            <div class="card-header"><h3>Recommandations complémentaires</h3></div>
            <div class="card-body">
                <div class="phv-section-main">
                    <textarea name="recommandations_complementaires" id="field-reco" rows="5"><?= e($phv['recommandations_complementaires'] ?? $autoContent['recommandations']) ?></textarea>
                </div>

                <div class="form-group mt-2">
                    <label class="form-label">Soins naturels spécifiques</label>
                    <textarea name="soins_naturels" class="form-control" rows="2" placeholder="HE, cataplasmes, bains..."><?= e($phv['soins_naturels'] ?? $autoContent['soins_naturels'] ?? '') ?></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Notes internes (non incluses dans l'export)</label>
                    <textarea name="notes_phv" class="form-control" rows="2" placeholder="Notes pour le suivi..."><?= e($phv['notes'] ?? '') ?></textarea>
                </div>
            </div>
        </div>

        <!-- ============================================ -->
        <!-- PROTOCOLES SUGGÉRÉS -->
        <!-- ============================================ -->
        <?php if (!empty($suggestedProtocoles)): ?>
        <div class="card mb-3" style="border: 2px solid var(--terra-cotta);">
            <div class="card-header" style="background: linear-gradient(135deg, var(--terra-cotta) 0%, var(--sage) 100%); color: white;">
                <h3 style="color: white; margin: 0;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="20" height="20" style="vertical-align: middle; margin-right: 8px;"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                    Protocoles suggérés
                </h3>
                <span class="badge" style="background: white; color: var(--terra-cotta);"><?= count($suggestedProtocoles) ?> protocole(s) adapté(s)</span>
            </div>
            <div class="card-body">
                <p class="text-muted mb-2">Basé sur le motif et les réponses au questionnaire, ces protocoles peuvent compléter le PHV :</p>

                <div class="protocoles-suggestions">
                    <?php foreach ($suggestedProtocoles as $proto): ?>
                    <div class="protocole-suggestion-item" data-protocole-id="<?= $proto['id'] ?>">
                        <div class="protocole-suggestion-header">
                            <div>
                                <span class="protocole-type-badge protocole-type-<?= e($proto['type_protocole']) ?>"><?= ucfirst(str_replace('_', ' ', $proto['type_protocole'])) ?></span>
                                <strong><?= e($proto['nom']) ?></strong>
                                <span class="text-muted">(<?= $proto['duree_jours'] ?> jours)</span>
                            </div>
                            <div class="protocole-match-score">
                                <span class="match-badge match-<?= $proto['match_level'] ?>">
                                    <?php if ($proto['match_level'] === 'high'): ?>
                                        Très pertinent
                                    <?php elseif ($proto['match_level'] === 'medium'): ?>
                                        Pertinent
                                    <?php else: ?>
                                        Peut convenir
                                    <?php endif; ?>
                                </span>
                            </div>
                        </div>
                        <p class="protocole-description"><?= e($proto['description']) ?></p>
                        <div class="protocole-suggestion-actions">
                            <button type="button" class="btn btn-sm btn-outline" onclick="toggleProtocoleDetails(<?= $proto['id'] ?>)">
                                Voir détails
                            </button>
                            <label class="protocole-checkbox">
                                <input type="checkbox" name="protocoles_selectionnes[]" value="<?= $proto['id'] ?>">
                                <span>Ajouter au PHV</span>
                            </label>
                        </div>
                        <div class="protocole-details" id="proto-details-<?= $proto['id'] ?>" style="display: none;">
                            <div class="protocole-detail-section">
                                <strong>Objectifs :</strong>
                                <div><?= nl2br(e($proto['objectifs'])) ?></div>
                            </div>
                            <?php $phases = json_decode($proto['phases'] ?? '[]', true); ?>
                            <?php if (!empty($phases)): ?>
                            <div class="protocole-detail-section">
                                <strong>Phases :</strong>
                                <div class="phases-timeline">
                                    <?php foreach ($phases as $i => $phase): ?>
                                    <div class="phase-item">
                                        <div class="phase-number"><?= $i + 1 ?></div>
                                        <div class="phase-content">
                                            <div class="phase-name"><?= e($phase['nom'] ?? 'Phase '.($i+1)) ?></div>
                                            <?php if (!empty($phase['duree'])): ?>
                                            <div class="phase-duree"><?= e($phase['duree']) ?></div>
                                            <?php endif; ?>
                                            <?php if (!empty($phase['actions'])): ?>
                                            <ul class="phase-actions">
                                                <?php foreach ($phase['actions'] as $action): ?>
                                                <li><?= e($action) ?></li>
                                                <?php endforeach; ?>
                                            </ul>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php $complements = json_decode($proto['complements'] ?? '[]', true); ?>
                            <?php if (!empty($complements)): ?>
                            <div class="protocole-detail-section">
                                <strong>Compléments :</strong>
                                <ul>
                                    <?php foreach ($complements as $comp): ?>
                                    <li>
                                        <strong><?= e($comp['nom']) ?></strong> - <?= e($comp['posologie']) ?>
                                        <span class="text-muted">(<?= e($comp['duree']) ?>)</span>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <?php endif; ?>
                            <?php if (!empty($proto['contre_indications'])): ?>
                            <div class="protocole-detail-section alert alert-warning">
                                <strong>Contre-indications :</strong>
                                <div><?= nl2br(e($proto['contre_indications'])) ?></div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- ============================================ -->
        <!-- TOUS LES PROTOCOLES DISPONIBLES -->
        <!-- ============================================ -->
        <?php if (!empty($allProtocoles)): ?>
        <div class="card mb-3">
            <div class="card-header" style="cursor: pointer;" onclick="toggleAllProtocoles()">
                <h3>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="18" height="18" style="vertical-align: middle; margin-right: 6px;"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    Bibliothèque de protocoles
                </h3>
                <span class="text-muted" id="proto-toggle-icon">Cliquer pour afficher tous les protocoles</span>
            </div>
            <div class="card-body" id="all-protocoles-list" style="display: none;">
                <div class="protocoles-grid">
                    <?php
                    $groupedProtocoles = [];
                    foreach ($allProtocoles as $p) {
                        $groupedProtocoles[$p['type_protocole']][] = $p;
                    }
                    ?>
                    <?php foreach ($groupedProtocoles as $type => $protos): ?>
                    <div class="protocole-group">
                        <h4 class="protocole-group-title"><?= ucfirst(str_replace('_', ' ', $type)) ?></h4>
                        <?php foreach ($protos as $p): ?>
                        <label class="protocole-mini-item">
                            <input type="checkbox" name="protocoles_selectionnes[]" value="<?= $p['id'] ?>">
                            <span>
                                <?= e($p['nom']) ?>
                                <small class="text-muted">(<?= $p['duree_jours'] ?>j)</small>
                            </span>
                        </label>
                        <?php endforeach; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- ============================================ -->
        <!-- FICHES PATHOLOGIES SUGGÉRÉES -->
        <!-- ============================================ -->
        <?php if (!empty($suggestedPathologies)): ?>
        <div class="card mb-3" style="border: 2px solid #2196F3;">
            <div class="card-header" style="background: linear-gradient(135deg, #2196F3 0%, #1976D2 100%); color: white;">
                <h3 style="color: white; margin: 0;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="20" height="20" style="vertical-align: middle; margin-right: 8px;"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
                    Fiches pathologies associées
                </h3>
                <span class="badge" style="background: white; color: #2196F3;"><?= count($suggestedPathologies) ?> fiche(s)</span>
            </div>
            <div class="card-body">
                <p class="text-muted mb-2">Ces fiches correspondent au profil du client :</p>
                <div class="pathologies-list">
                    <?php foreach ($suggestedPathologies as $patho): ?>
                    <div class="patho-item">
                        <div class="patho-header">
                            <label class="patho-checkbox">
                                <input type="checkbox" name="pathologies_selectionnees[]" value="<?= $patho['id'] ?>">
                                <span class="patho-systeme"><?= e($patho['systeme']) ?></span>
                                <strong><?= e($patho['nom']) ?></strong>
                            </label>
                            <button type="button" class="btn btn-sm btn-outline" onclick="togglePathoDetails(<?= $patho['id'] ?>)">Détails</button>
                        </div>
                        <div class="patho-details" id="patho-details-<?= $patho['id'] ?>" style="display: none;">
                            <div class="patho-section"><strong>Description:</strong> <?= nl2br(e($patho['description'])) ?></div>
                            <div class="patho-section"><strong>Causes:</strong> <?= nl2br(e($patho['causes'])) ?></div>
                            <div class="patho-section"><strong>Signes cliniques:</strong> <?= nl2br(e($patho['signes_cliniques'])) ?></div>
                            <div class="patho-grid">
                                <div class="patho-col">
                                    <h5>Alimentation</h5>
                                    <p><strong>À éviter:</strong> <?= nl2br(e($patho['aliments_eviter'])) ?></p>
                                    <p><strong>À privilégier:</strong> <?= nl2br(e($patho['aliments_privilegier'])) ?></p>
                                </div>
                                <div class="patho-col">
                                    <h5>Compléments</h5>
                                    <p><?= nl2br(e($patho['complements'])) ?></p>
                                </div>
                            </div>
                            <div class="patho-grid">
                                <div class="patho-col">
                                    <h5>Phytothérapie</h5>
                                    <p><?= nl2br(e($patho['phytotherapie'])) ?></p>
                                </div>
                                <div class="patho-col">
                                    <h5>Aromathérapie</h5>
                                    <p><?= nl2br(e($patho['aromatherapie'])) ?></p>
                                </div>
                            </div>
                            <?php if (!empty($patho['notes'])): ?>
                            <div class="patho-section alert alert-info">
                                <strong>Notes:</strong> <?= nl2br(e($patho['notes'])) ?>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- ============================================ -->
        <!-- RECETTES SUGGÉRÉES -->
        <!-- ============================================ -->
        <?php if (!empty($suggestedRecettes)): ?>
        <div class="card mb-3" style="border: 2px solid #4CAF50;">
            <div class="card-header" style="background: linear-gradient(135deg, #4CAF50 0%, #388E3C 100%); color: white;">
                <h3 style="color: white; margin: 0;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="20" height="20" style="vertical-align: middle; margin-right: 8px;"><path d="M18 8h1a4 4 0 0 1 0 8h-1"/><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"/><line x1="6" y1="1" x2="6" y2="4"/><line x1="10" y1="1" x2="10" y2="4"/><line x1="14" y1="1" x2="14" y2="4"/></svg>
                    Recettes recommandées
                </h3>
                <span class="badge" style="background: white; color: #4CAF50;"><?= count($suggestedRecettes) ?> recette(s)</span>
            </div>
            <div class="card-body">
                <p class="text-muted mb-2">Recettes adaptées aux besoins du client :</p>
                <div class="recettes-grid">
                    <?php foreach ($suggestedRecettes as $recette): ?>
                    <div class="recette-card">
                        <label class="recette-select">
                            <input type="checkbox" name="recettes_selectionnees[]" value="<?= $recette['id'] ?>">
                            <div class="recette-content">
                                <span class="recette-categorie"><?= ucfirst(str_replace('_', ' ', $recette['categorie'])) ?></span>
                                <strong class="recette-nom"><?= e($recette['nom']) ?></strong>
                                <div class="recette-meta">
                                    <span><?= $recette['temps_preparation'] + ($recette['temps_cuisson'] ?? 0) ?> min</span>
                                    <span><?= $recette['portions'] ?> portions</span>
                                </div>
                                <?php $regimes = json_decode($recette['regimes'] ?? '[]', true); ?>
                                <?php if (!empty($regimes)): ?>
                                <div class="recette-regimes">
                                    <?php foreach (array_slice($regimes, 0, 3) as $regime): ?>
                                    <span class="regime-tag"><?= e($regime) ?></span>
                                    <?php endforeach; ?>
                                </div>
                                <?php endif; ?>
                            </div>
                        </label>
                        <button type="button" class="btn btn-sm btn-outline" onclick="toggleRecetteDetails(<?= $recette['id'] ?>)">Voir</button>
                        <div class="recette-details" id="recette-details-<?= $recette['id'] ?>" style="display: none;">
                            <div class="recette-section">
                                <h5>Ingrédients</h5>
                                <div><?= nl2br(e($recette['ingredients'])) ?></div>
                            </div>
                            <div class="recette-section">
                                <h5>Instructions</h5>
                                <div><?= nl2br(e($recette['instructions'])) ?></div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- ============================================ -->
        <!-- BIBLIOTHÈQUE COMPLÈTE -->
        <!-- ============================================ -->
        <div class="card mb-3">
            <div class="card-header" style="cursor: pointer;" onclick="toggleBibliotheque()">
                <h3>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="18" height="18" style="vertical-align: middle; margin-right: 6px;"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                    Bibliothèque complète
                </h3>
                <span class="text-muted" id="biblio-toggle-icon">Cliquer pour explorer toutes les ressources</span>
            </div>
            <div class="card-body" id="bibliotheque-complete" style="display: none;">
                <div class="biblio-tabs">
                    <button type="button" class="biblio-tab active" onclick="showBiblioTab('pathos')">Fiches pathologies</button>
                    <button type="button" class="biblio-tab" onclick="showBiblioTab('recettes')">Recettes</button>
                </div>

                <div id="biblio-pathos" class="biblio-content">
                    <?php
                    $groupedPathos = [];
                    foreach ($allPathologies as $p) { $groupedPathos[$p['systeme']][] = $p; }
                    ?>
                    <div class="biblio-grid">
                        <?php foreach ($groupedPathos as $systeme => $pathos): ?>
                        <div class="biblio-group">
                            <h4><?= e($systeme) ?></h4>
                            <?php foreach ($pathos as $p): ?>
                            <label class="biblio-item">
                                <input type="checkbox" name="pathologies_selectionnees[]" value="<?= $p['id'] ?>">
                                <?= e($p['nom']) ?>
                            </label>
                            <?php endforeach; ?>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div id="biblio-recettes" class="biblio-content" style="display: none;">
                    <?php
                    $groupedRecettes = [];
                    foreach ($allRecettes as $r) { $groupedRecettes[$r['categorie']][] = $r; }
                    ?>
                    <div class="biblio-grid">
                        <?php foreach ($groupedRecettes as $cat => $recs): ?>
                        <div class="biblio-group">
                            <h4><?= ucfirst(str_replace('_', ' ', $cat)) ?></h4>
                            <?php foreach ($recs as $r): ?>
                            <label class="biblio-item">
                                <input type="checkbox" name="recettes_selectionnees[]" value="<?= $r['id'] ?>">
                                <?= e($r['nom']) ?>
                            </label>
                            <?php endforeach; ?>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- ============================================ -->
        <!-- RÉCAPITULATIF GLOBAL PRATICIEN -->
        <!-- ============================================ -->
        <div class="card mb-3 recap-global">
            <div class="card-header" style="cursor:pointer;" onclick="toggleCollapse('recap-global-content')">
                <h3>Récapitulatif Global</h3>
                <svg id="recap-global-content-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="18" height="18" style="transition: transform 0.3s;"><polyline points="6 9 12 15 18 9"/></svg>
            </div>
            <div class="card-body" id="recap-global-content" style="display:none;">

                <!-- ÉTAPE 1 : Client & Motif -->
                <div class="recap-section">
                    <div class="recap-header">
                        <h4>Étape 1 : Client & Motif</h4>
                        <a href="<?= $isV2 ? url('consultation-v2', ['id' => $consultId, 'step' => 1]) : url('consultation-step1', ['id' => $consultId]) ?>" class="btn btn-outline btn-sm">Modifier</a>
                    </div>
                    <div class="recap-content">
                        <div class="recap-row">
                            <span class="recap-label">Motif :</span>
                            <span class="recap-value"><?= nl2br(e($consultation['motif'] ?: 'Non renseigné')) ?></span>
                        </div>
                        <?php if (!empty($allReponses['vie_pro_description']['reponse'] ?? '')): ?>
                        <div class="recap-row">
                            <span class="recap-label">Vie pro :</span>
                            <span class="recap-value"><?= e(truncateText($allReponses['vie_pro_description']['reponse'] ?? '', 100)) ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if (!empty($allReponses['med_medicaments']['reponse'] ?? '')): ?>
                        <div class="recap-row">
                            <span class="recap-label">Traitements :</span>
                            <span class="recap-value"><?= e($allReponses['med_medicaments']['reponse'] ?? 'Aucun') ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if (!empty($allReponses['med_allergies']['reponse'] ?? '')): ?>
                        <div class="recap-row">
                            <span class="recap-label">Allergies :</span>
                            <span class="recap-value"><?= e($allReponses['med_allergies']['reponse'] ?? 'Aucune') ?></span>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- ÉTAPE 2 : Mode de vie -->
                <div class="recap-section">
                    <div class="recap-header">
                        <h4>Étape 2 : Mode de vie</h4>
                        <a href="<?= $isV2 ? url('consultation-v2', ['id' => $consultId, 'step' => 5]) : url('consultation-step2', ['id' => $consultId]) ?>" class="btn btn-outline btn-sm">Modifier</a>
                    </div>
                    <div class="recap-content">
                        <div class="recap-scores">
                            <div class="recap-score">
                                <span class="score-label">Stress</span>
                                <span class="score-badge <?= ($allReponses['stress_niveau']['reponse'] ?? 5) >= 7 ? 'score-high' : (($allReponses['stress_niveau']['reponse'] ?? 5) >= 5 ? 'score-medium' : 'score-low') ?>"><?= e($allReponses['stress_niveau']['reponse'] ?? '?') ?>/10</span>
                            </div>
                            <div class="recap-score">
                                <span class="score-label">Sommeil</span>
                                <span class="score-badge <?= ($allReponses['sommeil_qualite']['reponse'] ?? 5) <= 4 ? 'score-high' : (($allReponses['sommeil_qualite']['reponse'] ?? 5) <= 6 ? 'score-medium' : 'score-low') ?>"><?= e($allReponses['sommeil_qualite']['reponse'] ?? '?') ?>/10</span>
                            </div>
                            <div class="recap-score">
                                <span class="score-label">Activité</span>
                                <span class="score-badge <?= ($allReponses['activite_niveau']['reponse'] ?? 5) <= 3 ? 'score-high' : 'score-low' ?>"><?= e($allReponses['activite_niveau']['reponse'] ?? '?') ?>/10</span>
                            </div>
                        </div>
                        <?php if (!empty($allReponses['stress_manifestations']['reponse'] ?? '')): ?>
                        <div class="recap-row">
                            <span class="recap-label">Manifestations stress :</span>
                            <span class="recap-value"><?= e($allReponses['stress_manifestations']['reponse'] ?? '') ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if (!empty($allReponses['sommeil_problemes']['reponse'] ?? '')): ?>
                        <div class="recap-row">
                            <span class="recap-label">Problèmes sommeil :</span>
                            <span class="recap-value"><?= e($allReponses['sommeil_problemes']['reponse'] ?? '') ?></span>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- ÉTAPE 3 : Bilan systémique -->
                <div class="recap-section">
                    <div class="recap-header">
                        <h4>Étape 3 : Bilan systémique</h4>
                        <a href="<?= $isV2 ? url('consultation-v2', ['id' => $consultId, 'step' => 9]) : url('consultation-step3', ['id' => $consultId]) ?>" class="btn btn-outline btn-sm">Modifier</a>
                    </div>
                    <div class="recap-content">
                        <?php if (!empty($allReponses['dig_troubles']['reponse'] ?? '')): ?>
                        <div class="recap-row">
                            <span class="recap-label">Digestif :</span>
                            <span class="recap-value"><?= e($allReponses['dig_troubles']['reponse'] ?? '') ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if (!empty($allReponses['nerv_symptomes']['reponse'] ?? '')): ?>
                        <div class="recap-row">
                            <span class="recap-label">Nerveux :</span>
                            <span class="recap-value"><?= e($allReponses['nerv_symptomes']['reponse'] ?? '') ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if (!empty($allReponses['endo_thyroide']['reponse'] ?? '') || !empty($allReponses['endo_energie']['reponse'] ?? '')): ?>
                        <div class="recap-row">
                            <span class="recap-label">Endocrinien :</span>
                            <span class="recap-value"><?= e(truncateText(($allReponses['endo_thyroide']['reponse'] ?? '') . ' ' . ($allReponses['endo_energie']['reponse'] ?? ''), 80)) ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if (!empty($allReponses['immu_niveau']['reponse'] ?? '') && ($allReponses['immu_niveau']['reponse'] ?? 10) <= 5): ?>
                        <div class="recap-row">
                            <span class="recap-label">Immunité :</span>
                            <span class="recap-value score-badge score-high"><?= e($allReponses['immu_niveau']['reponse'] ?? '?') ?>/10</span>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- ÉTAPE 4 : Bilan complémentaire -->
                <div class="recap-section">
                    <div class="recap-header">
                        <h4>Étape 4 : Observations</h4>
                        <a href="<?= $isV2 ? url('consultation-v2', ['id' => $consultId, 'step' => 11]) : url('consultation-step4', ['id' => $consultId]) ?>" class="btn btn-outline btn-sm">Modifier</a>
                    </div>
                    <div class="recap-content">
                        <?php
                        $desequilibresRecap = array_filter(explode(',', $allReponses['pre_synthese_desequilibres']['reponse'] ?? ''));
                        if (!empty($desequilibresRecap)):
                        ?>
                        <div class="recap-badges">
                            <?php foreach (array_slice($desequilibresRecap, 0, 6) as $d): ?>
                                <span class="badge badge-warning"><?= e(trim($d)) ?></span>
                            <?php endforeach; ?>
                            <?php if (count($desequilibresRecap) > 6): ?>
                                <span class="badge badge-secondary">+<?= count($desequilibresRecap) - 6 ?></span>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                        <?php if (!empty($allReponses['obs_points_cles']['reponse'] ?? '')): ?>
                        <div class="recap-row">
                            <span class="recap-label">Points clés :</span>
                            <span class="recap-value"><?= e(truncateText($allReponses['obs_points_cles']['reponse'] ?? '', 150)) ?></span>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- ÉTAPE 5 : Synthèse -->
                <div class="recap-section">
                    <div class="recap-header">
                        <h4>Étape 5 : Synthèse</h4>
                        <a href="<?= $isV2 ? url('consultation-v2', ['id' => $consultId, 'step' => 15]) : url('consultation-step5', ['id' => $consultId]) ?>" class="btn btn-outline btn-sm">Modifier</a>
                    </div>
                    <div class="recap-content">
                        <?php if ($synthese): ?>
                        <div class="recap-priorities">
                            <?php if (!empty($synthese['priorite_1'])): ?>
                            <div class="recap-priority">
                                <span class="priority-num">1</span>
                                <span class="priority-text"><?= e(truncateText($synthese['priorite_1'], 80)) ?></span>
                            </div>
                            <?php endif; ?>
                            <?php if (!empty($synthese['priorite_2'])): ?>
                            <div class="recap-priority">
                                <span class="priority-num">2</span>
                                <span class="priority-text"><?= e(truncateText($synthese['priorite_2'], 80)) ?></span>
                            </div>
                            <?php endif; ?>
                            <?php if (!empty($synthese['priorite_3'])): ?>
                            <div class="recap-priority">
                                <span class="priority-num">3</span>
                                <span class="priority-text"><?= e(truncateText($synthese['priorite_3'], 80)) ?></span>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php else: ?>
                        <p class="text-muted">Synthèse non encore remplie</p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- ÉTAPE 6 : PHV (résumé) -->
                <div class="recap-section">
                    <div class="recap-header">
                        <h4>Étape 6 : PHV</h4>
                        <span class="badge badge-terra">Actuel</span>
                    </div>
                    <div class="recap-content">
                        <div class="recap-phv-summary">
                            <?php if ($phv): ?>
                            <div class="recap-row">
                                <span class="recap-label">Alimentation :</span>
                                <span class="recap-value"><?= e(truncateText($phv['alimentation'] ?? '', 60)) ?></span>
                            </div>
                            <?php if (!empty($phv['phytologie'])): ?>
                            <div class="recap-row">
                                <span class="recap-label">Phytologie :</span>
                                <span class="recap-value"><?= e(truncateText($phv['phytologie'], 60)) ?></span>
                            </div>
                            <?php endif; ?>
                            <?php if (!empty($phv['complements'])): ?>
                            <div class="recap-row">
                                <span class="recap-label">Compléments :</span>
                                <span class="recap-value"><?= e(truncateText($phv['complements'], 60)) ?></span>
                            </div>
                            <?php endif; ?>
                            <?php else: ?>
                            <p class="text-muted">PHV en cours de rédaction...</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Notes praticien (internes) -->
                <div class="recap-section recap-notes">
                    <div class="recap-header">
                        <h4>Notes praticien (internes)</h4>
                        <span class="badge badge-secondary">Non exporté</span>
                    </div>
                    <div class="recap-content">
                        <textarea name="notes_praticien_internes" class="form-control" rows="3" placeholder="Notes personnelles, rappels pour le suivi, points à surveiller..."><?= e($phv['notes_praticien'] ?? '') ?></textarea>
                    </div>
                </div>

                <!-- Prochain RDV -->
                <div class="recap-section recap-rdv">
                    <div class="recap-header">
                        <h4>Prochain rendez-vous</h4>
                    </div>
                    <div class="recap-content">
                        <div class="form-row">
                            <div class="form-group" style="flex:1;">
                                <input type="date" name="prochain_rdv" class="form-control" value="<?= e($phv['prochain_rdv'] ?? '') ?>">
                            </div>
                            <div class="form-group" style="flex:2;">
                                <input type="text" name="prochain_rdv_notes" class="form-control" placeholder="Notes pour le prochain RDV..." value="<?= e($phv['prochain_rdv_notes'] ?? '') ?>">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="d-flex justify-between" style="margin-top: 1.5rem;">
            <?php $prevUrl = $isV2 ? url('consultation-v2', ['id' => $consultId, 'step' => 15]) : url('consultation-step5', ['id' => $consultId]); ?>
            <a href="<?= $prevUrl ?>" class="btn btn-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><polyline points="15 18 9 12 15 6"/></svg>
                Précédent (<?= $isV2 ? 'Synthèse V2' : 'Synthèse' ?>)
            </a>
            <div class="d-flex gap-1">
                <button type="submit" name="finalize" value="0" class="btn btn-primary btn-lg">Enregistrer le PHV</button>
                <button type="submit" name="finalize" value="1" class="btn btn-terra btn-lg">Terminer la consultation</button>
            </div>
        </div>
    </form>

    <!-- ============================================ -->
    <!-- EXPORT PDF (à la fin du PHV) -->
    <!-- ============================================ -->
    <div class="card mb-3" style="margin-top:2rem; border:2px solid #4a6741; background:#f9f9f7;">
        <div class="card-header" style="background:#4a6741; color:#fff;">
            <h3 style="color:#fff; margin:0;">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="20" height="20" style="vertical-align:middle; margin-right:8px;"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                Exporter en PDF
            </h3>
        </div>
        <div class="card-body">
            <p class="text-muted" style="margin-bottom:1rem;">
                <?php if (!$phv): ?>
                    ⚠️ Enregistre d'abord le PHV pour pouvoir l'exporter en PDF.
                <?php else: ?>
                    Deux versions disponibles selon le destinataire :
                <?php endif; ?>
            </p>

            <div class="d-flex gap-1" style="flex-wrap:wrap;">
                <?php if ($phv): ?>
                <a href="<?= url('phv-pdf', ['id' => $consultId]) ?>" class="btn btn-terra btn-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="18" height="18"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                    PDF Client
                    <small style="display:block; font-weight:normal; opacity:.85; font-size:11px;">Programme d'hygiène de vie à remettre au consultant</small>
                </a>
                <?php endif; ?>

                <a href="<?= url('phv-pdf-praticien', ['id' => $consultId]) ?>" class="btn btn-primary btn-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="18" height="18"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                    PDF Praticien
                    <small style="display:block; font-weight:normal; opacity:.85; font-size:11px;">Dossier complet : questionnaire + synthèse + PHV + notes (archivage interne)</small>
                </a>

                <?php if ($phv): ?>
                <a href="<?= url('phv-export', ['id' => $consultId, 'preview' => 1]) ?>" class="btn btn-outline" target="_blank">
                    👁️ Aperçu HTML
                </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
// Insertion de suggestion dans un textarea
function insertSuggestion(fieldId, element) {
    const textarea = document.getElementById(fieldId);
    const content = element.getAttribute('data-content');

    if (!textarea || !content) return;

    // Ajouter à la fin avec séparateur si contenu existant
    if (textarea.value.trim()) {
        textarea.value += '\n\n' + content;
    } else {
        textarea.value = content;
    }

    // Marquer comme inséré
    element.classList.add('inserted');

    // Scroll vers le bas du textarea
    textarea.scrollTop = textarea.scrollHeight;

    // Focus sur le textarea
    textarea.focus();
}

// Remplacer le contenu d'un textarea par une suggestion
function replaceSuggestion(fieldId, element) {
    const textarea = document.getElementById(fieldId);
    const content = element.getAttribute('data-content');

    if (!textarea || !content) return;

    textarea.value = content;
    element.classList.add('inserted');
    textarea.focus();
}

function toggleProtocoleDetails(id) {
    const details = document.getElementById('proto-details-' + id);
    if (details.style.display === 'none') {
        details.style.display = 'block';
    } else {
        details.style.display = 'none';
    }
}

function toggleAllProtocoles() {
    const list = document.getElementById('all-protocoles-list');
    const icon = document.getElementById('proto-toggle-icon');
    if (list.style.display === 'none') {
        list.style.display = 'block';
        icon.textContent = 'Cliquer pour masquer';
    } else {
        list.style.display = 'none';
        icon.textContent = 'Cliquer pour afficher tous les protocoles';
    }
}

function togglePathoDetails(id) {
    const details = document.getElementById('patho-details-' + id);
    details.style.display = details.style.display === 'none' ? 'block' : 'none';
}

function toggleRecetteDetails(id) {
    const details = document.getElementById('recette-details-' + id);
    details.style.display = details.style.display === 'none' ? 'block' : 'none';
}

function toggleBibliotheque() {
    const biblio = document.getElementById('bibliotheque-complete');
    const icon = document.getElementById('biblio-toggle-icon');
    if (biblio.style.display === 'none') {
        biblio.style.display = 'block';
        icon.textContent = 'Cliquer pour masquer';
    } else {
        biblio.style.display = 'none';
        icon.textContent = 'Cliquer pour explorer toutes les ressources';
    }
}

function showBiblioTab(tab) {
    document.querySelectorAll('.biblio-tab').forEach(t => t.classList.remove('active'));
    document.querySelectorAll('.biblio-content').forEach(c => c.style.display = 'none');
    event.target.classList.add('active');
    document.getElementById('biblio-' + tab).style.display = 'block';
}

// Gestion des compléments
function addComplement() {
    const list = document.getElementById('complements-list');
    const items = list.querySelectorAll('.complement-edit-item');
    const newIndex = items.length;

    const newItem = document.createElement('div');
    newItem.className = 'complement-edit-item empty-slot';
    newItem.setAttribute('data-index', newIndex);
    newItem.innerHTML = `
        <label class="complement-checkbox">
            <input type="checkbox" name="complement_actif[]" value="${newIndex}" checked>
        </label>
        <div class="complement-fields">
            <input type="text" name="complement_nom[]" class="form-control complement-nom"
                placeholder="Nom du complément" value="">
            <input type="text" name="complement_posologie[]" class="form-control complement-poso"
                placeholder="Posologie (ex: 1 gélule/jour)" value="">
            <input type="text" name="complement_duree[]" class="form-control complement-duree"
                placeholder="Durée (ex: 3 mois)" value="">
        </div>
        <button type="button" class="complement-remove" onclick="removeComplement(this)" title="Supprimer">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        </button>
    `;
    list.appendChild(newItem);

    // Focus sur le champ nom
    newItem.querySelector('.complement-nom').focus();
}

function removeComplement(btn) {
    const item = btn.closest('.complement-edit-item');
    // Vider les champs plutôt que supprimer (pour garder les indices cohérents)
    item.querySelectorAll('input[type="text"]').forEach(input => input.value = '');
    item.querySelector('input[type="checkbox"]').checked = false;
    item.classList.add('empty-slot');
    item.classList.remove('has-content');
}

// Auto-cocher quand on commence à taper
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.complement-edit-item input[type="text"]').forEach(input => {
        input.addEventListener('input', function() {
            const item = this.closest('.complement-edit-item');
            const checkbox = item.querySelector('input[type="checkbox"]');
            const nomInput = item.querySelector('.complement-nom');
            if (nomInput.value.trim()) {
                checkbox.checked = true;
                item.classList.remove('empty-slot');
                item.classList.add('has-content');
            }
        });
    });
});
</script>

<style>
/* Tags du profil client */
.profil-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 0.4rem;
    margin-top: 0.5rem;
}

.profil-tag {
    display: inline-block;
    padding: 2px 10px;
    border-radius: 12px;
    font-size: 0.7rem;
    font-weight: 600;
    color: white;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Section PHV éditable avec suggestions */
.phv-section {
    display: grid;
    grid-template-columns: 1fr 280px;
    gap: 1rem;
    margin-bottom: 1rem;
}

.phv-section-main {
    display: flex;
    flex-direction: column;
}

.phv-section-main textarea {
    width: 100%;
    min-height: 150px;
    padding: 1rem;
    border: 1px solid var(--border);
    border-radius: 8px;
    font-family: inherit;
    font-size: 0.9rem;
    line-height: 1.5;
    resize: vertical;
}

.phv-section-main textarea:focus {
    outline: none;
    border-color: var(--sage);
    box-shadow: 0 0 0 3px rgba(106, 141, 115, 0.1);
}

.phv-section-suggestions {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 1rem;
    max-height: 400px;
    overflow-y: auto;
}

.phv-section-suggestions h4 {
    font-size: 0.85rem;
    color: var(--text-muted);
    margin-bottom: 0.75rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.suggestion-list {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.suggestion-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 0.75rem;
    background: white;
    border: 1px solid #e0e0e0;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.15s ease;
    font-size: 0.85rem;
}

.suggestion-item:hover {
    border-color: var(--sage);
    background: linear-gradient(135deg, #f0f7f0 0%, #fff 100%);
}

.suggestion-item .add-icon {
    width: 20px;
    height: 20px;
    background: var(--sage);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    font-weight: bold;
    flex-shrink: 0;
}

.suggestion-item .suggestion-titre {
    flex: 1;
    font-weight: 500;
}

.suggestion-item .suggestion-tags {
    display: flex;
    gap: 0.25rem;
}

.suggestion-item .suggestion-tag {
    font-size: 0.65rem;
    padding: 1px 5px;
    background: #e8e8e8;
    border-radius: 3px;
    color: #666;
}

.suggestion-item.inserted {
    opacity: 0.5;
    border-style: dashed;
}

.suggestion-item.inserted .add-icon {
    background: #ccc;
}

@media (max-width: 900px) {
    .phv-section {
        grid-template-columns: 1fr;
    }
    .phv-section-suggestions {
        max-height: 200px;
    }
}

.protocoles-suggestions {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.protocole-suggestion-item {
    background: var(--cream);
    border-radius: 8px;
    padding: 1rem;
    border-left: 4px solid var(--sage);
}

.protocole-suggestion-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-bottom: 0.5rem;
}

.protocole-type-badge {
    display: inline-block;
    padding: 2px 8px;
    border-radius: 4px;
    font-size: 0.75rem;
    font-weight: 500;
    margin-right: 0.5rem;
}

.protocole-type-detox { background: #e8f5e9; color: #2e7d32; }
.protocole-type-digestif { background: #fff3e0; color: #ef6c00; }
.protocole-type-stress { background: #e3f2fd; color: #1565c0; }
.protocole-type-immunite { background: #fce4ec; color: #c2185b; }
.protocole-type-hormonal { background: #f3e5f5; color: #7b1fa2; }
.protocole-type-peau { background: #e0f7fa; color: #00838f; }
.protocole-type-poids { background: #fff8e1; color: #ff8f00; }
.protocole-type-remineralisation { background: #efebe9; color: #5d4037; }
.protocole-type-autre { background: #eceff1; color: #546e7a; }

.match-badge {
    padding: 4px 10px;
    border-radius: 12px;
    font-size: 0.8rem;
    font-weight: 500;
}

.match-high { background: #c8e6c9; color: #2e7d32; }
.match-medium { background: #fff9c4; color: #f57f17; }
.match-low { background: #e0e0e0; color: #616161; }

.protocole-description {
    color: var(--text-muted);
    font-size: 0.9rem;
    margin: 0.5rem 0;
}

.protocole-suggestion-actions {
    display: flex;
    gap: 1rem;
    align-items: center;
    margin-top: 0.75rem;
}

.protocole-checkbox {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    cursor: pointer;
    background: var(--sage);
    color: white;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 0.85rem;
    font-weight: 500;
}

.protocole-checkbox input {
    accent-color: var(--terra-cotta);
}

.protocole-details {
    margin-top: 1rem;
    padding-top: 1rem;
    border-top: 1px dashed var(--border);
}

.protocole-detail-section {
    margin-bottom: 1rem;
}

.phases-timeline {
    margin-top: 0.5rem;
}

.phase-item {
    display: flex;
    gap: 1rem;
    margin-bottom: 1rem;
    padding-left: 0.5rem;
}

.phase-number {
    width: 28px;
    height: 28px;
    background: var(--terra-cotta);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    flex-shrink: 0;
}

.phase-content {
    flex: 1;
}

.phase-name {
    font-weight: 600;
    color: var(--sage-dark);
}

.phase-duree {
    font-size: 0.85rem;
    color: var(--text-muted);
}

.phase-actions {
    margin: 0.5rem 0 0 0;
    padding-left: 1.2rem;
    font-size: 0.9rem;
}

.phase-actions li {
    margin-bottom: 0.25rem;
}

.protocoles-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 1rem;
}

.protocole-group {
    background: var(--cream);
    padding: 1rem;
    border-radius: 8px;
}

.protocole-group-title {
    font-size: 0.9rem;
    color: var(--terra-cotta);
    margin-bottom: 0.75rem;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid var(--border);
}

.protocole-mini-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.4rem 0;
    cursor: pointer;
    font-size: 0.9rem;
}

.protocole-mini-item:hover {
    background: rgba(0,0,0,0.03);
}

/* Fiches pathologies */
.pathologies-list { display: flex; flex-direction: column; gap: 1rem; }
.patho-item { background: #e3f2fd; border-radius: 8px; padding: 1rem; border-left: 4px solid #2196F3; }
.patho-header { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 0.5rem; }
.patho-checkbox { display: flex; align-items: center; gap: 0.5rem; cursor: pointer; }
.patho-systeme { background: #2196F3; color: white; padding: 2px 8px; border-radius: 4px; font-size: 0.75rem; margin-right: 0.5rem; }
.patho-details { margin-top: 1rem; padding-top: 1rem; border-top: 1px dashed #90CAF9; }
.patho-section { margin-bottom: 1rem; }
.patho-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin: 1rem 0; }
.patho-col h5 { color: #1976D2; margin-bottom: 0.5rem; }

/* Recettes */
.recettes-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1rem; }
.recette-card { background: #e8f5e9; border-radius: 8px; padding: 1rem; border-left: 4px solid #4CAF50; }
.recette-select { display: flex; align-items: flex-start; gap: 0.5rem; cursor: pointer; }
.recette-content { flex: 1; }
.recette-categorie { background: #4CAF50; color: white; padding: 2px 8px; border-radius: 4px; font-size: 0.7rem; text-transform: uppercase; }
.recette-nom { display: block; margin: 0.5rem 0; }
.recette-meta { font-size: 0.8rem; color: #666; display: flex; gap: 1rem; }
.recette-regimes { display: flex; flex-wrap: wrap; gap: 0.25rem; margin-top: 0.5rem; }
.regime-tag { background: #c8e6c9; color: #2e7d32; padding: 2px 6px; border-radius: 4px; font-size: 0.7rem; }
.recette-details { margin-top: 1rem; padding-top: 1rem; border-top: 1px dashed #a5d6a7; }
.recette-section { margin-bottom: 1rem; }
.recette-section h5 { color: #388E3C; margin-bottom: 0.5rem; }

/* Bibliothèque */
.biblio-tabs { display: flex; gap: 0.5rem; margin-bottom: 1rem; border-bottom: 2px solid var(--border); padding-bottom: 0.5rem; }
.biblio-tab { background: none; border: none; padding: 0.5rem 1rem; cursor: pointer; border-radius: 4px 4px 0 0; }
.biblio-tab.active { background: var(--sage); color: white; }
.biblio-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 1rem; }
.biblio-group { background: var(--cream); padding: 1rem; border-radius: 8px; }
.biblio-group h4 { font-size: 0.9rem; color: var(--terra-cotta); margin-bottom: 0.75rem; border-bottom: 1px solid var(--border); padding-bottom: 0.5rem; }
.biblio-item { display: flex; align-items: center; gap: 0.5rem; padding: 0.3rem 0; font-size: 0.85rem; cursor: pointer; }

/* Routines avec checkboxes */
.routine-section {
    flex: 1;
    background: linear-gradient(135deg, #f8f9fa 0%, #fff 100%);
    border-radius: 12px;
    padding: 1.25rem;
    border: 1px solid var(--border);
}

.routine-header {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    color: var(--sage-dark);
    margin-bottom: 1rem;
    padding-bottom: 0.75rem;
    border-bottom: 2px solid var(--sage);
}

.routine-header svg {
    color: var(--terra-cotta);
}

.routine-items {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.routine-item {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
    padding: 0.75rem;
    background: white;
    border-radius: 8px;
    border: 1px solid #e0e0e0;
    cursor: pointer;
    transition: all 0.2s ease;
}

.routine-item:hover {
    border-color: var(--sage);
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
}

.routine-item input[type="checkbox"] {
    margin-top: 2px;
    width: 18px;
    height: 18px;
    accent-color: var(--terra-cotta);
    cursor: pointer;
}

.routine-item-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.routine-item-titre {
    font-weight: 500;
    color: var(--text);
    font-size: 0.9rem;
}

.routine-item-desc {
    font-size: 0.8rem;
    color: var(--text-muted);
    line-height: 1.4;
}

.routine-item input[type="checkbox"]:checked + .routine-item-content .routine-item-titre {
    color: var(--sage-dark);
}

.routine-item:has(input:checked) {
    border-color: var(--sage);
    background: linear-gradient(135deg, #f0f7f0 0%, #fff 100%);
}

/* Examens biologiques */
.examens-bio-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 0.75rem;
}

.examen-bio-item {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
    padding: 0.75rem;
    background: white;
    border-radius: 8px;
    border: 1px solid #e0e0e0;
    cursor: pointer;
    transition: all 0.2s ease;
}

.examen-bio-item:hover {
    border-color: #2196F3;
    box-shadow: 0 2px 8px rgba(33, 150, 243, 0.15);
}

.examen-bio-item input[type="checkbox"] {
    margin-top: 2px;
    width: 18px;
    height: 18px;
    accent-color: #2196F3;
    cursor: pointer;
}

.examen-bio-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 0.2rem;
}

.examen-bio-nom {
    font-weight: 500;
    color: var(--text);
    font-size: 0.9rem;
}

.examen-bio-indication {
    font-size: 0.8rem;
    color: var(--text-muted);
    font-style: italic;
}

.examen-bio-item:has(input:checked) {
    border-color: #2196F3;
    background: linear-gradient(135deg, #e3f2fd 0%, #fff 100%);
}

.examen-bio-item:has(input:checked) .examen-bio-nom {
    color: #1976D2;
}

/* Régimes alimentaires */
.regimes-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.regime-option {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 0.75rem;
    background: white;
    border: 1px solid #e0e0e0;
    border-radius: 20px;
    cursor: pointer;
    transition: all 0.2s ease;
    font-size: 0.85rem;
}

.regime-option:hover {
    border-color: var(--terra-cotta);
    background: #fdf5f3;
}

.regime-option input[type="checkbox"] {
    display: none;
}

.regime-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 24px;
    height: 24px;
    background: #f0f0f0;
    border-radius: 50%;
    font-size: 0.65rem;
    font-weight: 600;
    color: #666;
}

.regime-nom {
    color: var(--text);
}

.regime-option:has(input:checked) {
    border-color: var(--terra-cotta);
    background: linear-gradient(135deg, #fdf5f3 0%, #fff 100%);
}

.regime-option:has(input:checked) .regime-icon {
    background: var(--terra-cotta);
    color: white;
}

.regime-option:has(input:checked) .regime-nom {
    color: var(--terra-cotta);
    font-weight: 500;
}

/* Compléments éditables */
.complements-edit-list {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.complement-edit-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem;
    background: white;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    transition: all 0.2s ease;
}

.complement-edit-item.empty-slot {
    opacity: 0.6;
    border-style: dashed;
}

.complement-edit-item:has(input[type="checkbox"]:checked) {
    border-color: var(--sage);
    background: linear-gradient(135deg, #f0f7f0 0%, #fff 100%);
    opacity: 1;
}

.complement-checkbox input {
    width: 18px;
    height: 18px;
    accent-color: var(--sage);
    cursor: pointer;
}

.complement-fields {
    flex: 1;
    display: grid;
    grid-template-columns: 2fr 1.5fr 1fr;
    gap: 0.5rem;
}

.complement-fields input {
    padding: 0.4rem 0.6rem;
    font-size: 0.9rem;
    border: 1px solid #e0e0e0;
    border-radius: 4px;
}

.complement-fields input:focus {
    border-color: var(--sage);
    outline: none;
}

.complement-raison {
    font-size: 0.75rem;
    color: var(--text-muted);
    font-style: italic;
    max-width: 150px;
}

.complement-remove {
    background: none;
    border: none;
    color: #999;
    cursor: pointer;
    padding: 4px;
    border-radius: 4px;
    transition: all 0.2s;
}

.complement-remove:hover {
    background: #ffebee;
    color: #c62828;
}

@media (max-width: 768px) {
    .complement-fields {
        grid-template-columns: 1fr;
    }
    .complement-raison {
        display: none;
    }
}

@media (max-width: 768px) {
    .patho-grid { grid-template-columns: 1fr; }
    .recettes-grid { grid-template-columns: 1fr; }
    .form-row { flex-direction: column; }
    .routine-section { width: 100%; }
}
</style>

<?php
/**
 * Convertit une valeur en string (gère les arrays)
 */
function toStr($value): string {
    if (is_array($value)) {
        return implode(' ', array_filter($value));
    }
    return (string)($value ?? '');
}

/**
 * Matching intelligent des protocoles avec la consultation
 */
function matchProtocolesToConsultation(array $consultation, ?array $synthese, array $reponses, array $protocoles): array {
    $matched = [];

    // Données de la consultation
    $motif = strtolower($consultation['motif'] ?? '');
    $motifCat = strtolower($consultation['motif_categorie'] ?? '');
    $sexe = $consultation['client_sexe'] ?? '';

    // Priorités de la synthèse
    $priorite1 = strtolower($synthese['priorite_1'] ?? '');
    $priorite2 = strtolower($synthese['priorite_2'] ?? '');
    $priorite3 = strtolower($synthese['priorite_3'] ?? '');
    $allPriorites = $priorite1 . ' ' . $priorite2 . ' ' . $priorite3;

    // Scores du questionnaire
    $stressNiveau = (int)(toStr($reponses['stress_niveau'] ?? 5));
    $sommeilQualite = (int)(toStr($reponses['sommeil_qualite'] ?? 5));
    $immuNiveau = (int)(toStr($reponses['immu_niveau'] ?? 5));
    $digTroubles = strtolower(toStr($reponses['dig_troubles'] ?? ''));
    $desequilibres = strtolower(toStr($reponses['pre_synthese_desequilibres'] ?? ''));

    // Mots-clés par type de protocole
    $keywords = [
        'detox' => ['détox', 'detox', 'foie', 'hépatique', 'drainage', 'toxines', 'nettoyage', 'cure'],
        'digestif' => ['digestif', 'digestion', 'ballonnement', 'intestin', 'colon', 'constipation', 'diarrhée', 'sii', 'fodmap', 'microbiote', 'dysbiose', 'perméabilité'],
        'stress' => ['stress', 'anxiété', 'angoisse', 'burnout', 'épuisement', 'fatigue nerveuse', 'sommeil', 'insomnie'],
        'immunite' => ['immunité', 'infection', 'rhume', 'grippe', 'défenses', 'immunitaire', 'hiver'],
        'hormonal' => ['hormonal', 'hormone', 'cycle', 'règles', 'menstruel', 'spm', 'ménopause', 'préménopause', 'fertilité', 'thyroïde'],
        'peau' => ['peau', 'acné', 'eczéma', 'psoriasis', 'cutané', 'dermatologique'],
        'poids' => ['poids', 'minceur', 'surpoids', 'obésité', 'métabolisme', 'glycémie', 'cellulite', 'rétention'],
        'remineralisation' => ['minéral', 'reminéralisation', 'os', 'ostéoporose', 'crampes', 'cheveux', 'ongles', 'fatigue'],
        'autre' => ['articulaire', 'arthrose', 'douleur', 'inflammation', 'cardiovasculaire', 'énergie']
    ];

    foreach ($protocoles as $proto) {
        $score = 0;
        $type = $proto['type_protocole'];
        $protoNom = strtolower($proto['nom']);
        $protoDesc = strtolower($proto['description'] ?? '');
        $protoObjectifs = strtolower($proto['objectifs'] ?? '');
        $protoTexte = $protoNom . ' ' . $protoDesc . ' ' . $protoObjectifs;

        // Vérifier les mots-clés du type dans le motif et les priorités
        if (isset($keywords[$type])) {
            foreach ($keywords[$type] as $kw) {
                if (str_contains($motif, $kw)) $score += 3;
                if (str_contains($motifCat, $kw)) $score += 2;
                if (str_contains($allPriorites, $kw)) $score += 2;
                if (str_contains($desequilibres, $kw)) $score += 2;
            }
        }

        // Scores spécifiques basés sur le questionnaire
        if ($type === 'stress' && $stressNiveau >= 7) $score += 3;
        if ($type === 'stress' && $sommeilQualite <= 4) $score += 2;
        if ($type === 'digestif' && !empty($digTroubles)) $score += 3;
        if ($type === 'immunite' && $immuNiveau <= 4) $score += 3;
        if ($type === 'hormonal' && $sexe === 'femme') $score += 1;

        // Vérifier si les mots du motif apparaissent dans le protocole
        $motifWords = preg_split('/\s+/', $motif);
        foreach ($motifWords as $word) {
            if (strlen($word) > 3 && str_contains($protoTexte, $word)) {
                $score += 1;
            }
        }

        // Seulement garder si score > 0
        if ($score > 0) {
            $proto['match_score'] = $score;
            $proto['match_level'] = $score >= 5 ? 'high' : ($score >= 3 ? 'medium' : 'low');
            $matched[] = $proto;
        }
    }

    // Trier par score décroissant et limiter à 5
    usort($matched, fn($a, $b) => $b['match_score'] - $a['match_score']);
    return array_slice($matched, 0, 5);
}

/**
 * Matching des fiches pathologies avec la consultation
 */
function matchPathologiesToConsultation(array $consultation, ?array $synthese, array $reponses, array $pathologies): array {
    $matched = [];
    $motif = strtolower($consultation['motif'] ?? '');
    $motifCat = strtolower($consultation['motif_categorie'] ?? '');
    $priorites = strtolower(($synthese['priorite_1'] ?? '') . ' ' . ($synthese['priorite_2'] ?? '') . ' ' . ($synthese['priorite_3'] ?? ''));

    foreach ($pathologies as $patho) {
        $score = 0;
        $pathoNom = strtolower($patho['nom']);
        $pathoDesc = strtolower($patho['description'] ?? '');
        $pathoSysteme = strtolower($patho['systeme'] ?? '');

        // Recherche dans le nom de la pathologie
        if (str_contains($motif, $pathoNom) || str_contains($pathoNom, $motif)) $score += 5;

        // Mots clés communs
        $keywords = [
            'Digestif' => ['digestif', 'intestin', 'ballonnement', 'constipation', 'diarrhée', 'reflux', 'rgo', 'acidité', 'candidose'],
            'Nerveux' => ['stress', 'anxiété', 'sommeil', 'insomnie', 'fatigue', 'burn', 'épuisement'],
            'Immunitaire' => ['immunité', 'infection', 'rhume', 'allergie', 'défenses'],
            'Endocrinien' => ['thyroïde', 'hormone', 'cycle', 'règles', 'spm', 'ménopause'],
            'Ostéo-articulaire' => ['articulation', 'arthrose', 'douleur', 'rhumatisme'],
            'Tégumentaire' => ['peau', 'acné', 'eczéma', 'psoriasis'],
            'Cardiovasculaire' => ['tension', 'hypertension', 'cholestérol', 'cœur', 'circulation']
        ];

        if (isset($keywords[$patho['systeme']])) {
            foreach ($keywords[$patho['systeme']] as $kw) {
                if (str_contains($motif, $kw)) $score += 3;
                if (str_contains($priorites, $kw)) $score += 2;
            }
        }

        if ($score > 0) {
            $patho['match_score'] = $score;
            $matched[] = $patho;
        }
    }

    usort($matched, fn($a, $b) => $b['match_score'] - $a['match_score']);
    return array_slice($matched, 0, 5);
}

/**
 * Matching des recettes avec les besoins de la consultation
 */
function matchRecettesToConsultation(array $consultation, ?array $synthese, array $reponses, array $recettes): array {
    $matched = [];
    $motif = strtolower($consultation['motif'] ?? '');
    $priorites = strtolower(($synthese['priorite_1'] ?? '') . ' ' . ($synthese['priorite_2'] ?? ''));

    // Détecter les régimes nécessaires
    $needsVegan = str_contains($motif, 'vegan') || str_contains($motif, 'végétal');
    $needsGlutenFree = str_contains($motif, 'gluten') || str_contains($motif, 'cœliaque');
    $needsAntiInflam = str_contains($motif, 'inflam') || str_contains($motif, 'arthrose') || str_contains($motif, 'douleur');
    $needsDetox = str_contains($motif, 'détox') || str_contains($motif, 'foie') || str_contains($motif, 'drainage');
    $needsDigestif = str_contains($motif, 'digest') || str_contains($motif, 'ballonne') || str_contains($motif, 'intestin');
    $needsIGBas = str_contains($motif, 'poids') || str_contains($motif, 'glycémie') || str_contains($motif, 'diabète');

    foreach ($recettes as $recette) {
        $score = 0;
        $regimes = json_decode($recette['regimes'] ?? '[]', true) ?: [];
        $regimesLower = array_map('strtolower', $regimes);

        // Bonus selon besoins détectés
        if ($needsVegan && in_array('vegan', $regimesLower)) $score += 3;
        if ($needsGlutenFree && in_array('sans gluten', $regimesLower)) $score += 3;
        if ($needsAntiInflam && in_array('anti-inflammatoire', $regimesLower)) $score += 4;
        if ($needsDetox && in_array('détox', $regimesLower)) $score += 4;
        if ($needsDigestif && in_array('digestive', $regimesLower)) $score += 4;
        if ($needsIGBas && in_array('ig bas', $regimesLower)) $score += 4;

        // Bonus petit bonus pour variété
        if (!empty($regimes)) $score += 1;

        if ($score > 0) {
            $recette['match_score'] = $score;
            $matched[] = $recette;
        }
    }

    usort($matched, fn($a, $b) => $b['match_score'] - $a['match_score']);
    return array_slice($matched, 0, 8);
}

/**
 * Génère automatiquement le contenu du PHV basé sur les données de consultation
 */
function generateAutoPhvContent(array $consultation, ?array $synthese, array $reponses): array {
    $content = [
        'alimentation' => ['conseils' => '', 'eviter' => '', 'privilegier' => '', 'menu_type' => '', 'alertes' => []],
        'stress' => ['conseils' => ''],
        'activite' => ['conseils' => ''],
        'routines' => ['matin' => '', 'soir' => ''],
        'complements' => [],
        'recommandations' => '',
        'soins_naturels' => '',
    ];

    // Extraire les données clés
    $motif = strtolower($consultation['motif'] ?? '');
    $motifCat = $consultation['motif_categorie'] ?? '';
    $sexe = $consultation['client_sexe'] ?? '';
    $priorite1 = strtolower($synthese['priorite_1'] ?? '');
    $priorite2 = strtolower($synthese['priorite_2'] ?? '');
    $priorite3 = strtolower($synthese['priorite_3'] ?? '');

    // Scores et indicateurs
    $stressNiveau = (int)(toStr($reponses['stress_niveau'] ?? 5));
    $sommeilQualite = (int)(toStr($reponses['sommeil_qualite'] ?? 5));
    $activiteNiveau = (int)(toStr($reponses['activite_niveau'] ?? 5));
    $immuNiveau = (int)(toStr($reponses['immu_niveau'] ?? 5));

    // Troubles détectés
    $digTroubles = strtolower(toStr($reponses['dig_troubles'] ?? ''));
    $stressManifestation = strtolower(toStr($reponses['stress_manifestations'] ?? ''));
    $sommeilProblemes = strtolower(toStr($reponses['sommeil_problemes'] ?? ''));
    $nervSymptomes = strtolower(toStr($reponses['nerv_symptomes'] ?? ''));
    $desequilibres = strtolower(toStr($reponses['pre_synthese_desequilibres'] ?? ''));

    // Alimentation
    $hydratation = strtolower(toStr($reponses['alim_hydratation'] ?? ''));
    $mastication = strtolower(toStr($reponses['alim_mastication'] ?? ''));
    $grignotage = strtolower(toStr($reponses['alim_grignotage'] ?? ''));

    // ============================================
    // ALIMENTATION
    // ============================================
    $alimConseils = [];
    $alimEviter = [];
    $alimPrivilegier = [];
    $alimAlertes = [];

    // Conseils de base toujours présents
    $alimConseils[] = "• Mastiquer longuement chaque bouchée (20-30 fois)";
    $alimConseils[] = "• Manger dans le calme, sans écran, en pleine conscience";
    $alimConseils[] = "• Boire 1,5 L d'eau par jour (faiblement minéralisée), en dehors des repas (arrêter 30 min avant, reprendre 1h après)";

    // Alerte si hydratation insuffisante détectée dans le questionnaire
    if (!empty($hydratation) && (str_contains($hydratation, 'café') || str_contains($hydratation, '1l') || str_contains($hydratation, 'peu'))) {
        $alimAlertes[] = "Hydratation insuffisante détectée - insister sur 1,5 L/jour minimum";
    }

    // Troubles digestifs
    $hasDigestifIssue = str_contains($digTroubles, 'ballonnement') || str_contains($digTroubles, 'gaz') ||
                        str_contains($digTroubles, 'reflux') || str_contains($priorite1, 'digest') ||
                        str_contains($desequilibres, 'dysbiose') || str_contains($desequilibres, 'perméabilité');

    if ($hasDigestifIssue) {
        $alimConseils[] = "• Éviter les crudités le soir (privilégier légumes cuits)";
        $alimConseils[] = "• Ne pas boire pendant les repas (30 min avant, 1h après)";
        $alimConseils[] = "• Fractionner si besoin : 3 repas + 1 collation";

        $alimEviter[] = "Crudités le soir";
        $alimEviter[] = "Boissons gazeuses";
        $alimEviter[] = "Excès de fibres crues";
        $alimEviter[] = "Aliments fermentescibles en excès";

        $alimPrivilegier[] = "Légumes cuits à la vapeur douce";
        $alimPrivilegier[] = "Fenouil, gingembre (digestifs)";
        $alimPrivilegier[] = "Tisanes digestives après repas";
        $alimPrivilegier[] = "Aliments fermentés (en petite quantité au début)";
    }

    // Inflammation / Douleurs
    $hasInflammation = str_contains($motif, 'inflammat') || str_contains($motif, 'douleur') ||
                       str_contains($motif, 'arthro') || str_contains($desequilibres, 'inflammation');

    if ($hasInflammation) {
        $alimEviter[] = "Sucres raffinés et produits industriels";
        $alimEviter[] = "Viandes rouges (max 1x/semaine)";
        $alimEviter[] = "Produits laitiers (test éviction 3 semaines)";
        $alimEviter[] = "Huiles riches en oméga-6 (tournesol, maïs)";
        $alimEviter[] = "Gluten (test éviction si suspicion)";

        $alimPrivilegier[] = "Petits poissons gras (sardines, maquereaux, anchois)";
        $alimPrivilegier[] = "Curcuma + poivre noir quotidien";
        $alimPrivilegier[] = "Huile d'olive vierge extra";
        $alimPrivilegier[] = "Légumes colorés et fruits rouges";
    }

    // Stress élevé
    if ($stressNiveau >= 6) {
        $alimPrivilegier[] = "Aliments riches en magnésium (oléagineux, chocolat noir 70%)";
        $alimPrivilegier[] = "Céréales complètes et légumineuses";
        $alimPrivilegier[] = "Banane, avocat (potassium, B6)";

        $alimEviter[] = "Café (max 1/jour le matin)";
        $alimEviter[] = "Alcool";
        $alimEviter[] = "Sucres rapides (pics glycémiques)";
    }

    // Grignotage / Envies sucrées
    if (!empty($grignotage) && !str_contains($grignotage, 'non') && !str_contains($grignotage, 'pas')) {
        $alimConseils[] = "• Prendre une vraie collation à 16h-17h pour éviter le grignotage";
        $alimAlertes[] = "Grignotage signalé";
    }

    // Immunité faible
    if ($immuNiveau <= 4) {
        $alimPrivilegier[] = "Ail, oignon (antibactériens naturels)";
        $alimPrivilegier[] = "Aliments riches en zinc (fruits de mer, graines de courge)";
        $alimPrivilegier[] = "Vitamine C (agrumes, kiwi, poivron)";
    }

    // Problèmes hormonaux féminins
    if ($sexe === 'femme' && (str_contains(toStr($reponses['uro_gyneco'] ?? ''), 'spm') || str_contains($motif, 'hormonal') || str_contains($motif, 'règles'))) {
        $alimPrivilegier[] = "Graines de lin fraîchement moulues";
        $alimPrivilegier[] = "Légumes crucifères (brocoli, chou)";
        $alimEviter[] = "Perturbateurs endocriniens (plastiques, conserves)";
    }

    // Problèmes cutanés - nutriments clé pour la peau
    $motifCatLower = strtolower((string)$motifCat);
    $allPrioritesLocal = trim($priorite1 . ' ' . $priorite2 . ' ' . $priorite3);
    $hasPeauIssue = str_contains($motif, 'peau') || str_contains($motif, 'acné') || str_contains($motif, 'eczéma') ||
                    str_contains($motif, 'psoriasis') || str_contains($motif, 'rosacée') || str_contains($motif, 'cutané') ||
                    str_contains($motifCatLower, 'peau') || str_contains($allPrioritesLocal, 'peau') || str_contains($allPrioritesLocal, 'cutané') ||
                    str_contains($allPrioritesLocal, 'tégumentaire');
    if ($hasPeauIssue) {
        $alimPrivilegier[] = "Poissons gras (sardines, maquereaux) 3x/sem - oméga-3 anti-inflammatoires";
        $alimPrivilegier[] = "Huile de bourrache ou onagre - oméga-6 GLA (peau)";
        $alimPrivilegier[] = "Graines de courge, huîtres, légumineuses - zinc (cicatrisation)";
        $alimPrivilegier[] = "Patate douce, carotte, épinards - bêta-carotène / vitamine A";
        $alimPrivilegier[] = "Baies, kiwi, poivron - vitamine C (collagène)";
        $alimPrivilegier[] = "Avocat, amandes, huile d'olive - vitamine E antioxydante";
        $alimPrivilegier[] = "Prêle, ortie, eau silicatée - silicium (structure cutanée)";
        $alimPrivilegier[] = "Jaune d'œuf, foie, saumon - biotine (B8) pour phanères";
        $alimEviter[] = "Sucres rapides et produits laitiers (pro-inflammatoires peau)";
        $alimEviter[] = "Charcuteries et viandes transformées (IGF-1 / acné)";
    }

    $content['alimentation']['conseils'] = implode("\n", array_unique($alimConseils));
    $content['alimentation']['eviter'] = implode("\n", array_map(fn($a) => "• $a", array_unique($alimEviter)));
    $content['alimentation']['privilegier'] = implode("\n", array_map(fn($a) => "• $a", array_unique($alimPrivilegier)));
    $content['alimentation']['alertes'] = $alimAlertes;

    // Menu type
    $content['alimentation']['menu_type'] = "PETIT-DÉJEUNER (protéiné + lipides) :
• Œufs (mollets, brouillés, au plat) OU fromage de chèvre/brebis
• Pain complet au levain + beurre ou avocat
• Fruit frais de saison
• Thé vert ou infusion (éviter le café seul à jeun)

DÉJEUNER (repas principal) :
• Crudités en entrée avec vinaigrette huile olive/colza
• Protéine : poisson, volaille, légumineuses ou œufs
• Légumes cuits + féculents complets (quinoa, riz, patate douce)
• Huile d'olive ou colza en assaisonnement

COLLATION 16-17h (si faim) :
• Poignée d'oléagineux (amandes, noix)
• Fruit frais OU carré chocolat noir 70%

DÎNER (léger, 3h avant coucher) :
• Soupe ou légumes cuits à la vapeur
• Petite protéine légère (poisson blanc, œuf)
• Éviter féculents lourds et crudités le soir";

    // Régimes suggérés selon le profil
    $regimesSuggeres = [];

    // Troubles digestifs -> FODMAPs, sans gluten/lactose
    if ($hasDigestifIssue) {
        $regimesSuggeres[] = 'fodmap';
        $regimesSuggeres[] = 'sans_gluten';
        $regimesSuggeres[] = 'sans_lactose';
    }

    // Inflammation -> Anti-inflammatoire
    if ($hasInflammation || str_contains($priorite1, 'inflam') || str_contains($desequilibres, 'inflam')) {
        $regimesSuggeres[] = 'anti_inflammatoire';
        $regimesSuggeres[] = 'sans_gluten';
    }

    // Surpoids / Métabolisme -> IG bas, sans sucre
    if (str_contains($motif, 'poids') || str_contains($priorite1, 'poids') || str_contains($priorite1, 'métabol')) {
        $regimesSuggeres[] = 'ig_bas';
        $regimesSuggeres[] = 'sans_sucre';
    }

    // Allergies / Intolérances mentionnées
    if (str_contains(strtolower($digTroubles), 'lait') || str_contains(strtolower($digTroubles), 'lactose')) {
        $regimesSuggeres[] = 'sans_lactose';
        $regimesSuggeres[] = 'sans_lait_vache';
    }
    if (str_contains(strtolower($digTroubles), 'gluten') || str_contains(strtolower($digTroubles), 'blé')) {
        $regimesSuggeres[] = 'sans_gluten';
    }

    // Détox / Hépatique -> Hypotoxique
    if (str_contains($priorite1, 'détox') || str_contains($priorite1, 'foie') || str_contains($desequilibres, 'hépatique')) {
        $regimesSuggeres[] = 'hypotoxique';
    }

    $content['alimentation']['regimes_suggeres'] = array_unique($regimesSuggeres);

    // ============================================
    // GESTION DU STRESS
    // ============================================
    $stressConseils = [];

    if ($stressNiveau >= 5) {
        $stressConseils[] = "COHÉRENCE CARDIAQUE (à pratiquer 3x/jour) :";
        $stressConseils[] = "• Inspirer 5 secondes, expirer 5 secondes, pendant 5 minutes";
        $stressConseils[] = "• Moments idéaux : réveil, avant déjeuner, avant coucher";
        $stressConseils[] = "• App recommandée : Respirelax+ (gratuite)";
        $stressConseils[] = "";
    }

    if ($stressNiveau >= 7) {
        $stressConseils[] = "RESPIRATION ANTI-STRESS (en cas de pic) :";
        $stressConseils[] = "• Inspirer 4 sec (ventre se gonfle)";
        $stressConseils[] = "• Bloquer 4 sec";
        $stressConseils[] = "• Expirer 6 sec (ventre se dégonfle)";
        $stressConseils[] = "• Répéter 5 à 10 cycles";
        $stressConseils[] = "";
    }

    if ($sommeilQualite <= 5 || str_contains($sommeilProblemes, 'endormissement')) {
        $stressConseils[] = "RITUEL DU SOIR :";
        $stressConseils[] = "• Éteindre tous les écrans 1h avant le coucher";
        $stressConseils[] = "• Tisane relaxante : tilleul, mélisse ou passiflore";
        $stressConseils[] = "• 10 minutes de lecture ou méditation guidée";
        $stressConseils[] = "• Chambre : 18°C, obscurité complète";
        $stressConseils[] = "";
    }

    if (str_contains($stressManifestation, 'tension') || str_contains($stressManifestation, 'trapèze')) {
        $stressConseils[] = "TENSIONS PHYSIQUES :";
        $stressConseils[] = "• Auto-massage des trapèzes avec balle de tennis contre un mur";
        $stressConseils[] = "• Étirements doux du cou et des épaules matin et soir";
        $stressConseils[] = "";
    }

    $stressConseils[] = "AU QUOTIDIEN :";
    $stressConseils[] = "• Marche en nature 20-30 min/jour (sans téléphone)";
    $stressConseils[] = "• Pauses régulières toutes les 90 min de travail";
    $stressConseils[] = "• Limiter l'exposition aux actualités anxiogènes";

    $content['stress']['conseils'] = implode("\n", $stressConseils);

    // ============================================
    // ACTIVITÉ PHYSIQUE
    // ============================================
    $activiteConseils = [];

    if ($activiteNiveau <= 3) {
        $activiteConseils[] = "REPRISE PROGRESSIVE (sédentarité détectée) :";
        $activiteConseils[] = "• Semaines 1-2 : Marche 15 min/jour, tous les jours";
        $activiteConseils[] = "• Semaines 3-4 : Marche 25-30 min/jour";
        $activiteConseils[] = "• Ensuite : ajouter une activité complémentaire";
        $activiteConseils[] = "";
    } elseif ($activiteNiveau <= 6) {
        $activiteConseils[] = "MAINTENIR ET PROGRESSER :";
        $activiteConseils[] = "• Objectif : 30 min d'activité modérée, 5x/semaine";
        $activiteConseils[] = "• Varier les plaisirs : marche, vélo, natation...";
        $activiteConseils[] = "";
    } else {
        $activiteConseils[] = "BON NIVEAU D'ACTIVITÉ :";
        $activiteConseils[] = "• Maintenir le rythme actuel";
        $activiteConseils[] = "• Veiller à la récupération (sommeil, étirements)";
        $activiteConseils[] = "";
    }

    $activiteConseils[] = "RECOMMANDATIONS ADAPTÉES :";

    if (str_contains($motif, 'stress') || $stressNiveau >= 6) {
        $activiteConseils[] = "• Yoga ou Pilates (gestion stress + souplesse)";
        $activiteConseils[] = "• Marche rapide en nature (effet anti-stress prouvé)";
    }

    if ($hasInflammation || str_contains($motif, 'articul')) {
        $activiteConseils[] = "• Natation ou aquagym (doux pour les articulations)";
        $activiteConseils[] = "• Vélo ou marche nordique";
        $activiteConseils[] = "• Éviter les sports à impact";
    } else {
        $activiteConseils[] = "• Marche rapide (le plus accessible et complet)";
        $activiteConseils[] = "• Natation, vélo, danse, yoga...";
    }

    $activiteConseils[] = "";
    $activiteConseils[] = "CONSEILS PRATIQUES :";
    $activiteConseils[] = "• Marche digestive 10-15 min après les repas";
    $activiteConseils[] = "• Éviter le sport intense 3h avant le coucher";
    $activiteConseils[] = "• Bouger régulièrement dans la journée (escaliers, pauses actives)";

    $content['activite']['conseils'] = implode("\n", $activiteConseils);

    // ============================================
    // ROUTINES (items sélectionnables)
    // ============================================
    $routineMatinItems = [];
    $routineSoirItems = [];

    // Routine matin - chaque item a un id, titre, description et si coché par défaut
    $routineMatinItems[] = [
        'id' => 'matin_gratte_langue',
        'titre' => 'GRATTE-LANGUE (5-7 passages)',
        'description' => 'Élimine les toxines accumulées la nuit',
        'checked' => true
    ];

    if (!$hasDigestifIssue) {
        $routineMatinItems[] = [
            'id' => 'matin_eau_citron',
            'titre' => 'EAU TIÈDE + JUS DE CITRON (si bien toléré)',
            'description' => 'Stimule le foie et la digestion',
            'checked' => true
        ];
    } else {
        $routineMatinItems[] = [
            'id' => 'matin_eau_tiede',
            'titre' => 'VERRE D\'EAU TIÈDE (sans citron)',
            'description' => 'Réhydrate en douceur',
            'checked' => true
        ];
    }

    $routineMatinItems[] = [
        'id' => 'matin_automassage',
        'titre' => 'AUTOMASSAGE DU VENTRE (2 min, sens horaire)',
        'description' => 'Stimule le transit',
        'checked' => true
    ];

    if ($stressNiveau >= 5) {
        $routineMatinItems[] = [
            'id' => 'matin_coherence',
            'titre' => 'COHÉRENCE CARDIAQUE (5 min)',
            'description' => 'Démarre la journée sereinement',
            'checked' => true
        ];
    }

    // Routine soir
    $routineSoirItems[] = [
        'id' => 'soir_diner_leger',
        'titre' => 'DÎNER LÉGER (3h avant coucher minimum)',
        'description' => '',
        'checked' => true
    ];

    if (str_contains($desequilibres, 'hépatique') || str_contains($priorite1, 'foie') || str_contains($priorite1, 'détox')) {
        $routineSoirItems[] = [
            'id' => 'soir_bouillotte',
            'titre' => 'BOUILLOTTE CHAUDE SUR LE FOIE (20 min)',
            'description' => 'Favorise la détoxification hépatique',
            'checked' => true
        ];
    }

    $routineSoirItems[] = [
        'id' => 'soir_ecrans',
        'titre' => 'ÉCRANS ÉTEINTS 1h avant le coucher',
        'description' => 'Préserve la mélatonine naturelle',
        'checked' => true
    ];

    $routineSoirItems[] = [
        'id' => 'soir_tisane',
        'titre' => 'TISANE RELAXANTE',
        'description' => 'Tilleul, mélisse, camomille ou passiflore',
        'checked' => true
    ];

    if ($sommeilQualite <= 5) {
        $routineSoirItems[] = [
            'id' => 'soir_coherence',
            'titre' => 'COHÉRENCE CARDIAQUE ou SCAN CORPOREL (5-10 min)',
            'description' => 'Favorise l\'endormissement',
            'checked' => true
        ];
    }

    // Stocker les items pour l'affichage avec checkboxes
    $content['routines']['matin_items'] = $routineMatinItems;
    $content['routines']['soir_items'] = $routineSoirItems;

    // Générer aussi le texte formaté (pour compatibilité)
    $routineMatinText = [];
    foreach ($routineMatinItems as $i => $item) {
        $num = $i + 1;
        $routineMatinText[] = "{$num}. {$item['titre']}";
        if (!empty($item['description'])) {
            $routineMatinText[] = "   ▸{$item['description']}";
        }
    }
    $routineSoirText = [];
    foreach ($routineSoirItems as $i => $item) {
        $num = $i + 1;
        $routineSoirText[] = "{$num}. {$item['titre']}";
        if (!empty($item['description'])) {
            $routineSoirText[] = "   ▸{$item['description']}";
        }
    }
    $content['routines']['matin'] = implode("\n", $routineMatinText);
    $content['routines']['soir'] = implode("\n", $routineSoirText);

    // ============================================
    // COMPLÉMENTS
    // ============================================
    $complements = [];

    // Probiotiques si troubles digestifs ou dysbiose
    if ($hasDigestifIssue) {
        $complements[] = [
            'nom' => 'Probiotiques multi-souches',
            'posologie' => '10-20 milliards UFC/jour, à jeun le matin',
            'duree' => '2-3 mois',
            'raison' => 'Troubles digestifs / Rééquilibrage du microbiote'
        ];
    }

    // Magnésium si stress
    if ($stressNiveau >= 6) {
        $complements[] = [
            'nom' => 'Magnésium bisglycinate',
            'posologie' => '300 mg/jour, le soir au repas',
            'duree' => '3 mois (renouvelable)',
            'raison' => 'Stress élevé / Soutien nerveux'
        ];
    }

    // Oméga-3 si inflammation ou humeur
    if ($hasInflammation || str_contains($nervSymptomes, 'dépression') || str_contains($nervSymptomes, 'moral')) {
        $complements[] = [
            'nom' => 'Oméga-3 EPA/DHA (huile de poissons)',
            'posologie' => '1-2 g EPA+DHA/jour, au repas du midi',
            'duree' => '3 mois minimum',
            'raison' => 'Anti-inflammatoire / Soutien humeur'
        ];
    }

    // Vitamine D (quasi systématique)
    if ($immuNiveau <= 5 || empty($complements)) {
        $complements[] = [
            'nom' => 'Vitamine D3 + K2',
            'posologie' => '2000-4000 UI/jour, au petit-déjeuner',
            'duree' => 'Octobre à avril (ou selon dosage sanguin)',
            'raison' => 'Immunité / Énergie'
        ];
    }

    // Sommeil
    if ($sommeilQualite <= 4 && count($complements) < 3) {
        $complements[] = [
            'nom' => 'Passiflore + Mélisse (ou Griffonia)',
            'posologie' => '1-2 gélules 30 min avant coucher',
            'duree' => '1-2 mois',
            'raison' => 'Troubles du sommeil'
        ];
    }

    // Fer si femme avec fatigue
    if ($sexe === 'femme' && str_contains(strtolower(toStr($reponses['endo_energie'] ?? '')), 'fatigue') && count($complements) < 3) {
        $complements[] = [
            'nom' => 'Fer bisglycinate + Vitamine C',
            'posologie' => '14-20 mg/jour si carence confirmée',
            'duree' => 'Selon bilan sanguin',
            'raison' => 'Fatigue (vérifier ferritine)'
        ];
    }

    // Nutriments clé peau (acné, eczéma, psoriasis, rosacée...)
    if ($hasPeauIssue) {
        $complements[] = [
            'nom' => 'Zinc bisglycinate',
            'posologie' => '15-30 mg/jour au repas',
            'duree' => '2-3 mois',
            'raison' => 'Cicatrisation, régulation sébum, anti-inflammatoire cutané'
        ];
        $complements[] = [
            'nom' => 'Oméga-3 EPA/DHA + Oméga-7 (bourrache ou onagre)',
            'posologie' => '1 g EPA+DHA/j + 500 mg huile de bourrache/j',
            'duree' => '3 mois minimum',
            'raison' => 'Hydratation de la peau, anti-inflammatoire (oméga-3), GLA (oméga-7)'
        ];
        $complements[] = [
            'nom' => 'Vitamine A + bêta-carotène',
            'posologie' => '5 000 UI/j (ou 7 mg bêta-carotène) au repas',
            'duree' => '2-3 mois',
            'raison' => 'Renouvellement cellulaire cutané'
        ];
        $complements[] = [
            'nom' => 'Silicium organique + Biotine (B8)',
            'posologie' => 'Silicium : 5-10 mL/j - Biotine : 5 mg/j',
            'duree' => '3 mois',
            'raison' => 'Structure tissu conjonctif, phanères (cheveux, ongles, peau)'
        ];
    }

    $content['complements'] = array_slice($complements, 0, $hasPeauIssue ? 5 : 3);

    // ============================================
    // RECOMMANDATIONS COMPLÉMENTAIRES
    // ============================================
    $reco = [];

    if ($stressNiveau >= 7) {
        $reco[] = "• Sophrologie ou hypnose pour la gestion du stress";
    }

    if ($hasDigestifIssue) {
        $reco[] = "• Massage abdominal ou réflexologie plantaire";
    }

    if (str_contains($stressManifestation, 'tension') || !empty(toStr($reponses['osteo_douleurs'] ?? ''))) {
        $reco[] = "• Ostéopathie ou massage thérapeutique";
    }

    if ($sexe === 'femme' && str_contains(toStr($reponses['uro_gyneco'] ?? ''), 'menopause')) {
        $reco[] = "• Bilan hormonal avec médecin traitant";
    }

    $reco[] = "• Consultation de suivi dans 4-6 semaines pour ajuster le programme";

    $content['recommandations'] = implode("\n", $reco);

    // Soins naturels
    $soins = [];
    if ($hasInflammation) {
        $soins[] = "• HE Gaulthérie + Eucalyptus citronné (5% dans huile végétale) - massage zones douloureuses";
    }
    if ($stressNiveau >= 6) {
        $soins[] = "• HE Lavande vraie - 2 gouttes sur oreiller ou poignets";
    }
    if (str_contains($desequilibres, 'hépatique')) {
        $soins[] = "• Bouillotte chaude sur le foie 20 min après dîner";
    }
    $content['soins_naturels'] = implode("\n", $soins);

    // ============================================
    // EXAMENS BIOLOGIQUES SUGGÉRÉS
    // ============================================
    $examensSuggeres = [];

    // Fatigue générale -> Vit D, Ferritine, TSH, B12
    if (str_contains($motif, 'fatigue') || str_contains($priorite1, 'fatigue') || str_contains($priorite1, 'énergie')) {
        $examensSuggeres[] = 'vit_d';
        $examensSuggeres[] = 'ferritine';
        $examensSuggeres[] = 'tsh';
        $examensSuggeres[] = 'b12_b9';
    }

    // Stress chronique -> Cortisol, Magnésium
    if ($stressNiveau >= 7 || str_contains($priorite1, 'stress') || str_contains($priorite1, 'burnout')) {
        $examensSuggeres[] = 'cortisol';
        $examensSuggeres[] = 'magnesium';
    }

    // Troubles digestifs -> IgG alimentaires
    if ($hasDigestifIssue) {
        $examensSuggeres[] = 'igg_aliments';
    }

    // Inflammation -> CRP
    if ($hasInflammation) {
        $examensSuggeres[] = 'crp';
        $examensSuggeres[] = 'omega';
    }

    // Problèmes de poids / métabolisme -> Glycémie, Insuline
    if (str_contains($motif, 'poids') || str_contains($priorite1, 'poids') || str_contains($priorite1, 'métabol')) {
        $examensSuggeres[] = 'glycemie';
        $examensSuggeres[] = 'insuline';
    }

    // Thyroïde
    if (str_contains($motif, 'thyro') || str_contains($priorite1, 'thyro') || str_contains($desequilibres, 'thyro')) {
        $examensSuggeres[] = 'tsh';
        $examensSuggeres[] = 't3_t4';
    }

    // Femmes - troubles hormonaux
    if ($sexe === 'F' && (str_contains($motif, 'hormon') || str_contains($motif, 'règle') || str_contains($motif, 'ménopause'))) {
        $examensSuggeres[] = 'ferritine';
        $examensSuggeres[] = 'vit_d';
    }

    // Déficit immunitaire
    if ($immuNiveau <= 4 || str_contains($motif, 'immun')) {
        $examensSuggeres[] = 'vit_d';
        $examensSuggeres[] = 'zinc';
    }

    $content['examens_suggeres'] = array_unique($examensSuggeres);

    return $content;
}
?>
