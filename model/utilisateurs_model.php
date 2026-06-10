// ... (tes anciennes fonctions comme recupererInfosUtilisateur, etc.)

// Met à jour les infos complètes du capitaine
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

// Met à jour un coéquipier spécifique
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

// Ajoute un commentaire en attente
function ajouterCommentaire($id_u, $contenu) {
    global $bdd;
    $req = $bdd->prepare("INSERT INTO commentaires (id_utilisateur, contenu, statut) VALUES (:id_u, :cont, 'en_attente')");
    return $req->execute(['id_u' => $id_u, 'cont' => $contenu]);
}
?>