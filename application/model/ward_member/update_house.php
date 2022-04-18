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
                $updateQuery="UPDATE `tbl_house` SET `house_name`='$hname',`locality`='$hlocality',`post_office`='$hpost',`ration_no`='$hration' WHERE `house_no`='$houseno'";
                $updateHouseResult=mysqli_query($conn,$updateQuery);
                if($updateHouseResult){
                    $_SESSION['success'] = "House details updated successfully";
                    header("Location: ../../view/pages/ward_member/view_house.php?houseno=$houseno");
                }else{
                    $_SESSION['error'] = "Error in updating house details";
                    header("Location: ../../view/pages/ward_member/view_house.php?houseno=$houseno");
                }
            }else{
                $_SESSION['error'] = "Error in sending mail";
                header("Location: ../../view/pages/ward_member/view_house.php?houseno=$houseno");
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
                $multipleQuery="UPDATE `tbl_house` SET `house_name`='$hname',`locality`='$hlocality',`post_office`='$hpost',`ration_no`='$hration' WHERE `house_no`='$houseno' ;
                                UPDATE `tbl_house_member` SET `userid`='$newOwnerId' WHERE `hm_id`='$curOwnerTableId' ;
                                UPDATE `tbl_house_member` SET `userid`='$curOwnerId' WHERE `hm_id`='$newOwnerTableId'";
                $multipleQueryResult=mysqli_multi_query($conn,$multipleQuery);
                if($multipleQueryResult){
                    $_SESSION['success'] = "House details updated successfully";
                    header("Location: ../../view/pages/ward_member/view_house.php?houseno=$houseno");
                }else{
                    $_SESSION['error'] = "Error in updating house details";
                    header("Location: ../../view/pages/ward_member/view_house.php?houseno=$houseno");
                }
            }else{
                $_SESSION['error'] = "Error in sending mail";
                header("Location: ../../view/pages/ward_member/view_house.php?houseno=$houseno");
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

        //Send mail
        $subject="E-Ward House Deletion";
        $headers="From: ewardmember@gmail.com";
        if(mail($toMail,$subject,$body,$headers)){
            $deleteQuery="DELETE FROM `tbl_house` WHERE `ward_no`='$wardno' and `house_no`='$housenodel' ;
                          DELETE FROM `tbl_house_member` WHERE `ward_no`='$wardno' and `house_no`='$housenodel'";
            $deleteQueryResult=mysqli_multi_query($conn,$deleteQuery);
            if($deleteQueryResult){
                $_SESSION['success'] = "House deleted successfully";
                header("Location: ../../view/pages/ward_member/houses.php");
            }else{
                $_SESSION['error'] = "Error in deleting house";
                header("Location: ../../view/pages/ward_member/view_house.php?houseno=$housenodel");
            }
        }else{
            $_SESSION['error'] = "Error in sending mail";
            header("Location: ../../view/pages/ward_member/view_house.php?houseno=$housenodel");
        }
    }
?>