<?php 
    require_once __DIR__ . "/" . "../../infrastructure/constants.php";
    require_once __DIR__ . "/" . "../../infrastructure/request_data.php";
    require_once __DIR__ . "/" . "../../data/laboratories_repository.php";
    require_once __DIR__ . "/" . "../../infrastructure/session_manager.php";

    if($isGet){
        http_response_code(400);
        return;
    } else {
        if(!session_is_admin()) {
            http_response_code(403);
            return;
        }
        $errors = [];

        $id = $_POST["id"] ?? null;
        $name = $_POST["name"] ?? "";
        $computers = $_POST["computers"] ?? "";
        $remove = isset($_POST["remove"]);
        $manageSoftwares = isset($_POST["softwares"]);
        
        if($manageSoftwares) {
            header("Location: ../../pages/laboratory/softwares.php?id=" . $id);
            return;
        }

        // Blocking validation (its, if theres no id, theres no entity to validate errors)
        if($id == null){
            header("Location: ../../pages/notfound.php");
            return;
        }

        // Validations
        if(strlen($name) < 3){
            $errors["name"] = "Nome deve ter mais do que 3 caracteres";
        }if(!(is_int(intval($computers)))){
            $errors["computers"] = "A quantidade de computadores deve ser inteira";
        }else if($computers < 1){
            $errors["computers"] = "A quantidade de computadores deve ser maior do que 1";
        }

        // Verify errors
        if(sizeof($errors) > 0){
            header("Location: ../../pages/laboratory/details.php?id=" . $id . "&errors=" . json_encode($errors) . "");
            return;
        }
        // Handle the feature
        if($remove){
            $laboratoriesRepository = new LaboratoriesRepository();
            $laboratoriesRepository->laboratories_delete($id);
            header("Location: $BASE_URL/pages/home.php");
        } else {
            $laboratory = $laboratoriesRepository->laboratories_read($id);

            $laboratoriesRepository->laboratories_update($id, [
                "name" => $name,
                "computers" => $computers,
                "softwares" => $laboratory["softwares"]
            ]);
            header("Location: $BASE_URL/pages/laboratory/details.php?id=" . $id . "&success");
        }

    }
?>