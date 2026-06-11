<?php
// On démarre la session (utile si tu veux gérer des messages flash)
session_start();
require_once 'admin_model.php';

$message = "";

// 1. Traitement des formulaires de l'admin (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Saisie des scores
    if (isset($_POST['action']) && $_POST['action'] === 'maj_score') {
        $id_equipe = (int)$_POST['id_equipe'];
        $score = (int)$_POST['score'];
        mettreAJourScoreEquipe($id_equipe, $score);
        $message = "Le score a été mis à jour avec succès.";
    }
    
    // Modération des avis
    if (isset($_POST['action']) && $_POST['action'] === 'moderation') {
        $id_commentaire = (int)$_POST['id_commentaire'];
        $statut = $_POST['decision'] === 'approuver' ? 'approuve' : 'refuse';
        changerStatutCommentaire($id_commentaire, $statut);
        $message = "L'avis a été " . ($statut === 'approuve' ? "approuvé" : "refusé") . ".";
    }
}

// 2. Récupération de TOUTES les données
$equipes = recupererToutesLesEquipes();
$commentaires = recupererCommentairesEnAttente();

// 3. Appel de la vue Back-Office
require_once 'admin_view.php';
?>