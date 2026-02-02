<?php
session_start();
require_once '../classes/Database.php';

$mesazhiPHP = "";

// Kontrolli nëse ekziston Cookie (Auto-login nga shkolla)
if (!isset($_SESSION['user_id']) && isset($_COOKIE['remember_user'])) {
    // Këtu zakonisht do të bëje një SELECT për të marrë të dhënat e plota, 
    // por për thjeshtësi po i mbushim nga Cookie
    $_SESSION['email'] = $_COOKIE['remember_user'];
    $_SESSION['roli'] = $_COOKIE['remember_role'];
    header("Location: Ballina.php");
    exit;
}

if (isset($_POST['login'])) {
    $db = new Database();
    $conn = $db->getConnection();

    $email = $_POST['email'];
    $password = $_POST['password'];
    $remember = isset($_POST['remember']); // Kontrollon nëse është klikuar checkbox

    // Kontrolli në databazë
    $sql = "SELECT * FROM user WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Ruajtja në SESSION
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['emri'] = $user['emri'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['roli'] = $user['roli'];

        // Krijimi i COOKIE nëse është klikuar Remember Me
        if ($remember) {
            setcookie("remember_user", $user['email'], time() + 86400, "/");
            setcookie("remember_role", $user['roli'], time() + 86400, "/");
        }

        // Ridrejtimi sipas rolit
        if ($user['roli'] === 'admin') {
            header("Location: admin.php");
        } else {
            header("Location: Ballina.php");
        }
        exit;
    } else {
        $mesazhiPHP = "Email-i ose fjalëkalimi është gabim!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luxxo Cars - Log In</title>
    <link rel="icon" type="image/png" href="../img/car.png">
    <link rel="stylesheet" href="logInStyle.css">
</head>
<body>
    <form class="box" id="loginForm" action="logIn.php" method="POST">
        <div class="text">
            <img src="../img/car.png" alt="Logo">
            
            <?php if($mesazhiPHP): ?>
                <p style="color: #ff6b6b; font-size: 13px; font-weight: bold;"><?php echo $mesazhiPHP; ?></p>
            <?php endif; ?>

            <input type="email" id="logEmail" name="email" placeholder="Email"> <br>
            <input type="password" id="logPass" name="password" placeholder="Password"> <br>
            
            <div style="display: flex; align-items: center; justify-content: center; gap: 8px; margin: 10px 0; color: white; font-size: 13px;">
                <input type="checkbox" name="remember" id="remember" style="width: 15px; height: 15px; cursor: pointer;">
                <label for="remember" style="cursor: pointer;">Remember Me</label>
            </div>

            <p id="mesazhiJS" style="color: #ff6b6b; font-size: 12px; font-weight: bold; min-height: 15px;"></p>

            <button type="submit" name="login" id="btnLog">Log In</button>

            <div class="fundi">
                <a class="a" href="index.php">Back</a>
                <a href="signUp.php" class="a">Sign Up</a>
            </div>
        </div>
    </form>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const email = document.getElementById('logEmail').value.trim();
            const pass = document.getElementById('logPass').value;
            const msg = document.getElementById('mesazhiJS');

            if (email === "" || pass === "") {
                e.preventDefault(); 
                msg.innerText = "Ju lutem plotësoni të gjitha fushat!";
            } else {
                msg.style.color = "lightgreen";
                msg.innerText = "Duke u procesuar...";
            }
        });
    </script>
</body>
</html>