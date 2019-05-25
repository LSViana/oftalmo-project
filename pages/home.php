<?php
    require_once __DIR__ . "/" . "../infrastructure/constants.php";
    require_once __DIR__ . "/" . "../components/manager.php";
    require_once __DIR__ . "/" . "../infrastructure/scaffold_style.php";
    require_once __DIR__ . "/" . "../infrastructure/page_auth_redirect.php";
    //
    if(redirect_if_authenticated()) {
        return;
    } else { ?>
<html lang="en">
    <head>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
        rel="stylesheet">
        <title><?php echo APP_NAME ?></title>
        <?php scaffold_style() ?>
        <style>
            .card {
                padding: 16px;
                box-shadow: 0 0 5px 0px rgba(0,0,0,0.45)
            }
            .list{
                list-style-type: none;
            }
        </style>
    </head>
    <body>
        <?php require_component("header") ?>
        <main class="contents flex flex-column align-center">
            <section>
                <div class="card mt-6">
                    <h1 class="text-center">Laboratórios</h1>
                    <ul class="list">
                        <li class="flex justify-between">
                            <span class="flex align-center">Laboratório 3</span>
                            <i class="material-icons">edit</i>
                        </li>
                        <li>Laboratório 4</li>
                    </ul>
                </div>
            </section>
            <section>
                <div class="card mt-6">
                    <h1 class="text-center">Softwares</h1>
                    <ul class="list">
                        <li>Microsoft Office Word 2013</li>
                        <li>Visual Studio Code</li>
                    </ul>
                </div>
            </section>    
        </main>
    </body>
</html>
<?php } ?>