<?php
    require_once __DIR__ . "/../infrastructure/constants.php";
    //
    function component_header() { ?>
        <style>
            .header {
                background: var(--primary-color);
            }
            .header h1 {
                color: white;
            }
        </style>
        <nav class="header flex justify-between pa-3">
            <h1>
                <?php echo APP_NAME; ?>
            </h1>
        </nav>
    <?php }
?>