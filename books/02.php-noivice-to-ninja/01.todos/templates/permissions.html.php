<h2>Edit <?= $author->name ?> Permissions</h2>

<form action="" method="POST">
    <?php foreach ($permissions as $name => $value) : ?>
        <div>
            <input id="<?= $value ?>" type="checkbox" value="<?= $value ?>" name="permissions[]" <?= $author->hasPermission($value) ? 'checked' : '' ?>>
            <label for="<?= $value ?>"><?= $name ?></label>
        </div>
    <?php endforeach; ?>

    <input type="submit" value="Submit">
</form>
