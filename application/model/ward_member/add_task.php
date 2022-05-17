<?php
    include '../../config/dbcon.php';
    session_start();
    extract($_POST);

    $curDate = date('Y-m-d');
    $wardno=$_SESSION['wardno'];

    if(isset($_POST['add-task'])){
        $insertQuery="INSERT INTO `tbl_task`(`c_id`, `task_name`, `task_des`, `created_by`, `created_date`, `deadline`) VALUES ('$comid','$taskname','$task_des','$wardno','$curDate','$taskdate')";
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