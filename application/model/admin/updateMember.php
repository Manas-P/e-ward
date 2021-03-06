<?php
    include '../../config/dbcon.php';
    session_start();
    extract($_POST);

    //Update ward member
    if(isset($_POST['update-wm'])){
        $wrno=$_GET['wrno'];

        //Input sanitization
        $wfname = trim($wfname); 
        $wfname=mysqli_real_escape_string($conn,$wfname);
        $wfname=filter_var($wfname, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

        $wemail = trim($wemail);
        $wemail=mysqli_real_escape_string($conn,$wemail);
        $wemail=filter_var($wemail, FILTER_SANITIZE_EMAIL, FILTER_FLAG_STRIP_HIGH);

        $wphno = trim($wphno);
        $wphno=mysqli_real_escape_string($conn,$wphno);
        $wphno=filter_var($wphno, FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);

        $wwrdno = trim($wwrdno);
        $wwrdno=mysqli_real_escape_string($conn,$wwrdno);
        $wwrdno=filter_var($wwrdno, FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);

        //check image updated
        if($_FILES["wphoto"]["size"]==0){
            $update="UPDATE `tbl_ward_member` SET `fullname`='$wfname',`email`='$wemail',`phno`='$wphno',`wardno`='$wwrdno',`validupto`='$wvalidity' WHERE `wardno`='$wrno'";
            $updateResult=mysqli_query($conn,$update);
            header("Location: ../../view/pages/admin/admin_add_wm.php");
        }else{
            $upload_dir = '../../../public/assets/images/uploads/photos/';
            $file_tmpname = $_FILES['wphoto']['tmp_name'];
            $file_name = $_FILES['wphoto']['name'];
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $filepath = $upload_dir . time().".".$file_ext;
            //Check File Upload
            if(move_uploaded_file($file_tmpname, $filepath)){
                $update="UPDATE `tbl_ward_member` SET `fullname`='$wfname',`email`='$wemail',`phno`='$wphno',`wardno`='$wwrdno',`validupto`='$wvalidity',`photo`='$filepath' WHERE `wardno`='$wrno'";
                $updateResult=mysqli_query($conn,$update);
                header("Location: ../../view/pages/admin/admin_add_wm.php");
            }else{
                $_SESSION['error'] = "File upload error";
                header("Location: ../../view/pages/admin/admin_add_wm.php");
            }
           
        }
    }

    //Update validity for all ward members
    if(isset($_POST['upVal'])){
        if(empty($upvalidity)){
            $_SESSION['error'] = "Please enter a date";
            header("Location: ../../view/pages/admin/admin_add_wm.php");
        }else{
            $upquery="UPDATE `tbl_ward_member` SET `validupto`='$upvalidity' where `status`='1'";
            $upqueryResult=mysqli_query($conn,$upquery);
            if($upqueryResult){
                $_SESSION['success'] = "Validity updated successfully";
                header("Location: ../../view/pages/admin/admin_add_wm.php");
            }else{
                $_SESSION['error'] = "Error in updating validity";
                header("Location: ../../view/pages/admin/admin_add_wm.php");
            }            
        }
    }
?>