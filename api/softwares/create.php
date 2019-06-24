<?php
    require_once __DIR__ . "/" . "../../infrastructure/constants.php";
    require_once __DIR__ . "/" . "../../infrastructure/request_data.php";
    require_once __DIR__ . "/" . "../../data/softwares.php";
    require_once __DIR__ . "/" . "../../infrastructure/session_manager.php";
    //
    if($isGet) {
        http_response_code(400);
        return;
    } else if($isPost) {
        if(!session_is_admin()) {
            http_response_code(403);
            return;
        }
        $errors = [];
        //
        $name = $_POST["name"] ?? "";
        $color = $_POST["color"] ?? "";
        $logo = $_POST["logo"] ?? "";
        $description = $_POST["description"] ?? "";
        // Validations
        if(strlen($name) < 3) {
            $errors["name"] = "Nome deve ter mais do que 3 caracteres";
        }
        if(strlen($description) < 16) {
            $errors["description"] = "Descrição deve ter mais do que 16 caracteres";
        }
        if(strlen($color) != 7) {
            $errors["color"] = "Deve ser uma color com '#' e mais 6 dígitos hexadecimais";
        }
        if(!filter_var($logo, FILTER_VALIDATE_URL)) {
            $errors["logo"] = "Deve ser uma URL válida";
        }
        // Verify errors
        if(sizeof($errors) > 0) {
            header("Location: ../../pages/software/create.php?errors=" . json_encode($errors) . "");
            return;
        }
        // Handle the feature
        else {
            // The result of the method "softwares_create" is the ID of the newly generated software
            softwares_create([
                "name" => $name,
                "color" => $color,
                "logo" => $logo,
                "description" => $description,
            ]);
            //
            header("Location: $BASE_URL/pages/home.php");
        }
    }
?>