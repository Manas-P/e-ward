<?php
    include '../../config/dbcon.php';
    session_start();
    extract($_POST);

    $wardno=$_SESSION['wardno'];
    if(isset($_POST['add-not'])){

        $checkboxes=$_POST['notifi'];
        $parts="";
        foreach($checkboxes as $part)  
        {  
            $parts .= $part.", ";
        }
        if($parts=="House members, "){
            $insertQuery="INSERT INTO `tbl_notification`(`wardno`, `notification_title`, `notification_des`, `notification_for`, `hm`) VALUES ('$wardno','$notName','$not_des','$parts','1')";
        }
        if($parts=="House members, Office staffs, "){
            $insertQuery="INSERT INTO `tbl_notification`(`wardno`, `notification_title`, `notification_des`, `notification_for`, `hm`, `os`) VALUES ('$wardno','$notName','$not_des','$parts','1','1')";
        }
        if($parts=="Office staffs, "){
            $insertQuery="INSERT INTO `tbl_notification`(`wardno`, `notification_title`, `notification_des`, `notification_for`, `os`) VALUES ('$wardno','$notName','$not_des','$parts','1')";
        }
        $queryResult=mysqli_query($conn,$insertQuery);
        if($queryResult){
            $_SESSION['success'] = "Notification added successfully";
            echo "<script>window.location='../../view/pages/ward_member/notification.php'</script>";
            // header("Location: ../../view/pages/ward_member/notification.php");
        }else{
            $_SESSION['error'] = "Error in adding notification";
            echo "<script>window.location='../../view/pages/ward_member/notification.php'</script>";
            // header("Location: ../../view/pages/ward_member/notification.php");
        }
    }
?>
