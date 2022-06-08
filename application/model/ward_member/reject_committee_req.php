<?php
    include '../../config/dbcon.php';
    session_start();
    
    $c_id=$_GET['c_id'];
    $u_id=$_GET['u_id'];

    $updateQuery="UPDATE `tbl_committee_req` SET `status`='2' WHERE `c_id`='$c_id' AND `userid`='$u_id'";
    $updateQueryResult=mysqli_query($conn,$updateQuery);
    if($updateQueryResult){
        $_SESSION['success'] = "Committee request rejected";
        echo "<script>window.location='../../view/pages/ward_member/view_committee.php?c_id=".$c_id."'</script>";
        // header("Location: ../../view/pages/ward_member/view_committee.php?c_id=$c_id");
    }else{
        $_SESSION['error'] = "Error in rejecting request";
        echo "<script>window.location='../../view/pages/ward_member/view_committee.php?c_id=".$c_id."'</script>";
        // header("Location: ../../view/pages/ward_member/view_committee.php?c_id=$c_id");
    }
?>