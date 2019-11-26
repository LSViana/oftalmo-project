<?php
require_once __DIR__ . "/" . "../../softwares/softwares_controller.php";
require_once __DIR__ . "/" . "../../../infrastructure/request_data.php";
require_once __DIR__ . "/" . "../../../infrastructure/response_manager.php";

$requestData = new RequestData();

if($requestData->isGet){
    $controller = new SoftwaresController();
    
    $softwares = $controller->list();

    $responseManager = new ResponseManager();

    $responseManager->returnAsJson($softwares);
} else {
    http_response_code(405);
}

?>