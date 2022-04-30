<?php
    include '../../config/dbcon.php';
    session_start();
    extract($_POST);
    $id=$_GET['apprId'];

    //Get user mail
    $userMail="SELECT `email`, `houseno`, `fname`, `wardno`, `phno` FROM `tbl_registration` WHERE `rid`='$id'";
    $mailResult=mysqli_query($conn,$userMail);
    $userData=mysqli_fetch_assoc($mailResult);
    $toMail= $userData['email'];
    $houseNo=$userData['houseno'];
    $name=$userData['fname'];
    $wardno=$userData['wardno'];
    $phno=$userData['phno'];

    //Check if the action is done by office staff
            $officeId=$_SESSION['userid'];
            if($officeId!=""){
                //Fetch staff details
                $officeStaff="SELECT `name` FROM `tbl_office_staff` WHERE `userid`='$officeId'";
                $officeStaffResult=mysqli_query($conn,$officeStaff);
                $dataFetched=mysqli_fetch_assoc($officeStaffResult);
                $sName=$dataFetched['name'];
                $activity="Approved house having house number: $houseNo";
                $date_time = date("Y-m-d H:i:s");

                $activityInsQuery="INSERT INTO `tbl_staff_activity`(`userid`, `name`, `activity`, `date_time`) VALUES ('$officeId','$sName','$activity','$date_time')";
                $activityInsQueryResult=mysqli_query($conn,$activityInsQuery);

                // $_SESSION['success'] = "House approved";
                // header("Location: ../../view/pages/ward_member/houses_request.php");
            }else{
                // $_SESSION['success'] = "House approved";
                // header("Location: ../../view/pages/ward_member/houses_request.php");
            }
?>