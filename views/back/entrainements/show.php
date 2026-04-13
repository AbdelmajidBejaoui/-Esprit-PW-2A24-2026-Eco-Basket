<?php $pageTitle = 'Détail Entraînement – Admin'; $controller = 'back_entrainement'; ?>
<?php require __DIR__ . '/../../layouts/back_header.php'; ?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"><h1 class="m-0"><?= htmlspecialchars($entrainement['nom']) ?></h1></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= BASE_PATH ?>/index.php?controller=dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?= BASE_PATH ?>/index.php?controller=back_entrainement&action=index">Entraînements</a></li>
                    <li class="breadcrumb-item active">Détail</li>
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

        <div class="row">
            <!-- Infos entraînement -->
            <div class="col-md-4">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-running mr-2"></i>Informations</h3>
                        <div class="card-tools">
                            <a href="<?= BASE_PATH ?>/index.php?controller=back_entrainement&action=edit&id=<?= $entrainement['id'] ?>"
                               class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless table-sm">
                            <tr><th>Nom</th><td><?= htmlspecialchars($entrainement['nom']) ?></td></tr>
                            <tr><th>Type</th><td><?= htmlspecialchars($entrainement['type_sport']) ?></td></tr>
                            <tr><th>Durée</th><td><?= $entrainement['duree'] ?> minutes</td></tr>
                            <tr><th>Niveau</th>
                                <td><span class="badge badge-<?= $entrainement['niveau'] ?>"><?= ucfirst($entrainement['niveau']) ?></span></td>
                            </tr>
                            <tr><th>Date</th><td><?= date('d/m/Y', strtotime($entrainement['date_entrainement'])) ?></td></tr>
                        </table>
                        <?php if ($entrainement['description']): ?>
                        <hr>
                        <p class="text-muted"><?= nl2br(htmlspecialchars($entrainement['description'])) ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="card-footer">
                        <a href="<?= BASE_PATH ?>/index.php?controller=back_depense&action=create&entrainement_id=<?= $entrainement['id'] ?>"
                           class="btn btn-success btn-block">
                            <i class="fas fa-fire mr-1"></i> Ajouter une dépense
                        </a>
                    </div>
                </div>
            </div>

            <!-- Dépenses -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-fire mr-2 text-danger"></i>Dépenses Énergétiques (<?= count($depenses) ?>)</h3>
                    </div>
                    <?php if (empty($depenses)): ?>
                    <div class="card-body text-center text-muted py-4">
                        <i class="fas fa-fire fa-3x mb-3 text-muted"></i>
                        <p>Aucune dépense énergétique enregistrée.</p>
                        <a href="<?= BASE_PATH ?>/index.php?controller=back_depense&action=create&entrainement_id=<?= $entrainement['id'] ?>"
                           class="btn btn-success">Ajouter la première dépense</a>
                    </div>
                    <?php else: ?>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>Calories</th>
                                    <th>FC Moy. (bpm)</th>
                                    <th>Intensité</th>
                                    <th>Remarques</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($depenses as $d): ?>
                                <tr>
                                    <td><strong class="text-danger"><?= number_format($d['calories_brulees'], 1) ?></strong> kcal</td>
                                    <td><?= $d['frequence_cardiaque_moy'] ?? '—' ?></td>
                                    <td><span class="badge badge-<?= $d['intensite'] ?>"><?= ucfirst($d['intensite']) ?></span></td>
                                    <td class="text-muted" style="max-width:150px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
                                        <?= htmlspecialchars($d['remarques'] ?? '—') ?>
                                    </td>
                                    <td><?= date('d/m/Y', strtotime($d['created_at'])) ?></td>
                                    <td>
                                        <a href="<?= BASE_PATH ?>/index.php?controller=back_depense&action=edit&id=<?= $d['id'] ?>"
                                           class="btn btn-xs btn-warning"><i class="fas fa-edit"></i></a>
                                        <a href="<?= BASE_PATH ?>/index.php?controller=back_depense&action=delete&id=<?= $d['id'] ?>"
                                           class="btn btn-xs btn-danger"
                                           onclick="return confirm('Supprimer cette dépense ?')">
                                           <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <a href="<?= BASE_PATH ?>/index.php?controller=back_entrainement&action=index" class="btn btn-default">
            <i class="fas fa-arrow-left mr-1"></i> Retour à la liste
        </a>
    </div>
</section>

<?php require __DIR__ . '/../../layouts/back_footer.php'; ?>
