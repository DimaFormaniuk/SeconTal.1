<?php
session_start();
require_once "functions.php";
$DbName="login";
$lg=getLog($DbName);
header('Content-Type: text/html; charset=utf-8');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Document</title>
</head>
<body>
<form action="" method="POST" >
    <input type="submit" name="submit" value="Exit" class="bt" />
</form>
</body>
</html>
<?php
if(isset($_POST["submit"]))
{
    session_destroy();
    header("Location:/index.php");
    exit;
}
?>