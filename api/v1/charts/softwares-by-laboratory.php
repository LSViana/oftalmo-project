<?php
require_once __DIR__ . "/" . "../../charts/charts_controller.php";
require_once __DIR__ . "/" . "../../../infrastructure/request_data.php";
require_once __DIR__ . "/" . "../../../infrastructure/response_manager.php";

$requestData = new RequestData();
if($requestData->isGet) {
    $controller = new ChartsController();
    list($laboratories, $softwareAmounts) = $controller->softwaresByLaboratoryData();
    // Processing results
    $results = array_map(function($item) {
        $item["softwareAmount"] = sizeof($item["softwares"]);
        unset($item["softwares"]);
        unset($item["computers"]);
        return $item;
    }, $laboratories);
    // Returning as JSON
    $responseManager = new ResponseManager();
    $responseManager->returnAsJson($results);
} else {
    http_send_status(405);
}