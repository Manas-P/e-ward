<?php
session_start();
include '../../include/dbcon.php';
if (isset($_SESSION["e-wardId"]) != session_id()) {
    header("Location: ../login.php");
    die();
}
else
{
    $fname=$_SESSION['fname'];
    $houseno= $_SESSION['houseno'];
    $wardno= $_SESSION['wardno'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>E Ward</title>
        <link rel="shortcut icon" href="../../images/fav.svg" type="image/x-icon">
        <link rel="stylesheet" href="../../styles/hm_add_hm.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    </head>
    <body>
        <section class="main">
            <!-- ==========Sidebar============= -->
            <?php
                include '../../include/house_member/sidebar_hm_add_members.php'
            ?>
            <!-- ==========Sidebar End============= -->
            <div class="container">
                <div class="header">
                    <div class="title">
                        House members
                    </div>
                </div>
                <!-- content -->
                <div class="members-list">
                    <div class="members">

                        <a class="add-member">
                            <div class="icon">
                                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path class="str" d="M15 6.25V23.75" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path class="str" d="M6.25 15H23.75" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <div class="text">Add members</div>
                        </a>

                        <!-- Fetch Ward Members -->
                        <?php
                            $fetchQuery="SELECT * FROM `tbl_house_member` WHERE `ward_no`='$wardno' and `house_no`='$houseno'";
                            $fetchResult=mysqli_query($conn,$fetchQuery);
                            if(mysqli_num_rows($fetchResult)>0){
                                while($row = mysqli_fetch_assoc($fetchResult)){
                                    // Convert dob to age
                                    if($row["dob"]==="0000-00-00"){
                                        $age="NA";
                                    }else{
                                        $dob=$row["dob"];
                                        $age = (date('Y') - date('Y',strtotime($dob)));
                                    }
                                    
                        ?>
                        <a href="./house_member_profile.php?id=<?php echo $row['userid']; ?>" class="member">
                            <div class="photo">
                                <img src="../<?php echo $row["photo"]; ?>" alt="member photo">
                            </div>
                            <div class="about">
                                <div class="name"><?php echo $row["fname"]; ?></div>
                                <div class="tag">Age: <?php echo $age; ?></div>
                            </div>
                        </a>
                        <?php
                                }
                                    
                            }else{

                            }
                        ?>
                        
                    </div>
                </div>

            </div>
        </section>
        =========== Modal ============
        <div class="overlay modal-hidden"></div>
        <!-- form to add members-->
        <div class="box modal-box modal-hidden">
            <div class="title">
                Add house member
            </div>
            <div class="modal-close-btn">
                <img src="../../images/close.svg" alt="close button">
            </div>
            <!-- Add House Memeber -->
            <form action="../../php/auth.php" method="post" id="add-house-member" enctype="multipart/form-data">
                <input type="hidden" name="fname" value="<?php echo $fname ?>">
                <div class="inputs">
                    <div class="input h-fullname">
                        <div class="label">
                            Full name
                        </div>
                        <input type="text" name="hfname" id="h-full-name" placeholder="John Doe" autocomplete="off">
                        <div class="error error-hidden">
                        </div>
                    </div>
                    <div class="input h-email">
                        <div class="label">
                            Email ID
                        </div>
                        <input type="text" name="hemail" id="h-email-id" placeholder="example@gmail.com" autocomplete="off">
                        <div class="error error-hidden">
                        </div>
                    </div>
                    <div class="input h-phno">
                        <div class="label">
                            Phone number
                        </div>
                        <input type="text" name="hphno" id="h-phn-number" placeholder="9568547512" autocomplete="off">
                        <div class="error error-hidden">
                        </div>
                    </div>
                    <div class="half-input">
                        <div class="input h-blood">
                            <div class="label">
                                Blood group
                            </div>
                            <input type="text" name="hblood" id="h-blood" placeholder="A+" autocomplete="off">
                            <div class="error error-hidden">
                            </div>
                        </div>
                        <div class="input h-date">
                            <div class="label">
                                Date of birth
                            </div>
                            <input type="date" name="hdob" id="h-date" autocomplete="off">
                            <div class="error error-hidden">
                            </div>
                        </div>
                    </div>
                    <div class="input h-photo">
                        <div class="label">
                            Upload photo
                        </div>
                        <input type="file" name="hphoto" id="h-photo" accept="image/png,image/jpeg">
                        <div class="error error-hidden">
                        </div>
                    </div>
                    <div class="button hBtn cursor-disable">
                        <input type="submit" value="Add member" name="add-hm" id="add-hm" class="primary-button disabled">
                    </div>
                </div>
            </form>
        </div>
        <script src="../../js/hm_add_hm.js"></script>

        <!-- Error Toast -->
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

        <!-- Success toast -->
        <?php
            if (isset($_SESSION['success'])) {
                $msg=$_SESSION['success'];
                echo " <div class='alertt alert-visible' style='border-left: 10px solid #1BBD2B;'>
                            <div class='econtent'>
                                <img src='../../images/check.svg' alt='success'>
                                <div class='text'>
                                    $msg
                                </div>
                            </div>
                            <img src='../../images/close.svg' alt='close' class='alert-close'>
                        </div>";
                unset($_SESSION['success']);
        }?>
    </body>
    <script src="../../js/toast.js"></script>
</html>
	<?php
}
?>