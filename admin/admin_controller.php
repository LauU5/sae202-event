<?php
require_once 'admin_model.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['action']) && $_POST['action'] === 'maj_score') {
        $id_equipe = (int)$_POST['id_equipe'];
        $score = (int)$_POST['score'];
        mettreAJourScoreEquipe($id_equipe, $score);
        $message = "Score mis à jour avec succès.";
    }

    if (isset($_POST['action']) && $_POST['action'] === 'moderation') {
        $id_commentaire = (int)$_POST['id_commentaire'];
        $statut = $_POST['decision'] === 'approuver' ? 'approuve' : 'refuse';
        changerStatutCommentaire($id_commentaire, $statut);
        $message = "Commentaire " . ($statut === 'approuve' ? "approuvé" : "refusé") . ".";
    }
}

$inscrits = recupererTousLesInscrits();
$equipes = recupererToutesLesEquipes();
$commentaires = recupererCommentairesEnAttente();

require_once 'admin_view.php';
?>