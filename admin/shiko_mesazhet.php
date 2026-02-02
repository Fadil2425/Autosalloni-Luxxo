<?php
declare(strict_types=1);
session_start();

require_once '../classes/Database.php';
require_once '../classes/Message.php';

if (!isset($_SESSION['roli']) || $_SESSION['roli'] !== 'admin') {
    header("Location: ../Dizajn/login.php");
    exit();
}

$db = new Database();
$messageRepo = new Message($db->getConnection());

if (isset($_GET['fshij_id'])) {
    $id = (int)$_GET['fshij_id'];
    $messageRepo->delete($id);
    header("Location: shiko_mesazhet.php");
    exit();
}

$mesazhet = $messageRepo->all();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mesazhet - Luxxo Admin</title>
    <link rel="icon" type="image/png" href="../img/car.png">
    <style>
        body { background: #0a0a0a; color: white; font-family: sans-serif; padding: 30px; }
        table { width: 100%; border-collapse: collapse; background: #161616; border-radius: 10px; overflow: hidden; }
        th, td { padding: 15px; border-bottom: 1px solid #222; text-align: left; }
        th { background: #DAA520; color: black; }
        .btn-back { display: inline-block; padding: 10px 20px; background: #DAA520; color: black; text-decoration: none; border-radius: 5px; margin-bottom: 20px; font-weight: bold; }
        .btn-delete { color: #ff4d4d; border: 1px solid #ff4d4d; padding: 5px 10px; text-decoration: none; border-radius: 4px; font-size: 13px; }
        .btn-delete:hover { background: #ff4d4d; color: white; }
    </style>
</head>
<body>

    <a href="admin_dashboard.php" class="btn-back">⬅ Dashboard</a>
    <h2>Lista e Mesazheve</h2>

    <table>
        <thead>
            <tr>
                <th>Emri</th>
                <th>Email</th>
                <th>Mesazhi</th>
                <th>Veprime</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($mesazhet)): ?>
                <tr><td colspan="4" style="text-align: center;">Nuk ka mesazhe për t'u shfaqur.</td></tr>
            <?php else: ?>
                <?php foreach ($mesazhet as $m): ?>
                    <tr>
                        <td><?= htmlspecialchars($m['emri']) ?></td>
                        <td><?= htmlspecialchars($m['email']) ?></td>
                        <td><?= htmlspecialchars($m['mesazhi']) ?></td>
                        <td>
                            <a href="shiko_mesazhet.php?fshij_id=<?= $m['id'] ?>" 
                               class="btn-delete" 
                               onclick="return confirm('A dëshironi ta fshini?')">Fshij</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>