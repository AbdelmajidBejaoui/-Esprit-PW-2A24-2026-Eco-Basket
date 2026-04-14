<?php
$page_title = "Détail du défi";
include 'config.php';
include 'header.php';

// Simuler un défi pour l'exemple
$defi = [
    'id' => 1,
    'nom' => 'Protéines végétales',
    'type' => 'aliment',
    'objectif' => '5 repas végétariens par semaine',
    'recompense' => '100 points + badge'
];
?>

<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title"><?php echo htmlspecialchars($defi['nom']); ?></h1>
                        <span class="badge badge-primary"><?php echo htmlspecialchars($defi['type']); ?></span>
                        <p class="card-text mt-3"><?php echo htmlspecialchars($defi['objectif']); ?></p>
                        <p class="text-muted">Récompense: <?php echo htmlspecialchars($defi['recompense']); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
