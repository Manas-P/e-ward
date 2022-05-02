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
        <link rel="stylesheet" href="../../../../public/assets/css/house_member/hm_add_need_req.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    </head>
    <body>
        <section class="main">
            <!-- ==========Sidebar============= -->
            <?php
                include '../../layout/house_member/sidebar_add_need_requests.php'
            ?>
            <!-- ==========Sidebar End============= -->
            <div class="container">
                <div class="header">
                    <div class="title">
                        Need requests
                    </div>
                    <div class="search">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path class="str" d="M8.25 14.25C11.5637 14.25 14.25 11.5637 14.25 8.25C14.25 4.93629 11.5637 2.25 8.25 2.25C4.93629 2.25 2.25 4.93629 2.25 8.25C2.25 11.5637 4.93629 14.25 8.25 14.25Z" stroke="#B1B1B1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path class="str" d="M15.7498 15.75L12.4873 12.4875" stroke="#B1B1B1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>                        
                        <input type="text" name="hsearch" placeholder="Search..." id="live-search" autocomplete="off">
                    </div>
                </div>
                <div class="hyper-link">
                    <div class="add-req">
                        Add request
                    </div>
                    <div class="replies">
                        <a href="">
                            Replies
                        </a>
                        <span class="noti-badge">
                            <!-- Fetch request -->
                            4
                        </span>
                    </div>
                </div>
                <!-- content -->
                <div class="headings">
                    <div>Slno.</div>
                    <div style="margin-left: 61px;">Description</div>
                    <div style="margin-left:1028px;">Action</div>
                </div>
                <div class="datas">
                    <?php
                        $query="SELECT `c_name`, `c_description`, `m_limit`, `m_joined` FROM `tbl_committee` WHERE `wardno`='$wardno'";
                        $result=mysqli_query($conn,$query);
                        $i=1;
                        while($row=mysqli_fetch_array($result)){
                            if($row["m_joined"]!=0){
                                if($row["m_limit"]/$row["m_joined"]==1){
                                    continue;
                                }
                            }
                    ?>
                    <div class="data">
                        <table>
                            <tr>
                                <td width=101px><?php echo $i; ?></td>
                                <td width=1133px style="padding-right: 65px;"><?php echo $row["c_description"]; ?></td>
                                <td width=170px>
                                    <a href="" class="approve" onclick="loader()" >Delete request</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <?php
                        $i=$i+1;
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