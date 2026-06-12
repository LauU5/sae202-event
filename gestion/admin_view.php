<?php 
if (!isset($onglet)) {
    $onglet = isset($_GET['onglet']) ? $_GET['onglet'] : 'dashboard';
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Framed</title>
</head>
<body>

    <header>
        <div>[ F ] Framed</div>
        <nav>
            <a href="index.php?action=accueil">Accueil</a>
            <a href="index.php?action=concept">Concept</a>
            <a href="index.php?action=infos">Infos pratiques</a>
            <a href="index.php?action=inscription">Inscriptions</a>
        </nav>
    </header>

    <main>
        <h1>Vue d'ensemble</h1>
        
        <nav>
            <a href="index.php?action=admin&onglet=dashboard" <?= $onglet == 'dashboard' ? 'class="active"' : '' ?>>Tableau de Bord</a> | 
            <a href="index.php?action=admin&onglet=equipes" <?= $onglet == 'equipes' ? 'class="active"' : '' ?>>Equipes</a> | 
            <a href="index.php?action=admin&onglet=commentaires" <?= $onglet == 'commentaires' ? 'class="active"' : '' ?>>Commentaires</a> | 
            <a href="index.php?action=admin&onglet=temps" <?= $onglet == 'temps' ? 'class="active"' : '' ?>>Temps des Equipes</a>
        </nav>
        <hr>

        <?php if($onglet === 'dashboard'): ?>
        <section id="tableau-de-bord">
            <div>
                <div><strong>4,7/5</strong><br>Note globale</div>
                <div><strong>11</strong><br>Joueurs attendus</div>
                <div><strong>2</strong><br>Avis en attente</div>
                <div><strong>81%</strong><br>Taux de réussite</div>
            </div>

            <h2>Sessions à venir</h2>
            <table border="1" width="100%">
                <thead>
                    <tr><th>Date</th><th>Equipe</th><th>Nb. Joueurs</th><th>Statut</th></tr>
                </thead>
                <tbody>
                    <?php if(!empty($sessions)): ?>
                        <?php foreach($sessions as $session): ?>
                        <tr>
                            <td><?= date('d/m/Y H:i', strtotime($session['date_session'])) ?></td>
                            <td><?= htmlspecialchars($session['nom_equipe']) ?></td>
                            <td><?= $session['nb_participants'] ?></td>
                            <td>Inscrit</td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="4">Aucune session à venir.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>

        <?php elseif($onglet === 'equipes'): ?>
        <section id="equipes">
            <?php if(!empty($equipes)): ?>
                <?php foreach($equipes as $equipe): ?>
                <article>
                    <h3><?= htmlspecialchars($equipe['nom_equipe']) ?> <small>(Inscrit √)</small></h3>
                    <p>Session du : <?= date('d/m/Y', strtotime($equipe['date_session'] ?? '')) ?></p>
                    
                    <table border="1" width="100%">
                        <tr><th>Nom</th><th>Prénom</th><th>Pseudo</th><th>Email</th><th>Téléphone</th></tr>
                        
                        <?php 
                        // Ex: $membres = recupererMembresEquipe($equipe['id_equipe']); 
                        // En attendant, on affiche le chef d'équipe ou des données génériques
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($equipe['nom'] ?? 'Nom') ?></td>
                            <td><?= htmlspecialchars($equipe['prenom'] ?? 'Prénom') ?></td>
                            <td><?= htmlspecialchars($equipe['pseudo_chef'] ?? 'Pseudo') ?></td>
                            <td><?= htmlspecialchars($equipe['email'] ?? 'Email') ?></td>
                            <td><?= htmlspecialchars($equipe['telephone'] ?? 'Tel') ?></td>
                        </tr>
                    </table>
                </article>
                <br>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucune équipe inscrite pour le moment.</p>
            <?php endif; ?>
        </section>

        <?php elseif($onglet === 'commentaires'): ?>
        <section id="commentaires">
            <div>
                <button>En Attente</button>
                <button>Approuvés</button>
                <button>Refusés</button>
            </div>
            
            <?php if(!empty($commentaires)): ?>
                <?php foreach($commentaires as $avis): ?>
                <article>
                    <h4><?= htmlspecialchars($avis['pseudo'] ?? 'Anonyme') ?> <small><?= date('d/m/Y', strtotime($avis['date_commentaire'])) ?></small></h4>
                    <p>"<?= htmlspecialchars($avis['texte']) ?>"</p>
                    
                    <form action="index.php?action=admin" method="POST" style="display:inline;">
                        <input type="hidden" name="action" value="moderation">
                        <input type="hidden" name="id_commentaire" value="<?= $avis['id_commentaire'] ?>">
                        <button type="submit" name="decision" value="approuver">Accepter</button>
                        <button type="submit" name="decision" value="refuser">Refuser</button>
                    </form>
                </article>
                <hr>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucun commentaire en attente.</p>
            <?php endif; ?>
        </section>

        <?php elseif($onglet === 'temps'): ?>
        <section id="temps-equipes">
            <div>
                <h2>Saisie Rapide</h2>
                <form action="index.php?action=admin" method="POST">
                    <input type="hidden" name="action" value="maj_score">
                    <label>Equipe : 
                        <select name="id_equipe" required>
                            <option value="">-- Choisir une équipe --</option>
                            <?php if(!empty($equipes)): ?>
                                <?php foreach($equipes as $eq): ?>
                                    <option value="<?= $eq['id_equipe'] ?>"><?= htmlspecialchars($eq['nom_equipe']) ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </label>
                    <label>Temps (min) : <input type="number" name="temps" required></label>
                    <label>Score (%) : <input type="number" name="score" required></label>
                    <button type="submit">Enregistrer</button>
                </form>
            </div>

            <h2>Classement</h2>
            <table border="1" width="100%">
                <tr><th>Equipe</th><th>Temps</th><th>Score</th></tr>
                <?php if(!empty($equipes)): // Idéalement remplacer par $classement trié ?>
                    <?php foreach($equipes as $eq): ?>
                        <?php if(isset($eq['score']) && $eq['score'] > 0): // On n'affiche que ceux qui ont joué ?>
                        <tr>
                            <td><?= htmlspecialchars($eq['nom_equipe']) ?></td>
                            <td><?= htmlspecialchars($eq['temps'] ?? 'N/A') ?> min</td>
                            <td><?= htmlspecialchars($eq['score']) ?>/100</td>
                        </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="3">Aucun score enregistré.</td></tr>
                <?php endif; ?>
            </table>
        </section>
        <?php endif; ?>

    </main>

    <footer>
        <p>© 2026 Framed - Agence Okapi | Mentions Légales | X - TikTok - Insta</p>
    </footer>

</body>
</html>