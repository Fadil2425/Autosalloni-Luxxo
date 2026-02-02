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
}