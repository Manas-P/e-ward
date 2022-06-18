<?php
    include '../config/dbcon.php';
    session_start();
    extract($_POST);

    if(isset($_POST['toLoginPage'])){
        echo "<script>window.location='../view/pages/login/login.php'</script>";
        // header("Location: ../view/pages/login/login.php");
    }
        
    // Check user id exist or not
    if(isset($_POST['userId'])){
        $uidchk="SELECT `userid` FROM `tbl_house_member` WHERE `userid`='$userId'";
        $uidchkres = mysqli_query($conn, $uidchk);
        if(mysqli_num_rows($uidchkres)<1)
        {
             // Toast should appear
             echo  '<div class="alertt alert-visible">
                        <div class="econtent">
                            <img src="../../../../public/assets/images/warning.svg" alt="warning">
                            <div class="text">
                                User id does not exist
                            </div>
                        </div>
                    </div>';
        }else{
            return 0;
        }
    }

    //Send otp
    if(isset($_POST['fpContinue'])){

        //Fetch user data
        $fetchMailQuery="SELECT `email`, `fname` FROM `tbl_house_member` WHERE `userid`='$ftpUserId'";
        $fetchMailQueryResult = mysqli_query($conn, $fetchMailQuery);
        $userData=mysqli_fetch_assoc($fetchMailQueryResult);
        $email=$userData['email'];
        $fname=$userData['fname'];

        //Session
        $_SESSION['fp-email']=$email;
        $_SESSION['fp-uid']=$ftpUserId;

        //Generate otp
        $length=5;
        $generatedOtp='';
        $validChar='0123456789';
        while(0<$length--){
            $generatedOtp.=$validChar[random_int(0,strlen($validChar)-1)];
        }

        $subject="E-Ward OTP";
        $body="Dear $fname, your one time password is: $generatedOtp";
        $headers="From: ewardmember@gmail.com";

        if(mail($email,$subject,$body,$headers)){
            $otpQuery="INSERT INTO `tbl_forgot_password`(`userid`, `otp`) VALUES ('$ftpUserId','$generatedOtp')";
            mysqli_query($conn, $otpQuery);
            echo "<script>window.location='../view/pages/login/verify_otp.php'</script>";
            // header("Location: ../view/pages/login/verify_otp.php");
        }else{
            $_SESSION['errorMessage'] = "Error in sending E-mail";
            echo "<script>window.location='../view/pages/login/forgot_password.php'</script>";
            // header("Location: ../view/pages/login/forgot_password.php");
        }
    }

    // Back to user id section
    if(isset($_POST['touid'])){
        $ftpUserId=$_SESSION['fp-uid'];
        $deleteQuery="DELETE FROM `tbl_forgot_password` WHERE `userid`='$ftpUserId'";
        mysqli_query($conn, $deleteQuery);
        unset($_SESSION['fp-email']);
        unset($_SESSION['fp-uid']);
        echo "<script>window.location='../view/pages/login/forgot_password.php'</script>";
        // header("Location: ../view/pages/login/forgot_password.php");
    }

    //Check OTP
    if(isset($_POST['fpContinueOtp'])){
        $ftpUserId=$_SESSION['fp-uid'];
        $fetchOtp="SELECT `otp` FROM `tbl_forgot_password` WHERE `userid`='$ftpUserId' AND `otp`='$fpotp'";
        $fetchOtpRes=mysqli_query($conn, $fetchOtp);
        if(mysqli_num_rows($fetchOtpRes)>=1){
            echo "<script>window.location='../view/pages/login/new_password.php'</script>";
            // header("Location: ../view/pages/login/new_password.php");
        }else{
            $_SESSION['errorMessage'] = "Invalid OTP";
            echo "<script>window.location='../view/pages/login/verify_otp.php'</script>";
            // header("Location: ../view/pages/login/verify_otp.php");
        }
    }

    //New password
    if(isset($_POST['fpConNewPass'])){
        $ftpUserId=$_SESSION['fp-uid'];
        $updateQuery="UPDATE `tbl_house_member` SET `password`='$fpNewPass' WHERE `userid`='$ftpUserId'";
        if(mysqli_query($conn, $updateQuery)){
            $deleteQuery="DELETE FROM `tbl_forgot_password` WHERE `userid`='$ftpUserId'";
            mysqli_query($conn, $deleteQuery);
            unset($_SESSION['fp-email']);
            unset($_SESSION['fp-uid']);
            $_SESSION['success'] = "Password changed successfully";
            echo "<script>window.location='../view/pages/login/login.php'</script>";
            // header("Location: ../view/pages/login/login.php");
        }else{
            $deleteQuery="DELETE FROM `tbl_forgot_password` WHERE `userid`='$ftpUserId'";
            mysqli_query($conn, $deleteQuery);
            unset($_SESSION['fp-email']);
            unset($_SESSION['fp-uid']);
            $_SESSION['loginMessage'] = "Please try again";
            echo "<script>window.location='../view/pages/login/login.php'</script>";
            // header("Location: ../view/pages/login/login.php");
        }
    }
?>