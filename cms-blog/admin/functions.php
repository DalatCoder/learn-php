<?php

function insert_category() {
    global $connection;

    if (isset($_POST['submit'])) {
        $new_cat_title = $_POST['cat_title'];

        if (!$new_cat_title) {
            echo 'This field should not be empty';
        } else {
            $query = "INSERT INTO Categories(cat_title) VALUES('{$new_cat_title}')";

            $create_category_query = mysqli_query($connection, $query);
            if (!$create_category_query) {
                die('Oops! Error when creating new category ' . mysqli_error($connection));
            }

            // Redirect when we done
            header("Location: categories.php");
        }
    }
}

function delete_category() {
    global $connection;

    if (isset($_GET['delete'])) {
        $delete_cat_id = $_GET['delete'];
        if (is_numeric($delete_cat_id)) {
            $query = "DELETE FROM Categories WHERE cat_id = $delete_cat_id";

            $delete_category_query = mysqli_query($connection, $query);
            if (!$delete_cat_id) {
                die('Oops! Error when deleting selected category ' . mysqli_error($connection));
            }

            // Redirect when we done
            header("Location: categories.php");
        }
    }
}

function delete_post() {
    global $connection;

    if (isset($_GET['delete'])) {
        $delete_post_id = $_GET['delete'];
        if (is_numeric($delete_post_id)) {
            $query = "DELETE FROM Posts WHERE post_id = $delete_post_id";

            $delete_post_query = mysqli_query($connection, $query);
            if (!$delete_post_query) {
                die('Oops! Error when deleting selected post ' . mysqli_error($connection));
            }

            // Redirect when we done
            header("Location: posts.php");
        }
    }
}

?>
