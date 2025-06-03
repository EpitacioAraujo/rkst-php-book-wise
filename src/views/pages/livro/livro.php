<?= render('partials/header/header'); ?>

<div class="max-w-screen-lg mx-auto mt-5 px-3 flex flex-col gap-5">
    <?= render('components/book_details/book_details', [
        "book" => $book
    ]); ?>

    <h2>Avaliações</h2>

    <div class="grid grid-cols-8 gap-4">
        <div class="col-span-5 flex flex-col gap-5">
            <?php foreach ( $assessments as $assessment): ?>
                <div class="border-2 border-stone-800 rounded-md p-3">
                    <div>
                        <?php for ( $i = 1; $assessment->nota >= $i; $i++): ?>
                            ⭐
                        <?php endfor ?>
                    </div>

                    <p class="mt-3 italic">
                        &ldquo;<?= $assessment->avaliacao ?>&rdquo;
                    </p>
                </div>
            <?php endforeach ?>
        </div>

        <div class="col-span-3">
            <?php if(auth()): ?>
                <?= render('pages/livro/partials/formAvaliacao', [
                    "book" => $book
                ]) ?>
            <?php endif ?>
        </div>
    </div>
</div>