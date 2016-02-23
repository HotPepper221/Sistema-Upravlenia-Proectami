<?php 
    session_start();
    if (!isset($_SESSION['username'])) {
        echo '<script>document.location.href = "/";</script>';
    }
    elseif (!isset($_GET['id'])) {
        echo '<script>document.location.href = "/";</script>';
    }
    else {
        include("./assets/php_proccess/db.php");
        $con = mysql_connect($server, $db_user, $db_pwd) or die ("Ошибка: ".mysql_error());
mysql_select_db($db_name) or die ("Ошибка: ".mysql_error());

        $query = "SELECT * FROM ".$projects_table_name." WHERE username = '".$_SESSION['username']."' AND id=".mysql_real_escape_string($_GET['id'])."";
        $result = mysql_query($query, $con) or die('Ошибка');
        $row = mysql_fetch_array($result);
        if (mysql_num_rows($result)) {
            include('./assets/templates/yourproject.php');
        }
        else {
            $query = "SELECT * FROM ".$projects_table_name." WHERE id=".mysql_real_escape_string($_GET['id'])."";
            $result = mysql_query($query, $con) or die('Ошибка');
            $row = mysql_fetch_array($result);
            include('./assets/templates/anotherproject.php');
        } 
    }
?>
