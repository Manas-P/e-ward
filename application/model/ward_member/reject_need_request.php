<?php
    include '../../config/dbcon.php';
    session_start();
    extract($_POST);

    $rejId=$_POST['rejectId'];

    if(isset($_POST['reject_need_req'])){
        $appQuery="UPDATE `tbl_need_request` SET `status`='3',`reply`='$rej_reason' WHERE `id`='$rejId'";
        $appQueryResult=mysqli_query($conn,$appQuery);
        if($appQueryResult){
            $_SESSION['success'] = "Need request rejected successfully";
            echo "<script>window.location='../../view/pages/ward_member/need_request.php'</script>";
            // header("Location: ../../view/pages/ward_member/need_request.php");
        }else{
            $_SESSION['error'] = "Error";
            echo "<script>window.location='../../view/pages/ward_member/need_request.php'</script>";
            // header("Location: ../../view/pages/ward_member/need_request.php");
        }
    }
?>