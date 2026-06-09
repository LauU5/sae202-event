<?php
require_once 'model/commentaires_model.php'; // On inclut le modèle

$titre_page = "Accueil";

// On récupère les avis validés par l'admin
$avis_publics = recupererCommentairesApprouves();

// Appel de la vue
require_once 'view/accueil_view.php';
?>