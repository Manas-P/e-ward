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
    $user_id= $_SESSION['userid'];

    //Fetch house member details
    $hm_id=$_GET['id'];
    $hm_data="SELECT * FROM `tbl_house_member` WHERE `userid`='$hm_id'";
    $dataResult=mysqli_query($conn,$hm_data);
    while ($row = mysqli_fetch_assoc($dataResult))
    {
        $name=$row['fname'];
    }

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
        <link rel="shortcut icon" href="../../images/fav.svg" type="image/x-icon">
        <link rel="stylesheet" href="../../styles/hm_profile_update.css">
    </head>
    <body>
        <section class="main">
            <!-- ==========Sidebar============= -->
            <?php
                include '../../include/house_member/sidebar_hm_add_members.php'
            ?>
            <!-- ==========Sidebar End============= -->
            <form action="../../php/auth.php" id="reg-form" method="post" enctype="multipart/form-data">
                <div class="container">

                    <div class="left">
                        <!-- bread-crumbs -->
                        <div class="bread-crumbs">
                            <a href="./add_house_members.php" class="previous">
                                House members
                            </a>
                            <svg class="str" width="8" height="10" viewBox="0 0 8 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.2002 8.59999L5.8002 4.99999L2.2002 1.39999" stroke="#1E1E1E" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <a href="./house_member_profile.php?id=<?php echo $hm_id; ?>" class="previous">
                                <?php
                                    echo $name;
                                ?>
                            </a>
                            <svg class="str" width="8" height="10" viewBox="0 0 8 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.2002 8.59999L5.8002 4.99999L2.2002 1.39999" stroke="#1E1E1E" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <a href="" class="now">
                                Edit profile
                            </a>
                        </div>
                        <!-- menu -->
                        <div class="menu">
                            <div class="links">
                                <a href="#general" class="active">General informations</a>
                                <a href="#identityProof" >Identity proofs</a>
                                <a href="#educationalbackground" >Educational background</a>
                                <a href="#" >Professional background</a>
                            </div>
                        </div>
                        <div class="buttn ubn cursor-disable">
                            <input type="submit" id="hm-up-btn" name="hm-up-btn" value="Update changes" class="button">
                        </div>
                    </div>
                    
                    <div class="right">

                        <!-- General Indormation -->
                        <!-- Fetch data -->
                        <?php
                            $hm_data="SELECT * FROM `tbl_house_member` WHERE `userid`='$hm_id'";
                            $dataResult=mysqli_query($conn,$hm_data);
                            while ($hm_info = mysqli_fetch_assoc($dataResult))
                            {
                        ?>
                            <section class="general" id="general">
                                <div class="header">
                                    <div class="heading">
                                        General informations
                                    </div>
                                </div>
                                <input type="hidden" name="hm_id" value="<?php echo $hm_id; ?>">
                                <input type="hidden" name="hm_already_photo" value="<?php echo $hm_info['photo'] ?>">
                                <div class="information">
                                    <div class="inputs">
                                        <div class="input h-photo">
                                            <div class="label">
                                                Upload photo
                                            </div>
                                            <input type="file" name="hmuphoto" id="h-photo" accept="image/png,image/jpeg" value="<?php echo $hm_info['photo'] ?>">
                                            <div class="error error-hidden">
                                            </div>
                                        </div>
                                        <div class="input hm-fullname">
                                            <div class="label">
                                                Full name
                                            </div>
                                            <input type="text" name="hmufname" id="hm-full-name" placeholder="John Doe" value="<?php echo $hm_info['fname'] ?>" autocomplete="off">
                                            <div class="error error-hidden">
                                            </div>
                                        </div>
                                        <div class="half-input">
                                            <div class="input h-date">
                                                <div class="label">
                                                    Date of birth
                                                </div>
                                                <input type="date" name="hmudob" id="h-date" value="<?php echo $hm_info['dob'] ?>" autocomplete="off">
                                                <div class="error error-hidden">
                                                </div>
                                            </div>
                                            <div class="input hm-blood">
                                                <div class="label">
                                                    Blood group
                                                </div>
                                                <input type="text" name="hmublood" id="hm-blood" placeholder="A+" value="<?php if($hm_info['blood_grp']!='NA'){ echo $hm_info['blood_grp']; } ?>" autocomplete="off">
                                                <div class="error error-hidden">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="input hm-email">
                                            <div class="label">
                                                Email ID
                                            </div>
                                            <input type="text" name="hmuemail" id="hm-email-id" placeholder="example@gmail.com" value="<?php if($hm_info['email']!='Not entered'){ echo $hm_info['email']; } ?>" autocomplete="off">
                                            <div class="error error-hidden">
                                            </div>
                                        </div>
                                        <div class="input hm-phno">
                                            <div class="label">
                                                Phone number
                                            </div>
                                            <input type="text" name="hmuphno" id="hm-phn-number" placeholder="9568547512" value="<?php echo $hm_info['phno'] ?>" autocomplete="off">
                                            <div class="error error-hidden">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        <?php
                            }
                        ?>

                        <!-- Identity Proofs -->
                        <!-- Fetch id proof data -->
                        <?php
                            $idproofQuery="SELECT * FROM `tbl_id_proof` WHERE `userid`='$hm_id'";
                            $idproofResult=mysqli_query($conn,$idproofQuery);
                            while ($idProof = mysqli_fetch_assoc($idproofResult)){
                        
                        ?>

                        <section class="proofs" id="identityProof">
                            <div class="header">
                                <div class="heading">
                                    Identity proofs
                                </div>
                            </div>
                            <!-- To take already exist files -->
                            <input type="hidden" name="hm_already_aadhar" value="<?php echo $idProof['aadhar_file'] ?>">
                            <input type="hidden" name="hm_already_election" value="<?php echo $idProof['election_id_file'] ?>">
                            <input type="hidden" name="hm_already_driving" value="<?php echo $idProof['driving_lic_file'] ?>">
                            <input type="hidden" name="hm_already_pan" value="<?php echo $idProof['pan_card_file'] ?>">
                            <input type="hidden" name="hm_already_birth" value="<?php echo $idProof['birth_cer_file'] ?>">
                            <div class="files">
                                <div class="inputs">
                                    <!-- Aadhar number -->
                                    <div class="input hm-aadharno">
                                        <div class="label">
                                            Aadhar number
                                        </div>
                                        <input type="text" name="hmuaadharno" id="hm-aadharno" placeholder="9562547845" value="<?php if($idProof['aadhar_no']!='0'){ echo $idProof['aadhar_no']; } ?>" autocomplete="off">
                                        <div class="error error-hidden">
                                        </div>
                                    </div>
                                    <div class="input hm-aadhar-file">
                                        <div class="label">
                                            Upload aadhar (pdf)
                                        </div>
                                        <input type="file" name="hmuaadharfile" id="hm-aadhar-file" accept="application/pdf" value="<?php echo $idProof['aadhar_file'] ?>">
                                        <div class="error error-hidden">
                                        </div>
                                    </div>
                                    <!-- ---------- -->
                                    <!-- Election id -->
                                    <div class="input hm-electionid">
                                        <div class="label">
                                            Election id number
                                        </div>
                                        <input type="text" name="hmuelectionid" id="hm-electionid" placeholder="215487896563" value="<?php if($idProof['election_id']!='0'){ echo $idProof['election_id']; } ?>" autocomplete="off">
                                        <div class="error error-hidden">
                                        </div>
                                    </div>
                                    <div class="input hm-election-file">
                                        <div class="label">
                                            Upload election id (pdf)
                                        </div>
                                        <input type="file" name="hmuelectionfile" id="hm-election-file" accept="application/pdf" value="<?php echo $idProof['election_id_file'] ?>">
                                        <div class="error error-hidden">
                                        </div>
                                    </div>
                                    <!-- --------------- -->
                                    <!-- Driving licence -->
                                    <div class="input hm-drivingid">
                                        <div class="label">
                                            Driving licence number
                                        </div>
                                        <input type="text" name="hmudrivingid" id="hm-drivingid" placeholder="06/5265/2005" value="<?php if($idProof['driving_lic']!='0'){ echo $idProof['driving_lic']; } ?>" autocomplete="off">
                                        <div class="error error-hidden">
                                        </div>
                                    </div>
                                    <div class="input hm-driving-file">
                                        <div class="label">
                                            Upload driving licence (pdf)
                                        </div>
                                        <input type="file" name="hmudrivingfile" id="hm-driving-file" accept="application/pdf" value="<?php echo $idProof['driving_lic_file'] ?>">
                                        <div class="error error-hidden">
                                        </div>
                                    </div>
                                    <!-- ---------- -->
                                    <!-- PAN card -->
                                    <div class="input hm-pancard">
                                        <div class="label">
                                        PAN card number
                                        </div>
                                        <input type="text" name="hmupancard" id="hm-pancard" placeholder="EF58562RF541" value="<?php if($idProof['pan_card']!='0'){ echo $idProof['pan_card']; } ?>" autocomplete="off">
                                        <div class="error error-hidden">
                                        </div>
                                    </div>
                                    <div class="input hm-pancard-file">
                                        <div class="label">
                                            Upload PAN card (pdf)
                                        </div>
                                        <input type="file" name="hmupancardfile" id="hm-pancard-file" accept="application/pdf" value="<?php echo $idProof['pan_card_file'] ?>">
                                        <div class="error error-hidden">
                                        </div>
                                    </div>
                                    <!-- ---------- -->
                                    <!-- Birth certificate -->
                                    <div class="input hm-birth">
                                        <div class="label">
                                        Birth certificate number
                                        </div>
                                        <input type="text" name="hmubirth" id="hm-birth" placeholder="EF58562RF541" value="<?php if($idProof['birth_cer']!='0'){ echo $idProof['birth_cer']; } ?>" autocomplete="off">
                                        <div class="error error-hidden">
                                        </div>
                                    </div>
                                    <div class="input hm-birth-file">
                                        <div class="label">
                                            Upload birth certificate (pdf)
                                        </div>
                                        <input type="file" name="hmubirthfile" id="hm-birth-file" accept="application/pdf" value="<?php echo $idProof['birth_cer_file'] ?>">
                                        <div class="error error-hidden">
                                        </div>
                                    </div>
                                    <!-- ---------- -->
                                </div>
                            </div>
                        </section>
                        <?php
                            }
                        ?>


                        
                        <!-- Educational Background -->
                        <!-- Fetch edu bg data -->
                        <?php
                            $eduQuery="SELECT * FROM `tbl_edu_bg` WHERE `userid`='$hm_id'";
                            $eduResult=mysqli_query($conn,$eduQuery);
                            while ($edu = mysqli_fetch_assoc($eduResult)){
                        ?>
                        <section class="proofs" id="educationalbackground">
                            <div class="header">
                                <div class="heading">
                                    Educational backgrond
                                </div>
                            </div>
                            <!-- To take already exist files -->
                            <input type="hidden" name="hm_already_hs" value="<?php echo $edu['hs'] ?>">
                            <input type="hidden" name="hm_already_hss" value="<?php echo $edu['hss'] ?>">
                            <input type="hidden" name="hm_already_diploma" value="<?php echo $edu['diploma'] ?>">
                            <input type="hidden" name="hm_already_ug" value="<?php echo $edu['ug'] ?>">
                            <input type="hidden" name="hm_already_pg" value="<?php echo $edu['pg'] ?>">
                            <div class="files">
                                <div class="inputs">
                                    <!-- Secondary school certificate -->
                                    <div class="input hm-hs-file">
                                        <div class="label">
                                            Secondary school certificate (pdf)
                                        </div>
                                        <input type="file" name="hmuhsfile" id="hm-hs-file" accept="application/pdf" value="<?php echo $edu['hs'] ?>">
                                        <div class="error error-hidden">
                                        </div>
                                    </div>
                                    <!-- ---------- -->
                                    <!-- Higher secondary certificate -->
                                    <div class="input hm-hss-file">
                                        <div class="label">
                                            Higher secondary certificate (pdf)
                                        </div>
                                        <input type="file" name="hmuhssfile" id="hm-hss-file" accept="application/pdf" value="<?php echo $edu['hss'] ?>">
                                        <div class="error error-hidden">
                                        </div>
                                    </div>
                                    <!-- ---------- -->
                                    <!-- Diploma certificate -->
                                    <div class="input hm-diploma-file">
                                        <div class="label">
                                            Diploma certificate (pdf)
                                        </div>
                                        <input type="file" name="hmudiplomafile" id="hm-diploma-file" accept="application/pdf" value="<?php echo $edu['diploma'] ?>">
                                        <div class="error error-hidden">
                                        </div>
                                    </div>
                                    <!-- ---------- -->
                                    <!-- Under graduation certificate -->
                                    <div class="input hm-ug-file">
                                        <div class="label">
                                            Under graduation certificate (pdf)
                                        </div>
                                        <input type="file" name="hmuugfile" id="hm-ug-file" accept="application/pdf" value="<?php echo $edu['ug'] ?>">
                                        <div class="error error-hidden">
                                        </div>
                                    </div>
                                    <!-- ---------- -->
                                    <!-- Post graduation certificate -->
                                    <div class="input hm-pg-file">
                                        <div class="label">
                                            Post graduation certificate (pdf)
                                        </div>
                                        <input type="file" name="hmupgfile" id="hm-pg-file" accept="application/pdf" value="<?php echo $edu['pg'] ?>">
                                        <div class="error error-hidden">
                                        </div>
                                    </div>
                                    <!-- ---------- -->
                                </div>
                            </div>
                        </section>
                        <?php
                            }
                        ?>


                        <!-- Professional Background -->
                        <!-- Fetch pro bg data -->
                        <?php
                            $proQuery="SELECT * FROM `tbl_pro_bg` WHERE `userid`='$hm_id'";
                            $proResult=mysqli_query($conn,$proQuery);
                            while ($pro = mysqli_fetch_assoc($proResult)){
                        ?>
                        <section class="proofs" id="professionalbackground">
                            <div class="header">
                                <div class="heading">
                                    Professional backgrond
                                </div>
                            </div>
                            <!-- To take already exist files -->
                            <input type="hidden" name="hm_already_pro" value="<?php echo $pro['cur_pro_file'] ?>">
                            <div class="files">
                                <div class="inputs">
                                   <!-- Current profession -->
                                    <div class="input hm-cur-pro">
                                        <div class="label">
                                            Current Profession
                                        </div>
                                        <input type="text" name="hmucurpro" id="hm-cur-pro" placeholder="Teacher" value="<?php if($pro['cur_pro']!='0'){ echo $pro['cur_pro']; } ?>" autocomplete="off">
                                        <div class="error error-hidden">
                                        </div>
                                    </div>
                                    <!-- ---------- -->
                                    <!-- Profession certificate -->
                                    <div class="input hm-pro-file">
                                        <div class="label">
                                            Profession certificate (pdf)
                                        </div>
                                        <input type="file" name="hmuprofile" id="hm-pro-file" accept="application/pdf" value="<?php echo $pro['cur_pro_file'] ?>">
                                        <div class="error error-hidden">
                                        </div>
                                    </div>
                                    <!-- ---------- -->
                                    <!-- Company name -->
                                    <div class="input hm-comp-name">
                                        <div class="label">
                                            Company name
                                        </div>
                                        <input type="text" name="hmucompname" id="hm-comp-name" placeholder="Unity" value="<?php if($pro['comp_name']!='0'){ echo $pro['comp_name']; } ?>" autocomplete="off">
                                        <div class="error error-hidden">
                                        </div>
                                    </div>
                                    <!-- ---------- -->
                                    <!-- Company name -->
                                    <div class="input hm-location">
                                        <div class="label">
                                            Location
                                        </div>
                                        <input type="text" name="hmulocation" id="hm-location" placeholder="Baton Rouge (LA)" value="<?php if($pro['location']!='0'){ echo $pro['location']; } ?>" autocomplete="off">
                                        <div class="error error-hidden">
                                        </div>
                                    </div>
                                    <!-- ---------- -->
                                    <!-- Company name -->
                                    <div class="input hm-pro-start">
                                        <div class="label">
                                            Profession Started
                                        </div>
                                        <input type="date" name="hmuprostart" id="hm-pro-start" value="<?php if($pro['pro_started']!='0'){ echo $pro['pro_started']; } ?>" autocomplete="off">
                                        <div class="error error-hidden">
                                        </div>
                                    </div>
                                    <!-- ---------- -->
                                </div>
                            </div>
                        </section>
                        <?php
                            }
                        ?>


                    </div>
                </div>
            </form>
        </section>

        <script src="../../js/hm_profile.js"></script>
        <script src="../../js/update_hm_details.js"></script>
    </body>
</html>
	<?php
}
?>