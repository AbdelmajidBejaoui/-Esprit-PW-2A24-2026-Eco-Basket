<?php
require_once __DIR__ . '/../config/Database.php';

class DepenseEnergetique {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    // ── READ ──────────────────────────────────────────────────────────────────
    public function findAll(): array {
        $stmt = $this->db->query(
            "SELECT d.*, e.nom AS entrainement_nom, e.type_sport, e.date_entrainement
             FROM depenses_energetiques d
             INNER JOIN entrainements e ON e.id = d.entrainement_id
             ORDER BY d.created_at DESC"
        );
        return $stmt->fetchAll();
    }

    public function findById(int $id): array|false {
        $stmt = $this->db->prepare(
            "SELECT d.*, e.nom AS entrainement_nom, e.type_sport, e.date_entrainement
             FROM depenses_energetiques d
             INNER JOIN entrainements e ON e.id = d.entrainement_id
             WHERE d.id = :id"
        );
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function findByEntrainement(int $entrainement_id): array {
        $stmt = $this->db->prepare(
            "SELECT * FROM depenses_energetiques WHERE entrainement_id = :eid ORDER BY created_at DESC"
        );
        $stmt->execute([':eid' => $entrainement_id]);
        return $stmt->fetchAll();
    }

    // ── CREATE ────────────────────────────────────────────────────────────────
    public function create(array $data): bool {
        $stmt = $this->db->prepare(
            "INSERT INTO depenses_energetiques (entrainement_id, calories_brulees, frequence_cardiaque_moy, intensite, remarques)
             VALUES (:entrainement_id, :calories_brulees, :frequence_cardiaque_moy, :intensite, :remarques)"
        );
        return $stmt->execute([
            ':entrainement_id'        => (int)$data['entrainement_id'],
            ':calories_brulees'       => (float)$data['calories_brulees'],
            ':frequence_cardiaque_moy'=> !empty($data['frequence_cardiaque_moy']) ? (int)$data['frequence_cardiaque_moy'] : null,
            ':intensite'              => $data['intensite'],
            ':remarques'              => $data['remarques'] ?? '',
        ]);
    }

    // ── UPDATE ────────────────────────────────────────────────────────────────
    public function update(int $id, array $data): bool {
        $stmt = $this->db->prepare(
            "UPDATE depenses_energetiques SET entrainement_id=:entrainement_id, calories_brulees=:calories_brulees,
             frequence_cardiaque_moy=:frequence_cardiaque_moy, intensite=:intensite, remarques=:remarques
             WHERE id=:id"
        );
        return $stmt->execute([
            ':id'                     => $id,
            ':entrainement_id'        => (int)$data['entrainement_id'],
            ':calories_brulees'       => (float)$data['calories_brulees'],
            ':frequence_cardiaque_moy'=> !empty($data['frequence_cardiaque_moy']) ? (int)$data['frequence_cardiaque_moy'] : null,
            ':intensite'              => $data['intensite'],
            ':remarques'              => $data['remarques'] ?? '',
        ]);
    }

    // ── DELETE ────────────────────────────────────────────────────────────────
    public function delete(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM depenses_energetiques WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    public function countAll(): int {
        return (int)$this->db->query("SELECT COUNT(*) FROM depenses_energetiques")->fetchColumn();
    }
}
