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
}
?>