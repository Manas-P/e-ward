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
    <link rel="shortcut icon" href="../../../../public/assets/images/fav.svg" type="image/x-icon">
    <link rel="stylesheet" href="../../../../public/assets/css/index/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../../../../public/assets/css/google_translater.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
</head>
<body>
    <section class="main">
        <div class="sections">
            <div class="content">
                <div class="logo">
                    <a href="../../../../public/index.php">
                        <img src="../../../../public/assets/images/logo.svg" alt="Logo">
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
                    <img src="../../../../public/assets/images/connections.png" alt="Connections">
                </div>
            </div>

            <div class="form">
                <div class="box">
                    <div class="login-text">
                        <div class="title">
                            Forgot password?
                        </div>
                        <div class="sub-title">
                            Enter your login id, we’ll send you one time password 
                            to corresponding email.
                        </div>
                    </div>
                    <form action="../../../model/forgotPassword.php" method="post" id="fp-form">
                        <div class="inputs">
                            <div class="input fpuserid">
                                <div class="label">
                                    User id
                                </div>
                                <input type="number" id="fp-userid" oninput="validateUserId(this.value)" name="ftpUserId" placeholder="2451" autocomplete="off" >
                                <div class="error error-hidden">
                                </div>
                            </div>
                        </div>
                        <div class="buttons">
                            <input type="submit" value="Continue" id="fp-sub" name="fpContinue" onclick="loader()" class="primary-button disabled">
                            <input type="submit" value="Back to login/signup" name="toLoginPage" id="fp-sub" class="secondary-button">
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
        include '../../layout/google_translater.php';
    ?>

    <!-- Error Toast -->
    <?php
        if (isset($_SESSION['errorMessage'])) {
            $msg=$_SESSION['errorMessage'];
        echo " <div class='alertt alert-visible'>
                        <div class='econtent'>
                            <img src='../../../../public/assets/images/warning.svg' alt='warning'>
                            <div class='text'>
                                $msg
                            </div>
                        </div>
                        <img src='../../../../public/assets/images/close.svg' alt='close' class='alert-close'>
                    </div>";
        unset($_SESSION['errorMessage']);
    }?>

    <!-- ==========Loading============= -->
    <div class="loading loading-hide">
        <div class="loading-overlay"></div>
        <div class="gif">
            <img src="../../../../public/assets/images/loading5.gif" alt="loading gif">
        </div>
    </div>
    <!-- ==========Loading End============= -->

    <script src="../../../../public/assets/js/toast.js"></script>
    <script>
        //check user id exist or not with button enable or disable
        function validateUserId(userid)
        {  
            const subBtn=document.querySelector("#fp-sub");
            const useridError=document.querySelector(".fpuserid .error");
            if(userid.length!=0){
                $.ajax({
                    url: "../../../model/forgotPassword.php",
                    type: "POST",
                    data: {
                        userId:userid
                    },
                    success: function(data, status) {
                        if(data!=0){
                            $('#warrning-box').html(data);
                            $('#fp-sub').addClass('disabled');
                        }else{
                            $('#warrning-box').html(data);
                            $('#fp-sub').removeClass('disabled');
                        }
                        
                    }
                });
                useridError.classList.add("error-hidden");
                useridError.classList.remove("error-visible");
            }else{
                useridError.classList.add("error-visible");
                useridError.classList.remove("error-hidden");
                useridError.innerText="Field cannot be blank";
                subBtn.classList.add("disabled");
            }
             
         }

         //Loader
         function loader(){
            document.querySelector(".loading").classList.remove("loading-hide");
            document.querySelector("body").style.pointerEvents = "none";
            const timeout = setTimeout(closeLoader, 20000);
        }
        function closeLoader(){
            document.querySelector(".loading").classList.add("loading-hide");
            document.querySelector("body").style.pointerEvents = "auto";
        }
    </script>
</body>
</html>