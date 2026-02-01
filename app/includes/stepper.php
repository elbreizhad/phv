<?php
/**
 * Stepper de consultation - à inclure en haut de chaque étape
 * Variables attendues: $consultation, $currentStep
 */
$steps = CONSULTATION_STEPS;
?>
<div class="stepper">
    <?php foreach ($steps as $num => $step): ?>
        <?php
        $state = '';
        if ($num < $currentStep) $state = 'completed';
        elseif ($num === $currentStep) $state = 'active';
        ?>
        <div class="step <?= $state ?>">
            <div class="step-number">
                <?php if ($state === 'completed'): ?>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" width="14" height="14"><polyline points="20 6 9 17 4 12"/></svg>
                <?php else: ?>
                    <?= $num ?>
                <?php endif; ?>
            </div>
            <span class="step-label"><?= e($step['label']) ?></span>
        </div>
    <?php endforeach; ?>
</div>
