<?php
require_once 'model/equipes_model.php';
require_once 'model/utilisateurs_model.php';

$titre_page = "Inscription de l'équipe";
$message_erreur = "";

// On charge les sessions pour générer le calendrier
$sessions = recupererSessions();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Nettoyage des entrées de base
    $nom_equipe = htmlspecialchars($_POST['nom_equipe'] ?? '');
    $pseudo_chef = htmlspecialchars($_POST['pseudo'] ?? '');
    $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $mdp = $_POST['mot_de_passe'] ?? '';
    $tel = htmlspecialchars($_POST['telephone'] ?? '');
    
    // 👉 NOUVEAU : Récupération du Nom et Prénom du capitaine
    $nom_chef = htmlspecialchars($_POST['nom'] ?? '');
    $prenom_chef = htmlspecialchars($_POST['prenom'] ?? '');
    
    // Données logistiques et de groupe
    $nb_participants = (int)($_POST['nb_participants'] ?? 0);
    $type_menu = htmlspecialchars($_POST['type_menu'] ?? '');
    $options_access = htmlspecialchars($_POST['options_accessibilite'] ?? '');
    $id_session = !empty($_POST['id_session']) ? (int)$_POST['id_session'] : null;

    // On s'assure que le nom et prénom sont bien remplis
    if (!empty($nom_equipe) && !empty($pseudo_chef) && !empty($email) && !empty($mdp) && !empty($id_session) && !empty($nom_chef) && !empty($prenom_chef)) {
        
        if (!verifierNomEquipeExiste($nom_equipe)) {
            $mdp_hash = password_hash($mdp, PASSWORD_DEFAULT);
            
            try {
                // 1. On crée l'équipe
                $id_equipe = creerEquipe($nom_equipe, $nb_participants, $type_menu, $options_access, $id_session);
                
                // 2. 👉 CORRECTION : On envoie bien les 7 informations au modèle !
                creerUtilisateur($id_equipe, $nom_chef, $prenom_chef, $pseudo_chef, $email, $tel, $mdp_hash);
                
                // 3. On enregistre dynamiquement les autres membres si le groupe est > 1
                if (isset($_POST['membre_nom']) && is_array($_POST['membre_nom'])) {
                    for ($i = 0; $i < count($_POST['membre_nom']); $i++) {
                        $m_nom = htmlspecialchars($_POST['membre_nom'][$i]);
                        $m_prenom = htmlspecialchars($_POST['membre_prenom'][$i]);
                        $m_pseudo = htmlspecialchars($_POST['membre_pseudo'][$i]);
                        
                        if (!empty($m_nom) && !empty($m_prenom)) {
                            ajouterMembreEquipe($id_equipe, $m_nom, $m_prenom, $m_pseudo);
                        }
                    }
                }
                
                // Redirection fluide après succès
                header('Location: index.php?action=connexion&succes=inscription');
                exit();
                
            } catch (Exception $e) {
                $message_erreur = "Erreur lors de la réservation : " . $e->getMessage();
            }
        } else {
            $message_erreur = "Ce nom d'équipe est déjà utilisé !";
        }
    } else {
        $message_erreur = "Veuillez remplir tous les champs obligatoires.";
    }
}

require_once 'view/inscription_view.php';