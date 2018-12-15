<?php
session_start();
require_once "functions.php";
header('Content-Type: text/html; charset=utf-8');
$id = $_SESSION["id"];
echo "Привіт, ".$_SESSION["login"];
echo ' <a href="exit.php">Вихiд</a> <br>';
$m=getTovar($_SESSION["id"]);
$j=$_GET["id"];
for($i=0;$i<count($m);$i++) {
    if ($m[$i]["id"] == $j) {
        $j = $i;
        break;
    }
}
$i=$j;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Document</title>
</head>
<body>
<form enctype="multipart/form-data" action="" method="POST" class="reg">
    Ви хочете видалити товар<br>
    Категорія<br>
    <select name="categori">
        <option value="Ноутбуки" <?php if($m[$i]["kategoria"]=="Ноутбуки")echo "selected";?> >Ноутбуки</option>
        <option value="Телефони" <?php if($m[$i]["kategoria"]=="Телефони")echo "selected";?> >Телефони</option>
        <option value="Планшети" <?php if($m[$i]["kategoria"]=="Планшети")echo "selected";?> >Планшети</option>
    </select><br>
    Назва<br>
    <input type="text" name="name" required minlength="2" value=<?php echo $m[$i]["name"]?> ><br>
    Опис<br>
    <textarea name="opus" required cols="40" rows="3"><?php echo $m[$i]["opus"]?></textarea><br>
    Ціна<br>
    <input type="text" name="pric" required minlength="2" value=<?php echo $m[$i]["cina"]?>><br>
    <input type="submit" name="submit" value="Видалити"><br>
</form>
</body>
</html>
<?php
if(isset($_POST["submit"])) {
    DeleteTovar($m[$i]["id"]);
    header("Location:/cabinetprobavca.php");
    exit;
}
//header("Location:/index.php");
?>
