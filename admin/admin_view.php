<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Administration - Escape Game</title>
    <link rel="stylesheet" href="../view/css/style.css">
</head>
<body style="background-color: #f4f4f9;">
    <header style="background-color: #2c3e50; color: white; padding: 15px;">
        <div style="display: flex; justify-content: space-between; max-width: 1000px; margin: auto;">
            <h1>Espace Administrateur</h1>
            <a href="../index.php" style="color: white; text-decoration: none; padding: 10px; background: #e74c3c; border-radius: 5px;">Retour au site public</a>
        </div>
    </header>

    <main style="max-width: 1000px; margin: 20px auto; padding: 20px; background: white; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        
        <?php if(!empty($message)): ?>
            <p style="color: white; background: #27ae60; padding: 10px; border-radius: 5px;"><?= $message ?></p>
        <?php endif; ?>

        <section style="margin-bottom: 40px;">
            <h2>Avis en attente de modération</h2>
            <?php if(empty($commentaires)): ?>
                <p>Aucun commentaire en attente.</p>
            <?php else: ?>
                <table style="width: 100%; border-collapse: collapse; text-align: left;">
                    <tr style="background: #eee;">
                        <th style="padding: 10px; border: 1px solid #ccc;">Auteur</th>
                        <th style="padding: 10px; border: 1px solid #ccc;">Avis</th>
                        <th style="padding: 10px; border: 1px solid #ccc;">Action</th>
                    </tr>
                    <?php foreach($commentaires as $com): ?>
                    <tr>
                        <td style="padding: 10px; border: 1px solid #ccc;"><strong><?= htmlspecialchars($com['pseudo']) ?></strong><br><small><?= $com['date_publication'] ?></small></td>
                        <td style="padding: 10px; border: 1px solid #ccc;"><?= htmlspecialchars($com['contenu']) ?></td>
                        <td style="padding: 10px; border: 1px solid #ccc;">
                            <form action="index.php" method="POST" style="display: inline-block;">
                                <input type="hidden" name="action" value="moderation">
                                <input type="hidden" name="id_commentaire" value="<?= $com['id_commentaire'] ?>">
                                <button type="submit" name="decision" value="approuver" style="background: #2ecc71; color: white; border: none; padding: 5px 10px; cursor: pointer;">Approuver</button>
                                <button type="submit" name="decision" value="refuser" style="background: #e74c3c; color: white; border: none; padding: 5px 10px; cursor: pointer;">Refuser</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            <?php endif; ?>
        </section>

        <hr style="margin: 30px 0; border: 0; border-top: 1px solid #eee;">

        <section style="margin-bottom: 40px;">
            <h2>Saisie des Scores par Équipe</h2>
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <tr style="background: #eee;">
                    <th style="padding: 10px; border: 1px solid #ccc;">Équipe</th>
                    <th style="padding: 10px; border: 1px solid #ccc;">Score actuel</th>
                    <th style="padding: 10px; border: 1px solid #ccc;">Nouveau Score</th>
                </tr>
                <?php foreach($equipes as $equipe): ?>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ccc;"><?= htmlspecialchars($equipe['nom_equipe']) ?></td>
                    <td style="padding: 10px; border: 1px solid #ccc;"><?= $equipe['score_obtenu'] !== null ? htmlspecialchars($equipe['score_obtenu']) . ' pts' : 'Non défini' ?></td>
                    <td style="padding: 10px; border: 1px solid #ccc;">
                        <form action="index.php" method="POST">
                            <input type="hidden" name="action" value="maj_score">
                            <input type="hidden" name="id_equipe" value="<?= $equipe['id_equipe'] ?>">
                            <input type="number" name="score" value="<?= htmlspecialchars($equipe['score_obtenu'] ?? '') ?>" required style="padding: 5px;">
                            <button type="submit" style="background: #3498db; color: white; border: none; padding: 5px 10px; cursor: pointer;">Valider</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </section>

        <hr style="margin: 30px 0; border: 0; border-top: 1px solid #eee;">

        <section>
            <h2>Liste des Participants Inscrits</h2>
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <tr style="background: #eee;">
                    <th style="padding: 10px; border: 1px solid #ccc;">Pseudo</th>
                    <th style="padding: 10px; border: 1px solid #ccc;">Équipe</th>
                    <th style="padding: 10px; border: 1px solid #ccc;">Email</th>
                    <th style="padding: 10px; border: 1px solid #ccc;">Téléphone</th>
                </tr>
                <?php foreach($inscrits as $inscrit): ?>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ccc;"><?= htmlspecialchars($inscrit['pseudo']) ?></td>
                    <td style="padding: 10px; border: 1px solid #ccc;"><?= htmlspecialchars($inscrit['nom_equipe']) ?></td>
                    <td style="padding: 10px; border: 1px solid #ccc;"><a href="mailto:<?= htmlspecialchars($inscrit['email']) ?>"><?= htmlspecialchars($inscrit['email']) ?></a></td>
                    <td style="padding: 10px; border: 1px solid #ccc;"><?= htmlspecialchars($inscrit['telephone']) ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </section>

    </main>
</body>
</html>