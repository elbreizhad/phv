<?php /** @var callable $r */ /** @var callable $cb */ ?>
<div class="card v2-section">
    <div class="card-header"><h3>🥗 Journal alimentaire (dernières 24 h)</h3></div>
    <div class="card-body">
        <table class="v2-family-table">
            <thead><tr><th style="width:25%;">Repas</th><th style="width:15%;">Heure</th><th>Composition</th></tr></thead>
            <tbody>
                <?php
                $repas = [
                    'pdj' => '🌅 Petit-déjeuner',
                    'coll_matin' => '🍎 Collation matin',
                    'dej' => '☀️ Déjeuner',
                    'coll_apm' => '🍵 Collation après-midi',
                    'diner' => '🌙 Dîner',
                    'grignotage' => '🍪 Grignotage',
                ];
                foreach ($repas as $k => $label): ?>
                <tr>
                    <td><?= $label ?></td>
                    <td><input type="time" name="alim_<?= $k ?>_heure" class="form-control" style="padding:.2rem;" value="<?= e($r('alim_' . $k . '_heure')) ?>"></td>
                    <td><input type="text" name="alim_<?= $k ?>_compo" class="form-control" style="padding:.2rem;" value="<?= e($r('alim_' . $k . '_compo')) ?>"></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="form-group" style="margin-top:1rem;">
            <label class="form-label">Auto-évaluation alimentation / 10</label>
            <div class="v2-scale">
                <?php for ($i = 1; $i <= 10; $i++): ?>
                <label><input type="radio" name="alim_auto_eval" value="<?= $i ?>" <?= (string)$r('alim_auto_eval') === (string)$i ? 'checked' : '' ?>><span><?= $i ?></span></label>
                <?php endfor; ?>
            </div>
        </div>
    </div>
</div>

<div class="card v2-section">
    <div class="card-header"><h3>Groupes alimentaires</h3></div>
    <div class="card-body">
        <div class="v2-grid-2">
            <div>
                <div class="v2-group-title">Gluten</div>
                <?php foreach (['Quotidien', 'Occasionnel', 'Sans gluten'] as $v): ?>
                <label class="form-check"><input type="radio" name="aliment_gluten" value="<?= $v ?>" <?= $r('aliment_gluten') === $v ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">Céréales</div>
                <?php foreach (['Complètes', 'Semi-complètes', 'Raffinées'] as $v): ?>
                <label class="form-check"><input type="checkbox" name="aliment_cereales_cb[]" value="<?= $v ?>" <?= $cb('aliment_cereales', $v) ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">Viande</div>
                <?php foreach (['Blanche', 'Rouge', 'Charcuterie'] as $v): ?>
                <label class="form-check"><input type="checkbox" name="aliment_viande_cb[]" value="<?= $v ?>" <?= $cb('aliment_viande', $v) ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
                <div class="form-group" style="margin-top:.3rem;"><label class="form-label">Fréquence</label><input type="text" name="aliment_viande_freq" class="form-control" value="<?= e($r('aliment_viande_freq')) ?>"></div>
            </div>
            <div>
                <div class="v2-group-title">Poisson</div>
                <?php foreach (['Blanc', 'Gras (saumon, sardine…)'] as $v): ?>
                <label class="form-check"><input type="checkbox" name="aliment_poisson_cb[]" value="<?= $v ?>" <?= $cb('aliment_poisson', $v) ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
                <div class="form-group" style="margin-top:.3rem;"><label class="form-label">Fréquence</label><input type="text" name="aliment_poisson_freq" class="form-control" value="<?= e($r('aliment_poisson_freq')) ?>"></div>
            </div>
            <div>
                <div class="v2-group-title">Oméga-3</div>
                <?php foreach (['Poisson gras', 'Noix', 'Graines lin/chia', 'Huile lin/colza', 'ABSENTS ⚠️'] as $v): ?>
                <label class="form-check"><input type="checkbox" name="aliment_omega3_cb[]" value="<?= $v ?>" <?= $cb('aliment_omega3', $v) ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">Légumes / Fruits</div>
                <?php foreach (['Légumes quotidiens', 'Insuffisants', 'Fruits quotidiens', 'Peu / pas', 'Bio', 'De saison', 'Crus'] as $v): ?>
                <label class="form-check"><input type="checkbox" name="aliment_legumes_cb[]" value="<?= $v ?>" <?= $cb('aliment_legumes', $v) ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">Produits laitiers</div>
                <?php foreach (['Vache', 'Brebis', 'Chèvre', 'Lait végétal'] as $v): ?>
                <label class="form-check"><input type="checkbox" name="aliment_laitiers_cb[]" value="<?= $v ?>" <?= $cb('aliment_laitiers', $v) ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">Légumineuses / Oléagineux</div>
                <?php foreach (['Réguliers', 'Occasionnels', 'Absents'] as $v): ?>
                <label class="form-check"><input type="radio" name="aliment_legum_ole" value="<?= $v ?>" <?= $r('aliment_legum_ole') === $v ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">Junkfood / fast-food</div>
                <?php foreach (['Jamais', 'Occasionnel', 'Fréquent'] as $v): ?>
                <label class="form-check"><input type="radio" name="aliment_junkfood" value="<?= $v ?>" <?= $r('aliment_junkfood') === $v ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">Sucre / produits sucrés</div>
                <?php foreach (['Peu', 'Modéré', 'Excès', 'Envies compulsives', 'Fringales'] as $v): ?>
                <label class="form-check"><input type="checkbox" name="aliment_sucre_cb[]" value="<?= $v ?>" <?= $cb('aliment_sucre', $v) ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<div class="card v2-section">
    <div class="card-header"><h3>Matières grasses, boissons & comportement</h3></div>
    <div class="card-body">
        <div class="v2-grid-2">
            <div class="form-group"><label class="form-label">Huile de cuisson</label><input type="text" name="huile_cuisson" class="form-control" value="<?= e($r('huile_cuisson')) ?>"></div>
            <div class="form-group"><label class="form-label">Huile d'assaisonnement</label><input type="text" name="huile_assais" class="form-control" value="<?= e($r('huile_assais')) ?>"></div>
        </div>
        <div class="v2-group-title">Critères huiles</div>
        <?php foreach (['Bio', 'Vierge', '1ère pression à froid'] as $v): ?>
        <label class="form-check" style="display:inline-block;margin-right:1rem;"><input type="checkbox" name="huile_criteres_cb[]" value="<?= $v ?>" <?= $cb('huile_criteres', $v) ? 'checked' : '' ?>><label><?= $v ?></label></label>
        <?php endforeach; ?>

        <div class="v2-group-title">Boissons — fréquence</div>
        <table class="v2-family-table">
            <thead><tr><th>Boisson</th><th>Fréquence</th></tr></thead>
            <tbody>
            <?php foreach (['cafe' => 'Café', 'the' => 'Thé', 'infusion' => 'Infusion', 'soda' => 'Soda', 'alcool' => 'Alcool'] as $k => $label): ?>
                <tr><td><?= $label ?></td><td><input type="text" name="boisson_<?= $k ?>" class="form-control" style="padding:.2rem;" value="<?= e($r('boisson_' . $k)) ?>"></td></tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <div class="v2-grid-2" style="margin-top:1rem;">
            <div>
                <div class="v2-group-title">Contexte des repas</div>
                <?php foreach (['À table', 'Debout', 'Écran', 'En famille', 'Seul(e)', 'En travaillant'] as $v): ?>
                <label class="form-check"><input type="checkbox" name="repas_contexte_cb[]" value="<?= $v ?>" <?= $cb('repas_contexte', $v) ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">Vitesse / Mastication</div>
                <?php foreach (['Lentement', 'Moyen', 'Vite'] as $v): ?>
                <label class="form-check"><input type="radio" name="repas_vitesse" value="<?= $v ?>" <?= $r('repas_vitesse') === $v ? 'checked' : '' ?>><label>Vitesse : <?= $v ?></label></label>
                <?php endforeach; ?>
                <?php foreach (['Bonne', 'Insuffisante'] as $v): ?>
                <label class="form-check"><input type="radio" name="repas_mastication" value="<?= $v ?>" <?= $r('repas_mastication') === $v ? 'checked' : '' ?>><label>Mastication : <?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">Grignotage</div>
                <?php foreach (['Non', 'Stress', 'Ennui', 'Habitude'] as $v): ?>
                <label class="form-check"><input type="radio" name="grignotage_cause" value="<?= $v ?>" <?= $r('grignotage_cause') === $v ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">Appétit / Cuisiner</div>
                <?php foreach (['Bon', 'Moyen', 'Mauvais'] as $v): ?>
                <label class="form-check"><input type="radio" name="appetit" value="<?= $v ?>" <?= $r('appetit') === $v ? 'checked' : '' ?>><label>Appétit : <?= $v ?></label></label>
                <?php endforeach; ?>
                <?php foreach (["J'aime", "Je n'aime pas", 'Ne sait pas'] as $v): ?>
                <label class="form-check"><input type="radio" name="cuisiner" value="<?= $v ?>" <?= $r('cuisiner') === $v ? 'checked' : '' ?>><label>Cuisiner : <?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="form-group" style="margin-top:1rem;">
            <label class="form-label">Régime particulier / restrictions / allergies alimentaires</label>
            <textarea name="regime_restrictions" class="form-control" rows="2"><?= e($r('regime_restrictions')) ?></textarea>
        </div>
    </div>
</div>
