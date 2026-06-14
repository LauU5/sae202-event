<?php
require_once __DIR__ . '/../conf/conf.inc.php';

function recupererToutesLesEquipes() {
    global $bdd;
    $req = $bdd->query("
        SELECT e.id_equipe, e.nom_equipe, e.nb_participants, e.type_menu,
               e.options_accessibilite, e.score_obtenu, s.date_session,
               u.nom, u.prenom, u.pseudo AS capitaine_pseudo, u.email, u.telephone
        FROM equipes e
        LEFT JOIN sessions s ON e.id_session = s.id_session
        LEFT JOIN utilisateurs u ON e.id_equipe = u.id_equipe
        ORDER BY s.date_session ASC, e.nom_equipe ASC
    ");
    return $req->fetchAll();
}

function recupererSessionsAvecEquipes() {
    global $bdd;
    $req = $bdd->query("
        SELECT s.id_session, s.date_session, s.est_complete,
               e.nom_equipe, e.nb_participants
        FROM sessions s
        LEFT JOIN equipes e ON e.id_session = s.id_session
        ORDER BY s.date_session ASC
    ");
    return $req->fetchAll();
}

function recupererTousLesInscrits() {
    global $bdd;
    $req = $bdd->query("
        SELECT u.id_utilisateur, u.pseudo, u.email, u.telephone,
               e.nom_equipe, e.nb_participants, e.type_menu, s.date_session
        FROM utilisateurs u
        LEFT JOIN equipes e ON u.id_equipe = e.id_equipe
        LEFT JOIN sessions s ON e.id_session = s.id_session
        ORDER BY s.date_session ASC, u.pseudo ASC
    ");
    return $req->fetchAll();
}

function recupererMembresEquipe($id_equipe) {
    global $bdd;
    $req = $bdd->prepare("SELECT prenom, nom, pseudo FROM membres_equipe WHERE id_equipe = :id");
    $req->execute(['id' => $id_equipe]);
    return $req->fetchAll();
}

function mettreAJourScoreEquipe($id_equipe, $score) {
    global $bdd;
    $req = $bdd->prepare("UPDATE equipes SET score_obtenu = :score WHERE id_equipe = :id");
    return $req->execute(['score' => $score, 'id' => $id_equipe]);
}

function recupererCommentairesEnAttente() {
    global $bdd;
    $req = $bdd->query("
        SELECT c.id_commentaire, c.contenu, c.date_publication, u.pseudo
        FROM commentaires c
        JOIN utilisateurs u ON c.id_utilisateur = u.id_utilisateur
        WHERE c.statut = 'en_attente'
        ORDER BY c.date_publication ASC
    ");
    return $req->fetchAll();
}

function changerStatutCommentaire($id_commentaire, $statut) {
    global $bdd;
    $req = $bdd->prepare("UPDATE commentaires SET statut = :statut WHERE id_commentaire = :id");
    return $req->execute(['statut' => $statut, 'id' => $id_commentaire]);
}

function recupererStatistiquesDashboard() {
    global $bdd;
    $stats = ['joueurs_attendus' => 0, 'avis_attente' => 0, 'taux_reussite' => '0'];

    try {
        $r1 = $bdd->query("SELECT COUNT(id_commentaire) AS total FROM commentaires WHERE statut = 'en_attente'");
        if ($r1) { $stats['avis_attente'] = $r1->fetch()['total']; }

        $r2 = $bdd->query("SELECT SUM(nb_participants) AS total FROM equipes");
        if ($r2) { $res = $r2->fetch(); $stats['joueurs_attendus'] = $res['total'] ?? 0; }

        $r3 = $bdd->query("SELECT COUNT(id_equipe) AS total FROM equipes WHERE score_obtenu > 0");
        $r4 = $bdd->query("SELECT COUNT(id_equipe) AS victoires FROM equipes WHERE score_obtenu >= 50");
        if ($r3 && $r4) {
            $total     = $r3->fetch()['total'];
            $victoires = $r4->fetch()['victoires'];
            if ($total > 0) {
                $stats['taux_reussite'] = round(($victoires / $total) * 100);
            }
        }
    } catch (Exception $e) {}

    return $stats;
}
?>