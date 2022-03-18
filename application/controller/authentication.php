<?php
    include '../config/dbcon.php';
    session_start();
    extract($_POST);

    //Check login
    if(isset($_POST['userName']) && isset($_POST['password']) && isset($_POST['submitButton'])){
        
        //Input sanitization
        $userName=mysqli_real_escape_string($conn,$userName);
        $password=mysqli_real_escape_string($conn,$password);
        $userName=filter_var($userName, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
        $password=filter_var($password, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

        //Check if the user is Admin
        $adminCheck="SELECT `adid` FROM `tbl_admin` WHERE `username`='$userName' and `password`='$password'";
        $adminCheckResult = mysqli_query($conn,$adminCheck);
        $adminCheckCount=mysqli_num_rows($adminCheckResult);

        //Check if the user is Ward member
        $wardMemberCheck="SELECT `wardno`, `fullname` FROM `tbl_ward_member` WHERE `wardno`='$userName' and `password`='$password' and `status`=1";
        $wardMemberCheckResult=mysqli_query($conn,$wardMemberCheck);
        $wardMemberCount=mysqli_num_rows($wardMemberCheckResult);

        //Check if the user is House member
        $houseMemberCheck = "SELECT `fname`, `ward_no`, `house_no`, `userid` FROM `tbl_house_member` WHERE `userid`='$userName' and `password`='$password'";
        $houseMemberCheckResult = mysqli_query($conn, $houseMemberCheck);
        $houseMemberCheckCount = mysqli_num_rows($houseMemberCheckResult);

        //Check login conditions
        if($houseMemberCheckCount==1){
            $userData=mysqli_fetch_assoc($houseMemberCheckResult);
            $_SESSION['sessionId'] = session_id();
            $_SESSION['fname'] = $userData['fname'];
            $_SESSION['houseno']= $userData['house_no'];
            $_SESSION['wardno']= $userData['ward_no'];
            $_SESSION['userid']= $userData['userid'];
            header("Location: ../../assets/pages/house_member/dashboard.php");
            die();
        }elseif($wardMemberCount==1){
            $userData=mysqli_fetch_assoc($wardMemberCheckResult);
            $_SESSION['sessionId'] = session_id();
            $_SESSION['wardno']=$userData['wardno'];
            $_SESSION['fullname']=$userData['fullname'];
            header("Location: ../../assets/pages/ward_member/houses.php");
            die();
        }elseif($adminCheckCount==1){
            $userData=mysqli_fetch_assoc($adminCheckResult);
            $_SESSION['sessionId'] = session_id();
            $_SESSION['adid']=$userData['adid'];
            echo "admin";
            header("Location: ../../assets/pages/admin/admin_add_wm.php");
            die();
        }else{
            $_SESSION['error'] = "Invalid Username or Password";
            header("Location: ../../assets/pages/login.php");
            die();
        }
    }
?>