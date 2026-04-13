<?php $pageTitle = 'Ajouter une Dépense – FitTrack'; $controller = 'front_entrainement'; ?>
<?php require __DIR__ . '/../../layouts/front_header.php'; ?>

<section class="hero-wrap hero-wrap-2" style="background-image: url('<?= ASSETS_FRONT ?>/images/bg_2.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
            <div class="col-md-9 pb-5 text-center">
                <p class="breadcrumbs">
                    <span class="mr-2"><a href="<?= BASE_PATH ?>/index.php?controller=front_entrainement">Entraînements</a></span>
                    <span>Ajouter une dépense</span>
                </p>
                <h1 class="mb-3 bread">🔥 Nouvelle Dépense Énergétique</h1>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div style="background:#fff; border-radius:16px; box-shadow:0 8px 30px rgba(0,0,0,.08); padding:40px;">
                    <h4 class="mb-4" style="color:#82ae46;"><i class="fas fa-fire mr-2"></i>Enregistrer une dépense énergétique</h4>

                    <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        <strong>Erreurs :</strong>
                        <ul class="mb-0 mt-1">
                            <?php foreach ($errors as $err): ?>
                                <li><?= htmlspecialchars($err) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>

                    <form method="POST" action="<?= BASE_PATH ?>/index.php?controller=front_entrainement&action=add_depense&id=<?= htmlspecialchars($data['entrainement_id'] ?? '') ?>">
                        <input type="hidden" name="entrainement_id" value="<?= htmlspecialchars($data['entrainement_id'] ?? '') ?>">

                        <!-- Afficher le nom de l'entraînement -->
                        <?php foreach ($entrainements as $e): ?>
                            <?php if ((string)$e['id'] === (string)($data['entrainement_id'] ?? '')): ?>
                            <div class="alert alert-success py-2">
                                <i class="fas fa-running mr-2"></i>
                                Entraînement : <strong><?= htmlspecialchars($e['nom']) ?></strong>
                                – <?= date('d/m/Y', strtotime($e['date_entrainement'])) ?>
                            </div>
                            <?php endif; ?>
                        <?php endforeach; ?>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="font-weight:600;">Calories brûlées (kcal) <span class="text-danger">*</span></label>
                                    <input type="number" name="calories_brulees"
                                           class="form-control <?= isset($errors['calories_brulees']) ? 'is-invalid' : '' ?>"
                                           value="<?= htmlspecialchars($data['calories_brulees'] ?? '') ?>"
                                           placeholder="Ex: 350"
                                           style="border-radius:8px; height:48px;">
                                    <?php if (isset($errors['calories_brulees'])): ?>
                                        <div class="text-danger small mt-1"><?= htmlspecialchars($errors['calories_brulees']) ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="font-weight:600;">Fréquence cardiaque moy. (bpm)</label>
                                    <input type="number" name="frequence_cardiaque_moy"
                                           class="form-control <?= isset($errors['frequence_cardiaque_moy']) ? 'is-invalid' : '' ?>"
                                           value="<?= htmlspecialchars($data['frequence_cardiaque_moy'] ?? '') ?>"
                                           placeholder="Ex: 145"
                                           style="border-radius:8px; height:48px;">
                                    <small class="text-muted">Entre 40 et 250. Optionnel.</small>
                                    <?php if (isset($errors['frequence_cardiaque_moy'])): ?>
                                        <div class="text-danger small mt-1"><?= htmlspecialchars($errors['frequence_cardiaque_moy']) ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label style="font-weight:600;">Intensité <span class="text-danger">*</span></label>
                            <select name="intensite"
                                    class="form-control <?= isset($errors['intensite']) ? 'is-invalid' : '' ?>"
                                    style="border-radius:8px; height:48px;">
                                <option value="">-- Sélectionner --</option>
                                <?php foreach (['faible'=>'Faible','moderee'=>'Modérée','elevee'=>'Élevée','maximale'=>'Maximale'] as $val => $label): ?>
                                    <option value="<?= $val ?>" <?= ($data['intensite'] ?? '') === $val ? 'selected' : '' ?>><?= $label ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?php if (isset($errors['intensite'])): ?>
                                <div class="text-danger small mt-1"><?= htmlspecialchars($errors['intensite']) ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label style="font-weight:600;">Remarques</label>
                            <textarea name="remarques" rows="3" class="form-control"
                                      placeholder="Notes sur la séance..."
                                      style="border-radius:8px;"><?= htmlspecialchars($data['remarques'] ?? '') ?></textarea>
                        </div>

                        <div class="d-flex" style="gap:10px; margin-top:20px;">
                            <button type="submit" class="btn btn-primary px-4"
                                    style="background:#82ae46; border-color:#82ae46; border-radius:30px; height:48px;">
                                <i class="fas fa-save mr-2"></i>Enregistrer
                            </button>
                            <a href="<?= BASE_PATH ?>/index.php?controller=front_entrainement&action=show&id=<?= htmlspecialchars($data['entrainement_id'] ?? '') ?>"
                               class="btn btn-outline-secondary px-4" style="border-radius:30px; height:48px; line-height:32px;">
                                Annuler
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . '/../../layouts/front_footer.php'; ?>
