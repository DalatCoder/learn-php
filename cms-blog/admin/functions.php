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

function delete_comment() {
    global $connection;

    if (isset($_GET['delete'])) {
        $delete_comment_id = $_GET['delete'];
        if (is_numeric($delete_comment_id)) {
            $query = "DELETE FROM Comments WHERE comment_id = $delete_comment_id";

            $delete_comment_query = mysqli_query($connection, $query);
            if (!$delete_comment_query) {
                die('Oops! Error when deleting selected comment ' . mysqli_error($connection));
            }

            // Redirect when we done
            header("Location: comments.php");
        }
    }
}

function approved_comment() {
    global $connection;

    if (isset($_GET['approved'])) {
        $approved_comment_id = $_GET['approved'];
        if (is_numeric($approved_comment_id)) {
            $query = "UPDATE Comments SET comment_status = 'approved' WHERE comment_id = $approved_comment_id";

            $approved_comment_query = mysqli_query($connection, $query);
            if (!$approved_comment_query) {
                die('Oops! Error when approving selected comment ' . mysqli_error($connection));
            }

            // Redirect when we done
            header("Location: comments.php");
        }
    }
}

function unapproved_comment() {
    global $connection;

    if (isset($_GET['unapproved'])) {
        $unapproved_comment_id = $_GET['unapproved'];
        if (is_numeric($unapproved_comment_id)) {
            $query = "UPDATE Comments SET comment_status = 'unapproved' WHERE comment_id = $unapproved_comment_id";

            $unapproved_comment_query = mysqli_query($connection, $query);
            if (!$unapproved_comment_query) {
                die('Oops! Error when unapproving selected comment ' . mysqli_error($connection));
            }

            // Redirect when we done
            header("Location: comments.php");
        }
    }
}

?>
