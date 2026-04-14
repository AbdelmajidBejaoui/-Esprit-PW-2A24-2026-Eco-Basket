<?php
if (!isset($page_title)) $page_title = "Accueil";
$site_name = "Stabilis";
$site_tagline = "Nutrition durable · Performance intelligente";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title><?php echo $page_title; ?> — <?php echo $site_name; ?>™</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Plateforme de nutrition durable pour une alimentation performante et respectueuse de l'environnement">

    <!-- Premium Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Primary Font: Cal Sans (Modern Geometric) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Cal+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Secondary Font: Space Grotesk (Tech-focused) -->
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Accent Font: Instrument Serif (Elegant) -->
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Advanced Animation Libraries -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="assets/css/front-style.css">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/images/favicon.ico">

    <!-- Preload critical resources -->
    <link rel="preload" href="assets/css/front-style.css" as="style">
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
</head>
<body class="overflow-x-hidden">

<!-- Loading Screen -->
<div id="loading-screen" class="loading-screen">
    <div class="loading-content">
        <div class="loading-logo">
            <i class="fas fa-leaf loading-leaf"></i>
            <span class="loading-text">Stabilis</span>
        </div>
        <div class="loading-bar">
            <div class="loading-progress"></div>
        </div>
        <p class="loading-subtitle">Chargement de l'expérience...</p>
    </div>
</div>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-white/95 backdrop-blur-lg shadow-sm sticky-top border-bottom border-light">
    <div class="container-fluid px-4">
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="index.php" data-aos="fade-right">
            <div class="logo-container me-3">
                <div class="logo-icon-wrapper">
                    <i class="fas fa-leaf text-success fa-2x logo-leaf"></i>
                    <div class="logo-glow"></div>
                </div>
            </div>
            <div class="brand-text">
                <span class="fw-bold fs-3 text-dark brand-name" style="font-family: 'Cal Sans', sans-serif;"><?php echo $site_name; ?>™</span>
                <div class="small text-muted brand-tagline" style="font-family: 'Space Grotesk', sans-serif;">Nutrition durable</div>
            </div>
        </a>

        <!-- Mobile Toggle -->
        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item mx-2">
                    <a class="nav-link fw-semibold px-3 py-2 position-relative <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>" href="index.php" style="font-family: 'Space Grotesk', sans-serif;">
                        <i class="fas fa-home me-2"></i>Accueil
                        <span class="nav-indicator"></span>
                    </a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link fw-semibold px-3 py-2 position-relative <?php echo basename($_SERVER['PHP_SELF']) == 'challenges.php' ? 'active' : ''; ?>" href="challenges.php" style="font-family: 'Space Grotesk', sans-serif;">
                        <i class="fas fa-trophy me-2"></i>Défis
                        <span class="nav-indicator"></span>
                    </a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link fw-semibold px-3 py-2 position-relative <?php echo basename($_SERVER['PHP_SELF']) == 'about.php' ? 'active' : ''; ?>" href="about.php" style="font-family: 'Space Grotesk', sans-serif;">
                        <i class="fas fa-info-circle me-2"></i>À propos
                        <span class="nav-indicator"></span>
                    </a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link fw-semibold px-3 py-2 position-relative <?php echo basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'active' : ''; ?>" href="contact.php" style="font-family: 'Space Grotesk', sans-serif;">
                        <i class="fas fa-envelope me-2"></i>Contact
                        <span class="nav-indicator"></span>
                    </a>
                </li>
            </ul>

            <!-- CTA Buttons -->
            <div class="d-flex align-items-center gap-3">
                <a href="../back-office/index.php" class="btn btn-outline-primary btn-sm px-3 py-2">
                    <i class="fas fa-lock me-1"></i>Admin
                </a>
                <a href="challenges.php" class="btn btn-primary btn-sm px-4 py-2 fw-semibold position-relative overflow-hidden">
                    <span class="btn-text">Commencer</span>
                    <span class="btn-hover-bg"></span>
                    <i class="fas fa-arrow-right ms-2 btn-icon"></i>
                </a>
            </div>
        </div>
    </div>
</nav>

<!-- Top Info Bar -->
<div class="bg-gradient-to-r from-emerald-50 to-teal-50 border-bottom border-emerald-100 py-2 d-none d-lg-block">
    <div class="container-fluid px-4">
        <div class="row text-center justify-content-center">
            <div class="col-auto px-4">
                <small class="text-emerald-700 fw-medium">
                    <i class="fas fa-phone text-emerald-600 me-2"></i>+216 XX XXX XXX
                </small>
            </div>
            <div class="col-auto px-4">
                <small class="text-emerald-700 fw-medium">
                    <i class="fas fa-envelope text-emerald-600 me-2"></i>contact@stabilis.tn
                </small>
            </div>
            <div class="col-auto px-4">
                <small class="text-emerald-700 fw-medium">
                    <i class="fas fa-leaf text-emerald-600 me-2"></i><?php echo $site_tagline; ?>
                </small>
            </div>
        </div>
    </div>
</div>

<main class="main-content">