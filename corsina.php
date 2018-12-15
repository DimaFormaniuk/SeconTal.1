<?php
session_start();
require_once "functions.php";
header('Content-Type: text/html; charset=utf-8');
$m=getTovarAll();
echo 'Привіт, ' . $_SESSION["login"];
echo ' <a href="exit.php">Вихiд</a> ';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Document</title>
    <style>
        .tov {
            border: 1px solid silver;
            float: left;
            margin: 5px;
        }

        * {
            padding: 0;
            margin: 0;
        }
    </style>
</head>
<body>
<form action="" method="post" name="buy">
    <input type="text" name="buyr" value="<?php echo $ind?>" hidden><br>

<?php
//Array ( [id] => 17 [idadd] => 8 [kategoria] => Телефони [name] => nokia 1718 [opus] => nokia naqc [cina] => 150 [foto] => 1731.jpg Безымянный.jpg t2.jpg )
$r=getLog1($_SESSION["id"]);
$a=$r[0]["korsina"];
$im = explode(" ", $a);
//print_r($im);
$y=0;
for($i=0;$i<count($m);$i++) {
    for ($j = 0; $j < count($im); $j++) {
        if ($im[$j] != "" && $im[$j] == $m[$i]['id']) {
            $st = "tovardetal.php?tov=" . $m[$i]["id"];
            echo "<div class=\"tov\"> <input type='checkbox' name='b1[]' value=".$m[$i]["id"]." > <a href=$st>";
            echo "<h2>" . $m[$i]['name'] . "</h2>";
            echo "<p>Вартість " . $m[$i]['cina'] . " грн</p>";
            echo "</a></div>";
            $y++;
        }
    }
}
?>
    <br>
    <input type="submit" name="submit1" value="Оформити замовлення">
    <input type="submit" name="submit2" value="Видалити"><br>
</form>
</body>
</html>
<?php
$b1 = $_POST['b1'];
//pocup
if(isset($_POST["submit1"])) {
    //echo "1";
    $s="?";
    for($i=0;$i<count($b1);$i++){
        $s.="t[]=".$b1[$i]."&";
    }
    header("Location:/oformlena.php".$s);
    exit;
}
//delete
if(isset($_POST["submit2"])) {
    //echo "2";
    for($i=0;$i<count($b1);$i++)
    {
        delBuy($_SESSION["id"],$b1[$i]);
    }
}
//print_r($b1);
?>
