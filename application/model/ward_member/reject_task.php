<?php
    include '../../config/dbcon.php';
    session_start();
    extract($_POST);

    if(isset($_POST['reject_task_req'])){

        //Fetch email
        $query="SELECT `email`, `fname` FROM `tbl_house_member` WHERE `userid`='$userId'";
        $result=mysqli_query($conn,$query);
        $userData=mysqli_fetch_assoc($result);
        $toMail=$userData["email"];
        $name=$userData["fname"];

        //Fetch task report name
        $taskQuery="SELECT `title` FROM `tbl_task_report` WHERE `id`='$rejIdd'";
        $taskRes=mysqli_query($conn,$taskQuery);
        $taskData=mysqli_fetch_assoc($taskRes);
        $taskName=$taskData["title"];

        //Send mail
        $subject="E-Ward Task Report Rejection";
        $headers="From: E-WardSupport";
        $body="Dear $fname, your task report with title: $taskName as been rejected due to the reason: $rej_reason";
        if(mail($toMail,$subject,$body,$headers)){
            $update="UPDATE `tbl_task_report` SET `status`='2' WHERE `id`='$rejIdd'";
            $updateRes=mysqli_query($conn, $update);
            if($updateRes){
                $_SESSION['success'] = "Task report rejected successfully";
                header("Location: ../../view/pages/ward_member/task_approval.php?c_id=$cId&tskId=$tskId&userid=$userId");
            }else{
                $_SESSION['error'] = "Task report rejection failed";
                header("Location: ../../view/pages/ward_member/task_approval.php?c_id=$cId&tskId=$tskId&userid=$userId");
            }
        }else{
            $_SESSION['error'] = "Mail not send";
            header("Location: ../../view/pages/ward_member/task_approval.php?c_id=$cId&tskId=$tskId&userid=$userId");
        }
    }
?>