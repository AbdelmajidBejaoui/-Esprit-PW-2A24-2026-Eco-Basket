<?php
require_once __DIR__ . '/../models/Entrainement.php';
require_once __DIR__ . '/../models/DepenseEnergetique.php';

class EntrainementBackController {
    private Entrainement $model;

    public function __construct() {
        $this->model = new Entrainement();
    }

    // ── LIST ──────────────────────────────────────────────────────────────────
    public function index(): void {
        $entrainements = $this->model->findAllWithTotalCalories();
        $stats = [
            'total'          => $this->model->countAll(),
            'total_calories' => $this->model->totalCalories(),
            'avg_duree'      => round($this->model->avgDuree(), 1),
        ];
        require __DIR__ . '/../views/back/entrainements/index.php';
    }

    // ── CREATE ────────────────────────────────────────────────────────────────
    public function create(): void {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->sanitize($_POST);
            $errors = $this->validate($data);
            if (empty($errors)) {
                $this->model->create($data);
                $_SESSION['flash'] = ['type' => 'success', 'msg' => 'Entraînement ajouté avec succès !'];
                header("Location: " . BASE_PATH . "/index.php?controller=back_entrainement&action=index");
                exit;
            }
        }
        $data = $_POST ?? [];
        require __DIR__ . '/../views/back/entrainements/create.php';
    }

    // ── EDIT ──────────────────────────────────────────────────────────────────
    public function edit(int $id): void {
        $errors = [];
        $entrainement = $this->model->findById($id);
        if (!$entrainement) {
            header("Location: " . BASE_PATH . "/index.php?controller=back_entrainement&action=index");
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->sanitize($_POST);
            $errors = $this->validate($data);
            if (empty($errors)) {
                $this->model->update($id, $data);
                $_SESSION['flash'] = ['type' => 'success', 'msg' => 'Entraînement mis à jour avec succès !'];
                header("Location: " . BASE_PATH . "/index.php?controller=back_entrainement&action=index");
                exit;
            }
            $entrainement = array_merge($entrainement, $data);
        }
        require __DIR__ . '/../views/back/entrainements/edit.php';
    }

    // ── DELETE ────────────────────────────────────────────────────────────────
    public function delete(int $id): void {
        $this->model->delete($id);
        $_SESSION['flash'] = ['type' => 'warning', 'msg' => 'Entraînement supprimé.'];
        header("Location: " . BASE_PATH . "/index.php?controller=back_entrainement&action=index");
        exit;
    }

    // ── SHOW (with depenses) ──────────────────────────────────────────────────
    public function show(int $id): void {
        $rows = $this->model->findWithDepenses($id);
        if (empty($rows)) {
            header("Location: " . BASE_PATH . "/index.php?controller=back_entrainement&action=index");
            exit;
        }
        $entrainement = [
            'id'                => $rows[0]['id'],
            'nom'               => $rows[0]['nom'],
            'description'       => $rows[0]['description'],
            'duree'             => $rows[0]['duree'],
            'type_sport'        => $rows[0]['type_sport'],
            'niveau'            => $rows[0]['niveau'],
            'date_entrainement' => $rows[0]['date_entrainement'],
        ];
        $depenses = [];
        foreach ($rows as $row) {
            if ($row['dep_id'] !== null) {
                $depenses[] = [
                    'id'                      => $row['dep_id'],
                    'calories_brulees'        => $row['calories_brulees'],
                    'frequence_cardiaque_moy' => $row['frequence_cardiaque_moy'],
                    'intensite'               => $row['intensite'],
                    'remarques'               => $row['remarques'],
                    'created_at'              => $row['dep_created'],
                ];
            }
        }
        require __DIR__ . '/../views/back/entrainements/show.php';
    }

    // ── HELPERS ───────────────────────────────────────────────────────────────
    private function sanitize(array $post): array {
        return [
            'nom'               => trim(htmlspecialchars($post['nom'] ?? '')),
            'description'       => trim(htmlspecialchars($post['description'] ?? '')),
            'duree'             => trim($post['duree'] ?? ''),
            'type_sport'        => trim(htmlspecialchars($post['type_sport'] ?? '')),
            'niveau'            => trim($post['niveau'] ?? ''),
            'date_entrainement' => trim($post['date_entrainement'] ?? ''),
        ];
    }

    private function validate(array $data): array {
        $errors = [];
        if (empty($data['nom']))               $errors['nom']               = 'Le nom est obligatoire.';
        if (strlen($data['nom']) > 100)        $errors['nom']               = 'Le nom ne doit pas dépasser 100 caractères.';
        if (empty($data['duree']) || !is_numeric($data['duree']) || (int)$data['duree'] <= 0)
                                               $errors['duree']             = 'La durée doit être un entier positif.';
        if (empty($data['type_sport']))        $errors['type_sport']        = 'Le type de sport est obligatoire.';
        if (!in_array($data['niveau'], ['debutant','intermediaire','avance']))
                                               $errors['niveau']            = 'Niveau invalide.';
        if (empty($data['date_entrainement']) || !strtotime($data['date_entrainement']))
                                               $errors['date_entrainement'] = 'La date est obligatoire et doit être valide.';
        return $errors;
    }
}
