<?php
session_start();

include("db.php");
$con = mysql_connect($server, $db_user, $db_pwd) or die ("РћС€РёР±РєР°: ".mysql_error());
mysql_select_db($db_name) or die ("РћС€РёР±РєР°: ".mysql_error());

mysql_query("set names utf8");
$password = mysql_real_escape_string($_POST["password"]);
$username = mysql_real_escape_string($_GET['username']);

if (empty($password)) {
    die('<script>window.history.back();</script>');
}
	
$query = "UPDATE " . $users_table_name . " SET password='".crypt($password)."' WHERE username='$username'";
	
if (!mysql_query($query,$con)) {
    die('РћС€РёР±РєР°: ' . mysql_error() . $query);
}

echo 'РџР°СЂРѕР»СЊ СѓСЃРїРµС€РЅРѕ РёР·РјРµРЅС‘РЅ!<script>setTimeout(function(){window.history.back();}, 1500);</script>';
?>
