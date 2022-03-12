<?php
session_start();
$fpEmail=$_SESSION['fp-email'];
$fpUID=$_SESSION['fp-uid'];
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

            <div class="form">
                <div class="box">
                    <div class="login-text">
                        <div class="title">
                            Forgot password?
                        </div>
                        <div class="sub-title">
                        Please check your email <span class="email-h"><?php echo $fpEmail ?></span> and enter the one time password to continue
                        </div>
                    </div>
                    <form action="../php/auth.php" method="post" id="fp-form">
                        <div class="inputs">
                            <div class="input fpotp">
                                <div class="label">
                                    One time password
                                </div>
                                <input type="number" id="fp-otp" name="fpotp" placeholder="24513" onkeyup="validateOtp(this.value)" autocomplete="off" >
                                <div class="error error-hidden">
                                </div>
                            </div>
                        </div>
                        <div class="buttons">
                            <input type="submit" value="Continue" id="fp-sub" name="fpContinueOtp" class="primary-button disabled">
                            <input type="submit" value="Go back" name="touid" id="fp-sub" class="secondary-button">
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

    <!-- Error Toast -->
    <?php
        if (isset($_SESSION['errorMessage'])) {
            $msg=$_SESSION['errorMessage'];
        echo " <div class='alertt alert-visible'>
                        <div class='econtent'>
                            <img src='../images/warning.svg' alt='warning'>
                            <div class='text'>
                                $msg
                            </div>
                        </div>
                        <img src='../images/close.svg' alt='close' class='alert-close'>
                    </div>";
        unset($_SESSION['errorMessage']);
    }?>

    <script src="../js/toast.js"></script>
    <script>

        function validateOtp(otp){
            const subBtn=document.querySelector("#fp-sub");
            const useridd=document.querySelector("#fp-otp");
            const useridError=document.querySelector(".fpotp .error");
            if(otp.length==5){
                useridError.classList.add("error-hidden");
                useridError.classList.remove("error-visible");
                subBtn.classList.remove("disabled");
            }else{
                useridError.classList.add("error-visible");
                useridError.classList.remove("error-hidden");
                useridError.innerText="Invalid OTP";
                subBtn.classList.add("disabled");
            }
        }
    </script>

    
</body>
</html>