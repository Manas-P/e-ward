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
        $name=$_SESSION['fullname'];
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
                    <div class="attendance">
                        <a href="">
                            Attendance
                        </a>
                    </div>
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

                        <!-- Fetch House Members -->
                        <a href="" class="member">
                            <div class="photo">
                                <img src="../../../../public/assets/images/uploads/photos/1637433746.png" alt="member photo">
                            </div>
                            <div class="about">
                                <div class="name">Manas P</div>
                                <div class="tag">9587452365</div>
                            </div>
                        </a>

                        <a href="" class="member">
                            <div class="photo">
                                <img src="../../../../public/assets/images/uploads/photos/1637438149.png" alt="member photo">
                            </div>
                            <div class="about">
                                <div class="name">Wade Warren</div>
                                <div class="tag">9587452365</div>
                            </div>
                        </a>
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
            <form action="" method="post" id="add-house-member" enctype="multipart/form-data">
                <input type="hidden" name="fname" value="<?php echo $fname ?>">
                <div class="inputs">
                    <div class="input h-fullname">
                        <div class="label">
                            Full name
                        </div>
                        <input type="text" name="hfname" id="h-full-name" placeholder="John Doe" autocomplete="off">
                        <div class="error error-hidden">
                        </div>
                    </div>
                    <div class="input h-email">
                        <div class="label">
                            Email ID
                        </div>
                        <input type="text" name="hemail" id="h-email-id" placeholder="example@gmail.com" autocomplete="off">
                        <div class="error error-hidden">
                        </div>
                    </div>
                    <div class="input h-phno">
                        <div class="label">
                            Phone number
                        </div>
                        <input type="text" name="hphno" id="h-phn-number" placeholder="9568547512" autocomplete="off">
                        <div class="error error-hidden">
                        </div>
                    </div>
                    <div class="input h-photo">
                        <div class="label">
                            Upload photo
                        </div>
                        <input type="file" name="hphoto" id="h-photo" accept="image/png,image/jpeg">
                        <div class="error error-hidden">
                        </div>
                    </div>
                    <div class="input">
                        <div class="label">
                            Roles
                        </div>
                        <div class="checkboxes">
                            <div class="checkbox">
                                <input type="checkbox" name="" id="manage-house">
                                <label for="manage-house">Manage houses</label>
                            </div>
                            <div class="checkbox">
                                <input type="checkbox" name="" id="manage-committees">
                                <label for="manage-committees">Manage committees</label>
                            </div>
                            <div class="checkbox">
                                <input type="checkbox" name="" id="manage-complaints">
                                <label for="manage-complaints">Manage complaints</label>
                            </div>
                        </div>
                    </div>
                    <div class="button hBtn cursor-disable">
                        <input type="submit" value="Add office staff" name="add-hm" id="add-hm" onclick="loader()" class="primary-button disabled">
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
    </body>
    </html>
<?php
    }
?>