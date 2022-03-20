<?php
    include '../../config/dbcon.php';
    $wardno=$_GET['wardno'];
    $presidentUpdate="UPDATE `tbl_ward_member` SET `president`=1 WHERE `wardno`='$wardno'";
    $updateResult=mysqli_query($conn,$presidentUpdate);
    if($updateResult){
        $_SESSION['success'] = "President added successfully";
        header("Location: ../../view/pages/admin/admin_add_wm.php");
    }else{
        $_SESSION['error'] = "Error in adding president";
        header("Location: ../../view/pages/admin/admin_add_wm.php");
    }
?>