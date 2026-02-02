<?php
declare(strict_types=1);
session_start();

require_once '../classes/Database.php';
require_once '../classes/Car.php';

if (!isset($_SESSION['roli']) || $_SESSION['roli'] !== 'admin') {
    header("Location: ../Dizajn/login.php");
    exit();
}

$db = new Database();
$carRepo = new Car($db->getConnection());

if (isset($_GET['fshij_id'])) {
    $carRepo->delete((int)$_GET['fshij_id']);
    header("Location: menaxho_makinat.php");
    exit();
}

$makinat = $carRepo->all();
?>

<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>Menaxho Makinat - Luxxo</title>
    <link rel="icon" type="image/png" href="../img/car.png">
    <style>
        body { background: #0a0a0a; color: white; font-family: 'Segoe UI', Arial, sans-serif; padding: 30px; }
        .header-container { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; background: #111; border: 1px solid #333; }
        th, td { padding: 12px; border: 1px solid #222; text-align: center; }
        th { background: #DAA520; color: black; text-transform: uppercase; font-size: 14px; }
        tr:hover { background: #1a1a1a; }
        .btn { padding: 8px 15px; text-decoration: none; border-radius: 4px; font-weight: bold; font-size: 13px; cursor: pointer; }
        .btn-kthehu { background: #333; color: white; border: 1px solid #444; }
        .btn-shto { background: #DAA520; color: black; }
        .btn-delete { background: transparent; color: #ff4d4d; border: 1px solid #ff4d4d; transition: 0.3s; }
        .btn-delete:hover { background: #ff4d4d; color: white; }
        .img-car { width: 80px; height: 50px; object-fit: cover; border-radius: 4px; border: 1px solid #333; }
        .img-logo { width: 25px; vertical-align: middle; }
    </style>
</head>
<body>

    <div class="header-container">
        <a href="admin_dashboard.php" class="btn btn-kthehu">⬅ Dashboard</a>
        <h2 style="color: #DAA520; margin: 0;">Menaxhimi i Inventarit</h2>
        <a href="shto_makine.php" class="btn btn-shto">+ Shto Makinë</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Foto</th>
                <th>Logo</th>
                <th>Makina (Emri)</th>
                <th>Viti</th>
                <th>Kilometrat</th>
                <th>Veprime</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($makinat)): ?>
                <tr><td colspan="6">Nuk ka makina në stok.</td></tr>
            <?php else: ?>
                <?php foreach ($makinat as $m): ?>
                <tr>
                    <td><img src="<?= $m['foto']; ?>" class="img-car"></td>
                    <td><img src="<?= $m['logo']; ?>" class="img-logo"></td>
                    <td style="text-align: left; font-weight: bold;"><?= htmlspecialchars($m['emri']); ?></td>
                    <td><?= $m['viti']; ?></td>
                    <td><?= htmlspecialchars($m['kilometrat']); ?></td>
                    <td>
                        <a href="menaxho_makinat.php?fshij_id=<?= $m['id']; ?>" 
                           class="btn btn-delete" 
                           onclick="return confirm('A jeni të sigurt që dëshironi ta fshini këtë makinë?')">
                           Fshij
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>