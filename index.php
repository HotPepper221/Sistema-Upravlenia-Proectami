<?php 
    session_start();
    if (!isset($_SESSION['username'])) {
        include('./assets/templates/user_reg.php');
        include('./assets/templates/user_auth.php');
    }
    else {
        include('./assets/templates/index.php');
    }
?>
