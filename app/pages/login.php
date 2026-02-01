<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - <?= e(APP_NAME) ?></title>
    <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/style.css">
</head>
<body>
<div class="login-page">
    <div class="login-card animate-in">
        <div class="brand">
            <h1>PHV Naturo</h1>
            <div class="leaf-accent"></div>
            <p>Outil d'aide a la consultation en naturopathie</p>
        </div>

        <?php $flash = flashGet(); if ($flash): ?>
            <div class="alert alert-<?= e($flash['type']) ?>">
                <?= e($flash['message']) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?= url('login') ?>">
            <input type="hidden" name="action" value="login">

            <div class="form-group">
                <label class="form-label">Identifiant</label>
                <input type="text" name="username" class="form-control" placeholder="Votre identifiant" required autofocus>
            </div>

            <div class="form-group">
                <label class="form-label">Mot de passe</label>
                <input type="password" name="password" class="form-control" placeholder="Votre mot de passe" required>
            </div>

            <button type="submit" class="btn btn-primary btn-block btn-lg" style="margin-top: 1.5rem;">
                Se connecter
            </button>
        </form>

        <p class="text-center text-muted text-sm" style="margin-top: 2rem;">
            v<?= APP_VERSION ?>
        </p>
    </div>
</div>
</body>
</html>
