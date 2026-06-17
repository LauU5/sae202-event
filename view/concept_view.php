<?php require_once 'view/autres_pages/header.php'; ?>

<main>

    <section class="about-section">
        <h2>C'est quoi, Framed?</h2>


        <article class="about-text">
            <p>Bien plus qu'un simple escape game, c'est une expérience nocturne terrifiante et totalement
                immersive.</p>

            <p>Vous vous réveillez, dans une salle de classe abandonnée et plongée dans l'obscurité, hantée par le
                fantôme d'une jeune fille.</p>

            <p><span class="texte-vert">Votre seul moyen de survie ?</span> Une caméra à vision nocturne pour vous
                repérer dans les couloirs sombres, et un polaroid pour rassembler les preuves du passé.</p>
            <p class="about-conclusion">
                Framed est une aventure complète qui va mettre vos nerfs à rude épreuve, puisqu'elle inclut
                également un repas thématisé et une nuit complète sur place pour prolonger le frisson jusqu'au
                matin.
            </p>
        </article>

        <aside class="about-image">
            <img src="view/img/julien.webp" alt="Caméra vision nocturne Framed">
        </aside>


    </section>



    <section class="planning-section">
        <h2>Planning</h2>
        <div class="timeline">
            <div class="timeline-item">
                <div class="time">19h30</div>
                <div class="desc">Présentation de l'expérience, remise du matériel (caméra, polaroïd), règles de
                    sécurité. Mise en ambiance progressive.</div>
            </div>
            <div class="timeline-item">
                <div class="time">20h00</div>
                <div class="desc">Exploration de la salle de classe, collecte des premiers indices. Les lumières
                    s'éteignent. L'expérience commence.</div>
            </div>
            <div class="timeline-item">
                <div class="time">22h30</div>
                <div class="desc">Dîner servi dans l'ambiance du jeu. Menu surprise inspiré des années 90, servi à la
                    lueur d'une bougie. <em>(Voir les options ci-dessous.)</em></div>
            </div>
            <div class="timeline-item">
                <div class="time">00h00</div>
                <div class="desc">Les énigmes se resserrent. L'esprit se manifeste plus fréquemment. Il faut résoudre
                    avant l'aube.</div>
            </div>
            <div class="timeline-item">
                <div class="time">02h00</div>
                <div class="desc">Résolution du scénario (ou pas). Installation dans les hébergements thématisés pour le
                    reste de la nuit.</div>
            </div>
            <div class="timeline-item">
                <div class="time">08h00</div>
                <div class="desc">Petit-déjeuner continental servi dans un espace lumineux et rassurant. Retour à la
                    réalité.</div>
            </div>
        </div>
    </section>



    <section class="menus-section">
        <div class="nos-menus">
            <div class="menu-card">
                <h3>Menu Classique</h3>
                <ul>
                    <li>Velouté de champignons</li>
                    <li>Tartines rôties au fromage</li>
                    <li>Gratin dauphinois</li>
                    <li>Tarte aux pommes maison</li>
                </ul>
                <img src="view/img/menu_classique_changeable.webp" alt="Menu Preview">
            </div>

            <div class="menu-card popular">
                <span class="badge-populaire">Populaire</span>
                <h3>Menu Framed <span class="prix_framed">(+8€)</span></h3>
                <ul>
                    <li>Soupe à l'oignon gratinée</li>
                    <li>Planche de charcuterie</li>
                    <li>Rôti de porc / purée maison</li>
                    <li>Fondant au chocolat</li>
                </ul>
                <img src="view/img/menu_framed.webp" alt="Menu Preview">
            </div>

            <div class="menu-card">
                <h3>Menu Végétarien</h3>
                <ul>
                    <li>Velouté de courge</li>
                    <li>Tartines végétales</li>
                    <li>Gratin de légumes</li>
                    <li>Tarte aux pommes maison</li>
                </ul>
                <img src="view/img/menu_vegetarien.webp" alt="Menu Preview">
            </div>
        </div>
        <p class="allergies-note">* Les allergies et régimes spécifiques (sans gluten, sans lactose, halal...) sont
            pris en charge sur demande lors de la réservation. Précisez-le dans le formulaire d'inscription.</p>
    </section>





    <section class="prix-services-section">
        <h2>Prix & Services</h2>

        <div class="ps-container">

            <div class="ps-top">
                <div class="ps-price-main">
                    <p class="ps-label">A partir de</p>
                    <div class="ps-price-value">155€</div>
                    <p class="ps-label">par personnes</p>
                </div>

                <div class="ps-list">
                    <ul>
                        <li>Expérience de jeu complète <em>(toute la nuit)</em></li>
                        <li>Nuit sur place en chambre thématisée</li>
                        <li>Dîner thématisé <em>(menu classique)</em></li>
                        <li>Petit-déjeuner continental le lendemain matin</li>
                        <li>Matériel de jeu fourni <em>(caméra, polaroid, etc.)</em></li>
                        <li>Encadrement par les maîtres du jeu</li>
                    </ul>
                </div>

                <div class="ps-info-box">
                    <p>Le paiement peut être réparti entre les membres du groupe au moment de la réservation en ligne.
                        Chaque participant reçoit un lien de paiement individuel. Un acompte de 30% est demandé pour
                        confirmer la réservation.</p>
                </div>
            </div>

            <div class="ps-bottom">
                <div class="ps-group-box">
                    <strong>Groupe 2-3 pers.</strong><br>
                    <span>180€/pers.</span>
                </div>
                <div class="ps-group-box">
                    <strong>Groupe 4-6 pers.</strong><br>
                    <span>160€/pers.</span>
                </div>
                <div class="ps-group-box">
                    <strong>Groupe 7-8 pers.</strong><br>
                    <span>155€/pers.</span>
                </div>

                <a href="#" class="ps-btn-tarifs">Tarifs</a>
            </div>

        </div>
    </section>

</main>

<?php require_once 'view/autres_pages/footer.php'; ?>