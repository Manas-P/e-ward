<?php
    include '../../config/dbcon.php';
    session_start();
    extract($_POST);

    //Add hneed request
    if(isset($_POST['add-req'])){

        //File upload
        if(empty($_FILES["upFile"]['name'])){
            $filepath='0';
        }else{
            $upload_dir = '../../../public/assets/documents/request/';
            $file_tmpname = $_FILES['upFile']['tmp_name'];
            $file_name = $_FILES['upFile']['name'];
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $filepath = $upload_dir . time().".".$file_ext;
            if(move_uploaded_file($file_tmpname, $filepath)){}else{
                $_SESSION['error'] = "Error in file upload";
                echo "<script>window.location='../../view/pages/house_member/add_need_request.php'</script>";
                // header("Location: ../../view/pages/house_member/add_need_request.php");
            }
        }

        $houseno= $_SESSION['houseno'];
        $wardno= $_SESSION['wardno'];
        $user_id= $_SESSION['userid'];

        $insQuery="INSERT INTO `tbl_need_request`(`wardno`, `houseno`, `userid`, `description`, `proof_file`) VALUES ('$wardno','$houseno','$user_id','$req_des','$filepath')";
        $insQueryResult=mysqli_query($conn,$insQuery);
        if(insQueryResult){
            $_SESSION['success'] = "Request submitted successfully";
            echo "<script>window.location='../../view/pages/house_member/add_need_request.php'</script>";
            // header("Location: ../../view/pages/house_member/add_need_request.php");
        }else{
            $_SESSION['error'] = "Error in submitting request";
            echo "<script>window.location='../../view/pages/house_member/add_need_request.php'</script>";
            // header("Location: ../../view/pages/house_member/add_need_request.php");
        }
    }


?>