<?php
session_start();
require_once "functions.php";
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
<?php
$b1=$_GET["t"];
$sum=0;
for($i=0;$i<count($b1);$i++)
{
    $m = getTovarId($b1[$i]);
    $sum+=$m[0]['cina'];
}

//print_r($b1);
?>
<form action="" method="post" name="buy">
    Прізвище Ім'я
    <input type="text" name="name" required><br>
    Адреса доставки
    <input type="text" name="name1" required><br>
    Номер телефону
    <input type="text" name="name2" required><br>
    Вартість: <?php echo $sum?>
    <br>
    <input type="submit" name="submit" value="Оформити замовлення"><br>
</form>
</body>
</html>
<?php
if(isset($_POST["submit"])) {
    $r="[]";
    $s=$_POST["name"].$r.$_POST["name1"].$r.$_POST["name2"].$r.$sum;

header("Location:/index.php".$s);
exit;
}
?>