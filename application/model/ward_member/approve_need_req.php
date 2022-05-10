<?php
    include '../../config/dbcon.php';
    session_start();
    extract($_POST);

    $appId=$_POST['approveId'];

    if(isset($_POST['approve_need_req'])){
        $appQuery="UPDATE `tbl_need_request` SET `status`='2',`reply`='$app_reason' WHERE `id`='$appId'";
        $appQueryResult=mysqli_query($conn,$appQuery);
        if($appQueryResult){
            $_SESSION['success'] = "Need request approved successfully";
            header("Location: ../../view/pages/ward_member/need_request.php");
        }else{
            $_SESSION['error'] = "Error";
            header("Location: ../../view/pages/ward_member/need_request.php");
        }
    }
?>