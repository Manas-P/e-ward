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
        $c_id=$_GET['c_id'];
        $tsk_id=$_GET['tskId'];
        $userid=$_GET['userid'];
        //Fetch User data
        $wardno=$_SESSION['wardno'];

        //Fetch task details
        $taskDataQuery="SELECT `task_name` FROM `tbl_task` WHERE `c_id`='$c_id' AND `id`='$tsk_id'";
        $taskDataQueryResult = mysqli_query($conn, $taskDataQuery);
        $taskData=mysqli_fetch_assoc($taskDataQueryResult);
        $t_name = $taskData['task_name'];

        //Fetch committee data
        $commDataQuery="SELECT `c_name` FROM `tbl_committee` WHERE `c_id`='$c_id'";
        $commDataQueryResult = mysqli_query($conn, $commDataQuery);
        $commData=mysqli_fetch_assoc($commDataQueryResult);
        $c_name = $commData['c_name'];

        //Fetch user data
        $userDataQuery="SELECT `fname` FROM `tbl_house_member` WHERE `userid`='$userid'";
        $userDataQueryResult = mysqli_query($conn, $userDataQuery);
        $userData=mysqli_fetch_assoc($userDataQueryResult);
        $u_name = $userData['fname'];
?>
	<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="../../../../public/assets/images/fav.svg" type="image/x-icon">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../../../../public/assets/css/ward_member/wm_task_approval.css">
        <title>Ward <?php echo $wardno; ?> || Committees</title>
    </head>
    <body>
	    <section class="main">
            <!-- ==========Sidebar============= -->
            <?php
                include '../../layout/ward_member/sidebar_committees.php';
            ?>
            <!-- ==========Sidebar End============= -->
            <div class="container">
                <div class="header">
                    <div class="title">
                        Closed committees
                    </div>
                    <div class="search">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path class="str" d="M8.25 14.25C11.5637 14.25 14.25 11.5637 14.25 8.25C14.25 4.93629 11.5637 2.25 8.25 2.25C4.93629 2.25 2.25 4.93629 2.25 8.25C2.25 11.5637 4.93629 14.25 8.25 14.25Z" stroke="#B1B1B1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path class="str" d="M15.7498 15.75L12.4873 12.4875" stroke="#B1B1B1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>                        
                        <input type="text" name="hsearch" placeholder="Search..." id="live-search" autocomplete="off" onkeyup="searchHouse(this.value)">
                    </div>
                </div>
                <div class="bread-crumbs">
                    <a href="./closed_committees.php" class="previous">
                        Closed committees
                    </a>
                    <svg class="str" width="8" height="10" viewBox="0 0 8 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.2002 8.59999L5.8002 4.99999L2.2002 1.39999" stroke="#1E1E1E" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <a href="./view_c_committee.php?c_id=<?php echo $c_id ?>" class="previous">
                        <?php echo $c_name;?>
                    </a>
                    <svg class="str" width="8" height="10" viewBox="0 0 8 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.2002 8.59999L5.8002 4.99999L2.2002 1.39999" stroke="#1E1E1E" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <a href="./view_c_task.php?c_id=<?php echo $c_id;?>&tskId=<?php echo $tsk_id;?>" class="previous">
                        <?php echo $t_name;?>
                    </a>
                    <svg class="str" width="8" height="10" viewBox="0 0 8 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.2002 8.59999L5.8002 4.99999L2.2002 1.39999" stroke="#1E1E1E" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <a href="" class="now">
                        <?php echo $u_name;?>
                    </a>
                </div>

                <!-- content -->
                <!-- Tab Menu -->
                <div class="tab-menu">
                    <div class="tabs">
                        <div id="tabBtn1" class="tab tab-active">
                            Pending approval
                        </div>
                        <div id="tabBtn2" class="tab">
                            Approved work
                        </div>
                        <div id="tabBtn3" class="tab">
                            Rejected work
                        </div>
                    </div>
                    <div class="underline"></div>
                </div>

                <!-- Pending approval -->
                <div id="tabCon1" class="tab-content tab-con-active">
                    <div class="cards">
                        <?php
                            $fetchTskRep="SELECT `id`, `title`, `description`, `date`, `photo1`, `photo2`, `photo3`, `status` FROM `tbl_task_report` WHERE `tsk_id`='$tsk_id' AND `com_id`='$c_id' AND `userid`='$userid' AND `status`='0'";
                            $fetchTskRepResult = mysqli_query($conn, $fetchTskRep);
                            $checkCount = mysqli_num_rows($fetchTskRepResult);
                            if($checkCount!=0){
                                while($row=mysqli_fetch_array($fetchTskRepResult)){
                                    $date=$row["date"];
                                    $date=date_format (new DateTime($date), 'd-m-Y');
                        ?>
                        <div class="card">
                            <div class="header">
                                <div class="title">
                                    <?php echo $row["title"]; ?>
                                </div>
                                <div class="date">
                                    <?php echo $date; ?>
                                </div>
                            </div>
                            <div class="description">
                                <?php echo $row["description"]; ?>
                            </div>
                            <div class="photos">
                                <div class="title">
                                    Photos
                                </div>
                                <div class="images">
                                    <div class="img">
                                        <img src="../<?php echo $row['photo1']; ?>" alt="">
                                    </div>
                                    <div class="img">
                                        <img src="../<?php echo $row['photo2']; ?>" alt="">
                                    </div>
                                    <div class="img">
                                        <img src="../<?php echo $row['photo3']; ?>" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="underline">
                            </div>
                        </div>
                        <?php
                                }
                            }else{
                        ?>
                            <div class="no-result"> No records </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
                <!-- End of Pending approval -->

                <!-- Approved work -->
                <div id="tabCon2" class="tab-content">
                    <div class="cards">
                        <?php
                            $fetchTskRep="SELECT `id`, `title`, `description`, `date`, `photo1`, `photo2`, `photo3`, `status` FROM `tbl_task_report` WHERE `tsk_id`='$tsk_id' AND `com_id`='$c_id' AND `userid`='$userid' AND `status`='1'";
                            $fetchTskRepResult = mysqli_query($conn, $fetchTskRep);
                            $checkCount = mysqli_num_rows($fetchTskRepResult);
                            if($checkCount!=0){
                                while($row=mysqli_fetch_array($fetchTskRepResult)){
                                    $date=$row["date"];
                                    $date=date_format (new DateTime($date), 'd-m-Y');
                        ?>
                        <div class="card">
                            <div class="header">
                                <div class="title">
                                    <?php echo $row["title"]; ?>
                                </div>
                                <div class="date">
                                    <?php echo $date; ?>
                                </div>
                            </div>
                            <div class="description">
                                <?php echo $row["description"]; ?>
                            </div>
                            <div class="photos">
                                <div class="title">
                                    Photos
                                </div>
                                <div class="images">
                                    <div class="img">
                                        <img src="../<?php echo $row['photo1']; ?>" alt="">
                                    </div>
                                    <div class="img">
                                        <img src="../<?php echo $row['photo2']; ?>" alt="">
                                    </div>
                                    <div class="img">
                                        <img src="../<?php echo $row['photo3']; ?>" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                                }
                            }else{
                        ?>
                            <div class="no-result"> No records </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
                <!-- End of Approved work -->

                <!-- Rejected work -->
                <div id="tabCon3" class="tab-content">
                    <div class="cards">
                        <?php
                            $fetchTskRep="SELECT `id`, `title`, `description`, `date`, `photo1`, `photo2`, `photo3`, `status` FROM `tbl_task_report` WHERE `tsk_id`='$tsk_id' AND `com_id`='$c_id' AND `userid`='$userid' AND `status`='2'";
                            $fetchTskRepResult = mysqli_query($conn, $fetchTskRep);
                            $checkCount = mysqli_num_rows($fetchTskRepResult);
                            if($checkCount!=0){
                                while($row=mysqli_fetch_array($fetchTskRepResult)){
                                    $date=$row["date"];
                                    $date=date_format (new DateTime($date), 'd-m-Y');
                        ?>
                        <div class="card">
                            <div class="header">
                                <div class="title">
                                    <?php echo $row["title"]; ?>
                                </div>
                                <div class="date">
                                    <?php echo $date; ?>
                                </div>
                            </div>
                            <div class="description">
                                <?php echo $row["description"]; ?>
                            </div>
                            <div class="photos">
                                <div class="title">
                                    Photos
                                </div>
                                <div class="images">
                                    <div class="img">
                                        <img src="../<?php echo $row['photo1']; ?>" alt="">
                                    </div>
                                    <div class="img">
                                        <img src="../<?php echo $row['photo2']; ?>" alt="">
                                    </div>
                                    <div class="img">
                                        <img src="../<?php echo $row['photo3']; ?>" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                                }
                            }else{
                        ?>
                            <div class="no-result"> No records </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
                <!-- End of Rejected work -->
                
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

        <script src="../../../../public/assets/js/wm_task_approval.js"></script>
        <script src="../../../../public/assets/js/toast.js"></script>
    </body>
    </html>
<?php
    }
?>