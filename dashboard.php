<?php
session_start();
$fname=$_SESSION['fname'];
if (isset($_SESSION["e-wardId"]) != session_id()) {
    header("Location: ./index.php");
    die();
}
else
{
	?>
	<html>
	<body>
	hi <?php echo $fname ?>
		<a href="./assets/php/logout.php">Logout</body>
	</html>
	<?php
}
?>