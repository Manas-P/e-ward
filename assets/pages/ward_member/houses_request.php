<?php
    include '../../include/dbcon.php';
    session_start();
    //Check login
    if (isset($_SESSION["memebrId"]) != session_id()) {
        header("Location: ../login.php");
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
        <link rel="shortcut icon" href="../../images/fav.svg" type="image/x-icon">
        <link rel="stylesheet" href="../../styles/wm_houses_req.css">
        <title>Admin</title>
    </head>
    <body>
        <section class="main">
            <!-- ==========Sidebar============= -->
            <?php
                include '../../include/ward_member/sidebar_houses.php'
            ?>
            <!-- ==========Sidebar End============= -->
            <div class="container">
                <div class="header">
                    <div class="title">
                        Manage houses
                    </div>
                    <div class="search">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path class="str" d="M8.25 14.25C11.5637 14.25 14.25 11.5637 14.25 8.25C14.25 4.93629 11.5637 2.25 8.25 2.25C4.93629 2.25 2.25 4.93629 2.25 8.25C2.25 11.5637 4.93629 14.25 8.25 14.25Z" stroke="#B1B1B1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path class="str" d="M15.7498 15.75L12.4873 12.4875" stroke="#B1B1B1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>                        
                        <input type="text" name="" placeholder="Search..." id="">
                    </div>
                </div>
                <div class="bread-crumbs">
                    <a href="./houses.php" class="previous">
                        Houses
                    </a>
                    <svg class="str" width="8" height="10" viewBox="0 0 8 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.2002 8.59999L5.8002 4.99999L2.2002 1.39999" stroke="#1E1E1E" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <a href="" class="now">
                        Requests
                    </a>
                </div>
                <div class="headings">
                    <div>Slno.</div>
                    <div style="margin-left: 70px;">Full name</div>
                    <div style="margin-left: 129px;">Email id</div>
                    <div style="margin-left: 265px;">Phno.</div>
                    <div style="margin-left: 88px;">House no.</div>
                    <div style="margin-left: 90px;">Ration card no.</div>
                    <div style="margin-left: 92px;">Action</div>
                </div>
                <div class="datas">
                    <?php
                        include '../../include/dbcon.php';
                        $query="SELECT * FROM `tbl_registration` WHERE `status`=0 and `wardno`='$wardno'";
                        $result=mysqli_query($conn,$query);
                        $i=1;
                        while($row=mysqli_fetch_array($result)){
                    ?>
                    <div class="data">
                        <table>
                            <tr>
                                <td width=104px><?php echo $i; ?></td>
                                <td width=218px><?php echo $row["fname"]; ?></td>
                                <td width=333px><?php echo $row["email"]; ?></td>
                                <td width=140px><?php echo $row["phno"]; ?></td>
                                <td width=180px><?php echo $row["houseno"]; ?></td>
                                <td width=225px><?php echo $row["rationno"]; ?></td>
                                <td width=95px>
                                    <a href="../../php/approve.php?apprId=<?php echo $row['rid']; ?>" class="approve">Approve</a>
                                </td>
                                <td>
                                    <!-- <a href="../../php/reject.php?rejId=<?php echo $row['rid']; ?>" class="reject">Reject</a> -->
                                    <a class="reject">Reject</a>
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

        <!--=========== Modal ============-->
        <div class="overlay modal-hidden"></div>
        <!-- form to reject houuse request-->
        <div class="box modal-box modal-hidden">
            <div class="title">
                Reason for rejection
            </div>
            <div class="modal-close-btn">
                <img src="../../images/close.svg" alt="close button">
            </div>
            <!-- Add Ward Memeber -->
            <form action="../../php/auth.php?wrno=<?php echo $wardno;?>" method="post" id="reject-form" enctype="multipart/form-data">
                <div class="inputs">
                    <textarea name="" id="rejreason" rows="10"></textarea>
                   
                    <div class="button wBtn cursor-disable">
                        <input type="submit" value="Continue" name="update-wm" id="rej" class="primary-button disabled">
                    </div>
                </div>
            </form>
        </div>


        <script src="../../js/reject_house_reg.js"></script>
    </body>
</html>
	<?php
}
?>