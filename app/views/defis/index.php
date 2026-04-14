<?php
$title = 'Stabilis™ — Défis nutritionnels';
require __DIR__ . '/../layout/header.php';
?>

        <div class="page-header">
            <div class="header-left">
                <h1>Défis nutritionnels</h1>
                <p>Suivi des objectifs · performance & durabilité</p>
            </div>
            <a href="index.php?action=create" class="btn-new">
                <i class="fas fa-plus"></i> Créer un défi
            </a>
        </div>

        <div class="stats-row">
            <div class="stat-card">
                <div class="stat-label">Défis actifs</div>
                <div class="stat-value"><?= $count ?></div>
                <div class="stat-sub">objectifs en cours</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Catégories</div>
                <div class="stat-value">3</div>
                <div class="stat-sub">aliment · entraînement · compensation</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Impact estimé</div>
                <div class="stat-value"><?= number_format($co2_evite, 1) ?> kg</div>
                <div class="stat-sub">CO₂ évité (cumulé)</div>
            </div>
        </div>

        <div class="eco-widget">
            <div class="left">
                <i class="fas fa-globe-europe"></i>
                <div class="text">
                    <strong>Éco-score</strong><br>
                    engagement bas-carbone
                </div>
            </div>
            <div class="right">
                <i class="fas fa-leaf"></i> <?= $count * 5 ?> points durabilité cumulés
            </div>
        </div>

        <div class="table-card">
            <div class="table-header">
                <h3><i class="fas fa-list-ul"></i> Tous les défis</h3>
                <span class="record-count"><?= $count ?> enregistrement<?= $count !== 1 ? 's' : '' ?></span>
            </div>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Identifiant</th>
                            <th>Nom</th>
                            <th>Type</th>
                            <th>Objectif</th>
                            <th>Récompense</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($count > 0): ?>
                            <?php foreach ($defis as $defi): ?>
                                <?php
                                    $badgeClass = match ($defi['type']) {
                                        'aliment' => 'badge-aliment',
                                        'entrainement' => 'badge-entrainement',
                                        'compensation' => 'badge-compensation',
                                        default => 'badge-aliment',
                                    };
                                ?>
                                <tr>
                                    <td class="defi-id">#<?= str_pad($defi['id'], 3, '0', STR_PAD_LEFT) ?></td>
                                    <td class="defi-nom"><?= htmlspecialchars($defi['nom']) ?></td>
                                    <td><span class="badge <?= $badgeClass ?>"><?= htmlspecialchars($defi['type']) ?></span></td>
                                    <td><?= htmlspecialchars($defi['objectif']) ?></td>
                                    <td class="recompense"><?= htmlspecialchars($defi['recompense']) ?></td>
                                    <td class="actions">
                                        <a href="index.php?action=edit&id=<?= $defi['id'] ?>" class="btn-icon">
                                            <i class="fas fa-edit"></i> <span>Modifier</span>
                                        </a>
                                        <a href="index.php?action=delete&id=<?= $defi['id'] ?>" class="btn-icon btn-icon-danger" onclick="return confirm('Confirmer la suppression — cette action est définitive.')">
                                            <i class="fas fa-trash-alt"></i> <span>Supprimer</span>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6">
                                    <div class="empty-state">
                                        <i class="fas fa-leaf"></i>
                                        <p>Aucun défi enregistré</p>
                                        <a href="index.php?action=create">Créer un premier défi</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="quote">
            <p>« Manger mieux, bouger plus, polluer moins — un défi à la fois. »</p>
            <div class="author">Stabilis — programme durable</div>
        </div>

<?php require __DIR__ . '/../layout/footer.php';
