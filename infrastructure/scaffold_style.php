<?php
    require_once "constants.php";
    // Definitions
    $baseSize = "4px";
    $iterations = 6;
    // Style  scaffold    
    function scaffold_style() {
        global $baseSize;
        global $iterations;
    ?>
    <!-- Infrastructure styles -->
    <style>
        @import url('https://fonts.googleapis.com/css?family=Concert+One|Ubuntu&display=swap');
        /* Variables */
        :root {
            /* Colors */
            --primary-color: #42bff4;
            --primary-dark-color: #38a3d1;
            --accent-color: #41f4a6;
            /* Dimensions */
            --base-size: <?php echo $baseSize ?>
        }
        /* Reset */
        * {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
            font-family: 'Ubuntu';
        }
        h1, h2, h3, h4, h5, h6 {
            font-weight: 100;
            font-family: 'Concert One';
        }
         a {
            text-decoration: none;
        }
        /* Flexbox */
        .flex { display: flex; }
        .justify-center { justify-content: center; }
        .justify-between { justify-content: space-between; }
        .align-center { align-content: center; }
        /* Layout box */
        <?php
        for($i = 1; $i <= $iterations; $i++) {
        ?>.ma-<?php echo $i ?> {
            margin: calc(var(--base-size) * <?php echo $i; ?>);
        }
        .mx-<?php echo $i ?> {
            margin-left: calc(var(--base-size) * <?php echo $i ?>);
            margin-right: calc(var(--base-size) * <?php echo $i ?>);
        }
        .my-<?php echo $i ?> {
            margin-top: calc(var(--base-size) * <?php echo $i ?>);
            margin-bottom: calc(var(--base-size) * <?php echo $i ?>);
        }
        /*  */
        .pa-<?php echo $i ?> {
            padding: calc(var(--base-size) * <?php echo $i ?>);
        }
        .px-<?php echo $i ?> {
            padding-left: calc(var(--base-size) * <?php echo $i ?>);
            padding-right: calc(var(--base-size) * <?php echo $i ?>);
        }
        .py-<?php echo $i ?> {
            padding-top: calc(var(--base-size) * <?php echo $i ?>);
            padding-bottom: calc(var(--base-size) * <?php echo $i ?>);
        }<?php
        } ?>
    </style>
<?php
    }
?>