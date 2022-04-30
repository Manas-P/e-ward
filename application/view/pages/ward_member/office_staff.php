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
        $staffData="SELECT `name`, `email`, `phno`, `photo`, `m_house`, `m_committee`, `m_complaint` FROM `tbl_office_staff` WHERE `userid`='$staffId' AND `status`='1'";
        $staffDataResult=mysqli_query($conn,$staffData);
        $staff=mysqli_fetch_assoc($staffDataResult);
        $sName=$staff['name'];
        $sEmail=$staff['email'];
        $sPhno=$staff['phno'];
        $sPhoto=$staff['photo'];
        $mHouse=$staff['m_house'];
        $mCommittee=$staff['m_committee'];
        $mRequest=$staff['m_complaint'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="../../../../public/assets/images/fav.svg" type="image/x-icon">
        <link rel="stylesheet" href="../../../../public/assets/css/ward_member/view_office_staff.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
                                <img src="../<?php echo $sPhoto; ?>" alt="">
                            </div>
                            <div class="info">
                                <div class="con"><?php echo $sName; ?></div>
                                <div class="con-fade"><?php echo $sEmail; ?></div>
                                <div class="con-fade">+91<?php echo $sPhno; ?></div>
                            </div>
                        </div>
                        <div class="role">
                            <div class="line"></div>
                            <div class="roles">
                                <div class="resp">
                                    <div class="title">Manage houses:</div>
                                    <div class="sub">
                                        <?php 
                                            if($mHouse=='1'){
                                                echo "Eligible";
                                            }else{
                                                echo "Not eligible";
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div class="resp">
                                    <div class="title">Manage requests:</div>
                                    <div class="sub">
                                        <?php 
                                            if($mRequest=='1'){
                                                echo "Eligible";
                                            }else{
                                                echo "Not eligible";
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div class="resp">
                                    <div class="title">Manage committees:</div>
                                    <div class="sub">
                                        <?php 
                                            if($mCommittee=='1'){
                                                echo "Eligible";
                                            }else{
                                                echo "Not eligible";
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="r-content">
                        <a class="update-btn">Update</a>
                        <a class="remove-btn">Remove</a>
                    </div>
                </div>

                <!-- Activities -->
                <div class="titlee">Activities</div>
                <div class="headings">
                    <div>Slno.</div>
                    <div style="margin-left: 80px;">Date</div>
                    <div style="margin-left: 134px;">Time</div>
                    <div style="margin-left: 120px;">Activity</div>
                </div>
                <div class="datas">
                    <!-- Fetch data (While loope) -->
                    <div class="data">
                        <table>
                            <tr>
                                <td width=120px>1.</td>
                                <td width=174px>25-10-2022</td>
                                <td width=162px>09:00 am</td>
                                <td width=930px>
                                    Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat dolor do amet sint. Velit officia consequat
                                </td>
                            </tr>
                        </table>
                    </div>
                    <!-- While loop close -->
                    <div class="data">
                        <table>
                            <tr>
                                <td width=120px>2.</td>
                                <td width=174px>25-10-2022</td>
                                <td width=162px>09:00 am</td>
                                <td width=930px> Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint.</td>
                            </tr>
                        </table>
                    </div>
                </div>
            
                
            </div>
        </section>


        <!-- =========== Modal ============ -->
        <div class="overlay modal-hidden"></div>
        <!-- form to update office staff -->
        <div class="box modal-box1 modal-hidden">
            <div class="title"> Update office staff </div>
            <div class="modal-close-btn">
                <img src="../../../../public/assets/images/close.svg" alt="close button">
            </div>
            <!-- update office staffs -->
            <form action="../../../model/ward_member/manage_office_staff.php" method="post" id="up-office-staff" enctype="multipart/form-data">
                <input type="hidden" name="hm_already_photo" value="<?php echo $sPhoto ?>">
                <input type="hidden" name="staff_id" value="<?php echo $staffId ?>">
                <div class="inputs">
                    <div class="input of-fullname">
                        <div class="label"> Full name </div>
                        <input type="text" name="name" id="up-full-name" value="<?php echo $sName; ?>" autocomplete="off">
                        <div class="error error-hidden">
                        </div>
                    </div>
                    <div class="input of-email">
                        <div class="label"> Email ID </div>
                        <input type="text" name="email" id="up-email-id" value="<?php echo $sEmail; ?>" autocomplete="off">
                        <div class="error error-hidden">
                        </div>
                    </div>
                    <div class="input of-phno">
                        <div class="label"> Phone number </div>
                        <input type="text" name="phno" id="up-phn-number" value="<?php echo $sPhno; ?>" autocomplete="off">
                        <div class="error error-hidden">
                        </div>
                    </div>
                    <div class="input of-photo">
                        <div class="label"> Upload photo </div>
                        <input type="file" name="photo" id="up-photo" value="<?php echo $sPhoto ?>" accept="image/png,image/jpeg">
                        <div class="error error-hidden">
                        </div>
                    </div>
                    <div class="input">
                        <div class="label"> Roles </div>
                        <div class="checkboxes">
                            <div class="checkbox">
                                <input type="checkbox" name="mhouse" value="0" id="manage-house">
                                <label for="manage-house">Manage houses</label>
                            </div>
                            <div class="checkbox">
                                <input type="checkbox" name="mcommittee" value="0" id="manage-committees">
                                <label for="manage-committees">Manage committees</label>
                            </div>
                            <div class="checkbox">
                                <input type="checkbox" name="mcomplaint" value="0" id="manage-complaints">
                                <label for="manage-complaints">Manage requests</label>
                            </div>
                        </div>
                    </div>
                    <div class="button hBtn cursor-disable">
                        <input type="submit" value="Update" name="update-staff" id="up-of" onclick="loader()"
                            class="primary-button disabled">
                    </div>
                </div>
            </form>
        </div>

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
        <script src="../../../../public/assets/js/wm_manage_staff.js"></script>
    </body>
</html>
	<?php
}
?>