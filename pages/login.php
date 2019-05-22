<?php
    require_once __DIR__ . "/" . "../infrastructure/constants.php";
    require_once __DIR__ . "/" . "../components/manager.php";
    require_once __DIR__ . "/" . "../infrastructure/scaffold_style.php";
?>
<html>
    <head>
        <title>
            Autenticação | <?php echo APP_NAME; ?>
        </title>
        <?php scaffold_style() ?>
    </head>
    <body>
        <?php require_component("header") ?>
        <section class="login">
            <!-- Login -->
            <form action="../api/users/login.php" method="post">
                <p>
                    <label for="email">E-mail</label>
                    <input type="email" name="email" id="email">
                </p>
                <p>
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password">
                </p>
                <button>
                    Entrar
                </button>
                <section class="subtitle">
                    <p>
                        Não tem conta?
                    </p>
                    <button value="register">
                        Criar conta
                    </button>
                </section>
            </form>
        </section>
    </body>
</html>