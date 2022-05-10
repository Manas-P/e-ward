<?php
    include '../../config/dbcon.php';
    session_start();
    extract($_POST);

    //Fetch details
    $rejId=$_POST['HiddenItemId'];
    $fetchQuery="SELECT `houseno`, `userid` FROM `tbl_need_request` WHERE `id`='$rejId'";
    $fetchQueryResult=mysqli_query($conn,$fetchQuery);
    $dataFetched=mysqli_fetch_assoc($fetchQueryResult);
    $houseno=$dataFetched['houseno'];
    $userid=$dataFetched['userid'];

    $fetchHQuery="SELECT `fname` FROM `tbl_house_member` WHERE `userid`='$userid'";
    $fetchHQueryResult=mysqli_query($conn,$fetchHQuery);
    $infoFetched=mysqli_fetch_assoc($fetchHQueryResult);
    $username=$infoFetched['fname'];

    //Fetch office staff
    $officeId=$_SESSION['userid'];
    $officeStaff="SELECT `name` FROM `tbl_office_staff` WHERE `userid`='$officeId'";
    $officeStaffResult=mysqli_query($conn,$officeStaff);
    $dataFetched=mysqli_fetch_assoc($officeStaffResult);
    $sName=$dataFetched['name'];
    $activity="Rejected need request requested by $username of house: $houseno with the reason: $rej_reason";
    date_default_timezone_set('Asia/Kolkata');
    $date_time = date("Y-m-d H:i:s", time ());

    if(isset($_POST['reject_need_req'])){
        $rejQuery="UPDATE `tbl_need_request` SET `status`='3',`reply`='$rej_reason',`office_staff`='$sName' WHERE `id`='$rejId' ; 
                   INSERT INTO `tbl_staff_activity`(`userid`, `name`, `activity`, `date_time`) VALUES ('$officeId','$sName','$activity','$date_time')";
        $rejQueryResult=mysqli_multi_query($conn,$rejQuery);
        if($rejQueryResult){
            $_SESSION['success'] = "Need request rejected successfully";
            header("Location: ../../view/pages/office_staff/need_request.php");
        }else{
            $_SESSION['error'] = "Error";
            header("Location: ../../view/pages/office_staff/need_request.php");
        }
    }
?>