<?php
require_once __DIR__ . '/../models/Entrainement.php';
require_once __DIR__ . '/../models/DepenseEnergetique.php';

class EntrainementFrontController {
    private Entrainement $model;
    private DepenseEnergetique $depenseModel;

    public function __construct() {
        $this->model        = new Entrainement();
        $this->depenseModel = new DepenseEnergetique();
    }

    // LIST
    public function index(): void {
        $entrainements = $this->model->findAllWithTotalCalories();
        $stats = [
            'total'          => $this->model->countAll(),
            'total_calories' => $this->model->totalCalories(),
            'avg_duree'      => round($this->model->avgDuree(), 1),
            'total_depenses' => $this->depenseModel->countAll(),
        ];
        require __DIR__ . '/../views/front/entrainements/index.php';
    }

    // SHOW + depenses
    public function show(int $id): void {
        $rows = $this->model->findWithDepenses($id);
        if (empty($rows)) {
            header("Location: " . BASE_PATH . "/index.php?controller=front_entrainement");
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
        require __DIR__ . '/../views/front/entrainements/show.php';
    }

    // CREATE
    public function create(): void {
        $errors = [];
        $data   = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data   = $this->sanitize($_POST);
            $errors = $this->validate($data);
            if (empty($errors)) {
                $this->model->create($data);
                $_SESSION['flash'] = ['type' => 'success', 'msg' => 'Entraînement ajouté avec succès !'];
                header("Location: " . BASE_PATH . "/index.php?controller=front_entrainement");
                exit;
            }
        }
        require __DIR__ . '/../views/front/entrainements/create.php';
    }

    // EDIT
    public function edit(int $id): void {
        $errors       = [];
        $entrainement = $this->model->findById($id);
        if (!$entrainement) {
            header("Location: " . BASE_PATH . "/index.php?controller=front_entrainement");
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data   = $this->sanitize($_POST);
            $errors = $this->validate($data);
            if (empty($errors)) {
                $this->model->update($id, $data);
                $_SESSION['flash'] = ['type' => 'success', 'msg' => 'Entraînement modifié avec succès !'];
                header("Location: " . BASE_PATH . "/index.php?controller=front_entrainement&action=show&id=$id");
                exit;
            }
            $entrainement = array_merge($entrainement, $data);
        }
        require __DIR__ . '/../views/front/entrainements/edit.php';
    }

    // DELETE
    public function delete(int $id): void {
        $this->model->delete($id);
        $_SESSION['flash'] = ['type' => 'warning', 'msg' => 'Entraînement supprimé.'];
        header("Location: " . BASE_PATH . "/index.php?controller=front_entrainement");
        exit;
    }

    // ADD DEPENSE from front
    public function addDepense(int $entrainement_id): void {
        $errors        = [];
        $entrainements = $this->model->findAll();
        $data          = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data   = $this->sanitizeDepense($_POST);
            $errors = $this->validateDepense($data);
            if (empty($errors)) {
                $this->depenseModel->create($data);
                $_SESSION['flash'] = ['type' => 'success', 'msg' => 'Dépense énergétique ajoutée !'];
                header("Location: " . BASE_PATH . "/index.php?controller=front_entrainement&action=show&id={$data['entrainement_id']}");
                exit;
            }
        }
        $data['entrainement_id'] = $entrainement_id;
        require __DIR__ . '/../views/front/depenses/create.php';
    }

    // DELETE DEPENSE from front
    public function deleteDepense(int $id): void {
        $depense = $this->depenseModel->findById($id);
        $eid = $depense['entrainement_id'] ?? null;
        $this->depenseModel->delete($id);
        $_SESSION['flash'] = ['type' => 'warning', 'msg' => 'Dépense supprimée.'];
        header("Location: " . BASE_PATH . "/index.php?controller=front_entrainement" . ($eid ? "&action=show&id=$eid" : ""));
        exit;
    }

    private function sanitize(array $p): array {
        return [
            'nom'               => trim(htmlspecialchars($p['nom'] ?? '')),
            'description'       => trim(htmlspecialchars($p['description'] ?? '')),
            'duree'             => trim($p['duree'] ?? ''),
            'type_sport'        => trim(htmlspecialchars($p['type_sport'] ?? '')),
            'niveau'            => trim($p['niveau'] ?? ''),
            'date_entrainement' => trim($p['date_entrainement'] ?? ''),
        ];
    }

    private function validate(array $d): array {
        $errors = [];
        if (empty($d['nom']))                                              $errors['nom']               = 'Le nom est obligatoire.';
        if (strlen($d['nom']) > 100)                                       $errors['nom']               = 'Max 100 caractères.';
        if (empty($d['duree']) || !is_numeric($d['duree']) || (int)$d['duree'] <= 0)
                                                                           $errors['duree']             = 'Durée invalide (entier positif).';
        if (empty($d['type_sport']))                                        $errors['type_sport']        = 'Le type de sport est obligatoire.';
        if (!in_array($d['niveau'], ['debutant','intermediaire','avance'])) $errors['niveau']            = 'Niveau invalide.';
        if (empty($d['date_entrainement']) || !strtotime($d['date_entrainement']))
                                                                           $errors['date_entrainement'] = 'Date invalide.';
        return $errors;
    }

    private function sanitizeDepense(array $p): array {
        return [
            'entrainement_id'         => trim($p['entrainement_id'] ?? ''),
            'calories_brulees'        => trim($p['calories_brulees'] ?? ''),
            'frequence_cardiaque_moy' => trim($p['frequence_cardiaque_moy'] ?? ''),
            'intensite'               => trim($p['intensite'] ?? ''),
            'remarques'               => trim(htmlspecialchars($p['remarques'] ?? '')),
        ];
    }

    private function validateDepense(array $d): array {
        $errors = [];
        if (empty($d['entrainement_id']) || !is_numeric($d['entrainement_id']))
            $errors['entrainement_id'] = 'Entraînement invalide.';
        if (empty($d['calories_brulees']) || !is_numeric($d['calories_brulees']) || (float)$d['calories_brulees'] <= 0)
            $errors['calories_brulees'] = 'Calories invalides (nombre positif).';
        if (!empty($d['frequence_cardiaque_moy']) && (!is_numeric($d['frequence_cardiaque_moy']) || (int)$d['frequence_cardiaque_moy'] < 40 || (int)$d['frequence_cardiaque_moy'] > 250))
            $errors['frequence_cardiaque_moy'] = 'FC doit être entre 40 et 250 bpm.';
        if (!in_array($d['intensite'], ['faible','moderee','elevee','maximale']))
            $errors['intensite'] = 'Intensité invalide.';
        return $errors;
    }
}
