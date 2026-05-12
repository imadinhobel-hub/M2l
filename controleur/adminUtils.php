<?php
require_once __DIR__ . '/../modele/dao/ligueDAO.php';
require_once __DIR__ . '/../modele/dao/clubDAO.php';

function verifierConnexionAdmin() {
    if (empty($_SESSION['identification'])) {
        $_SESSION['erreurConnexion'] = "Veuillez vous connecter.";
        $_SESSION['m2lMP'] = 'connexion';
        header('Location: index.php');
        exit;
    }
}

function chargerDonneesAdmin() {
    return [
        'ligues' => getAllLigues(),
        'clubs' => ClubDAO::getAllClubsWithDetails(),
        'communes' => ClubDAO::getAllCommunes()
    ];
}

function afficherPageAdmin($section, $ligueEnEdition = null, $clubEnEdition = null) {
    $messageAdmin = $_SESSION['admin_message'] ?? '';
    unset($_SESSION['admin_message']);

    // La vue admin inclut `vue/haut.php`, qui attend cette variable.
    // Comme la vue est chargée depuis cette fonction, on la relaie dans la portée locale.
    $menuPrincipalM2L = $GLOBALS['menuPrincipalM2L'] ?? '';

    $donneesAdmin = chargerDonneesAdmin();
    $ligues = $donneesAdmin['ligues'];
    $clubs = $donneesAdmin['clubs'];
    $communes = $donneesAdmin['communes'];

    require 'vue/vueAdmin.php';
}

function redirigerVersAdmin($section, $message = '') {
    if ($message !== '') {
        $_SESSION['admin_message'] = $message;
    }

    header('Location: index.php?m2lMP=admin&section=' . urlencode($section));
    exit;
}
