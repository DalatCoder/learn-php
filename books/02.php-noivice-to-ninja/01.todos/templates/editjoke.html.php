    <form action="" method="POST">
        <input type="hidden" name="joke[id]" value="<?= $joke->id ?? '' ?>">
        <label for="joketext">Type your joke here: </label>
        <textarea name="joke[joketext]" id="joketext" cols="40" rows="3"><?= $joke->joketext ?? '' ?></textarea>

        <p>Select categories for this joke:</p>

        <?php foreach ($categories as $category) : ?>

            <?php if ($joke && $joke->hasCategory($category->id)) : ?>
                <input type="checkbox" checked name="category[]" id="<?= $category->id ?>" value="<?= $category->id ?>">
            <?php else : ?>
                <input type="checkbox" name="category[]" id="<?= $category->id ?>" value="<?= $category->id ?>">
            <?php endif; ?>

            <label for="<?= $category->id ?>"><?= $category->name ?></label>
        <?php endforeach; ?>

        <input type="submit" value="<?= isset($joke) && $joke->id ? 'Update' : 'Create' ?>">
    </form>
