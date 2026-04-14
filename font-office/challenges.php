<?php
$page_title = "Défis";
include 'config.php';
include 'header.php';

// Récupérer tous les défis
$sql = "SELECT * FROM defis ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
$defis = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h1>Tous les défis</h1>
            <p class="lead">Découvrez nos défis pour une nutrition durable</p>
        </div>
        <div class="row">
            <?php if (!empty($defis)): ?>
                <?php foreach ($defis as $defi): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($defi['nom']); ?></h5>
                                <p class="card-text"><?php echo htmlspecialchars($defi['objectif']); ?></p>
                                <span class="badge badge-primary"><?php echo htmlspecialchars($defi['type']); ?></span>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">Récompense: <?php echo htmlspecialchars($defi['recompense']); ?></small>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center">
                    <p>Aucun défi disponible pour le moment.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
