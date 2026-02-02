<?php
declare(strict_types=1);
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: logIn.php");
    exit;
}

require_once '../classes/Database.php';
require_once '../classes/Favorite.php';

$db = new Database();
$favRepo = new Favorite($db->getConnection());

$user_id = (int)$_SESSION['user_id'];
$makinatFavorite = $favRepo->getByUser($user_id);

$emri = $_SESSION['emri'];
$email = $_SESSION['email'];
$roli = $_SESSION['roli'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profili Im - Luxxo Cars</title>
    <link rel="icon" type="image/png" href="../img/car.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { 
            margin: 0; 
            background-color: rgba(0,0,0,0.9); 
            font-family: Arial; 
            color: white; 
        }
        .header { 
            position: fixed; 
            top: 0; 
            left: 0; 
            width: 97%; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            padding: 10px 30px; 
            background-color: rgba(0,0,0,0.8); 
            z-index: 1000; 
        }
        .header img { 
            height: 70px; 
        }
        .menu { 
            display: flex; 
            gap: 25px; 
        }   
        .menu a { 
            text-decoration: none; 
            color: grey; 
        }
        .menu a:hover, .menu a.m { 
            color: #DAA520; 
        }
        .profile-container { 
            margin-top: 120px; 
            display: flex; 
            flex-direction: column; 
            align-items: center; 
            padding: 20px; 
        }
        .profile-card { 
            background-color: #111; 
            width: 450px; 
            border: 1px solid #DAA520; 
            border-radius: 15px; 
            padding: 30px; 
            text-align: center; 
            box-shadow: 0 0 20px rgba(218, 165, 32, 0.2); 
        }
        .profile-info h2 { 
            color: #DAA520; 
        }
        .stats { 
            display: flex; 
            justify-content: space-around; 
            margin-top: 25px; 
            border-top: 1px solid #333; 
            padding-top: 20px; 
        }
        .stat-box b { 
            color: #DAA520; 
            display: block; 
            font-size: 22px; 
        }
        
        .fav-item { 
            display: flex; 
            align-items: center; 
            justify-content: space-between; 
            background: #1a1a1a; 
            margin-top: 10px; 
            padding: 10px; 
            border-radius: 8px; 
            border-left: 3px solid #DAA520; 
        }
        .fav-item img { 
            width: 60px; 
            border-radius: 5px; 
        }
        .fav-details { 
            flex-grow: 1; 
            text-align: left; 
            margin-left: 15px; 
        }
        .fav-details span { 
            display: block; 
            font-size: 14px; 
        }
        .btn-remove { 
            color: #ff6b6b; 
            text-decoration: none; 
            font-size: 12px; 
            font-weight: bold; 
        }
    </style>
</head>
<body>

    <header class="header">
        <img src="../img/car.png" alt="Logo">
        <div class="menu">
            <a href="Ballina.php">Ballina</a>
            <a href="makinat.php">Makinat</a>
            <a href="rrethNesh.php">Rreth Nesh</a>
            <a href="Kontakti.php">Kontakti</a>
            <?php if($roli === 'admin'): ?>
                <a href="../Admin/dashboard.php" style="color: #DAA520;">Dashboard</a>
            <?php endif; ?>
            <a href="profili.php" class="m">Profili</a>
        </div>
    </header>

    <div class="profile-container">
        <div class="profile-card">
            <img src="../img/car.png" style="width: 80px;" alt="User">
            <div class="profile-info">
                <h2><?php echo htmlspecialchars($emri); ?></h2>
                <p><i class="fa-solid fa-envelope"></i> <?php echo htmlspecialchars($email); ?></p>
                <p><i class="fa-solid fa-user-tag"></i> Roli: <?php echo ucfirst($roli); ?></p>
            </div>

            <div class="stats">
                <div class="stat-box">
                    <b><?php echo count($makinatFavorite); ?></b>
                    <span>Të preferuara</span>
                </div>
            </div>

            <div style="margin-top: 30px; text-align: left;">
                <h3 style="font-size: 16px; border-bottom: 1px solid #333; padding-bottom: 10px;">Makina të Ruajtura</h3>
                
                <?php if (empty($makinatFavorite)): ?>
                    <p style="color: #888; text-align: center; margin-top: 10px;">Nuk keni asnjë makinë favorite.</p>
                <?php else: ?>
                    <?php foreach ($makinatFavorite as $makina): ?>
                        <div class="fav-item">
                            <img src="<?php echo $makina['foto']; ?>" alt="Car">
                            <div class="fav-details">
                                <strong><?php echo $makina['emri']; ?></strong>
                                <span>Viti: <?php echo $makina['viti']; ?></span>
                            </div>
                            <a href="largo_favorit.php?id=<?php echo $makina['id']; ?>" class="btn-remove" onclick="return confirm('A jeni të sigurt?')">Largo</a>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <br>
            <a href="logout.php" style="color: #ff6b6b; font-size: 13px; text-decoration: none; font-weight: bold;">
                <i class="fa-solid fa-right-from-bracket"></i> Çkyçu (Log Out)
            </a>
        </div>
    </div>
</body>
</html>