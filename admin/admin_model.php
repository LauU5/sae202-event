<?php
// On remonte d'un dossier pour trouver conf.inc.php
require_once '../conf/conf.inc.php';

function recupererTousLesInscrits() {
    global $bdd;
    $req = $bdd->query("SELECT u.pseudo, u.email, u.telephone, e.nom_equipe 
                        FROM utilisateurs u 
                        JOIN equipes e ON u.id_equipe = e.id_equipe 
                        ORDER BY e.nom_equipe ASC");
    return $req->fetchAll();
}

function recupererToutesLesEquipes() {
    global $bdd;
    $req = $bdd->query("SELECT id_equipe, nom_equipe, score_obtenu FROM equipes ORDER BY nom_equipe ASC");
    return $req->fetchAll();
}

function mettreAJourScoreEquipe($id_equipe, $score) {
    global $bdd;
    $req = $bdd->prepare("UPDATE equipes SET score_obtenu = :score WHERE id_equipe = :id");
    return $req->execute(['score' => $score, 'id' => $id_equipe]);
}

function recupererCommentairesEnAttente() {
    global $bdd;
    $req = $bdd->query("SELECT c.id_commentaire, c.contenu, c.date_publication, u.pseudo 
                        FROM commentaires c 
                        JOIN utilisateurs u ON c.id_utilisateur = u.id_utilisateur 
                        WHERE c.statut = 'en_attente' ORDER BY c.date_publication ASC");
    return $req->fetchAll();
}

function changerStatutCommentaire($id_commentaire, $statut) {
    global $bdd;
    $req = $bdd->prepare("UPDATE commentaires SET statut = :statut WHERE id_commentaire = :id");
    return $req->execute(['statut' => $statut, 'id' => $id_commentaire]);
}
?>