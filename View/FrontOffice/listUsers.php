<?php
require_once __DIR__ . '/../../Controller/UserC.php';

$userC = new UserC();
$allUsers = $userC->listUsers();

$users = array_filter($allUsers, function ($u) {
    return (int) $u['statut_compte'] === 1;
});

$pageTitle = 'FrontOffice';
$heroTitle = 'Athlete Community';
$heroSubtitle = 'Profils actifs de la plateforme';
$activePage = 'list';
require_once __DIR__ . '/partials/layout_top.php';
?>

<div class="card card-vege">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Utilisateurs actifs</span>
        <a href="addUser.php" class="btn btn-sm btn-vege">Creer un compte</a>
    </div>
    <div class="table-responsive">
        <table class="table mb-0">
            <thead class="thead-vege">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Preference alimentaire</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($users)): ?>
                    <?php foreach ($users as $u): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($u['id']); ?></td>
                            <td><?php echo htmlspecialchars($u['nom']); ?></td>
                            <td><?php echo htmlspecialchars($u['email']); ?></td>
                            <td><span class="pill-role"><?php echo htmlspecialchars($u['role']); ?></span></td>
                            <td><?php echo htmlspecialchars($u['preference_alimentaire']); ?></td>
                            <td>
                                <a href="updateUser.php?id=<?php echo (int) $u['id']; ?>" class="btn btn-outline-secondary btn-sm">Modifier</a>
                                <a href="deleteUser.php?id=<?php echo (int) $u['id']; ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Supprimer ce compte ?');">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center py-4">Aucun utilisateur actif.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once __DIR__ . '/partials/layout_bottom.php'; ?>
