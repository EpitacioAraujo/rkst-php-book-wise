<?= render('partials/header/header'); ?>

<div class="mt-5 px-3">
    <?= render('components/book_details/book_details', [
        "book" => $book
    ]); ?>
</div>