<?php
require_once __DIR__ . "/" . "../../infrastructure/constants.php";
require_once __DIR__ . "/" . "../../infrastructure/request_data.php";
require_once __DIR__ . "/" . "../../data/users_repository.php";
require_once __DIR__ . "/" . "../../infrastructure/session_manager.php";

class UsersController
{
    private $sessionManager;
    private $requestData;
    private $usersRepository;

    public function __construct() {
        $this->sessionManager = new SessionManager();
        $this->requestData = new RequestData();
        $this->usersRepository = new UsersRepository();
    }

    public function login(){
        if($this->requestData->isPost) {
            $email = $_POST["email"] ?? null;
            $password = $_POST["password"] ?? null;
            $register = isset($_POST["register"]);
            if($register) {
                header("Location: ../../pages/register.php");
                return;
            }
            // Verify null values
            if($email == null || $password == null) {
                header("Location: ../../pages/login.php?invalidValues");
                return;
            }
            // Authenticate user
            $user = $this->usersRepository->users_authenticate($email, $password);
            // If invalid credentials, send back to login with GET parameter to indicate error
            if($user == null) {
                header("Location: ../../pages/login.php?invalidCredentials");
                return;
            }
            // Save user to session
            $this->sessionManager->session_set_user($user);
            // Send to the index page
            header("Location: ../../index.php");
        } else {
            return http_response_code(400);
        }
    }

    public function register(){
        if($this->requestData->isPost){
            $name = $_POST["name"] ?? "";
            $email = $_POST["email"] ?? "";
            $password = $_POST["password"] ?? "";
            $confirmPassword = $_POST["confirmPassword"] ?? "";
            $errors = [];

            if(strlen($name) < 5){
                $errors["name"] = "O nome deve ter no mínimo 5 caracteres";
            }

            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors["email"] = "O email não é um e-mail válido";
            };

            if(strlen($password) < 8){
                $errors["password"] = "A senha deve ter no mínimo 8 caracteres";
            }

            if($password != $confirmPassword){
                $errors["confirmPassword"] = "As senhas não conferem";
            }

            if(sizeof($errors) > 0) {
                header("Location: ../../pages/register.php?errors=" . json_encode($errors) . "");
                return;
            }

            $users = $this->usersRepository->users_list();

            $alreadyExistsUsers = array_values(array_filter($users, function($item) use ($email) {
                try {
                    if(strtolower($item["email"]) == strtolower($email)) {
                        return true;        
                    }
                } catch(Exception $err) {
                    return false;
                }
            }));

            if(sizeof($alreadyExistsUsers) > 0) {
                $errors["email"] = "Um usuário com o mesmo email já existe";
                header("Location: ../../pages/register.php?errors=" . json_encode($errors) . "");
                return;
            }

            $this->usersRepository->users_create([
                "name" => $name,
                "email" => $email,
                "password" => $password,
                "is_admin" => false
            ]);

            header("Location: ../../pages/login.php");
        } else {
            return http_response_code(400);
        }
    }
}
?>