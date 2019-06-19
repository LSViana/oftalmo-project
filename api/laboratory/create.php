<?php
    require_once __DIR__ . "/" . "../../infrastructure/constants.php";
    require_once __DIR__ . "/" . "../../infrastructure/request_data.php";
    require_once __DIR__ . "/" . "../../data/laboratories.php";
    require_once __DIR__ . "/" . "../../infrastructure/session_manager.php";

    if($isGet){
        http_response_code(400);
        return;
    } else if($isPost) {
        if(!session_is_admin()) {
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
            laboratories_create([
                "name" => $name,
                "computers" => $computers,
                "softwares" => array()
            ]);
            header("Location: $BASE_URL/pages/home.php");
        }
    }
?>