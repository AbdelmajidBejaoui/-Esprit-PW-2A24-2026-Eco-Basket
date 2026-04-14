<?php
session_start();
require_once __DIR__ . '/../../controllers/ProduitController.php';

$controller = new ProduitController();
$cart = $_SESSION['cart'] ?? [];
$cartCount = array_sum($cart);

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $productId = intval($_POST['product_id'] ?? 0);
    $quantity = max(1, intval($_POST['quantity'] ?? 1));

    if($action === 'add' && $productId > 0) {
        $_SESSION['cart'][$productId] = ($_SESSION['cart'][$productId] ?? 0) + $quantity;
    }

    if($action === 'update' && $productId > 0) {
        if($quantity > 0) {
            $_SESSION['cart'][$productId] = $quantity;
        } else {
            unset($_SESSION['cart'][$productId]);
        }
    }

    if($action === 'remove' && $productId > 0) {
        unset($_SESSION['cart'][$productId]);
    }

    if($action === 'clear') {
        $_SESSION['cart'] = [];
    }

    header('Location: cart.php');
    exit();
}

$cart = $_SESSION['cart'] ?? [];
$cartCount = array_sum($cart);
$products = [];
$total = 0;
if(!empty($cart)) {
    $products = $controller->getByIds(array_keys($cart));
    foreach($products as $product) {
        $quantity = $cart[$product['id']] ?? 0;
        $total += $product['prix'] * $quantity;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Panier - Stabilis™</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/stabilis.css?v=1">

    <style>
        .cart-section {
            padding: 60px 0;
        }

        .cart-container {
            display: grid;
            grid-template-columns: 1fr 350px;
            gap: 40px;
        }

        .cart-items {
            background: var(--bg-elevated);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }

        .cart-header {
            background: var(--accent-herb);
            color: white;
            padding: 20px 24px;
            font-size: 18px;
            font-weight: 600;
        }

        .cart-item {
            display: flex;
            align-items: center;
            padding: 20px 24px;
            border-bottom: 1px solid var(--border-light);
            transition: background var(--transition-fast);
        }

        .cart-item:hover {
            background: var(--bg-surface);
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .item-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: var(--radius-md);
            margin-right: 20px;
        }

        .item-details {
            flex: 1;
        }

        .item-title {
            font-size: 16px;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 4px;
        }

        .item-category {
            font-size: 12px;
            color: var(--accent-herb);
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .item-price {
            font-size: 16px;
            font-weight: 600;
            color: var(--accent-herb);
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            border: 1px solid var(--border-light);
            border-radius: var(--radius-md);
            overflow: hidden;
            margin: 0 20px;
        }

        .quantity-btn {
            background: var(--bg-surface);
            border: none;
            width: 32px;
            height: 32px;
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
            width: 50px;
            height: 32px;
            border: none;
            text-align: center;
            font-size: 14px;
            font-weight: 500;
            color: var(--text-primary);
        }

        .item-total {
            font-size: 16px;
            font-weight: 600;
            color: var(--text-primary);
            min-width: 80px;
            text-align: right;
        }

        .remove-btn {
            background: transparent;
            border: none;
            color: #C55A4A;
            cursor: pointer;
            padding: 8px;
            border-radius: var(--radius-md);
            transition: all var(--transition-fast);
            margin-left: 16px;
        }

        .remove-btn:hover {
            background: #FEE;
            color: #A0443A;
        }

        .cart-summary {
            background: var(--bg-elevated);
            border-radius: var(--radius-lg);
            padding: 24px;
            box-shadow: var(--shadow-sm);
            height: fit-content;
        }

        .summary-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 20px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            font-size: 14px;
        }

        .summary-row.total {
            border-top: 1px solid var(--border-light);
            padding-top: 12px;
            font-size: 16px;
            font-weight: 600;
            color: var(--text-primary);
        }

        .checkout-btn {
            background: var(--accent-herb);
            color: white;
            border: none;
            padding: 14px 24px;
            border-radius: var(--radius-full);
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            margin-top: 20px;
            transition: all var(--transition-normal);
        }

        .checkout-btn:hover {
            background: var(--accent-herb-dark);
            transform: translateY(-1px);
        }

        .checkout-btn:disabled {
            background: var(--text-muted);
            cursor: not-allowed;
            transform: none;
        }

        .continue-shopping {
            background: transparent;
            border: 1px solid var(--border-light);
            padding: 12px 24px;
            border-radius: var(--radius-full);
            color: var(--text-secondary);
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all var(--transition-fast);
            margin-top: 12px;
        }

        .continue-shopping:hover {
            background: var(--accent-herb-light);
            border-color: var(--accent-herb-soft);
            color: var(--accent-herb);
        }

        .empty-cart {
            text-align: center;
            padding: 80px 20px;
            color: var(--text-muted);
        }

        .empty-cart i {
            font-size: 64px;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .empty-cart h2 {
            font-size: 24px;
            margin-bottom: 8px;
            color: var(--text-secondary);
        }

        .empty-cart p {
            font-size: 16px;
            margin-bottom: 24px;
        }

        .clear-cart {
            background: transparent;
            border: 1px solid #C55A4A;
            color: #C55A4A;
            padding: 8px 16px;
            border-radius: var(--radius-full);
            font-size: 13px;
            cursor: pointer;
            transition: all var(--transition-fast);
            margin-top: 16px;
        }

        .clear-cart:hover {
            background: #C55A4A;
            color: white;
        }

        @media (max-width: 768px) {
            .cart-container {
                grid-template-columns: 1fr;
            }

            .cart-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 16px;
            }

            .quantity-controls {
                margin: 0;
            }

            .item-total {
                text-align: left;
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
                <li><a href="cart.php" style="color: var(--accent-herb);">
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

    <!-- Cart Section -->
    <section class="cart-section">
        <div class="container">
            <div style="text-align: center; margin-bottom: 40px;">
                <h1 style="font-size: 32px; font-weight: 700; color: var(--text-primary); margin-bottom: 8px;">Votre Panier</h1>
                <p style="color: var(--text-secondary); font-size: 16px;">
                    <?php echo $cartCount; ?> article<?php echo $cartCount > 1 ? 's' : ''; ?> dans votre panier
                </p>
            </div>

            <?php if(empty($products)): ?>
            <div class="empty-cart">
                <i class="fas fa-shopping-cart"></i>
                <h2>Votre panier est vide</h2>
                <p>Découvrez nos produits et commencez vos achats</p>
                <a href="shop.php" class="btn-primary" style="display: inline-flex; padding: 14px 32px; font-size: 16px;">
                    <i class="fas fa-shopping-bag"></i>
                    Voir la boutique
                </a>
            </div>
            <?php else: ?>
            <div class="cart-container">
                <!-- Cart Items -->
                <div class="cart-items">
                    <div class="cart-header">
                        <i class="fas fa-shopping-cart"></i>
                        Articles dans votre panier
                    </div>

                    <?php foreach($products as $product):
                        $quantity = $cart[$product['id']] ?? 0;
                        $itemTotal = $product['prix'] * $quantity;
                    ?>
                    <div class="cart-item">
                        <img src="/AdminLTE3/dist/img/<?php echo $product['image_url'] ?? 'default-product.png'; ?>"
                             alt="<?php echo htmlspecialchars($product['nom']); ?>"
                             class="item-image"
                             onerror="this.src='/AdminLTE3/dist/img/default-product.png'">

                        <div class="item-details">
                            <div class="item-title"><?php echo htmlspecialchars($product['nom']); ?></div>
                            <div class="item-category"><?php echo htmlspecialchars($product['categorie']); ?></div>
                            <div class="item-price"><?php echo number_format($product['prix'], 2); ?> €</div>
                        </div>

                        <form method="POST" style="display: flex; align-items: center; margin: 0 20px;">
                            <input type="hidden" name="action" value="update">
                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                            <div class="quantity-controls">
                                <button type="button" class="quantity-btn" onclick="changeQuantity(<?php echo $product['id']; ?>, -1)">-</button>
                                <input type="number" name="quantity" value="<?php echo $quantity; ?>" min="1" max="<?php echo $product['stock']; ?>"
                                       class="quantity-input" onchange="updateQuantity(<?php echo $product['id']; ?>, this.value)">
                                <button type="button" class="quantity-btn" onclick="changeQuantity(<?php echo $product['id']; ?>, 1)">+</button>
                            </div>
                        </form>

                        <div class="item-total"><?php echo number_format($itemTotal, 2); ?> €</div>

                        <form method="POST" style="margin-left: 16px;">
                            <input type="hidden" name="action" value="remove">
                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                            <button type="submit" class="remove-btn" title="Retirer du panier">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                    <?php endforeach; ?>

                    <div style="padding: 20px 24px; border-top: 1px solid var(--border-light);">
                        <form method="POST">
                            <input type="hidden" name="action" value="clear">
                            <button type="submit" class="clear-cart" onclick="return confirm('Voulez-vous vider votre panier ?')">
                                <i class="fas fa-trash-alt"></i>
                                Vider le panier
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Cart Summary -->
                <div class="cart-summary">
                    <div class="summary-title">Récapitulatif</div>

                    <div class="summary-row">
                        <span>Sous-total</span>
                        <span><?php echo number_format($total, 2); ?> €</span>
                    </div>

                    <div class="summary-row">
                        <span>Livraison</span>
                        <span>Gratuite</span>
                    </div>

                    <div class="summary-row total">
                        <span>Total</span>
                        <span><?php echo number_format($total, 2); ?> €</span>
                    </div>

                    <a href="checkout.php" class="checkout-btn">
                        <i class="fas fa-credit-card"></i>
                        Procéder au paiement
                    </a>

                    <a href="shop.php" class="continue-shopping">
                        <i class="fas fa-arrow-left"></i>
                        Continuer mes achats
                    </a>
                </div>
            </div>
            <?php endif; ?>
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
    function changeQuantity(productId, delta) {
        const input = document.querySelector(`input[name="quantity"][onchange*="${productId}"]`);
        const currentValue = parseInt(input.value);
        const newValue = currentValue + delta;
        const max = parseInt(input.max);

        if (newValue >= 1 && newValue <= max) {
            input.value = newValue;
            updateQuantity(productId, newValue);
        }
    }

    function updateQuantity(productId, quantity) {
        const form = document.querySelector(`input[value="${productId}"]`).closest('form');
        form.submit();
    }
    </script>
</body>
</html>
  <head>
    <title>Stabilis - Panier</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../FrontOfficeFreeSource/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="../../FrontOfficeFreeSource/css/animate.css">
    <link rel="stylesheet" href="../../FrontOfficeFreeSource/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../../FrontOfficeFreeSource/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../../FrontOfficeFreeSource/css/magnific-popup.css">
    <link rel="stylesheet" href="../../FrontOfficeFreeSource/css/aos.css">
    <link rel="stylesheet" href="../../FrontOfficeFreeSource/css/ionicons.min.css">
    <link rel="stylesheet" href="../../FrontOfficeFreeSource/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="../../FrontOfficeFreeSource/css/jquery.timepicker.css">
    <link rel="stylesheet" href="../../FrontOfficeFreeSource/css/flaticon.css">
    <link rel="stylesheet" href="../../FrontOfficeFreeSource/css/icomoon.css">
    <link rel="stylesheet" href="../../FrontOfficeFreeSource/css/style.css">
    <link rel="stylesheet" href="../../assets/css/front-style.css">
  </head>
  <body class="goto-here">
    <div class="py-1 bg-primary">
      <div class="container">
        <div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
          <div class="col-lg-12 d-block">
            <div class="row d-flex">
              <div class="col-md pr-4 d-flex topper align-items-center">
                <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
                <span class="text">contact@stabilis.example</span>
              </div>
              <div class="col-md pr-4 d-flex topper align-items-center text-lg-right">
                <span class="text">Livraison sous 3-5 jours</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
      <div class="container">
        <a class="navbar-brand" href="index.php">Stabilis</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="oi oi-menu"></span> Menu
        </button>
        <div class="collapse navbar-collapse" id="ftco-nav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a href="index.php" class="nav-link">Accueil</a></li>
            <li class="nav-item"><a href="shop.php" class="nav-link">Boutique</a></li>
            <li class="nav-item active"><a href="cart.php" class="nav-link">Panier<?php echo $cartCount ? ' (' . $cartCount . ')' : ''; ?></a></li>
            <li class="nav-item cta cta-colored"><a href="../../Views/back/produits/liste.php" class="nav-link">Back Office</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <section class="hero-wrap hero-bread" style="background-image: url('../../FrontOfficeFreeSource/images/bg_1.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Accueil</a></span> <span>Panier</span></p>
            <h1 class="mb-0 bread">Mon panier</h1>
          </div>
        </div>
      </div>
    </section>
    <section class="ftco-section bg-light">
      <div class="container">
        <?php if(empty($products)): ?>
          <div class="row">
            <div class="col-12 text-center py-5">
              <h2>Votre panier est vide.</h2>
              <p><a href="shop.php" class="btn btn-primary py-3 px-5">Retour à la boutique</a></p>
            </div>
          </div>
        <?php else: ?>
          <div class="row">
            <div class="col-md-12 mb-4">
              <div class="table-responsive">
                <table class="table cart-table">
                  <thead>
                    <tr>
                      <th>Produit</th>
                      <th>Prix</th>
                      <th>Quantité</th>
                      <th>Total</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($products as $product):
                      $quantity = $cart[$product['id']] ?? 0;
                      $lineTotal = $product['prix'] * $quantity;
                    ?>
                      <tr>
                        <td>
                          <div class="media align-items-center">
                            <img src="../../dist/img/<?php echo htmlspecialchars($product['image_url'] ?: 'default-product.png'); ?>" alt="<?php echo htmlspecialchars($product['nom']); ?>" class="mr-3" style="width: 80px; border-radius: 16px;">
                            <div class="media-body">
                              <h5 class="mt-0"><?php echo htmlspecialchars($product['nom']); ?></h5>
                              <small class="text-muted"><?php echo htmlspecialchars($product['categorie']); ?></small>
                            </div>
                          </div>
                        </td>
                        <td><?php echo number_format($product['prix'], 2); ?> €</td>
                        <td>
                          <form method="POST" class="form-inline">
                            <input type="hidden" name="action" value="update">
                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                            <input type="number" name="quantity" value="<?php echo $quantity; ?>" min="0" class="form-control mr-2" style="width: 90px;">
                            <button type="submit" class="btn btn-outline-primary btn-sm">Mettre à jour</button>
                          </form>
                        </td>
                        <td><?php echo number_format($lineTotal, 2); ?> €</td>
                        <td>
                          <form method="POST">
                            <input type="hidden" name="action" value="remove">
                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                          </form>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="row justify-content-end">
            <div class="col-md-4">
              <div class="checkout-total">
                <h3>Résumé de la commande</h3>
                <p>Sous-total: <strong><?php echo number_format($total, 2); ?> €</strong></p>
                <p>Articles: <strong><?php echo $cartCount; ?></strong></p>
                <p><a href="checkout.php" class="btn btn-primary btn-block py-3">Passer à la caisse</a></p>
                <form method="POST">
                  <input type="hidden" name="action" value="clear">
                  <button type="submit" class="btn btn-outline-secondary btn-block py-3">Vider le panier</button>
                </form>
              </div>
            </div>
          </div>
        <?php endif; ?>
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
