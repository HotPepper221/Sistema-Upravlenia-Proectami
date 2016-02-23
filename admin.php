<?php 
    session_start();
    if (!isset($_SESSION['admin'])) {
        include('./assets/templates/admin_auth.php');
    }
    else {
        include('./assets/templates/admin_dashboard.php');
    }
?>
