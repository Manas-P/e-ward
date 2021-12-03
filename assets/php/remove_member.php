<?php
    include '../include/dbcon.php';
    $wardno=$_GET['wardno'];
    $updateQuery="UPDATE `tbl_ward_member` SET `status`=0, `president`=0 WHERE `wardno`=$wardno";
    mysqli_query($conn,$updateQuery);
    header("Location: ../pages/admin/admin_add_wm.php");
?>