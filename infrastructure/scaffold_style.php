<?php
    require_once "constants.php";
    // Definitions
    $baseSize = "4px";
    $iterations = 12;
    // Style  scaffold    
    function scaffold_style() {
        global $baseSize;
        global $iterations;
    ?><style>
        @import url('https://fonts.googleapis.com/css?family=Raleway|Ubuntu&display=swap');
        /* Variables */
        :root {
            /* Colors */
            --dark-light-color: rgba(100, 100, 100, 1);
            --dark-color: rgba(50, 50, 50, 1);
            --primary-color: #42bff4;
            --primary-dark-color: #38a3d1;
            --accent-color: #f4ee41;
            /* Dimensions */
            --base-size: <?php echo $baseSize ?>;
        }
        /* Reset */
        * {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
            font-family: 'Ubuntu';
            color: white;
        }
        body {
            min-height: 100vh;
            background-color: var(--dark-light-color);
        }
        h1, h2, h3, h4, h5, h6 {
            font-weight: 100;
            font-family: 'Raleway';
        }
        a {
            text-decoration: none;
            color: unset;
        }
        /* Containers */
        .bg-dark {
            background-color: var(--dark-color);
        }
        /* Flexbox */
        .flex { display: flex; flex-wrap: wrap; }
        .flex-row { flex-direction: row; }
        .flex-column { flex-direction: column; }
        .justify-center { justify-content: center; }
        .justify-between { justify-content: space-between; }
        .justify-end { justify-content: end; }
        .align-center { align-items: center; }
        .align-start { align-items: start; }
        .align-stretch { align-items: stretch; }
        /* Text styles */
        .text-primary { color: var(--primary-color); }
        .text-primary-dark { color: var(--primary-dark-color); }
        .text-accent { color: var(--accent-color); }
        .text-center { text-align: center; }
        .text-title { font-family: 'Raleway'; }
        /* Forms */
        .data-form p input {
            border: none;
            padding: calc(var(--base-size) * 2);
            border-bottom: 1px solid black;
            background: transparent;
            transition: border-bottom-color .3s, color .3s;
            font-size: 1.25em;
        }
        .data-form p input:hover {
            border-bottom-color: var(--primary-color);
            color: var(--primary-color);
        }
        .data-form p input:focus {
            border-bottom-color: var(--primary-color);
            border-bottom-width: 2px;
            color: var(--primary-color);
        }
        .data-form button {
            cursor: pointer;
            background: transparent;
            padding: calc(var(--base-size) * 2);
            border: calc(var(--base-size) / 2) solid white;
            font-weight: bold;
            font-family: 'Raleway';
            text-transform: uppercase;
            border-radius: calc(var(--base-size) * 1000);
            padding: calc(var(--base-size) * 2) calc(var(--base-size) * 4);
        }
        .data-form button:hover {
            background-color: white;
            color: var(--dark-color);
        }
        .data-form button.primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }
        .data-form button.primary:hover {
            color: var(--dark-color);
            background-color: var(--primary-color);
        }
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
        .mt-<?php echo $i ?> {
            margin-top: calc(var(--base-size) * <?php echo $i ?>);
        }
        .mb-<?php echo $i ?> {
            margin-bottom: calc(var(--base-size) * <?php echo $i ?>);
        }
        .mr-<?php echo $i ?> {
            margin-right: calc(var(--base-size) * <?php echo $i ?>);
        }
        .ml-<?php echo $i ?> {
            margin-left: calc(var(--base-size) * <?php echo $i ?>);
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
        }
        /*  */
        .elevation-<?php echo $i ?> {
            box-shadow: 0px 0px <?php echo $i * 2 ?>px <?php echo $i ?>px rgba(0, 0, 0, .25);
        }
        .border-radius-<?php echo $i ?> {
            border-radius: <?php echo $i * 2 ?>px;
        }
        <?php } ?>
    </style><?php } ?>