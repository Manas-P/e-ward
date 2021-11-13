<?php
        include '../include/dbcon.php';
        session_start();
        //check houseno exisit
        if(isset($_POST['houseNo']))
        {
            extract($_POST);
            $chk = "SELECT * FROM registration WHERE houseno='$houseNo'";
            $res = mysqli_query($conn, $chk);
            if(mysqli_num_rows($res)>0)
            {
                 // Toast should appear
                 echo '<div class="alertt alert-visible">
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
        
        if(isset($_POST["regbtn"])){
            $name=$_POST["fname"];
            $email=$_POST["email"];
            $phno=$_POST["phno"];
            $wardno=$_POST["wrdno"];
            $houseno=$_POST["houno"];
            $rationno=$_POST["rano"];
            $chk = "SELECT * FROM registration WHERE houseno='$houseno'";
            $res = mysqli_query($conn, $chk);
            if(mysqli_num_rows($res) > 0){
                // Toast should appear
                echo "Hi";
              }else{
                $ins="INSERT INTO `registration`(`fname`, `email`, `phno`, `wardno`, `houseno`, `rationno`) VALUES ('$name','$email','$phno','$wardno','$houseno','$rationno')";
                mysqli_query($conn,$ins);
              }
        }
        //login 
        if(isset($_POST['userName']) && isset($_POST['password']) && isset($_POST['submitButton']))
        {
            // Collecting values
            extract($_POST);
            $password=$password;
            //Check if mobile already exisit
            $checkLogin = "SELECT * FROM `registration` WHERE `houseno`='$userName' and password='$password' and status=1";
            $checkLoginResult = mysqli_query($conn, $checkLogin);
            $checkLoginCount = mysqli_num_rows($checkLoginResult);
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
            else
            {
                $_SESSION['loginMessage'] = "User Login Failed";
                header("Location: ../../index.php");
                die();
            }
        }
    ?>