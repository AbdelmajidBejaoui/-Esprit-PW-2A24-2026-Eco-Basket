<?php
session_start();
require_once __DIR__ . '/../../controllers/ProduitController.php';

$id = $_GET['id'] ?? null;
$controller = new ProduitController();
$product = $id ? $controller->getById($id) : null;
if(!$product) {
    header('Location: shop.php');
    exit();
}
$cartCount = array_sum($_SESSION['cart'] ?? []);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo htmlspecialchars($product['nom']); ?> - Stabilis™</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/stabilis.css?v=1">

    <style>
        .product-detail {
            padding: 60px 0;
        }

        .product-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: start;
        }

        .product-image-container {
            position: relative;
        }

        .product-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-lg);
        }

        .product-info h1 {
            font-size: 32px;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 8px;
        }

        .product-category {
            font-size: 14px;
            color: var(--accent-herb);
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 20px;
        }

        .product-price {
            font-size: 28px;
            font-weight: 700;
            color: var(--accent-herb);
            margin-bottom: 24px;
        }

        .product-description {
            color: var(--text-secondary);
            line-height: 1.6;
            margin-bottom: 32px;
            font-size: 16px;
        }

        .product-meta {
            background: var(--bg-surface);
            padding: 20px;
            border-radius: var(--radius-lg);
            margin-bottom: 32px;
        }

        .meta-item {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid var(--border-light);
        }

        .meta-item:last-child {
            border-bottom: none;
        }

        .meta-label {
            font-weight: 500;
            color: var(--text-primary);
        }

        .meta-value {
            color: var(--text-secondary);
        }

        .quantity-selector {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 24px;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            border: 1px solid var(--border-light);
            border-radius: var(--radius-md);
            overflow: hidden;
        }

        .quantity-btn {
            background: var(--bg-surface);
            border: none;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-secondary);
            cursor: pointer;
            transition: all var(--transition-fast);
        }

        .quantity-btn:hover {
            background: var(--accent-herb-light);
            color: var(--accent-herb);
        }

        .quantity-input {
            width: 60px;
            height: 40px;
            border: none;
            text-align: center;
            font-size: 16px;
            font-weight: 500;
            color: var(--text-primary);
        }

        .action-buttons {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .btn-add-cart {
            background: var(--accent-herb);
            color: white;
            border: none;
            padding: 14px 32px;
            border-radius: var(--radius-full);
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all var(--transition-normal);
            flex: 1;
            justify-content: center;
        }

        .btn-add-cart:hover {
            background: var(--accent-herb-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .btn-back {
            background: transparent;
            border: 1px solid var(--border-light);
            padding: 14px 32px;
            border-radius: var(--radius-full);
            color: var(--text-secondary);
            font-size: 16px;
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all var(--transition-fast);
            justify-content: center;
        }

        .btn-back:hover {
            background: var(--accent-herb-light);
            border-color: var(--accent-herb-soft);
            color: var(--accent-herb);
        }

        .stock-indicator {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: var(--radius-full);
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 16px;
        }

        .stock-indicator.in-stock {
            background: var(--accent-herb-light);
            color: var(--accent-herb);
        }

        .stock-indicator.out-of-stock {
            background: #FEE;
            color: #C55A4A;
        }

        @media (max-width: 768px) {
            .product-container {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .product-image {
                height: 300px;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn-add-cart, .btn-back {
                flex: none;
            }
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
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
            </ul>
        </div>
    </nav>

    <!-- Breadcrumb -->
    <div style="background: var(--bg-surface); padding: 16px 0; border-bottom: 1px solid var(--border-light);">
        <div class="container">
            <div style="font-size: 14px; color: var(--text-muted);">
                <a href="index.php" style="color: var(--text-muted); text-decoration: none;">Accueil</a>
                <span style="margin: 0 8px;">></span>
                <a href="shop.php" style="color: var(--text-muted); text-decoration: none;">Boutique</a>
                <span style="margin: 0 8px;">></span>
                <span style="color: var(--text-primary);"><?php echo htmlspecialchars($product['nom']); ?></span>
            </div>
        </div>
    </div>

    <!-- Product Detail -->
    <section class="product-detail">
        <div class="container">
            <div class="product-container">
                <div class="product-image-container">
                    <img src="/AdminLTE3/dist/img/<?php echo $product['image_url'] ?? 'default-product.png'; ?>"
                         alt="<?php echo htmlspecialchars($product['nom']); ?>"
                         class="product-image"
                         onerror="this.src='/AdminLTE3/dist/img/default-product.png'">
                </div>

                <div class="product-info">
                    <div class="product-category"><?php echo htmlspecialchars($product['categorie']); ?></div>
                    <h1><?php echo htmlspecialchars($product['nom']); ?></h1>

                    <div class="stock-indicator <?php echo $product['stock'] > 0 ? 'in-stock' : 'out-of-stock'; ?>">
                        <i class="fas fa-<?php echo $product['stock'] > 0 ? 'check-circle' : 'times-circle'; ?>"></i>
                        <?php echo $product['stock'] > 0 ? 'En stock (' . $product['stock'] . ' unités)' : 'Rupture de stock'; ?>
                    </div>

                    <div class="product-price"><?php echo number_format($product['prix'], 2); ?> €</div>

                    <div class="product-description">
                        Découvrez notre complément nutritionnel premium pour optimiser vos performances sportives.
                        Formulé avec des ingrédients naturels de haute qualité pour un soutien durable.
                    </div>

                    <div class="product-meta">
                        <div class="meta-item">
                            <span class="meta-label">Catégorie</span>
                            <span class="meta-value"><?php echo htmlspecialchars($product['categorie']); ?></span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-label">Stock disponible</span>
                            <span class="meta-value"><?php echo $product['stock']; ?> unités</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-label">Livraison</span>
                            <span class="meta-value">Sous 3-5 jours</span>
                        </div>
                    </div>

                    <?php if($product['stock'] > 0): ?>
                    <form method="POST" action="cart.php" style="margin-bottom: 24px;">
                        <input type="hidden" name="action" value="add">
                        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                        <div class="quantity-selector">
                            <span style="font-weight: 500; color: var(--text-primary);">Quantité:</span>
                            <div class="quantity-controls">
                                <button type="button" class="quantity-btn" onclick="changeQuantity(-1)">-</button>
                                <input type="number" name="quantity" value="1" min="1" max="<?php echo $product['stock']; ?>" class="quantity-input" id="quantity">
                                <button type="button" class="quantity-btn" onclick="changeQuantity(1)">+</button>
                            </div>
                        </div>
                        <div class="action-buttons">
                            <button type="submit" class="btn-add-cart">
                                <i class="fas fa-cart-plus"></i>
                                Ajouter au panier
                            </button>
                        </div>
                    </form>
                    <?php endif; ?>

                    <div class="action-buttons">
                        <a href="shop.php" class="btn-back">
                            <i class="fas fa-arrow-left"></i>
                            Retour à la boutique
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

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

    <script>
    function changeQuantity(delta) {
        const input = document.getElementById('quantity');
        const currentValue = parseInt(input.value);
        const newValue = currentValue + delta;
        const max = parseInt(input.max);

        if (newValue >= 1 && newValue <= max) {
            input.value = newValue;
        }
    }
</body>
</html>
        <a class="navbar-brand" href="index.php">Stabilis</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="oi oi-menu"></span> Menu
        </button>
        <div class="collapse navbar-collapse" id="ftco-nav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a href="index.php" class="nav-link">Accueil</a></li>
            <li class="nav-item"><a href="shop.php" class="nav-link">Boutique</a></li>
            <li class="nav-item"><a href="cart.php" class="nav-link">Panier<?php echo $cartCount ? ' (' . $cartCount . ')' : ''; ?></a></li>
            <li class="nav-item cta cta-colored"><a href="../../Views/back/produits/liste.php" class="nav-link">Back Office</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="hero-wrap hero-bread" style="background-image: url('../../FrontOfficeFreeSource/images/bg_1.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Accueil</a></span> <span class="mr-2"><a href="shop.php">Boutique</a></span> <span><?php echo htmlspecialchars($product['nom']); ?></span></p>
            <h1 class="mb-0 bread"><?php echo htmlspecialchars($product['nom']); ?></h1>
          </div>
        </div>
      </div>
    </div>
    <section class="ftco-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 mb-5 ftco-animate">
            <a href="../../dist/img/<?php echo htmlspecialchars($product['image_url'] ?: 'default-product.png'); ?>" class="image-popup"><img src="../../dist/img/<?php echo htmlspecialchars($product['image_url'] ?: 'default-product.png'); ?>" class="img-fluid" alt="<?php echo htmlspecialchars($product['nom']); ?>"></a>
          </div>
          <div class="col-lg-6 product-details pl-md-5 ftco-animate">
            <h3><?php echo htmlspecialchars($product['nom']); ?></h3>
            <p class="price"><span><?php echo number_format($product['prix'], 2); ?> €</span></p>
            <p><?php echo nl2br(htmlspecialchars($product['description'] ?: 'Aucune description disponible.')); ?></p>
            <div class="row mt-4">
              <div class="col-md-6">
                <p><strong>Catégorie :</strong> <?php echo htmlspecialchars($product['categorie']); ?></p>
              </div>
              <div class="col-md-6">
                <p><strong>Stock :</strong> <?php echo intval($product['stock']); ?> unités</p>
              </div>
            </div>
            <form method="POST" action="cart.php" class="mb-3">
              <input type="hidden" name="action" value="add">
              <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['id']); ?>">
              <div class="form-row align-items-center">
                <div class="col-auto mb-2">
                  <input type="number" name="quantity" value="1" min="1" class="form-control" style="width: 100px;">
                </div>
                <div class="col-auto mb-2">
                  <button type="submit" class="btn btn-primary py-3 px-5">Ajouter au panier</button>
                </div>
              </div>
            </form>
            <p><a href="shop.php" class="btn btn-secondary py-3 px-5">Retour à la boutique</a></p>
          </div>
        </div>
      </div>
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