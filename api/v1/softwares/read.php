<?php
require_once __DIR__ . "/" . "../../softwares/softwares_controller.php";
require_once __DIR__ . "/" . "../../../infrastructure/request_data.php";
require_once __DIR__ . "/" . "../../../infrastructure/response_manager.php";

$requestData = new RequestData();

if($requestData->isGet){
    if(isset($_GET['id'])){
        $controller = new SoftwaresController();

        $software = $controller->read($_GET['id']);

        $responseManager = new ResponseManager();

        if($software)
            $responseManager->returnAsJson($software);
        else
            http_response_code(404);
    }else{
        http_response_code(400);
    }

} else {
    http_response_code(405);
}


?>