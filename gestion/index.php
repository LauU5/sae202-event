<?php
session_start();
require_once 'admin_model.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['action']) && $_POST['action'] === 'maj_score') {
        $id_equipe = (int)$_POST['id_equipe'];
        $score     = (int)$_POST['score'];
        mettreAJourScoreEquipe($id_equipe, $score);
        $message = "Le score a été mis à jour avec succès.";
    }

    if (isset($_POST['action']) && $_POST['action'] === 'moderation') {
        $id_commentaire = (int)$_POST['id_commentaire'];
        $statut = $_POST['decision'] === 'approuver' ? 'approuve' : 'refuse';
        changerStatutCommentaire($id_commentaire, $statut);
        $message = "L'avis a été " . ($statut === 'approuve' ? "approuvé" : "refusé") . ".";
    }
}

$onglet = $_GET['onglet'] ?? 'dashboard';

if ($onglet === 'equipes' || $onglet === 'temps') {
    $equipes = recupererToutesLesEquipes();
}
if ($onglet === 'commentaires') {
    $commentaires = recupererCommentairesEnAttente();
}
if ($onglet === 'dashboard') {
    $stats    = recupererStatistiquesDashboard();
    $sessions = recupererSessionsAvecEquipes();
}

require_once 'admin_view.php';
?>