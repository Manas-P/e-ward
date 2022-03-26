<?php
    include '../../config/dbcon.php';
    session_start();
    extract($_POST);

    //Reject House registeration request
    if(isset($_POST['reject_house_req'])){
        $rejId=$_POST['HiddenItemId'];
        $body=$_POST['rej_reason'];
        $query="SELECT `email` FROM `tbl_registration` WHERE `rid`='$rejId'";
        $result=mysqli_query($conn,$query);
        $userData=mysqli_fetch_assoc($result);
        $toMail=$userData["email"];

        //Send mail
        $subject="E-Ward House Rejection";
        $headers="From: ewardmember@gmail.com";
        if(mail($toMail,$subject,$body,$headers)){
            mysqli_query($conn,"DELETE FROM `tbl_registration` WHERE `rid`='$rejId'");
            header("Location: ../../view/pages/ward_member/houses_request.php");
        }else{
            $_SESSION['error'] = "Mail not send";
            header("Location: ../../view/pages/ward_member/houses_request.php");
        }
    }
?>