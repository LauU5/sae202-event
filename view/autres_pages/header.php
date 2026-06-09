<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($titre_page) ? htmlspecialchars($titre_page) : "Escape Game de Nuit" ?> - SAE 202</title>
    <link rel="stylesheet" href="view/css/style.css">
</head>
<body>
    <header>
        <?php require_once 'view/autres_pages/menu.php'; ?>
    </header>

    <main>