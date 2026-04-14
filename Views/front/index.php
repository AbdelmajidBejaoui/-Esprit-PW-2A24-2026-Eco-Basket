<?php
session_start();
require_once __DIR__ . '/../../controllers/ProduitController.php';

$controller = new ProduitController();
$produits = $controller->getAll();
$featured = array_slice($produits, 0, 4);
$cartCount = array_sum($_SESSION['cart'] ?? []);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Stabilis™ - Boutique Sport Nutrition</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/stabilis.css?v=1">

    <style>
        .hero-section {
            background: linear-gradient(135deg, var(--accent-herb) 0%, var(--accent-herb-dark) 100%);
            color: white;
            padding: 80px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: float 6s ease-in-out infinite;
        }

        .hero-section h1 {
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 16px;
            position: relative;
            z-index: 2;
        }

        .hero-section p {
            font-size: 20px;
            opacity: 0.9;
            margin-bottom: 32px;
            position: relative;
            z-index: 2;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 24px;
            margin-top: 40px;
        }

        .product-card {
            background: var(--bg-elevated);
            border: 1px solid var(--border-light);
            border-radius: var(--radius-lg);
            overflow: hidden;
            transition: all var(--transition-normal);
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
        }

        .product-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--accent-herb);
            transform: scaleX(0);
            transition: transform var(--transition-normal);
        }

        .product-card:hover::before {
            transform: scaleX(1);
        }

        .product-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            background: var(--bg-surface);
        }

        .product-content {
            padding: 20px;
        }

        .product-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text-primary);
        }

        .product-category {
            font-size: 12px;
            color: var(--accent-herb);
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 12px;
        }

        .product-price {
            font-size: 20px;
            font-weight: 700;
            color: var(--accent-herb);
            margin-bottom: 16px;
        }

        .product-actions {
            display: flex;
            gap: 8px;
        }

        .btn-cart {
            background: var(--accent-herb);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: var(--radius-full);
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all var(--transition-normal);
            flex: 1;
            justify-content: center;
        }

        .btn-cart:hover {
            background: var(--accent-herb-dark);
            transform: translateY(-1px);
        }

        .btn-view {
            background: transparent;
            border: 1px solid var(--border-light);
            padding: 8px 16px;
            border-radius: var(--radius-full);
            color: var(--text-secondary);
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all var(--transition-fast);
            flex: 1;
            justify-content: center;
        }

        .btn-view:hover {
            background: var(--accent-herb-light);
            border-color: var(--accent-herb-soft);
            color: var(--accent-herb);
        }

        .top-bar {
            background: var(--sidebar-green);
            color: var(--sidebar-text);
            padding: 12px 0;
            font-size: 14px;
        }

        .top-bar .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .top-bar-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .top-bar-item i {
            opacity: 0.8;
        }

        .navbar {
            background: var(--bg-elevated);
            border-bottom: 1px solid var(--border-light);
            padding: 16px 0;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .navbar .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-brand {
            font-size: 24px;
            font-weight: 700;
            color: var(--accent-herb);
            text-decoration: none;
        }

        .navbar-brand sup {
            font-size: 10px;
            font-weight: 400;
            color: var(--accent-herb-soft);
        }

        .navbar-nav {
            display: flex;
            list-style: none;
            gap: 24px;
            margin: 0;
            padding: 0;
        }

        .navbar-nav a {
            color: var(--text-primary);
            text-decoration: none;
            font-weight: 500;
            transition: color var(--transition-fast);
        }

        .navbar-nav a:hover {
            color: var(--accent-herb);
        }

        .admin-link {
            background: var(--accent-herb);
            color: white !important;
            padding: 6px 12px;
            border-radius: var(--radius-full);
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all var(--transition-fast);
        }

        .admin-link:hover {
            background: var(--accent-herb-dark);
            color: white !important;
            transform: translateY(-1px);
        }

        .cart-badge {
            position: relative;
            margin-left: 4px;
        }

        .cart-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background: var(--accent-herb);
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .bubble {
            position: absolute;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
            animation: float 8s ease-in-out infinite;
        }

        .bubble:nth-child(1) {
            width: 60px;
            height: 60px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .bubble:nth-child(2) {
            width: 40px;
            height: 40px;
            top: 60%;
            right: 15%;
            animation-delay: 2s;
        }

        .bubble:nth-child(3) {
            width: 80px;
            height: 80px;
            bottom: 20%;
            left: 20%;
            animation-delay: 4s;
        }
    </style>
</head>
<body>
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
                <li><a href="shop.php">Boutique</a></li>
                <li><a href="cart.php">
                    <i class="fas fa-shopping-cart"></i>
                    <?php if($cartCount > 0): ?>
                        <span class="cart-badge">
                            <span class="cart-count"><?php echo $cartCount; ?></span>
                        </span>
                    <?php endif; ?>
                </a></li>
                <li><a href="../back/produits/liste.php" class="admin-link">
                    <i class="fas fa-cog"></i>
                    Administration
                </a></li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="container">
            <h1>Nutrition Adaptative</h1>
            <p>Performance durable · Solutions intelligentes</p>
            <a href="shop.php" class="btn-primary" style="display: inline-flex; padding: 14px 32px; font-size: 16px;">
                <i class="fas fa-shopping-bag"></i>
                Découvrir nos produits
            </a>
        </div>
    </section>

    <!-- Featured Products -->
    <div class="container" style="padding: 60px 0;">
        <div style="text-align: center; margin-bottom: 40px;">
            <h2 style="font-size: 32px; font-weight: 700; color: var(--text-primary); margin-bottom: 8px;">Produits Phares</h2>
            <p style="color: var(--text-secondary); font-size: 16px;">Notre sélection de compléments nutritionnels premium</p>
        </div>

        <div class="product-grid">
            <?php foreach($featured as $produit): ?>
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

        <div style="text-align: center; margin-top: 40px;">
            <a href="shop.php" class="btn-primary" style="padding: 14px 32px; font-size: 16px;">
                <i class="fas fa-th-large"></i>
                Voir tous les produits
            </a>
        </div>
    </div>

    <!-- Footer -->
    <footer style="background: var(--sidebar-green); color: var(--sidebar-text); padding: 40px 0; margin-top: 60px;">
        <div class="container">
            <div style="text-align: center;">
                <h3 style="color: white; margin-bottom: 8px;">Stabilis<sup>™</sup></h3>
                <p style="opacity: 0.8; margin-bottom: 16px;">Nutrition adaptative · Performance durable</p>
                <div style="opacity: 0.6;">
                    <i class="fas fa-seedling"></i> low carbon · high performance
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
    </section>
    <footer class="ftco-footer ftco-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <p>&copy; <?php echo date('Y'); ?> Stabilis. Tous droits réservés.</p>
          </div>
        </div>
      </div>
    </footer>
    <script src="../../FrontOfficeFreeSource/js/jquery.min.js"></script>
    <script src="../../FrontOfficeFreeSource/js/jquery-migrate-3.0.1.min.js"></script>
    <script src="../../FrontOfficeFreeSource/js/popper.min.js"></script>
    <script src="../../FrontOfficeFreeSource/js/bootstrap.min.js"></script>
    <script src="../../FrontOfficeFreeSource/js/jquery.easing.1.3.js"></script>
    <script src="../../FrontOfficeFreeSource/js/jquery.waypoints.min.js"></script>
    <script src="../../FrontOfficeFreeSource/js/jquery.stellar.min.js"></script>
    <script src="../../FrontOfficeFreeSource/js/owl.carousel.min.js"></script>
    <script src="../../FrontOfficeFreeSource/js/jquery.magnific-popup.min.js"></script>
    <script src="../../FrontOfficeFreeSource/js/aos.js"></script>
    <script src="../../FrontOfficeFreeSource/js/jquery.animateNumber.min.js"></script>
    <script src="../../FrontOfficeFreeSource/js/bootstrap-datepicker.js"></script>
    <script src="../../FrontOfficeFreeSource/js/scrollax.min.js"></script>
    <script src="../../FrontOfficeFreeSource/js/main.js"></script>
  </body>
</html>