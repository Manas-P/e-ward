<?php
    include '../../config/dbcon.php';
    session_start();
    extract($_POST);

    if(isset($_POST['add-task'])){
        $insertQuery="INSERT INTO `tbl_task`(`c_id`, `task_name`, `task_des`) VALUES ('$comid','$taskname','$task_des')";
        $insertQueryRes=mysqli_query($conn,$insertQuery);
        if($insertQueryRes){
            $_SESSION['success'] = "Task added successfully";
            header("Location: ../../view/pages/ward_member/view_committee.php?c_id=$comid");
        }else{
            $_SESSION['error'] = "Error in adding task";
            header("Location: ../../view/pages/ward_member/view_committee.php?c_id=$comid");
        }
    }
?>