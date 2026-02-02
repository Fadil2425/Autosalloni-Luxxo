<?php
declare(strict_types=1);

class Database
{
    private string $host;
    private string $user;
    private string $password;
    private string $database;
    private ?mysqli $connection = null;

    public function __construct()
    {
        // Përdorim vlerat e tua direkte nëse getenv nuk është setuar
        $this->host = getenv('DB_HOST') ?: '127.0.0.1';
        $this->user = getenv('DB_USER') ?: 'root';
        $this->password = getenv('DB_PASSWORD') ?: '';
        $this->database = getenv('DB_NAME') ?: 'autosalloni-luxxosql';
    }

    public function getConnection(): mysqli
    {
        if ($this->connection instanceof mysqli) {
            return $this->connection;
        }

        $this->connection = new mysqli($this->host, $this->user, $this->password);

        if ($this->connection->connect_error) {
            throw new RuntimeException('Lidhja me databazën dështoi: ' . $this->connection->connect_error);
        }

        // Zgjedhim databazën tënde
        $this->connection->select_db($this->database);

        return $this->connection;
    }

    public function initialize(): void
    {
        $connection = $this->getConnection();
        $databaseName = $connection->real_escape_string($this->database);

        // Krijon DB nëse nuk ekziston
        $connection->query("CREATE DATABASE IF NOT EXISTS `{$databaseName}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        $connection->select_db($this->database);

        // Këtu mund të shtoje SQL për krijimin e tabelave user dhe makinat 
        // nëse nuk do t'i kishe krijuar në phpMyAdmin.
    }
}