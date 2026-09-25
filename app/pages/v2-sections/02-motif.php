<?php /** @var callable $r */ /** @var callable $cb */ /** @var array $consultation */ /** @var array $pathologiesList */ ?>
<div class="card v2-section">
    <div class="card-header"><h3>🎯 Plainte / motif principal</h3></div>
    <div class="card-body">
        <div class="v2-tip">Rappel du motif déclaré à la création : <em><?= nl2br(e($consultation['motif'])) ?></em></div>

        <div class="form-group">
            <label class="form-label">Plainte / motif principal (reformulé)</label>
            <textarea name="motif_reformule" class="form-control" rows="3" placeholder="Reformulation du motif après échange..."><?= e($r('motif_reformule')) ?></textarea>
        </div>
        <div class="form-group">
            <label class="form-label">Historique (depuis quand ? déclencheur ? chronologie ?)</label>
            <textarea name="motif_historique" class="form-control" rows="3"><?= e($r('motif_historique')) ?></textarea>
        </div>
        <div class="form-group">
            <label class="form-label">Objectif du consultant (qu'attend-il de cette consultation ?)</label>
            <textarea name="motif_objectif" class="form-control" rows="2"><?= e($r('motif_objectif')) ?></textarea>
        </div>
        <div class="form-group">
            <label class="form-label">Signification émotionnelle perçue</label>
            <textarea name="motif_signification" class="form-control" rows="2"><?= e($r('motif_signification')) ?></textarea>
        </div>

        <div class="form-group">
            <label class="form-label">Pathologies / pistes à relier <span class="text-sm text-muted">(alimente automatiquement les fiches pathologies, protocoles, recettes et suggestions à l'étape Programme PHV)</span></label>
            <input type="text" id="v2_patho_filter" class="form-control" placeholder="Rechercher une pathologie (ex: SIBO, thyroïde, acné...)" style="margin-bottom:.5rem;">
            <div id="v2_patho_list" style="max-height:260px; overflow-y:auto; border:1px solid var(--border, #ddd); border-radius:6px; padding:.5rem .75rem;">
                <?php
                $currentSysteme = null;
                foreach ($pathologiesList as $patho):
                    if ($patho['systeme'] !== $currentSysteme):
                        $currentSysteme = $patho['systeme'];
                        if ($currentSysteme !== $pathologiesList[0]['systeme']) echo '</div>';
                        ?>
                        <div class="v2-group-title" style="margin-top:.5rem;"><?= e($currentSysteme) ?></div>
                        <div class="v2-checkbox-grid v2-patho-group">
                    <?php endif; ?>
                    <label class="v2-patho-item">
                        <input type="checkbox" name="motif_pathologies_liees_cb[]" value="<?= e($patho['nom']) ?>" <?= $cb('motif_pathologies_liees', $patho['nom']) ? 'checked' : '' ?>>
                        <?= e($patho['nom']) ?>
                    </label>
                <?php endforeach; ?>
                <?php if (!empty($pathologiesList)) echo '</div>'; ?>
            </div>
        </div>
    </div>
</div>

<script>
(function() {
    const filterInput = document.getElementById('v2_patho_filter');
    const list = document.getElementById('v2_patho_list');
    if (!filterInput || !list) return;
    filterInput.addEventListener('input', function() {
        const q = this.value.trim().toLowerCase();
        list.querySelectorAll('.v2-patho-item').forEach(function(item) {
            const match = item.textContent.trim().toLowerCase().includes(q);
            item.style.display = match ? '' : 'none';
        });
        list.querySelectorAll('.v2-patho-group').forEach(function(group) {
            const hasVisible = Array.from(group.querySelectorAll('.v2-patho-item')).some(function(i) { return i.style.display !== 'none'; });
            group.style.display = hasVisible ? '' : 'none';
            const title = group.previousElementSibling;
            if (title && title.classList.contains('v2-group-title')) title.style.display = hasVisible ? '' : 'none';
        });
    });
})();
</script>

<div class="card v2-section">
    <div class="card-header"><h3>💊 Traitement & suivi en cours</h3></div>
    <div class="card-body">
        <div class="v2-group-title">Suivi médical</div>
        <div class="v2-checkbox-grid">
            <?php foreach (['Médecin traitant', 'Spécialiste', 'Kiné / Ostéo', 'Psy / Psychothérapeute', 'Aucun'] as $v): ?>
            <label><input type="checkbox" name="suivi_medical_cb[]" value="<?= $v ?>" <?= $cb('suivi_medical', $v) ? 'checked' : '' ?>> <?= $v ?></label>
            <?php endforeach; ?>
        </div>

        <div class="form-group" style="margin-top:1rem;">
            <label class="form-label">Médicaments en cours</label>
            <textarea name="medicaments_encours" class="form-control" rows="2"><?= e($r('medicaments_encours')) ?></textarea>
        </div>
        <div class="form-group">
            <label class="form-label">Compléments alimentaires</label>
            <textarea name="complements_encours" class="form-control" rows="2"><?= e($r('complements_encours')) ?></textarea>
        </div>

        <div class="v2-group-title">Autres thérapies</div>
        <div class="v2-checkbox-grid">
            <?php foreach (['Acupuncture', 'Ostéopathie', 'Homéopathie', 'Sophrologie', 'Hypnose', 'Kinésiologie'] as $v): ?>
            <label><input type="checkbox" name="autres_therapies_cb[]" value="<?= $v ?>" <?= $cb('autres_therapies', $v) ? 'checked' : '' ?>> <?= $v ?></label>
            <?php endforeach; ?>
        </div>
        <div class="form-group" style="margin-top:.5rem;">
            <label class="form-label">Autres (à préciser)</label>
            <input type="text" name="autres_therapies_precision" class="form-control" value="<?= e($r('autres_therapies_precision')) ?>">
        </div>
    </div>
</div>
