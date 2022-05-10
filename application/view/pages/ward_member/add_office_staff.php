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
        <link rel="stylesheet" href="../../../../public/assets/css/ward_member/office_staff.css">
        <title>Ward <?php echo $wardno; ?> || Office staffs</title>
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
                        Office staffs
                    </div>
                    <div class="search">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path class="str" d="M8.25 14.25C11.5637 14.25 14.25 11.5637 14.25 8.25C14.25 4.93629 11.5637 2.25 8.25 2.25C4.93629 2.25 2.25 4.93629 2.25 8.25C2.25 11.5637 4.93629 14.25 8.25 14.25Z" stroke="#B1B1B1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path class="str" d="M15.7498 15.75L12.4873 12.4875" stroke="#B1B1B1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>                        
                        <input type="text" name="hsearch" placeholder="Search..." id="live-search" autocomplete="off" onkeyup="searchHouse(this.value)">
                    </div>
                </div>
                <div class="hyper-link">
                    <div class="leave-req">
                        <a href="">
                            Leave requests
                        </a>
                        <span class="noti-badge">
                            <!-- Fetch request -->
                            4
                        </span>
                    </div>
                </div>

                <!-- content -->
                <div class="members-list">
                    <div class="members">
                        <a class="add-member">
                            <div class="icon">
                                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path class="str" d="M15 6.25V23.75" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path class="str" d="M6.25 15H23.75" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <div class="text">Add office staff</div>
                        </a>

                        <!-- Fetch office staffs -->
                        <?php
                            $fetchQuery="SELECT `name`, `phno`, `photo`, `userid` FROM `tbl_office_staff` WHERE `wardno`='$wardno' AND `status`='1'";
                            $fetchResult=mysqli_query($conn,$fetchQuery);
                            if(mysqli_num_rows($fetchResult)>0){
                                while($row = mysqli_fetch_assoc($fetchResult)){
                        ?>
                                <a href="./office_staff.php?id=<?php echo $row['userid']; ?>" class="member">
                                    <div class="photo">
                                        <img src="../<?php echo $row['photo']; ?>" alt="member photo">
                                    </div>
                                    <div class="about">
                                        <div class="name"><?php echo $row['name']; ?></div>
                                        <div class="tag"><?php echo $row['phno']; ?></div>
                                    </div>
                                </a>
                        <?php
                                } 
                            }else{
                            }
                        ?>

                    </div>
                </div>
                
            </div>
        </section>

        <!-- =========== Modal ============ -->
        <div class="overlay modal-hidden"></div>
        <!-- form to add members-->
        <div class="box modal-box modal-hidden">
            <div class="title">
                Add office staff
            </div>
            <div class="modal-close-btn">
                <img src="../../../../public/assets/images/close.svg" alt="close button">
            </div>
            <!-- Add office staffs -->
            <form action="../../../model/ward_member/add_office_staff.php" method="post" id="add-office-staff" enctype="multipart/form-data">
                <div class="inputs">
                    <div class="input of-fullname">
                        <div class="label">
                            Full name
                        </div>
                        <input type="text" name="name" id="of-full-name" placeholder="John Doe" autocomplete="off">
                        <div class="error error-hidden">
                        </div>
                    </div>
                    <div class="input of-email">
                        <div class="label">
                            Email ID
                        </div>
                        <input type="text" name="email" id="of-email-id" placeholder="example@gmail.com" autocomplete="off">
                        <div class="error error-hidden">
                        </div>
                    </div>
                    <div class="input of-phno">
                        <div class="label">
                            Phone number
                        </div>
                        <input type="text" name="phno" id="of-phn-number" placeholder="9568547512" autocomplete="off">
                        <div class="error error-hidden">
                        </div>
                    </div>
                    <div class="input of-photo">
                        <div class="label">
                            Upload photo
                        </div>
                        <input type="file" name="photo" id="of-photo" accept="image/png,image/jpeg">
                        <div class="error error-hidden">
                        </div>
                    </div>
                    <div class="input">
                        <div class="label">
                            Roles
                        </div>
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
                        <input type="submit" value="Add office staff" name="add-staff" id="add-of" onclick="loader()" class="primary-button disabled">
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

        <script src="../../../../public/assets/js/wm_add_staffs.js"></script>
        <script src="../../../../public/assets/js/toast.js"></script>
    </body>
    </html>
<?php
    }
?>