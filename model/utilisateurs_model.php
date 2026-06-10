<?php

require_once __DIR__ . '/../conf/conf.inc.php';

function recupererInfosUtilisateur($id_utilisateur) {
    global $bdd;
    $req = $bdd->prepare("
        SELECT u.*, e.nom_equipe, e.nb_participants, e.type_menu, e.options_accessibilite, e.score_obtenu, s.date_session
        FROM utilisateurs u
        LEFT JOIN equipes e ON u.id_equipe = e.id_equipe
        LEFT JOIN sessions s ON e.id_session = s.id_session
        WHERE u.id_utilisateur = :id
    ");
    $req->execute(['id' => $id_utilisateur]);
    return $req->fetch();
}

function recupererMembresEquipeParUtilisateur($id_utilisateur) {
    global $bdd;
    $req = $bdd->prepare("
        SELECT m.* FROM membres_equipe m
        JOIN utilisateurs u ON m.id_equipe = u.id_equipe
        WHERE u.id_utilisateur = :id
    ");
    $req->execute(['id' => $id_utilisateur]);
    return $req->fetchAll();
}


function creerUtilisateur($id_equipe, $pseudo, $email, $mdp_hash, $tel) {
    global $bdd;
    $req = $bdd->prepare("INSERT INTO utilisateurs (id_equipe, pseudo, email, mot_de_passe, telephone)
                          VALUES (:id_equipe, :pseudo, :email, :mdp, :tel)");
    return $req->execute([
        'id_equipe' => $id_equipe,
        'pseudo'    => $pseudo,
        'email'     => $email,
        'mdp'       => $mdp_hash,
        'tel'       => $tel
    ]);
}


function verifierUtilisateur($email) {
    global $bdd;
    $req = $bdd->prepare("SELECT id_utilisateur, mot_de_passe, pseudo FROM utilisateurs WHERE email = :email");
    $req->execute(['email' => $email]);
    return $req->fetch();
}

function mettreAJourProfilComplet($id, $nom, $prenom, $pseudo, $tel, $email) {
    global $bdd;
    $req = $bdd->prepare("UPDATE utilisateurs SET pseudo = :ps, telephone = :tel, email = :em, nom = :nom, prenom = :pre WHERE id_utilisateur = :id");
    return $req->execute([
        'ps'  => $pseudo,
        'tel' => $tel,
        'em'  => $email,
        'nom' => $nom,
        'pre' => $prenom,
        'id'  => $id
    ]);
}

function modifierMembreEquipe($id_m, $nom, $prenom, $pseudo) {
    global $bdd;
    $req = $bdd->prepare("UPDATE membres_equipe SET nom = :nom, prenom = :pre, pseudo = :ps WHERE id_membre = :id");
    return $req->execute([
        'nom' => $nom,
        'pre' => $prenom,
        'ps'  => $pseudo,
        'id'  => $id_m
    ]);
}

function recupererAvisValides() {
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