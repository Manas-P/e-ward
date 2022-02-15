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
                                    <!-- ---------- -->
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
                                    <div class="input hm-drivingid">
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
                        <section class="proofs" id="educationalbackground">
                            <div class="header">
                                <div class="heading">
                                    Educational backgrond
                                </div>
                                <div class="edit">
                                    <a href="#">
                                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10.0833 3.77783H3.66659C3.18036 3.77783 2.71404 3.97099 2.37022 4.3148C2.02641 4.65862 1.83325 5.12494 1.83325 5.61117V18.4445C1.83325 18.9307 2.02641 19.397 2.37022 19.7409C2.71404 20.0847 3.18036 20.2778 3.66659 20.2778H16.4999C16.9861 20.2778 17.4525 20.0847 17.7963 19.7409C18.1401 19.397 18.3333 18.9307 18.3333 18.4445V12.0278" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M16.9583 2.40286C17.3229 2.03818 17.8175 1.83331 18.3333 1.83331C18.849 1.83331 19.3436 2.03818 19.7083 2.40286C20.0729 2.76753 20.2778 3.26213 20.2778 3.77786C20.2778 4.29358 20.0729 4.78818 19.7083 5.15286L10.9999 13.8612L7.33325 14.7779L8.24992 11.1112L16.9583 2.40286Z" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            <div class="files">
                                <!-- ---------------- -->
                                <div class="file">
                                    <div class="info">
                                        <div class="title">
                                            ______________:
                                        </div>
                                        <div class="info">
                                            ______________
                                        </div>
                                    </div>
                                    <div class="download">
                                        <a href="#">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M17.5 12.5V15.8333C17.5 16.2754 17.3244 16.6993 17.0118 17.0118C16.6993 17.3244 16.2754 17.5 15.8333 17.5H4.16667C3.72464 17.5 3.30072 17.3244 2.98816 17.0118C2.67559 16.6993 2.5 16.2754 2.5 15.8333V12.5" stroke="#5744E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M5.8335 8.33325L10.0002 12.4999L14.1668 8.33325" stroke="#5744E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M10 12.5V2.5" stroke="#5744E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            
                            </div>
                        </section>



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