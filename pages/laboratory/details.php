<?php
    require_once __DIR__ . "/" . "../../infrastructure/constants.php";
    require_once __DIR__ . "/" . "../../components/manager.php";
    require_once __DIR__ . "/" . "../../infrastructure/session_manager.php";
    require_once __DIR__ . "/" . "../../infrastructure/scaffold_style.php";    
    require_once __DIR__ . "/" . "../../infrastructure/form_builder.php";
    require_once __DIR__ . "/" . "../../data/laboratories.php";
    
    $allowedToRender = false;
    $laboratoryId = $_GET["id"] ?? null;
    $errors = json_decode($_GET["errors"] ?? "[]", true);
    $success = isset($_GET["success"]);
    $authenticated = session_is_authenticated() && session_is_admin();
    if($authenticated && $laboratoryId != null){
        $laboratory = laboratories_read($laboratoryId);
        $allowedToRender = true;
    }
    if(!$allowedToRender){
        if(!$authenticated){
            header("Location: ../login.php");
        }else{
            header("Location: ../notfound.php");
        }
        return;
    } else {
?>
<html>
    <head>
        <title>Detalhes do Laoratório | <?php echo APP_NAME ?></title>
        <?php scaffold_style() ?>
        <style>
        </style>
    </head>
    <body>
        <?php require_component("header"); ?>
        <section class="laboratory flex flex-column align-center justify-center" style="flex:1;">
            <?php
                form_build(
                    $laboratory,
                    $errors,
                    $success,
                    true,
                    "../../api/laboratory/update.php",
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
                            "placeholder" => "Quantidade de computadores"
                        ],
                    ],
                    [
                        [
                            "text" => "Gerenciar Softwares",
                            "name" => "softwares",
                        ],
                        [
                            "text" => "Remover",
                            "name" => "remove",
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