<?php
session_start();

$_SESSION = array();

session_destroy();

if (isset($_COOKIE['remember_user'])) {
    setcookie("remember_user", "", time() - 3600, "/");
    setcookie("remember_role", "", time() - 3600, "/");
}

header("Location: logIn.php");
exit;
?>