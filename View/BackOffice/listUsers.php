<?php
require_once __DIR__ . '/../../Controller/UserC.php';

$userC = new UserC();
$users = $userC->listUsers();

$pageTitle = 'Liste des utilisateurs';
$activePage = 'list';
require_once __DIR__ . '/partials/layout_top.php';
?>

<div class="card card-primary card-outline">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Gestion des comptes</h3>
        <a href="addUser.php" class="btn btn-primary btn-sm">
            <i class="fas fa-user-plus mr-1"></i> Ajouter
        </a>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Preference</th>
                    <th>Date inscription</th>
                    <th>Statut</th>
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
                            <td><?php echo htmlspecialchars($u['role']); ?></td>
                            <td><?php echo htmlspecialchars($u['preference_alimentaire']); ?></td>
                            <td><?php echo htmlspecialchars($u['date_inscription']); ?></td>
                            <td>
                                <?php if ((int) $u['statut_compte'] === 1): ?>
                                    <span class="badge badge-success">Actif</span>
                                <?php else: ?>
                                    <span class="badge badge-secondary">Inactif</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="updateUser.php?id=<?php echo (int) $u['id']; ?>" class="btn btn-warning btn-xs">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="deleteUser.php?id=<?php echo (int) $u['id']; ?>" class="btn btn-danger btn-xs" onclick="return confirm('Supprimer cet utilisateur ?');">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center">Aucun utilisateur trouve.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once __DIR__ . '/partials/layout_bottom.php'; ?>
