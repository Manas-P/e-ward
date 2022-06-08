<?php
    include '../../config/dbcon.php';
    session_start();
    extract($_POST);

    $c_userid= $_SESSION['c_userid'];
    // Check current password
    if(isset($_POST['curPass'])){
        $curpasschk="SELECT `password` FROM `tbl_committee_member` WHERE `c_userid`='$c_userid' AND `password`='$curPass'";
        $curpasschkres = mysqli_query($conn, $curpasschk);
        if(mysqli_num_rows($curpasschkres)<1)
        {
             // Toast should appear
             echo  '<div class="alertt alert-visible">
                        <div class="econtent">
                            <img src="../../../../public/assets/images/warning.svg" alt="warning">
                            <div class="text">
                                Incorrent password
                            </div>
                        </div>
                    </div>';
        }else{
            return 0;
        }
    }

    // Change password
    if(isset($_POST['changePass'])){
        echo $updatePassQuery="UPDATE `tbl_committee_member` SET `password`='$newPass' WHERE `c_userid`='$c_userid'";
        $updatePassRes=mysqli_query($conn,$updatePassQuery);
        if($updatePassRes){
            header("Location: ../../view/pages/committee_member/change_password.php");
            $_SESSION['success'] = "Password changed successfully";
        }else{
            header("Location: ../../view/pages/committee_member/change_password.php");
            $_SESSION['error'] = "Error in changing password";
        }
    }
?>