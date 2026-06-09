<?php require_once 'view/autres_pages/header.php'; ?>
<h2>Connexion à votre espace</h2>

<?php if(!empty($erreur)): ?>
    <p style="color: red;"><?= $erreur ?></p>
<?php endif; ?>

<form action="index.php?action=connexion" method="POST">
    <label for="email">Email</label>
    <input type="email" name="email" id="email" required>
    
    <label for="mot_de_passe">Mot de passe</label>
    <input type="password" name="mot_de_passe" id="mot_de_passe" required>
    
    <button type="submit" class="btn">Se connecter</button>
</form>
<p>Pas encore d'équipe ? <a href="index.php?action=inscription">Inscrivez-vous ici</a>.</p>
<?php require_once 'view/autres_pages/footer.php'; ?>