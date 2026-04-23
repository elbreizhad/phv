<?php /** @var callable $r */ /** @var callable $cb */ ?>
<div class="card v2-section">
    <div class="card-header"><h3>💧 Hydratation</h3></div>
    <div class="card-body">
        <div class="v2-tip">💡 Cible : <strong>1,5 L d'eau par jour</strong> minimum, faiblement minéralisée (résidu sec &lt; 150 mg/L), en dehors des repas (arrêt 30 min avant, reprise 1h après).</div>

        <div class="form-group">
            <label class="form-label">Quantité d'eau / jour</label>
            <input type="text" name="hydra_quantite" class="form-control" value="<?= e($r('hydra_quantite')) ?>" placeholder="ex: 1L, 1,5L, 2L...">
        </div>

        <div class="v2-grid-2">
            <div>
                <div class="v2-group-title">Type d'eau</div>
                <?php foreach (['Robinet', 'Filtrée', 'Osmosée', 'Source', 'Minérale', 'Gazeuse'] as $v): ?>
                <label class="form-check"><input type="checkbox" name="hydra_type_cb[]" value="<?= $v ?>" <?= $cb('hydra_type', $v) ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">Moment de consommation</div>
                <?php foreach (['Avant repas', 'Pendant', 'Après', 'Tout au long de la journée'] as $v): ?>
                <label class="form-check"><input type="checkbox" name="hydra_moment_cb[]" value="<?= $v ?>" <?= $cb('hydra_moment', $v) ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">Comment</div>
                <?php foreach (['Petites gorgées', "Grandes quantités d'un coup"] as $v): ?>
                <label class="form-check"><input type="radio" name="hydra_comment" value="<?= $v ?>" <?= $r('hydra_comment') === $v ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="form-group" style="margin-top:1rem;">
            <label class="form-label">Observations</label>
            <textarea name="hydra_obs" class="form-control" rows="2"><?= e($r('hydra_obs')) ?></textarea>
        </div>
    </div>
</div>
