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
        $photo=$row['photo'];
        $name= $row['fname'];
        $dob=$row['dob'];
        $blood=$row['blood_grp'];
        $email=$row['email'];
        $phno=$row['phno'];
    }
    //check user
    $arr = str_split($user_id); // convert string to an array
    $chk= end($arr); // 0 = house head
    $arr2=str_split($hm_id);
    $chk2= end($arr2);
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
                    <div class="buttn">
                        <input type="button" value="Update changes" class="button">
                    </div>
                </div>
                
                <div class="right">

                    <!-- General Indormation -->
                    <section class="general" id="general">
                        <div class="header">
                            <div class="heading">
                                General informations
                            </div>
                        </div>
                        <div class="information">
                            <div class="inputs">
                                <div class="input h-photo">
                                    <div class="label">
                                        Upload photo
                                    </div>
                                    <input type="file" name="hphoto" id="h-photo" accept="image/png,image/jpeg">
                                    <div class="error error-hidden">
                                    </div>
                                </div>
                                <div class="input h-fullname">
                                    <div class="label">
                                        Full name
                                    </div>
                                    <input type="text" name="hfname" id="h-full-name" placeholder="John Doe" autocomplete="off">
                                    <div class="error error-hidden">
                                    </div>
                                </div>
                                <div class="half-input">
                                    <div class="input h-date">
                                        <div class="label">
                                            Date of birth
                                        </div>
                                        <input type="date" name="hdob" id="h-date" autocomplete="off">
                                        <div class="error error-hidden">
                                        </div>
                                    </div>
                                    <div class="input h-blood">
                                        <div class="label">
                                            Blood group
                                        </div>
                                        <input type="text" name="hblood" id="h-blood" placeholder="A+" autocomplete="off">
                                        <div class="error error-hidden">
                                        </div>
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

                    <section class="proofs" id="identityProof">
                        <div class="header">
                            <div class="heading">
                                Identity proofs
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
                                        <a href="#">
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
                                        <a href="#">
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
                                        <a href="#">
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
                                        <a href="#">
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
                                        <a href="#">
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
        </section>
    </body>
    <script src="../../js/hm_profile.js"></script>
</html>
	<?php
}
?>