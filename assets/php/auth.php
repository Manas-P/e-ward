    <?php
        include '../include/dbcon.php';
        session_start();
        // Collecting values
        extract($_POST);
        //check houseno exisit
        if(isset($_POST['houseNo']))
        {
            $chk = "SELECT * FROM tbl_registration WHERE houseno='$houseNo' and wardno='$wardno'";
            $res = mysqli_query($conn, $chk);
            if(mysqli_num_rows($res)>0)
            {
                 // Toast should appear
                 echo  '<div class="alertt alert-visible">
                            <div class="econtent">
                                <img src="../images/warning.svg" alt="warning">
                                <div class="text">
                                    House already registered
                                </div>
                            </div>
                        </div>';
            }
        }
        //Registration
        if(isset($_POST['regbtn'])){
            //While using extract, no need to define variable use $nameAttribute from the form
            $userid=$wrdno . $houno . "0";

            $upload_dir = '../documents/taxreport/';
            $file_tmpname = $_FILES['taxre']['tmp_name'];
            $file_name = $_FILES['taxre']['name'];
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $filepath = $upload_dir . time().".".$file_ext;

            if(move_uploaded_file($file_tmpname, $filepath)){

                $ins="INSERT INTO `tbl_registration`(`fname`, `email`, `phno`, `wardno`, `houseno`, `taxreport`) VALUES ('$fname','$email','$phno','$wrdno','$houno','$filepath')";
                $ins_res=mysqli_query($conn,$ins);
                if($ins_res){
                    header("Location: ../pages/login.php");
                }else{
                    $_SESSION['loginMessage'] = "Error in registration";
                    header("Location: ../pages/login.php");
                }

            }else{
                $_SESSION['loginMessage'] = "File upload error";
                header("Location: ../pages/login.php");
            }
        }


        //login 
        if(isset($_POST['userName']) && isset($_POST['password']) && isset($_POST['submitButton']))
        {
            //Check if mobile already exisit
            $checkLogin = "SELECT * FROM `tbl_house_member` WHERE `userid`='$userName' and `password`='$password'";
            $checkLoginResult = mysqli_query($conn, $checkLogin);
            $checkLoginCount = mysqli_num_rows($checkLoginResult);
            //Check Admin
            $adminCheck="SELECT * FROM `tbl_admin` WHERE `username`='$userName' and `password`='$password'";
            $adminCheckResult = mysqli_query($conn,$adminCheck);
            $adminCheckCount=mysqli_num_rows($adminCheckResult);
            //Check Ward Member
            $wardMemberCheck="SELECT * FROM `tbl_ward_member` WHERE `wardno`='$userName' and `password`='$password' and `status`=1";
            $wardMemberCheckResult=mysqli_query($conn,$wardMemberCheck);
            $wardMemberCount=mysqli_num_rows($wardMemberCheckResult);
            //No user exists
            if($checkLoginCount==1)
            {
                $userData=mysqli_fetch_assoc($checkLoginResult);
                $_SESSION['e-wardId'] = session_id();
                $_SESSION['fname'] = $userData['fname'];
                $_SESSION['houseno']= $userData['house_no'];
                $_SESSION['wardno']= $userData['ward_no'];
                $_SESSION['userid']= $userData['userid'];
                header("Location: ../pages/house_member/dashboard.php");
                die();
            }
            elseif($adminCheckCount==1){
                $adminData=mysqli_fetch_assoc($adminCheckResult);
                $_SESSION['adminId'] = session_id();
                $_SESSION['aid']=$adminData['aid'];
                header("Location: ../pages/admin/admin_add_wm.php");
                die();
            }
            elseif($wardMemberCount==1){
                $wardMemberData=mysqli_fetch_assoc($wardMemberCheckResult);
                $_SESSION['memebrId'] = session_id();
                $_SESSION['wardno']=$wardMemberData['wardno'];
                $_SESSION['fullname']=$wardMemberData['fullname'];
                header("Location: ../pages/ward_member/houses.php");
                die();
            }
            else
            {
                $_SESSION['loginMessage'] = "Invalid Username or Password";
                header("Location: ../pages/login.php");
                die();
            }
        }

        //check wardno exisit
        if(isset($_POST['wardNo']))
        {
            $chkWard = "SELECT * FROM `tbl_ward_member` WHERE wardno='$wardNo'";
            $resChk = mysqli_query($conn, $chkWard);
            if(mysqli_num_rows($resChk)>0)
            {
                 // Toast should appear
                 echo  '<div class="alertt alert-visible">
                            <div class="econtent">
                                <img src="../../images/warning.svg" alt="warning">
                                <div class="text">
                                    Ward member already registered
                                </div>
                            </div>
                        </div>';
            }
        }

        //Add Ward Member
        if(isset($_POST['add-wm'])){
            $upload_dir = '../images/uploads/photos/';
            $file_tmpname = $_FILES['wphoto']['tmp_name'];
            $file_name = $_FILES['wphoto']['name'];
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $filepath = $upload_dir . time().".".$file_ext;
            //Check File Upload
            if(move_uploaded_file($file_tmpname, $filepath)){
                
                // Generate Random Password
                include '../include/password_generator.php';

                $subject="E-Ward Approved";
                $body="Dear $wfname, you have been added as Ward member. You can login to E-Ward using Id = $wwrdno and Password = $generatedPassword";
                $headers="From: ewardmember@gmail.com";

                if(mail($wemail,$subject,$body,$headers)){

                    $insMember="INSERT INTO `tbl_ward_member`(`fullname`, `email`, `phno`, `wardno`, `validupto`, `photo`, `password`) VALUES ('$wfname','$wemail','$wphno','$wwrdno','$wvalidity','$filepath','$generatedPassword')";
                    $insMemberRes=mysqli_query($conn,$insMember);
                    if($insMemberRes){
                        header("Location: ../pages/admin/admin_add_wm.php");
                    }else{
                    echo '<script language="javascript" type="text/javascript">';
                    echo 'alert("Error")';
                    echo '</script>';
                    }

                }else{
                    echo "Mail not Send";
                }

                
            }else{
                $_SESSION['loginMessage'] = "File upload error";
                header("Location: ../pages/admin/admin_add_wm.php");
            }
        }

        //Update ward member
        if(isset($_POST['update-wm'])){
            $wrno=$_GET['wrno'];
            //check image updated
            if($_FILES["wphoto"]["size"]==0){
                $update="UPDATE `tbl_ward_member` SET `fullname`='$wfname',`email`='$wemail',`phno`='$wphno',`wardno`='$wwrdno',`validupto`='$wvalidity' WHERE `wardno`='$wrno'";
                $updateResult=mysqli_query($conn,$update);
                header("Location: ../pages/admin/admin_add_wm.php");
            }else{
                $upload_dir = '../images/uploads/photos/';
                $file_tmpname = $_FILES['wphoto']['tmp_name'];
                $file_name = $_FILES['wphoto']['name'];
                $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
                $filepath = $upload_dir . time().".".$file_ext;
                //Check File Upload
                if(move_uploaded_file($file_tmpname, $filepath)){
                    $update="UPDATE `tbl_ward_member` SET `fullname`='$wfname',`email`='$wemail',`phno`='$wphno',`wardno`='$wwrdno',`validupto`='$wvalidity',`photo`='$filepath' WHERE `wardno`='$wrno'";
                    $updateResult=mysqli_query($conn,$update);
                    header("Location: ../pages/admin/admin_add_wm.php");
                }else{
                    $_SESSION['loginMessage'] = "File upload error";
                    header("Location: ../pages/admin/admin_add_wm.php");
                }
               
            }
        }

        //Update validity for all ward members
        if(isset($_POST['upVal'])){
            if(empty($upvalidity)){
                $_SESSION['loginMessage'] = "Please enter a date";
                header("Location: ../pages/admin/admin_add_wm.php");
            }else{
                $upquery="UPDATE `tbl_ward_member` SET `validupto`='$upvalidity' where `status`='1'";
                $upqueryResult=mysqli_query($conn,$upquery);
                if($upqueryResult){
                    $_SESSION['success'] = "Validity updated successfully";
                    header("Location: ../pages/admin/admin_add_wm.php");
                }else{
                    $_SESSION['loginMessage'] = "Error in updating validity";
                    header("Location: ../pages/admin/admin_add_wm.php");
                }            
            }
        }

        //First time Update profile (House member)
        if(isset($_POST['upbtn'])){
            $insHouse = "INSERT INTO `tbl_house`(`house_name`, `house_no`, `ward_no`, `locality`, `post_office`, `ration_no`, `category`) VALUES ('$hname', '$houno', '$wardno','$locality','$po','$rano','$rationCat')";
            $insHouseRes=mysqli_query($conn,$insHouse);
            if($insHouseRes){
                header("Location: ../pages/house_member/update_house_details.php");
                $_SESSION['loginMessage'] = "House Info Added";
            }else{
                echo '<script language="javascript" type="text/javascript">';
                echo 'alert("Error")';
                echo '</script>';
            }
        }

        //Update House Details (House member)
        if(isset($_POST['uphbtn'])){
            $updateh="UPDATE `tbl_house` SET `house_name`='$hname', `locality`='$locality', `post_office`='$po', `category`='$rationCat' WHERE `ward_no`='$wardno' and `house_no`='$houno'";
            // $insHouse = "INSERT INTO `tbl_house`(`rid`, `house_name`, `house_no`, `ward_no`, `locality`, `post_office`, `ration_no`, `category`) VALUES ('$rid','$hname', '$houno', '$wardno','$locality','$po','$rano','$rationCat')";
            $upHouseRes=mysqli_query($conn,$updateh);
            if($upHouseRes){
                header("Location: ../pages/house_member/update_house_details.php");
                $_SESSION['loginMessage'] = "House Info Updated Successfully";
            }else{
                echo '<script language="javascript" type="text/javascript">';
                echo 'alert("Error")';
                echo '</script>';
            }
        }

        //Add house member
        if(isset($_POST['add-hm'])){
            $houseno= $_SESSION['houseno'];
            $wardno= $_SESSION['wardno'];
            //Photo path upload
            $upload_dir = '../images/uploads/photos/';
            $file_tmpname = $_FILES['hphoto']['tmp_name'];
            $file_name = $_FILES['hphoto']['name'];
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $filepath = $upload_dir . time().".".$file_ext;
            if(empty($hemail)){
               //Check photo upload error
               if(move_uploaded_file($file_tmpname, $filepath)){
                    $insHouseMember="INSERT INTO `tbl_house_member`(`ward_no`, `house_no`, `fname`, `phno`, `blood_grp`, `dob`, `photo`) VALUES ('$wardno','$houseno','$hfname','$hphno','$hblood','$hdob','$filepath')";
                    $insResult=mysqli_query($conn,$insHouseMember);
                    header("Location: ../pages/house_member/add_house_members.php");
                }else{
                    $_SESSION['loginMessage'] = "File upload error";
                    header("Location: ../pages/house_member/add_house_members.php");
                }
            }else{
                if(move_uploaded_file($file_tmpname, $filepath)){

                    // Generate Random Password
                    include '../include/password_generator.php';

                    //Count number of users
                    $count="SELECT * FROM `tbl_house_member` WHERE `house_no`='$houseno'";
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
                            header("Location: ../pages/house_member/add_house_members.php");
                            $_SESSION['success'] = "House member added";
                        }else{
                            $_SESSION['loginMessage'] = "Error in adding member";
                            header("Location: ../pages/house_member/add_house_members.php");
                        }
                    }else{
                        $_SESSION['loginMessage'] = "Error in sending E-mail";
                        header("Location: ../pages/house_member/add_house_members.php");
                    }
                }else{
                    $_SESSION['loginMessage'] = "File upload error";
                    header("Location: ../pages/house_member/add_house_members.php");
                }
            }
        }

        //Reject House register request
        if(isset($_POST['reject_house_req'])){
            $rejId=$_POST['HiddenItemId'];
            $body=$_POST['rej_reason'];
            $query="SELECT * FROM `tbl_registration` WHERE `rid`='$rejId'";
            $result=mysqli_query($conn,$query);
            while($row=mysqli_fetch_array($result)){
                $toMail=$row["email"];
            }
            $subject="E-Ward House Rejection";
            $headers="From: ewardmember@gmail.com";
            if(mail($toMail,$subject,$body,$headers)){
                mysqli_query($conn,"DELETE FROM `tbl_registration` WHERE `rid`='$rejId'");
                header("Location: ../pages/ward_member/houses_request.php");
            }else{
                $_SESSION['loginMessage'] = "Mail not send";
                header("Location: ../pages/ward_member/houses_request.php");
            }
        }

        //Update house member details
        if(isset($_POST['hm-up-btn'])){

            //check empty file 
            //profile photo
            if(empty($_FILES["hmuphoto"]['name'])){
                $filepath=$hm_already_photo;
            }else{
                $upload_dir = '../images/uploads/photos/';
                $file_tmpname = $_FILES['hmuphoto']['tmp_name'];
                $file_name = $_FILES['hmuphoto']['name'];
                $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
                $filepath = $upload_dir . time().".".$file_ext;
                if(move_uploaded_file($file_tmpname, $filepath)){}else{
                    $_SESSION['loginMessage'] = "Error in file upload";
                    header("Location: ../pages/house_member/add_house_members.php");
                }
            }

            //Id proofs
            $upload_dir_doc = '../documents/';
            $file_ext_pdf = ".pdf";
            //Aadhar
            if(empty($_FILES["hmuaadharfile"]['name'])){
                $filepath_aadhar=$hm_already_aadhar;
            }else{
                $file_tmpname_aadhar = $_FILES['hmuaadharfile']['tmp_name'];
                $file_name_aadhar = $_FILES['hmuaadharfile']['name'];
                $filepath_aadhar = $upload_dir_doc . time()."0".".".$file_ext_pdf;
                if(move_uploaded_file($file_tmpname_aadhar, $filepath_aadhar)){}else{
                    $_SESSION['loginMessage'] = "Error in uploading Aadhar";
                    header("Location: ../pages/house_member/add_house_members.php");
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
                    $_SESSION['loginMessage'] = "Error in uploading Election id";
                    header("Location: ../pages/house_member/add_house_members.php");
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
                    $_SESSION['loginMessage'] = "Error in uploading Driving licence";
                    header("Location: ../pages/house_member/add_house_members.php");
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
                    $_SESSION['loginMessage'] = "Error in uploading PAN card";
                    header("Location: ../pages/house_member/add_house_members.php");
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
                    $_SESSION['loginMessage'] = "Error in uploading Birth certificate";
                    header("Location: ../pages/house_member/add_house_members.php");
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
                    $_SESSION['loginMessage'] = "Error in uploading secondary school certificate";
                    header("Location: ../pages/house_member/add_house_members.php");
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
                    $_SESSION['loginMessage'] = "Error in uploading higher secondary certificate";
                    header("Location: ../pages/house_member/add_house_members.php");
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
                    $_SESSION['loginMessage'] = "Error in uploading diploma certificate";
                    header("Location: ../pages/house_member/add_house_members.php");
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
                    $_SESSION['loginMessage'] = "Error in uploading under graduation certificate";
                    header("Location: ../pages/house_member/add_house_members.php");
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
                    $_SESSION['loginMessage'] = "Error in uploading post graduation certificate";
                    header("Location: ../pages/house_member/add_house_members.php");
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
                    $_SESSION['loginMessage'] = "Error in uploading profession certificate";
                    header("Location: ../pages/house_member/add_house_members.php");
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
                header("Location: ../pages/house_member/add_house_members.php");
            }else{
                $_SESSION['loginMessage'] = "Error in updatation";
                header("Location: ../pages/house_member/add_house_members.php");
            }
        }

        //Ward member - Houses page search
        if(isset($_POST['item'])){
            $input=$_POST['item'];
            $wardno=$_POST['wardno'];
            $searchQuery="SELECT * FROM `tbl_house` WHERE (house_name LIKE '{$input}%' OR house_no LIKE '{$input}%' OR locality LIKE '{$input}%' OR post_office LIKE '{$input}%' OR ration_no LIKE '{$input}%' OR category LIKE '{$input}%') AND ward_no='$wardno'";
            $searchResult=mysqli_query($conn,$searchQuery);
            
            if(mysqli_num_rows($searchResult)>0){
                $i=1;
                while($row=mysqli_fetch_array($searchResult)){
                ?>
                    <div class="data">
                        <table>
                            <tr>
                                <td width=104px><?php echo $i; ?></td>
                                <td width=238px><?php echo $row['house_name']; ?></td>
                                <td width=180px><?php echo $row['house_no']; ?></td>
                                <td width=160px>4</td>
                                <td width=176px><?php echo $row['locality']; ?></td>
                                <td width=208px><?php echo $row['post_office']; ?></td>
                                <td width=240px><?php echo $row['ration_no']; ?></td>
                                <td><?php echo $row['category']; ?></td>
                            </tr>
                        </table>
                    </div>

            <?php
            $i=$i+1;
                }
            }else{
                echo '<b> No result found</b>';
            }
        }

        // ---------Forgot password-----------
        if(isset($_POST['toLoginPage'])){
            header("Location: ../pages/login.php");
        }
        
        // Check user id exist or not
        if(isset($_POST['userId'])){
            $uidchk="SELECT * FROM `tbl_house_member` WHERE `userid`='$userId'";
            $uidchkres = mysqli_query($conn, $uidchk);
            if(mysqli_num_rows($uidchkres)<1)
            {
                 // Toast should appear
                 echo  '<div class="alertt alert-visible">
                            <div class="econtent">
                                <img src="../images/warning.svg" alt="warning">
                                <div class="text">
                                    User id does not exist
                                </div>
                            </div>
                        </div>';
            }else{
                return 0;
            }
        }

        //Send otp
        if(isset($_POST['fpContinue'])){
            $fetchMailQ="SELECT * FROM `tbl_house_member` WHERE `userid`='$ftpUserId'";
            $fetchMailQRes = mysqli_query($conn, $fetchMailQ);
            while($row=mysqli_fetch_array($fetchMailQRes)){
                $email=$row['email'];
                $fname=$row['fname'];
            }

            //Session
            $_SESSION['fp-email']=$email;
            $_SESSION['fp-uid']=$ftpUserId;

            //Generate otp
            $length=5;
            $generatedOtp='';
            $validChar='0123456789';
            while(0<$length--){
                $generatedOtp.=$validChar[random_int(0,strlen($validChar)-1)];
            }

            $subject="E-Ward OTP";
            $body="Dear $fname, your one time password is: $generatedOtp";
            $headers="From: ewardmember@gmail.com";

            if(mail($email,$subject,$body,$headers)){
                $otpQuery="INSERT INTO `tbl_forgot_password`(`userid`, `otp`) VALUES ('$ftpUserId','$generatedOtp')";
                mysqli_query($conn, $otpQuery);
                header("Location: ../pages/verify_otp.php");
            }else{
                $_SESSION['errorMessage'] = "Error in sending E-mail";
                header("Location: ../pages/forgot_password.php");
            }
        }

        // Back to user id section
        if(isset($_POST['touid'])){
            $ftpUserId=$_SESSION['fp-uid'];
            $deleteQuery="DELETE FROM `tbl_forgot_password` WHERE `userid`='$ftpUserId'";
            mysqli_query($conn, $deleteQuery);
            unset($_SESSION['fp-email']);
            unset($_SESSION['fp-uid']);
            header("Location: ../pages/forgot_password.php");
        }

        //Check OTP
        if(isset($_POST['fpContinueOtp'])){
            $ftpUserId=$_SESSION['fp-uid'];
            $fetchOtp="SELECT `otp` FROM `tbl_forgot_password` WHERE `userid`='$ftpUserId' AND `otp`='$fpotp'";
            $fetchOtpRes=mysqli_query($conn, $fetchOtp);
            if(mysqli_num_rows($fetchOtpRes)>=1){
                header("Location: ../pages/new_password.php");
            }else{
                $_SESSION['errorMessage'] = "Invalid OTP";
                header("Location: ../pages/verify_otp.php");
            }
        }

        //New password
        if(isset($_POST['fpConNewPass'])){
            $ftpUserId=$_SESSION['fp-uid'];
            $updateQuery="UPDATE `tbl_house_member` SET `password`='$fpNewPass' WHERE `userid`='$ftpUserId'";
            if(mysqli_query($conn, $updateQuery)){
                $deleteQuery="DELETE FROM `tbl_forgot_password` WHERE `userid`='$ftpUserId'";
                mysqli_query($conn, $deleteQuery);
                unset($_SESSION['fp-email']);
                unset($_SESSION['fp-uid']);
                $_SESSION['success'] = "Password changed successfully";
                header("Location: ../pages/login.php");
            }else{
                $deleteQuery="DELETE FROM `tbl_forgot_password` WHERE `userid`='$ftpUserId'";
                mysqli_query($conn, $deleteQuery);
                unset($_SESSION['fp-email']);
                unset($_SESSION['fp-uid']);
                $_SESSION['loginMessage'] = "Please try again";
                header("Location: ../pages/login.php");
            }
        }
        // ---------End of forgot password-----------
    ?>