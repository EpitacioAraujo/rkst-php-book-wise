<?php
    $menssagem = flash()->get(chave: 'Auth.SignIn.Message.Error');
    $validacoes = flash()->get(chave: 'Auth.SignIn.Validacoes', defaultValue: []);
    $valoresPadroes = flash()->get(chave: 'Auth.SignIn.Fields', defaultValue: []);

    $singin_fields = [
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

<form class="flex flex-col gap-3" method="post" action="/auth/singin">
    <?php if ($menssagem && strlen($menssagem)): ?>
        <div class="text-red-800">
            <?= $menssagem ?>
        </div>
    <?php endif; ?>
    
    <?php
        foreach ($singin_fields as $campo => $campo_config):
            [
                "name" => $campo_name,
                "label" => $campo_label,
                "type" => $campo_type
            ] = $campo_config;

            $error_mensage = "";
            $input_class = "border-stone-800";
            $value = "";

            if (isset($validacoes[$campo_name]) && sizeof($validacoes[$campo_name]) > 0) {
                $error_mensage = $validacoes[$campo_name][0];
                $input_class = "border-red-600";
            }

            if (isset($valoresPadroes[$campo_name])) {
                $value = $valoresPadroes[$campo_name];
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
        <button type="submit" class="btn">Sign In</button>
    </div>
</form>