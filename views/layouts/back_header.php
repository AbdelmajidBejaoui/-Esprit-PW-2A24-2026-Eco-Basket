<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle ?? 'Admin – FitTrack') ?></title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="<?= ASSETS_BACK ?>/dist/css/adminlte.min.css">
    <style>
        .badge-debutant      { background-color:#28a745 !important; color:#fff; }
        .badge-intermediaire { background-color:#ffc107 !important; color:#000; }
        .badge-avance        { background-color:#dc3545 !important; color:#fff; }
        .badge-faible        { background-color:#17a2b8 !important; color:#fff; }
        .badge-moderee       { background-color:#28a745 !important; color:#fff; }
        .badge-elevee        { background-color:#ffc107 !important; color:#000; }
        .badge-maximale      { background-color:#dc3545 !important; color:#fff; }
        .error-msg { color:#dc3545; font-size:.85em; margin-top:3px; display:block; }
        .field-error { border-color:#dc3545 !important; }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a></li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= BASE_PATH ?>/index.php?controller=dashboard" class="nav-link">Accueil</a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a href="<?= BASE_PATH ?>/index.php?controller=front_entrainement" class="nav-link">
                <i class="fas fa-globe"></i> Front Office
            </a>
        </li>
    </ul>
</nav>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="<?= BASE_PATH ?>/index.php?controller=dashboard" class="brand-link">
        <span class="brand-text font-weight-light"><strong>🏋️ FitTrack</strong> Admin</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <li class="nav-item">
                    <a href="<?= BASE_PATH ?>/index.php?controller=dashboard"
                       class="nav-link <?= ($controller ?? '') === 'dashboard' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i><p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= BASE_PATH ?>/index.php?controller=back_entrainement&action=index"
                       class="nav-link <?= ($controller ?? '') === 'back_entrainement' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-running"></i><p>Entraînements</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= BASE_PATH ?>/index.php?controller=back_depense&action=index"
                       class="nav-link <?= ($controller ?? '') === 'back_depense' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-fire"></i><p>Dépenses Énergétiques</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>

<div class="content-wrapper">
