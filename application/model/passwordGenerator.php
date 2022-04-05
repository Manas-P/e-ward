<?php
    $length=8;
    $generatedPassword='';
    $validChar='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    while(0<$length--){
        $generatedPassword.=$validChar[random_int(0,strlen($validChar)-1)];
    }
?>