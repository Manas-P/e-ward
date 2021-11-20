<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin | Add Ward Memeber</title>
        <link rel="shortcut icon" href="../../images/fav.svg" type="image/x-icon">
        <link rel="stylesheet" href="../../styles/admin_add_wm.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    </head>
    <body>
        <section class="main">
            <!-- ==========Sidebar============= -->
            <div class="sidebar">
                <div class="brand">
                    <img src="../../images/logo.svg" alt="logo" srcset="">
                    <div class="user">Admin</div>
                </div>
                <div class="division"></div>
                <div class="links">
                    <div class="menus">
                        <a href="./admin_add_wm.php" class="menu active">
                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path class="str active" d="M18.3334 19.25V17.4167C18.3334 16.4442 17.9471 15.5116 17.2595 14.8239C16.5718 14.1363 15.6392 13.75 14.6667 13.75H7.33341C6.36095 13.75 5.42832 14.1363 4.74069 14.8239C4.05306 15.5116 3.66675 16.4442 3.66675 17.4167V19.25" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="str active" d="M11.0002 10.0833C13.0252 10.0833 14.6668 8.44171 14.6668 6.41667C14.6668 4.39162 13.0252 2.75 11.0002 2.75C8.97512 2.75 7.3335 4.39162 7.3335 6.41667C7.3335 8.44171 8.97512 10.0833 11.0002 10.0833Z" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <div class="text active">Ward Member</div>
                        </a>
                        <a href="" class="menu">
                            <svg width="24" height="22" viewBox="0 0 24 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path class="str" d="M15.6667 2.75H1.91675V14.6667H15.6667V2.75Z" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="str" d="M15.6667 7.33334H19.3334L22.0834 10.0833V14.6667H15.6667V7.33334Z" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="str" d="M6.04167 19.25C7.30732 19.25 8.33333 18.224 8.33333 16.9583C8.33333 15.6927 7.30732 14.6667 6.04167 14.6667C4.77601 14.6667 3.75 15.6927 3.75 16.9583C3.75 18.224 4.77601 19.25 6.04167 19.25Z" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="str" d="M17.9584 19.25C19.2241 19.25 20.2501 18.224 20.2501 16.9583C20.2501 15.6927 19.2241 14.6667 17.9584 14.6667C16.6928 14.6667 15.6667 15.6927 15.6667 16.9583C15.6667 18.224 16.6928 19.25 17.9584 19.25Z" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <div class="text">Waste Manager</div>
                        </a>
                        <a href="" class="menu">
                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path class="str" d="M10.0833 3.77783H3.66659C3.18036 3.77783 2.71404 3.97099 2.37022 4.3148C2.02641 4.65862 1.83325 5.12494 1.83325 5.61117V18.4445C1.83325 18.9307 2.02641 19.397 2.37022 19.7409C2.71404 20.0847 3.18036 20.2778 3.66659 20.2778H16.4999C16.9861 20.2778 17.4525 20.0847 17.7963 19.7409C18.1401 19.397 18.3333 18.9307 18.3333 18.4445V12.0278" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="str" d="M16.9583 2.40286C17.3229 2.03818 17.8175 1.83331 18.3333 1.83331C18.849 1.83331 19.3436 2.03818 19.7083 2.40286C20.0729 2.76753 20.2778 3.26213 20.2778 3.77786C20.2778 4.29358 20.0729 4.78818 19.7083 5.15286L10.9999 13.8612L7.33325 14.7779L8.24992 11.1112L16.9583 2.40286Z" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <div class="text">Update Profile</div>
                        </a>
                    </div>
                    <div class="logout">
                        <a href="">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path class="str" d="M9 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H9" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="str" d="M16 17L21 12L16 7" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="str" d="M21 12H9" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <div class="text">Logout</div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- ==========Sidebar End============= -->
            <div class="container">
                <div class="header">
                    <div class="title">
                        Manage ward members
                    </div>
                    <div class="search">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path class="str" d="M8.25 14.25C11.5637 14.25 14.25 11.5637 14.25 8.25C14.25 4.93629 11.5637 2.25 8.25 2.25C4.93629 2.25 2.25 4.93629 2.25 8.25C2.25 11.5637 4.93629 14.25 8.25 14.25Z" stroke="#B1B1B1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path class="str" d="M15.7498 15.75L12.4873 12.4875" stroke="#B1B1B1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>                        
                        <input type="text" name="" placeholder="Search..." id="">
                    </div>
                </div>
                <!-- President -->
                <div class="president">
                    <div class="heading">
                        President
                    </div>
                    <a class="add-president">
                        <div class="icon">
                            <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path class="str" d="M15 6.25V23.75" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="str" d="M6.25 15H23.75" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="text">Add president</div>
                    </a>
                </div>
                <!-- Ward Members -->
                <div class="members-list">
                    <div class="heading">
                        Ward Members
                    </div>
                    <div class="members">
                        <a class="add-member">
                            <div class="icon">
                                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path class="str" d="M15 6.25V23.75" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path class="str" d="M6.25 15H23.75" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <div class="text">Add ward member</div>
                        </a>
                        <!-- Members -->
                        <a href="" class="member">
                            <div class="photo">
                                <img src="../../images/uploads/photos/member1.png" alt="member photo">
                            </div>
                            <div class="about">
                                <div class="name">Wade Warren</div>
                                <div class="tag">Ward: 1</div>
                            </div>
                        </a>
                        <!-- Members -->
                        <a href="" class="member">
                            <div class="photo">
                                <img src="../../images/uploads/photos/member1.png" alt="member photo">
                            </div>
                            <div class="about">
                                <div class="name">Wade Warren</div>
                                <div class="tag">Ward: 1</div>
                            </div>
                        </a>
                        <!-- Members -->
                        <a href="" class="member">
                            <div class="photo">
                                <img src="../../images/uploads/photos/member1.png" alt="member photo">
                            </div>
                            <div class="about">
                                <div class="name">Wade Warren</div>
                                <div class="tag">Ward: 1</div>
                            </div>
                        </a>
                        <!-- Members -->
                        <a href="" class="member">
                            <div class="photo">
                                <img src="../../images/uploads/photos/member1.png" alt="member photo">
                            </div>
                            <div class="about">
                                <div class="name">Wade Warren</div>
                                <div class="tag">Ward: 1</div>
                            </div>
                        </a>
                        <!-- Members -->
                        <a href="" class="member">
                            <div class="photo">
                                <img src="../../images/uploads/photos/member1.png" alt="member photo">
                            </div>
                            <div class="about">
                                <div class="name">Wade Warren</div>
                                <div class="tag">Ward: 1</div>
                            </div>
                        </a>
                        <!-- Members -->
                        <a href="" class="member">
                            <div class="photo">
                                <img src="../../images/uploads/photos/member1.png" alt="member photo">
                            </div>
                            <div class="about">
                                <div class="name">Wade Warren</div>
                                <div class="tag">Ward: 1</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <!--=========== Modal ============-->
        <div class="overlay modal-hidden"></div>
        <!-- form to add members-->
        <div class="box modal-box modal-hidden">
            <div class="title">
                Add ward member
            </div>
            <div class="modal-close-btn">
                <img src="../../images/close.svg" alt="close button">
            </div>
            <!-- Add Ward Memeber -->
            <form action="../../php/auth.php" method="post" id="add-ward-member" enctype="multipart/form-data">
                <div class="inputs">
                    <div class="input w-fullname">
                        <div class="label">
                            Full name
                        </div>
                        <input type="text" name="wfname" id="w-full-name" placeholder="John Doe" autocomplete="off">
                        <div class="error error-hidden">
                        </div>
                    </div>
                    <div class="input w-email">
                        <div class="label">
                            Email ID
                        </div>
                        <input type="text" name="wemail" id="w-email-id" placeholder="example@gmail.com" autocomplete="off">
                        <div class="error error-hidden">
                        </div>
                    </div>
                    <div class="input w-phno">
                        <div class="label">
                            Phone number
                        </div>
                        <input type="text" name="wphno" id="w-phn-number" placeholder="9568547512" autocomplete="off">
                        <div class="error error-hidden">
                        </div>
                    </div>
                    <div class="half-input">
                        <div class="input w-wrdno">
                            <div class="label">
                                Ward number
                            </div>
                            <input type="text" name="wwrdno" id="w-ward-number" placeholder="25" autocomplete="off" oninput="validateWardNo(this.value)">
                            <div class="error error-hidden">
                            </div>
                        </div>
                        <div class="input w-date">
                            <div class="label">
                                Valid upto
                            </div>
                            <input type="date" name="wvalidity" id="w-date" autocomplete="off">
                            <div class="error error-hidden">
                            </div>
                        </div>
                    </div>
                    <div class="input w-photo">
                        <div class="label">
                            Upload photo
                        </div>
                        <input type="file" name="wphoto" id="w-photo" accept="image/png,image/jpeg">
                        <div class="error error-hidden">
                        </div>
                    </div>
                    <div class="button wBtn cursor-disable">
                        <input type="submit" value="Add member" name="add-wm" id="add-wm" class="primary-button disabled">
                    </div>
                </div>
            </form>
        </div>
        <!-- Form to add President -->
        <div class="box modal-box2 modal-hidden">
            <div class="title">
                Add president
            </div>
            <div class="modal-close-btn pre-cls-btn">
                <img src="../../images/close.svg" alt="close button">
            </div>
            <form action="" method="post" id="add-president">
                <div class="inputs">
                    <div class="input p-fullname">
                        <div class="label">
                            Full name
                        </div>
                        <input type="text" name="fname" id="p-full-name" placeholder="John Doe" autocomplete="off">
                        <div class="error error-hidden">
                        </div>
                    </div>
                    <div class="input p-email">
                        <div class="label">
                            Email ID
                        </div>
                        <input type="text" name="email" id="p-email-id" placeholder="example@gmail.com" autocomplete="off">
                        <div class="error error-hidden">
                        </div>
                    </div>
                    <div class="input p-phno">
                        <div class="label">
                            Phone number
                        </div>
                        <input type="text" name="phno" id="p-phn-number" placeholder="9568547512" autocomplete="off">
                        <div class="error error-hidden">
                        </div>
                    </div>
                    <div class="half-input">
                        <div class="input p-wrdno">
                            <div class="label">
                                Ward number
                            </div>
                            <input type="text" name="wrdno" id="p-ward-number" placeholder="25" autocomplete="off">
                            <div class="error error-hidden">
                            </div>
                        </div>
                        <div class="input p-date">
                            <div class="label">
                                Valid upto
                            </div>
                            <input type="date" name="houno" id="p-date" autocomplete="off">
                            <div class="error error-hidden">
                            </div>
                        </div>
                    </div>
                    <div class="input p-photo">
                        <div class="label">
                            Upload photo
                        </div>
                        <input type="file" name="phno" id="p-photo" accept="image/png,image/jpeg">
                        <div class="error error-hidden">
                        </div>
                    </div>
                    <div class="button pBtn cursor-disable">
                        <input type="submit" value="Add member" name="regbtn" id="add-p" class="primary-button disabled">
                    </div>
                </div>
            </form>
        </div>
        <div id="warrning-box" >
            <!-- Inject Error Toast -->
        </div>
        <?php
        if (isset($_SESSION['loginMessage'])) {
            $msg=$_SESSION['loginMessage'];
          echo " <div class='alertt alert-visible'>
                        <div class='econtent'>
                            <img src='../../images/warning.svg' alt='warning'>
                            <div class='text'>
                                $msg
                            </div>
                        </div>
                        <img src='../../images/close.svg' alt='close' class='alert-close'>
                    </div>";
          unset($_SESSION['loginMessage']);
        }?>
        <script src="../../js/admin_add_wm.js"></script>
        <script>
            function validateWardNo(ward)
            {  
                 $.ajax({
                    url: "../../php/auth.php",
                    type: "POST",
                    data: {
                        wardNo:ward
                    },
                    success: function(data, status) {
                        $('#warrning-box').html(data);
                        // hosnoSubmit=false;
                    }
                });
             }
        </script>
    </body>
</html>