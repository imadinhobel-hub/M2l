<?php
require_once __DIR__ . '/adminUtils.php';

verifierConnexionAdmin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom'] ?? '');
    $site = trim($_POST['site'] ?? '');
    $descriptif = trim($_POST['descriptif'] ?? '');

    if ($nom === '') {
        redirigerVersAdmin('ligues', "Le nom de la ligue est obligatoire.");
    }

    try {
        ajouterLigue($nom, $site, $descriptif);
        redirigerVersAdmin('ligues', "Ligue ajoutée.");
    } catch (Exception $e) {
        redirigerVersAdmin('ligues', "Erreur : " . $e->getMessage());
    }
}

redirigerVersAdmin('ligues');
