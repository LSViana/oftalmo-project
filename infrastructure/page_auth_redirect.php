<?php
    require_once __DIR__ . "/" . "./constants.php";
    require_once __DIR__ . "/" . "./session_manager.php";
    //
    function redirect_if_authenticated() {
        global $BASE_URL;
        //
        if(session_is_authenticated()) {
            return false;
        } else {
            header("Location: ${BASE_URL}/pages/login.php");
            return true;
        }
    }
    
?>