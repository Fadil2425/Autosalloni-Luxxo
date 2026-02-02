<?php
session_start();
// 1. Sigurohu që ky path është 100% i saktë
require_once '../classes/Database.php';

// Aktivizo raportimin e gabimeve
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $db = new Database();
        $conn = $db->getConnection();

        if (!$conn) {
            die("Lidhja me databazën dështoi!");
        }

        $emri = $_POST['emri'] ?? '';
        $email = $_POST['email'] ?? '';
        $mesazhi = $_POST['mesazhi'] ?? '';

        // Kontrollojmë nëse tabela ekziston vërtet
        $sql = "INSERT INTO mesazhet (emri, email, mesazhi) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        
        if ($stmt) {
            $stmt->bind_param("sss", $emri, $email, $mesazhi);
            if ($stmt->execute()) {
                echo "success";
            } else {
                echo "Gabim gjatë ruajtjes: " . $stmt->error;
            }
        } else {
            echo "Gabim në përgatitjen e SQL (A ekziston tabela 'mesazhet'?): " . $conn->error;
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>