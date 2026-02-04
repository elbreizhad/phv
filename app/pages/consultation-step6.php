<?php
/**
 * Étape 6 : Programme d'Hygiène de Vie (PHV)
 * GÉNÉRATION AUTOMATIQUE basée sur le questionnaire
 * Le praticien ne fait qu'ajouter des commentaires spécifiques
 */
require_once __DIR__ . '/../data/knowledge-base.php';

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
$synthese = $synthStmt->fetch();

// Récupérer le PHV existant
$phvStmt = $db->prepare("SELECT * FROM phv WHERE consultation_id = ?");
$phvStmt->execute([$consultId]);
$phv = $phvStmt->fetch();

// Toutes les réponses du questionnaire
$allReponses = getReponses($consultId);

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

<?php
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
    $stressNiveau = (int)($reponses['stress_niveau'] ?? 5);
    $sommeilQualite = (int)($reponses['sommeil_qualite'] ?? 5);
    $activiteNiveau = (int)($reponses['activite_niveau'] ?? 5);
    $immuNiveau = (int)($reponses['immu_niveau'] ?? 5);

    // Troubles détectés
    $digTroubles = strtolower($reponses['dig_troubles'] ?? '');
    $stressManifestation = strtolower($reponses['stress_manifestations'] ?? '');
    $sommeilProblemes = strtolower($reponses['sommeil_problemes'] ?? '');
    $nervSymptomes = strtolower($reponses['nerv_symptomes'] ?? '');
    $desequilibres = strtolower($reponses['pre_synthese_desequilibres'] ?? '');

    // Alimentation
    $hydratation = strtolower($reponses['alim_hydratation'] ?? '');
    $mastication = strtolower($reponses['alim_mastication'] ?? '');
    $grignotage = strtolower($reponses['alim_grignotage'] ?? '');

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
    if ($sexe === 'femme' && (str_contains($reponses['uro_gyneco'] ?? '', 'spm') || str_contains($motif, 'hormonal') || str_contains($motif, 'règles'))) {
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
    if ($sexe === 'femme' && str_contains(strtolower($reponses['endo_energie'] ?? ''), 'fatigue') && count($complements) < 3) {
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

    if (str_contains($stressManifestation, 'tension') || str_contains($reponses['osteo_douleurs'] ?? '', '')) {
        $reco[] = "• Ostéopathie ou massage thérapeutique";
    }

    if ($sexe === 'femme' && str_contains($reponses['uro_gyneco'] ?? '', 'menopause')) {
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
