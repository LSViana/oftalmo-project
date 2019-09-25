<?php
    require_once __DIR__ . "/" . "../infrastructure/constants.php";
    require_once __DIR__ . "/" . "../components/manager.php";
    require_once __DIR__ . "/" . "../infrastructure/scaffold_style.php";
    require_once __DIR__ . "/" . "../infrastructure/page_auth_redirect.php";
    //
    $pageAuthRedirect = new PageAuthRedirect();
    //
    if($pageAuthRedirect->redirect_if_authenticated()) {
        return;
    } else {
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
                <h2 class="form-title">Registrar</h3>
                <p class="flex flex-column align-start my-2">
                    <label for="name">Nome</label>
                    <input type="text" name="name" id="name">
                </p>
                <p class="flex flex-column align-start my-2">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" id="email">
                </p>
                <p class="flex flex-column align-start my-2">
                    <label for="password">Senha</label>
                    <input type="password" name="password" id="password">
                </p>
                <p class="flex flex-column align-start my-2">
                    <label for="confirmPassword">Confirmar Senha</label>
                    <input type="password" name="confirmPassword" id="confirmPassword">
                </p>
                <button name="register">
                    Criar conta
                </button>
            </form>
        </section>
    </body>
</html>
<?php
    }
?>