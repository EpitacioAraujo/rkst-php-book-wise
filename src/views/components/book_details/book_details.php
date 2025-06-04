<div class="border-2 border-stone-800 rounded-md p-3 w-full h-full">
    <div class="flex flex-row gap-3">
        <div class="w-[100px] h-[100px] border-stone-800 border rounded-md overflow-hidden">
            <?php if($book->imagem): ?>
                <img src="/assets/images/<?= $book->imagem ?>" alt="" class="w-full h-full object-cover" />
            <?php else: ?>
                <div class="w-full h-full flex items-center justify-center text-sm">Sem imagem</div>
            <?php endif ?>
        </div>

        <div class="flex-[1] flex flex-col align-left gap-1">
            <a href="/livro?id=<?= $book->id ?>" class="font-semibold text-lg">
                <?= $book->titulo ?>
            </a>
            
            <div class="text-xs italic">
                <?= $book->autor ?>
            </div>
            
            <div class="text-xs italic">
                <?php for ( $i = 1; $book->avarage >= $i; $i++): ?>
                    ⭐
                <?php endfor ?>
                (<?= $book->total_assessments ?> Avaliações)
            </div>
        </div>
    </div>

    <p class="mt-5">
        <?= $book->descricao ?>
    </p>
</div>