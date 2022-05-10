<?php
    include '../../config/dbcon.php';
    session_start();
    extract($_POST);

    // Check current password
    if(isset($_POST['curPass'])){
        $curpasschk="SELECT `password` FROM `tbl_admin` WHERE `username`='admin' AND `password`='$curPass'";
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
        echo $updatePassQuery="UPDATE `tbl_admin` SET `password`='$newPass' WHERE `username`='admin'";
        $updatePassRes=mysqli_query($conn,$updatePassQuery);
        if($updatePassRes){
            header("Location: ../../view/pages/admin/change_password.php");
            $_SESSION['success'] = "Password changed successfully";
        }else{
            header("Location: ../../view/pages/admin/change_password.php");
            $_SESSION['error'] = "Error in changing password";
        }
    }
?>