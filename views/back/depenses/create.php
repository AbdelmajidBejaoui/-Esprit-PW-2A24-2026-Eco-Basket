<?php $pageTitle = 'Ajouter Dépense – Admin'; $controller = 'back_depense'; ?>
<?php require __DIR__ . '/../../layouts/back_header.php'; ?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"><h1 class="m-0">Ajouter une Dépense Énergétique</h1></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= BASE_PATH ?>/index.php?controller=dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?= BASE_PATH ?>/index.php?controller=back_depense&action=index">Dépenses</a></li>
                    <li class="breadcrumb-item active">Ajouter</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-fire mr-2"></i>Nouvelle dépense énergétique</h3>
                    </div>
                    <form method="POST" action="<?= BASE_PATH ?>/index.php?controller=back_depense&action=create">
                        <div class="card-body">
                            <?php if (!empty($errors)): ?>
                                <div class="alert alert-danger">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    Veuillez corriger les erreurs ci-dessous.
                                </div>
                            <?php endif; ?>
                            <?php require __DIR__ . '/_form.php'; ?>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save mr-1"></i> Enregistrer
                            </button>
                            <a href="<?= BASE_PATH ?>/index.php?controller=back_depense&action=index" class="btn btn-default ml-2">
                                Annuler
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . '/../../layouts/back_footer.php'; ?>
