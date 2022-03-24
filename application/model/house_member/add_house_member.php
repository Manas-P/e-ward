<?php
    include '../../config/dbcon.php';
    session_start();
    extract($_POST);

    //Add house member
    if(isset($_POST['add-hm'])){
        $houseno= $_SESSION['houseno'];
        $wardno= $_SESSION['wardno'];

        //Input Sanitization
        $hfname = trim($hfname); 
        $hfname=mysqli_real_escape_string($conn,$hfname);
        $hfname=filter_var($hfname, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

        $hemail = trim($hemail);
        $hemail=mysqli_real_escape_string($conn,$hemail);
        $hemail=filter_var($hemail, FILTER_SANITIZE_EMAIL, FILTER_FLAG_STRIP_HIGH);

        $hphno = trim($hphno);
        $hphno=mysqli_real_escape_string($conn,$hphno);
        $hphno=filter_var($hphno, FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);

        //Photo path upload
        $upload_dir = '../../../public/assets/images/';
        $file_tmpname = $_FILES['hphoto']['tmp_name'];
        $file_name = $_FILES['hphoto']['name'];
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $filepath = $upload_dir . time().".".$file_ext;
        if(empty($hemail)){
           //Check photo upload error
           if(move_uploaded_file($file_tmpname, $filepath)){
                $insHouseMember="INSERT INTO `tbl_house_member`(`ward_no`, `house_no`, `fname`, `phno`, `blood_grp`, `dob`, `photo`) VALUES ('$wardno','$houseno','$hfname','$hphno','$hblood','$hdob','$filepath')";
                $insResult=mysqli_query($conn,$insHouseMember);
                header("Location: ../../view/pages/house_member/add_house_members.php");
            }else{
                $_SESSION['loginMessage'] = "File upload error";
                header("Location: ../../view/pages/house_member/add_house_members.php");
            }
        }else{
            if(move_uploaded_file($file_tmpname, $filepath)){

                // Generate Random Password
                include '../passwordGenerator.php';

                //Count number of users
                $count="SELECT `hm_id` FROM `tbl_house_member` WHERE `house_no`='$houseno'";
                $countResult=mysqli_query($conn,$count);
                $rowcount = mysqli_num_rows($countResult);
                $rowcount+=1;

                //Generate user id
                $userid=$wardno . $houseno . $rowcount;

                //Send mail
                $subject="E-Ward membership added";
                $body="Dear $hfname, you have been added as House member by $fname. You can login to E-Ward using Id = $userid and Password = $generatedPassword";
                $headers="From: ewardmember@gmail.com";

                if(mail($hemail,$subject,$body,$headers)){
                    $insHouseMember="INSERT INTO `tbl_house_member`(`ward_no`, `house_no`, `fname`,`email`, `phno`, `blood_grp`, `dob`, `photo`, `userid`, `password`) VALUES ('$wardno','$houseno','$hfname','$hemail','$hphno','$hblood','$hdob','$filepath','$userid','$generatedPassword') ; 
                    INSERT INTO `tbl_id_proof`(`userid`) VALUES ('$userid') ; 
                    INSERT INTO `tbl_edu_bg`(`userid`) VALUES ('$userid') ; 
                    INSERT INTO `tbl_pro_bg`(`userid`) VALUES ('$userid')";
                    $insResult=mysqli_multi_query($conn,$insHouseMember);
                    if($insResult){
                        header("Location: ../../view/pages/house_member/add_house_members.php");
                        $_SESSION['success'] = "House member added";
                    }else{
                        $_SESSION['error'] = "Error in adding member";
                        header("Location: ../../view/pages/house_member/add_house_members.php");
                    }
                }else{
                    $_SESSION['error'] = "Error in sending E-mail";
                    header("Location: ../../view/pages/house_member/add_house_members.php");
                }
            }else{
                $_SESSION['error'] = "File upload error";
                header("Location: ../../view/pages/house_member/add_house_members.php");
            }
        }
    }
?>