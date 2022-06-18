<?php
    include '../../config/dbcon.php';
    session_start();
    
    $id=$_GET['id'];
    $tskId=$_GET['tskId'];
    $userId=$_GET['userId'];
    $cId=$_GET['cId'];
    $updateQuery="UPDATE `tbl_task_report` SET `status`='1' WHERE `id`='$id'";
    $updateQueryResult=mysqli_query($conn,$updateQuery);

    //Check number of pending tasks
    $pend="SELECT `id` FROM `tbl_task_report` WHERE `tsk_id`='$tskId' AND `userid`='$userId' AND `com_id`='$cId' AND `status`='0'";
    $pendResult = mysqli_query($conn, $pend);
    $checkCountPend = mysqli_num_rows($pendResult);
    if($checkCountPend==0){
        //Check number of approved tasks
        $app="SELECT `id` FROM `tbl_task_report` WHERE `tsk_id`='$tskId' AND `userid`='$userId' AND `com_id`='$cId' AND `status`='1'";
        $appResult = mysqli_query($conn, $app);
        $checkCountapp = mysqli_num_rows($appResult);
        if($checkCountapp!=0){
            $up="UPDATE `tbl_task_member` SET `status`='1' WHERE `tsk_id`='$tskId' AND `userid`='$userId' AND `com_id`='$cId'";
            mysqli_query($conn,$up);
        }
    }

    if($updateQueryResult){
        $_SESSION['success'] = "Task approved successfully";
        echo "<script>window.location='../../view/pages/ward_member/task_approval.php?c_id=".$cId."&tskId=".$tskId."&userid=".$userId."'</script>";
        // header("Location: ../../view/pages/ward_member/task_approval.php?c_id=$cId&tskId=$tskId&userid=$userId");
    }else{
        $_SESSION['error'] = "Error in approving task";
        echo "<script>window.location='../../view/pages/ward_member/task_approval.php?c_id=".$cId."&tskId=".$tskId."&userid=".$userId."'</script>";
        // header("Location: ../../view/pages/ward_member/task_approval.php?c_id=$cId&tskId=$tskId&userid=$userId");
    }
?>