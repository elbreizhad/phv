<?php
/**
 * Page publique - Accès client à la téléconsultation
 * Pas d'authentification requise
 */

$token = getGet('token', '');
$db = getDB();

// Rechercher le RDV par token (visio_room_id)
$rdv = null;
$praticien = null;

if (!empty($token)) {
    $stmt = $db->prepare("
        SELECT r.*, c.nom AS client_nom, c.prenom AS client_prenom,
               u.nom AS praticien_nom, u.prenom AS praticien_prenom
        FROM rendez_vous r
        LEFT JOIN clients c ON r.client_id = c.id
        LEFT JOIN users u ON r.user_id = u.id
        WHERE r.visio_room_id = ?
    ");
    $stmt->execute([$token]);
    $rdv = $stmt->fetch();
}

$jitsiDomain = 'meet.jit.si';
$roomId = $token;
$clientName = $rdv ? ($rdv['client_prenom'] . ' ' . $rdv['client_nom']) : 'Invité';
$praticienName = $rdv ? ($rdv['praticien_prenom'] . ' ' . $rdv['praticien_nom']) : 'Praticien';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Téléconsultation - <?= e(APP_NAME) ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #4a6741 0%, #3d5636 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .header {
            background: rgba(255,255,255,0.1);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            color: white;
            font-size: 1.2rem;
            font-weight: 500;
        }

        .header-info {
            color: rgba(255,255,255,0.8);
            font-size: 0.9rem;
        }

        .container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }

        .card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            max-width: 500px;
            width: 100%;
            overflow: hidden;
        }

        .card-header {
            background: #4a6741;
            color: white;
            padding: 2rem;
            text-align: center;
        }

        .card-header h2 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .card-header p {
            opacity: 0.9;
        }

        .card-body {
            padding: 2rem;
        }

        .info-box {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }

        .info-box p {
            margin: 0.5rem 0;
            color: #555;
        }

        .info-box strong {
            color: #333;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #333;
        }

        .form-group input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.2s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #4a6741;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 1rem;
            background: #4a6741;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn:hover {
            background: #3d5636;
        }

        .btn-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .requirements {
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid #eee;
        }

        .requirements h4 {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 0.75rem;
        }

        .requirements ul {
            list-style: none;
            font-size: 0.85rem;
            color: #777;
        }

        .requirements li {
            padding: 0.25rem 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .requirements li::before {
            content: "✓";
            color: #4a6741;
            font-weight: bold;
        }

        .error-card {
            text-align: center;
            padding: 3rem 2rem;
        }

        .error-card svg {
            width: 64px;
            height: 64px;
            color: #dc3545;
            margin-bottom: 1rem;
        }

        .error-card h2 {
            color: #333;
            margin-bottom: 0.5rem;
        }

        .error-card p {
            color: #666;
        }

        /* Jitsi container */
        .visio-fullscreen {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: #1a1a1a;
            z-index: 1000;
        }

        .visio-header {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            background: rgba(0,0,0,0.5);
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1001;
        }

        .visio-header h3 {
            color: white;
            font-size: 1rem;
        }

        .btn-leave {
            background: #dc3545;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            cursor: pointer;
        }

        #jitsi-frame {
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>PHV Naturo - Téléconsultation</h1>
        <?php if ($rdv): ?>
            <span class="header-info">Consultation avec <?= e($praticienName) ?></span>
        <?php endif; ?>
    </div>

    <div class="container" id="welcome-screen">
        <?php if (!$rdv): ?>
            <!-- Erreur: lien invalide -->
            <div class="card">
                <div class="error-card">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="12" y1="8" x2="12" y2="12"/>
                        <line x1="12" y1="16" x2="12.01" y2="16"/>
                    </svg>
                    <h2>Lien invalide</h2>
                    <p>Ce lien de téléconsultation n'existe pas ou a expiré.</p>
                    <p style="margin-top: 1rem; font-size: 0.9rem;">Veuillez contacter votre praticien pour obtenir un nouveau lien.</p>
                </div>
            </div>
        <?php else: ?>
            <!-- Écran d'accueil -->
            <div class="card">
                <div class="card-header">
                    <h2>Bienvenue à votre consultation</h2>
                    <p>Consultation vidéo avec <?= e($praticienName) ?></p>
                </div>
                <div class="card-body">
                    <div class="info-box">
                        <p><strong>Date :</strong> <?= date('d/m/Y', strtotime($rdv['date_rdv'])) ?></p>
                        <p><strong>Heure :</strong> <?= date('H:i', strtotime($rdv['heure_debut'])) ?> - <?= date('H:i', strtotime($rdv['heure_fin'])) ?></p>
                        <?php if ($rdv['titre']): ?>
                            <p><strong>Motif :</strong> <?= e($rdv['titre']) ?></p>
                        <?php endif; ?>
                    </div>

                    <form id="join-form" onsubmit="joinCall(event)">
                        <div class="form-group">
                            <label for="display-name">Votre nom (affiché dans la vidéo)</label>
                            <input type="text" id="display-name" value="<?= e($clientName) ?>" required>
                        </div>

                        <button type="submit" class="btn btn-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polygon points="23 7 16 12 23 17 23 7"/>
                                <rect x="1" y="5" width="15" height="14" rx="2" ry="2"/>
                            </svg>
                            Rejoindre la consultation
                        </button>
                    </form>

                    <div class="requirements">
                        <h4>Avant de commencer, vérifiez que :</h4>
                        <ul>
                            <li>Votre webcam fonctionne</li>
                            <li>Votre micro est activé</li>
                            <li>Vous êtes dans un endroit calme</li>
                            <li>Votre connexion internet est stable</li>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Zone de visio (cachée au départ) -->
    <div class="visio-fullscreen" id="visio-screen" style="display: none;">
        <div id="jitsi-frame"></div>
    </div>

    <?php if ($rdv): ?>
    <script src="https://meet.jit.si/external_api.js"></script>
    <script>
        let api = null;

        function joinCall(e) {
            e.preventDefault();

            const displayName = document.getElementById('display-name').value;

            // Masquer écran d'accueil, afficher visio
            document.getElementById('welcome-screen').style.display = 'none';
            document.getElementById('visio-screen').style.display = 'block';

            // Initialiser Jitsi
            const options = {
                roomName: '<?= e($roomId) ?>',
                width: '100%',
                height: '100%',
                parentNode: document.querySelector('#jitsi-frame'),
                userInfo: {
                    displayName: displayName
                },
                configOverwrite: {
                    startWithAudioMuted: false,
                    startWithVideoMuted: false,
                    prejoinPageEnabled: false,
                    disableDeepLinking: true,
                    defaultLanguage: 'fr'
                },
                interfaceConfigOverwrite: {
                    TOOLBAR_BUTTONS: [
                        'microphone', 'camera', 'fullscreen',
                        'chat', 'raisehand', 'tileview', 'hangup'
                    ],
                    SHOW_JITSI_WATERMARK: false,
                    SHOW_WATERMARK_FOR_GUESTS: false,
                    DEFAULT_BACKGROUND: '#1a1a1a',
                    MOBILE_APP_PROMO: false
                }
            };

            api = new JitsiMeetExternalAPI('<?= $jitsiDomain ?>', options);

            // Événements
            api.addListener('videoConferenceLeft', function() {
                // Retour à l'écran d'accueil ou fermeture
                document.getElementById('visio-screen').style.display = 'none';
                document.getElementById('welcome-screen').style.display = 'flex';
                document.querySelector('.card-header h2').textContent = 'Consultation terminée';
                document.querySelector('.card-header p').textContent = 'Merci pour votre consultation';
                document.querySelector('.card-body').innerHTML = `
                    <p style="text-align: center; padding: 2rem;">
                        La consultation vidéo est terminée.<br><br>
                        Vous pouvez fermer cette fenêtre.
                    </p>
                `;
            });

            // Mot de passe si requis
            api.addEventListener('passwordRequired', function() {
                const password = prompt('Mot de passe de la salle :');
                if (password) {
                    api.executeCommand('password', password);
                }
            });
        }
    </script>
    <?php endif; ?>
</body>
</html>
