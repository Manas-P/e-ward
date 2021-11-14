<?php
    include './assets/include/dbcon.php';
    $id=$_GET['apprId'];
    // $query="SELECT * FROM `tbl_registration` WHERE `rid`='$id'";
    // $result=mysqli_query($conn,$query);
    // while ($row = mysqli_fetch_assoc($result))
    // {
    //     echo $row['email'];
    // }
    
    //Generate Random Password
    $length=8;
    $generatedPassword='';
    $validChar='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    while(0<$length--){
        $generatedPassword.=$validChar[random_int(0,strlen($validChar)-1)];
    }

    //Update User Status
    $updateQuery="UPDATE `tbl_registration` SET `password`='$generatedPassword',`status`=1 WHERE `rid`='$id'";
    $updateResult=mysqli_query($conn,$updateQuery);
?>