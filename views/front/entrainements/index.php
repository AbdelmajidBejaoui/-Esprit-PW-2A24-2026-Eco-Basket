<?php $pageTitle = 'Nos Entraînements – FitTrack'; $controller = 'front_entrainement'; ?>
<?php require __DIR__ . '/../../layouts/front_header.php'; ?>

<!-- HERO avec slider style vegefoods -->
<div id="ftco-loader" class="show fullscreen">
    <svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#82ae46"/></svg>
</div>

<section class="hero-wrap hero-wrap-2" style="background-image: url('<?= ASSETS_FRONT ?>/images/bg_1.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
            <div class="col-md-9 pb-5 text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="<?= BASE_PATH ?>/index.php">Accueil</a></span> <span>Entraînements</span></p>
                <h1 class="mb-3 bread">Gestion des Entraînements</h1>
            </div>
        </div>
    </div>
</section>

<!-- FLASH -->
<?php if (!empty($_SESSION['flash'])): ?>
<div class="container mt-3">
    <div class="alert alert-<?= $_SESSION['flash']['type'] === 'success' ? 'success' : 'warning' ?> alert-dismissible" role="alert">
        <?= htmlspecialchars($_SESSION['flash']['msg']) ?>
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div>
</div>
<?php unset($_SESSION['flash']); endif; ?>

<!-- STATS BAND -->
<section class="ftco-section ftco-no-pb ftco-no-pt py-4" style="background:#82ae46;">
    <div class="container">
        <div class="row text-center text-white">
            <div class="col-6 col-md-3 py-3" style="border-right:1px solid rgba(255,255,255,.3);">
                <h3 class="mb-0 font-weight-bold"><?= $stats['total'] ?></h3>
                <small>Entraînements</small>
            </div>
            <div class="col-6 col-md-3 py-3" style="border-right:1px solid rgba(255,255,255,.3);">
                <h3 class="mb-0 font-weight-bold"><?= number_format($stats['total_calories'], 0) ?></h3>
                <small>Calories brûlées</small>
            </div>
            <div class="col-6 col-md-3 py-3" style="border-right:1px solid rgba(255,255,255,.3);">
                <h3 class="mb-0 font-weight-bold"><?= $stats['avg_duree'] ?> min</h3>
                <small>Durée moyenne</small>
            </div>
            <div class="col-6 col-md-3 py-3">
                <h3 class="mb-0 font-weight-bold"><?= $stats['total_depenses'] ?></h3>
                <small>Séances enregistrées</small>
            </div>
        </div>
    </div>
</section>

<!-- LISTE ENTRAINEMENTS -->
<section class="ftco-section">
    <div class="container">

        <div class="row justify-content-center mb-5">
            <div class="col-md-7 text-center heading-section">
                <span class="subheading">Programmes sportifs</span>
                <h2 class="mb-2">Tous les entraînements</h2>
                <p>Ajoutez, modifiez ou supprimez vos séances d'entraînement.</p>
            </div>
        </div>

        <!-- Bouton ajouter -->
        <div class="row mb-4">
            <div class="col-12 text-right">
                <a href="<?= BASE_PATH ?>/index.php?controller=front_entrainement&action=create"
                   class="btn btn-primary px-4 py-2" style="border-radius:30px; background:#82ae46; border-color:#82ae46;">
                    <i class="fas fa-plus mr-2"></i>Ajouter un entraînement
                </a>
            </div>
        </div>

        <div class="row">
            <?php if (empty($entrainements)): ?>
                <div class="col-12 text-center py-5">
                    <i class="fas fa-dumbbell fa-3x mb-3" style="color:#ccc;"></i>
                    <p class="text-muted">Aucun entraînement enregistré.</p>
                    <a href="<?= BASE_PATH ?>/index.php?controller=front_entrainement&action=create"
                       class="btn btn-primary" style="background:#82ae46; border-color:#82ae46; border-radius:30px;">
                        Créer le premier entraînement
                    </a>
                </div>
            <?php else: ?>
                <?php
                $sportImages = [
                    'Course à pied'=>'image_1.jpg','Musculation'=>'bg_3.jpg',
                    'HIIT'=>'bg_1.jpg','Yoga'=>'about.jpg','Cyclisme'=>'image_2.jpg',
                    'Natation'=>'image_3.jpg','Football'=>'image_4.jpg',
                    'Basketball'=>'image_5.jpg','Tennis'=>'image_6.jpg',
                    'Boxe'=>'bg_2.jpg','Pilates'=>'category-1.jpg','Autre'=>'category-2.jpg',
                ];
                $niveauColors = ['debutant'=>['bg'=>'#28a745','txt'=>'#fff'],
                                 'intermediaire'=>['bg'=>'#ffc107','txt'=>'#000'],
                                 'avance'=>['bg'=>'#dc3545','txt'=>'#fff']];
                ?>
                <?php foreach ($entrainements as $e): ?>
                <?php $img = $sportImages[$e['type_sport']] ?? 'bg_1.jpg'; ?>
                <?php $nc = $niveauColors[$e['niveau']] ?? ['bg'=>'#6c757d','txt'=>'#fff']; ?>
                <div class="col-md-6 col-lg-4">
                    <div class="product">
                        <!-- Image -->
                        <a href="<?= BASE_PATH ?>/index.php?controller=front_entrainement&action=show&id=<?= $e['id'] ?>"
                           class="img-prod">
                            <img class="img-fluid" src="<?= ASSETS_FRONT ?>/images/<?= $img ?>"
                                 alt="<?= htmlspecialchars($e['type_sport']) ?>"
                                 style="height:200px; width:100%; object-fit:cover;">
                            <span class="status" style="background:<?= $nc['bg'] ?>; color:<?= $nc['txt'] ?>;">
                                <?= ucfirst($e['niveau']) ?>
                            </span>
                            <div class="overlay"></div>
                        </a>

                        <!-- Texte -->
                        <div class="text py-3 pb-4 px-3">
                            <h3>
                                <a href="<?= BASE_PATH ?>/index.php?controller=front_entrainement&action=show&id=<?= $e['id'] ?>">
                                    <?= htmlspecialchars($e['nom']) ?>
                                </a>
                            </h3>
                            <p class="text-muted" style="font-size:.82rem; margin-bottom:6px;">
                                <i class="fas fa-dumbbell mr-1" style="color:#82ae46;"></i><?= htmlspecialchars($e['type_sport']) ?>
                                &nbsp;•&nbsp;
                                <i class="fas fa-clock mr-1" style="color:#82ae46;"></i><?= $e['duree'] ?> min
                            </p>
                            <p class="text-muted" style="font-size:.82rem; margin-bottom:8px;">
                                <i class="fas fa-calendar-alt mr-1" style="color:#82ae46;"></i>
                                <?= date('d/m/Y', strtotime($e['date_entrainement'])) ?>
                                &nbsp;•&nbsp;
                                <i class="fas fa-fire mr-1" style="color:#f5576c;"></i>
                                <?= number_format($e['total_calories'], 0) ?> kcal
                            </p>

                            <!-- Actions CRUD -->
                            <div class="d-flex" style="gap:6px; margin-top:10px;">
                                <a href="<?= BASE_PATH ?>/index.php?controller=front_entrainement&action=show&id=<?= $e['id'] ?>"
                                   class="btn btn-sm flex-fill" style="background:#82ae46; color:#fff; border-radius:20px; font-size:.8rem;">
                                    <i class="fas fa-eye mr-1"></i>Voir
                                </a>
                                <a href="<?= BASE_PATH ?>/index.php?controller=front_entrainement&action=edit&id=<?= $e['id'] ?>"
                                   class="btn btn-sm flex-fill btn-warning" style="border-radius:20px; font-size:.8rem;">
                                    <i class="fas fa-edit mr-1"></i>Modifier
                                </a>
                                <a href="<?= BASE_PATH ?>/index.php?controller=front_entrainement&action=delete&id=<?= $e['id'] ?>"
                                   class="btn btn-sm flex-fill btn-danger" style="border-radius:20px; font-size:.8rem;"
                                   onclick="return confirm('Supprimer cet entraînement et toutes ses dépenses ?')">
                                    <i class="fas fa-trash mr-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php require __DIR__ . '/../../layouts/front_footer.php'; ?>
