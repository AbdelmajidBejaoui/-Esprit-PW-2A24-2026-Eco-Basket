<?php $pageTitle = 'Dashboard – FitTrack Admin'; $controller = 'dashboard'; ?>
<?php require __DIR__ . '/../layouts/back_header.php'; ?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"><h1 class="m-0">Dashboard</h1></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

        <!-- Flash message -->
        <?php if (!empty($_SESSION['flash'])): ?>
            <div class="alert alert-<?= $_SESSION['flash']['type'] === 'success' ? 'success' : 'warning' ?> alert-dismissible fade show">
                <?= htmlspecialchars($_SESSION['flash']['msg']) ?>
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            </div>
            <?php unset($_SESSION['flash']); ?>
        <?php endif; ?>

        <!-- Stats cards -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?= $stats['total_entrainements'] ?></h3>
                        <p>Entraînements</p>
                    </div>
                    <div class="icon"><i class="fas fa-running"></i></div>
                    <a href="<?= BASE_PATH ?>/index.php?controller=back_entrainement&action=index" class="small-box-footer">Voir tout <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3><?= number_format($stats['total_calories'], 0) ?></h3>
                        <p>Calories Totales (kcal)</p>
                    </div>
                    <div class="icon"><i class="fas fa-fire"></i></div>
                    <a href="<?= BASE_PATH ?>/index.php?controller=back_depense&action=index" class="small-box-footer">Voir tout <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?= $stats['avg_duree'] ?> min</h3>
                        <p>Durée Moyenne</p>
                    </div>
                    <div class="icon"><i class="fas fa-clock"></i></div>
                    <a href="<?= BASE_PATH ?>/index.php?controller=back_entrainement&action=index" class="small-box-footer">Voir tout <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3><?= $stats['total_depenses'] ?></h3>
                        <p>Dépenses Enregistrées</p>
                    </div>
                    <div class="icon"><i class="fas fa-bolt"></i></div>
                    <a href="<?= BASE_PATH ?>/index.php?controller=back_depense&action=index" class="small-box-footer">Voir tout <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>

        <!-- Recent entrainements -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-running mr-2"></i>Entraînements récents</h3>
                        <div class="card-tools">
                            <a href="<?= BASE_PATH ?>/index.php?controller=back_entrainement&action=create" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> Ajouter
                            </a>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nom</th>
                                    <th>Type</th>
                                    <th>Durée</th>
                                    <th>Niveau</th>
                                    <th>Date</th>
                                    <th>Calories</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach (array_slice($recent, 0, 5) as $e): ?>
                                <tr>
                                    <td><?= $e['id'] ?></td>
                                    <td><?= htmlspecialchars($e['nom']) ?></td>
                                    <td><?= htmlspecialchars($e['type_sport']) ?></td>
                                    <td><?= $e['duree'] ?> min</td>
                                    <td><span class="badge badge-<?= $e['niveau'] ?>"><?= ucfirst($e['niveau']) ?></span></td>
                                    <td><?= date('d/m/Y', strtotime($e['date_entrainement'])) ?></td>
                                    <td><?= number_format($e['total_calories'], 0) ?> kcal</td>
                                    <td>
                                        <a href="<?= BASE_PATH ?>/index.php?controller=back_entrainement&action=show&id=<?= $e['id'] ?>" class="btn btn-xs btn-info"><i class="fas fa-eye"></i></a>
                                        <a href="<?= BASE_PATH ?>/index.php?controller=back_entrainement&action=edit&id=<?= $e['id'] ?>" class="btn btn-xs btn-warning"><i class="fas fa-edit"></i></a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<?php require __DIR__ . '/../layouts/back_footer.php'; ?>
