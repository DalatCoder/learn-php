<form action="" method="POST">
    <input type="hidden" name="category[id]" value="<?= $category->id ?? '' ?>">

    <label for="categoryname">Enter category name:</label>
    <input type="text" id="categoryname" name="category[name]" value="<?= $category->name ?? '' ?>">

    <input type="submit" value="Save" name="submit">
</form>
