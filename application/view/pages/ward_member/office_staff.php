<?php
    include '../../../config/dbcon.php';
    session_start();
    //Check login
    if (isset($_SESSION["sessionId"]) != session_id()) {
        header("Location: ../login/login.php");
        die();
    }
    else
    {
        //Fetch User data
        $wardno=$_SESSION['wardno'];
        $staffId=$_GET['id'];
        $staffData="SELECT `name` FROM `tbl_office_staff` WHERE `userid`='$staffId' AND `status`='1'";
        $staffDataResult=mysqli_query($conn,$staffData);
        $staff=mysqli_fetch_assoc($staffDataResult);
        $sName=$staff['name'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="../../../../public/assets/images/fav.svg" type="image/x-icon">
        <link rel="stylesheet" href="../../../../public/assets/css/ward_member/view_office_staff.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <title>Ward <?php echo $wardno; ?> || Staff</title>
    </head>
    <body>
        <section class="main">
            <!-- ==========Sidebar============= -->
            <?php
            include '../../layout/ward_member/sidebar_office_staff.php';
            ?>
            <!-- ==========Sidebar End============= -->
            <div class="container">
                <div class="header">
                    <div class="title">
                        Office staff
                    </div>
                </div>
                <div class="bread-crumbs">
                    <a href="./add_office_staff.php" class="previous">
                        Office staffs
                    </a>
                    <svg class="str" width="8" height="10" viewBox="0 0 8 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.2002 8.59999L5.8002 4.99999L2.2002 1.39999" stroke="#1E1E1E" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <a href="" class="now">
                        <?php echo $sName; ?>
                    </a>
                </div>
                <!-- Content -->
                <div class="details-box">
                    <div class="l-content">
                        <div class="detail">
                            <div class="img">
                                <img src="../../../../public/assets/images/uploads/photos/1637437604.png" alt="">
                            </div>
                            <div class="info">
                                <div class="con">Wade Warren</div>
                                <div class="con-fade">wadewarren@gmai.com</div>
                                <div class="con-fade">+919854562325</div>
                            </div>
                        </div>
                        <div class="role">
                            <div class="line"></div>
                            <div class="roles">
                                <div class="resp">
                                    <div class="title">Manage houses:</div>
                                    <div class="sub">Eligible</div>
                                </div>
                                <div class="resp">
                                    <div class="title">Manage requests:</div>
                                    <div class="sub">Eligible</div>
                                </div>
                                <div class="resp">
                                    <div class="title">Manage committees:</div>
                                    <div class="sub">Eligible</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="r-content">
                        <a href="" class="update-btn">Update</a>
                        <a href="" class="remove-btn">Remove</a>
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