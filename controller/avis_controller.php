<?php
require_once 'model/commentaires_model.php';

if (!isset($_SESSION['id_utilisateur'])) {
    header('Location: index.php?action=connexion');
    exit();
}

$titre_page = "Laisser un avis";
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contenu = htmlspecialchars($_POST['contenu']); // Anti-XSS
    
    if (!empty($contenu)) {
        // Fonction à créer dans commentaires_model.php : INSERT INTO commentaires...
        ajouterCommentaire($_SESSION['id_utilisateur'], $contenu);
        $message = "Merci ! Votre avis a été soumis et est en attente d'approbation par un administrateur.";
    }
}
require_once 'view/avis_view.php';