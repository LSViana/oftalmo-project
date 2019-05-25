<?php
    require_once __DIR__ . "/" . "../../infrastructure/constants.php";
    require_once __DIR__ . "/" . "../../components/manager.php";
    require_once __DIR__ . "/" . "../../infrastructure/session_manager.php";
    require_once __DIR__ . "/" . "../../infrastructure/scaffold_style.php";    
    require_once __DIR__ . "/" . "../../infrastructure/form_builder.php";
    require_once __DIR__ . "/" . "../../data/softwares.php";
    //
    $allowedToRender = false;
    $softwareId = $_GET["id"] ?? null;
    $errors = json_decode($_GET["errors"] ?? "[]", true);
    $success = isset($_GET["success"]);
    $authenticated = session_is_authenticated();
    if($authenticated && $softwareId != null) {
        $software = softwares_read($softwareId);
        $allowedToRender = true;
    }
    if(!$allowedToRender) {
        if(!$authenticated) {
            header("Location: ../login.php");
        }
        else {
            header("Location: ../notfound.php");
        }
        return;
    } else {
?>
<html>
    <head>
        <title>Detalhes do Software | <?php echo APP_NAME ?></title>
        <?php scaffold_style() ?>
        <style>
        </style>
    </head>
    <body>
        <?php require_component("header"); ?>
        <section class="software flex flex-column align-center justify-center" style="flex: 1;">
            <?php
                form_build(
                    $software,
                    $errors,
                    $success,
                    true,
                    "../../api/softwares/update.php",
                    "post",
                    "flex flex-column",
                    "",
                    [
                        [
                            "name" => "name",
                            "text" => "Nome",
                            "type" => "text",
                        ],
                        [
                            "name" => "color",
                            "text" => "Cor",
                            "type" => "color",
                        ],
                        [
                            "name" => "logo",
                            "text" => "Imagem",
                            "type" => "url",
                        ],
                        [
                            "name" => "description",
                            "text" => "Descrição",
                            "type" => "text",
                            "tag" => "textarea",
                        ],
                    ],
                    [
                        [
                            "text" => "Remover",
                            "value" => "remove",
                            "classes" => "remove",
                        ],
                        [
                            "text" => "Atualizar",
                            "classes" => "primary",
                        ],
                    ]);
            ?>
        </section>
    </body>
</html>
<?php
    }
?>