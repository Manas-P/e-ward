<?php
    include '../../config/dbcon.php';
    session_start();
    
    $id=$_GET['id'];
    $tskId=$_GET['tskId'];
    $userId=$_GET['userId'];
    $cId=$_GET['cId'];
    $updateQuery="UPDATE `tbl_task_report` SET `status`='1' WHERE `id`='$id'";
    $updateQueryResult=mysqli_query($conn,$updateQuery);
    if($updateQueryResult){
        $_SESSION['success'] = "Task approved successfully";
        header("Location: ../../view/pages/ward_member/task_approval.php?c_id=$cId&tskId=$tskId&userid=$userId");
    }else{
        $_SESSION['error'] = "Error in approving task";
        header("Location: ../../view/pages/ward_member/task_approval.php?c_id=$cId&tskId=$tskId&userid=$userId");
    }
?>
<a href="../../view/pages/ward_member/task_approval.php"></a>