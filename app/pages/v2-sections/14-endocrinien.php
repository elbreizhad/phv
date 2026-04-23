<?php /** @var callable $r */ /** @var callable $cb */ /** @var array $consultation */
$sexe = $consultation['client_sexe'] ?? '';
?>
<div class="card v2-section">
    <div class="card-header"><h3>🔬 Thyroïde & surrénales ★</h3></div>
    <div class="card-body">
        <div class="v2-grid-2">
            <div>
                <div class="v2-group-title">Surrénales (fatigue)</div>
                <?php foreach (['Non', 'Suspicion', 'Confirmé'] as $v): ?>
                <label class="form-check"><input type="radio" name="surrenales" value="<?= $v ?>" <?= $r('surrenales') === $v ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">Thyroïde ★</div>
                <?php foreach (['Aucun trouble connu', 'Suspicion à explorer', 'Hypothyroïdie confirmée', 'Hyperthyroïdie confirmée', 'Hashimoto (auto-immune)'] as $v): ?>
                <label class="form-check"><input type="radio" name="thyroide" value="<?= $v ?>" <?= $r('thyroide') === $v ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">Bilans réalisés</div>
                <?php foreach (['TSH seule ⚠️ insuffisant', 'TSH + T3L + T4L', 'Anti-TPO / Anti-TG dosés', 'Aucun bilan'] as $v): ?>
                <label class="form-check"><input type="checkbox" name="thyroide_bilan_cb[]" value="<?= $v ?>" <?= $cb('thyroide_bilan', $v) ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">Signes d'hypothyroïdie ★</div>
                <?php foreach (['Fatigue matinale chronique', 'Frilosité / extrémités froides', 'Prise de poids inexpliquée', 'Peau sèche / chute cheveux', 'Constipation', 'Lenteur psychomotrice'] as $v): ?>
                <label class="form-check"><input type="checkbox" name="hypo_signes_cb[]" value="<?= $v ?>" <?= $cb('hypo_signes', $v) ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="v2-group-title">Glycémie / pancréas</div>
        <div class="v2-checkbox-grid">
            <?php foreach (['Pas de trouble', 'Résistance à l\'insuline', 'Diabète T1', 'Diabète T2', 'Hypoglycémies réactionnelles'] as $v): ?>
            <label><input type="checkbox" name="glycemie_cb[]" value="<?= $v ?>" <?= $cb('glycemie', $v) ? 'checked' : '' ?>> <?= $v ?></label>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php if ($sexe === 'femme' || $sexe === ''): ?>
<div class="card v2-section">
    <div class="card-header"><h3>♀ Féminin — cycle, contraception, SOPK, post-partum ★</h3></div>
    <div class="card-body">
        <div class="v2-grid-2">
            <div>
                <div class="v2-group-title">Contraception</div>
                <?php foreach (['Aucune', 'Pilule', 'Stérilet cuivre', 'Stérilet hormonal', 'Implant', 'Méthode naturelle'] as $v): ?>
                <label class="form-check"><input type="radio" name="contraception" value="<?= $v ?>" <?= $r('contraception') === $v ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">Cycle</div>
                <?php foreach (['Régulier', 'Irrégulier'] as $v): ?>
                <label class="form-check"><input type="radio" name="cycle_regul" value="<?= $v ?>" <?= $r('cycle_regul') === $v ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
                <div class="form-group" style="margin-top:.3rem;"><label class="form-label">Durée du cycle (jours)</label><input type="text" name="cycle_duree" class="form-control" value="<?= e($r('cycle_duree')) ?>"></div>
            </div>
            <div>
                <div class="v2-group-title">Règles</div>
                <?php foreach (['Normales', 'Faibles', 'Abondantes', 'Douloureuses', 'Non douloureuses', 'Spotting (saignements inter-menstruels) ★'] as $v): ?>
                <label class="form-check"><input type="checkbox" name="regles_cb[]" value="<?= $v ?>" <?= $cb('regles', $v) ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">SPM</div>
                <?php foreach (['Aucun', 'Modéré', 'Marqué'] as $v): ?>
                <label class="form-check"><input type="radio" name="spm_niveau" value="<?= $v ?>" <?= $r('spm_niveau') === $v ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
                <?php foreach (['Douleurs ventre', 'Douleurs seins', 'Troubles humeur', 'Libido'] as $v): ?>
                <label class="form-check"><input type="checkbox" name="spm_signes_cb[]" value="<?= $v ?>" <?= $cb('spm_signes', $v) ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">SOPK ★</div>
                <?php foreach (['Non', 'Diagnostiqué', 'Suspecté'] as $v): ?>
                <label class="form-check"><input type="radio" name="sopk" value="<?= $v ?>" <?= $r('sopk') === $v ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
                <?php foreach (['Acné hormonale ★', 'Hirsutisme'] as $v): ?>
                <label class="form-check"><input type="checkbox" name="sopk_signes_cb[]" value="<?= $v ?>" <?= $cb('sopk_signes', $v) ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">Post-partum ★</div>
                <?php foreach (['Grossesse difficile (émotionnellement)', 'Dépression post-partum', 'Psoriasis / eczéma apparu post-partum', 'Allaitement long / épuisant'] as $v): ?>
                <label class="form-check"><input type="checkbox" name="postpartum_cb[]" value="<?= $v ?>" <?= $cb('postpartum', $v) ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">Ménopause</div>
                <?php foreach (['Non', 'Péri-ménopause', 'Ménopause'] as $v): ?>
                <label class="form-check"><input type="radio" name="menopause" value="<?= $v ?>" <?= $r('menopause') === $v ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
                <?php foreach (['Bouffées de chaleur', 'Sueurs nocturnes'] as $v): ?>
                <label class="form-check"><input type="checkbox" name="menopause_signes_cb[]" value="<?= $v ?>" <?= $cb('menopause_signes', $v) ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?php if ($sexe === 'homme' || $sexe === ''): ?>
<div class="card v2-section">
    <div class="card-header"><h3>♂ Masculin</h3></div>
    <div class="card-body">
        <div class="v2-checkbox-grid">
            <?php foreach (['Andropause', 'Troubles érectiles', 'Autres troubles sexuels'] as $v): ?>
            <label><input type="checkbox" name="masculin_cb[]" value="<?= $v ?>" <?= $cb('masculin', $v) ? 'checked' : '' ?>> <?= $v ?></label>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endif; ?>

<div class="card v2-section">
    <div class="card-body">
        <div class="form-group">
            <label class="form-label">Observations hormonales complémentaires</label>
            <textarea name="endo_obs" class="form-control" rows="2"><?= e($r('endo_obs')) ?></textarea>
        </div>
    </div>
</div>
