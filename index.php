<!-- Landing Page -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Ward</title>
    <link rel="shortcut icon" href="./assets/images/fav.svg" type="image/x-icon">
    <link rel="stylesheet" href="./assets/styles/index.css">
</head>
<body>
    <div class="bg">
        <img src="./assets/images/landingBg.png" alt="Background image">
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
                <a href="./assets/pages/login.php" class="link login-btn">login</a>
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
    </div>

    <!-- Google Translater -->
    <div id="google_translate_element"></div>
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'en,hi,ml,gu,pa,ta,te,ur,ar', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, autoDisplay: true}, 'google_translate_element');
        }
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</body>
</html>