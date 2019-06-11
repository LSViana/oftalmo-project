<?php
    $BASE_URL = "/oftalmo-project";
    $ROOT = $_SERVER["DOCUMENT_ROOT"] . $BASE_URL;
    define('APP_NAME', 'Gerenciamento de Softwares');
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