<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_GET['m2lMP'])) {
    $_SESSION['m2lMP'] = $_GET['m2lMP'];
} else {
    if (!isset($_SESSION['m2lMP'])) {
        $_SESSION['m2lMP'] = "accueil";
    }
}

// Génération du menu
$m2lMP = new Menu("m2lMP");

$m2lMP->ajouterComposant($m2lMP->creerItemLien("accueil", "Accueil"));
$m2lMP->ajouterComposant($m2lMP->creerItemLien("services", "Services"));
$m2lMP->ajouterComposant($m2lMP->creerItemLien("locaux", "Locaux"));
$m2lMP->ajouterComposant($m2lMP->creerItemLien("ligues", "Ligues"));

if (isset($_SESSION['identification']) && $_SESSION['identification']) {
    
    $m2lMP->ajouterComposant($m2lMP->creerItemLien("deconnexion", "Se déconnecter"));
} else {
    $m2lMP->ajouterComposant($m2lMP->creerItemLien("connexion", "Se connecter"));
}

$menuPrincipalM2L = $m2lMP->creerMenu($_SESSION['m2lMP'], 'm2lMP');

// Dispatch vers le bon contrôleur
// Dispatch vers le bon contrôleur
switch ($_SESSION['m2lMP']) {
    case 'accueil':
        include_once 'controleur/controleurAccueil.php';
        break;
    case 'services':
        include_once 'controleur/controleurServices.php';
        break;
    case 'locaux':
        include_once 'controleur/controleurLocaux.php';
        break;
    case 'ligues':
        include_once 'controleur/controleurLigues.php';
        break;
    case 'connexion':
        include_once 'controleur/controleurConnexion.php';
        break;
    case 'deconnexion':
        include_once 'controleur/controleurDeconnexion.php';
        break;
    case 'admin':
        include_once 'controleur/controleurAdmin.php';
        break;
    case 'ajouterLigue':
        include_once 'controleur/controleurAjouterLigue.php';
        break;
    case 'modifierLigue':
        include_once 'controleur/controleurModifierLigue.php';
        break;
    case 'supprimerLigue':
        include_once 'controleur/controleurSupprimerLigue.php';
        break;
    case 'ajouterClub':
        include_once 'controleur/controleurAjouterClub.php';
        break;
    case 'modifierClub':
        include_once 'controleur/controleurModifierClub.php';
        break;
    case 'supprimerClub':
        include_once 'controleur/controleurSupprimerClub.php';
        break;
}
  

if (isset($vue)) {
    include_once($vue);
}
