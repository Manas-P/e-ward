<?php
    include '../../config/dbcon.php';
    session_start();
    extract($_POST);

    //Check wardno exisit
    if(isset($_POST['wardNo']))
    {
        $chkWard = "SELECT `wardno` FROM `tbl_ward_member` WHERE wardno='$wardNo'";
        $resChk = mysqli_query($conn, $chkWard);
        if(mysqli_num_rows($resChk)>0)
        {
             // Toast should appear
             echo  '<div class="alertt alert-visible">
                        <div class="econtent">
                            <img src="../../../../public/assets/images/warning.svg" alt="warning">
                            <div class="text">
                                Ward member already registered
                            </div>
                        </div>
                    </div>';
        }
    }

    //Add ward member
    if(isset($_POST['add-wm'])){

        //Input sanitization
        $wfname = trim($wfname); 
        $wfname=mysqli_real_escape_string($conn,$wfname);
        $wfname=filter_var($wfname, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

        $wemail = trim($wemail);
        $wemail=mysqli_real_escape_string($conn,$wemail);
        $wemail=filter_var($wemail, FILTER_SANITIZE_EMAIL, FILTER_FLAG_STRIP_HIGH);

        $wphno = trim($wphno);
        $wphno=mysqli_real_escape_string($conn,$wphno);
        $wphno=filter_var($wphno, FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);

        $wwrdno = trim($wwrdno);
        $wwrdno=mysqli_real_escape_string($conn,$wwrdno);
        $wwrdno=filter_var($wwrdno, FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);

        //Upload photo
        $upload_dir = '../../../public/assets/images/uploads/photos/';
        $file_tmpname = $_FILES['wphoto']['tmp_name'];
        $file_name = $_FILES['wphoto']['name'];
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $filepath = $upload_dir . time().".".$file_ext;
        
        //Check File Upload
        if(move_uploaded_file($file_tmpname, $filepath)){
            
            // Generate Random Password
            include '../passwordGenerator.php';

            $subject="E-Ward Approved";
            $body="Dear $wfname, you have been added as Ward member. You can login to E-Ward using Id = $wwrdno and Password = $generatedPassword";
            $headers="From: ewardmember@gmail.com";

            if(mail($wemail,$subject,$body,$headers)){

                $insMember="INSERT INTO `tbl_ward_member`(`fullname`, `email`, `phno`, `wardno`, `validupto`, `photo`, `password`) VALUES ('$wfname','$wemail','$wphno','$wwrdno','$wvalidity','$filepath','$generatedPassword')";
                $insMemberRes=mysqli_query($conn,$insMember);
                if($insMemberRes){
                    $_SESSION['sucess'] = "Ward member added successfully";
                    header("Location: ../../view/pages/admin/admin_add_wm.php");
                }else{
                    $_SESSION['error'] = "Error in adding ward member";
                    header("Location: ../../view/pages/admin/admin_add_wm.php");
                }

            }else{
                $_SESSION['error'] = "Mail not send";
                header("Location: ../../view/pages/admin/admin_add_wm.php");
            }
        }else{
            $_SESSION['error'] = "File upload error";
            header("Location: ../../view/pages/admin/admin_add_wm.php");
        }
    }
?>