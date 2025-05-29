<?= render('partials/header/header') ?>

<section class="max-w-screen-lg mx-auto mt-5 px-3 flex flex-row gap-5">
    <div class="flex-[1] border-2 border-stone-800 rounded-md">
        <h3 class="m-3 font-semibold">Login</h3>

        <hr class="w-full my-3 border-stone-800" />

        <form class="p-3 flex flex-col gap-3">
            <div class="flex flex-col gap-2">
                <label for="email">Email</label>
                <input id="email" type="text" name="email" class="border-2 border-stone-800 bg-stone-900 rounded-md focus:outline-none text-md px-2 py-1" />
            </div>

            <div class="flex flex-col gap-2">
                <label for="senha">Senha</label>
                <input id="senha" type="password" name="password" class="border-2 border-stone-800 bg-stone-900 rounded-md focus:outline-none text-md px-2 py-1" />
            </div>

            <div>
                <button type="submit" class="btn">Logar</button>
            </div>
        </form>
    </div>

    <div class="flex-[1] border-2 border-stone-800 rounded-md">
        <h3 class="m-3 font-semibold">Registro</h3>

        <?php if (isset($mensagem) && strlen($mensagem)): ?>
            <div class="m-3 border-2 border-green-400 bg-green-800 text-green-400 p-2 rounded-md">
                <?= $mensagem ?>
            </div>
        <?php endif; ?>

        <hr class="w-full my-3 border-stone-800" />

        <?php
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

        <form class="p-3 flex flex-col gap-3" method="post" action="/singup">
            <?php 
                foreach ( $singup_fields as $campo => $campo_config ): 
                    [
                        "name" => $campo_name,
                        "label" => $campo_label,
                        "type" => $campo_type
                    ] = $campo_config;

                    $error_mensage = "";
                    $input_class = "border-stone-800";
                    
                    if( isset($_SESSION['validacao']) && isset($_SESSION['validacao'][$campo_name]) ) {
                        if( sizeof($_SESSION['validacao'][$campo_name]) > 0) {
                            $error_mensage = $_SESSION['validacao'][$campo_name][0] . "*";
                            $input_class = "border-red-600";
                        }
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
                        class="border-2 bg-stone-900 rounded-md focus:outline-none text-md px-2 py-1 <?= $input_class ?>"
                    />
                </div>
            <?php endforeach; ?>

            <div>
                <button type="reset" class="btn btn-secondary">Cancelar</button>
                <button type="submit" class="btn">Registrar</button>
            </div>
        </form>
    </div>
</section>

<?php unset($_SESSION['validacao']) ?>