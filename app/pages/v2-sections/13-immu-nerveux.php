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
    <div class="card-header"><h3>🛡️ Immunité & auto-immunité ★</h3></div>
    <div class="card-body">
        <div class="v2-grid-2">
            <div>
                <div class="v2-group-title">Immunité</div>
                <?php foreach (['Solide', 'Fragile', 'Infections ORL récurrentes', 'Herpès', 'EBV', 'Varicelle / zona'] as $v): ?>
                <label class="form-check"><input type="checkbox" name="immu_cb[]" value="<?= $v ?>" <?= $cb('immu', $v) ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">Maladie auto-immune</div>
                <?php foreach (['Non', 'Oui'] as $v): ?>
                <label class="form-check"><input type="radio" name="auto_immune" value="<?= $v ?>" <?= $r('auto_immune') === $v ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
                <div class="form-group" style="margin-top:.3rem;"><input type="text" name="auto_immune_detail" class="form-control" placeholder="Préciser…" value="<?= e($r('auto_immune_detail')) ?>"></div>
            </div>
            <div>
                <div class="v2-group-title">Allergie(s)</div>
                <?php foreach (['Non', 'Oui'] as $v): ?>
                <label class="form-check"><input type="radio" name="allergies_oui_non" value="<?= $v ?>" <?= $r('allergies_oui_non') === $v ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
                <div class="form-group" style="margin-top:.3rem;"><input type="text" name="allergies_detail" class="form-control" placeholder="Préciser…" value="<?= e($r('allergies_detail')) ?>"></div>
            </div>
            <div>
                <div class="v2-group-title">Naissance / allaitement</div>
                <?php foreach (['Voie basse', 'Césarienne'] as $v): ?>
                <label class="form-check"><input type="radio" name="naissance" value="<?= $v ?>" <?= $r('naissance') === $v ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
                <?php foreach (['Oui', 'Non'] as $v): ?>
                <label class="form-check"><input type="radio" name="allaitement" value="<?= $v ?>" <?= $r('allaitement') === $v ? 'checked' : '' ?>><label>Allaité : <?= $v ?></label></label>
                <?php endforeach; ?>
                <div class="form-group" style="margin-top:.3rem;"><label class="form-label">Durée</label><input type="text" name="allaitement_duree" class="form-control" value="<?= e($r('allaitement_duree')) ?>"></div>
            </div>
        </div>

        <?php
        // Compat v1 : immu_niveau (1-10) dérivé rapidement depuis les cases "Solide/Fragile"
        $immuChoix = (string) $r('immu');
        $immuV1 = str_contains($immuChoix, 'Fragile') ? '3' : (str_contains($immuChoix, 'Solide') ? '8' : '5');
        ?>
        <input type="hidden" name="immu_niveau" value="<?= $immuV1 ?>">
    </div>
</div>

<div class="card v2-section">
    <div class="card-header"><h3>🧠 Système nerveux & émotions</h3></div>
    <div class="card-body">
        <?php $scale('stress_niveau', '😰', 'Niveau de stress actuel'); ?>
        <?php $scale('moral_niveau', '😔', 'État moral général'); ?>

        <div class="v2-grid-2" style="margin-top:1rem;">
            <div>
                <div class="v2-group-title">Type de stress</div>
                <?php foreach (['Stress chronique', 'Angoisse', 'Anxiété généralisée', "Crises d'angoisse", "Peur de l'avenir", 'Hypervigilance'] as $v): ?>
                <label class="form-check"><input type="checkbox" name="stress_type_cb[]" value="<?= $v ?>" <?= $cb('stress_type', $v) ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">Système nerveux</div>
                <?php foreach (['Troubles de concentration', 'Troubles de mémoire', 'Difficultés à trouver ses mots'] as $v): ?>
                <label class="form-check"><input type="checkbox" name="nerv_cb[]" value="<?= $v ?>" <?= $cb('nerv', $v) ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">État émotionnel</div>
                <?php foreach (['Stable', 'Variable', 'Irritabilité', 'Tristesse', 'Déprime', 'Microdépression', 'Dépressions répétées'] as $v): ?>
                <label class="form-check"><input type="checkbox" name="etat_emo_cb[]" value="<?= $v ?>" <?= $cb('etat_emo', $v) ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">Suivi psy / sophrologie</div>
                <?php foreach (['Non', 'Ponctuel', 'Régulier'] as $v): ?>
                <label class="form-check"><input type="radio" name="suivi_psy" value="<?= $v ?>" <?= $r('suivi_psy') === $v ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="form-group" style="margin-top:1rem;">
            <label class="form-label">Motifs du stress / situation émotionnelle actuelle</label>
            <textarea name="stress_motifs" class="form-control" rows="3"><?= e($r('stress_motifs')) ?></textarea>
        </div>
        <div class="form-group">
            <label class="form-label">Ressources / techniques de gestion du stress utilisées</label>
            <textarea name="stress_ressources" class="form-control" rows="2"><?= e($r('stress_ressources')) ?></textarea>
        </div>
    </div>
</div>
