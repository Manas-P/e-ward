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
        //Fetch user data
        $wardno=$_SESSION['wardno'];
        $name=$_SESSION['fullname'];
        $userid=$_SESSION['userid'];

        //slice first name of user
        $slices=explode(" ", $name);
        $firstName=$slices[0];

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="../../../../public/assets/images/fav.svg" type="image/x-icon">
        <link rel="stylesheet" href="../../../../public/assets/css/ward_member/wm_houses_req.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <title>Ward <?php echo $wardno; ?> || House Requests</title>
    </head>
    <body>
        <section class="main">
            <!-- ==========Sidebar============= -->
            <?php
                include '../../layout/office_staff/sidebar_houses.php';
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
                    <div style="margin-left: 100px;">House no.</div>
                    <div style="margin-left: 90px;">House tax report</div>
                    <div style="margin-left: 72px;">Action</div>
                </div>
                <div class="datas">
                    <?php
                        $query="SELECT `fname`, `email`, `phno`, `houseno`, `taxreport`, `rid` FROM `tbl_registration` WHERE `status`=0 and `wardno`='$wardno'";
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
                                <td width=154px><?php echo $row["phno"]; ?></td>
                                <td width=180px><?php echo $row["houseno"]; ?></td>
                                <td width=225px>
                                    <a class="view" href="../../../model/viewPdf.php?pdf=<?php echo $row["taxreport"]; ?>" target="_blank">View</a>
                                </td>
                                <td width=95px>
                                    <a href="../../../model/ward_member/approve_house.php?apprId=<?php echo $row['rid']; ?>" class="approve" onclick="loader()" >Approve</a>
                                </td>
                                <td>
                                    <a class="reject"  onclick="deleteItem(<?php $rejId=$row['rid']; echo $rejId; ?>)">Reject</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <?php
                        $i=$i+1;
                        }
                        if(mysqli_num_rows($result)==0){
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

        

        <!--=========== Modal ============-->
        <div class="overlay modal-hidden"></div>
        <!-- form to reject houuse request-->
        <div class="box modal-box modal-hidden">
            <div class="title">
                Reason for rejection
            </div>
            <div class="modal-close-btn">
                <img src="../../../../public/assets/images/close.svg" alt="close button">
            </div>
            <form action="../../../model/ward_member/reject_house.php" method="post" id="reject-form" enctype="multipart/form-data">
            <input type="hidden" name="HiddenItemId" id="hiddenItemId">
                <div class="inputs">
                    <textarea name="rej_reason" id="rejreason" rows="10"></textarea>
                   
                    <div class="button wBtn cursor-disable">
                        <input type="submit" value="Continue" name="reject_house_req" id="rej" onclick="loader()" class="primary-button disabled">
                    </div>
                </div>
            </form>
        </div>
        <script>
            let deleteItem=(DataId)=>{
                document.getElementById('hiddenItemId').value=DataId;

            }
        </script>

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
        <script src="../../../../public/assets/js/reject_house_reg.js"></script>
        <script src="../../../../public/assets/js/toast.js"></script>
    </body>
</html>
	<?php
}
?>