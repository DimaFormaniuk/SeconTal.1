<?php
session_start();
require_once "functions.php";
$DbName="login";
$lg=getLog($DbName);
header('Content-Type: text/html; charset=utf-8');
//print_r($lg);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Document</title>
</head>
<body>
<form action="" method="post" name="reg">
    login<br>
    <input type="text" name="login" required minlength="6" ><br>
    password<br>
    <input type="password" name="pas" required minlength="6" ><br>
    продавець<br>
    ні
    <input type="radio" name="priv" value="0" checked><br>
    так
    <input type="radio" name="priv" value="1"><br>
    <input type="submit" name="submit" value="Зареєструватись"><br>
</form>
</body>
</html>
<?php
if(isset($_POST["submit"])) {
    $name = $_POST["login"];
    $pas = $_POST["pas"];
    $priv = $_POST["priv"];
    $_SESSION["login"] = $name;
    $_SESSION["pass"] = $pas;
    $_SESSION["priv"] = $priv;
    pushLog($name, $pas, $priv);
    header("Location:/index.php");
    exit;
}
//header("Location:/index.php");
?>