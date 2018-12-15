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
    <input type="submit" name="submit" value="Вхід"><br>
</form>
</body>
</html>
<?php
//Array ( [id] => 1 [login] => dima [password] => 123456 [priv] => 1
if(isset($_POST["submit"])) {
    $name = $_POST["login"];
    $pas = $_POST["pas"];
    $j = 0;
    //print_r($lg);
    $tr = false;
    $k = count($lg);
    for ($i = 0; $i < $k; $i++) {
        if ($lg[$i]["login"] == $name && $lg[$i]["password"] == $pas) {
            $tr = true;
            echo "++++" . $i . "<br>";
            $j = $i;
            break;
        }
    }
    if ($tr) {
        $id = $lg[$j]["id"];
        $priv = $lg[$j]["priv"];
        $_SESSION["login"] = $name;
        $_SESSION["pass"] = $pas;
        $_SESSION["priv"] = $priv;
        $_SESSION["id"] = $id;
        header("Location:/index.php");
        exit;
    } else {
        echo "<br> Невірний логін чи пароль.<br>";
        echo '<a href="reg.php">Зареєструватись</a> ';
    }
}