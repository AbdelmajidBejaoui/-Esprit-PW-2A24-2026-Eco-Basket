<?php
require_once __DIR__ . '/../config/Database.php';

class Entrainement {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    // ── READ ──────────────────────────────────────────────────────────────────
    public function findAll(): array {
        $stmt = $this->db->query("SELECT * FROM entrainements ORDER BY date_entrainement DESC");
        return $stmt->fetchAll();
    }

    public function findById(int $id): array|false {
        $stmt = $this->db->prepare("SELECT * FROM entrainements WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function findWithDepenses(int $id): array|false {
        $stmt = $this->db->prepare(
            "SELECT e.*, d.id AS dep_id, d.calories_brulees, d.frequence_cardiaque_moy,
                    d.intensite, d.remarques, d.created_at AS dep_created
             FROM entrainements e
             LEFT JOIN depenses_energetiques d ON d.entrainement_id = e.id
             WHERE e.id = :id"
        );
        $stmt->execute([':id' => $id]);
        return $stmt->fetchAll();
    }

    public function findAllWithTotalCalories(): array {
        $stmt = $this->db->query(
            "SELECT e.*, COALESCE(SUM(d.calories_brulees), 0) AS total_calories,
                    COUNT(d.id) AS nb_depenses
             FROM entrainements e
             LEFT JOIN depenses_energetiques d ON d.entrainement_id = e.id
             GROUP BY e.id
             ORDER BY e.date_entrainement DESC"
        );
        return $stmt->fetchAll();
    }

    // ── CREATE ────────────────────────────────────────────────────────────────
    public function create(array $data): bool {
        $stmt = $this->db->prepare(
            "INSERT INTO entrainements (nom, description, duree, type_sport, niveau, date_entrainement)
             VALUES (:nom, :description, :duree, :type_sport, :niveau, :date_entrainement)"
        );
        return $stmt->execute([
            ':nom'               => $data['nom'],
            ':description'       => $data['description'] ?? '',
            ':duree'             => (int)$data['duree'],
            ':type_sport'        => $data['type_sport'],
            ':niveau'            => $data['niveau'],
            ':date_entrainement' => $data['date_entrainement'],
        ]);
    }

    // ── UPDATE ────────────────────────────────────────────────────────────────
    public function update(int $id, array $data): bool {
        $stmt = $this->db->prepare(
            "UPDATE entrainements SET nom=:nom, description=:description, duree=:duree,
             type_sport=:type_sport, niveau=:niveau, date_entrainement=:date_entrainement
             WHERE id=:id"
        );
        return $stmt->execute([
            ':id'                => $id,
            ':nom'               => $data['nom'],
            ':description'       => $data['description'] ?? '',
            ':duree'             => (int)$data['duree'],
            ':type_sport'        => $data['type_sport'],
            ':niveau'            => $data['niveau'],
            ':date_entrainement' => $data['date_entrainement'],
        ]);
    }

    // ── DELETE ────────────────────────────────────────────────────────────────
    public function delete(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM entrainements WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    // ── STATS ─────────────────────────────────────────────────────────────────
    public function countAll(): int {
        return (int)$this->db->query("SELECT COUNT(*) FROM entrainements")->fetchColumn();
    }

    public function totalCalories(): float {
        return (float)$this->db->query("SELECT COALESCE(SUM(calories_brulees),0) FROM depenses_energetiques")->fetchColumn();
    }

    public function avgDuree(): float {
        return (float)$this->db->query("SELECT COALESCE(AVG(duree),0) FROM entrainements")->fetchColumn();
    }
}
