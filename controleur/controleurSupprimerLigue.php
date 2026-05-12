<?php
require_once __DIR__ . '/adminUtils.php';

verifierConnexionAdmin();

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id <= 0) {
    redirigerVersAdmin('ligues', "Ligue introuvable.");
}

try {
    supprimerLigue($id);
    redirigerVersAdmin('ligues', "Ligue supprimée.");
} catch (Exception $e) {
    redirigerVersAdmin('ligues', "Erreur : " . $e->getMessage());
}
