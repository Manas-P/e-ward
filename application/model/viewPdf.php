<?php
    include '../config/dbcon.php';
    session_start();
    //Fetch pdf data
    $pdf=$_GET['pdf'];

    //Identify folder path
    $find="taxreport";
    if(strpos($pdf, $find)==false){
        $pdf=substr($pdf, 3);
    }
    
    // Header content type
    header("Content-type: application/pdf");
        
    header("Content-Length: " . filesize($pdf));
        
    // Send the file to the browser.
    readfile($pdf);
?>