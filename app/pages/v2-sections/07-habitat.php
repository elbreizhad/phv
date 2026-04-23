<?php /** @var callable $r */ /** @var callable $cb */ ?>
<div class="card v2-section">
    <div class="card-header"><h3>🏡 Habitat & environnement</h3></div>
    <div class="card-body">
        <div class="v2-grid-2">
            <div>
                <div class="v2-group-title">Type d'habitat</div>
                <?php foreach (['Appartement', 'Maison', 'Ville', 'Périurbain', 'Campagne'] as $v): ?>
                <label class="form-check"><input type="checkbox" name="habitat_type_cb[]" value="<?= $v ?>" <?= $cb('habitat_type', $v) ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">Accès extérieur</div>
                <?php foreach (['Balcon', 'Jardin', 'Aucun'] as $v): ?>
                <label class="form-check"><input type="radio" name="habitat_acces_ext" value="<?= $v ?>" <?= $r('habitat_acces_ext') === $v ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">Salle de bain</div>
                <?php foreach (['Douche', 'Baignoire', 'Les deux'] as $v): ?>
                <label class="form-check"><input type="radio" name="habitat_sdb" value="<?= $v ?>" <?= $r('habitat_sdb') === $v ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">Nuisances</div>
                <?php foreach (['Pesticides / champs', 'Pollution sonore', 'Antennes / ondes', 'Pollution atmosphérique'] as $v): ?>
                <label class="form-check"><input type="checkbox" name="habitat_nuisances_cb[]" value="<?= $v ?>" <?= $cb('habitat_nuisances', $v) ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="v2-group-title">Se sent bien dans son habitat</div>
        <?php foreach (['Oui', 'Partiellement', 'Non'] as $v): ?>
        <label class="form-check" style="display:inline-block;margin-right:1rem;"><input type="radio" name="habitat_bienetre" value="<?= $v ?>" <?= $r('habitat_bienetre') === $v ? 'checked' : '' ?>><label><?= $v ?></label></label>
        <?php endforeach; ?>

        <div class="form-group" style="margin-top:1rem;">
            <label class="form-label">Observations habitat</label>
            <textarea name="habitat_obs" class="form-control" rows="2"><?= e($r('habitat_obs')) ?></textarea>
        </div>
    </div>
</div>

<div class="card v2-section">
    <div class="card-header"><h3>🏃 Activité physique</h3></div>
    <div class="card-body">
        <p class="text-sm text-muted">Jusqu'à 3 activités. Laissez vide les lignes non utilisées.</p>
        <table class="v2-family-table">
            <thead><tr><th>Activité / sport</th><th>Fréquence</th><th>Durée</th><th>Depuis</th></tr></thead>
            <tbody>
                <?php for ($i = 1; $i <= 3; $i++): ?>
                <tr>
                    <td><input type="text" name="activite_<?= $i ?>_nom" class="form-control" style="padding:.2rem;" value="<?= e($r('activite_' . $i . '_nom')) ?>"></td>
                    <td><input type="text" name="activite_<?= $i ?>_freq" class="form-control" style="padding:.2rem;" value="<?= e($r('activite_' . $i . '_freq')) ?>"></td>
                    <td><input type="text" name="activite_<?= $i ?>_duree" class="form-control" style="padding:.2rem;" value="<?= e($r('activite_' . $i . '_duree')) ?>"></td>
                    <td><input type="text" name="activite_<?= $i ?>_depuis" class="form-control" style="padding:.2rem;" value="<?= e($r('activite_' . $i . '_depuis')) ?>"></td>
                </tr>
                <?php endfor; ?>
            </tbody>
        </table>

        <div class="v2-grid-2" style="margin-top:1rem;">
            <div>
                <div class="v2-group-title">Sédentarité</div>
                <?php foreach (['Aucune activité', 'Partiellement actif', 'Actif'] as $v): ?>
                <label class="form-check"><input type="radio" name="sedentarite" value="<?= $v ?>" <?= $r('sedentarite') === $v ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">Si pas d'activité, raison</div>
                <?php foreach (['Manque de temps', 'Fatigue', 'Motivation', 'Douleurs'] as $v): ?>
                <label class="form-check"><input type="checkbox" name="pas_activite_raison_cb[]" value="<?= $v ?>" <?= $cb('pas_activite_raison', $v) ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">Pratique en plein air</div>
                <?php foreach (['Régulièrement', 'Parfois', 'Jamais'] as $v): ?>
                <label class="form-check"><input type="radio" name="plein_air" value="<?= $v ?>" <?= $r('plein_air') === $v ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">Effets positifs ressentis</div>
                <?php foreach (['Humeur', 'Sommeil', 'Digestion', 'Peau'] as $v): ?>
                <label class="form-check"><input type="checkbox" name="activite_effets_cb[]" value="<?= $v ?>" <?= $cb('activite_effets', $v) ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
