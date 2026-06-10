<?php
require_once 'conf/conf.inc.php';

function creerUtilisateur($id_equipe, $pseudo, $email, $mdp_hash, $tel) {
    global $bdd;
    $req = $bdd->prepare("INSERT INTO utilisateurs (id_equipe, pseudo, email, mot_de_passe, telephone) VALUES (:id_eq, :pseudo, :email, :mdp, :tel)");
    return $req->execute([
        'id_eq' => $id_equipe,
        'pseudo' => $pseudo,
        'email' => $email,
        'mdp' => $mdp_hash,
        'tel' => $tel
    ]);
}

function verifierUtilisateur($email) {
    global $bdd;
    $req = $bdd->prepare("SELECT id_utilisateur, mot_de_passe, pseudo FROM utilisateurs WHERE email = :email");
    $req->execute(['email' => $email]);
    return $req->fetch();
}

function mettreAJourProfil($id_user, $pseudo, $tel) {
    global $bdd;
    $req = $bdd->prepare("UPDATE utilisateurs SET pseudo = :pseudo, telephone = :tel WHERE id_utilisateur = :id");
    return $req->execute([
        'pseudo' => $pseudo,
        'tel' => $tel,
        'id' => $id_user
    ]);
}

function recupererInfosUtilisateur($id_user) {
    global $bdd;
    
    $req = $bdd->prepare("SELECT u.pseudo, u.telephone, e.score_obtenu 
                          FROM utilisateurs u 
                          JOIN equipes e ON u.id_equipe = e.id_equipe 
                          WHERE u.id_utilisateur = :id");
    $req->execute(['id' => $id_user]);
    return $req->fetch();
}



function mettreAJourProfilComplet($id, $nom, $prenom, $pseudo, $tel, $email) {
    global $bdd;
    $req = $bdd->prepare("UPDATE utilisateurs SET pseudo = :ps, telephone = :tel, email = :em, nom = :nom, prenom = :pre WHERE id_utilisateur = :id");
    return $req->execute([
        'ps' => $pseudo,
        'tel' => $tel,
        'em' => $email,
        'nom' => $nom,
        'pre' => $prenom,
        'id' => $id
    ]);
}


function modifierMembreEquipe($id_m, $nom, $prenom, $pseudo) {
    global $bdd;
    $req = $bdd->prepare("UPDATE membres_equipe SET nom = :nom, prenom = :pre, pseudo = :ps WHERE id_membre = :id");
    return $req->execute([
        'nom' => $nom,
        'pre' => $prenom,
        'ps' => $pseudo,
        'id' => $id_m
    ]);
}


function ajouterCommentaire($id_u, $contenu) {
    global $bdd;
    $req = $bdd->prepare("INSERT INTO commentaires (id_utilisateur, contenu, statut) VALUES (:id_u, :cont, 'en_attente')");
    return $req->execute(['id_u' => $id_u, 'cont' => $contenu]);
}
?>
