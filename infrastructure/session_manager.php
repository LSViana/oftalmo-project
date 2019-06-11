<?php
    require_once __DIR__ . "/" . "./constants.php";
    //
    session_start();
    // Functions
    function session_is_authenticated() {
        return isset($_SESSION[USER_KEY]);
    }
    function session_set_user($user) {
        $_SESSION[USER_KEY] = $user;
    }
    function session_get_user() {
        return $_SESSION[USER_KEY];
    }
    function session_logout() {
        session_destroy();
    }
    function session_is_admin() {
        return session_is_authenticated() && isset(session_get_user()[IS_ADMIN]);
    }
?>