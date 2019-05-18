<?php
    require_once "infrastructure/constants.php";
    require_once "components/manager.php";
    require_once "infrastructure/scaffold_style.php";
    require_once "infrastructure/request_data.php";
    // Only for logged in people
    $redirect = false;
    if($isGet && !isAuthenticated()) {
        $redirect = true;
        header("Location: ./pages/login.php");
    }
    //
    if(!$redirect) {
?><html>
    <head>
        <title>
            Bem-vindos ao <?php echo APP_NAME; ?>
        </title>
        <?php scaffold_style() ?>
    </head>
    <body>
        <?php require_component("header") ?>
    </body>
</html><?php } ?>