<?php
    include '../include/dbcon.php';
    $id=$_GET['apprId'];
    // $query="SELECT * FROM `tbl_registration` WHERE `rid`='$id'";
    // $result=mysqli_query($conn,$query);
    // while ($row = mysqli_fetch_assoc($result))
    // {
    //     echo $row['email'];
    // }
    
    // Generate Random Password
    $length=8;
    $generatedPassword='';
    $validChar='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    while(0<$length--){
        $generatedPassword.=$validChar[random_int(0,strlen($validChar)-1)];
    }
    //============================Send Mail==================================
    //Get user mail
    $userMail="SELECT * FROM `tbl_registration` WHERE `rid`='$id'";
    $mailResult=mysqli_query($conn,$userMail);
    while ($row = mysqli_fetch_assoc($mailResult))
    {
        $toMail= $row['email'];
        $houseNo=$row['houseno'];
        $name=$row['fname'];
    }
    
    //Mail Informations
    $subject="E-Ward Approved";
    $body="Dear $name, your request have approved. You can login to E-Ward using Id = $houseNo and Password = $generatedPassword";
    $headers="From: ewardmember@gmail.com";

    if(mail($toMail,$subject,$body,$headers)){
        //Update User Status and Password
        $updateQuery="UPDATE `tbl_registration` SET `password`='$generatedPassword',`status`=1 WHERE `rid`='$id'";
        $updateResult=mysqli_query($conn,$updateQuery);
        header("Location: ../pages/ward_member/houses_request.php");
    }else{
        echo "Mail not Send";
    }
?>