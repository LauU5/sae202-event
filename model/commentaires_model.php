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
    global $bdd; // Si la ligne du haut manque, $bdd sera "null" ici
    $req = $bdd->query("SELECT c.contenu, c.date_publication, u.pseudo 
                        FROM commentaires c 
                        JOIN utilisateurs u ON c.id_utilisateur = u.id_utilisateur 
                        WHERE c.statut = 'approuve' 
                        ORDER BY c.date_publication DESC");
    return $req->fetchAll();
}
?>