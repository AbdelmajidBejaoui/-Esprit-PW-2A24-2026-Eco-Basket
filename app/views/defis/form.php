<?php
$title = $action === 'edit' ? 'Stabilis™ — Modifier un défi' : 'Stabilis™ — Nouveau défi';
require __DIR__ . '/../layout/header.php';
?>

        <div class="form-card">
            <div class="card-header">
                <h2><?= $action === 'edit' ? 'Modifier le défi' : 'Créer un défi' ?></h2>
                <p><?= $action === 'edit' ? 'Ajustez les paramètres de l\'objectif' : 'Définissez un objectif nutritionnel ou sportif durable' ?></p>
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

                <form method="POST" action="index.php?action=<?= $action ?><?= $action === 'edit' ? '&id=' . intval($defi['id']) : '' ?>">
                    <div class="form-group">
                        <label>Nom du défi</label>
                        <input type="text" name="nom" class="form-control" value="<?= htmlspecialchars($defi['nom'] ?? '') ?>" placeholder="ex: Protéines végétales" required>
                        <div class="hint"><i class="fas fa-flag-checkered"></i> Maximum 100 caractères</div>
                    </div>

                    <div class="form-group">
                        <label>Catégorie</label>
                        <select name="type" class="form-control" required>
                            <option value="">Sélectionner</option>
                            <option value="aliment" <?= ($defi['type'] ?? '') === 'aliment' ? 'selected' : '' ?>>Aliment / Nutrition</option>
                            <option value="entrainement" <?= ($defi['type'] ?? '') === 'entrainement' ? 'selected' : '' ?>>Entraînement</option>
                            <option value="compensation" <?= ($defi['type'] ?? '') === 'compensation' ? 'selected' : '' ?>>Compensation carbone</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Objectif</label>
                        <input type="text" name="objectif" class="form-control" value="<?= htmlspecialchars($defi['objectif'] ?? '') ?>" placeholder="ex: 5 repas végétariens par semaine" required>
                        <div class="hint"><i class="fas fa-bullseye"></i> Objectif mesurable et atteignable</div>
                    </div>

                    <div class="form-group">
                        <label>Récompense</label>
                        <input type="text" name="recompense" class="form-control" value="<?= htmlspecialchars($defi['recompense'] ?? '') ?>" placeholder="ex: 100 points + badge" required>
                        <div class="hint"><i class="fas fa-medal"></i> Ce qui motive l'effort</div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-save"></i> <?= $action === 'edit' ? 'Mettre à jour' : 'Enregistrer' ?>
                        </button>
                        <a href="index.php" class="btn-cancel">Annuler</a>
                    </div>
                </form>

                <div class="inspo-widget" style="margin-top: 26px; padding: 18px 22px; border: 1px solid #EDEDE9; border-radius: 20px; background: #FAFBF9; display: flex; gap: 14px; align-items: center;">
                    <i class="fas fa-lightbulb" style="color: #3A6B4B;"></i>
                    <div class="text">
                        <strong>Astuce durable</strong><br>
                        Un défi bien défini = une meilleure adhésion. Soyez précis et motivant.
                    </div>
                </div>
            </div>
        </div>

<?php require __DIR__ . '/../layout/footer.php';
