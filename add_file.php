<?php
session_start();
include("db.php");
$con = mysql_connect($server, $db_user, $db_pwd) or die ("Ошибка: ".mysql_error());
mysql_select_db($db_name) or die ("Ошибка: ".mysql_error());
mysql_query("set names utf8");
$descrip = mysql_real_escape_string($_POST["descrip"]);
$id = mysql_real_escape_string($_GET["id"]);
if (file_exists("../../files/".$_FILES["filename"]["name"])) {
    $i = 2;
    $dot = strrpos($_FILES["filename"]["name"], '.');
    $lastname = substr($_FILES["filename"]["name"], $dot, strlen($_FILES["filename"]["name"])); 
    $firstname = substr($_FILES["filename"]["name"], 0, $dot); 
    while (file_exists("../../files/".$firstname.'.ver'.$i.$lastname)) {
        $i++;
    }
    $query = "UPDATE " . $files_table_name . " SET status='1' WHERE project_id='$id' AND file_with='".$_FILES["filename"]["name"]."' AND status='2'";
    mysql_query($query, $con);
    $status = 2;
    $query = "INSERT INTO " . $files_table_name . " (project_id, descrip, file, username, status, file_with) VALUES ('$id', '".$descrip."', '".$firstname.'.ver'.$i.$lastname."', '".$_SESSION['username']."', '$status', '".$_FILES["filename"]["name"]."')";
    move_uploaded_file($_FILES["filename"]["tmp_name"], "../../files/".$firstname.'.ver'.$i.$lastname);
}
else {
    $status = 2;
    $query = "INSERT INTO " . $files_table_name . " (project_id, descrip, file, username, status, file_with) VALUES ('$id', '".$descrip."', '".$_FILES["filename"]["name"]."', '".$_SESSION['username']."', '$status', '".$_FILES["filename"]["name"]."')";
    move_uploaded_file($_FILES["filename"]["tmp_name"], "../../files/".$_FILES["filename"]["name"]);
}

if (empty($descrip)) {
    echo '<script>document.location.href = "/index.php";</script>';
}

if (!mysql_query($query,$con)) {
    die('Ошибка: ' . mysql_error() . $query);
}

echo 'Файл успешно добавлен!<script>setTimeout(function(){window.history.back()}, 1500);</script>';
?>
