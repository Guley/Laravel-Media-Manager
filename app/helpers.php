<?php
function dateformat($datetime, $type = 'date') {
    if($type == 'datetime'){
        return !empty($datetime) ? date('j F Y H:i', strtotime($datetime)) : '';
    }else if($type == 'datetime1'){
        return !empty($datetime) ? date('Y-m-d H:i:s', strtotime($datetime)) : '';
    }else if($type == 'time'){
        return !empty($datetime) ? date('H:i', strtotime($datetime)) : '';
    } else {
        return !empty($datetime) ? date('d M Y', strtotime($datetime)) : '';
    }
}

function dateformat_db($datetime = '', $type = 'date') {
    if($type == 'datetime'){
        return !empty($datetime) ? date('Y-m-d H:i:s', strtotime($datetime)) : '';
    } else if($type == 'time'){
        return !empty($datetime) ? date('H:i:s', strtotime($datetime)) : '';
    } else {
        return !empty($datetime) ? date('Y-m-d', strtotime($datetime)) : '';
    }
}
function validateDate($date, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}
function pr($str){
    echo '<pre>';
    print_r($str);
    echo '</pre>';
}
 function remove_special_char($string){
   return preg_replace("/[^ \w]+/", "", $string);
}

function numberformat($number,$postion=2){
    return number_format($number, $postion, '.', '');
}
function string_encrypt($string = '') {
    return rtrim(strtr(base64_encode(@mcrypt_encrypt(
        MCRYPT_BLOWFISH,
        md5(config_item('encryption_key'), TRUE),
        utf8_encode($string),
        MCRYPT_MODE_ECB
    )), '+/', '-_'), '=');
}

function string_decrypt($string = '') {
    return str_replace("\000", '', @mcrypt_decrypt(
        MCRYPT_BLOWFISH,
        md5(config_item('encryption_key'), TRUE),
        base64_decode(str_pad(
            strtr($string, '-_', '+/'),
            strlen($string) % 4,
            '=',
            STR_PAD_RIGHT
        )),
        MCRYPT_MODE_ECB
    ));
}
