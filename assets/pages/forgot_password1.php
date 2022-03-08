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
                    <form action="../php/auth.php" method="post">
                        <div class="inputs">
                            <div class="input">
                                <div class="label">
                                    User id
                                </div>
                                <input type="text" name="userName" id="" placeholder="2451" autocomplete="off" >
                            </div>
                        </div>
                        <div class="buttons">
                            <input type="submit" value="Continue" name="submitButton" class="primary-button">
                            <input type="submit" value="Back to login/signup" name="toLoginPage" id="register" class="secondary-button">
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