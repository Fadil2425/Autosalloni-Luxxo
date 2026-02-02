<?php
session_start();

// 1. Fshijmë të gjitha variablat e Session-it
$_SESSION = array();

// 2. Nëse dëshiron të shkatërrosh plotësisht session-in
session_destroy();

// 3. Fshirja e Cookies të "Remember Me" (nëse ekzistojnë)
if (isset($_COOKIE['remember_user'])) {
    setcookie("remember_user", "", time() - 3600, "/");
    setcookie("remember_role", "", time() - 3600, "/");
}

// 4. Ridrejto përdoruesin te faqja Log In ose Ballina
header("Location: logIn.php");
exit;
?>