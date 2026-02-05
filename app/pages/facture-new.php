<?php
/**
 * Nouvelle facture
 */
$db = getDB();
$userId = currentUserId();

// Clients
$clientsStmt = $db->prepare("SELECT id, nom, prenom FROM clients WHERE user_id = ? ORDER BY nom, prenom");
$clientsStmt->execute([$userId]);
$clients = $clientsStmt->fetchAll();

// Prestations
$prestationsStmt = $db->prepare("SELECT * FROM prestations WHERE user_id = ? AND actif = 1 ORDER BY nom");
$prestationsStmt->execute([$userId]);
$prestations = $prestationsStmt->fetchAll();

// Paramètres utilisateur pour les mentions légales
$settingsStmt = $db->prepare("SELECT * FROM user_settings WHERE user_id = ?");
$settingsStmt->execute([$userId]);
$settings = $settingsStmt->fetch() ?: [];

// Prochain numéro de facture
$year = date('Y');
$lastFacture = $db->prepare("SELECT numero_facture FROM factures WHERE user_id = ? AND YEAR(date_facture) = ? ORDER BY id DESC LIMIT 1");
$lastFacture->execute([$userId, $year]);
$last = $lastFacture->fetchColumn();
if ($last && preg_match('/(\d+)$/', $last, $matches)) {
    $nextNum = (int)$matches[1] + 1;
} else {
    $nextNum = 1;
}
$numeroFacture = 'F' . $year . '-' . str_pad($nextNum, 4, '0', STR_PAD_LEFT);

// Client pré-sélectionné
$clientId = getGet('client_id', '');
$consultationId = getGet('consultation_id', '');
?>

<div class="page-header">
    <div>
        <h1>Nouvelle facture</h1>
        <p class="subtitle"><?= e($numeroFacture) ?></p>
    </div>
    <a href="<?= url('factures') ?>" class="btn btn-secondary">Retour</a>
</div>

<div class="page-body animate-in">
    <form method="POST" action="<?= url('factures') ?>" id="facture-form">
        <input type="hidden" name="action" value="facture-save">
        <input type="hidden" name="numero_facture" value="<?= e($numeroFacture) ?>">
        <input type="hidden" name="consultation_id" value="<?= e($consultationId) ?>">

        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem;">
            <!-- Informations principales -->
            <div class="card">
                <div class="card-header">
                    <h3>Informations</h3>
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Client <span class="required">*</span></label>
                            <select name="client_id" id="client_id" class="form-control" required>
                                <option value="">-- Sélectionner --</option>
                                <?php foreach ($clients as $c): ?>
                                    <option value="<?= $c['id'] ?>" <?= $clientId == $c['id'] ? 'selected' : '' ?>><?= e($c['prenom'] . ' ' . $c['nom']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Date facture <span class="required">*</span></label>
                            <input type="date" name="date_facture" class="form-control" required value="<?= date('Y-m-d') ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Date d'échéance</label>
                            <input type="date" name="date_echeance" class="form-control" value="<?= date('Y-m-d', strtotime('+30 days')) ?>">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Mode de paiement</label>
                            <select name="mode_paiement" class="form-control">
                                <option value="">-- Non défini --</option>
                                <?php foreach (MODES_PAIEMENT as $key => $label): ?>
                                    <option value="<?= $key ?>"><?= $label ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Résumé -->
            <div class="card">
                <div class="card-header">
                    <h3>Total</h3>
                </div>
                <div class="card-body">
                    <div class="total-summary">
                        <div class="total-row">
                            <span>Sous-total HT</span>
                            <span id="total-ht">0,00 €</span>
                        </div>
                        <div class="total-row">
                            <span>TVA (<span id="tva-rate">0</span>%)</span>
                            <span id="total-tva">0,00 €</span>
                        </div>
                        <div class="total-row total-final">
                            <span>Total TTC</span>
                            <span id="total-ttc">0,00 €</span>
                        </div>
                    </div>
                    <input type="hidden" name="montant_ht" id="montant_ht" value="0">
                    <input type="hidden" name="montant_tva" id="montant_tva" value="0">
                    <input type="hidden" name="montant_ttc" id="montant_ttc" value="0">
                </div>
            </div>
        </div>

        <!-- Lignes de facture -->
        <div class="card mt-2">
            <div class="card-header">
                <h3>Prestations</h3>
                <button type="button" class="btn btn-outline btn-sm" onclick="addLigne()">+ Ajouter une ligne</button>
            </div>
            <div class="card-body">
                <!-- Ajout rapide depuis prestations -->
                <?php if (!empty($prestations)): ?>
                <div class="quick-add mb-2">
                    <label class="form-label">Ajout rapide :</label>
                    <div class="d-flex gap-1 flex-wrap">
                        <?php foreach ($prestations as $p): ?>
                            <button type="button" class="btn btn-outline btn-sm" onclick="addPrestation(<?= htmlspecialchars(json_encode($p)) ?>)">
                                <?= e($p['nom']) ?> (<?= number_format($p['tarif'], 2, ',', ' ') ?> €)
                            </button>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <table class="table" id="lignes-table">
                    <thead>
                        <tr>
                            <th style="width: 50%;">Description</th>
                            <th style="width: 15%;">Quantité</th>
                            <th style="width: 15%;">Prix unitaire</th>
                            <th style="width: 15%;">Montant</th>
                            <th style="width: 5%;"></th>
                        </tr>
                    </thead>
                    <tbody id="lignes-body">
                        <!-- Lignes ajoutées dynamiquement -->
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Notes -->
        <div class="card mt-2">
            <div class="card-header">
                <h3>Notes et mentions</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Notes (visible sur la facture)</label>
                    <textarea name="notes" class="form-control" rows="2" placeholder="Notes pour le client..."></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Mentions légales</label>
                    <textarea name="mentions_legales" class="form-control" rows="3"><?= e($settings['mentions_facture'] ?? 'Naturopathe certifié - Non conventionné - Règlement à réception') ?></textarea>
                </div>
            </div>
        </div>

        <div class="form-actions mt-2 d-flex justify-between">
            <a href="<?= url('factures') ?>" class="btn btn-secondary">Annuler</a>
            <div class="d-flex gap-1">
                <button type="submit" name="statut" value="brouillon" class="btn btn-outline">Enregistrer brouillon</button>
                <button type="submit" name="statut" value="envoyee" class="btn btn-primary">Créer et marquer envoyée</button>
            </div>
        </div>
    </form>
</div>

<style>
.total-summary { display: flex; flex-direction: column; gap: 0.5rem; }
.total-row { display: flex; justify-content: space-between; padding: 0.5rem 0; }
.total-final { border-top: 2px solid var(--sage-300); padding-top: 1rem; margin-top: 0.5rem; font-size: 1.2rem; font-weight: 700; color: var(--sage-700); }
.quick-add { padding: 1rem; background: var(--cream-50); border-radius: var(--radius-sm); }
</style>

<script>
let ligneIndex = 0;

function addLigne(description = '', quantite = 1, prix = 0) {
    const tbody = document.getElementById('lignes-body');
    const tr = document.createElement('tr');
    tr.innerHTML = `
        <td><input type="text" name="lignes[${ligneIndex}][description]" class="form-control" value="${description}" required></td>
        <td><input type="number" name="lignes[${ligneIndex}][quantite]" class="form-control ligne-qte" value="${quantite}" min="1" step="0.5" onchange="calculateTotals()"></td>
        <td><input type="number" name="lignes[${ligneIndex}][prix]" class="form-control ligne-prix" value="${prix}" min="0" step="0.01" onchange="calculateTotals()"></td>
        <td class="ligne-montant" style="font-weight: 600; text-align: right;">${(quantite * prix).toFixed(2)} €</td>
        <td><button type="button" class="btn btn-danger btn-sm" onclick="removeLigne(this)">&times;</button></td>
    `;
    tbody.appendChild(tr);
    ligneIndex++;
    calculateTotals();
}

function addPrestation(prestation) {
    addLigne(prestation.nom, 1, parseFloat(prestation.tarif));
}

function removeLigne(btn) {
    btn.closest('tr').remove();
    calculateTotals();
}

function calculateTotals() {
    const rows = document.querySelectorAll('#lignes-body tr');
    let totalHT = 0;

    rows.forEach(row => {
        const qte = parseFloat(row.querySelector('.ligne-qte').value) || 0;
        const prix = parseFloat(row.querySelector('.ligne-prix').value) || 0;
        const montant = qte * prix;
        row.querySelector('.ligne-montant').textContent = montant.toFixed(2) + ' €';
        totalHT += montant;
    });

    const tauxTva = 0; // Naturopathes généralement non assujettis
    const totalTva = totalHT * (tauxTva / 100);
    const totalTTC = totalHT + totalTva;

    document.getElementById('total-ht').textContent = totalHT.toFixed(2).replace('.', ',') + ' €';
    document.getElementById('total-tva').textContent = totalTva.toFixed(2).replace('.', ',') + ' €';
    document.getElementById('total-ttc').textContent = totalTTC.toFixed(2).replace('.', ',') + ' €';
    document.getElementById('tva-rate').textContent = tauxTva;

    document.getElementById('montant_ht').value = totalHT.toFixed(2);
    document.getElementById('montant_tva').value = totalTva.toFixed(2);
    document.getElementById('montant_ttc').value = totalTTC.toFixed(2);
}

// Ajouter une ligne vide par défaut
addLigne('Consultation naturopathie', 1, 70);
</script>
