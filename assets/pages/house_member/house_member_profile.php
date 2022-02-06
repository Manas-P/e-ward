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
    $houseno= $_SESSION['houseno'];
    $wardno= $_SESSION['wardno'];

    //Fetch house member details
    $hm_id=$_GET['id'];
    $hm_data="SELECT * FROM `tbl_house_member` WHERE `hm_id`='$hm_id'";
    $dataResult=mysqli_query($conn,$hm_data);
    while ($row = mysqli_fetch_assoc($dataResult))
    {
        $photo=$row['photo'];
        $name= $row['fname'];
        $dob=$row['dob'];
        $blood=$row['blood_grp'];
        $email=$row['email'];
        $phno=$row['phno'];
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
                            <a href="#general" class="active">General informations</a>
                            <a href="#" >Identity proofs</a>
                            <a href="#" >Educational background</a>
                            <a href="#" >Professional background</a>
                        </div>
                    </div>
                </div>
                
                <div class="right">

                    <!-- General Indormation -->
                    <section class="general" id="general">
                        <div class="header">
                            <div class="heading">
                                General informations
                            </div>
                            <div class="edit">
                                <a href="#">
                                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10.0833 3.77783H3.66659C3.18036 3.77783 2.71404 3.97099 2.37022 4.3148C2.02641 4.65862 1.83325 5.12494 1.83325 5.61117V18.4445C1.83325 18.9307 2.02641 19.397 2.37022 19.7409C2.71404 20.0847 3.18036 20.2778 3.66659 20.2778H16.4999C16.9861 20.2778 17.4525 20.0847 17.7963 19.7409C18.1401 19.397 18.3333 18.9307 18.3333 18.4445V12.0278" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M16.9583 2.40286C17.3229 2.03818 17.8175 1.83331 18.3333 1.83331C18.849 1.83331 19.3436 2.03818 19.7083 2.40286C20.0729 2.76753 20.2778 3.26213 20.2778 3.77786C20.2778 4.29358 20.0729 4.78818 19.7083 5.15286L10.9999 13.8612L7.33325 14.7779L8.24992 11.1112L16.9583 2.40286Z" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <div class="information">
                            <div class="photo">
                                <img src="../<?php echo $photo; ?>" alt="">
                            </div>
                            <div class="content">
                                <div class="title">
                                    Name:
                                </div>
                                <div class="info">
                                    <?php echo $name; ?>
                                </div>
                            </div>
                            <div class="content">
                                <div class="title">
                                    Date of birth:
                                </div>
                                <div class="info">
                                    <?php echo $dob; ?>
                                </div>
                            </div>
                            <div class="content">
                                <div class="title">
                                    Blood group:
                                </div>
                                <div class="info">
                                    <?php echo $blood; ?>
                                </div>
                            </div>
                            <div class="content">
                                <div class="title">
                                    Email id:
                                </div>
                                <div class="info">
                                    <?php echo $email; ?>
                                </div>
                            </div>
                            <div class="content">
                                <div class="title">
                                    Phone number:
                                </div>
                                <div class="info">
                                    <?php echo $phno; ?>
                                </div>
                            </div>
                        </div>
                    </section>



                </div>
            </div>
        </section>
    </body>
    <script src="../../js/hm_profile.js"></script>
</html>
	<?php
}
?>