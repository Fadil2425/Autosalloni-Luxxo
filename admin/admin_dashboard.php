<?php
session_start();
require_once '../classes/Database.php';

if (!isset($_SESSION['roli']) || $_SESSION['roli'] !== 'admin') {
    header("Location: ../Dizajn/Ballina.php");
    exit();
}

$db = new Database();
$conn = $db->getConnection();

$makinat_count = $conn->query("SELECT COUNT(*) as total FROM makinat")->fetch_assoc()['total'];
$mesazhet_count = $conn->query("SELECT COUNT(*) as total FROM mesazhet")->fetch_assoc()['total'];
$perdoruesit_count = $conn->query("SELECT COUNT(*) as total FROM user")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luxxo Admin | Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <style>
        :root {
            --gold: #DAA520;
            --dark-bg: #0a0a0a;
            --card-bg: #161616;
            --text-grey: #a0a0a0;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: var(--dark-bg);
            color: white;
            display: flex;
        }

        .sidebar {
            width: 260px;
            height: 100vh;
            background: black;
            border-right: 1px solid #333;
            position: fixed;
            display: flex;
            flex-direction: column;
        }

        .sidebar-header {
            padding: 30px;
            text-align: center;
            border-bottom: 1px solid #222;
        }

        .sidebar-header h2 {
            color: var(--gold);
            margin: 0;
            letter-spacing: 2px;
            font-size: 22px;
        }

        .menu {
            padding: 20px 0;
            flex-grow: 1;
        }

        .menu a {
            display: flex;
            align-items: center;
            padding: 15px 30px;
            color: var(--text-grey);
            text-decoration: none;
            transition: 0.3s;
            font-size: 15px;
        }

        .menu a i { margin-right: 15px; width: 20px; }

        .menu a:hover, .menu a.active {
            color: var(--gold);
            background: rgba(218, 165, 32, 0.05);
            border-left: 4px solid var(--gold);
        }

        .logout {
            padding: 20px;
            border-top: 1px solid #222;
        }

        .logout a { color: #ff4d4d; text-decoration: none; display: flex; align-items: center; justify-content: center; }

        .main {
            margin-left: 260px;
            padding: 40px;
            width: calc(100% - 260px);
        }

        .header-main {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .welcome-text h1 { margin: 0; font-size: 28px; }
        .welcome-text p { color: var(--text-grey); margin: 5px 0 0; }

        .btn-back {
            background: var(--gold);
            color: black;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 30px;
            transition: 0.3s;
        }

        .btn-back:hover {
            background: #b8860b;
            transform: translateX(-5px);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: var(--card-bg);
            padding: 25px;
            border-radius: 15px;
            border: 1px solid #222;
            display: flex;
            align-items: center;
            transition: 0.3s;
        }

        .stat-card:hover { border-color: var(--gold); transform: translateY(-5px); }

        .stat-icon {
            width: 60px;
            height: 60px;
            background: rgba(218, 165, 32, 0.1);
            color: var(--gold);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-right: 20px;
        }

        .stat-info h3 { margin: 0; font-size: 24px; }
        .stat-info p { margin: 5px 0 0; color: var(--text-grey); font-size: 14px; }

        .recent-section {
            background: var(--card-bg);
            padding: 25px;
            border-radius: 15px;
            border: 1px solid #222;
        }

        .recent-section h2 { font-size: 20px; margin-bottom: 20px; color: var(--gold); }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-header">
            <h2>LUXXO ADMIN</h2>
        </div>
        <div class="menu">
            <a href="admin_dashboard.php" class="active"><i class="fas fa-chart-line"></i> Dashboard</a>
            <a href="menaxho_makinat.php"><i class="fas fa-car"></i> Menaxho Makinat</a>
            <a href="shiko_mesazhet.php"><i class="fas fa-envelope"></i> Mesazhet</a>
            <a href="dashboard_user.php"><i class="fas fa-users"></i> Përdoruesit</a>
        </div>
        <div class="logout">
            <a href="../Dizajn/logout.php"><i class="fas fa-sign-out-alt"></i> Çkyqu</a>
        </div>
    </div>

    <div class="main">
        <a href="../Dizajn/profili.php" class="btn-back">
            <i class="fas fa-arrow-left"></i> Kthehu te Profili
        </a>

        <div class="header-main">
            <div class="welcome-text">
                <h1>Përshëndetje, <?php echo $_SESSION['emri']; ?></h1>
                <p>Mirësevini në panelin e kontrollit të Luxxo Cars.</p>
            </div>
            <div class="date" style="color: var(--gold)">
                <i class="far fa-calendar-alt"></i> <?php echo date('d M, Y'); ?>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-car"></i></div>
                <div class="stat-info">
                    <h3><?php echo $makinat_count; ?></h3>
                    <p>Makinat në Stock</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-comment-alt"></i></div>
                <div class="stat-info">
                    <h3><?php echo $mesazhet_count; ?></h3>
                    <p>Mesazhe të Reja</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-user-shield"></i></div>
                <div class="stat-info">
                    <h3><?php echo $perdoruesit_count; ?></h3>
                    <p>Përdorues total</p>
                </div>
            </div>
        </div>

        <div class="recent-section">
            <h2>Statusi i Sistemit</h2>
            <p style="color: var(--text-grey)">
                Sistemi është duke funksionuar në rregull. Të gjitha lidhjet me databazën 
                <strong>autosalloni-luxxosql</strong> janë aktive.
            </p>
        </div>
    </div>

</body>
</html>