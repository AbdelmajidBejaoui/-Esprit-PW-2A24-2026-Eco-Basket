<?php $pageTitle = 'Dépenses Énergétiques – Admin'; $controller = 'back_depense'; ?>
<?php require __DIR__ . '/../../layouts/back_header.php'; ?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"><h1 class="m-0">Dépenses Énergétiques</h1></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= BASE_PATH ?>/index.php?controller=dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active">Dépenses</li>
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

        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-fire mr-2 text-danger"></i>Liste des dépenses énergétiques</h3>
                <div class="card-tools">
                    <a href="<?= BASE_PATH ?>/index.php?controller=back_depense&action=create" class="btn btn-success btn-sm">
                        <i class="fas fa-plus"></i> Ajouter une dépense
                    </a>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Entraînement</th>
                            <th>Type Sport</th>
                            <th>Date Séance</th>
                            <th>Calories</th>
                            <th>FC Moy.</th>
                            <th>Intensité</th>
                            <th>Remarques</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($depenses)): ?>
                        <tr><td colspan="9" class="text-center text-muted py-4">Aucune dépense enregistrée.</td></tr>
                        <?php else: ?>
                        <?php foreach ($depenses as $d): ?>
                        <tr>
                            <td><?= $d['id'] ?></td>
                            <td>
                                <a href="<?= BASE_PATH ?>/index.php?controller=back_entrainement&action=show&id=<?= $d['entrainement_id'] ?>">
                                    <?= htmlspecialchars($d['entrainement_nom']) ?>
                                </a>
                            </td>
                            <td><?= htmlspecialchars($d['type_sport']) ?></td>
                            <td><?= date('d/m/Y', strtotime($d['date_entrainement'])) ?></td>
                            <td><strong class="text-danger"><?= number_format($d['calories_brulees'], 1) ?></strong> kcal</td>
                            <td><?= $d['frequence_cardiaque_moy'] ?? '—' ?> bpm</td>
                            <td>
                                <span class="badge badge-<?= $d['intensite'] ?>">
                                    <?= ucfirst($d['intensite']) ?>
                                </span>
                            </td>
                            <td style="max-width:150px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
                                <?= htmlspecialchars($d['remarques'] ?? '—') ?>
                            </td>
                            <td class="text-nowrap">
                                <a href="<?= BASE_PATH ?>/index.php?controller=back_depense&action=edit&id=<?= $d['id'] ?>"
                                   class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                <a href="<?= BASE_PATH ?>/index.php?controller=back_depense&action=delete&id=<?= $d['id'] ?>"
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Supprimer cette dépense ?')">
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
