<?php
require_once __DIR__ . "/" . "../../charts/charts_controller.php";
require_once __DIR__ . "/" . "../../../infrastructure/request_data.php";
require_once __DIR__ . "/" . "../../../infrastructure/response_manager.php";

$requestData = new RequestData();
if($requestData->isGet) {
    $responseManager = new ResponseManager();
    if(!isset($_REQUEST["id"])) {
        http_response_code(400);
        $responseManager->returnAsJson([
            'error' => "O parâmetro 'id' é obrigatório"
        ]);
        return;
    }
    $controller = new ChartsController();
    list($laboratory, $colors, $colorsCount, $softwareNames, $softwares) = $controller->colorsBySoftwareByLaboratoryData();
    // Processing results
    $softwaresWithColors = array_values(array_map(function($item) use ($colors, $softwares) {
        // Using static variables will make them keep their old values when this scope is reached again
        static $index = -1;
        $index++;
        return [
            "color" => $colors[$index],
            "name" => $softwares[$index]["name"],
            "id" => $item,
        ];
    }, $laboratory["softwares"]));
    // Returning as JSON
    $laboratory["softwares"] = $softwaresWithColors;
    $responseManager->returnAsJson($laboratory);
} else {
    http_response_code(405);
}
