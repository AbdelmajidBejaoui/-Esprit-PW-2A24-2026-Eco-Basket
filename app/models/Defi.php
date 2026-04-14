<?php
class Defi
{
    private mysqli $db;

    public function __construct(mysqli $db)
    {
        $this->db = $db;
    }

    public function getAll(): array
    {
        $sql = "SELECT * FROM defis ORDER BY id DESC";
        $result = $this->db->query($sql);
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    public function count(): int
    {
        $sql = "SELECT COUNT(*) AS total FROM defis";
        $result = $this->db->query($sql);
        $row = $result ? $result->fetch_assoc() : null;
        return $row ? (int) $row['total'] : 0;
    }

    public function getById(int $id): ?array
    {
        $sql = "SELECT * FROM defis WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result ? $result->fetch_assoc() : null;
    }

    public function create(array $data): bool
    {
        $sql = "INSERT INTO defis (nom, type, objectif, recompense) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('ssss', $data['nom'], $data['type'], $data['objectif'], $data['recompense']);
        return $stmt->execute();
    }

    public function update(int $id, array $data): bool
    {
        $sql = "UPDATE defis SET nom = ?, type = ?, objectif = ?, recompense = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('ssssi', $data['nom'], $data['type'], $data['objectif'], $data['recompense'], $id);
        return $stmt->execute();
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM defis WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

    public function getEcoImpact(): float
    {
        return $this->count() * 2.3;
    }
}
