<?php
session_start();
require_once '../classes/Database.php';
require_once '../classes/Car.php';

$db = new Database();
$conn = $db->getConnection();
$carRepo = new Car($conn);

if (!isset($_SESSION['user_id']) && isset($_COOKIE['remember_user_id'])) {
    $_SESSION['user_id'] = $_COOKIE['remember_user_id'];
    $_SESSION['role']    = $_COOKIE['remember_role'];
}

if (isset($_GET['shto_fav'])) {
    if (!isset($_SESSION['user_id'])) {
        echo "<script>alert('Kyçu që të ruash favorite!'); window.location.href='logIn.php';</script>";
        exit;
    }
    $u_id = $_SESSION['user_id'];
    $m_id = (int)$_GET['shto_fav'];
    $stmt = $conn->prepare("INSERT IGNORE INTO favoritet (user_id, makina_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $u_id, $m_id);
    $stmt->execute();
    header("Location: makinat.php?sukses=1");
    exit;
}

$teGjithaMakinat = $carRepo->all();

$seksionet = [
    'Mercedes'    => ['id' => 'mercedesLogo',    'logo' => 'mercedes-benz-logo.png.webp', 'titulli' => 'Mercedes-Benz'],
    'BMW'         => ['id' => 'bmwLogo',         'logo' => 'bmw-logo.png.webp',           'titulli' => 'BMW'],
    'Audi'        => ['id' => 'audiLogo',        'logo' => 'alogo.png',                  'titulli' => 'Audi'],
    'Lamborghini' => ['id' => 'lamborghiniLogo', 'logo' => 'lamborghini-logo.png.webp',  'titulli' => 'Lamborghini'],
    'Ferrari'     => ['id' => 'ferrariLogo',     'logo' => '2025.png.webp',               'titulli' => 'Ferrari'],
    'Porsche'     => ['id' => 'porscheLogo',     'logo' => 'porsche-logo.png.webp',       'titulli' => 'Porsche']
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Luxxo Cars</title>
    <link rel="icon" type="image/png" href="../img/car.png">
    <link rel="stylesheet" href="makinatstyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        .auto {
            display: flex;
            flex-wrap: wrap;     
            gap: 20px;           
            justify-content: center;
            width: 100%;       
        }

        .m1 {
            box-sizing: border-box; 
        }

        @media (max-width: 900px) {
            .m1 {
                flex: 0 0 calc(50% - 10px);
                max-width: calc(50% - 10px);
            }
        }

        @media (max-width: 600px) {
            .m1 {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <nav>
        <div class="header">
            <img src="../img/car.png" alt="">
            <div style="text-align: center; margin: 20px;">
                <input type="text" id="kerkoMakinen" placeholder="Kerko makinen" 
                style="padding: 10px; margin: -5px; width: 70%; border-radius: 25px; border: 1px solid #DAA520; background: black; color: white;">
            </div>
            <div class="menu">
                <a href="Ballina.php">Ballina</a>
                <a class="m" href="makinat.php">Makinat</a>
                <a href="RrethNesh.php">Rreth Nesh</a>
                <a href="Kontakti.php">Kontakti</a>
                <a href="profili.php">Profili</a>
            </div>
        </div>
    </nav>

    <div class="body">
        <?php if (isset($_GET['sukses'])): ?>
            <div id="msg-sukses" style="color: #DAA520; text-align: center; background: rgba(218, 165, 32, 0.1); padding: 15px; border-radius: 5px; margin: 20px auto; width: 50%; border: 1px solid #DAA520; font-family: sans-serif;">
                <i class="fa-solid fa-circle-check"></i> Makina u shtua në favorite!
            </div>
        <?php endif; ?>
        <b><i><h1 class="bannertext" style="color: #DAA520;">Makinat</h1></i></b>
    </div>

    <div class="sh">
        <h2 style="color: #DAA520; text-align: center;">Shfleto sipas markes</h2>
        <div class="shfleto">
            <a href="makinat.php#lamborghiniLogo"><img src="../img/lamborghini-logo.png.webp" alt="Lamborghini"></a>
            <a href="makinat.php#ferrariLogo"><img src="../img/2025.png.webp" alt="Ferrari"></a>
            <a href="makinat.php#mercedesLogo"><img src="../img/mercedes-benz-logo.png.webp" alt="Mercedes"></a>
            <a href="makinat.php#audiLogo"><img src="../img/alogo.png" alt="Audi"></a>
            <a href="makinat.php#bmwLogo"><img src="../img/bmw-logo.png.webp" alt="BMW"></a>
            <a href="makinat.php#porscheLogo"><img src="../img/porsche-logo.png.webp" alt="Porsche"></a>
        </div>
    </div>
    
    <div class="body1">
        <?php foreach ($seksionet as $fjalaKyce => $info): 
            $makinatSipasMarkes = array_filter($teGjithaMakinat, function($m) use ($fjalaKyce) {
                return stripos($m['emri'], $fjalaKyce) === 0;
            });

            if (!empty($makinatSipasMarkes)): 
        ?>
            <div class="txt">
                <div id="<?= $info['id'] ?>" class="txt1">
                    <img src="../img/<?= $info['logo'] ?>" alt="">
                    <h2><?= strtoupper($info['titulli']) ?></h2>
                </div>

                <div class="auto">
                    <?php foreach($makinatSipasMarkes as $row): ?>
                        <div class="m1">
                            <a href="Kontakti.php">
                                <img src="<?= $row['foto']; ?>" alt="">
                            </a>
                            <div class="info1">
                                <div class="fav">
                                    <img src="<?= $row['logo']; ?>" alt="" style="width: 50px; height: 40px; object-fit: contain;">
                                    <p><?= htmlspecialchars($row['emri']); ?></p>
                                </div>
                                <a href="?shto_fav=<?= $row['id']; ?>" class="pelqim-link" style="text-decoration: none; color: #DAA520; font-weight: bold; font-size: 13px;">
                                    <i class="fa-solid fa-heart"></i> Favorite
                                </a>
                            </div>
                            <div class="info">
                                <p><?= $row['viti']; ?></p>
                                <p><?= htmlspecialchars($row['kilometrat']); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <br>
        <?php 
            endif;
        endforeach; 
        ?>
    </div>

    <footer class="footer" style="background-image: url(../img/shfletoo.jpg); background-size: cover; background-position: center;">
    <div class="social-container">

        <div class="social-box">
            <a href="https://www.facebook.com/" target="_blank" class="social fb">
                <i class="fa-brands fa-facebook-f"></i>
                <p>Like us on <strong>Facebook</strong></p>
            </a>
        </div>

        <div class="social-box">
            <a href="https://www.instagram.com/" target="_blank" class="social ig">
                <i class="fa-brands fa-instagram"></i>
                <p>Follow us on <strong>Instagram</strong></p>
            </a>
        </div>

        <div class="social-box">
            <a href="https://www.tiktok.com/" target="_blank" class="social tt">
                <i class="fa-brands fa-tiktok"></i>
                <p>Follow us on <strong>TikTok</strong></p>
            </a>
        </div>

    </div>
    <div class="lokacioni" style="padding-top: 10px; text-align: center;">
    <img src="../img/car.png" alt="" style="display: block; margin: 0 auto 10px auto; width: 100px;">
    <p style="color: white; font-size: 20px;">
        Magj. Prishtine-Ferizaj,<br>
        Çagllavicë 10010<br>
        Kosovë
    </p>
</div>

    <div class="end">
        <p class="copyright">© 2025 Luxxo Cars - All rights reserved</p>
    </div>
    </footer>

    <script>
        document.getElementById('kerkoMakinen').addEventListener('keyup', function() {
            let kerko = this.value.toLowerCase();
            let kartat = document.querySelectorAll('.m1');
            kartat.forEach(karta => {
                let emri = karta.querySelector('.fav p').innerText.toLowerCase();
                karta.style.display = emri.includes(kerko) ? "block" : "none";
            });
        });
    </script>
</body>
</html>