<?php
    session_start();
    session_unset();  
    header("Location: ../../assets/pages/login.php");
    die();
?>