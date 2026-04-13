<?php $pageTitle = 'Ajouter un Entraînement – FitTrack'; $controller = 'front_entrainement'; ?>
<?php require __DIR__ . '/../../layouts/front_header.php'; ?>

<section class="hero-wrap hero-wrap-2" style="background-image: url('<?= ASSETS_FRONT ?>/images/bg_2.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
            <div class="col-md-9 pb-5 text-center">
                <p class="breadcrumbs">
                    <span class="mr-2"><a href="<?= BASE_PATH ?>/index.php?controller=front_entrainement">Entraînements</a></span>
                    <span>Ajouter</span>
                </p>
                <h1 class="mb-3 bread">Nouvel Entraînement</h1>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div style="background:#fff; border-radius:16px; box-shadow:0 8px 30px rgba(0,0,0,.08); padding:40px;">
                    <h4 class="mb-4" style="color:#82ae46;">
                        <i class="fas fa-plus-circle mr-2"></i>Ajouter un entraînement
                    </h4>
                    <form method="POST" action="<?= BASE_PATH ?>/index.php?controller=front_entrainement&action=create">
                        <?php require __DIR__ . '/_form.php'; ?>
                        <div class="d-flex" style="gap:10px; margin-top:20px;">
                            <button type="submit" class="btn btn-primary px-4"
                                    style="background:#82ae46; border-color:#82ae46; border-radius:30px; height:48px;">
                                <i class="fas fa-save mr-2"></i>Enregistrer
                            </button>
                            <a href="<?= BASE_PATH ?>/index.php?controller=front_entrainement"
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
