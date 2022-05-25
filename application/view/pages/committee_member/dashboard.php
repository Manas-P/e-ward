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

                <!-- Tab Menu -->
                <div class="tab-menu">
                    <div class="tabs">
                        <div id="tabBtn1" class="tab tab-active">
                            Members
                        </div>
                        <div id="tabBtn2" class="tab">
                            Pending task
                        </div>
                        <div id="tabBtn3" class="tab">
                            Completed task
                        </div>
                        <div id="tabBtn4" class="tab">
                            Rejected task
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
                            <div style="margin-left: 232px;">House no.</div>
                            <div style="margin-left: 106px;">Phone no.</div>
                            <div style="margin-left: 169px;">Email id</div>
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
                                        <td width=284px><?php echo $row["fname"]; ?></td>
                                        <td width=194px><?php echo $row["house_no"]; ?></td>
                                        <td width=258px><?php echo $row["phno"]; ?></td>
                                        <td width=496px><?php echo $row["email"]; ?></td>
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

                <!-- Pending task -->
                <div id="tabCon2" class="tab-content">
                    <div class="pending-task">
                        <?php
                            //Fetch task id
                            $fetchTskId="SELECT `tsk_id` FROM `tbl_task_member` WHERE `userid`='$h_userid' AND `com_id`='$c_id' AND `status`='0'";
                            $fetchTskIdRes=mysqli_query($conn, $fetchTskId);
                            while($tskRow=mysqli_fetch_array($fetchTskIdRes)){
                                $tskId = $tskRow['tsk_id'];
                                //Fetch task data
                                $fetchTskData="SELECT `task_name`, `task_des`, `created_date`, `deadline` FROM `tbl_task` WHERE `id`='$tskId'";
                                $fetchTskDataRes=mysqli_query($conn, $fetchTskData);
                                $tskData=mysqli_fetch_assoc($fetchTskDataRes);
                                $tsk_name = $tskData['task_name'];
                                $tsk_des = $tskData['task_des'];
                                $tsk_cre = $tskData['created_date'];
                                $tsk_dead = $tskData['deadline'];
                                //Trim task description if its above 136 char
                                if(strlen($tsk_des)>136){
                                    $tsk_des=substr($tsk_des,0,136);
                                    $tsk_des=$tsk_des . "...";
                                }
                        ?>
                        <a href="./view_task.php?tskId=<?php echo $tskId ?>" class="task">
                            <div class="detail">
                                <div class="title">
                                    <?php echo $tsk_name ?>
                                </div>
                                <div class="description">
                                    <?php echo $tsk_des ?>
                                </div>
                            </div>
                            <div class="divider"></div>
                            <div class="dates">
                                <div class="date">
                                    Created on:<span><?php echo $tsk_cre ?></span>
                                </div>
                                <div class="date">
                                    Deadline:<span><?php echo $tsk_dead ?></span>
                                </div>
                            </div>
                        </a>
                        <?php
                            }
                        ?>
                    </div>
                </div>
                <!-- End of pending task -->

                <!-- View completed task -->
                <div id="tabCon3" class="tab-content">
                    tab3
                </div>
                <!-- End of completed task -->

                <!-- View rejected task -->
                <div id="tabCon4" class="tab-content">
                    tab4
                </div>
                <!-- End of rejected task -->


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