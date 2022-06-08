<?php
    include '../../config/dbcon.php';
    session_start();
    extract($_POST);
    $wardno=$_SESSION['wardno'];
    $id=$_GET['id'];

    $query="DELETE FROM `tbl_e_doc` WHERE `id`='$id'";
    $queryResult=mysqli_query($conn, $query);
    if($queryResult){
        $_SESSION['success'] = "File deleted successfully";
        echo "<script>window.location='../../view/pages/ward_member/e_document.php'</script>";
        // header("Location: ../../view/pages/ward_member/e_document.php");
    }else{
        $_SESSION['error'] = "An error occured";
        echo "<script>window.location='../../view/pages/ward_member/e_document.php'</script>";
        // header("Location: ../../view/pages/ward_member/e_document.php");
    }
?>