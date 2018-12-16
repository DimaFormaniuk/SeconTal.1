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
$zam=getZamov();
//print_r($zam);
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
<br>
<?php
if($_SESSION["priv"]==1) {
    echo "<form action='' method='post' name='buy'>";
    for ($i = 0; $i < count($zam); $i++) {
        if ($zam[$i]["idprod"] == $_SESSION["id"]) {
            $md=getTovarId($zam[$i]["idtov"]);
            $st = "tovardetal.php?tov=" . $md[$i]["id"];
            echo "<div class='tov'>";
            if($zam[$i]["status"]==0)
            echo "<input type='checkbox' name='b1[]' value=".$zam[$i]['id']." >";
            else if($zam[$i]["status"]==1)
                echo "статис Підтверджено <br>";
            else if($zam[$i]["status"]==-1)
                echo "статус Відмовлено <br>";
            echo "<a href=$st>";
            echo "<h2>" . $md[0]['name'] . "</h2>";
            echo "<p>Вартість " . $md[0]['cina'] . " грн</p>";
            echo "<h2>Ім'я " . $zam[$i]['name'] . "</h2>";
            echo "<h2>Адреса " . $zam[$i]['adres'] . "</h2>";
            echo "<h2>Телефон " . $zam[$i]['phone'] . "</h2>";
            echo "</a></div>";
        }
    }
    echo "<br>
    <input type='submit' name='submit1' value='Підтвердити'>
    <input type='submit' name='submit2' value='Відмовити'><br>";
}else{
    for ($i = 0; $i < count($zam); $i++) {
        if ($zam[$i]["idpoc"] == $_SESSION["id"]) {
            $md=getTovarId($zam[$i]["idtov"]);
            $st = "tovardetal.php?tov=" . $md[$i]["id"];
            echo "<div class='tov'>";
            if($zam[$i]["status"]==0)
                echo "статис Очікування <br>";
            else if($zam[$i]["status"]==1)
                echo "статис Підтверджено <br>";
            else if($zam[$i]["status"]==-1)
                echo "статус Відмовлено <br>";
            echo "<a href=$st>";
            echo "<h2>" . $md[0]['name'] . "</h2>";
            echo "<p>Вартість " . $md[0]['cina'] . " грн</p>";
            echo "<h2>Ім'я " . $zam[$i]['name'] . "</h2>";
            echo "<h2>Адреса " . $zam[$i]['adres'] . "</h2>";
            echo "<h2>Телефон " . $zam[$i]['phone'] . "</h2>";
            echo "</a></div>";
        }
    }
}
?>

</body>
</html>
<?php
$b1 = $_POST['b1'];
//print_r($b1);
//pocup
if(isset($_POST["submit1"])) {
    $b1 = $_POST['b1'];
    for($i=0;$i<count($b1);$i++){
        ZamovTrue($b1[$i],1);
        //echo $b1[$i];
    }
    header("Location:/zamov.php");
    exit;
}
//delete
if(isset($_POST["submit2"])) {
    $b1 = $_POST['b1'];
    for($i=0;$i<count($b1);$i++){
        ZamovTrue($b1[$i],-1);
        //echo $b1[$i];
    }
    header("Location:/zamov.php");
    exit;
}
//print_r($b1);
?>