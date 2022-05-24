<?php
include '../../../config/dbcon.php';
session_start();
if (isset($_SESSION["sessionId"]) != session_id()) {
    header("Location: ../login/login.php");
    die();
}
else
{
    $c_id=$_SESSION['c_id'];
    $h_userid= $_SESSION['h_userid'];
    $c_userid= $_SESSION['c_userid'];

    //Fetch user data
    $fetchUserQuery="SELECT `ward_no`, `house_no`, `fname` FROM `tbl_house_member` WHERE `userid`='$h_userid'";
    $fetchUserRes=mysqli_query($conn,$fetchUserQuery);
    $userData=mysqli_fetch_assoc($fetchUserRes);
    $fname = $userData['fname'];
    $wardno = $userData['ward_no'];

    //Fetch Committee details
    $commDataQuery="SELECT `c_name`, `c_description`, `c_photo`, `m_limit`, `m_joined`, `added_by`, `status` FROM `tbl_committee` WHERE `c_id`='$c_id'";
    $commDataQueryResult = mysqli_query($conn, $commDataQuery);
    $commData=mysqli_fetch_assoc($commDataQueryResult);
    $c_name = $commData['c_name'];
    $c_des = $commData['c_description'];
    $c_photo = $commData['c_photo'];
    $m_limit = $commData['m_limit'];
    $m_joined = $commData['m_joined'];
    $added_by = $commData['added_by'];
    $status = $commData['status'];

    //Fetch the user who created the committee
    if($wardno == $added_by){
        $wmNameQuery="SELECT `fullname` FROM `tbl_ward_member` WHERE `wardno`='$added_by'";
        $wmNameQueryResult = mysqli_query($conn, $wmNameQuery);
        $wmData=mysqli_fetch_assoc($wmNameQueryResult);
        $addedName = $wmData['fullname'];
    }else{
        $osNameQuery="SELECT `name` FROM `tbl_office_staff` WHERE `userid`='$added_by'";
        $osNameQueryResult = mysqli_query($conn, $osNameQuery);
        $osData=mysqli_fetch_assoc($osNameQueryResult);
        $addedName = $osData['name'];
    }

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
        <link rel="stylesheet" href="../../../../public/assets/css/committee_member/cm_dashboard.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    </head>
    <body>
        <!-- Dashboard -->
        <section class="dashboard">
            <!-- ==========Sidebar============= -->
            <?php
                include '../../layout/committee_member/sidebar_dashboard.php';
            ?>
            <!-- ==========Sidebar End============= -->
            <div class="container">
                <div class="header">
                    <div class="title">
                        Welcome, <?php echo $fname ?>
                    </div>
                </div>
                <!-- content -->
                <div class="committee-details">
                    <div class="basic-description">
                        <div class="img">
                            <img src="../<?php echo $c_photo ?>" alt="committee photo">
                        </div>
                        <div class="description">
                            <div class="heading">
                                <?php echo $c_name ?>
                            </div>
                            <div class="det">
                                <?php echo $c_des?>
                            </div>
                        </div>
                    </div>
                    <div class="other-contents">
                        <div class="other-content">
                            <div class="divider"></div>
                            <div class="contents">
                                <div class="content">
                                    Members limit:<span><?php echo $m_limit ?></span>
                                </div>
                                <div class="content">
                                    Members joined:<span><?php echo $m_joined ?></span>
                                </div>
                                <div class="content">
                                    Status:<span>
                                        <?php
                                            if($status==1){
                                        ?>
                                        <span id="act">Active</span>
                                        <?php
                                            }else{
                                        ?>
                                        <span id="inact">Inactive</span>
                                        <?php
                                            }
                                        ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="other-content">
                            <div class="divider"></div>
                            <div class="contents">
                                <div class="content">
                                    Created by:<span><?php echo $addedName ?></span>
                                </div>
                                <div class="content">
                                    Created on:<span>22-05-2022</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


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
    </body>
    <script src="../../../../public/assets/js/toast.js"></script>
</html>
	<?php
}
?>