<?php
require_once __DIR__ . '/adminUtils.php';

verifierConnexionAdmin();

$id = isset($_GET['id']) ? (int) $_GET['id'] : (int) ($_POST['id'] ?? 0);

if ($id <= 0) {
    redirigerVersAdmin('ligues', "Ligue introuvable.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom'] ?? '');
    $site = trim($_POST['site'] ?? '');
    $descriptif = trim($_POST['descriptif'] ?? '');

    if ($nom === '') {
        redirigerVersAdmin('ligues', "Le nom de la ligue est obligatoire.");
    }

    try {
        modifierLigue($id, $nom, $site, $descriptif);
        redirigerVersAdmin('ligues', "Ligue modifiée.");
    } catch (Exception $e) {
        redirigerVersAdmin('ligues', "Erreur : " . $e->getMessage());
    }
}

$ligueEnEdition = getLigueById($id);
if (!$ligueEnEdition) {
    redirigerVersAdmin('ligues', "Ligue introuvable.");
}

afficherPageAdmin('ligues', $ligueEnEdition);
