<?php
/**
 * Étape 6 : Programme d'Hygiène de Vie (PHV)
 * GÉNÉRATION AUTOMATIQUE basée sur le questionnaire
 * Le praticien ne fait qu'ajouter des commentaires spécifiques
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

$db = getDB();
$consultId = (int) getGet('id');
$userId = currentUserId();

$stmt = $db->prepare("SELECT c.*, cl.nom AS client_nom, cl.prenom AS client_prenom, cl.sexe AS client_sexe FROM consultations c JOIN clients cl ON c.client_id = cl.id WHERE c.id = ? AND c.user_id = ?");
$stmt->execute([$consultId, $userId]);
$consultation = $stmt->fetch();
if (!$consultation) { redirect('dashboard'); }

$currentStep = 6;

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
// GÉNÉRATION AUTOMATIQUE DU CONTENU PHV
// ============================================
$autoContent = generateAutoPhvContent($consultation, $synthese, $allReponses);

// Si PHV déjà sauvegardé, utiliser les données existantes pour les commentaires
$commentaires = $phv ? json_decode($phv['commentaires_praticien'] ?? '{}', true) : [];
?>

<div class="page-header">
    <div>
        <h1>Programme d'Hygiène de Vie</h1>
        <p class="subtitle"><?= e($consultation['client_prenom'] . ' ' . $consultation['client_nom']) ?></p>
    </div>
    <div class="d-flex gap-1">
        <?php if ($phv): ?>
        <a href="<?= url('phv-export', ['id' => $consultId]) ?>" class="btn btn-terra" target="_blank">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
            Exporter en PDF
        </a>
        <?php endif; ?>
    </div>
</div>

<div class="page-body animate-in">
    <?php require __DIR__ . '/../includes/stepper.php'; ?>

    <div class="alert alert-info mb-3">
        <strong>Génération automatique :</strong> Le programme est pré-rédigé à partir des réponses du questionnaire.
        Ajoutez vos commentaires et ajustements si nécessaire.
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
                <?php if (!empty($autoContent['alimentation']['alertes'])): ?>
                    <span class="badge badge-warning"><?= count($autoContent['alimentation']['alertes']) ?> point(s) d'attention</span>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <!-- Contenu auto-généré (lecture seule visuel) -->
                <div class="auto-content-section">
                    <div class="auto-content-label">Conseils générés automatiquement :</div>
                    <div class="auto-content-box">
                        <?= nl2br(e($autoContent['alimentation']['conseils'])) ?>
                    </div>
                    <input type="hidden" name="alimentation" value="<?= e($autoContent['alimentation']['conseils']) ?>">
                </div>

                <div class="form-row mt-2">
                    <div class="auto-content-section">
                        <div class="auto-content-label text-danger">À éviter / limiter :</div>
                        <div class="auto-content-box auto-content-box-small">
                            <?= nl2br(e($autoContent['alimentation']['eviter'])) ?>
                        </div>
                        <input type="hidden" name="alimentation_eviter" value="<?= e($autoContent['alimentation']['eviter']) ?>">
                    </div>
                    <div class="auto-content-section">
                        <div class="auto-content-label text-success">À privilégier :</div>
                        <div class="auto-content-box auto-content-box-small">
                            <?= nl2br(e($autoContent['alimentation']['privilegier'])) ?>
                        </div>
                        <input type="hidden" name="alimentation_privilegier" value="<?= e($autoContent['alimentation']['privilegier']) ?>">
                    </div>
                </div>

                <div class="auto-content-section mt-2">
                    <div class="auto-content-label">Menu type suggéré :</div>
                    <div class="auto-content-box">
                        <?= nl2br(e($autoContent['alimentation']['menu_type'])) ?>
                    </div>
                    <input type="hidden" name="menu_type" value="<?= e($autoContent['alimentation']['menu_type']) ?>">
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
                <div class="auto-content-section">
                    <div class="auto-content-box">
                        <?= nl2br(e($autoContent['stress']['conseils'])) ?>
                    </div>
                    <input type="hidden" name="gestion_stress" value="<?= e($autoContent['stress']['conseils']) ?>">
                </div>

                <div class="form-group mt-2 praticien-comment">
                    <label class="form-label">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        Commentaire du praticien
                    </label>
                    <textarea name="commentaire_stress" class="form-control" rows="2" placeholder="Remarques personnalisées..."><?= e($commentaires['stress'] ?? '') ?></textarea>
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
                <div class="auto-content-section">
                    <div class="auto-content-box">
                        <?= nl2br(e($autoContent['activite']['conseils'])) ?>
                    </div>
                    <input type="hidden" name="activite_physique" value="<?= e($autoContent['activite']['conseils']) ?>">
                </div>

                <div class="form-group mt-2 praticien-comment">
                    <label class="form-label">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        Commentaire du praticien
                    </label>
                    <textarea name="commentaire_activite" class="form-control" rows="2" placeholder="Adaptations spécifiques..."><?= e($commentaires['activite'] ?? '') ?></textarea>
                </div>
            </div>
        </div>

        <!-- ============================================ -->
        <!-- ROUTINES MATIN / SOIR -->
        <!-- ============================================ -->
        <div class="card mb-3">
            <div class="card-header"><h3>Routines quotidiennes</h3></div>
            <div class="card-body">
                <div class="form-row">
                    <div class="auto-content-section">
                        <div class="auto-content-label">Routine matin :</div>
                        <div class="auto-content-box auto-content-box-small">
                            <?= nl2br(e($autoContent['routines']['matin'])) ?>
                        </div>
                        <input type="hidden" name="routine_matin" value="<?= e($autoContent['routines']['matin']) ?>">
                    </div>
                    <div class="auto-content-section">
                        <div class="auto-content-label">Routine soir :</div>
                        <div class="auto-content-box auto-content-box-small">
                            <?= nl2br(e($autoContent['routines']['soir'])) ?>
                        </div>
                        <input type="hidden" name="routine_soir" value="<?= e($autoContent['routines']['soir']) ?>">
                    </div>
                </div>

                <div class="form-group mt-2 praticien-comment">
                    <label class="form-label">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        Commentaire du praticien
                    </label>
                    <textarea name="commentaire_routines" class="form-control" rows="2" placeholder="Ajustements aux routines..."><?= e($commentaires['routines'] ?? '') ?></textarea>
                </div>
            </div>
        </div>

        <!-- ============================================ -->
        <!-- COMPLÉMENTS ALIMENTAIRES -->
        <!-- ============================================ -->
        <div class="card mb-3">
            <div class="card-header">
                <h3>Compléments alimentaires suggérés</h3>
                <span class="badge badge-info"><?= count($autoContent['complements']) ?> complément(s)</span>
            </div>
            <div class="card-body">
                <?php if (!empty($autoContent['complements'])): ?>
                <div class="complements-auto-list">
                    <?php foreach ($autoContent['complements'] as $i => $comp): ?>
                    <div class="complement-auto-item">
                        <div class="complement-auto-nom"><?= e($comp['nom']) ?></div>
                        <div class="complement-auto-details">
                            <span class="complement-auto-poso"><?= e($comp['posologie']) ?></span>
                            <span class="complement-auto-duree"><?= e($comp['duree']) ?></span>
                        </div>
                        <div class="complement-auto-raison text-sm text-muted"><?= e($comp['raison'] ?? '') ?></div>
                        <input type="hidden" name="complement_nom[]" value="<?= e($comp['nom']) ?>">
                        <input type="hidden" name="complement_posologie[]" value="<?= e($comp['posologie']) ?>">
                        <input type="hidden" name="complement_duree[]" value="<?= e($comp['duree']) ?>">
                    </div>
                    <?php endforeach; ?>
                    <?php for ($i = count($autoContent['complements']); $i < 3; $i++): ?>
                    <input type="hidden" name="complement_nom[]" value="">
                    <input type="hidden" name="complement_posologie[]" value="">
                    <input type="hidden" name="complement_duree[]" value="">
                    <?php endfor; ?>
                </div>
                <?php else: ?>
                <p class="text-muted">Aucun complément suggéré selon le profil. Ajoutez manuellement si nécessaire.</p>
                <input type="hidden" name="complement_nom[]" value="">
                <input type="hidden" name="complement_posologie[]" value="">
                <input type="hidden" name="complement_duree[]" value="">
                <?php endif; ?>

                <div class="form-group mt-2 praticien-comment">
                    <label class="form-label">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        Ajustements compléments (ajouter/modifier/supprimer)
                    </label>
                    <textarea name="commentaire_complements" class="form-control" rows="2" placeholder="Ex: Remplacer le magnésium par..., Ajouter zinc car..."><?= e($commentaires['complements'] ?? '') ?></textarea>
                </div>
            </div>
        </div>

        <!-- ============================================ -->
        <!-- RECOMMANDATIONS COMPLÉMENTAIRES -->
        <!-- ============================================ -->
        <div class="card mb-3">
            <div class="card-header"><h3>Recommandations complémentaires</h3></div>
            <div class="card-body">
                <div class="auto-content-section">
                    <div class="auto-content-box">
                        <?= nl2br(e($autoContent['recommandations'])) ?>
                    </div>
                    <input type="hidden" name="recommandations_complementaires" value="<?= e($autoContent['recommandations']) ?>">
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

        <div class="d-flex justify-between" style="margin-top: 1.5rem;">
            <a href="<?= url('consultation-step5', ['id' => $consultId]) ?>" class="btn btn-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><polyline points="15 18 9 12 15 6"/></svg>
                Précédent
            </a>
            <div class="d-flex gap-1">
                <button type="submit" name="finalize" value="0" class="btn btn-primary btn-lg">Enregistrer le PHV</button>
                <button type="submit" name="finalize" value="1" class="btn btn-terra btn-lg">Terminer la consultation</button>
            </div>
        </div>
    </form>
</div>

<script>
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
</script>

<style>
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

@media (max-width: 768px) {
    .patho-grid { grid-template-columns: 1fr; }
    .recettes-grid { grid-template-columns: 1fr; }
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

    // Hydratation
    if (empty($hydratation) || str_contains($hydratation, 'café') || str_contains($hydratation, '1l') || str_contains($hydratation, 'peu')) {
        $alimConseils[] = "• Boire 1,5 à 2L d'eau par jour, en dehors des repas";
        $alimAlertes[] = "Hydratation insuffisante détectée";
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
    // ROUTINES
    // ============================================
    $routineMatin = [];
    $routineSoir = [];

    // Routine matin
    $routineMatin[] = "1. GRATTE-LANGUE (5-7 passages)";
    $routineMatin[] = "   → Élimine les toxines accumulées la nuit";

    if (!$hasDigestifIssue) { // Citron déconseillé si RGO/acidité
        $routineMatin[] = "2. EAU TIÈDE + JUS DE CITRON (si bien toléré)";
        $routineMatin[] = "   → Stimule le foie et la digestion";
    } else {
        $routineMatin[] = "2. VERRE D'EAU TIÈDE (sans citron)";
        $routineMatin[] = "   → Réhydrate en douceur";
    }

    $routineMatin[] = "3. AUTOMASSAGE DU VENTRE (2 min, sens horaire)";
    $routineMatin[] = "   → Stimule le transit";

    if ($stressNiveau >= 5) {
        $routineMatin[] = "4. COHÉRENCE CARDIAQUE (5 min)";
        $routineMatin[] = "   → Démarre la journée sereinement";
    }

    // Routine soir
    $routineSoir[] = "1. DÎNER LÉGER (3h avant coucher minimum)";

    if (str_contains($desequilibres, 'hépatique') || str_contains($priorite1, 'foie') || str_contains($priorite1, 'détox')) {
        $routineSoir[] = "2. BOUILLOTTE CHAUDE SUR LE FOIE (20 min)";
        $routineSoir[] = "   → Favorise la détoxification hépatique";
    }

    $routineSoir[] = "3. ÉCRANS ÉTEINTS 1h avant le coucher";
    $routineSoir[] = "   → Préserve la mélatonine naturelle";

    $routineSoir[] = "4. TISANE RELAXANTE";
    $routineSoir[] = "   → Tilleul, mélisse, camomille ou passiflore";

    if ($sommeilQualite <= 5) {
        $routineSoir[] = "5. COHÉRENCE CARDIAQUE ou SCAN CORPOREL (5-10 min)";
        $routineSoir[] = "   → Favorise l'endormissement";
    }

    $content['routines']['matin'] = implode("\n", $routineMatin);
    $content['routines']['soir'] = implode("\n", $routineSoir);

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

    $content['complements'] = array_slice($complements, 0, 3);

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

    return $content;
}
?>
