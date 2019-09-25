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
            Autenticação | <?php echo APP_NAME; ?>
        </title>
        <?php scaffold_style() ?>
    </head>
    <body>
        <?php require_component("header") ?>
        <section class="login flex justify-center align-center pa-8" style="flex: 1;">
            <!-- Login -->
            <form action="../api/users/login.php" method="post" class="bg-dark data-form pa-6 elevation-1 border-radius-5">
                <h2 class="form-title">Autenticação</h2>
                <p class="flex flex-column align-start my-2">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" id="email" value="lucas@gmail.com">
                </p>
                <p class="flex flex-column align-start my-2">
                    <label for="password">Senha</label>
                    <input type="password" name="password" id="password" value="Asdf1234">
                </p>
                <section class="actions flex justify-end my-4">
                    <button class="primary">
                        Entrar
                    </button>
                </section>
                <section class="subtitle flex align-center justify-center mt-6">
                    <p class="text-primary mr-3">
                        Não tem conta?
                    </p>
                    <button name="register">
                        Criar conta
                    </button>
                </section>
            </form>
        </section>
    </body>
</html>
<?php
    }
?>