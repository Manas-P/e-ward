<?php
session_start();
$fname=$_SESSION['fname'];
if (isset($_SESSION["e-wardId"]) != session_id()) {
    header("Location: ../pages/login.php");
    die();
}
else
{
	?>
	<html>
	<body>
	hi <?php echo $fname ?>
		<a href="../php/logout.php">Logout</body>
	</html>
	<?php
}
?>