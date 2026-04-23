<?php /** @var callable $r */ /** @var callable $cb */ ?>
<div class="card v2-section">
    <div class="card-header"><h3>💼 Vie professionnelle</h3></div>
    <div class="card-body">
        <div class="v2-grid-2">
            <div>
                <div class="v2-group-title">Statut</div>
                <?php foreach (['Salarié(e)', 'Libéral(e)', 'Entrepreneur', 'Étudiant(e)', 'Chômage', 'Arrêt maladie', 'Retraite'] as $v): ?>
                <label class="form-check"><input type="radio" name="pro_statut" value="<?= $v ?>" <?= $r('pro_statut') === $v ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">Conditions de travail</div>
                <?php foreach (['Assis', 'Debout', 'Télétravail', 'Travail de nuit', 'Déplacements fréquents'] as $v): ?>
                <label class="form-check"><input type="checkbox" name="pro_conditions_cb[]" value="<?= $v ?>" <?= $cb('pro_conditions', $v) ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="form-group" style="margin-top:1rem;">
            <label class="form-label">Poste / domaine</label>
            <input type="text" name="pro_poste" class="form-control" value="<?= e($r('pro_poste')) ?>">
        </div>

        <div class="v2-grid-2">
            <div>
                <div class="v2-group-title">Satisfaction</div>
                <?php foreach (['Très satisfait(e)', 'Moyen', 'Pas satisfait(e)', 'Souhait de changer'] as $v): ?>
                <label class="form-check"><input type="radio" name="pro_satisfaction" value="<?= $v ?>" <?= $r('pro_satisfaction') === $v ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">Relations au travail</div>
                <?php foreach (['Bonnes', 'Moyennes', 'Mauvaises'] as $v): ?>
                <label class="form-check"><input type="radio" name="pro_relations" value="<?= $v ?>" <?= $r('pro_relations') === $v ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">Stress professionnel</div>
                <?php foreach (['Faible', 'Modéré', 'Élevé', 'Épuisement'] as $v): ?>
                <label class="form-check"><input type="radio" name="pro_stress" value="<?= $v ?>" <?= $r('pro_stress') === $v ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">Déjeuner</div>
                <?php foreach (['Maison', 'Cantine', 'Restaurant', 'Saute le repas'] as $v): ?>
                <label class="form-check"><input type="radio" name="pro_dejeuner" value="<?= $v ?>" <?= $r('pro_dejeuner') === $v ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="form-group" style="margin-top:1rem;">
            <label class="form-label">Observations / projets de changement professionnels</label>
            <textarea name="pro_observations" class="form-control" rows="3"><?= e($r('pro_observations')) ?></textarea>
        </div>
    </div>
</div>
