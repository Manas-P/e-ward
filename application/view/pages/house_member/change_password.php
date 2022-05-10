<?php
include '../../../config/dbcon.php';
session_start();
if (isset($_SESSION["sessionId"]) != session_id()) {
    header("Location: ../login/login.php");
    die();
}
else
{
    $fname=$_SESSION['fname'];
    $houseno= $_SESSION['houseno'];
    $wardno= $_SESSION['wardno'];
    $user_id= $_SESSION['userid'];

    //check user
    $arr = str_split($user_id); // convert string to an array
    $chk= end($arr); // 0 = house head

    //slice first name of user
    $slices=explode(" ", $fname);
    $firstName=$slices[0];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>E Ward</title>
        <link rel="shortcut icon" href="../../../../public/assets/images/fav.svg" type="image/x-icon">
        <link rel="stylesheet" href="../../../../public/assets/css/house_member/hm_change_password.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    </head>
    <body>
        <section class="main">
            <!-- ==========Sidebar============= -->
            <?php
                include '../../layout/house_member/sidebar_change_password.php'
            ?>
            <!-- ==========Sidebar End============= -->
            <div class="container">
                <div class="header">
                    <div class="title">
                        Change password
                    </div>
                </div>
                <!-- content -->
                <div class="change-pass">
                    <div class="text">
                            *Passwords work like a key to important personal information, such as name, birth date, home address, phone number and
                            credit card. <br>
                            It’s a perfect time to change your passwords to stronger ones.
                    </div>
                    <form id="cp-form" action="../../../model/house_member/change_password.php" method="post" enctype="multipart/form-data">
                        <input type="text" name="userid" value="<?php echo $user_id; ?>" id="user-id" style="display: none;">
                        <div class="inputs">
                            <div class="input curPass">
                                <div class="label">
                                    Current password
                                </div>
                                <input type="password" id="cur-pass" name="curpass" placeholder="********" oninput="validateCurrentPass(this.value)" autocomplete="off">
                                <div class="error error-hidden">
                                </div>
                            </div>
                            <div class="input newPass">
                                <div class="label">
                                    New password
                                </div>
                                <input type="password" id="new-pass" name="newPass" placeholder="********" onkeyup="validatepass(this.value)" autocomplete="off">
                                <div class="error error-hidden">
                                </div>
                            </div>
                        </div>
                        <div class="button">
                            <input type="submit" value="Continue" id="cp-sub" name="changePass" class="primary-button disabled">
                        </div>
                    </form>
                </div>
                

            </div>
        </section>


        <div id="warrning-box">
            <!-- Inject Error Toast -->
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
        
        <script src="../../../../public/assets/js/toast.js"></script>
        <script>
            var curError = false;
            var newError = false;

            const subBtn = document.querySelector( "#cp-sub" );

            //check current password
            function validateCurrentPass ( curpass )
            {
                const userId = $( '#user-id' ).val();
                const curPassError = document.querySelector( ".curPass .error" );
                if ( curpass.length != 0 ){
                    $.ajax( {
                        url: "../../../model/house_member/change_password.php",
                        type: "POST",
                        data: {
                            curPass: curpass,
                            userId: userId
                        },
                        success: function( data,status ){
                            if ( data != 0 ){
                                $( '#warrning-box' ).html( data );
                                subBtn.classList.add( "disabled" );
                                curError = false;
                            }
                            if ( data == 0 ){
                                $( '#warrning-box' ).html( data );
                                subBtn.classList.remove( "disabled" );
                                curError = true;
                            }
                        }
                    } );
                    curPassError.classList.add( "error-hidden" );
                    curPassError.classList.remove( "error-visible" );
                } else{
                    curPassError.classList.add( "error-visible" );
                    curPassError.classList.remove( "error-hidden" );
                    curPassError.innerText = "Field cannot be blank";
                    curError = false;
                }
            }
        </script>
        <script src="../../../../public/assets/js/password_validation.js"></script>
    </body>
    
</html>
	<?php
}
?>