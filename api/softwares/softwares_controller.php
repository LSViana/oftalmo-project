<?php
  require_once __DIR__ . "/" . "../../infrastructure/constants.php";
  require_once __DIR__ . "/" . "../../infrastructure/request_data.php";
  require_once __DIR__ . "/" . "../../data/softwares_repository.php";
  require_once __DIR__ . "/" . "../../infrastructure/session_manager.php";
  //
  class SoftwaresController {
    private $sessionManager;
    private $requestData;
    private $softwaresRepository;

    public function __construct() {    
      $this->sessionManager = new SessionManager();
      $this->requestData = new RequestData();
      $this->softwaresRepository = new SoftwaresRepository();
    }

    public function create() {
      //
      if($this->requestData->isGet) {
        http_response_code(400);
        return;
      } else if($this->requestData->isPost) {
          if(!$this->sessionManager->session_is_admin()) {
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
              $this->softwaresRepository->softwares_create([
                  "name" => $name,
                  "color" => $color,
                  "logo" => $logo,
                  "description" => $description,
              ]);
              //
              header("Location: ../../pages/home.php");
          }
      }
    }

    public function createByApi(){
        if($this->requestData->isGet) {
            http_response_code(400);
            return;
        } else if($this->requestData->isPost) {
            $data = json_decode(file_get_contents('php://input'), true);
            $errors = [];
            //
            $name = $data["name"] ?? "";
            $color = $data["color"] ?? "";
            $logo = $data["logo"] ?? "";
            $description = $data["description"] ?? "";
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
                return $errors;
            }
            // Handle the feature
            else {
                // The result of the method "softwares_create" is the ID of the newly generated software
                $this->softwaresRepository->softwares_create([
                    "name" => $name,
                    "color" => $color,
                    "logo" => $logo,
                    "description" => $description,
                ]);
                //
                return;
            }
        }
    }

    public function update() {
            //
            if($this->requestData->isGet) {
                http_response_code(400);
                return;
            } else {
                if(!$this->sessionManager->session_is_admin()) {
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
                if($remove) {
                    $this->softwaresRepository->softwares_delete($id);
                    header("Location: ../../pages/home.php");
                }
                else {
                    $this->softwaresRepository->softwares_update($id, [
                        "name" => $name,
                        "color" => $color,
                        "logo" => $logo,
                        "description" => $description,
                    ]);
                    //
                    header("Location: ../../pages/software/details.php?id=" . $id . "&success");
                }
            }
    }

      public function updateByApi() {
          //
          if($this->requestData->isGet) {
              http_response_code(400);
              return;
          } else {
              $errors = [];
              $data = json_decode(file_get_contents("php://input"), true);
              //
              $id = $data["id"] ?? null;
              $name = $data["name"] ?? "";
              $color = $data["color"] ?? "";
              $logo = $data["logo"] ?? "";
              $description = $data["description"] ?? "";
              // Blocking validation (it is, if there's no Id, there's no entity to validate errors)
              if($id == null || !$this->softwaresRepository->softwares_read($id)) {
                  $errors["id"] = "Software não encontrado no sistema";
                  return $errors;
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
                  return $errors;
              }

              else {
                  $this->softwaresRepository->softwares_update($id, [
                      "name" => $name,
                      "color" => $color,
                      "logo" => $logo,
                      "description" => $description,
                  ]);
                  //
                  return;
              }
          }
      }

    public function list(){
        return $this->softwaresRepository->softwares_list();
    }

    public function read($id){
        return $this->softwaresRepository->softwares_read($id);
    }


  }
?>