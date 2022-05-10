<?php
    include '../../config/dbcon.php';
    session_start();
    extract($_POST);

        //Update house member details
        if(isset($_POST['hm-up-btn'])){

            //Input Sanitization
            $hmufname = trim($hmufname); 
            $hmufname=mysqli_real_escape_string($conn,$hmufname);
            $hmufname=filter_var($hmufname, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

            $hmuemail = trim($hmuemail);
            $hmuemail=mysqli_real_escape_string($conn,$hmuemail);
            $hmuemail=filter_var($hmuemail, FILTER_SANITIZE_EMAIL, FILTER_FLAG_STRIP_HIGH);

            $hmuphno = trim($hmuphno);
            $hmuphno=mysqli_real_escape_string($conn,$hmuphno);
            $hmuphno=filter_var($hmuphno, FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);

            $hmuaadharno = trim($hmuaadharno);
            $hmuaadharno=mysqli_real_escape_string($conn,$hmuaadharno);
            $hmuaadharno=filter_var($hmuaadharno, FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);

            //check empty file 
            //profile photo
            if(empty($_FILES["hmuphoto"]['name'])){
                $filepath=$hm_already_photo;
            }else{
                $upload_dir = '../../../public/assets/images/uploads/photos/';
                $file_tmpname = $_FILES['hmuphoto']['tmp_name'];
                $file_name = $_FILES['hmuphoto']['name'];
                $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
                $filepath = $upload_dir . time().".".$file_ext;
                if(move_uploaded_file($file_tmpname, $filepath)){}else{
                    $_SESSION['error'] = "Error in file upload";
                    header("Location: ../../view/pages/house_member/add_house_members.php");
                }
            }

            //Id proofs
            $upload_dir_doc = '../../../public/assets/documents/';
            $file_ext_pdf = ".pdf";
            //Aadhar
            if(empty($_FILES["hmuaadharfile"]['name'])){
                $filepath_aadhar=$hm_already_aadhar;
            }else{
                $file_tmpname_aadhar = $_FILES['hmuaadharfile']['tmp_name'];
                $file_name_aadhar = $_FILES['hmuaadharfile']['name'];
                $filepath_aadhar = $upload_dir_doc . time()."0".".".$file_ext_pdf;
                if(move_uploaded_file($file_tmpname_aadhar, $filepath_aadhar)){}else{
                    $_SESSION['error'] = "Error in uploading Aadhar";
                    header("Location: ../../view/pages/house_member/add_house_members.php");
                }
            }
            //Election id
            if(empty($_FILES["hmuelectionfile"]['name'])){
                $filepath_election=$hm_already_election;
            }else{
                $file_tmpname_election = $_FILES['hmuelectionfile']['tmp_name'];
                $file_name_election = $_FILES['hmuelectionfile']['name'];
                $filepath_election = $upload_dir_doc . time()."1".".".$file_ext_pdf;
                if(move_uploaded_file($file_tmpname_election, $filepath_election)){}else{
                    $_SESSION['error'] = "Error in uploading Election id";
                    header("Location: ../../view/pages/house_member/add_house_members.php");
                }
            }
            //Driving Licence
            if(empty($_FILES["hmudrivingfile"]['name'])){
                $filepath_driving=$hm_already_driving;
            }else{
                $file_tmpname_driving = $_FILES['hmudrivingfile']['tmp_name'];
                $file_name_driving = $_FILES['hmudrivingfile']['name'];
                $filepath_driving = $upload_dir_doc . time()."2".".".$file_ext_pdf;
                if(move_uploaded_file($file_tmpname_driving, $filepath_driving)){}else{
                    $_SESSION['error'] = "Error in uploading Driving licence";
                    header("Location: ../../view/pages/house_member/add_house_members.php");
                }
            }
            //PAN card
            if(empty($_FILES["hmupancardfile"]['name'])){
                $filepath_pan=$hm_already_pan;
            }else{
                $file_tmpname_pan = $_FILES['hmupancardfile']['tmp_name'];
                $file_name_pan = $_FILES['hmupancardfile']['name'];
                $filepath_pan = $upload_dir_doc . time()."3".".".$file_ext_pdf;
                if(move_uploaded_file($file_tmpname_pan, $filepath_pan)){}else{
                    $_SESSION['error'] = "Error in uploading PAN card";
                    header("Location: ../../view/pages/house_member/add_house_members.php");
                }
            }
            //Birth certificate
            if(empty($_FILES["hmubirthfile"]['name'])){
                $filepath_birth=$hm_already_birth;
            }else{
                $file_tmpname_birth = $_FILES['hmubirthfile']['tmp_name'];
                $file_name_birth = $_FILES['hmubirthfile']['name'];
                $filepath_birth = $upload_dir_doc . time()."4".".".$file_ext_pdf;
                if(move_uploaded_file($file_tmpname_birth, $filepath_birth)){}else{
                    $_SESSION['error'] = "Error in uploading Birth certificate";
                    header("Location: ../../view/pages/house_member/add_house_members.php");
                }
            }

            //Professional backgrounds
            //Secondary school
            if(empty($_FILES["hmuhsfile"]['name'])){
                $filepath_hs=$hm_already_hs;
            }else{
                $file_tmpname_hs = $_FILES['hmuhsfile']['tmp_name'];
                $file_name_hs = $_FILES['hmuhsfile']['name'];
                $filepath_hs = $upload_dir_doc . time()."5".".".$file_ext_pdf;
                if(move_uploaded_file($file_tmpname_hs, $filepath_hs)){}else{
                    $_SESSION['error'] = "Error in uploading secondary school certificate";
                    header("Location: ../../view/pages/house_member/add_house_members.php");
                }
            }
            //Higher secondary school
            if(empty($_FILES["hmuhssfile"]['name'])){
                $filepath_hss=$hm_already_hss;
            }else{
                $file_tmpname_hss = $_FILES['hmuhssfile']['tmp_name'];
                $file_name_hss = $_FILES['hmuhssfile']['name'];
                $filepath_hss = $upload_dir_doc . time()."6".".".$file_ext_pdf;
                if(move_uploaded_file($file_tmpname_hss, $filepath_hss)){}else{
                    $_SESSION['error'] = "Error in uploading higher secondary certificate";
                    header("Location: ../../view/pages/house_member/add_house_members.php");
                }
            }
            //Diploma
            if(empty($_FILES["hmudiplomafile"]['name'])){
                $filepath_diploma=$hm_already_diploma;
            }else{
                $file_tmpname_diploma = $_FILES['hmudiplomafile']['tmp_name'];
                $file_name_diploma = $_FILES['hmudiplomafile']['name'];
                $filepath_diploma = $upload_dir_doc . time()."7".".".$file_ext_pdf;
                if(move_uploaded_file($file_tmpname_diploma, $filepath_diploma)){}else{
                    $_SESSION['error'] = "Error in uploading diploma certificate";
                    header("Location: ../../view/pages/house_member/add_house_members.php");
                }
            }
            //Under graduation
            if(empty($_FILES["hmuugfile"]['name'])){
                $filepath_ug=$hm_already_ug;
            }else{
                $file_tmpname_ug = $_FILES['hmuugfile']['tmp_name'];
                $file_name_ug = $_FILES['hmuugfile']['name'];
                $filepath_ug = $upload_dir_doc . time()."8".".".$file_ext_pdf;
                if(move_uploaded_file($file_tmpname_ug, $filepath_ug)){}else{
                    $_SESSION['error'] = "Error in uploading under graduation certificate";
                    header("Location: ../../view/pages/house_member/add_house_members.php");
                }
            }
            //Post graduation
            if(empty($_FILES["hmupgfile"]['name'])){
                $filepath_pg=$hm_already_pg;
            }else{
                $file_tmpname_pg = $_FILES['hmupgfile']['tmp_name'];
                $file_name_pg = $_FILES['hmupgfile']['name'];
                $filepath_pg = $upload_dir_doc . time()."9".".".$file_ext_pdf;
                if(move_uploaded_file($file_tmpname_pg, $filepath_pg)){}else{
                    $_SESSION['error'] = "Error in uploading post graduation certificate";
                    header("Location: ../../view/pages/house_member/add_house_members.php");
                }
            }
            //Current profession
            if(empty($_FILES["hmuprofile"]['name'])){
                $filepath_cur_pro=$hm_already_pro;
            }else{
                $file_tmpname_cur_pro = $_FILES['hmuprofile']['tmp_name'];
                $file_name_cur_pro = $_FILES['hmuprofile']['name'];
                $filepath_cur_pro = $upload_dir_doc . time()."10".".".$file_ext_pdf;
                if(move_uploaded_file($file_tmpname_cur_pro, $filepath_cur_pro)){}else{
                    $_SESSION['error'] = "Error in uploading profession certificate";
                    header("Location: ../../view/pages/house_member/add_house_members.php");
                }
            }


            //Check empty field
            //General info
            if(empty($hmuemail)){
                $hmuemail="Not entered";
            }
            if(empty($hmublood)){
                $hmublood="NA";
            }
            //Id proof
            if(empty($hmuaadharno)){
                $hmuaadharno="0";
            }
            if(empty($hmuelectionid)){
                $hmuelectionid="0";
            }
            if(empty($hmudrivingid)){
                $hmudrivingid="0";
            }
            if(empty($hmupancard)){
                $hmupancard="0";
            }
            if(empty($hmubirth)){
                $hmubirth="0";
            }
            //Profession background
            if(empty($hmucurpro)){
                $hmucurpro="0";
            }
            if(empty($hmucompname)){
                $hmucompname="0";
            }
            if(empty($hmulocation)){
                $hmulocation="0";
            }
            if(empty($hmuprostart)){
                $hmuprostart="";
            }

            //Update request
            $updatehmQuery="UPDATE `tbl_house_member` SET `fname`='$hmufname',`email`='$hmuemail',`phno`='$hmuphno',`blood_grp`='$hmublood',`dob`='$hmudob',`photo`='$filepath' WHERE `userid`='$hm_id' ; 
                            UPDATE `tbl_id_proof` SET `aadhar_no`='$hmuaadharno',`aadhar_file`='$filepath_aadhar',`election_id`='$hmuelectionid',`election_id_file`='$filepath_election',`driving_lic`='$hmudrivingid',`driving_lic_file`='$filepath_driving',`pan_card`='$hmupancard',`pan_card_file`='$filepath_pan',`birth_cer`='$hmubirth',`birth_cer_file`='$filepath_birth' WHERE `userid`='$hm_id' ; 
                            UPDATE `tbl_edu_bg` SET `hs`='$filepath_hs',`hss`='$filepath_hss',`diploma`='$filepath_diploma',`ug`='$filepath_ug',`pg`='$filepath_pg' WHERE `userid`='$hm_id' ; 
                            UPDATE `tbl_pro_bg` SET `cur_pro`='$hmucurpro',`cur_pro_file`='$filepath_cur_pro',`comp_name`='$hmucompname',`location`='$hmulocation',`pro_started`='$hmuprostart' WHERE `userid`='$hm_id'";
            $updatehmResult=mysqli_multi_query($conn,$updatehmQuery);
            if($updatehmResult){
                $_SESSION['success'] = "$hmufname's profile updated successfully";
                header("Location: ../../view/pages/house_member/add_house_members.php");
            }else{
                $_SESSION['error'] = "Error in updatation";
                header("Location: ../../view/pages/house_member/add_house_members.php");
            }
        }
?>