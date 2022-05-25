<?php
    include '../../../config/dbcon.php';
    session_start();
    if (isset($_SESSION["sessionId"]) != session_id()) {
        header("Location: ../login/login.php");
        die();
    }
    else
    {
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin | Add Ward Memeber</title>
        <link rel="shortcut icon" href="../../../../public/assets/images/fav.svg" type="image/x-icon">
        <link rel="stylesheet" href="../../../../public/assets/css/admin/admin_add_wm.css">
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
            <div class="container">
                <div class="header">
                    <div class="title">
                        Manage ward members
                    </div>
                    <div class="search">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path class="str" d="M8.25 14.25C11.5637 14.25 14.25 11.5637 14.25 8.25C14.25 4.93629 11.5637 2.25 8.25 2.25C4.93629 2.25 2.25 4.93629 2.25 8.25C2.25 11.5637 4.93629 14.25 8.25 14.25Z" stroke="#B1B1B1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path class="str" d="M15.7498 15.75L12.4873 12.4875" stroke="#B1B1B1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>                        
                        <input type="text" name="" placeholder="Search..." id="">
                    </div>
                </div>
                <!-- President -->
                <div class="president">
                    <div class="heading">
                        President
                    </div>

                    <?php
                        $memberFetch="SELECT `photo`, `wardno`, `fullname` FROM `tbl_ward_member` WHERE `president`=1";
                        $memberResult=mysqli_query($conn,$memberFetch);
                        if(mysqli_num_rows($memberResult)==0){
                    ?>
                            <a class="add-president">
                                <div class="icon">
                                    <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path class="str" d="M15 6.25V23.75" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path class="str" d="M6.25 15H23.75" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                                <div class="text">Add president</div>
                            </a>
                    <?php 
                        }else{
                            while($mrow = mysqli_fetch_assoc($memberResult)){
                    ?>
                            <a href="./ward_member_show.php?wardno=<?php echo $mrow['wardno']; ?>" class="presidentt">
                                <div class="photo">
                                    <img src="../<?php echo $mrow["photo"]; ?>" alt="member photo">
                                </div>
                                <div class="about">
                                    <div class="name"><?php echo $mrow["fullname"]; ?></div>
                                    <div class="tag">Ward: <?php echo $mrow["wardno"]; ?></div>
                                </div>
                            </a>
                    <?php
                            }
                        }
                    ?>
                </div>
                <!-- Ward Members -->
                <div class="members-list">
                    <div class="heading">
                        <div class="titl">
                            Ward Members
                        </div>
                        <div class="upvalid">
                            Update validity for all
                        </div>
                    </div>
                    <div class="members">
                        <a class="add-member">
                            <div class="icon">
                                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path class="str" d="M15 6.25V23.75" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path class="str" d="M6.25 15H23.75" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <div class="text">Add ward member</div>
                        </a>
                        <!-- Fetch Ward Members -->
                        <?php
                            $fetchQuery="SELECT `photo`, `wardno`, `fullname` FROM `tbl_ward_member` WHERE `status`=1";
                            $fetchResult=mysqli_query($conn,$fetchQuery);
                            if(mysqli_num_rows($fetchResult)>0){
                                while($row = mysqli_fetch_assoc($fetchResult)){
                        ?>
                                    <a href="./ward_member_show.php?wardno=<?php echo $row['wardno']; ?>" class="member">
                                        <div class="photo">
                                            <img src="../<?php echo $row["photo"]; ?>" alt="member photo">
                                        </div>
                                        <div class="about">
                                            <div class="name"><?php echo $row["fullname"]; ?></div>
                                            <div class="tag">Ward: <?php echo $row["wardno"]; ?></div>
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
        <!--=========== Modal ============-->
        <div class="overlay modal-hidden"></div>
        <!-- form to add members-->
        <div class="box modal-box modal-hidden">
            <div class="title">
                Add ward member
            </div>
            <div class="modal-close-btn">
                <img src="../../../../public/assets/images/close.svg" alt="close button">
            </div>
            <!-- Add Ward Memeber -->
            <form action="../../../model/admin/addWardMember.php" method="post" id="add-ward-member" enctype="multipart/form-data">
                <div class="inputs">
                    <div class="input w-fullname">
                        <div class="label">
                            Full name
                        </div>
                        <input type="text" name="wfname" id="w-full-name" placeholder="John Doe" autocomplete="off">
                        <div class="error error-hidden">
                        </div>
                    </div>
                    <div class="input w-email">
                        <div class="label">
                            Email ID
                        </div>
                        <input type="text" name="wemail" id="w-email-id" placeholder="example@gmail.com" autocomplete="off">
                        <div class="error error-hidden">
                        </div>
                    </div>
                    <div class="input w-phno">
                        <div class="label">
                            Phone number
                        </div>
                        <input type="text" name="wphno" id="w-phn-number" placeholder="9568547512" autocomplete="off">
                        <div class="error error-hidden">
                        </div>
                    </div>
                    <div class="half-input">
                        <div class="input w-wrdno">
                            <div class="label">
                                Ward number
                            </div>
                            <input type="text" name="wwrdno" id="w-ward-number" placeholder="25" autocomplete="off" oninput="validateWardNo(this.value)">
                            <div class="error error-hidden">
                            </div>
                        </div>
                        <div class="input w-date">
                            <div class="label">
                                Valid upto
                            </div>
                            <input type="date" name="wvalidity" id="w-date" autocomplete="off">
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
                        <input type="submit" value="Add member" name="add-wm" onclick="loader()" id="add-wm" class="primary-button disabled">
                    </div>
                </div>
            </form>
        </div>
        <!-- Form to add President -->
        <div class="box2 modal-box2 modal-hidden">
            <div class="title">
                Add president
            </div>
            <div class="modal-close-btn pre-cls-btn">
                <img src="../../../../public/assets/images/close.svg" alt="close button">
            </div>
            <form action="" method="post" id="add-president">
            <?php
                $fetchQuery="SELECT `wardno`, `photo`, `fullname` FROM `tbl_ward_member` WHERE `status`=1";
                $fetchResult=mysqli_query($conn,$fetchQuery);
                if(mysqli_num_rows($fetchResult)>0){
                    while($row = mysqli_fetch_assoc($fetchResult)){
            ?>
                        <a href="../../../model/admin/addPresident.php?wardno=<?php echo $row["wardno"]; ?>" class="member">
                            <div class="photo">
                                <img src="../<?php echo $row["photo"]; ?>" alt="member photo">
                            </div>
                            <div class="about">
                                <div class="name"><?php echo $row["fullname"]; ?></div>
                                <div class="tag">Ward: <?php echo $row["wardno"]; ?></div>
                            </div>
                        </a>
            <?php
                    }
                        
                }else{

                }
            ?>
            </form>
        </div>
        <!-- Form to update validity for all -->
        <div class="box3 modal-box3 modal-hidden">
            <div class="title">
                Add president
            </div>
            <div class="modal-close-btn up-cls-btn">
                <img src="../../../../public/assets/images/close.svg" alt="close button">
            </div>
            <form action="../../../model/admin/updateMember.php" method="post" id="add-president">
                <div class="inputs">
                    <div class="input w-date">
                        <div class="label">
                            Valid upto
                        </div>
                        <input type="date" name="upvalidity" id="a-date" autocomplete="off">
                        <div class="error error-hidden">
                        </div>
                    </div>
                    <div class="button wBtn">
                        <input type="submit" value="Update validity" name="upVal" id="upVal" class="primary-button">
                    </div>
                </div>
            </form>
        </div>


        <div id="warrning-box" >
            <!-- Inject Error Toast -->
        </div>
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
            }
        ?>
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
            }
        ?>


            <!-- ==========Loading============= -->
            <?php
                include '../../includes/loading.php'
            ?>
            <!-- ==========Loading End============= -->


        <script src="../../../../public/assets/js/admin_add_wm.js"></script>
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