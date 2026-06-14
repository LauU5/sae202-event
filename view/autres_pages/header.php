<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($titre_page) ? htmlspecialchars($titre_page) : 'Framed' ?></title>
    
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <nav>
        <div class="logo"><img src="view/img/Framed-Favicon.webp" alt="Logo Framed"></div>
        <ul>
            <li><a href="index.php?action=accueil">Accueil</a></li>
            <li><a href="index.php?action=concept">Concept</a></li>
            <li><a href="index.php?action=infos">Infos pratiques</a></li>

            
            <?php if(isset($_SESSION['id_utilisateur'])): ?>
                <li><a href="index.php?action=profil">Mon Profil</a></li>
                <li><a href="index.php?action=deconnexion">Déconnexion</a></li>
            <?php else: ?>
                <li><a href="index.php?action=inscription">Inscription</a></li>
                <li><a href="index.php?action=connexion" class="compte"><img src="view/img/compte.webp" alt="Compte">Compte</a></li>

            <?php endif; ?>
        </ul>
    </nav>
</header>