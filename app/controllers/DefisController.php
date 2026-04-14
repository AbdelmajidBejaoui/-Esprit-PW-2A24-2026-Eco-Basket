<?php
require_once __DIR__ . '/../models/Defi.php';

class DefisController
{
    private Defi $defi;

    public function __construct(mysqli $db)
    {
        $this->defi = new Defi($db);
    }

    public function index(): void
    {
        $defis = $this->defi->getAll();
        $count = $this->defi->count();
        $co2_evite = $this->defi->getEcoImpact();

        require __DIR__ . '/../views/defis/index.php';
    }

    public function create(): void
    {
        $errors = [];
        $defi = [
            'nom' => '',
            'type' => '',
            'objectif' => '',
            'recompense' => '',
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $defi = $this->sanitizeInput($_POST);
            $errors = $this->validate($defi);

            if (empty($errors)) {
                if ($this->defi->create($defi)) {
                    header('Location: index.php');
                    exit();
                }

                $errors[] = 'Erreur lors de l\'ajout du défi.';
            }
        }

        $action = 'create';
        require __DIR__ . '/../views/defis/form.php';
    }

    public function edit(): void
    {
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        if ($id <= 0) {
            header('Location: index.php');
            exit();
        }

        $defi = $this->defi->getById($id);
        if (!$defi) {
            header('Location: index.php');
            exit();
        }

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $input = $this->sanitizeInput($_POST);
            $errors = $this->validate($input);

            if (empty($errors)) {
                if ($this->defi->update($id, $input)) {
                    header('Location: index.php');
                    exit();
                }

                $errors[] = 'Erreur lors de la modification du défi.';
            }

            $defi = array_merge($defi, $input);
        }

        $action = 'edit';
        require __DIR__ . '/../views/defis/form.php';
    }

    public function delete(): void
    {
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        if ($id <= 0) {
            header('Location: index.php');
            exit();
        }

        $defi = $this->defi->getById($id);
        if (!$defi) {
            header('Location: index.php');
            exit();
        }

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm']) && $_POST['confirm'] === 'oui') {
            if ($this->defi->delete($id)) {
                header('Location: index.php?deleted=1');
                exit();
            }
            $errors[] = 'Erreur lors de la suppression du défi.';
        }

        require __DIR__ . '/../views/defis/delete.php';
    }

    private function sanitizeInput(array $input): array
    {
        return [
            'nom' => trim($input['nom'] ?? ''),
            'type' => trim($input['type'] ?? ''),
            'objectif' => trim($input['objectif'] ?? ''),
            'recompense' => trim($input['recompense'] ?? ''),
        ];
    }

    private function validate(array $input): array
    {
        $errors = [];

        if (empty($input['nom'])) {
            $errors[] = 'Le nom est obligatoire';
        } elseif (mb_strlen($input['nom']) > 100) {
            $errors[] = 'Le nom ne doit pas dépasser 100 caractères';
        }

        if (empty($input['type'])) {
            $errors[] = 'Le type est obligatoire';
        } elseif (!in_array($input['type'], ['aliment', 'entrainement', 'compensation'], true)) {
            $errors[] = 'Type invalide';
        }

        if (empty($input['objectif'])) {
            $errors[] = 'L\'objectif est obligatoire';
        }

        if (empty($input['recompense'])) {
            $errors[] = 'La récompense est obligatoire';
        }

        return $errors;
    }
}
