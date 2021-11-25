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
                        Update Profile
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
                        $query="SELECT * FROM `tbl_registration` WHERE `rid`='$rid'";
                        $result=mysqli_query($conn,$query);
                        while($row=mysqli_fetch_array($result)){
                    ?>

                    <form id="reg-form" action="../../php/auth.php" method="post" enctype="multipart/form-data">
                        <div class="inputs">
                            <input type="text" name="rid" value="<?php echo $row['rid']; ?>" style="display: none;">
                            <input type="text" name="wardno" value="<?php echo $row['wardno']; ?>" style="display: none;">
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
                                <input type="text" name="houno" id="house-number" placeholder="153" value="<?php echo $row['houseno']; ?>" autocomplete="off" readonly>
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
                                <input type="text" name="rano" id="ration-number" placeholder="2547863214" value="<?php echo $row['rationno']; ?>" autocomplete="off" readonly>
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
                            <div class="button">
                                <input type="submit" value="Update" name="upbtn" id="up-btn" class="primary-button">
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
                include '../../include/house_member/sidebar_hm_dashboard.php'
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
    </body>
</html>
	<?php
}
?>