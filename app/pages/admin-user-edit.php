<?php
/**
 * Administration - Créer / modifier un praticien
 */
$db = getDB();
$userId = (int) getGet('id');

$editedUser = null;
if ($userId) {
    $stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$userId]);
    $editedUser = $stmt->fetch();
    if (!$editedUser) {
        flashSet('error', 'Praticien introuvable.');
        redirect('admin-users');
    }
}
$isEdit = $editedUser !== null;
?>

<div class="page-header">
    <div>
        <h1><?= $isEdit ? 'Modifier le praticien' : 'Nouveau praticien' ?></h1>
        <p class="subtitle"><?= $isEdit ? e($editedUser['prenom'] . ' ' . $editedUser['nom']) : 'Créer un nouveau compte praticien' ?></p>
    </div>
    <a href="<?= url('admin-users') ?>" class="btn btn-secondary">Retour</a>
</div>

<div class="page-body animate-in">
    <div class="card" style="max-width: 640px;">
        <div class="card-body">
            <form method="POST">
                <input type="hidden" name="action" value="admin-user-save">
                <input type="hidden" name="user_id" value="<?= $userId ?>">

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Prénom <span class="required">*</span></label>
                        <input type="text" name="prenom" class="form-control" required value="<?= e($editedUser['prenom'] ?? '') ?>">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nom <span class="required">*</span></label>
                        <input type="text" name="nom" class="form-control" required value="<?= e($editedUser['nom'] ?? '') ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Identifiant de connexion <span class="required">*</span></label>
                    <input type="text" name="username" class="form-control" required value="<?= e($editedUser['username'] ?? '') ?>">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="<?= e($editedUser['email'] ?? '') ?>">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Téléphone</label>
                        <input type="text" name="telephone" class="form-control" value="<?= e($editedUser['telephone'] ?? '') ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Rôle</label>
                    <select name="role" class="form-control" <?= $isEdit && $editedUser['id'] == currentUserId() ? 'disabled' : '' ?>>
                        <option value="praticien" <?= ($editedUser['role'] ?? 'praticien') === 'praticien' ? 'selected' : '' ?>>Praticien</option>
                        <option value="admin" <?= ($editedUser['role'] ?? '') === 'admin' ? 'selected' : '' ?>>Administrateur</option>
                    </select>
                    <?php if ($isEdit && $editedUser['id'] == currentUserId()): ?>
                        <input type="hidden" name="role" value="<?= e($editedUser['role']) ?>">
                        <p class="text-sm text-muted mt-1">Vous ne pouvez pas changer votre propre rôle.</p>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label class="form-label"><?= $isEdit ? 'Nouveau mot de passe' : 'Mot de passe' ?> <?= $isEdit ? '' : '<span class="required">*</span>' ?></label>
                    <input type="password" name="password" class="form-control" <?= $isEdit ? '' : 'required' ?> placeholder="<?= $isEdit ? 'Laisser vide pour ne pas changer' : '' ?>" autocomplete="new-password">
                </div>

                <button type="submit" class="btn btn-primary mt-2"><?= $isEdit ? 'Enregistrer' : 'Créer le praticien' ?></button>
            </form>
        </div>
    </div>
</div>
