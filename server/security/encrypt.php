<?php

function encrypt($key)
{
    $ciphering = "123456789";
    $encryption_key = "123456789";
    $options = 0;
    $encryption_iv = '123456789';
    
    $key = $key . "@" . strtotime("+60 seconds");

    $encryption = openssl_encrypt(
        $key,
        $ciphering,
        $encryption_key,
        $options,
        $encryption_iv
    );

    return urlencode($encryption);
}
