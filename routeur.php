<?php

session_start();


$action = $_GET['action'] ?? 'accueil';

switch ($action) {
    case 'accueil':
        require_once 'controller/accueil_controller.php';
        break;
    case 'concept':
        require_once 'controller/concept_controller.php';
        break;
    case 'infos':
        require_once 'controller/infos_controller.php';
        break;
    case 'mentions':
        require_once 'controller/mentions_controller.php';
        break;
    case 'inscription':
        require_once 'controller/inscription_controller.php';
        break;
    case 'connexion':
        require_once 'controller/connexion_controller.php';
        break;
    case 'deconnexion':
        require_once 'controller/deconnexion_controller.php';
        break;
    case 'profil':
        
        if(isset($_SESSION['id_utilisateur'])) {
            require_once 'controller/profil_controller.php';
        } else {
            header('Location: index.php?action=connexion');
            exit();
        }
        break;
    case 'avis':
        
        if(isset($_SESSION['id_utilisateur'])) {
            require_once 'controller/avis_controller.php';
        } else {
            header('Location: index.php?action=connexion');
            exit();
        }
        break;
    default:
        
        require_once 'controller/accueil_controller.php';
        break;
}
?>