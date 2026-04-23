<?php /** @var callable $r */ /** @var callable $cb */
$scale = function(string $name, string $icon, string $label) use ($r) {
    echo '<div class="v2-group-title">' . $icon . ' ' . e($label) . '</div><div class="v2-scale">';
    for ($i = 1; $i <= 10; $i++) {
        $checked = (string)$r($name) === (string)$i ? 'checked' : '';
        echo '<label><input type="radio" name="' . $name . '" value="' . $i . '" ' . $checked . '><span>' . $i . '</span></label>';
    }
    echo '</div>';
};
?>

<div class="card v2-section">
    <div class="card-header"><h3>😴 Sommeil</h3></div>
    <div class="card-body">
        <div class="v2-grid-4">
            <div class="form-group"><label class="form-label">Besoins (h)</label><input type="text" name="sommeil_besoin_h" class="form-control" value="<?= e($r('sommeil_besoin_h')) ?>"></div>
            <div class="form-group"><label class="form-label">Heures dormies</label><input type="text" name="sommeil_heures_dormies" class="form-control" value="<?= e($r('sommeil_heures_dormies')) ?>"></div>
            <div class="form-group"><label class="form-label">Heure coucher</label><input type="time" name="sommeil_heure_coucher" class="form-control" value="<?= e($r('sommeil_heure_coucher')) ?>"></div>
            <div class="form-group"><label class="form-label">Heure lever</label><input type="time" name="sommeil_heure_lever" class="form-control" value="<?= e($r('sommeil_heure_lever')) ?>"></div>
        </div>
        <div class="form-group">
            <label class="form-label">Réveils nocturnes</label>
            <input type="text" name="sommeil_reveils" class="form-control" value="<?= e($r('sommeil_reveils')) ?>" placeholder="Fréquence / heures / durée">
        </div>

        <?php $scale('sommeil_qualite', '🌙', 'Qualité du sommeil'); ?>
        <?php $scale('niveau_energie', '⚡', "Niveau d'énergie / vitalité"); ?>
        <?php $scale('niveau_fatigue', '😓', 'Niveau de fatigue générale'); ?>

        <div class="v2-grid-2" style="margin-top:1rem;">
            <div>
                <div class="v2-group-title">État au réveil</div>
                <?php foreach (['En forme', 'Fatigué(e)', 'Difficultés à se lever'] as $v): ?>
                <label class="form-check"><input type="radio" name="reveil_etat" value="<?= $v ?>" <?= $r('reveil_etat') === $v ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">Type de fatigue</div>
                <?php foreach (['Physique', 'Nerveuse', 'Émotionnelle', 'Chronique', 'Manque de sommeil'] as $v): ?>
                <label class="form-check"><input type="checkbox" name="fatigue_type_cb[]" value="<?= $v ?>" <?= $cb('fatigue_type', $v) ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">Consommation stimulants</div>
                <?php foreach (['Café +++', 'Sucre', 'Energy drinks'] as $v): ?>
                <label class="form-check"><input type="checkbox" name="stimulants_cb[]" value="<?= $v ?>" <?= $cb('stimulants', $v) ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">Troubles du sommeil</div>
                <?php foreach (['Endormissement difficile', 'Réveils fréquents', 'Réveil très tôt', 'Cauchemars', 'Apnée', 'Insomnies'] as $v): ?>
                <label class="form-check"><input type="checkbox" name="sommeil_troubles_cb[]" value="<?= $v ?>" <?= $cb('sommeil_troubles', $v) ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">Apnée du sommeil</div>
                <?php foreach (['Diagnostiquée', 'Suspectée', 'Non'] as $v): ?>
                <label class="form-check"><input type="radio" name="apnee" value="<?= $v ?>" <?= $r('apnee') === $v ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">Besoin TV / écrans pour dormir</div>
                <?php foreach (['Oui', 'Non'] as $v): ?>
                <label class="form-check"><input type="radio" name="sommeil_ecrans" value="<?= $v ?>" <?= $r('sommeil_ecrans') === $v ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="form-group" style="margin-top:1rem;">
            <label class="form-label">Rituels du soir / observations sommeil</label>
            <textarea name="sommeil_rituels" class="form-control" rows="2"><?= e($r('sommeil_rituels')) ?></textarea>
        </div>
    </div>
</div>
