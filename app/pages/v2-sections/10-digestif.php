<?php /** @var callable $r */ /** @var callable $cb */ ?>
<div class="card v2-section">
    <div class="card-header"><h3>🫁 Transit & selles</h3></div>
    <div class="card-body">
        <div class="v2-grid-2">
            <div>
                <div class="v2-group-title">Fréquence des selles</div>
                <?php foreach (['1×/jour (idéal)', '2×+/jour', '1×/2 jours', '2×/semaine', 'Constipation chronique'] as $v): ?>
                <label class="form-check"><input type="radio" name="dig_selles_freq" value="<?= $v ?>" <?= $r('dig_selles_freq') === $v ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">Consistance</div>
                <?php foreach (['Moulées (idéal)', 'Molles', 'Dures/sèches', 'Liquides / diarrhée'] as $v): ?>
                <label class="form-check"><input type="radio" name="dig_selles_consistance" value="<?= $v ?>" <?= $r('dig_selles_consistance') === $v ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">Couleur</div>
                <?php foreach (['Marron normal', 'Clair', 'Noir', 'Rouge'] as $v): ?>
                <label class="form-check"><input type="radio" name="dig_selles_couleur" value="<?= $v ?>" <?= $r('dig_selles_couleur') === $v ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">Selles collantes</div>
                <?php foreach (['Non', 'Oui → signe foie'] as $v): ?>
                <label class="form-check"><input type="radio" name="dig_selles_collantes" value="<?= $v ?>" <?= $r('dig_selles_collantes') === $v ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<div class="card v2-section">
    <div class="card-header"><h3>Symptômes digestifs</h3></div>
    <div class="card-body">
        <div class="v2-grid-2">
            <div>
                <div class="v2-group-title">Estomac</div>
                <?php foreach (['RGO', 'Brûlures', 'Éructations', 'Lenteur digestive', 'Douleur'] as $v): ?>
                <label class="form-check"><input type="checkbox" name="dig_estomac_cb[]" value="<?= $v ?>" <?= $cb('dig_estomac', $v) ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">Intestins</div>
                <?php foreach (['Ballonnements', 'Douleurs abdominales', 'Gaz malodorants', 'Spasmes'] as $v): ?>
                <label class="form-check"><input type="checkbox" name="dig_intestins_cb[]" value="<?= $v ?>" <?= $cb('dig_intestins', $v) ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">Foie / Vésicule biliaire</div>
                <?php foreach (['Lourdeur après repas', 'Nausées', 'Maux de tête post-repas'] as $v): ?>
                <label class="form-check"><input type="checkbox" name="dig_foie_cb[]" value="<?= $v ?>" <?= $cb('dig_foie', $v) ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">Somnolence postprandiale</div>
                <?php foreach (['Non', 'Parfois', 'Systématique'] as $v): ?>
                <label class="form-check"><input type="radio" name="dig_somnolence" value="<?= $v ?>" <?= $r('dig_somnolence') === $v ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Compatibilité v1 : on remplit aussi dig_troubles pour que step6 (prefill PHV) fonctionne -->
        <input type="hidden" name="dig_troubles" value="<?= e(trim(implode(', ', array_filter([
            implode(' ', explode(',', $r('dig_estomac'))),
            implode(' ', explode(',', $r('dig_intestins'))),
            implode(' ', explode(',', $r('dig_foie'))),
        ])))) ?>">
    </div>
</div>

<div class="card v2-section">
    <div class="card-header"><h3>Signes d'émonctoires — bouche, peau, transpiration</h3></div>
    <div class="card-body">
        <div class="v2-grid-3">
            <div>
                <div class="v2-group-title">🗣️ Bouche & langue</div>
                <?php foreach (['Caries', 'Aphtes', 'Gencives saignantes', 'Langue chargée/blanche', 'Haleine chargée'] as $v): ?>
                <label class="form-check"><input type="checkbox" name="emonc_bouche_cb[]" value="<?= $v ?>" <?= $cb('emonc_bouche', $v) ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">👁️ Teint & peau</div>
                <?php foreach (['Teint brouillé / gris', 'Cernes marqués', 'Acné / éruptions', 'Psoriasis / eczéma'] as $v): ?>
                <label class="form-check"><input type="checkbox" name="emonc_teint_cb[]" value="<?= $v ?>" <?= $cb('emonc_teint', $v) ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">💦 Transpiration</div>
                <?php foreach (['Transpiration abondante', 'Transpire peu / pas ⚠️', 'Odeurs marquées', 'Sueurs nocturnes'] as $v): ?>
                <label class="form-check"><input type="checkbox" name="emonc_transpi_cb[]" value="<?= $v ?>" <?= $cb('emonc_transpi', $v) ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="form-group" style="margin-top:1rem;">
            <label class="form-label">Observations digestives complémentaires</label>
            <textarea name="dig_obs" class="form-control" rows="2"><?= e($r('dig_obs')) ?></textarea>
        </div>
    </div>
</div>
