<?php
$editMode = ($page === 'client-edit');
$client = null;

if ($editMode) {
    $db = getDB();
    $stmt = $db->prepare('SELECT * FROM clients WHERE id = ? AND user_id = ?');
    $stmt->execute([getGet('id'), currentUserId()]);
    $client = $stmt->fetch();
    if (!$client) { redirect('clients'); }
}
?>

<div class="page-header">
    <div>
        <h1><?= $editMode ? 'Modifier le client' : 'Nouveau client' ?></h1>
        <p class="subtitle"><?= $editMode ? e($client['prenom'] . ' ' . $client['nom']) : 'Enregistrer un nouveau client' ?></p>
    </div>
    <a href="<?= url('clients') ?>" class="btn btn-secondary">Retour</a>
</div>

<div class="page-body animate-in">
    <div class="card">
        <div class="card-body">
            <form method="POST" action="<?= url($page) ?>">
                <input type="hidden" name="action" value="client-save">
                <?php if ($editMode): ?>
                    <input type="hidden" name="id" value="<?= $client['id'] ?>">
                <?php endif; ?>

                <div class="form-section">
                    <div class="form-section-title">Identité</div>
                    <div class="form-row form-row-3">
                        <div class="form-group">
                            <label class="form-label">Nom <span class="required">*</span></label>
                            <input type="text" name="nom" class="form-control" required value="<?= e($client['nom'] ?? '') ?>">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Prénom <span class="required">*</span></label>
                            <input type="text" name="prenom" class="form-control" required value="<?= e($client['prenom'] ?? '') ?>">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Date de naissance</label>
                            <input type="date" name="date_naissance" class="form-control" value="<?= e($client['date_naissance'] ?? '') ?>">
                        </div>
                    </div>
                    <div class="form-row form-row-3">
                        <div class="form-group">
                            <label class="form-label">Sexe</label>
                            <select name="sexe" class="form-control">
                                <option value="">-</option>
                                <option value="femme" <?= ($client['sexe'] ?? '') === 'femme' ? 'selected' : '' ?>>Femme</option>
                                <option value="homme" <?= ($client['sexe'] ?? '') === 'homme' ? 'selected' : '' ?>>Homme</option>
                                <option value="autre" <?= ($client['sexe'] ?? '') === 'autre' ? 'selected' : '' ?>>Autre</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Profession</label>
                            <input type="text" name="profession" class="form-control" value="<?= e($client['profession'] ?? '') ?>">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Lieu de vie</label>
                            <input type="text" name="lieu_de_vie" class="form-control" placeholder="Ex: Appartement en ville" value="<?= e($client['lieu_de_vie'] ?? '') ?>">
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <div class="form-section-title">Coordonnées</div>
                    <div class="form-row form-row-3">
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="<?= e($client['email'] ?? '') ?>">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Téléphone</label>
                            <input type="tel" name="telephone" class="form-control" value="<?= e($client['telephone'] ?? '') ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Adresse</label>
                        <textarea name="adresse" class="form-control" rows="2"><?= e($client['adresse'] ?? '') ?></textarea>
                    </div>
                </div>

                <div class="form-section">
                    <div class="form-section-title">Informations complémentaires</div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Taille (cm)</label>
                            <input type="number" name="taille_cm" class="form-control" value="<?= e($client['taille_cm'] ?? '') ?>">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Poids (kg)</label>
                            <input type="number" step="0.1" name="poids_kg" class="form-control" value="<?= e($client['poids_kg'] ?? '') ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Notes</label>
                        <textarea name="notes" class="form-control" rows="3" placeholder="Notes internes sur le client..."><?= e($client['notes'] ?? '') ?></textarea>
                    </div>
                </div>

                <div class="d-flex justify-between" style="margin-top: 1.5rem;">
                    <a href="<?= url('clients') ?>" class="btn btn-secondary">Annuler</a>
                    <button type="submit" class="btn btn-primary btn-lg">
                        <?= $editMode ? 'Enregistrer les modifications' : 'Créer le client' ?>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
