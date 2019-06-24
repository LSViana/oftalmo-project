<?php
    $BASE_URL = "/software-manager";
    $ROOT = $_SERVER["DOCUMENT_ROOT"] . $BASE_URL;
    define('APP_NAME', 'Gerenciamento de Softwares');
    define('DARK_LIGHT_COLOR', '#646464');
    define('DARK_COLOR', '#323232');
    define('PRIMARY_COLOR', '#42bff4');
    define('PRIMARY_DARK_COLOR', '#38a3d1');
    define('ACCENT_COLOR', '#f4ee41');
    define('ERROR_COLOR', '#f47d42');
    define('USER_KEY', 'user');
    define('IS_ADMIN', 'is_admin');
    // General purpose functions
    if (function_exists('com_create_guid') === false)
    {
        function com_create_guid() {
            return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
        }
    }    
?>