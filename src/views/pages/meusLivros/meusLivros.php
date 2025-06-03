<?php
    ob_start();
?>

<?= render('partials/header/header') ?>

<div class="max-w-screen-lg mx-auto px-3 mt-5 grid grid-cols-8 gap-3">
    <div class="col-span-5 flex flex-col gap-3">
        <?php foreach ( $books as $book): ?>
            <div>
                <?= render('components/book_details/book_details', [
                    "book" => $book
                ]) ?>
            </div>
        <?php endforeach ?>
    </div>

    <div class="col-span-3">
        <?= render('pages/meusLivros/partials/formLivro') ?>
    </div>
</div>

<?php
    $content = ob_get_clean();
    echo render('partials/layout/layout', ["content" => $content]);
?>