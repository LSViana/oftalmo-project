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
    } else {
?>
<html>
    <head>
        <title>Criar Novo Laboratório | <?php echo APP_NAME?></title>
        <?php scaffold_style() ?>
        <style>
        </style>
    </head>
    <body>
        <?php require_component("header"); ?>
        <section class="laboratory flex flex-column align-center justify-center" style="flex:1;">
            <?php
                form_build(
                    null,
                    null,
                    $success,
                    true,
                    "../../api/laboratory/create.php",
                    "post",
                    "flex flex-column",
                    "",
                    [
                        [
                            "name" => "name",
                            "text" => "Nome",
                            "type" => "text",
                            "placeholder" => "Nome do laboratório",
                        ],
                        [
                            "name" => "computers",
                            "text" => "Computadores",
                            "type" => "number",
                            "placeholder" => "Quantidade de computadores",
                        ], 
                    ],
                    [
                        [
                            "text" => "Criar",
                            "classes" => "primary"
                        ]
                    ]);
            ?>
        </section>
    </body>
</html>
<?php
    }
?>