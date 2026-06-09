<?php
require_once 'model/utilisateurs_model.php';
$titre_page = "Connexion";
$erreur = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $mdp = $_POST['mot_de_passe'];

    // Fonction à ajouter dans utilisateurs_model.php :
    // SELECT id_utilisateur, mot_de_passe, pseudo FROM utilisateurs WHERE email = :email
    $utilisateur = verifierUtilisateur($email);

    if ($utilisateur && password_verify($mdp, $utilisateur['mot_de_passe'])) {
        // Connexion réussie, création des sessions
        $_SESSION['id_utilisateur'] = $utilisateur['id_utilisateur'];
        $_SESSION['pseudo'] = $utilisateur['pseudo'];
        header('Location: index.php?action=profil');
        exit();
    } else {
        $erreur = "Email ou mot de passe incorrect.";
    }
}
require_once 'view/connexion_view.php';
