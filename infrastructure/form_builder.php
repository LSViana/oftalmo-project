<?php
    function form_build($model, $errors, $success, $includeId, $action, $method, $classes, $styles, $fields, $buttons) {
    ?>
    <form
        action="<?php echo $action ?>"
        method="<?php echo $method ?>"
        class="data-form pa-6 bg-dark border-radius-5 elevation-1 <?php echo $classes ?>"
        style="<?php echo $styles ?>">
        <?php
            if($includeId) {
            ?>
                <input type="hidden" name="id" value="<?php echo ($model["id"] ?? "") ?>">
            <?php
            }
        ?>
        <?php
            foreach($fields as $field) {
            ?>
            <p class="mt-3 flex flex-column align-stretch">
                <label for="<?php echo $field["name"] ?>">
                    <?php echo $field["text"] ?>
                </label>
                <?php if(($field["tag"] ?? "") == "textarea") {
                    ?>
                        <textarea
                            name="<?php echo $field["name"] ?>"
                            id="<?php echo $field["name"] ?>"
                            cols="30"
                            rows="5"><?php echo $model[$field["name"]] ?? "" ?></textarea>
                    <?php
                    } else {
                    ?>
                        <input
                        type="<?php echo $field["type"] ?>"
                        name="<?php echo $field["name"] ?>"
                        id="<?php echo $field["name"] ?>"
                        value="<?php echo $model[$field["name"]] ?? "" ?>">
                    <?php
                    }
                ?>
                <?php
                    if(isset($errors[$field["name"]])) {
                        $errorMessage = $errors[$field["name"]];
                ?>
                    <p class="error mt-1">
                        <?php echo $errorMessage; ?>
                    </p>
                <?php
                    }
                ?>
            </p>
            <?php
            }
        ?>
        <section class="actions my-4 flex flex-row justify-end">
            <?php
                foreach($buttons as $button) {
                ?>
                    <button
                        <?php if(isset($button["value"])) echo "value=\"" . $button["value"] . "\"" ?>
                        class="mt-3 mr-1 <?php echo $button["classes"] ?? "" ?>">
                        <?php echo $button["text"] ?>
                    </button>
                <?php
                }
            ?>
        </section>
        <?php
            if($success) {
            ?>
            <div class="flex justify-end">
                <p class="text-primary">
                    Operação realizada com sucesso.
                </p>
            </div>
        <?php
            }
        ?>
    </form>
    <?php
    }
?>