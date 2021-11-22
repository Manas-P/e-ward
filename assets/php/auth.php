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
            $ins="INSERT INTO `tbl_registration`(`fname`, `email`, `phno`, `wardno`, `houseno`, `rationno`) VALUES ('$fname','$email','$phno','$wrdno','$houno','$rano')";
            $ins_res=mysqli_query($conn,$ins);
            if($ins_res){
                header("Location: ../pages/login.php");
            }else{
                echo '<script language="javascript" type="text/javascript">';
				echo 'alert("Error")';
				echo '</script>';
            }
        }


        //login 
        if(isset($_POST['userName']) && isset($_POST['password']) && isset($_POST['submitButton']))
        {
            // $password=$password;
            //Check if mobile already exisit
            $checkLogin = "SELECT * FROM `tbl_registration` WHERE `houseno`='$userName' and `password`='$password' and `status`=1";
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
                $_SESSION['rid'] = $userData['rid'];
                header("Location: ../pages/dashboard.php");
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
                header("Location: ../pages/wardmember.php");
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
                $length=8;
                $generatedPassword='';
                $validChar='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                while(0<$length--){
                    $generatedPassword.=$validChar[random_int(0,strlen($validChar)-1)];
                }

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
    ?>
