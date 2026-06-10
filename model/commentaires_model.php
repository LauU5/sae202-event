<?php
require_once 'conf/conf.inc.php';

function ajouterCommentaire($id_user, $contenu) {
    global $bdd;
    $req = $bdd->prepare("INSERT INTO commentaires (id_utilisateur, contenu) VALUES (:id_user, :contenu)");
    return $req->execute([
        'id_user' => $id_user,
        'contenu' => $contenu
    ]);
}

function recupererCommentairesApprouves() {
    global $bdd;
    $req = $bdd->query("
        SELECT c.contenu, u.pseudo, u.prenom 
        FROM commentaires c
        JOIN utilisateurs u ON c.id_utilisateur = u.id_utilisateur
        WHERE c.statut = 'valide' 
        ORDER BY c.id_commentaire DESC 
        LIMIT 5
    ");
    return $req->fetchAll();
}
?>