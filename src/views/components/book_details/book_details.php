<div class="border-2 border-stone-800 rounded-md p-3 w-full h-full">
    <div class="flex flex-row gap-3">
        <img src="/assets/images/livro.jpg" alt="" class="w-[100x] h-[100px]" />

        <div class="flex-[1] flex flex-col align-left gap-1">
            <a href="/livro?id=<?= $book->id ?>" class="font-semibold text-lg">
                <?= $book->titulo ?>
            </a>
            
            <div class="text-xs italic">
                <?= $book->autor ?>
            </div>
            
            <div class="text-xs italic">
                <?php for ( $i = 1; $book_avarage >= $i; $i++): ?>
                    ⭐
                <?php endfor ?>
                (<?= $total_assessments ?> Avaliações)
            </div>
        </div>
    </div>

    <p class="mt-5">
        <?= $book->descricao ?>
    </p>
</div>