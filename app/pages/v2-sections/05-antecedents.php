<?php /** @var callable $r */ /** @var callable $cb */ ?>
<div class="card v2-section">
    <div class="card-header"><h3>🏥 Antécédents personnels</h3></div>
    <div class="card-body">
        <?php
        $atcdPerso = [
            'chirurgie' => 'Interventions chirurgicales',
            'hospi' => 'Hospitalisations',
            'chroniques' => 'Maladies chroniques',
            'auto_immunes' => 'Maladies auto-immunes',
            'infantiles' => 'Maladies infantiles',
            'grossesses' => 'Grossesse(s) / Accouchement(s)',
            'allergies' => 'Allergies connues',
            'intolerances' => 'Intolérances alimentaires',
            'antibio' => 'Antibiotiques (longue durée / répétés)',
            'corticoides' => 'Corticoïdes (longue durée)',
            'contraception_hormo' => 'Contraception hormonale',
        ];
        ?>
        <table class="v2-family-table">
            <thead><tr><th>Antécédent</th><th>OUI</th><th>NON</th><th>Précisions / date</th></tr></thead>
            <tbody>
            <?php foreach ($atcdPerso as $k => $label): ?>
                <tr>
                    <td><?= e($label) ?></td>
                    <td><input type="radio" name="atcd_<?= $k ?>" value="oui" <?= $r('atcd_' . $k) === 'oui' ? 'checked' : '' ?>></td>
                    <td><input type="radio" name="atcd_<?= $k ?>" value="non" <?= $r('atcd_' . $k) === 'non' ? 'checked' : '' ?>></td>
                    <td><input type="text" name="atcd_<?= $k ?>_precisions" class="form-control" style="font-size:12px;padding:.2rem;" value="<?= e($r('atcd_' . $k . '_precisions')) ?>"></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <div class="form-group" style="margin-top:1rem;">
            <label class="form-label">Médecin traitant & praticiens de santé suivis</label>
            <textarea name="atcd_praticiens" class="form-control" rows="2"><?= e($r('atcd_praticiens')) ?></textarea>
        </div>
    </div>
</div>

<div class="card v2-section">
    <div class="card-header"><h3>🧬 Antécédents familiaux</h3></div>
    <div class="card-body">
        <p class="text-sm text-muted">Cocher les cases pour chaque membre de la famille concerné. ★ = à surveiller particulièrement.</p>
        <?php
        $members = ['mere' => 'Mère', 'pere' => 'Père', 'gp_mat' => 'GP mat.', 'gm_mat' => 'GM mat.', 'gp_pat' => 'GP pat.', 'gm_pat' => 'GM pat.', 'fratrie' => 'Fratrie'];
        $pathos = [
            'diabete' => 'Diabète',
            'cancer' => 'Cancer',
            'cardiaque' => 'Maladies cardiaques',
            'neuro' => 'Maladies neurologiques',
            'auto_immune' => 'Maladies auto-immunes',
            'cutanees' => 'Pathologies cutanées ★',
            'thyroide' => 'Troubles thyroïdiens ★',
            'digestif' => 'Troubles digestifs / constipation ★',
            'obesite' => 'Obésité / surpoids',
            'autres' => 'Autres',
        ];
        ?>
        <div style="overflow-x:auto;">
        <table class="v2-family-table">
            <thead>
                <tr>
                    <th>Pathologie</th>
                    <?php foreach ($members as $label): ?><th><?= e($label) ?></th><?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pathos as $pkey => $plabel): ?>
                <tr>
                    <td><?= e($plabel) ?></td>
                    <?php foreach ($members as $mkey => $_): ?>
                        <td><input type="checkbox" name="fam_<?= $pkey ?>_cb[]" value="<?= $mkey ?>" <?= $cb('fam_' . $pkey, $mkey) ? 'checked' : '' ?>></td>
                    <?php endforeach; ?>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>

        <div class="form-group" style="margin-top:1rem;">
            <label class="form-label">Observations complémentaires</label>
            <textarea name="atcd_fam_observations" class="form-control" rows="2"><?= e($r('atcd_fam_observations')) ?></textarea>
        </div>
    </div>
</div>
