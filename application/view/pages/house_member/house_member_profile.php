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

    //Fetch house member details
    $hm_id=$_GET['id'];
    $hm_data="SELECT `photo`, `fname`, `dob`, `blood_grp`, `email`, `phno` FROM `tbl_house_member` WHERE `userid`='$hm_id'";
    $hm_dataResult=mysqli_query($conn,$hm_data);
    $userData=mysqli_fetch_assoc($hm_dataResult);
    $photo=$userData['photo'];
    $name= $userData['fname'];
    $dob=$userData['dob'];
    $blood=$userData['blood_grp'];
    $email=$userData['email'];
    $phno=$userData['phno'];

    //check user
    $arr = str_split($user_id); // convert string to an array
    $chk= end($arr); // 0 = house head
    $arr2=str_split($hm_id);
    $chk2= end($arr2);

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
        <link rel="stylesheet" href="../../../../public/assets/css/house_member/hm_profile.css">
    </head>
    <body>
        <section class="main">
            <!-- ==========Sidebar============= -->
            <?php
                include '../../layout/house_member/sidebar_hm_add_members.php'
            ?>
            <!-- ==========Sidebar End============= -->
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
                        <a href="" class="now">
                            <?php
                                echo $name;
                            ?>
                        </a>
                    </div>
                    <!-- menu -->
                    <div class="menu">
                        <div class="links">
                            <a href="#general" class="general active">General informations</a>
                            <a href="#identityProof" class="identityProof">Identity proofs</a>
                            <a href="#educationalbackground" class="educationalbackground">Educational background</a>
                            <a href="#professionalbackground" class="professionalbackground">Professional background</a>
                        </div>
                    </div>
                </div>
                
                <div class="right">

                    <!-- General Indormation -->
                    <section class="section general" id="general">
                        <div class="header">
                            <div class="heading">
                                General informations
                            </div>
                            <?php
                                if($chk==0 || $chk==$chk2){
                            ?>
                                    <div class="edit">
                                        <a href="./update_house_member.php?id=<?php echo $hm_id ?>">
                                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10.0833 3.77783H3.66659C3.18036 3.77783 2.71404 3.97099 2.37022 4.3148C2.02641 4.65862 1.83325 5.12494 1.83325 5.61117V18.4445C1.83325 18.9307 2.02641 19.397 2.37022 19.7409C2.71404 20.0847 3.18036 20.2778 3.66659 20.2778H16.4999C16.9861 20.2778 17.4525 20.0847 17.7963 19.7409C18.1401 19.397 18.3333 18.9307 18.3333 18.4445V12.0278" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M16.9583 2.40286C17.3229 2.03818 17.8175 1.83331 18.3333 1.83331C18.849 1.83331 19.3436 2.03818 19.7083 2.40286C20.0729 2.76753 20.2778 3.26213 20.2778 3.77786C20.2778 4.29358 20.0729 4.78818 19.7083 5.15286L10.9999 13.8612L7.33325 14.7779L8.24992 11.1112L16.9583 2.40286Z" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </a>
                                    </div>
                            <?php
                                }
                            ?>
                        </div>
                        <div class="information">
                            <div class="photo">
                                <img src="../<?php echo $photo; ?>" alt="">
                            </div>
                            <div class="content">
                                <div class="title">
                                    Name:
                                </div>
                                <div class="info">
                                    <?php echo $name; ?>
                                </div>
                            </div>
                            <div class="content">
                                <div class="title">
                                    Date of birth:
                                </div>
                                <div class="info">
                                    <?php echo $dob; ?>
                                </div>
                            </div>
                            <div class="content">
                                <div class="title">
                                    Blood group:
                                </div>
                                <div class="info">
                                    <?php echo $blood; ?>
                                </div>
                            </div>
                            <div class="content">
                                <div class="title">
                                    Email id:
                                </div>
                                <div class="info">
                                    <?php echo $email; ?>
                                </div>
                            </div>
                            <div class="content">
                                <div class="title">
                                    Phone number:
                                </div>
                                <div class="info">
                                    <?php echo $phno; ?>
                                </div>
                            </div>
                        </div>
                    </section>


                    <!-- Identity Proofs -->
                    <!-- Fetch id proof data -->
                    <?php
                        $idproofQuery="SELECT * FROM `tbl_id_proof` WHERE `userid`='$hm_id'";
                        $idproofResult=mysqli_query($conn,$idproofQuery);
                        while ($idProof = mysqli_fetch_assoc($idproofResult)){
                    ?>

                    <section class="section proofs" id="identityProof">
                        <div class="header">
                            <div class="heading">
                                Identity proofs
                            </div>
                            <?php
                                if($chk==0 || $chk==$chk2){
                            ?>
                                    <div class="edit">
                                        <a href="./update_house_member.php?id=<?php echo $hm_id ?>#identityProof">
                                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10.0833 3.77783H3.66659C3.18036 3.77783 2.71404 3.97099 2.37022 4.3148C2.02641 4.65862 1.83325 5.12494 1.83325 5.61117V18.4445C1.83325 18.9307 2.02641 19.397 2.37022 19.7409C2.71404 20.0847 3.18036 20.2778 3.66659 20.2778H16.4999C16.9861 20.2778 17.4525 20.0847 17.7963 19.7409C18.1401 19.397 18.3333 18.9307 18.3333 18.4445V12.0278" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M16.9583 2.40286C17.3229 2.03818 17.8175 1.83331 18.3333 1.83331C18.849 1.83331 19.3436 2.03818 19.7083 2.40286C20.0729 2.76753 20.2778 3.26213 20.2778 3.77786C20.2778 4.29358 20.0729 4.78818 19.7083 5.15286L10.9999 13.8612L7.33325 14.7779L8.24992 11.1112L16.9583 2.40286Z" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </a>
                                    </div>
                            <?php
                                }
                            ?>
                        </div>
                        <div class="files">
                            <!-- ---------------- -->
                            <div class="file">
                                <div class="info">
                                    <div class="title">
                                        Aadhar number:
                                    </div>
                                    <div class="info">
                                        <?php
                                            if($idProof['aadhar_no']=='0'){
                                                echo "Not entered";
                                            }else{
                                                echo $idProof['aadhar_no'];
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div class="download">
                                    <?php
                                        if($idProof['aadhar_file']!='0'){
                                    ?>
                                        <a href="../../../model/viewPdf.php?pdf=<?php echo $idProof['aadhar_file']; ?>" target="_blank">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M17.5 12.5V15.8333C17.5 16.2754 17.3244 16.6993 17.0118 17.0118C16.6993 17.3244 16.2754 17.5 15.8333 17.5H4.16667C3.72464 17.5 3.30072 17.3244 2.98816 17.0118C2.67559 16.6993 2.5 16.2754 2.5 15.8333V12.5" stroke="#5744E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M5.8335 8.33325L10.0002 12.4999L14.1668 8.33325" stroke="#5744E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M10 12.5V2.5" stroke="#5744E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </a>
                                    <?php
                                        }
                                    ?>
                                </div>
                            </div>
                            <!-- ---------------- -->
                            <div class="file">
                                <div class="info">
                                    <div class="title">
                                        Election id:
                                    </div>
                                    <div class="info">
                                        <?php
                                            if($idProof['election_id']=='0'){
                                                echo "Not entered";
                                            }else{
                                                echo $idProof['election_id'];
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div class="download">
                                    <?php
                                        if($idProof['election_id_file']!='0'){
                                    ?>
                                        <a href="../../../model/viewPdf.php?pdf=<?php echo $idProof['election_id_file']; ?>" target="_blank">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M17.5 12.5V15.8333C17.5 16.2754 17.3244 16.6993 17.0118 17.0118C16.6993 17.3244 16.2754 17.5 15.8333 17.5H4.16667C3.72464 17.5 3.30072 17.3244 2.98816 17.0118C2.67559 16.6993 2.5 16.2754 2.5 15.8333V12.5" stroke="#5744E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M5.8335 8.33325L10.0002 12.4999L14.1668 8.33325" stroke="#5744E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M10 12.5V2.5" stroke="#5744E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </a>
                                    <?php
                                        }
                                    ?>
                                </div>
                            </div>
                            <!-- ---------------- -->
                            <div class="file">
                                <div class="info">
                                    <div class="title">
                                        Driving licence:
                                    </div>
                                    <div class="info">
                                        <?php
                                            if($idProof['driving_lic']=='0'){
                                                echo "Not entered";
                                            }else{
                                                echo $idProof['driving_lic'];
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div class="download">
                                    <?php
                                        if($idProof['driving_lic_file']!='0'){
                                    ?>
                                        <a href="../../../model/viewPdf.php?pdf=<?php echo $idProof['driving_lic_file']; ?>" target="_blank">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M17.5 12.5V15.8333C17.5 16.2754 17.3244 16.6993 17.0118 17.0118C16.6993 17.3244 16.2754 17.5 15.8333 17.5H4.16667C3.72464 17.5 3.30072 17.3244 2.98816 17.0118C2.67559 16.6993 2.5 16.2754 2.5 15.8333V12.5" stroke="#5744E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M5.8335 8.33325L10.0002 12.4999L14.1668 8.33325" stroke="#5744E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M10 12.5V2.5" stroke="#5744E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </a>
                                    <?php
                                        }
                                    ?>
                                </div>
                            </div>
                            <!-- ---------------- -->
                            <div class="file">
                                <div class="info">
                                    <div class="title">
                                        PAN card:
                                    </div>
                                    <div class="info">
                                        <?php
                                            if($idProof['pan_card']=='0'){
                                                echo "Not entered";
                                            }else{
                                                echo $idProof['pan_card'];
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div class="download">
                                    <?php
                                        if($idProof['pan_card_file']!='0'){
                                    ?>
                                        <a href="../../../model/viewPdf.php?pdf=<?php echo $idProof['pan_card_file']; ?>" target="_blank">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M17.5 12.5V15.8333C17.5 16.2754 17.3244 16.6993 17.0118 17.0118C16.6993 17.3244 16.2754 17.5 15.8333 17.5H4.16667C3.72464 17.5 3.30072 17.3244 2.98816 17.0118C2.67559 16.6993 2.5 16.2754 2.5 15.8333V12.5" stroke="#5744E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M5.8335 8.33325L10.0002 12.4999L14.1668 8.33325" stroke="#5744E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M10 12.5V2.5" stroke="#5744E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </a>
                                    <?php
                                        }
                                    ?>
                                </div>
                            </div>
                            <!-- ---------------- -->
                            <div class="file">
                                <div class="info">
                                    <div class="title">
                                        Birth certificate:
                                    </div>
                                    <div class="info">
                                        <?php
                                            if($idProof['birth_cer']=='0'){
                                                echo "Not entered";
                                            }else{
                                                echo $idProof['birth_cer'];
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div class="download">
                                    <?php
                                        if($idProof['birth_cer_file']!='0'){
                                    ?>
                                        <a href="../../../model/viewPdf.php?pdf=<?php echo $idProof['birth_cer_file']; ?>" target="_blank">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M17.5 12.5V15.8333C17.5 16.2754 17.3244 16.6993 17.0118 17.0118C16.6993 17.3244 16.2754 17.5 15.8333 17.5H4.16667C3.72464 17.5 3.30072 17.3244 2.98816 17.0118C2.67559 16.6993 2.5 16.2754 2.5 15.8333V12.5" stroke="#5744E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M5.8335 8.33325L10.0002 12.4999L14.1668 8.33325" stroke="#5744E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M10 12.5V2.5" stroke="#5744E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </a>
                                    <?php
                                        }
                                    ?>
                                </div>
                            </div>
                            <!-- ---------------- -->
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
                    <section class="section proofs" id="educationalbackground">
                        <div class="header">
                            <div class="heading">
                                Educational backgrond
                            </div>
                            <?php
                                if($chk==0 || $chk==$chk2){
                            ?>
                                    <div class="edit">
                                        <a href="./update_house_member.php?id=<?php echo $hm_id ?>#educationalbackground">
                                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10.0833 3.77783H3.66659C3.18036 3.77783 2.71404 3.97099 2.37022 4.3148C2.02641 4.65862 1.83325 5.12494 1.83325 5.61117V18.4445C1.83325 18.9307 2.02641 19.397 2.37022 19.7409C2.71404 20.0847 3.18036 20.2778 3.66659 20.2778H16.4999C16.9861 20.2778 17.4525 20.0847 17.7963 19.7409C18.1401 19.397 18.3333 18.9307 18.3333 18.4445V12.0278" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M16.9583 2.40286C17.3229 2.03818 17.8175 1.83331 18.3333 1.83331C18.849 1.83331 19.3436 2.03818 19.7083 2.40286C20.0729 2.76753 20.2778 3.26213 20.2778 3.77786C20.2778 4.29358 20.0729 4.78818 19.7083 5.15286L10.9999 13.8612L7.33325 14.7779L8.24992 11.1112L16.9583 2.40286Z" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </a>
                                    </div>
                            <?php
                                }
                            ?>
                        </div>
                        <div class="files">
                            <!-- ---------------- -->
                            <div class="file">
                                <div class="info">
                                    <div class="title">
                                        Secondary school:
                                    </div>
                                    <div class="info">
                                        <?php
                                            if($edu['hs']=='0'){
                                                echo "Not uploaded";
                                            }else{
                                                echo "Uploaded";
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div class="download">
                                    <?php
                                        if($edu['hs']!='0'){
                                    ?>
                                        <a href="../../../model/viewPdf.php?pdf=<?php echo $edu['hs']; ?>" target="_blank">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M17.5 12.5V15.8333C17.5 16.2754 17.3244 16.6993 17.0118 17.0118C16.6993 17.3244 16.2754 17.5 15.8333 17.5H4.16667C3.72464 17.5 3.30072 17.3244 2.98816 17.0118C2.67559 16.6993 2.5 16.2754 2.5 15.8333V12.5" stroke="#5744E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M5.8335 8.33325L10.0002 12.4999L14.1668 8.33325" stroke="#5744E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M10 12.5V2.5" stroke="#5744E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </a>
                                    <?php
                                        }
                                    ?>
                                </div>
                            </div>
                            <!-- ---------------- -->
                            <div class="file">
                                <div class="info">
                                    <div class="title">
                                        Higher secondary:
                                    </div>
                                    <div class="info">
                                        <?php
                                            if($edu['hss']=='0'){
                                                echo "Not uploaded";
                                            }else{
                                                echo "Uploaded";
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div class="download">
                                    <?php
                                        if($edu['hss']!='0'){
                                    ?>
                                        <a href="../../../model/viewPdf.php?pdf=<?php echo $edu['hss']; ?>" target="_blank">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M17.5 12.5V15.8333C17.5 16.2754 17.3244 16.6993 17.0118 17.0118C16.6993 17.3244 16.2754 17.5 15.8333 17.5H4.16667C3.72464 17.5 3.30072 17.3244 2.98816 17.0118C2.67559 16.6993 2.5 16.2754 2.5 15.8333V12.5" stroke="#5744E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M5.8335 8.33325L10.0002 12.4999L14.1668 8.33325" stroke="#5744E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M10 12.5V2.5" stroke="#5744E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </a>
                                    <?php
                                        }
                                    ?>
                                </div>
                            </div>
                            <!-- ---------------- -->
                            <div class="file">
                                <div class="info">
                                    <div class="title">
                                        Diploma:
                                    </div>
                                    <div class="info">
                                        <?php
                                            if($edu['diploma']=='0'){
                                                echo "Not uploaded";
                                            }else{
                                                echo "Uploaded";
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div class="download">
                                    <?php
                                        if($edu['diploma']!='0'){
                                    ?>
                                        <a href="../../../model/viewPdf.php?pdf=<?php echo $edu['diploma']; ?>" target="_blank">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M17.5 12.5V15.8333C17.5 16.2754 17.3244 16.6993 17.0118 17.0118C16.6993 17.3244 16.2754 17.5 15.8333 17.5H4.16667C3.72464 17.5 3.30072 17.3244 2.98816 17.0118C2.67559 16.6993 2.5 16.2754 2.5 15.8333V12.5" stroke="#5744E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M5.8335 8.33325L10.0002 12.4999L14.1668 8.33325" stroke="#5744E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M10 12.5V2.5" stroke="#5744E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </a>
                                    <?php
                                        }
                                    ?>
                                </div>
                            </div>
                            <!-- ---------------- -->
                            <div class="file">
                                <div class="info">
                                    <div class="title">
                                        Under graduation:
                                    </div>
                                    <div class="info">
                                        <?php
                                            if($edu['ug']=='0'){
                                                echo "Not uploaded";
                                            }else{
                                                echo "Uploaded";
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div class="download">
                                    <?php
                                        if($edu['ug']!='0'){
                                    ?>
                                        <a href="../../../model/viewPdf.php?pdf=<?php echo $edu['ug']; ?>" target="_blank">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M17.5 12.5V15.8333C17.5 16.2754 17.3244 16.6993 17.0118 17.0118C16.6993 17.3244 16.2754 17.5 15.8333 17.5H4.16667C3.72464 17.5 3.30072 17.3244 2.98816 17.0118C2.67559 16.6993 2.5 16.2754 2.5 15.8333V12.5" stroke="#5744E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M5.8335 8.33325L10.0002 12.4999L14.1668 8.33325" stroke="#5744E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M10 12.5V2.5" stroke="#5744E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </a>
                                    <?php
                                        }
                                    ?>
                                </div>
                            </div>
                            <!-- ---------------- -->
                            <div class="file">
                                <div class="info">
                                    <div class="title">
                                        Post graduation:
                                    </div>
                                    <div class="info">
                                        <?php
                                            if($edu['pg']=='0'){
                                                echo "Not uploaded";
                                            }else{
                                                echo "Uploaded";
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div class="download">
                                    <?php
                                        if($edu['pg']!='0'){
                                    ?>
                                        <a href="../../../model/viewPdf.php?pdf=<?php echo $edu['pg']; ?>" target="_blank">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M17.5 12.5V15.8333C17.5 16.2754 17.3244 16.6993 17.0118 17.0118C16.6993 17.3244 16.2754 17.5 15.8333 17.5H4.16667C3.72464 17.5 3.30072 17.3244 2.98816 17.0118C2.67559 16.6993 2.5 16.2754 2.5 15.8333V12.5" stroke="#5744E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M5.8335 8.33325L10.0002 12.4999L14.1668 8.33325" stroke="#5744E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M10 12.5V2.5" stroke="#5744E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </a>
                                    <?php
                                        }
                                    ?>
                                </div>
                            </div>
                            <!-- ---------------- -->
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
                    <section class="section proofs" id="professionalbackground">
                        <div class="header">
                            <div class="heading">
                                Professional backgrond
                            </div>
                            <?php
                                if($chk==0 || $chk==$chk2){
                            ?>
                                    <div class="edit">
                                        <a href="./update_house_member.php?id=<?php echo $hm_id ?>#professionalbackground">
                                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10.0833 3.77783H3.66659C3.18036 3.77783 2.71404 3.97099 2.37022 4.3148C2.02641 4.65862 1.83325 5.12494 1.83325 5.61117V18.4445C1.83325 18.9307 2.02641 19.397 2.37022 19.7409C2.71404 20.0847 3.18036 20.2778 3.66659 20.2778H16.4999C16.9861 20.2778 17.4525 20.0847 17.7963 19.7409C18.1401 19.397 18.3333 18.9307 18.3333 18.4445V12.0278" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M16.9583 2.40286C17.3229 2.03818 17.8175 1.83331 18.3333 1.83331C18.849 1.83331 19.3436 2.03818 19.7083 2.40286C20.0729 2.76753 20.2778 3.26213 20.2778 3.77786C20.2778 4.29358 20.0729 4.78818 19.7083 5.15286L10.9999 13.8612L7.33325 14.7779L8.24992 11.1112L16.9583 2.40286Z" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </a>
                                    </div>
                            <?php
                                }
                            ?>
                        </div>
                        <div class="files">
                            <!-- ---------------- -->
                            <div class="file">
                                <div class="info">
                                    <div class="title">
                                        Current Profession:
                                    </div>
                                    <div class="info">
                                        <?php
                                            if($pro['cur_pro']=='0'){
                                                echo "Not entered";
                                            }else{
                                                echo $pro['cur_pro'];
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div class="download">
                                    <?php
                                        if($pro['cur_pro_file']!='0'){
                                    ?>
                                        <a href="../../../model/viewPdf.php?pdf=<?php echo $edu['hs']; ?>" target="_blank">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M17.5 12.5V15.8333C17.5 16.2754 17.3244 16.6993 17.0118 17.0118C16.6993 17.3244 16.2754 17.5 15.8333 17.5H4.16667C3.72464 17.5 3.30072 17.3244 2.98816 17.0118C2.67559 16.6993 2.5 16.2754 2.5 15.8333V12.5" stroke="#5744E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M5.8335 8.33325L10.0002 12.4999L14.1668 8.33325" stroke="#5744E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M10 12.5V2.5" stroke="#5744E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </a>
                                    <?php
                                        }
                                    ?>
                                </div>
                            </div>
                            <!-- ---------------- -->
                            <div class="file">
                                <div class="info">
                                    <div class="title">
                                        Company name:
                                    </div>
                                    <div class="info">
                                        <?php
                                            if($pro['comp_name']=='0'){
                                                echo "Not entered";
                                            }else{
                                                echo $pro['comp_name'];
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <!-- ---------------- -->
                            <div class="file">
                                <div class="info">
                                    <div class="title">
                                        Location:
                                    </div>
                                    <div class="info">
                                        <?php
                                            if($pro['location']=='0'){
                                                echo "Not entered";
                                            }else{
                                                echo $pro['location'];
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <!-- ---------------- -->
                            <div class="file">
                                <div class="info">
                                    <div class="title">
                                        Profession started:
                                    </div>
                                    <div class="info">
                                        <?php
                                            if($pro['pro_started']=='0000-00-00'){
                                                echo "Not entered";
                                            }else{
                                                echo $pro['pro_started'];
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <!-- ---------------- -->
                           
                        </div>
                    </section>
                    <?php
                        }
                    ?>

                </div>
            </div>
        </section>
    </body>
    <script src="../../../../public/assets/js/hm_profile.js"></script>
</html>
	<?php
}
?>