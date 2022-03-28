<?php
    include '../../config/dbcon.php';
    session_start();
    extract($_POST);

    $wardno=$_SESSION['wardno'];
    if(isset($_POST['add-staff'])){
        
        //Input Sanitization
        $name = trim($name); 
        $name=mysqli_real_escape_string($conn,$name);
        $name=filter_var($name, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

        $email = trim($email);
        $email=mysqli_real_escape_string($conn,$email);
        $email=filter_var($email, FILTER_SANITIZE_EMAIL, FILTER_FLAG_STRIP_HIGH);

        $phno = trim($phno);
        $phno=mysqli_real_escape_string($conn,$phno);
        $phno=filter_var($phno, FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);

        //Photo path upload
        $upload_dir = '../../../public/assets/images/';
        $file_tmpname = $_FILES['photo']['tmp_name'];
        $file_name = $_FILES['photo']['name'];
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $filepath = $upload_dir . time().".".$file_ext;

        //Assign checkbox values
        if(isset($_POST['mhouse'])){
            $mhouse=1;
        }
        if(isset($_POST['mcommittee'])){
            $mcommittee=1;
        }
        if(isset($_POST['mcomplaint'])){
            $mcomplaint=1;
        }

        //Check file upload
        if(move_uploaded_file($file_tmpname, $filepath)){
            //Generate user id
            //Count number of users
            $count="SELECT `id` FROM `tbl_office_staff` WHERE `wardno`='$wardno'";
            $countResult=mysqli_query($conn,$count);
            $rowcount = mysqli_num_rows($countResult);
            $rowcount+=1;
            $userid=$wardno . "00" . $rowcount;

            // Generate Random Password
            include '../passwordGenerator.php';

            //Send mail
            $subject="E-Ward Office Staff";
            $body="Dear $name, you have been added as office staff of ward $wardno. You can login to E-Ward using Id = $userid and Password = $generatedPassword";
            $headers="From: ewardmember@gmail.com";

            //Check mail send
            if(mail($email,$subject,$body,$headers)){
                $insOfficeStaff="INSERT INTO `tbl_office_staff`(`name`, `email`, `phno`, `photo`, `m_house`, `m_committee`, `m_complaint`, `wardno`, `userid`, `password`) VALUES ('$name','$email','$phno','$filepath','$mhouse','$mcommittee','$mcomplaint','$wardno','$userid','$generatedPassword')";
                $insOfficeStaffRes=mysqli_query($conn,$insOfficeStaff);
                if($insOfficeStaffRes){
                    $_SESSION['success'] = "Office staff added successfully";
                    header("Location: ../../view/pages/ward_member/add_office_staff.php");
                }else{
                    $_SESSION['error'] = "Error in adding office staff";
                    header("Location: ../../view/pages/ward_member/add_office_staff.php");
                }
            }else{
                $_SESSION['error'] = "Error in sending email";
                header("Location: ../../view/pages/ward_member/add_office_staff.php");
            }
        }else{
            $_SESSION['error'] = "Error in uploading photo";
            header("Location: ../../view/pages/ward_member/add_office_staff.php");
        }
    }
?>