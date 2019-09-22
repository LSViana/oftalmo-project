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
            //
            if($this->sessionManager->  session_is_authenticated()) {
                return false;
            } else {
                header("Location: ../pages/login.php");
                return true;
            }
        }

        public function redirect_if_authenticated() {
            //
            if($this->sessionManager->session_is_authenticated()) {
                header("Location: ../index.php");
                return true;
            } else {
                return false;
            }
        }
    }
?>