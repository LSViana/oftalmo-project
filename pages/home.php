<?php
    require_once __DIR__ . "/" . "../infrastructure/constants.php";
    require_once __DIR__ . "/" . "../components/manager.php";
    require_once __DIR__ . "/" . "../infrastructure/scaffold_style.php";
    require_once __DIR__ . "/" . "../infrastructure/page_auth_redirect.php";
    require_once __DIR__ . "/" . "../data/laboratories.php";
    require_once __DIR__ . "/" . "../data/softwares.php";
    //
    if(redirect_if_not_authenticated()) {
        return;
    } else {
        $laboratories = laboratories_list();
        $softwares = softwares_list();
    ?>
<html>
    <head>
        <title><?php echo APP_NAME ?></title>
        <?php scaffold_style() ?>
        <style>
            .card {
                padding: 16px;
                box-shadow: 0 0 5px 0px rgba(0,0,0,0.45)
            }
            .software-tag {
                border: calc(var(--base-size) / 2) solid;
            }
        </style>
    </head>
    <body>
        <?php require_component("header") ?>
        <main class="contents">
            <section class="laboratories pa-5">
                <div class="flex align-center">
                    <h2>Laboratórios</h2>
                    <a href="./laboratory/create.php">
                        <button class="action-button primary ml-3">
                            Adicionar
                        </button>
                    </a>
                </div>
                <section class="laboratories-list my-2 py-1 flex flex-nowrap overflow-x-auto">
                    <?php foreach($laboratories as $laboratory) { ?>
                        <article class="pa-5 bg-dark border-radius-3 mr-1 flex flex-column align-stretch" style="width: 350px;">
                            <div class="flex justify-between">
                                <h3 class="text-weight-bold text-font-body text-primary">
                                    <?php echo $laboratory["name"] ?>
                                </h3>
                                <a
                                    class="action-button py-1 px-3 text-small"
                                    href="<?php echo $BASE_URL . "/pages/laboratory/details.php?id=" . $laboratory["id"] ?>">
                                    Detalhes 🡪
                                </a>
                            </div>
                            <div class="flex justify-between text-medium">
                                <p class="mt-2">
                                    Computadores: <span class="text-weight-bold"><?php echo $laboratory["computers"] ?></span>
                                </p>
                                <p class="mt-2">
                                    Softwares: <span class="text-weight-bold"><?php echo sizeof($laboratory["softwares"]) ?></span>
                                </p>
                            </div>
                            <section class="softwares mt-3 pb-1 flex flex-row flex-nowrap overflow-x-auto">
                                <?php
                                    $amountOfSoftwaresToShow = 3;
                                    $softwaresIdSlice = array_slice($laboratory["softwares"], 0, $amountOfSoftwaresToShow);
                                    //
                                    foreach($softwaresIdSlice as $softwareId) {
                                        $software = array_values(array_filter($softwares, function($item) use ($softwareId) {
                                            return $item["id"] == $softwareId;
                                        }))[0] ?? null;
                                        if($software != null) {
                                            $softwareColor = $software["color"];
                                            ?>
                                            <a href="<?php echo $BASE_URL . "/pages/software/details.php?id=" . $software["id"] ?>">
                                                <p
                                                    class="software-tag py-1 px-3 mr-1 border-radius-circular"
                                                    style="<?php echo "border-color: " . $softwareColor . "; color: " . $softwareColor . "; font-size: .75em;" ?>">
                                                    <?php echo $software["name"] ?>
                                                </p>
                                            </a>
                                        <?php
                                        }
                                    }
                                ?>
                            </section>
                        </article>
                    <?php } ?>
                </section>
            </section>
            <hr />
            <section class="softwares pa-5">
                <div class="flex align-center">
                    <h2>Softwares</h2>
                    <a href="./software/create.php">
                        <button class="action-button primary ml-3">
                            Adicionar
                        </button>
                    </a>
                </div>
                <section class="softwares-list my-2 py-1 flex flex-nowrap overflow-x-auto">
                    <?php
                        foreach($softwares as $software) {
                            $softwareColor = $software["color"];
                        ?>
                        <article class="pa-5 bg-dark border-radius-3 mr-1 flex flex-column align-stretch" style="width: 350px;">
                            <div class="flex flex-nowrap align-center justify-between">
                                <div class="flex flex-nowrap align-center" style="flex: 1">
                                    <img
                                        class="thumb-image mr-3"
                                        src="<?php echo $software["logo"] ?>"
                                        alt="<?php echo $software["name"] . "'s logo" ?>">
                                    <h3
                                        class="text-weight-bold text-font-body text-primary"
                                        style="<?php echo "color: " . $softwareColor . "; flex: 1; text-overflow: ellipsis;" ?>">
                                        <?php echo $software["name"] ?>
                                    </h3>
                                </div>
                                <a
                                    class="action-button py-1 px-3 text-small"
                                    href="<?php echo $BASE_URL . "/pages/software/details.php?id=" . $software["id"] ?>">
                                    Detalhes 🡪
                                </a>
                            </div>
                            <p class="mt-3 text-justified" style="font-size: .9em;">
                                <?php echo $software["description"] ?>
                            </p>
                        </article>
                    <?php } ?>
                </section>
            </section>
            <hr />
            <section class="charts py-5">
                <div class="flex flex-column align-start">
                    <h2 class="ml-5">Gráficos</h2>
                    <article class="charts-lists flex flex-row flex-wrap ma-3">
                        <div class="flex flex-column align-center ma-2 pa-2 bg-dark border-radius-3">
                            <h3>
                                Softwares por laboratório
                            </h3>
                            <div class="border-radius-2 overflow-hidden">
                                <img
                                    src="../api/charts/software-by-laboratory.php"
                                    alt="Gráfico de softwares por laboratório">
                            </div>
                        </div>
                    </article>
                </div>
            </section>
        </main>
    </body>
</html>
<?php } ?>