<?php
require_once 'model/equipes_model.php';
require_once 'model/utilisateurs_model.php';

$titre_page = "Inscription de l'équipe";
$message_erreur = "";

// On charge les sessions pour générer le calendrier
$sessions = recupererSessions();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Nettoyage des entrées du Chef d'équipe (Anti-XSS)
    $nom_equipe = htmlspecialchars($_POST['nom_equipe']);
    $pseudo_chef = htmlspecialchars($_POST['pseudo']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $mdp = $_POST['mot_de_passe'];
    $tel = htmlspecialchars($_POST['telephone']);
    
    // Données logistiques et de groupe
    $nb_participants = (int)$_POST['nb_participants'];
    $type_menu = htmlspecialchars($_POST['type_menu']);
    $options_access = htmlspecialchars($_POST['options_accessibilite']);
    $id_session = !empty($_POST['id_session']) ? (int)$_POST['id_session'] : null;

    if (!empty($nom_equipe) && !empty($pseudo_chef) && !empty($email) && !empty($mdp) && !empty($id_session)) {
        if (!verifierNomEquipeExiste($nom_equipe)) {
            
            $mdp_hash = password_hash($mdp, PASSWORD_DEFAULT);
            
            try {
                // 1. On crée l'équipe modifiée
                $id_equipe = creerEquipe($nom_equipe, $nb_participants, $type_menu, $options_access, $id_session);
                
                // 2. On crée le compte utilisateur principal (Le Chef d'équipe)
                creerUtilisateur($id_equipe, $pseudo_chef, $email, $mdp_hash, $tel);
                
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
        $message_erreur = "Veuillez remplir tous les champs obligatoires (incluant la date).";
    }
}

require_once 'view/autres_pages/inscription_view.php';
?>