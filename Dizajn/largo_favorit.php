<?php
session_start();
require_once '../classes/Database.php';
require_once '../classes/Favorite.php';

if (!isset($_SESSION['user_id']) || !isset($_GET['id'])) {
    header("Location: profili.php");
    exit;
}

$db = new Database();
$favRepo = new Favorite($db->getConnection());

$user_id = (int)$_SESSION['user_id'];
$makina_id = (int)$_GET['id'];

$favRepo->remove($user_id, $makina_id);

header("Location: profili.php?mesazhi=fshire");
exit;