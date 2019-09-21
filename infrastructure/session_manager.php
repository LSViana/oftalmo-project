<?php
    require_once __DIR__ . "/" . "./constants.php";
    //
    class SessionManager {

        public function __construct() {
            if(session_status() !== PHP_SESSION_ACTIVE) {
                session_start();
            }
        }
        
        public function session_is_authenticated() {
            return isset($_SESSION[USER_KEY]);
        }
        
        public function session_set_user($user) {
            $_SESSION[USER_KEY] = $user;
        }
        
        public function session_get_user() {
            return $_SESSION[USER_KEY];
        }
        
        public function session_logout() {
            session_destroy();
        }
        
        public function session_is_admin() {
            return $this->session_is_authenticated() && isset($this->session_get_user()[IS_ADMIN]);
        }
    }
?>