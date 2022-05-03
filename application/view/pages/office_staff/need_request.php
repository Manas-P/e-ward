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

        //Fetch restrictions
        $restrictions="SELECT `m_house`, `m_committee`, `m_complaint` FROM `tbl_office_staff` WHERE `userid`='$userid'";
        $restrictionsResult=mysqli_query($conn,$restrictions);
        $dataFetched=mysqli_fetch_assoc($restrictionsResult);
        $m_house=$dataFetched['m_house'];
        $m_complaint=$dataFetched['m_complaint'];
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
        <title>Ward <?php echo $wardno; ?> || Houses</title>
    </head>
    <body>
	    <section class="main">
            <!-- ==========Sidebar============= -->
            <?php
                include '../../layout/office_staff/sidebar_need_request.php';
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
                    <div class="request">
                        <a href="">
                            View history
                        </a>
                    </div>
                <div class="headings">
                    <div>Slno.</div>
                    <div style="margin-left: 58px;">Username</div>
                    <div style="margin-left: 118px;">House no.</div>
                    <div style="margin-left: 83px;">Message</div>
                    <div style="margin-left: 472px;">Proof</div>
                    <div style="margin-left: 137px;">Action</div>
                </div>

                <div class="datas" id="search-result">
                    <!-- inject search result -->
                </div>

                <div class="allResult">
                    <?php
                        $query="SELECT `houseno`, `userid`, `description`, `proof_file` FROM `tbl_need_request` WHERE `wardno`='$wardno' AND `status`='0'";
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
                                <td width=212px><?php echo $memberName; ?></td>
                                <td width=173px><?php echo $row['houseno']; ?></td>
                                <td width=567px style="padding-right: 60px;"><?php echo $row['description']; ?></td>
                                <td width=186px>
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
                                    <a href="" class="approve" onclick="loader()">Approve</a>
                                </td>
                                <td width=73px>
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
    </body>
    </html>
<?php
    }
?>