<?php
require_once __DIR__ . '/adminUtils.php';

verifierConnexionAdmin();

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id <= 0) {
    redirigerVersAdmin('clubs', "Club introuvable.");
}

try {
    ClubDAO::deleteClub($id);
    redirigerVersAdmin('clubs', "Club supprimé.");
} catch (Exception $e) {
    redirigerVersAdmin('clubs', "Erreur : " . $e->getMessage());
}
