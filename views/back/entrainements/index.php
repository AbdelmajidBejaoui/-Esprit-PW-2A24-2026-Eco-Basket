<?php $pageTitle = 'Entraînements – Admin'; $controller = 'back_entrainement'; ?>
<?php require __DIR__ . '/../../layouts/back_header.php'; ?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"><h1 class="m-0">Gestion des Entraînements</h1></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= BASE_PATH ?>/index.php?controller=dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active">Entraînements</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

        <?php if (!empty($_SESSION['flash'])): ?>
            <div class="alert alert-<?= $_SESSION['flash']['type'] === 'success' ? 'success' : 'warning' ?> alert-dismissible fade show">
                <?= htmlspecialchars($_SESSION['flash']['msg']) ?>
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            </div>
            <?php unset($_SESSION['flash']); ?>
        <?php endif; ?>

        <!-- Stats row -->
        <div class="row mb-3">
            <div class="col-md-4">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="fas fa-running"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Entraînements</span>
                        <span class="info-box-number"><?= $stats['total'] ?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-box">
                    <span class="info-box-icon bg-danger"><i class="fas fa-fire"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Calories totales brûlées</span>
                        <span class="info-box-number"><?= number_format($stats['total_calories'], 0) ?> kcal</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="fas fa-clock"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Durée Moyenne</span>
                        <span class="info-box-number"><?= $stats['avg_duree'] ?> min</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-list mr-2"></i>Liste des entraînements</h3>
                <div class="card-tools">
                    <a href="<?= BASE_PATH ?>/index.php?controller=back_entrainement&action=create" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Ajouter un entraînement
                    </a>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Type de sport</th>
                            <th>Durée</th>
                            <th>Niveau</th>
                            <th>Date</th>
                            <th>Calories</th>
                            <th>Séances</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($entrainements)): ?>
                        <tr><td colspan="9" class="text-center text-muted py-4">Aucun entraînement enregistré.</td></tr>
                        <?php else: ?>
                        <?php foreach ($entrainements as $e): ?>
                        <tr>
                            <td><?= $e['id'] ?></td>
                            <td><strong><?= htmlspecialchars($e['nom']) ?></strong></td>
                            <td><?= htmlspecialchars($e['type_sport']) ?></td>
                            <td><?= $e['duree'] ?> min</td>
                            <td>
                                <span class="badge badge-<?= $e['niveau'] ?>">
                                    <?= ucfirst($e['niveau']) ?>
                                </span>
                            </td>
                            <td><?= date('d/m/Y', strtotime($e['date_entrainement'])) ?></td>
                            <td><span class="text-danger font-weight-bold"><?= number_format($e['total_calories'], 0) ?></span> kcal</td>
                            <td><span class="badge badge-secondary"><?= $e['nb_depenses'] ?></span></td>
                            <td class="text-nowrap">
                                <a href="<?= BASE_PATH ?>/index.php?controller=back_entrainement&action=show&id=<?= $e['id'] ?>"
                                   class="btn btn-sm btn-info" title="Voir"><i class="fas fa-eye"></i></a>
                                <a href="<?= BASE_PATH ?>/index.php?controller=back_entrainement&action=edit&id=<?= $e['id'] ?>"
                                   class="btn btn-sm btn-warning" title="Modifier"><i class="fas fa-edit"></i></a>
                                <a href="<?= BASE_PATH ?>/index.php?controller=back_depense&action=create&entrainement_id=<?= $e['id'] ?>"
                                   class="btn btn-sm btn-success" title="Ajouter dépense"><i class="fas fa-fire"></i></a>
                                <a href="<?= BASE_PATH ?>/index.php?controller=back_entrainement&action=delete&id=<?= $e['id'] ?>"
                                   class="btn btn-sm btn-danger" title="Supprimer"
                                   onclick="return confirm('Supprimer cet entraînement et toutes ses dépenses ?')">
                                   <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . '/../../layouts/back_footer.php'; ?>
