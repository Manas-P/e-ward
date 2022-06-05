<?php
    include '../../config/dbcon.php';
    session_start();
    extract($_POST);

    $c_id=$_SESSION['c_id'];
    $h_userid= $_SESSION['h_userid'];

    if(isset($_POST['add-tsk-rep'])){

        //upload photos
        $upload_dir = '../../../public/assets/images/uploads/photos/';
        //photo1
        $file_tmpname = $_FILES['photo1']['tmp_name'];
        $file_name = $_FILES['photo1']['name'];
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $filepath_photo1 = $upload_dir . time()."0".".".$file_ext;
        if(move_uploaded_file($file_tmpname, $filepath_photo1)){}else{
            $_SESSION['error'] = "Error in uploading photo";
            header("Location: ../../view/pages/committee_member/view_task.php?tskId=$tskId");
        }
        //photo2
        if(empty($_FILES["photo2"]['name'])){
            $filepath_photo2=0;
        }else{
            $file_tmpname = $_FILES['photo2']['tmp_name'];
            $file_name = $_FILES['photo2']['name'];
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $filepath_photo2 = $upload_dir . time()."1".".".$file_ext;
            if(move_uploaded_file($file_tmpname, $filepath_photo2)){}else{
                $_SESSION['error'] = "Error in uploading photo";
                header("Location: ../../view/pages/committee_member/view_task.php?tskId=$tskId");
            }
        }
        //photo3
        if(empty($_FILES["photo3"]['name'])){
            $filepath_photo3=0;
        }else{
            $file_tmpname = $_FILES['photo3']['tmp_name'];
            $file_name = $_FILES['photo3']['name'];
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $filepath_photo3 = $upload_dir . time()."2".".".$file_ext;
            if(move_uploaded_file($file_tmpname, $filepath_photo3)){}else{
                $_SESSION['error'] = "Error in uploading photo";
                header("Location: ../../view/pages/committee_member/view_task.php?tskId=$tskId");
            }
        }

        $date=date("Y-m-d");
        $insertQuery="INSERT INTO `tbl_task_report`(`tsk_id`, `com_id`, `userid`, `title`, `description`, `date`, `photo1`, `photo2`, `photo3`) VALUES ('$tskId','$c_id','$h_userid','$title','$des','$date','$filepath_photo1','$filepath_photo2','$filepath_photo3')";
        $insertQueryRes=mysqli_query($conn, $insertQuery);
        if($insertQueryRes){
            $_SESSION['success'] = "Successfully added task report";
            header("Location: ../../view/pages/committee_member/view_task.php?tskId=$tskId");
        }else{
            $_SESSION['error'] = "Error in adding task report";
            header("Location: ../../view/pages/committee_member/view_task.php?tskId=$tskId");
        }
    }
?>