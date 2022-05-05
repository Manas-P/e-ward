<?php
    include '../../config/dbcon.php';
    session_start();
    extract($_POST);
    $wardno=$_SESSION['wardno'];

    if(isset($_POST['add-doc'])){

        //input sanitization
        $docName = trim($docName); 
        $docName=mysqli_real_escape_string($conn,$docName);
        $docName=filter_var($docName, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

        //Upload document (pdf)
        $upload_dir = '../../../public/assets/documents/edocument/';
        $file_tmpname = $_FILES['edocFile']['tmp_name'];
        $file_name = $_FILES['edocFile']['name'];
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $filepath = $upload_dir . time().".".$file_ext;

        if(move_uploaded_file($file_tmpname, $filepath)){
            $query="INSERT INTO `tbl_e_doc`(`wardno`, `doc_name`, `file`) VALUES ('$wardno','$docName','$filepath')";
            $queryResult=mysqli_query($conn, $query);
            if($queryResult){
                $_SESSION['success'] = "File uploaded successfully";
                header("Location: ../../view/pages/ward_member/e_document.php");
            }else{
                $_SESSION['error'] = "An error occured";
                header("Location: ../../view/pages/ward_member/e_document.php");
            }
        }else{
            $_SESSION['error'] = "File upload error";
            header("Location: ../../view/pages/ward_member/e_document.php");
        }
    }
?>