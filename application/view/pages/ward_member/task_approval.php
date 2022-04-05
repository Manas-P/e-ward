<?php
    include '../../../config/dbcon.php';
    session_start();
    //Check login
    if (isset($_SESSION["sessionId"]) != session_id()) {
        header("Location: ../login/login.php");
        die();
    }
    else
    {
        //Fetch User data
        $wardno=$_SESSION['wardno'];
?>
	<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="../../../../public/assets/images/fav.svg" type="image/x-icon">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../../../../public/assets/css/ward_member/wm_task_approval.css">
        <title>Ward <?php echo $wardno; ?> || Committees</title>
    </head>
    <body>
	    <section class="main">
            <!-- ==========Sidebar============= -->
            <?php
                include '../../layout/ward_member/sidebar_committees.php';
            ?>
            <!-- ==========Sidebar End============= -->
            <div class="container">
                <div class="header">
                    <div class="title">
                        Committees
                    </div>
                    <div class="search">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path class="str" d="M8.25 14.25C11.5637 14.25 14.25 11.5637 14.25 8.25C14.25 4.93629 11.5637 2.25 8.25 2.25C4.93629 2.25 2.25 4.93629 2.25 8.25C2.25 11.5637 4.93629 14.25 8.25 14.25Z" stroke="#B1B1B1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path class="str" d="M15.7498 15.75L12.4873 12.4875" stroke="#B1B1B1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>                        
                        <input type="text" name="hsearch" placeholder="Search..." id="live-search" autocomplete="off" onkeyup="searchHouse(this.value)">
                    </div>
                </div>
                <div class="bread-crumbs">
                    <a href="./committees.php" class="previous">
                        Committees
                    </a>
                    <svg class="str" width="8" height="10" viewBox="0 0 8 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.2002 8.59999L5.8002 4.99999L2.2002 1.39999" stroke="#1E1E1E" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <a href="./view_committee.php" class="previous">
                        Committee new
                    </a>
                    <svg class="str" width="8" height="10" viewBox="0 0 8 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.2002 8.59999L5.8002 4.99999L2.2002 1.39999" stroke="#1E1E1E" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <a href="./view_task.php" class="previous">
                        Task name 1
                    </a>
                    <svg class="str" width="8" height="10" viewBox="0 0 8 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.2002 8.59999L5.8002 4.99999L2.2002 1.39999" stroke="#1E1E1E" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <a href="" class="now">
                        Member name
                    </a>
                </div>

                <!-- content -->
                <!-- Tab Menu -->
                <div class="tab-menu">
                    <div class="tabs">
                        <div id="tabBtn1" class="tab tab-active">
                            Pending approval
                        </div>
                        <div id="tabBtn2" class="tab">
                            Approved work
                        </div>
                        <div id="tabBtn3" class="tab">
                            Rejected work
                        </div>
                    </div>
                    <div class="underline"></div>
                </div>

                <!-- Pending approval -->
                <div id="tabCon1" class="tab-content tab-con-active">
                    <div class="cards">
                        <div class="card">
                            <div class="header">
                                <div class="title">
                                    Title
                                </div>
                                <div class="date">
                                    20-03-2022
                                </div>
                            </div>
                            <div class="description">
                                Amet minim mollit non deserunt ullamco est sit aliqua dolor 
                                do amet sint. Velit officia consequat duis enim velit
                                mollit. Exercitation veniam consequat sunt nostrud amet. 
                                Amet minim mollit non deserunt ullamco est sit aliqua dolor do
                                amet sint. Duis enim velit mollit. Exercitation veniam 
                                consequat sunt nostrud amet.Amet minim mollit non deserunt
                                ullamco est sit aliqua dolor do amet sint.
                            </div>
                            <div class="photos">
                                <div class="title">
                                    Photos
                                </div>
                                <div class="images">
                                    <div class="img">
                                        <img src="../../../../public/assets/images/uploads/photos/1637689428.png" alt="">
                                    </div>
                                    <div class="img">
                                        <img src="../../../../public/assets/images/uploads/photos/1644758474.png" alt="">
                                    </div>
                                    <div class="img">
                                        <img src="../../../../public/assets/images/uploads/photos/1643901418.jpg" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="underline">
                            </div>
                            <div class="buttons">
                                <a href="" class="approve">Approve</a>
                                <a href="" class="reject">Reject</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Pending approval -->

                <!-- Approved work -->
                <div id="tabCon2" class="tab-content">
                    <div class="cards">
                        <div class="card">
                            <div class="header">
                                <div class="title">
                                    New title
                                </div>
                                <div class="date">
                                    18-03-2022
                                </div>
                            </div>
                            <div class="description">
                                Amet minim mollit non deserunt ullamco est sit aliqua dolor
                                do amet sint. Velit officia consequat duis enim velit
                                mollit. Exercitation veniam consequat sunt nostrud amet.
                                Amet minim mollit non deserunt ullamco est sit aliqua dolor do
                                amet sint. Duis enim velit mollit.
                            </div>
                            <div class="photos">
                                <div class="title">
                                    Photos
                                </div>
                                <div class="images">
                                    <div class="img">
                                        <img src="../../../../public/assets/images/uploads/photos/1637437604.png" alt="">
                                    </div>
                                    <div class="img">
                                        <img src="../../../../public/assets/images/uploads/photos/1637438042.png" alt="">
                                    </div>
                                    <div class="img">
                                        <img src="../../../../public/assets/images/uploads/photos/1637438149.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Approved work -->

                <!-- Rejected work -->
                <div id="tabCon3" class="tab-content">
                    <h1>Tab 3</h1>
                </div>
                <!-- End of Rejected work -->
                
            </div>
        </section>


        


        <!-- Error Toast -->
        <?php
        if (isset($_SESSION['error'])) {
            $msg=$_SESSION['error'];
          echo " <div class='alertt alert-visible'>
                        <div class='econtent'>
                            <img src='../../../../public/assets/images/warning.svg' alt='warning'>
                            <div class='text'>
                                $msg
                            </div>
                        </div>
                        <img src='../../../../public/assets/images/close.svg' alt='close' class='alert-close'>
                    </div>";
          unset($_SESSION['error']);
        }?>

        <!-- Success toast -->
        <?php
            if (isset($_SESSION['success'])) {
                $msg=$_SESSION['success'];
                echo " <div class='alertt alert-visible' style='border-left: 10px solid #1BBD2B;'>
                            <div class='econtent'>
                                <img src='../../../../public/assets/images/check.svg' alt='success'>
                                <div class='text'>
                                    $msg
                                </div>
                            </div>
                            <img src='../../../../public/assets/images/close.svg' alt='close' class='alert-close'>
                        </div>";
                unset($_SESSION['success']);
        }?>

        <!-- ==========Loading============= -->
        <?php
            include '../../includes/loading.php';
        ?>
        <!-- ==========Loading End============= -->

        <script src="../../../../public/assets/js/wm_task_approval.js"></script>
        <script src="../../../../public/assets/js/toast.js"></script>
    </body>
    </html>
<?php
    }
?>