<?php
require_once 'conf/conf.inc.php';


function ajouterCommentaire($id_utilisateur, $contenu, $note) {
    global $bdd; 
    
    // On remplace id_membre par id_utilisateur dans la requête
    $sql = "INSERT INTO commentaires (id_utilisateur, contenu, note, date_publication) 
            VALUES (:id_utilisateur, :contenu, :note, NOW())";
            
    $stmt = $bdd->prepare($sql);
    $stmt->execute([
        ':id_utilisateur' => $id_utilisateur,
        ':contenu'        => $contenu,
        ':note'           => $note 
    ]);
}

function recupererCommentairesApprouves() {
    global $bdd;

    $req = $bdd->query("
        SELECT c.contenu, c.note, c.date_publication, u.pseudo, u.prenom 
        FROM commentaires c
        JOIN utilisateurs u ON c.id_utilisateur = u.id_utilisateur
        WHERE c.statut = 'approuve' 
        ORDER BY c.id_commentaire DESC 
        LIMIT 5
    ");
    return $req->fetchAll();
}
?>