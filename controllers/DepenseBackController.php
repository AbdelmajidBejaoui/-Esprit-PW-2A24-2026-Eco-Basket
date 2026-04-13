<?php
require_once __DIR__ . '/../models/DepenseEnergetique.php';
require_once __DIR__ . '/../models/Entrainement.php';

class DepenseBackController {
    private DepenseEnergetique $model;
    private Entrainement $entrainementModel;

    public function __construct() {
        $this->model             = new DepenseEnergetique();
        $this->entrainementModel = new Entrainement();
    }

    public function index(): void {
        $depenses = $this->model->findAll();
        require __DIR__ . '/../views/back/depenses/index.php';
    }

    public function create(?int $entrainement_id = null): void {
        $errors       = [];
        $entrainements = $this->entrainementModel->findAll();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data   = $this->sanitize($_POST);
            $errors = $this->validate($data);
            if (empty($errors)) {
                $this->model->create($data);
                $_SESSION['flash'] = ['type' => 'success', 'msg' => 'Dépense énergétique ajoutée !'];
                header("Location: " . BASE_PATH . "/index.php?controller=back_depense&action=index");
                exit;
            }
        }
        $data = $_POST ?? [];
        if ($entrainement_id) $data['entrainement_id'] = $entrainement_id;
        require __DIR__ . '/../views/back/depenses/create.php';
    }

    public function edit(int $id): void {
        $errors        = [];
        $depense       = $this->model->findById($id);
        $entrainements = $this->entrainementModel->findAll();
        if (!$depense) {
            header("Location: " . BASE_PATH . "/index.php?controller=back_depense&action=index");
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data   = $this->sanitize($_POST);
            $errors = $this->validate($data);
            if (empty($errors)) {
                $this->model->update($id, $data);
                $_SESSION['flash'] = ['type' => 'success', 'msg' => 'Dépense énergétique mise à jour !'];
                header("Location: " . BASE_PATH . "/index.php?controller=back_depense&action=index");
                exit;
            }
            $depense = array_merge($depense, $data);
        }
        require __DIR__ . '/../views/back/depenses/edit.php';
    }

    public function delete(int $id): void {
        $this->model->delete($id);
        $_SESSION['flash'] = ['type' => 'warning', 'msg' => 'Dépense énergétique supprimée.'];
        header("Location: " . BASE_PATH . "/index.php?controller=back_depense&action=index");
        exit;
    }

    private function sanitize(array $post): array {
        return [
            'entrainement_id'         => trim($post['entrainement_id'] ?? ''),
            'calories_brulees'        => trim($post['calories_brulees'] ?? ''),
            'frequence_cardiaque_moy' => trim($post['frequence_cardiaque_moy'] ?? ''),
            'intensite'               => trim($post['intensite'] ?? ''),
            'remarques'               => trim(htmlspecialchars($post['remarques'] ?? '')),
        ];
    }

    private function validate(array $data): array {
        $errors = [];
        if (empty($data['entrainement_id']) || !is_numeric($data['entrainement_id']))
            $errors['entrainement_id'] = 'Veuillez sélectionner un entraînement.';
        if (empty($data['calories_brulees']) || !is_numeric($data['calories_brulees']) || (float)$data['calories_brulees'] <= 0)
            $errors['calories_brulees'] = 'Les calories doivent être un nombre positif.';
        if (!empty($data['frequence_cardiaque_moy']) && (!is_numeric($data['frequence_cardiaque_moy']) || (int)$data['frequence_cardiaque_moy'] < 40 || (int)$data['frequence_cardiaque_moy'] > 250))
            $errors['frequence_cardiaque_moy'] = 'La fréquence cardiaque doit être entre 40 et 250 bpm.';
        if (!in_array($data['intensite'], ['faible','moderee','elevee','maximale']))
            $errors['intensite'] = 'Intensité invalide.';
        return $errors;
    }
}
