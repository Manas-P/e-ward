<?php
    include '../../config/dbcon.php';
    session_start();
    extract($_POST);

    $wardno=$_SESSION['wardno'];
    if(isset($_POST['add-sl'])){

        $checkboxes=$_POST['houseno'];
        echo $checkboxes;
        $houses="";
        foreach($checkboxes as $houseno)  
        {  
            $houses .= $houseno.", ";
            $updateQuery="UPDATE `tbl_house` SET `street_light`='1',`street_light_status`='1',`post_no`='$strltno' WHERE `ward_no`='$wardno' AND `house_no`='$houseno'";
            mysqli_query($conn,$updateQuery);
        }  
        $insertQuery="INSERT INTO `tbl_street_light`(`street_light_no`, `locality`, `ward_no`, `houseno`) VALUES ('$strltno','$slLocality','$wardno','$houses')";
        $queryResult=mysqli_query($conn,$insertQuery);
        if($queryResult){
            $_SESSION['success'] = "Street light added successfully";
            header("Location: ../../view/pages/ward_member/street_light.php");
        }else{
            $_SESSION['error'] = "Error in adding street light";
            header("Location: ../../view/pages/ward_member/street_light.php");
        }
    }
?>
