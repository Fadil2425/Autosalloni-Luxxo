<?php
declare(strict_types=1);

class Message {
    private mysqli $connection;

    public function __construct(mysqli $connection) {
        $this->connection = $connection;
    }

    // Metoda për të dërguar mesazh (përdoret te kontakti.php)
    public function send(string $emri, string $email, string $mesazhi): void {
        $stmt = $this->connection->prepare('INSERT INTO mesazhet (emri, email, mesazhi) VALUES (?, ?, ?)');
        $stmt->bind_param('sss', $emri, $email, $mesazhi);
        $stmt->execute();
        $stmt->close();
    }

    // Metoda për të parë mesazhet (përdoret te dashboard.php i adminit)
    public function all(): array {
        $result = $this->connection->query('SELECT * FROM mesazhet ORDER BY krijuar_me DESC');
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }
}
