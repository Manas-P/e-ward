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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../images/fav.svg" type="image/x-icon">
    <link rel="stylesheet" href="../../styles/wm_houses.css">
    <title>Admin</title>
</head>
<body>
    <section class="main">
        <!-- ==========Sidebar============= -->
        <?php
            include '../../include/ward_member/sidebar_houses.php'
        ?>
        <!-- ==========Sidebar End============= -->
        <div class="container">
            <div class="header">
                <div class="title">
                    Manage houses
                </div>
                <div class="search">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path class="str" d="M8.25 14.25C11.5637 14.25 14.25 11.5637 14.25 8.25C14.25 4.93629 11.5637 2.25 8.25 2.25C4.93629 2.25 2.25 4.93629 2.25 8.25C2.25 11.5637 4.93629 14.25 8.25 14.25Z" stroke="#B1B1B1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path class="str" d="M15.7498 15.75L12.4873 12.4875" stroke="#B1B1B1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>                        
                    <input type="text" name="" placeholder="Search..." id="">
                </div>
            </div>
           
            
           
        </div>
    </section>
</html>
	<?php
}
?>