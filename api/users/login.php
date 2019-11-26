<?php
    require_once __DIR__ . "/" . "./users_controller.php";

    $usersController = new UsersController();
    $usersController->login();
?>