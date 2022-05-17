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
        //Fetch User data
        $wardno=$_SESSION['wardno'];

        //Fetch committee data
        $commDataQuery="SELECT `c_name`, `c_description`, `c_photo`, `m_limit`, `m_joined`, `added_by`, `status` FROM `tbl_committee` WHERE `c_id`='$c_id'";
        $commDataQueryResult = mysqli_query($conn, $commDataQuery);
        $commData=mysqli_fetch_assoc($commDataQueryResult);
        $c_name = $commData['c_name'];

        //Fetch task data
        $taskDataQuery="SELECT `task_name`, `task_des`, `created_by`, `created_date`, `deadline` FROM `tbl_task` WHERE `c_id`='$c_id' AND `id`='$tsk_id'";
        $taskDataQueryResult = mysqli_query($conn, $taskDataQuery);
        $taskData=mysqli_fetch_assoc($taskDataQueryResult);
        $t_name = $taskData['task_name'];
        $t_des = $taskData['task_des'];
        $crt_by = $taskData['created_by'];
        $crt_date = $taskData['created_date'];
        $deadline = $taskData['deadline'];

        //Fetch ward member data
        $wmDataQuery="SELECT `fullname` FROM `tbl_ward_member` WHERE `wardno`='$crt_by'";
        $wmDataQueryResult = mysqli_query($conn, $wmDataQuery);
        $wmData=mysqli_fetch_assoc($wmDataQueryResult);
        $crt_name = $wmData['fullname'];

       
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
        <link rel="stylesheet" href="../../../../public/assets/css/ward_member/wm_view_task.css">
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
                        Committees
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
                    <a href="./committees.php" class="previous">
                        Committees
                    </a>
                    <svg class="str" width="8" height="10" viewBox="0 0 8 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.2002 8.59999L5.8002 4.99999L2.2002 1.39999" stroke="#1E1E1E" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <a href="./view_committee.php?c_id=<?php echo $c_id ?>" class="previous">
                        <?php echo $c_name ?>
                    </a>
                    <svg class="str" width="8" height="10" viewBox="0 0 8 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.2002 8.59999L5.8002 4.99999L2.2002 1.39999" stroke="#1E1E1E" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <a href="" class="now">
                        <?php echo $t_name ?>
                    </a>
                </div>

                <!-- content -->
                <div class="task-det">
                    <div class="card1">
                        <div class="content">
                            <div class="heading">
                                <?php echo $t_name ?>
                            </div>
                            <div class="description">
                                <?php echo $t_des ?>
                            </div>
                        </div>
                    </div>
                    <div class="card2">
                        <div class="heading">
                            Other details
                        </div>
                        <div class="content">
                            <div class="right">
                                <div class="detail">Created by: <span><?php echo $crt_name ?></span></div>
                                <div class="detail">Created on: <span><?php echo $crt_date ?></span></div>
                            </div>
                            <div class="left">
                                <div class="divider"></div>
                                <div class="details">
                                    <div class="detail">Deadline: <span><?php echo $deadline ?></span></div>
                                    <div class="detail">Created on: <span><?php echo $crt_date ?></span></div>
                                </div>
                            </div>
                        </div>
                        <div class="buttons">
                            <input type="button" value="Update" class="secondary-btn">
                            <input type="button" value="Close" class="secondary-btn red-btn">
                        </div>
                    </div>
                </div>

                <!-- Add members -->
                <div class="title">
                    Members
                </div>
                <div class="members-list">
                    <div class="members">
                        <a class="add-member">
                            <div class="icon">
                                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path class="str" d="M15 6.25V23.75" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path class="str" d="M6.25 15H23.75" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <div class="text">Add members</div>
                        </a>

                        <!-- Fetch members -->
                        <a href="./task_approval.php" class="member">
                            <div class="photo">
                                <img src="../../../../public/assets/images/uploads/photos/1637689638.png" alt="member photo">
                            </div>
                            <div class="about">
                                <div class="name">Wade Warren</div>
                                <div class="tag" style="color:#1BBD2B; background:#DDF5DF;">Completed</div>
                            </div>
                        </a>

                        <a href="./task_approval.php" class="member">
                            <div class="photo">
                                <img src="../../../../public/assets/images/uploads/photos/1645631386.png" alt="member photo">
                            </div>
                            <div class="about">
                                <div class="name">Annette Black</div>
                                <div class="tag" style="color:#EC0000; background:#FCD9D9;">Incomplete</div>
                            </div>
                        </a>

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