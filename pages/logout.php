<?php
    require_once __DIR__ . "/" . "../infrastructure/constants.php";
    require_once __DIR__ . "/" . "../infrastructure/request_data.php";
    require_once __DIR__ . "/" . "../infrastructure/session_manager.php";
    //
    $sessionManager = new SessionManager();
    $requestData = new RequestData();
    //
    if($requestData->isGet) {
        $sessionManager->session_logout();
        //
        header("Location: ../index.php");
    } else {
        http_response_code(400);
    }
?>