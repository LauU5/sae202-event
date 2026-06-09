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

// Récupère les infos du chef d'équipe, de son équipe et de sa réservation
function recupererInfosUtilisateur($id_user) {
    global $bdd;
    $req = $bdd->prepare("SELECT u.pseudo, u.telephone, u.email, e.nom_equipe, e.score_obtenu, e.type_menu, e.options_accessibilite, e.nb_participants, s.date_session 
                          FROM utilisateurs u 
                          JOIN equipes e ON u.id_equipe = e.id_equipe 
                          LEFT JOIN sessions s ON e.id_session = s.id_session
                          WHERE u.id_utilisateur = :id");
    $req->execute(['id' => $id_user]);
    return $req->fetch();
}

// Récupère la liste des autres participants de l'équipe
function recupererMembresEquipeParUtilisateur($id_user) {
    global $bdd;
    $req = $bdd->prepare("SELECT m.nom, m.prenom, m.pseudo 
                          FROM membres_equipe m
                          JOIN equipes e ON m.id_equipe = e.id_equipe
                          JOIN utilisateurs u ON e.id_equipe = u.id_equipe
                          WHERE u.id_utilisateur = :id");
    $req->execute(['id' => $id_user]);
    return $req->fetchAll();
}