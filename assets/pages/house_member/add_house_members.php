<?php
session_start();
include '../../include/dbcon.php';
if (isset($_SESSION["e-wardId"]) != session_id()) {
    header("Location: ../login.php");
    die();
}
else
{
    $fname=$_SESSION['fname'];
    $rid=$_SESSION['rid'];
    $houseno= $_SESSION['houseno'];
    $wardno= $_SESSION['wardno'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>E Ward</title>
        <link rel="shortcut icon" href="../../images/fav.svg" type="image/x-icon">
        <link rel="stylesheet" href="../../styles/hm_add_hm.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    </head>
    <body>
        <section class="main">
            <!-- ==========Sidebar============= -->
            <?php
                include '../../include/house_member/sidebar_hm_add_members.php'
            ?>
            <!-- ==========Sidebar End============= -->
            <div class="container">
                <div class="header">
                    <div class="title">
                        House members
                    </div>
                </div>
                <!-- content -->
                <div class="members-list">
                    <div class="members">
                        <a class="add-member">
                            <div class="icon">
                                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path class="str" d="M15 6.25V23.75" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path class="str" d="M6.25 15H23.75" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <div class="text">Add members</div>
                        </a>

                        <a href="" class="member">
                            <div class="photo">
                                <img src="../../images/uploads/photos/1637438202.png" alt="member photo">
                            </div>
                            <div class="about">
                                <div class="name">Annette Black</div>
                                <div class="tag">Age: 22</div>
                            </div>
                        </a>

                        <a href="" class="member">
                            <div class="photo">
                                <img src="../../images/uploads/photos/1637689636.png" alt="member photo">
                            </div>
                            <div class="about">
                                <div class="name">Wade Warren</div>
                                <div class="tag">Age: 52</div>
                            </div>
                        </a>
                        
                    </div>
                </div>

            </div>
        </section>
    </body>
</html>
	<?php
}
?>