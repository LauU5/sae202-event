<?php
// On remonte d'un dossier pour trouver la connexion à la BDD
require_once '../conf/conf.inc.php';

// 1. Récupérer toutes les équipes avec leurs options et la date de session
function recupererToutesLesEquipes() {
    global $bdd;
    $req = $bdd->query("
        SELECT e.id_equipe, e.nom_equipe, e.nb_participants, e.type_menu, e.options_accessibilite, e.score_obtenu, 
               s.date_session, 
               u.pseudo AS capitaine_pseudo, u.email, u.telephone
        FROM equipes e
        LEFT JOIN sessions s ON e.id_session = s.id_session
        LEFT JOIN utilisateurs u ON e.id_equipe = u.id_equipe
        ORDER BY s.date_session ASC, e.nom_equipe ASC
    ");
    return $req->fetchAll();
}

// 2. Récupérer les autres membres d'une équipe précise
function recupererMembresEquipe($id_equipe) {
    global $bdd;
    $req = $bdd->prepare("SELECT prenom, nom, pseudo FROM membres_equipe WHERE id_equipe = :id");
    $req->execute(['id' => $id_equipe]);
    return $req->fetchAll();
}

// 3. Mise à jour du score
function mettreAJourScoreEquipe($id_equipe, $score) {
    global $bdd;
    $req = $bdd->prepare("UPDATE equipes SET score_obtenu = :score WHERE id_equipe = :id");
    return $req->execute(['score' => $score, 'id' => $id_equipe]);
}

// 4. Modération des commentaires
function recupererCommentairesEnAttente() {
    global $bdd;
    $req = $bdd->query("
        SELECT c.id_commentaire, c.contenu, c.date_publication, u.pseudo 
        FROM commentaires c 
        JOIN utilisateurs u ON c.id_utilisateur = u.id_utilisateur 
        WHERE c.statut = 'en_attente' 
        ORDER BY c.date_publication ASC
    ");
    return $req->fetchAll();
}

function changerStatutCommentaire($id_commentaire, $statut) {
    global $bdd;
    $req = $bdd->prepare("UPDATE commentaires SET statut = :statut WHERE id_commentaire = :id");
    return $req->execute(['statut' => $statut, 'id' => $id_commentaire]);
}
?>