<?php
session_start();

include("db.php");
$con = mysql_connect($server, $db_user, $db_pwd) or die ("Ошибка: ".mysql_error());
mysql_select_db($db_name) or die ("Ошибка: ".mysql_error());

mysql_query("set names utf8");
$name = mysql_real_escape_string($_POST["name"]);
$descrip = mysql_real_escape_string($_POST["descrip"]);
$date_start = mysql_real_escape_string($_POST["date_start"]);
$date_end = mysql_real_escape_string($_POST["date_end"]);
$date_start = date_create($date_start);
$date_end = date_create($date_end);

if (empty($name) || empty($descrip) || empty($date_start) || empty($date_end)) {
    echo '<script>document.location.href = "/index.php";</script>';
}
	
$query = "INSERT INTO " . $projects_table_name . " (name, descrip, date_start, date_end, status, username) VALUES ('$name', '$descrip', '".date_format($date_start, 'Y-m-d')."', '".date_format($date_end, 'Y-m-d')."', 0, '".$_SESSION['username']."')";
	
if (!mysql_query($query,$con)) {
    die('Ошибка: ' . mysql_error() . $query);
}

echo 'Проект успешно добавлен!<script>setTimeout(function(){document.location.href = "/index.php"}, 1500);</script>';
?>
