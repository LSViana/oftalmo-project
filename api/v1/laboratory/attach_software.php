<?php

require_once __DIR__ . "/" . "../../laboratory/laboratory_controller.php";
require_once __DIR__ . "/" . "../../../infrastructure/request_data.php";
require_once __DIR__ . "/" . "../../../infrastructure/response_manager.php";

$requestData = new RequestData();

if($requestData->isGet){
    $controller = new LaboratoryController();

    $errors = $controller->attach_software_by_api();

    $responseManager = new ResponseManager();

    if($errors){
        $responseManager->returnAsJson($errors, 400);
    } else {
        http_response_code(204);
    }

} else {
    http_response_code(405);
}
?>