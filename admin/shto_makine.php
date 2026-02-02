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

$mesazhi = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $marka = $_POST['marka_zgjedhur'];
    $modeli = $_POST['modeli_detajuar'];
    $emri_full = $marka . " " . $modeli;
    
    $viti = (int)$_POST['viti'];
    $kilometrat = $_POST['kilometrat'];
    
    $foto_name = time() . "_" . $_FILES['foto']['name'];
    $foto_target = "../img/" . $foto_name;
    move_uploaded_file($_FILES['foto']['tmp_name'], $foto_target);
    $foto_path = "../img/" . $foto_name;

    $logo_name = time() . "_" . $_FILES['logo']['name'];
    $logo_target = "../img/" . $logo_name;
    move_uploaded_file($_FILES['logo']['tmp_name'], $logo_target);
    $logo_path = "../img/" . $logo_name;

    if ($carRepo->create($emri_full, $viti, $kilometrat, $foto_path, $logo_path)) {
        header("Location: menaxho_makinat.php?success=1");
        exit();
    } else {
        $mesazhi = "Gabim gjatë shtimit të makinës!";
    }
}
?>

<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>Shto Makinë | Luxxo</title>
    <link rel="icon" type="image/png" href="../img/car.png">
    <style>
        body { background: #0a0a0a; color: white; font-family: Arial; padding: 40px; }
        .form-container { max-width: 500px; margin: auto; background: #111; padding: 30px; border: 1px solid #DAA520; border-radius: 10px; }
        h2 { color: #DAA520; text-align: center; margin-bottom: 20px; }
        label { display: block; margin-top: 15px; color: #aaa; font-size: 14px; }
        input, select { width: 100%; padding: 10px; margin-top: 5px; background: #1a1a1a; border: 1px solid #333; color: white; box-sizing: border-box; border-radius: 5px; }
        select { cursor: pointer; border: 1px solid #DAA520; }
        button { width: 100%; padding: 12px; background: #DAA520; border: none; font-weight: bold; cursor: pointer; margin-top: 25px; transition: 0.3s; border-radius: 5px; }
        button:hover { background: #b8860b; }
        .btn-anulo { display: block; text-align: center; margin-top: 15px; color: #666; text-decoration: none; font-size: 14px; }
    </style>
</head>
<body>

    <div class="form-container">
        <h2>Shto Makinë të Re</h2>
        
        <?php if($mesazhi): ?> <p style="color: #ff4d4d;"><?= $mesazhi ?></p> <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">
            
            <label>Zgjidh Markën:</label>
            <select name="marka_zgjedhur" required>
                <option value="Mercedes">Mercedes-Benz</option>
                <option value="BMW">BMW</option>
                <option value="Audi">Audi</option>
                <option value="Lamborghini">Lamborghini</option>
                <option value="Ferrari">Ferrari</option>
                <option value="Porsche">Porsche</option>
            </select>

            <label>Modeli i makinës (p.sh. S-Class, M5, 911 GT3):</label>
            <input type="text" name="modeli_detajuar" placeholder="Shkruaj modelin këtu..." required>

            <label>Viti i prodhimit</label>
            <input type="number" name="viti" value="2025" required>

            <label>Kilometrat (p.sh. 12,000 km)</label>
            <input type="text" name="kilometrat" placeholder="0 km" required>

            <label>Foto kryesore (shfaqet në kartë)</label>
            <input type="file" name="foto" accept="image/*" required>

            <label>Logoja e markës (shfaqet mbi emër)</label>
            <input type="file" name="logo" accept="image/*" required>

            <button type="submit">RUAJ MAKINËN</button>
            <a href="menaxho_makinat.php" class="btn-anulo">Anulo dhe kthehu</a>
        </form>
    </div>

</body>
</html>