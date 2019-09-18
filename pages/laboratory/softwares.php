<?php
    require __DIR__ . "/" . "../../infrastructure/constants.php";
    require __DIR__ . "/" . "../../infrastructure/request_data.php";
    require __DIR__ . "/" . "../../infrastructure/session_manager.php";
    require __DIR__ . "/" . "../../infrastructure/scaffold_style.php";
    require __DIR__ . "/" . "../../components/manager.php";
    require __DIR__ . "/" . "../../data/laboratories_repository.php";
    require __DIR__ . "/" . "../../data/softwares_repository.php";
    //
    $allowedToRender = false;
    $authenticated = session_is_authenticated() && session_is_admin();
    $laboratoryId = $_GET["id"] ?? null;
    if($authenticated && $isGet && $laboratoryId != null) {
        $allowedToRender = true;
    }
    $laboratoriesRepository = new LaboratoriesRepository();
    $laboratory = $laboratoriesRepository->laboratories_read($laboratoryId);
    if($laboratory == null) {
        $allowedToRender = false;
    }
    if(!$allowedToRender) {
        if(!$authenticated) {
            header("Location: ./../../login.php");
        } else {
            header("Location: ./../../notfound.php");
        }
        return;
    } else {
        $softwaresRepository = new SoftwaresRepository();
        $softwares = $softwaresRepository->softwares_list();
        $notAttachedSoftwares = array_values(array_filter($softwares, function($item) use($laboratory) {
            $isAttached = array_search($item["id"], $laboratory["softwares"]) !== false;
            return !$isAttached;
        }));
        $attachedSoftwares = array_values(array_filter($softwares, function($item) use($laboratory) {
            $isAttached = array_search($item["id"], $laboratory["softwares"]) !== false;
            return $isAttached;
        }));
?>
<html>
    <head>
        <title>Softwares do Laboratório | <?php echo APP_NAME; ?></title>
        <?php scaffold_style(); ?>
        <style>
        .software-list {
            min-width: 400px;
        }
        </style>
    </head>
    <body>
        <?php require_component("header"); ?>
        <section class="laboratory flex flex-column align-stretch pa-6">
            <h2>Softwares do <span class="text-weight-bold text-primary"><?php echo $laboratory["name"]; ?></span></h2>
            <article class="softwares flex flex-row justify-center">
                <section class="not-attached software-list ma-2 bg-dark border-radius-2">
                    <h4 class="ma-3">Softwares não atribuídos</h4>
                    <hr />
                    <div class="pa-3">
                        <?php foreach($notAttachedSoftwares as $value) { ?>
                            <div class="ma-1 pa-2 flex flex-row flex-nowrap border-white border-radius-circular">
                                <a class="action-button text-medium text-weight-bold border-radius-circular unattach-button px-3 py-1 flex align-center"
                                   href="../../api/laboratory/attach_software.php?software_id=<?php echo $value["id"]; ?>&laboratory_id=<?php echo $laboratoryId; ?>">
                                   ADD
                                </a>
                                <span class="ml-2 flex align-center">
                                    <img
                                        class="thumb-image"
                                        src="<?php echo $value["logo"] ?>"
                                        alt="<?php echo $value["name"] ?> logo">
                                    <span
                                        class="ml-2 text-weight-bold"
                                        style="color: <?php echo $value["color"]; ?>;">
                                        <?php echo $value["name"] ?>
                                    </span>
                                </span>
                            </div>
                        <?php } ?>
                    </div>
                </section>
                <section class="not-attached software-list ma-2 bg-dark border-radius-2">
                    <h4 class="ma-3">Softwares atribuídos</h4>
                    <hr />
                    <div class="pa-3">
                        <?php foreach($attachedSoftwares as $value) { ?>
                            <div class="ma-1 pa-2 flex flex-row flex-nowrap border-white border-radius-circular">
                                <a class="bg-error text-medium text-weight-bold border-radius-circular unattach-button px-3 py-1 flex align-center"
                                   href="../../api/laboratory/unattach_software.php?software_id=<?php echo $value["id"]; ?>&laboratory_id=<?php echo $laboratoryId; ?>">
                                   REMOVE
                                </a>
                                <span class="ml-2 flex align-center">
                                    <img
                                        class="thumb-image"
                                        src="<?php echo $value["logo"] ?>"
                                        alt="<?php echo $value["name"] ?> logo">
                                    <span
                                        class="ml-2 text-weight-bold"
                                        style="color: <?php echo $value["color"]; ?>;">
                                        <?php echo $value["name"] ?>
                                    </span>
                                </span>
                            </div>
                        <?php } ?>
                    </div>
                </section>
            </article>
        </section>
    </body>
</html>
<?php
    }
?>