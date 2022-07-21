<?php 
    session_start();
    $_SESSION["user_id"] = "";
    session_destroy();
    header("location: http://localhost/taskboard/header/login.php", true);
    exit();
?>