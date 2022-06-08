<?php
    include '../../config/dbcon.php';
    session_start();
    extract($_POST);

    if(isset($_POST['up-comm'])){

        //check empty file
        if(empty($_FILES["up-photo"]['name'])){
            $filepath=$alreadyphoto;
            $updateQuery="UPDATE `tbl_committee` SET `c_name`='$upname',`c_description`='$upcomm_des',`c_photo`='$filepath',`m_limit`='$upcommLimit' WHERE `c_id`='$comid'";
            $updateQueryRes=mysqli_query($conn,$updateQuery);
            if($updateQueryRes){
                $_SESSION['sucess'] = "Updation successful";
                echo "<script>window.location='../../view/pages/ward_member/view_committee.php?c_id=".$comid."'</script>";
                // header("Location: ../../view/pages/ward_member/view_committee.php?c_id=$comid");
            }else{
                $_SESSION['error'] = "Error in updating details";
                echo "<script>window.location='../../view/pages/ward_member/view_committee.php?c_id=".$comid."'</script>";
                // header("Location: ../../view/pages/ward_member/view_committee.php?c_id=$comid");
            }
        }else{
            $upload_dir = '../../../public/assets/images/uploads/photos/';
            $file_tmpname = $_FILES['up-photo']['tmp_name'];
            $file_name = $_FILES['up-photo']['name'];
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $filepath = $upload_dir . time().".".$file_ext;
            if(move_uploaded_file($file_tmpname, $filepath)){
                $updateQuery="UPDATE `tbl_committee` SET `c_name`='$upname',`c_description`='$upcomm_des',`c_photo`='$filepath',`m_limit`='$upcommLimit' WHERE `c_id`='$comid'";
                $updateQueryRes=mysqli_query($conn,$updateQuery);
                if($updateQueryRes){
                    $_SESSION['sucess'] = "Updation successful";
                    echo "<script>window.location='../../view/pages/ward_member/view_committee.php?c_id=".$comid."'</script>";
                    // header("Location: ../../view/pages/ward_member/view_committee.php?c_id=$comid");
                }else{
                    $_SESSION['error'] = "Error in updating details";
                    echo "<script>window.location='../../view/pages/ward_member/view_committee.php?c_id=".$comid."'</script>";
                    // header("Location: ../../view/pages/ward_member/view_committee.php?c_id=$comid");
                }
            }else{
                $_SESSION['error'] = "Error in file upload";
                echo "<script>window.location='../../view/pages/ward_member/view_committee.php?c_id=".$comid."'</script>";
                // header("Location: ../../view/pages/ward_member/view_committee.php?c_id=$comid");
            }
        }

        
    }
?>