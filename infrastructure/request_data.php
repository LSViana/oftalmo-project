<?php
    require_once __DIR__ . "/constants.php";
    //
    $method = $_SERVER["REQUEST_METHOD"];
    $isGet = $method == "GET";
    $isPost = $method == "POST";
    //
    function isAuthenticated() {
        return isset($_SESSION[USER_KEY]);
    }
?>