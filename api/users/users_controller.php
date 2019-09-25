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
            $name = $_POST["name"] ?? null;
            $email = $_POST["email"] ?? null;
            $password = $_POST["password"] ?? null;
            $confirmPassword = $_POST["confirmPassword"] ?? null;
            
            if($email == null || $name == null || $password == null || $confirmPassword == null){
                header("Location: ../../pages/register.php?invalidValues");
                return;
            }

            if($password != $confirmPassword){
                header("Location: ../../pages/register.php?passwordsDontMatch");
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
                header("Location: ../../pages/register.php?sameEmail");
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