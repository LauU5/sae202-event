<?php require_once 'view/autres_pages/header.php'; ?>
<h2>Bienvenue, <?= htmlspecialchars($_SESSION['pseudo']) ?> !</h2>

<?php if(!empty($message)): ?>
    <p style="color: green;"><?= $message ?></p>
<?php endif; ?>

<div class="score-box" style="background:#eee; padding:15px; margin-bottom:20px;">
    <h3>Score de votre équipe</h3>
    <p>
        <?php if ($infos['score_obtenu'] !== null): ?>
            Votre score final est de : <strong><?= htmlspecialchars($infos['score_obtenu']) ?> points !</strong><br>
            <a href="https://twitter.com/intent/tweet?text=<?= urlencode("J'ai obtenu " . $infos['score_obtenu'] . " points à l'Escape Game de Nuit MMI ! #EscapeNight") ?>" target="_blank" class="btn" style="background:#1DA1F2;">Partager mon score</a>
        <?php else: ?>
            L'Escape Game n'est pas encore terminé, votre score s'affichera ici.
        <?php endif; ?>
    </p>
</div>

<form action="index.php?action=profil" method="POST">
    <fieldset>
        <legend>Modifier mes informations</legend>
        <label for="pseudo">Pseudo</label>
        <input type="text" name="pseudo" id="pseudo" value="<?= htmlspecialchars($infos['pseudo']) ?>" required>

        <label for="telephone">Téléphone</label>
        <input type="tel" name="telephone" id="telephone" value="<?= htmlspecialchars($infos['telephone']) ?>">

        <button type="submit" class="btn">Mettre à jour</button>
    </fieldset>
</form>
<?php require_once 'view/autres_pages/footer.php'; ?>