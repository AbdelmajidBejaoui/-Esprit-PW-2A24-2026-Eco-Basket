<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$title = "Dashboard - Stabilis™";

require_once __DIR__ . '/Views/partials/header.php';
require_once __DIR__ . '/controllers/ProduitController.php';

$controller = new ProduitController();
$produits = $controller->getAll();
$totalProduits = count($produits);
$totalStock = array_sum(array_column($produits, 'stock'));
?>

<!-- Stats Row -->
<div class="stats-row">
    <div class="stat-card hover-lift">
        <div class="stat-label">Produits</div>
        <div class="stat-value"><?php echo $totalProduits; ?></div>
        <div class="text-muted" style="font-size: 12px; margin-top: 8px;">en catalogue</div>
    </div>
    <div class="stat-card hover-lift">
        <div class="stat-label">Stock total</div>
        <div class="stat-value"><?php echo $totalStock; ?></div>
        <div class="text-muted" style="font-size: 12px; margin-top: 8px;">unités disponibles</div>
    </div>
    <div class="stat-card hover-lift">
        <div class="stat-label">Impact</div>
        <div class="stat-value">-42%</div>
        <div class="text-muted" style="font-size: 12px; margin-top: 8px;">empreinte carbone</div>
    </div>
</div>

<!-- Eco Widget -->
<div class="eco-widget">
    <div>
        <i class="fas fa-leaf" style="color: var(--accent-herb); font-size: 24px;"></i>
    </div>
    <div style="flex: 1;">
        <strong style="color: var(--accent-earth-dark);">Engagement durable</strong>
        <p style="margin: 0; font-size: 13px;">Chaque produit compense deux fois son empreinte carbone.</p>
    </div>
    <div>
        <span class="badge-aliment badge">+250kg CO₂ économisés</span>
    </div>
</div>

<!-- Tableau des produits -->
<div class="table-card">
    <div class="table-header">
        <h3><i class="fas fa-bolt"></i> Produits récents</h3>
        <div class="record-count">
            <i class="fas fa-box"></i> <?php echo $totalProduits; ?> références
        </div>
    </div>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Catégorie</th>
                    <th>Stock</th>
                    <th>Prix</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($produits)): ?>
                <tr>
                    <td colspan="5" class="text-center">Aucun produit pour le moment</td>
                </tr>
                <?php else: ?>
                <?php foreach(array_slice($produits, 0, 5) as $p): ?>
                <tr>
                    <td>
                        <strong><?php echo htmlspecialchars($p['nom']); ?></strong><br>
                        <small class="text-muted"><?php echo htmlspecialchars($p['description'] ?? 'Aucune description'); ?></small>
                    </td>
                    <td><?php echo htmlspecialchars($p['categorie']); ?></td>
                    <td><?php echo $p['stock']; ?> unités</td>
                    <td><strong><?php echo number_format($p['prix'], 2); ?> €</strong></td>
                    <td>
                        <a href="Views/back/produits/modifier.php?id=<?php echo $p['id']; ?>" class="btn-icon">
                            <i class="fas fa-edit"></i> <span>Modifier</span>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="table-header" style="border-top: 1px solid var(--border-light);">
        <a href="Views/back/produits/liste.php" class="btn-secondary">
            <i class="fas fa-arrow-right"></i> Voir tous les produits
        </a>
        <a href="Views/back/produits/ajout.php" class="btn-primary">
            <i class="fas fa-plus"></i> Ajouter un produit
        </a>
    </div>
</div>

<!-- Inspiration Widget -->
<div class="inspo-widget">
    <i class="fas fa-quote-left" style="color: var(--accent-herb); font-size: 20px;"></i>
    <div>
        <em>"La performance durable commence par ce que vous mettez dans votre assiette — et dans votre code."</em>
        <div class="text-muted" style="font-size: 12px; margin-top: 5px;">— Stabilis Lab</div>
    </div>
</div>

<?php require_once __DIR__ . '/views/partials/footer.php'; ?>