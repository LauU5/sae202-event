<?php require_once 'view/autres_pages/header.php'; ?>

<div class="espace-header"></div>

<div class="connexion-container">
    
    <h2>Connexion</h2>

    <?php if(!empty($erreur)): ?>
        <p class="erreur-message"><?= $erreur ?></p>
    <?php endif; ?>

    <form action="index.php?action=connexion" method="POST" class="connexion-form">
        
        <label for="email">E-mail</label>
        <input type="email" name="email" id="email" required>
        
        <label for="mot_de_passe">Mot de passe</label>
        <input type="password" name="mot_de_passe" id="mot_de_passe" required>
        
        <div class="bouton-centrer">
            <button type="submit" class="btn-connexion">Se Connecter</button>
        </div>

    </form>

    <p class="inscription-link">
        Pas encore de compte? <a href="index.php?action=inscription">Inscrivez-vous!</a>
    </p>

</div>

<?php require_once 'view/autres_pages/footer.php'; ?>