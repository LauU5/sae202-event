<?php require_once 'view/autres_pages/header.php'; ?>

<h2>Inscription et Réservation de votre Escape Game</h2>

<?php if(!empty($message_erreur)): ?>
    <div class="erreur" style="color: red; font-weight: bold; margin-bottom: 15px;">
        <?= $message_erreur ?>
    </div>
<?php endif; ?>

<form action="index.php?action=inscription" method="POST" id="form-inscription">
    <fieldset>
        <legend>1. Votre Compte Responsable (Chef d'équipe)</legend>
        <label for="nom_equipe">Nom unique de l'équipe *</label>
        <input type="text" id="nom_equipe" name="nom_equipe" required placeholder="Ex: Les Veilleurs">

        <label for="pseudo">Votre Pseudo *</label>
        <input type="text" id="pseudo" name="pseudo" required>

        <label for="email">Adresse Email *</label>
        <input type="email" id="email" name="email" required>

        <label for="mot_de_passe">Mot de passe * (8 car. min)</label>
        <input type="password" id="mot_de_passe" name="mot_de_passe" required minlength="8">

        <label for="telephone">Téléphone de contact</label>
        <input type="tel" id="telephone" name="telephone">
    </fieldset>

    <fieldset>
        <legend>2. Session & Options Logistiques</legend>
        
        <label for="id_session">Choisir la date de votre session *</label>
        <select name="id_session" id="id_session" required style="width: 100%; padding: 8px; margin-top: 5px;">
            <option value="">-- Sélectionnez une date --</option>
            <?php foreach($sessions as $sess): ?>
                <?php if($sess['est_complete'] == 1): ?>
                    <option value="<?= $sess['id_session'] ?>" disabled style="color: #999; background: #eee;">
                        <?= date('d/m/Y', strtotime($sess['date_session'])) ?> [COMPLET / GRISÉ]
                    </option>
                <?php else: ?>
                    <option value="<?= $sess['id_session'] ?>">
                        <?= date('d/m/Y', strtotime($sess['date_session'])) ?> (Disponible)
                    </option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>

        <label for="type_menu">Type de repas souhaité pour l'équipe *</label>
        <select name="type_menu" id="type_menu" required style="width: 100%; padding: 8px; margin-top: 5px;">
            <option value="Menu classique">Menu classique</option>
            <option value="Menu Framed">Menu Framed</option>
            <option value="Menu Végétarien">Menu Végétarien</option>
        </select>

        <label for="options_accessibilite">Options d'accessibilité ou besoins spécifiques (Handicap, PMR, régime alimentaire, allergies...)</label>
        <textarea name="options_accessibilite" id="options_accessibilite" rows="3" style="width: 100%; padding: 8px; margin-top: 5px;" placeholder="Ex: Options PMR requises, un menu sans arachides..."></textarea>
    </fieldset>

    <fieldset>
        <legend>3. Composition de l'équipe</legend>
        <label for="nb_participants">Nombre total de participants (Chef inclus) *</label>
        <select name="nb_participants" id="nb_participants" required style="width: 100%; padding: 8px; margin-top: 5px;">
            <option value="1">1 personne (Moi uniquement)</option>
            <option value="2">2 personnes</option>
            <option value="3">3 personnes</option>
            <option value="4">4 personnes</option>
            <option value="5">5 personnes</option>
        </select>

        <div id="compagnons-fields" style="margin-top: 15px;"></div>
    </fieldset>

    <button type="submit" class="btn">Valider la réservation et créer l'équipe</button>
</form>

<script>
document.getElementById('nb_participants').addEventListener('change', function() {
    const nb = parseInt(this.value);
    const container = document.getElementById('compagnons-fields');
    container.innerHTML = ''; 

    for(let i = 1; i < nb; i++) {
        const div = document.createElement('div');
        div.style.padding = "10px";
        div.style.borderTop = "1px dashed #ccc";
        div.style.marginTop = "10px";
        
        div.innerHTML = `
            <h4>Participant n°\${i + 1}</h4>
            <div style="display: flex; gap: 10px; margin-top: 5px;">
                <input type="text" name="membre_prenom[]" placeholder="Prénom *" required style="flex:1; padding:5px;">
                <input type="text" name="membre_nom[]" placeholder="Nom *" required style="flex:1; padding:5px;">
                <input type="text" name="membre_pseudo[]" placeholder="Pseudo *" required style="flex:1; padding:5px;">
            </div>
        `;
        container.appendChild(div);
    }
});
</script>

<?php require_once 'view/autres_pages/footer.php'; ?>