<?php
    include './assets/include/dbcon.php';
    
    extract($_POST);

    $id=$_GET['apprId'];
    // $query="SELECT * FROM `tbl_registration` WHERE `rid`='$id'";
    // $result=mysqli_query($conn,$query);
    // while ($row = mysqli_fetch_assoc($result))
    // {
    //     echo $row['email'];
    // }
    
    //Generate Random Password
    $length=8;
    $generatedResult='';
    $validChar='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    while(0<$length--){
        $generatedResult.=$validChar[random_int(0,strlen($validChar)-1)];
    }
?>