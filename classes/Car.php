<?php
declare(strict_types=1);

class Car
{
    private mysqli $connection;

    public function __construct(mysqli $connection)
    {
        $this->connection = $connection;
    }

    public function all(): array
    {
        $result = $this->connection->query('SELECT * FROM makinat ORDER BY id DESC');
        
        if (!$result) {
            return [];
        }

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function find(int $id): ?array
    {
        $statement = $this->connection->prepare('SELECT * FROM makinat WHERE id = ?');
        $statement->bind_param('i', $id);
        $statement->execute();
        $result = $statement->get_result();
        $car = $result->fetch_assoc();
        $statement->close();

        return $car ?: null;
    }

    public function create(string $emri, int $viti, string $kilometrat, string $foto, string $logo): bool 
    {
        $stmt = $this->connection->prepare('INSERT INTO makinat (emri, viti, kilometrat, foto, logo) VALUES (?, ?, ?, ?, ?)');
        $stmt->bind_param('sisss', $emri, $viti, $kilometrat, $foto, $logo);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function delete(int $id): bool 
    {
        $stmt = $this->connection->prepare('DELETE FROM makinat WHERE id = ?');
        $stmt->bind_param('i', $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
}