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
        //Fetch User data
        $wardno=$_SESSION['wardno'];

        //Fetch committee data
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
        <link rel="stylesheet" href="../../../../public/assets/css/ward_member/wm_view_committee.css">
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
                    <a href="" class="now">
                        <?php echo $c_name ?>
                    </a>
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
                    <div class="other-content">
                        <div class="divider"></div>
                        <div class="contents">
                            <div class="content">Members limit:<span><?php echo $m_limit ?></span></div>
                            <div class="content">Members joined:<span><?php echo $m_joined ?></span></div>
                            <div class="content">Created by:<span><?php echo $addedName ?></span></div>
                        </div>
                    </div>
                    <div class="buttons">
                        <a href="../../../model/ward_member/reopen_c.php?c_id=<?php echo $c_id; ?>" class="update">Reopen</a>
                    </div>
                </div>

                <!-- Tab Menu -->
                <div class="tab-menu">
                    <div class="tabs">
                        <div id="tabBtn1" class="tab tab-active">
                            Members
                        </div>
                        <div id="tabBtn2" class="tab">
                            Committee tasks
                        </div>
                    </div>
                    <div class="underline"></div>
                </div>

                <!-- View members -->
                <div id="tabCon1" class="tab-content tab-con-active">
                    <div class="content-table">
                        <div class="headings">
                            <div>Slno.</div>
                            <div style="margin-left: 70px;">Name</div>
                            <div style="margin-left: 224px;">House no.</div>
                            <div style="margin-left: 79px;">Phone no.</div>
                            <div style="margin-left: 120px;">Email id</div>
                        </div>
                        <div class="datas">
                            <?php
                            //Fetch data id
                            $viewMemQuery="SELECT `userid`, `wardno` FROM `tbl_committee_req` WHERE `c_id`='$c_id' AND `status`='1'";
                            $viewMemQueryResult = mysqli_query($conn, $viewMemQuery);
                            $checkCount = mysqli_num_rows($viewMemQueryResult);
                            $i=1;
                            if($checkCount!=0){
                                while($comRow=mysqli_fetch_array($viewMemQueryResult)){
                                    $userid = $comRow['userid'];
                                    
                                    //Fetch user data
                                    $query="SELECT `house_no`, `fname`, `email`, `phno`, `dob` FROM `tbl_house_member` WHERE `userid`='$userid'";
                                    $result=mysqli_query($conn,$query);
                                    while($row=mysqli_fetch_array($result)){
                                        //Age
                                        $age = (date('Y') - date('Y',strtotime($row["dob"])));
                            ?>
                            <div class="data">
                                <table>
                                    <tr>
                                        <td width=110px><?php echo $i?>.</td>
                                        <td width=276px><?php echo $row["fname"]; ?></td>
                                        <td width=166px><?php echo $row["house_no"]; ?></td>
                                        <td width=208px><?php echo $row["phno"]; ?></td>
                                        <td width=452px><?php echo $row["email"]; ?></td>
                                    </tr>
                                </table>
                            </div>
                            <?php
                                    $i=$i+1;
                                    }
                                }
                            }else{
                            ?>
                            <div class="no-result"> No records </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <!-- End of view members -->

                <div id="tabCon2" class="tab-content">
                    <div class="committe-tasks">
                        <div class="tasks">
        
                            <!-- Fetch committee tasks -->
                            <?php
                                $fetchTask="SELECT `id`, `task_name`, `task_des`, `assignees`, `status` FROM `tbl_task` WHERE `c_id`='$c_id'";
                                $fetchTaskRes=mysqli_query($conn,$fetchTask);
                                while($taskRow=mysqli_fetch_array($fetchTaskRes)){
                            ?>
                                    <a href="./view_c_task.php?c_id=<?php echo $c_id ?>&tskId=<?php echo $taskRow['id']?>" class="task">
                                        <div class="about">
                                            <div class="name"><?php echo $taskRow['task_name']?></div>
                                            <div class="members-asgn"><span>Members assigned:</span><?php echo $taskRow['assignees']?></div>
                                            <?php
                                                if($taskRow['status']=='1'){
                                            ?>
                                                    <div class="sub">Status:<div class="tag" style="color:#1BBD2B; background:#DDF5DF;">Completed</div></div>
                                            <?php
                                                }else{
                                            ?>
                                                    <div class="sub">Status:<div class="tag" style="color:#EC0000; background:#FCD9D9;">Incomplete</div>
                                            <?php
                                                }
                                            ?>
                                            </div>
                                        </div>
                                    </a>
                            <?php
                                }
                            ?>

                        </div>
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

        <script src="../../../../public/assets/js/wm_view_c_committee.js"></script>
        <script src="../../../../public/assets/js/toast.js"></script>
    </body>
    </html>
<?php
    }
?>