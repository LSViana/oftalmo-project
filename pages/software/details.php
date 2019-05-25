<?php
    require_once __DIR__ . "/" . "../../infrastructure/constants.php";
    require_once __DIR__ . "/" . "../../components/manager.php";
    require_once __DIR__ . "/" . "../../infrastructure/session_manager.php";
    require_once __DIR__ . "/" . "../../infrastructure/scaffold_style.php";
    require_once __DIR__ . "/" . "../../data/softwares.php";
    //
    $allowedToRender = false;
    $softwareId = $_GET["id"] ?? null;
    if(session_is_authenticated() && $softwareId != null) {
        $software = softwares_read($softwareId);
        $allowedToRender = true;
    }
    if(!$allowedToRender) {
        header("Location: ${BASE_URL}/pages/login.php");
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
        <section class="software">
            <form action="../../api/softwares" method="post" class="data-form">
                <input type="hidden" name="id" value="<?php echo $softwareId ?>">
                <p>
                    <label for="name">Nome</label>
                    <input type="text" name="name" id="name" value="<?php echo $software["name"] ?>">
                </p>
                <p>
                    <label for="image">Imagem</label>
                    <input type="text" name="image" id="image" value="<?php echo $software["image"] ?>">
                </p>
                <p>
                    <label for="description">Descrição</label>
                    <input type="text" name="name" id="name" value="<?php echo $software["name"] ?>">
                </p>
                <p>
                    <label for="color">Cor</label>
                    <input type="text" name="name" id="name" value="<?php echo $software["name"] ?>">
                </p>
            </form>
        </section>
    </body>
</html>
<?php
    }
?>