<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>

    <?php include realpath(__DIR__ . "/../../../public/assets/styles/styles.php") ?>

    <title>Bookwise</title>
</head>

<body class="bg-stone-900 text-stone-400">
    <?php if(flash()->get('Global.Message.Success')): ?>
        <div class="m-3 border-2 border-green-400 bg-green-800 text-green-400 p-2 rounded-md">
            <?= flash()->get('Global.Message.Success') ?>
        </div>
    <?php endif; ?>

    <?php if(flash()->get('Global.Message.Error')): ?>
        <div class="m-3 border-2 border-red-400 bg-red-800 text-red-400 p-2 rounded-md">
            <?= flash()->get('Global.Message.Error') ?>
        </div>
    <?php endif; ?>

    <?= $content ?>
</body>

</html>