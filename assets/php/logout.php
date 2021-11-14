<?php
session_start();
unset($_SESSION['e-wardId']);
unset($_SESSION['fname']);
unset($_SESSION['rid']);
unset($_SESSION['adminId']);
unset($_SESSION['aid']);
header("Location: ../../dashboard.php");
die();

?>