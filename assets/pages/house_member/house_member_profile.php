<?php
session_start();
include '../../include/dbcon.php';
if (isset($_SESSION["e-wardId"]) != session_id()) {
    header("Location: ../login.php");
    die();
}
else
{
    $fname=$_SESSION['fname'];
    $rid=$_SESSION['rid'];
    $houseno= $_SESSION['houseno'];
    $wardno= $_SESSION['wardno'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>E Ward</title>
        <link rel="shortcut icon" href="../../images/fav.svg" type="image/x-icon">
        <link rel="stylesheet" href="../../styles/hm_profile.css">
    </head>
    <body>
        <section class="main">
            <!-- ==========Sidebar============= -->
            <?php
                include '../../include/house_member/sidebar_hm_add_members.php'
            ?>
            <!-- ==========Sidebar End============= -->
            <div class="container">
                <h1>Hello</h1>
            </div>
        </section>
    </body>
</html>
	<?php
}
?>