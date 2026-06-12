<?php
require_once '../conf/conf.inc.php';

function recupererToutesLesEquipes() {
    global $bdd;
    $req = $bdd->query("
        SELECT e.id_equipe, e.nom_equipe, e.nb_participants, e.type_menu, e.options_accessibilite, e.score_obtenu,
               s.date_session,
               u.pseudo AS capitaine_pseudo, u.email, u.telephone
        FROM equipes e
        LEFT JOIN sessions s ON e.id_session = s.id_session
        LEFT JOIN utilisateurs u ON e.id_equipe = u.id_equipe
        ORDER BY s.date_session ASC, e.nom_equipe ASC
    ");
    return $req->fetchAll();
}

// CORRECTION : fonction manquante — appelée dans admin_controller.php mais jamais définie
function recupererTousLesInscrits() {
    global $bdd;
    $req = $bdd->query("
        SELECT u.id_utilisateur, u.pseudo, u.email, u.telephone,
               e.nom_equipe, e.nb_participants, e.type_menu,
               s.date_session
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
    
    // On prépare des valeurs par défaut au cas où la BDD est vide
    $stats = [
        'note_globale' => '0',
        'joueurs_attendus' => 0,
        'avis_attente' => 0,
        'taux_reussite' => '0'
    ];

    try {
        // 1. AVIS EN ATTENTE (On compte les commentaires avec le statut 'attente')
        $req1 = $bdd->query("SELECT COUNT(id_commentaire) AS total FROM commentaires WHERE statut = 'attente'");
        if ($req1) { $stats['avis_attente'] = $req1->fetch()['total']; }

        // 2. NOTE GLOBALE (On fait la moyenne de la colonne 'note' des commentaires approuvés)
        // /!\ Assure-toi d'avoir une colonne 'note' (int) dans ta table commentaires
        $req2 = $bdd->query("SELECT ROUND(AVG(note), 1) AS moyenne FROM commentaires WHERE statut = 'approuve'");
        if ($req2) { 
            $res = $req2->fetch();
            $stats['note_globale'] = $res['moyenne'] ? $res['moyenne'] : '0'; 
        }

        // 3. JOUEURS ATTENDUS (On fait la somme du nombre de participants dans les équipes)
        $req3 = $bdd->query("SELECT SUM(nb_participants) AS total FROM equipes");
        if ($req3) { 
            $res = $req3->fetch();
            $stats['joueurs_attendus'] = $res['total'] ? $res['total'] : 0; 
        }

        // 4. TAUX DE RÉUSSITE (On calcule le % d'équipes qui ont plus de 50 en score)
        $req4_tot = $bdd->query("SELECT COUNT(id_equipe) AS total FROM equipes WHERE score > 0");
        $req4_vic = $bdd->query("SELECT COUNT(id_equipe) AS victoires FROM equipes WHERE score >= 50");
        if ($req4_tot && $req4_vic) {
            $total = $req4_tot->fetch()['total'];
            $victoires = $req4_vic->fetch()['victoires'];
            if ($total > 0) {
                $stats['taux_reussite'] = round(($victoires / $total) * 100);
            }
        }
    } catch(Exception $e) {
        // Si une colonne manque dans la BDD, ça n'affichera pas d'erreur fatale, ça mettra juste 0
    }

    return $stats;
}
?>