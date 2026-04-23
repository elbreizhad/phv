<?php /** @var callable $r */ /** @var callable $cb */ ?>
<div class="v2-tip">⭐ <strong>Section enrichie — Module 13 Pathologies tégumentaires</strong><br>La peau est un émonctoire majeur. Elle reflète l'état du terrain (inflammation, auto-immunité, dysbiose).</div>

<div class="card v2-section">
    <div class="card-header"><h3>🧴 Type de peau & pathologies</h3></div>
    <div class="card-body">
        <div class="v2-grid-2">
            <div>
                <div class="v2-group-title">Type de peau</div>
                <?php foreach (['Normale', 'Grasse', 'Sèche', 'Mixte', 'Sensible', 'Atopique'] as $v): ?>
                <label class="form-check"><input type="checkbox" name="peau_type_cb[]" value="<?= $v ?>" <?= $cb('peau_type', $v) ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">Teint</div>
                <?php foreach (['Lumineux', 'Brouillé', 'Gris', 'Rosé', 'Rouge', 'Jaunâtre'] as $v): ?>
                <label class="form-check"><input type="checkbox" name="peau_teint_cb[]" value="<?= $v ?>" <?= $cb('peau_teint', $v) ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">Pathologies cutanées</div>
                <?php foreach (['Psoriasis', 'Eczéma', 'Acné', 'Dermatite', 'Rosacée', 'Urticaire', 'Mycoses cutanées'] as $v): ?>
                <label class="form-check"><input type="checkbox" name="peau_patho_cb[]" value="<?= $v ?>" <?= $cb('peau_patho', $v) ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
                <input type="text" name="peau_patho_autre" class="form-control" placeholder="Autre…" value="<?= e($r('peau_patho_autre')) ?>">
            </div>
            <div>
                <div class="v2-group-title">Prurit (démangeaisons)</div>
                <?php foreach (['Absent', 'Modéré', 'Intense', 'Nocturne'] as $v): ?>
                <label class="form-check"><input type="radio" name="peau_prurit" value="<?= $v ?>" <?= $r('peau_prurit') === $v ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<div class="card v2-section">
    <div class="card-header"><h3>Localisation & déclencheurs des poussées ★</h3></div>
    <div class="card-body">
        <div class="v2-grid-2">
            <div>
                <div class="v2-group-title">Localisation principale</div>
                <?php foreach (['Visage (haut)', 'Visage (bas / mâchoire)', 'Cuir chevelu', 'Cou / Nuque', 'Bras / Coudes', 'Jambes / Genoux', 'Tronc / Dos', 'Mains', 'Généralisé'] as $v): ?>
                <label class="form-check"><input type="checkbox" name="peau_loc_cb[]" value="<?= $v ?>" <?= $cb('peau_loc', $v) ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">Ancienneté</div>
                <?php foreach (['< 1 an', '1-5 ans', '> 5 ans', "Depuis l'enfance", 'Apparu post-grossesse ★', 'Post-stress ★'] as $v): ?>
                <label class="form-check"><input type="checkbox" name="peau_anciennete_cb[]" value="<?= $v ?>" <?= $cb('peau_anciennete', $v) ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="v2-group-title">Déclencheurs identifiés ★</div>
        <div class="v2-checkbox-grid">
            <?php foreach (['Stress / émotions +++', 'Cycle hormonal / SPM', 'Post-grossesse / Post-partum', 'Soleil / UV', 'Produits cosmétiques', 'Médicaments'] as $v): ?>
            <label><input type="checkbox" name="peau_declencheurs_cb[]" value="<?= $v ?>" <?= $cb('peau_declencheurs', $v) ? 'checked' : '' ?>> <?= $v ?></label>
            <?php endforeach; ?>
        </div>
        <div class="form-group" style="margin-top:.5rem;">
            <label class="form-label">Alimentation spécifique</label>
            <input type="text" name="peau_declencheur_alim" class="form-control" value="<?= e($r('peau_declencheur_alim')) ?>">
        </div>
        <div class="form-group">
            <label class="form-label">Saison</label>
            <input type="text" name="peau_saison" class="form-control" value="<?= e($r('peau_saison')) ?>">
        </div>

        <div class="v2-group-title">Évolution en période de stress ★</div>
        <?php foreach (['Aggravée', 'Stable', 'Améliorée'] as $v): ?>
        <label class="form-check" style="display:inline-block;margin-right:1rem;"><input type="radio" name="peau_stress_evol" value="<?= $v ?>" <?= $r('peau_stress_evol') === $v ? 'checked' : '' ?>><label><?= $v ?></label></label>
        <?php endforeach; ?>
    </div>
</div>

<div class="card v2-section">
    <div class="card-header"><h3>Lien psycho-émotionnel / peau ★</h3></div>
    <div class="card-body">
        <div class="v2-group-title">Lien stress / peau clairement constaté</div>
        <?php foreach (['Oui, clairement', 'Probable', 'Non / pas remarqué'] as $v): ?>
        <label class="form-check" style="display:inline-block;margin-right:1rem;"><input type="radio" name="peau_stress_lien" value="<?= $v ?>" <?= $r('peau_stress_lien') === $v ? 'checked' : '' ?>><label><?= $v ?></label></label>
        <?php endforeach; ?>

        <div class="form-group" style="margin-top:.5rem;">
            <label class="form-label">Évènement déclencheur initial (mariage, deuil, accouchement, conflit…)</label>
            <textarea name="peau_event_decl" class="form-control" rows="2"><?= e($r('peau_event_decl')) ?></textarea>
        </div>
    </div>
</div>

<div class="card v2-section">
    <div class="card-header"><h3>Traitements & soins</h3></div>
    <div class="card-body">
        <div class="v2-group-title">Traitement médical en cours</div>
        <?php foreach (['Corticoïdes topiques', 'Immunosuppresseurs', 'Antihistaminiques', 'Photothérapie UV', 'Aucun'] as $v): ?>
        <label class="form-check"><input type="checkbox" name="peau_trt_cb[]" value="<?= $v ?>" <?= $cb('peau_trt', $v) ? 'checked' : '' ?>><label><?= $v ?></label></label>
        <?php endforeach; ?>

        <div class="form-group" style="margin-top:.5rem;">
            <label class="form-label">Dermatologue suivi</label>
            <input type="text" name="peau_dermato" class="form-control" value="<?= e($r('peau_dermato')) ?>">
        </div>

        <div class="v2-group-title">Soins locaux naturels</div>
        <div class="v2-checkbox-grid">
            <?php foreach (['Savon doux / surgras / alep', 'Masques naturels'] as $v): ?>
            <label><input type="checkbox" name="peau_soins_cb[]" value="<?= $v ?>" <?= $cb('peau_soins', $v) ? 'checked' : '' ?>> <?= $v ?></label>
            <?php endforeach; ?>
        </div>
        <div class="form-group" style="margin-top:.5rem;">
            <label class="form-label">Hydrolats utilisés</label>
            <input type="text" name="peau_hydrolats" class="form-control" value="<?= e($r('peau_hydrolats')) ?>">
        </div>
        <div class="form-group">
            <label class="form-label">HE utilisées</label>
            <input type="text" name="peau_he" class="form-control" value="<?= e($r('peau_he')) ?>">
        </div>
        <div class="form-group">
            <label class="form-label">Huiles végétales</label>
            <input type="text" name="peau_hv" class="form-control" value="<?= e($r('peau_hv')) ?>">
        </div>
    </div>
</div>

<div class="card v2-section">
    <div class="card-header"><h3>Cheveux & ongles</h3></div>
    <div class="card-body">
        <div class="v2-grid-2">
            <div>
                <div class="v2-group-title">Cheveux</div>
                <?php foreach (['Normaux', 'Gras', 'Secs', 'Cassants', 'Ternes', 'Chute', 'Pellicules', 'Cuir chevelu irrité / plaques'] as $v): ?>
                <label class="form-check"><input type="checkbox" name="phaneres_cheveux_cb[]" value="<?= $v ?>" <?= $cb('phaneres_cheveux', $v) ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">Ongles</div>
                <?php foreach (['Normaux', 'Cassants', 'Mous', 'Striés', 'Tachés', 'Décollés'] as $v): ?>
                <label class="form-check"><input type="checkbox" name="phaneres_ongles_cb[]" value="<?= $v ?>" <?= $cb('phaneres_ongles', $v) ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
                <p class="text-sm text-muted">→ Signe potentiel de carence (Zn, Vit B, fer)</p>
            </div>
        </div>

        <div class="form-group" style="margin-top:1rem;">
            <label class="form-label">Observations complémentaires / produits / réactions</label>
            <textarea name="peau_obs" class="form-control" rows="2"><?= e($r('peau_obs')) ?></textarea>
        </div>
    </div>
</div>
