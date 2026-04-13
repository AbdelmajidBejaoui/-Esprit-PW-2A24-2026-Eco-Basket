<?php
session_start();

require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/config/Database.php';
require_once __DIR__ . '/models/Entrainement.php';
require_once __DIR__ . '/models/DepenseEnergetique.php';
require_once __DIR__ . '/controllers/EntrainementFrontController.php';
require_once __DIR__ . '/controllers/EntrainementBackController.php';
require_once __DIR__ . '/controllers/DepenseBackController.php';

$controller = $_GET['controller'] ?? 'front_entrainement';
$action     = $_GET['action']     ?? 'index';
$id         = isset($_GET['id'])  ? (int)$_GET['id'] : null;

switch ($controller) {

    // ── FRONT OFFICE ─────────────────────────────────────────────────────────
    case 'front_entrainement':
        $ctrl = new EntrainementFrontController();
        match($action) {
            'show'          => $ctrl->show($id),
            'create'        => $ctrl->create(),
            'edit'          => $ctrl->edit($id),
            'delete'        => $ctrl->delete($id),
            'add_depense'   => $ctrl->addDepense($id),
            'del_depense'   => $ctrl->deleteDepense($id),
            default         => $ctrl->index(),
        };
        break;

    // ── BACK OFFICE — Entraînements ──────────────────────────────────────────
    case 'back_entrainement':
        $ctrl = new EntrainementBackController();
        match($action) {
            'create' => $ctrl->create(),
            'edit'   => $ctrl->edit($id),
            'delete' => $ctrl->delete($id),
            'show'   => $ctrl->show($id),
            default  => $ctrl->index(),
        };
        break;

    // ── BACK OFFICE — Dépenses ───────────────────────────────────────────────
    case 'back_depense':
        $ctrl = new DepenseBackController();
        $eid  = isset($_GET['entrainement_id']) ? (int)$_GET['entrainement_id'] : null;
        match($action) {
            'create' => $ctrl->create($eid),
            'edit'   => $ctrl->edit($id),
            'delete' => $ctrl->delete($id),
            default  => $ctrl->index(),
        };
        break;

    // ── DASHBOARD ─────────────────────────────────────────────────────────────
    case 'dashboard':
        $entrainementModel = new Entrainement();
        $depenseModel      = new DepenseEnergetique();
        $stats = [
            'total_entrainements' => $entrainementModel->countAll(),
            'total_calories'      => $entrainementModel->totalCalories(),
            'avg_duree'           => round($entrainementModel->avgDuree(), 1),
            'total_depenses'      => $depenseModel->countAll(),
        ];
        $recent = $entrainementModel->findAllWithTotalCalories();
        require __DIR__ . '/views/back/dashboard.php';
        break;

    default:
        header("Location: " . BASE_PATH . "/index.php");
        exit;
}
