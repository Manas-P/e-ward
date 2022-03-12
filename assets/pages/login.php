<?php
session_start();
?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Ward | Login</title>
    <link rel="shortcut icon" href="../images/fav.svg" type="image/x-icon">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../styles/google_translater.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
</head>
<body>
    <section class="main">
        <div class="sections">
            <div class="content">
                <div class="logo">
                    <a href="../../index.php">
                        <img src="../images/logo.svg" alt="Logo">
                    </a>
                    
                </div>
                <div class="description">
                    The goal of this web application is to reduce the amount of 
                    work that ward members have to do, make their jobs easier, 
                    and make their activities more transparent. Here, manual 
                    tasks are transformed to digital, allowing paper tasks to 
                    be reduced to online tasks.
                </div>

                <div class="connection">
                    <img src="../images/connections.png" alt="Connections">
                </div>
            </div>
            <!-- Error toast -->
            <?php
                if (isset($_SESSION['loginMessage'])) {
                    $msg=$_SESSION['loginMessage'];
                    echo " <div class='alertt alert-visible'>
                                    <div class='econtent'>
                                        <img src='../images/warning.svg' alt='warning'>
                                        <div class='text'>
                                            $msg
                                        </div>
                                    </div>
                                    <img src='../images/close.svg' alt='close' class='alert-close'>
                                </div>";
                    unset($_SESSION['loginMessage']);
            }?>

            <!-- Success toast -->
            <?php
                if (isset($_SESSION['success'])) {
                    $msg=$_SESSION['success'];
                    echo " <div class='alertt alert-visible' style='border-left: 10px solid #1BBD2B;'>
                                <div class='econtent'>
                                    <img src='../images/check.svg' alt='success'>
                                    <div class='text'>
                                        $msg
                                    </div>
                                </div>
                                <img src='../images/close.svg' alt='close' class='alert-close'>
                            </div>";
                    unset($_SESSION['success']);
            }?>

            <div class="form">
                <div class="box">
                    <div class="login-text">
                        <div class="title">
                            Login to continue
                        </div>
                        <div class="sub-title">
                            A web-based application for managing your ward.
                        </div>
                    </div>
                    <form action="../php/auth.php" method="post">
                        <div class="inputs">
                            <div class="input">
                                <div class="label">
                                    Username
                                </div>
                                <input type="text" name="userName" id="" placeholder="House no./committe no." autocomplete="off" >
                            </div>
                            <div class="input">
                                <div class="label">
                                    Password
                                </div>
                                <input type="password" name="password" id="" placeholder="Password" autocomplete="off">
                            </div>
                        </div>
                        <div class="sub">
                            <div class="checkbox">
                                <input type="checkbox" name="" id="check" checked>
                                <label for="check">Remember me</label>
                            </div>
                                <a href="./forgot_password.php" class="forgot">Forgot password?</a>
                        </div>
                        <div class="buttons">
                            <input type="submit" value="Login" name="submitButton" class="primary-button">
                            <div class="or">
                                <div class="line"></div>
                                <span>Or</span>
                                <div class="line"></div>
                            </div>
                            <input type="button" value="Register" id="register" class="secondary-button">
                        </div>
                    </form>
                </div>

                <!-- Registration Form -->

                <div class="box2">
                    <div class="register-text">
                        <div class="title">
                            Register your house
                        </div>
                        <div class="sub-title">
                            Already have an account?<a>Login</a> 
                        </div>
                    </div>
                    <form id="reg-form" action="../php/auth.php" method="post" enctype="multipart/form-data">
                        <div class="inputs">
                            <div class="input fullname">
                                <div class="label">
                                    Full name
                                </div>
                                <input type="text" name="fname" id="full-name" placeholder="John Doe" autocomplete="off">
                                <div class="error error-hidden">
                                    
                                </div>
                            </div>
                            <div class="input email">
                                <div class="label">
                                    Email ID
                                </div>
                                <input type="text" name="email" id="email-id" placeholder="example@gmail.com" autocomplete="off">
                                <div class="error error-hidden">
                                </div>
                            </div>
                            <div class="input phno">
                                <div class="label">
                                    Phone number
                                </div>
                                <input type="text" name="phno" id="phn-number" placeholder="9568547512" autocomplete="off">
                                <div class="error error-hidden">
                                </div>
                            </div>
                            <div class="half-input">
                                <div class="input wrdno">
                                    <div class="label">
                                        Ward number
                                    </div>
                                    <input type="text" name="wrdno" id="ward-number" placeholder="25" autocomplete="off">
                                    <div class="error error-hidden">
                                    </div>
                                </div>
                                <div class="input houseno">
                                    <div class="label">
                                        House number
                                    </div>
                                    <input type="text" name="houno" id="house-number" placeholder="153" autocomplete="off" oninput="validateHouseNo(this.value)">
                                    <div class="error error-hidden">
                                    </div>
                                </div>
                            </div>
                            <div class="input taxreport">
                                <div class="label">
                                    House tax report
                                </div>
                                <input type="file" name="taxre" id="tax-report" accept="application/pdf">
                                <div class="error error-hidden">
                                </div>
                            </div>
                            <div class="button cursor-disable">
                                <input type="submit" value="Register" name="regbtn" id="reg-btn" class="primary-button disabled">
                            </div>
                            <div class="message">
                                *The login details will be sent to you via email or SMS.
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    
    <div id="warrning-box" >
        <!-- Inject Error Toast -->
    </div>

    <!--Google translater -->
    <?php
        include '../include/google_translater.php'
    ?>
    <script src="../js/login.js"></script>
    <script>
        function validateHouseNo(house)
        {  
           const wardNo=$('#ward-number').val();
             $.ajax({
                url: "../php/auth.php",
                type: "POST",
                data: {
                    houseNo:house,
                    wardno:wardNo
                },
                success: function(data, status) {
                    $('#warrning-box').html(data);
                    //hosnoSubmit=false;
                }
            });
         }
    </script>

    
</body>
</html>