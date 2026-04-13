<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle ?? 'FitTrack – Gestion des Entraînements') ?></title>

    <!-- Google Fonts (required by VegeFood style.css) -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- VegeFood CSS -->
    <link rel="stylesheet" href="<?= ASSETS_FRONT ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= ASSETS_FRONT ?>/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="<?= ASSETS_FRONT ?>/css/animate.css">
    <link rel="stylesheet" href="<?= ASSETS_FRONT ?>/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= ASSETS_FRONT ?>/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?= ASSETS_FRONT ?>/css/magnific-popup.css">
    <link rel="stylesheet" href="<?= ASSETS_FRONT ?>/css/aos.css">
    <link rel="stylesheet" href="<?= ASSETS_FRONT ?>/css/ionicons.min.css">
    <link rel="stylesheet" href="<?= ASSETS_FRONT ?>/css/flaticon.css">
    <link rel="stylesheet" href="<?= ASSETS_FRONT ?>/css/icomoon.css">
    <link rel="stylesheet" href="<?= ASSETS_FRONT ?>/css/style.css">

    <style>
        .badge-niveau { padding: 4px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; }
        .badge-debutant     { background: #d4edda; color: #155724; }
        .badge-intermediaire { background: #fff3cd; color: #856404; }
        .badge-avance       { background: #f8d7da; color: #721c24; }
        .card-workout { border: none; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,.08); transition: transform .2s; }
        .card-workout:hover { transform: translateY(-4px); }
        .calories-badge { background: linear-gradient(135deg,#f093fb,#f5576c); color: white; border-radius: 20px; padding: 3px 12px; font-size: .8rem; }
        .hero-wrap { min-height: 280px; display: flex; align-items: flex-end; }
        .ftco-section { padding: 5em 0; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light ftco-navbar-light scrolled awake" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="<?= BASE_PATH ?>/index.php">🏋️ FitTrack</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav">
            <span class="oi oi-menu"></span> Menu
        </button>
        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item <?= ($controller ?? '') === 'front_entrainement' ? 'active' : '' ?>">
                    <a href="<?= BASE_PATH ?>/index.php?controller=front_entrainement" class="nav-link">Entraînements</a>
                </li>
                <li class="nav-item">
                    <a href="<?= BASE_PATH ?>/index.php?controller=dashboard" class="nav-link">🔧 Admin</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
