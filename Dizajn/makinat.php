<?php
session_start();
require_once '../classes/Database.php';

$db = new Database();
$conn = $db->getConnection();

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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luxxo Cars</title>
    <link rel="icon" type="image/png" href="../img/car.png">
    <link rel="stylesheet" href="makinatstyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            <script>
                setTimeout(() => {
                    const msg = document.getElementById('msg-sukses');
                    if(msg) msg.style.opacity = '0';
                    setTimeout(() => msg.style.display = 'none', 500);
                }, 2500);
            </script>
        <?php endif; ?>

        <b><i><h1 class="bannertext" style="color: #DAA520;">Makinat</h1></i></b>
    </div>

    <div class="sh">
        <h2 style="color: #DAA520; display: flex; text-align: center; justify-content: center; align-items: center;">Shfleto sipas markes</h2>
        <div class="shfleto">
            <a href="#lamborghiniLogo"><img src="../img/lamborghini-logo.png.webp" alt="Lamborghini"></a>
            <a href="#ferrariLogo"><img src="../img/2025.png.webp" alt="Ferrari"></a>
            <a href="#mercedesLogo"><img src="../img/mercedes-benz-logo.png.webp" alt="Mercedes"></a>
            <a href="#audiLogo"><img src="../img/alogo.png" alt="Audi"></a>
            <a href="#bmwLogo"><img src="../img/bmw-logo.png.webp" alt="BMW"></a>
            <a href="#porscheLogo"><img src="../img/porsche-logo.png.webp" alt="Porsche"></a>
        </div>
    </div>

    <div class="body1">
    <?php
    $markat = [
        'Mercedes'    => ['id' => 'mercedesLogo',    'logo' => 'mercedes-benz-logo.png.webp', 'titulli' => 'Mercedes-Benz'],
        'BMW'         => ['id' => 'bmwLogo',         'logo' => 'bmw-logo.png.webp',           'titulli' => 'BMW'],
        'Audi'        => ['id' => 'audiLogo',        'logo' => 'alogo.png',                  'titulli' => 'Audi'],
        'Lamborghini' => ['id' => 'lamborghiniLogo', 'logo' => 'lamborghini-logo.png.webp',  'titulli' => 'Lamborghini'],
        'Ferrari'     => ['id' => 'ferrariLogo',     'logo' => '2025.png.webp',              'titulli' => 'Ferrari'],
        'Porsche'     => ['id' => 'porscheLogo',     'logo' => 'porsche-logo.png.webp',      'titulli' => 'Porsche']
    ];

    foreach ($markat as $fjalekyc => $info):
        $sql = "SELECT * FROM makinat WHERE emri LIKE '$fjalekyc%'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0): 
    ?>
        <div class="txt">
            <div id="<?php echo $info['id']; ?>" class="txt1">
                <img src="../img/<?php echo $info['logo']; ?>" alt="">
                <h2><?php echo $info['titulli']; ?></h2>
            </div>

            <div class="auto">
                <?php while($row = $result->fetch_assoc()): ?>
                    <div class="m1">
                        <a href="Kontakti.php">
                            <img src="<?php echo $row['foto']; ?>" alt="">
                        </a>
                        <div class="info1">
                            <div class="fav">
                                <img src="../img/<?php echo $info['logo']; ?>" alt="" style="width: 50px; height: 40px;">
                                <p><?php echo $row['emri']; ?></p>
                            </div>
                            <a href="?shto_fav=<?php echo $row['id']; ?>" class="pelqim-link" style="text-decoration: none; color: #DAA520; font-weight: bold; font-size: 13px;">
                                <i class="fa-solid fa-heart"></i> Favorite
                            </a>
                        </div>
                        <div class="info">
                            <p><?php echo $row['viti']; ?></p>
                            <p><?php echo $row['kilometrat']; ?></p>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
        <br>
    <?php 
        endif; 
    endforeach; 
    ?>
</div>
    </div>

    <footer class="footer">
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
        <div class="lokacioni" style="display: flex; flex-direction: column; align-items: center; text-align: center; width: 100%; margin-top: 20px;">
            <img src="../img/car.png" alt="" style="width: 100px; height: auto;">
            <p style="color: white; font-size: 20px; margin-top: 10px;"> 
                Magj. Prishtine-Ferizaj, Çagllavicë 10010, Kosovë
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