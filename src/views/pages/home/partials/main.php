<main class="max-w-screen-lg mx-auto mt-5 px-3">
    <form class="w-full flex gap-7">
        <input
            type="text"
            name=""
            id=""
            class="border-2 border-stone-800 bg-stone-900 rounded-md focus:outline-none text-md px-2 py-1 flex-[1]"
            placeholder="Buscar" aria-label="Search" />

        <button type=" submit">🔍</button>
    </form>

    <section class="grid grid-cols-3 max-md:grid-cols-2 gap-3 mt-5">
        <?php foreach($livros as $livro): ?>
            <div class="border-2 border-stone-800 rounded-md p-3 w-full h-full">
                <div class="flex flex-row gap-3">
                    <img src="/assets/images/livro.jpg" alt="" class="w-[100x] h-[100px]" />

                    <div class="flex-[1] flex flex-col align-left gap-1">
                        <a href="/livro?" class="font-semibold text-lg">
                            <?= $livro->titulo ?>
                        </a>
                        <div class="text-xs italic">
                            <?= $livro->autor ?>
                        </div>
                        <div class="text-xs italic">⭐⭐⭐⭐⭐(3 Avaliações)</div>
                    </div>
                </div>

                <p class="mt-5">
                    <?= $livro->descricao ?>
                </p>
            </div>
        <?php endforeach; ?>
    </section>
</main>