<?php
    include '../../config/dbcon.php';
    session_start();

    // header('content-type:image/jpeg');
    $fontSB="../../../public/assets/fonts/certificate/Montserrat-SemiBold.ttf";
    $image=imagecreatefromjpeg("../../../public/assets/images/certificate_template.jpg");
    $colorName=imagecolorallocate($image, 30, 30, 30); //color in rgb
    $name="Appy Kurian";
    imagettftext($image, 20, 0, 360, 308, $colorName, $fontSB, $name); //image, font size, orientation, x-axis, y-axis, color, font, text
    imagejepg($image);

    imagedestroy($image);
?>