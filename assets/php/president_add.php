<?php
    include '../include/dbcon.php';
    $wardno=$_GET['wardno'];
    $presidentUpdate="UPDATE `tbl_ward_member` SET `president`=1 WHERE `wardno`='$wardno'";
    $updateResult=mysqli_query($conn,$presidentUpdate);
    if($updateResult){
        header("Location: ../pages/admin/admin_add_wm.php");
    }else{
        echo '<script language="javascript" type="text/javascript">';
		echo 'alert("Error")';
		echo '</script>';
    }
?>