<?php

function decrypt($key)
{
    $ciphering = "123456789";
    $decryption_key = "123456789";
    $options = 0;
    $decryption_iv = '123456789';

    $key = urldecode($key);

    $decryption = openssl_decrypt(
        $key,
        $ciphering,
        $decryption_key,
        $options,
        $decryption_iv
    );

    $time = explode("@", $decryption)[1];

    if (time() > $time) {
        return $time;
    } else {
        return true;
    }
}
