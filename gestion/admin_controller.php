<?php
require_once 'admin_model.php';

$message = "";

// =========================================================
// 1. GESTION DES ACTIONS DU FORMULAIRE (Ton code intact)
// =========================================================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['action']) && $_POST['action'] === 'maj_score') {
        $id_equipe = (int)$_POST['id_equipe'];
        $score     = (int)$_POST['score'];
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

// =========================================================
// 2. GESTION DES ONGLETS (La nouveauté)
// =========================================================
$onglet = isset($_GET['onglet']) ? $_GET['onglet'] : 'dashboard';


// =========================================================
// 3. CHARGEMENT DES DONNÉES SELON L'ONGLET
// =========================================================
if ($onglet === 'equipes' || $onglet === 'temps') {
    // On a besoin des équipes pour l'onglet "Equipes" et pour le menu déroulant de l'onglet "Temps"
    $equipes = recupererToutesLesEquipes();
}

if ($onglet === 'commentaires') {
    // On ne charge les commentaires que si l'admin clique sur cet onglet
    $commentaires = recupererCommentairesEnAttente();
}

if ($onglet === 'dashboard') {
    // Plus tard, tu pourras charger tes statistiques ici
    // $stats = recupererStatistiques();
}

// =========================================================
// 4. APPEL DE LA VUE
// =========================================================
require_once 'admin_view.php';
