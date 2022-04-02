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
        <link rel="stylesheet" href="../../../../public/assets/css/ward_member/wm_view_committee.css">
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
                    <a href="" class="now">
                        Committee new
                    </a>
                </div>

                <!-- content -->
                <div class="committee-details">
                    <div class="basic-description">
                        <div class="img">
                            <img src="../../../../public/assets/images/uploads/photos/1637689886.png" alt="">
                        </div>
                        <div class="description">
                            <div class="heading">
                                Committee new
                            </div>
                            <div class="det">
                                Amet minim mollit non deserunt ullamco est sit aliqua dolor do 
                                amet sint. Velit officia consequat duis enim velit mollit. 
                                Exercitation veniam consequat sunt nostrud amet.Amet minim 
                                mollit non deserunt ullamco est sit aliqua dolor do amet sint.
                            </div>
                        </div>
                    </div>
                    <div class="other-content">
                        <div class="divider"></div>
                        <div class="contents">
                            <div class="content">Members limit:<span>25</span></div>
                            <div class="content">Members joined:<span>16</span></div>
                            <div class="content">Created by:<span>Wade Warren</span></div>
                        </div>
                    </div>
                    <div class="buttons">
                        <a href="" class="update">Update</a>
                        <a href="" class="close">Close</a>
                    </div>
                </div>

                <!-- Tab Menu -->
                <div class="tab-menu">
                    <div class="tabs">
                        <div id="tabBtn1" class="tab tab-active">
                            Members
                        </div>
                        <div id="tabBtn2" class="tab">
                            Committee tasks
                        </div>
                        <div id="tabBtn3" class="tab">
                            Requests
                        </div>
                    </div>
                    <div class="underline"></div>
                </div>

                <!-- View members -->
                <div id="tabCon1" class="tab-content tab-con-active">
                    <div class="content-table">
                        <div class="headings">
                            <div>Slno.</div>
                            <div style="margin-left: 70px;">Name</div>
                            <div style="margin-left: 184px;">House no.</div>
                            <div style="margin-left: 74px;">Phone no.</div>
                            <div style="margin-left: 89px;">Email id</div>
                            <div style="margin-left: 282px;">Assigned tasks</div>
                            <div style="margin-left: 58px;">Completed tasks</div>
                        </div>
                        <div class="datas">
                            <div class="data">
                                <table>
                                    <tr>
                                        <td width=108px>1.</td>
                                        <td width=236px>Brooklyn Simmons</td>
                                        <td width=160px>124</td>
                                        <td width=180px>9854587856</td>
                                        <td width=354px>brooklynsimmo01n@gmail.com</td>
                                        <td width=194px>3</td>
                                        <td>1</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="datas">
                            <div class="data">
                                <table>
                                    <tr>
                                        <td width=108px>2.</td>
                                        <td width=236px>Wade Warren</td>
                                        <td width=160px>15</td>
                                        <td width=180px>9587845126</td>
                                        <td width=354px>wadewarren@gmail.com</td>
                                        <td width=194px>5</td>
                                        <td>3</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of view members -->

                <div id="tabCon2" class="tab-content">
                    <div class="committe-tasks">
                        <div class="tasks">
                            <a class="add-task">
                                <div class="icon">
                                    <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path class="str" d="M15 6.25V23.75" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path class="str" d="M6.25 15H23.75" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                                <div class="text">Add task</div>
                            </a>
        
                            <!-- Fetch office staffs -->
                                
                            <a href="" class="task">
                                <div class="about">
                                    <div class="name">Task name one</div>
                                    <div class="members-asgn"><span>Members assigned:</span>active</div>
                                    <div class="sub">Status:<div class="tag" style="color:#EC0000; background:#FCD9D9;">Incomplete</div></div>
                                </div>
                            </a>

                            <a href="" class="task">
                                <div class="about">
                                    <div class="name">Task name two</div>
                                    <div class="members-asgn"><span>Members assigned:</span>active</div>
                                    <div class="sub">Status:<div class="tag" style="color:#1BBD2B; background:#DDF5DF;">Completed</div></div>
                                </div>
                            </a>

                        </div>
                    </div>
                </div>

                <!-- View membership request -->
                <div id="tabCon3" class="tab-content">
                    <div class="content-table">
                        <div class="headings">
                            <div>Slno.</div>
                            <div style="margin-left: 70px;">Name</div>
                            <div style="margin-left: 184px;">House no.</div>
                            <div style="margin-left: 74px;">Phone no.</div>
                            <div style="margin-left: 89px;">Email id</div>
                            <div style="margin-left: 324px;">Age</div>
                            <div style="margin-left: 90px;">Action</div>
                        </div>
                        <div class="datas">
                            <div class="data">
                                <table>
                                    <tr>
                                        <td width=108px>1.</td>
                                        <td width=236px>Annette Black</td>
                                        <td width=160px>46</td>
                                        <td width=180px>9854587856</td>
                                        <td width=396px>annetteblack@gmail.com</td>
                                        <td width=130px>23</td>
                                        <td width=95px>
                                            <a  class="approve" onclick="loader()" >Approve</a>
                                        </td>
                                        <td>
                                            <a class="reject" >Reject</a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of membership request -->
                
            </div>
        </section>


        <!-- =========== Modal ============ -->
        <div class="overlay modal-hidden"></div>
        <!-- form to add committee task-->
        <div class="box modal-box modal-hidden">
            <div class="title">
                Add committee task
            </div>
            <div class="modal-close-btn">
                <img src="../../../../public/assets/images/close.svg" alt="close button">
            </div>
            <!-- Add task -->
            <form action="" method="post" id="add-task" enctype="multipart/form-data">
                <div class="inputs">
                    <div class="input commName">
                        <div class="label">
                            Task name
                        </div>
                        <input type="text" name="name" id="comm-name" placeholder="John Doe" autocomplete="off">
                        <div class="error error-hidden">
                        </div>
                    </div>
                    <div class="inputt commDes">
                        <div class="label">
                            Task description
                        </div>
                        <textarea name="comm_des" id="comm-des" rows="10"></textarea>
                        <div class="subtext">
                            <div class="error error-hidden">
                            </div>
                            <div class="count-limit">
                                <span id="count-char">0</span>/370
                            </div>
                        </div>
                    </div>
                    <div class="button hBtn cursor-disable">
                        <input type="submit" value="Add task" name="add-comm" id="add-comm" onclick="loader()" class="primary-button disabled">
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

        <script src="../../../../public/assets/js/wm_view_committee.js"></script>
        <script src="../../../../public/assets/js/toast.js"></script>
    </body>
    </html>
<?php
    }
?>