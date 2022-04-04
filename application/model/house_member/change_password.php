<?php
    include '../../config/dbcon.php';
    session_start();
    extract($_POST);

    // Check current password
    if(isset($_POST['curPass'])){
        $curpasschk="SELECT `password` FROM `tbl_house_member` WHERE `userid`='$userId' AND `password`='$curPass'";
        $curpasschkres = mysqli_query($conn, $curpasschk);
        if(mysqli_num_rows($curpasschkres)<1)
        {
             // Toast should appear
             echo  '<div class="alertt alert-visible">
                        <div class="econtent">
                            <img src="../../../../public/assets/images/warning.svg" alt="warning">
                            <div class="text">
                                Incorrent password
                            </div>
                        </div>
                    </div>';
        }else{
            return 0;
        }
    }
?>