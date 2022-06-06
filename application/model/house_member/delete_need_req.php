<?php
    include '../../config/dbcon.php';
    session_start();
    
    $id=$_GET['id'];
    $deleteQuery="DELETE FROM `tbl_need_request` WHERE `id`='$id'";
    $deleteQueryResult=mysqli_query($conn,$deleteQuery);
    if($deleteQueryResult){
        $_SESSION['success'] = "Request deleted successfully";
        header("Location: ../../view/pages/house_member/add_need_request.php");
    }else{
        $_SESSION['error'] = "Error in deleting request";
        header("Location: ../../view/pages/house_member/add_need_request.php");
    }
?>