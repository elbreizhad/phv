<?php
/**
 * Export du PHV en HTML imprimable (génération PDF via le navigateur Ctrl+P)
 * Version améliorée avec mise en page multi-pages et ressources intégrées
 */
$db = getDB();
$consultId = (int) getGet('id');
$userId = currentUserId();

$stmt = $db->prepare("
    SELECT c.*, cl.nom AS client_nom, cl.prenom AS client_prenom, cl.sexe AS client_sexe,
           cl.email AS client_email, cl.telephone AS client_telephone
    FROM consultations c
    JOIN clients cl ON c.client_id = cl.id
    WHERE c.id = ? AND c.user_id = ?
");
$stmt->execute([$consultId, $userId]);
$consultation = $stmt->fetch();
if (!$consultation) { exit('Consultation introuvable.'); }

// PHV
$phvStmt = $db->prepare("SELECT * FROM phv WHERE consultation_id = ?");
$phvStmt->execute([$consultId]);
$phv = $phvStmt->fetch();
if (!$phv) { exit('PHV non encore rédigé.'); }

// Synthèse
$synthStmt = $db->prepare("SELECT * FROM consultation_synthese WHERE consultation_id = ?");
$synthStmt->execute([$consultId]);
$synthese = $synthStmt->fetch();

// Praticien
$userStmt = $db->prepare("SELECT * FROM users WHERE id = ?");
$userStmt->execute([$userId]);
$user = $userStmt->fetch();

$complements = json_decode($phv['complements'], true) ?: [];
$commentaires = json_decode($phv['commentaires_praticien'] ?? '{}', true) ?: [];

// Récupérer les ressources sélectionnées (colonnes optionnelles)
$protocolesIds = [];
$recettesIds = [];
$pathologiesIds = [];
if (isset($phv['protocoles_ids'])) {
    $protocolesIds = json_decode($phv['protocoles_ids'] ?? '[]', true) ?: [];
}
if (isset($phv['recettes_ids'])) {
    $recettesIds = json_decode($phv['recettes_ids'] ?? '[]', true) ?: [];
}
if (isset($phv['pathologies_ids'])) {
    $pathologiesIds = json_decode($phv['pathologies_ids'] ?? '[]', true) ?: [];
}

// Charger les protocoles sélectionnés
$protocoles = [];
if (!empty($protocolesIds)) {
    try {
        $placeholders = implode(',', array_fill(0, count($protocolesIds), '?'));
        $protoStmt = $db->prepare("SELECT * FROM protocoles WHERE id IN ($placeholders)");
        $protoStmt->execute($protocolesIds);
        $protocoles = $protoStmt->fetchAll();
    } catch (PDOException $e) {}
}

// Charger les recettes sélectionnées
$recettes = [];
if (!empty($recettesIds)) {
    try {
        $placeholders = implode(',', array_fill(0, count($recettesIds), '?'));
        $recStmt = $db->prepare("SELECT * FROM recettes WHERE id IN ($placeholders)");
        $recStmt->execute($recettesIds);
        $recettes = $recStmt->fetchAll();
    } catch (PDOException $e) {}
}

// Charger les fiches pathologies sélectionnées
$pathologies = [];
if (!empty($pathologiesIds)) {
    try {
        $placeholders = implode(',', array_fill(0, count($pathologiesIds), '?'));
        $pathoStmt = $db->prepare("SELECT * FROM fiches_pathologies WHERE id IN ($placeholders)");
        $pathoStmt->execute($pathologiesIds);
        $pathologies = $pathoStmt->fetchAll();
    } catch (PDOException $e) {}
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>PHV - <?= e($consultation['client_prenom'] . ' ' . $consultation['client_nom']) ?></title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;600;700&display=swap');

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            color: #1a1f16;
            line-height: 1.5;
            font-size: 10pt;
            background: white;
        }

        .page {
            max-width: 210mm;
            min-height: 297mm;
            margin: 0 auto;
            padding: 15mm 20mm;
            background: white;
        }

        /* Page breaks */
        .page-break {
            page-break-before: always;
        }

        .avoid-break {
            page-break-inside: avoid;
        }

        /* Header */
        .phv-header {
            text-align: center;
            padding-bottom: 1rem;
            border-bottom: 3px solid #4a6741;
            margin-bottom: 1.5rem;
        }

        .phv-header h1 {
            font-family: 'Playfair Display', serif;
            font-size: 22pt;
            color: #4a6741;
            margin-bottom: 0.2rem;
        }

        .phv-header .subtitle {
            color: #7a8370;
            font-size: 9pt;
        }

        .client-info {
            display: flex;
            justify-content: space-between;
            padding: 0.8rem;
            background: #f4f7f2;
            border-radius: 6px;
            margin-bottom: 1.5rem;
            font-size: 9pt;
        }

        .client-info strong {
            color: #3b5234;
        }

        /* Sections */
        .section {
            margin-bottom: 1.2rem;
            page-break-inside: avoid;
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 12pt;
            color: #4a6741;
            padding-bottom: 0.3rem;
            border-bottom: 2px solid #c9d7c1;
            margin-bottom: 0.6rem;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .section-title::before {
            content: '';
            width: 4px;
            height: 16px;
            background: #c4704b;
            border-radius: 2px;
        }

        .content {
            font-size: 9.5pt;
            line-height: 1.5;
        }

        .content p { margin-bottom: 0.4rem; }

        .two-cols {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.8rem;
            margin: 0.4rem 0;
        }

        .box-avoid {
            padding: 0.6rem;
            background: #fde8e6;
            border-radius: 5px;
            border-left: 3px solid #c45b4b;
            font-size: 9pt;
        }

        .box-favor {
            padding: 0.6rem;
            background: #e8f5ea;
            border-radius: 5px;
            border-left: 3px solid #4a9b5a;
            font-size: 9pt;
        }

        .box-avoid h4, .box-favor h4 {
            font-size: 8pt;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.2rem;
        }

        .box-avoid h4 { color: #c45b4b; }
        .box-favor h4 { color: #4a9b5a; }

        /* Commentaires praticien */
        .praticien-note {
            margin-top: 0.5rem;
            padding: 0.5rem 0.6rem;
            background: #f8f6f2;
            border-left: 3px solid #a85a3a;
            border-radius: 4px;
            font-size: 9pt;
            color: #6d3a28;
            font-style: italic;
        }
        .praticien-note::before {
            content: "Note du praticien : ";
            font-weight: 600;
            font-style: normal;
        }

        /* Compléments */
        .complement-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 0.4rem;
            font-size: 9pt;
        }

        .complement-table th {
            text-align: left;
            padding: 0.4rem;
            background: #f4f7f2;
            font-size: 8pt;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #4a5240;
            border-bottom: 2px solid #c9d7c1;
        }

        .complement-table td {
            padding: 0.4rem;
            border-bottom: 1px solid #ebe3d5;
        }

        /* Protocoles */
        .protocole-item {
            background: #fef9f3;
            border: 1px solid #e8ddd0;
            border-left: 4px solid #c4704b;
            border-radius: 6px;
            padding: 0.8rem;
            margin-bottom: 0.8rem;
            page-break-inside: avoid;
        }

        .protocole-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.5rem;
        }

        .protocole-type {
            display: inline-block;
            padding: 2px 8px;
            background: #c4704b;
            color: white;
            font-size: 8pt;
            border-radius: 4px;
            text-transform: uppercase;
        }

        .protocole-name {
            font-size: 11pt;
            font-weight: 600;
            color: #3b5234;
        }

        .protocole-duree {
            font-size: 9pt;
            color: #7a8370;
        }

        .protocole-objectifs {
            font-size: 9pt;
            color: #555;
            margin-bottom: 0.5rem;
        }

        .phases-list {
            margin: 0.5rem 0;
        }

        .phase-item {
            display: flex;
            gap: 0.6rem;
            margin-bottom: 0.5rem;
            font-size: 9pt;
        }

        .phase-number {
            width: 22px;
            height: 22px;
            background: #4a6741;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 8pt;
            font-weight: bold;
            flex-shrink: 0;
        }

        .phase-content {
            flex: 1;
        }

        .phase-name {
            font-weight: 600;
            color: #3b5234;
        }

        .phase-actions {
            margin: 0.2rem 0 0 0;
            padding-left: 1rem;
            font-size: 8.5pt;
            color: #555;
        }

        .phase-actions li {
            margin-bottom: 0.1rem;
        }

        .protocole-complements {
            margin-top: 0.5rem;
            padding-top: 0.5rem;
            border-top: 1px dashed #e8ddd0;
        }

        .protocole-complements h5 {
            font-size: 9pt;
            color: #4a6741;
            margin-bottom: 0.3rem;
        }

        .protocole-complements ul {
            padding-left: 1rem;
            font-size: 8.5pt;
        }

        /* Recettes */
        .recettes-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.8rem;
        }

        .recette-item {
            background: #f0f7f0;
            border: 1px solid #c9d7c1;
            border-radius: 6px;
            padding: 0.8rem;
            page-break-inside: avoid;
        }

        .recette-header {
            margin-bottom: 0.5rem;
        }

        .recette-categorie {
            display: inline-block;
            padding: 2px 6px;
            background: #4a6741;
            color: white;
            font-size: 7pt;
            border-radius: 3px;
            text-transform: uppercase;
        }

        .recette-name {
            font-size: 10pt;
            font-weight: 600;
            color: #3b5234;
            margin-top: 0.3rem;
        }

        .recette-meta {
            font-size: 8pt;
            color: #7a8370;
            margin-bottom: 0.3rem;
        }

        .recette-regimes {
            display: flex;
            flex-wrap: wrap;
            gap: 0.2rem;
            margin-bottom: 0.5rem;
        }

        .regime-badge {
            padding: 1px 5px;
            background: #e8f5ea;
            color: #2e7d32;
            font-size: 7pt;
            border-radius: 3px;
        }

        .recette-section {
            margin-top: 0.5rem;
        }

        .recette-section h5 {
            font-size: 8pt;
            color: #4a6741;
            margin-bottom: 0.2rem;
        }

        .recette-section p {
            font-size: 8pt;
            line-height: 1.4;
            color: #444;
        }

        /* Fiches pathologies */
        .patho-item {
            background: #f5f9fc;
            border: 1px solid #b8d4e8;
            border-left: 4px solid #2196F3;
            border-radius: 6px;
            padding: 0.8rem;
            margin-bottom: 0.8rem;
            page-break-inside: avoid;
        }

        .patho-header {
            margin-bottom: 0.5rem;
        }

        .patho-systeme {
            display: inline-block;
            padding: 2px 6px;
            background: #2196F3;
            color: white;
            font-size: 7pt;
            border-radius: 3px;
            text-transform: uppercase;
        }

        .patho-name {
            font-size: 11pt;
            font-weight: 600;
            color: #1565c0;
            margin-top: 0.3rem;
        }

        .patho-description {
            font-size: 9pt;
            color: #555;
            margin-bottom: 0.5rem;
        }

        .patho-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.6rem;
        }

        .patho-col {
            background: white;
            padding: 0.5rem;
            border-radius: 4px;
        }

        .patho-col h5 {
            font-size: 8pt;
            color: #1976D2;
            margin-bottom: 0.2rem;
            text-transform: uppercase;
        }

        .patho-col p {
            font-size: 8pt;
            line-height: 1.4;
        }

        .patho-full {
            margin-top: 0.5rem;
        }

        /* Footer */
        .phv-footer {
            margin-top: 2rem;
            padding-top: 0.8rem;
            border-top: 1px solid #d9cebc;
            font-size: 8pt;
            color: #7a8370;
            text-align: center;
            line-height: 1.4;
        }

        .disclaimer {
            margin-top: 0.8rem;
            padding: 0.6rem;
            background: #fcf9f3;
            border-radius: 5px;
            font-size: 7pt;
            color: #7a8370;
            font-style: italic;
        }

        /* Page header for subsequent pages */
        .page-subheader {
            text-align: center;
            padding-bottom: 0.8rem;
            border-bottom: 2px solid #c9d7c1;
            margin-bottom: 1rem;
        }

        .page-subheader h2 {
            font-family: 'Playfair Display', serif;
            font-size: 16pt;
            color: #4a6741;
        }

        .page-subheader .client-name {
            font-size: 9pt;
            color: #7a8370;
        }

        /* Print styles */
        @media print {
            body {
                font-size: 9pt;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            .page {
                padding: 10mm 15mm;
                max-width: none;
                min-height: auto;
            }
            .no-print { display: none !important; }
            .section { page-break-inside: avoid; }
            .protocole-item { page-break-inside: avoid; }
            .recette-item { page-break-inside: avoid; }
            .patho-item { page-break-inside: avoid; }
            .page-break { page-break-before: always; }
        }

        /* Bouton imprimer */
        .print-bar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: #4a6741;
            color: white;
            padding: 0.6rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 100;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .print-bar button {
            background: white;
            color: #4a6741;
            border: none;
            padding: 0.4rem 1.2rem;
            border-radius: 5px;
            font-weight: 600;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
        }

        .print-bar + .page { margin-top: 50px; }

        @media print {
            .print-bar + .page { margin-top: 0; }
        }
    </style>
</head>
<body>
    <div class="print-bar no-print">
        <span>Programme d'Hygiène de Vie - <?= e($consultation['client_prenom'] . ' ' . $consultation['client_nom']) ?></span>
        <div>
            <button onclick="window.print()">Imprimer / Sauvegarder en PDF</button>
        </div>
    </div>

    <!-- PAGE 1 : PHV Principal -->
    <div class="page">
        <!-- Header -->
        <div class="phv-header">
            <h1>Programme d'Hygiène de Vie</h1>
            <div class="subtitle">Conseils personnalisés en naturopathie</div>
        </div>

        <!-- Info client -->
        <div class="client-info">
            <div>
                <strong><?= e($consultation['client_prenom'] . ' ' . $consultation['client_nom']) ?></strong><br>
                Date : <?= formatDate($consultation['date_consultation']) ?>
            </div>
            <div style="text-align: right;">
                <strong><?= e($user['prenom'] . ' ' . $user['nom']) ?></strong><br>
                Praticien(ne) en naturopathie
            </div>
        </div>

        <!-- Alimentation -->
        <?php if ($phv['alimentation'] || $phv['alimentation_eviter'] || $phv['alimentation_privilegier']): ?>
        <div class="section">
            <div class="section-title">Conseils alimentaires</div>
            <div class="content">
                <?php if ($phv['alimentation']): ?>
                    <p><?= nl2br(e($phv['alimentation'])) ?></p>
                <?php endif; ?>

                <?php if ($phv['alimentation_eviter'] || $phv['alimentation_privilegier']): ?>
                <div class="two-cols">
                    <?php if ($phv['alimentation_eviter']): ?>
                    <div class="box-avoid">
                        <h4>A limiter / éviter</h4>
                        <p><?= nl2br(e($phv['alimentation_eviter'])) ?></p>
                    </div>
                    <?php endif; ?>
                    <?php if ($phv['alimentation_privilegier']): ?>
                    <div class="box-favor">
                        <h4>A privilégier</h4>
                        <p><?= nl2br(e($phv['alimentation_privilegier'])) ?></p>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <?php if (!empty($commentaires['alimentation'])): ?>
                    <div class="praticien-note"><?= nl2br(e($commentaires['alimentation'])) ?></div>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- Menu type -->
        <?php if ($phv['menu_type']): ?>
        <div class="section">
            <div class="section-title">Exemples de repas</div>
            <div class="content">
                <p><?= nl2br(e($phv['menu_type'])) ?></p>
            </div>
        </div>
        <?php endif; ?>

        <!-- Gestion du stress -->
        <?php if ($phv['gestion_stress']): ?>
        <div class="section">
            <div class="section-title">Gestion du stress & émotions</div>
            <div class="content">
                <p><?= nl2br(e($phv['gestion_stress'])) ?></p>
                <?php if (!empty($commentaires['stress'])): ?>
                    <div class="praticien-note"><?= nl2br(e($commentaires['stress'])) ?></div>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- Activité physique -->
        <?php if ($phv['activite_physique']): ?>
        <div class="section">
            <div class="section-title">Activité physique</div>
            <div class="content">
                <p><?= nl2br(e($phv['activite_physique'])) ?></p>
                <?php if (!empty($commentaires['activite'])): ?>
                    <div class="praticien-note"><?= nl2br(e($commentaires['activite'])) ?></div>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- Routines -->
        <?php if ($phv['routine_matin'] || $phv['routine_soir']): ?>
        <div class="section">
            <div class="section-title">Routines quotidiennes</div>
            <div class="content">
                <div class="two-cols">
                    <?php if ($phv['routine_matin']): ?>
                    <div>
                        <p><strong>Matin :</strong></p>
                        <p><?= nl2br(e($phv['routine_matin'])) ?></p>
                    </div>
                    <?php endif; ?>
                    <?php if ($phv['routine_soir']): ?>
                    <div>
                        <p><strong>Soir :</strong></p>
                        <p><?= nl2br(e($phv['routine_soir'])) ?></p>
                    </div>
                    <?php endif; ?>
                </div>
                <?php if (!empty($commentaires['routines'])): ?>
                    <div class="praticien-note"><?= nl2br(e($commentaires['routines'])) ?></div>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- Soins naturels -->
        <?php if ($phv['soins_naturels']): ?>
        <div class="section">
            <div class="section-title">Soins naturels</div>
            <div class="content"><p><?= nl2br(e($phv['soins_naturels'])) ?></p></div>
        </div>
        <?php endif; ?>

        <!-- Compléments -->
        <?php if (!empty($complements)): ?>
        <div class="section">
            <div class="section-title">Compléments alimentaires</div>
            <div class="content">
                <table class="complement-table">
                    <thead>
                        <tr>
                            <th>Complément</th>
                            <th>Posologie</th>
                            <th>Durée</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($complements as $c): ?>
                        <tr>
                            <td><strong><?= e($c['nom']) ?></strong></td>
                            <td><?= e($c['posologie']) ?></td>
                            <td><?= e($c['duree']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php if (!empty($commentaires['complements'])): ?>
                    <div class="praticien-note"><?= nl2br(e($commentaires['complements'])) ?></div>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- Recommandations complémentaires -->
        <?php if ($phv['recommandations_complementaires']): ?>
        <div class="section">
            <div class="section-title">Recommandations complémentaires</div>
            <div class="content"><p><?= nl2br(e($phv['recommandations_complementaires'])) ?></p></div>
        </div>
        <?php endif; ?>

        <!-- Footer page 1 si pas de ressources -->
        <?php if (empty($protocoles) && empty($recettes) && empty($pathologies)): ?>
        <div class="phv-footer">
            <p>
                <?= e($user['prenom'] . ' ' . $user['nom']) ?> - Praticien(ne) en naturopathie<br>
                <?php if ($user['email']): ?><?= e($user['email']) ?> | <?php endif; ?>
                <?php if ($user['telephone']): ?><?= e($user['telephone']) ?><?php endif; ?>
                <?php if ($user['siret']): ?><br>SIRET : <?= e($user['siret']) ?><?php endif; ?>
            </p>
            <div class="disclaimer">
                Les conseils prodigués dans ce document ne se substituent pas à un avis médical.
                La naturopathie est une approche complémentaire qui ne remplace en aucun cas un traitement médical.
                En cas de doute, consultez votre médecin traitant.
            </div>
        </div>
        <?php endif; ?>
    </div>

    <!-- PAGE 2+ : Protocoles -->
    <?php if (!empty($protocoles)): ?>
    <div class="page page-break">
        <div class="page-subheader">
            <h2>Protocoles d'accompagnement</h2>
            <div class="client-name"><?= e($consultation['client_prenom'] . ' ' . $consultation['client_nom']) ?></div>
        </div>

        <?php foreach ($protocoles as $proto): ?>
        <div class="protocole-item avoid-break">
            <div class="protocole-header">
                <div>
                    <span class="protocole-type"><?= ucfirst(str_replace('_', ' ', $proto['type_protocole'])) ?></span>
                    <div class="protocole-name"><?= e($proto['nom']) ?></div>
                </div>
                <div class="protocole-duree"><?= $proto['duree_jours'] ?> jours</div>
            </div>

            <?php if (!empty($proto['objectifs'])): ?>
            <div class="protocole-objectifs">
                <strong>Objectifs :</strong> <?= e($proto['objectifs']) ?>
            </div>
            <?php endif; ?>

            <?php $phases = json_decode($proto['phases'] ?? '[]', true); ?>
            <?php if (!empty($phases)): ?>
            <div class="phases-list">
                <strong style="font-size: 9pt;">Phases du protocole :</strong>
                <?php foreach ($phases as $i => $phase): ?>
                <div class="phase-item">
                    <div class="phase-number"><?= $i + 1 ?></div>
                    <div class="phase-content">
                        <div class="phase-name"><?= e($phase['nom'] ?? 'Phase '.($i+1)) ?><?php if (!empty($phase['duree'])): ?> <span style="font-weight: normal; color: #888;">(<?= e($phase['duree']) ?>)</span><?php endif; ?></div>
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
            <?php endif; ?>

            <?php $protoCompl = json_decode($proto['complements'] ?? '[]', true); ?>
            <?php if (!empty($protoCompl)): ?>
            <div class="protocole-complements">
                <h5>Compléments recommandés :</h5>
                <ul>
                    <?php foreach ($protoCompl as $c): ?>
                    <li><strong><?= e($c['nom']) ?></strong> - <?= e($c['posologie']) ?> <span style="color: #888;">(<?= e($c['duree']) ?>)</span></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>

            <?php if (!empty($proto['contre_indications'])): ?>
            <div style="margin-top: 0.5rem; padding: 0.4rem; background: #fff3e0; border-radius: 4px; font-size: 8pt;">
                <strong style="color: #e65100;">Précautions :</strong> <?= e($proto['contre_indications']) ?>
            </div>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <!-- PAGE 3+ : Fiches pathologies -->
    <?php if (!empty($pathologies)): ?>
    <div class="page page-break">
        <div class="page-subheader">
            <h2>Fiches d'information</h2>
            <div class="client-name"><?= e($consultation['client_prenom'] . ' ' . $consultation['client_nom']) ?></div>
        </div>

        <?php foreach ($pathologies as $patho): ?>
        <div class="patho-item avoid-break">
            <div class="patho-header">
                <span class="patho-systeme"><?= e($patho['systeme']) ?></span>
                <div class="patho-name"><?= e($patho['nom']) ?></div>
            </div>

            <?php if (!empty($patho['description'])): ?>
            <div class="patho-description"><?= e($patho['description']) ?></div>
            <?php endif; ?>

            <div class="patho-grid">
                <div class="patho-col">
                    <h5>Aliments à éviter</h5>
                    <p><?= nl2br(e($patho['aliments_eviter'])) ?></p>
                </div>
                <div class="patho-col">
                    <h5>Aliments à privilégier</h5>
                    <p><?= nl2br(e($patho['aliments_privilegier'])) ?></p>
                </div>
            </div>

            <div class="patho-grid">
                <div class="patho-col">
                    <h5>Compléments utiles</h5>
                    <p><?= nl2br(e($patho['complements'])) ?></p>
                </div>
                <div class="patho-col">
                    <h5>Phytothérapie</h5>
                    <p><?= nl2br(e($patho['phytotherapie'])) ?></p>
                </div>
            </div>

            <?php if (!empty($patho['aromatherapie'])): ?>
            <div class="patho-full">
                <div class="patho-col" style="background: #fff;">
                    <h5>Aromathérapie</h5>
                    <p><?= nl2br(e($patho['aromatherapie'])) ?></p>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <!-- PAGE 4+ : Recettes -->
    <?php if (!empty($recettes)): ?>
    <div class="page page-break">
        <div class="page-subheader">
            <h2>Recettes recommandées</h2>
            <div class="client-name"><?= e($consultation['client_prenom'] . ' ' . $consultation['client_nom']) ?></div>
        </div>

        <div class="recettes-grid">
        <?php foreach ($recettes as $recette): ?>
            <div class="recette-item avoid-break">
                <div class="recette-header">
                    <span class="recette-categorie"><?= ucfirst(str_replace('_', ' ', $recette['categorie'])) ?></span>
                    <div class="recette-name"><?= e($recette['nom']) ?></div>
                    <div class="recette-meta">
                        <?= $recette['temps_preparation'] ?> min prépa<?php if ($recette['temps_cuisson']): ?> + <?= $recette['temps_cuisson'] ?> min cuisson<?php endif; ?>
                        • <?= $recette['portions'] ?> portions
                    </div>
                </div>

                <?php $regimes = json_decode($recette['regimes'] ?? '[]', true); ?>
                <?php if (!empty($regimes)): ?>
                <div class="recette-regimes">
                    <?php foreach ($regimes as $regime): ?>
                    <span class="regime-badge"><?= e($regime) ?></span>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <div class="recette-section">
                    <h5>Ingrédients</h5>
                    <p><?= nl2br(e($recette['ingredients'])) ?></p>
                </div>

                <div class="recette-section">
                    <h5>Préparation</h5>
                    <p><?= nl2br(e($recette['instructions'])) ?></p>
                </div>

                <?php if (!empty($recette['bienfaits'])): ?>
                <div class="recette-section" style="background: #e8f5e9; padding: 0.4rem; border-radius: 4px; margin-top: 0.4rem;">
                    <h5 style="color: #2e7d32;">Bienfaits</h5>
                    <p><?= e($recette['bienfaits']) ?></p>
                </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- Footer final (sur dernière page) -->
    <?php if (!empty($protocoles) || !empty($recettes) || !empty($pathologies)): ?>
    <div class="page">
        <div class="phv-footer" style="margin-top: 0;">
            <p>
                <?= e($user['prenom'] . ' ' . $user['nom']) ?> - Praticien(ne) en naturopathie<br>
                <?php if ($user['email']): ?><?= e($user['email']) ?> | <?php endif; ?>
                <?php if ($user['telephone']): ?><?= e($user['telephone']) ?><?php endif; ?>
                <?php if ($user['siret']): ?><br>SIRET : <?= e($user['siret']) ?><?php endif; ?>
            </p>
            <div class="disclaimer">
                Les conseils prodigués dans ce document ne se substituent pas à un avis médical.
                La naturopathie est une approche complémentaire qui ne remplace en aucun cas un traitement médical.
                En cas de doute, consultez votre médecin traitant.
                Conformément au RGPD, vos données personnelles sont traitées de manière confidentielle.
            </div>
        </div>
    </div>
    <?php endif; ?>
</body>
</html>
