<?php require_once 'view/autres_pages/header.php'; ?>

<main>
    <section class="hero-section">
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

    <section class="avis-section">
        <h2>Ce qu'ils en pensent</h2>

        <?php if (!empty($avis_publics)): ?>
            <div class="carousel-container" style="overflow: hidden;">

                <div class="carousel-track" style="display: flex; transition: transform 0.5s ease-in-out;">
                    <?php foreach ($avis_publics as $index => $avis): ?>
                        <div class="carousel-item" style="min-width: 100%; box-sizing: border-box;">
                            <p>
                                "<?= nl2br(htmlspecialchars($avis['contenu'])) ?>"
                            </p>
                            <p>
                                — <?= htmlspecialchars($avis['pseudo']) ?>
                                (<?= htmlspecialchars($avis['prenom'] ?? '') ?>)
                                <small> — <?= date('d/m/Y', strtotime($avis['date_publication'])) ?></small>
                            </p>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="carousel-buttons">
                    <button class="carousel-btn" onclick="prevAvis()">&#10094; Précédent</button>
                    <button class="carousel-btn" onclick="nextAvis()">Suivant &#10095;</button>
                </div>
            </div>

            <script>
                let currentAvis = 0;
                const track = document.querySelector('.carousel-track');
                const items = document.querySelectorAll('.carousel-item');
                const totalItems = items.length;

                function showAvis(index) {
                    if (index >= totalItems) currentAvis = 0;
                    if (index < 0) currentAvis = totalItems - 1;

                    const translateX = -(currentAvis * 100);
                    track.style.transform = `translateX(${translateX}%)`;
                }

                function nextAvis() { currentAvis++; showAvis(currentAvis); }
                function prevAvis() { currentAvis--; showAvis(currentAvis); }

                if (totalItems > 1) {
                    setInterval(nextAvis, 5000);
                }
            </script>

        <?php else: ?>
            <p>Soyez les premiers à partager votre expérience !</p>
        <?php endif; ?>
    </section>

</main>

<?php require_once 'view/autres_pages/footer.php'; ?>