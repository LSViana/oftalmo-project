<?php

require_once __DIR__ . "/" . "../../laboratory/laboratory_controller.php";
require_once __DIR__ . "/" . "../../../infrastructure/request_data.php";
require_once __DIR__ . "/" . "../../../infrastructure/response_manager.php";

$requestData = new RequestData();

if($requestData->isGet){
    $controller = new LaboratoryController();

    $laboratories = $controller->list();

    $responseManager = new ResponseManager();

    $responseManager->returnAsJson($laboratories);

} else {
    http_response_code(405);
}
?>
