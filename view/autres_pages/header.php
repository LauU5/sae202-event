<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($titre_page) ? htmlspecialchars($titre_page) : 'Framed' ?></title>
    <link rel="icon" type="image/webp" href="view/img/Framed-Favicon.webp">

    <link rel="stylesheet" href="/style.css">
</head>

<body>

    <header>
        <nav>
            <div class="logo">
                <a href="/index.php?action=accueil">
                    <img src="/view/img/Framed-Favicon.webp" alt="Logo Framed">
                </a>
            </div>

            <input type="checkbox" id="burger-toggle" class="burger-toggle">
            
            <label for="burger-toggle" class="burger-icon">
                <span></span>
                <span></span>
                <span></span>
            </label>
            <div class="menu">
                <ul>
                    <li><a href="index.php?action=accueil">Accueil</a></li>
                    <li><a href="index.php?action=concept">Concept</a></li>
                    <li><a href="index.php?action=infos">Infos pratiques</a></li>
                    <?php if (isset($_SESSION['id_utilisateur'])): ?>
                        <li><a href="index.php?action=profil">Mon Profil</a></li>
                    <?php else: ?>
                        <li><a href="index.php?action=inscription">Inscription</a></li>
                    <?php endif; ?>
                </ul>
            </div>

            <ul class="droite">
                <?php if (isset($_SESSION['id_utilisateur'])): ?>
                    <li><a href="index.php?action=deconnexion" class="compte"><img src="/view/img/compte.webp" alt="Compte">Déconnexion</a></li>
                <?php else: ?>
                    <li>
                        <a href="index.php?action=connexion" class="compte">
                            <img src="/view/img/compte.webp" alt="Compte">Compte</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>