<?= render('partials/header/header'); ?>

<div class="max-w-screen-lg mx-auto mt-5 px-3 flex flex-col gap-5">
    <?= render('components/book_details/book_details', [
        "book" => $book
    ]); ?>

    <h2>Avaliações</h2>

    <div class="grid grid-cols-8 gap-4">
        <div class="col-span-5"></div>

        <div class="col-span-3">
            <?= render('pages/livro/partials/formAvaliacao', [
                "book" => $book
            ]) ?>
        </div>
    </div>
</div>