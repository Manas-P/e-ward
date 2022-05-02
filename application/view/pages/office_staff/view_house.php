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
        $userid=$_SESSION['userid'];

        $houseno=$_GET['houseno'];

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
        <link rel="stylesheet" href="../../../../public/assets/css/ward_member/view_house.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <title>Ward <?php echo $wardno; ?> || View house</title>
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
                        House no. <?php echo $houseno; ?>
                    </a>
                </div>
                <!-- Content -->
                <div class="head">
                    <div class="heading">
                        House details
                    </div>
                    <?php
                        if($m_house==1){
                    ?>
                    <div class="buttons">
                        <input type="button" value="Update" class="p-btn" id="up-house">
                        <input type="button" value="Delete" class="s-btn red" id="delete-house">
                    </div>
                    <?php
                        }else{}
                    ?>
                </div>
                <!-- House details -->
                <!-- Fetch house details -->
                <?php
                    $house_data="SELECT `house_name`, `locality`, `post_office`, `ration_no`, `category` FROM `tbl_house` WHERE `house_no`='$houseno'";
                    $house_dataResult=mysqli_query($conn,$house_data);
                    $houseData=mysqli_fetch_assoc($house_dataResult);
                    $hName=$houseData['house_name'];
                    $hLocality= $houseData['locality'];
                    $hPost=$houseData['post_office'];
                    $hRationNo=$houseData['ration_no'];
                    $hCategory=$houseData['category'];

                    //Fetch house owner
                    $ownerId=$wardno . $houseno . "0";
                    $houseOwnerQuery="SELECT `fname` FROM `tbl_house_member` WHERE `userid`='$ownerId'";
                    $houseOwnerResult=mysqli_query($conn,$houseOwnerQuery);
                    $houseOwnerData=mysqli_fetch_assoc($houseOwnerResult);
                    $houseOwner=$houseOwnerData['fname'];

                    //Fetch house member count
                    $membersFetch="SELECT `fname`, `email`, `phno`, `blood_grp`, `dob`, `photo`, `userid` FROM `tbl_house_member` WHERE `house_no`='$houseno'";
                    $membersFetchResult=mysqli_query($conn,$membersFetch);
                    $memebrCount = mysqli_num_rows($membersFetchResult);
                ?>
                <div class="details">
                    <div class="content">
                        <div class="detail">
                            <div class="tag"> House no.: </div>
                            <div class="ans"> <?php echo $houseno; ?> </div>
                        </div>
                        <div class="detail">
                            <div class="tag">  House name: </div>
                            <div class="ans"> <?php echo $hName; ?> </div>
                        </div>
                    </div>
                    <div class="content">
                        <div class="detail">
                            <div class="tag"> Members: </div>
                            <div class="ans"> <?php echo $memebrCount; ?> members </div>
                        </div>
                        <div class="detail">
                            <div class="tag"> Locality: </div>
                            <div class="ans"> <?php echo $hLocality; ?> </div>
                        </div>
                    </div>
                    <div class="content">
                        <div class="detail">
                            <div class="tag"> Post office: </div>
                            <div class="ans"> <?php echo $hPost; ?> </div>
                        </div>
                        <div class="detail">
                            <div class="tag"> Ration no.: </div>
                            <div class="ans"> <?php echo $hRationNo; ?> </div>
                        </div>
                    </div>
                    <div class="content">
                        <div class="detail">
                            <div class="tag"> Category: </div>
                            <div class="ans"> <?php echo $hCategory; ?> </div>
                        </div>
                        <div class="detail">
                            <div class="tag"> Owner: </div>
                            <div class="ans"> <?php echo $houseOwner; ?> </div>
                        </div>
                    </div>
                </div>

                <!-- House members -->
                <div class="title">
                    Members
                </div>
                <div class="members">
                    <?php 
                        while($memberData = mysqli_fetch_assoc($membersFetchResult)){
                            $age = (date('Y') - date('Y',strtotime($memberData["dob"])));
                    ?>
                    <div class="member">
                        <div class="photo">
                            <img src="../<?php echo $memberData['photo']; ?>" alt="">
                        </div>
                        <div class="contents">
                            <div class="content">
                                <div class="tag">Name:</div>
                                <div class="ans"><?php echo $memberData["fname"]; ?></div>
                            </div>
                            <div class="content">
                                <div class="tag">Date of birth:</div>
                                <div class="ans"><?php echo $memberData["dob"]; ?></div>
                            </div>
                            <div class="content">
                                <div class="tag">Age:</div>
                                <div class="ans"><?php echo $age; ?></div>
                            </div>
                            <div class="content">
                                <div class="tag">Blood group:</div>
                                <div class="ans"><?php echo $memberData["blood_grp"]; ?></div>
                            </div>
                            <div class="content">
                                <div class="tag">Email id:</div>
                                <div class="ans"><?php echo $memberData["email"]; ?></div>
                            </div>
                            <div class="content">
                                <div class="tag">Phone number:</div>
                                <div class="ans"><?php echo $memberData["phno"]; ?></div>
                            </div>
                        </div>
                        <?php
                            if($m_house==1){
                        ?>
                        <div class="buttons">
                            <input type="button" value="Update" class="s-btn">
                            <input type="button" value="Delete" class="s-btn red" id="delete-member-btn" onclick="deletemember(<?php echo $memberData['userid']; ?>)">
                        </div>
                        <?php
                            }else{}
                        ?>
                    </div>
                    <?php
                        }
                    ?>
                </div>
                
            </div>
        </section>

        <!-- =========== Modal ============ -->
        <div class="overlay modal-hidden"></div>
        <!-- Modal to update house details-->
        <div class="box modal-box1 modal-hidden">
            <div class="title"> Update house </div>
            <div class="modal-close-btn">
                <img src="../../../../public/assets/images/close.svg" alt="close button">
            </div>
            <!-- Update house details -->
            <form action="../../../model/ward_member/update_house.php" method="post" id="update-house" enctype="multipart/form-data">
                <input type="hidden" name="wardno" value="<?php echo $wardno ?>">
                <input type="hidden" name="houseno" value="<?php echo $houseno ?>">
                <div class="inputs">
                    <div class="input h-name">
                        <div class="label"> House name </div>
                        <input type="text" name="hname" id="h-name" value="<?php echo $hName;?>" autocomplete="off">
                        <div class="error error-hidden">
                        </div>
                    </div>
                    <div class="input h-locality">
                        <div class="label"> Locality </div>
                        <input type="text" name="hlocality" id="h-locality" value="<?php echo $hLocality;?>" autocomplete="off">
                        <div class="error error-hidden">
                        </div>
                    </div>
                    <div class="input h-post">
                        <div class="label"> Post office </div>
                        <input type="text" name="hpost" id="h-post" value="<?php echo $hPost;?>" autocomplete="off">
                        <div class="error error-hidden">
                        </div>
                    </div>
                    <div class="input h-owner">
                        <div class="label"> House owner </div>
                        <select name="newOwnerId" id="" class="select">
                            <option value="<?php echo $ownerId ?>" selected>Select new owner</option>
                            <?php
                                $membersFetch="SELECT `userid`,`fname`, `email`, `phno`, `blood_grp`, `dob`, `photo` FROM `tbl_house_member` WHERE `house_no`='$houseno'";
                                $membersFetchResult=mysqli_query($conn,$membersFetch);
                                while($memberData = mysqli_fetch_assoc($membersFetchResult)){
                            ?>
                            <option value="<?php echo $memberData['userid']; ?>"><?php echo $memberData['fname']; ?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class="input h-ration">
                        <div class="label"> Ration number </div>
                        <input type="number" name="hration" id="h-ration" value="<?php echo $hRationNo;?>" autocomplete="off">
                        <div class="error error-hidden">
                        </div>
                    </div>
                    <div class="button hBtn">
                        <input type="submit" value="Update house details" name="up-h" id="up-h" onclick="loader()" class="primary-button">
                    </div>
                </div>
            </form>
        </div>

        <!-- form to delete house -->
        <div class="box modal-box2 modal-hidden">
            <div class="title"> Reason to delete </div>
            <div class="modal-close-btn close-delete">
                <img src="../../../../public/assets/images/close.svg" alt="close button">
            </div>
            <form action="../../../model/ward_member/update_house.php" method="post" id="delete-house-form" enctype="multipart/form-data">
                <input type="hidden" name="hownerdel" value="<?php echo $ownerId ?>">
                <input type="hidden" name="housenodel" value="<?php echo $houseno ?>">
                <div class="inputs">
                    <textarea name="hdel_reason" id="hdelreason" rows="10"></textarea>
                    <div class="button dBtn cursor-disable">
                        <input type="submit" value="Delete house" name="deleteHouseBtn" id="delhBtn" onclick="loader()" class="primary-button disabled">
                    </div>
                </div>
            </form>
        </div>

        <!-- form to delete house member -->
        <div class="box modal-box3 modal-hidden">
            <div class="title"> Reason to delete </div>
            <div class="modal-close-btn close-delete-mem">
                <img src="../../../../public/assets/images/close.svg" alt="close button">
            </div>
            <form action="../../../model/ward_member/update_house.php" method="post" id="delete-member-form" enctype="multipart/form-data">
                <input type="hidden" name="HiddenItemId" id="hiddenMemId">
                <input type="hidden" name="housenodel" value="<?php echo $houseno ?>">
                <div class="inputs">
                    <textarea name="mdel_reason" id="mdelreason" rows="10"></textarea>
                    <div class="button dmBtn cursor-disable">
                        <input type="submit" value="Delete house member" name="deleteMemberBtn" id="delmBtn" onclick="loader()" class="primary-button disabled">
                    </div>
                </div>
            </form>
        </div>

        <!-- To delete respected house member -->
        <script>
            let deletemember = (memberId) => {
                document.getElementById('hiddenMemId').value = memberId;

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

        <script src="../../../../public/assets/js/wm_view_house.js"></script>
        <script src="../../../../public/assets/js/toast.js"></script>
    </body>
</html>
	<?php
}
?>