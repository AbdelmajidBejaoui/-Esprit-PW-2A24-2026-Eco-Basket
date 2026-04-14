<?php
session_start();
require_once __DIR__ . '/../../controllers/ProduitController.php';

$search = trim($_GET['search'] ?? '');
$category = trim($_GET['category'] ?? '');
$controller = new ProduitController();
$produits = $controller->getAll($search, $category);
$categories = $controller->getCategories();
$cartCount = array_sum($_SESSION['cart'] ?? []);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Boutique - Stabilis™</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/stabilis.css?v=1">
    <link rel="stylesheet" href="../../assets/css/front-style.css?v=1">
</head>
<body class="page-shop">
    <!-- Top Bar -->
    <div class="top-bar">
        <div class="container">
            <div class="top-bar-item">
                <i class="fas fa-envelope"></i>
                <span>contact@stabilis.example</span>
            </div>
            <div class="top-bar-item">
                <i class="fas fa-truck"></i>
                <span>Livraison sous 3-5 jours</span>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="navbar">
        <div class="container">
            <a href="index.php" class="navbar-brand">Stabilis<sup>™</sup></a>
            <ul class="navbar-nav">
                <li><a href="index.php">Accueil</a></li>
                <li><a href="shop.php" class="active-nav">Boutique</a></li>
                <li><a href="cart.php">
                    <i class="fas fa-shopping-cart"></i>
                    <?php if($cartCount > 0): ?>
                        <span class="cart-badge">
                            <span class="cart-count"><?php echo $cartCount; ?></span>
                        </span>
                    <?php endif; ?>
                </a></li>
                <li><a href="../../Views/back/produits/liste.php" class="admin-link">
                    <i class="fas fa-cog"></i>
                    Administration
                </a></li>
            </ul>
        </div>
    </nav>

    <!-- Shop Header -->
    <section class="shop-header">
        <div class="container">
            <h1 class="shop-title">Notre Boutique</h1>
            <p class="shop-subtitle">Découvrez notre gamme complète de compléments nutritionnels</p>
        </div>
    </section>

    <!-- Filters -->
    <section class="filters-section">
        <div class="container">
            <form method="GET" class="filters-container">
                <div class="filter-group">
                    <label class="filter-label">Rechercher:</label>
                    <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Nom du produit..." class="search-input">
                </div>
                <div class="filter-group">
                    <label class="filter-label">Catégorie:</label>
                    <select name="category" class="filter-select">
                        <option value="">Toutes les catégories</option>
                        <?php foreach($categories as $cat): ?>
                            <option value="<?php echo htmlspecialchars($cat); ?>" <?php echo $category === $cat ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($cat); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn-filter">
                    <i class="fas fa-search"></i>
                    Filtrer
                </button>
                <?php if($search || $category): ?>
                    <a href="shop.php" class="btn-secondary no-underline">
                        <i class="fas fa-times"></i>
                        Effacer
                    </a>
                <?php endif; ?>
            </form>
        </div>
    </section>

    <!-- Products -->
        <div class="container shop-content">
        <?php if($search || $category): ?>
        <div class="results-info">
            <div class="results-text">
                <?php echo count($produits); ?> produit<?php echo count($produits) > 1 ? 's' : ''; ?> trouvé<?php echo count($produits) > 1 ? 's' : ''; ?>
                <?php if($search): ?><strong>"<?php echo htmlspecialchars($search); ?>"</strong><?php endif; ?>
                <?php if($category): ?>dans <strong><?php echo htmlspecialchars($category); ?></strong><?php endif; ?>
            </div>
            <select class="sort-select">
                <option>Trier par: Pertinence</option>
                <option>Prix croissant</option>
                <option>Prix décroissant</option>
                <option>Nom A-Z</option>
            </select>
        </div>
        <?php endif; ?>

        <?php if(empty($produits)): ?>
        <div class="empty-state">
            <i class="fas fa-search"></i>
            <h3>Aucun produit trouvé</h3>
            <p>Essayez de modifier vos critères de recherche</p>
            <a href="shop.php" class="btn-primary">
                <i class="fas fa-th-large"></i>
                Voir tous les produits
            </a>
        </div>
        <?php else: ?>
        <div class="product-grid">
            <?php foreach($produits as $produit): ?>
            <div class="product-card">
                <img src="/AdminLTE3/dist/img/<?php echo $produit['image_url'] ?? 'default-product.png'; ?>"
                     alt="<?php echo htmlspecialchars($produit['nom']); ?>"
                     class="product-image"
                     onerror="this.src='/AdminLTE3/dist/img/default-product.png'">
                <div class="product-content">
                    <div class="product-category"><?php echo htmlspecialchars($produit['categorie']); ?></div>
                    <h3 class="product-title"><?php echo htmlspecialchars($produit['nom']); ?></h3>
                    <div class="product-price"><?php echo number_format($produit['prix'], 2); ?> €</div>
                    <div class="product-actions">
                        <a href="product.php?id=<?php echo $produit['id']; ?>" class="btn-view">
                            <i class="fas fa-eye"></i>
                            Voir
                        </a>
                        <a href="cart.php?action=add&id=<?php echo $produit['id']; ?>" class="btn-cart">
                            <i class="fas fa-cart-plus"></i>
                            Ajouter
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <footer class="shop-footer">
        <div class="container">
            <div class="footer-content">
                <h3>Stabilis<sup>™</sup></h3>
                <p>Nutrition adaptative · Performance durable</p>
                <div class="footer-note">
                    <i class="fas fa-seedling"></i> low carbon · high performance
                </div>
            </div>
        </div>
    </footer>
</body>
</html>