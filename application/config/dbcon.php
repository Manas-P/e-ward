<?php
    $dbServerName="localhost";
    $dbUserName="root";
    $dbPassword="";
    $dbName="e-ward";

    // Sanitization
    $dbServerNameClean=filter_var($dbServerName, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    $dbUserNameClean=filter_var($dbUserName, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    $dbPasswordClean=filter_var($dbPassword, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    $dbNameClean=filter_var($dbName, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);


    $conn = mysqli_connect($dbServerNameClean,$dbUserNameClean,$dbPasswordClean,$dbNameClean) ;
 
    if (!$conn)
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
?>