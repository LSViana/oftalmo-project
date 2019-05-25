<?php
    require_once __DIR__ . "/" . "../../infrastructure/constants.php";
    require_once __DIR__ . "/" . "../../infrastructure/request_data.php";
    require_once __DIR__ . "/" . "../../data/softwares.php";
    //
    if($isGet) {
        http_response_code(400);
        return;
    } else {
        $x = 3;
    }
?>