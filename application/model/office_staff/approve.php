<?php
    include '../../config/dbcon.php';
    session_start();
    extract($_POST);
    $id=$_GET['id'];
    $houseno=$_GET['houseno'];
    $username=$_GET['memName'];

    //Fetch office staff
    $officeId=$_SESSION['userid'];
    $officeStaff="SELECT `name` FROM `tbl_office_staff` WHERE `userid`='$officeId'";
    $officeStaffResult=mysqli_query($conn,$officeStaff);
    $dataFetched=mysqli_fetch_assoc($officeStaffResult);
    $sName=$dataFetched['name'];
    $activity="Forwarded need request requested by $username of house: $houseno";
    date_default_timezone_set('Asia/Kolkata');
    $date_time = date("Y-m-d H:i:s", time ());
    
    $upQuery="UPDATE `tbl_need_request` SET `status`='1' WHERE `id`='$id' ;
               INSERT INTO `tbl_staff_activity`(`userid`, `name`, `activity`, `date_time`) VALUES ('$officeId','$sName','$activity','$date_time')";
    $upQueryResult=mysqli_multi_query($conn,$upQuery);
    if($upQueryResult){
        $_SESSION['success'] = "Need request forwarded to ward member";
        header("Location: ../../view/pages/office_staff/need_request.php");
    }else{
        $_SESSION['error'] = "Error";
        header("Location: ../../view/pages/office_staff/need_request.php");
    }
?>