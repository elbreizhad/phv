<?php
$db = getDB();
$clientId = (int) getGet('id');
$userId = currentUserId();

$stmt = $db->prepare('SELECT * FROM clients WHERE id = ? AND user_id = ?');
$stmt->execute([$clientId, $userId]);
$client = $stmt->fetch();
if (!$client) { redirect('clients'); }

// Consultations du client + détection V2 (trame_version OU présence de réponses v2_step%)
$cStmt = $db->prepare("
    SELECT c.*,
        CASE WHEN c.trame_version = 'v2'
             OR EXISTS (SELECT 1 FROM consultation_reponses r WHERE r.consultation_id = c.id AND r.section LIKE 'v2_step%')
        THEN 'v2' ELSE 'v1' END AS resolved_trame
    FROM consultations c
    WHERE c.client_id = ?
    ORDER BY c.date_consultation DESC
");
try {
    $cStmt->execute([$clientId]);
    $consultations = $cStmt->fetchAll();
} catch (PDOException $e) {
    // Colonne trame_version absente -> requête simple
    $fallback = $db->prepare("SELECT *, 'v1' AS resolved_trame FROM consultations WHERE client_id = ? ORDER BY date_consultation DESC");
    $fallback->execute([$clientId]);
    $consultations = $fallback->fetchAll();
}

// Calcul âge
$age = $client['date_naissance'] ? (new DateTime($client['date_naissance']))->diff(new DateTime())->y : $client['age'];
?>

<div class="page-header">
    <div>
        <h1><?= e($client['prenom'] . ' ' . $client['nom']) ?></h1>
        <p class="subtitle"><?= $age ? $age . ' ans' : '' ?><?= $client['profession'] ? ' - ' . e($client['profession']) : '' ?></p>
    </div>
    <div class="d-flex gap-1">
        <a href="<?= url('client-edit', ['id' => $clientId]) ?>" class="btn btn-outline">Modifier</a>
        <a href="<?= url('consultation-new', ['client_id' => $clientId]) ?>" class="btn btn-terra">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Nouvelle consultation
        </a>
        <form method="POST" action="<?= url('client-view', ['id' => $clientId]) ?>" style="display:inline;" onsubmit="return confirm('Supprimer définitivement <?= e(addslashes($client['prenom'] . ' ' . $client['nom'])) ?> et TOUTES ses données (<?= count($consultations) ?> consultation<?= count($consultations) > 1 ? 's' : '' ?>, factures, mesures) ?\n\nCette action est irréversible.');">
            <input type="hidden" name="action" value="client-delete">
            <input type="hidden" name="client_id" value="<?= $clientId ?>">
            <button type="submit" class="btn" style="background:#fee;color:#d85a3d;border:1px solid #f5c5b8;">🗑 Supprimer le client</button>
        </form>
    </div>
</div>

<div class="page-body animate-in">
    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 1.5rem;">
        <!-- Infos client -->
        <div class="card">
            <div class="card-header">
                <h3>Informations</h3>
            </div>
            <div class="card-body">
                <div style="display: grid; gap: 0.8rem;">
                    <?php if ($client['sexe']): ?>
                    <div>
                        <div class="text-sm text-muted">Sexe</div>
                        <div><?= e(ucfirst($client['sexe'])) ?></div>
                    </div>
                    <?php endif; ?>
                    <?php if ($client['date_naissance']): ?>
                    <div>
                        <div class="text-sm text-muted">Date de naissance</div>
                        <div><?= formatDate($client['date_naissance']) ?></div>
                    </div>
                    <?php endif; ?>
                    <?php if ($client['lieu_de_vie']): ?>
                    <div>
                        <div class="text-sm text-muted">Lieu de vie</div>
                        <div><?= e($client['lieu_de_vie']) ?></div>
                    </div>
                    <?php endif; ?>
                    <?php if ($client['email']): ?>
                    <div>
                        <div class="text-sm text-muted">Email</div>
                        <div><?= e($client['email']) ?></div>
                    </div>
                    <?php endif; ?>
                    <?php if ($client['telephone']): ?>
                    <div>
                        <div class="text-sm text-muted">Téléphone</div>
                        <div><?= e($client['telephone']) ?></div>
                    </div>
                    <?php endif; ?>
                    <?php if ($client['adresse']): ?>
                    <div>
                        <div class="text-sm text-muted">Adresse</div>
                        <div><?= nl2br(e($client['adresse'])) ?></div>
                    </div>
                    <?php endif; ?>
                    <?php if ($client['taille_cm'] || $client['poids_kg']): ?>
                    <div>
                        <div class="text-sm text-muted">Morphologie</div>
                        <div>
                            <?= $client['taille_cm'] ? $client['taille_cm'] . ' cm' : '' ?>
                            <?= ($client['taille_cm'] && $client['poids_kg']) ? ' / ' : '' ?>
                            <?= $client['poids_kg'] ? $client['poids_kg'] . ' kg' : '' ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if ($client['notes']): ?>
                    <div>
                        <div class="text-sm text-muted">Notes</div>
                        <div class="text-sm"><?= nl2br(e($client['notes'])) ?></div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Consultations -->
        <div class="card">
            <div class="card-header">
                <h3>Historique des consultations</h3>
                <a href="<?= url('consultation-new', ['client_id' => $clientId]) ?>" class="btn btn-primary btn-sm">Nouvelle</a>
            </div>
            <div class="card-body" style="padding:0;">
                <?php if (empty($consultations)): ?>
                    <div class="empty-state" style="padding: 2rem;">
                        <p>Aucune consultation enregistrée.</p>
                        <a href="<?= url('consultation-new', ['client_id' => $clientId]) ?>" class="btn btn-terra btn-sm">Démarrer une consultation</a>
                    </div>
                <?php else: ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Motif</th>
                                <th>Statut</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($consultations as $c):
                            $statusBadge = match($c['statut']) {
                                'terminee' => 'badge-success',
                                'en_cours', 'questionnaire' => 'badge-warning',
                                'synthese' => 'badge-info',
                                'phv' => 'badge-sage',
                                default => 'badge-warning',
                            };
                            $statusLabel = match($c['statut']) {
                                'terminee' => 'Terminée',
                                'en_cours' => 'En cours',
                                'questionnaire' => 'Questionnaire',
                                'synthese' => 'Synthèse',
                                'phv' => 'PHV',
                                default => $c['statut'],
                            };
                        ?>
                            <tr>
                                <td><?= formatDate($c['date_consultation']) ?></td>
                                <td><span class="badge badge-<?= $c['type_seance'] === 'premiere' ? 'terra' : 'sage' ?>"><?= $c['type_seance'] === 'premiere' ? '1ère séance' : 'Suivi' ?></span></td>
                                <td class="text-sm"><?= e(mb_strimwidth($c['motif'], 0, 50, '...')) ?></td>
                                <td><span class="badge <?= $statusBadge ?>"><?= $statusLabel ?></span></td>
                                <td style="display:flex;gap:.3rem;">
                                    <?php
                                    $isV2 = ($c['resolved_trame'] ?? 'v1') === 'v2';
                                    if ($isV2) {
                                        // Si statut = phv, on renvoie sur le PHV (step6 réutilisé) ; sinon sur la dernière étape questionnaire/synthèse
                                        if ($c['statut'] === 'phv' || $c['statut'] === 'terminee') {
                                            $continueUrl = url('consultation-step6', ['id' => $c['id']]);
                                        } else {
                                            $vStep = max(1, min(15, (int)$c['current_step']));
                                            $continueUrl = url('consultation-v2', ['id' => $c['id'], 'step' => $vStep]);
                                        }
                                    } else {
                                        $continueUrl = url('consultation-step' . max(1, min(6, (int)$c['current_step'])), ['id' => $c['id']]);
                                    }
                                    ?>
                                    <a href="<?= $continueUrl ?>" class="btn btn-outline btn-sm">
                                        <?= $c['statut'] === 'terminee' ? 'Voir' : 'Continuer' ?>
                                    </a>
                                    <form method="POST" action="<?= url('client-view', ['id' => $clientId]) ?>" style="display:inline;" onsubmit="return confirm('Supprimer cette consultation du <?= formatDate($c['date_consultation']) ?> ?');">
                                        <input type="hidden" name="action" value="consultation-delete">
                                        <input type="hidden" name="consultation_id" value="<?= $c['id'] ?>">
                                        <input type="hidden" name="return_to" value="client-view">
                                        <button type="submit" class="btn btn-sm" style="background:#fee;color:#d85a3d;border:1px solid #f5c5b8;" title="Supprimer">🗑</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
