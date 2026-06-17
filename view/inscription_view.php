<?php require_once 'view/autres_pages/header.php'; ?>
<main>
    <div class="background-gradient-container">
        <div class="inscription-container">

            <h2>Inscription</h2>
            <p>Réservez votre nuit d'expérience pour 2 à 8 participants.</p>

            <?php if (!empty($message_erreur)): ?>
                <div class="erreur-message">
                    <?= $message_erreur ?>
                </div>
            <?php endif; ?>

            <div class="tabs-navigation">
                <div id="tab-1" class="tab active">1 - Equipe</div>
                <div id="tab-2" class="tab">2 - Membres</div>
                <div id="tab-3" class="tab">3 - Session</div>
                <div id="tab-4" class="tab">4 - Confirmation</div>
            </div>

            <form action="index.php?action=inscription" method="POST" id="form-inscription" novalidate>

                <div id="step-1" class="form-step">
                    <fieldset>
                        <legend>Nommez votre équipe</legend>

                        <label for="nom_equipe">Nom de l'équipe *</label>
                        <input type="text" name="nom_equipe" id="nom_equipe" required>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="nb_participants">Nombre de participants *</label>
                                <select name="nb_participants" id="nb_participants" required onchange="mettreAJourParticipants()">
                                    <option value="2">2 personnes</option>
                                    <option value="3">3 personnes</option>
                                    <option value="4">4 personnes</option>
                                    <option value="5">5 personnes</option>
                                    <option value="6">6 personnes</option>
                                    <option value="7">7 personnes</option>
                                    <option value="8">8 personnes</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="type_menu">Menu désiré *</label>
                                <select name="type_menu" id="type_menu" required>
                                    <option value="Menu classique">Menu classique</option>
                                    <option value="Menu Framed">Menu Framed (+8€)</option>
                                    <option value="Menu Végétarien">Menu Végétarien</option>
                                </select>
                            </div>
                        </div>

                        <label for="options_accessibilite">Besoins particuliers (PMR, allergies...)</label>
                        <textarea name="options_accessibilite" id="options_accessibilite" rows="4"></textarea>

                    </fieldset>
                    <div class="boutons-navigation">
                        <button type="button" class="btn-suivant" onclick="allerEtape(2)">Suivant</button>
                    </div>
                </div>

                <div id="step-2" class="form-step" style="display: none;">
                    <fieldset>
                        <legend>Infos des participants</legend>
                        <p>Seul le capitaine aura besoin de créer un compte.</p>

                        <div class="participant-titre">
                            <strong>Participant 1 - CAPITAINE D'EQUIPE</strong>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="cap_nom">Nom *</label>
                                <input type="text" name="nom" id="cap_nom" required>
                            </div>
                            <div class="form-group">
                                <label for="cap_prenom">Prénom *</label>
                                <input type="text" name="prenom" id="cap_prenom" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="telephone">Téléphone</label>
                                <input type="tel" name="telephone" id="telephone">
                            </div>
                            <div class="form-group">
                                <label for="email">E-mail *</label>
                                <input type="email" name="email" id="email" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="pseudo">Pseudo *</label>
                                <input type="text" name="pseudo" id="pseudo" required>
                            </div>
                            <div class="form-group">
                                <label for="mot_de_passe">Mot de passe *</label>
                                <input type="password" name="mot_de_passe" id="mot_de_passe" required minlength="8">
                            </div>
                        </div>

                        <div id="zone-participants"></div>

                    </fieldset>

                    <div class="boutons-navigation">
                        <button type="button" class="btn-ajouter" onclick="ajouterParticipant()">Ajouter un Participant +</button>
                        <button type="button" class="btn-precedent" onclick="allerEtape(1)">Retour</button>
                        <button type="button" class="btn-suivant" onclick="allerEtape(3)">Suivant</button>
                    </div>
                </div>

                <div id="step-3" class="form-step" style="display: none;">
                    <fieldset class="fieldset-creneaux">
                        <legend>Choisissez votre créneau</legend>

                        <?php
                        // Petits tableaux pour traduire les dates en français proprement
                        $jours = ['Sunday' => 'Dimanche', 'Monday' => 'Lundi', 'Tuesday' => 'Mardi', 'Wednesday' => 'Mercredi', 'Thursday' => 'Jeudi', 'Friday' => 'Vendredi', 'Saturday' => 'Samedi'];
                        $mois = ['Jan' => 'Janv.', 'Feb' => 'Fév.', 'Mar' => 'Mars', 'Apr' => 'Avr.', 'May' => 'Mai', 'Jun' => 'Juin', 'Jul' => 'Juil.', 'Aug' => 'Août', 'Sep' => 'Sept.', 'Oct' => 'Oct.', 'Nov' => 'Nov.', 'Dec' => 'Déc.'];
                        ?>

                        <div class="session-grid" id="grille-sessions">
                            <?php foreach ($sessions as $index => $sess): ?>
                                <?php
                                $ts = strtotime($sess['date_session']);
                                $jourStr = $jours[date('l', $ts)];
                                $jourNum = date('d', $ts);
                                $moisStr = $mois[date('M', $ts)];
                                $heure = date('H\hi', $ts); // Donne "19h30"
                                $estComplete = ($sess['est_complete'] == 1);
                                ?>

                                <div class="carte-session-wrapper" style="display: none;">
                                    <input type="radio" name="id_session" id="sess_<?= $sess['id_session'] ?>" value="<?= $sess['id_session'] ?>" class="hidden-radio" <?= $estComplete ? 'disabled' : 'required' ?>>

                                    <label for="sess_<?= $sess['id_session'] ?>" class="session-card <?= $estComplete ? 'card-complete' : 'card-available' ?>">
                                        <div class="sess-date"><?= $jourStr . ' ' . $jourNum . ' ' . $moisStr ?></div>
                                        <div class="sess-time"><?= $heure ?></div>
                                        <div class="sess-status"><?= $estComplete ? 'Complet' : 'Disponible' ?></div>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="table-pagination pagination-creneaux">
                            <a href="#" id="btn-prev-creneau">◀</a>
                            <span id="page-info-creneau" style="margin: 0 10px;">Page 1/1</span>
                            <a href="#" id="btn-next-creneau">▶</a>
                        </div>
                    </fieldset>

                    <div class="boutons-navigation">
                        <button type="button" class="btn-precedent" onclick="allerEtape(2)">Retour</button>
                        <button type="button" class="btn-suivant" onclick="preparerRecap(); allerEtape(4);">Suivant</button>
                    </div>
                </div>

                <div id="step-4" class="form-step" style="display: none;">
                    <fieldset class="fieldset-recap">
                        <legend>Récapitulatif</legend>

                        <div class="recap-box">
                            <p><span class="recap-label">Equipe :</span> <span id="recap-equipe" class="recap-valeur"></span></p>
                            <p><span class="recap-label">Date :</span> <span id="recap-date" class="recap-valeur"></span></p>
                            <p><span class="recap-label">Menu :</span> <span id="recap-menu" class="recap-valeur"></span></p>
                            <p><span class="recap-label">Nombre de joueurs :</span> <span id="recap-nb" class="recap-valeur"></span></p>
                            <p><span class="recap-label">Capitaine :</span> <span id="recap-capitaine" class="recap-valeur"></span> (<span id="recap-email" class="recap-valeur"></span>)</p>
                            
                            <div class="cgv-container">
                                <input type="checkbox" name="accepte_cgv" id="accepte_cgv" class="cgv-checkbox" required>
                                <label for="accepte_cgv">J'accepte les <a href="/index.php?action=mentions" target="_blank">CGV et le règlement intérieur</a>.</label>
                            </div>
                        </div>
                    </fieldset>
                    
                    <div class="boutons-navigation">
                        <button type="button" class="btn-precedent" onclick="allerEtape(3)">Retour</button>
                        <button type="submit" class="btn-confirmer">Confirmer</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</main>

<script>
    // 1. Navigation entre les étapes principales
    function allerEtape(etape) {
        document.querySelectorAll('.form-step').forEach(el => el.style.display = 'none');
        document.getElementById('step-' + etape).style.display = 'block';

        document.querySelectorAll('.tab').forEach(el => el.classList.remove('active'));
        document.getElementById('tab-' + etape).classList.add('active');
    }

    // 2. Fonction qui génère les champs en fonction du menu déroulant (nombre de joueurs)
    function mettreAJourParticipants() {
        let nb = parseInt(document.getElementById('nb_participants').value);
        const container = document.getElementById('zone-participants');
        container.innerHTML = '';

        for (let i = 2; i <= nb; i++) {
            const div = document.createElement('div');
            div.classList.add('nouveau-participant');

            div.innerHTML = '<div class="participant-titre"><strong>Participant ' + i + '</strong></div>' +
                '<div class="form-row">' +
                '<div class="form-group">' +
                '<label>Nom</label>' +
                '<input type="text" name="membre_nom[]" required>' +
                '</div>' +
                '<div class="form-group">' +
                '<label>Prénom</label>' +
                '<input type="text" name="membre_prenom[]" required>' +
                '</div>' +
                '<div class="form-group">' +
                '<label>Pseudo</label>' +
                '<input type="text" name="membre_pseudo[]" required>' +
                '</div>' +
                '</div>';

            container.appendChild(div);
        }
    }

    // 3. Bouton "Ajouter un participant" 
    function ajouterParticipant() {
        let selectElement = document.getElementById('nb_participants');
        let nbActuel = parseInt(selectElement.value);

        if (nbActuel >= 8) {
            alert("Maximum 8 participants par équipe !");
            return;
        }

        selectElement.value = nbActuel + 1;
        mettreAJourParticipants();
    }

    // 4. Préparer le récapitulatif avec les cartes (Boutons Radio)
    function preparerRecap() {
        document.getElementById('recap-equipe').innerText = document.getElementById('nom_equipe').value || 'Non renseigné';
        document.getElementById('recap-menu').innerText = document.getElementById('type_menu').value;
        document.getElementById('recap-nb').innerText = document.getElementById('nb_participants').value;
        document.getElementById('recap-capitaine').innerText = document.getElementById('pseudo').value || 'Non renseigné';
        document.getElementById('recap-email').innerText = document.getElementById('email').value || 'Non renseigné';

        // On cherche le bouton radio qui a été coché
        let radioCoche = document.querySelector('input[name="id_session"]:checked');
        
        if (radioCoche) {
            // S'il y a un radio coché, on va chercher le texte de la date dans le label associé
            let labelAssocie = document.querySelector('label[for="' + radioCoche.id + '"]');
            if (labelAssocie) {
                let dateTexte = labelAssocie.querySelector('.sess-date').innerText;
                document.getElementById('recap-date').innerText = 'Nuit du ' + dateTexte;
            } else {
                document.getElementById('recap-date').innerText = 'Date sélectionnée';
            }
        } else {
            // Si aucun radio n'est coché
            document.getElementById('recap-date').innerText = 'Aucune date choisie';
        }
    }

    // 5. Pagination de la grille des créneaux
    document.addEventListener('DOMContentLoaded', function () {
        const cartes = document.querySelectorAll('.carte-session-wrapper');
        const btnPrev = document.getElementById('btn-prev-creneau');
        const btnNext = document.getElementById('btn-next-creneau');
        const pageInfo = document.getElementById('page-info-creneau');

        const cartesParPage = 6; // 3 colonnes x 2 lignes
        let pageActuelle = 1;
        const totalPages = Math.ceil(cartes.length / cartesParPage) || 1;

        function afficherPage(page) {
            cartes.forEach(carte => carte.style.display = 'none'); // On cache tout

            const debut = (page - 1) * cartesParPage;
            const fin = debut + cartesParPage;

            for (let i = debut; i < fin && i < cartes.length; i++) {
                cartes[i].style.display = 'block'; // On affiche les 6 de la page
            }

            pageInfo.textContent = `Page ${page} / ${totalPages}`;
            btnPrev.style.color = page === 1 ? 'rgba(232, 232, 232, 0.3)' : '#e8e8e8';
            btnPrev.style.cursor = page === 1 ? 'default' : 'pointer';
            btnNext.style.color = page === totalPages ? 'rgba(232, 232, 232, 0.3)' : '#e8e8e8';
            btnNext.style.cursor = page === totalPages ? 'default' : 'pointer';
        }

        if (btnPrev) {
            btnPrev.addEventListener('click', function (e) {
                e.preventDefault();
                if (pageActuelle > 1) { pageActuelle--; afficherPage(pageActuelle); }
            });
        }

        if (btnNext) {
            btnNext.addEventListener('click', function (e) {
                e.preventDefault();
                if (pageActuelle < totalPages) { pageActuelle++; afficherPage(pageActuelle); }
            });
        }

        afficherPage(1); // Initialisation de la grille
    });

    // 6. Lancement au chargement de la page
    window.onload = function () {
        mettreAJourParticipants();
    };
</script>

<?php require_once 'view/autres_pages/footer.php'; ?>