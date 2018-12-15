<?php
session_start();
require_once "functions.php";
$DbName="login";
$m=getTovarAll();
header('Content-Type: text/html; charset=utf-8');
if(!isset($_SESSION["login"])) {
    echo '<a href="reg.php">Зареєструватись</a> ';
    echo '<a href="log.php">Вхід</a> ';
}else {
    echo 'Привіт, ' . $_SESSION["login"];
    echo ' <a href="exit.php">Вихiд</a> ';
    if ($_SESSION["priv"]) {
        echo '<a href="cabinetprobavca.php">Особистий кабінет</a> ';
    } else {
        echo '<a href="cabinetpocupca.php">Особистий кабінет</a> ';
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Document</title>
    <style>
        .tov{
            border: 1px solid silver;
            float: left;
            margin: 5px;
        }
        .tov img{
            height: 200px;
            width: auto;
        }
        *{
            padding: 0;
            margin: 0;
        }
    </style>
</head>
<body>
<div class="side">
    Категорії<br>
    <a href="Tovar.php?in=1">Ноутбуки</a><br>
    <a href="Tovar.php?in=2">Телефони</a><br>
    <a href="Tovar.php?in=3">Планшети</a><br>
</div>
<br>
<?php
//Array ( [id] => 17 [idadd] => 8 [kategoria] => Телефони [name] => nokia 1718 [opus] => nokia naqc [cina] => 150 [foto] => 1731.jpg Безымянный.jpg t2.jpg )
for($i=0;$i<count($m);$i++) {
    $st="tovardetal.php?tov=".$m[$i]["id"];
    echo "<a href=$st><div class=\"tov\">";
    $img = explode(" ", $m[$i]['foto']);
    $st = "upload/";
    echo "<img src='" . $st . $img[0] . "'><br>";
    echo "<h2>" . $m[$i]['name']."</h2>";
    echo "<p>Вартість " . $m[$i]['cina'] . " грн</p>";
    echo "</div></a>";
}
?>
</body>
</html>
