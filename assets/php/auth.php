<?php
        include '../include/dbcon.php';
        session_start();
        // Collecting values
        extract($_POST);
        //check houseno exisit
        if(isset($_POST['houseNo']))
        {
            $chk = "SELECT * FROM tbl_registration WHERE houseno='$houseNo'";
            $res = mysqli_query($conn, $chk);
            if(mysqli_num_rows($res)>0)
            {
                 // Toast should appear
                 echo  '<div class="alertt alert-visible">
                            <div class="econtent">
                                <img src="./assets/images/warning.svg" alt="warning">
                                <div class="text">
                                    House already registered
                                </div>
                            </div>
                            <img src="./assets/images/close.svg" alt="close" class="alert-close">
                        </div>';
            }
        }
        
        if(isset($_POST['regbtn'])){
            //While using extract, no need to define variable use $nameAttribute from the form
            $ins="INSERT INTO `tbl_registration`(`fname`, `email`, `phno`, `wardno`, `houseno`, `rationno`) VALUES ('$fname','$email','$phno','$wrdno','$houno','$rano')";
            $ins_res=mysqli_query($conn,$ins);
            if($ins_res){
                header("Location: ../../index.php");
            }else{
                echo '<script language="javascript" type="text/javascript">';
				echo 'alert("Error")';
				echo '</script>';
            }
        }


        //login 
        if(isset($_POST['userName']) && isset($_POST['password']) && isset($_POST['submitButton']))
        {
            // $password=$password;
            //Check if mobile already exisit
            $checkLogin = "SELECT * FROM `tbl_registration` WHERE `houseno`='$userName' and `password`='$password' and `status`=1";
            $checkLoginResult = mysqli_query($conn, $checkLogin);
            $checkLoginCount = mysqli_num_rows($checkLoginResult);
            //Check Admin
            $adminCheck="SELECT * FROM `tbl_admin` WHERE `username`='$userName' and `password`='$password'";
            $adminCheckResult = mysqli_query($conn,$adminCheck);
            $adminCheckCount=mysqli_num_rows($adminCheckResult);
            //No user exists
            if($checkLoginCount==1)
            {
                $userData=mysqli_fetch_assoc($checkLoginResult);
                $_SESSION['e-wardId'] = session_id();
                $_SESSION['fname'] = $userData['fname'];
                $_SESSION['rid'] = $userData['rid'];
                header("Location: ../../dashboard.php");
                die();
            }
            elseif($adminCheckCount==1){
                $_SESSION['adminId'] = session_id();
                $_SESSION['aid']=$userData['aid'];
                header("Location: ../../admin.php");
                die();
            }
            else
            {
                $_SESSION['loginMessage'] = "User Login Failed";
                header("Location: ../../index.php");
                die();
            }
        }
    ?>