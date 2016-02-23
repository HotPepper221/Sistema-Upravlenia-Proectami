<?php
session_start();

include("db.php");
$con = mysql_connect($server, $db_user, $db_pwd) or die ("РћС€РёР±РєР°: ".mysql_error());
mysql_select_db($db_name) or die ("РћС€РёР±РєР°: ".mysql_error());

mysql_query("set names utf8");
$file = mysql_real_escape_string($_GET["name"]);
$id = mysql_real_escape_string($_GET['id']);

if (empty($id)) {
    die('<script>window.history.back();</script>');
}
	
$query = "DELETE FROM " . $files_table_name . " WHERE id='$id'";
unlink('../../files/'.$file);
	
if (!mysql_query($query,$con)) {
    die('РћС€РёР±РєР°: ' . mysql_error() . $query);
}

echo 'Р¤Р°Р№Р» СѓРґР°Р»С‘РЅ!<script>setTimeout(function(){window.history.back();}, 1500);</script>';
?>
