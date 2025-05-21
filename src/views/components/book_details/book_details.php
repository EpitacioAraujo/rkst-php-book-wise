<div class="border-2 border-stone-800 rounded-md p-3 w-full h-full">
    <div class="flex flex-row gap-3">
        <img src="/assets/images/livro.jpg" alt="" class="w-[100x] h-[100px]" />

        <div class="flex-[1] flex flex-col align-left gap-1">
            <a href="/livro?id=<?= $livro->id ?>" class="font-semibold text-lg">
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