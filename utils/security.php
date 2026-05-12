<?php

function verifyCsrfToken() {
    // Ne pas vérifier pour les requêtes GET sauf si critique
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        return true;
    }

    if (empty($_SESSION['csrf_token']) || empty($_POST['csrf_token'])) {
        error_log("CSRF Error: Token manquant");
        return false;
    }

    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        error_log("CSRF Error: Token invalide");
        return false;
    }

    return true;
}

/*function verifyCsrfToken() {
    // Vérifie si la session est active
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    // Ne vérifie que les requêtes potentiellement dangereuses
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $requestToken = $_POST['csrf_token'] ?? '';
        if (!isset($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $requestToken)) {
            http_response_code(403);
            die("Erreur CSRF : Token invalide ou expiré");
        }
    }
}

function generateCsrfToken() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}*/
?>