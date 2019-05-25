<?php
    require_once __DIR__ . "/" . "../infrastructure/constants.php";
    require_once __DIR__ . "/" . "../infrastructure/request_data.php";
    require_once __DIR__ . "/" . "../infrastructure/session_manager.php";
    // Routes
    $routes = [
        "index" => $BASE_URL . "/index.php",
        "login" => $BASE_URL . "/pages/login.php",
        "logout" => $BASE_URL . "/pages/logout.php",
    ];
    // Print component
    function component_header() {
        global $routes;
        ?><style>
            .header {
                background-color: var(--dark-color);
            }
            .header h1 {
                color: var(--primary-color);
            }
            .header .pages a p {
                color: white;
                font-weight: 600;
            }
            @media only screen and (max-width: 720px) {
                .header .pages {
                    display: none;
                }
            }
        </style>
        <nav class="header flex justify-between align-stretch elevation-4">
            <h1 class="ma-3">
                <?php echo APP_NAME; ?>
            </h1>
            <section class="pages flex">
                <a href="<?php echo $routes['index'] ?>" class="px-4 flex align-center">
                    <h4 class="text-title">HOME</h4>
                </a>
                <?php
                if(session_is_authenticated()) {
                ?><a href="<?php echo $routes['logout'] ?>" class="px-4 flex align-center">
                    <h4 class="text-title">LOGOUT</h4>
                </a><?php
                } else {
                ?><a href="<?php echo $routes['login'] ?>" class="px-4 flex align-center">
                    <h4 class="text-title">LOGIN</h4>
                </a><?php
                } ?>
            </section>
        </nav>
    <?php }
?>