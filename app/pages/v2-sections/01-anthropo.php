<?php /** @var callable $r */ /** @var callable $cb */ ?>
<div class="v2-tip">💡 <strong>Rappel posture</strong> — Accueil chaleureux · laisser s'installer · proposer de l'eau · écoute active sans jugement. 1 séance = 1 motif principal. Reformuler. Valider les émotions. Notes discrètes.</div>

<div class="card v2-section">
    <div class="card-header"><h3>👁️ Données anthropométriques</h3></div>
    <div class="card-body">
        <div class="v2-grid-4">
            <div class="form-group"><label class="form-label">Taille (cm)</label><input type="number" name="taille_cm" class="form-control" value="<?= e($r('taille_cm')) ?>"></div>
            <div class="form-group"><label class="form-label">Poids (kg)</label><input type="number" step="0.1" name="poids_kg" class="form-control" value="<?= e($r('poids_kg')) ?>"></div>
            <div class="form-group"><label class="form-label">IMC</label><input type="text" name="imc" class="form-control" value="<?= e($r('imc')) ?>" placeholder="auto"></div>
            <div class="form-group"><label class="form-label">Tour de taille (cm)</label><input type="number" name="tour_taille_cm" class="form-control" value="<?= e($r('tour_taille_cm')) ?>"></div>
        </div>
    </div>
</div>

<div class="card v2-section">
    <div class="card-header"><h3>🔍 Premières impressions à l'observation</h3></div>
    <div class="card-body">
        <div class="v2-grid-2">
            <div>
                <div class="v2-group-title">Démarche</div>
                <?php foreach (['Lente', 'Assurée', 'Précipitée'] as $v): ?>
                <label class="form-check"><input type="radio" name="obs_demarche" value="<?= $v ?>" <?= $r('obs_demarche') === $v ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">Posture</div>
                <?php foreach (['Droite', 'Avachi(e)', 'Tendue'] as $v): ?>
                <label class="form-check"><input type="radio" name="obs_posture" value="<?= $v ?>" <?= $r('obs_posture') === $v ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">Regard</div>
                <?php foreach (['Fuyant', 'Droit', 'Absent', 'Fatigué'] as $v): ?>
                <label class="form-check"><input type="radio" name="obs_regard" value="<?= $v ?>" <?= $r('obs_regard') === $v ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">Sourire</div>
                <?php foreach (['Naturel', 'Crispé', 'Nerveux', 'Absent'] as $v): ?>
                <label class="form-check"><input type="radio" name="obs_sourire" value="<?= $v ?>" <?= $r('obs_sourire') === $v ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">Débit de parole</div>
                <?php foreach (['Lent', 'Moyen', 'Rapide'] as $v): ?>
                <label class="form-check"><input type="radio" name="obs_debit" value="<?= $v ?>" <?= $r('obs_debit') === $v ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">Volume voix</div>
                <?php foreach (['Posé', 'Faible', 'Fort'] as $v): ?>
                <label class="form-check"><input type="radio" name="obs_voix" value="<?= $v ?>" <?= $r('obs_voix') === $v ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">Tempérament (4 humeurs)</div>
                <?php foreach (['Nerveux', 'Sanguin', 'Bilieux', 'Lymphatique'] as $v): ?>
                <label class="form-check"><input type="radio" name="obs_temperament" value="<?= $v ?>" <?= $r('obs_temperament') === $v ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="v2-group-title">Attitude</div>
                <?php foreach (['Ouverte', 'Méfiante', 'Désespérée', 'Motivée'] as $v): ?>
                <label class="form-check"><input type="radio" name="obs_attitude" value="<?= $v ?>" <?= $r('obs_attitude') === $v ? 'checked' : '' ?>><label><?= $v ?></label></label>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="form-group" style="margin-top:1rem;">
            <label class="form-label">Autres observations (comportement, teint, tenue, odeur…)</label>
            <textarea name="obs_autres" class="form-control" rows="3"><?= e($r('obs_autres')) ?></textarea>
        </div>
    </div>
</div>
