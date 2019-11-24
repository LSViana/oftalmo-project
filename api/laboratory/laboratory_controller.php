<?php
require_once __DIR__ . "/" . "../../infrastructure/constants.php";
require_once __DIR__ . "/" . "../../infrastructure/request_data.php";
require_once __DIR__ . "/" . "../../infrastructure/session_manager.php";
require_once __DIR__ . "/" . "../../data/laboratories_repository.php";

class LaboratoryController {
    private $sessionManager;
    private $requestData;
    private $laboratoriesRepository;

    public function __construct() {
      $this->sessionManager = new SessionManager();
      $this->requestData = new RequestData();
      $this->laboratoriesRepository = new LaboratoriesRepository();
    }

    public function create() {
        if($this->requestData->isGet){
            http_response_code(400);
            return;
        } else if($this->requestData->isPost) {
            if(!$this->sessionManager->session_is_admin()) {
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
                $this->laboratoriesRepository->laboratories_create([
                    "name" => $name,
                    "computers" => $computers
                ]);
                header("Location: ../../pages/home.php");
            }
        }
    }

    public function createByApi()
    {
        if($this->requestData->isGet){
            http_response_code(400);
            return;
        } else if($this->requestData->isPost) {
            $data = json_decode(file_get_contents('php://input'), true);
            $errors = [];
            $name = $data["name"] ?? "";
            $computers = $data["computers"] ?? "";
            // Validations
            if(strlen($name) < 3){
                $errors["name"] = "Nome deve ter mais do que 3 caracteres";
            }
            if(intval($computers) == 0) {
                $errors["computers"] = "A quantidade de computadores deve ser ao menos 1";
            }

            // Verify errors
            if(sizeof($errors) > 0){
                return $errors;
            }
            // Handle the feature
            else {
                // The result of the method "laboratories_create" is the ID of the newly generated laboratory
                $this->laboratoriesRepository->laboratories_create([
                    "name" => $name,
                    "computers" => $computers
                ]);
                return;
            }
        }
    }

    public function attach_software() {
        if(!$this->sessionManager->session_is_admin()) {
            http_response_code(403);
            return;
        }
        $isAuthenticated = $this->sessionManager->session_is_authenticated() && $this->sessionManager->session_is_admin();
        if(!$isAuthenticated) {
            http_response_code(401);
            return;
        }
        if(!$this->requestData->isGet) {
            http_response_code(405);
            return;
        }
        $laboratoryId = $_GET["laboratory_id"] ?? null;
        $softwareId = $_GET["software_id"] ?? null;
        if($laboratoryId == null || $softwareId == null) {
            http_response_code(400);
            return;
        }

        $this->laboratoriesRepository->laboratories_attach_software($laboratoryId, $softwareId);
        // Sending back to the laboratory softwares page
        header("Location: ../../pages/laboratory/softwares.php?id=" . $laboratoryId);
    }

    public function attach_software_by_api() {

        if(!$this->requestData->isGet) {
            http_response_code(405);
            return;
        }
        $errors = [];
        $data = json_decode(file_get_contents('php://input'), true);
        $laboratoryId = $data["laboratory_id"] ?? null;
        $softwareId = $data["software_id"] ?? null;
        if($laboratoryId == null)
        {
            $errors["laboratoryId"] = "O laboratoryId não pode ser nulo";
        }
        if($softwareId == null)
        {
            $errors["softwareId"] = "O softwareId não pode ser nulo";
        }

        if(sizeof($errors) > 0)
        {
            return $errors;
        }

        $this->laboratoriesRepository->laboratories_attach_software($laboratoryId, $softwareId);
        // Sending back to the laboratory softwares page
        return;
    }
}
?>