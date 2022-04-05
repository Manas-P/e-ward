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
        <link rel="stylesheet" href="../../../../public/assets/css/ward_member/wm_committees.css">
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
                <div class="hyper-link">
                    <div class="attendance">
                        <a href="">
                            All committees
                        </a>
                    </div>
                    <div class="leave-req">
                        <a href="">
                            Closed committees
                        </a>
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
                            <div class="text">Add committee</div>
                        </a>

                        <!-- Fetch committees -->
                        <?php
                            $fetchQuery="SELECT `wardno`, `c_name`, `c_photo`, `m_limit`, `m_joined` FROM `tbl_committee` WHERE `wardno`='$wardno'";
                            $fetchResult=mysqli_query($conn,$fetchQuery);
                            if(mysqli_num_rows($fetchResult)>0){
                                while($row = mysqli_fetch_assoc($fetchResult)){

                                    //display only 13 character if it exceeds the limit
                                    $name=$row["c_name"];
                                    if(strlen($name)>13){
                                        $name = substr($name, 0, 13);
                                        $name=$name . "...";
                                    }
                        ?>
                                <a href="./view_committee.php" class="member">
                                    <div class="photo">
                                        <img src="../<?php echo $row["c_photo"]; ?>" alt="member photo">
                                    </div>
                                    <div class="about">
                                        <div class="name"><?php echo $name; ?></div>
                                        <div class="tag">Members: <?php echo $row["m_joined"]; ?>/<?php echo $row["m_limit"]; ?></div>
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
        <!-- form to add committee-->
        <div class="box modal-box modal-hidden">
            <div class="title">
                Add committee
            </div>
            <div class="modal-close-btn">
                <img src="../../../../public/assets/images/close.svg" alt="close button">
            </div>
            <!-- Add committee -->
            <form action="../../../model/ward_member/add_committee.php" method="post" id="add-committe" enctype="multipart/form-data">
                <div class="inputs">
                    <div class="input commName">
                        <div class="label">
                            Committee name
                        </div>
                        <input type="text" name="name" id="comm-name" placeholder="John Doe" autocomplete="off">
                        <div class="error error-hidden">
                        </div>
                    </div>
                    <div class="inputt commDes">
                        <div class="label">
                            Committee description
                        </div>
                        <textarea name="comm_des" id="comm-des" rows="10"></textarea>
                        <div class="subtext">
                            <div class="error error-hidden">
                            </div>
                            <div class="count-limit">
                                <span id="count-char">0</span>/300
                            </div>
                        </div>
                    </div>
                    <div class="input commPhoto">
                        <div class="label">
                            Upload photo
                        </div>
                        <input type="file" name="photo" id="comm-photo" accept="image/png,image/jpeg">
                        <div class="error error-hidden">
                        </div>
                    </div>
                    <div class="input commLimit">
                        <div class="label">
                            Members limit
                        </div>
                        <input type="text" name="commLimit" id="comm-limit" placeholder="20" autocomplete="off">
                        <div class="error error-hidden">
                        </div>
                    </div>
                    <div class="button hBtn cursor-disable">
                        <input type="submit" value="Add committee" name="add-comm" id="add-comm" onclick="loader()" class="primary-button disabled">
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

        <script src="../../../../public/assets/js/wm_add_committe.js"></script>
        <script src="../../../../public/assets/js/toast.js"></script>
    </body>
    </html>
<?php
    }
?>