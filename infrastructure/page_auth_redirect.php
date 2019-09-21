<?php
    require_once __DIR__ . "/" . "./constants.php";
    require_once __DIR__ . "/" . "./session_manager.php";
    //
    class PageAuthRedirect {

        private $sessionManager;
        
        public function __construct() {
            $this->sessionManager = new SessionManager();
        }

        public function redirect_if_not_authenticated() {
            global $BASE_URL;
            //
            if($this->sessionManager->  session_is_authenticated()) {
                return false;
            } else {
                header("Location: ${BASE_URL}/pages/login.php");
                return true;
            }
        }

        public function redirect_if_authenticated() {
            global $BASE_URL;
            //
            if($this->sessionManager->session_is_authenticated()) {
                header("Location: ${BASE_URL}/index.php");
                return true;
            } else {
                return false;
            }
        }
    }
?>