<?php
    include '../../config/dbcon.php';
    session_start();
    extract($_POST);

    //Update office staff
    if(isset($_POST['update-staff'])){

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

        //check empty file 
        //profile photo
        if(empty($_FILES["photo"]['name'])){
            $filepath=$hm_already_photo;
        }else{
            $upload_dir = '../../../public/assets/images/uploads/photos/';
            $file_tmpname = $_FILES['photo']['tmp_name'];
            $file_name = $_FILES['photo']['name'];
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $filepath = $upload_dir . time().".".$file_ext;
            if(move_uploaded_file($file_tmpname, $filepath)){}else{
                $_SESSION['error'] = "Error in file upload";
                echo "<script>window.location='../../view/pages/ward_member/office_staff.php?id=".$staff_id."'</script>";
                // header("Location: ../../view/pages/ward_member/office_staff.php?id=$staff_id");
            }
        }

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

        //Update 
        $updateQuery="UPDATE `tbl_office_staff` SET `name`='$name',`email`='$email',`phno`='$phno',`photo`='$filepath',`m_house`='$mhouse',`m_committee`='$mcommittee',`m_complaint`='$mcomplaint' WHERE `userid`='$staff_id';";
        $updateResult=mysqli_query($conn,$updateQuery);
        if($updateResult){
            $_SESSION['success'] = "Profile updated successfully";
            echo "<script>window.location='../../view/pages/ward_member/office_staff.php?id=".$staff_id."'</script>";
            // header("Location: ../../view/pages/ward_member/office_staff.php?id=$staff_id");
        }else{
            $_SESSION['error'] = "Error in updation";
            echo "<script>window.location='../../view/pages/ward_member/office_staff.php?id=".$staff_id."'</script>";
            // header("Location: ../../view/pages/ward_member/office_staff.php?id=$staff_id");
        }
    }

    //Delete staff
    if(isset($_POST['deleteStaffBtn'])){

        //Fetch data
        $query="SELECT `email` FROM `tbl_office_staff` WHERE `userid`='$staff_id'";
        $result=mysqli_query($conn,$query);
        $userData=mysqli_fetch_assoc($result);
        $toMail=$userData["email"];
        $body=$hdel_reason;

        //Input sanitization
        $body = trim($body); 
        $body=mysqli_real_escape_string($conn,$body);
        $body=filter_var($body, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

        //Send mail
        $subject="E-Ward Staff Removal";
        $headers="From: ewardmember@gmail.com";
        if(mail($toMail,$subject,$body,$headers)){
            $deleteQuery="UPDATE `tbl_office_staff` SET `status`='0' WHERE `userid`='$staff_id'";
            $deleteQueryResult=mysqli_query($conn,$deleteQuery);
            if($deleteQueryResult){
                $_SESSION['success'] = "Staff removed successfully";
                echo "<script>window.location='../../view/pages/ward_member/add_office_staff.php'</script>";
                // header("Location: ../../view/pages/ward_member/add_office_staff.php");
            }else{
                $_SESSION['error'] = "Error in removing staff";
                echo "<script>window.location='../../view/pages/ward_member/office_staff.php?id=".$staff_id."'</script>";
                // header("Location: ../../view/pages/ward_member/office_staff.php?id=$staff_id");
            }
        }else{
            $_SESSION['error'] = "Error in sending mail";
            echo "<script>window.location='../../view/pages/ward_member/office_staff.php?id=".$staff_id."'</script>";
            // header("Location: ../../view/pages/ward_member/office_staff.php?id=$staff_id");
        }
    }
?>