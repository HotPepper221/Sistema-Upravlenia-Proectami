<?php
include("db.php");
$con = mysql_connect($server, $db_user, $db_pwd) or die ("Ошибка: ".mysql_error());
mysql_select_db($db_name) or die ("Ошибка: ".mysql_error());

mysql_query("set names utf8");
$username = mysql_real_escape_string($_POST["username"]);
$password = mysql_real_escape_string($_POST["password"]);

if (empty($username) || empty($password)) {
    echo '<script>document.location.href = "/index.php";</script>';
}
	
$query = "SELECT * FROM ".$users_table_name." WHERE username = '$username'";
$result = mysql_query($query, $con) or die('Ошибка');

if (mysql_num_rows($result)) {
    die('Такой пользователь уже существует<script>setTimeout(function(){document.location.href = "/index.php"}, 1500);</script>');
}  

$hashed_password = crypt($password); 
$query = "INSERT INTO ".$users_table_name." (username, password) VALUES ('$username', '$hashed_password')";
	
if (!mysql_query($query,$con)) {
    die('Ошибка: ' . mysql_error());
}

echo 'Вы успешно зарегистрированы!<script>setTimeout(function(){document.location.href = "/index.php"}, 1500);</script>';
?>
