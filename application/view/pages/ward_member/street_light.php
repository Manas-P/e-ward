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
        <link rel="stylesheet" href="../../../../public/assets/css/ward_member/wm_street_light.css">
        <title>Ward <?php echo $wardno; ?> || Street lights</title>
    </head>
    <body>
	    <section class="main">
            <!-- ==========Sidebar============= -->
            <?php
                include '../../layout/ward_member/sidebar_street_lights.php';
            ?>
            <!-- ==========Sidebar End============= -->
            <div class="container">
                <div class="header">
                    <div class="title">
                        Street lights
                    </div>
                    <div class="search">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path class="str" d="M8.25 14.25C11.5637 14.25 14.25 11.5637 14.25 8.25C14.25 4.93629 11.5637 2.25 8.25 2.25C4.93629 2.25 2.25 4.93629 2.25 8.25C2.25 11.5637 4.93629 14.25 8.25 14.25Z" stroke="#B1B1B1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path class="str" d="M15.7498 15.75L12.4873 12.4875" stroke="#B1B1B1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>                        
                        <input type="text" name="hsearch" placeholder="Search..." id="live-search" autocomplete="off" onkeyup="searchHouse(this.value)">
                    </div>
                </div>

                <!-- content -->
                <!-- Tab Menu -->
                <div class="tab-menu">
                    <div class="tabs">
                        <div id="tabBtn1" class="tab tab-active"> Street lights </div>
                        <div id="tabBtn2" class="tab"> Inactive street lights </div>
                    </div>
                    <div class="underline"></div>
                </div>
                <!-- street lights -->
                <div id="tabCon1" class="tab-content tab-con-active">
                    <div class="street-lights">
                        <div class="add-sl">
                            Add street light
                        </div>
                        <div class="headings">
                            <div>Slno.</div>
                            <div style="margin-left: 70px;">Light number</div>
                            <div style="margin-left: 85px;">Locality</div>
                            <div style="margin-left: 267px;">Nearby houses</div>
                            <div style="margin-left: 118px;">Status</div>
                            <div style="margin-left: 98px;">Action</div>
                        </div>
                        <div class="datas">
                            <div class="data">
                                <table>
                                    <tr>
                                        <td width=108px>1.</td>
                                        <td width=207px>E33</td>
                                        <td width=340px>154th mile, Amet minim</td>
                                        <td width=255px>16, 24, 15</td>
                                        <td width=158px>Active</td>
                                        <td width=311px>Not required</td>
                                        <td width="22px">
                                            <a href="">
                                                <svg width="22" height="21" viewBox="0 0 22 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M3.125 5.25H4.875H18.875" stroke="#EC0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M7.5 5.25V3.5C7.5 3.03587 7.68437 2.59075 8.01256 2.26256C8.34075 1.93437 8.78587 1.75 9.25 1.75H12.75C13.2141 1.75 13.6592 1.93437 13.9874 2.26256C14.3156 2.59075 14.5 3.03587 14.5 3.5V5.25M17.125 5.25V17.5C17.125 17.9641 16.9406 18.4092 16.6124 18.7374C16.2842 19.0656 15.8391 19.25 15.375 19.25H6.625C6.16087 19.25 5.71575 19.0656 5.38756 18.7374C5.05937 18.4092 4.875 17.9641 4.875 17.5V5.25H17.125Z" stroke="#EC0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M9.25 9.625V14.875" stroke="#EC0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M12.75 9.625V14.875" stroke="#EC0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of street lights -->
                <!-- inactive street lights -->
                <div id="tabCon2" class="tab-content">
                    <div class="street-lights">
                        <div class="headings">
                            <div>Slno.</div>
                            <div style="margin-left: 70px;">Light number</div>
                            <div style="margin-left: 85px;">Locality</div>
                            <div style="margin-left: 267px;">Nearby houses</div>
                            <div style="margin-left: 118px;">Status</div>
                            <div style="margin-left: 98px;">Action</div>
                        </div>
                        <div class="datas">
                            <div class="data">
                                <table>
                                    <tr>
                                        <td width=108px>1.</td>
                                        <td width=207px>E33</td>
                                        <td width=340px>154th mile, Amet minim</td>
                                        <td width=255px>16, 24, 15</td>
                                        <td width=158px>Active</td>
                                        <td width=311px>Not required</td>
                                        <td width="22px">
                                            <a href="">
                                                <svg width="22" height="21" viewBox="0 0 22 21" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M3.125 5.25H4.875H18.875" stroke="#EC0000" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                    <path
                                                        d="M7.5 5.25V3.5C7.5 3.03587 7.68437 2.59075 8.01256 2.26256C8.34075 1.93437 8.78587 1.75 9.25 1.75H12.75C13.2141 1.75 13.6592 1.93437 13.9874 2.26256C14.3156 2.59075 14.5 3.03587 14.5 3.5V5.25M17.125 5.25V17.5C17.125 17.9641 16.9406 18.4092 16.6124 18.7374C16.2842 19.0656 15.8391 19.25 15.375 19.25H6.625C6.16087 19.25 5.71575 19.0656 5.38756 18.7374C5.05937 18.4092 4.875 17.9641 4.875 17.5V5.25H17.125Z"
                                                        stroke="#EC0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M9.25 9.625V14.875" stroke="#EC0000" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path d="M12.75 9.625V14.875" stroke="#EC0000" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of inactive street lights -->
                
            </div>
        </section>

        <!-- =========== Modal ============ -->
        <div class="overlay modal-hidden"></div>
        <!-- form to add street lights-->
        <div class="box modal-box modal-hidden">
            <div class="title"> Add street light </div>
            <div class="modal-close-btn">
                <img src="../../../../public/assets/images/close.svg" alt="close button">
            </div>
            <!-- Add task -->
            <form action="" method="post" id="add-task" enctype="multipart/form-data">
                <div class="inputs">
                    <div class="input commName">
                        <div class="label"> Street light number </div>
                        <input type="text" name="name" id="comm-name" placeholder="John Doe" autocomplete="off">
                        <div class="error error-hidden">
                        </div>
                    </div>
                    <div class="input commlocality">
                        <div class="label"> Locality </div>
                        <input type="text" name="name" id="comm-locality" placeholder="John Doe" autocomplete="off">
                        <div class="error error-hidden">
                        </div>
                    </div>
                    <div class="input">
                        <div class="label"> Roles </div>
                        <div class="checkboxes">
                            <div class="checkbox">
                                <input type="checkbox" name="mhouse" value="0" id="manage-house">
                                <label for="manage-house">12</label>
                            </div>
                            <div class="checkbox">
                                <input type="checkbox" name="mcommittee" value="0" id="manage-committees">
                                <label for="manage-committees">24</label>
                            </div>
                            <div class="checkbox">
                                <input type="checkbox" name="mcomplaint" value="0" id="manage-complaints">
                                <label for="manage-complaints">56</label>
                            </div>
                            <div class="checkbox">
                                <input type="checkbox" name="mcomplaint" value="0" id="manage-complaints">
                                <label for="manage-complaints">56</label>
                            </div>
                        </div>
                    </div>
                    <div class="button hBtn cursor-disable">
                        <input type="submit" value="Add task" name="add-comm" id="add-comm" onclick="loader()"
                            class="primary-button disabled">
                    </div>
                </div>
            </form>
        </div>


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

        <script src="../../../../public/assets/js/wm_street_light.js"></script>
        <script src="../../../../public/assets/js/toast.js"></script>
    </body>
    </html>
<?php
    }
?>