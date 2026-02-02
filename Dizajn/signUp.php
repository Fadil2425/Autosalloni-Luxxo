<?php
session_start();
require_once '../classes/Database.php'; 

$mesazhiPHP = "";
$tipeMesazhi = ""; 

if (isset($_POST['register'])) {
    $db = new Database();
    $conn = $db->getConnection();

    // Marrja e të dhënave nga forma
    $emri = $_POST['emri'];
    $mbiemri = $_POST['mbiemri'];
    $email = $_POST['email'];
    $password = $_POST['password']; 
    $confirm_password = $_POST['confirm_password'];
    $telefoni = $_POST['telefoni'];
    $qyteti = $_POST['qyteti'];

    // KUSHTI PËR ROLIN
    $roli = str_ends_with($email, '@luxxo.com') ? 'admin' : 'user';

    // 1. Kontrolli i fjalëkalimeve
    if ($password !== $confirm_password) {
        $mesazhiPHP = "Fjalëkalimet nuk përputhen!";
        $tipeMesazhi = "error";
    } else {
        // 2. Kontrollojmë nëse emaili ekziston
        $checkEmail = $conn->prepare("SELECT email FROM user WHERE email = ?");
        $checkEmail->bind_param("s", $email);
        $checkEmail->execute();
        $rezultati = $checkEmail->get_result();

        if ($rezultati->num_rows > 0) {
            $mesazhiPHP = "Ky email ekziston në sistem!";
            $tipeMesazhi = "error";
        } else {
            // 3. Ruajtja në databazë (Plain Text siç kërkove)
            $sql = "INSERT INTO user (emri, mbiemri, email, password, telefoni, qyteti, roli) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssss", $emri, $mbiemri, $email, $password, $telefoni, $qyteti, $roli);
            
            if ($stmt->execute()) {
                $mesazhiPHP = "Regjistrimi u krye me sukses!";
                $tipeMesazhi = "success";
                header("refresh:2; url=logIn.php");
            } else {
                $mesazhiPHP = "Gabim gjatë regjistrimit!";
                $tipeMesazhi = "error";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luxxo Cars - Sign Up</title>
    <link rel="icon" type="image/png" href="../img/car.png">
    <link rel="stylesheet" href="signUpStyle.css">
    <style>
        .success { 
            color: lightgreen; 
            font-weight: bold; 
        }
        .error { 
            color: #ff6b6b; 
            font-weight: bold; 
        }
    </style>
</head>
<body>
    <form class="box" id="regForm" action="signUp.php" method="POST">
        <div class="text">
            <img src="../img/car.png" alt="">
            
            <?php if($mesazhiPHP): ?>
                <p class="<?php echo $tipeMesazhi; ?>"><?php echo $mesazhiPHP; ?></p>
            <?php endif; ?>

            <input type="text" id="emri" name="emri" placeholder="Emri"> <br>
            <input type="text" id="mbiemri" name="mbiemri" placeholder="Mbiemri"> <br>
            <input type="email" id="email" name="email" placeholder="Email"> <br>
            <input type="password" id="pass1" name="password" placeholder="Password"> <br>
            <input type="password" id="pass2" name="confirm_password" placeholder="Confirm Password"> <br>
            <input type="tel" id="telefoni" name="telefoni" placeholder="Numri i telefonit"> <br>
            
            <select name="qyteti" id="qyteti">
                <option selected value="">Qyteti</option>
                <option value="Prishtine">Prishtine</option>
                <option value="Rahovec">Rahovec</option>
                <option value="Prizren">Prizren</option>
                <option value="Mitrovice">Mitrovice</option>        
            </select> <br>

            <p id="mesazhiJS" style="color: #ff6b6b; font-size: 12px; font-weight: bold;"></p>

            <button type="submit" name="register" id="ngj">Sign Up</button>            
            
            <div class="fundi">
                <a class="a" href="index.php">Back</a>
                <a class="a" href="logIn.php">Log In</a>
            </div>
        </div>
    </form>

    <script>
        document.getElementById('regForm').addEventListener('submit', function(e) {
            const emri = document.getElementById('emri').value.trim();
            const mbiemri = document.getElementById('mbiemri').value.trim();
            const email = document.getElementById('email').value.trim();
            const p1 = document.getElementById('pass1').value;
            const p2 = document.getElementById('pass2').value;
            const tel = document.getElementById('telefoni').value.trim();
            const qyteti = document.getElementById('qyteti').value;
            const msg = document.getElementById('mesazhiJS');

            const regexEmri = /^[A-Za-z]{3,}$/;
            const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const regexTel = /^04[34589][0-9]{6}$/;

            if (emri === "" || mbiemri === "" || email === "" || tel === "" || p1 === "" || qyteti === "") {
                e.preventDefault();
                msg.innerText = "Ju lutem plotesoni te gjitha fushat!";
            } 
            else if (!regexEmri.test(emri) || !regexEmri.test(mbiemri)) {
                e.preventDefault();
                msg.innerText = "Emri dhe Mbiemri duhet te kene vetem shkronja!";
            } 
            else if (!regexEmail.test(email)) {
                e.preventDefault();
                msg.innerText = "Email-i nuk eshte i vlefshem!";
            } 
            else if (!regexTel.test(tel)) {
                e.preventDefault();
                msg.innerText = "Numri i telefonit duhet te jete 04xxxxxxx!";
            } 
            else if (p1.length < 6) {
                e.preventDefault();
                msg.innerText = "Fjalekalimi duhet te kete se paku 6 karaktere!";
            } 
            else if (p1 !== p2) {
                e.preventDefault();
                msg.innerText = "Fjalekalimet nuk perputhen!";
            }
            // Nëse s'ka gabime, JS e lejon formën të shkojë te PHP
        });
    </script>
</body>
</html>