<?php
    include '../../config/dbcon.php';
    session_start();
    
    $c_id=$_GET['c_id'];
    $u_id=$_GET['u_id'];

    // Generate Random Password
    include '../passwordGenerator.php';

    //Get user mail
    $userMail="SELECT `email`, `fname` FROM `tbl_house_member` WHERE `userid`='$u_id'";
    $mailResult=mysqli_query($conn,$userMail);
    $userData=mysqli_fetch_assoc($mailResult);
    $toMail= $userData['email'];
    $name= $userData['fname'];

    //Generate userid
    $count="SELECT `id` FROM `tbl_committee_member` WHERE `c_id`='$c_id'";
    $countResult=mysqli_query($conn,$count);
    $rowcount = mysqli_num_rows($countResult);
    $rowcount+=1;
    $c_userid=$c_id . $rowcount;

    //Mail Informations
    $subject="E-Ward Committee Request Approved";
    $body="Dear $name, your request to join the committee have approved. You can login to E-Ward committee using Id = $c_userid and Password = $generatedPassword";
    $headers="From: ewardmember@gmail.com";
    if(mail($toMail,$subject,$body,$headers)){
        $query="INSERT INTO `tbl_committee_member`(`c_id`, `h_userid`, `c_userid`, `password`) VALUES ('$c_id','$u_id','$c_userid','$generatedPassword') ; 
                UPDATE `tbl_committee_req` SET `status`='1' WHERE `c_id`='$c_id' AND `userid`='$u_id'";
        $queryResult=mysqli_multi_query($conn,$query);
        if($queryResult){
            $_SESSION['success'] = "Member added";
            header("Location: ../../view/pages/ward_member/view_committee.php?c_id=$c_id");
        }else{
            $_SESSION['error'] = "Error in approving request";
            header("Location: ../../view/pages/ward_member/view_committee.php?c_id=$c_id");
        }
    }else{
        $_SESSION['error'] = "Error in sending mail";
        header("Location: ../../view/pages/ward_member/view_committee.php?c_id=$c_id");
    }
?>