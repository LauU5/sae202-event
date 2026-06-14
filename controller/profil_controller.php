<?php
require_once 'model/utilisateurs_model.php';
require_once 'model/equipes_model.php';
require_once 'model/commentaires_model.php';

if (!isset($_SESSION['id_utilisateur'])) {
    header('Location: index.php?action=connexion');
    exit();
}

$id_user = $_SESSION['id_utilisateur'];
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['action']) && $_POST['action'] === 'update_infos') {
        $nom    = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $tel    = htmlspecialchars($_POST['telephone']);
        $email  = htmlspecialchars($_POST['email']);

        mettreAJourProfilComplet($id_user, $nom, $prenom, $pseudo, $tel, $email);
        $_SESSION['pseudo'] = $pseudo;

        if (!empty($_POST['mot_de_passe'])) {
            $nouveau_mdp = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);
            mettreAJourMotDePasse($id_user, $nouveau_mdp);
        }

        $message = "Informations personnelles mises à jour !";
    }

    if (isset($_POST['action']) && $_POST['action'] === 'update_equipe') {
        if (isset($_POST['membre_id'])) {
            for ($i = 0; $i < count($_POST['membre_id']); $i++) {
                $id_m     = (int)$_POST['membre_id'][$i];
                $nom_m    = htmlspecialchars($_POST['membre_nom'][$i]);
                $prenom_m = htmlspecialchars($_POST['membre_prenom'][$i]);
                $pseudo_m = htmlspecialchars($_POST['membre_pseudo'][$i]);
                
                modifierMembreEquipe($id_m, $nom_m, $prenom_m, $pseudo_m);
            }
        }
        $message = "Noms des coéquipiers mis à jour !";
    }

    if (isset($_POST['action']) && $_POST['action'] === 'envoyer_avis') {
        $contenu = htmlspecialchars($_POST['commentaire']);
        ajouterCommentaire($id_user, $contenu);
        $message = "Votre avis a été envoyé et est en attente de modération.";
    }
}

$infos   = recupererInfosUtilisateur($id_user);
$membres = recupererMembresEquipeParUtilisateur($id_user);

require_once 'view/profil_view.php';
?>