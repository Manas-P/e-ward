<?php
    include '../../config/dbcon.php';
    session_start();
    extract($_POST);

    // Check current password
    if(isset($_POST['curPass'])){
        $curpasschk="SELECT `password` FROM `tbl_ward_member` WHERE `wardno`='$userId' AND `password`='$curPass'";
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
        $updatePassQuery="UPDATE `tbl_ward_member` SET `password`='$newPass' WHERE `wardno`='$userid'";
        $updatePassRes=mysqli_query($conn,$updatePassQuery);
        if($updatePassRes){
            echo "<script>window.location='../../view/pages/ward_member/change_password.php'</script>";
            // header("Location: ../../view/pages/ward_member/change_password.php");
            $_SESSION['success'] = "Password changed successfully";
        }else{
            echo "<script>window.location='../../view/pages/ward_member/change_password.php'</script>";
            // header("Location: ../../view/pages/ward_member/change_password.php");
            $_SESSION['error'] = "Error in changing password";
        }
    }
?>