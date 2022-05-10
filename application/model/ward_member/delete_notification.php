<?php
    include '../../config/dbcon.php';
    session_start();
    extract($_POST);
    $id=$_GET['id'];

    $query="DELETE FROM `tbl_notification` WHERE `id`='$id'";
    $queryResult=mysqli_query($conn,$query);
    if($queryResult){
    $_SESSION['success'] = "Notification deleted successfully";
        header("Location: ../../view/pages/ward_member/notification.php");
    }else{
        $_SESSION['error'] = "Error in deleting notification";
        header("Location: ../../view/pages/ward_member/notification.php");
    }
?>