<?php
include '../../../config/dbcon.php';
session_start();
if (isset($_SESSION["sessionId"]) != session_id()) {
    header("Location: ../login/login.php");
    die();
}
else
{
    $fname=$_SESSION['fname'];
    $houseno= $_SESSION['houseno'];
    $wardno= $_SESSION['wardno'];

    //slice first name of user
    $slices=explode(" ", $fname);
    $firstName=$slices[0];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>E Ward</title>
        <link rel="shortcut icon" href="../../../../public/assets/images/fav.svg" type="image/x-icon">
        <link rel="stylesheet" href="../../../../public/assets/css/house_member/hm_dashbored.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    </head>
    <body>
        <!-- Check if the user entered house details -->
        <?php
            $checkQuery="SELECT `hid` FROM `tbl_house` WHERE `ward_no`='$wardno' and `house_no`='$houseno'";
            $checkResult=mysqli_query($conn,$checkQuery);
            if(mysqli_num_rows($checkResult)==0){
        ?>
        <!-- Add house info -->

        <section class="main">
            <!-- ==========Sidebar============= -->
            <?php
                include '../../layout/house_member/sidebar_hm_update.php';
            ?>
            <!-- ==========Sidebar End============= -->
                
            <div class="container">
                <div class="header">
                    <div class="title">
                        Add house details
                    </div>
                </div>
                <!-- content -->
                <div class="update-form">
                    <div class="register-text">
                        <div class="title">
                            House details
                        </div>
                    </div>

                    <?php
                        $query="SELECT * FROM `tbl_house_member` WHERE `ward_no`=$wardno and `house_no`=$houseno";
                        $result=mysqli_query($conn,$query);
                        while($row=mysqli_fetch_array($result)){
                    ?>

                    <form id="reg-form" action="../../php/auth.php" method="post" enctype="multipart/form-data">
                        <div class="inputs">
                            <input type="text" name="wardno" value="<?php echo $row['ward_no']; ?>" style="display: none;">
                            <div class="input housename">
                                <div class="label">
                                    House name
                                </div>
                                <input type="text" name="hname" id="house-name" placeholder="Dream house" autocomplete="off">
                                <div class="error error-hidden">
                                    
                                </div>
                            </div>
                            <div class="input houseno">
                                <div class="label">
                                    House number
                                </div>
                                <input type="text" name="houno" id="house-number" placeholder="153" value="<?php echo $row['house_no']; ?>" autocomplete="off" readonly>
                                <div class="error error-hidden">
                                </div>
                            </div>
                            <div class="input locality">
                                <div class="label">
                                    Locality
                                </div>
                                <input type="text" name="locality" id="locality-id" placeholder="7529 E. Pecan St." autocomplete="off">
                                <div class="error error-hidden">
                                </div>
                            </div>
                            <div class="input po">
                                <div class="label">
                                    Post office
                                </div>
                                <input type="text" name="po" id="por" placeholder="Baton Rouge (LA)" autocomplete="off">
                                <div class="error error-hidden">
                                </div>
                            </div>
                            <div class="input rationno">
                                <div class="label">
                                    Ration number
                                </div>
                                <input type="text" name="rano" id="ration-number" placeholder="2547863214" autocomplete="off">
                                <div class="error error-hidden">
                                </div>
                            </div>
                            <div class="radios">
                                <div class="radio">
                                    <input type="radio" id="apl" name="rationCat" value="APL" checked>
                                    <label for="apl">APL</label>
                                </div>
                                <div class="radio">
                                    <input type="radio" id="bpl" name="rationCat" value="BPL">
                                    <label for="bpl">BPL</label>
                                </div>
                            </div>
                            <div class="button ubn cursor-disable">
                                <input type="submit" value="Add details" name="upbtn" id="up-btn" class="primary-button disabled">
                            </div>
                        </div>
                    </form>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </section>
        <?php
            }else{
        ?>
        <!-- Dashboard -->
        <section class="dashboard">
            <!-- ==========Sidebar============= -->
            <?php
                include '../../layout/house_member/sidebar_hm_dashboard.php';
            ?>
            <!-- ==========Sidebar End============= -->
            <div class="container">
                <div class="header">
                    <div class="title">
                        Dashboard
                    </div>
                </div>
                <!-- content -->
            </div>
        </section>

        <?php
            }
        ?>
        <?php
            if (isset($_SESSION['loginMessage'])) {
                $msg=$_SESSION['loginMessage'];
                echo " <div class='alertt alert-visible' style='border-left: 10px solid #1BBD2B;'>
                            <div class='econtent'>
                                <img src='../../images/check.svg' alt='success'>
                                <div class='text'>
                                    $msg
                                </div>
                            </div>
                            <img src='../../images/close.svg' alt='close' class='alert-close'>
                        </div>";
                unset($_SESSION['loginMessage']);
        }?>
    </body>
    <script src="../../js/hm_dashboard.js"></script>
</html>
	<?php
}
?>