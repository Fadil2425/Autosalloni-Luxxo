<?php
declare(strict_types=1);

class Favorite {
    private mysqli $connection;

    public function __construct(mysqli $connection) {
        $this->connection = $connection;
    }

    // Shto në favorite
    public function add(int $user_id, int $makina_id): void {
        // Kontrollojmë nëse ekziston njëherë që të mos kemi dublikate
        $stmt = $this->connection->prepare('INSERT IGNORE INTO favoritet (user_id, makina_id) VALUES (?, ?)');
        $stmt->bind_param('ii', $user_id, $makina_id);
        $stmt->execute();
        $stmt->close();
    }

    // Hiq nga favoritet
    public function remove(int $user_id, int $makina_id): void {
        $stmt = $this->connection->prepare('DELETE FROM favoritet WHERE user_id = ? AND makina_id = ?');
        $stmt->bind_param('ii', $user_id, $makina_id);
        $stmt->execute();
        $stmt->close();
    }

    // Merr të gjitha makinat favorite të një përdoruesi të caktuar
    public function getByUser(int $user_id): array {
        $stmt = $this->connection->prepare('
            SELECT m.* FROM makinat m 
            JOIN favoritet f ON m.id = f.makina_id 
            WHERE f.user_id = ?
        ');
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}