<?php
    session_start();
    include("db.php");
    $con = mysql_connect($server, $db_user, $db_pwd) or die ("РћС€РёР±РєР°: ".mysql_error());
    mysql_select_db($db_name) or die ("РћС€РёР±РєР°: ".mysql_error());
    
    mysql_query("set names utf8");
    if (empty($_GET['username']) || empty($_GET['id'])) {
        die('<script>window.history.back();</script>');
    }

    $query = "UPDATE ".$projects_table_name." SET party=CONCAT(party,  '".mysql_real_escape_string($_GET['username'])."', ';') WHERE id=".mysql_real_escape_string($_GET['id'])."";
    $result = mysql_query($query, $con) or die(mysql_error());
    die('Р’С‹ РІСЃС‚СѓРїРёР»Рё РІ РїСЂРѕРµРєС‚!<script>setTimeout(function(){window.history.back()}, 1500);</script>');
?>
