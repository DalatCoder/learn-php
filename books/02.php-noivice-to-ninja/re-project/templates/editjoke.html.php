<form action="" method="POST">
    <input type="hidden" name="jokeid" value="<?= $joke['id'] ?? '' ?>">
    <label for="joketext">Type your joke here: </label>
    <textarea name="joketext" id="joketext" cols="40" rows="3"><?= $joke['joketext'] ?? '' ?></textarea>
    <input type="submit" value="<?= isset($joke) && $joke['id'] ? 'Update' : 'Create' ?>">
</form>
