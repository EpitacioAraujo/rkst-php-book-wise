<?= render('partials/header/header') ?>

<main class="max-w-screen-lg mx-auto mt-5 px-3">
    <form class="w-full flex gap-7">
        <input
            type="text"
            name="pesquisa"
            class="border-2 border-stone-800 bg-stone-900 rounded-md focus:outline-none text-md px-2 py-1 flex-[1]"
            placeholder="Buscar" aria-label="Search" />

        <button type=" submit">🔍</button>
    </form>

    <section class="grid grid-cols-3 max-md:grid-cols-2 gap-3 mt-5">
        <?php foreach($books as $book): 
            echo render('components/book_details/book_details', [
                "book" => $book
            ]);
        endforeach; ?>
    </section>
</main>