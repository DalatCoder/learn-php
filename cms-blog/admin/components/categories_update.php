<?php
// Update a category

if (isset($_POST['update'])) {
    $updated_cat_title = $_POST['cat_title'];
    if (!$updated_cat_title) {
        echo 'This field should not be empty';
    } else {
        $query = "UPDATE Categories ";
        $query .= "SET cat_title = '$updated_cat_title' ";
        $query .= "WHERE cat_id = $updated_cat_id"; // $updated_cat_id in categories.php

        $update_category_query = mysqli_query($connection, $query);
        if (!$update_category_query) {
            die('Oops! Error when updating selected category ' . mysqli_error($connection));
        }

        // Redirect when we done
        header("Location: categories.php");
    }
}
?>

<form action="" method="post">
    <div class="form-group">
        <label for="cat_title_update">Update Category</label>
        <?php
        // $updated_cat_id in categories.php

        $query = "SELECT * FROM Categories WHERE cat_id = $updated_cat_id";
        $select_category_query = mysqli_query($connection, $query);

        if (!$select_category_query) {
            die('Oops! Error when creating new category ' . mysqli_error($connection));
            return;
        }

        $count = mysqli_num_rows($select_category_query);
        if ($count > 0) {
            $row = mysqli_fetch_assoc($select_category_query);
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];
            if (!isset($cat_title)) $cat_title = "";
            ?>
            <input value="<?php echo $cat_title; ?>" class="form-control" type="text"
                   id="cat_title_update" name="cat_title"
                   autocomplete="off"/>
            <?php
        }
        ?>

    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update"
               value="Update Category"/>
    </div>
</form>