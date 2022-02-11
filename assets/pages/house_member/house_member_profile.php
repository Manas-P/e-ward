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
        <link rel="stylesheet" href="../../styles/hm_profile.css">
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
                        <a href="" class="now">
                            <?php
                                echo $name;
                            ?>
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
                </div>
                
                <div class="right">

                    <!-- General Indormation -->
                    <section class="general" id="general">
                        <div class="header">
                            <div class="heading">
                                General informations
                            </div>
                            <?php
                                if($chk==0 || $chk==$chk2){
                            ?>
                                    <div class="edit">
                                        <a href="#">
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
                    <section class="proofs" id="identityProof">
                        <div class="header">
                            <div class="heading">
                                Identity proofs
                            </div>
                            <?php
                                if($chk==0 || $chk==$chk2){
                            ?>
                                    <div class="edit">
                                        <a href="#">
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
                                        215487896563
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
                            <!-- ---------------- -->
                            <div class="file">
                                <div class="info">
                                    <div class="title">
                                        Election id:
                                    </div>
                                    <div class="info">
                                        458962357
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
                            <!-- ---------------- -->
                            <div class="file">
                                <div class="info">
                                    <div class="title">
                                        Driving licence:
                                    </div>
                                    <div class="info">
                                        587856985647
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
                            <!-- ---------------- -->
                            <div class="file">
                                <div class="info">
                                    <div class="title">
                                        PAN card:
                                    </div>
                                    <div class="info">
                                        425685412548
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
                            <!-- ---------------- -->
                            <div class="file">
                                <div class="info">
                                    <div class="title">
                                        Birth certificate:
                                    </div>
                                    <div class="info">
                                        2000-08-24
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
                            <!-- ---------------- -->
                        </div>
                    </section>

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