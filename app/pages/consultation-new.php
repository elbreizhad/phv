<?php
$db = getDB();
$userId = currentUserId();
$clientId = (int) getGet('client_id');

// Récupérer le client
$stmt = $db->prepare('SELECT * FROM clients WHERE id = ? AND user_id = ?');
$stmt->execute([$clientId, $userId]);
$client = $stmt->fetch();
if (!$client) { redirect('clients'); }

// Nombre de consultations existantes
$nbC = $db->prepare("SELECT COUNT(*) FROM consultations WHERE client_id = ?");
$nbC->execute([$clientId]);
$nbConsult = $nbC->fetchColumn();
?>

<div class="page-header">
    <div>
        <h1>Nouvelle consultation</h1>
        <p class="subtitle">Pour <?= e($client['prenom'] . ' ' . $client['nom']) ?></p>
    </div>
    <a href="<?= url('client-view', ['id' => $clientId]) ?>" class="btn btn-secondary">Retour</a>
</div>

<div class="page-body animate-in">
    <div class="card" style="max-width: 700px;">
        <div class="card-body">
            <form method="POST" action="<?= url('consultation-new') ?>">
                <input type="hidden" name="action" value="consultation-create">
                <input type="hidden" name="client_id" value="<?= $clientId ?>">

                <div class="form-group">
                    <label class="form-label">Type de séance <span class="required">*</span></label>
                    <div class="d-flex gap-1">
                        <label class="form-check">
                            <input type="radio" name="type_seance" value="premiere" <?= $nbConsult === 0 ? 'checked' : '' ?>>
                            <label>Première séance (~1h15)</label>
                        </label>
                        <label class="form-check" style="margin-left: 1.5rem;">
                            <input type="radio" name="type_seance" value="suivi" <?= $nbConsult > 0 ? 'checked' : '' ?>>
                            <label>Séance de suivi (~45min)</label>
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Date de consultation <span class="required">*</span></label>
                    <input type="date" name="date_consultation" class="form-control" value="<?= date('Y-m-d') ?>" required style="max-width: 250px;">
                </div>

                <div class="form-group">
                    <label class="form-label">Catégorie du motif</label>
                    <select name="motif_categorie" class="form-control" id="motifCategorie">
                        <option value="">Sélectionner...</option>
                        <?php foreach (MOTIF_CATEGORIES as $key => $label): ?>
                            <option value="<?= $key ?>"><?= e($label) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <p class="form-hint">Aide à orienter les questions du bilan systémique</p>
                </div>

                <div class="form-group">
                    <label class="form-label">Motif de consultation <span class="required">*</span></label>
                    <textarea name="motif" class="form-control" rows="4" required placeholder="Décrivez le motif de la consultation tel que formulé par le client..."></textarea>
                    <p class="form-hint">Prenez environ 10 minutes pour explorer le motif avec le client</p>
                </div>

                <div class="d-flex justify-between" style="margin-top: 2rem;">
                    <a href="<?= url('client-view', ['id' => $clientId]) ?>" class="btn btn-secondary">Annuler</a>
                    <button type="submit" class="btn btn-terra btn-lg">Démarrer la consultation</button>
                </div>
            </form>
        </div>
    </div>
</div>
