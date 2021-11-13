<?php
session_start();
unset($_SESSION['e-wardId']);
unset($_SESSION['fname']);
unset($_SESSION['rid']);
header("Location: ./dashboard.php");
die();

?>