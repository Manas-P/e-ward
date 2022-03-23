<?php
    include '../../config/dbcon.php';
    session_start();
    extract($_POST);

    //First time Update profile (House member)
    if(isset($_POST['upbtn'])){
        $insHouse = "INSERT INTO `tbl_house`(`house_name`, `house_no`, `ward_no`, `locality`, `post_office`, `ration_no`, `category`) VALUES ('$hname', '$houno', '$wardno','$locality','$po','$rano','$rationCat')";
        $insHouseRes=mysqli_query($conn,$insHouse);
        if($insHouseRes){
            header("Location: ../../view/pages/house_member/update_house_details.php");
            $_SESSION['success'] = "House Info Added";
        }else{
            header("Location: ../../view/pages/house_member/update_house_details.php");
            $_SESSION['error'] = "Error in adding house details";
        }
    }

    //Update House Details (House member)
    if(isset($_POST['uphbtn'])){
        $updateh="UPDATE `tbl_house` SET `house_name`='$hname', `locality`='$locality', `post_office`='$po', `category`='$rationCat' WHERE `ward_no`='$wardno' and `house_no`='$houno'";
        // $insHouse = "INSERT INTO `tbl_house`(`rid`, `house_name`, `house_no`, `ward_no`, `locality`, `post_office`, `ration_no`, `category`) VALUES ('$rid','$hname', '$houno', '$wardno','$locality','$po','$rano','$rationCat')";
        $upHouseRes=mysqli_query($conn,$updateh);
        if($upHouseRes){
            header("Location: ../../view/pages/house_member/update_house_details.php");
            $_SESSION['success'] = "House Info Updated Successfully";
        }else{
            header("Location: ../../view/pages/house_member/update_house_details.php");
            $_SESSION['error'] = "Error in adding house details";
        }
    }
?>