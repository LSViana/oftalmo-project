<?php
    require_once __DIR__ . "/" . "../../infrastructure/constants.php";
    require_once __DIR__ . "/" . "../../infrastructure/request_data.php";
    require_once __DIR__ . "/" . "../../data/laboratories_repository.php";
    require_once __DIR__ . "/" . "../../infrastructure/session_manager.php";
    //
    $sessionManager = new SessionManager(); 
    $requestData = new RequestData();
    //
    if($requestData->isGet){
        http_response_code(400);
        return;
    } else if($requestData->isPost) {
        if(!$sessionManager->session_is_admin()) {
            http_response_code(403);
            return;
        }
        $errors = [];
        $name = $_POST["name"] ?? "";
        $computers = $_POST["computers"] ?? "";
        // Validations
        if(strlen($name) < 3){
            $errors["name"] = "Nome deve ter mais do que 3 caracteres";
        }
        if(intval($computers) == 0) {
            $errors["computers"] = "A quantidade de computadores deve ser ao menos 1";
        }

        // Verify errors
        if(sizeof($errors) > 0){
            header("Location: ../../pages/laboratory/create.php?errors=" . json_encode($errors) . "");
            return;
        }
        // Handle the feature
        else {
            // The result of the method "laboratories_create" is the ID of the newly generated laboratory
            $laboratoriesRepository = new LaboratoriesRepository();
            $laboratoriesRepository->laboratories_create([
                "name" => $name,
                "computers" => $computers
            ]);
            header("Location: ../../pages/home.php");
        }
    }
?>
