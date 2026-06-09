<?php
require_once 'conf/conf.inc.php';

// Récupère toutes les sessions de l'escape game
function recupererSessions() {
    global $bdd;
    $req = $bdd->query("SELECT id_session, date_session, est_complete FROM sessions ORDER BY date_session ASC");
    return $req->fetchAll();
}

function verifierNomEquipeExiste($nom_equipe) {
    global $bdd;
    $req = $bdd->prepare("SELECT id_equipe FROM equipes WHERE nom_equipe = :nom");
    $req->execute(['nom' => $nom_equipe]);
    return $req->fetch();
}

// Version complète modifiée pour insérer toutes les nouvelles données logistiques
function creerEquipe($nom_equipe, $nb_participants, $type_menu, $options_access, $id_session) {
    global $bdd;
    $req = $bdd->prepare("INSERT INTO equipes (nom_equipe, nb_participants, type_menu, options_accessibilite, id_session) 
                          VALUES (:nom, :nb, :menu, :options, :id_session)");
    $req->execute([
        'nom' => $nom_equipe,
        'nb' => $nb_participants,
        'menu' => $type_menu,
        'options' => $options_access,
        'id_session' => $id_session
    ]);
    return $bdd->lastInsertId();
}

// Ajoute un coéquipier dans la nouvelle table membres_equipe
function ajouterMembreEquipe($id_equipe, $nom, $prenom, $pseudo) {
    global $bdd;
    $req = $bdd->prepare("INSERT INTO membres_equipe (id_equipe, nom, prenom, pseudo) VALUES (:id_eq, :nom, :prenom, :pseudo)");
    return $req->execute([
        'id_eq' => $id_equipe,
        'nom' => $nom,
        'prenom' => $prenom,
        'pseudo' => $pseudo
    ]);
}
?>