<?php
    require_once "infrastructure/constants.php";
    require_once "components/manager.php";
    require_once "infrastructure/scaffold_style.php";
    require_once "infrastructure/request_data.php";
    // Only for logged in people
    $redirect = false;
    if($isGet) {
        $redirect = true;
        if(is_authenticated())
            header("Location: ./pages/home.php");
        else
            header("Location: ./pages/login.php");
    }
    //
    if(!$redirect) {
        http_response_code(400);
    }
?>