<nav>
    <div class="logo">Framed</div>
    <ul>
        <li><a href="accueil">Accueil</a></li>
        <li><a href="concept">Concept</a></li>
        <li><a href="infos">Infos pratiques</a></li>

        <?php if(isset($_SESSION['id_utilisateur'])): ?>
            <li><a href="profil">Mon Profil</a></li>
            <li><a href="avis">Laisser un avis</a></li>
            <li><a href="deconnexion">Déconnexion</a></li>
        <?php else: ?>
            <li><a href="inscription">Inscription</a></li>
            <li><a href="connexion">Connexion</a></li>
        <?php endif; ?>
    </ul>
</nav>