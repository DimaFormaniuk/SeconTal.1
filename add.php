<?php
session_start();
require_once "functions.php";
header('Content-Type: text/html; charset=utf-8');
$id = $_SESSION["id"];
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
<form enctype="multipart/form-data" action="" method="POST" class="reg">
    Категорія<br>
    <select name="categori">
        <option value="Ноутбуки" selected >Ноутбуки</option>
        <option value="Телефони" >Телефони</option>
        <option value="Планшети" >Планшети</option>
    </select><br>
    Назва<br>
    <input type="text" name="name" required minlength="2" ><br>
    Опис<br>
    <textarea name="opus" required cols="40" rows="3"></textarea><br>
    Ціна<br>
    <input type="text" name="pric" required minlength="2" ><br>
    Фото<br>
    <input name="userfile1" type="file" /><br/>
    <input name="userfile2" type="file" /><br/>
    <input name="userfile3" type="file" /><br/>
    <input type="submit" name="submit" value="Додати"><br>
</form>
</body>
</html>
<?php
if(isset($_POST["submit"])) {
    $cate = $_POST["categori"];
    $name = $_POST["name"];
    $opus = $_POST["opus"];
    $pric = $_POST["pric"];
    $foto = "";
    if (!is_dir('upload/')) mkdir('upload/');
    $uploaddir = "upload/";
    $uploadfile = basename($_FILES['userfile1']['name']);
    //echo $uploadfile."<br>";
    if ($uploadfile != "") {
        $foto .= $uploadfile . " ";
        $uploadfile = $uploaddir . basename($_FILES['userfile1']['name']);
        move_uploaded_file($_FILES['userfile1']['tmp_name'], $uploadfile);
    }
    $uploadfile = basename($_FILES['userfile2']['name']);
    if ($uploadfile != "") {
        $foto .= $uploadfile . " ";
        $uploadfile = $uploaddir . basename($_FILES['userfile2']['name']);
        move_uploaded_file($_FILES['userfile2']['tmp_name'], $uploadfile);
    }
    $uploadfile = basename($_FILES['userfile3']['name']);
    if ($uploadfile != "") {
        $foto .= $uploadfile . " ";
        $uploadfile = $uploaddir . basename($_FILES['userfile3']['name']);
        move_uploaded_file($_FILES['userfile3']['tmp_name'], $uploadfile);
    }
    echo $foto;
    $id = $_SESSION["id"];
    pushTovar($id, $cate, $name, $opus, $pric, $foto);
    echo "OK";
    header("Location:/cabinetprobavca.php");
    exit;
}
//header("Location:/index.php");
?>
