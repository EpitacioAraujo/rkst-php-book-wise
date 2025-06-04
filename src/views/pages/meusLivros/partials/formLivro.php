<?php
$error_message = flash()->get(key: 'Livro.Store.Message.Error');
$success_message = flash()->get(key: 'Livro.Store.Message.Success');
$validations = flash()->get(key: 'Livro.Store.Validations', defaultValue: []);
$defaultValues = flash()->get(key: 'Livro.Store.Fields', defaultValue: []);

$signin_fields = [
    "imagem" => [
        "label" => "Imagem",
        "name" => "imagem",
        "type" => "file"
    ],
    "titulo" => [
        "label" => "titulo",
        "name" => "titulo",
        "type" => "text"
    ],
    "autor" => [
        "label" => "Autor",
        "name" => "autor",
        "type" => "text"
    ],
    "descricao" => [
        "label" => "Descrição",
        "name" => "descricao",
        "type" => "textarea"
    ],
    "ano_lancamento" => [
        "label" => "Ano de lançamento",
        "name" => "ano_lancamento",
        "type" => "select",
        "options" => (function() {
            $years = range(1800, date('Y'));
            return array_combine($years, $years);
        })()
    ],
];
?>

<div class="flex-[1] border-2 border-stone-800 rounded-md">
    <h3 class="m-3 font-semibold">Registro</h3>

    <hr class="w-full my-3 border-stone-800 border-1" />

    <div class="p-3">
        <form class="flex flex-col gap-3" method="post" action="/livro" enctype="multipart/form-data">
            <?php if ($error_message && strlen($error_message)): ?>
                <div class="text-red-800">
                    <?= $error_message ?>
                </div>
            <?php endif; ?>

            <?php if ($success_message && strlen($success_message)): ?>
                <div class="text-emerald-800">
                    <?= $success_message ?>
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

                    <?= render('components/input/input', [
                        "name" => $field_name,
                        "label" => $field_label,
                        "type" => $field_type,
                        "value" => $value,
                        "css" => $input_class,
                        "options" => isset($field_config['options']) ? $field_config['options'] : []
                    ]) ?>
                </div>
            <?php endforeach; ?>

            <div>
                <button type="submit" class="btn">Registrar</button>
            </div>
        </form>
    </div>
</div>