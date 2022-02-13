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
            // $password=$password;
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
                        $insHouseMember="INSERT INTO `tbl_house_member`(`ward_no`, `house_no`, `fname`,`email`, `phno`, `blood_grp`, `dob`, `photo`, `userid`, `password`) VALUES ('$wardno','$houseno','$hfname','$hemail','$hphno','$hblood','$hdob','$filepath','$userid','$generatedPassword') ; INSERT INTO `tbl_id_proof`(`userid`) VALUES ('$userid')";
                        $insResult=mysqli_multi_query($conn,$insHouseMember);
                        if($insResult){
                            header("Location: ../pages/house_member/add_house_members.php");
                            $_SESSION['success'] = "House member added";
                        }else{
                            $_SESSION['loginMessage'] = "Error in adding member";
                        }
                    }else{
                        $_SESSION['loginMessage'] = "Error in sending E-mail";
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
            }
        }

        //Update house member details
        if(isset($_POST['hm-up-btn'])){
            //check profile photo added or not
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
            //Check empty field
            if(empty($hmuemail)){
                $hmuemail="Not entered";
            }
            if(empty($hmublood)){
                $hmublood="NA";
            }
            $updatehmQuery="UPDATE `tbl_house_member` SET `fname`='$hmufname',`email`='$hmuemail',`phno`='$hmuphno',`blood_grp`='$hmublood',`dob`='$hmudob',`photo`='$filepath' WHERE `userid`='$hm_id'";
            $updatehmResult=mysqli_query($conn,$updatehmQuery);
            if($updatehmResult){
                $_SESSION['success'] = "Update successfull";
                header("Location: ../pages/house_member/add_house_members.php");
            }else{
                $_SESSION['loginMessage'] = "Error in updatation";
                header("Location: ../pages/house_member/add_house_members.php");
            }
        }
    ?>