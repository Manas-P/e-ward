<?php
    include '../../config/dbcon.php';
    session_start();
    
    $c_id=$_GET['c_id'];
    $wardno= $_SESSION['wardno'];
    $user_id= $_SESSION['userid'];

    $insertQuery="INSERT INTO `tbl_committee_req`(`c_id`, `userid`, `wardno`) VALUES ('$c_id','$user_id','$wardno')";
    $insertQueryResult=mysqli_query($conn,$insertQuery);
    if(insertQueryResult){
        $_SESSION['success'] = "Membership requested successfully";
        header("Location: ../../view/pages/house_member/committees.php");
    }else{
        $_SESSION['error'] = "Error in requesting membership";
        header("Location: ../../view/pages/house_member/committees.php");
    }
?>