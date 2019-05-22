<?php
    require_once __DIR__ . "/" . "../../infrastructure/request_data.php";
    //
    if($isPost) {
        
        //
        header("Location: ../../index.php");
    } else {
        return http_response_code(400);
    }
?>