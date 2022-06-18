<?php
    include '../../config/dbcon.php';
    session_start();
    extract($_POST);

    $no=$_GET['name'];
    $query="DELETE FROM `tbl_street_light` WHERE `street_light_no`='$no' ;
            UPDATE `tbl_house` SET `street_light`='0',`street_light_status`='0',`post_no`='0' WHERE `post_no`='$no'";
    $queryResult=mysqli_multi_query($conn,$query);
    if($queryResult){
        $_SESSION['success'] = "Street light deleted successfully";
        echo "<script>window.location='../../view/pages/ward_member/street_light.php'</script>";
        // header("Location: ../../view/pages/ward_member/street_light.php");
    }else{
        $_SESSION['error'] = "Error in deleting street light";
        echo "<script>window.location='../../view/pages/ward_member/street_light.php'</script>";
        // header("Location: ../../view/pages/ward_member/street_light.php");
    }
?>