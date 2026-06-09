<?php require_once 'view/autres_pages/header.php'; ?>
<h2>Laissez votre avis sur l'Escape Game</h2>

<?php if(!empty($message)): ?>
    <p style="color: green; font-weight: bold;"><?= $message ?></p>
<?php else: ?>
    <form action="index.php?action=avis" method="POST">
        <label for="contenu">Votre expérience :</label>
        <textarea name="contenu" id="contenu" rows="5" style="width:100%; padding:10px;" required placeholder="Racontez-nous..."></textarea>
        
        <button type="submit" class="btn">Envoyer mon avis</button>
    </form>
<?php endif; ?>
<?php require_once 'view/autres_pages/footer.php'; ?>