<?php
session_start();
require_once "functions.php";
echo ' <a href="index.php">SeconTal</a> <br>';
header('Content-Type: text/html; charset=utf-8');
echo "Привіт, ".$_SESSION["login"];
echo ' <a href="exit.php">Вихiд</a> <br>';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Document</title>
</head>
<body>
<a href="add.php">Додати товар</a><br>
<a href="red.php?e=1">Редагувати товар</a><br>
<a href="red.php?e=0">Видалити товар</a><br>
<a href="corsina.php">Корзина</a><br>
<a href="zamov.php">Замовлення</a><br>
</body>
</html>
