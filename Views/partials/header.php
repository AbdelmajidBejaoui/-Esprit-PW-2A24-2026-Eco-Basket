<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title ?? 'Stabilis™ - Gestion Sport Nutrition'; ?></title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/AdminLTE3/assets/css/stabilis.css?v=1">
    
    <style>
        .product-img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 8px;
        }
        .error-message {
            color: #C55A4A;
            font-size: 12px;
            margin-top: 5px;
        }
        .table-row {
            animation: slideIn 0.3s ease-out forwards;
        }
        .table-row-delete {
            animation: slideOut 0.3s ease-out forwards;
        }
        .badge-stock-low {
            animation: pulse 1s infinite;
        }
        @keyframes slideIn {
            from { opacity: 0; transform: translateX(-20px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes slideOut {
            from { opacity: 1; transform: translateX(0); }
            to { opacity: 0; transform: translateX(50px); }
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.6; transform: scale(1.05); }
        }
        @keyframes slideInRight {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        @keyframes slideOutRight {
            from { transform: translateX(0); opacity: 1; }
            to { transform: translateX(100%); opacity: 0; }
        }
        .toast-notification {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            padding: 12px 20px;
            border-radius: 12px;
            color: white;
            font-weight: 500;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            animation: slideInRight 0.4s ease-out;
        }
        .toast-notification.success { background-color: #3A6B4B; }
        .toast-notification.error { background-color: #C55A4A; }
        .toast-notification.info { background-color: #3A6B8C; }
        .loading-spinner-custom {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid white;
            border-top-color: transparent;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
            margin-right: 6px;
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        .input-error {
            animation: shake 0.3s ease;
            border-color: #C55A4A !important;
        }
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="sidebar-header">
        <h3>Stabilis<sup>™</sup></h3>
        <div class="tagline">nutrition adaptative · durable</div>
    </div>
    <ul class="sidebar-nav">
        <li><a href="/AdminLTE3/index.php"><i class="fas fa-bolt"></i> <span>Dashboard</span></a></li>
        <li><a href="/AdminLTE3/Views/back/produits/liste.php"><i class="fas fa-box"></i> <span>Produits</span></a></li>
        <li><a href="/AdminLTE3/Views/back/produits/ajout.php"><i class="fas fa-plus"></i> <span>Nouveau produit</span></a></li>
        <li><a href="/AdminLTE3/Views/front/index.php"><i class="fas fa-store"></i> <span>Front Office</span></a></li>
    </ul>
    <div class="sidebar-footer">
        <i class="fas fa-seedling"></i> low carbon · high performance
    </div>
</div>

<div class="main-content">