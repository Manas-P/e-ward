<?php
session_start();
if (isset($_SESSION["e-wardId"]) != session_id()) {
    header("Location: ./index.php");
    die();
}
else
{
	?>
	<html>
	<body>
	hi
<a href="./logout.php">Logout</body>
	</html>
	<?php
}
?>