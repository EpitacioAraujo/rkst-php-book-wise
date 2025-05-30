<?php
    $fields = flash()->get('Auth.SingUp.Fields', []);
    $validacoes = flash()->get('Auth.SingUp.Validacoes', []);

    $messageSuccess = flash()->get('Auth.SingUp.Message.Success');
    $messageError = flash()->get('Auth.SingUp.Message.Error');

    $singup_fields = [
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

<form class="p-3 flex flex-col gap-3" method="post" action="/auth/singup">
    <?php
        foreach ($singup_fields as $campo => $campo_config):
            [
                "name" => $campo_name,
                "label" => $campo_label,
                "type" => $campo_type
            ] = $campo_config;

        $error_mensage = "";
        $input_class = "border-stone-800";
        $value = "";

        if (isset($validacoes[$campo_name]) && sizeof($validacoes[$campo_name]) > 0) {
            $error_mensage = $validacoes[$campo_name][0] . "*";
            $input_class = "border-red-600";
        }

        if (isset($fields[$campo_name])) {
            $value = $fields[$campo_name];
        }
    ?>

        <div class="flex flex-col gap-2">
            <label for="<?= $campo_name ?>">
                <?= $campo_label ?>

                <span class="text-red-700 text-sm">
                    <?= $error_mensage ?>
                </span>
            </label>

            <input
                id="<?= $campo_name ?>"
                type="<?= $campo_type ?>"
                name="<?= $campo_name ?>"
                value="<?= $value ?>"
                class="border-2 bg-stone-900 rounded-md focus:outline-none text-md px-2 py-1 <?= $input_class ?>" />
        </div>
    <?php endforeach; ?>

    <div>
        <button type="reset" class="btn btn-secondary">Cancelar</button>
        <button type="submit" class="btn">Registrar</button>
    </div>
</form>