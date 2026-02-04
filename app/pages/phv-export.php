<?php
/**
 * Export du PHV en HTML imprimable (génération PDF via le navigateur Ctrl+P)
 * Alternative légère à DOMPDF - pas de dépendance externe
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
            line-height: 1.6;
            font-size: 11pt;
            background: white;
        }

        .page {
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* Header */
        .phv-header {
            text-align: center;
            padding-bottom: 1.5rem;
            border-bottom: 3px solid #4a6741;
            margin-bottom: 2rem;
        }

        .phv-header h1 {
            font-family: 'Playfair Display', serif;
            font-size: 24pt;
            color: #4a6741;
            margin-bottom: 0.3rem;
        }

        .phv-header .subtitle {
            color: #7a8370;
            font-size: 10pt;
        }

        .client-info {
            display: flex;
            justify-content: space-between;
            padding: 1rem;
            background: #f4f7f2;
            border-radius: 8px;
            margin-bottom: 2rem;
            font-size: 10pt;
        }

        .client-info strong {
            color: #3b5234;
        }

        /* Sections */
        .section {
            margin-bottom: 1.8rem;
            page-break-inside: avoid;
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 14pt;
            color: #4a6741;
            padding-bottom: 0.4rem;
            border-bottom: 2px solid #c9d7c1;
            margin-bottom: 0.8rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .section-title::before {
            content: '';
            width: 4px;
            height: 20px;
            background: #c4704b;
            border-radius: 2px;
        }

        .content {
            font-size: 10.5pt;
            line-height: 1.7;
        }

        .content p { margin-bottom: 0.5rem; }

        .two-cols {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin: 0.5rem 0;
        }

        .box-avoid {
            padding: 0.8rem;
            background: #fde8e6;
            border-radius: 6px;
            border-left: 3px solid #c45b4b;
        }

        .box-favor {
            padding: 0.8rem;
            background: #e8f5ea;
            border-radius: 6px;
            border-left: 3px solid #4a9b5a;
        }

        .box-avoid h4, .box-favor h4 {
            font-size: 9pt;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.3rem;
        }

        .box-avoid h4 { color: #c45b4b; }
        .box-favor h4 { color: #4a9b5a; }

        /* Commentaires praticien */
        .praticien-note {
            margin-top: 0.8rem;
            padding: 0.6rem 0.8rem;
            background: #f8f6f2;
            border-left: 3px solid #a85a3a;
            border-radius: 4px;
            font-size: 9.5pt;
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
            margin-top: 0.5rem;
        }

        .complement-table th {
            text-align: left;
            padding: 0.5rem;
            background: #f4f7f2;
            font-size: 9pt;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #4a5240;
            border-bottom: 2px solid #c9d7c1;
        }

        .complement-table td {
            padding: 0.5rem;
            border-bottom: 1px solid #ebe3d5;
            font-size: 10pt;
        }

        /* Footer */
        .phv-footer {
            margin-top: 3rem;
            padding-top: 1rem;
            border-top: 1px solid #d9cebc;
            font-size: 8pt;
            color: #7a8370;
            text-align: center;
            line-height: 1.5;
        }

        .disclaimer {
            margin-top: 1rem;
            padding: 0.8rem;
            background: #fcf9f3;
            border-radius: 6px;
            font-size: 7.5pt;
            color: #7a8370;
            font-style: italic;
        }

        /* Print */
        @media print {
            body { font-size: 10pt; }
            .page { padding: 0; max-width: none; }
            .no-print { display: none; }
            .section { page-break-inside: avoid; }
        }

        /* Bouton imprimer */
        .print-bar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: #4a6741;
            color: white;
            padding: 0.8rem 2rem;
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
            padding: 0.5rem 1.5rem;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
        }

        .print-bar + .page { margin-top: 60px; }
    </style>
</head>
<body>
    <div class="print-bar no-print">
        <span>Programme d'Hygiène de Vie - <?= e($consultation['client_prenom'] . ' ' . $consultation['client_nom']) ?></span>
        <div>
            <button onclick="window.print()">Imprimer / Sauvegarder en PDF</button>
        </div>
    </div>

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

                <?php if ($phv['menu_type']): ?>
                    <p style="margin-top: 0.8rem;"><strong>Exemples de repas :</strong></p>
                    <p><?= nl2br(e($phv['menu_type'])) ?></p>
                <?php endif; ?>

                <?php if (!empty($commentaires['alimentation'])): ?>
                    <div class="praticien-note"><?= nl2br(e($commentaires['alimentation'])) ?></div>
                <?php endif; ?>
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

        <!-- Footer -->
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
                Conformément au RGPD, vos données personnelles sont traitées de manière confidentielle.
            </div>
        </div>
    </div>
</body>
</html>
