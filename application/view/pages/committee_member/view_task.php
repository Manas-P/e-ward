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

    $tskId=$_GET['tskId'];

    //Fetch user data
    $fetchUserQuery="SELECT `ward_no`, `house_no`, `fname` FROM `tbl_house_member` WHERE `userid`='$h_userid'";
    $fetchUserRes=mysqli_query($conn,$fetchUserQuery);
    $userData=mysqli_fetch_assoc($fetchUserRes);
    $fname = $userData['fname'];
    $wardno = $userData['ward_no'];

    //Fetch Committee details
    $commDataQuery="SELECT `c_name` FROM `tbl_committee` WHERE `c_id`='$c_id'";
    $commDataQueryResult = mysqli_query($conn, $commDataQuery);
    $commData=mysqli_fetch_assoc($commDataQueryResult);
    $c_name = $commData['c_name'];

    //Fetch task detail
    $fetchTskData="SELECT `task_name`, `task_des`, `created_by`, `created_date`, `deadline` FROM `tbl_task` WHERE `id`='$tskId'";
    $fetchTskDataRes=mysqli_query($conn, $fetchTskData);
    $tskData=mysqli_fetch_assoc($fetchTskDataRes);
    $tsk_name = $tskData['task_name'];
    $tsk_des = $tskData['task_des'];
    $tsk_crtBy = $tskData['created_by'];
    $tsk_cre = $tskData['created_date'];
    $tsk_dead = $tskData['deadline'];

    //Fetch the user who created the committee
    if($wardno == $tsk_crtBy){
        $wmNameQuery="SELECT `fullname` FROM `tbl_ward_member` WHERE `wardno`='$tsk_crtBy'";
        $wmNameQueryResult = mysqli_query($conn, $wmNameQuery);
        $wmData=mysqli_fetch_assoc($wmNameQueryResult);
        $addedName = $wmData['fullname'];
    }else{
        $osNameQuery="SELECT `name` FROM `tbl_office_staff` WHERE `userid`='$tsk_crtBy'";
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
        <link rel="stylesheet" href="../../../../public/assets/css/committee_member/cm_view_task.css">
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
                <div class="bread-crumbs">
                    <a href="./dashboard.php" class="previous">
                        <?php echo $c_name ?>
                    </a>
                    <svg class="str" width="8" height="10" viewBox="0 0 8 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.2002 8.59999L5.8002 4.99999L2.2002 1.39999" stroke="#1E1E1E" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <a href="" class="now">
                        <?php echo $tsk_name ?>
                    </a>
                </div>
                <!-- content -->
                <div class="task-det">
                    <div class="card1">
                        <div class="content">
                            <div class="heading">
                                <?php echo $tsk_name ?>
                            </div>
                            <div class="description">
                                <?php echo $tsk_des ?>
                            </div>
                        </div>
                    </div>
                    <div class="card2">
                        <div class="heading">
                            Other details
                        </div>
                        <div class="content">
                            <div class="right">
                                <div class="detail">Created by: <span><?php echo $addedName ?></span></div>
                                <div class="detail">Created on: <span><?php echo $tsk_cre ?></span></div>
                            </div>
                            <div class="left">
                                <div class="divider"></div>
                                <div class="details">
                                    <div class="detail">Deadline: <span><?php echo $tsk_dead ?></span></div>
                                    <div class="detail">Created on: <span><?php echo $tsk_cre ?></span></div>
                                </div>
                            </div>
                        </div>
                        <div class="buttons">
                            <a href="" class="secondary-btn">Mark as complete</a>
                        </div>
                    </div>
                </div>

                <div class="title">
                    Task report
                </div>
                <div class="add-task-report">
                    Add task report
                </div>

                <div class="report-cards">
                    <div class="report-card">
                        <div class="header">
                            <div class="r-title">Title of report</div>
                            <div class="date">22-05-2022</div>
                        </div>
                        <div class="r-description">
                            Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit
                            mollit. Exercitation veniam consequat sunt nostrud amet.Amet minim mollit non deserunt ullamco est sit aliqua dolor do
                            amet sint. Duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.Amet minim mollit non deserunt
                            ullamco est sit aliqua dolor do amet sint.
                        </div>
                        <div class="photosec">
                            <div class="p-title">Photos</div>
                            <div class="photos">
                                <div class="photo">
                                    <img src="../../../../public/assets/images/uploads/photos/1637438149.png" alt="">
                                </div>
                                <div class="photo">
                                    <img src="../../../../public/assets/images/uploads/photos/1637438149.png" alt="">
                                </div>
                                <div class="photo">
                                    <img src="../../../../public/assets/images/uploads/photos/1637438149.png" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="r-divider"></div>
                        <div class="bottom-sec">
                            <div class="status">
                                Status:<span class="pen">Pending approval</span>
                            </div>
                            <div class="delete-btn">
                                <svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="1" y="1" width="42" height="42" rx="9" fill="white" stroke="#EC0000" stroke-width="2"/>
                                    <path d="M13 16H15H31" stroke="#EC0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M17.9998 16.0001V14.0001C17.9998 13.4697 18.2105 12.961 18.5855 12.5859C18.9606 12.2108 19.4693 12.0001 19.9998 12.0001H23.9998C24.5302 12.0001 25.0389 12.2108 25.414 12.5859C25.789 12.961 25.9998 13.4697 25.9998 14.0001V16.0001M28.9998 16.0001V30.0001C28.9998 30.5306 28.789 31.0393 28.414 31.4143C28.0389 31.7894 27.5302 32.0001 26.9998 32.0001H16.9998C16.4693 32.0001 15.9606 31.7894 15.5855 31.4143C15.2105 31.0393 14.9998 30.5306 14.9998 30.0001V16.0001H28.9998Z" stroke="#EC0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M20.0002 21.0001V27.0001" stroke="#EC0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M23.9998 21.0001V27.0001" stroke="#EC0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
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
    <script src="../../../../public/assets/js/cm_dashboard.js"></script>
    <script src="../../../../public/assets/js/toast.js"></script>
</html>
	<?php
}
?>