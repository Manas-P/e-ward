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
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../../../../public/assets/css/office_staff/os_need_req.css">
        <title>Ward <?php echo $wardno; ?> || Need requests</title>
    </head>
    <body>
	    <section class="main">
            <!-- ==========Sidebar============= -->
            <?php
                include '../../layout/ward_member/sidebar_need_req.php';
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
                        <input type="text" name="hsearch" placeholder="Search..." id="live-search" autocomplete="off" onkeyup="searchHouse(this.value)">
                    </div>
                </div>
                <div class="request">
                    <a href="">
                        View history
                    </a>
                </div>


                <div class="headings">
                    <div>Slno.</div>
                    <div style="margin-left: 58px;">Username</div>
                    <div style="margin-left: 105px;">Forwarded from</div>
                    <div style="margin-left: 70px;">House no.</div>
                    <div style="margin-left: 58px;">Message</div>
                    <div style="margin-left: 306px;">Proof</div>
                    <div style="margin-left: 123px;">Action</div>
                </div>

                <div class="datas" id="search-result">
                    <!-- inject search result -->
                </div>

                <div class="allResult">
                    <?php
                        $query="SELECT `id`, `houseno`, `userid`, `description`, `proof_file`, `office_staff` FROM `tbl_need_request` WHERE `wardno`='$wardno' AND `status`='1'";
                        $result=mysqli_query($conn,$query);
                        $i=1;
                        while($row=mysqli_fetch_array($result)){
                            $memId=$row['userid'];
                            $memberQuery="SELECT `fname` FROM `tbl_house_member` WHERE `userid`='$memId'";
                            $memberQueryResult=mysqli_query($conn,$memberQuery);
                            $dataFetched=mysqli_fetch_assoc($memberQueryResult);
                            $memberName=$dataFetched['fname'];
                    ?>
                    <div class="data">
                        <table>
                            <tr>
                                <td width=98px><?php echo $i; ?></td>
                                <td width=199px><?php echo $memberName; ?></td>
                                <td width=226px><?php echo $row['office_staff']; ?></td>
                                <td width=148px><?php echo $row['houseno']; ?></td>
                                <td width=393px style="padding-right: 58px;"><?php echo $row['description']; ?></td>
                                <td width=172px>
                                    <?php
                                        if($row['proof_file']!='0'){
                                    ?>
                                            <a href="../<?php echo $row['proof_file']; ?>" download class="view">View</a>
                                    <?php
                                        }else{
                                    ?>
                                            <div class="no-file">Not uploaded</div>
                                    <?php
                                        }
                                    ?>
                                </td>
                                <td width=95px>
                                    <a class="approve" onclick="approveItem(<?php $rejId=$row['id']; echo $rejId; ?>)">Approve</a>
                                </td>
                                <td width=73px>
                                    <a class="reject" onclick="deleteItem(<?php $rejId=$row['id']; echo $rejId; ?>)">Reject</a>
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
        <!-- form to approve need request-->
        <div class="box modal-box-app modal-hidden">
            <div class="title"> Reply to house member </div>
            <div class="modal-close-btn app-close">
                <img src="../../../../public/assets/images/close.svg" alt="close button">
            </div>
            <form action="../../../model/ward_member/approve_need_req.php" method="post" id="approve-form" enctype="multipart/form-data">
                <input type="hidden" name="approveId" id="approveItemId">
                <div class="inputs">
                    <textarea name="app_reason" id="appreason" rows="10"></textarea>
                    <div class="button aBtn cursor-disable">
                        <input type="submit" value="Continue" name="approve_need_req" id="app" onclick="loader()"
                            class="primary-button disabled">
                    </div>
                </div>
            </form>
        </div>

        <!-- form to reject need request-->
        <div class="box modal-box-rej modal-hidden">
            <div class="title"> Reason for rejection </div>
            <div class="modal-close-btn rej-close">
                <img src="../../../../public/assets/images/close.svg" alt="close button">
            </div>
            <form action="../../../model/ward_member/reject_need_request.php" method="post" id="reject-form" enctype="multipart/form-data">
                <input type="hidden" name="rejectId" id="rejectItemId">
                <div class="inputs">
                    <textarea name="rej_reason" id="rejreason" rows="10"></textarea>
                    <div class="button rBtn cursor-disable">
                        <input type="submit" value="Continue" name="reject_need_req" id="rejB" onclick="loader()"
                            class="primary-button disabled">
                    </div>
                </div>
            </form>
        </div>

        <script>
            let deleteItem = (DataId) => {
                document.getElementById('rejectItemId').value = DataId;
            }

            let approveItem = (DataId) => {
                document.getElementById('approveItemId').value = DataId;
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
        
        <script src="../../../../public/assets/js/wm_need_req.js"></script>
        <script src="../../../../public/assets/js/toast.js"></script>
    </body>
    </html>
<?php
    }
?>