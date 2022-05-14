<?php
    include '../../config/dbcon.php';
    session_start();
    extract($_POST);

    $wardno=$_SESSION['wardno'];
    if(isset($_POST['add-comm'])){

        //Input Sanitization
        $name = trim($name); 
        $name=mysqli_real_escape_string($conn,$name);
        $name=filter_var($name, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

        $comm_des = trim($comm_des); 
        $comm_des=mysqli_real_escape_string($conn,$comm_des);
        $comm_des=filter_var($comm_des, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

        $commLimit = trim($commLimit);
        $commLimit=mysqli_real_escape_string($conn,$commLimit);
        $commLimit=filter_var($commLimit, FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);

        //Generate committee id
        $count="SELECT `id` FROM `tbl_committee` WHERE `wardno`='$wardno'";
        $countResult=mysqli_query($conn,$count);
        $rowcount = mysqli_num_rows($countResult);
        $rowcount+=1;
        $c_id=$wardno . $wardno . $wardno . $rowcount;

        //Photo path upload
        $upload_dir = '../../../public/assets/images/uploads/photos/';
        $file_tmpname = $_FILES['photo']['tmp_name'];
        $file_name = $_FILES['photo']['name'];
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $filepath = $upload_dir . time().".".$file_ext;

        //Check file upload
        if(move_uploaded_file($file_tmpname, $filepath)){
            $insertQuery="INSERT INTO `tbl_committee`(`c_id`, `wardno`, `c_name`, `c_description`, `c_photo`, `m_limit`, `added_by`) VALUES ('$c_id','$wardno','$name','$comm_des','$filepath','$commLimit','$wardno')";
            $insertQueryRes=mysqli_query($conn,$insertQuery);
            if($insertQueryRes){
                $_SESSION['success'] = "Committe added successfully";
                header("Location: ../../view/pages/ward_member/committees.php");
            }else{
                $_SESSION['error'] = "Error in adding committee";
                header("Location: ../../view/pages/ward_member/committees.php");
            }
        }else{
            $_SESSION['error'] = "Error in file upload";
            header("Location: ../../view/pages/ward_member/committees.php");
        }
    }
?>