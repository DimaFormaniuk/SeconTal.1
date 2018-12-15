<?php
$mysqli=false;
function connectDB()
{
    global $mysqli;
    $mysqli= new mysqli("localhost","root","","secontal");
    //$mysqli->query('set character_set_results = "utf8"');
    $mysqli->query("SET NAMES 'utf8';");
    $mysqli->query("SET CHARACTER SET 'utf8';");
    $mysqli->query("SET SESSION collation_connection = 'utf8_general_ci';");
}
function closeDB()
{
    global $mysqli;
    $mysqli->close();
}
function getLog($dname)
{
    global $mysqli;
    connectDB();
    $result = $mysqli->query("SELECT * FROM `$dname`");
    closeDB();
    return resultToArray($result);
}
function getLog1($id)
{
    global $mysqli;
    connectDB();
    $result = $mysqli->query("SELECT * FROM `login` WHERE `id`=$id");
    closeDB();
    return resultToArray($result);
}
function pushLog($login,$pass,$priv){
//INSERT INTO `secontal`.`login` (`id`, `login`, `password`, `priv`) VALUES (NULL, 'dim', '1234', '0');
    global $mysqli;
    connectDB();
    $mysqli->query("INSERT INTO `secontal`.`login` (`id`, `login`, `password`, `priv`) VALUES (NULL, '$login', '$pass', '$priv');");
    closeDB();
}
function pushBuy($id,$idbuy)
{
//UPDATE `secontal`.`login` SET `korsina` = '12' WHERE `login`.`id` =9;
    global $mysqli;
    $r = getLog1($id);
    $s = "";
    if ($r[0]["korsina"] == "") $s = $s . $idbuy;
    else
        $s = $r[0]["korsina"] . " " . $idbuy;
    connectDB();
    $mysqli->query("UPDATE `secontal`.`login` SET `korsina` = '$s' WHERE `login`.`id` ='$id';");
    closeDB();
}
function delBuy($id,$idbuy)
{
//UPDATE `secontal`.`login` SET `korsina` = '12' WHERE `login`.`id` =9;
    global $mysqli;
    $r = getLog1($id);
    $s = "";
    $tr = 1;
    if ($r[0]["korsina"] != "") {
        $im = explode(" ", $r[0]["korsina"]);
        for ($i = 0; $i < count($im); $i++) {
            //if($im[$i]==$idbuy){unset($im[$i]);break;}
            if ($tr == 1 && $im[$i] == $idbuy) {
                $tr = 0;
            } else {
                if ($im[$i] != " ")
                    $s .= $im[$i] . " ";
            }
        }
        $s = trim($s, " ");
    }
    connectDB();
    $mysqli->query("UPDATE `secontal`.`login` SET `korsina` = '$s' WHERE `login`.`id` ='$id';");
    closeDB();
}

function pushTovar($idadd="0",$kategoria,$name,$opus,$cina,$foto=""){
//INSERT INTO `secontal`.`tovar` (`id`, `idadd`, `kategoria`, `name`, `opus`, `cina`, `foto`) VALUES (NULL, '1', 'Ноутбуки', 'lenovo', 'naus nout', '12000', 'f1.jpg');
    global $mysqli;
    connectDB();
    $mysqli->query("INSERT INTO `secontal`.`tovar` (`id`, `idadd`, `kategoria`, `name`, `opus`, `cina`, `foto`) VALUES (NULL, '$idadd', '$kategoria', '$name', '$opus', '$cina', '$foto');");
    closeDB();
}
function getTov($dname)
{
    global $mysqli;
    connectDB();
    $result = $mysqli->query("SELECT * FROM `$dname`");
    closeDB();
    return resultToArray($result);
}
//SELECT * FROM `tovar` WHERE `idadd` = '8'
function getTovar($idadd)
{
    global $mysqli;
    connectDB();
    $result = $mysqli->query("SELECT * FROM `tovar` WHERE `idadd` = '$idadd';");
    closeDB();
    return resultToArray($result);
}
function getTovarAll()
{
    global $mysqli;
    connectDB();
    $result = $mysqli->query("SELECT * FROM `tovar`;");
    closeDB();
    return resultToArray($result);
}
function getTovarCat($cat)
{
    global $mysqli;
    connectDB();
    $result = $mysqli->query("SELECT * FROM `tovar` WHERE `kategoria` = '$cat';");
    closeDB();
    return resultToArray($result);
}
function getTovarId($id)
{
    global $mysqli;
    connectDB();
    $result = $mysqli->query("SELECT * FROM `tovar` WHERE `id` = '$id';");
    closeDB();
    return resultToArray($result);
}
function getItem($id,$dname)
{
    global $mysqli;
    connectDB();
    $wher = "WHERE `id` =" . $id;
    $result = $mysqli->query("SELECT * FROM `$dname` $wher");
    closeDB();
    return $result->fetch_assoc();
}
//UPDATE `secontal`.`tovar` SET `kategoria` = 'Ноутбукил', `name` = 'tovar1',`opus` = 'new tovar12',`cina` = '1200,50' WHERE `tovar`.`id` =18;
function upTovar($id,$kategoria,$name,$opus,$cina)
{
    global $mysqli;
    connectDB();
    $mysqli->query("UPDATE `secontal`.`tovar` SET `kategoria` = '$kategoria', `name` = '$name',`opus` = '$opus',`cina` = '$cina' WHERE `tovar`.`id` ='$id';");
    closeDB();
}
//DELETE FROM `secontal`.`tovar` WHERE `tovar`.`id` = 18
function DeleteTovar($id)
{
    global $mysqli;
    connectDB();
    $mysqli->query("DELETE FROM `secontal`.`tovar` WHERE `tovar`.`id` ='$id';");
    closeDB();
}
function resultToArray($result)
{
    $array = array();
    while (($row = $result->fetch_assoc()) != false)
        $array[] = $row;
    return $array;
}
?>