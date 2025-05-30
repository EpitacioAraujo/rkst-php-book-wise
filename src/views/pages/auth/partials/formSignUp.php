<?php
    $fields = flash()->get('Auth.SignUp.Fields', []);
    $validations = flash()->get('Auth.SignUp.Validations', []);

    $messageSuccess = flash()->get('Auth.SignUp.Message.Success');
    $messageError = flash()->get('Auth.SignUp.Message.Error');

    $signup_fields = [
        "nome" => [
            "label" => "Nome",
            "name" => "nome",
            "type" => "text",
        ],
        "email" => [
            "label" => "Email",
            "name" => "email",
            "type" => "text"
        ],
        "email_confirm" => [
            "label" => "Confirme o email",
            "name" => "email_confirm",
            "type" => "text"
        ],
        "senha" => [
            "label" => "Senha",
            "name" => "senha",
            "type" => "password"
        ],
    ];
?>

<?php 
    if ($messageSuccess && strlen($messageSuccess)): 
?>
    <div class="m-3 border-2 border-green-400 bg-green-800 text-green-400 p-2 rounded-md">
        <?= $messageSuccess ?>
    </div>

    <hr class="w-full my-3 border-stone-800" />
<?php endif; ?>

<form class="p-3 flex flex-col gap-3" method="post" action="/auth/signup">
    <?php
        foreach ($signup_fields as $field => $field_config):
            [
                "name" => $field_name,
                "label" => $field_label,
                "type" => $field_type
            ] = $field_config;

        $error_message = "";
        $input_class = "border-stone-800";
        $value = "";

        if (isset($validations[$field_name]) && sizeof($validations[$field_name]) > 0) {
            $error_message = $validations[$field_name][0] . "*";
            $input_class = "border-red-600";
        }

        if (isset($fields[$field_name])) {
            $value = $fields[$field_name];
        }
    ?>

        <div class="flex flex-col gap-2">
            <label for="<?= $field_name ?>">
                <?= $field_label ?>

                <span class="text-red-700 text-sm">
                    <?= $error_message ?>
                </span>
            </label>

            <input
                id="<?= $field_name ?>"
                type="<?= $field_type ?>"
                name="<?= $field_name ?>"
                value="<?= $value ?>"
                class="border-2 bg-stone-900 rounded-md focus:outline-none text-md px-2 py-1 <?= $input_class ?>" />
        </div>
    <?php endforeach; ?>

    <div>
        <button type="reset" class="btn btn-secondary">Cancel</button>
        <button type="submit" class="btn">Register</button>
    </div>
</form>