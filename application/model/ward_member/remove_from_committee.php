<?php
    include '../../config/dbcon.php';
    session_start();
    
    $c_id=$_GET['c_id'];
    $u_id=$_GET['u_id'];

    $updateQuery="DELETE FROM `tbl_committee_member` WHERE `c_id`='$c_id' AND `h_userid`='$u_id' ; 
                  UPDATE `tbl_committee` SET `m_joined`=`m_joined` - 1 WHERE `c_id`='$c_id' ; 
                  DELETE FROM `tbl_committee_req` WHERE `c_id`='$c_id' AND `userid`='$u_id'";
    $updateQueryResult=mysqli_multi_query($conn,$updateQuery);
    if($updateQueryResult){
        $_SESSION['success'] = "Committee member removed";
        header("Location: ../../view/pages/ward_member/view_committee.php?c_id=$c_id");
    }else{
        $_SESSION['error'] = "Error in removing member";
        header("Location: ../../view/pages/ward_member/view_committee.php?c_id=$c_id");
    }
?>