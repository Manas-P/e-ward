<?php
session_start();
unset($_SESSION['e-wardId']);
unset($_SESSION['fname']);
unset($_SESSION['rid']);
unset($_SESSION['adminId']);
unset($_SESSION['aid']);
unset($_SESSION["memebrId"]);
header("Location: ../pages/login.php");
die();

?>