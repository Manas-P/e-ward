<?php
include '../../../config/dbcon.php';
session_start();
if (isset($_SESSION["sessionId"]) != session_id()) {
    header("Location: ../login/login.php");
    die();
}
else
{
    $fname=$_SESSION['fname'];
    $houseno= $_SESSION['houseno'];
    $wardno= $_SESSION['wardno'];
    $user_id= $_SESSION['userid'];

    //check user
    $arr = str_split($user_id); // convert string to an array
    $chk= end($arr); // 0 = house head

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
        <link rel="stylesheet" href="../../../../public/assets/css/ward_member/wm_e_doc.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    </head>
    <body>
        <section class="main">
            <!-- ==========Sidebar============= -->
            <?php
                include '../../layout/house_member/sidebar_notification.php'
            ?>
            <!-- ==========Sidebar End============= -->
            <div class="container">
                <div class="header">
                    <div class="title"> Notifications </div>
                    <div class="search">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path class="str" d="M8.25 14.25C11.5637 14.25 14.25 11.5637 14.25 8.25C14.25 4.93629 11.5637 2.25 8.25 2.25C4.93629 2.25 2.25 4.93629 2.25 8.25C2.25 11.5637 4.93629 14.25 8.25 14.25Z" stroke="#B1B1B1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path class="str" d="M15.7498 15.75L12.4873 12.4875" stroke="#B1B1B1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <input type="text" name="hsearch" placeholder="Search..." id="live-search" autocomplete="off">
                    </div>
                </div>

                <!-- content -->
                <div class="headings" style="margin-top: 48px;">
                    <div>Slno.</div>
                    <div style="margin-left: 61px;">Notification title</div>
                    <div style="margin-left: 211px;">Description</div>
                    <div style="margin-left: 639px;">Date posted</div>
                </div>
                <div class="datas">
                    <?php
                        $tblQuery="SELECT `id`, `notification_title`, `notification_des`, `date_time` FROM `tbl_notification` WHERE `wardno`='$wardno' AND `hm`='1' ORDER BY id DESC";
                        $tblQueryResult=mysqli_query($conn,$tblQuery);
                        $i=1;
                        while($notData=mysqli_fetch_array($tblQueryResult)){
                            $datetime = $notData["date_time"];
                            $date = date('d-m-y', strtotime($datetime));
                            $time = date('h:i a', strtotime($datetime));
                    ?>
                    <div class="data">
                        <table>
                            <tr>
                                <td width=101px><?php echo $i ?>.</td>
                                <td width=360px><?php echo $notData['notification_title']; ?></td>
                                <td width=744px style="padding-right: 85px;"><?php echo $notData['notification_des']; ?></td>
                                <td width=199px><?php echo $date; ?></td>
                            </tr>
                        </table>
                    </div>
                    <?php
                        $i=$i+1;
                        }
                        if(mysqli_num_rows($tblQueryResult)==0){
                    ?>
                    <div class="no-result">
                        No records
                    </div>
                    <?php
                        }
                    ?>
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