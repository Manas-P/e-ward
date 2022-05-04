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
    $user_id= $_SESSION['userid'];

    //check user
    $arr = str_split($user_id); // convert string to an array
    $chk= end($arr); // 0 = house head

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
        <link rel="stylesheet" href="../../../../public/assets/css/house_member/hm_street_light.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    </head>
    <body>
        <section class="main">
            <!-- ==========Sidebar============= -->
            <?php
                include '../../layout/house_member/sidebar_street_light.php'
            ?>
            <!-- ==========Sidebar End============= -->
            <div class="container">
                <div class="header">
                    <div class="title">
                        Street light
                    </div>
                </div>
                <!-- content -->
                <?php
                    $streetLightData="SELECT `street_light`, `street_light_status`, `post_no` FROM `tbl_house` WHERE `house_no`='$houseno'"; 
                    $streetLightDataResult=mysqli_query($conn,$streetLightData);
                    $data=mysqli_fetch_assoc($streetLightDataResult); 
                    $postNo=$data['post_no'];
                    $status=$data['street_light_status'];
                ?>
                <div class="street-light">
                    <div class="img">
                        <?php
                            if($status!='0'){
                        ?>
                            <img src="../../../../public/assets/images/active-street-light.svg" alt="Active street light">
                        <?php
                            }else{
                        ?>
                            <img src="../../../../public/assets/images/inactive-street-light.svg" alt="Inactive street light">
                        <?php
                            }
                        ?>
                    </div>
                    <div class="data">
                        <div class="detail">
                            <div class="post">Post number:</div>
                            <div class="numb"><?php echo $postNo ?></div>
                        </div>
                        <?php
                            if($status!='0'){
                        ?>
                            <a href="../../../model/house_member/street_light.php?no=<?php echo $postNo ?>" class="req-btn">Request repair</a>
                        <?php
                            }else{
                        ?>
                            <div class="req-btn2">Repair requested</div>
                        <?php
                            }
                        ?>
                        
                    </div>
                </div>
                

            </div>
        </section>
        

        <!-- Error Toast -->
        <?php
        if (isset($_SESSION['error'])) {
            $msg=$_SESSION['error'];
          echo " <div class='alertt alert-visible'>
                        <div class='econtent'>
                            <img src='../../../../public/assets/images/warning.svg' alt='warning'>
                            <div class='text'>
                                $msg
                            </div>
                        </div>
                        <img src='../../../../public/assets/images/close.svg' alt='close' class='alert-close'>
                    </div>";
          unset($_SESSION['error']);
        }?>

        <!-- Success toast -->
        <?php
            if (isset($_SESSION['success'])) {
                $msg=$_SESSION['success'];
                echo " <div class='alertt alert-visible' style='border-left: 10px solid #1BBD2B;'>
                            <div class='econtent'>
                                <img src='../../../../public/assets/images/check.svg' alt='success'>
                                <div class='text'>
                                    $msg
                                </div>
                            </div>
                            <img src='../../../../public/assets/images/close.svg' alt='close' class='alert-close'>
                        </div>";
                unset($_SESSION['success']);
        }?>


            <!-- ==========Loading============= -->
            <?php
                include '../../includes/loading.php';
            ?>
            <!-- ==========Loading End============= -->
        
        <script src="../../../../public/assets/js/toast.js"></script>
    </body>
    
</html>
	<?php
}
?>