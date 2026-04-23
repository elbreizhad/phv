<?php
/**
 * Paramètres du cabinet
 */
$db = getDB();
$userId = currentUserId();

// Récupérer les paramètres
$settingsStmt = $db->prepare("SELECT * FROM user_settings WHERE user_id = ?");
$settingsStmt->execute([$userId]);
$settings = $settingsStmt->fetch() ?: [];

// Info utilisateur
$userStmt = $db->prepare("SELECT * FROM users WHERE id = ?");
$userStmt->execute([$userId]);
$user = $userStmt->fetch();

// Prestations
$prestationsStmt = $db->prepare("SELECT * FROM prestations WHERE user_id = ? ORDER BY nom");
$prestationsStmt->execute([$userId]);
$prestations = $prestationsStmt->fetchAll();
?>

<div class="page-header">
    <div>
        <h1>Paramètres</h1>
        <p class="subtitle">Configuration de votre cabinet</p>
    </div>
</div>

<div class="page-body animate-in">
    <!-- Onglets -->
    <div class="tabs mb-2">
        <button class="tab-btn active" data-tab="cabinet">Cabinet</button>
        <button class="tab-btn" data-tab="prestations">Prestations</button>
        <button class="tab-btn" data-tab="profil">Mon profil</button>
    </div>

    <!-- Tab Cabinet -->
    <div class="tab-content active" id="tab-cabinet">
        <form method="POST">
            <input type="hidden" name="action" value="settings-save">
            <input type="hidden" name="tab" value="cabinet">

            <div class="card mb-2">
                <div class="card-header">
                    <h3>Identité du cabinet</h3>
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Nom du cabinet</label>
                            <input type="text" name="nom_cabinet" class="form-control" value="<?= e($settings['nom_cabinet'] ?? '') ?>" placeholder="Cabinet de Naturopathie">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Site web</label>
                            <input type="url" name="site_web" class="form-control" value="<?= e($settings['site_web'] ?? '') ?>" placeholder="https://...">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Adresse du cabinet</label>
                        <textarea name="adresse_cabinet" class="form-control" rows="2"><?= e($settings['adresse_cabinet'] ?? '') ?></textarea>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Téléphone cabinet</label>
                            <input type="tel" name="telephone_cabinet" class="form-control" value="<?= e($settings['telephone_cabinet'] ?? '') ?>">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email cabinet</label>
                            <input type="email" name="email_cabinet" class="form-control" value="<?= e($settings['email_cabinet'] ?? '') ?>">
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-2">
                <div class="card-header">
                    <h3>Informations légales</h3>
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">SIRET</label>
                            <input type="text" name="siret" class="form-control" value="<?= e($settings['siret'] ?? $user['siret'] ?? '') ?>">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Code APE</label>
                            <input type="text" name="code_ape" class="form-control" value="<?= e($settings['code_ape'] ?? '') ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Mentions légales sur les factures</label>
                        <textarea name="mentions_facture" class="form-control" rows="3"><?= e($settings['mentions_facture'] ?? 'Naturopathe certifié - Non conventionné - Règlement à réception') ?></textarea>
                    </div>
                </div>
            </div>

            <div class="card mb-2">
                <div class="card-header">
                    <h3>Préférences agenda</h3>
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Première heure</label>
                            <input type="time" name="premiere_heure_agenda" class="form-control" value="<?= e($settings['premiere_heure_agenda'] ?? '08:00') ?>">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Dernière heure</label>
                            <input type="time" name="derniere_heure_agenda" class="form-control" value="<?= e($settings['derniere_heure_agenda'] ?? '20:00') ?>">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Durée RDV par défaut (min)</label>
                            <input type="number" name="duree_rdv_defaut" class="form-control" value="<?= e($settings['duree_rdv_defaut'] ?? '60') ?>">
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-2">
                <div class="card-header">
                    <h3>Trame de consultation</h3>
                </div>
                <div class="card-body">
                    <div style="display:flex; align-items:center; gap:.6rem; padding:.4rem 0;">
                        <input type="checkbox" id="trame_v2_enabled" name="trame_v2_enabled" value="1" <?= !empty($settings['trame_v2_enabled']) ? 'checked' : '' ?> style="width:20px; height:20px; cursor:pointer;">
                        <label for="trame_v2_enabled" style="cursor:pointer; font-weight:500;">Utiliser la trame V2 (15 sections - TaNaturo / ESN)</label>
                    </div>
                    <p class="form-hint">Les nouvelles consultations utiliseront un questionnaire détaillé inspiré du format officiel ESN : premières impressions, antécédents familiaux tabulaires, habitat, journal alimentaire 24h, tégumentaire & endocrinien enrichis, synthèse terrain. Les consultations déjà démarrées conservent leur trame d'origine.</p>
                    <p class="form-hint" style="background:#f3f5ef; padding:.4rem .6rem; border-radius:4px;">
                        État actuel en base : <strong><?= !empty($settings['trame_v2_enabled']) ? '✅ V2 activée' : '⭕ V1 (par défaut)' ?></strong>
                        — user_settings.trame_v2_enabled = <code><?= var_export($settings['trame_v2_enabled'] ?? null, true) ?></code>
                    </p>

                    <?php if (!empty($_SESSION['trame_v2_debug'])): $dbg = $_SESSION['trame_v2_debug']; unset($_SESSION['trame_v2_debug']); ?>
                    <div style="background:#1e1e1e; color:#0f0; padding:.8rem; border-radius:6px; font-family:monospace; font-size:12px; white-space:pre-wrap; margin-top:.6rem;">🐛 DEBUG TRAME V2 (dernier save)
<?php foreach ($dbg as $k => $v): ?>
  <?= str_pad($k, 35) ?> : <?= is_scalar($v) ? var_export($v, true) : json_encode($v, JSON_UNESCAPED_UNICODE) ?>
<?php endforeach; ?>
</div>
                    <?php endif; ?>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Enregistrer les paramètres</button>
        </form>
    </div>

    <!-- Tab Prestations -->
    <div class="tab-content" id="tab-prestations" style="display: none;">
        <div class="card">
            <div class="card-header">
                <h3>Prestations & Tarifs</h3>
                <button type="button" class="btn btn-outline btn-sm" onclick="openPrestationModal()">+ Ajouter</button>
            </div>
            <div class="card-body" style="padding: 0;">
                <?php if (empty($prestations)): ?>
                    <div class="empty-state">
                        <p>Aucune prestation définie.</p>
                        <button type="button" class="btn btn-primary btn-sm" onclick="openPrestationModal()">Ajouter une prestation</button>
                    </div>
                <?php else: ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Prestation</th>
                                <th>Durée</th>
                                <th>Tarif</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($prestations as $p): ?>
                            <tr>
                                <td>
                                    <strong><?= e($p['nom']) ?></strong>
                                    <?php if ($p['description']): ?><br><span class="text-sm text-muted"><?= e($p['description']) ?></span><?php endif; ?>
                                </td>
                                <td><?= $p['duree_minutes'] ?> min</td>
                                <td><strong><?= number_format($p['tarif'], 2, ',', ' ') ?> €</strong></td>
                                <td>
                                    <button type="button" class="btn btn-outline btn-sm" onclick="editPrestation(<?= htmlspecialchars(json_encode($p)) ?>)">Modifier</button>
                                    <form method="POST" style="display: inline;" onsubmit="return confirm('Supprimer cette prestation ?');">
                                        <input type="hidden" name="action" value="prestation-delete">
                                        <input type="hidden" name="prestation_id" value="<?= $p['id'] ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
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

    <!-- Tab Profil -->
    <div class="tab-content" id="tab-profil" style="display: none;">
        <form method="POST">
            <input type="hidden" name="action" value="settings-save">
            <input type="hidden" name="tab" value="profil">

            <div class="card">
                <div class="card-header">
                    <h3>Mon profil</h3>
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Prénom</label>
                            <input type="text" name="prenom" class="form-control" value="<?= e($user['prenom']) ?>">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Nom</label>
                            <input type="text" name="nom" class="form-control" value="<?= e($user['nom']) ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="<?= e($user['email']) ?>">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Téléphone</label>
                            <input type="tel" name="telephone" class="form-control" value="<?= e($user['telephone']) ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Adresse</label>
                        <textarea name="adresse" class="form-control" rows="2"><?= e($user['adresse']) ?></textarea>
                    </div>

                    <hr style="margin: 1.5rem 0;">

                    <h4 style="margin-bottom: 1rem;">Changer le mot de passe</h4>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Nouveau mot de passe</label>
                            <input type="password" name="new_password" class="form-control" placeholder="Laisser vide pour ne pas changer">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Confirmer</label>
                            <input type="password" name="confirm_password" class="form-control">
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-2">Enregistrer mon profil</button>
        </form>
    </div>
</div>

<!-- Modal Prestation -->
<div id="prestation-modal" class="modal" style="display: none;">
    <div class="modal-backdrop" onclick="closePrestationModal()"></div>
    <div class="modal-content" style="max-width: 500px;">
        <div class="modal-header">
            <h3 id="prestation-modal-title">Nouvelle prestation</h3>
            <button type="button" class="modal-close" onclick="closePrestationModal()">&times;</button>
        </div>
        <form method="POST">
            <input type="hidden" name="action" value="prestation-save">
            <input type="hidden" name="prestation_id" id="prestation_id" value="">
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Nom <span class="required">*</span></label>
                    <input type="text" name="nom" id="prestation_nom" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Description</label>
                    <input type="text" name="description" id="prestation_description" class="form-control">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Durée (min)</label>
                        <input type="number" name="duree_minutes" id="prestation_duree" class="form-control" value="60">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tarif (€) <span class="required">*</span></label>
                        <input type="number" name="tarif" id="prestation_tarif" class="form-control" step="0.01" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closePrestationModal()">Annuler</button>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
    </div>
</div>

<style>
.tabs {
    display: flex;
    gap: 0.5rem;
    border-bottom: 2px solid var(--cream-200);
    padding-bottom: 0;
}
.tab-btn {
    padding: 0.7rem 1.5rem;
    background: none;
    border: none;
    cursor: pointer;
    font-weight: 500;
    color: var(--text-muted);
    border-bottom: 2px solid transparent;
    margin-bottom: -2px;
    transition: var(--transition);
}
.tab-btn:hover { color: var(--sage-600); }
.tab-btn.active {
    color: var(--sage-700);
    border-bottom-color: var(--sage-500);
}
</style>

<script>
// Onglets
document.querySelectorAll('.tab-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        document.querySelectorAll('.tab-content').forEach(c => c.style.display = 'none');
        this.classList.add('active');
        document.getElementById('tab-' + this.dataset.tab).style.display = 'block';
    });
});

function openPrestationModal() {
    document.getElementById('prestation-modal-title').textContent = 'Nouvelle prestation';
    document.getElementById('prestation_id').value = '';
    document.getElementById('prestation_nom').value = '';
    document.getElementById('prestation_description').value = '';
    document.getElementById('prestation_duree').value = '60';
    document.getElementById('prestation_tarif').value = '';
    document.getElementById('prestation-modal').style.display = 'flex';
}

function closePrestationModal() {
    document.getElementById('prestation-modal').style.display = 'none';
}

function editPrestation(p) {
    document.getElementById('prestation-modal-title').textContent = 'Modifier la prestation';
    document.getElementById('prestation_id').value = p.id;
    document.getElementById('prestation_nom').value = p.nom;
    document.getElementById('prestation_description').value = p.description || '';
    document.getElementById('prestation_duree').value = p.duree_minutes;
    document.getElementById('prestation_tarif').value = p.tarif;
    document.getElementById('prestation-modal').style.display = 'flex';
}
</script>
