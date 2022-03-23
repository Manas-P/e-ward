<?php
    include '../config/dbcon.php';
    session_start();
    //Fetch pdf data
    $pdf=$_GET['pdf'];
    
    // Header content type
    header("Content-type: application/pdf");
        
    header("Content-Length: " . filesize($pdf));
        
    // Send the file to the browser.
    readfile($pdf);
?>
<!-- <a href="../../public/assets/documents/taxreport/"></a>
../../public/assets/documents/taxreport/1647663153.pdf -->