<?php
$title = "Produits - Stabilis™";
require_once __DIR__ . '/../../partials/header.php';
require_once __DIR__ . '/../../../controllers/ProduitController.php';

$search = trim($_GET['search'] ?? '');
$controller = new ProduitController();
$produits = $controller->getAll($search);
?>

<div class="table-card">
    <div class="table-header">
        <div>
            <h3>Catalogue complet</h3>
            <?php if($search): ?>
                <div class="text-muted" style="margin-top: 8px;">Résultats pour "<?php echo htmlspecialchars($search); ?>"</div>
            <?php endif; ?>
        </div>
        <form method="GET" class="search-bar">
            <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Rechercher par nom ou catégorie" class="form-control">
            <button type="submit" class="btn-secondary">Rechercher</button>
        </form>
        <div class="record-count">
            <?php echo count($produits); ?> produit<?php echo count($produits) > 1 ? 's' : ''; ?>
        </div>
    </div>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Nom</th>
                    <th>Catégorie</th>
                    <th>Stock</th>
                    <th>Prix</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($produits)): ?>
                <tr>
                    <td colspan="7" class="text-center">Aucun produit trouvé</td>
                </tr>
                <?php else: ?>
                    <?php foreach($produits as $p): ?>
                    <tr>
                        <td>#<?php echo $p['id']; ?></td>
                        <td>
                            <img src="/AdminLTE3/dist/img/<?php echo $p['image_url'] ?? 'default-product.png'; ?>" 
                                 class="product-img" onerror="this.src='/AdminLTE3/dist/img/default-product.png'">
                        </td>
                        <td><strong><?php echo htmlspecialchars($p['nom']); ?></strong></td>
                        <td><?php echo htmlspecialchars($p['categorie']); ?></td>
                        <td>
                            <span class="badge <?php echo $p['stock'] > 0 ? 'badge-aliment' : 'badge-compensation'; ?>">
                                <?php echo $p['stock']; ?> unités
                            </span>
                        </td>
                        <td><strong><?php echo number_format($p['prix'], 2); ?> €</strong></td>
                        <td>
                            <a href="modifier.php?id=<?php echo $p['id']; ?>" class="btn-icon">
                                <i class="fas fa-edit"></i> <span>Modifier</span>
                            </a>
                            <a href="javascript:void(0)" onclick="supprimer(<?php echo $p['id']; ?>, this)" class="btn-icon btn-icon-danger">
                                <i class="fas fa-trash"></i> <span>Supprimer</span>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="table-header" style="border-top: 1px solid var(--border-light);">
        <a href="ajout.php" class="btn-primary">
            <i class="fas fa-plus"></i> Ajouter un produit
        </a>
    </div>
</div>

<script>
function supprimer(id, element) {
    if(confirm('Souhaitez-vous vraiment supprimer ce produit ?')) {
        const row = element.closest('tr');
        row.classList.add('table-row-delete');
        setTimeout(() => window.location.href = 'supprimer.php?id=' + id, 300);
    }
}
</script>

<?php require_once __DIR__ . '/../../partials/footer.php'; ?>