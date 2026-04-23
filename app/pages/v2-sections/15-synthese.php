<?php /** @var callable $r */ /** @var callable $cb */ /** @var array $consultation */
// Sauvegarde aussi dans consultation_synthese pour compat v1 / step6
$consultId = $consultation['id'];
$db = getDB();
$existingSynthese = $db->prepare("SELECT * FROM consultation_synthese WHERE consultation_id = ?");
$existingSynthese->execute([$consultId]);
$synth = $existingSynthese->fetch() ?: [];
?>
<div class="v2-tip">🗺️ <strong>Synthèse</strong> — identifier le terrain dominant, relever les signes clés et retenir 2-3 priorités d'action pour le PHV.</div>

<div class="card v2-section">
    <div class="card-header"><h3>Identification du terrain ★</h3></div>
    <div class="card-body">
        <p class="text-sm text-muted">Cocher le ou les terrains dominants identifiés.</p>
        <div class="v2-checkbox-grid">
            <?php
            $terrains = [
                '🔥 Inflammatoire',
                '🧪 Acidifié',
                '🦠 Dysbiose intestinale',
                '🛡️ Auto-immun',
                '😰 Anxieux / dépressif',
                '💊 Déséq. hormonal',
                '🌡️ Surcharge émonctorielle',
                '❓ Carences nutritionnelles',
            ];
            foreach ($terrains as $t): ?>
            <label><input type="checkbox" name="terrains_cb[]" value="<?= e($t) ?>" <?= $cb('terrains', $t) ? 'checked' : '' ?>> <?= $t ?></label>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<div class="card v2-section">
    <div class="card-header"><h3>Signes relevés & habitudes de vie à corriger</h3></div>
    <div class="card-body">
        <div class="v2-grid-2">
            <div class="form-group">
                <label class="form-label">Signes de déséquilibre relevés</label>
                <textarea name="signes_desequilibre" class="form-control" rows="7" placeholder="• ..."><?= e($r('signes_desequilibre', $synth['observations'] ?? '')) ?></textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Habitudes de vie à corriger</label>
                <textarea name="habitudes_corriger" class="form-control" rows="7" placeholder="• ..."><?= e($r('habitudes_corriger')) ?></textarea>
            </div>
        </div>
    </div>
</div>

<div class="card v2-section">
    <div class="card-header"><h3>Priorités d'action (choisir 2-3)</h3></div>
    <div class="card-body">
        <div class="v2-checkbox-grid">
            <?php
            $axes = [
                '🔥 Inflammation / immunité',
                '🫁 Digestion / microbiote / perméabilité',
                '😴 Sommeil / fatigue surrénalienne',
                '🍽️ Alimentation anti-inflammatoire',
                '😰 Équilibre psycho-émotionnel',
                '🔬 Régulation hormonale',
                '🧴 Émonctoires / peau',
                '⚖️ Équilibre acido-basique',
            ];
            foreach ($axes as $a): ?>
            <label><input type="checkbox" name="priorites_axes_cb[]" value="<?= e($a) ?>" <?= $cb('priorites_axes', $a) ? 'checked' : '' ?>> <?= $a ?></label>
            <?php endforeach; ?>
        </div>

        <!-- Compat step6 : priorites 1/2/3 texte libre -->
        <div class="v2-grid-3" style="margin-top:1rem;">
            <div class="form-group"><label class="form-label">Priorité 1</label><input type="text" name="priorite_1" class="form-control" value="<?= e($r('priorite_1', $synth['priorite_1'] ?? '')) ?>"></div>
            <div class="form-group"><label class="form-label">Priorité 2</label><input type="text" name="priorite_2" class="form-control" value="<?= e($r('priorite_2', $synth['priorite_2'] ?? '')) ?>"></div>
            <div class="form-group"><label class="form-label">Priorité 3</label><input type="text" name="priorite_3" class="form-control" value="<?= e($r('priorite_3', $synth['priorite_3'] ?? '')) ?>"></div>
        </div>
    </div>
</div>

<div class="card v2-section">
    <div class="card-header"><h3>Analyses à préconiser ★</h3></div>
    <div class="card-body">
        <div class="v2-checkbox-grid">
            <?php foreach ([
                'TSH + T3L + T4L',
                'Anti-TPO + Anti-TG',
                'Cortisol matinal (7h-9h)',
                'Ferritine + NFS',
                'Vitamine D',
                'Zinc + Vitamine A + Vitamines B',
                'Bilan lipidique / oméga-3',
                'Microbiote intestinal',
                'Bilan hormonal complet',
                'Glycémie à jeun + Insuline + HOMA',
                'HbA1c',
                'CRP / CRP us',
            ] as $v): ?>
            <label><input type="checkbox" name="analyses_preconisees_cb[]" value="<?= $v ?>" <?= $cb('analyses_preconisees', $v) ? 'checked' : '' ?>> <?= $v ?></label>
            <?php endforeach; ?>
        </div>
        <div class="form-group" style="margin-top:.5rem;">
            <label class="form-label">Autre analyse</label>
            <input type="text" name="analyses_autres" class="form-control" value="<?= e($r('analyses_autres')) ?>">
        </div>
    </div>
</div>

<div class="card v2-section">
    <div class="card-header"><h3>Résumé des premiers conseils</h3></div>
    <div class="card-body">
        <div class="form-group">
            <label class="form-label">Conseils à noter en séance (alimentation, compléments, techniques naturelles…)</label>
            <textarea name="synthese_conseils" class="form-control" rows="4"><?= e($r('synthese_conseils')) ?></textarea>
            <p class="form-hint">Ces notes alimenteront la génération du PHV à l'étape suivante.</p>
        </div>
        <div class="form-group">
            <label class="form-label">Prochaine consultation / suivi / délai recommandé</label>
            <input type="text" name="synthese_prochain_rdv" class="form-control" value="<?= e($r('synthese_prochain_rdv')) ?>" placeholder="ex: suivi dans 4-6 semaines">
        </div>
    </div>
</div>
