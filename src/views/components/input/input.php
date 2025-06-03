<?php if ($type === "select"): ?>
    <select
        id="<?= $name ?>"
        name="<?= $name ?>"
        class="h-[35px] border-2 bg-stone-900 rounded-md focus:outline-none text-md px-2 py-1 <?= $css ?>">
        <?php foreach ($options as $option_value => $option_label): ?>
            <option value="<?= $option_value ?>" <?= $value == $option_value ? 'selected' : '' ?>>
                <?= $option_label ?>
            </option>
        <?php endforeach; ?>
    </select>
<?php elseif ($type === "textarea"): ?>
    <textarea
        id="<?= $name ?>"
        name="<?= $name ?>"
        class="border-2 bg-stone-900 rounded-md focus:outline-none text-md px-2 py-1 <?= $css ?>"
        rows="4"><?= $value ?></textarea>
<?php else: ?>
    <input
        id="<?= $name ?>"
        type="<?= $type ?>"
        name="<?= $name ?>"
        value="<?= $value ?>"
        class="border-2 bg-stone-900 rounded-md focus:outline-none text-md px-2 py-1 <?= $css ?>" />
<?php endif; ?>