<?php
/**
 * Téléconsultation - Page praticien
 * Intégration Jitsi Meet pour consultations vidéo
 */

$rdvId = (int)getGet('rdv', 0);
$db = getDB();

// Récupérer le RDV avec les infos client
$rdv = null;
$client = null;

if ($rdvId > 0) {
    $stmt = $db->prepare("
        SELECT r.*, c.nom AS client_nom, c.prenom AS client_prenom, c.email AS client_email
        FROM rendez_vous r
        LEFT JOIN clients c ON r.client_id = c.id
        WHERE r.id = ? AND r.user_id = ?
    ");
    $stmt->execute([$rdvId, currentUserId()]);
    $rdv = $stmt->fetch();
}

// Générer ou récupérer la salle Jitsi
$roomId = '';
$roomPassword = '';
$jitsiDomain = 'meet.jit.si'; // Serveur public Jitsi (gratuit)

if ($rdv) {
    if (empty($rdv['visio_room_id'])) {
        // Générer un ID de salle unique
        $roomId = 'phv-' . bin2hex(random_bytes(8)) . '-' . $rdvId;
        $roomPassword = strtoupper(bin2hex(random_bytes(3))); // 6 caractères

        // Sauvegarder en base
        $stmt = $db->prepare("
            UPDATE rendez_vous
            SET visio_enabled = TRUE, visio_room_id = ?, visio_password = ?
            WHERE id = ?
        ");
        $stmt->execute([$roomId, $roomPassword, $rdvId]);
    } else {
        $roomId = $rdv['visio_room_id'];
        $roomPassword = $rdv['visio_password'];
    }
}

// Récupérer les paramètres praticien
$stmt = $db->prepare("SELECT * FROM user_settings WHERE user_id = ?");
$stmt->execute([currentUserId()]);
$settings = $stmt->fetch();
$praticienNom = currentUserName();
?>

<div class="page-header">
    <div>
        <h1>Téléconsultation</h1>
        <?php if ($rdv): ?>
            <p>Consultation vidéo avec <?= e($rdv['client_prenom'] . ' ' . $rdv['client_nom']) ?></p>
        <?php else: ?>
            <p>Démarrer une consultation vidéo</p>
        <?php endif; ?>
    </div>
    <div class="page-actions">
        <a href="<?= url('agenda') ?>" class="btn btn-secondary">Retour à l'agenda</a>
    </div>
</div>

<div class="page-body">
    <?php if (!$rdv): ?>
        <!-- Sélection du RDV -->
        <div class="card">
            <div class="card-header">
                <h2>Sélectionner un rendez-vous</h2>
            </div>
            <div class="card-body">
                <?php
                // RDV du jour avec visio
                $stmt = $db->prepare("
                    SELECT r.*, c.nom AS client_nom, c.prenom AS client_prenom
                    FROM rendez_vous r
                    LEFT JOIN clients c ON r.client_id = c.id
                    WHERE r.user_id = ?
                    AND r.date_rdv = CURDATE()
                    AND r.statut IN ('planifie', 'confirme', 'en_cours')
                    ORDER BY r.heure_debut
                ");
                $stmt->execute([currentUserId()]);
                $rdvsJour = $stmt->fetchAll();
                ?>

                <?php if (empty($rdvsJour)): ?>
                    <p class="text-muted">Aucun rendez-vous prévu aujourd'hui.</p>
                    <a href="<?= url('agenda') ?>" class="btn btn-primary">Voir l'agenda</a>
                <?php else: ?>
                    <p>Rendez-vous du jour :</p>
                    <div class="rdv-list" style="display: grid; gap: 1rem; margin-top: 1rem;">
                        <?php foreach ($rdvsJour as $r): ?>
                            <a href="<?= url('teleconsultation') ?>&rdv=<?= $r['id'] ?>" class="card" style="text-decoration: none; padding: 1rem;">
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <div>
                                        <strong><?= e($r['client_prenom'] . ' ' . $r['client_nom']) ?></strong>
                                        <br>
                                        <small><?= date('H:i', strtotime($r['heure_debut'])) ?> - <?= date('H:i', strtotime($r['heure_fin'])) ?></small>
                                    </div>
                                    <span class="btn btn-primary">Démarrer visio</span>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <hr style="margin: 2rem 0;">

                <h3>Ou démarrer une salle libre</h3>
                <p>Créer une salle de téléconsultation sans rendez-vous associé.</p>
                <button type="button" class="btn btn-secondary" onclick="startFreeRoom()">Créer une salle libre</button>
            </div>
        </div>
    <?php else: ?>
        <!-- Interface de téléconsultation -->
        <div class="visio-container" style="display: grid; grid-template-columns: 1fr 350px; gap: 1.5rem;">
            <!-- Zone vidéo -->
            <div class="card">
                <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                    <h2>Consultation en cours</h2>
                    <div class="visio-status" id="visio-status">
                        <span class="badge badge-warning">En attente du client</span>
                    </div>
                </div>
                <div class="card-body" style="padding: 0;">
                    <div id="jitsi-container" style="height: 500px; background: #1a1a1a; border-radius: 0 0 8px 8px;"></div>
                </div>
                <div class="card-footer" style="display: flex; gap: 1rem; justify-content: center;">
                    <button type="button" class="btn btn-danger" onclick="endCall()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
                        Terminer l'appel
                    </button>
                </div>
            </div>

            <!-- Panneau latéral -->
            <div class="visio-sidebar">
                <!-- Infos client -->
                <div class="card">
                    <div class="card-header">
                        <h3>Client</h3>
                    </div>
                    <div class="card-body">
                        <p><strong><?= e($rdv['client_prenom'] . ' ' . $rdv['client_nom']) ?></strong></p>
                        <p class="text-muted">
                            <?= date('H:i', strtotime($rdv['heure_debut'])) ?> - <?= date('H:i', strtotime($rdv['heure_fin'])) ?>
                        </p>
                        <?php if ($rdv['client_id']): ?>
                            <a href="<?= url('client-view') ?>&id=<?= $rdv['client_id'] ?>" class="btn btn-secondary btn-sm" target="_blank">
                                Voir fiche client
                            </a>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Lien à partager -->
                <div class="card">
                    <div class="card-header">
                        <h3>Lien pour le client</h3>
                    </div>
                    <div class="card-body">
                        <p class="text-muted" style="font-size: 0.85rem;">Partagez ce lien avec votre client pour qu'il rejoigne la consultation :</p>

                        <?php
                        $clientLink = APP_URL . '/index.php?page=visio-client&token=' . $rdv['visio_room_id'];
                        ?>

                        <div class="input-group" style="margin: 1rem 0;">
                            <input type="text" id="client-link" value="<?= e($clientLink) ?>" readonly
                                   style="flex: 1; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px 0 0 4px; font-size: 0.8rem;">
                            <button type="button" onclick="copyLink()" class="btn btn-primary" style="border-radius: 0 4px 4px 0;">
                                Copier
                            </button>
                        </div>

                        <?php if ($roomPassword): ?>
                            <p style="font-size: 0.85rem;">
                                <strong>Mot de passe :</strong>
                                <code style="background: #f5f5f5; padding: 0.2rem 0.5rem; border-radius: 4px;"><?= e($roomPassword) ?></code>
                            </p>
                        <?php endif; ?>

                        <?php if ($rdv['client_email']): ?>
                            <hr>
                            <button type="button" class="btn btn-secondary btn-sm" onclick="sendEmailInvite()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                                Envoyer par email
                            </button>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Notes rapides -->
                <div class="card">
                    <div class="card-header">
                        <h3>Notes de consultation</h3>
                    </div>
                    <div class="card-body">
                        <textarea id="visio-notes" rows="6" placeholder="Prenez des notes pendant la consultation..."
                                  style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 4px; resize: vertical;"><?= e($rdv['notes'] ?? '') ?></textarea>
                        <button type="button" class="btn btn-secondary btn-sm" onclick="saveNotes()" style="margin-top: 0.5rem;">
                            Sauvegarder
                        </button>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php if ($rdv): ?>
<script src="https://meet.jit.si/external_api.js"></script>
<script>
let api = null;

document.addEventListener('DOMContentLoaded', function() {
    initJitsi();
});

function initJitsi() {
    const domain = '<?= $jitsiDomain ?>';
    const options = {
        roomName: '<?= e($roomId) ?>',
        width: '100%',
        height: '100%',
        parentNode: document.querySelector('#jitsi-container'),
        userInfo: {
            displayName: '<?= e($praticienNom) ?> (Praticien)'
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
                'microphone', 'camera', 'desktop', 'fullscreen',
                'chat', 'raisehand', 'videoquality', 'tileview',
                'settings'
            ],
            SHOW_JITSI_WATERMARK: false,
            SHOW_WATERMARK_FOR_GUESTS: false,
            DEFAULT_BACKGROUND: '#1a1a1a',
            DISABLE_JOIN_LEAVE_NOTIFICATIONS: false,
            MOBILE_APP_PROMO: false
        }
    };

    api = new JitsiMeetExternalAPI(domain, options);

    // Événements
    api.addListener('participantJoined', function(participant) {
        document.getElementById('visio-status').innerHTML = '<span class="badge badge-success">Client connecté</span>';
    });

    api.addListener('participantLeft', function(participant) {
        document.getElementById('visio-status').innerHTML = '<span class="badge badge-warning">Client déconnecté</span>';
    });

    api.addListener('videoConferenceLeft', function() {
        // Rediriger vers l'agenda après fin de l'appel
        window.location.href = '<?= url('agenda') ?>';
    });

    // Définir le mot de passe de la salle
    api.addEventListener('passwordRequired', function() {
        api.executeCommand('password', '<?= e($roomPassword) ?>');
    });

    api.addEventListener('participantRoleChanged', function(event) {
        if (event.role === 'moderator') {
            api.executeCommand('password', '<?= e($roomPassword) ?>');
        }
    });
}

function endCall() {
    if (confirm('Voulez-vous vraiment terminer la consultation ?')) {
        if (api) {
            api.executeCommand('hangup');
        }
        window.location.href = '<?= url('agenda') ?>';
    }
}

function copyLink() {
    const linkInput = document.getElementById('client-link');
    linkInput.select();
    document.execCommand('copy');
    alert('Lien copié dans le presse-papier !');
}

function sendEmailInvite() {
    const subject = encodeURIComponent('Lien pour votre téléconsultation');
    const body = encodeURIComponent(
        'Bonjour,\n\n' +
        'Voici le lien pour rejoindre votre téléconsultation :\n\n' +
        '<?= e($clientLink) ?>\n\n' +
        'Mot de passe de la salle : <?= e($roomPassword) ?>\n\n' +
        'À très bientôt,\n' +
        '<?= e($praticienNom) ?>'
    );
    window.open('mailto:<?= e($rdv['client_email']) ?>?subject=' + subject + '&body=' + body);
}

function saveNotes() {
    const notes = document.getElementById('visio-notes').value;

    fetch('<?= url('rdv-notes-save') ?>', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'rdv_id=<?= $rdvId ?>&notes=' + encodeURIComponent(notes)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Notes sauvegardées !');
        }
    })
    .catch(err => {
        console.error(err);
        alert('Erreur lors de la sauvegarde');
    });
}

function startFreeRoom() {
    // Créer une salle sans RDV
    const roomId = 'phv-libre-' + Date.now();
    window.location.href = 'https://<?= $jitsiDomain ?>/' + roomId;
}
</script>

<style>
.visio-container {
    min-height: 600px;
}

.visio-sidebar .card {
    margin-bottom: 1rem;
}

.visio-sidebar .card-header h3 {
    font-size: 1rem;
    margin: 0;
}

.badge-success {
    background: #28a745;
    color: white;
}

.badge-warning {
    background: #ffc107;
    color: #333;
}

@media (max-width: 1024px) {
    .visio-container {
        grid-template-columns: 1fr;
    }

    #jitsi-container {
        height: 400px;
    }
}
</style>
<?php endif; ?>
