<?php
    include '../../config/dbcon.php';
    session_start();
    extract($_POST);

    require('../../../public/assets/libraries/mpdf/vendor/autoload.php');

?>