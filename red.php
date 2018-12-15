<?php
session_start();
require_once "functions.php";
header('Content-Type: text/html; charset=utf-8');
$id = $_SESSION["id"];
echo "Привіт, ".$_SESSION["login"];
echo ' <a href="exit.php">Вихiд</a> <br>';
$m=getTovar($_SESSION["id"]);
//print_r($m);
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
        *{
            padding: 0;
            margin: 0;
        }
    </style>
</head>
<body>
<?php
//Array ( [id] => 17 [idadd] => 8 [kategoria] => Телефони [name] => nokia 1718 [opus] => nokia naqc [cina] => 150 [foto] => 1731.jpg Безымянный.jpg t2.jpg )
for($i=0;$i<count($m);$i++) {
    $st="";
    if($_GET["e"]==0)$st="del.php?id=".$m[$i]["id"]."&e=0";
    else $st="redag.php?id=".$m[$i]["id"]."&e=1";
    echo "<a href=$st><div class=\"tov\">";
    echo "<h2>" . $m[$i]['name']."</h2>";
    echo "<p>Вартість " . $m[$i]['cina'] . " грн</p>";
    echo "</div></a>";
}
?>

</body>
</html>

