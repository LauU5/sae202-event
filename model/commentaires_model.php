<?php
require_once 'conf/conf.inc.php';

function ajouterCommentaire($id_membre, $contenu, $note) {
    global $pdo; 
    
    // On ajoute 'note' dans la requête SQL
    $sql = "INSERT INTO commentaires (id_membre, contenu, note, date_publication) 
            VALUES (:id_membre, :contenu, :note, NOW())";
            
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':id_membre' => $id_membre,
        ':contenu'   => $contenu,
        ':note'      => $note // On relie la note ici
    ]);
}

function recupererCommentairesApprouves() {
    global $bdd;
    $req = $bdd->query("
        SELECT c.contenu, c.date_publication, u.pseudo, u.prenom 
        FROM commentaires c
        JOIN utilisateurs u ON c.id_utilisateur = u.id_utilisateur
        WHERE c.statut = 'approuve' 
        ORDER BY c.id_commentaire DESC 
        LIMIT 5
    ");
    return $req->fetchAll();
}
?>