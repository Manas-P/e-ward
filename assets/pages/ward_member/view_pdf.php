<?php
    include '../../include/dbcon.php';
    session_start();
    //Check login
    if (isset($_SESSION["memebrId"]) != session_id()) {
        header("Location: ../login.php");
        die();
    }
    else
    {
        //Fetch User data
        $wardno=$_SESSION['wardno'];
        $name=$_SESSION['fullname'];
        $pdf="../" . $_GET['pdf'];

        // Header content type
        header("Content-type: application/pdf");
        
        header("Content-Length: " . filesize($pdf));
        
        // Send the file to the browser.
        readfile($pdf);
    }
?>