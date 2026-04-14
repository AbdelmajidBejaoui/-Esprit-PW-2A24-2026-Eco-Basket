<?php
require_once __DIR__ . '/../app/core/Database.php';
require_once __DIR__ . '/../app/controllers/DefisController.php';

$db = Database::connect();
$controller = new DefisController($db);

$action = $_GET['action'] ?? 'index';

switch ($action) {
    case 'create':
        $controller->create();
        break;
    case 'edit':
        $controller->edit();
        break;
    case 'delete':
        $controller->delete();
        break;
    default:
        $controller->index();
        break;
}
