<?php
require_once __DIR__ . '/../../Controller/UserC.php';
require_once __DIR__ . '/../../Model/User.php';

$userC = new UserC();
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = $userC->validateUserData($_POST, true);

    if (empty($errors)) {
        $user = new User(
            null,
            trim($_POST['nom']),
            trim($_POST['email']),
            $_POST['password'],
            trim($_POST['role']),
            trim($_POST['preference_alimentaire']),
            trim($_POST['date_inscription']),
            (int) $_POST['statut_compte']
        );

        $userC->insertUser($user);
        header('Location: listUsers.php');
        exit;
    }
}

$pageTitle = 'Ajouter utilisateur';
$activePage = 'add';
require_once __DIR__ . '/partials/layout_top.php';
?>

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Nouveau compte</h3>
    </div>
    <form method="POST" action="">
        <div class="card-body">
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <h5><i class="icon fas fa-ban"></i> Erreurs de saisie</h5>
                    <ul class="mb-0">
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo htmlspecialchars($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="form-group">
                <label>Nom</label>
                <input class="form-control" type="text" name="nom" value="<?php echo htmlspecialchars($_POST['nom'] ?? ''); ?>" placeholder="Nom complet">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input class="form-control" type="text" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" placeholder="email@exemple.com">
            </div>

            <div class="form-group">
                <label>Mot de passe</label>
                <input class="form-control" type="password" name="password" placeholder="Minimum 8 caracteres">
            </div>

            <div class="form-group">
                <label>Role (admin/client)</label>
                <input class="form-control" type="text" name="role" value="<?php echo htmlspecialchars($_POST['role'] ?? 'client'); ?>">
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
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Ajouter</button>
            <a href="listUsers.php" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/partials/layout_bottom.php'; ?>
