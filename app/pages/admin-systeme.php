<?php
/**
 * Administration - Système (déploiement)
 */
?>

<div class="page-header">
    <div>
        <h1>Administration — Système</h1>
        <p class="subtitle">Réservé aux administrateurs</p>
    </div>
</div>

<div class="page-body animate-in">
    <div class="card">
        <div class="card-header">
            <h3>Mise à jour du site</h3>
        </div>
        <div class="card-body">
            <p class="text-muted mb-2">Télécharge la dernière version du site depuis GitHub et l'installe. Vos données (base de données, exports) ne sont pas affectées.</p>
            <form method="POST" onsubmit="return confirm('Actualiser le site depuis GitHub ?');">
                <input type="hidden" name="action" value="site-update">
                <button type="submit" class="btn btn-primary">Actualiser le site</button>
            </form>
        </div>
    </div>
</div>
