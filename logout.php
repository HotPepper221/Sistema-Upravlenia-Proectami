<?php
    session_start();

    if (isset($_SESSION['admin'])) {
        unset($_SESSION['admin']);
        session_start();
        session_destroy();
        die('<script>document.location.href = "/admin.php";</script>');
    }
    elseif (isset($_SESSION['username'])) {
        unset($_SESSION['username']);
        unset($_SESSION['type']);
        session_start();
        session_destroy();
        die('<script>document.location.href = "/index.php";</script>');
    }
    else {
        echo '<script>document.location.href = "/index.php";</script>';
    }
?>
