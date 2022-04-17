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

        $houseno=$_GET['houseno'];
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
            include '../../layout/ward_member/sidebar_houses.php';
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
                    <div class="buttons">
                        <input type="button" value="Update" class="p-btn">
                        <input type="button" value="Delete" class="s-btn red">
                    </div>
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
                    $membersFetch="SELECT `hm_id` FROM `tbl_house_member` WHERE `house_no`='$houseno'";
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