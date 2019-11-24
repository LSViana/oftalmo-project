<?php
require_once __DIR__ . "/" . "../../charts/charts_controller.php";
require_once __DIR__ . "/" . "../../../infrastructure/request_data.php";
require_once __DIR__ . "/" . "../../../infrastructure/response_manager.php";

$requestData = new RequestData();
if($requestData->isGet) {
    $controller = new ChartsController();
    list($laboratories, $computers) = $controller->computersByLaboratoryData();
    // Processing results
    $results = array_values(array_map(function($item) {
        unset($item["softwares"]);
        return $item;
    }, $laboratories));
    // Returning as JSON
    $responseManager = new ResponseManager();
    $responseManager->returnAsJson($results);
} else {
    http_response_code(405);
}
