<?php
    require_once __DIR__ . "/" . "../../infrastructure/constants.php";
    require_once __DIR__ . "/" . "../../infrastructure/request_data.php";
    require_once __DIR__ . "/" . "../../infrastructure/session_manager.php";
    require_once __DIR__ . "/" . "../../data/users.php";
    //
    if($isPost) {
        $email = $_POST["email"] ?? null;
        $password = $_POST["password"] ?? null;
        $register = isset($_POST["register"]);
        if($register) {
            header("Location: ${BASE_URL}/pages/register.php");
            return;
        }
        // Verify null values
        if($email == null || $password == null) {
            header("Location: ${BASE_URL}/pages/login.php?invalidValues");
            return;
        }
        // Authenticate user
        $user = users_authenticate($email, $password);
        // If invalid credentials, send back to login with GET parameter to indicate error
        if($user == null) {
            header("Location: ${BASE_URL}/pages/login.php?invalidCredentials");
            return;
        }
        // Save user to session
        session_set_user($user);
        // Send to the index page
        header("Location: ${BASE_URL}/index.php");
    } else {
        return http_response_code(400);
    }
?>