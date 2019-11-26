<?php
    require_once __DIR__ . "/" . "../infrastructure/constants.php";
    require_once __DIR__ . "/" . "../components/manager.php";
    require_once __DIR__ . "/" . "../infrastructure/scaffold_style.php";
    require_once __DIR__ . "/" . "../infrastructure/page_auth_redirect.php";
    require_once __DIR__ . "/" . "../infrastructure/form_builder.php";
    //
    $pageAuthRedirect = new PageAuthRedirect();
    //
    if($pageAuthRedirect->redirect_if_authenticated()) {
        return;
    } else {
    $errors = $_GET["errors"] ?? null;
    if($errors != null) {
        $errors = json_decode($errors, true);
    }
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
           <?php 
                form_build(
                    null,
                    "Registrar",
                    $errors,
                    false,
                    true,
                    "../api/users/register.php",
                    "post",
                    "flex flex-column",
                    "",
                    [
                        [
                            "name" => "name",
                            "text" => "Nome",
                            "type" => "text",
                            "placeholder" => "Nome Completo",
                        ],
                        [
                            "name" => "email",
                            "text" => "Email",
                            "type" => "email",
                            "placeholder" => "Email",
                        ],
                        [
                            "name" => "password",
                            "text" => "Senha",
                            "type" => "password",
                            "placeholder" => "Senha",
                        ],
                        [
                            "name" => "confirmPassword",
                            "text" => "Confirmar Senha",
                            "type" => "password",
                            "placeholder" => "Confirme sua senha",
                        ],
                    ],
                    [
                        [
                            "text" => "Registrar",
                            "classes" => "primary",
                        ],
                    ]);
           ?>
        </section>
    </body>
</html>
<?php
    }
?>