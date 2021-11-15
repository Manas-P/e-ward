<?php
    include '../include/dbcon.php';
    $id=$_GET['rejId'];
    mysqli_query($conn,"DELETE FROM `tbl_registration` WHERE `rid`='$id'");
    header("Location: ../../admin.php");
?>
