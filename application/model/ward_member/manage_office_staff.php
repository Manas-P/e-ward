<?php
    include '../../config/dbcon.php';
    session_start();
    extract($_POST);

    //Update office staff
    if(isset($_POST['update-staff'])){

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
                header("Location: ../../view/pages/ward_member/office_staff.php?id=$staff_id");
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
            header("Location: ../../view/pages/ward_member/office_staff.php?id=$staff_id");
        }else{
            $_SESSION['error'] = "Error in updation";
            header("Location: ../../view/pages/ward_member/office_staff.php?id=$staff_id");
        }
    }
?>