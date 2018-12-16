<?php
session_start();
require_once "functions.php";
echo ' <a href="index.php">SeconTal</a> <br>';
header('Content-Type: text/html; charset=utf-8');
echo 'Привіт, ' . $_SESSION["login"];
echo ' <a href="exit.php">Вихiд</a> ';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Document</title>
</head>
<body>
<br>
<a href="corsina.php">Корзина</a><br>
<a href="zamov.php">Замовлення</a><br>
</body>
</html>
