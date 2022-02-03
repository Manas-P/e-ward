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

    //Fetch house member details
    $hm_id=$_GET['id'];
    $hm_data="SELECT * FROM `tbl_house_member` WHERE `hm_id`='$hm_id'";
    $dataResult=mysqli_query($conn,$hm_data);
    while ($row = mysqli_fetch_assoc($dataResult))
    {
        $name= $row['fname'];
    }
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

                <div class="left">
                    <!-- bread-crumbs -->
                    <div class="bread-crumbs">
                        <a href="./add_house_members.php" class="previous">
                            House members
                        </a>
                        <svg class="str" width="8" height="10" viewBox="0 0 8 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2.2002 8.59999L5.8002 4.99999L2.2002 1.39999" stroke="#1E1E1E" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <a href="" class="now">
                            <?php
                                echo $name;
                            ?>
                        </a>
                    </div>
                    <!-- menu -->
                    <div class="menu">
                        <div class="links">
                            <a href="#" class="active">General informations</a>
                            <a href="#" >Identity proofs</a>
                            <a href="#" >Educational background</a>
                            <a href="#" >Professional background</a>
                        </div>
                    </div>
                </div>
                
                <div class="right">
                    <h1 style="padding-bottom: 50px;">details</h1>
                </div>
            </div>
        </section>
    </body>
    <script src="../../js/hm_profile.js"></script>
</html>
	<?php
}
?>