<?php
    include '../config/dbcon.php';
    session_start();
    extract($_POST);

    //Check login
    if(isset($_POST['userName']) && isset($_POST['password']) && isset($_POST['submitButton'])){
        
        //Input sanitization
        $userName = trim($userName); 
        $userName=mysqli_real_escape_string($conn,$userName);
        $userName=filter_var($userName, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

        $password = trim($password); 
        $password=mysqli_real_escape_string($conn,$password);
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

        //Check if the user is Office staff
        $officeStaffCheck = "SELECT `name`, `wardno`, `userid` FROM `tbl_office_staff` WHERE `userid`='$userName' and `password`='$password'";
        $officeStaffCheckResult = mysqli_query($conn, $officeStaffCheck);
        $officeStaffCheckCount = mysqli_num_rows($officeStaffCheckResult);

        //Check if the user is committee member
        $committeeMemberCheck = "SELECT `c_id`, `h_userid`, `c_userid`, `password` FROM `tbl_committee_member` WHERE `c_userid`='$userName' AND `password`='$password'";
        $committeeMemberCheckResult = mysqli_query($conn, $committeeMemberCheck);
        $committeeMemberCheckCount = mysqli_num_rows($committeeMemberCheckResult);

        //Check login conditions
        if($houseMemberCheckCount==1){
            $userData=mysqli_fetch_assoc($houseMemberCheckResult);
            $_SESSION['sessionId'] = session_id();
            $_SESSION['fname'] = $userData['fname'];
            $_SESSION['houseno']= $userData['house_no'];
            $_SESSION['wardno']= $userData['ward_no'];
            $_SESSION['userid']= $userData['userid'];
            header("Location: ../view/pages/house_member/dashboard.php");
            die();
        }elseif($wardMemberCount==1){
            $userData=mysqli_fetch_assoc($wardMemberCheckResult);
            $_SESSION['sessionId'] = session_id();
            $_SESSION['wardno']=$userData['wardno'];
            $_SESSION['fullname']=$userData['fullname'];
            header("Location: ../view/pages/ward_member/houses.php");
            die();
        }elseif($officeStaffCheckCount==1){
            $userData=mysqli_fetch_assoc($officeStaffCheckResult);
            $_SESSION['sessionId'] = session_id();
            $_SESSION['wardno']=$userData['wardno'];
            $_SESSION['fullname']=$userData['name'];
            $_SESSION['userid']= $userData['userid'];
            header("Location: ../view/pages/office_staff/houses.php");
            die();
        }elseif($adminCheckCount==1){
            $userData=mysqli_fetch_assoc($adminCheckResult);
            $_SESSION['sessionId'] = session_id();
            $_SESSION['adid']=$userData['adid'];
            header("Location: ../view/pages/admin/admin_add_wm.php");
            die();
        }elseif($committeeMemberCheckCount==1){
            $userData=mysqli_fetch_assoc($committeeMemberCheckResult);
            $_SESSION['sessionId'] = session_id();
            $_SESSION['c_id']=$userData['c_id'];
            $_SESSION['h_userid']=$userData['h_userid'];
            $_SESSION['c_userid']=$userData['c_userid'];
            header("Location: ../view/pages/committee_member/dashboard.php");
            die();
        }else{
            $_SESSION['error'] = "Invalid Username or Password";
            header("Location: ../view/pages/login/login.php");
            die();
        }
    }
?>