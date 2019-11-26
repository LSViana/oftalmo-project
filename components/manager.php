<?php
    require_once __DIR__ . "/" . "./header.php";
    // Registered components
    $components = [
        "header",
    ];
    // Manager functions
    function require_component($componentName) {
        global $components;
        //
        $result = array_search($componentName, $components);
        if($result !== false) { // False (as boolean) only if the value isn't found
            call_user_func("component_" . $components[$result]);
        } else {
            throw new Exception("Component not registered");
        }
    }
?>