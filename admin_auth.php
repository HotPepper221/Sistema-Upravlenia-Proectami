<?php
    session_start();
	include("db.php");

	$username = $_POST["username"];
	$password = $_POST["password"];
	
	if($username == $admin_user) {
	   if($password == $admin_password) {
		   $_SESSION['admin'] = $admin_user;
           $_SESSION['username'] = $admin_user;
           echo '<script>document.location.href = "/admin.php"</script>';
	   }
       else {
           echo '<br><br><center><h2>Неправильный логин и/или пароль</center></h2><script>setTimeout("document.location.href = \'/admin.php\'", 2000);</script>';   
       }
    }
    else {
        echo '<br><br><center><h2>Неправильный логин и/или пароль</center></h2><script>setTimeout("document.location.href = \'/admin.php\'", 2000);</script>';   
    }
?>
