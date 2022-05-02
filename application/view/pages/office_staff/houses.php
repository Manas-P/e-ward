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
        <link rel="stylesheet" href="../../../../public/assets/css/ward_member/wm_houses.css">
        <title>Ward <?php echo $wardno; ?> || Houses</title>
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
                        <input type="text" name="hsearch" placeholder="Search..." id="live-search" autocomplete="off" onkeyup="searchHouse(this.value)">
                    </div>
                </div>
                <?php
                    if($m_house==1){
                ?>
                    <div class="request">
                        <a href="./houses_request.php">
                            View requests
                        </a>
                        <span class="noti-badge">
                            <!-- Fetch registration request -->
                            <?php
                                $query="SELECT `rid` FROM `tbl_registration` WHERE `wardno`='$wardno' AND `status`='0'";
                                $result=mysqli_query($conn,$query);
                                echo mysqli_num_rows($result);
                            ?>
                        </span>
                    </div>
                <?php
                    }else{}
                ?>
                <div class="headings">
                    <div>Slno.</div>
                    <div style="margin-left: 70px;">House name</div>
                    <div style="margin-left: 124px;">House no.</div>
                    <div style="margin-left: 50px;">Members</div>
                    <div style="margin-left: 50px;">Locality</div>
                    <div style="margin-left: 155px;">Post office</div>
                    <div style="margin-left: 134px;">Ration card no.</div>
                    <div style="margin-left: 80px;">Category</div>
                </div>

                <div class="datas" id="search-result">
                    <!-- inject search result -->
                </div>

                <div class="allResult">
                    <?php
                        $query="SELECT `house_name`, `house_no`, `locality`, `post_office`, `ration_no`, `category` FROM `tbl_house` WHERE `ward_no`='$wardno'";
                        $result=mysqli_query($conn,$query);
                        $i=1;
                        while($row=mysqli_fetch_array($result)){
                    ?>
                    <a href="./view_house.php?houseno=<?php echo $row['house_no'];?>" class="data">
                        <table>
                            <tr>
                                <td width=104px><?php echo $i; ?></td>
                                <td width=238px><?php echo $row['house_name']; ?></td>
                                <td width=140px><?php echo $row['house_no']; ?></td>
                                <td width=132px>4</td>
                                <td width=226px><?php echo $row['locality']; ?></td>
                                <td width=228px><?php echo $row['post_office']; ?></td>
                                <td width=220px><?php echo $row['ration_no']; ?></td>
                                <td><?php echo $row['category']; ?></td>
                            </tr>
                        </table>
                    </a>
                    <?php
                        $i=$i+1;
                        }
                    ?>
                </div>
            </div>
        </section>
        <script>
            function searchHouse(item){
                if(item.length!=0){
                    document.querySelector(".allResult").classList.add("displayNone");
                    document.querySelector(".datas").classList.remove("displayNone");
                    const wardno='<?php echo $wardno?>';
                    $.ajax({
                        url:"../../../model/ward_member/search_house.php",
                        method:"POST",
                        data:{
                            item:item,
                            wardno:wardno
                        },
                        success:function(data){
                            $("#search-result").html(data);
                        }
                    })
                }else{
                    document.querySelector(".allResult").classList.remove("displayNone");
                    document.querySelector(".datas").classList.add("displayNone");
                }
            }
        </script>
    </body>
    </html>
<?php
    }
?>