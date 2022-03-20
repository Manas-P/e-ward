<?php
    session_start();
    session_unset();  
    header("Location: ../view/pages/login/login.php");
    die();
?>