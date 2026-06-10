<?php require_once 'view/autres_pages/header.php'; ?>

<main>

    <section>
        <img src="" alt="[ Emplacement Image : Logo géant Framed ]" width="400" height="150">
        <p>Votre seul repère dans l'obscurité a une batterie limitée.</p>
        <a href="index.php?action=inscription">Commençons le jeu</a>
    </section>

    <hr>

    <section>
        <h2>Une expérience nocturne terrifiante</h2>
        <article>
            <p>Bien plus qu'un simple escape game, Framed vous plonge dans une salle de classe abandonnée, hantée par le fantôme d'une jeune fille. Réveillez-vous dans l'obscurité totale.</p>
            <p>Votre seul moyen de survie : une caméra à vision nocturne pour vous repérer dans les couloirs, et un polaroid pour rassembler les preuves du passé.</p>
            <p>Framed inclut également un repas thématisé et une nuit complète sur place pour prolonger le frisson jusqu'au matin.</p>
        </article>
        <aside>
            <img src="" alt="[ Emplacement Image : Capture d'écran du jeu avec caméra vision nocturne ]" width="400" height="250">
            <br>
            <a href="index.php?action=concept">Découvrir le scénario</a>
        </aside>
    </section>

    <hr>

    <section>
        <ul>
            <li><strong>2-8</strong><br>participants par sessions</li>
            <li><strong>18+ ans</strong><br>accompagné à partir de 16 ans</li>
            <li><strong>15 Heures</strong><br>durée totale : toute la nuit</li>
            <li><strong>***</strong><br>difficulté élevée</li>
        </ul>
    </section>

    <hr>

    <section>
        <div>
            <img src="" alt="[ Emplacement Vidéo ]" width="400" height="250">
        </div>
        <div>
            <h2>Silence, ça tourne...</h2>
            <p>Découvrez notre vidéo de présentation pour vous plonger directement dans l'ambiance.</p>
        </div>
    </section>

    <hr>

    
    <section>
        <h2>Ce qu'ils en pensent</h2>
        <?php if (!empty($avis_publics)): ?>
            <ul>
                <?php foreach ($avis_publics as $avis): ?>
                    <li>
                        <blockquote><?= htmlspecialchars($avis['contenu']) ?></blockquote>
                        <p>
                            <strong><?= htmlspecialchars($avis['pseudo']) ?></strong>
                            <small> — <?= date('d/m/Y', strtotime($avis['date_publication'])) ?></small>
                        </p>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Soyez les premiers à partager votre expérience !</p>
            <section class="avis-section" style="text-align: center; margin: 50px 0;">
    <h2 style="color: #4CAF50;">Ils ont survécu... Voici leurs témoignages</h2>
    
    <?php if(!empty($avis_publics)): ?>
        <div class="carousel-container" style="position: relative; max-width: 600px; margin: 20px auto; padding: 20px; border: 1px solid #333; background: #111;">
            
            <?php foreach($avis_publics as $index => $avis): ?>
                <div class="carousel-item" style="display: none;">
                    <p style="font-size: 1.2em; font-style: italic;">
                        "<?= nl2br(htmlspecialchars($avis['contenu'])) ?>"
                    </p>
                    <p style="color: #888; margin-top: 15px; font-weight: bold;">
                        — <?= htmlspecialchars($avis['pseudo']) ?> 
                        (<?= htmlspecialchars($avis['prenom'] ?? '') ?>)
                    </p>
                </div>
            <?php endforeach; ?>

            <div style="margin-top: 20px;">
                <button onclick="prevAvis()" style="background: none; border: 1px solid #4CAF50; color: #4CAF50; padding: 5px 15px; cursor: pointer;">&#10094; Précédent</button>
                <button onclick="nextAvis()" style="background: none; border: 1px solid #4CAF50; color: #4CAF50; padding: 5px 15px; cursor: pointer;">Suivant &#10095;</button>
            </div>
            
        </div>

        <script>
            let currentAvis = 0;
            const items = document.querySelectorAll('.carousel-item');

            function showAvis(index) {
                // On cache tout
                items.forEach(item => item.style.display = 'none');
                
                // On boucle si on arrive au bout
                if (index >= items.length) currentAvis = 0;
                if (index < 0) currentAvis = items.length - 1;
                
                // On affiche le bon élément
                items[currentAvis].style.display = 'block';
            }

            function nextAvis() {
                currentAvis++;
                showAvis(currentAvis);
            }

            function prevAvis() {
                currentAvis--;
                showAvis(currentAvis);
            }

            // Initialisation au chargement
            if(items.length > 0) {
                showAvis(currentAvis);
                // Défilement automatique (5000 ms = 5 secondes)
                setInterval(nextAvis, 5000);
            }
        </script>

    <?php else: ?>
        <p>Aucun témoignage pour le moment. Serez-vous les premiers ?</p>
    <?php endif; ?>
</section>
        <?php endif; ?>
    </section>

</main>

<?php require_once 'view/autres_pages/footer.php'; ?>