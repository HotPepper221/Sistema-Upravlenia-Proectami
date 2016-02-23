<?php
    session_start();
    include("db.php");
    $con = mysql_connect($server, $db_user, $db_pwd) or die ("Ошибка: ".mysql_error());
    mysql_select_db($db_name) or die ("Ошибка: ".mysql_error());
    
    mysql_query("set names utf8");
    if (empty($_GET['id'])) {
        die ('<script>window.history.back();</script>');
    }

    $query = "SELECT * FROM ".$projects_table_name." WHERE username = '".$_SESSION['username']."' AND id=".mysql_real_escape_string($_GET['id'])."";
    $result = mysql_query($query, $con) or die('Ошибка');
    if (mysql_num_rows($result)) {
        $query = "UPDATE ".$projects_table_name." SET status=1 WHERE username = '".$_SESSION['username']."' AND id=".mysql_real_escape_string($_GET['id'])."";
        $result = mysql_query($query, $con) or die('Ошибка');
        die('Проект переведён в статус "Завершено"!<script>setTimeout(function(){document.location.href = "/index.php"}, 1500);</script>');
    }
    echo 'Это не Ваш проект.<script>setTimeout(function(){document.location.href = "/index.php"}, 1500);</script>';
?>
