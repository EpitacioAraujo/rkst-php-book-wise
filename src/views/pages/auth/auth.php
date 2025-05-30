<?= render('partials/header/header') ?>

<section class="max-w-screen-lg mx-auto mt-5 px-3 flex flex-row gap-5">
    <div class="flex-[1] border-2 border-stone-800 rounded-md">
        <h3 class="m-3 font-semibold">Login</h3>

        <hr class="w-full my-3 border-stone-800" />

        <div class="p-3">
            <?= render('pages/auth/partials/formSignIn') ?>
        </div>
        
    </div>

    <div class="flex-[1] border-2 border-stone-800 rounded-md">
        <h3 class="m-3 font-semibold">Registro</h3>

        <div class="p-3">
            <?= render('pages/auth/partials/formSingUp') ?>
        </div>
    </div>
</section>

<?php unset($_SESSION['validacao']) ?>