<?php
require_once __DIR__ . '/adminUtils.php';

verifierConnexionAdmin();

$id = isset($_GET['id']) ? (int) $_GET['id'] : (int) ($_POST['id'] ?? 0);

if ($id <= 0) {
    redirigerVersAdmin('clubs', "Club introuvable.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom'] ?? '');
    $adresse = trim($_POST['adresse'] ?? '');
    $idCommune = (int) ($_POST['idCommune'] ?? 0);
    $idLigue = (int) ($_POST['idLigue'] ?? 0);

    if ($nom === '' || $adresse === '' || $idCommune <= 0 || $idLigue <= 0) {
        redirigerVersAdmin('clubs', "Tous les champs du club sont obligatoires.");
    }

    try {
        ClubDAO::updateClub($id, $nom, $adresse, $idCommune, $idLigue);
        redirigerVersAdmin('clubs', "Club modifié.");
    } catch (Exception $e) {
        redirigerVersAdmin('clubs', "Erreur : " . $e->getMessage());
    }
}

$clubEnEdition = ClubDAO::getClubById($id);
if (!$clubEnEdition) {
    redirigerVersAdmin('clubs', "Club introuvable.");
}

afficherPageAdmin('clubs', null, $clubEnEdition);
