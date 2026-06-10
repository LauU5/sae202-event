<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Back-Office | Framed Escape Game</title>
    <link rel="stylesheet" href="../view/css/style.css">
</head>
<body>

    <header>
        <h1>Espace Administration - Framed</h1>
        <nav>
            <ul>
                <li><a href="index.php">Tableau de bord</a></li>
                <li><a href="../index.php">Retour au site public</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <?php if(!empty($message)): ?>
            <div class="message-succes">
                <p><?= $message ?></p>
            </div>
        <?php endif; ?>

        <section>
            <h2>Avis en attente de modération</h2>
            
            <?php if(empty($commentaires)): ?>
                <p>Aucun nouvel avis à modérer.</p>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>Auteur / Date</th>
                            <th>Contenu de l'avis</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($commentaires as $com): ?>
                        <tr>
                            <td>
                                <strong><?= htmlspecialchars($com['pseudo']) ?></strong><br>
                                <small><?= date('d/m/Y H:i', strtotime($com['date_publication'])) ?></small>
                            </td>
                            <td><?= htmlspecialchars($com['contenu']) ?></td>
                            <td>
                                <form action="index.php" method="POST">
                                    <input type="hidden" name="action" value="moderation">
                                    <input type="hidden" name="id_commentaire" value="<?= $com['id_commentaire'] ?>">
                                    <button type="submit" name="decision" value="approuver">Approuver</button>
                                    <button type="submit" name="decision" value="refuser">Refuser</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </section>

        <hr>

        <section>
            <h2>Gestion des Scores</h2>
            
            <table>
                <thead>
                    <tr>
                        <th>Date de Session</th>
                        <th>Nom de l'équipe</th>
                        <th>Score Actuel</th>
                        <th>Nouveau Score</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($equipes as $equipe): ?>
                    <tr>
                        <td><?= $equipe['date_session'] ? date('d/m/Y', strtotime($equipe['date_session'])) : 'Non définie' ?></td>
                        <td><strong><?= htmlspecialchars($equipe['nom_equipe']) ?></strong></td>
                        <td><?= $equipe['score_obtenu'] !== null ? htmlspecialchars($equipe['score_obtenu']) . ' pts' : 'En attente' ?></td>
                        <td>
                            <form action="index.php" method="POST">
                                <input type="hidden" name="action" value="maj_score">
                                <input type="hidden" name="id_equipe" value="<?= $equipe['id_equipe'] ?>">
                                <input type="number" name="score" value="<?= htmlspecialchars($equipe['score_obtenu'] ?? '') ?>" required placeholder="Ex: 850">
                                <button type="submit">Valider</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <hr>

        <section>
            <h2>Détails Logistiques des Réservations</h2>
            
            <table>
                <thead>
                    <tr>
                        <th>Session</th>
                        <th>Équipe & Logistique</th>
                        <th>Capitaine (Contact)</th>
                        <th>Composition du groupe</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($equipes as $equipe): ?>
                    <tr>
                        <td>
                            <strong><?= $equipe['date_session'] ? date('d/m/Y', strtotime($equipe['date_session'])) : 'Non définie' ?></strong>
                        </td>
                        
                        <td>
                            <strong><?= htmlspecialchars($equipe['nom_equipe']) ?></strong><br>
                            Menu : <?= htmlspecialchars($equipe['type_menu']) ?><br>
                            Total : <?= $equipe['nb_participants'] ?> joueur(s)<br>
                            <?php if(!empty($equipe['options_accessibilite'])): ?>
                                <em style="color: red;">Alertes : <?= htmlspecialchars($equipe['options_accessibilite']) ?></em>
                            <?php endif; ?>
                        </td>
                        
                        <td>
                            <strong><?= htmlspecialchars($equipe['capitaine_pseudo']) ?></strong><br>
                            <a href="mailto:<?= htmlspecialchars($equipe['email']) ?>"><?= htmlspecialchars($equipe['email']) ?></a><br>
                            <?= htmlspecialchars($equipe['telephone']) ?>
                        </td>
                        
                        <td>
                            <ul>
                                <li><?= htmlspecialchars($equipe['capitaine_pseudo']) ?> <em>(Capitaine)</em></li>
                                <?php 
                                // On récupère les autres membres pour cette équipe spécifique
                                $membres = recupererMembresEquipe($equipe['id_equipe']);
                                foreach($membres as $membre): 
                                ?>
                                    <li><?= htmlspecialchars($membre['prenom']) ?> <?= htmlspecialchars($membre['nom']) ?> <em>(<?= htmlspecialchars($membre['pseudo']) ?>)</em></li>
                                <?php endforeach; ?>
                            </ul>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

    </main>

</body>
</html>