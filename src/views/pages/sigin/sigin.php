<?= render('partials/header/header') ?>

<section class="max-w-screen-lg mx-auto mt-5 px-3 flex flex-row gap-5">
    <div class="flex-[1] border-2 border-stone-800 rounded-md">
        <h3 class="m-3 font-semibold">Login</h3>

        <hr class="w-full my-3 border-stone-800" />

        <form class="p-3 flex flex-col gap-3">
            <div class="flex flex-col gap-2">
                <label for="email">Email</label>
                <input id="email" type="text" name="email" class="border-2 border-stone-800 bg-stone-900 rounded-md focus:outline-none text-md px-2 py-1" required />
            </div>

            <div class="flex flex-col gap-2">
                <label for="senha">Senha</label>
                <input id="senha" type="password" name="password" class="border-2 border-stone-800 bg-stone-900 rounded-md focus:outline-none text-md px-2 py-1" required />
            </div>

            <div>
                <button type="submit" class="btn">Logar</button>
            </div>
        </form>
    </div>

    <div class="flex-[1] border-2 border-stone-800 rounded-md">
        <h3 class="m-3 font-semibold">Registro</h3>

        <hr class="w-full my-3 border-stone-800" />

        <form class="p-3 flex flex-col gap-3">
            <div class="flex flex-col gap-2">
                <label for="nome">Nome</label>
                <input id="nome" type="text" name="nome" class="border-2 border-stone-800 bg-stone-900 rounded-md focus:outline-none text-md px-2 py-1" required />
            </div>

            <div class="flex flex-col gap-2">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" class="border-2 border-stone-800 bg-stone-900 rounded-md focus:outline-none text-md px-2 py-1" required />
            </div>

            <div class="flex flex-col gap-2">
                <label for="email_confirm">Confirme o email</label>
                <input id="email_confirm" type="email" name="email_confirm" class="border-2 border-stone-800 bg-stone-900 rounded-md focus:outline-none text-md px-2 py-1" required />
            </div>

            <div class="flex flex-col gap-2">
                <label for="senha">Senha</label>
                <input id="senha" type="password" name="password" class="border-2 border-stone-800 bg-stone-900 rounded-md focus:outline-none text-md px-2 py-1" required />
            </div>

            <div>
                <button type="reset" class="btn btn-secondary">Cancelar</button>
                <button type="submit" class="btn">Registrar</button>
            </div>
        </form>
    </div>
</section>