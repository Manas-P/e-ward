<?php
session_start();
if (isset($_SESSION["sessionId"]) != session_id()) {
    header("Location: ../login/login.php");
    die();
} else {
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin | Add Ward Memeber</title>
        <link rel="shortcut icon" href="../../../../public/assets/images/fav.svg" type="image/x-icon">
        <link rel="stylesheet" href="../../../../public/assets/css/admin/ward_member_show.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    </head>

    <body>
        <section class="main">
            <!-- ==========Sidebar============= -->
            <?php
                include '../../layout/admin/sidebar_manage_wm.php'
            ?>
            <!-- ==========Sidebar End============= -->

            <?php
                    include '../../../config/dbcon.php';
                    $wardno=$_GET['wardno'];
                    //Fetch Member Details
                    $memberDetals="SELECT `fullname`, `email`, `phno`, `photo`, `validupto`, `president` FROM `tbl_ward_member` WHERE `wardno`=$wardno";
                    $detailsResult=mysqli_query($conn,$memberDetals);
                    $userData=mysqli_fetch_assoc($detailsResult);
                    $name=$userData['fullname'];
                    $email=$userData['email'];
                    $phno=$userData['phno'];
                    $photo=$userData['photo'];
                    $validity=$userData['validupto'];
                    $president=$userData['president'];

                    //Fetch house count
                    $houseCount="SELECT `hid` FROM `tbl_house` WHERE `ward_no`='$wardno'";
                    $houseCountResult=mysqli_query($conn,$houseCount);
                    $houseRowCount = mysqli_num_rows($houseCountResult);

                    //Fetch committee count
                    $committeeCount="SELECT `id` FROM `tbl_committee` WHERE `wardno`='$wardno'";
                    $committeeCountResult=mysqli_query($conn,$committeeCount);
                    $committeeRowCount = mysqli_num_rows($committeeCountResult);
                    
                    //Fetch office staff count
                    $officeStaffCount="SELECT `id` FROM `tbl_office_staff` WHERE `wardno`='$wardno'";
                    $officeStaffCountResult=mysqli_query($conn,$officeStaffCount);
                    $officeStaffRowCount = mysqli_num_rows($officeStaffCountResult);
                ?>
                
            <div class="container">
                <div class="header">
                    <div class="title">
                        Manage ward members
                    </div>
                    <div class="search">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path class="str" d="M8.25 14.25C11.5637 14.25 14.25 11.5637 14.25 8.25C14.25 4.93629 11.5637 2.25 8.25 2.25C4.93629 2.25 2.25 4.93629 2.25 8.25C2.25 11.5637 4.93629 14.25 8.25 14.25Z" stroke="#B1B1B1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path class="str" d="M15.7498 15.75L12.4873 12.4875" stroke="#B1B1B1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <input type="text" name="" placeholder="Search..." id="">
                    </div>
                </div>
                <div class="bread-crumbs">
                    <a href="./admin_add_wm.php" class="previous">
                        <?php 
                            if($president!=1){
                                echo "Ward members";
                            }else{
                                echo "President";
                            }
                        ?>
                    </a>
                    <svg class="str" width="8" height="10" viewBox="0 0 8 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.2002 8.59999L5.8002 4.99999L2.2002 1.39999" stroke="#1E1E1E" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <a href="" class="now">
                        <?php
                            echo $name;
                        ?>
                    </a>
                </div>
                <!-- Member detals box -->
                <div class="member-data">
                    <div class="basic-details">
                        <img src="../<?php echo $photo ?>" alt="Member-photo">
                        <div class="details">
                            <div class="name"><?php echo $name ?></div>
                            <div class="info"><?php echo $email ?></div>
                            <div class="info">+91 <?php echo $phno ?></div>
                            <div class="tag">Ward: <?php echo $wardno ?></div>
                        </div>
                    </div>
                    <div class="other-content">
                        <div class="divider"></div>
                        <div class="contents">
                            <div class="content">No. of houses registered:<span><?php echo $houseRowCount ?></span></div>
                            <div class="content">No. of committees:<span><?php echo $committeeRowCount ?></span></div>
                            <div class="content">No. of office staffs:<span><?php echo $officeStaffRowCount ?></span></div>
                        </div>
                    </div>
                    <div class="other-content">
                        <div class="divider"></div>
                        <div class="contents">
                            <div class="content">Valid upto:<span><?php echo $validity ?></span></div>
                            <div class="content">Goals acheived:<span>24</span></div>
                            <div class="content">Goals acheived:<span>24</span></div>
                        </div>
                    </div>
                    <div class="buttons">
                        <a class="update" id="add-member">Update</a>
                        <?php 
                            if($president==0){
                        ?>
                            <a href="../../../model/admin/removeMember.php?wardno=<?php echo $wardno ?>" class="remove">Remove</a>
                        <?php
                            }else{
                        ?>
                            <a href="../../../model/admin/removePresident.php?wardno=<?php echo $wardno ?>" class="remove">Remove</a>
                        <?php    
                            }
                        ?>
                    </div>
                </div>
                <div class="analytics">
                    <div class="title">
                        Analytics
                    </div>
                </div>
            </div>
        </section>
        <!--=========== Modal ============-->
        <div class="overlay modal-hidden"></div>
        <!-- form to add members-->
        <div class="box modal-box modal-hidden">
            <div class="title">
                Update details
            </div>
            <div class="modal-close-btn">
                <img src="../../../../public/assets/images/close.svg" alt="close button">
            </div>
            <!-- Add Ward Memeber -->
            <form action="../../../model/admin/updateMember.php?wrno=<?php echo $wardno;?>" method="post" id="add-ward-member" enctype="multipart/form-data">
                <div class="inputs">
                    <div class="input w-fullname">
                        <div class="label">
                            Full name
                        </div>
                        <input type="text" name="wfname" id="w-full-name" value="<?php echo $name ?>" placeholder="John Doe" autocomplete="off">
                        <div class="error error-hidden">
                        </div>
                    </div>
                    <div class="input w-email">
                        <div class="label">
                            Email ID
                        </div>
                        <input type="text" name="wemail" id="w-email-id" value="<?php echo $email ?>" placeholder="example@gmail.com" autocomplete="off">
                        <div class="error error-hidden">
                        </div>
                    </div>
                    <div class="input w-phno">
                        <div class="label">
                            Phone number
                        </div>
                        <input type="text" name="wphno" id="w-phn-number" value="<?php echo $phno ?>" placeholder="9568547512" autocomplete="off">
                        <div class="error error-hidden">
                        </div>
                    </div>
                    <div class="half-input">
                        <div class="input w-wrdno">
                            <div class="label">
                                Ward number
                            </div>
                            <input type="text" name="wwrdno" id="w-ward-number" value="<?php echo $wardno ?>" placeholder="25" autocomplete="off" oninput="validateWardNo(this.value)">
                            <div class="error error-hidden">
                            </div>
                        </div>
                        <div class="input w-date">
                            <div class="label">
                                Valid upto
                            </div>
                            <input type="date" name="wvalidity" value="<?php echo $validity ?>" id="w-date" autocomplete="off">
                            <div class="error error-hidden">
                            </div>
                        </div>
                    </div>
                    <div class="input w-photo">
                        <div class="label">
                            Upload photo
                        </div>
                        <input type="file" name="wphoto" id="w-photo" accept="image/png,image/jpeg">
                        <div class="error error-hidden">
                        </div>
                    </div>
                    <div class="button wBtn cursor-disable">
                        <input type="submit" value="Update" name="update-wm" id="add-wm" class="primary-button disabled">
                    </div>
                </div>
            </form>
        </div>

        <div id="warrning-box" >
            <!-- inject error -->
        </div>
        <?php
        if (isset($_SESSION['error'])) {
            $msg = $_SESSION['error'];
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
        } ?>
        <script src="../../../../public/assets/js/admin_member_update.js"></script>
        <script src="../../../../public/assets/js/toast.js"></script>
        <script>
            function validateWardNo(ward)
            {  
                 $.ajax({
                    url: "../../../model/admin/addWardMember.php",
                    type: "POST",
                    data: {
                        wardNo:ward
                    },
                    success: function(data, status) {
                        $('#warrning-box').html(data);
                        // hosnoSubmit=false;
                    }
                });
             }
        </script>
    </body>

    </html>
<?php
}
?>