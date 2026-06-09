<?php
require_once 'model/utilisateurs_model.php';

// Sécurité : si non connecté, on dégage
if (!isset($_SESSION['id_utilisateur'])) {
    header('Location: index.php?action=connexion');
    exit();
}

$titre_page = "Mon Profil";
$id_user = $_SESSION['id_utilisateur'];
$message = "";

// Traitement de la mise à jour (Modification des infos)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $tel = htmlspecialchars($_POST['telephone']);
    
    // Fonction à ajouter dans utilisateurs_model.php pour l'UPDATE SQL
    mettreAJourProfil($id_user, $pseudo, $tel);
    $message = "Profil mis à jour avec succès !";
    $_SESSION['pseudo'] = $pseudo; // On met à jour la session
}

// Récupération des infos actuelles pour pré-remplir le formulaire
// (Fonction à créer avec un SELECT JOIN sur la table equipes pour avoir le score)
$infos = recupererInfosUtilisateur($id_user); 

require_once 'view/profil_view.php';
