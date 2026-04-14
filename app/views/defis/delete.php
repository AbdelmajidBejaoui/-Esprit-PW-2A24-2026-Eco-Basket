<?php
$title = 'Stabilis™ — Supprimer un défi';
require __DIR__ . '/../layout/header.php';
?>

        <div class="form-card" style="max-width: 680px; margin: 0 auto;">
            <div class="card-header">
                <h2>Supprimer le défi</h2>
                <p>Cette action est irréversible. Confirmez la suppression si vous souhaitez continuer.</p>
            </div>
            <div class="card-body">
                <?php if (!empty($errors)): ?>
                    <div class="alert">
                        <ul>
                            <?php foreach ($errors as $err): ?>
                                <li><?= htmlspecialchars($err) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <div style="margin-bottom: 24px;">
                    <p><strong>ID :</strong> #<?= str_pad($defi['id'], 3, '0', STR_PAD_LEFT) ?></p>
                    <p><strong>Nom :</strong> <?= htmlspecialchars($defi['nom']) ?></p>
                    <p><strong>Objectif :</strong> <?= htmlspecialchars($defi['objectif']) ?></p>
                    <p><strong>Récompense :</strong> <?= htmlspecialchars($defi['recompense']) ?></p>
                </div>

                <form method="POST" action="index.php?action=delete&id=<?= $defi['id'] ?>">
                    <input type="hidden" name="confirm" value="oui">
                    <div class="form-actions">
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-trash-alt"></i> Supprimer définitivement
                        </button>
                        <a href="index.php" class="btn-cancel">Annuler</a>
                    </div>
                </form>
            </div>
        </div>

<?php require __DIR__ . '/../layout/footer.php';
