<?php
    require_once __DIR__ . "/" . "../infrastructure/constants.php";
    require_once __DIR__ . "/" . "../components/manager.php";
    require_once __DIR__ . "/" . "../infrastructure/scaffold_style.php";
?>
<html>
    <head>
        <title>
            Criar Conta | <?php echo APP_NAME; ?>
        </title>
        <?php scaffold_style() ?>
    </head>
    <body class="flex flex-column align-stretch">
        <?php require_component("header") ?>
        <section class="login flex justify-center align-center pa-8" style="flex: 1;">
            <!-- Login -->
            <form action="../api/users/register.php" method="post" class="bg-dark data-form pa-6 elevation-1 border-radius-1">
                <h3>To be implemented</h3>
                <button name="register">
                    Criar conta
                </button>
            </form>
        </section>
    </body>
</html>