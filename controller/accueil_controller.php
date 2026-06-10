<?php
// CORRECTION : utilisation de __DIR__ pour garantir le bon chemin
require_once __DIR__ . '/../model/commentaires_model.php';

$titre_page = "Accueil";

$avis_publics = recupererCommentairesApprouves();

require_once 'view/accueil_view.php';
?>