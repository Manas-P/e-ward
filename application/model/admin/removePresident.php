<?php
    include '../../config/dbcon.php';
    $wardno=$_GET['wardno'];
    $updateQuery="UPDATE `tbl_ward_member` SET `president`=0 WHERE `wardno`=$wardno";
    mysqli_query($conn,$updateQuery);
    header("Location: ../../view/pages/admin/admin_add_wm.php");
?>