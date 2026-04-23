<?php /** @var callable $r */ /** @var callable $cb */ ?>
<div class="card v2-section">
    <div class="card-header"><h3>🫁 Respiratoire & ORL</h3></div>
    <div class="card-body">
        <div class="v2-grid-2">
            <div>
                <div class="v2-group-title">Tabac</div>
                <?php foreach (['Non-fumeur', 'Fumeur actif', 'Ex-fumeur'] as $v): ?>
                <label class="form-check"><input type="radio" name="tabac" value="<?= $v ?>" <?= $r('tabac') === $v ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
                <div class="form-group" style="margin-top:.3rem;"><label class="form-label">Si ex-fumeur, date sevrage</label><input type="text" name="tabac_sevrage" class="form-control" value="<?= e($r('tabac_sevrage')) ?>"></div>
            </div>
            <div>
                <div class="v2-group-title">Pathologies ORL / respiratoires</div>
                <?php foreach (['Rhinites chroniques ★', 'Sinusites', 'Asthme', 'Bronchites récurrentes', 'Encombrement chronique'] as $v): ?>
                <label class="form-check"><input type="checkbox" name="resp_patho_cb[]" value="<?= $v ?>" <?= $cb('resp_patho', $v) ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">Respiration</div>
                <?php foreach (['Profonde', 'Courte / superficielle', 'Gêne respiratoire', 'Essoufflement'] as $v): ?>
                <label class="form-check"><input type="checkbox" name="resp_type_cb[]" value="<?= $v ?>" <?= $cb('resp_type', $v) ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">Oxygénation plein air</div>
                <?php foreach (['Régulière', 'Insuffisante', 'Rare'] as $v): ?>
                <label class="form-check"><input type="radio" name="resp_oxy" value="<?= $v ?>" <?= $r('resp_oxy') === $v ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<div class="card v2-section">
    <div class="card-header"><h3>🫀 Cardiovasculaire & maux de tête</h3></div>
    <div class="card-body">
        <div class="v2-grid-2">
            <div>
                <div class="v2-group-title">Cardiovasculaire</div>
                <?php foreach (['Pas de trouble', 'Palpitations', 'Extrémités froides', 'Varices', 'Jambes lourdes', 'Œdèmes', 'Hypertension', 'Hypotension'] as $v): ?>
                <label class="form-check"><input type="checkbox" name="cardio_cb[]" value="<?= $v ?>" <?= $cb('cardio', $v) ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">Maux de tête</div>
                <?php foreach (['Aucun', 'Céphalées de tension', 'Migraines', 'Migraine ophtalmique'] as $v): ?>
                <label class="form-check"><input type="radio" name="maux_tete" value="<?= $v ?>" <?= $r('maux_tete') === $v ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
                <div class="v2-group-title" style="margin-top:.5rem;">Déclencheurs</div>
                <?php foreach (['Stress', 'Cervicales', 'Alimentation', 'Hormones'] as $v): ?>
                <label class="form-check"><input type="checkbox" name="maux_tete_decl_cb[]" value="<?= $v ?>" <?= $cb('maux_tete_decl', $v) ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<div class="card v2-section">
    <div class="card-header"><h3>🦴 Locomoteur & urinaire</h3></div>
    <div class="card-body">
        <div class="v2-grid-2">
            <div>
                <div class="v2-group-title">Appareil locomoteur</div>
                <?php foreach (['Pas de trouble', 'Arthrose', 'Douleurs articulaires', 'Douleurs musculaires', 'Crampes', 'Raideur matinale'] as $v): ?>
                <label class="form-check"><input type="checkbox" name="loco_cb[]" value="<?= $v ?>" <?= $cb('loco', $v) ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
                <div class="form-group" style="margin-top:.3rem;"><label class="form-label">Localisation</label><input type="text" name="loco_localisation" class="form-control" value="<?= e($r('loco_localisation')) ?>"></div>
            </div>
            <div>
                <div class="v2-group-title">Urinaire</div>
                <?php foreach (['Normal', 'Mictions fréquentes', 'Douleur à la miction', 'Infections récurrentes', 'Lever nocturne', 'Incontinence'] as $v): ?>
                <label class="form-check"><input type="checkbox" name="urinaire_cb[]" value="<?= $v ?>" <?= $cb('urinaire', $v) ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="form-group" style="margin-top:1rem;">
            <label class="form-label">Observations / douleurs localisées</label>
            <textarea name="systemes_obs" class="form-control" rows="2"><?= e($r('systemes_obs')) ?></textarea>
        </div>
    </div>
</div>
