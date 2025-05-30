<?php
    $message = flash()->get(key: 'Auth.SignIn.Message.Error');
    $validations = flash()->get(key: 'Auth.SignIn.Validations', defaultValue: []);
    $defaultValues = flash()->get(key: 'Auth.SignIn.Fields', defaultValue: []);

    $signin_fields = [
        "email" => [
            "label" => "Email",
            "name" => "email",
            "type" => "text"
        ],
        "senha" => [
            "label" => "Senha",
            "name" => "senha",
            "type" => "password"
        ],
    ];
?>

<form class="flex flex-col gap-3" method="post" action="/auth/signin">
    <?php if ($message && strlen($message)): ?>
        <div class="text-red-800">
            <?= $message ?>
        </div>
    <?php endif; ?>
    
    <?php
        foreach ($signin_fields as $field => $field_config):
            [
                "name" => $field_name,
                "label" => $field_label,
                "type" => $field_type
            ] = $field_config;

            $error_message = "";
            $input_class = "border-stone-800";
            $value = "";

            if (isset($validations[$field_name]) && sizeof($validations[$field_name]) > 0) {
                $error_message = $validations[$field_name][0];
                $input_class = "border-red-600";
            }

            if (isset($defaultValues[$field_name])) {
                $value = $defaultValues[$field_name];
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
        <button type="submit" class="btn">Sign In</button>
    </div>
</form>