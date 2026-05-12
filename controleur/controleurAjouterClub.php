<?php
require_once __DIR__ . '/adminUtils.php';

verifierConnexionAdmin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom'] ?? '');
    $adresse = trim($_POST['adresse'] ?? '');
    $idCommune = (int) ($_POST['idCommune'] ?? 0);
    $idLigue = (int) ($_POST['idLigue'] ?? 0);

    if ($nom === '' || $adresse === '' || $idCommune <= 0 || $idLigue <= 0) {
        redirigerVersAdmin('clubs', "Tous les champs du club sont obligatoires.");
    }

    try {
        ClubDAO::createClub($nom, $adresse, $idCommune, $idLigue);
        redirigerVersAdmin('clubs', "Club ajouté.");
    } catch (Exception $e) {
        redirigerVersAdmin('clubs', "Erreur : " . $e->getMessage());
    }
}

redirigerVersAdmin('clubs');
