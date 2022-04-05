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
    
    //Mail Informations
    $userid=$wardno . $houseNo . "0";
    $subject="E-Ward Approved";
    $body="Dear $name, your request have approved. You can login to E-Ward using Id = $userid and Password = $generatedPassword";
    $headers="From: ewardmember@gmail.com";

    if(mail($toMail,$subject,$body,$headers)){
        //Update User Status and Password (Multi-query)
        $updateQuery="UPDATE `tbl_registration` SET `status`=1 WHERE `rid`='$id' ; 
        INSERT INTO `tbl_house_member`(`ward_no`, `house_no`, `fname`, `email`, `phno`, `userid`, `password`) VALUES ('$wardno','$houseNo','$name','$toMail','$phno','$userid','$generatedPassword') ; 
        INSERT INTO `tbl_id_proof`(`userid`) VALUES ('$userid') ; 
        INSERT INTO `tbl_edu_bg`(`userid`) VALUES ('$userid') ;
        INSERT INTO `tbl_pro_bg`(`userid`) VALUES ('$userid')";
        $updateResult=mysqli_multi_query($conn,$updateQuery);
        if($updateResult){
            $_SESSION['success'] = "House approved";
            header("Location: ../../view/pages/ward_member/houses_request.php");
        }else{
            $_SESSION['error'] = "Error in approval";
            header("Location: ../../view/pages/ward_member/houses_request.php");
        }
    }else{
        $_SESSION['error'] = "Mail not send";
        header("Location: ../../view/pages/ward_member/houses_request.php");
    }
?>