<?php
    require_once __DIR__ . "/" . "../infrastructure/constants.php";
    require_once __DIR__ . "/" . "../infrastructure/request_data.php";
    require_once __DIR__ . "/" . "../infrastructure/session_manager.php";
    //
    $requestData = new RequestData();
    //
    if($requestData->isGet) {
        session_logout();
        //
        header("Location: ${BASE_URL}/index.php");
    } else {
        http_response_code(400);
    }
?>