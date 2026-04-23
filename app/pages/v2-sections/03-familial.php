<?php /** @var callable $r */ /** @var callable $cb */ ?>
<div class="card v2-section">
    <div class="card-header"><h3>👨‍👩‍👧 Évènements marquants</h3></div>
    <div class="card-body">
        <div class="form-group">
            <label class="form-label">Évènements marquants (enfance, adolescence, deuils, chocs émotionnels)</label>
            <textarea name="evenements_marquants" class="form-control" rows="4"><?= e($r('evenements_marquants')) ?></textarea>
        </div>
    </div>
</div>

<div class="card v2-section">
    <div class="card-header"><h3>Situation familiale actuelle</h3></div>
    <div class="card-body">
        <div class="v2-grid-2">
            <div>
                <div class="v2-group-title">Situation familiale</div>
                <?php foreach (['Marié(e)', 'Pacsé(e)', 'Vie maritale', 'Célibataire', 'Divorcé(e)', 'Veuf/Veuve'] as $v): ?>
                <label class="form-check"><input type="radio" name="situation_familiale" value="<?= $v ?>" <?= $r('situation_familiale') === $v ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">Enfants</div>
                <?php foreach (['Oui', 'Non'] as $v): ?>
                <label class="form-check"><input type="radio" name="enfants" value="<?= $v ?>" <?= $r('enfants') === $v ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
                <div class="form-group" style="margin-top:.5rem;">
                    <label class="form-label">Nombre / âges</label>
                    <input type="text" name="enfants_details" class="form-control" value="<?= e($r('enfants_details')) ?>">
                </div>
            </div>
            <div>
                <div class="v2-group-title">Relations familiales</div>
                <?php foreach (['Harmonieuses', 'Tendues', 'Conflictuelles', 'Peu de contact'] as $v): ?>
                <label class="form-check"><input type="radio" name="relations_familiales" value="<?= $v ?>" <?= $r('relations_familiales') === $v ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">Temps pour soi</div>
                <?php foreach (['Suffisant', 'Insuffisant', 'Aucun'] as $v): ?>
                <label class="form-check"><input type="radio" name="temps_pour_soi" value="<?= $v ?>" <?= $r('temps_pour_soi') === $v ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<div class="card v2-section">
    <div class="card-header"><h3>Vie sociale & hobbies</h3></div>
    <div class="card-body">
        <div class="v2-group-title">Vie sociale</div>
        <?php foreach (['Riche', 'Correcte', 'Isolé(e)'] as $v): ?>
        <label class="form-check" style="display:inline-block;margin-right:1rem;"><input type="radio" name="vie_sociale" value="<?= $v ?>" <?= $r('vie_sociale') === $v ? 'checked' : '' ?>><label><?= $v ?></label></label>
        <?php endforeach; ?>

        <div class="form-group" style="margin-top:1rem;">
            <label class="form-label">Hobbies / passions</label>
            <input type="text" name="hobbies" class="form-control" value="<?= e($r('hobbies')) ?>">
        </div>
        <div class="form-group">
            <label class="form-label">Ressources (ce qui fait du bien)</label>
            <textarea name="ressources_bienetre" class="form-control" rows="2"><?= e($r('ressources_bienetre')) ?></textarea>
        </div>
        <div class="form-group">
            <label class="form-label">Observations vie familiale / conjugale</label>
            <textarea name="obs_vie_familiale" class="form-control" rows="2"><?= e($r('obs_vie_familiale')) ?></textarea>
        </div>
    </div>
</div>
