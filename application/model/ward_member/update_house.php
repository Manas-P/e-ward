<?php
    include '../../config/dbcon.php';
    session_start();
    extract($_POST);

    //Update house details
    if(isset($_POST['up-h'])){
        $curOwnerId=$wardno . $houseno . "0";
        
        $fetchOwner="SELECT `hm_id`,`email`,`fname` FROM `tbl_house_member` WHERE `userid`='$curOwnerId'";
        $fetchOwnerResult=mysqli_query($conn,$fetchOwner);
        $ownerData=mysqli_fetch_assoc($fetchOwnerResult);
        $curOwnerEmail=$ownerData['email'];
        $curOwnerName=$ownerData['fname'];
        $curOwnerTableId=$ownerData['hm_id'];

        //Check if the action is done by office staff
        $officeId=$_SESSION['userid'];
        //Fetch staff details
        if($officeId!=""){
            $officeStaff="SELECT `name` FROM `tbl_office_staff` WHERE `userid`='$officeId'";
            $officeStaffResult=mysqli_query($conn,$officeStaff);
            $dataFetched=mysqli_fetch_assoc($officeStaffResult);
            $sName=$dataFetched['name'];
            $activity="Updated house having house number: $houseno";
            date_default_timezone_set('Asia/Kolkata');
            $date_time = date("Y-m-d H:i:s", time ());
        }

        //Input Sanitization
        $hname = trim($hname); 
        $hname=mysqli_real_escape_string($conn,$hname);
        $hname=filter_var($hname, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

        $hlocality = trim($hlocality); 
        $hlocality=mysqli_real_escape_string($conn,$hlocality);
        $hlocality=filter_var($hlocality, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

        $hpost = trim($hpost); 
        $hpost=mysqli_real_escape_string($conn,$hpost);
        $hpost=filter_var($hpost, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

        $hration = trim($hration);
        $hration=mysqli_real_escape_string($conn,$hration);
        $hration=filter_var($hration, FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);

        if($curOwnerId==$newOwnerId){
            //Send mail
            $subject="E-Ward, House details updated";
            $body="Dear $curOwnerName, your house datails have been updated by administrator";
            $headers="From: ewardmember@gmail.com";

            //Check mail send
            if(mail($curOwnerEmail,$subject,$body,$headers)){
                //Check if the action is done by office staff
                if($officeId!=""){
                    $updateQuery="UPDATE `tbl_house` SET `house_name`='$hname',`locality`='$hlocality',`post_office`='$hpost',`ration_no`='$hration' WHERE `house_no`='$houseno' ; 
                                  INSERT INTO `tbl_staff_activity`(`userid`, `name`, `activity`, `date_time`) VALUES ('$officeId','$sName','$activity','$date_time')";
                    $updateHouseResult=mysqli_multi_query($conn,$updateQuery);
                    if($updateHouseResult){
                        $_SESSION['success'] = "House details updated successfully";
                        echo "<script>window.location='../../view/pages/office_staff/view_house.php?houseno=".$houseno."'</script>";
                        // header("Location: ../../view/pages/office_staff/view_house.php?houseno=$houseno");
                    }else{
                        $_SESSION['error'] = "Error in updating house details";
                        echo "<script>window.location='../../view/pages/office_staff/view_house.php?houseno=".$houseno."'</script>";
                        // header("Location: ../../view/pages/office_staff/view_house.php?houseno=$houseno");
                    }
                }else{
                    $updateQuery="UPDATE `tbl_house` SET `house_name`='$hname',`locality`='$hlocality',`post_office`='$hpost',`ration_no`='$hration' WHERE `house_no`='$houseno'";
                    $updateHouseResult=mysqli_query($conn,$updateQuery);
                    if($updateHouseResult){
                        $_SESSION['success'] = "House details updated successfully";
                        echo "<script>window.location='../../view/pages/ward_member/view_house.php?houseno=".$houseno."'</script>";
                        // header("Location: ../../view/pages/ward_member/view_house.php?houseno=$houseno");
                    }else{
                        $_SESSION['error'] = "Error in updating house details";
                        echo "<script>window.location='../../view/pages/ward_member/view_house.php?houseno=".$houseno."'</script>";
                        // header("Location: ../../view/pages/ward_member/view_house.php?houseno=$houseno");
                    }
                }
            }else{
                if($officeId!=""){
                    $_SESSION['error'] = "Error in sending mail";
                    echo "<script>window.location='../../view/pages/office_staff/view_house.php?houseno=".$houseno."'</script>";
                    // header("Location: ../../view/pages/office_staff/view_house.php?houseno=$houseno");
                }else{
                    $_SESSION['error'] = "Error in sending mail";
                    echo "<script>window.location='../../view/pages/ward_member/view_house.php?houseno=".$houseno."'</script>";
                    // header("Location: ../../view/pages/ward_member/view_house.php?houseno=$houseno");
                }
            }
        }else{
            //Fetch new owner details
            $fetchNewOwner="SELECT `hm_id`,`email`,`fname` FROM `tbl_house_member` WHERE `userid`='$newOwnerId'";
            $fetchNewOwnerResult=mysqli_query($conn,$fetchNewOwner);
            $newOwnerData=mysqli_fetch_assoc($fetchNewOwnerResult);
            $newOwnerEmail=$newOwnerData['email'];
            $newOwnerName=$newOwnerData['fname'];
            $newOwnerTableId=$newOwnerData['hm_id'];

            //Send to new owner
            $subject1="E-Ward, House details updated";
            $body1="Dear $newOwnerName, as per request you are now the admin of the house. You can login to E-Ward using the id $curOwnerId";
            $headers1="From: ewardmember@gmail.com";

            //Send to current owner
            $subject2="E-Ward, House details updated";
            $body2="Dear $curOwnerName, your admin rights have been transfered to other house member as per request. You can login to E-Ward using the id $newOwnerId";
            $headers2="From: ewardmember@gmail.com";

            //Check mail send
            if(mail($newOwnerEmail,$subject1,$body1,$headers1) && mail($curOwnerEmail,$subject2,$body2,$headers2)){
                //Check if the action is done by office staff
                if($officeId!=""){
                    $activity="Updated house having house number: $houseno and changed ownership to $newOwnerName from $curOwnerName";
                    $multipleQuery="UPDATE `tbl_house` SET `house_name`='$hname',`locality`='$hlocality',`post_office`='$hpost',`ration_no`='$hration' WHERE `house_no`='$houseno' ;
                                    UPDATE `tbl_house_member` SET `userid`='$newOwnerId' WHERE `hm_id`='$curOwnerTableId' ;
                                    UPDATE `tbl_house_member` SET `userid`='$curOwnerId' WHERE `hm_id`='$newOwnerTableId' ; 
                                    INSERT INTO `tbl_staff_activity`(`userid`, `name`, `activity`, `date_time`) VALUES ('$officeId','$sName','$activity','$date_time')";
                    $multipleQueryResult=mysqli_multi_query($conn,$multipleQuery);
                    if($multipleQueryResult){
                        $_SESSION['success'] = "House details updated successfully";
                        echo "<script>window.location='../../view/pages/office_staff/view_house.php?houseno=".$houseno."'</script>";
                        // header("Location: ../../view/pages/office_staff/view_house.php?houseno=$houseno");
                    }else{
                        $_SESSION['error'] = "Error in updating house details";
                        echo "<script>window.location='../../view/pages/office_staff/view_house.php?houseno=".$houseno."'</script>";
                        // header("Location: ../../view/pages/office_staff/view_house.php?houseno=$houseno");
                    }
                }else{
                    $multipleQuery="UPDATE `tbl_house` SET `house_name`='$hname',`locality`='$hlocality',`post_office`='$hpost',`ration_no`='$hration' WHERE `house_no`='$houseno' ;
                                    UPDATE `tbl_house_member` SET `userid`='$newOwnerId' WHERE `hm_id`='$curOwnerTableId' ;
                                    UPDATE `tbl_house_member` SET `userid`='$curOwnerId' WHERE `hm_id`='$newOwnerTableId'";
                    $multipleQueryResult=mysqli_multi_query($conn,$multipleQuery);
                    if($multipleQueryResult){
                        $_SESSION['success'] = "House details updated successfully";
                        echo "<script>window.location='../../view/pages/ward_member/view_house.php?houseno=".$houseno."'</script>";
                        // header("Location: ../../view/pages/ward_member/view_house.php?houseno=$houseno");
                    }else{
                        $_SESSION['error'] = "Error in updating house details";
                        echo "<script>window.location='../../view/pages/ward_member/view_house.php?houseno=".$houseno."'</script>";
                        // header("Location: ../../view/pages/ward_member/view_house.php?houseno=$houseno");
                    }
                }
            }else{
                if($officeId!=""){
                    $_SESSION['error'] = "Error in sending mail";
                    echo "<script>window.location='../../view/pages/office_staff/view_house.php?houseno=".$houseno."'</script>";
                    // header("Location: ../../view/pages/office_staff/view_house.php?houseno=$houseno");
                }else{
                    $_SESSION['error'] = "Error in sending mail";
                    echo "<script>window.location='../../view/pages/ward_member/view_house.php?houseno=".$houseno."'</script>";
                    // header("Location: ../../view/pages/ward_member/view_house.php?houseno=$houseno");
                }
            }
        }
    }

    //Delete house
    if(isset($_POST['deleteHouseBtn'])){

        //Input Sanitization
        $hdel_reason = trim($hdel_reason); 
        $hdel_reason=mysqli_real_escape_string($conn,$hdel_reason);
        $hdel_reason=filter_var($hdel_reason, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

        $wardno=$_SESSION['wardno'];
        $body=$hdel_reason;
        $query="SELECT `email` FROM `tbl_house_member` WHERE `userid`='$hownerdel'";
        $result=mysqli_query($conn,$query);
        $userData=mysqli_fetch_assoc($result);
        $toMail=$userData["email"];

        //Check if the action is done by office staff
        $officeId=$_SESSION['userid'];
        //Fetch staff details
        if($officeId!=""){
            $officeStaff="SELECT `name` FROM `tbl_office_staff` WHERE `userid`='$officeId'";
            $officeStaffResult=mysqli_query($conn,$officeStaff);
            $dataFetched=mysqli_fetch_assoc($officeStaffResult);
            $sName=$dataFetched['name'];
            $activity="Deleted house having house number: $housenodel with reason: $body";
            date_default_timezone_set('Asia/Kolkata');
            $date_time = date("Y-m-d H:i:s", time ());
        }

        //Send mail
        $subject="E-Ward House Deletion";
        $headers="From: ewardmember@gmail.com";
        if(mail($toMail,$subject,$body,$headers)){
            //Check if the action is done by office staff
            if($officeId!=""){
                $deleteQuery="DELETE FROM `tbl_house` WHERE `ward_no`='$wardno' and `house_no`='$housenodel' ;
                            DELETE FROM `tbl_house_member` WHERE `ward_no`='$wardno' and `house_no`='$housenodel' ;
                            INSERT INTO `tbl_staff_activity`(`userid`, `name`, `activity`, `date_time`) VALUES ('$officeId','$sName','$activity','$date_time')";
                $deleteQueryResult=mysqli_multi_query($conn,$deleteQuery);
                if($deleteQueryResult){
                    $_SESSION['success'] = "House deleted successfully";
                    echo "<script>window.location='../../view/pages/office_staff/houses.php'</script>";
                    // header("Location: ../../view/pages/office_staff/houses.php");
                }else{
                    $_SESSION['error'] = "Error in deleting house";
                    echo "<script>window.location='../../view/pages/office_staff/view_house.php?houseno=".$housenodel."'</script>";
                    // header("Location: ../../view/pages/office_staff/view_house.php?houseno=$housenodel");
                }
            }else{
                $deleteQuery="DELETE FROM `tbl_house` WHERE `ward_no`='$wardno' and `house_no`='$housenodel' ;
                            DELETE FROM `tbl_house_member` WHERE `ward_no`='$wardno' and `house_no`='$housenodel'";
                $deleteQueryResult=mysqli_multi_query($conn,$deleteQuery);
                if($deleteQueryResult){
                    $_SESSION['success'] = "House deleted successfully";
                    echo "<script>window.location='../../view/pages/ward_member/houses.php'</script>";
                    // header("Location: ../../view/pages/ward_member/houses.php");
                }else{
                    $_SESSION['error'] = "Error in deleting house";
                    echo "<script>window.location='../../view/pages/ward_member/view_house.php?houseno=".$housenodel."'</script>";
                    // header("Location: ../../view/pages/ward_member/view_house.php?houseno=$housenodel");
                }
            }
        }else{
            if($officeId!=""){
                $_SESSION['error'] = "Error in sending mail";
                echo "<script>window.location='../../view/pages/office_staff/view_house.php?houseno=".$housenodel."'</script>";
                // header("Location: ../../view/pages/office_staff/view_house.php?houseno=$housenodel");
            }else{
                $_SESSION['error'] = "Error in sending mail";
                echo "<script>window.location='../../view/pages/ward_member/view_house.php?houseno=".$housenodel."'</script>";
                // header("Location: ../../view/pages/ward_member/view_house.php?houseno=$housenodel");
            }
        }
    }

    //Delete house member
    if(isset($_POST['deleteMemberBtn'])){
        $memberId=$HiddenItemId;
        echo $memberId;
        $fetchEmail="SELECT `email` FROM `tbl_house_member` WHERE `userid`='$memberId'";
        $fetchEmailResult=mysqli_query($conn,$fetchEmail);
        $userData=mysqli_fetch_assoc($fetchEmailResult);
        $toMail=$userData["email"];
        $body=$mdel_reason;

        //Check if the action is done by office staff
        $officeId=$_SESSION['userid'];
        //Fetch staff details
        if($officeId!=""){
            $officeStaff="SELECT `name` FROM `tbl_office_staff` WHERE `userid`='$officeId'";
            $officeStaffResult=mysqli_query($conn,$officeStaff);
            $dataFetched=mysqli_fetch_assoc($officeStaffResult);
            $sName=$dataFetched['name'];
            $activity="Deleted house member having user id: $memberId and house number: $housenodel with reason: $body";
            date_default_timezone_set('Asia/Kolkata');
            $date_time = date("Y-m-d H:i:s", time ());
        }

        //Send mail
        $subject="E-Ward House Member Deletion";
        $headers="From: ewardmember@gmail.com";
        if(mail($toMail,$subject,$body,$headers)){
            //Check if the action is done by office staff
            if($officeId!=""){
                $deleteQuery="DELETE FROM `tbl_house_member` WHERE `userid`='$memberId' ;
                            INSERT INTO `tbl_staff_activity`(`userid`, `name`, `activity`, `date_time`) VALUES ('$officeId','$sName','$activity','$date_time')";
                $deleteQueryResult=mysqli_multi_query($conn,$deleteQuery);
                if($deleteQueryResult){
                    $_SESSION['success'] = "Member deleted successfully";
                    echo "<script>window.location='../../view/pages/office_staff/view_house.php?houseno=".$housenodel."'</script>";
                    // header("Location: ../../view/pages/office_staff/view_house.php?houseno=$housenodel");
                }else{
                    $_SESSION['error'] = "Error in deleting member";
                    echo "<script>window.location='../../view/pages/office_staff/view_house.php?houseno=".$housenodel."'</script>";
                    // header("Location: ../../view/pages/office_staff/view_house.php?houseno=$housenodel");
                }
            }else{
                $deleteQuery="DELETE FROM `tbl_house_member` WHERE `userid`='$memberId'";
                $deleteQueryResult=mysqli_query($conn,$deleteQuery);
                if($deleteQueryResult){
                    $_SESSION['success'] = "Member deleted successfully";
                    echo "<script>window.location='../../view/pages/ward_member/view_house.php?houseno=".$housenodel."'</script>";
                    // header("Location: ../../view/pages/ward_member/view_house.php?houseno=$housenodel");
                }else{
                    $_SESSION['error'] = "Error in deleting member";
                    echo "<script>window.location='../../view/pages/ward_member/view_house.php?houseno=".$housenodel."'</script>";
                    // header("Location: ../../view/pages/ward_member/view_house.php?houseno=$housenodel");
                }
            }
        }else{
            if($officeId!=""){
                $_SESSION['error'] = "Error in sending mail";
                echo "<script>window.location='../../view/pages/office_staff/view_house.php?houseno=".$housenodel."'</script>";
                // header("Location: ../../view/pages/office_staff/view_house.php?houseno=$housenodel");
            }else{
                $_SESSION['error'] = "Error in sending mail";
                echo "<script>window.location='../../view/pages/ward_member/view_house.php?houseno=".$housenodel."'</script>";
                // header("Location: ../../view/pages/ward_member/view_house.php?houseno=$housenodel");
            }
        }
    }
?>