<?php
declare(strict_types=1);

class Message {
    private mysqli $connection;

    public function __construct(mysqli $connection) {
        $this->connection = $connection;
    }

    public function send(string $emri, string $email, string $mesazhi): void {
        $stmt = $this->connection->prepare('INSERT INTO mesazhet (emri, email, mesazhi) VALUES (?, ?, ?)');
        $stmt->bind_param('sss', $emri, $email, $mesazhi);
        $stmt->execute();
        $stmt->close();
    }

    public function all(): array {
        $result = $this->connection->query('SELECT * FROM mesazhet ORDER BY krijuar_me DESC');
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    public function delete(int $id): bool {
    $stmt = $this->connection->prepare('DELETE FROM mesazhet WHERE id = ?');
    $stmt->bind_param('i', $id);
    $uFshi = $stmt->execute();
    $stmt->close();
    return $uFshi;
}
}
