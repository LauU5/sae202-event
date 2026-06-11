<?php require_once 'view/autres_pages/header.php'; ?>

<div class="inscription-container">
    
    <h2>Inscription</h2>
    <p>Réservez votre nuit d'expérience. L'inscription crée un compte pour le capitaine.</p>

    <?php if(!empty($message_erreur)): ?>
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

    <form action="index.php?action=inscription" method="POST" id="form-inscription">
        
        <div id="step-1" class="form-step">
            <fieldset>
                <legend>Nommez votre équipe</legend>
                
                <label for="nom_equipe">Nom de l'équipe *</label>
                <input type="text" name="nom_equipe" id="nom_equipe" required>

                <div class="form-row">
                    <div class="form-group">
                        <label for="nb_participants">Nombre de participants *</label>
                        <select name="nb_participants" id="nb_participants" required onchange="mettreAJourParticipants()">
                            <option value="1">1 personne (Moi seul)</option>
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
                            <option value="Menu Framed">Menu Framed</option>
                            <option value="Menu Végétarien">Menu Végétarien</option>
                        </select>
                    </div>
                </div>

                <label for="options_accessibilite">Besoins particuliers (PMR, allergies...)</label>
                <textarea name="options_accessibilite" id="options_accessibilite" rows="4"></textarea>

                <div class="boutons-navigation">
                    <button type="button" class="btn-suivant" onclick="allerEtape(2)">Suivant</button>
                </div>
            </fieldset>
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

                <div class="action-ajouter">
                    <button type="button" class="btn-ajouter" onclick="ajouterParticipant()">Ajouter un Participant +</button>
                </div>

                <div class="boutons-navigation">
                    <button type="button" class="btn-precedent" onclick="allerEtape(1)">Précédent</button>
                    <button type="button" class="btn-suivant" onclick="allerEtape(3)">Suivant</button>
                </div>
            </fieldset>
        </div>

        <div id="step-3" class="form-step" style="display: none;">
            <fieldset>
                <legend>Réserver la date</legend>
                
                <label for="id_session">Choisissez votre nuit *</label>
                <select name="id_session" id="id_session" required>
                    <option value="">-- Sélectionnez une date disponible --</option>
                    <?php foreach($sessions as $sess): ?>
                        <?php if($sess['est_complete'] == 1): ?>
                            <option value="<?= $sess['id_session'] ?>" disabled class="date-complete">
                                <?= date('d/m/Y', strtotime($sess['date_session'])) ?> [COMPLET]
                            </option>
                        <?php else: ?>
                            <option value="<?= $sess['id_session'] ?>">
                                Nuit du <?= date('d/m/Y', strtotime($sess['date_session'])) ?>
                            </option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>

                <div class="boutons-navigation">
                    <button type="button" class="btn-precedent" onclick="allerEtape(2)">Précédent</button>
                    <button type="button" class="btn-suivant" onclick="preparerRecap(); allerEtape(4);">Suivant</button>
                </div>
            </fieldset>
        </div>

        <div id="step-4" class="form-step" style="display: none;">
            <fieldset>
                <legend>Récapitulatif</legend>
                
                <div class="recap-box">
                    <p><strong>Équipe :</strong> <span id="recap-equipe"></span></p>
                    <p><strong>Date :</strong> <span id="recap-date"></span></p>
                    <p><strong>Menu :</strong> <span id="recap-menu"></span></p>
                    <p><strong>Nombre de joueurs :</strong> <span id="recap-nb"></span></p>
                    <p><strong>Capitaine :</strong> <span id="recap-capitaine"></span> (<span id="recap-email"></span>)</p>
                </div>

                <div class="boutons-navigation">
                    <button type="button" class="btn-precedent" onclick="allerEtape(3)">Précédent</button>
                    <button type="submit" class="btn-confirmer">Confirmer l'inscription</button>
                </div>
            </fieldset>
        </div>

    </form>
</div>

<script>
    // 1. Navigation entre les étapes
    function allerEtape(etape) {
        document.querySelectorAll('.form-step').forEach(el => el.style.display = 'none');
        document.getElementById('step-' + etape).style.display = 'block';

        document.querySelectorAll('.tab').forEach(el => el.classList.remove('active'));
        document.getElementById('tab-' + etape).classList.add('active');
    }

    // 2. Fonction qui génère les champs en fonction du menu déroulant
    function mettreAJourParticipants() {
        let nb = parseInt(document.getElementById('nb_participants').value);
        const container = document.getElementById('zone-participants');
        container.innerHTML = ''; 

        for(let i = 2; i <= nb; i++) {
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
        
        if(nbActuel >= 8) {
            alert("Maximum 8 participants par équipe !");
            return;
        }

        selectElement.value = nbActuel + 1;
        mettreAJourParticipants();
    }

    // 4. Préparer le récapitulatif
    function preparerRecap() {
        document.getElementById('recap-equipe').innerText = document.getElementById('nom_equipe').value || 'Non renseigné';
        document.getElementById('recap-menu').innerText = document.getElementById('type_menu').value;
        document.getElementById('recap-nb').innerText = document.getElementById('nb_participants').value;
        document.getElementById('recap-capitaine').innerText = document.getElementById('pseudo').value || 'Non renseigné';
        document.getElementById('recap-email').innerText = document.getElementById('email').value || 'Non renseigné';
        
        let selectDate = document.getElementById('id_session');
        if(selectDate.selectedIndex > 0) {
            document.getElementById('recap-date').innerText = selectDate.options[selectDate.selectedIndex].text;
        } else {
            document.getElementById('recap-date').innerText = 'Aucune date choisie';
        }
    }

    window.onload = function() {
        mettreAJourParticipants();
    };
</script>

<?php require_once 'view/autres_pages/footer.php'; ?>