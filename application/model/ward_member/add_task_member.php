<?php
    include '../../config/dbcon.php';
    session_start();
    
    $c_id=$_GET['c_id'];
    $tsk_id=$_GET['tskId'];
    $u_id=$_GET['memId'];

    $insertQuery="INSERT INTO `tbl_task_member`(`com_id`, `tsk_id`, `userid`) VALUES ('$c_id','$tsk_id','$u_id') ;
                  UPDATE `tbl_task` SET `assignees`=`assignees` + 1 WHERE `id`='$tsk_id' AND `c_id`='$c_id'";
    $insertQueryRes=mysqli_multi_query($conn, $insertQuery);
    if($insertQueryRes){
        $_SESSION['success'] = "Member added successfully";
        header("Location: ../../view/pages/ward_member/view_task.php?c_id=$c_id&tskId=$tsk_id");
    }else{
        $_SESSION['error'] = "Error in adding member";
        header("Location: ../../view/pages/ward_member/view_task.php?c_id=$c_id&tskId=$tsk_id");
    }
?>