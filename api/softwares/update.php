<?php
    require_once __DIR__ . "/" . "../../infrastructure/constants.php";
    require_once __DIR__ . "/" . "../../infrastructure/request_data.php";
    require_once __DIR__ . "/" . "../../data/softwares_repository.php";
    require_once __DIR__ . "/" . "../../infrastructure/session_manager.php";
    //
    $sessionManager = new SessionManager();
    $requestData = new RequestData();
    //
    if($requestData->isGet) {
        http_response_code(400);
        return;
    } else {
        if(!$sessionManager->session_is_admin()) {
            http_response_code(403);
            return;
        }
        $errors = [];
        //
        $id = $_POST["id"] ?? null;
        $name = $_POST["name"] ?? "";
        $color = $_POST["color"] ?? "";
        $logo = $_POST["logo"] ?? "";
        $description = $_POST["description"] ?? "";
        $remove = isset($_POST["remove"]);
        // Blocking validation (it is, if there's no Id, there's no entity to validate errors)
        if($id == null) {
            header("Location: ../../pages/notfound.php");
            return;
        }
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
            header("Location: ../../pages/software/details.php?id=" . $id . "&errors=" . json_encode($errors) . "");
            return;
        }
        // Handle the feature
        $softwaresRepository = new SoftwaresRepository();
        if($remove) {
            $softwaresRepository->softwares_delete($id);
            header("Location: $BASE_URL/pages/home.php");
        }
        else {
            $softwaresRepository->softwares_update($id, [
                "name" => $name,
                "color" => $color,
                "logo" => $logo,
                "description" => $description,
            ]);
            //
            header("Location: $BASE_URL/pages/software/details.php?id=" . $id . "&success");
        }
    }
?>