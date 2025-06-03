<header class="w-full bg-stone-700 pt-4 pb-4">
    <nav class="max-w-screen-lg mx-auto flex flex-row justify-between items-center px-3">
        <div class="font-bold text-xl tracking-wide">Book wise</div>

        <ul class="flex space-x-4 font-bold">
            <li class="text-lime-500"><a href="/">Explorar</a></li>
            <li class="hover:underline"><a href="/meus-livros">Meus livros</a></li>
        </ul>

        <?php if(isset($_SESSION['auth'])):?>
            <a href="/auth/signout">
                Olá, <?= $_SESSION['auth']->nome ?>!
            </a>
        <?php else: ?>
            <a class="hover:underlined" href="/auth">Fazer login</a>
        <?php endif; ?>
    </nav>
</header>

<section class="max-w-screen-lg mx-auto">
    <?php if(flash()->get('Global.Message.Success')): ?>
        <div class="m-3 border-2 border-green-400 bg-green-800 text-green-200 p-2 rounded-md">
            <?= flash()->get('Global.Message.Success') ?>
        </div>
    <?php endif; ?>

    <?php if(flash()->get('Global.Message.Error')): ?>
        <div class="m-3 border-2 border-red-400 bg-red-800 text-red-200 p-2 rounded-md">
            <?= flash()->get('Global.Message.Error') ?>
        </div>
    <?php endif; ?>
</section>