<?php
    session_start();
    include("db.php");
	$con = mysql_connect($server, $db_user, $db_pwd) or die ("Ошибка: ".mysql_error());
    mysql_select_db($db_name) or die ("Ошибка: ".mysql_error());
    mysql_query("set names utf8"); 
    
	$username = mysql_real_escape_string(htmlspecialchars($_POST["username"]));
	$password = mysql_real_escape_string(htmlspecialchars($_POST["password"]));

    if (empty($username) || empty($password)) {
        echo '<script>document.location.href = "/index.php";</script>';
        die();
    }
	
	$query = "SELECT * FROM " . $users_table_name . " WHERE username = '$username'";
	$result = mysql_query($query, $con) or die('Ошибка');
    if (mysql_num_rows($result)) {
		$query = "SELECT password FROM " . $users_table_name . " WHERE username = '$username'";
	    $result = mysql_query($query, $con) or die('Ошибка');
		$db_field = mysql_fetch_assoc($result);
		$hashed_password = crypt($password, $db_field['password']);
		
 		$query = "SELECT * FROM " . $users_table_name . " WHERE username = '$username' AND password = '$hashed_password'";
		$result = mysql_query($query, $con) or die('Ошибка');
		if (mysql_num_rows($result)) {
            $query = "UPDATE " . $users_table_name . " SET last_login_date=CURRENT_TIMESTAMP WHERE username='$username'";
		    $result = mysql_query($query, $con) or die('Ошибка');
		    $_SESSION['username'] = $username;
		    echo '<script>document.location.href = "/index.php";</script>';
		}
        else {
            echo '<br><br><center><h2>Неверный логин и/или пароль</h2></center><script>setTimeout(function(){document.location.href = "/index.php"}, 1500);</script>';
	    }
    }	
	else {
	   echo '<br><br><center><h2>Неверный логин и/или пароль</h2></center><script>setTimeout(function(){document.location.href = "/index.php"}, 1500);</script>';
	   die();
	}
?>
