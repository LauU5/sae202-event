<?php require_once 'view/autres_pages/header.php'; ?>

<main>
    <section class="hero-section">
        <img src="view/img/Framed-Logo.webp"  alt="[ Emplacement Image : Logo géant Framed ]">
        <p>Votre seul repère dans l'obscurité a une batterie limitée.</p>
        <a href="index.php?action=inscription">Commençons le jeu</a>
    </section>



    <section class="lore">
        <h2>Une expérience nocturne terrifiante</h2>
        <article>
            <p>Bien plus qu'un simple escape game, Framed vous plonge dans une salle de classe abandonnée, hantée par le fantôme d'une jeune fille. Réveillez-vous dans l'obscurité totale.</p>
            <p>Votre seul moyen de survie : une caméra à vision nocturne pour vous repérer dans les couloirs, et un polaroid pour rassembler les preuves du passé.</p>
            <p>Framed inclut également un repas thématisé et une nuit complète sur place pour prolonger le frisson jusqu'au matin.</p>
        </article>
        <aside>
            <img src="view/img/image1.webp" alt="[ Emplacement Image : Capture d'écran du jeu avec caméra vision nocturne ]" width="400" height="250">
            <br>
            <a href="index.php?action=concept">Découvrir le scénario</a>
        </aside>
    </section>



    <section class="info-cards-section">
    <div class="info-card">
        <span class="card-valeur">2-8</span>
        <p>participants par<br>sessions</p>
    </div>
    
    <div class="info-card">
        <span class="card-valeur">18+ ans</span>
        <p>accompagné à<br>partir de 16 ans</p>
    </div>
    
    <div class="info-card">
        <span class="card-valeur">15 Heures</span>
        <p>durée totale :<br>toute la nuit</p>
    </div>
    
    <div class="info-card">
        <span class="card-valeur"><img src="view/img/etoile.webp" alt="etoile difficulté 1"><img src="view/img/etoile.webp" alt="etoile difficulté 2"><img src="view/img/etoile.webp" alt="etoile difficulté 3"></span>
        <p>difficulté<br>élevée</p>
    </div>
</section>

  

    <section class="presentation-section">
    <div class="presentation-content">
        <div class="espace-video">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/TN1E5M0mALk?mute=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
        
        <div class="presentation-text">
            <h2>Silence, ça tourne.</h2>
            <p>Découvrez notre vidéo de présentation ultra-rapide pour vous plonger directement dans l'ambiance de l'escape game et entrevoir ce qui vous attend dans le noir.</p>
        </div>
    </div>
    
    <div class="ligne-rouge"></div>
   </section>

  

<section class="avis-section">
    <h2>Les Survivants</h2>
    <p>Ils ont passé la nuit entière enfermés. Récits de ceux qui ont réussi à sortir.</p>

    <?php if (!empty($avis_publics)): ?>
        <div class="defilement-container">
            <div class="defilement-track">
                
                <?php for($i = 0; $i < 2; $i++): ?>
                    <?php foreach ($avis_publics as $avis): ?>
                        <div class="avis-card">
                            
                            <div class="etoiles-affichage">
                                <?php 
                                // On récupère la note (si elle n'existe pas, on met 5 par défaut pour éviter les bugs)
                                $note = isset($avis['note']) ? (int)$avis['note'] : 5; 
                                
                                // Boucle pour afficher 5 étoiles
                                for ($j = 1; $j <= 5; $j++) {
                                    if ($j <= $note) {
                                        echo '<span class="etoile-pleine">★</span>'; // Étoile pleine
                                    } else {
                                        echo '<span class="etoile-vide">☆</span>'; // Étoile vide
                                    }
                                }
                                ?>
                            </div>

                            
                            <p class="auteur">
                                <?= htmlspecialchars($avis['pseudo']) ?>
                                <?php if (!empty($avis['prenom'])): ?>
                                    (<?= htmlspecialchars($avis['prenom']) ?>)
                                <?php endif; ?>
                            </p>
                                <p class="commentaire">
                                <?= nl2br(htmlspecialchars($avis['contenu'])) ?>
                                </p>
                                <small><?= date('d/m/Y', strtotime($avis['date_publication'])) ?></small>
                            
                        </div>
                    <?php endforeach; ?>
                <?php endfor; ?>
                
            </div>
        </div>
    <?php else: ?>
        <p class="aucun-avis">Soyez les premiers à partager votre expérience !</p>
    <?php endif; ?>
</section>
</main>

<?php require_once 'view/autres_pages/footer.php'; ?>