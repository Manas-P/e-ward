<?php
    include '../../config/dbcon.php';
    session_start();

    $name=$_GET['name'];
    $date=date('d-m-Y');

    header('content-type:image/jpeg');
    $fontSB=dirname(__FILE__) . "./Montserrat-SemiBold.ttf";
    $image=imagecreatefromjpeg("../../../public/assets/images/certificate_template.jpg");
    $colorName=imagecolorallocate($image, 30, 30, 30); //color in rgb
    imagettftext($image, 28, 0, 460, 446, $colorName, $fontSB, $name); //image, font size, orientation, x-axis, y-axis, color, font, text
    
    $fontM=dirname(__FILE__) . "./Montserrat-Medium.ttf";
    $colorDate=imagecolorallocate($image, 84, 84, 84);
    imagettftext($image, 16, 0, 340, 680, $colorDate, $fontM, $date);

    imagejpeg($image);
    imagedestroy($image);
?>
