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
        =========== Modal ============
        <div class="overlay modal-hidden"></div>
        <!-- form to add members-->
        <div class="box modal-box modal-hidden">
            <div class="title">
                Add house member
            </div>
            <div class="modal-close-btn">
                <img src="../../images/close.svg" alt="close button">
            </div>
            <!-- Add House Memeber -->
            <form action="../../php/auth.php" method="post" id="add-house-member" enctype="multipart/form-data">
                <div class="inputs">
                    <div class="input h-fullname">
                        <div class="label">
                            Full name
                        </div>
                        <input type="text" name="hfname" id="h-full-name" placeholder="John Doe" autocomplete="off">
                        <div class="error error-hidden">
                        </div>
                    </div>
                    <div class="input h-email">
                        <div class="label">
                            Email ID
                        </div>
                        <input type="text" name="hemail" id="h-email-id" placeholder="example@gmail.com" autocomplete="off">
                        <div class="error error-hidden">
                        </div>
                    </div>
                    <div class="input h-phno">
                        <div class="label">
                            Phone number
                        </div>
                        <input type="text" name="hphno" id="h-phn-number" placeholder="9568547512" autocomplete="off">
                        <div class="error error-hidden">
                        </div>
                    </div>
                    <div class="half-input">
                        <div class="input h-blood">
                            <div class="label">
                                Blood group
                            </div>
                            <input type="text" name="hwrdno" id="h-blood" placeholder="A+" autocomplete="off">
                            <div class="error error-hidden">
                            </div>
                        </div>
                        <div class="input h-date">
                            <div class="label">
                                Date of birth
                            </div>
                            <input type="date" name="hvalidity" id="h-date" autocomplete="off">
                            <div class="error error-hidden">
                            </div>
                        </div>
                    </div>
                    <div class="input h-photo">
                        <div class="label">
                            Upload photo
                        </div>
                        <input type="file" name="hphoto" id="h-photo" accept="image/png,image/jpeg">
                        <div class="error error-hidden">
                        </div>
                    </div>
                    <div class="button hBtn cursor-disable">
                        <input type="submit" value="Add member" name="add-hm" id="add-hm" class="primary-button disabled">
                    </div>
                </div>
            </form>
        </div>
        <script src="../../js/hm_add_hm.js"></script>
    </body>
</html>
	<?php
}
?>