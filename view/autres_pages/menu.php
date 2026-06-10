<nav>
    <div class="logo">Framed</div>
    <ul>
        <li><a href="index.php?action=accueil">Accueil</a></li>
        <li><a href="index.php?action=concept">Concept</a></li>
        <li><a href="index.php?action=infos">Infos pratiques</a></li>

        <?php if(isset($_SESSION['id_utilisateur'])): ?>
            <li><a href="index.php?action=profil">Mon Profil</a></li>
            <li><a href="index.php?action=avis">Laisser un avis</a></li>
            <li><a href="index.php?action=deconnexion">Déconnexion</a></li>
        <?php else: ?>
            <li><a href="index.php?action=inscription">Inscription</a></li>
            <li><a href="index.php?action=connexion">Connexion</a></li>
        <?php endif; ?>
    </ul>
</nav>