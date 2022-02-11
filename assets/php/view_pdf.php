<?php
    include '../include/dbcon.php';
    session_start();
    //Fetch pdf data
    $pdf=$_GET['pdf'];

    // Header content type
    header("Content-type: application/pdf");
        
    header("Content-Length: " . filesize($pdf));
        
    // Send the file to the browser.
    readfile($pdf);
?>