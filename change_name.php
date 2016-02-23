<?php
session_start();

include("db.php");
$con = mysql_connect($server, $db_user, $db_pwd) or die ("РћС€РёР±РєР°: ".mysql_error());
mysql_select_db($db_name) or die ("РћС€РёР±РєР°: ".mysql_error());

mysql_query("set names utf8");
$name = mysql_real_escape_string($_POST["name"]);
$descrip = mysql_real_escape_string($_POST["descrip"]);
$id = mysql_real_escape_string($_GET['id']);

if (empty($name) || empty($descrip) || empty($id)) {
    echo '<script>window.history.back();</script>';
}
	
$query = "UPDATE " . $projects_table_name . " SET name='$name', descrip='$descrip' WHERE id='$id'";
	
if (!mysql_query($query,$con)) {
    die('РћС€РёР±РєР°: ' . mysql_error() . $query);
}

echo 'РџСЂРѕРµРєС‚ СѓСЃРїРµС€РЅРѕ РѕР±РЅРѕРІР»С‘РЅ!<script>setTimeout(function(){window.history.back();}, 1500);</script>';
?>
