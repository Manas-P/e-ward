<?php
    include '../../config/dbcon.php';
    session_start();
    extract($_POST);

    //Input Sanitization
    $hname = trim($hname); 
    $hname=mysqli_real_escape_string($conn,$hname);
    $hname=filter_var($hname, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

    $locality = trim($locality); 
    $locality=mysqli_real_escape_string($conn,$locality);
    $locality=filter_var($locality, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

    $po = trim($po); 
    $po=mysqli_real_escape_string($conn,$po);
    $po=filter_var($po, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

    $rano = trim($rano);
    $rano=mysqli_real_escape_string($conn,$rano);
    $rano=filter_var($rano, FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);

    //First time Update profile (House member)
    if(isset($_POST['upbtn'])){
        $insHouse = "INSERT INTO `tbl_house`(`house_name`, `house_no`, `ward_no`, `locality`, `post_office`, `ration_no`, `category`) VALUES ('$hname', '$houno', '$wardno','$locality','$po','$rano','$rationCat')";
        $insHouseRes=mysqli_query($conn,$insHouse);
        if($insHouseRes){
            echo "<script>window.location='../../view/pages/house_member/street_light.php'</script>";
            // header("Location: ../../view/pages/house_member/update_house_details.php");
            $_SESSION['success'] = "House Info Added";
        }else{
            echo "<script>window.location='../../view/pages/house_member/street_light.php'</script>";
            // header("Location: ../../view/pages/house_member/update_house_details.php");
            $_SESSION['error'] = "Error in adding house details";
        }
    }

    //Update House Details (House member)
    if(isset($_POST['uphbtn'])){
        $updateh="UPDATE `tbl_house` SET `house_name`='$hname', `locality`='$locality', `post_office`='$po', `category`='$rationCat' WHERE `ward_no`='$wardno' and `house_no`='$houno'";
        // $insHouse = "INSERT INTO `tbl_house`(`rid`, `house_name`, `house_no`, `ward_no`, `locality`, `post_office`, `ration_no`, `category`) VALUES ('$rid','$hname', '$houno', '$wardno','$locality','$po','$rano','$rationCat')";
        $upHouseRes=mysqli_query($conn,$updateh);
        if($upHouseRes){
            echo "<script>window.location='../../view/pages/house_member/street_light.php'</script>";
            // header("Location: ../../view/pages/house_member/update_house_details.php");
            $_SESSION['success'] = "House Info Updated Successfully";
        }else{
            echo "<script>window.location='../../view/pages/house_member/street_light.php'</script>";
            // header("Location: ../../view/pages/house_member/update_house_details.php");
            $_SESSION['error'] = "Error in adding house details";
        }
    }
?>