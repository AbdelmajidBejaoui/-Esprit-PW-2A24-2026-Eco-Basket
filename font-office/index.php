<?php
$page_title = "Accueil";
include 'config.php';
include 'header.php';

// Récupérer les 6 derniers défis
$sql = "SELECT * FROM defis ORDER BY id DESC LIMIT 6";
$result = mysqli_query($conn, $sql);
$defis = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!-- Hero Section -->
<section class="hero-section position-relative overflow-hidden">
    <div class="hero-bg"></div>
    <div class="container position-relative">
        <div class="row align-items-center min-vh-100">
            <div class="col-lg-6 text-white">
                <div class="hero-content">
                    <span class="badge badge-pill badge-light mb-3 px-3 py-2">🌱 Nutrition Durable</span>
                    <h1 class="display-1 font-weight-bold mb-4">
                        Des défis pour<br>
                        <span class="text-accent">mieux manger</span>
                    </h1>
                    <p class="lead mb-4 fs-5">
                        Transformez votre alimentation en aventure durable.
                        Atteignez vos objectifs tout en préservant la planète.
                    </p>
                    <div class="hero-buttons">
                        <a href="challenges.php" class="btn btn-primary btn-lg px-5 py-3 me-3">
                            <i class="fas fa-play me-2"></i>Découvrir les défis
                        </a>
                        <a href="about.php" class="btn btn-outline-light btn-lg px-5 py-3">
                            En savoir plus
                        </a>
                    </div>
                    <div class="hero-stats mt-5">
                        <div class="row g-4">
                            <div class="col-4">
                                <div class="stat-item">
                                    <h3 class="text-white mb-1">500+</h3>
                                    <small class="text-white-50">Utilisateurs actifs</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="stat-item">
                                    <h3 class="text-white mb-1">2.3t</h3>
                                    <small class="text-white-50">CO₂ économisé</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="stat-item">
                                    <h3 class="text-white mb-1">15</h3>
                                    <small class="text-white-50">Défis disponibles</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-image">
                    <div class="floating-card card-1">
                        <div class="card bg-white shadow-lg border-0 p-3">
                            <div class="d-flex align-items-center">
                                <div class="avatar bg-success rounded-circle me-3">
                                    <i class="fas fa-leaf text-white"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Protéines végétales</h6>
                                    <small class="text-muted">Défi complété !</small>
                                </div>
                                <div class="ms-auto">
                                    <span class="badge bg-success">+100 pts</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="floating-card card-2">
                        <div class="card bg-white shadow-lg border-0 p-3">
                            <div class="d-flex align-items-center">
                                <div class="avatar bg-primary rounded-circle me-3">
                                    <i class="fas fa-trophy text-white"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Sport durable</h6>
                                    <small class="text-muted">En cours</small>
                                </div>
                                <div class="ms-auto">
                                    <span class="badge bg-warning">75%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hero-main-image">
                        <img src="https://images.unsplash.com/photo-1490645935967-10de6ba17061?w=600&h=800&fit=crop&crop=center" alt="Nutrition saine" class="img-fluid rounded-3 shadow-lg">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="hero-shape">
        <svg viewBox="0 0 100 100" preserveAspectRatio="none">
            <polygon points="0,0 100,0 100,100" fill="rgba(255,255,255,0.1)"/>
        </svg>
    </div>
</section>

<!-- Services Section -->
<section class="services-section py-6">
    <div class="container">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <span class="badge badge-pill badge-primary-soft mb-3 px-3 py-2">Nos Services</span>
                <h2 class="display-4 font-weight-bold mb-4">
                    Une approche <span class="text-primary">holistique</span>
                </h2>
                <p class="lead text-muted fs-5">
                    Découvrez comment nous combinons nutrition, performance et impact environnemental
                </p>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="service-card card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <div class="service-icon mb-4">
                            <div class="icon-circle bg-success-soft">
                                <i class="fas fa-leaf fa-2x text-success"></i>
                            </div>
                        </div>
                        <h5 class="card-title font-weight-bold mb-3">Nutrition durable</h5>
                        <p class="card-text text-muted">
                            Produits locaux et de saison pour une alimentation respectueuse de l'environnement
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="service-card card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <div class="service-icon mb-4">
                            <div class="icon-circle bg-warning-soft">
                                <i class="fas fa-trophy fa-2x text-warning"></i>
                            </div>
                        </div>
                        <h5 class="card-title font-weight-bold mb-3">Performance</h5>
                        <p class="card-text text-muted">
                            Objectifs personnalisés et suivi de vos progrès quotidiens
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="service-card card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <div class="service-icon mb-4">
                            <div class="icon-circle bg-info-soft">
                                <i class="fas fa-globe fa-2x text-info"></i>
                            </div>
                        </div>
                        <h5 class="card-title font-weight-bold mb-3">Bas-carbone</h5>
                        <p class="card-text text-muted">
                            Mesurez et réduisez votre empreinte carbone alimentaire
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="service-card card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <div class="service-icon mb-4">
                            <div class="icon-circle bg-primary-soft">
                                <i class="fas fa-headset fa-2x text-primary"></i>
                            </div>
                        </div>
                        <h5 class="card-title font-weight-bold mb-3">Support 24/7</h5>
                        <p class="card-text text-muted">
                            Une équipe dédiée à votre réussite nutritionnelle
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Challenges Section -->
<section class="challenges-section py-6 bg-light">
    <div class="container">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <span class="badge badge-pill badge-success-soft mb-3 px-3 py-2">Défis Actuels</span>
                <h2 class="display-4 font-weight-bold mb-4">
                    Relevez le <span class="text-success">défi</span>
                </h2>
                <p class="lead text-muted fs-5">
                    Découvrez nos défis les plus populaires et commencez votre transformation
                </p>
            </div>
        </div>

        <div class="row g-4">
            <?php if (!empty($defis)): ?>
                <?php foreach ($defis as $index => $defi): ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="challenge-card card border-0 shadow-sm h-100">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <span class="badge badge-<?php echo $defi['type'] == 'aliment' ? 'success' : ($defi['type'] == 'entrainement' ? 'warning' : 'info'); ?> badge-pill px-3 py-2">
                                        <?php echo htmlspecialchars($defi['type']); ?>
                                    </span>
                                    <div class="card-number">#<?php echo $index + 1; ?></div>
                                </div>

                                <h5 class="card-title font-weight-bold mb-3">
                                    <?php echo htmlspecialchars($defi['nom']); ?>
                                </h5>

                                <p class="card-text text-muted mb-4">
                                    <?php echo htmlspecialchars(substr($defi['objectif'], 0, 100)) . '...'; ?>
                                </p>

                                <div class="challenge-reward mb-4">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-gift text-warning me-2"></i>
                                        <span class="text-muted"><?php echo htmlspecialchars($defi['recompense']); ?></span>
                                    </div>
                                </div>

                                <a href="challenge-detail.php?id=<?php echo $defi['id']; ?>" class="btn btn-outline-primary w-100">
                                    En savoir plus
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center">
                    <div class="empty-state">
                        <i class="fas fa-trophy fa-4x text-muted mb-4"></i>
                        <h4 class="text-muted">Aucun défi disponible</h4>
                        <p class="text-muted">Revenez bientôt pour découvrir de nouveaux défis !</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div class="text-center mt-5">
            <a href="challenges.php" class="btn btn-primary btn-lg px-5 py-3">
                <i class="fas fa-list me-2"></i>Voir tous les défis
            </a>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="testimonials-section py-6">
    <div class="container">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <span class="badge badge-pill badge-primary-soft mb-3 px-3 py-2">Témoignages</span>
                <h2 class="display-4 font-weight-bold mb-4">
                    Ils ont <span class="text-primary">réussi</span>
                </h2>
                <p class="lead text-muted fs-5">
                    Découvrez les expériences de notre communauté
                </p>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-4">
                <div class="testimonial-card card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="rating mb-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                        <p class="card-text mb-4">
                            "Grâce à Stabilis, j'ai perdu 5kg en 2 mois tout en mangeant mieux.
                            Les défis sont motivants et l'impact environnemental me motive encore plus !"
                        </p>
                        <div class="d-flex align-items-center">
                            <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?w=60&h=60&fit=crop&crop=face" alt="Marie D." class="rounded-circle me-3">
                            <div>
                                <h6 class="mb-0 font-weight-bold">Marie D.</h6>
                                <small class="text-muted">Nutritionniste</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="testimonial-card card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="rating mb-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                        <p class="card-text mb-4">
                            "L'application est intuitive et les récompenses rendent le suivi addictif.
                            J'ai découvert de nouveaux aliments et réduit mon empreinte carbone de 30%."
                        </p>
                        <div class="d-flex align-items-center">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=60&h=60&fit=crop&crop=face" alt="Thomas L." class="rounded-circle me-3">
                            <div>
                                <h6 class="mb-0 font-weight-bold">Thomas L.</h6>
                                <small class="text-muted">Sportif amateur</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="testimonial-card card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="rating mb-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                        <p class="card-text mb-4">
                            "Enfin une app qui allie santé et écologie ! Les défis sont variés
                            et adaptés à tous les niveaux. Ma famille entière utilise Stabilis maintenant."
                        </p>
                        <div class="d-flex align-items-center">
                            <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=60&h=60&fit=crop&crop=face" alt="Sophie M." class="rounded-circle me-3">
                            <div>
                                <h6 class="mb-0 font-weight-bold">Sophie M.</h6>
                                <small class="text-muted">Mère de famille</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section py-6 bg-primary">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <h2 class="display-4 font-weight-bold text-white mb-4">
                    Prêt à transformer votre alimentation ?
                </h2>
                <p class="lead text-white-50 mb-5 fs-5">
                    Rejoignez plus de 500 utilisateurs qui ont déjà choisi une nutrition durable et performante
                </p>
                <div class="cta-buttons">
                    <a href="challenges.php" class="btn btn-light btn-lg px-5 py-3 me-3">
                        <i class="fas fa-rocket me-2"></i>Commencer maintenant
                    </a>
                    <a href="contact.php" class="btn btn-outline-light btn-lg px-5 py-3">
                        <i class="fas fa-envelope me-2"></i>Nous contacter
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
