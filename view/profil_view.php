<?php
// Les fichiers de structure (Header)
require_once 'view/autres_pages/header.php';
?>
<div class="background-gradient-container">
<main class="espace-client">
    

    <h2 class="titre-espace">Mon Espace - <?= htmlspecialchars($infos['pseudo']) ?></h2>

    <div class="profil-header-card">
        <div class="profil-icon">
            <img src="view/img/profil.webp" alt="[ Icône ]" width="60" height="60">
        </div>
        <div class="profil-info-main">
            <h3>
                <?= htmlspecialchars($infos['prenom'] ?? 'Prénom inconnu') ?>
                <?= htmlspecialchars($infos['nom'] ?? 'Nom inconnu') ?>
            </h3>
            <p>
                <?= htmlspecialchars($infos['nom_equipe'] ?? 'Aucune équipe') ?>
            </p>
        </div>
        <div class="profil-status">
            <span class="badge-inscrit"><span class="badge-texte">Inscrit</span><img src="view/img/inscrit_vert.webp"
                    alt="✓" width="20" height="20"></span>
        </div>
    </div>

    <nav class="tabs-navigation">
        <div id="tab-infos" class="tab active" onclick="switchTab('infos')">Informations</div>
        <div id="tab-equipe" class="tab" onclick="switchTab('equipe')">Mon Equipe</div>
        <div id="tab-temps" class="tab" onclick="switchTab('temps')">Mon Score</div>
        <div id="tab-avis" class="tab" onclick="switchTab('avis')">Laisser un Avis</div>
    </nav>

    <?php if (!empty($message)): ?>
        <p class="message-notif"><?= $message ?></p>
    <?php endif; ?>

    <div id="content-infos" class="tab-content">
        <form action="index.php?action=profil" method="POST">
            <input type="hidden" name="action" value="update_infos">
            <fieldset>
                <legend>Modifier mes Informations</legend>
                <div class="form-row">
                    <div class="form-group">
                        <label>Nom</label>
                        <input type="text" name="nom" value="<?= htmlspecialchars($infos['nom'] ?? '') ?>">
                    </div>
                    <div class="form-group">
                        <label>Prénom</label>
                        <input type="text" name="prenom" value="<?= htmlspecialchars($infos['prenom'] ?? '') ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Téléphone</label>
                        <input type="tel" name="telephone" value="<?= htmlspecialchars($infos['telephone']) ?>">
                    </div>
                    <div class="form-group">
                        <label>E-mail</label>
                        <input type="email" name="email" value="<?= htmlspecialchars($infos['email']) ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Pseudo</label>
                        <input type="text" name="pseudo" value="<?= htmlspecialchars($infos['pseudo']) ?>">
                    </div>
                    <div class="form-group">
                        <label>Mot de passe</label>
                        <input type="password" name="mot_de_passe" placeholder="Laissez vide pour ne pas changer">
                    </div>
                </div>

            </fieldset>
        </form>
        <div class="action-zone" style="margin-top: 8px;">
            <button type="submit" class="btn-enregistrer">Enregistrer</button>
        </div>
    </div>

    <div id="content-equipe" class="tab-content" style="display:none;">
       
        <form action="index.php?action=profil" method="POST">
            <input type="hidden" name="action" value="update_equipe">
             <h3>Nom de l'équipe</h3>

            <div class="liste-membres">
                <div class="membre-item">
                    <span class="numero">1</span>
                    <div class="membre-detail">
                        <strong>
                            <?= htmlspecialchars($infos['prenom'] ?? 'Prénom inconnu') ?>
                            <?= htmlspecialchars($infos['nom'] ?? 'Nom inconnu') ?>
                        </strong><br>
                        <small><?= htmlspecialchars($infos['pseudo']) ?></small>
                    </div>
                    <span class="label-vous">Vous</span>
                </div>

                <?php $i = 2;
                foreach ($membres as $m): ?>
                    <div class="membre-item">
                        <span class="numero"><?= $i ?></span>
                        <div class="membre-detail">
                            <input type="hidden" name="membre_id[]" value="<?= $m['id_membre'] ?>">
                            <input type="text" name="membre_prenom[]" value="<?= htmlspecialchars($m['prenom']) ?>"
                                placeholder="Prénom">
                            <input type="text" name="membre_nom[]" value="<?= htmlspecialchars($m['nom']) ?>"
                                placeholder="Nom">
                            <input type="text" name="membre_pseudo[]" value="<?= htmlspecialchars($m['pseudo']) ?>"
                                placeholder="Pseudo">
                        </div>
                        <span class="label-membre">Membre</span>
                    </div>
                    <?php $i++; endforeach; ?>
            </div>

            <div class="reservation-fixe-box">
                <p><strong>Menu Choisi</strong><?= htmlspecialchars($infos['type_menu']) ?></p>
                <p><strong>Session
                        Réservée</strong><?= $infos['date_session'] ? date('l j F Y, H:i', strtotime($infos['date_session'])) : 'Non définie' ?>
                </p>
                <div class="action-zone">
                    <p><strong>Besoins
                            Particuliers</strong><?= !empty($infos['options_accessibilite']) ? htmlspecialchars($infos['options_accessibilite']) : 'Aucun' ?>
                    </p>
                    <button type="submit" class="btn-modifier">Modifier</button>
                </div>
            </div>
        </form>
    </div>

    <div id="content-temps" class="tab-content" style="display:none;">
        <div class="recap-box">
            <h3>Temps record</h3>
            <?php if ($infos['score_obtenu']): ?>
                <p class="score-display"><?= htmlspecialchars($infos['score_obtenu']) ?> points</p>
            <?php else: ?>
                <p>Score non encore disponible.<br>Il sera renseigné par nos game masters après votre session.</p>
            <?php endif; ?>
        </div>
    </div>

    <div id="content-avis" class="tab-content" style="display:none;">
        <form action="index.php?action=profil" method="POST">
            <input type="hidden" name="action" value="envoyer_avis">

            <h3>Envoyer un commentaire</h3>

            <div class="rating-stars">
                <input type="radio" name="note" id="star5" value="5"><label for="star5">★</label>
                <input type="radio" name="note" id="star4" value="4"><label for="star4">★</label>
                <input type="radio" name="note" id="star3" value="3"><label for="star3">★</label>
                <input type="radio" name="note" id="star2" value="2"><label for="star2">★</label>
                <input type="radio" name="note" id="star1" value="1"><label for="star1">★</label>
            </div>

            <textarea name="contenu" rows="6" required></textarea>
            <div class="action-zone">
                <button type="submit" class="btn-envoyer">Envoyer</button>
            </div>

        </form>

    </div>

</main>
</div>

<script>
    function switchTab(tabName) {
        document.querySelectorAll('.tab-content').forEach(el => el.style.display = 'none');
        document.querySelectorAll('.tab').forEach(el => el.classList.remove('active'));
        document.getElementById('content-' + tabName).style.display = 'block';
        document.getElementById('tab-' + tabName).classList.add('active');
    }
</script>

<?php
// Le fichier de structure (Footer)
require_once 'view/autres_pages/footer.php';
?>