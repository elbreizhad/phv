<?php
/**
 * Stepper V2 (16 étapes) - compact horizontal
 * Variables attendues : $consultation, $currentStep
 */
$steps = CONSULTATION_STEPS_V2;
?>
<div class="stepper stepper-v2">
    <?php foreach ($steps as $num => $step): ?>
        <?php
        $state = '';
        if ($num < $currentStep) $state = 'completed';
        elseif ($num === $currentStep) $state = 'active';
        $url = $num === 16
            ? url('consultation-step6', ['id' => $consultation['id']])
            : url('consultation-v2', ['id' => $consultation['id'], 'step' => $num]);
        $clickable = $num <= $currentStep;
        ?>
        <?php if ($clickable): ?>
            <a href="<?= $url ?>" class="step-v2 <?= $state ?>" title="<?= e($step['label']) ?>">
        <?php else: ?>
            <div class="step-v2 <?= $state ?>" title="<?= e($step['label']) ?>">
        <?php endif; ?>
            <div class="step-number">
                <?php if ($state === 'completed'): ?>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" width="12" height="12"><polyline points="20 6 9 17 4 12"/></svg>
                <?php else: ?>
                    <span class="step-emoji"><?= $step['emoji'] ?></span>
                <?php endif; ?>
            </div>
            <span class="step-label-v2"><?= $num ?>. <?= e($step['label']) ?></span>
        <?php echo $clickable ? '</a>' : '</div>'; ?>
    <?php endforeach; ?>
</div>

<style>
.stepper-v2 {
    display: flex;
    flex-wrap: wrap;
    gap: .4rem;
    margin-bottom: 1.5rem;
    padding: .8rem;
    background: #f9f9f7;
    border-radius: 8px;
    max-width: 100%;
    overflow-x: auto;
}
.step-v2 {
    display: flex;
    align-items: center;
    gap: .4rem;
    padding: .35rem .6rem;
    border-radius: 999px;
    background: #fff;
    border: 1px solid #e4e2dc;
    text-decoration: none;
    color: #666;
    font-size: 12px;
    line-height: 1.2;
    transition: all .15s;
    flex-shrink: 0;
}
.step-v2:hover { border-color: #a2b59a; color: #2c3e2c; }
.step-v2.completed { background: #e8f0e3; border-color: #7a9b6e; color: #3a5a2e; }
.step-v2.active { background: #4a6741; border-color: #4a6741; color: #fff; font-weight: 600; }
.step-v2 .step-number {
    width: 22px; height: 22px;
    display: inline-flex; align-items: center; justify-content: center;
    border-radius: 50%;
    background: rgba(0,0,0,.06);
    font-size: 13px;
    flex-shrink: 0;
}
.step-v2.active .step-number { background: rgba(255,255,255,.2); }
.step-label-v2 { white-space: nowrap; }
@media (max-width: 1400px) {
    .step-label-v2 { display: none; }
    .step-v2 { padding: .35rem; }
}
</style>
