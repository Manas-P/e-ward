<?php
    include '../../config/dbcon.php';
    session_start();
    extract($_POST);

    $no=$_GET['no'];
    $query="UPDATE `tbl_house` SET `street_light_status`='0' WHERE `post_no`='$no' ;
            UPDATE `tbl_street_light` SET `status`='0' WHERE `street_light_no`='$no'";
    $queryResult=mysqli_multi_query($conn,$query);
    if($queryResult){
        $_SESSION['success'] = "Street light status updated";
        echo "<script>window.location='../../view/pages/house_member/street_light.php'</script>";
        // header("Location: ../../view/pages/house_member/street_light.php");
    }else{
        $_SESSION['error'] = "Error in updating street light status";
        echo "<script>window.location='../../view/pages/house_member/street_light.php'</script>";
        // header("Location: ../../view/pages/house_member/street_light.php");
    }
?>
