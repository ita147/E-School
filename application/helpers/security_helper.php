<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

 

function encrypt_url($string) {
    $output = false;
    $secret_key = 'BarBarTEAM312Logic';
    $secret_iv = '9386759462068594';
    $encrypt_method = 'aes-256-cbc';
    // hash
    $key = hash('sha256', $secret_key);
    // iv – encrypt method AES-256-CBC expects 16 bytes – else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    //do the encryption given text/string/number
    $result = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
    $output = base64_encode($result);
    return $output;
}

 

function decrypt_url($string) {

    $output = false;
    $secret_key = 'BarBarTEAM312Logic';
    $secret_iv = '9386759462068594';
    $encrypt_method = 'aes-256-cbc';
    // hash
    $key = hash('sha256', $secret_key);
    // iv – encrypt method AES-256-CBC expects 16 bytes – else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    //do the decryption given text/string/number
    $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    return $output;
}