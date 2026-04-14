<?php
require_once __DIR__ . '/../../Controller/UserC.php';
require_once __DIR__ . '/../../Model/User.php';

$userC = new UserC();
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_POST['role'] = 'client';
    $_POST['statut_compte'] = $_POST['statut_compte'] ?? '1';

    $errors = $userC->validateUserData($_POST, true);

    if (empty($errors)) {
        $user = new User(
            null,
            trim($_POST['nom']),
            trim($_POST['email']),
            $_POST['password'],
            'client',
            trim($_POST['preference_alimentaire']),
            trim($_POST['date_inscription']),
            (int) $_POST['statut_compte']
        );

        $userC->insertUser($user);
        header('Location: listUsers.php');
        exit;
    }
}

$pageTitle = 'Inscription';
$heroTitle = 'Create Your Athlete Profile';
$heroSubtitle = 'Rejoignez la communaute NutriSmart';
$activePage = 'add';
require_once __DIR__ . '/partials/layout_top.php';
?>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card card-vege">
            <div class="card-header">Inscription athlete</div>
            <div class="card-body">
                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php foreach ($errors as $error): ?>
                                <li><?php echo htmlspecialchars($error); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form method="POST" action="">
                    <div class="form-group">
                        <label>Nom</label>
                        <input class="form-control" type="text" name="nom" value="<?php echo htmlspecialchars($_POST['nom'] ?? ''); ?>">
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" type="text" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                    </div>

                    <div class="form-group">
                        <label>Mot de passe</label>
                        <input class="form-control" type="password" name="password">
                    </div>

                    <div class="form-group">
                        <label>Preference alimentaire</label>
                        <input class="form-control" type="text" name="preference_alimentaire" value="<?php echo htmlspecialchars($_POST['preference_alimentaire'] ?? ''); ?>">
                    </div>

                    <div class="form-group">
                        <label>Date inscription (YYYY-MM-DD HH:MM:SS)</label>
                        <input class="form-control" type="text" name="date_inscription" value="<?php echo htmlspecialchars($_POST['date_inscription'] ?? date('Y-m-d H:i:s')); ?>">
                    </div>

                    <div class="form-group">
                        <label>Statut compte (1 actif, 0 inactif)</label>
                        <input class="form-control" type="text" name="statut_compte" value="<?php echo htmlspecialchars($_POST['statut_compte'] ?? '1'); ?>">
                    </div>

                    <button type="submit" class="btn btn-vege">S'inscrire</button>
                    <a href="listUsers.php" class="btn btn-outline-secondary">Retour</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/partials/layout_bottom.php'; ?>
