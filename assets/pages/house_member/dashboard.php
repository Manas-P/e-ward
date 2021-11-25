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
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>E Ward</title>
        <link rel="shortcut icon" href="../../images/fav.svg" type="image/x-icon">
        <link rel="stylesheet" href="../../styles/hm_dashbored.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    </head>
    <body>
        <!-- Check if the user entered house details -->
        <?php
            $checkQuery="SELECT * FROM `tbl_house` WHERE `rid`=$rid";
            $checkResult=mysqli_query($conn,$checkQuery);
            if(mysqli_num_rows($checkResult)==0){
        ?>
        <!-- Update profile -->


        <section class="main">
            <!-- ==========Sidebar============= -->
            <?php
                include '../../include/house_member/sidebar_hm_update.php'
            ?>
            <!-- ==========Sidebar End============= -->
                
            <div class="container">
                <div class="header">
                    <div class="title">
                        Update house details
                    </div>
                </div>
                <!-- content -->
            </div>
        </section>
        <?php
            }else{
        ?>
        <!-- Dashboard -->

        <?php
            }
        ?>
    </body>
</html>
	<?php
}
?>