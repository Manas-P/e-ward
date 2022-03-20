<!-- Landing Page -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Ward</title>
    <link rel="shortcut icon" href="./assets/images/fav.svg" type="image/x-icon">
    <link rel="stylesheet" href="./assets/css/index.css">
    <link rel="stylesheet" href="./assets/css/google_translater.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>
<body>
    <div class="bg">
        <img src="./assets/images/landingBgFade.png" alt="Background image">
    </div>
    <div class="main">
        <div class="header">
            <div class="logo">
                <img src="./assets/images/logo.svg" alt="logo">
            </div>
            <div class="links">
                <a href="" class="link">Services</a>
                <a href="" class="link">About</a>
                <a href="" class="link">contact us</a>
                <a href="../application/view/pages/login/login.php" class="link login-btn">login</a>
            </div>
        </div>
        <div class="hero">
            <div class="content">
                <div class="heading">
                    Get your <span>E-Ward</span> services in a single click
                </div>
                <div class="description">
                    E-ward is a user-friendly web platform designed to assist ward 
                    members, house members, and various committee members. All 
                    transparency in the ward will be lowered after using this platform. 
                    The ward's activities may be more engaging.
                </div>
                <a href="" class="cta">Get Started</a>
            </div>
            <div class="hero-img">
                <img src="./assets/images/landing-hero.png" alt="">
            </div>
        </div>
        <div class="features">
            <div class="card">
                <img src="./assets/images/time.svg" alt="Time saving" style="background: #E5E7FF;">
                <div class="title">
                    Time saving
                </div>
                <div class="parag">
                    Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. 
                    Velit officia consequat duis enim velit mollit. Exercitation veniam.
                </div>
            </div>
            <div class="card">
                <img src="./assets/images/queue.svg" alt="Queue" style="background: #D4FFDE;">
                <div class="title">
                    No more queue
                </div>
                <div class="parag">
                    Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. 
                    Velit officia consequat duis enim velit mollit. Exercitation veniam.
                </div>
            </div>
            <div class="card">
                <img src="./assets/images/status.svg" alt="status" style="background: #FFEFE0;">
                <div class="title">
                    Live status check
                </div>
                <div class="parag">
                    Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. 
                    Velit officia consequat duis enim velit mollit. Exercitation veniam.
                </div>
            </div>
        </div>
    </div>



    <!--Google translater -->
    <?php
        include '../application/view/layout/google_translater.php'
    ?>
    <script src="./assets/libraries/tilt.jquery.js"></script>
    <script>
        //Tilt Js
        $(document).ready(function () {
            $(".card").tilt({
                maxTilt: 2,
                scale: 1.01
            });
        });
    </script>
</body>
</html>