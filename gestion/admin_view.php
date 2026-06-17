<?php
if (!isset($onglet)) {
    $onglet = $_GET['onglet'] ?? 'dashboard';
}

// ON REMONTE D'UN DOSSIER AVEC "../"
require_once '../view/autres_pages/header.php';
?>
<div class="background-gradient-container">
    <div class="dashboard-container">
        <h1 class="dashboard-title">Vue d'ensemble</h1>

        <nav class="tabs-navigation">
            <a href="index.php?onglet=dashboard" class="tab <?= $onglet == 'dashboard' ? 'active' : '' ?>">Tableau de
                Bord</a>
            <a href="index.php?onglet=equipes" class="tab <?= $onglet == 'equipes' ? 'active' : '' ?>">Equipes</a>
            <a href="index.php?onglet=commentaires"
                class="tab <?= $onglet == 'commentaires' ? 'active' : '' ?>">Commentaires</a>
            <a href="index.php?onglet=temps" class="tab <?= $onglet == 'temps' ? 'active' : '' ?>">Scores des
                Equipes</a>
        </nav>


        <?php if ($onglet === 'dashboard'): ?>

            <?php
            // --- LOGIQUE DE PAGINATION ---
            // 1. On définit le nombre d'éléments par page
            $elementsParPage = 3;

            // 2. On récupère la page actuelle dans l'URL (ex: index.php?onglet=dashboard&page=2)
            $pageActuelle = isset($_GET['page']) ? (int) $_GET['page'] : 1;
            if ($pageActuelle < 1) {
                $pageActuelle = 1;
            }

            // 3. On calcule le nombre total de pages
            $totalSessions = count($sessions);
            $totalPages = ceil($totalSessions / $elementsParPage);
            if ($pageActuelle > $totalPages && $totalPages > 0) {
                $pageActuelle = $totalPages;
            }

            // 4. On découpe le tableau pour ne garder que les 3 éléments de la page actuelle
            $offset = ($pageActuelle - 1) * $elementsParPage;
            $sessionsAffichees = array_slice($sessions, $offset, $elementsParPage);
            ?>

            <div class="dashboard-stats">
                <div class="stat-card">
                    <div class="stat-value">4,7/5</div>
                    <div class="stat-label">Note globale sur<br>le site web</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value"><?= htmlspecialchars($stats['joueurs_attendus'] ?? 0) ?></div>
                    <div class="stat-label">Joueurs attendus<br>cette semaine</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value"><?= htmlspecialchars($stats['avis_attente'] ?? 0) ?></div>
                    <div class="stat-label">Avis en attente<br>de validation</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value"><?= htmlspecialchars($stats['taux_reussite'] ?? 0) ?>%</div>
                    <div class="stat-label">Taux de réussite les<br>30 derniers jours</div>
                </div>
            </div>

            <div class="dashboard-table-container">
                <h2 class="table-title">Sessions à venir</h2>

                <table class="dashboard-table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Equipe</th>
                            <th>Nb. de Joueurs</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($sessionsAffichees)): ?>
                            <?php foreach ($sessionsAffichees as $index => $session): ?>
                                <?php
                                $isLast = ($index === count($sessionsAffichees) - 1);
                                $classNoBorder = $isLast ? 'no-border-bottom' : '';
                                ?>
                                <tr>
                                    <td class="<?= $classNoBorder ?>">
                                        <?= date('d/m/Y H:i', strtotime($session['date_session'])) ?>
                                    </td>
                                    <td class="border-left <?= $classNoBorder ?>">
                                        <?= htmlspecialchars($session['nom_equipe'] ?? '—') ?>
                                    </td>
                                    <td class="border-left <?= $classNoBorder ?>">
                                        <?= $session['nb_participants'] ?? '—' ?>
                                    </td>
                                    <td class="border-left <?= $classNoBorder ?>">
                                        <?= $session['est_complete'] ? 'Complet' : 'Ouvert' ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="no-border-bottom" style="text-align: center; padding: 20px;">Aucune
                                    session à
                                    venir pour le moment.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

                <div class="table-pagination">
                    <?php if ($pageActuelle > 1): ?>
                        <a href="index.php?onglet=dashboard&page=<?= $pageActuelle - 1 ?>">◀</a>
                    <?php else: ?>
                        <span style="color: rgba(232, 232, 232, 0.3); margin: 0 5px;">◀</span>
                    <?php endif; ?>

                    Page <?= $pageActuelle ?>/<?= max(1, $totalPages) ?>

                    <?php if ($pageActuelle < $totalPages): ?>
                        <a href="index.php?onglet=dashboard&page=<?= $pageActuelle + 1 ?>">▶</a>
                    <?php else: ?>
                        <span style="color: rgba(232, 232, 232, 0.3); margin: 0 5px;">▶</span>
                    <?php endif; ?>
                </div>
            </div>

            <<?php elseif ($onglet === 'equipes'): ?>

                <?php if (!empty($equipes)): ?>
                    <?php foreach ($equipes as $equipe): ?>
                        <div class="dashboard-table-container">
                            <article style="margin-bottom: 30px; border-bottom: 1px solid #3a7a58; padding-bottom: 20px;">
                                <h3
                                    style="color: #6ebd87;font-family: 'Special Elite', cursive;margin-top:0;display: flex;justify-content: space-between;">
                                    <?= htmlspecialchars($equipe['nom_equipe']) ?>
                                    <span class="badge-inscrit"><span class="badge-texte">Inscrit</span><img
                                            src="../view/img/inscrit_vert.webp" alt="✓" width="20" height="20"></span>
                                </h3>
                                <p style="font-family: 'Besley', serif; color: #e0f2e9;">
                                    Session du :
                                    <?= $equipe['date_session'] ? date('d/m/Y H:i', strtotime($equipe['date_session'])) : '—' ?>
                                </p>

                                <table class="dashboard-table">
                                    <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Prénom</th>
                                            <th>Pseudo</th>
                                            <th>Email</th>
                                            <th>Téléphone</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="no-border-bottom"><?= htmlspecialchars($equipe['nom'] ?? '—') ?></td>
                                            <td class="border-left no-border-bottom">
                                                <?= htmlspecialchars($equipe['prenom'] ?? '—') ?></td>
                                            <td class="border-left no-border-bottom">
                                                <?= htmlspecialchars($equipe['capitaine_pseudo'] ?? '—') ?>
                                            </td>
                                            <td class="border-left no-border-bottom">
                                                <?= htmlspecialchars($equipe['email'] ?? '—') ?></td>
                                            <td class="border-left no-border-bottom">
                                                <?= htmlspecialchars($equipe['telephone'] ?? '—') ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div
                                    style="margin-top: 25px; padding: 15px; background-color: rgba(11, 30, 24, 0.6); border-left: 4px solid #4aa07b; border-radius: 0 4px 4px 0;">
                                    <p style="font-family: 'Besley', serif; color: #e0f2e9; margin: 0 0 10px 0; font-size: 16px;">
                                        <strong style="color: #4aa07b; font-family: 'Special Elite', cursive; font-size: 18px;">Type
                                            de Menu :</strong>
                                        <?= htmlspecialchars($equipe['type_menu'] ?? 'Non spécifié') ?>
                                    </p>
                                    <p style="font-family: 'Besley', serif; color: #cc2929; margin: 0; font-size: 16px;">
                                        <strong
                                            style="color: #4aa07b; font-family: 'Special Elite', cursive; font-size: 18px;">Besoins
                                            particuliers / Accessibilité :</strong>
                                        <?php if (!empty($equipe['options_accessibilite'])): ?>
                                            <br>
                                            <span
                                                style="font-style: italic;"><?= nl2br(htmlspecialchars($equipe['options_accessibilite'])) ?></span>
                                        <?php else: ?>
                                            Aucun besoin particulier signalé.
                                        <?php endif; ?>
                                    </p>
                                </div>

                            </article>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p style="font-family: 'Besley', serif; color: #e0f2e9;">Aucune équipe inscrite pour le moment.</p>
                <?php endif; ?>

            <?php elseif ($onglet === 'commentaires'): ?>

                <div class="comments-subnav">
                    <a href="#" class="subtab active">En Attente (<?= count($commentaires) ?>)</a>
                    <a href="#" class="subtab">Approuvés</a>
                    <a href="#" class="subtab">Refusés</a>
                </div>

                <div class="comments-list">
                    <?php if (!empty($commentaires)): ?>
                        <?php foreach ($commentaires as $avis): ?>
                            <div class="comment-card">
                                <div class="comment-header">
                                    <div class="comment-user-section">
                                        <div class="comment-pseudo"><?= htmlspecialchars($avis['pseudo'] ?? 'Anonyme') ?></div>
                                        <div class="comment-meta">
                                            <div class="comment-stars">
                                                <?php
                                                // Affichage des étoiles en fonction de la note (par défaut 5 si vide)
                                                $note = $avis['note'] ?? 5;
                                                for ($i = 1; $i <= 5; $i++) {
                                                    echo $i <= $note ? '★' : '☆';
                                                }
                                                ?>
                                            </div>
                                            <div class="comment-date"><?= date('d/m/Y', strtotime($avis['date_publication'])) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="comment-badge">En attente</div>
                                </div>

                                <p class="comment-text">"<?= nl2br(htmlspecialchars($avis['contenu'])) ?>"</p>

                                <form action="index.php" method="POST" class="comment-actions">
                                    <input type="hidden" name="action" value="moderation">
                                    <input type="hidden" name="id_commentaire" value="<?= $avis['id_commentaire'] ?>">
                                    <button type="submit" name="decision" value="approuver" class="btn-accepter">Accepter</button>
                                    <button type="submit" name="decision" value="refuser" class="btn-refuser">Refuser</button>
                                </form>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p style="font-family: 'Besley', serif; color: #e0f2e9; text-align: center;">Aucun commentaire en
                            attente.</p>
                    <?php endif; ?>
                </div>

                <div class="table-pagination">
                    <span style="color: rgba(232, 232, 232, 0.3); margin: 0 5px;">◀</span>
                    Page 1/1
                    <span style="color: rgba(232, 232, 232, 0.3); margin: 0 5px;">▶</span>
                </div>
        </div>

    <?php elseif ($onglet === 'temps'): ?>
        <div class="dashboard-table-container" style="margin-bottom: 40px;">
            <h2 class="table-title">Saisie Rapide des Scores</h2>
            <form action="index.php" method="POST" style="display: flex; gap: 20px; align-items: flex-end;">
                <input type="hidden" name="action" value="maj_score">
                <div style="flex: 1;">
                    <label style="display: block; font-family: 'Besley', serif; color: #e0f2e9; margin-bottom: 5px;">Equipe
                        :</label>
                    <select name="id_equipe" required
                        style="width: 100%; padding: 10px; background-color: #0a0f0c; color: #e0f2e9; border: 1px solid #3a7a58; font-family: 'Besley', serif;">
                        <option value="">-- Choisir une équipe --</option>
                        <?php if (!empty($equipes)): ?>
                            <?php foreach ($equipes as $eq): ?>
                                <option value="<?= $eq['id_equipe'] ?>"><?= htmlspecialchars($eq['nom_equipe']) ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div style="flex: 1;">
                    <label style="display: block; font-family: 'Besley', serif; color: #e0f2e9; margin-bottom: 5px;">Score
                        (pts) :</label>
                    <input type="number" name="score" required
                        style="width: 100%; padding: 10px; background-color: #0a0f0c; color: #e0f2e9; border: 1px solid #3a7a58; font-family: 'Besley', serif; box-sizing: border-box;">
                </div>
                <button type="submit"
                    style="background-color: #4aa07b; color: #0b1e18; border: none; padding: 10px 20px; font-family: 'Special Elite', cursive; cursor: pointer; height: 42px;">Enregistrer</button>
            </form>
        </div>

        <div class="dashboard-table-container">
            <h2 class="table-title">Classement</h2>
            <table class="dashboard-table">
                <thead>
                    <tr>
                        <th>Equipe</th>
                        <th>Score</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($equipes)): ?>
                        <?php
                        // Petite astuce pour filtrer ceux qui ont un score
                        $equipesClassees = array_filter($equipes, function ($eq) {
                            return !empty($eq['score_obtenu']) && $eq['score_obtenu'] > 0;
                        });

                        if (!empty($equipesClassees)):
                            // Optionnel : Trier par score décroissant (si pas fait en SQL)
                            usort($equipesClassees, function ($a, $b) {
                                return $b['score_obtenu'] <=> $a['score_obtenu'];
                            });

                            foreach ($equipesClassees as $index => $eq):
                                $isLast = ($index === count($equipesClassees) - 1);
                                $classNoBorder = $isLast ? 'no-border-bottom' : '';
                                ?>
                                <tr>
                                    <td class="<?= $classNoBorder ?>"><?= htmlspecialchars($eq['nom_equipe']) ?></td>
                                    <td class="border-left <?= $classNoBorder ?>"><?= htmlspecialchars($eq['score_obtenu']) ?> pts
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="2" class="no-border-bottom" style="text-align: center; padding: 20px;">Aucun score
                                    enregistré.</td>
                            </tr>
                        <?php endif; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="2" class="no-border-bottom" style="text-align: center; padding: 20px;">Aucun score
                                enregistré.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
</div>

<?php require_once '../view/autres_pages/footer.php'; ?>