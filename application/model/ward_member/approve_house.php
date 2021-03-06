<?php
    include '../../config/dbcon.php';
    session_start();
    extract($_POST);
    $id=$_GET['apprId'];
    
    // Generate Random Password
    include '../passwordGenerator.php';

    //============================Send Mail==================================
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
    //Fetch staff details
    if($officeId!=""){
        $officeStaff="SELECT `name` FROM `tbl_office_staff` WHERE `userid`='$officeId'";
        $officeStaffResult=mysqli_query($conn,$officeStaff);
        $dataFetched=mysqli_fetch_assoc($officeStaffResult);
        $sName=$dataFetched['name'];
        $activity="Approved house having house number: $houseNo";
        date_default_timezone_set('Asia/Kolkata');
        $date_time = date("Y-m-d H:i:s", time ());
    }
    
    //Mail Informations
    $userid=$wardno . $houseNo . "0";
    $subject="E-Ward Approved";
    $body="Dear $name, your request have approved. You can login to E-Ward using Id = $userid and Password = $generatedPassword";
    $headers="From: ewardmember@gmail.com";

    if(mail($toMail,$subject,$body,$headers)){
        //Check if the action is done by office staff
        if($officeId!=""){
            //Update User Status and Password (Multi-query)
            $updateQuery="UPDATE `tbl_registration` SET `status`=1 WHERE `rid`='$id' ; 
            INSERT INTO `tbl_house_member`(`ward_no`, `house_no`, `fname`, `email`, `phno`, `userid`, `password`) VALUES ('$wardno','$houseNo','$name','$toMail','$phno','$userid','$generatedPassword') ; 
            INSERT INTO `tbl_id_proof`(`userid`) VALUES ('$userid') ; 
            INSERT INTO `tbl_edu_bg`(`userid`) VALUES ('$userid') ;
            INSERT INTO `tbl_pro_bg`(`userid`) VALUES ('$userid') ;
            INSERT INTO `tbl_staff_activity`(`userid`, `name`, `activity`, `date_time`) VALUES ('$officeId','$sName','$activity','$date_time')";
            $updateResult=mysqli_multi_query($conn,$updateQuery);
            if($updateResult){
                $_SESSION['success'] = "House approved";
                echo "<script>window.location='../../view/pages/office_staff/houses_request.php'</script>";
                // header("Location: ../../view/pages/office_staff/houses_request.php");
            }else{
                $_SESSION['error'] = "Error in house approval";
                echo "<script>window.location='../../view/pages/office_staff/houses_request.php'</script>";
                // header("Location: ../../view/pages/office_staff/houses_request.php");
            }
        }else{
            $updateQuery="UPDATE `tbl_registration` SET `status`=1 WHERE `rid`='$id' ; 
            INSERT INTO `tbl_house_member`(`ward_no`, `house_no`, `fname`, `email`, `phno`, `userid`, `password`) VALUES ('$wardno','$houseNo','$name','$toMail','$phno','$userid','$generatedPassword') ; 
            INSERT INTO `tbl_id_proof`(`userid`) VALUES ('$userid') ; 
            INSERT INTO `tbl_edu_bg`(`userid`) VALUES ('$userid') ;
            INSERT INTO `tbl_pro_bg`(`userid`) VALUES ('$userid')";
            $updateResult=mysqli_multi_query($conn,$updateQuery);
            if($updateResult){
                $_SESSION['success'] = "House approved";
                echo "<script>window.location='../../view/pages/ward_member/houses_request.php'</script>";
                // header("Location: ../../view/pages/ward_member/houses_request.php");
            }else{
                $_SESSION['error'] = "Error in house approval";
                echo "<script>window.location='../../view/pages/ward_member/houses_request.php'</script>";
                // header("Location: ../../view/pages/ward_member/houses_request.php");
            }
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
?>