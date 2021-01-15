<?php
$query = "SELECT * FROM Categories";
$select_all_categories_query = mysqli_query($connection, $query);
if (!$select_all_categories_query) {
    die('Oops! Error when fetching category data ' . mysqli_error());
    return;
}
$count = mysqli_num_rows($select_all_categories_query);

if ($count > 0) {
    ?>
    <table class="table table-hover table-bordered">
        <thead>
        <tr>
            <th>Id</th>
            <th>Category Title</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php
        while ($row = mysqli_fetch_assoc($select_all_categories_query)) {
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];
            ?>
            <tr>
                <td><?php echo $cat_id; ?></td>
                <td><?php echo $cat_title; ?></td>
                <td><a href="categories.php?edit=<?php echo $cat_id; ?>">Edit</a></td>
                <td>
                    <a onclick="javascript: return confirm('Are you sure want to delete category: \'<?php echo $cat_title; ?>\'')"
                       href="categories.php?delete=<?php echo $cat_id; ?>">Delete</a>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    <?php
}
?>
