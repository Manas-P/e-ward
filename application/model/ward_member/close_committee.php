<?php
    include '../../config/dbcon.php';
    session_start();
    $c_id=$_GET['c_id'];

    $updateQuery="UPDATE `tbl_committee` SET `status`='0' WHERE `c_id`='$c_id'";
    $updateQueryRes=mysqli_multi_query($conn, $updateQuery);
    if($updateQueryRes){
        $_SESSION['success'] = "Successfully closed the committee";
        header("Location: ../../view/pages/ward_member/committees.php");
    }else{
        $_SESSION['error'] = "Error in closing committee";
        header("Location: ../../view/pages/ward_member/committees.php");
    }
?>