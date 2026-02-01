<?php
/**
 * Fonctions utilitaires
 */

function e(string $str): string {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

function redirect(string $page, array $params = []): void {
    $url = APP_URL . '/index.php?page=' . $page;
    if (!empty($params)) {
        $url .= '&' . http_build_query($params);
    }
    header('Location: ' . $url);
    exit;
}

function url(string $page, array $params = []): string {
    $url = APP_URL . '/index.php?page=' . $page;
    if (!empty($params)) {
        $url .= '&' . http_build_query($params);
    }
    return $url;
}

function flashSet(string $type, string $message): void {
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}

function flashGet(): ?array {
    if (isset($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $flash;
    }
    return null;
}

function formatDate(?string $date): string {
    if (!$date) return '-';
    return date('d/m/Y', strtotime($date));
}

function timeAgo(string $datetime): string {
    $diff = time() - strtotime($datetime);
    if ($diff < 60) return "à l'instant";
    if ($diff < 3600) return floor($diff / 60) . ' min';
    if ($diff < 86400) return floor($diff / 3600) . 'h';
    if ($diff < 604800) return floor($diff / 86400) . 'j';
    return formatDate($datetime);
}

function getPost(string $key, $default = ''): string {
    return trim($_POST[$key] ?? $default);
}

function getGet(string $key, $default = ''): string {
    return trim($_GET[$key] ?? $default);
}

// Sauvegarder les réponses d'une section du questionnaire
function saveReponses(int $consultationId, string $section, array $questions): void {
    $db = getDB();

    // Supprimer les anciennes réponses de cette section
    $stmt = $db->prepare('DELETE FROM consultation_reponses WHERE consultation_id = ? AND section = ?');
    $stmt->execute([$consultationId, $section]);

    // Insérer les nouvelles
    $stmt = $db->prepare('INSERT INTO consultation_reponses (consultation_id, section, sous_section, question_key, question_label, reponse, score) VALUES (?, ?, ?, ?, ?, ?, ?)');

    foreach ($questions as $q) {
        $value = getPost($q['key'], '');
        if ($value !== '') {
            $stmt->execute([
                $consultationId,
                $section,
                $q['sous_section'] ?? null,
                $q['key'],
                $q['label'],
                $value,
                $q['score'] ?? null,
            ]);
        }
    }
}

// Récupérer les réponses d'une consultation
function getReponses(int $consultationId, ?string $section = null): array {
    $db = getDB();
    if ($section) {
        $stmt = $db->prepare('SELECT * FROM consultation_reponses WHERE consultation_id = ? AND section = ? ORDER BY id');
        $stmt->execute([$consultationId, $section]);
    } else {
        $stmt = $db->prepare('SELECT * FROM consultation_reponses WHERE consultation_id = ? ORDER BY id');
        $stmt->execute([$consultationId]);
    }
    $rows = $stmt->fetchAll();

    // Indexer par question_key
    $indexed = [];
    foreach ($rows as $row) {
        $indexed[$row['question_key']] = $row;
    }
    return $indexed;
}

// Récupérer la valeur d'une réponse
function getReponseValue(array $reponses, string $key, string $default = ''): string {
    return $reponses[$key]['reponse'] ?? $default;
}
