<?php
    include '../config/dbcon.php';
    session_start();
    extract($_POST);

    //Check houseno exisit
    if(isset($_POST['houseNo']))
    {
        $chk = "SELECT `houseno` FROM tbl_registration WHERE houseno='$houseNo' and wardno='$wardno'";
        $res = mysqli_query($conn, $chk);
        if(mysqli_num_rows($res)>0)
        {
             // Return error toast
             echo  '<div class="alertt alert-visible">
                        <div class="econtent">
                            <img src="../../../../public/assets/images/warning.svg" alt="warning">
                            <div class="text">
                                House already registered
                            </div>
                        </div>
                    </div>';
        }
    }

    if(isset($_POST['regbtn'])){
        //Concatenating '0' for registering user
        $userid=$wrdno . $houno . "0";

        //Input sanitization
        $fname = trim($fname); 
        $fname=mysqli_real_escape_string($conn,$fname);
        $fname=filter_var($fname, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

        $email = trim($email);
        $email=mysqli_real_escape_string($conn,$email);
        $email=filter_var($email, FILTER_SANITIZE_EMAIL, FILTER_FLAG_STRIP_HIGH);

        $phno = trim($phno);
        $phno=mysqli_real_escape_string($conn,$phno);
        $phno=filter_var($phno, FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);

        $wrdno = trim($wrdno);
        $wrdno=mysqli_real_escape_string($conn,$wrdno);
        $wrdno=filter_var($wrdno, FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);

        $houno = trim($houno);
        $houno=mysqli_real_escape_string($conn,$houno);
        $houno=filter_var($houno, FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
        
        //Upload tax report (pdf)
        $upload_dir = '../../public/assets/documents/taxreport/';
        $file_tmpname = $_FILES['taxre']['tmp_name'];
        $file_name = $_FILES['taxre']['name'];
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $filepath = $upload_dir . time().".".$file_ext;

        if(move_uploaded_file($file_tmpname, $filepath)){
            $ins="INSERT INTO `tbl_registration`(`fname`, `email`, `phno`, `wardno`, `houseno`, `taxreport`) VALUES ('$fname','$email','$phno','$wrdno','$houno','$filepath')";
            $ins_res=mysqli_query($conn,$ins);
            if($ins_res){
                $_SESSION['success'] = "Registration request send";
                header("Location: ../view/pages/login/login.php");
            }else{
                $_SESSION['error'] = "Error in registration";
                header("Location: ../view/pages/login/login.php");
            }
        }else{
            $_SESSION['error'] = "File upload error";
            header("Location: ../view/pages/login/login.php");
        }
    }
?>