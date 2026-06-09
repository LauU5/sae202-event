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
    // Jointure pour récupérer le score de l'équipe du joueur
    $req = $bdd->prepare("SELECT u.pseudo, u.telephone, e.score_obtenu 
                          FROM utilisateurs u 
                          JOIN equipes e ON u.id_equipe = e.id_equipe 
                          WHERE u.id_utilisateur = :id");
    $req->execute(['id' => $id_user]);
    return $req->fetch();
}
?>