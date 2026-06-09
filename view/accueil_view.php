<?php require_once 'view/autres_pages/header.php'; ?>
<section class="avis-publics" style="margin-top: 40px; background: #f9f9f9; padding: 20px; border-radius: 5px;">
    <h2>Les retours des survivants</h2>
    <?php if(empty($avis_publics)): ?>
        <p>Aucun avis pour le moment. Soyez la première équipe à laisser une trace !</p>
    <?php else: ?>
        <div style="display: flex; flex-direction: column; gap: 15px;">
            <?php foreach($avis_publics as $avis): ?>
                <div style="background: white; padding: 15px; border-left: 4px solid #e94560; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                    <p style="font-style: italic;">"<?= htmlspecialchars($avis['contenu']) ?>"</p>
                    <p style="text-align: right; margin-top: 10px; font-size: 0.9em; color: #666;">
                        - <strong><?= htmlspecialchars($avis['pseudo']) ?></strong>, le <?= date('d/m/Y', strtotime($avis['date_publication'])) ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>
<?php require_once 'view/autres_pages/footer.php'; ?>