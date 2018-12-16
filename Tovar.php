<?php
session_start();
require_once "functions.php";
echo ' <a href="index.php">SeconTal</a> <br>';
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
$ind="0";
if(isset($_GET["in"])){
    switch ($_GET["in"]){
        case 1:$ind="Ноутбуки";break;
        case 2:$ind="Телефони";break;
        case 3:$ind="Планшети";break;
    }
}else{
    header("Location:/index.php");
    exit;
}
$m=getTovarCat($ind);
$vid=0;$do=100000;
if(isset($_POST["vid"]))$vid=$_POST["vid"];
if(isset($_POST["do"]))$do=$_POST["do"];
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
<div class="tov">
    <form action="" method="post" name="buy">
        Ціна<br>від
        <input type="text" name="vid" value="<?php echo $vid ?>"><br>
        до<input type="text" name="do" value="<?php echo $do ?>"><br>
        <input type="submit" name="submit" value="ОК"><br>
    </form>
</div>
<?php
if(isset($_POST["submit"])) {
    $vid = 0;
    $do = 100000;
    if (isset($_POST["vid"])) $vid = $_POST["vid"];
    if (isset($_POST["do"])) $do = $_POST["do"];
    for ($i = 0; $i < count($m); $i++) {
        if ($m[$i]['cina'] >= $vid && $m[$i]['cina'] <= $do) {
            $st = "tovardetal.php?tov=" . $m[$i]["id"];
            echo "<a href=$st><div class=\"tov\">";
            $img = explode(" ", $m[$i]['foto']);
            $st = "upload/";
            echo "<img src='" . $st . $img[0] . "'><br>";
            echo "<h2>" . $m[$i]['name'] . "</h2>";
            echo "<p>Вартість " . $m[$i]['cina'] . " грн</p>";
            echo "</div></a>";
        }
    }
}else {
//Array ( [id] => 17 [idadd] => 8 [kategoria] => Телефони [name] => nokia 1718 [opus] => nokia naqc [cina] => 150 [foto] => 1731.jpg Безымянный.jpg t2.jpg )
    for ($i = 0; $i < count($m); $i++) {
        $st = "tovardetal.php?tov=" . $m[$i]["id"];
        echo "<a href=$st><div class=\"tov\">";
        $img = explode(" ", $m[$i]['foto']);
        $st = "upload/";
        echo "<img src='" . $st . $img[0] . "'><br>";
        echo "<h2>" . $m[$i]['name'] . "</h2>";
        echo "<p>Вартість " . $m[$i]['cina'] . " грн</p>";
        echo "</div></a>";
    }
}
?>
</body>
</html>
