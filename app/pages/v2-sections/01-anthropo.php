<?php /** @var callable $r */ /** @var callable $cb */ ?>
<div class="v2-tip">💡 <strong>Rappel posture</strong> — Accueil chaleureux · laisser s'installer · proposer de l'eau · écoute active sans jugement. 1 séance = 1 motif principal. Reformuler. Valider les émotions. Notes discrètes.</div>

<div class="card v2-section">
    <div class="card-header"><h3>👁️ Données anthropométriques</h3></div>
    <div class="card-body">
        <div class="v2-grid-4">
            <div class="form-group"><label class="form-label">Taille (cm)</label><input type="number" id="v2_taille_cm" name="taille_cm" class="form-control" value="<?= e($r('taille_cm')) ?>"></div>
            <div class="form-group"><label class="form-label">Poids (kg)</label><input type="number" step="0.1" id="v2_poids_kg" name="poids_kg" class="form-control" value="<?= e($r('poids_kg')) ?>"></div>
            <div class="form-group"><label class="form-label">IMC <span class="text-sm text-muted">(auto)</span></label><input type="text" id="v2_imc" name="imc" class="form-control" value="<?= e($r('imc')) ?>" readonly style="background:#f9f9f7;"></div>
            <div class="form-group"><label class="form-label">Tour de taille (cm)</label><input type="number" name="tour_taille_cm" class="form-control" value="<?= e($r('tour_taille_cm')) ?>"></div>
        </div>
        <div id="v2_imc_interpretation" class="form-hint" style="margin-top:-.5rem;"></div>
    </div>
</div>

<script>
(function() {
    const taille = document.getElementById('v2_taille_cm');
    const poids = document.getElementById('v2_poids_kg');
    const imc = document.getElementById('v2_imc');
    const interp = document.getElementById('v2_imc_interpretation');
    function calcIMC() {
        const t = parseFloat(taille.value);
        const p = parseFloat(poids.value);
        if (!t || !p || t <= 0) { imc.value = ''; interp.textContent = ''; return; }
        const m = t / 100;
        const v = p / (m * m);
        imc.value = v.toFixed(1);
        let cat = '', color = '';
        if (v < 16.5) { cat = 'Dénutrition sévère'; color = '#d85a3d'; }
        else if (v < 18.5) { cat = 'Maigreur'; color = '#e0a829'; }
        else if (v < 25) { cat = 'Corpulence normale'; color = '#4a6741'; }
        else if (v < 30) { cat = 'Surpoids'; color = '#e0a829'; }
        else if (v < 35) { cat = 'Obésité modérée'; color = '#d85a3d'; }
        else if (v < 40) { cat = 'Obésité sévère'; color = '#d85a3d'; }
        else { cat = 'Obésité morbide'; color = '#d85a3d'; }
        interp.innerHTML = '<span style="color:' + color + ';font-weight:500;">IMC ' + v.toFixed(1) + ' — ' + cat + '</span>';
    }
    taille.addEventListener('input', calcIMC);
    poids.addEventListener('input', calcIMC);
    calcIMC();
})();
</script>
