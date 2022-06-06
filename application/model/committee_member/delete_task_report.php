<?php
    include '../../config/dbcon.php';
    session_start();
    
    $id=$_GET['id'];
    $tskId=$_GET['tskId'];
    $deleteQuery="DELETE FROM `tbl_task_report` WHERE `id`='$id'";
    $deleteQueryResult=mysqli_query($conn,$deleteQuery);
    if($deleteQueryResult){
        $_SESSION['success'] = "Task deleted successfully";
        header("Location: ../../view/pages/committee_member/view_task.php?tskId=$tskId");
    }else{
        $_SESSION['error'] = "Error in deleting task";
        header("Location: ../../view/pages/committee_member/view_task.php?tskId=$tskId");
    }
?>