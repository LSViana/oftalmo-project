<?php
    require_once __DIR__ . "/" . "../../infrastructure/constants.php";
    require_once __DIR__ . "/" . "../../components/manager.php";
    require_once __DIR__ . "/" . "../../infrastructure/session_manager.php";
    require_once __DIR__ . "/" . "../../infrastructure/scaffold_style.php";    
    require_once __DIR__ . "/" . "../../infrastructure/form_builder.php";
    require_once __DIR__ . "/" . "../../data/softwares.php";
    //
    $allowedToRender = false;
    $authenticated = session_is_authenticated() && session_is_admin();
    $success = $_GET["success"] ?? false;
    if($authenticated) {
        $allowedToRender = true;
    }
    if(!$allowedToRender) {
        if(!$authenticated) {
            header("Location: ../login.php");
        } else {
            
        }
        return;
    }
?>