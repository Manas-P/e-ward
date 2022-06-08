<?php
    include '../../config/dbcon.php';
    session_start();
    extract($_POST);

    //Reject House registeration request
    if(isset($_POST['reject_house_req'])){
        $rejId=$_POST['HiddenItemId'];
        $body=$_POST['rej_reason'];
        $query="SELECT `email`,`houseno` FROM `tbl_registration` WHERE `rid`='$rejId'";
        $result=mysqli_query($conn,$query);
        $userData=mysqli_fetch_assoc($result);
        $toMail=$userData["email"];
        $houseNo=$userData["houseno"];

        //Check if the action is done by office staff
        $officeId=$_SESSION['userid'];
        //Fetch staff details
        if($officeId!=""){
            $officeStaff="SELECT `name` FROM `tbl_office_staff` WHERE `userid`='$officeId'";
            $officeStaffResult=mysqli_query($conn,$officeStaff);
            $dataFetched=mysqli_fetch_assoc($officeStaffResult);
            $sName=$dataFetched['name'];
            $activity="Rejected house having house number: $houseNo with reason: $body";
            date_default_timezone_set('Asia/Kolkata');
            $date_time = date("Y-m-d H:i:s", time ());
        }

        //Send mail
        $subject="E-Ward House Rejection";
        $headers="From: ewardmember@gmail.com";
        if(mail($toMail,$subject,$body,$headers)){
            //Check if the action is done by office staff
            if($officeId!=""){
                mysqli_multi_query($conn,"DELETE FROM `tbl_registration` WHERE `rid`='$rejId' ; INSERT INTO `tbl_staff_activity`(`userid`, `name`, `activity`, `date_time`) VALUES ('$officeId','$sName','$activity','$date_time')");
                echo "<script>window.location='../../view/pages/office_staff/houses_request.php'</script>";
                // header("Location: ../../view/pages/office_staff/houses_request.php");
            }else{
                mysqli_multi_query($conn,"DELETE FROM `tbl_registration` WHERE `rid`='$rejId'");
                echo "<script>window.location='../../view/pages/ward_member/houses_request.php'</script>";
                // header("Location: ../../view/pages/ward_member/houses_request.php");
            }
        }else{
            if($officeId!=""){
                $_SESSION['error'] = "Mail not send";
                echo "<script>window.location='../../view/pages/office_staff/houses_request.php'</script>";
                // header("Location: ../../view/pages/office_staff/houses_request.php");
            }else{
                $_SESSION['error'] = "Mail not send";
                echo "<script>window.location='../../view/pages/ward_member/houses_request.php'</script>";
                // header("Location: ../../view/pages/ward_member/houses_request.php");
            }
        }
    }
?>