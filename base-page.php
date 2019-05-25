<?php
    // You may need to change these paths depending on where the page is located
    require_once __DIR__ . "/" . "./infrastructure/constants.php";
    require_once __DIR__ . "/" . "./components/manager.php";
    require_once __DIR__ . "/" . "./infrastructure/session_manager.php";
    require_once __DIR__ . "/" . "./infrastructure/scaffold_style.php";
    require_once __DIR__ . "/" . "./data/softwares.php";
    //
    if(true) {
?>
<html>
    <head>
        <title>@PAGE_TITLE@ | <?php echo APP_NAME ?></title>
        <?php scaffold_style() ?>
        <style>
        </style>
    </head>
    <body>
        <?php require_component("header"); ?>
    </body>
</html>
<?php
    }
?>